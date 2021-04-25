<?php

namespace App\Http\Controllers;

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
        return $request->all();
    }
}
