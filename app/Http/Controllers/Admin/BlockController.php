<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BlockImport;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $blocks = Block::with('district')
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('district', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            // ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Load all divisions with their districts (needed for dropdowns)
        $divisions = Division::with('districts')->orderBy('name')->get();

        return view('admin.block.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',

            'name' => [
                'required',
                'string',
                'max:255',
                // Unique block name inside the same district
                function ($attribute, $value, $fail) use ($request) {
                    $exists = Block::where('district_id', $request->district_id)
                        ->where('name', $value)
                        ->exists();

                    if ($exists) {
                        $fail("The block '{$value}' already exists in this district.");
                    }
                }
            ],
        ]);

        // Store in DB
        Block::create([
            'district_id' => $request->district_id,
            'name'        => strtolower($request->name),
        ]);

        return redirect()
            ->route('admin.blocks.index')
            ->with('success', 'Block created successfully.');
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
        // Fetch block or show 404
        $block = Block::findOrFail($id);

        // Load divisions with their districts for dropdown
        $divisions = Division::with('districts')->orderBy('name')->get();

        return view('admin.block.edit', compact('block', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fetch block
        $block = Block::findOrFail($id);

        // validate
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'name'        => ['required', 'string', 'max:255'],
        ]);

        // extra: ensure district belongs to division
        $districtOk = District::where('id', $request->district_id)
            ->where('division_id', $request->division_id)
            ->exists();

        if (! $districtOk) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['district_id' => 'Selected district does not belong to the selected division.']);
        }

        // unique name within same district (exclude current block)
        $exists = Block::where('district_id', $request->district_id)
            ->where('name', $request->name)
            ->where('id', '!=', $block->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => "The block '{$request->name}' already exists in the selected district."]);
        }

        // update
        $block->update([
            'district_id' => $request->district_id,
            'name'        => strtolower($request->name),
        ]);

        return redirect()
            ->route('admin.blocks.index')
            ->with('success', 'Block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $block = Block::findOrFail($id);
        // If you want to prevent delete when block contains dependent data,
        $block->delete();

        return redirect()
            ->route('admin.blocks.index')
            ->with('success', 'Block deleted successfully.');
    }

    public function getBlocksByDistrict($districtId)
    {
        return Block::where('district_id', $districtId)
            ->orderBy('name')
            ->get()
            ->map(function ($block) {
                $block->name = ucwords(strtolower($block->name));
                return $block;
            });
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new \App\Imports\BlockImport, $file);
            return redirect()->route('admin.blocks.index')->with('success', 'Blocks imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.blocks.index')->with('error', 'Error importing blocks: ' . $e->getMessage());
        }
    }
}
