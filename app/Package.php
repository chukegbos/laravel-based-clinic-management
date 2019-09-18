<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Service;

class Package extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status', 'package', 'discount', 'amount', 'total'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at'
    ];


    public function getAmountAttribute()
    {  
        $name = $this->attributes['name'];
        //$packages = Package::where('deleted_at', NULL)->where('name', $name)->sum('amount');
        $packages = Package::where('deleted_at', NULL)->where('name', $name)->get();

        $amount = array();
        foreach ($packages as $key) {
            $id = $key->package;
            $service = Service::findOrFail($id);
            $new_amount = array_push($amount,$service->quantity);
        }
        $new_amount = array_sum($amount);
        return $new_amount; 
    }

    public function getTotalAttribute()
    {  
        $name = $this->attributes['name'];
        $packages = Package::where('deleted_at', NULL)->where('name', $name)->get();
        $amount = array();
        foreach ($packages as $key) {
            $id = $key->package;
            $service = Service::findOrFail($id);
            $new_amount = array_push($amount,$service->quantity);
        }
        $new_amount = array_sum($amount);
        $discount = Package::where('deleted_at', NULL)->where('name', $name)->first();
        $total = $new_amount - $discount->discount;
        return $total;    
    }
}