<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Classes\SendCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResendVerificationCodeController extends Controller
{
    public function resendVerificationCode($id)
    {
        $user = User::findOrFail($id);
        if($user){
            $code = SendCode::sendCode($user->applicant->mobile, $user->name);
            DB::table('users')->where('id', $user->id)->update([
                'code' => $code,
            ]);
        }
        return redirect('/registration-verification?user='.$user->id)->with('success', 'Verification code is send to your respective mobile number');
    }

    public function getActivationForm()
    {
        return view('verify.activation_form');
    }

    public function activation(Request $request)
    {
        $data = DB::table('applicants')->select('user_id')->where('mobile', $request->mobile)->first();
        $user = User::findOrFail($data->user_id);
        if($user){
            $code = SendCode::sendCode($request->mobile, $user->name);
            DB::table('users')->where('id', $user->id)->update([
                'code' => $code,
            ]);
        }

        return redirect('/registration-verification?user='.$user->id)->with('success', 'Verification code is send to your respective mobile number');
    }
}
