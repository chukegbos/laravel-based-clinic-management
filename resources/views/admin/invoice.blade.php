@extends('layouts.admin')
@section('pageTitle', 'Generate Invoice')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="header-icon">
        <i class="pe-7s-note2"></i>
    </div>
    <div class="header-title">      
      <h1>Invoice</h1>
      <small>Generate Invoice</small>
      <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
        <li class="active">Generate Invoice</li>
      </ol>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd billing-panel ">
          <div class="panel-heading no-print row">
            <div class="btn-group col-xs-2"> 
              <a class="btn btn-primary" href=""> <i class="fa fa-list"></i>  Bill List </a>  
            </div>
          </div> 
 
          <div class="panel-body">
            <form action="" class="billig-form" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                  
                  <div style="background: wheat; padding: 10px; text-align: center">
                    <p>Patient Name:  {{ $patient->lname }} {{ $patient->mname }} {{ $patient->fname }}</p>
                    <p>Patient Phone:  {{ $patient->phone }}</p>
                    <p>Patient Email:  {{ $patient->email }}</p>
                  </div>

                  <div class="table-responsive m-b-20">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Total</th>
                          <th>Receipt</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Total</td>
                          <td><input name="total" type="text" class="form-control grand-calc" id="total" value="0.00"></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-addon">Discount %</div>
                              <input type="text" id="discountPercent" required="" autocomplete="off" class="form-control tax-discount-calc" value="0">
                            </div>
                          </td>
                          <td>
                            <input name="discount" type="text" class="form-control grand-calc" id="discount" value="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-addon">Tax %</div>
                              <input type="text" id="taxPercent" required="" autocomplete="off" class="form-control tax-discount-calc" value="0">
                            </div>
                          </td>
                          <td>
                            <input name="tax" type="text" class="form-control grand-calc" id="tax" value="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>Pay Advance</td>
                          <td>
                            <input type="text" class="form-control grand-calc" id="pay_advance" value="0.00">
                          </td> 
                        </tr>
                        <tr>
                          <td>Payable</td>
                          <td>
                            <input type="text" class="form-control grand-calc" id="payable" value="0.00">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="panel-footer text-center"> 
                <button type="submit" class="btn btn-success w-md">Save</button>
              </div>
            </form>            
          </div>
        </div>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection