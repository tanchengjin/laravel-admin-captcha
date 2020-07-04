<?php

namespace tanchengjin\LaravelAdmin\Captcha\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use tanchengjin\captcha\Captcha;

class CaptchaController extends Controller
{
    public function login()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        ob_end_clean();
        return view('laravel-admin-captcha::index');

    }

    #review login logic
    public function postLogin(Request $request)
    {
        $this->loginValidate($request->all())->validate();

        if (!Captcha::verify($request->get('code'))) {
            return back()->withInput()->withErrors([
                'code' => Lang::has('captcha.error') ? trans('captcha.error') : 'captcha error please try again'
            ]);
        }

        $credentials = $request->only([$this->getUserName(), 'password']);

        $remember = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->getUserName() => $this->getFailedLoginMessage()
        ]);
    }

    protected function loginValidate(array $data)
    {
        return Validator::make($data, [
            $this->getUserName() => 'required',
            'password' => 'required',
            'code' => 'required'
        ]);
    }

    protected function getFailedLoginMessage()
    {
        return 'login  error';
    }

    protected function sendLoginResponse(Request $request)
    {
        admin_toastr('login successfully');
        $request->session()->regenerate();
        return redirect()->intended($this->redirectPath());
    }

    public function getUserName()
    {
        return 'username';
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('admin.route.prefix');
    }
}
