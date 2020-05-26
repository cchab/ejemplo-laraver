<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'title', 'description','type', 'date', 'time', 'isFavorit','score','user_app_id'
    ];

    public function UserApp()
    {
        return $this->belongsTo('App\UserApp','user_app_id');
    }
}
