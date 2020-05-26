<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'quantity', 'stock', 'type', 'unit_price','provider_id','description','photo','city','country',
        'is_new'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function purchase()
    {
        return $this->belongsToMany('App\Purchase');
    }
}
