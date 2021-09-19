<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\PasswordResets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;

class ForgotPasswordController extends Controller
{

    public function sendResetPasswordLink(Request $request){
        $this->validate($request,[
            'email' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();

        if (!empty($user)) {            

            $token = str_random(50);

            $check_token = PasswordResets::where('email',$request->email)->delete();

            $password_reset = new PasswordResets();
            $password_reset->email = $user->email;
            $password_reset->token = $token;
            $password_reset->save();

            //Mail
            $to_name = $user->user_name;
            $to_email = $user->email;

            $data = array('name'=>$user->user_name, 'token'=>$token);

            Mail::send('email.password_reset', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Reset Password');
                $message->from('reset-password@bazaarsy.com','Bazaarsy Team');
            });

            return redirect('/login')->with('doneMessage','We sent the email. Please check your inbox.');
        }
        else
            return Redirect::back()->withErrors(['There is no user registered with this email address.']);
    }

    public function resetPasswordToken($token){
        return view('auth.passwords.reset',compact('token'));
    }


    public function resetPassword(Request $request){

        $this->validate($request,[
            'email' => 'required',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $password_reset = PasswordResets::where('token',$request->token)
                                    ->where('email',$request->email)
                                    ->first();

        if (count($password_reset)>0) {

            $user = User::where('email',$request->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();

            $check_token = PasswordResets::where('email',$user->email)->delete();
            return redirect('/login')->with('doneMessage','Password changed successfully.');
        }
        else
            return redirect('/password/reset')->with('errorMessage','An error occur please verify email again.');
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
