<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
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
                if (Auth::user()->role != 'admin') {
                    Auth::logout();
                    return redirect()->back()->withErrors(['error' => 'User does not have sufficient rights'])->withInput();
                }
                $user = Auth::user();
                return redirect()->route('admin.dashboard', compact('user'));
            } else {
                return redirect()->back()->withErrors(['error' => 'Email or password is wrong'])->withInput();
            }
        }
        return view('admin.pages.un-auth.login',);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
