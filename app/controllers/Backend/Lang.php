<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class Lang extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.lang.table')
            ->withItems(\Langs::customOrder());

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.lang.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = \Langs::customStore($params);

        if ($result['boolean']) {

            return Redirect::to('/admin/lang');

        } else {

            Input::flash();

            return Redirect::back()
                ->withErrors($result['report']);

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

        $this->layout->content = View::make('backend.pages.lang.edit')
            ->withItem(\Langs::find($id));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $params = Input::all();

        $result = \Langs::customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('/admin/lang');

        } else {

            Input::flash();

            return Redirect::back()
                ->withErrors($result['report'])
                ->withParams($params);

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
        //
    }


}
