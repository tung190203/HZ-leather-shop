<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AdminBannerController extends Controller{
    public function banner()
    {
        $banners = Banner::where('type','banner')->paginate(5);
        $sliders = Banner::where('type','slider')->get();
        $posters = Banner::where('type','poster')->get();
        $socials = Banner::where('type','social')->get();
        return view('admin.pages.banners.banner',compact('banners','sliders','posters','socials'));
    }
    public function createBanner(Request $request, Banner $banner)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'images' => 'required|image|mimes:jpeg,png,jpg',
                'type'=> 'required',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $imagePath = $request->file('images');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();

            // Lưu ảnh lên MinIO
            Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
            $banner = new Banner([
                'image' => $imageName,
                'type' => $request->type,
            ]);
            $banner->save();
            return redirect()->route('admin.banner.create')->with('success', 'Create banner success');
        }
        return view('admin.pages.banners.create');
    }
    public function detailBanner(Request $request, Banner $banner)
    {
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'image' => 'sometimes|image|mimes:jpeg,png,jpg',
                'type'=> 'required',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image');
                if ($banner->image) {
                    Storage::disk('minio')->delete($banner->image);
                }
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
                Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
                $banner->image = $imageName;
            }
            $banner->type = $request->type;
            $banner->save();
            return redirect()->route('admin.banner.detail', $banner->id)->with('success', 'Update banner success');
        }
        return view('admin.pages.banners.detail', compact('banner'));
    }
    public function deleteBanner(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('minio')->delete($banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banner')->with('success', 'Delete banner success');
    }
}

?>