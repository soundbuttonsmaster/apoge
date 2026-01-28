<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Area;

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
        ]);

        $area = new Area();
        $area->name = $request->name;
        $area->status = $request->status ? 1 : 0;
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
        ]);

        $area = Area::findOrFail($id);
        $area->name = $request->name;
        $area->status = $request->status ? 1 : 0;
        $area->save();

        return redirect()->route('admin.area.index')->with(['status' => true, 'message' => 'Area updated successfully!', 'alert-type' => 'success']);
    }

    public function delete($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Area deleted successfully!', 'alert-type' => 'success']);
    }
}
