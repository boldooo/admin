<?php

class CategoryTableSeeder extends Seeder
{

    public function run()
    {

        $datas = [
            [
                'title' => 'Нийтлэл',
                'key_name' => 'posts',
                'lang_id' => 1
            ],
            [
                'title' => 'Слайдер',
                'key_name' => 'slider',
                'lang_id' => 1
            ],
            [
                'title' => 'Харилцагчид',
                'key_name' => 'partners',
                'lang_id' => 1
            ]
        ];

        if (\Category\Backend\Category::count() == 0)

            \Category\Backend\Category::insert($datas);

    }

}