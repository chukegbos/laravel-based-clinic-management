@extends('layouts.admin')
@section('pageTitle', 'Add Report')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1>Add Report</h1>
          <small>Add Report</small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Add Report</li>
          </ol>
      </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- Form controls -->
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
                  <div  class="col-sm-12">
                    <p>Name: <a href="{{ url('/') }}/editpatient/?unique_id={{ $patient->unique_id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> {{ $patient->lname }} {{ $patient->fname }} {{ $patient->mname }}</a> </p>
                  </div>
                  <form class="col-sm-12" method="POST" action="{{ url('addreport') }}"  enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="col-sm-12 form-group">
                      <label>1. DISEASE or CONDITION (Provide details in problem scope below for any box checked.)</label>
                      <div>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Neurological"/>  Neurological
                        </label>
                        <label class="radio-inline"> 
                          <input type="checkbox" name="category[]" value="Cardiovascular"/> Cardiovascular 
                        </label>
                        <label class="radio-inline"> 
                          <input type="checkbox" name="category[]" value="Diabetes"/>  Diabetes
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Psychological"/>  Psychological
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Dementia"/>  Dementia
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Hypoglycemia"/> Hypoglycemia 
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Epilepsy"/>  Epilepsy
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Loss of Consciousness"/>  Loss of Consciousness
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Orthopedic/Prosthetic"/>  Orthopedic/Prosthetic
                        </label>
                        <label class="radio-inline">
                          <input type="checkbox" name="category[]" value="Others"/>  Others
                        </label>
                      </div>
                    </div> <br>

                      <div class="col-sm-12 form-group">
                          <label>2. Problem Scope (Describe the nature, extent and frequency of any of the patient’s symptoms, especially those that might affect the safe operation of a motor vehicle.)</label>
                          <textarea class="form-control" name="problem_scope" rows="5" required=""></textarea>
                      </div><br>

                      <div class="col-sm-12 form-group">
                          <label>3. Diagnosis/Treatment (medical/surgical/device):</label>
                          <textarea class="form-control" name="diagnosis" rows="5" required=""></textarea>
                      </div><br>

                      <div class="col-sm-12 form-group">
                          <label>4. Recommendation</label>
                          <input type="hidden" name="report_id" value="{{ $random_number }}">
                          <input type="hidden" name="unique_id" value="{{ $patient->unique_id }}">
                          <input type="hidden" name="doctor_id" value="{{ Auth::user()->unique_id }}">
                          <textarea class="form-control" name="recommendation" rows="5" required=""></textarea>
                      </div><br>

                      <div class="col-sm-12 form-group">
                          <label>5. Drug Prescription (List the drugs, the usage and quantity eg. 1. Paracetamol  2 X 3 for 12days):</label>
                          <textarea class="form-control" name="prescription" rows="5"></textarea>
                      </div><br>

                      <div class="col-sm-4 form-group">
                        <label>6. Needs Operation?</label>
                          <select  name="operation" class="form-control">
                              <option value="Yes">Yes</option>
                              <option Selected value="No">No</option> 
                          </select>
                      </div>

                      <div class="col-sm-4 form-group">
                        <label>7. Needs Lab Test?</label>
                          <select  name="lab_test" class="form-control">
                              <option value="Yes">Yes</option>
                              <option Selected value="No">No</option> 
                          </select>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label>8. Is the disease or condition controlled?</label>
                          <select  name="controlled" class="form-control">
                              <option value="Yes">Yes</option>
                              <option Selected value="No">No</option> 
                          </select>
                      </div>

                      <div class="col-sm-4 form-group">
                        <label>9. Is the patient capable of safe and competent driving?</label>
                          <select  name="competent_driving" class="form-control">
                              <option value="Yes">Yes</option>
                              <option Selected value="No">No</option> 
                          </select>
                      </div>


                      

                      <div class="col-sm-4 form-group">
                            <label>10. Department/Unit-in-charge</label>
                            <select class="js-example-basic-single form-control" name="department">
                            <!--<select name="department" class="form-control" id="exampleSelect1" name="select" size="1">-->
                              @forelse($departmentss as $department)
                                <option value="{{ $department->name }}">{{$department->name}}</option>
                              @empty
                              @endforelse
                            </select> 
                      </div>
                      <input type="hidden" name="oldreport_id" value="{{ $report_id }}">
                      <div class="col-sm-4 form-group">
                        <label>11. Recommend Admission?</label>
                          <select name="admission" class="form-control"  id="mySelect" onchange="myFunction()">
                              <option value="Yes">Yes</option>
                              <option Selected value="No">No</option> 
                          </select>
                      </div>

                      <div class="col-sm-3 form-group">
                          <div id="wrapper"></div>
                      </div>

                      <div class="col-sm-2 form-group">
                      </div>

                      <div class="col-sm-8 form-group">
                      
                        <label class="radio-inline">
                          <input type="checkbox" required=""/>  By Submiting this report, you agreed for your signature to be appended
                        </label>
                      </div>

                      <div class="col-sm-12 reset-button">
                        <button class="btn btn-warning" type="submit">Submit</button>
                      </div>
                   </form>
               </div>
           </div>
      </div>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<script>
  function myFunction() {
    var x = document.getElementById("mySelect").value;
    if (x=="No") {
      var codeBlock = 
      '<label>12. Next Date of Appointment</label>'+
      '<input class="form-control" type="date" name="checkup" style="font-size: 14px;border-radius: 2px;border: 1px solid #ccc;display: block;width: 310px;padding: .5rem .75rem;line-height: 1.25;color: #495057;background-color: #fff;">'+

    document.getElementById("wrapper").innerHTML = codeBlock
    }
  }
</script>
@endsection