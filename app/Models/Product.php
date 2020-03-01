<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'total'
    ];

    protected $casts = [
        'total' => 'float',
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('amount');
    }
}
