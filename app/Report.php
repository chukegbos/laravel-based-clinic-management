<?php

namespace App;

use App\User;
use App\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'report_id', 'unique_id', 'problem_scope', 'diagnosis', 'recommendation', 'operation', 'operation_detail', 'lab_test', 'lab_test_result', 'lab_test_status', 'doctor_id', 'operation_result', 'controlled', 'competent_driving', 'checkup', 'admission', 'prescription', 'prescription_billed', 'department', 'first_timer', 'admission_booked', 'sugar_content', 'bit_rate', 'hbp'
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
