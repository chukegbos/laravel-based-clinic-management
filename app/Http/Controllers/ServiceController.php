<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = Service::where('deleted_at', NULL)->get();
        return view('admin.servicelist', compact('services', 'status'));
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
        Service::create($request->all());
        $status = "Service Added Sucessfully";
        return redirect()->route('service.index', array('status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = request('id'); 
        $service = Service::where('id', $id)->first();
        return view('admin.editservice', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id; 
        $service = Service::where('id', $id)->first();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->quantity = $request->quantity;
        $service->rate = $request->rate;
        $service->update();
        $status = "Service Updated Sucessfully";
        return redirect()->route('service.index', array('status' => $status));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return back();
    }
}
