<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Users\Backend\User;

class Users extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    var $users;

    public function __construct(User $user)
    {

        $this->users = $user;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.users.table')
            ->withItems($this->users->customOrder(Input::get('title'), 20));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.users.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->users->customStore($params);

        if ($result['boolean']) {

            return Redirect::to('admin/users');

        } else {

            Input::flash();

            return Redirect::back()
                ->withErrors($result['errors']);

        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $this->layout->content = View::make('backend.pages.users.edit')
            ->withItem($this->users->find($id));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $params = Input::except('_method', '_token');

        $result = $this->users->customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('admin/users');

        } else {

            return Redirect::back()
                ->withErrors($result['errors']);

        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        $this->users->destroy($id);

        return 'success';

    }


}
