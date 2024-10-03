<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
     /**
     * Instantiate a new LoginRegisterController instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except([
    //         'logout', 'dashboard'
    //     ]);
    // }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('signup.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:6'
        ]);

        $newUser                     = new User;
        $newUser->name               = $request->name.' '.$request->last_name;
        //$newUser->last_name          = $request->last_name;
        $newUser->email              = $request->email;
        //$newUser->phone              = $request->phone;
        $newUser->password           = Hash::make($request->password);

        $newUser->save();

        // $newUser = User::create([
        //     'first_name' => $request->name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password)
        // ]);

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);
        $request->session()->regenerate();

        if($newUser->user_type == 0){
            return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
        } else {
            return redirect()->route('dashboard');
        }

        // return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('signup.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if (auth()->user()->user_type == '1' || auth()->user()->user_type == '2') {
                return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
            }else{
                return redirect()->route('home');
            }


        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.', ])->onlyInput('email');

    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('admin.dashboard');
        }

        return redirect()->route('login')->withErrors([ 'email' => 'Please login to access the dashboard.', ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }


    public function update_user(Request $request){

        if(!empty($request->new_password) &&  !empty($request->confirm_pass)){

            $request->validate([
                'new_password' => 'required',
                'confirm_password' => 'required|confirmed',
            ]);

            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        //$user->phone = $request->user_phone;
        $user->save();
        return redirect()->route('my_account')->withSuccess('User account details updated!');

    }


    public function member_list(Request $request)
    {
        $members = User::where('user_type','0')->get();
        return view('admin.pages.member.list', compact('members'));

    }



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }




}
