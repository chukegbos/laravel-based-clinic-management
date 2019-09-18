@extends('layouts.admin')
@section('pageTitle', 'All Patient')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>
                @if(isset($outpatient))
                    All Out-Patient
                @elseif(isset($inpatient))
                    All In-Patient
                @else
                    All Patients
                @endif
            </h1>
            <small>Patient list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Patients</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    @if(Auth::user()->role=="Admin")
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="{{ url('patients') }}"> <i class="fa fa-plus"></i> Add Patients
                            </a>  
                        </div>        
                    </div>
                    @endif
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
                                        <th>Patient's No</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Action</th>
                                        @if(Auth::user()->role=="Admin")
                                        <th>Delete</th>
                                        @endif
                                        @if(isset($outpatient))
                                            <th>Date of next appointment</th>
                                        @elseif(isset($inpatient))
                                            <th>Ward</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($outpatient))
                                        @forelse($patients as $patient)
                                            @forelse($appointments as $user)
                                                @if($patient->unique_id==$user->unique_id)
                                                    <tr>
                                                        <td>
                                                            <label>{{ $patient->unique_id }}</label>   
                                                        </td>

                                                         <td>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</td>
                                                         <td><a href="mailto:{{ $patient->email }}">{{ $patient->email }}</a></td>
                                                         <td>{{ $patient->phone }}</td>
                                                        
                                                        <td>
                                                            <a href="{{ url('/') }}/viewpatient/?unique_id={{ $patient->unique_id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> View Profile</a>  <a href="{{ url('/') }}/report/?unique_id={{ $patient->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> View Report</a>
                                                        </td>
                                                        @if(Auth::user()->role=="Admin")
                                                        <td>
                                                            <form action="{{ url('/deletepatient') }}/{{$patient->id}}" method="POST">
                                                              {{ csrf_field() }}
                                                              {{ Method_field('DELETE') }}
                                                              
                                                               <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                                            </form>
                                                        </td>
                                                        @endif
                                                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->toFormattedDateString() }}</td>
                                                        <td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        @empty
                                        @endforelse
                                    @elseif(isset($inpatient))
                                        @forelse($patients as $patient)
                                            @forelse($inpatients as $user)
                                                @if($patient->unique_id==$user->occupant)
                                                    <tr>
                                                        <td>
                                                            <label>{{ $patient->unique_id }}</label>   
                                                        </td>

                                                         <td>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</td>
                                                         <td><a href="mailto:{{ $patient->email }}">{{ $patient->email }}</a></td>
                                                         <td>{{ $patient->phone }}</td>
                                                        
                                                        <td>
                                                            <a href="{{ url('/') }}/viewpatient/?unique_id={{ $patient->unique_id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> View Profile</a>  <a href="{{ url('/') }}/report/?unique_id={{ $patient->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> View Report</a>
                                                        </td>
                                                        @if(Auth::user()->role=="Admin")
                                                        <td>
                                                            <form action="{{ url('/deletepatient') }}/{{$patient->id}}" method="POST">
                                                              {{ csrf_field() }}
                                                              {{ Method_field('DELETE') }}
                                                              
                                                               <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                                            </form>
                                                        </td>
                                                        @endif
                                                        <td>{{ $user->ward}}, Bed {{ $user->number }}</td>
                                                        <td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        @empty
                                        @endforelse
                                    @else

                                        @forelse($patients as $patient)
                                        <tr>
                                            <td>
                                                <label>{{ $patient->unique_id }}</label>   
                                            </td>

                                             <td>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</td>
                                             <td><a href="mailto:{{ $patient->email }}">{{ $patient->email }}</a></td>
                                             <td>{{ $patient->phone }}</td>
                                            
                                             <td>
                                                <a href="{{ url('/') }}/viewpatient/?unique_id={{ $patient->unique_id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> View Profile</a>  <a href="{{ url('/') }}/report/?unique_id={{ $patient->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> View Report</a>
                                            </td>
                                            @if(Auth::user()->role=="Admin")
                                            <td>
                                                <form action="{{ url('/deletepatient') }}/{{$patient->id}}" method="POST">
                                                  {{ csrf_field() }}
                                                  {{ Method_field('DELETE') }}
                                                  
                                                   <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        @endforelse
                                    @endif
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
                        <a class="btn btn-primary" href="table.html"> <i class="fa fa-list"></i>  patient List </a>  
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