@extends('layouts.admin')
@section('pageTitle', 'Prescription List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>Prescription List</h1>
            <small>Prescription List</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Prescription List</li>
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
                                        <th>Report ID</th>
                                        <th>Doctor-in-charge</th>
                                        <th>Patient</th>
                                        <th>Prescription</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($labs as $lab)
                                    <tr>
                                        <td><a target="_blank" href="{{ url('/viewreport') }}/?report_id={{ $lab->report_id }}">{{ $lab->report_id }}</a></td>
                                        <td>{{ $lab->doctor_id }}</td>
                                        <td>
                                            @forelse($user1 as $user)
                                                @if($lab->unique_id==$user->unique_id)
                                                    {{ $user->fname }} {{ $user->lname }}
                                                @endif
                                            @empty
                                            @endforelse
                                            ({{ $lab->unique_id }})
                                        </td>
                                        <td>{{ $lab->prescription }}</td>
                                        <td>
                                            <a href="{{ url('/alldrugs') }}/?id={{ $lab->id }}" class="btn btn-warning btn-xs">Attend To</a>
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