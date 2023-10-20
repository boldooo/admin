<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class Videos extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.videos.table')
            ->withItems(\Files::customOrder(['filetype' => 'video']));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.videos.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = \Files::customStore($params);

        if ($result['boolean']) {

            return Redirect::to('/admin/videos');

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

        $this->layout->content = View::make('backend.pages.videos.edit')
            ->withItem(\Files::find($id));

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

        $result = \Files::customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('/admin/videos');

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

        Files::destroy($id);

        return 'success';

    }


}
