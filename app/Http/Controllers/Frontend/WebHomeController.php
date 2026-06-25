<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class WebHomeController extends Controller
{
    /**
     * Show the frontend Home Page
     *
     * @return void
     */
    public function index()
    {
        try {
            $totalUsers = User::where('status',1)->count();
            $totalCompanies = Company::count();

            return view('frontend.index', with([
                'totalUsers' => $totalUsers,
                'totalCompanies' => $totalCompanies,
            ]));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
