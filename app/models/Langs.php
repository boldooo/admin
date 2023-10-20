<?php

class Langs extends Eloquent
{

    protected $table = 'lang';

    protected $fillable = ['title', 'picture'];

    public static $rules = [
        'title' => 'required|unique:lang',
        'picture' => ''
    ];

    public $timestamps = false;

    public static function customStore($datas = [])
    {

        $result = Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $result['id'] = static::create($datas);

        }

        return $result;

    }

    public static function customUpdate($id, $datas = [])
    {

        static::$rules['title'] = 'required|unique:lang,title,' . $id;

        $result = Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $lang = static::find($id);

            $lang->title = $datas['title'];

            $lang->save();

        }

        return $result;

    }

    public static function customOrder()
    {

        return static::orderBy('id', 'desc')
            ->paginate(20);

    }

}