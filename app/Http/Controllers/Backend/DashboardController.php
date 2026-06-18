<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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

            return view('backend.index', with([
                'totalUsers' => $totalUsers
            ]));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
