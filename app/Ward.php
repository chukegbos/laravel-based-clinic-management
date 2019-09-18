<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Bed;

class Ward extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status', 'bed', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at'
    ];


    public function getBedsAttribute()
    {
        $id = $this->attributes['id'];
        //$bed = Doctor::findOrFail($id);
        $beds = Bed::where('deleted_at', NULL)->where('ward', $id)->count();
        return $beds;
              
    }
}