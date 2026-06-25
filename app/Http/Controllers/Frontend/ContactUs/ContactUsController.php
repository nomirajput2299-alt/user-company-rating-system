<?php

namespace App\Http\Controllers\Frontend\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Contactus\StoreFeedbackRequest;
use App\Models\Feedback;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    /**
     * ContactUs create function
     *
     * @return void
     */
    public function create()
    {
        try {
            return view('frontend.contactus.contactus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store Feedback Function
     *
     * @param StoreFeedbackRequest $request
     * @return void
     */
    public function store(StoreFeedbackRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            $feedback = Feedback::create($data);

            DB::commit();
            return redirect()->route('web.contactUs.create')->with('success', 'Feedback is submitted now.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
