<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function getVerify()
    {
        return view('verify.form');
    }

    public function postVerify(Request $request){
        if($user=User::where('code',$request->code)->first()){
            $user->status = 1;
            $user->code=null;
            $user->save();
            return redirect()->route('login')->withMessage('Your account is active');
        }
        else{
            return back()->withMessage('verify code is not correct. Please try again');
        }
    }

}
