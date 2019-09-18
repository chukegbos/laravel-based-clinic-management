<aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                       
                        <div class="info">
                            <h4>Welcome</h4>
                            @if (Auth::guard('web')->check())
                            <p>{{ ucfirst(Auth::user()->fname) }}</p>
                            @endif
                        </div>
                    </div>
                   
                    <!-- sidebar menu -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{ url('/') }}"><i class="fa fa-hospital-o"></i><span>Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::guard('web')->check())
                            @if(Auth::user()->role=="Doctor")
                            
                                <li>
                                    <a href="{{ url('/allpatients') }}"><i class="fa fa-user"></i><span>Patients</span></a>
                                </li>

                                <li>
                                    <a href="{{ url('/report') }}"><i class="fa fa-check-square-o"></i><span>General Report</span></a>
                                </li>

                                <li>
                                    <a href="{{ url('/labreports') }}"><i class="fa fa-file-text"></i><span>Laboratory Report</span></a>
                                </li>

                                <!--<li>
                                    <a href="{{ url('/optreport') }}"><i class="fa fa-list-alt"></i><span>Operation Report</span></a>
                                </li>-->
                            @elseif(Auth::user()->role=="Lab Scientist")
                                <li>
                                    <a href="{{ url('/laborders') }}"><i class="fa fa-check-square-o"></i><span>Lab Test Orders</span></a>
                                </li>
                                
                                <li>
                                    <a href="{{ url('/optreport') }}"><i class="fa fa-list-alt"></i><span>Booked Orders</span></a>
                                </li>

                                <li>
                                    <a href="{{ url('/labreports') }}"><i class="fa fa-file-text"></i><span>Lab Results</span></a>
                                </li>
                            @elseif(Auth::user()->role=="Admin")
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-user-md"></i><span>Doctor</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/doctors') }}">Add Doctor</a></li>
                                        <li><a href="{{ url('/alldoctors') }}">Doctor list</a></li>
                                        
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="">
                                        <i class="fa fa-edit"></i><span>Appointment</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/addappoint') }}">Book Appointment</a></li>
                                        <li><a href="{{ url('/appointments') }}/?today=now">Today's Appointments</a>
                                        <li><a href="{{ url('/appointments') }}/?current=now">Current Appointments</a>
                                        <li><a href="{{ url('/appointments') }}">Appointment History</a></li>
                                       
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="">
                                        <i class="fa fa-user-circle-o"></i><span>Human Resources</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/addstaff') }}">Add Employee</a></li>
                                        <li><a href="{{ url('/stafflist') }}">Employee list</a></li>            
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-sitemap"></i><span>Department/Units</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/departments') }}">Add Department/Units</a></li>
                                        <li><a href="{{ url('/alldepartments') }}">Department/Units list</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-user"></i><span>Ledger/Files</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/patients') }}">Add Patient</a></li>
                                        <li><a href="{{ url('/allpatients') }}">Files</a></li>
                                        <li><a href="{{ url('/allpatients') }}/?type=outpatient">Out-Patients</a></li>
                                        <li><a href="{{ url('/allpatients') }}/?type=inpatient">In-Patients</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-check-square-o"></i><span>Medical Records</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/report') }}">General Report</a></li>
                                        <li><a href="{{ url('/labreports') }}">Laboratory Report</a></li>
                                    </ul>
                                </li>

                                
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-file-text"></i><span>Wards</span>
                                        <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/addward') }}">Add Ward</a></li>
                                        <li><a href="{{ url('/wards') }}">Ward Lists</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-bed"></i><span>Bed Manager</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/addbed') }}">Add Bed</a></li>
                                        <li><a href="{{ url('/beds') }}">Bed list/Occupants</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="hvr-buzz-out fa fa-bath"></i><span>Admission</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ url('/admission') }}">Admission Request <span style="color: white; float: right;" class="badge">{{ $admission_order }}</span></a>
                                        </li>
                                        <li><a href="{{ url('/admissionstatus') }}">Admission Status</a></li>
                                        <li><a href="{{ url('/admissionhistory') }}">Admission History</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-edit"></i><span>Billing</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/servicelist') }}">Billing Services</a></li>
                                        <li><a href="{{ url('/invoice') }}"> Add Bill</a></li>
                                        <!--<li><a href="{{ url('/packagelist') }}">Billing Packages</a></li>-->
                                        <li><a href="{{ url('/billlist') }}">Billing List</a></li>
                                    </ul>
                                </li>
                            @elseif(Auth::user()->role=="Pharmacist")
                                <li>
                                    <a href="{{ url('/prescription') }}"><i class="fa fa-user"></i><span>Request</span><span class="badge pull-right">{{ $drugorder }}</span></a>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-medkit"></i><span>Medicine Inventory</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/drugcat') }}"><i class="fa fa-medkit"></i> <span>Drug Category</span></a></li>
                                        <!--<li><a href="#" data-toggle="modal" data-target="#drugcat"><i class="fa fa-plus"></i><span>Add Category</span></a></li>-->
                                        <li><a href="{{ url('/alldrugs') }}"><i class="fa fa-medkit"></i> <span>Drug Inventory</span></a></li>
                                        <!--<li><a href="#" data-toggle="modal" data-target="#adddrug"><i class="fa fa-plus"></i><span>Add Drug</span></a></li>-->
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" data-toggle="modal" data-target="#adddrug"><i class="fa fa-file-text"></i><span>Add Medicine</span></a>
                                </li>

                                <li>
                                    <a href="{{ url('/drugsale') }}"><i class="fa fa-money"></i><span>Sales</span></a>
                                </li>

                                <li>
                                    <a href="{{ url('/orders') }}"><i class="fa fa-list-alt"></i><span>Bills & Reciept</span></a>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-bank"></i><span>Expense Manager</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="{{ url('/expensecat') }}"><i class="fa fa-bank"></i> <span>Expense Category</span></a></li>
                                        <!--<li><a href="#" data-toggle="modal" data-target="#drugcat"><i class="fa fa-plus"></i><span>Add Expense Category</span></a></li>-->
                                        <li><a href="{{ url('/allexpense') }}"><i class="fa fa-bank"></i> <span>All Expense</span></a></li>
                                        <!--<li><a href="#" data-toggle="modal" data-target="#adddrug"><i class="fa fa-plus"></i><span>Add Expense</span></a></li>-->
                                    </ul>
                                </li>
                            @endif
                         @endif
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>