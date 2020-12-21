<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidateEmail;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm(){
        return view('front.pages.auth.register');
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
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',new ValidateEmail()],
            'phone' => ['required', 'numeric','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /***
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'image' =>'uploads/users/default-user.png',
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role'  => CUSTOMER,
            'plan_id'=>null,
            'plan_starting_date'=>null,
            'email_verified_at' => now(),
            'status'=>'unblocked',
            'password' => Hash::make($data['password']),
        ]);
    }
}
