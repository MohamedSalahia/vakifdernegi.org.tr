<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function getImage($width, $height, $quality, $file_path)
    {
        //dd($file_path);
        ($width == 0 ? $width = null : '');
        ($height == 0 ? $height = null : '');
        ($quality == 0 ? $quality = 1 : '');

        $file_path = str_replace("storage/","",$file_path);
        $file_path = '../storage/app/public/'.$file_path;
        $file_name = substr($file_path, strrpos($file_path, '/') + 1);
        $file_name_without_format = substr($file_name, 0, strpos($file_name, '.'));
        $file_name_without_format = $file_name_without_format.'.webp';

        //dd($file_name_without_format);
        $thumbnail_name = $width.'_'.$height.'_'.$quality.'_'.$file_name_without_format;

        //dd($thumbnail_name);
        $cache_path = '../storage/app/public/cache/';

        // If file exist
        if(File::isFile($cache_path.$thumbnail_name)){
            $img = \Intervention\Image\ImageManagerStatic::make($cache_path.$thumbnail_name)->encode('webp', 80);
            return $img->response('webp', $quality);
        }

        // Create the output directory if it doesn't exist yet
        if (!File::isDirectory($cache_path)) {
            File::makeDirectory($cache_path);
        }

        // If file not exist
        if(!File::isFile($file_path)){
            $file_path = 'progiom_cp/assets/img/default_image.png';
            $file_name = substr($file_path, strrpos($file_path, '/') + 1);
            $file_name_without_format = substr($file_path, strrpos($file_path, '/') + 1, '4');

            $thumbnail_name = $width.'_'.$height.'_'.$quality.'_'.$file_name_without_format;
        }

        if($width && $height){
            $img = Image::make($file_path)->encode('webp', 80)->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }else{
            $img = Image::make($file_path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $img->save($cache_path.$thumbnail_name, $quality);
        //$img->destroy();
        //return $img;
        return $img->response('webp', $quality);

    }
}
