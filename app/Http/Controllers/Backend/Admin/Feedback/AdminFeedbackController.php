<?php

namespace App\Http\Controllers\Backend\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminFeedbackController extends Controller
{
    /**
     * Feedback function of admin side
     *
     * @param Request $request
     * @return void
     */
    public function index (Request $request) {
        try {
             if ($request->ajax()) {
                $feedback = Feedback::latest()->get();
                // dd($company);
                return Datatables::of($feedback)
                    ->addIndexColumn()
                    ->addColumn('action', function ($feedback) {
                        $viewRoute = route('admin.feedback.view', ['feedbackId' => $feedback->id]);
                        $deleteRoute = route('admin.feedback.delete', ['feedbackId' => $feedback->id]);
                        return '<div class="d-flex align-items-center gap-2">
                                    <a href="' . $viewRoute . '" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill fs-5"></i></a>
                                    <a href="javascript:void(0)" class="text-danger delete" data-action="' . $deleteRoute . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash fs-5"></i></a>
                                    </div>';
                    })
                    ->editColumn('name', function ($feedback) {
                        return '<strong>' . $feedback->name . '</strong><br><small class="text-muted">(' . $feedback->email . ')</small>';
                    })
                    ->editColumn('phoneNumber', function ($feedback) {
                        return $feedback->phoneNumber ? $feedback->phoneNumber : 'N/A';
                    })
                    ->editColumn('subject', function ($feedback) {
                        return $feedback->subject ? $feedback->subject : 'N/A';
                    })
                    ->editColumn('created_at', function ($feedback) {
                        return '
                            ' . $feedback->created_at->format('d-M-y') . '
                            <br>
                            <small class="text-muted">At ' . $feedback->created_at->format('g:i A') . '</small>';
                    })
                    ->rawColumns(['action', 'name', 'created_at',])
                    ->make(true);
            }

            return view('backend.admin.feedback.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View function of Feedback
     *
     * @param integer $feedbackId
     * @return void
     */
    public function view ($feedbackId) {
        try {
            $feedback = Feedback::find($feedbackId);
            if (!$feedback) {
                throw new ErrorException('Unable to submit your feedback. Please verify your details and try again.');
            }
            return view('backend.admin.feedback.show')->with([
                'feedback' => $feedback,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete ($feedbackId) {
        try {
            $feedback = Feedback::find($feedbackId);
            if (!$feedback) {
                throw new ErrorException('Unable to submit your feedback. Please verify your details and try again.');
            }

             $feedback->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Feedback Successfully deleted now.',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
