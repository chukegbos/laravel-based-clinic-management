<?php

namespace App;

use App\User;
use App\Bed;
use App\Ward;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admission extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bed', 'patient_id', 'start_date', 'end_date', 'status', 'duration', 'billing_service'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at', 'start_date', 'end_date',
    ];

    /* public function getPatientIdAttribute()
    {
        $id = $this->attributes['patient_id'];
        $patient = Patient::where('deleted_at', NULL)->where('unique_id', $id)->first();
        $name = $patient->fname.' '.$patient->lname. '('.$id.')';
        return $name;    
    }
   public function getUniqueIdAttribute()
    {
        $id = $this->attributes['unique_id'];
        $patient = Patient::where('deleted_at', NULL)->where('unique_id', $id)->first();
        $name = $patient->fname.' '.$patient->lname;
        return $name;     
    }*/
    public function getBedAttribute()
    {
        $id = $this->attributes['bed'];
        $bed = Bed::findOrFail($id);
        $bed_number = $bed->number;
        $bed_ward = $bed->ward;
        return $bed_ward.' Bed '. $bed_number ;
    }
}
