<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Area;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminAreaController extends Controller
{

    public function index()
    {
        $areas = Area::latest()->get();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:areas,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $area = new Area();
        $area->name = $request->name;
        $area->slug = Str::slug($request->name);
        $area->short_description = $request->short_description;
        $area->full_description = $request->full_description;
        $area->meta_title = $request->meta_title;
        $area->meta_keywords = $request->meta_keywords;
        $area->meta_description = $request->meta_description;
        $area->status = $request->status ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/areas');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $imageName);
            $area->image = $imageName;
        }

        $area->save();

        return redirect()->route('admin.area.index')->with(['status' => true, 'message' => 'Area created successfully!', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.area.create', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:areas,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $area = Area::findOrFail($id);
        $area->name = $request->name;
        $area->slug = Str::slug($request->name);
        $area->short_description = $request->short_description;
        $area->full_description = $request->full_description;
        $area->meta_title = $request->meta_title;
        $area->meta_keywords = $request->meta_keywords;
        $area->meta_description = $request->meta_description;
        $area->status = $request->status ? 1 : 0;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($area->image && File::exists(public_path('uploads/areas/' . $area->image))) {
                File::delete(public_path('uploads/areas/' . $area->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/areas');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $imageName);
            $area->image = $imageName;
        }

        $area->save();

        return redirect()->route('admin.area.index')->with(['status' => true, 'message' => 'Area updated successfully!', 'alert-type' => 'success']);
    }

    public function delete($id)
    {
        $area = Area::findOrFail($id);
        if ($area->image && File::exists(public_path('uploads/areas/' . $area->image))) {
            File::delete(public_path('uploads/areas/' . $area->image));
        }
        $area->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Area deleted successfully!', 'alert-type' => 'success']);
    }
}
