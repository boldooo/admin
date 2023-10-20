<?php

class SignIn extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return View::make('front.sign.in');

    }

    public function do_login()
    {

        if (Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password')])) {

            return Redirect::to('admin/dashboard');

        } else {

            return Redirect::back()
                ->withInput()
                ->withErrors('Нэвтрэх нэр болон нууц үг буруу байна');

        }

    }

    public function logout()
    {

        Auth::logout();

        return Redirect::to('sign/system_login');

    }


}
