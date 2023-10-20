<?php

class PostsInCategory extends Eloquent
{

    protected $table = 'posts_in_category';

    protected $fillable = ['post_id', 'category_id'];

    public static $rules = [
        'post_id' => 'required',
        'category_id' => 'required'
    ];

    public $timestamps = false;

    public static function getAllRowsByPostId($post_id)
    {

        $result = static::select('category_id')
            ->where('post_id', $post_id)
            ->get();

        $array = [];

        foreach ($result as $value) {

            $array[] = $value->category_id;

        }

        return $array;

    }

    public static function customStore($post_id, $category_id = [])
    {

        $insert = [];

        foreach ($category_id as $key => $value) {

            $insert[] = [
                'post_id' => $post_id,
                'category_id' => $value
            ];

        }

        static::where('post_id', $post_id)
            ->delete();

        if (count($insert) > 0)

            static::insert($insert);

        return true;

    }

    public static function deleteByPostId($post_id)
    {

        static::where('post_id', $post_id)
            ->delete();

        return true;

    }

    public static function deleteByCategoryId($category_id)
    {

        static::where('category_id', $category_id)
            ->delete();

        return true;

    }

}