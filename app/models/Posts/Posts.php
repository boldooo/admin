<?php

namespace Posts;

class Posts extends \Eloquent
{

    protected $table = 'posts';

    public static function getActive($select = [], $take = 1)
    {

        return static::select($select)
            ->whereActive(1)
            ->orderBy('id', 'desc')
            ->take($take)
            ->get();

    }

    public static function getByCategoryId($category_id, $take = 20)
    {

        return static::select('posts.id', 'posts.title', 'posts.short_content', 'posts.picture')
            ->leftJoin('posts_in_category', 'posts.id', '=', 'posts_in_category.post_id')
            ->where('posts_in_category.category_id', $category_id)
            ->orderBy('posts.custom_date')
            ->orderBy('posts.id', 'desc')
            ->paginate($take);

    }

}