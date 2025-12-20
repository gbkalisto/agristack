<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer;
use App\Models\User;
use App\Models\District;
use App\Models\FarmerLandDetail;
use App\Models\FarmerCropDetail;
use App\Models\FarmerBankDetail;
use App\Models\FarmerDocument;
use App\Models\FarmerResidentialDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FarmerController extends Controller
{
    protected $account;
    protected $role;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->account = auth('account')->user();
            $this->role = auth('account')->user()->role;
            return $next($request);
        });
    }
    /* =========================
        STEP 1 – BASIC DETAILS
    ========================== */
    public function index()
    {
        $farmers = User::query();
        if ($this->role == 'block_admin') {
            $farmers->where('filled_by_admin_user_id', $this->account->id);
        }
        $farmers = $farmers->with('district')->latest()->paginate(15);
        return view('account.farmer.index', compact('farmers'));
    }

    public function create()
    {
        $districts = District::all();
        return view('account.farmer.create', compact('districts'));
    }

    public function storeBasic(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'mobile'      => 'required|digits:10|unique:users,phone',
            'aadhaar'     => 'nullable|digits:12|unique:users,aadhaar',
            'district_id' => 'required|exists:districts,id',
        ]);

        $farmer = User::create([
            'name'                => $request->name,
            'father_name'         => $request->father_name,
            'phone'              => $request->mobile,
            'email'              => $request->email,
            'aadhaar'             => $request->aadhaar,
            'dob'                 => $request->dob,
            'gender'              => $request->gender,
            'category'            => $request->category,
            'address'             => $request->address,
            'district_id'         => $request->district_id,

            // Tracking
            'filled_by'           => 'admin_user',
            'filled_by_admin_user_id'  => auth('account')->id(),
        ]);

        session(['farmer_id' => $farmer->id]);

        return redirect()->route('account.farmers.create.land');
    }

    /* =========================
        STEP 2 – LAND DETAILS
    ========================== */

    public function createLand()
    {
        return view('account.farmer.steps.land');
    }

    public function storeLand(Request $request)
    {
        $request->validate([
            'khata_number'      => 'nullable|string',
            'plot_numbers'      => 'nullable|string',
            'total_land'        => 'nullable|numeric',
            'irrigation_source' => 'nullable|string',
            'ownership_type'    => 'nullable|string',
        ]);

        FarmerLandDetail::create([
            'user_id'           => session('farmer_id'),
            'khata_number'      => $request->khata_number,
            'plot_numbers'      => $request->plot_numbers,
            'total_land'        => $request->total_land,
            'irrigation_source' => $request->irrigation_source,
            'ownership_type'    => $request->ownership_type,
        ]);

        return redirect()->route('account.farmers.create.crop');
    }

    /* =========================
        STEP 3 – CROP DETAILS
    ========================== */

    public function createCrop()
    {

        return view('account.farmer.steps.crop');
    }

    public function storeCrop(Request $request)
    {
        $request->validate([
            'main_crop'      => 'required|string',
            'secondary_crop' => 'nullable|string',
            'season'         => 'required|string',
        ]);
        FarmerCropDetail::create([
            'user_id'      => session('farmer_id'),
            'main_crop'      => $request->main_crop,
            'secondary_crop' => $request->secondary_crop,
            'season'         => $request->season,
        ]);

        return redirect()->route('account.farmers.create.bank');
    }

    /* =========================
        STEP 4 – BANK DETAILS
    ========================== */

    public function createBank()
    {
        return view('account.farmer.steps.bank');
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'bank_name'            => 'required|string',
            'account_holder_name'  => 'required|string',
            'account_number'       => 'required|string',
            'ifsc_code'            => 'required|string',
        ]);

        FarmerBankDetail::create([
            'user_id'           => session('farmer_id'),
            'bank_name'           => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'account_number'      => $request->account_number,
            'ifsc_code'           => $request->ifsc_code,
        ]);

        return redirect()->route('account.farmers.create.documents');
    }

    /* =========================
        STEP 5 – DOCUMENTS
    ========================== */

    public function createDocuments()
    {
        return view('account.farmer.steps.documents');
    }

    public function storeDocuments(Request $request)
    {
        $request->validate([
            'aadhaar_file'  => 'required|file|mimes:pdf,jpg,jpeg,png',
            'land_papers'  => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'bank_passbook' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'photo'        => 'nullable|image',
        ]);

        DB::transaction(function () use ($request) {

            $data = ['user_id' => session('farmer_id')];
            foreach (['aadhaar_file', 'land_papers', 'bank_passbook', 'photo'] as $file) {
                if ($request->hasFile($file)) {
                    $data[$file] = $request->file($file)
                        ->store('farmers/documents', 'public');
                }
            }

            FarmerDocument::create($data);

            // Mark farmer profile completed
            // User::where('id', session('farmer_id'))
            //     ->update(['is_profile_completed' => true]);
        });

        // session()->forget('farmer_id');

        // return redirect()
        //     ->route('account.farmers.index')
        //     ->with('success', 'Farmer registered successfully');
        return redirect()->route('account.farmers.create.residential');
    }


    /* =========================
        STEP 6 – Recidential DETAILS
    ========================== */

    public function createResidential()
    {
        return view('account.farmer.steps.residential');
    }

    public function storeResidential(Request $request)
    {
        $request->validate([
            'division_id'      => 'required',
            'district_id'  => 'required',
            'block_id'       => 'required',
            'village'       => 'required|string',
            'pincode'       => 'nullable|digits:6',
        ]);

        FarmerResidentialDetail::create(
            [
                'user_id'          => session('farmer_id'),
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
        // Mark farmer profile completed
        User::where('id', session('farmer_id'))
            ->update(['is_profile_completed' => true]);
        session()->forget('farmer_id');

        return redirect()
            ->route('account.farmers.index')
            ->with('success', 'Farmer profile completed successfully');
    }

    // edit and update methods would go here


    ######################################################
    public function edit(User $farmer)
    {
        $farmer->load([
            'district',
            'landDetail',
            'cropDetail',
            'bankDetail',
            'documents',
        ]);
        Gate::authorize('manage-farmer', $farmer);

        return view('account.farmer.edit.index', compact('farmer'));
    }

    ######################################################


    public function editBasic(User $farmer)
    {
        $farmer->load([
            'district',
            'landDetail',
            'cropDetail',
            'bankDetail',
            'documents',
        ]);

        $districts = District::all();
        return view('account.farmer.edit.index', compact('farmer', 'districts'));
    }

    public function updateBasic(Request $request, User $farmer)
    {
        $request->validate([
            'name' => 'required',
            'district_id' => 'required|exists:districts,id',
        ]);

        $farmer->update($request->only([
            'name',
            'father_name',
            'dob',
            'gender',
            'category',
            'address',
            'district_id'
        ]));

        return redirect()->route('account.farmers.edit.land', $farmer->id);
    }

    public function editLand(User $farmer)
    {
        $land = FarmerLandDetail::firstOrNew(['user_id' => $farmer->id]);

        return view('account.farmer.edit.steps.land', [
            'farmer' => $farmer,
            'land' => $land,
            'isEdit' => true,
            'currentStep' => 2,
        ]);
    }

    public function updateLand(Request $request, User $farmer)
    {
        FarmerLandDetail::updateOrCreate(
            ['user_id' => $farmer->id],
            $request->only([
                'khata_number',
                'plot_numbers',
                'total_land',
                'irrigation_source',
                'ownership_type'
            ])
        );

        return redirect()->route('account.farmers.edit.crop', $farmer->id);
    }

    public function editCrop(User $farmer)
    {
        $crop = FarmerCropDetail::firstOrNew(['user_id' => $farmer->id]);

        return view('account.farmer.edit.steps.crop', compact('farmer', 'crop') + [
            'isEdit' => true,
            'currentStep' => 3,
        ]);
    }

    public function updateCrop(Request $request, User $farmer)
    {
        FarmerCropDetail::updateOrCreate(
            ['user_id' => $farmer->id],
            $request->only(['main_crop', 'secondary_crop', 'season'])
        );

        return redirect()->route('account.farmers.edit.bank', $farmer->id);
    }

    public function editBank(User $farmer)
    {
        $bank = FarmerBankDetail::firstOrNew(['user_id' => $farmer->id]);

        return view('account.farmer.edit.steps.bank', compact('farmer', 'bank') + [
            'isEdit' => true,
            'currentStep' => 4,
        ]);
    }

    public function updateBank(Request $request, User $farmer)
    {
        FarmerBankDetail::updateOrCreate(
            ['user_id' => $farmer->id],
            $request->only([
                'bank_name',
                'account_holder_name',
                'account_number',
                'ifsc_code'
            ])
        );

        return redirect()->route('account.farmers.edit.documents', $farmer->id);
    }

    public function editDocuments(User $farmer)
    {
        $documents = FarmerDocument::firstOrNew(['user_id' => $farmer->id]);

        return view('account.farmer.edit.steps.documents', compact('farmer', 'documents') + [
            'isEdit' => true,
            'currentStep' => 5,
        ]);
    }

    public function updateDocuments(Request $request, $id)
    {
        $farmer = User::findOrFail($id);

        $doc = FarmerDocument::firstOrCreate([
            'user_id' => $farmer->id
        ]);

        $files = ['aadhaar_file', 'land_papers', 'bank_passbook', 'photo'];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {

                // Delete old file if exists
                if ($doc->$file && Storage::disk('public')->exists($doc->$file)) {
                    Storage::disk('public')->delete($doc->$file);
                }

                // Store new file
                $doc->$file = $request->file($file)
                    ->store('farmers/documents', 'public');
            }
        }

        $doc->save();

        // return redirect()
        //     ->route('account.farmers.index')
        //     ->with('success', 'Documents updated successfully');
        return redirect()->route('account.farmers.edit.residential', $farmer->id);
    }

    public function editResidential(User $farmer)
    {
        $residential = FarmerResidentialDetail::firstOrNew(['user_id' => $farmer->id]);

        return view('account.farmer.edit.steps.residential', compact('farmer', 'residential') + [
            'isEdit' => true,
            'currentStep' => 6,
        ]);
    }

    public function updateResidential(Request $request, User $farmer)
    {
        $request->validate([
            'division_id'      => 'required',
            'district_id'  => 'required',
            'block_id'       => 'required',
            'village'       => 'required|string',
            'pincode'       => 'nullable|digits:6',
        ]);

        FarmerResidentialDetail::updateOrCreate(
            ['user_id' => $farmer->id],
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

        return redirect()
            ->route('account.farmers.index')
            ->with('success', 'Residential details updated successfully');
    }
}
