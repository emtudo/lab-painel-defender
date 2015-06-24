<?php
Route::get('', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');
