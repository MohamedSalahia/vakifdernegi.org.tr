<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['index', 'socialLinks', 'socialLogin']);

    }// end of __construct

    public function general()
    {
        return view('admin.settings.general');

    }// end of index

    public function store(Request $request)
    {
        //dd($request);
        /*$request->validate([
            'email' => 'sometimes|nullable|email',
        ]);*/

        $requestData = $request->except(['_token', '_method']);

        if ($request->logo) {
            Storage::delete('public/settings/' . setting('logo'));
            $file = $request->file('logo');
            $path = $file->hashName('public/settings');

            $image = Image::make($file);
            Storage::put($path, (string) $image->encode());
            $requestData['logo'] = $request->logo->hashName();
        }

        if ($request->fav_icon) {

            Storage::delete('public/settings/' . setting('fav_icon'));
            $file = $request->file('fav_icon');
            $path = $file->hashName('public/settings');
            //dd($path);
            $image = Image::make($file);
            Storage::put($path, (string) $image->encode());
            $requestData['fav_icon'] = $request->fav_icon->hashName();
        }
        if ($request->banner) {
            if (setting('banner')){
                Storage::delete('public/settings/' . setting('banner'));
            }

            $file = $request->file('banner');
            $path = $file->hashName('public/settings');
            $banner = Image::make($file);
            Storage::put($path, (string) $banner->encode());
            $requestData['banner'] = $request->banner->hashName();
        }
        if ($request->zakat) {
            if (setting('zakat')){
                Storage::delete('public/settings/' . setting('zakat'));
            }

            $file = $request->file('zakat');
            $path = $file->hashName('public/settings');
            $zakat = Image::make($file);
            Storage::put($path, (string) $zakat->encode());
            $requestData['zakat'] = $request->zakat->hashName();
        }

        //dd($requestData);
        setting($requestData)->save();
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }// end of store

}//end of controller


