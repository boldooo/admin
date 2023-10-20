<?php

class LangTableSeeder extends Seeder
{

    public function run()
    {

        $datas = [
            [
                "title" => "mn"
            ],
            [
                "title" => "en"
            ],
        ];

        if (Langs::count() == 0)

            Langs::insert($datas);

    }

}