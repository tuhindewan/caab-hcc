<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Classes\SendCode;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'nid' => ['required', 'min:10', 'max:10', 'unique:applicants,nid'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'mobile' => 'required|numeric|min:11|unique:applicants',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],
        [
            'nid.unique' => 'This NID has already been registered',
            'email.unique' => 'The email address has already been taken',
            'mobile.numeric' => 'Mobile number must be a number',
            'mobile.min' => 'Mobile number must be 11 digits',
            'mobile.unique' => 'Mobile number has already been taken',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request,$user) ?: redirect('/verify?mobile='.$request->mobile);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        if($user){
            Applicant::create([
                'nid' => $data['nid'],
                'mobile' => $data['mobile'],
                'user_id' => $user->id
            ]);
            $user->assignRole(['2']);
        }

        if($user){
            $user->code = SendCode::sendCode($data['mobile']);
            $user->save();
        }

        return $user;
    }
}
