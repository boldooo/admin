<?php


class UserTableSeeder extends Seeder
{

    public function run()
    {

        $datas = [
            [
                'firstname' => 'Shinekhuu',
                'lastname' => 'Myagmarbayar',
                'username' => 'admin',
                'phone' => '96691653',
                'lang_id' => 1,
                'email' => 'm_shinehuu@yahoo.com',
                'password' => Hash::make("admin")
            ],
        ];


        if (\Users\Backend\User::count() == 0) {

            \Users\Backend\User::insert($datas);

        }

    }

}