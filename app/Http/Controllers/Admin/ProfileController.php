<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function getProfileData()
    {
        return view('admin.profile.profile');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $employee = $user->employee;

        DB::transaction(function () use($request, $employee, $user) {

            if (!empty($request->password)) {
                $password = Hash::make($request['password']);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'password' => $password,
                    ]);
            }

            DB::table('users')->where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->mobile,
            ]);


            DB::table('employees')->where('id', $employee->id)->update([
                'department' => $request->department,
                'designation' => $request->designation,
                'mobile' => $request->mobile
            ]);

        });

        return response()->json([
            'msg' => 'Profile information updated successfully'
        ]);
    }
}
