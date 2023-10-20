<?php namespace Backend;

use Category\Backend\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Posts\Backend\Posts as P;
use PostsInCategory;

class Posts extends \BaseController
{

    protected $layout = 'backend.layout.layout';

    private $posts;

    public function __construct(P $posts)
    {

        $this->posts = $posts;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->layout->content = View::make('backend.pages.posts.table')
            ->withCategories(Category::getSubsByKeyName('posts'))
            ->withItems($this->posts->customOrder(20, Input::except('page')));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $parent = Category::findByKeyName('posts');

        $this->layout->content = View::make('backend.pages.posts.create')
            ->withPostDesc(Category::getSubsByKeyName('post_desc'))
            ->withCategory(Category::customOrder(['id', 'title'], $parent->id));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $params = Input::all();

        $result = $this->posts->customStore($params);

        if ($result['boolean']) {

            return Redirect::to('admin/posts');

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

        $result = $this->posts->customOrder(20, Input::get('name'));

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

        $parent = Category::findByKeyName('posts');

        $this->layout->content = View::make('backend.pages.posts.edit')
            ->withPostDesc(Category::getSubsByKeyName('post_desc'))
            ->withCategory(Category::customOrder(['id', 'title', 'parent_id'], $parent->id))
            ->withHasPostsInCategory(PostsInCategory::getAllRowsByPostId($id))
            ->withItem($this->posts->find($id));

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

        $result = $this->posts->customUpdate($id, $params);

        if ($result['boolean']) {

            return Redirect::to('admin/posts');

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

        $this->posts->destroy($id);

        return 'success';

    }


}
