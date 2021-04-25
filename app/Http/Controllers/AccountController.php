<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getIndividualApplicant()
    {
        return view('frontend.applicant.show');
    }
}
