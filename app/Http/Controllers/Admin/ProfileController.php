<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Cache\Store;

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

        if($request->signature){
            $signatureExtension = explode('/', mime_content_type($request->signature))[1];
            $name = time().'.'.$signatureExtension;
            $resize = Image::make($request->signature)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
              })->encode('jpg');
            $save = Storage::put("public/images/signatures/{$name}", $resize->__toString());

            $currentSignnature = "public/images/signatures/".$employee->signature;
            Storage::delete($currentSignnature);

            if($save){
                DB::table('employees')->where('id', $employee->id)->update([
                    'signature' => $name,
                ]);
            }

        }

        if($request->seal){
            $sealExtension = explode('/', mime_content_type($request->seal))[1];
            $name = time().'.'.$sealExtension;
            $resize = Image::make($request->seal)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
              })->encode('jpg');
            $save = Storage::put("public/images/seals/{$name}", $resize->__toString());

            $currentSeal = "public/images/seals/".$employee->seal;
            Storage::delete($currentSeal);

            if($save){
                DB::table('employees')->where('id', $employee->id)->update([
                    'seal' => $name,
                ]);
            }
        }

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
