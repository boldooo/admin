<?php

namespace Category\Backend;

class Category extends \Eloquent
{

    protected $table = 'category';

    protected $fillable = ['title', 'picture', 'key_name', 'content', 'link', 'level', 'lang_id', 'parent_id', 'active', '_picture', 'short_content'];

    public static $rules = [
        'title' => 'required',
        'lang_id' => 'required',
        'key_name' => 'unique:category'
    ];

    public $timestamps = false;

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

        static::$rules['key_name'] = 'unique:category,key_name,' . $id;

        $result = \Validation::updates($id, $datas, static::$rules);

        $datas['active'] = isset($datas['active']) ? $datas['active'] : 0;

        if ($result['boolean']) {

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

    public static function customOrder($select = [], $parent_id = 0, $title = '', $take = false)
    {

        $result = static::where('title', 'LIKE', '%' . $title . '%')
            ->where('parent_id', $parent_id);

        if (!empty($select)) {

            $result = $result->select($select);

        }

        if ($take) {

            return $result->orderBy('level', 'asc')
                ->paginate($take);

        }

        return $result->orderBy('level', 'asc')
            ->get();

    }

    public static function findByKeyName($key_name)
    {

        if ($key_name != '')

            return static::whereKeyName($key_name)->first();

        else

            return 0;

    }

    public static function getSubsByKeyName($key_name, $take = '')
    {

        $id = static::whereKeyName($key_name)
            ->pluck('id');

        $result = static::whereParentId($id)
            ->select('id', 'title', 'picture', '_picture', 'link', 'short_content')
            ->orderBy('level', 'asc');

        if ($take != '')

            return $result->take($take)
                ->get();

        return $result->get();

    }

    public function hasChildren($parent_id = 0, $in_where = [])
    {

        $result = $this->where('parent_id', $parent_id);

        if (count($in_where) > 0)
            $result->whereIn('id', $in_where);

        return $result->first();

    }

    public function getChildren($parent_id = 0)
    {

        return $this->where('parent_id', $parent_id)
            ->select('id', 'title', 'parent_id')
            ->orderBy('level', 'asc')
            ->get();

    }

    public function save_level($datas = [], $parent_id = 0)
    {

        $n = count($datas);

        for ($i = 0; $i < $n; $i++) {

            $result = $this->select('id', 'title', 'parent_id')->where('id', $datas[$i]->id)->first();

            $result->level = $i;

            $result->parent_id = ($parent_id == 0) ? 0 : $parent_id;

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

            $result = $this->select('id', 'title', 'parent_id')->where('id', $data[$i]->id)->first();

            $result->level = $i;

            $result->parent_id = $parent_id;

            $result->update();

            if (isset($data[$i]->children)) {

                $this->saveChildren($data[$i]->children, $data[$i]->id);

            }

        }

    }

    public function getPostDesc()
    {

        return $this->hasOne('\PostDesc', 'category_id', 'id');

    }

}