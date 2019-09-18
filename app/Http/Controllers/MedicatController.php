<?php

namespace App\Http\Controllers;

use App\Medicat;
use App\Drug;
use Illuminate\Http\Request;

class MedicatController extends Controller
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
        $cats = Medicat::where('deleted_at', NULL)->get();
        return view('admin.drugcat', compact('status', 'error', 'cats'));
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
        Medicat::create($request->all());
        $status = "Category Saved Successfully";
        return redirect()->route('drugcat', array('status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicat  $medicat
     * @return \Illuminate\Http\Response
     */
    public function show(Medicat $medicat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicat  $medicat
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicat $medicat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicat  $medicat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id; 
        $cat = Medicat::where('id', $id)->first();
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->update();
        $status = "Category Updated Sucessfully";
        return redirect()->route('drugcat', array('status' => $status));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicat  $medicat
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Medicat::destroy($id);

        $drug = Drug::where('category', $id)->where('deleted_at', NULL)->get();
        foreach ($drug as $key) {
            $key->category = NULL;
            $key->update();
        }
        return back();
    }
}
