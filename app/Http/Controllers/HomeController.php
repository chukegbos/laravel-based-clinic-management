<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Order;
use App\Doctor;
use App\Patient;
use App\Admission;
use App\Report;
use App\Medicat;
use App\Ward;
use App\Bed;
use App\Bill;
use App\Service;
use App\Drug;
use App\Department;
use App\Appointment;
use DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unique_id = Auth::user()->unique_id; 
        $today = Carbon::Today();

        $users = Appointment::get();
        foreach ($users as $key) {
            if ($key->date_of_appointment<$today) {
                $key->status = "Cancelled";
                $key->update();
            }
        }

        $pharms = Report::where('prescription', '!=', NULL)->where('prescription_billed', NULL)->where('deleted_at', NULL)->get(); 
        foreach ($pharms as $key) {
            if ($key->updated_at<$today) {
                $key->prescription_billed = "No";
                $key->update();
            }
        }

        if (Auth::user()->role=="Doctor") {
            $doctor = Doctor::where('unique_id', $unique_id)->first();
            $department = $doctor->department;
            $today = Carbon::Today();
            $status = "On Queue";
            //return $today;
            $appointments = Appointment::where('deleted_at', NULL)->where('date_of_appointment', $today)->where('department', $department)->where('status', $status)->orderBy('created_at', 'desc')->get();
            return view('admin.index', compact('doctor', 'appointments'));
        }
        elseif (Auth::user()->role=="Admin") {
            $countdoctor = Doctor::where('deleted_at', NULL)->count();
            $allpatients = Patient::where('deleted_at', NULL)->count();
            $units = Department::where('deleted_at', NULL)->count();
            $allnurses = User::where('deleted_at', NULL)->where('role', 'Nurse')->count();
            $stafflist = User::where('deleted_at', NULL)->where('role', '!=', 'Patient')->count();
            $laboratorist = User::where('deleted_at', NULL)->where('role', 'Lab Scientist')->count();
            $pharmacist = User::where('deleted_at', NULL)->where('role', 'Pharmacist')->count();
            $today = Carbon::Today();
            $appointment = Appointment::where('deleted_at', NULL)->where('date_of_appointment', $today)->orWhere('status', '!=', 'Seen')->where('status', NULL)->orderBy('created_at', 'desc')->count();
            $outpatients = Appointment::where('deleted_at', NULL)->where('status', NULL)->orWhere('status', "On Queue")->orderBy('created_at', 'desc')->count();
            $inpatients = Bed::where('deleted_at', NULL)->where('occupant', '!=', NULL)->orderBy('created_at', 'desc')->count();
            $appointments = Appointment::where('deleted_at', NULL)->where('date_of_appointment', $today)->orWhere('status', '!=', 'Seen')->where('status', NULL)->orderBy('created_at', 'desc')->get();
            return view('admin.index', compact('countdoctor', 'allpatients', 'allnurses', 'units', 'pharmacist', 'laboratorist', 'appointments', 'appointment', 'outpatients', 'stafflist', 'inpatients'));
        }
        elseif (Auth::user()->role=="Pharmacist") {
            $status = request('status'); 
            $error = request('error');
            $drugs = Drug::where('deleted_at', NULL)->get();
            $today = Carbon::Today();
            
            $dt = Carbon::now();
            $year = $dt->year;
            $month = $dt->month;
            $day = $dt->day;
            $hour = $dt->hour;
            $minute = $dt->minute;
            $second = $dt->second;

            $about_to_expire = $today->subDays(29); 
         
            $id = request('id');
            if (isset($id)) {
                $report = Report::findOrFail($id);
                $prescription = $report->prescription;
                $unique_id = $report->unique_id;
                return view('admin.index', compact('status', 'error', 'drugs', 'today', 'about_to_expire', 'prescription', 'unique_id'));
            }
            else{
                $drugcat = Medicat::where('deleted_at', NULL)->count();
                $drug = Drug::where('deleted_at', NULL)->where('quantity', '>=', 1)->count();
                $orders = Order::where('deleted_at', NULL)->count();  
                //$todayorders = Order::where('deleted_at', NULL)->where('created_at', Carbon::today())->count();
                $todayorders = DB::table('orders')->select(DB::raw('*'))
                  ->whereRaw('Date(created_at) = CURDATE()')->count();

                /*$inspections = Order::select('*')->get()->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('W');
                });*/

                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                $weekorders = DB::table('orders')->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();

                $currentMonth = date('m');
                $monthorders = Order::where('deleted_at', NULL)->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count();

                $currentYear = '20'.date('y');
                $yearorders = Order::where('deleted_at', NULL)->whereRaw('YEAR(created_at) = ?',[$currentYear])->count();

                return view('admin.index', compact('drugcat', 'orders', 'drug', 'status', 'error', 'drugs', 'today', 'about_to_expire', 'todayorders', 'weekorders', 'monthorders', 'yearorders'));
            }
        }
        elseif (Auth::user()->role=="Lab Scientist") {
            $status = request('status'); 
            $booked = "Booked";
            $error = request('error');
            $labrequest = Report::where('lab_test', 'Yes')->where('lab_test_result', NULL)->where('lab_test_status', NULL)->where('deleted_at', NULL)->count();
            $bookedlab = Report::where('lab_test', 'Yes')->where('lab_test_result', NULL)->where('lab_test_status', $booked)->where('deleted_at', NULL)->count();
            $readylab = Report::where('lab_test', 'Yes')->where('lab_test_result', '!=', NULL)->where('lab_test_status', $booked)->where('deleted_at', NULL)->count();

            return view('admin.index', compact('labrequest', 'bookedlab', 'readylab'));
        }
    }

    //Doctors
    public function alldoctors()
    {
        $status = request('status'); 
        $error = request('error');
        $doctors = Doctor::where('designation', "Doctor")->get();
        return view('admin.alldoctors', compact('status', 'error', 'doctors'));
    }

    public function doctors()
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
        $status = request('status'); 
        $error = request('error');
        return view('admin.doctors', compact('random_number', 'error', 'status'));
    }

    public function storedoctor(Request  $request )
    {
        $email = $request->email; 
        $doctor = Doctor::where('email', $email)->first();
        $user = User::where('email', $email)->first();
        if (isset($doctor) || isset($user)) 
        {
            $error = "This doctor already exist!!!";
            return redirect()->route('doctors', array('error' => $error));
        }
        else
        {
            $users = new User();
            $users->fname = $request->fname;
            $users->lname = $request->lname;
            $users->mname = $request->mname;
            $users->uname = $request->uname;
            $users->email = $request->email;
            $users->status = $request->status;
            $users->phone = $request->phone;
            $users->role = $request->designation;
            $users->unique_id = $request->unique_id;
            $users->password = bcrypt($request->password);
            $users->save();


            $step1 = new Doctor();
            $step1->fname = $request->fname;
            $step1->lname = $request->lname;
            $step1->mname = $request->mname;
            $step1->uname = $request->uname;
            $step1->email = $request->email;
            $step1->phone = $request->phone;
            $step1->address = $request->address;
            $step1->unique_id = $request->unique_id;
            $step1->designation = $request->designation;
            $step1->specialist = $request->specialist;
            $step1->department = $request->department;
            $step1->bio = $request->bio;
            $step1->dob = $request->dob;
            $step1->blood_group = $request->blood_group;
            $step1->gender = $request->gender;
            $step1->status = $request->status;
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $path = Storage::disk('public')->putFile('doctors', $file);
                $step1->photo = $path;
            }
            $step1->save();
      

            $status = $request->designation. ' Added Sucessfully';
            if ($request->designation=="Doctor") {
                return redirect()->route('alldoctors', array('status' => $status));
            }
            else{
                return redirect()->route('addstaff', array('status' => $status));
                //return redirect()->back()->with("status","Added Sucessfully");
            }
            
        }
    }

    //Patients
    public function allpatients()
    {
        $status = request('status'); 
        $error = request('error');
        $type = request('type');
        $patients = Patient::get();

        if (isset($type) && $type=="outpatient") {
            $outpatient = request('type');
            $queue = "On Queue";
            $appointments = Appointment::where('deleted_at', NULL)->where('status', $queue)->orWhere('status', NULL)->orderBy('created_at', 'desc')->get();
           
            return view('admin.allpatients', compact('status', 'error', 'patients', 'appointments', 'outpatient'));
        }
        elseif (isset($type) && $type=="inpatient") {
            $inpatient = request('type');
            $inpatients = Bed::where('deleted_at', NULL)->where('occupant', '!=', NULL)->orderBy('created_at', 'desc')->get();
          
            return view('admin.allpatients', compact('status', 'error', 'patients', 'inpatient', 'inpatients'));
        }
        else
        {
            return view('admin.allpatients', compact('status', 'error', 'patients'));
        }
    }

    public function patients()
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
        $random_number = random_num(15);
        $status = request('status'); 
        $error = request('error');
        return view('admin.addpatient', compact('random_number', 'error', 'status'));
    }

    public function storepatient(Request  $request )
    {
        $email = $request->email; 
        $patient = Patient::where('email', $email)->first();
        $user = User::where('email', $email)->first();
        if (isset($patient) || isset($user)) 
        {
            $error = "This patient already exist!!!";
            return redirect()->route('patients', array('error' => $error));
        }
        else
        {
            $users = new User();
            $users->fname = $request->fname;
            $users->lname = $request->lname;
            $users->mname = $request->mname;
            $users->uname = $request->uname;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->role = "Patient";
            $users->unique_id = $request->unique_id;
            $users->password = bcrypt($request->password);
            $users->save();


            $step1 = new Patient();
            $step1->fname = $request->fname;
            $step1->lname = $request->lname;
            $step1->mname = $request->mname;
            $step1->uname = $request->uname;
            $step1->email = $request->email;
            $step1->phone = $request->phone;
            $step1->unique_id = $request->unique_id;
            $step1->address = $request->address;
            $step1->bio = $request->bio;
            $step1->dob = $request->dob;
            $step1->blood_group = $request->blood_group;
            $step1->gender = $request->gender;
            $step1->genotype = $request->genotype;
            $step1->status = $request->status;
            $step1->marital_status = $request->marital_status;
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $path = Storage::disk('public')->putFile('patient', $file);
                $step1->photo = $path;
            }
            
            $step1->save();
        
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
            $random_nu = random_num(15);

            $step3 = new Report();
            $step3->problem_scope = $request->problem_scope;
            $step3->department = $request->department;
            $step3->unique_id = $request->unique_id;
            $step3->report_id = $random_nu;
            $step3->checkup = Carbon::Today();
            $step3->doctor_id = Auth::user()->unique_id;
            $step3->first_timer = "Yes";
            $step3->bit_rate = $request->bit_rate;
            $step3->hbp = $request->hbp;
            $step3->sugar_content = $request->sugar_content;
            $step3->save();
     
            $step4 = new Appointment();
            $step4->unique_id = $request->unique_id;
            $step4->department = $request->department;
            $step4->report_id = $random_nu;
            $step4->doctor_id = Auth::user()->unique_id;
            $step4->date_of_appointment = Carbon::Today();
            $step4->status = "On Queue";
            $step4->first_timer = "Yes";
            $step4->save();

            $step5 = new Bill();
            $step5->unique_id = $request->unique_id;
            $step5->service_id = $request->service_id;
            $service = Service::findOrFail($request->service_id);
            $step5->amount = $service->quantity;
            $step5->description = $service->description;
            $step5->status = "Paid";
            $step5->admin_id = Auth::user()->unique_id;
            $step5->save();

            $status = "Patients Added Sucessfully";
            return redirect()->route('allpatients', array('status' => $status));
        }
    }

    public function updatepatient(Request  $request )
    {
        $unique_id = $request->unique_id;
        $users = User::where('unique_id', $unique_id)->first();
        $users->fname = $request->fname;
        $users->lname = $request->lname;
        $users->mname = $request->mname;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->role = "Patient";
        $users->update();

        $user = Patient::where('unique_id', $unique_id)->first();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->bio = $request->bio;
        $user->dob = $request->dob;
        $user->genotype = $request->genotype;
        $user->blood_group = $request->blood_group;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->status = $request->status;

        $user->update();

        $status = "Patients Updated Sucessfully";
        return redirect()->route('viewpatient', array('status' => $status, 'unique_id'=> $unique_id));
    }

    public function viewpatient()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id');
        $patient = Patient::where('unique_id', $unique_id)->first();
        //return $patient;
        return view('admin.viewprofile', compact('status', 'error', 'patient'));
    }


    public function profile()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id'); 

        
        $patient = Patient::where('unique_id', $unique_id)->first();
        if (isset($patient)) {
           return view('admin.viewprofile', compact('status', 'error', 'patient')); 
        }
        else
        {
            $doctor = User::where('unique_id', $unique_id)->first();
            return view('admin.viewprofile', compact('status', 'error', 'doctor'));
        }
    }

    public function editpatient()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id');
        $patient = Patient::where('unique_id', $unique_id)->first();
        //return $patient;
        return view('admin.editpatient', compact('status', 'error', 'patient'));
    }

    //Nurse
    public function stafflist()
    {
        $status = request('status'); 
        $error = request('error');
        $staff = request('staff');

        if (isset($staff)) {
            $doctors = User::where('role', '!=', "Super Agent")->where('role', $staff)->where('deleted_at', NULL)->get();
        }
        else{
            $doctors = User::where('role', '!=', "Super Agent")->where('role', '!=', "Patient")->where('deleted_at', NULL)->get();
        //$doctors = Doctor::where('designation', '!=', "Doctor")->get();
        }
        return view('admin.stafflist', compact('status', 'error', 'doctors'));
    }

    public function addstaff()
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
        $random_number = random_num(15);
        $status = request('status'); 
        $error = request('error');
        return view('admin.addstaff', compact('random_number', 'error', 'status'));
    }

    //Nurse
    public function report()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id');
        if (isset($unique_id)) {
            $patient = Patient::where('unique_id', $unique_id)->where('deleted_at', NULL)->first();
            $reports = Report::where('unique_id', $unique_id)->where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
            $users = User::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
            return view('admin.report', compact('status', 'error', 'reports', 'unique_id', 'patient', 'users'));
        }
        else
        {
            $reports = Report::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
            $users = User::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
            return view('admin.report', compact('status', 'error', 'reports', 'users'));
        }
    }

    public function addreport()
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
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id');
        $report_id = request('report_id');
        $patient = Patient::where('unique_id', $unique_id)->first();

        return view('admin.addreport', compact('random_number', 'error', 'status', 'unique_id', 'patient', 'report_id'));
    }

    public function ban()
    {
        $unique_id = request('unique_id');
        $doctor = Doctor::where('unique_id', $unique_id)->first();

        if ($doctor->status=="1") {
            $doctor->status = "0";
        }
        else{
            $doctor->status = "1";
        }
        $doctor->update();
        return back();
    }

    public function userban()
    {
        $unique_id = request('unique_id');
        $doctor = User::where('unique_id', $unique_id)->first();

        if ($doctor->status=="1") {
            $doctor->status = "0";
        }
        else{
            $doctor->status = "1";
        }
        $doctor->update();
        return back();
    }

    public function storereport(Request  $request )
    {
        $report_id = $request->report_id;
        $oldreport_id = $request->oldreport_id;
        $report = Report::where('report_id', $report_id)->first();
        if (!isset($report)) {
            $step1 = new Report();
            $step1->category = collect($request->category)->implode(', ');
            $step1->problem_scope = $request->problem_scope;
            $step1->diagnosis = $request->diagnosis;
            $step1->recommendation = $request->recommendation;
            $step1->unique_id = $request->unique_id;
            $step1->report_id = $request->report_id;
            $step1->doctor_id = $request->doctor_id;
            $step1->operation = $request->operation;
            $step1->lab_test = $request->lab_test;
            $step1->controlled = $request->controlled;
            $step1->competent_driving = $request->competent_driving;

            if ($request->admission == "No") {
                $today = Carbon::Today();
                $oneweek = $today->addDay(7);
                $step1->checkup = $oneweek;
            }

            $step1->admission = $request->admission;
            $step1->department = $request->department;
            $step1->prescription = $request->prescription;
            $unique_id = $request->unique_id;
            $step1->save();
     
            $step2 = new Appointment();
            $step2->unique_id = $request->unique_id;
            $step2->report_id = $request->report_id;
            $step2->doctor_id = $request->doctor_id;
            $step2->department = $request->department;
            $step2->date_of_appointment = $request->checkup;
            $step2->save();

            $appointment = Appointment::where('report_id', $oldreport_id)->first();
            $appointment->first_timer = NULL;
            $appointment->status = "Seen";
            $appointment->reporting_doctor = Auth::user()->unique_id; 
            $appointment->update();


            $status = "Report Created Successfully";
            return redirect()->route('report', array('unique_id' => $unique_id));   
        }
        else
        {
            return back();
        }
    }

    public function viewreport()
    {
        $status = request('status'); 
        $error = request('error');
        $report_id = request('report_id');
        $bed = request('bed');
        $report = Report::where('report_id', $report_id)->first();    
        $patient_id = $report->unique_id;

        $patient = Patient::where('unique_id', $patient_id)->first();
        $patient_gender = $patient->gender;
        $gender_ward = Ward::where('deleted_at', NULL)->where('gender', $patient_gender)->get();

        $appointment = Appointment::where('report_id', $report_id)->first();  
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
        $random_number = random_num(8);
        $users = User::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
        return view('admin.viewreport', compact('error', 'status', 'report', 'patient', 'random_number', 'users', 'bed', 'patient_gender', 'appointment'));
    }


    public function viewbedorder()
    {
        $status = request('status'); 
        $error = request('error');
        $report_id = request('report_id');
        $bed = request('bed');
        $report = Report::where('report_id', $report_id)->first();    
        $patient_id = $report->unique_id;

        $patient = Patient::where('unique_id', $patient_id)->first();
        $patient_gender = $patient->gender;
        $gender_wards = Ward::where('deleted_at', NULL)->where('gender', $patient_gender)->get();
        $bedss = DB::table('beds')->where('deleted_at', NULL)->where('occupant', NULL)->get();
        
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
        $random_number = random_num(8);
        $users = User::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
        return view('admin.viewbedorder', compact('error', 'status', 'report', 'patient', 'random_number', 'users', 'bed', 'patient_gender', 'gender_wards', 'bedss'));
    }

    public function storebedorder(Request  $request )
    {
        $unique_id = $request->unique_id; 
        $report_id = $request->report_id; 
        $bed_id = $request->bed; 

        if (isset($bed_id)) {
            $beds = Bed::where('id', $bed_id)->first();
            $beds->occupant = $unique_id;
            $beds->update();
            $bed = "Assigned";

            $report = Report::where('report_id', $report_id)->first();
            $report->admission_booked = "Booked";
            $report->update();

            $today = Carbon::Today();

            $step5 = new Admission();
            $step5->patient_id = $unique_id;
            $step5->start_date = $today;
            $step5->bed = $bed_id;
            $step5->status = "Inpatient";
            $step5->save();

            $status = 'Bed Assigned Sucessfully';
            return redirect()->route('viewbedorder', array('status' => $status, 'report_id' => $report_id, 'unique_id' => $unique_id, 'bed' => $bed));
        } 
        else
        {
            return back();
        }
    }


    //Nurse
    public function admission()
    {
        $status = request('status'); 
        $error = request('error');
        $unique_id = request('unique_id');

        $admission = Report::where('admission', 'Yes')->where('admission_booked', NULL)->where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
        $users = User::where('deleted_at', NULL)->orderBy('created_at', 'desc')->get();
        return view('admin.admission', compact('status', 'error', 'admission', 'users'));
        
    }

    public function passwordget()
    {   
        $error = request('passworderror'); 
        return view('admin.password', compact('error'));
    }

    public function password(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !"); 
    }


    //Doctors
    public function appointments()
    {
        $today = Carbon::Today();
        $status = request('status');
        $today1 = request('today');
        $current = request('current');
        if (isset($today1)) {
            $appointments = Appointment::where('deleted_at', NULL)->where('date_of_appointment', $today)->orderBy('created_at', 'desc')->get();
        }
        elseif (isset($current)) {
            $appointments = Appointment::where('deleted_at', NULL)->where('status', NULL)->orwhere('status', 'On Queue')->orderBy('created_at', 'desc')->get();
        }
        else{
            $appointments = Appointment::where('deleted_at', NULL)->orderBy('date_of_appointment', 'desc')->get();
        }
        return view('admin.appointment', compact('appointments', 'today', 'status'));
    }

    public function markpresent()
    {
        $today = Carbon::Today();
        $appointment_id = request('appointment_id');
        $report_id = request('report_id');
        $report = Report::where('report_id', $report_id)->first();
        $unique_id = $report->unique_id;
        $patient = Patient::where('unique_id', $unique_id)->first();
        return view('admin.markpresent', compact('appointment_id', 'report', 'patient'));
    }

    public function reschedule(Request  $request )
    {
        $today = Carbon::Today();
        $id = $request->id;
        $users = Appointment::findOrFail($id);
        if ($request->date_of_appointment<=$today) {
            $users->status = "On Queue";
        }
        else{
            $users->status = NULL;
        }
        $users->date_of_appointment = $request->date_of_appointment;
        $users->update();
        return back();
    }

    public function storemarkpresent(Request  $request )
    {
        $step5 = new Bill();
        $step5->unique_id = $request->unique_id;
        $step5->service_id = $request->service_id;
        $service = Service::findOrFail($request->service_id);
        $step5->amount = $service->quantity;
        $step5->description = $service->description;
        $step5->status = "Paid";
        $step5->admin_id = Auth::user()->unique_id;
        $step5->save();


        $report_id = $request->report_id;
        $report = Report::findOrFail($report_id);
        $report->sugar_content = $request->sugar_content;
        $report->hbp = $request->hbp;
        $report->bit_rate = $request->bit_rate;
        $report->update();

        $users = Appointment::findOrFail($request->appointment_id);
        $users->status = "On Queue";
        $users->update();
        $status = "Booked Sucessfully";
        return redirect()->route('appointments', array('status' => $status));
    }

    //Admission
    public function admissionstatus()
    {
        $admissions = Admission::where('deleted_at', NULL)->orderBy('status', $inpatients)->get();
        return view('admin.admissionstatus', compact('appointments', 'today', 'status'));
    }

    public function admissionhistory()
    {
        $admission = Admission::where('deleted_at', NULL)->get();
        return view('admin.admissionhistory', compact('admission'));
    }
}
