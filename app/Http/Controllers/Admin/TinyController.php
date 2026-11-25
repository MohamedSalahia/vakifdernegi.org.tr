<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $imgpath = $request->file('file')->store('tiny_images', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }

    public function uppyImage(Request $request)
    {
        $request->validate([
            'uppy_files' => 'required|array|min:1',
            'uppy_files.*' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $uppy_images = $request->file('uppy_files');
        $imgpath = $uppy_images[0]->store('uppy_images', 'public');
        return response()->json(['location' => "/public/uploads/$imgpath"]);
    }
}
