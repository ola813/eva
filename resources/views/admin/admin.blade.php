<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----token ----->
  <link rel="mainfest" href="{{asset('assets/mainfest.json')}}"/>
  <meta name="csrf-token" content="{{csrf_token()}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap-rtl.min.css')}}">
  <!-- bootstrap  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{asset('assets/css/util.css')}}">
  <!----select2 css -->
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}"  />
  <!---SweetAlert -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
  <!---datatables-->
  <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/css/custom-style.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
   
      <!-- translate languages -->
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->
      <!-- <li class="nav-item"> -->
              
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                
                <x-responsive-nav-link :href="route('logout')" class="text-danger"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{trans('layout/sidebar.Log Out')}}
                <i class="nav-icon fa fa-sign-out"></i>
                      </x-responsive-nav-link>
                    </form>
            <!-- </li>  -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown show-order ">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-warning navbar-badge m-t--12 number-alert">{{$numberAlert}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left notfcation-style">
          <span class="dropdown-item dropdown-header number-message"> عدد الاشعارات {{$numberAlert}}</span>
      
        <ul class="menu order-notifcayion">
          
         
        </ul>
          <a href="#" class="dropdown-item dropdown-footer">مشاهدة كل الإشعارات</a>
        </div>
      </li>
      

    </ul>
  </nav>
  <!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
      <img src="{{asset('assets/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <!-- <span class="brand-text font-weight-light">EvaCard </span> -->
    </a>

    

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://secure.gravatar.com/avatar/5ffa2a1ffeb767c60ab7e1052e385d5c?s=52&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">admin</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
              <a href="{{route('admin.view')}}" class="nav-link">
              <i class="nav-icon fa fa-user-secret"></i>
                <p>
                  {{trans('layout/sidebar.admins')}}
                </p>
              </a>
            </li>
            <li class="nav-item ">
              <a href="{{route('admin.view-user')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
                <p>
                {{trans('layout/sidebar.Users')}}
                </p>
              </a>
            </li>
        
             
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-archive"></i>
                <p>
                {{trans('layout/sidebar.Category and product')}}
                <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('Categories')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Category')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('create-item')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Add New Product')}}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="nav-icon  fa fa-truck"></i>
                <p>
                {{trans('layout/sidebar.orders')}}
                <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('view-new-order')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-accept-order')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-cancel-order')}}" class="nav-link">
                  <i class="nav-icon fa fa-check-square-o"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
                <li class="nav-item ">
              <a href="{{route('getAllcoupons')}}" class="nav-link">
              <i class="nav-icon fa fa-download" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.order out')}}
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{route('view-new-order-out')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-accept-order-out')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-cancel-order-out')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
                 
              </ul>
          </li>

          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="nav-icon  fa fa-truck"></i>
                <p>
                {{trans('layout/sidebar.order cache account')}}
                <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('getAllopenaccount')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('Acceptopenaccount')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-cancel-openaccount')}}" class="nav-link">
                  <i class="nav-icon fa fa-check-square-o"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
            </li>
            
              </ul>
         
            </li>

            <li class="nav-item ">
              
              <a class="nav-link">
                <i class="nav-icon fa fa-credit-card-alt" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Payment')}}
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('Payments')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('Acceptcharge')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('view-cancel-Charge')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
            </li> 

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file-text-o" aria-hidden="true"></i>
                <p>
                {{trans('layout/sidebar.Billies')}}
                <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a  class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.order Electricity Bills')}}</p>
                  </a>
                  <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('ElectronicNewOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptOrderElectronic')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('CancelOrderElectronic')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.order phone bills')}}</p>
                  </a>
                  <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('PhoneNewOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptOrderphone')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('CancelPhoneOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.order mobile bills')}}</p>
                  </a>
                  <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('MobileNewOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptOrderMobile')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('CancelMobileOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
                </li>
                <li class="nav-item">
                  <a  class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.order internet Bills')}}</p>
                  </a>
                  <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('netNewOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptOrdernet')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
              </ul>
                </li>
              </ul>
            </li>

            <li class="nav-item ">
              <a href="{{route('admin.view')}}" class="nav-link">
                <i class="nav-icon fa fa-phone" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Balance Transfers')}}
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('AccountPage')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Add new balance')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AllAccount')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.list balance')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('OrderBalance')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptBalance')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('CancelBlanceOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item ">
              <a href="{{route('admin.view')}}" class="nav-link">
              <i class="nav-icon fa fa-briefcase" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Company')}}
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('showCompany')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Company_name')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('showCompanyinter')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Company_internet')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ShowPayELec')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.Payment Electornic')}}</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item ">
              <a href="{{route('admin.view')}}" class="nav-link">
                <i class="nav-icon fa fa-file-text-o" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Reoprts')}}
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('SearchPage')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportOrder')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ReportElectronic')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportElectronic')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ReportMobile')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportMobile')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ReportPhone')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportPhone')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('Reportinternet')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportInternet')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ReportBalance')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportBalance')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ReportOrderOut')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.ReportOrderOut')}}</p>
                  </a>
                </li>
              </ul>
            </li> 

   
        
            <li class="nav-item ">
              <a href="{{route('showmessage')}}" class="nav-link">
                <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Messages')}}
                </p>
              </a>
          </li>
            
      
          </li>
            <li class="nav-item ">
              <a href="{{route('showAllImage')}}" class="nav-link">
                <i class="nav-icon fa fa-picture-o" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Image offer')}}
                </p>
              </a>
          </li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="nav-icon  fa fa-truck"></i>
                <p>
                {{trans('layout/sidebar.order cache')}}
                <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('CacheNewOrder')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.New orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('AcceptOrdercache')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{trans('layout/sidebar.accept orders')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('CancelcacheOrder')}}" class="nav-link">
                  <i class="nav-icon fa fa-check-square-o"></i>
                    <p>{{trans('layout/sidebar.Cancel orders')}}</p>
                  </a>
                </li>
              </ul>
            </li>
       

            <li class="nav-item ">
              <a href="{{route('getAllcoupons')}}" class="nav-link">
                <i class="nav-icon fa fa-gift" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.Coupons')}}
                </p>
              </a>
          </li>
            <li class="nav-item ">
              <a href="{{route('getAllcodegame')}}" class="nav-link">
                <i class="nav-icon fa fa-gift" aria-hidden="true"></i>
                <p>
                  {{trans('layout/sidebar.code game')}}
                </p>
              </a>
          </li>

            
      
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- <div class="container-fluid"> -->
      @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here -->
  <!-- </aside> -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!---select2 library --->
<!--------SweetAlert------->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- jQuery -->
<!-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> -->
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/js/adminlte.js')}}"></script>
<!---dtatatable-->
<script type="text/javascript" src="{{asset('assets/js/dataTables.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{asset('assets/js/pages/dashboard.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/admin_script.js')}}"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
<script src="{{asset('assets/js/firebase.js')}}"></script>
<!-- <script src='https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js'></script>
<script src='https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js'></script> -->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@if(Session('status'))
<script>
  swal("{{Session('status')}}")
  </script>
@endif
@yield('scripts')
</body>
</html>
