<?php

namespace Menu\Backend;


class Menus extends \Eloquent
{

    protected $table = 'menus';

    protected $fillable = ['title', 'key_name', 'lang_id'];

    public $timestamps = false;

    public static $rules = [
        'title' => 'required|unique:menus',
        'key_name' => 'required|unique:menus',
        'lang_id' => 'required'
    ];

    public function customOrder($take = 20)
    {

        return $this->orderBy('id', 'desc')->paginate($take);

    }

    public function customStore($datas = [])
    {

        $result = \Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $result['last'] = $this->create($datas);

        }

        return $result;

    }

    public function customUpdate($id, $datas = [])
    {

        static::$rules['title'] .= ',title,' . $id;

        static::$rules['key_name'] .= ',key_name,' . $id;

        $result = \Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

}