<?php

namespace App;

use App\User;
use App\Drug;
use App\Expensecat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
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
        'category', 'name', 'amount', 'department'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at'
    ];

    public function getCategoryAttribute()
    {
        $id = $this->attributes['id'];
        $cat = Expensecat::where('deleted_at', NULL)->where('id', $id)->first();
        return $cat->name;   
    }
} 