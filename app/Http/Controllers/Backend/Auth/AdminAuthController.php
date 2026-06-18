<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\StoreUserRequest;
use App\Http\Requests\Backend\Auth\UpdateUserRequest;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminAuthController extends Controller
{
    /**
     * List of user
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = User::orderby('id', 'desc');
                $roles = Role::all();
                return Datatables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        $viewRoute = route('admin.user.view', ['userId' => $user->id]);
                        $editRoute = route('admin.user.edit', ['userId' => $user->id]);
                        $deleteRoute = route('admin.user.delete', ['userId' => $user->id]);
                        $ownerEmail = 'admin@example.com';
                        $btn = '<div class="d-flex align-items-center gap-2">';
                        $btn .= '<a href="' . $viewRoute . '" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="bi bi-eye-fill fs-5"></i></a>';
                        if ($user->email != $ownerEmail || Auth::user()->email == $ownerEmail) {
                            $btn .= '<a href="' . $editRoute . '" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square fs-5"></i></a>';
                        }
                        if ($user->email != $ownerEmail) {
                            $btn .= '<a href="javascript:void(0)" class="text-danger delete" data-action="' . $deleteRoute . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash fs-5"></i></a>';
                        }
                        $btn .= '</div>';
                        return $btn;
                    })
                    ->addColumn('status', function ($user) {
                        $checked = $user->status ? 'checked' : '';
                        $toggleStatus = route('admin.user.toggleStatus', ['userId' => $user->id]);
                        return '
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input toggle-status" type="checkbox" data-id="' . $user->id . '" data-action="' . $toggleStatus . '" ' . $checked . '>
                            </div>';
                    })
                    ->addColumn('roles', function ($user) use ($roles) {
                        $select = '<select class="form-select form-select-sm user-role" data-id="' . $user->id . '">';
                        $select .= '<option value="" selected disabled>Select Role</option>';
                        foreach ($roles as $role) {
                            $selected = $user->hasRole($role->name) ? 'selected' : '';
                            $select .= '<option value="' . $role->name . '" ' . $selected . '>' . ucfirst($role->name) . '</option>';
                        }
                        $select .= '</select>';
                        return $select;
                    })
                    ->editColumn('name', function ($user) {
                        return '<strong>' . $user->name . ' </strong><br><small class="text-muted">(' . $user->email . ')</small>';
                    })
                    ->editColumn('phoneNumber', function ($user) {
                        return $user->phoneNumber ? $user->phoneNumber : 'N/A';
                    })
                    ->editColumn('avatar', function ($user) {
                        if (!empty($user->avatar)) {
                            return '<image src="' . asset($user->avatar) . '"alt="Avatar" width="50" height="50" class="rounded circle">';
                        }
                        return 'N/A';
                    })
                    ->editColumn('created_at', function ($user) {
                        return '
                            ' . $user->created_at->format('d-M-y') . '<br><small class="text-muted">At ' . $user->created_at->format('g:i A') . '</small>';
                    })
                    ->rawColumns(['name', 'phoneNumber', 'avatar', 'status', 'action', 'created_at', 'roles'])
                    ->make(true);
            }
            return view('backend.auth.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * ToggleStatus of Status change
     *
     * @param integer $userId
     * @return void
     */
    public function toggleStatus($userId)
    {
        try {
            DB::beginTransaction();
            $user = User::find($userId);
            if (!$user) {
                throw new ErrorException('Invalid user. Kindly try again with the valid user.');
            }
            $loginUserId = Auth::user()->id;
            if ($userId == $loginUserId) {
                throw new ErrorException('Users are not allowed to change their own account status. ');
            }

            // Toggle the status
            $user->update([
                'status' => (!$user->status),
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'User status updated now.'
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
     * View function of admin side
     *
     * @param integer $userId
     * @return void
     */
    public function view($userId)
    {
        try {
            $user = User::find($userId);
            if (!$user) {
                throw new ErrorException('Invalid user. Kindly try again with valid user.');
            }
            return view('backend.auth.show')->with([
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit function of user of admin side
     *
     * @param integer $userId
     * @return void
     */
    public function edit($userId)
    {
        try {
            $roles = Role::all();
            $user = User::find($userId);
            if (!$user) {
                throw new ErrorException('Invalid user. Kindly try again with valid user.');
            }
            $ownerEmail = 'admin@example.com';
            if ($ownerEmail == $user->email && Auth::user()->email != $user->email) {
                throw new ErrorException('This owner email you can not edit this.');
            }

            return view('backend.auth.edit')->with([
                'user' => $user,
                'roles' => $roles,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update of user listings
     *
     * @param UpdateUserRequest $request
     * @return void
     */
    public function update(UpdateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $userId = $request->userId;
            $user = User::find($userId);
            if (!$user) {
                throw new ErrorException('Invalid user. Kindly try again with valid user.');
            }
            $ownerEmail = 'admin@example.com';
            if ($ownerEmail == $user->email && Auth::user()->email != $ownerEmail) {
                throw new ErrorException('This owner email you can not edit this.');
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'status' => $request->status,
            ];

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                // delete old avatar
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // get extension only
                $extension = $file->getClientOriginalExtension();
                // only timestamp filename
                $filename = time() . '.' . $extension;
                // store in storage/app/public/avatars
                $avatarPath = $file->storeAs('avatars', $filename, 'public');
                $data['avatar'] = $avatarPath;
            }
            if ($request->password != null) {
                $data['password'] = Hash::make($request->password);
            }


            $user->update($data);
            // Spatie role update
            $user->syncRoles([$request->roles]);

            DB::commit();
            return redirect()->route('admin.user.edit', ['userId' => $userId])->with('success', 'User Detail are successfully Update Now.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Create function of user of admin side
     *
     * @return void
     */
    public function create()
    {
        try {
            DB::beginTransaction();
            $roles = Role::all();

            DB::commit();
            return view('backend.auth.create')->with([
                'roles' => $roles,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store the new user
     *
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ];

            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                // get extension only
                $extension = $file->getClientOriginalExtension();
                // only timestamp filename
                $filename = time() . '.' . $extension;
                // store in storage/app/public/avatars
                $avatarPath = $file->storeAs('avatars', $filename, 'public');
                $data['avatar'] = $avatarPath;
            }
            if ($request->password != null) {
                $data['password'] = Hash::make($request->password);
            }

            //Create User Record
            $user = User::create($data);

            //Assign Role Spatie
            $user->assignRole($request->roles);

            DB::commit();
            return redirect()->route('admin.user.edit', ['userId' => $user->id])->with('success', 'User Successfully Created');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Change role of user of admin side
     *
     * @param Request $request
     * @return void
     */
    public function changeRole(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $newRole = $request->newRole;
            //  Check that select role is valid or not
            $role = Role::where('name', $newRole)->first();
            if (! $role) {
                throw new ErrorException('Invalid Role. Kindly try again with valid role.');
            }

            $userId = $request->userId;
            // Check that selected user is valid or not
            $user = User::find($userId);
            if (! $user) {
                throw new ErrorException('Invalid User. Kindly try again with valid user');
            }

            $ownerEmail = 'admin@example.com';
            // Check that $superAdmin
            if ($ownerEmail == $user->email) {
                throw new ErrorException('The Super Admin account is protected and cannot be modified.');
            }

            // Check user is not changing their own role
            if ($user->email == Auth::user()->email) {
                throw new ErrorException('You are not allowed to modify your own account role.');
            }

            //Assign Role Spatie
            $user->syncRoles($request->newRole);


            // dd($request->all());

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'User Role are Successfully change',
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
     * Delete user of admin side
     *
     * @param integer $userId
     * @return void
     */
    public function delete($userId)
    {
        try {
            DB::beginTransaction();
            $user = User::find($userId);
            if(! $user){
                throw new ErrorException('Invalid user. Kindly try again with valid user.');
                }
             $ownerEmail = 'admin@example.com';
             if($user->email == $ownerEmail){
                throw new ErrorException('You are not allowed to delete the owner account.');
             }

             $user->delete();
            //  dd($user);
             DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'User account successfully deleted now.',
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
