<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the Backend Home Page
     *
     * @return void
     */
    public function index()
    {
        try {
            $totalUsers = User::count();
            $totalCompanies = Company::count();
            $myCompanies = Company::where('userId', Auth::user()->id)->count();

            return view('backend.index', with([
                'totalUsers' => $totalUsers,
                'totalCompanies' => $totalCompanies,
                'myCompanies' => $myCompanies,
            ]));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
