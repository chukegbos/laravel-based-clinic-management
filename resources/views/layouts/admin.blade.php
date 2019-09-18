<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('pageTitle') - {{ $setting->sitename }}</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
       <!-- Start Global Mandatory Style
       =====================================================================-->
       <!-- jquery-ui css -->
       <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
       <!-- Bootstrap -->
       <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
       <!-- Bootstrap rtl -->
       <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
       <!-- Lobipanel css -->
       <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
       <!-- Pace css -->
       <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
       <!-- Font Awesome -->
       <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
       <!-- Pe-icon -->
       <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
       <!-- Themify icons -->
       <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
        <!-- End Global Mandatory Style
        =====================================================================-->
        <!-- Start page Label Plugins 
        =====================================================================-->
        <!-- Toastr css -->
        <link href="assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css"/>
        <!-- Emojionearea -->
        <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
        <!-- Monthly css -->
        <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
        <!-- End page Label Plugins 
        =====================================================================-->
        <!-- Start Theme Layout Style
        =====================================================================-->
        <!-- Theme style -->
        <link href="assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="assets/dist/css/stylehealth-rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- End Theme Layout Style
        =====================================================================-->
       <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
        <style type="text/css">
          .portfolio-item {
            position: relative;
            background: #FFF;
                background-clip: border-box;
            margin-bottom: 10px;
            border: 8px solid #FFF;
            -webkit-border-radius: 5px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 5px;
            -moz-background-clip: padding;
            border-radius: 5px;
            background-clip: padding-box;
            -webkit-box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            -moz-box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            color: inset 0 1px #fff,0 0 8px #c8cfe6;
            -webkit-transition: all .5s ease;
            -moz-transition: all .5s ease;
            -o-transition: all .5s ease;
            -ms-transition: all .5s ease;
            transition: all .5s ease;
          }
          
          .portfolio-item .portfolio-image {
            overflow: hidden;
            text-align: center;
            position: relative;
          }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ url('/') }}" class="logo"> <!-- Logo -->
                    <span class="logo-mini">
                        <!--<b>A</b>H-admin-->
                        <img src="assets/dist/img/mini-logo.png" alt="">
                    </span>
                    <span class="logo-lg">
                        <!--<b>Admin</b>H-admin-->
                        <img src="assets/dist/img/logo.png" alt="">
                    </span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top ">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-tasks"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="pe-7s-bell"></i>
                                    <span class="label label-warning">{{ $admission_order }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><i class="fa fa-bell"></i> {{ $admission_order }} Notifications</li>
                                    <li>
                                        <ul class="menu">
                                            @if(isset($admission_order))
                                                <li>
                                                    <a href="{{ url('/admission') }}" class="border-gray">
                                                        <i class="fa fa-bed"></i> Pending Admisssion Request 
                                                        <span class=" label-success label label-default pull-right">{{ $admission_order }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--<li>
                                                <a href="#" class="border-gray">
                                                    <i class="fa fa-inbox"></i> Inbox  
                                                    <span class=" label-success label label-default pull-right">9</span>
                                                </a>
                                            </li>

                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> New Order <span class=" label-success label label-default pull-right">3</span> </a>
                                            </li>
                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-money"></i> Payment Failed  <span class="label-success label label-default pull-right">6</span> </a>
                                            </li>
                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Order Confirmation <span class="label-success label label-default pull-right">7</span> </a>
                                            </li>
                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Update system status <span class=" label-success label label-default pull-right">11</span> </a>
                                            </li>
                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> client update <span class="label-success label label-default pull-right">12</span> </a>
                                            </li>
                                            <li>
                                            <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> shipment cancel 
                                            <span class="label-success label label-default pull-right">2</span> </a>
                                            </li>-->
                                        </ul>
                                    </li>
                                   <li class="footer">
                                   <a href="#"> See all Notifications <i class=" fa fa-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                            @if (Auth::guard('web')->check())
                                @if(Auth::user()->role=="Pharmacist")
                                <li>
                                    <a href="{{ url('/shoppingcart') }}">
                                        <i class="fa fa-shopping-cart" style="color: white"></i>
                                        <span class="badge" style="margin-top: -50px">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                                    </a>
                                </li>
                                @endif
                            @endif
                            <li class="dropdown dropdown-user admin-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                <div class="user-image">
                                <img src="assets/dist/img/avatar4.png" class="img-circle" height="40" width="40" alt="User Image">
                                </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/profile') }}/?unique_id={{ Auth::user()->unique_id}}"><i class="fa fa-users"></i> User Profile</a></li>

                                    <li>
                                        <a href="{{ url('/password') }}"><i class="fa fa-key"></i><span>Change Password</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>
                                            <span>Logout</span>        
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                        </form>
                                    </li>
                                   
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            @include('component.sidebar') 
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            @yield('content')<!-- /.content-wrapper -->

            <div id="adddrug" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content ">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Add Drug</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-body">
                                <form class="col-sm-12" method="POST" action="{{ url('/alldrugs') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Medicine Category</label>
                                        <select class="form-control" name="category">
                                            @forelse($medicats as $medicat)
                                                <option value="{{ $medicat->id }}">{{ $medicat->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" class="form-control" name="brand_name" placeholder="Emzor" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Genetic Name</label>
                                        <input type="text" class="form-control" name="genetic_name" placeholder="Paracetamol" required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>NAFDAC Number</label>
                                        <input type="text" class="form-control" name="nafdac_number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Batch Number</label>
                                        <input type="text" class="form-control" name="batch_number" required>
                                    </div>
                                    
                                 
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="date" class="form-control" name="expiry_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Regular Price (Amount meant to be sold)</label>
                                        <input type="number" class="form-control" name="reg_price" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Discount Price (Amount to be sold)</label>
                                        <input type="number" class="form-control" name="discount_price" required>
                                    </div>
                                 
                                   <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity" required>
                                    </div>

                                    <div class="reset button">
                                         <a href="#" class="btn btn-primary">Reset</a>
                                         <button type="submit" class="btn btn-success">Save</button>
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
            <footer class="main-footer">
                <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div>
                <strong>Copyright &copy; {{ date('Y')}} <a href="#">NOVAtIQ IT</a>.</strong> All rights reserved.
            </footer>
        </div> <!-- ./wrapper -->
        <!-- ./wrapper -->
         <!-- Start Core Plugins
        =====================================================================-->
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- jquery-ui --> 
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <!-- Pace js -->
        <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <!-- Hadmin frame -->
        <script src="assets/dist/js/custom1.js" type="text/javascript"></script>
        <!-- End Core Plugins
        =====================================================================-->
        <!-- Start Page Lavel Plugins
        =====================================================================-->
        <!-- Toastr js -->
        <script src="assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>
        <!-- Sparkline js -->
        <script src="assets/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
        <!-- Data maps js -->
        <script src="assets/plugins/datamaps/d3.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datamaps/topojson.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datamaps/datamaps.all.min.js" type="text/javascript"></script>
        <!-- Counter js -->
        <script src="assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- ChartJs JavaScript -->
        <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
        <script src="assets/plugins/emojionearea/emojionearea.min.js" type="text/javascript"></script>
        <!-- Monthly js -->
        <script src="assets/plugins/monthly/monthly.js" type="text/javascript"></script>
        <!-- Data maps -->
        <script src="assets/plugins/datamaps/d3.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datamaps/topojson.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datamaps/datamaps.all.min.js" type="text/javascript"></script>
        <script src="{{ asset('vpad/datatable/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
       
        <!-- DataTables -->
        <script src="{{ asset('vpad/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vpad/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('vpad/datatable/data-table.js') }}"></script>
      
        <!-- End Page Lavel Plugins
        =====================================================================-->
        <!-- Start Theme label Script
        =====================================================================-->
        <!-- Dashboard js -->
        <script src="assets/dist/js/custom.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
               
                var fieldHTML = '<div><br>Name of Test: <input type="text" name="test[]" placeholder="Blood Test" style="margin-right: 10px; width: 500px"/>Amount: <input type="number" name="amount[]" placeholder="1000" style="margin-right: 10px; width: 90px"/><a href="javascript:void(0);" class="remove_button btn btn-danger btn-xs">Remove</a></div>'
                var x = 1; //Initial field counter is 1
                
                //Once add button is clicked
                $(addButton).click(function(){
                    //Check maximum number of input fields
                    if(x < maxField){ 
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });
                
                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>


    </body>
</html>