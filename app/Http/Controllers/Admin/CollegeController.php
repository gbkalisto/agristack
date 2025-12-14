<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class CollegeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view colleges')->only('index');
        $this->middleware('permission:create colleges')->only(['create', 'store']);
        $this->middleware('permission:edit colleges')->only(['edit', 'update']);
        $this->middleware('permission:delete colleges')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $colleges = Tenant::with('domains')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('domains', function ($q) use ($search) {
                        $q->where('domain', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);
        return view('admin.colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $college =  Tenant::create($validator);
        $college->domains()->create([
            'domain' => $validator['domain_name'] . '.' . config('app.domain')
        ]);
        return redirect()->route('admin.colleges.index');
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
        $college = Tenant::with('domains')->findOrFail($id);
        return view('admin.colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $college = Tenant::with('domains')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'domains' => 'required|array|min:1',
            'domains.*.domain' => [
                'required',
                'string',
                'max:255',
                Rule::unique('domains', 'domain')
                    ->ignore($college->domains->pluck('domain')->toArray()),
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $college->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $college->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Delete old and insert new domains (simple way)
        $college->domains()->delete();

        foreach ($request->domains as $domainData) {
            $college->domains()->create([
                'domain' => $domainData['domain'] . '.' . config('app.domain'),
            ]);
        }

        return redirect()->route('admin.colleges.index')->with('success', 'College updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
