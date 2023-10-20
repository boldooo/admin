<?php

namespace Users\Backend;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Hash;


class User extends \Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    protected $table = 'users';

    protected $fillable = ['lang_id', 'firstname', 'lastname', 'username', 'email', 'password', 'password_confirmation', 'phone', 'active'];

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;

    public static $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required',
        'password_confirmation' => 'required|min:6|same:password'
    ];

    public function customOrder($title = '', $take = 20)
    {

        return $this->where('firstname', 'LIKE', '%' . $title . '%')
            ->orWhere('lastname', 'LIKE', '%' . $title . '%')
            ->orWhere('username', 'LIKE', '%' . $title . '%')
            ->orWhere('email', 'LIKE', '%' . $title . '%')
            ->orWhere('phone', 'LIKE', '%' . $title . '%')
            ->orderBy('id', 'desc')
            ->paginate($take);

    }

    public function customStore($datas = [])
    {

        $result = \Validation::store($datas, static::$rules);

        if ($result['boolean']) {

            unset($datas['password_confirmation']);

            $datas['password'] = Hash::make($datas['password']);

            $result['last'] = $this->create($datas);

        }

        return $result;

    }

    public function customUpdate($id, $datas = [])
    {

        if ($datas['password'] == '') {

            static::$rules['password'] = '';

            static::$rules['password_confirmation'] = '';

        }

        static::$rules['username'] .= ',username,' . $id;

        static::$rules['email'] .= ',email,' . $id;

        $result = \Validation::updates($id, $datas, static::$rules);

        if ($result['boolean']) {

            if ($datas['password'] != '')

                $datas['password'] = Hash::make($datas['password']);

            else

                unset($datas['password']);

            unset($datas['password_confirmation']);

            $this->where('id', $id)
                ->update($datas);

        }

        return $result;

    }

}