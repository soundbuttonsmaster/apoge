<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Carbon;
use Validator;
use Image;
use Str;
use File;

class AdminBlogController extends Controller
{
    public function create()
    {
        $blogList = Blog::orderBy('id', 'DESC')->get();
        return view('admin.blog.index', compact('blogList'));
    }

    private function ensureBlogUploadDirs(): void
    {
        foreach (['datels', 'list', 'thumb', 'featured'] as $folder) {
            $path = public_path('uploads/blog/' . $folder);
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }
    }

    private function makeBlogImageName($file): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $base = Str::slug($base) ?: 'image';

        return rand(111, 999) . time() . '_' . $base . '.' . $ext;
    }

    private function applyScheduleAndStatus(Blog $blogObj, Request $req): void
    {
        $raw = trim((string) $req->input('scheduled_at', ''));
        $scheduledAt = null;

        if ($raw !== '') {
            try {
                $tz = config('app.timezone');
                // datetime-local posts "YYYY-MM-DDTHH:mm"
                if (preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/', $raw)) {
                    $scheduledAt = Carbon::createFromFormat('Y-m-d\TH:i', substr($raw, 0, 16), $tz);
                } else {
                    $scheduledAt = Carbon::parse($raw, $tz);
                }
            } catch (\Throwable $e) {
                $scheduledAt = null;
            }
        }

        $blogObj->scheduled_at = $scheduledAt;

        // Future schedule => keep unpublished until that date/time
        if ($scheduledAt && $scheduledAt->isFuture()) {
            $blogObj->status = 0;
            return;
        }

        $blogObj->status = $req->boolean('status') ? 1 : 0;
    }

    public function store(Request $req)
    {
        // dd($req->all());
        if ($req->input('scheduled_at') === '') {
            $req->merge(['scheduled_at' => null]);
        }

        $validator = Validator::make($req->all(), [
            'title' => 'required|unique:blogs',
            'short_description' => 'required',
            // 'full_description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'scheduled_at' => 'nullable|date',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPEG, PNG, and JPG formats are allowed.',
            'image.max' => 'The image size must not exceed 6MB.',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $blogObj = new Blog();

        if ($req->hasFile('image')) {
            $this->ensureBlogUploadDirs();
            $image1 = $req->file('image');
            $image = $this->makeBlogImageName($image1);
            $image_resize = Image::make($image1->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 800) {
                $image_resize->resize(800, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/datels/' . $image));

            if ($width > 380) {
                $image_resize->resize(380, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/list/' . $image));

            if ($width > 90) {
                $image_resize->resize(90, 90, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/thumb/' . $image));
            $blogObj->image = $image;
        } else {
            $blogObj->image = null;
        }

        $blogObj->title =  $req->title;
        $blogObj->slug =  Str::slug($req->title);
        $blogObj->short_description =  $req->short_description;
        $blogObj->full_description =  $req->full_description;
        $blogObj->meta_title = $req->meta_title;
        $blogObj->meta_keywords = $req->meta_keywords;
        $blogObj->meta_description = $req->meta_description;
        $blogObj->head_content = $req->head_content;
        $this->applyScheduleAndStatus($blogObj, $req);
        $blogObj->save();

        try {
            Artisan::call('blogs:generate-featured-images', ['--slug' => $blogObj->slug]);
        } catch (\Throwable $e) {
            report($e);
        }

        $message = $blogObj->isScheduled()
            ? 'Blog saved and scheduled for ' . $blogObj->scheduled_at->format('d M Y h:i A') . '!'
            : 'Blog Added successfully !';

        return redirect('admin/blog/create')->with(['message' => $message, 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Blog::find($id);
        return view('admin/blog.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        if ($req->input('scheduled_at') === '') {
            $req->merge(['scheduled_at' => null]);
        }

        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'title' => 'required|unique:blogs,title,' . $id,
            'short_description' => 'required',
            // 'full_description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'scheduled_at' => 'nullable|date',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPEG, PNG, and JPG formats are allowed.',
            'image.max' => 'The image size must not exceed 6MB.',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $blogObj = Blog::findOrFail($id);
        if ($req->hasFile('image')) {
            $this->ensureBlogUploadDirs();

            if (!empty($blogObj->image)) {
                $image_path = public_path('uploads/blog/datels/' . $blogObj->image);
                if (File::exists($image_path)) {
                    @unlink($image_path);
                }

                $image_path = public_path('uploads/blog/list/' . $blogObj->image);
                if (File::exists($image_path)) {
                    @unlink($image_path);
                }

                $image_path = public_path('uploads/blog/thumb/' . $blogObj->image);
                if (File::exists($image_path)) {
                    @unlink($image_path);
                }
            }
            $image1 = $req->file('image');
            $image = $this->makeBlogImageName($image1);
            $image_resize = Image::make($image1->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 800) {
                $image_resize->resize(800, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/datels/' . $image));

            if ($width > 380) {
                $image_resize->resize(380, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/list/' . $image));

            if ($width > 90) {
                $image_resize->resize(90, 90, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/blog/thumb/' . $image));
            $blogObj->image = $image;
        }

        $blogObj->title =  $req->title;
        $blogObj->slug =  Str::slug($req->title);
        $blogObj->short_description =  $req->short_description;
        $blogObj->full_description =  $req->full_description;
        $blogObj->meta_title = $req->meta_title;
        $blogObj->meta_keywords = $req->meta_keywords;
        $blogObj->meta_description = $req->meta_description;
        $blogObj->head_content = $req->head_content;
        $this->applyScheduleAndStatus($blogObj, $req);
        $blogObj->save();

        try {
            Artisan::call('blogs:generate-featured-images', ['--slug' => $blogObj->slug]);
        } catch (\Throwable $e) {
            report($e);
        }

        $message = $blogObj->isScheduled()
            ? 'Blog updated and scheduled for ' . $blogObj->scheduled_at->format('d M Y h:i A') . '!'
            : 'Blog Updated successfully !';

        return redirect('admin/blog/create')->with(['message' => $message, 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $blogObj = Blog::find($id);

        if (!$blogObj) {
            return redirect('admin/blog/create')->with(['message' => 'Blog not found!', 'alert-type' => 'error']);
        }

        $imageName = $blogObj->image;
        $featuredStem = !empty($imageName)
            ? pathinfo($imageName, PATHINFO_FILENAME)
            : ($blogObj->slug ?: null);

        if (!empty($imageName)) {
            foreach (['datels', 'list', 'thumb'] as $folder) {
                $image_path = public_path('uploads/blog/' . $folder . '/' . $imageName);
                if (File::exists($image_path)) {
                    @unlink($image_path);
                }
            }
        }

        if (!empty($featuredStem)) {
            $featuredPath = public_path('uploads/blog/featured/' . $featuredStem . '.jpg');
            if (File::exists($featuredPath)) {
                @unlink($featuredPath);
            }
        }

        $blogObj->delete();

        return redirect('admin/blog/create')->with(['message' => 'Blog deleted successfully!', 'alert-type' => 'success']);
    }
}
