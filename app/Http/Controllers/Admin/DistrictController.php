<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DistrictImport;



class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $districts = District::with('division')
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('division', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.district.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.district.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => [
                'required',
                'string',
                'max:255',
                // Unique district NAME inside the same DIVISION
                function ($attribute, $value, $fail) use ($request) {
                    $exists = District::where('division_id', $request->division_id)
                        ->where('name', $value)
                        ->exists();

                    if ($exists) {
                        $fail("The district '{$value}' already exists in this division.");
                    }
                }
            ],
        ]);

        // Create District
        District::create([
            'division_id' => $request->division_id,
            'name'        => strtolower($request->name),
        ]);

        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
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
        $divisions = Division::orderBy('name')->get();
        $district = District::findOrFail($id);
        return view('admin.district.edit', compact('district', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fetch the model (404 if not found)
        $division = Division::findOrFail($id);

        // validate input: name required and unique among divisions except current one
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('divisions', 'name')->ignore($division->id),
            ],
        ]);

        // perform update
        $division->update([
            'name' => strtolower($request->input('name')),
        ]);

        // redirect with success message
        return redirect()
            ->route('admin.divisions.index')   // adjust route name if different
            ->with('success', 'Division updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        District::findOrFail($id)->delete();
        return redirect()
            ->route('admin.districts.index')
            ->with('success', 'District deleted successfully.');
    }

    public function getDistrictsByDivision($divisionId)
    {
        return District::where('division_id', $divisionId)
            ->orderBy('name')
            ->get();
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new \App\Imports\DistrictImport, $file);
            return redirect()->route('admin.districts.index')->with('success', 'Districts imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.districts.index')->with('error', 'Error importing districts: ' . $e->getMessage());
        }
    }
}
