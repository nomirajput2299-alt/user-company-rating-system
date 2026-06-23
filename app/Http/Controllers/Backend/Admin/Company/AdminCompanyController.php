<?php

namespace App\Http\Controllers\Backend\Admin\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\StoreCompanyRequest;
use App\Http\Requests\Backend\Company\UpdateCompanyRequest;
use App\Models\Company;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminCompanyController extends Controller
{
    /**
     * Company listing function
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {

                $company = Company::with('user')->latest()->get();
                return Datatables::of($company)
                    ->addIndexColumn()
                    ->addColumn('action', function ($company) {
                        $viewRoute = route('admin.company.view', ['companyId' => $company->id]);
                        $editRoute = route('admin.company.edit', ['companyId' => $company->id]);
                        $deleteRoute = route('admin.company.delete', ['companyId' => $company->id]);
                        return '<div class="d-flex align-items-center gap-2">
                                    <a href="' . $viewRoute . '" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill fs-5"></i></a>
                                    <a href="' . $editRoute . '" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square fs-5"></i></a>
                                    <a href="javascript:void(0)" class="text-danger delete" data-action="' . $deleteRoute . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash fs-5"></i></a>
                                    </div>';
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
                        return $company->user ? $company->user->name : 'N/A';
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

            return view('backend.admin.company.index');
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
                'message' => 'Company status Successfully Updated now.'
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

            return view('backend.admin.company.show')->with([
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
            return view('backend.admin.company.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company store function
     *
     * @param StoreCompanyRequest $request
     * @return void
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            DB::beginTransaction();
            $name = trim($request->name);
            $words = preg_split('/\s+/', $name);

            if (count($words) > 1) {
                // First letter of first two words
                $initial = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
            } else {
                // First two letters of single word
                $initial = strtoupper(substr($words[0], 0, 2));
            }

            $data = [
                'name' => $name,
                'email' => $request->email,
                'initial' => $initial,
                'userId' => Auth::user()->id,
                'phoneNumber' => $request->phoneNumber,
                'description' => $request->description,
                'city' => $request->city,
                'status' => $request->status,
            ];

            $company = Company::create($data);

            DB::commit();
            return redirect()->route('admin.company.edit', ['companyId' => $company->id])->with('success', 'Company Successfully Create.');
        } catch (Exception $e) {
            DB::rollBack();
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
            $company = Company::with('user')->find($companyId);
            // Check that selected company is valid or not
            if (!$company) {
                throw new Exception('Invalid Company. Kindly try again with valid Company');
            }
            return view('backend.admin.company.edit')->with([
                'company' => $company,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Company update function
     *
     * @param UpdateCompanyRequest $request
     * @return void
     */
    public function update(UpdateCompanyRequest $request)
    {
        try {
            DB::beginTransaction();
            $companyId = $request->companyId;
            // Check that selected company is valid or not
            $company = Company::with('user')->find($companyId);
            if (!$company) {
                throw new Exception('Invalid Company. Kindly try again with valid Company');
            }

            $data = [
                'name' => $request->name,
                'initial' => $request->initial,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'description' => $request->description,
                'city' => $request->city,
                'status' => $request->status,
            ];

            $company->update($data);

            DB::commit();
            return redirect()->route('admin.company.edit', ['companyId' => $companyId])->with('success', 'Comapny Detail are successfully Update Now.');
        } catch (Exception $e) {
            DB::rollBack();
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
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
