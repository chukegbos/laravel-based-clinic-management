@extends('layouts.admin')
@section('pageTitle', 'Ward Lists')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Ward</h1>
            <small>Ward list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Ward</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="{{ url('addward') }}"> <i class="fa fa-plus"></i> Add Ward
                            </a>  
                        </div>        
                    </div>
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <!--<th>Status</th>-->
                                        <th>Number of beds</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($wards as $ward)
                                    <tr>
                                        <td>
                                            <label>{{ $ward->name }}</label>   
                                        </td>
                                        <td>
                                            <label>{{ $ward->gender}} Ward</label>   
                                        </td>
                                        <!--<td>
                                          @if($ward->status=="Active")
                                            <label><span class="label label-success">{{ $ward->status }}</span></label>
                                          @else
                                            <label><span class="label label-warning">{{ $ward->status }}</span></label>  
                                          @endif  
                                        </td>-->
                                        <td>
                                            <label>{{ $ward->beds }}</label>   
                                        </td>
                                     
                                        <td>
                                            <form action="{{ url('/deleteward') }}/{{$ward->id}}" method="POST">
                                              {{ csrf_field() }}
                                              {{ Method_field('DELETE') }}
                                              
                                               <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                            </form>
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