<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Model\AdminUsers;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/admin';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile'   => [
                'required',
                'regex:/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/',
                'unique:admin_users',
            ],
            'password' => 'required|min:6|alpha_num|confirmed',
        ], [
            'mobile.required'    => '手机号码不能为空!',
            'mobile.regex'       => '手机号码格式不正确!',
            'mobile.unique'      => '手机号码已存在!',
            'password.required'  => '密码不能为空!',
            'password.min'       => '密码不能小于6为数!',
            'password.alpha_num' => '密码必须是字母或数字!',
            'password.confirmed' => '两次密码不一致!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return AdminUsers
     */
    protected function create(array $data)
    {
        return AdminUsers::create([
            'mobile'   => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
