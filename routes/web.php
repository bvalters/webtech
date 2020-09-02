<?php

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

Route::get('/lang/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'lv'])) {
        abort(400);
    }

    session()->put('locale', $lang);
    return redirect()->back();

})->name('lang');

Route::get('/', function () {
    if (Auth::check()) return redirect("home");
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'localized']], function () {
    Route::get('/home', 'FileController@index')->name('home');
    Route::post('/upload', 'FileController@store');

    Route::post('/folder/change-order', "FolderController@changeOrder");
    Route::post('/files/delete', "FileController@destroy");

    Route::post('/files/edit/{id}', "FileController@update");

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
    Route::post('/user/delete/{id}', 'UserController@destroy')->name('user.delete');
});

Route::get('/files/download/{ids}', "FileController@download");

