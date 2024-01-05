<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6'
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user = Auth::user();
                    return redirect()->route('client.home',compact('user') );
                } else {
                    return redirect()->back()->withErrors(['messages' => 'Email hoặc mật khẩu không đúng'])->withInput();
                }
            
        }
        return view('clients.pages.un-auth.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('client.home');
    }
    public function register(Request $request)
    {
       if($request->isMethod('post')){
           $validator = Validator::make($request->all(),[
               'first_name' => 'required|string',
               'last_name' => 'required|string',
               'email' => 'required|email|unique:users,email',
               'password' => 'required|string|min:6',
               'password_confirmation' => 'required|same:password'
           ]);
           try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
               $user = new User();
               $user->first_name = $request->first_name;
               $user->last_name = $request->last_name;
               $user->email = $request->email;
               $user->password = bcrypt($request->password);
               $user->save();
               return redirect()->route('client.login')->with('success','Đăng ký thành công');
        }
        return view('clients.pages.un-auth.register');
    }
    public function forgot(Request $request)
    {
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'email' => 'required|email'
            ]);
            if(!$validator->fails()){
                $user = User::where('email',$request->email)->first();
                if($user){
                    $token = Str::random(60);
                    $user->remember_token = $token;
                    $user->save();
                    Mail::to($user->email)->send(new ForgotPassword($user));
                    return redirect()->route('client.login')->with('success','Vui lòng kiểm tra email để lấy lại mật khẩu');
                }
                return redirect()->back()->withErrors(['messages' => 'Email không tồn tại'])->withInput();
            }
        }
        return view('clients.pages.un-auth.forgot');
    }

    
}

