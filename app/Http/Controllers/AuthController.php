<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }//end __construct()


    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_email'    => 'required|email',
                'password' => 'required|string|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }//end login()


    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'surname' => 'required|string',
                'patronymic' => 'required|string',
                'user_phone' => 'required|string',
                'name'     => 'required|string|between:2,100',
                'user_email'    => 'required|email|unique:users',
                'user_password' => 'required|between:6,255|confirmed',
                'user_phone' => 'required|string',
                'date_of_birth' => 'required|string',
                //'partner_id' => 'required|string',
                //'user_hash' => 'string',
                //'reg_date' => 'required|string',   
                //'region_id' => 'string',
                //'user_ip' => 'string',
                //'referral_id' => 'string', 
                //'facebook_link' => 'string',
                //'user_skype' => 'string',
                //'utm_parametrs' => 'string',        
                //'user_active' => 'string',       
                                                                             
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $user = User::create(
            array_merge(
                $validator->validated(),
                ['user_password' => bcrypt($request->user_password)]
            )
        );

        return response()->json(['message' => 'User created successfully', 'user' => $user]);

    }//end register()


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);

    }//end logout()


    public function profile()
    {
        return response()->json($this->guard()->user());

    }//end profile()


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refresh()


    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
            ]
        );

    }//end respondWithToken()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()


}//end class
