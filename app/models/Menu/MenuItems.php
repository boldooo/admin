<?php

namespace Menu;


class MenuItems extends \Eloquent
{

    protected $table = 'menu_items';

    public static function getMenuByKeyName($key_name = '')
    {

        $menu_id = Menu::where('key_name', $key_name)->pluck('id');

        return static::select('link', 'title', 'id')
            ->whereMenuId($menu_id)
            ->whereParentItemId(0)
            ->orderBy('level', 'asc')
            ->get();

    }

    public function has_child()
    {

        return $this->whereParentItemId($this->id)
            ->first();

    }

    public function get_child()
    {

        return $this->whereParentItemId($this->id)
            ->orderBy('level', 'asc')
            ->get();

    }

}