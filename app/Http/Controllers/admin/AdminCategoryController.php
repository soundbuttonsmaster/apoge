<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use File;
use Str;
use Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class AdminCategoryController extends Controller
{
    public function create()
    {
        $categoryList = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categoryList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:categories',
            //     'image' => 'required|image|mimes:jpeg,png,jpg|max:6144', // 8MB limit
            // ], [
            //     'image.image' => 'The file must be an image.',
            //     'image.mimes' => 'Only JPEG, PNG, and JPG formats are allowed.',
            //     'image.max' => 'The image size must not exceed 6MB.',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $categoryObj = new Category();

        // if ($req->hasFile('image')) {
        //     $image1 = $req->file('image');
        //     $image = rand(111, 999) . time() . '_' . $req->file('image')->getClientOriginalName();
        //     $image_resize = Image::make($req->file('image')->getRealPath());
        //     $width = Image::make($image1)->width();
        //     if ($width > 500) {
        //         $image_resize->resize(500, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });
        //     }
        //     $image_resize->save(public_path('uploads/category_images/' . $image));
        //     $categoryObj->image = $image;
        // }

         $categoryObj->name =  $req->name;
        $categoryObj->slug =  Str::slug($req->name);
        $categoryObj->meta_title =  $req->meta_title;
        $categoryObj->meta_keywords =  $req->meta_keywords;
        $categoryObj->meta_description =  $req->meta_description;
        $categoryObj->head_content =  $req->head_content;
        $categoryObj->status =  $req->status ?? 0;

        $categoryObj->save();

        return redirect('admin/category/create')->with(['message' => 'Category Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin/category.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:categories,name,' . $id,
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $categoryObj = Category::findOrFail($id);


        $categoryObj = Category::findOrFail($id);
        $categoryObj->name =  $req->name;
        $categoryObj->slug =  Str::slug($req->name);
        $categoryObj->meta_title =  $req->meta_title;
        $categoryObj->meta_keywords =  $req->meta_keywords;
        $categoryObj->meta_description =  $req->meta_description;
        $categoryObj->head_content =  $req->head_content;
        $categoryObj->status =  $req->status;
        $categoryObj->save();
        return redirect('admin/category/create')->with(['message' => 'Category Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $check = SubCategory::where('category_id', $id)->count();
        if ($check > 0) {
            return redirect()->back()->with(['message' => 'Category has subcategory !', 'alert-type' => 'error']);
        }
        $checkProduct = Product::where('category_id', $id)->count();
        if ($checkProduct > 0) {
            return redirect()->back()->with(['message' => 'Category has Product !', 'alert-type' => 'error']);
        }
        Category::whereId($id)->delete();
        return redirect('admin/category/create')->with(['message' => 'Category deleted successfully !', 'alert-type' => 'success']);
    }
}
