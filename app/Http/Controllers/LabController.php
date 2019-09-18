<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Report;
use Illuminate\Http\Request;

class LabController extends Controller
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
        $status = request('status'); 
        $error = request('error');
        $reports = Report::where('lab_test', 'Yes')->where('lab_test_result', NULL)->where('deleted_at', NULL)->get();
       
        return view('admin.laborders', compact('status', 'error', 'reports'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = request('status'); 
        $error = request('error');
        $labs = Lab::where('deleted_at', NULL)->get();
       
        return view('admin.labreports', compact('status', 'error', 'labs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report_id = $request->doctor_report_id;
        Lab::create($request->all());
        $status = "Lab Report Saved Successfully";
        return redirect()->route('viewreport', array('report_id' => $report_id, 'status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $status = request('status'); 
        $error = request('error');
        $lab_id = request('lab_id');
        $report = Lab::where('deleted_at', NULL)->where('lab_report_id', $lab_id)->first();
        return view('admin.viewlab', compact('status', 'error', 'report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        //
    }
}
