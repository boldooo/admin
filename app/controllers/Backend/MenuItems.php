<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Menu\Backend\MenuItems as M;

class MenuItems extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    private $menu_item;

    public function __construct(M $menu_item)
    {

        $this->menu_item = $menu_item;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.menu_item.table')
            ->withItems($this->menu_item->customOrder(Input::get('menu_id')));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('backend.pages.menu_item.create')
            ->withMenuId(Input::get('menu_id'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->menu_item->customStore($params);

        if ($result['boolean']) {

            $result['view'] = View::make('backend.pages.menu_item.realtime.add')
                ->withItem($result['last'])
                ->render();

        } else {

            $result['errors'] = $result['errors']->messages();

        }

        return json_encode($result);

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

        return View::make('backend.pages.menu_item.edit')
            ->withItem($this->menu_item->find($id));

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

        $result = $this->menu_item->customUpdate($id, $params);

        if ($result['boolean']) {

            $result['view'] = '';

            $result['title'] = $params['title'];

        } else {

            $result['errors'] = $result['errors']->messages();

        }

        return json_encode($result);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        $this->menu_item->destroy($id);

        return 'success';

    }

    public function save_level()
    {

        $data = json_decode(Input::get('data'));

        $this->menu_item->save_level($data);

        return 'success';

    }


}
