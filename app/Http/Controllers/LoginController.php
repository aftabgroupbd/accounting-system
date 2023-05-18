<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // login view 
    public function index()
    {
        try {
            return view('login');
        } catch (\Exception $e) {
            echo 'Some thing wrong!';
        }
    }
    // login logic 
    public function loginSubmit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'email'     => 'required|email|exists:users,email',
                'password'  => 'required|string|max:20'
            ]);

            if($validator->passes())
            {
                $user   = User::where('email',$request->email)->first();
                if($user != false){
                    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                        return response()->json(array('error' => false,'check' => false, 'message' => 'Successfully logged in.','url'=>route('dashboard'))); 
                    }
                    return response()->json(array('error' => true,'check' => true, 'message' => array('password' => 'Invalid Password!')));
                }else{
                    return response()->json(array('error' => true,'check' => false, 'message' => 'Invalid email address!'));
                }
            }else{
                return response()->json(array('error' => true,'check' => true, 'message' => $validator->errors()->getMessages()));
            }
        } catch (\Exception $e) {
            return response()->json(array('error' => true,'check' => false, 'message' => 'Something wrong!'));
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }
}
