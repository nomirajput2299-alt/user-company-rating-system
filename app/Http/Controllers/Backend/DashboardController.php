<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
            return view('backend.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
