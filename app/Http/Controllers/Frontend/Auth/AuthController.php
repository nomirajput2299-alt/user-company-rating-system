<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\LoginRequest;
use App\Http\Requests\Frontend\Auth\SignupRequest;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the Login page
     *
     * @return void
     */
    public function showLogin()
    {
        try {
            return view('frontend.auth.login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Login function
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                throw new ErrorException('Invalid Email or Password');
            }

            $request->session()->regenerate();
            $user = Auth::user();

             if(!$user->status){
                Auth::logout();
                return redirect()->route('web.auth.login')->with('error', 'Your account is inactive. Please Contact Administrator');
            }

            if ($user->hasRole('admin')) {
                return redirect()->route('backend.dashboard.index')->with('success', 'Welcome Admin.');
            }

            if ($user->hasRole('user')) {
                return redirect()->route('Web.Home')->with('success', 'Login successful.');
            }

            // Unknown role
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw new ErrorException('Unauthorized role assigned to this account.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show Sign-up
     *
     * @return void
     */
    public function showSignup()
    {
        try {
            return view('frontend.auth.register');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     *Signup function
     *
     * @param Request $request
     * @return void
     */
    public function signup(SignupRequest $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $avatarPath = null;
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');

                // get extension only
                $extension =$file->getClientOriginalExtension();
                // only timestamp filename
                $filename = time() . '.' . $extension;
                // store in storage/app/public/avatars
                $avatarPath = $file->storeAs('avatars', $filename, 'public');
            }
            // Create data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'avatar' => $avatarPath,
                'password' => Hash::make($request->password),
            ];

            // Create the user record
            $user = User::create($data);

            //Assign Role Spatie
            $user->assignRole('user');

            // Attempt Login
            Auth::login($user);

            DB::commit();
            return redirect()->route('Web.Home')->with('info', 'Welcome! Account successfully created now.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Logout function
     *
     * @return void
     */
    public function logout()
    {
        try {
            if (Auth::check()) {
                Auth::logout();
                return redirect()->route('Web.Home')->with('success', 'Logout Successfully');
            }
            throw (new ErrorException('You are not login. Kindly login first.'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
