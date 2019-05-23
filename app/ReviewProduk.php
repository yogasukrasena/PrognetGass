<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewProduk extends Model
{
    //
	protected $table = 'product_reviews';
    
    protected $fillable = [
        'product_id', 'user_id', 'rate', 'content'
    ];

}
