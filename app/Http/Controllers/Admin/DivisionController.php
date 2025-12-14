<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DivisionImport;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $divisions = Division::query()
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:divisions,name'
        ]);

        $division = Division::create(['name' => $request->name]);

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $division = Division::findOrFail($id);
        return view('admin.divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $division = Division::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:divisions,name,' . $division->id
        ]);

        $division->name = $request->name;
        $division->save();
        return redirect()->route('admin.divisions.index')->with('success', 'Division updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return redirect()->route('admin.divisions.index')->with('success', 'Division deleted successfully.');
    }

    // import divisions from excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);
        Excel::import(new DivisionImport, $request->file('file'));
        // Handle file upload and import logic here
        return redirect()->route('admin.divisions.index')->with('success', 'Divisions imported successfully.');
    }
}
