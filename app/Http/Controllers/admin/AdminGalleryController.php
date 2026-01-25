<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Session;
use Illuminate\Http\Request;
use Validator;
use Image;
use File;

class AdminGalleryController extends Controller
{
    public function create()
    {
        $galleryList = Gallery::orderBy('id', 'DESC')->get();
        $session = Session::where('status', 1)->latest()->get();
        return view('admin.gallery.index', compact('session', 'galleryList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'session_id' => 'required',
            'group_id' => 'required',
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

        $galleryObj = new Gallery();

        if ($req->hasFile('image')) {
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 800) {
                $image_resize->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/gallery/large/' . $image));

            if ($width > 268) {
                $image_resize->resize(268, 268, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/gallery/small/' . $image));
            $galleryObj->image = $image;
        }

        $galleryObj->session_id =  $req->session_id;
        $galleryObj->group_id =  $req->group_id;
        $galleryObj->status =  $req->status ?? 0;
        $galleryObj->save();

        return redirect('admin/gallery/create')->with(['message' => 'gallery Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Gallery::find($id);
        $session = Session::where('status', 1)->latest()->get();
        return view('admin/gallery.update', compact('data', 'session'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'session_id' => 'required',
            'group_id' => 'required',
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

        $galleryObj = Gallery::findOrFail($id);
        if ($req->hasFile('image')) {

            $image_path = public_path('uploads/gallery/large/' . $galleryObj->image);
            if (File::exists($image_path)) {
                @unlink($image_path);
            }

            $image_path = public_path('uploads/gallery/small/' . $galleryObj->image);
            if (File::exists($image_path)) {
                @unlink($image_path);
            }
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 800) {
                $image_resize->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/gallery/large/' . $image));

            if ($width > 268) {
                $image_resize->resize(268, 268, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/gallery/small/' . $image));
            $galleryObj->image = $image;
        }

        $galleryObj->session_id =  $req->session_id;
        $galleryObj->group_id =  $req->group_id;
        $galleryObj->status =  $req->status ?? 0;
        $galleryObj->save();
        return redirect('admin/gallery/create')->with(['message' => 'gallery Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with(['message' => 'Gallery not found!', 'alert-type' => 'error']);
        }

        // Delete large image
        $largeImagePath = public_path('uploads/gallery/large/' . $gallery->image);
        if (File::exists($largeImagePath)) {
            File::delete($largeImagePath);
        }

        // Delete small image
        $smallImagePath = public_path('uploads/gallery/small/' . $gallery->image);
        if (File::exists($smallImagePath)) {
            File::delete($smallImagePath);
        }

        // Delete gallery record from database
        $gallery->delete();

        return redirect()->back()->with(['message' => 'Gallery deleted successfully!', 'alert-type' => 'success']);
    }







    public function loadgroup(Request $req)
    {
        // dd($req->all());
        $sel = $req->groupId;
        // $themesel = $req->themecategoryid;
        $sessionId = $req->sessionId;
        $groupDropdown  = '';
        $grouplist = Group::where('session_id', $sessionId)->where('status', 1)->get();
        // dd($grouplist);

        // dd($grouplist);
        if (count($grouplist) > 0) {
            $groupDropdown  .= '<select class="form-control" name="group_id" required>';
            $groupDropdown  .= '<option value="">--Select--</option>';
            for ($i = 0; $i < count($grouplist); $i++) {
                if (isset($sel) && $sel == $grouplist[$i]->id) $selected = 'selected="selected"';
                else $selected = "";
                $groupDropdown  .= '<option value="' . $grouplist[$i]->id . '" ' . $selected . '>' . $grouplist[$i]->group . '</option>';
            }
            $groupDropdown  .= '</select>';
        } else {
            $groupDropdown  .= '<select class="form-control" name="group_id" required>';
            $groupDropdown  .= '<option value="">No Record Found</option>';
            $groupDropdown  .= '</select>';
        }


        return response()->json([
            'groupDropdown' => $groupDropdown,
        ]);
    }
}
