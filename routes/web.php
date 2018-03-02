<?php

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
Route::get('/', function(){
    return redirect(str_random(10));
});
Route::get('{name}/html', function(){
	return cache()->get(request()->route('name'),'Nothing found');
});
Route::get('{name}/image', function(){
        return SnappyImage::loadFile(url(request()->route('name')).'/html')->download(request()->route('name').'.jpg');
});
Route::get('{name}/pdf', function(){
	return PDF::loadFile(url(request()->route('name')).'/html')->download(request()->route('name').'.pdf');
});
Route::get('{name}', function () {
    return view('welcome');
});

Route::post('{name}', function(){
    cache()->forever(request()->route('name'), request('text'));
});
