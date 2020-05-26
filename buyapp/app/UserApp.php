<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    protected $table = 'users_app';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'age', 'phone', 'photo', 'email','password'
    ];

    public function events()
    {
        return $this->hasMany('App\Events','user_app_id');
    }
}
