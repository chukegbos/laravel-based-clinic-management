@extends('layouts.admin')
@section('pageTitle', 'Lab Report List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>Lab Report List</h1>
            <small>Lab Report List</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Lab Report List</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        @if(isset($status))
                          <div class="alert alert-success alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                              {{ $status}}
                          </div>
                        @endif

                        @if(isset($error))
                          <div class="alert alert-danger alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-times"></i> Oops!</h4>
                              {{ $error}}
                          </div>
                        @endif

                        <div class="table-responsive">
                            <table id="example4" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Doctor's Report ID</th>
                                        <th>Lab Report ID</th>
                                        <th>Action</th>
                                        
                                        <!--<th>Delete</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($labs as $lab)
                                    <tr>
                                        <td>
                                            <label><a href="{{ url('/viewreport') }}/?report_id={{ $lab->doctor_report_id }}">{{ $lab->doctor_report_id }}</a></label>   
                                        </td>
                                        <td>
                                            <label>{{ $lab->lab_report_id }}</label>   
                                        </td>
                                        <td>
                                            <label>
                                                <a href="{{ url('/viewlab') }}/?lab_id={{ $lab->lab_report_id }}" class="btn btn-warning btn-xs">View</a>
                                            </label>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection