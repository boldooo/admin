<?php

namespace Menu;


class Menu extends \Eloquent
{

    protected $table = 'menus';

    public static function getByKeyName($key_name)
    {

        return static::whereKeyName($key_name)->first();

    }

    public function getMenuItems()
    {

        return $this->hasMany('\Menu\MenuItems', 'menu_id', 'id')
            ->where('parent_item_id', 0)
            ->get();

    }

}