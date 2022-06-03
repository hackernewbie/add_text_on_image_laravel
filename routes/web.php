<?php

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('upload', function (Request $request) {
    $path             =   $request->image_file->storeAs('public/images',$request->image_file->getClientOriginalName());
    $uploadedPath     =   asset('/storage/images').'/'.$request->image_file->getClientOriginalName();

    $img = Image::make($uploadedPath)->resize(300, 200);
    //$img->text('This is a example ', 120, 100);
    //$img->save(public_path($path));
    //$img->save('public/images/updated');
    //return $img->response('jpg');
    dd($img->response('jpg'));
})->name('upload.image');

// Route::get('image', function() {
//     $img = Image::make('foo.jpg')->resize(300, 200);
//     return $img->response('jpg');
// });
