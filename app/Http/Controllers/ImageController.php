<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


class ImageController extends Controller
{
    public function UploadImage(Request $request){
        $path             =   $request->image_file->storeAs('public/images',$request->image_file->getClientOriginalName());

        $uploadedPath     =   'storage/images'.'/'.$request->image_file->getClientOriginalName();
        $storageDir       =   'storage/images/processed/';

        $img = Image::make($uploadedPath);
        $img->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        //$img->text('This is a example ', 10, 10);

        $img->text($request->image_file->getClientOriginalName(), 10, 10, function($font) {
            $font->color('#f9f9f9');
            $font->align('left');
            // $font->angle(45);
        });

        if(!File::exists($storageDir.'\''.$request->image_file->getClientOriginalName())){
            File::makeDirectory($storageDir, 0755, true, true);
            $img->save($storageDir.$request->text_to_add.'.png',20);            /// Last param for image quality
        }
        //dd('Done!');
        return "Image Processed";
    }
}
