<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
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

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'title' => 'required|unique:blogs',
            'short_description' => 'required',
            // 'full_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:6144', // 8MB limit
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
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
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
        $blogObj->status =  $req->status ?? 0;
        $blogObj->save();

        return redirect('admin/blog/create')->with(['message' => 'Blog Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Blog::find($id);
        return view('admin/blog.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'title' => 'required|unique:blogs,title,' . $id,
            'short_description' => 'required',
            // 'full_description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:6144', // 8MB limit
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
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
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
        $blogObj->status =  $req->status ?? 0;
        $blogObj->save();
        return redirect('admin/blog/create')->with(['message' => 'Blog Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $blogObj = Blog::find($id);

        if (!$blogObj) {
            return redirect()->back()->with(['message' => 'Blog not found!', 'alert-type' => 'error']);
        }

        // Delete large image
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

        // Delete gallery record from database
        $blogObj->delete();

        return redirect()->back()->with(['message' => 'Gallery deleted successfully!', 'alert-type' => 'success']);
    }
}
