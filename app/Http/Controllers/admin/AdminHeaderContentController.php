<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderContent;
use Illuminate\Http\Request;

class AdminHeaderContentController extends Controller
{
    public function create()
    {
        $headerContentList = HeaderContent::latest()->get();
        return view('admin.header-content.index', compact('headerContentList'));
    }

    public function get(Request $request)
    {
        $data = HeaderContent::where('page_name', $request->page_name)->first();
        
        if ($data) {
            return response()->json(['status' => true, 'data' => $data]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
        ]);

        $headerContent = HeaderContent::updateOrCreate(
            ['page_name' => $request->page_name],
            [
                // 'url' => $request->url,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'head_content' => $request->head_content,
                'status' => $request->status ? 1 : 0
            ]
        );

        return redirect()->back()->with(['status' => true, 'message' => 'Header Content saved successfully!', 'alert-type' => 'success']);
    }


    public function delete($id){
        $headerContentObj = HeaderContent::find($id);
        $headerContentObj->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Header Content Deleted successfully!', 'alert-type' => 'success']);
    }
}
