<?php

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function showProfile()
    {
        $account = Auth::guard('account')->user();
        return view('account.profile.show', compact('account'));
    }

    // public function updateProfile(Request $request, $id)
    // {
    //     // 1. ─── Validation ──────────────────────────────────────────
    //     $validated = $request->validate([
    //         'name'          => ['required', 'string', 'max:255'],
    //         'email'         => ['required', 'string', 'email', 'max:255', "unique:admins,email,$id"],
    //         'phone'         => ['nullable', 'digits:10'],          // adjust to your format
    //         'address'       => ['nullable', 'string', 'max:255'],
    //         'password'      => ['nullable', 'string', 'min:8'],    // add 'confirmed' if using confirm field
    //         'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    //     ]);

    //     // 2. ─── Fetch the admin ────────────────────────────────────
    //     $admin               = Admin::findOrFail($id);
    //     $admin->name         = $validated['name'];
    //     $admin->email        = $validated['email'];
    //     $admin->phone        = $validated['phone'] ?? $admin->phone;
    //     $admin->address      = $validated['address'] ?? $admin->address;

    //     // 3. ─── Optional password update ───────────────────────────
    //     if (!empty($validated['password'])) {
    //         $admin->password = Hash::make($validated['password']);
    //     }

    //     // 4. ─── Handle profile image upload (optional) ─────────────
    //     if ($request->hasFile('profile_picture')) {
    //         $file      = $request->file('profile_picture');
    //         $filename  = 'admin_' . $admin->id . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
    //         $path      = $file->storeAs('profile_picture', $filename, 'public'); // storage/app/public/profile_images/...
    //         $admin->profile_picture = $path;
    //     }

    //     // 5. ─── Save & redirect ────────────────────────────────────
    //     $admin->save();

    //     return redirect()
    //         ->route('admin.profile')
    //         ->with('success', 'Profile updated successfully.');
    // }
}
