<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
		protected $table = 'transactions';
    
    protected $fillable = [
        'timeout', 'address', 'regency', 
        'province', 'total', 'shipping_cost', 'sub_total',
        'user_id', 'courier_id', 'proof_of_payment', 'status', 'created_at'
    ];
}
