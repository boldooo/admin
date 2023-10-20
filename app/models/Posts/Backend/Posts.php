<?php

namespace Posts\Backend;


class Posts extends \Eloquent
{

    protected $table = 'posts';

    protected $fillable = ['title', 'picture', 'short_content', 'content', 'custom_date', 'lang_id', 'link', 'active', '_picture'];

    public static $rules = [
        'title' => 'required',
        'lang_id' => 'required'
    ];

    public $timestamps = false;

    public function customStore($datas = [])
    {

        $result = \Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $result['last'] = $this->create($datas);

            $category_id = isset($datas['category_id']) ? $datas['category_id'] : [];

            \PostsInCategory::customStore($result['last']->id, $category_id);

        }

        return $result;

    }

    public function customUpdate($id, $datas = [])
    {

        $result = \Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $category_id = isset($datas['category_id']) ? $datas['category_id'] : [];

            \PostsInCategory::customStore($id, $category_id);

            $post_desc_datas = $datas['post_desc_content'];

            unset($datas['category_id']);

            unset($datas['post_desc_content']);

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

    public function customOrder($take = 20, $where = [])
    {

        $result = $this->select('posts.id', 'posts.title', 'posts.picture', 'posts._picture', 'posts.short_content', 'posts.custom_date')
            ->leftJoin('posts_in_category', 'posts.id', '=', 'posts_in_category.post_id');

        if (isset($where['title']) && $where['title'] != '')

            $result = $result->where('posts.title', 'LIKE', '%' . $where['title'] . '%');

        if (isset($where['category_id']) && $where['category_id'] != '')

            $result = $result->where('category_id.category_id', $where['category_id']);

        return $result->groupBy('posts.id')
            ->orderBy('posts.custom_date', 'desc')
            ->orderBy('posts.id', 'desc')
            ->paginate($take);

    }

    public function posts_in_category()
    {

        return $this->select('category.title')
            ->leftJoin('posts_in_category', 'posts.id', '=', 'posts_in_category.post_id')
            ->leftJoin('category', 'posts_in_category.category_id', '=', 'category.id')
            ->where('posts_in_category.post_id', $this->id)
            ->get();

    }

}