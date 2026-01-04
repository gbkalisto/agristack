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


    public function index()
    {
        $accountsCount = 0;
        $accounts = [];
        $farmers = User::query();
        $accounts = AdminUser::query();
        if ($this->role == 'block_admin') {
            $farmers->where('filled_by_admin_user_id', $this->account->id);
        }
        if ($this->role == 'district_admin') {
            $accounts->where('district_id', $this->account->district_id);
        } elseif ($this->role == 'division_admin') {
            $accounts->where('division_id', $this->account->division_id);
        }

        $accountsCount = $accounts->count();
        $accounts = $accounts->get();
        $farmerCount = $farmers->with('district')->count();
        $account = Auth::guard('account')->user();
        return view('account.dashboard', compact('account', 'farmerCount', 'accountsCount', 'accounts'));
    }
}
