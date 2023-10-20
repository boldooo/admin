<?php

Route::group(['before' => 'auth|isLogged', 'prefix' => 'admin'], function () {

    Route::resource('dashboard', 'Backend\Dashboard');

    Route::resource('posts', 'Backend\Posts');

    Route::resource('lang', 'Backend\Lang');

    Route::resource('category', 'Backend\Category');

    Route::resource('menu', 'Backend\Menu');
    Route::resource('menu_item', 'Backend\MenuItems');

    Route::resource('contact', 'Backend\Contact');

    Route::resource('users', 'Backend\Users');

    Route::resource('videos', 'Backend\Videos');

    Route::resource('files', 'Backend\Files');

    //

    Route::get('media_show', 'Backend\Media@index');
    Route::any('media/{id}', 'Backend\Media@store');

    Route::post('category_level', 'Backend\Category@save_level');
    Route::post('menu_item_level', 'Backend\MenuItems@save_level');
    Route::get('category_for_menu', 'Backend\Category@for_menu');

    Route::post('get_child', 'Backend\Category@get_child');

});

Route::get('/', 'HomeController@index');

Route::get('/{id}.html', 'HomeController@show');
Route::get('list', 'HomeController@lists');
Route::get('menu_group', 'HomeController@menuGroup');

Route::group(['before' => 'guest'], function () {
    Route::get('sign/system_login', 'SignIn@index');
    Route::post('sign/do_login', 'SignIn@do_login');
});

Route::get('logout', 'SignIn@logout');

Route::get('contact', 'HomeController@contact');
Route::post('send_contact', 'HomeController@send_contact');

Route::get('captcha', 'Captcha@index');