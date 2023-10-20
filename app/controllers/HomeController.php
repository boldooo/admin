<?php

use Illuminate\Support;

class HomeController extends BaseController
{

    protected $layout = 'front.layouts.home';

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@index');
    |
    */

    public function index()
    {

        $this->get_consts();

        $this->layout->slider = false;

        $this->layout->content = View::make('front.pages.home')
            ->withSliders(\Category\Category::getSubsByKeyName('slider'));

    }

    public function show($id)
    {

        $this->get_consts();

        $this->layout->content = View::make('front.pages.show')
            ->withNews(\Category\Category::getByKeyName('news'))
            ->withItem(\Posts\Posts::find($id));

    }

    public function lists()
    {

        $this->get_consts();

        $this->layout->content = View::make('front.pages.lists')
            ->withNews(\Category\Category::getByKeyName('news'))
            ->withCategory(\Category\Category::find(Input::get('category_id')))
            ->withItems(\Category\Category::getPostsByCategoryId(Input::only('category_id', 'title'), 10));

    }

    public function get_consts()
    {

        $this->layout->menu = \Menu\MenuItems::getMenuByKeyName('basic_menu');

        $this->layout->menu_links = \Menu\MenuItems::getMenuByKeyName('links');

        $this->layout->contact = Contact::for_web();

        $this->layout->partner = \Category\Category::getByKeyName('partners');

        $this->layout->partners = \Category\Category::getSubsByKeyName('partners');

        $this->layout->slider = false;

    }

    public function contact()
    {

        $this->get_consts();

        $this->layout->content = View::make('front.pages.contact')
            ->withNews(\Category\Category::getByKeyName('news'));

    }

    public function send_contact()
    {

        if (Session::get('super-assist') == Input::get('answer')) {

            $input = Input::only('email', 'subject', 'message');

            $d['m'] = $input['message'];
            $d['e'] = $input['email'];
            Mail::send('front.contents.mail.body', $d, function ($message) use ($input) {
                $message->to('info@super-assist.com', $input['subject'])->subject($input['subject']);
            });

            return Redirect::back()
                ->withErrors('Амжилттай илгээгдлээ');

        } else {

            return Redirect::back()
                ->withInput()
                ->withErrors('Капча буруу байна дахин шалгана уу');

        }

    }

}