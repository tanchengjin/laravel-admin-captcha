<?php
Route::get('auth/login', 'tanchengjin\LaravelAdmin\Captcha\Http\Controllers\CaptchaController@login');
Route::post('auth/login', 'tanchengjin\LaravelAdmin\Captcha\Http\Controllers\CaptchaController@postLogin');
Route::get('captcha', 'tanchengjin\LaravelAdmin\Captcha\Http\Controllers\CaptchaController@getCaptcha');
