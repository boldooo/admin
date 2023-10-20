<?php

use Illuminate\Support\Facades\Validator;

class Validation extends Eloquent
{

    public static function store($datas = [], $rules = [])
    {

        $validator = Validator::make($datas, $rules);

        if ($validator->fails()) {

            return [
                'boolean' => false,
                'errors' => $validator
            ];

        } else {

            return [
                'boolean' => true
            ];

        }

    }

    public static function updates($id, $datas = [], $rules = [])
    {

        $validator = Validator::make($datas, $rules);

        if ($validator->fails()) {

            return [
                'boolean' => false,
                'errors' => $validator
            ];

        } else {

            return [
                'boolean' => true,
                'last' => $id
            ];

        }

    }

}