@extends('layouts.admin')
@section('pageTitle', 'All Staff')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>Staff</h1>
            <small>Staff list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Staff</li>
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
                            <a class="btn btn-success" href="{{ url('addstaff') }}"> <i class="fa fa-plus"></i> Add Staff
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
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($doctors as $doctor)
                                    <tr>
                                        <td>
                                            <b>{{ $doctor->fname }} {{ $doctor->mname }} {{ $doctor->lname }}</b>
                                            <br>{{ $doctor->unique_id }}
                                        </td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>{{ $doctor->role }}</td>
                                        <td>@if($doctor->status=="1")
                                                <a href="{{ url('/') }}/userban/?unique_id={{ $doctor->unique_id }}" class="btn btn-inverse btn-xs">Ban</a>
                                            @else
                                                <a href="{{ url('/') }}/userban/?unique_id={{ $doctor->unique_id }}" class="btn btn-warning btn-xs">Unban</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('/deletedoctor') }}/{{$doctor->id}}" method="POST">
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

<div id="ordine" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Update table</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group"> 
                        <a class="btn btn-primary" href="table.html"> <i class="fa fa-list"></i>  Doctor List </a>  
                    </div>
                </div>
                <div class="panel-body">
                    <form class="col-sm-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter last Name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" placeholder="Enter Designation" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" name="select" size="1">
                                <option selected class="test">Neurology</option>
                                <option>Gynaecology</option>
                                <option>Microbiology</option>
                                <option>Pharmacy</option>
                                <option>Neonatal</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" id="exampleTextarea" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" placeholder="Enter Phone number" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="number" class="form-control" placeholder="Enter Mobile" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Picture upload</label>
                            <input type="file" name="picture" id="picture">
                            <input type="hidden" name="old_picture">
                        </div>

                        <div class="form-group">
                            <label>Short Biography</label>
                            <textarea id="some-textarea" class="form-control" rows="6" placeholder="Enter text ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Specialist</label>
                            <input type="text" class="form-control" placeholder="Specialist" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input name="date_of_birth" class="datepicker form-control hasDatepicker" type="text" placeholder="Date of Birth">
                        </div>
                        <div class="form-group">
                            <label>Blood group</label>
                            <select class="form-control">
                                <option>A+</option>
                                <option>AB+</option>
                                <option>O+</option>
                                <option>AB-</option>
                                <option>B+</option>
                                <option>A-</option>
                                <option>B-</option>
                                <option>O-</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                         <label>Sex</label><br>
                         <label class="radio-inline">
                             <input type="radio" name="sex" value="1" checked="checked">Male</label> 
                             <label class="radio-inline"><input type="radio" name="sex" value="0" >Female</label>                                     
                             
                         </div>
                         <div class="form-check">
                          <label>Status</label><br>
                          <label class="radio-inline">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="radio-inline">
                              <input type="radio" name="status" value="0" >Inctive
                          </label>
                      </div>                                       
                      
                      <div class="reset button">
                         <a href="#" class="btn btn-primary">Reset</a>
                         <a href="#" class="btn btn-success">Save</a>
                     </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
@endsection