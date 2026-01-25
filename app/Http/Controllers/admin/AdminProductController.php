<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Validator;
use Image;
use File;
use PDO;
use Str;

class AdminProductController extends Controller
{
    public function create()
    {
        $category = Category::where('status', 1)->latest()->get();
        return view('admin.product.creat', compact('category'));
    }

    public function list()
    {
        $productListing = Product::latest()->get();
        return view('admin.product.list', compact('productListing'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'product_name' => 'required|unique:products',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'short_description' => 'required',
            'features_advantages' => 'required',
            'technical_specifications' => 'required',
            // 'brochure' => 'required|mimes:pdf|max:8192', // Only PDF, Max 8MB
        ], [
            'brochure.required' => 'The brochure is required.',
            'brochure.mimes' => 'The brochure must be a PDF file.',
            'brochure.max' => 'The brochure must not be larger than 8MB.',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productObj = new Product();
        if ($req->hasFile('product_image')) {
            foreach ($req->file('product_image') as $image) {
                // Store each image
                $imageName = rand(111, 999) . time() . '_' . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $width = Image::make($image)->width();
                if ($width > 770) {
                    $image_resize->resize(770, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/large/' . $imageName));

                if ($width > 500) {
                    $image_resize->resize(500, 468, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/big/' . $imageName));

                if ($width > 380) {
                    $image_resize->resize(380, 355, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/list/' . $imageName));

                if ($width > 80) {

                    $image_resize->resize(80, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/thumb/' . $imageName));

                // Add image path to the array
                $productImage[] = $imageName;
            }
        }

        if ($req->hasFile('brochure')) {
            $file = $req->file('brochure');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products/brochure/'), $fileName);
            $productObj->brochure = $fileName;
        }
        $productObj->product_image = json_encode($productImage);
        $productObj->product_name = $req->product_name;
        $productObj->slug = Str::slug($req->product_name);
        $productObj->category_id = $req->category_id;
        $productObj->subcategory_id = $req->subcategory_id;
        $productObj->short_description = $req->short_description;
        $productObj->features_advantages = $req->features_advantages;
        $productObj->technical_specifications = $req->technical_specifications;
        $productObj->meta_title = $req->meta_title;
        $productObj->meta_keywords = $req->meta_keywords;
        $productObj->meta_description = $req->meta_description;
        $productObj->head_content = $req->head_content;
        $productObj->status = $req->status ?? 0;

        $productObj->save();
        return response()->json(['status' => 'true', 'message' => 'Product Added successfully !']);
    }

    public function edit($id)
    {
        $data = Product::find($id);
        $category = Category::where('status', 1)->latest()->get();
        return view('admin.product.update', compact('data', 'category'));
    }

    public function update(Request $req, $id)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'product_name' => 'required|unique:products,product_name,' . $id,
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'short_description' => 'required',
            'features_advantages' => 'required',
            'technical_specifications' => 'required',
            'brochure' => 'mimes:pdf|max:8192', // Only PDF, Max 8MB
        ], [
            'brochure.mimes' => 'The brochure must be a PDF file.',
            'brochure.max' => 'The brochure must not be larger than 8MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
            //     return back()->with('error',$validator->errors()->first())
            // ->withErrors($validator->errors())
            // ->withInput($req->all());
        }

        $productObj =  Product::findOrFail($id);

        $old_product_images = !empty($productObj->product_image) ?  json_decode($productObj->product_image) : [];

        $productImages = []; // Initialize an array to store image paths
        // update
        if ($req->hasFile('product_image_new')) {
            foreach ($req->file('product_image_new') as $image) {
                // Store each image
                $imageName = rand(111, 999) . time() . '_' . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $width = Image::make($image)->width();
                if ($width > 770) {
                    $image_resize->resize(770, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/large/' . $imageName));

                if ($width > 500) {
                    $image_resize->resize(500, 468, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/big/' . $imageName));

                if ($width > 380) {
                    $image_resize->resize(380, 355, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/list/' . $imageName));

                if ($width > 80) {

                    $image_resize->resize(80, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $image_resize->save(public_path('uploads/products/thumb/' . $imageName));




                // Add image path to the array
                $productImages[] = $imageName;
            }
        }
        $total_product_images = array_merge($old_product_images, $productImages);
        if ($req->hasFile('replace_first_image')) {
            // Delete the old first image file
            if (!empty($total_product_images) && count($total_product_images) > 0) {
                $oldFirstImage = $total_product_images[0];
                $oldFirstImagePath = public_path('uploads/products/large/' . $oldFirstImage);
                if (file_exists($oldFirstImagePath)) {
                    unlink($oldFirstImagePath);
                }
                $oldFirstImagePath = public_path('uploads/products/big/' . $oldFirstImage);
                if (file_exists($oldFirstImagePath)) {
                    unlink($oldFirstImagePath);
                }
                $oldFirstImagePath = public_path('uploads/products/list/' . $oldFirstImage);
                if (file_exists($oldFirstImagePath)) {
                    unlink($oldFirstImagePath);
                }

                $oldFirstImagePath = public_path('uploads/products/thumb/' . $oldFirstImage);
                if (file_exists($oldFirstImagePath)) {
                    unlink($oldFirstImagePath);
                }
                // Remove the old first image from the array
                array_shift($total_product_images); // Removes the first image from the array
            }

            // Upload the new first image
            $newImage = $req->file('replace_first_image');
            $imageName = rand(111, 999) . time() . '_' . $newImage->getClientOriginalName();
            $image_resize = Image::make($newImage->getRealPath());
            $width = $image_resize->getWidth();
            // dd($width);
            // Resize and save images
            if ($width > 770) {
                $image_resize->resize(770, 720, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/products/large/' . $imageName));

            if ($width > 500) {
                $image_resize->resize(500, 468, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/products/big/' . $imageName));

            if ($width > 380) {
                $image_resize->resize(380, 355, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/products/list/' . $imageName));

            if ($width > 80) {

                $image_resize->resize(80, 75, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save(public_path('uploads/products/thumb/' . $imageName));

            // Add the new image to the array
            array_unshift($total_product_images, $imageName); // Adds the new image at the beginning of the array
        }

        if ($req->hasFile('brochure')) {
            if (!empty($productObj->brochure)) {
                $oldFilePath = public_path('uploads/products/brochure/' . $productObj->brochure);
                
                // Delete old brochure if it exists
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file = $req->file('brochure');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products/brochure/'), $fileName);
            $productObj->brochure = $fileName;
        }
        $productObj->product_image = json_encode($total_product_images);
        $productObj->product_name = $req->product_name;
        $productObj->slug = Str::slug($req->product_name);
        $productObj->category_id = $req->category_id;
        $productObj->subcategory_id = $req->subcategory_id;
        $productObj->short_description = $req->short_description;
        $productObj->features_advantages = $req->features_advantages;
        $productObj->technical_specifications = $req->technical_specifications;
        $productObj->meta_title = $req->meta_title;
        $productObj->meta_keywords = $req->meta_keywords;
        $productObj->meta_description = $req->meta_description;
        $productObj->head_content = $req->head_content;
        $productObj->status = $req->status ?? 0;

        $productObj->save();


        return response()->json(['status' => 'true', 'message' => 'Product Updated successfully !']);

        //  return redirect('admin/product/list')->with(['message' => 'Product Updated successfully !','alert-type'=>'success']);
    }


    public function deleteProductImage(Request $req)
    {
        $key = $req->key;
        $product = Product::findOrFail($req->product_id);
        $productImages = json_decode($product->product_image, true);

        // Check if the key exists in the array
        if (array_key_exists($key, $productImages)) {
            // Remove the image file
            $imagePath = public_path('uploads/products/large/' . $productImages[$key]);
            if (\File::exists($imagePath)) {
                \File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/big/' . $productImages[$key]);
            if (\File::exists($imagePath)) {
                \File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/list/' . $productImages[$key]);
            if (\File::exists($imagePath)) {
                \File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/thumb/' . $productImages[$key]);
            if (\File::exists($imagePath)) {
                \File::delete($imagePath);
            }

            // Remove the key from the array
            unset($productImages[$key]);
            $productsImages = array_values($productImages);

            // Encode the array back to JSON
            $product->product_image = json_encode($productsImages);
            $product->save();
            return 'success';
        } else {
            return 'Image key does not exist';
        }
    }


    public function loadSubcategory(Request $req)
    {
        // dd($req->all());
        $sel = $req->subcategory_id;
        $catId = $req->catId;
        $subcategoryDropdown  = '';
        $subcategorylist = SubCategory::where('category_id', $catId)->where('status', 1)->get();

        // dd($subcategorylist);
        if (count($subcategorylist) > 0) {
            $subcategoryDropdown  .= '<select class="form-control" name="subcategory_id" onchange="LoadChildcategory(' . $catId . ', this.value)" required>';
            $subcategoryDropdown  .= '<option value="">--Select--</option>';
            for ($i = 0; $i < count($subcategorylist); $i++) {
                if (isset($sel) && $sel == $subcategorylist[$i]->id) $selected = 'selected="selected"';
                else $selected = "";
                $subcategoryDropdown  .= '<option value="' . $subcategorylist[$i]->id . '" ' . $selected . '>' . $subcategorylist[$i]->name . '</option>';
            }
            $subcategoryDropdown  .= '</select>';
        } else {
            $subcategoryDropdown  .= '<select class="form-control" name="subcategory_id" required>';
            $subcategoryDropdown  .= '<option value="">No Record Found</option>';
            $subcategoryDropdown  .= '</select>';
        }


        return response()->json([
            'subcategoryDropdown' => $subcategoryDropdown,
        ]);
    }


    public function delete($id)
    {


        $productObj =  Product::findOrFail($id);
        $productImages = json_decode($productObj->product_image, true);
        foreach ($productImages as $image) {
            // Delete each image file
            $imagePath = public_path('uploads/products/large/' . $image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/big/' . $image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/list/' . $image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $imagePath = public_path('uploads/products/thumb/' . $image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $productObj->delete();

        return redirect('admin/product/list')->with(['message' => 'Product deleted successfully !', 'alert-type' => 'success']);
    }



    public function showinhome(Request $req)
    {
        $productID = $req->id;
        $projectObj = Product::find($productID);
        $projectObj->show_in_home = $req->show_in_home;
        $res = $projectObj->save();
        if ($res) {
            return 'success';
        }
    }
}
