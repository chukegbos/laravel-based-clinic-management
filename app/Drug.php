<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name', 'genetic_name', 'reg_price', 'discount_price', 'quantity', 'status', 'nafdac_number', 'sku', 'expiry_date', 'batch_number', 'category'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
      'remember_token', 'deleted_at'
    ];

    
}