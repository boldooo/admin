<?php

namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class Files extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.files.table')
            ->withItems(\Files::customOrder(['filetype' => 'other']));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.files.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = \Files::customStoreWithFile($params);

        if ($result['boolean']) {

            return Redirect::to('admin/files');

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

        $this->layout->content = View::make('backend.pages.files.edit')
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

        $params = Input::except('_method', '_token', 'have');

        $result = $this->contact->customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('admin/contact');

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

        $item = \Files::find($id);

        unlink(public_path() . '/backend/files/' . $item->filename);

        $item->delete();

        return 'success';

    }


}
