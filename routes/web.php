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

function r_loop($r){
    $s = $r * 4;
}

Route::get('peak', function(){
    for($r = 0; $r < 1000000 ; $r++){
        // $r * 4;
        // unset(${'s_'.$r});
    }
    echo ceil(memory_get_peak_usage() / (1024*1024)) ."MB";
});
Route::get('{name}', function () {
    return view('welcome');
});

Route::post('{name}', function(){
    cache()->forever(request()->route('name'), request('text'));
});
