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
use App\Models\FarmerDocument;

class RegistryController extends Controller
{

    public function index()
    {
        $step = RegistryStepService::currentStep();

        // All steps completed
        // if ($step === null) {
        //     auth()->user()->update(['is_profile_completed' => 1]);
        //     return view('registry.completed');
        // }

        // //Incomplete → redirect to correct step
        // return redirect()->route('registry.step', $step);
        $user = Auth::user();
        return view('registry', compact('user', 'step'));
    }

    public function step($step)
    {
        $currentStep = RegistryStepService::currentStep();

        if ($step > $currentStep) {
            return redirect()->route("registry.step.$currentStep");
        }
        // load all user related data
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
        $districts = District::where('status',1)->get();
        $divisions = Division::where('status',1)->get();
        return view("registry.steps.step-$step", compact('user', 'districts','divisions'));
    }




    public function store(Request $request, $step)
    {
        $userId = auth()->id();

        switch ($step) {

            case 2:
                FarmerResidentialDetail::updateOrCreate(
                    ['user_id' => $userId],
                    $request->validated()
                );
                break;

            case 3:
                FarmerLandDetail::updateOrCreate(
                    ['user_id' => $userId],
                    $request->validated()
                );
                break;

            case 4:
                FarmerCropDetail::updateOrCreate(
                    ['user_id' => $userId],
                    $request->validated()
                );
                break;

            case 5:
                FarmerBankDetail::updateOrCreate(
                    ['user_id' => $userId],
                    $request->validated()
                );
                break;

            case 6:
                FarmerDocument::updateOrCreate(
                    ['user_id' => $userId],
                    $request->validated()
                );

                auth()->user()->update(['is_profile_completed' => 1]);
                return redirect()->route('registry.completed');
        }

        return redirect()->route('registry.index');
    }
}
