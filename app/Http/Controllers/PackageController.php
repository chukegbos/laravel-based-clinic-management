<?php

namespace App\Http\Controllers;

use App\Package;
use App\Admission;
use App\Bill;
use App\User;
use App\Patient;
use Auth;
use DB;
use App\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
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
        $packages = Package::where('deleted_at', NULL)->groupBy('name')->get();
        return view('admin.packagelist', compact('packages', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = request('id'); 
        $package = Package::findOrFail($id);
        $package_name = $package->name;
        $packages = Package::where('deleted_at', NULL)->where('name', $package_name)->get();

        $service_id = array();
        foreach ($packages as $key) {
            $id = $key->package;
            $new_amount = array_push($service_id,$id);
        }

        return view('admin.viewpackage', compact('packages', 'package', 'service_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       
        foreach ($request->package as $key) {
            $step1 = new Package();
            $step1->name = $request->name;
            $step1->description = $request->description;          
            $step1->discount = $request->discount;
            $step1->package = $key;
            $step1->save();
        }
        $status = "Package Added Sucessfully";
        return redirect()->route('package.index', array('status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id; 
        $package = Package::where('id', $id)->first();
        $package_name = $package->name;

        $packages = Package::where('name', $package_name)->where('deleted_at', NULL)->get();
        //$exploded = explode(",",$request->package);

        foreach ($packages as $key) {
            if (in_array($key->package, $request->package)) {
               
            }
            else
            {
                $thepackage = Package::where('deleted_at', NULL)->where('name', $package_name)->where('package', $key->package)->first();
                $package_id = $thepackage->id;
                Package::destroy($package_id);
            }
        }

        foreach ($request->package as $key) {
            $editpackage = Package::where('package', $key)->where('name', $package_name)->where('deleted_at', NULL)->first();
            if (isset($editpackage)) {
                $editpackage->name = $request->name;
                $editpackage->description = $request->description;          
                $editpackage->discount = $request->discount;
                $editpackage->package = $key;
                $editpackage->update();
            }
            else
            {
                $step1 = new Package();
                $step1->name = $request->name;
                $step1->description = $request->description;          
                $step1->discount = $request->discount;
                $step1->package = $key;
                $step1->save();
            }
        }

        $lastpackage = Package::where('name', $request->name)->where('deleted_at', NULL)->first();
        $id = $lastpackage->id; 
        return redirect()->route('package.create', array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $package = Package::findOrFail($id);
        $name_of_package = $package->name;
        $package_list = Package::where('deleted_at', NULL)->where('name', $name_of_package)->get();
        foreach ($package_list as $key) {
            $package_id = $key->id;
            Package::destroy($package_id);
        }
        return back();
    }

    public function invoice()
    {
        function random_num($size) {
            $alpha_key = '';
            $keys = range('A', 'Z');

            for ($i = 0; $i < 2; $i++) {
                $alpha_key .= $keys[array_rand($keys)];
            }

            $length = $size - 2;

            $key = '';
            $keys = range(0, 9);

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            return $alpha_key . $key;
        }
        $random_number = random_num(10);

        $admission_id = request('admission_id'); 
        $admission = Admission::findOrFail($admission_id);
        $patient_id = $admission->patient_id;
        $patient = Patient::where('unique_id', $patient_id)->first();

        $status = request('status'); 
        $error = request('error');

        $services = Service::where('deleted_at', NULL)->groupBy('name')->get();
        return view('admin.invoice', compact('patient', 'status', 'random_number'));
    }
}
