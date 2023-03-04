<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Jobs\ForgotPasswordEmailJob;
use Queue;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
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
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['User with such email doesn\'t exist']
            ]);
        }

        $password_reset = ForgotPassword::updateOrCreate([
            'email' => $request->email
        ], [
            'token' => Str::random(30)
        ]);

        $user_name = $user->fullname ?? $user->first_name .' '. $user->last_name;

        $this->sendMail($user->email, $password_reset->token, $user_name);

        return redirect()->back();
    }

    private function sendMail($email, $token, $name) 
    {
        $data = [
            'email' => $email,
            'token' => $token,
            'name' => $name
        ];
        return Queue::push(new ForgotPasswordEmailJob($data));
    }

    public function resetPasswordPage($token)
    {        
        $user_token = $token;
        return view('auth.user-reset-password', compact('user_token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'   => ['required', 'confirmed'],
        ]);

        $forgot_password = ForgotPassword::where('token', $request->token)->first();

        if ($forgot_password) {
            $user = User::where('email', $forgot_password->email)->first();

            $user->update([
                'password' => Hash::make($request->password)
            ]);
        } else {
            return response()->json(['error'=> 'Token forgot password tidak ditemukan']);
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming api password reset link request.
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
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['User with such email doesn\'t exist']
            ]);
        }

        return response('Password reset email successfully sent.');
    }
}
