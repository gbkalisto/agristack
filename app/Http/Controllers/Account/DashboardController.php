<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $account = Auth::guard('account')->user();
        return view('account.dashboard', compact('account'));
    }
}
