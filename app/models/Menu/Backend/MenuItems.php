<?php

namespace Menu\Backend;


class MenuItems extends \Eloquent
{

    protected $table = 'menu_items';

    protected $fillable = ['title', 'link', 'picture', 'level', 'menu_id', 'parent_item_id', '_picture'];

    public $timestamps = false;

    public static $rules = [
        'title' => 'required',
        'menu_id' => 'required'
    ];

    public function customOrder($menu_id)
    {

        return $this->select('title', 'link', 'id')
            ->where('parent_item_id', 0)
            ->where('menu_id', $menu_id)
            ->orderBy('level', 'asc')
            ->get();

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

        static::$rules['menu_id'] = '';

        $result = \Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

    public function hasChildren($parent_id = 0)
    {

        return $this->where('parent_item_id', $parent_id)->first();

    }

    public function getChildren($parent_id = 0)
    {

        return $this->where('parent_item_id', $parent_id)
            ->orderBy('level', 'asc')
            ->get();

    }

    public function save_level($datas = [])
    {

        $n = count($datas);

        for ($i = 0; $i < $n; $i++) {

            $result = $this->find($datas[$i]->id);

            $result->level = $i;

            $result->parent_item_id = 0;

            $result->update();

            if (isset($datas[$i]->children)) {

                $this->saveChildren($datas[$i]->children, $datas[$i]->id);

            }

        }

        return true;

    }

    public function saveChildren($data, $parent_id)
    {

        $n = count($data);

        for ($i = 0; $i < $n; $i++) {

            $result = $this->find($data[$i]->id);

            $result->level = $i;

            $result->parent_item_id = $parent_id;

            $result->update();

            if (isset($data[$i]->children)) {

                $this->saveChildren($data[$i]->children, $data[$i]->id);

            }

        }

    }

}