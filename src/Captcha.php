<?php


namespace tanchengjin\LaravelAdmin\Captcha;


use Encore\Admin\Extension;

class Captcha extends Extension
{
    public $name = 'captcha';

    public $views = __DIR__ . '/../resources/views';

    public $assets = __DIR__ . '/../resources/assets';

    public $menu = [
        'title' => 'title',
        'path' => 'captcha',
        'icon' => 'fa-gears'
    ];
}
