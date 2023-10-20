<?php

class MenuTableSeeder extends Seeder
{

    public function run()
    {

        $datas = [
            [
                'title' => 'Үндсэн цэс',
                'key_name' => 'basic_menu',
                'lang_id' => 1
            ]
        ];

        if (\Menu\Backend\Menus::count() == 0)

            \Menu\Backend\Menus::insert($datas);

    }

}