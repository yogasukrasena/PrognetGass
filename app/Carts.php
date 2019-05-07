<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    protected $table = 'carts';
    
    protected $fillable = [
        'user_id', 'product_id', 'qty', 'status'
    ];
}
