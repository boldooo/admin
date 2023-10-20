<?php namespace Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Category\Backend\Category as C;

class Category extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    private $category;

    public function __construct(C $category)
    {

        $this->category = $category;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $parent = C::findByKeyName(Input::get('key_name'));

        $parent_id = ($parent) ? $parent->id : 0;

        $this->layout->content = View::make('backend.pages.category.table')
            ->withParent($parent)
            ->withItems(C::customOrder(['id', 'title'], $parent_id, '', false));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('backend.pages.category.create')
            ->withParentId(Input::get('parent_id'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->category->customStore($params);

        if ($result['boolean']) {

            $result['view'] = View::make('backend.pages.category.realtime.add')
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

        if (Input::get('parent_id') == 0) {

            $parent_id = \Category\Backend\Category::findByKeyName('posts')->id;

        } else {

            $parent_id = Input::get('parent_id');

        }

        $result = $this->category->customOrder(['id', 'title'], $parent_id, Input::get('name'), 20);

        return Response::json($result);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        return View::make('backend.pages.category.edit')
            ->withItem($this->category->find($id));

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

        $result = $this->category->customUpdate($id, $params);

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

        if ($this->category->find($id)->key_name != '') {

            return 'failed';

        }

        $this->category->destroy($id);

        return 'success';

    }

    public function save_level()
    {

        $data = json_decode(Input::get('data'));

        $this->category->save_level($data, Input::get('parent_id'));

        return 'success';

    }


    public function get_child()
    {

        $have = Input::get('have') != '' ? Input::get('have') : [];

        return View::make('backend.pages.category.realtime.child_for_posts')
            ->withHasPostsInCategory($have)
            ->withCategory(C::customOrder(['title', 'id'], Input::get('parent_id')));

    }

    public function _children()
    {

        return json_encode($this->category->getChildren(Input::get('parent_id')));

    }

    // menu deer ashiglasan

    public function for_menu()
    {

        if ($this->category->hasChildren(Input::get('parent_id')))

            return View::make('backend.pages.category.realtime.for_menu')
                ->withParentId(Input::get('parent_id'));

        else

            return '';

    }

}
