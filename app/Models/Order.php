<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date', 'total'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('amount');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
