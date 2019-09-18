<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Ward;

class Bed extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'ward', 'gender', 'occupant', 'duration'  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at'
    ];


    public function getWardAttribute()
    {
        $id = $this->attributes['ward'];
        //$bed = Doctor::findOrFail($id);
        $ward = Ward::where('deleted_at', NULL)->where('id', $id)->first();
        $wardname = $ward->name." (".$ward->gender." Ward)";
        return $wardname;
              
    }
}