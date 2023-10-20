<?php

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        Eloquent::unguard();
        $this->call('LangTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('MenuTableSeeder');
        $this->call('CategoryTableSeeder');
        
    }

}