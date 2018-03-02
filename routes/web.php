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
	return with(new \App\Note)->get(request()->route('name'));
});

Route::get('{name}/image', function(){
        return SnappyImage::loadFile(url(request()->route('name')).'/html')->download(request()->route('name').'.jpg');
});

Route::get('{name}/mail', function(){
	rescue(function(){
        Mail::send('mail', ['content'=>with(new \App\Note)->get(request()->route('name'))], function($m){
            $m->from('noreply@pdfpub.com','PDFPUB.com');
            $m->to(request()->get('mail'))->subject('Note about '.request()->route('name'));
        });
    });	
	return back();
});

Route::get('{name}/pdf', function(){
	return PDF::loadFile(url(request()->route('name')).'/html')->download(request()->route('name').'.pdf');
});

Route::get('{name}', function () {
    return view('welcome');
});

Route::post('{name}', function(){
    with(new \App\Note)->set(request()->route('name'),request('text'));
});
