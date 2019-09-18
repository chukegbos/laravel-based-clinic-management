<?php

namespace App;

use App\User;
use App\Drug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicat extends Model
{
    /*public function user(){
    	return $this->belongsTo('App\User');
    }
    */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'no_of_drugs', 'description', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at'
    ];

    public function getNoOfDrugsAttribute()
    {
        $id = $this->attributes['id'];
        $drug = Drug::where('deleted_at', NULL)->where('quantity', '>=', 1)->where('category', $id)->count();
        return $drug;   
    }
} 