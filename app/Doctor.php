<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'mname', 'uname', 'phone', 'email', 'unique_id', 'address', 'designation', 'department', 'specialist', 'photo', 'bio', 'dob', 'blood_group', 'genotype', 'gender', 'status', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'start_time1', 'end_time1', 'start_time2', 'end_time2', 'start_time3', 'end_time3', 'start_time4', 'end_time4', 'start_time5', 'end_time5', 'start_time6', 'end_time6', 'start_time7', 'end_time7'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at'
    ];
}
