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

Route::get('{note}/html', function(\App\Note $note){
	return $note->content;
});

Route::get('{note}/image', function(\App\Note $note){
        return $note->exists ?  SnappyImage::loadHTML($note->content)->download(request()->route('name').'.jpg') : 'Note does not exists yet';
});

Route::get('{note}/mail', function(\App\Note $note){
    $note->exists && $note->sendMail(request()->get('mail'));

	return back();
});

Route::get('{note}/pdf', function(\App\Note $note){
	return $note->exists ? PDF::loadHTML($note->content)->download(request()->route('name').'.pdf'): 'Note does note exists yet';
});

Route::get('{note}', function (\App\Note $note) {
    return view('welcome');
});

Route::post('{note}', function (\App\Note $note) {
    $note->content = request('text');
    $note->save();
});

Route::post('ajax/store', function(){
    with(new \App\Note)->appends(request('key'),request('value'));
});
