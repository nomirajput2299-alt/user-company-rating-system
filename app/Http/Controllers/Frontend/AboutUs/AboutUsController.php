<?php

namespace App\Http\Controllers\Frontend\AboutUs;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.aboutus.aboutus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
