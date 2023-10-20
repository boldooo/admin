<?php

namespace Category;


class Category extends \Eloquent
{

    protected $table = 'category';

    public static function getByKeyName($key_name)
    {

        return static::whereKeyName($key_name)
            ->select('id', 'title', 'picture', 'link')
            ->first();

    }

    public static function getSubsByKeyName($key_name, $take = '')
    {

        $id = static::whereKeyName($key_name)
            ->pluck('id');

        $result = static::whereParentId($id)
            ->select('id', 'title', 'picture', 'link', 'content')
            ->orderBy('level', 'asc');

        if ($take != '')

            return $result->take($take)
                ->get();

        return $result->get();

    }

    public function get_posts($take = 4)
    {

        return $this->hasMany('\PostsInCategory', 'category_id', 'id')
            ->leftJoin('posts', 'posts_in_category.post_id', '=', 'posts.id')
            ->select('posts.title', 'posts.id', 'posts.picture', 'posts.short_content', 'posts.custom_date')
            ->orderBy('custom_date', 'asc')
            ->orderBy('id', 'desc')
            ->take($take)
            ->get();

    }

    public static function getPostsByCategoryId($where = [], $take = 40)
    {

        $title = isset($where['title']) ? $where['title'] : '';

        if ($where['category_id'] == 0)

            return [];

        $result = static::leftJoin('posts_in_category', 'category.id', '=', 'posts_in_category.category_id')
            ->leftJoin('posts', 'posts_in_category.post_id', '=', 'posts.id')
            ->where('posts_in_category.category_id', $where['category_id'])
            ->where('posts.title', 'LIKE', '%' . $title . '%')
            ->select('posts.title', 'posts.id', 'posts.short_content', 'posts.picture', 'posts.old_price', 'posts.price');

        if ($where['size_id'] != '')

            return $result->where('posts.size_id', $where['size_id'])
                ->orderBy('posts.title', 'asc')
                ->paginate($take);

        return $result->orderBy('posts.title', 'asc')
            ->paginate($take);


    }

    public static function getActive($take = 20)
    {

        return static::select('id', 'title', 'picture')
            ->where('active', 1)
            ->orderBy('level', 'asc')
            ->take($take)
            ->get();
    }

    public function getSubCategory()
    {

        return $this->select('id', 'title')
            ->whereParentId($this->id)
            ->orderBy('level', 'asc')
            ->get();

    }

}