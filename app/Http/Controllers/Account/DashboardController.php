<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminUser;

class DashboardController extends Controller
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


    // public function index()
    // {
    //     $accountsCount = 0;
    //     $accounts = [];
    //     $farmers = User::query();
    //     $accounts = AdminUser::query();
    //     if ($this->role == 'block_admin') {
    //         $farmers->where('filled_by_admin_user_id', $this->account->id);
    //     }
    //     if ($this->role == 'district_admin') {
    //         $accounts->where('district_id', $this->account->district_id);
    //     } elseif ($this->role == 'division_admin') {
    //         $accounts->where('division_id', $this->account->division_id);
    //     } else {
    //         $accounts = AdminUser::query();
    //     }
    //     $accounts->where('id', '!=', $this->account->id);

    //     $accountsCount = $accounts->count();
    //     $accounts = $accounts->get();
    //     $farmerCount = $farmers->with('district')->count();
    //     $account = Auth::guard('account')->user();
    //     return view('account.dashboard', compact('account', 'farmerCount', 'accountsCount', 'accounts'));
    // }

    public function index()
    {
        $account = Auth::guard('account')->user();

        // Base queries
        $farmersQuery  = User::with(['district', 'residentialDetail']);
        $accountsQuery = AdminUser::with(['division', 'district', 'block']);

        // ================= FARMERS FILTER =================
        if ($this->role === 'block_admin') {

            $farmersQuery->where('filled_by_admin_user_id', $account->id);
        } elseif ($this->role === 'district_admin') {

            $farmersQuery->whereHas('residentialDetail', function ($q) use ($account) {
                $q->where('district_id', $account->district_id);
            });
        } elseif ($this->role === 'division_admin') {

            $farmersQuery->whereHas('residentialDetail', function ($q) use ($account) {
                $q->where('division_id', $account->division_id);
            });
        }
        // admin → sees all farmers


        // ================= ACCOUNTS FILTER =================
        if ($this->role === 'district_admin') {

            $accountsQuery->whereHas('district', function ($q) use ($account) {
                $q->where('district_id', $account->district_id);
            });
        } elseif ($this->role === 'division_admin') {

            $accountsQuery->whereHas('division', function ($q) use ($account) {
                $q->where('division_id', $account->division_id);
            });
        }

        // block_admin & admin → see all accounts except self
        $accountsQuery->where('id', '!=', $account->id);


        // ================= FINAL DATA =================
        $farmerCount   = $farmersQuery->count();
        $accountsCount = $accountsQuery->count();
        $accounts      = $accountsQuery->get();

        return view('account.dashboard', compact(
            'account',
            'farmerCount',
            'accountsCount',
            'accounts'
        ));
    }
}
