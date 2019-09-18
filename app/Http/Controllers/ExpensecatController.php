<?php

namespace App\Http\Controllers;

use App\Expensecat;
use App\Expense;
use Auth;
use Illuminate\Http\Request;

class ExpensecatController extends Controller
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
        $role = Auth::user()->role;
        $status = request('status'); 
        $error = request('error');
        if ($role=="Admin") {
            $cats = Expensecat::where('deleted_at', NULL)->get();
        }
        else
        {
            $cats = Expensecat::where('deleted_at', NULL)->where('department', $role)->get();
        }
        return view('admin.expensecat', compact('status', 'error', 'cats'));
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
        Expensecat::create($request->all());
        $status = "Category Saved Successfully";
        return redirect()->route('expensecat', array('status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expensecat  $expensecat
     * @return \Illuminate\Http\Response
     */
    public function show(Expensecat $expensecat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expensecat  $expensecat
     * @return \Illuminate\Http\Response
     */
    public function edit(Expensecat $expensecat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expensecat  $expensecat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id; 
        $cat = Expensecat::where('id', $id)->first();
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->department = $request->department;
        $cat->update();
        $status = "Category Updated Sucessfully";
        return redirect()->route('expensecat', array('status' => $status));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expensecat  $expensecat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expensecat::destroy($id);
        $expense= Expense::where('category', $id)->where('deleted_at', NULL)->get();
        foreach ($expense as $key) {
            $key->category = NULL;
            $key->update();
        }
        return back();
    }
}
