<?php

namespace App\Http\Controllers\Backend\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Yajra\DataTables\DataTables;

class AdminCompanyController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {

                $company = Company::with('user')->latest()->get();
                // dd($companies->toArray());
                return Datatables::of($company)
                    ->addIndexColumn()
                    ->addColumn('action', function ($company) {
                        // $btn = '<div class="d-flex align-items-center gap-2">';
                        // $btn .= '<a href="' . $viewRoute . '" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill fs-5"></i></a>';
                        // $btn .= '<a href="' . $editRoute . '" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square fs-5"></i></a>';
                        // $btn .= '<a href="javascript:void(0)" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="delete"><i class="bi bi-trash fs-5"></i></a>';
                        // $btn .= '</div>';
                        // return $btn;

                        $viewRoute = route('admin.company.view', ['companyId' => $company->id]);
                        $editRoute = route('admin.company.edit', ['companyId' => $company->id]);
                        $deleteRoute = route('admin.company.delete', ['companyId' => $company->id]);
                        return '<div class="d-flex align-items-center gap-2">
                                    <a href="' . $viewRoute . '" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill fs-5"></i></a>
                                    <a href="' . $editRoute . '" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square fs-5"></i></a>
                                    <a href="javascript:void(0)" class="text-danger delete" data-action="' . $deleteRoute . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash fs-5"></i></a>
                                    </div>';
                        return $btn;
                    })
                    ->addColumn('status', function ($company) {
                        $checked = $company->status ? 'checked' : '';
                        $toggleStatus = route('admin.company.toggleStatus', ['companyId' => $company->id]);
                        return '
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input toggle-status" type="checkbox" data-id="' . $company->id . '" data-action="' . $toggleStatus . '" ' . $checked . '>
                            </div>';
                    })
                    ->editColumn('name', function ($company) {
                        return '<strong>' . $company->name . '</strong><br><small class="text-muted">(' . $company->email . ')</small>';
                    })
                    ->editColumn('initial', function ($company) {
                        return $company->initial ? $company->initial : 'N/A';
                    })
                    ->addColumn('userName', function ($company) {
                        return $company->user->name ? $company->user->name : 'N/A';
                    })
                    ->editColumn('phoneNumber', function ($company) {
                        return $company->phoneNumber ? $company->phoneNumber : 'N/A';
                    })
                    ->editColumn('city', function ($company) {
                        return $company->city ? $company->city : 'N/A';
                    })
                    ->editColumn('created_at', function ($company) {
                        return '
                            ' . $company->created_at->format('d-M-y') . '
                            <br>
                            <small class="text-muted">At ' . $company->created_at->format('g:i A') . '</small>';
                    })
                    ->rawColumns(['action', 'name', 'status', 'created_at',])
                    ->make(true);
            }

            return view('backend.company.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle company status
     *
     * @param integer $companyId
     * @return void
     */
    public function toggleStatus($companyId)
    {
        try {
            DB::beginTransaction();
            // Check that selected company is valid or not
            $company = Company::find($companyId);
            if (!$company) {
                throw new Exception("Invalid Company. Kindly try again with valid Company");
            }

            // Toggle the status
            $company->update([
                'status' => !($company->status),
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Company status Successfully Update now.'
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Company view function
     *
     * @param integer $companyId
     * @return void
     */
    public function view($companyId)
    {
        try {
            // Check that selected company is valid or not
            $company = Company::find($companyId);
            if (!$company) {
                throw new Exception("Invalid Company. Kindly try again with valid Company");
            }

            return view('backend.company.show')->with([
                'company' => $company,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company Create function
     *
     * @return void
     */
    public function create()
    {
        try {
            //code...
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company store function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            //code...
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company edit function
     *
     * @param integer $companyId
     * @return void
     */
    public function edit($companyId)
    {
        try {
            //code...
            dd($companyId);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company update function
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        try {
            //code...
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete company record
     *
     * @param integer $companyId
     * @return void
     */
    public function delete($companyId)
    {
        try {
            DB::beginTransaction();
            // dd($companyId);
            // Check that selected company is valid or not
            $company = Company::find($companyId);
            if (!$company) {
                throw new ErrorException('Invalid Company. Kindly try again with valid Company');
            }

            $company->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Company Successfully deleted now.',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
