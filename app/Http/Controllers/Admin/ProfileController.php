<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfileData()
    {
        return view('admin.profile.profile');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        
        return response()->json([
            'msg' => 'Profile information updated successfully'
        ]);
    }
}
