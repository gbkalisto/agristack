<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Division;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $accounts = AdminUser::with(['division', 'district', 'block'])
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where('id', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('user_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")

                        ->orWhereHas('division', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('district', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('block', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->appends(['search' => $search]);

        return view('admin.account.index', compact('accounts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.account.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'        => 'required|string|max:255',
            'user_name'   => 'required|string|unique:admin_users,user_name',
            'email'       => 'required|email|unique:admin_users,email',
            'mobile'      => 'required|string|unique:admin_users,mobile',
            'password'    => 'required|min:6',
            'role'        => 'required|in:admin,division_admin,district_admin,block_admin',

            // conditional location validation
            'division_id' => 'nullable|exists:divisions,id',
            'district_id' => 'nullable|exists:districts,id',
            'block_id'    => 'nullable|exists:blocks,id',
        ]);

        // Extra validation based on role
        if ($request->role === 'division_admin' && !$request->division_id) {
            return back()->withErrors(['division_id' => 'Division is required for Division Admin'])->withInput();
        }

        if ($request->role === 'district_admin' && !$request->district_id) {
            return back()->withErrors(['district_id' => 'District is required for District Admin'])->withInput();
        }

        if ($request->role === 'block_admin' && !$request->block_id) {
            return back()->withErrors(['block_id' => 'Block is required for Block Admin'])->withInput();
        }

        // Create account
        AdminUser::create([
            'name'        => $request->name,
            'user_name'   => $request->user_name,
            'email'       => $request->email,
            'mobile'      => $request->mobile,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'block_id'    => $request->block_id,
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Admin Account created successfully.');
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
        $account   = AdminUser::findOrFail($id);
        $divisions = Division::orderBy('name')->get();

        return view('admin.account.edit', compact('account', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = AdminUser::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'user_name' => 'required|unique:admin_users,user_name,' . $account->id,
            'email'    => 'required|email|unique:admin_users,email,' . $account->id,
            'mobile'   => 'required|string|unique:admin_users,mobile,' . $account->id,
            'role'     => 'required|in:admin,division_admin,district_admin,block_admin',
            'password' => 'nullable|min:6',

            'division_id' => 'nullable|exists:divisions,id',
            'district_id' => 'nullable|exists:districts,id',
            'block_id'    => 'nullable|exists:blocks,id',
        ]);

        $account->update([
            'name'        => $request->name,
            'user_name'   => $request->user_name,
            'email'       => $request->email,
            'mobile'      => $request->mobile,
            'role'        => $request->role,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'block_id'    => $request->block_id,
            'password'    => $request->password ? Hash::make($request->password) : $account->password,
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Admin Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = AdminUser::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Admin Account deleted successfully.');
    }
}
