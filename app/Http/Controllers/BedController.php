<?php

namespace App\Http\Controllers;

use App\Bed;
use App\Ward;
use Illuminate\Http\Request;

class BedController extends Controller
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
        $bedss = Bed::get();
        return view('admin.bed', compact('status', 'error', 'bedss'));
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
        $wards = Ward::get();
        return view('admin.addbed', compact('wards', 'error', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $findbed = Bed::where('deleted_at', NULL)->where('number', $request->number)->where('ward', $request->ward)->first();
        if (isset($findbed)) {
            $error = "Bed Already Exist";
            return redirect()->route('addbed', array('error' => $error));
        }
        else
        {
            Bed::create($request->all());
            $status = "Bed Added Sucessfully";
            return redirect()->route('bed', array('status' => $status));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Bed $bed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bed::destroy($id);
        return back();
    }
}
