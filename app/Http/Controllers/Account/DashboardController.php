<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $farmers = User::query();
        if ($this->role == 'block_admin') {
            $farmers->where('filled_by_admin_user_id', $this->account->id);
        }
        $farmerCount = $farmers->with('district')->count();
        $account = Auth::guard('account')->user();
        return view('account.dashboard', compact('account', 'farmerCount'));
    }
}
