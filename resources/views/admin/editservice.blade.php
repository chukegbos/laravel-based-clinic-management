@extends('layouts.admin')
@section('pageTitle', 'Edit Services')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">  
            <h1>Edit Service</h1>
            <small></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Service</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form class="col-sm-12" method="POST" action="{{ url('/editservice') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name of Service</label>
                                <input type="hidden" name="id" value="{{ $service->id }}">
                                <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description of Service</label>
                                <textarea class="form-control" name="description"> {{ $service->description }} </textarea>
                            </div>                      
                            <div class="form-group">
                                <label>Quantity/Price</label>
                                <input type="number" class="form-control" name="quantity" value="{{ $service->quantity }}" required>
                            </div>                      
                            <div class="form-group">
                                <label>Rate (Per Day/Per Service</label>
                                <input type="number" class="form-control" value="{{ $service->rate }}" name="rate">
                            </div>
                            <div class="reset button">
                                 <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection