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

    public function updateProfile(Request $request, $id)
    {
        // 1. ─── Validation ──────────────────────────────────────────
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', "unique:admins,email,$id"],
            'phone'         => ['nullable', 'digits:10'],          // adjust to your format
            'password'      => ['nullable', 'string', 'min:8'],    // add 'confirmed' if using confirm field
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // 2. ─── Fetch the admin ────────────────────────────────────
        $account               = AdminUser::findOrFail($id);
        $account->name         = $validated['name'];
        $account->email        = $validated['email'];
        $account->mobile        = $validated['phone'] ?? $account->mobile;

        // 3. ─── Optional password update ───────────────────────────
        if (!empty($validated['password'])) {
            $account->password = Hash::make($validated['password']);
        }

        // 4. ─── Handle profile image upload (optional) ─────────────
        if ($request->hasFile('profile_picture')) {
            $file      = $request->file('profile_picture');
            $filename  = 'account_' . $account->id . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path      = $file->storeAs('profile_picture', $filename, 'public'); // storage/app/public/profile_images/...
            $account->profile_picture = $path;
        }

        // 5. ─── Save & redirect ────────────────────────────────────
        $account->save();
        return redirect()
            ->route('account.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
