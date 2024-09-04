<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function LoginPage()
    {
        return view('pages.login-page');
    }

    public function VerifyPage()
    {
        return view('pages.verify-page');
    }

    public function UserLogin(Request $request)
    {
        try{
            $userEmail = $request->email;
            $otp = rand(100000, 999999);
            $details = ['otp' => $otp];
            Mail::to($userEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email'=> $userEmail],['email'=> $userEmail,'otp' => $otp]);
            return ResponseHelper::Out('success', 'A 6 digit OTP has been sent to your email', 200);
        }
        catch(\Exception $e){
            return ResponseHelper::Out('fail', $e, 500);
        }
    }

    public function VerifyLogin(Request $request)
    {
        try{
            $userEmail = $request->email;
            $otp = $request->otp;
            $varification = User::where('email', $userEmail)->where('otp', $otp)->first();
            if($varification){
                User::where('email', $userEmail)->where('otp', $otp)->update(['otp' => 0]);
                $token = JWTToken::CreateToken($userEmail, $varification->id);
                return ResponseHelper::Out('success', '', 200)->cookie('token', $token, 60*24*30);
            }
            else{
                return ResponseHelper::Out('fail', 'Invalid OTP', 401);
            }
        }
        catch(\Exception $e){
            return ResponseHelper::Out('fail', $e, 401);
        }
    }

    public function UserLogout()
    {
        return redirect('/')->cookie('token', '', -1);
    }
}
