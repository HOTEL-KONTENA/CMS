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
Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'cms'], function(){
    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('/login', 'UACController@login')->name('backend.login');
    Route::post('/login', 'UACController@logging')->name('backend.logging');
    Route::get('/logout', 'UACController@logout')->name('backend.logout');

    // Authed User Only
    Route::group(['middleware' => ['auth']], function(){
        Route::get('/', 'dashboardController@index')->name('backend.dashboard');
        Route::get('/me', 'dashboardController@profile')->name('backend.me');
        Route::any('/me/update-password', 'userController@updatePassword')->name('backend.updatePassword');

        Route::resource('/promotion', 'promotionController', ['names' => [
            'index' 	=> 'backend.promotion.index',
            'create' 	=> 'backend.promotion.create',
            'store' 	=> 'backend.promotion.store',
            'show' 		=> 'backend.promotion.show',
            'edit' 		=> 'backend.promotion.edit',
            'update' 	=> 'backend.promotion.update',
            'destroy' 	=> 'backend.promotion.destroy',
        ]]);

        Route::resource('/article', 'blogController', ['names' => [
            'index' 	=> 'backend.blog.index',
            'create' 	=> 'backend.blog.create',
            'store' 	=> 'backend.blog.store',
            'show' 		=> 'backend.blog.show',
            'edit' 		=> 'backend.blog.edit',
            'update' 	=> 'backend.blog.update',
            'destroy' 	=> 'backend.blog.destroy',
        ]]);
        
        Route::get('/config', 'configController@create')->name('backend.config.create');
        Route::post('/config', 'configController@store')->name('backend.config.store');

        Route::post('/media/uploader/promotion', 'mediaController@uploadImagePromotion')->name('backend.media.upload.promotion');
        Route::post('/media/uploader/article', 'mediaController@uploadImageArticle')->name('backend.media.upload.article');
    });
});
