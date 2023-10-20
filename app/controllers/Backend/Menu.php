<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Menu\Backend\Menus;

class Menu extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    private $menu;

    public function __construct(Menus $menu)
    {

        $this->menu = $menu;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.menu.table')
            ->withItems($this->menu->customOrder());

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.menu.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->menu->customStore($params);

        if ($result['boolean']) {

            return Redirect::to('admin/menu');

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

        $this->layout->content = View::make('backend.pages.menu.edit')
            ->withItem($this->menu->find($id));

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

        $result = $this->menu->customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('admin/menu');

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

        $this->menu->destroy($id);

        return 'success';

    }


}
