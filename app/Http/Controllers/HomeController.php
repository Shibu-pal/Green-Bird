<?php

namespace App\Http\Controllers;

use App\Mail\otpmail;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function index()
    {
        $id = Auth::check()?Auth::id():null;
        // $id = null;
        $items = Item::with(['item_pics','user'])->where([
            ['status', '=', 'Available'],
            ['user_id', '<>', $id]
        ])->paginate(20);
        // dd($items);
        // return $items;
        return view('home', compact('items'));
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Welcome, ' . Auth::user()->name . ' You are successfully logged in.');
        }
        return redirect()->route('login')->withErrors(['message' => 'Invalid email or password']);
    }

    public function register(Request $request)
    {
        $messages = [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
        $data = $request->validate([
            'first' => 'required|alpha',
            'last' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'password' => 'required|confirmed|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'photo' => 'nullable|image|max:4000',
        ], $messages);

        $data['profile_image'] = $request->photo ? $request->photo->store('image', 'public') : null;
        $data['name'] = $data['first'] . ' ' . $data['last'];
        $data['otp'] = rand(100000, 999999);

        $user = User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'profile_image' => $data['profile_image'],
                'otp' => $data['otp'],
            ]
        );

        Mail::to($data['email'])->send(new otpmail($data['otp'], "OTP sender", $data['name']));

        return redirect()->route('OTP')->withInput()->with([
            'message' => 'OTP sent successfully',
            'id' => $user->id,
            'email' => $data['email'],
        ]);
    }

    public function showOtp(Request $request)
    {
        return view('otp')->with([
            'message' => $request->session()->get('message'),
            'id' => $request->session()->get('id'),
            'email' => $request->session()->get('email'),
        ]);
    }

    public function forget_otp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->firstOrFail();
        $user->otp = rand(100000, 999999);
        $user->save();

        Mail::to($user->email)->send(new otpmail($user->otp, "OTP sender", $user->name));

        return redirect()->route('show_OTP')->withInput()->with([
            'message' => 'OTP sent successfully',
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }

    public function showForgetOtp(Request $request)
    {
        return view('forget_otp')->with([
            'message' => $request->session()->get('message'),
            'id' => $request->session()->get('id'),
            'email' => $request->session()->get('email'),
        ]);
    }

    public function otp(Request $request)
    {
        $request->validate([
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric',
            'otp5' => 'required|numeric',
            'otp6' => 'required|numeric',
        ]);
        $otp = implode('', $request->only('otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6'));
        $user = User::findOrFail($request->id);
        if ($user->otp == $otp) {
            $user->email_verified_at = now();
            $user->otp = null;
            $user->save();
            return redirect()->route('login')->with('message', 'Registered successfully Please log in');
        } else {
        return redirect()->route('OTP')->withInput()->with([
            'message' => 'Wrong OTP',
            'id' => $request->id,
                'email' => $user->email
    
        ]);
        }
    }

    public function to_pass(Request $request)
    {
        $request->validate([
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric',
            'otp5' => 'required|numeric',
            'otp6' => 'required|numeric',
        ]);
        $otp = implode('', $request->only('otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6'));
        $user = User::findOrFail($request->id);
        if ($user->otp == $otp) {
            $user->email_verified_at = now();
            $user->otp = null;
            $user->save();
            return view('new_password')->with('id', $request->id);
        }
        return redirect()->route('OTP')->withInput()->with([
            'message' => 'Wrong OTP',
            'id' => $request->id,
            'email' => $user->email,
        ]);
    }

    public function set_password(Request $request)
    {
        $messages = [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
        $request->validate(['password' => 'required|confirmed|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],$messages);
        $user = User::findOrFail($request->id);
        $user->update(['password' => bcrypt($request->password)]);
        return redirect()->route('login')->with('message', 'Password changed successfully. Please log in.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with([
            'success' => 'Logged out successfully'
        ]);
    }
}
