<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResendVerificationCodeController extends Controller
{
    public function resendVerificationCode($id)
    {
        $user = User::findOrFail($id);
        if($user){
            DB::table('users')->where('id', $user->id)->update([
                'code' => rand(11111,99999),
            ]);
        }
        return redirect('/registration-verification?user='.$user->id)->with('success', 'Verification code is send to your respective mobile number');
    }
}
