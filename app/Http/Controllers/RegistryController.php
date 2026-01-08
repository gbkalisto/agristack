<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RegistryStepService;
use App\Models\FarmerBankDetail;
use App\Models\FarmerCropDetail;
use App\Models\FarmerLandDetail;
use App\Models\FarmerResidentialDetail;
use App\Models\District;
use App\Models\Division;
use App\Models\User;
use App\Models\FarmerDocument;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ResidentialRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class RegistryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // FORCE EDIT STEP (HIGHEST PRIORITY)
        $editStep = request()->query('edit_step');

        if ($editStep !== null) {
            $editStep = (int) $editStep;

            if ($editStep >= 1 && $editStep <= 6) {
                return redirect()->to("/registry/step/{$editStep}");
            }
        }

        // Get current step
        $step = RegistryStepService::currentStep();

        // Registration completed
        if ($step === null) {
            return view('registry.index', [
                'user' => $user,
                'completed' => true,
                'message' => 'Your registration is complete. You can review or edit your details.',
            ]);
        }

        // Normal flow
        return redirect()->to("/registry/step/{$step}");
    }



    public function step($step)
    {
        $step = (int) $step;

        $currentStep = RegistryStepService::currentStep();

        // Detect edit mode (query param OR completed profile)
        $isEditMode = request()->query('edit_step') !== null || $currentStep === null;



        // Normal flow: prevent skipping steps
        if (!$isEditMode && $currentStep !== null && $step > $currentStep) {
            return redirect("/registry/step/{$currentStep}");
        }

        // Safety: step range
        if ($step < 1 || $step > 6) {
            abort(404);
        }


        $user = auth()->user()->load([
            'district',
            'landDetail',
            'cropDetail',
            'bankDetail',
            'documents',
            'residentialDetail',
            'residentialDetail.division',
            'residentialDetail.district',
            'residentialDetail.block',
        ]);

        $districts = District::where('status', 1)->get();
        $divisions = Division::where('status', 1)->get();

        return view("registry.steps.step-{$step}", compact(
            'user',
            'districts',
            'divisions'
        ));
    }



    public function basicDetail(Request $request)
    {
        $user = auth()->user();


        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'father_name' => 'nullable|string|max:255',

            'phone' => [
                'required',
                'digits:10',
                Rule::unique('users', 'phone')->ignore($user->id),
            ],

            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'aadhaar' => [
                'nullable',
                'digits:12',
                Rule::unique('users', 'aadhaar')->ignore($user->id),
            ],

            'dob' => 'nullable|date',

            'gender' => 'nullable|in:male,female,other',

            'category' => 'nullable',

            'address' => 'nullable|string|max:500',

            'district_id' => 'required|exists:districts,id',
        ]);


        $user->update($validated);


        return redirect('/registry/step/2')
            ->with('success', 'Basic details saved successfully.');
    }




    public function residentialDetail(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'division_id'      => 'required',
            'district_id'  => 'required',
            'block_id'       => 'required',
            'village'       => 'required|string',
            'pincode'       => 'nullable|digits:6',
        ]);

        FarmerResidentialDetail::updateOrCreate(
            ['user_id' => $userId],
            [
                'residential_type' => $request->residential_type,
                'address_english'  => $request->address_english,
                'address_local'    => $request->address_local,
                'division_id'         => $request->division_id,
                'district_id'         => $request->district_id,
                'block_id'            => $request->block_id,
                'village'          => $request->village,
                'pincode'          => $request->pincode,
                'is_latest'        => $request->has('is_latest'),
            ]
        );
        return redirect('/registry/step/3')->with('success', 'Residential details saved successfully.');
    }

    public function landDetail(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'khata_number'      => 'required',
            'plot_numbers'  => 'required',
            'total_land'       => 'required',
            'irrigation_source'       => 'required',
            'ownership_type'       => 'nullable',
        ]);

        FarmerLandDetail::updateOrCreate(
            ['user_id' => $userId],
            [
                'khata_number' => $request->khata_number,
                'plot_numbers'  => $request->plot_numbers,
                'total_land'    => $request->total_land,
                'irrigation_source' => $request->irrigation_source,
                'ownership_type'    => $request->ownership_type,
            ]
        );
        return redirect('/registry/step/4')->with('success', 'Land details saved successfully.');
    }

    public function cropDetail(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'main_crop'      => 'required',
            'secondary_crop'  => 'required',
            'season'       => 'required',
        ]);

        FarmerCropDetail::updateOrCreate(
            ['user_id' => $userId],
            [
                'main_crop' => $request->main_crop,
                'secondary_crop'  => $request->secondary_crop,
                'season'    => $request->season
            ]
        );
        return redirect('/registry/step/5')->with('success', 'Crop details saved successfully.');
    }

    public function bankDetail(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'bank_name'      => 'required',
            'account_holder_name'  => 'required',
            'account_number'       => 'required',
            'ifsc_code'       => 'required',
        ]);

        FarmerBankDetail::updateOrCreate(
            ['user_id' => $userId],
            [
                'bank_name' => $request->bank_name,
                'account_holder_name'  => $request->account_holder_name,
                'account_number'    => $request->account_number,
                'ifsc_code'    => $request->ifsc_code
            ]
        );
        return redirect('/registry/step/6')->with('success', 'Bank details saved successfully.');
    }

    public function documentsDetail(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'aadhaar_file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'land_papers'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bank_passbook'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $farmer = User::findOrFail($userId);

        $doc = FarmerDocument::firstOrCreate([
            'user_id' => $farmer->id
        ]);

        $basePath = "farmers/documents/{$farmer->id}";

        $files = [
            'aadhaar_file',
            'land_papers',
            'bank_passbook',
            'photo',
        ];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {

                // 🔥 Delete old file if exists
                if (!empty($doc->$file) && Storage::disk('public')->exists($doc->$file)) {
                    Storage::disk('public')->delete($doc->$file);
                }

                // 🔥 Generate unique filename
                $extension = $request->file($file)->getClientOriginalExtension();
                $fileName = $file . '_' . time() . '_' . uniqid() . '.' . $extension;

                // 🔥 Store new file farmer-wise
                $doc->$file = $request->file($file)
                    ->storeAs($basePath, $fileName, 'public');
            }
        }

        $doc->save();

        $farmer->update([
            'is_profile_completed' => 1,
            'profile_picture' => $doc->photo //  photo need to update her
        ]);
        return redirect()->route('home')->with('success', 'Profile completed successfully.');
    }
}
