<?php namespace Backend;

use Contact as C;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class Contact extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    private $contact;

    public function __construct(C $contact)
    {

        $this->contact = $contact;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.contact.table')
            ->withItems($this->contact->customOrder());

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $this->layout->content = View::make('backend.pages.contact.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->contact->customStore($params);

        if ($result['boolean']) {

            return Redirect::to('admin/contact');

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

        $this->layout->content = View::make('backend.pages.contact.edit')
            ->withItem($this->contact->find($id));

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

        $this->contact->destroy($id);

        return 'success';

    }


}
