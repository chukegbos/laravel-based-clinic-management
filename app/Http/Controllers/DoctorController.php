<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use Auth;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        $unique_id = $doctor->unique_id;
        $finddoctor = User::where('unique_id', $unique_id)->first();
        $user_id = $finddoctor->id;
        User::destroy($user_id);
        Doctor::destroy($id);
        return back();
    }

    public function doctorschedule()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id'); 
        $doctor = Doctor::where('unique_id', $unique_id)->first();
        return view('admin.schedule', compact('doctor'));
    }

    public function updateschedule(Request $request)
    {
        $id = $request->id;
        $settings = Doctor::findOrFail($id);
        $settings->update($request->all()); 


        if (isset($request->start_time1) && isset($request->end_time1)) {
            $settings->monday=1;
            $settings->update();
        } 

        if (isset($request->start_time2) && isset($request->end_time2)) {
            $settings->tuesday=1;
            $settings->update();
        } 

        if (isset($request->start_time3) && isset($request->end_time3)) {
            $settings->wednesday=1;
            $settings->update();
        } 

        if (isset($request->start_time4) && isset($request->end_time4)) {
            $settings->thursday=1;
            $settings->update();
        } 

        if (isset($request->start_time5) && isset($request->end_time5)) {
            $settings->friday=1;
            $settings->update();
        } 

        if (isset($request->start_time6) && isset($request->end_time6)) {
            $settings->saturday=1;
            $settings->update();
        } 

        if (isset($request->start_time7) && isset($request->end_time7)) {
            $settings->sunday=1;
            $settings->update();
        } 
        return back();
    }
}
