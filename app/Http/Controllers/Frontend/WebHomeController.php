<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
            return view('frontend.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
