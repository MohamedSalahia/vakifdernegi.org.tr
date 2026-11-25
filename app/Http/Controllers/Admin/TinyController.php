<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TinyController extends Controller
{
    public function uploadImage(Request $request)
    {

        $imgpath = $request->file('file')->store('tiny_images', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }
    public function uppyImage(Request $request)
    {
        /*dd($request->files);
        if ($request->files) {

            Image::make($request->files)
                ->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/blog_images/' . $request->files->hashName()));

            $request_data['image'] = $request->name->hashName();

            dd($request_data);

        }//end of if*/

        $uppy_images = $request->file('uppy_files');

        //dd($uppy_images[0]);
        $imgpath = $uppy_images[0]->store('uppy_images', 'public');
        //dd($imgpath);
        return response()->json(['location' => "/public/uploads/$imgpath"]);
    }
}
