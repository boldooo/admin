<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use UploadHandler;

class Media extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return View::make('backend.pages.media.table')
            ->withFolder(Input::get('folder'))
            ->withEditor(Input::get('editor'))
            ->render();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($folder)
    {

        $folder = (Input::get('folder') != '') ? Input::get('folder') : 'pictures';

        $upload_handler = new UploadHandler(null, true, null, $folder);

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
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
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
