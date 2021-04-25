<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountUpdateRequest;

class AccountController extends Controller
{
    public function getIndividualApplicant()
    {
        $data = auth()->user();
        return view('frontend.applicant.show', compact('data'));
    }

    public function updateAccount(AccountUpdateRequest $request)
    {
        $user = auth()->user();
        $applicant = $user->applicant;

        DB::transaction(function () use($request, $applicant, $user) {

            if (!empty($request->password)) {
                $password = Hash::make($request['password']);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'password' => $password,
                    ]);
            }

            if (!empty($request->username)) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'username' => $request->username,
                    ]);
            }

            DB::table('users')->where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);


            DB::table('applicants')->where('id', $applicant->id)->update([
                'mobile' => $request->mobile,
                'nid' => $request->nid
            ]);

        });

        return response()->json([
            'msg' => 'Account information updated successfully'
        ]);
    }
}
