<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getIndividualApplicant()
    {
        $data = auth()->user();
        return view('frontend.applicant.show', compact('data'));
    }
}
