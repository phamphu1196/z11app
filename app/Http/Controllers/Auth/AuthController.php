<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|min:6|confirmed',
        'sex' => 'required',
        
        ];

        $messages = [
            "name.required"     => "Tên không được bỏ trống",
            "email.required"    => "Email không được bỏ trống",
            "password.required"  => "Password không được bỏ trống",
            "password.min"       => "Password tối thiều 6 ký tự",
            "pasword.confirmed" => "Password xác nhận không trùng khớp",

        ];
        return Validator::make($data,$rules,$messages);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $client = new GuzzleHttpClient();
        $result = $client->post('http://kien.godfath.com/api/v1/auth/register', [
            'form_params' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'gender' => $data['sex'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation']
            ]
        ]);

        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }
    public function login(Request $request)
    {   
        try {
            $data = $request->only(['email', 'password']);
            $client = new GuzzleHttpClient();
            $result = $client->post('http://kien.godfath.com/api/v1/auth/login', [
                'form_params' => [
                    'grant_type' => 'password',
                    'email' => $data['email'],
                    'password' => $data['password']
                ]
            ]);
            
            // var_dump(json_decode($result));
            // var_dump($result);
            dd($result);
        } catch (ClientErrorResponseException $e) {
            $responseBody = $e->getResponse()->getBody(true);
        }
    }
}
