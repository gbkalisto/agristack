<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:view admins')->only('index');
    //     $this->middleware('permission:create admins')->only(['create', 'store']);
    //     $this->middleware('permission:edit admins')->only(['edit', 'update']);
    //     $this->middleware('permission:delete admins')->only('destroy');
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $admins = Admin::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.users.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get(); // Make sure guard is admin
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes|boolean',
            'roles' => 'required',
            // 'roles' => 'required|array',
            // 'roles.*' => 'exists:roles,name',
        ]);

        // dd($request->all());

        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle profile picture upload if exists
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile_picture', $fileName, 'public');
            $validatedData['profile_picture'] = 'profile_picture/' . $fileName;
        }

        // Set default value if is_active is not provided
        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;

        // Create the admin user
        $admin = Admin::create($validatedData);
        $admin->syncRoles($request->roles);
        return redirect()->route('admin.admins.index')->with('success', 'Admin user created successfully.');
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all(); // Fetch all roles to show in checkbox
        return view('admin.users.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|min:8',
            'profile_picture' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'

        ]);

        $admin->fill($request->only(['name', 'email', 'phone', 'address']));
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        if ($request->hasFile('profile_picture')) {
            if ($admin->profile_picture && Storage::disk('public')->exists($admin->profile_picture)) {
                Storage::disk('public')->delete($admin->profile_picture);
            }
            $filename = time() . '.' . $request->profile_picture->extension();
            $admin->profile_picture = $request->file('profile_picture')->storeAs('admins', $filename, 'public');
        }

        $admin->is_active = $request->has('is_active') ? 1 : 0;
        $admin->save();
        // Sync roles
        $admin->syncRoles($request->roles);
        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        // remove the profile picture if it exists
        if ($admin->profile_picture) {
            $profilePicturePath = public_path('storage/' . $admin->profile_picture);
            if (file_exists($profilePicturePath)) {
                unlink($profilePicturePath);
            }
        }
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin user deleted successfully.');
    }
}
