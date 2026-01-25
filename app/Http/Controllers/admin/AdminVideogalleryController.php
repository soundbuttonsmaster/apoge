<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Validator;

class AdminVideogalleryController extends Controller
{
    public function create()
    {
        $videoGalleryList = VideoGallery::orderBy('id', 'DESC')->get();
        return view('admin.video-gallery.index', compact('videoGalleryList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $videoGalleryObj = new VideoGallery();
        $videoGalleryObj->url =  $req->url;
        $videoGalleryObj->status =  $req->status ?? 0;
        $videoGalleryObj->save();

        return redirect('admin/video-gallery/create')->with(['message' => 'Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = VideoGallery::find($id);
        return view('admin/video-gallery.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $videoGalleryObj = VideoGallery::find($id);
        $videoGalleryObj->url =  $req->url;
        $videoGalleryObj->status =  $req->status ?? 0;
        $videoGalleryObj->save();
        return redirect('admin/video-gallery/create')->with(['message' => 'Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        // $check = Subcategory::where('category_id', $id)->count();
        // if ($check > 0) {
        //     return redirect()->back()->with(['message' => 'Category has subcategory !', 'alert-type' => 'error']);
        // }
        VideoGallery::whereId($id)->delete();
        return redirect('admin/video-gallery/create')->with(['message' => 'deleted successfully !', 'alert-type' => 'success']);
    }
}
