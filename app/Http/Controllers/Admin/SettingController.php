<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view settings')->only('index');
    //     $this->middleware('permission:edit settings')->only('update');
    // }

    public function index()
    {
        $settings = AdminSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $allSettings = AdminSetting::pluck('key')->toArray();
        // dd($allSettings);

        // === Handle Logo ===
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $oldLogo = AdminSetting::where('key', 'logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Upload new logo
            $logoPath = $request->file('logo')->store('uploads/settings', 'public');
            AdminSetting::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
        }

        // === Handle Favicon ===
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            $oldFavicon = AdminSetting::where('key', 'favicon')->value('value');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            // Upload new favicon
            $faviconPath = $request->file('favicon')->store('uploads/settings', 'public');
            AdminSetting::updateOrCreate(['key' => 'favicon'], ['value' => $faviconPath]);
        }

        // === Update Text/Option Settings ===
        foreach ($request->except(['_token', 'logo', 'favicon']) as $key => $value) {
            if (in_array($key, $allSettings)) {
                AdminSetting::where('key', $key)->update(['value' => $value]);
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
