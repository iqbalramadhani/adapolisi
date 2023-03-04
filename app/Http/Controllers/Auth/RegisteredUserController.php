<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use App\Jobs\UserActivationEmailJob;
use Queue;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'      => 'required|string|email|max:255',
            'password'   => ['required', 'confirmed'],
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json(['error'=> 'Email tidak terdaftar']);
        }
        
        $activation_token = Str::random(30);
        $user->update([
            'activation_token' => $activation_token
        ]);

        $user_name = $user->fullname ?? $user->first_name .' '. $user->last_name;

        $this->sendMail($user->email, $activation_token, $user_name);
        // event(new Registered($user));

        return redirect()->back();
    }

    private function sendMail($email, $activation_token, $name) 
    {
        $data = [
            'email' => $email,
            'activation_token' => $activation_token,
            'name' => $name
        ];
        return Queue::push(new UserActivationEmailJob($data));
    }

    public function activationAccount(Request $request)
    {
        $user = User::where('activation_token', $request->user_token_activation)->first();

        $user->update([
            'is_activate' => 1
        ]);

        $message = "Akun anda berhasil teraktivasi, silahkan login";

        return view('auth.login', compact('message'));
    }


    public function activation($token)
    {        
        $user_token = $token;
        return view('auth.verify-token-activation', compact('user_token'));
    }

    /**
     * Handle an incoming api registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = Str::random(60);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'api_token' => hash('sha256', $token),
        ]);

        return response($user);
    }
}
