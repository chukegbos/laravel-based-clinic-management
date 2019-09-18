<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SettingController extends Controller
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
        $setting = Setting::where('id', 1)->first();
        if (isset($setting)) {
            $active = $setting->active;
            if ($active==1) {
                $date_expire = $setting->date_expire;
                if (Carbon::now()>=$date_expire) {
                    $setting->active = "0";
                    $setting->update();
                    $reactivate = "Your account has expired, please reactivate";
                    return view('welcome', compact('reactivate'));
                }
                else
                {
                    if (Auth::guard('web')->check()){
                        return redirect()->route('home');
                    }
                    else{
                        $login = "Yes";
                        return view('welcome', compact('login'));
                        //return view('auth.login');
                    }
                }
            }

            else
            {
                $reactivate = "Your account has expired, please reactivate";
                return view('welcome', compact('reactivate'));
            }          
        }

        else{
            return view('auth.create');
            //return view('auth.login');
        }
        //return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate()
    {
        return view('auth.create');
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->email;

            $step1 = new Setting();
            $step1->sitename = $request->sitename;
            $step1->email = $request->email;
            $step1->phone = $request->phone;

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
            $step1->siteid = random_num(10);
            $step1->active = "1";
            $step1->date_activate = Carbon::now();
            $step1->duration = "30";

            $dt = Carbon::now();
            $step1->date_expire = $dt->addMonths(12); 
            $step1->save();


            $users = new User();
            $users->fname = "Admin";
            $users->lname = "Admin";
            $users->mname = "Admin";
            $users->uname = "Admin";
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->role = "Admin";
            $unique_id = random_num(10);
            $users->unique_id = $unique_id;
            $users->password = bcrypt('secret');
            $users->save();

            $status = 'Thats all. Your Hospital Management System has Been Installed. You can login with the following creditentials -'.  'Email: '. $request->email.  ' and Password: secret';
            return redirect()->route('login', array('status' => $status));

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
