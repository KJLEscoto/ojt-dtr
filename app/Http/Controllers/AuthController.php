<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'student_no' => 'required|string|max:255',

            'emergency_contact_fullname' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:255',
            'emergency_contact_address' => 'required|string|max:255',

            'password' => 'required|string|min:8|confirmed',
        ]);

        //return response()->json(['message' => $request->all()],Response::HTTP_INTERNAL_SERVER_ERROR);

        //dd($data);
        //Generate QR Code
        $qr_code = 'QR' . '_' . Str::random(10) . '_' . Str::random(10);

        //dd($qr_code);
        $user = User::create(
            [
                'firstname' => $data['firstname'],
                'middlename' => $data['middlename'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'school' => $data['school'],
                'student_no' => $data['student_no'],
                'emergency_contact_fullname' => $data['emergency_contact_fullname'],
                'emergency_contact_number' => $data['emergency_contact_number'],
                'emergency_contact_address' => $data['emergency_contact_address'],
                'qr_code' => $qr_code,
                'expiry_date' => Carbon::now()->addMonths(3),
            ]
        );

        return back()->with([
            'success' => 'Congratulations! You are now registered!',
        ]);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request, HistoryController $historyController, UserController $userController)
    {
        //dd($request->all());

        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);        

            if (Auth::attempt($data)) {

            //session regenerate
            $request->session()->regenerate();

            //get the auth user data
            $user = Auth::user();

            //local variables
            $isExpired = false;
            $isActive = false;
            $isStarted = false;

            if ($user->role == 'admin') {
                if($request->type === 'user')
                {
                    Auth::logout();
                    return back()->with('invalid', 'This user does not belong here');
                }

                $userController->showAdminScanner();
                
            } else {
                if($request->type === 'admin')
                {
                    Auth::logout();
                    return back()->with('invalid', 'This user does not belong here');
                }
                if ($user->expiry_date < Carbon::now()) {
                    $user->status = 'inactive';
                    $user->save();
                    Auth::logout();

                    //expiry message
                    return response()->json(
                        ['error' => 'Your account has expired, Please contact the admin for more inforamtion'],
                        Response::HTTP_UNAUTHORIZED
                    );
                }
                if (!is_null($user->starting_date) && $user->starting_date <= Carbon::now()) {
                    $isStarted = true;
                }
                else{
                    if($user->expiry_date < Carbon::now()){
                        $user->status = 'inactive';
                        $user->save();
                        Auth::logout();

                        //expiry message
                        return response()->json(['error' => 'Your account has expired, Please contact the admin for more inforamtion'],
                        Response::HTTP_UNAUTHORIZED);
                    }
                    if(!is_null($user->starting_date) && $user->starting_date <= Carbon::now()){
                        $isStarted = true;
                    }
                    if(!is_null($user->expiry_date) && $user->expiry_date <= Carbon::now()){
                        $isExpired = true;
                    }
                    if($user->status == 'active'){
                        $isActive = true;
                    }
                    if($isStarted && $isActive && !$isExpired){

                        //redirect to the users dashboard
                        return redirect()->route('users.dashboard');
                    }
                    else{
                        //this will logout the user and redirect 
                        Auth::logout();
                        return response()->json(['error' => 'You are not allowed to login, Please contact the admin for more inforamtion'], 403);
                    }
                }
            }
        }

        // return back()->with(['invalid' => 'Invalid Login Credentials.']);

        throw ValidationException::withMessages([
            'invalid' => 'Invalid login credentials.'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //redirect()->route('login');

        if ($user->role == 'admin') {
            Auth::logout();
            return redirect()->route('show.admin.login');
        } else {
            Auth::logout();
            return redirect()->route('show.login');
        }
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request, EmailController $emailController)
    {
        //email verification
        $data = $request->validate([
            'email' => 'required|string|email',
        ]);
        //dd($data);

        //validation here
        $user = User::where('email', $request->email)->first();

        //get the class of the Auth
        $authenticatedUser = Auth::class;

        if (!$user) {
            return back()->with('invalid', 'Email not found');
        }

        if ($authenticatedUser::check()) {
            if ($user->email != $authenticatedUser::user()->email) {
                return back()->with('invalid', 'Email does not matched!');
            }
        }

        //send the reset password link to the email
        $resetPassword = $emailController->EmailResetPassword($user);

        //return the success response
        return back()->with('success', 'Password reset successfully');
    }

}