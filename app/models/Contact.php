<?php

class Contact extends \Eloquent
{

    protected $table = 'contacts';

    protected $fillable = ['facebook', 'twitter', 'youtube', 'phone', 'email', 'website', 'address', 'lang_id'];

    public $timestamps = false;

    public static $rules = [
        'lang_id' => 'required'
    ];

    public function customOrder($take = 20)
    {

        return $this->orderBy('id', 'desc')
            ->paginate($take);

    }

    public function customStore($datas = [])
    {

        $result = Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $result['id'] = $this->create($datas);

        }

        return $result;

    }

    public function customUpdate($id, $datas = [])
    {

        $result = Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

    //

    public static function for_web()
    {

        return static::orderBy('id', 'desc')->first();

    }

}