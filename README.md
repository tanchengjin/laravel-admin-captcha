Laravel-admin Captcha Extension
======

### install
````
composer require tanchengjin/laravel-admin-captcha
````

### configuration
````
'extensions' => [
    't-laravel-admin-captcha' => [
        #是否开启扩展
        'enable' => true,
        #验证码高度
        'height' => 30,
        #宽度
        'width' => 100,
        #验证码字符长度
        'length'=>4
    ],
],
````

### publish language
````
php artisan vendor:publish --provider=tanchengjin\LaravelAdmin\Captcha\CaptchaServiceProvider
````
