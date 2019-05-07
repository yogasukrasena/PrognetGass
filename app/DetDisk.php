<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetDisk extends Model
{
    //
	protected $table = 'detail_discounts';
    
    protected $fillable = [
        'id_product', 'id_discount', 'tgl_mulai', 'tgl_akhir',
    ];
}
