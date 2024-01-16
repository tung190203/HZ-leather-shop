<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientSideController extends Controller
{
    public function home()
    {
        $banners = Banner::where('type','banner')->get();
        $sliders = Banner::where('type','slider')->limit(4)->get();
        $posters = Banner::where('type','poster')->get();
        $socials = Banner::where('type','social')->get();
        // product
        $status = config('default.product.status.in_stock');
        // $bestSellers =
        $promotions = Product::where('status',$status)->limit(5)->get();
        $newProducts = Product::orderBy('created_at','desc')->limit(5)->get();
        return view('clients.pages.home',compact('banners','sliders','posters','socials','promotions','newProducts'));
    }
    public function profile(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'current_password' => 'nullable|min:6',
                'password' => 'nullable|min:6|confirmed',
                'phone' => 'nullable|digits_between:10,12|unique:users,phone,'.$user->id,
                'address' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg',
                'gender' => 'nullable',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
           
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ];
    
            if ($request->filled('password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng'])->withInput();
                }
                $data['password'] = bcrypt($request->password);
            }
            if($request->filled('gender')){
                $data['gender'] = $request->gender;
            }
            if ($request->filled('phone')) {
                $data['phone'] = $request->phone;
            }
            if ($request->filled('address')) {
                $data['address'] = $request->address;
            }
            if ($request->hasFile('avatar')) {
                $imagePath = $request->file('avatar');
                if ($request->filled('avatar') && $request->file('avatar')->isValid()) {
                    Storage::disk('minio')->delete($user->avatar);
                }
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
                Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
                $data['avatar'] = $imageName;
            }
            $user->update($data);
    
            return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công');
        }
    
        return view('clients.pages.users.profile', compact('user'));
    }
    public function checkout()
    {
        return view('clients.pages.checkout');
    }

    public function contact()
    {
        return view('clients.pages.contact');
    }

}
