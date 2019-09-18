<?php

namespace App;

use App\User;
use App\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id', 'unique_id', 'date_of_appointment', 'status', 'doctor_id', 'department', 'first_timer', 'reporting_doctor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'remember_token', 'deleted_at', 'checkup'
    ];

    public function getDoctorIdAttribute()
    {
        $id = $this->attributes['doctor_id'];
        $doctor = Doctor::where('deleted_at', NULL)->where('unique_id', $id)->first();
        if (isset($doctor)) {
            $name = $doctor->fname.' '.$doctor->lname;
            return $name; 
        }
        else{
            $doctor = User::where('deleted_at', NULL)->where('unique_id', $id)->first();
            $name = $doctor->fname.' '.$doctor->lname;
            return $name;   
        }
            
    }
    /*public function getUniqueIdAttribute()
    {
        $id = $this->attributes['unique_id'];
        $patient = Patient::where('deleted_at', NULL)->where('unique_id', $id)->first();
        $name = $patient->fname.' '.$patient->lname;
        return $name;     
    }*/
}
