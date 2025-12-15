<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\Division;

class DashboardController extends Controller
{
    protected $accounts;
    protected $divisions;
    public function __construct()
    {
        $this->accounts = AdminUser::count();
        $this->divisions = Division::count();
    }
    public function index()
    {
        return view('admin.dashboard', [
            'accounts' => $this->accounts,
            'divisions' => $this->divisions,
        ]);
    }
}
