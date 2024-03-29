<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsers()
    {
        $applicants = Applicant::all();
        return view('admin.users.index', compact('applicants'));
    }
}
