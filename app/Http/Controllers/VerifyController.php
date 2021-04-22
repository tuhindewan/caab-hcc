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
            return redirect()->route('login')->with('success', 'Your account is activated. Now you can login to the system');
        }
        else{
            return back()->with('error', 'Verification code is not correct. Please try again');
        }
    }

}
