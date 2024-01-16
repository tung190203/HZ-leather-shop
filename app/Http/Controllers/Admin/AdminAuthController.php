<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function user()
    {
        $user = Auth::id();
        $users = User::whereNotIn('id',[$user])->paginate(10);
        return view('admin.pages.users.user', compact('users'));
    }
    public function createUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string'
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->email = $request->email;
            
            try {
                $user->save();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Something went wrong'])->withInput();
            }
            return redirect()->route('admin.user',compact('user'))->with('success', 'User created successfully');
        }
        return view('admin.pages.users.create');
    }
    public function detailUser(Request $request, User $user)
    {
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'role' => 'required|string'
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->role = $request->input('role');
            try {
                $user->save();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Something went wrong'])->withInput();
            }
            return redirect()->route('admin.user.detail',compact('user'))->with('success', 'User updated successfully');
        }
        return view('admin.pages.users.detail', compact('user'));
    }
    public function deleteUser(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong'])->withInput();
        }
        return redirect()->route('admin.user')->with('success', 'User deleted successfully');
    }
}
