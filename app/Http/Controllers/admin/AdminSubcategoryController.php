<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Validator;
use Str;

class AdminSubcategoryController extends Controller
{
    public function create()
    {
        $subcategoryList = SubCategory::orderBy('id', 'DESC')->get();
        $category = Category::where('status', 1)->latest()->get();
        return view('admin.sub-category.index', compact('category', 'subcategoryList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:sub_categories',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $SubcategoryObj = new SubCategory();
        $SubcategoryObj->name =  $req->name;
        $SubcategoryObj->slug =  Str::slug($req->name);
        $SubcategoryObj->category_id = $req->category_id;
        $SubcategoryObj->meta_title = $req->meta_title;
        $SubcategoryObj->meta_keywords = $req->meta_keywords;
        $SubcategoryObj->meta_description = $req->meta_description;
        $SubcategoryObj->head_content = $req->head_content;
        $SubcategoryObj->status =  $req->status ?? 0;

        $SubcategoryObj->save();

        return redirect('admin/sub-category/create')->with(['message' => 'Sub-Category Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = SubCategory::find($id);
        $category = Category::where('status', 1)->latest()->get();
        return view('admin/sub-category.update', compact('data', 'category'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:sub_categories,name,' . $id,
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $SubcategoryObj = SubCategory::findOrFail($id);
        $SubcategoryObj->name =  $req->name;
        $SubcategoryObj->slug =  Str::slug($req->name);
        $SubcategoryObj->category_id = $req->category_id;
        $SubcategoryObj->meta_title = $req->meta_title;
        $SubcategoryObj->meta_keywords = $req->meta_keywords;
        $SubcategoryObj->meta_description = $req->meta_description;
        $SubcategoryObj->head_content = $req->head_content;
        $SubcategoryObj->status =  $req->status ?? 0;

        $SubcategoryObj->save();
        return redirect('admin/sub-category/create')->with(['message' => 'Sub-Category Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $check = Product::where('subcategory_id', $id)->count();
        if ($check > 0) {
            return redirect()->back()->with(['message' => 'Sub-Category has Product !', 'alert-type' => 'error']);
        }
        SubCategory::whereId($id)->delete();
        return redirect('admin/sub-category/create')->with(['message' => 'Sub-Category deleted successfully !', 'alert-type' => 'success']);
    }
}
