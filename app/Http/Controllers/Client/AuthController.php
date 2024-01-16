<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAccount;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

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
                if (Auth::user()->status == config('default.user.status.unverify')) {
                    Auth::logout();
                    return redirect()->back()->withErrors(['error' => 'Tài khoản chưa được xác nhận'])->withInput();
                }
                $user = Auth::user();
                return redirect()->route('client.home', compact('user'));
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
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
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
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->code = $code;
            $user->status = config('default.user.status.unverify');
            $user->save();
            Mail::to($user->email)->send(new ConfirmAccount($user, $code));
            return redirect()->route('client.verify')->with('success', 'Vui lòng kiểm tra email để xác nhận tài khoản');
        }
        return view('clients.pages.un-auth.register');
    }
    public function forgot(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);
            if (!$validator->fails()) {
                $user = User::where('email', $request->email)->first();
                $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                if ($user) {
                    $user->code = $code;
                    $user->save();
                    Mail::to($user->email)->send(new ForgotPassword($user, $code));
                    return redirect()->route('client.verify')->with('success', 'Vui lòng kiểm tra email để lấy lại mật khẩu');
                }
                return redirect()->back()->withErrors(['error' => 'Email không tồn tại'])->withInput();
            }
        }
        return view('clients.pages.un-auth.forgot');
    }


    public function verify(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'code.*' => 'required',
            ]);
            if (!$validator->fails()) {
                $requestCode = implode('', $request->input('code'));
                $user = User::where('code', $requestCode)->first();
                if ($user) {
                    if ($user->status == config('default.user.status.verify')) {
                        Cache::put('code', $user->code, now()->addMinutes(5));
                        return redirect()->route('client.change.password')->with('info', 'Vui lòng đổi mật khẩu để tiếp tục sử dụng');
                    } else {
                        $user->status = config('default.user.status.verify');
                        $user->code = null;
                        $user->save();
                    }
                    return redirect()->route('client.login')->with('success', 'Xác nhận tài khoản thành công');
                }
                return redirect()->back()->withErrors(['error' => 'Code không tồn tại'])->withInput();
            }
        }
        return view('clients.pages.un-auth.verify');
    }
    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password'
            ]);
            if (!$validator->fails()) {
                $code = Cache::get('code');
                if (!$code) {
                    return redirect()->route('client.change.password')->withErrors(['error' => 'Code không tồn tại'])->withInput();
                }
                $user = User::where('code', $code)->first();
                if ($user) {
                    $user->password = bcrypt($request->input('password'));
                    $user->code = null;
                    $user->save();
                    return redirect()->route('client.login')->with('success', 'Đổi mật khẩu thành công');
                }
                return redirect()->back()->withErrors(['error' => 'Code không tồn tại'])->withInput();
            }
        }
        return view('clients.pages.un-auth.change-password',);
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect()->route('client.login')->withErrors(['error' => 'Đăng nhập bằng Facebook thất bại']);
        }
        $user = User::where('email', $facebookUser->getEmail())->first();

        if (!$user) {
            $fullName = explode(' ', $facebookUser->getName(), 2);
            $user = User::create([
                'first_name' => $fullName[0],
                'last_name' => isset($fullName[1]) ? $fullName[1] : '',
                'email' => $facebookUser->getEmail(),
                'password' => bcrypt('randompassword'),
                'status' => config('default.user.status.verify')
            ]);
        }
        Auth::login($user);
        return redirect()->route('client.home');
    }
}
