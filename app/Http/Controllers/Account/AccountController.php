<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AdminUser;

class AccountController extends Controller
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

    public function index(Request $request)
    {
        $currentAccount = Auth::guard('account')->user();

        $keyword = $request->input('search');

        $accounts = AdminUser::query();

        // 🔐 Role-based filtering (unchanged logic)
        if ($this->role === 'district_admin') {
            $accounts->where('district_id', $this->account->district_id);
        } elseif ($this->role === 'division_admin') {
            $accounts->where('division_id', $this->account->division_id);
        }

        // 🔍 Keyword Search
        if (!empty($keyword)) {
            $accounts->where(function ($q) use ($keyword) {

                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('mobile', 'like', "%{$keyword}%")

                    ->orWhereHas('district', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    })

                    ->orWhereHas('division', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });

                // ✅ Optional: block search (if relation exists)
                // ->orWhereHas('block', function ($q) use ($keyword) {
                //     $q->where('name', 'like', "%{$keyword}%");
                // });
            });
        }

        $accounts = $accounts->where('id', '!=', $currentAccount->id) // Exclude current account
            ->with(['district', 'division'])
            ->paginate(10)
            ->withQueryString(); // keeps search term during pagination

        return view('account.below_accounts.index', compact('currentAccount', 'accounts'));
    }
}
