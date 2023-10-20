<?php

class Files extends Eloquent
{

    protected $table = 'files';

    protected $fillable = [
        'title',
        'filename',
        'filetype'
    ];

    public static $rules = [
        'title' => 'required',
        'filename' => 'required',
        'filetype' => 'required'
    ];

    public $timestamps = false;

    public static function customOrder($where = [], $take = 20)
    {

        return static::where($where)
            ->orderBy('id', 'desc')
            ->paginate($take);

    }

    public static function customStore($datas = [])
    {

        $result = Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $result['id'] = static::create($datas);

        }

        return $result;

    }

    public static function customStoreWithFile($datas = [])
    {

        $file = $datas['filename'];

        $datas['filename'] = str_random(15) . '.' . $file->getClientOriginalExtension();

        $result = Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            $destinationPath = public_path() . '/backend/files/';

            $file->move($destinationPath, $datas['filename']);

            $result['id'] = static::create($datas);

        }

        return $result;

    }

    public static function customUpdate($id, $datas = [])
    {

        $result = Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            $lang = static::find($id);

            $lang->title = $datas['title'];

            $lang->filename = $datas['filename'];

            $lang->filetype = $datas['filetype'];

            $lang->save();

        }

        return $result;

    }

    public static function last()
    {

        return static::orderBy('id', 'desc')
            ->first();

    }

}