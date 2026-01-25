<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Validator;
use Image;
use File;

class AdminTestimoialController extends Controller
{
    public function create()
    {
        $testimonialList = Testimonial::orderBy('id', 'DESC')->get();
        return view('admin.testimonial.index', compact('testimonialList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'testimonial_name' => 'required',
            'city' => 'required',
            'rating' => 'required',
            'content' => 'required',
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

        $testimonialObj = new Testimonial();

        if ($req->hasFile('image')) {
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 140) {
                $image_resize->resize(140, 140, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/testimonial/' . $image));
            $testimonialObj->image = $image;
        }

        $testimonialObj->testimonial_name =  $req->testimonial_name;
        $testimonialObj->city =  $req->city;
        $testimonialObj->rating =  $req->rating;
        $testimonialObj->content =  $req->content;
        $testimonialObj->status =  $req->status ?? 0;
        $testimonialObj->save();

        return redirect('admin/testimonial/create')->with(['message' => 'Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Testimonial::find($id);
        return view('admin/testimonial.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'testimonial_name' => 'required',
            'city' => 'required',
            'rating' => 'required',
            'content' => 'required',
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

        $testimonialObj = Testimonial::findOrFail($id);
        if ($req->hasFile('image')) {

            $image_path = public_path('uploads/testimonial/' . $testimonialObj->image);
            if (File::exists($image_path)) {
                @unlink($image_path);
            }
            $image1 = $req->file('image');
            $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
            $image_resize = Image::make($req->file('image')->getRealPath());
            $width = Image::make($image1)->width();
            if ($width > 140) {
                $image_resize->resize(140, 140, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/testimonial/' . $image));
            $testimonialObj->image = $image;
        }

        $testimonialObj->testimonial_name =  $req->testimonial_name;
        $testimonialObj->city =  $req->city;
        $testimonialObj->rating =  $req->rating;
        $testimonialObj->content =  $req->content;
        $testimonialObj->status =  $req->status ?? 0;
        $testimonialObj->save();
        return redirect('admin/testimonial/create')->with(['message' => 'Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $testimonialObj = Testimonial::find($id);

        if (!$testimonialObj) {
            return redirect()->back()->with(['message' => 'Testimonials not found!', 'alert-type' => 'error']);
        }

        // Delete large image
        $image_path = public_path('uploads/testimonial/' . $testimonialObj->image);
        if (File::exists($image_path)) {
            @unlink($image_path);
        }

        // Delete gallery record from database
        $testimonialObj->delete();

        return redirect()->back()->with(['message' => 'deleted successfully!', 'alert-type' => 'success']);
    }
}
