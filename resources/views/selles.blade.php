<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Data Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini"  dir="rtl">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../dist/img/avatar04.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"></span>
                </a>
            
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-right image">
              <img src="dist/img/avatar04.png" class="img-circle bi bi-person" alt="User Image">

            </div>
            <div class="pull-left info">
                @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
              <a href="#"><i class="fa fa-circle text-success"></i>     </a>
            </div>
          </div>
          <!-- search form -->
        <!--   <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">
            <li class="header">ﯼﻞﺻا ﯼﺮﺑﻭﺎﻧ</li>
            <li class="active treeview">
              <a href="/">الرئيسية</a>
             
            </li>
            <li class="treeview">
              <a href="{{url('product')}}">
                <i class="fa fa-files-o"></i>
                المنتجات               </a>
             
            </li>
            <li>
              <a href="{{url('supply')}}">
                <i class="fa fa-th"></i>
<i class="bi bi-person-fill"></i>
                 <span>الموردين</span> <small class="label pull-left bg-green">  </small> </a>
            </li>
         
            <li class="treeview">
              <a href="{{url('unitpro')}}">
                <i class="fa fa-laptop"></i>
                <span>الوحدة </span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{url('customer')}}">
                <i class="fa fa-edit"></i> <span>العملاء</span>
              </a>
             
            </li>
                <li class="treeview">
              <a href="{{url('selles')}}">
                <i class="fa fa-table"></i> <span>المبيعات</span>
              </a>
             
            </li>
                <li class="treeview">
              <a href="{{url('purchase')}}">
                <i class="fa fa-table"></i> <span>المشتريات</span>
              </a>
             
            </li>
            <!-- li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li> -->
           <!--  <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-left bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-left bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
  <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> <span>Profil<small class="label bg-red">ﺪﻳﺪﺟ</small></a></li>
              </ul>
            </li> -->
            <li class="treeview">
              <a href="{{url('invoices')}}">
                <i class="fa fa-share"></i> <span>المخزن</span>
              </a>
           
            </li>

            <li class="treeview">
              <a href="{{ route('profile.edit')}}">
                <i class="fa fa-share"></i> <span>تعديل البيانات </span>
              </a>
           
            </li>

            <li class="header">لوحة التحكم</li>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
المبيعات
            <small>..</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الرائيسية</a></li>
            <li><a href="#">جدول</a></li>
            <li class="active">بيانات  المبيعات</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
        <!-- /.box -->

              <div class="box">
                <div class="box-header">
<form method="post" action="{{route('selles.StoreDat')}}">  
      @csrf


<label for="browser" class="form-label"><h4>اختر العميل  </h4></label>
<select class="selectpicker" aria-label=".form-select-lg example"  name="custname">
  @foreach ($custtfatch as $valrt)
  <option  value="{{$valrt->cusname}}">{{$valrt->cusname}}</option>
@endforeach

</select>


<button type="submit" class="btn btn-primary">حفظ</button>

</form>




                </div><!-- /.box-header -->
                <div class="box-body"  >
                  <table id="example1" class="table table-bordered table-striped">

                    <thead >
                      <tr>
                <th>اسم المنتج</th>
                        <th>الكمية</th>
                        <th>الوحدة</th>
                        <th>سعر بيع المنتج</th>
                        <th>الكمية المتوفرة</th>
                        <th>الاجراء</th>
                      </tr>
                    </thead>
                    <tbody>
                                 @foreach ($cus as $mdas)

                      <tr>
                        <td>{{ $mdas->proname}}</td>
                        <td>
                          <form method="get" action="InsertSel/{{$mdas->id}}">
      <input type="number" min="1" class="form-control" required id="recipient-name" name="proquan">
      <input type="hidden" min="1" class="form-control" value="" name="custname">



                     </td>
                        <td>{{ $mdas->prounite }}</td>
                        <td> {{ $mdas->proprice }}</td>
                        <td> {{ $mdas->proquan }}</td>
                        <td>

 <div class="btn-group mr-2 " role="group" aria-label="Second group">

<button type="submit"   class="btn btn-warning"   >اضافة</button>

  </div>
                                          </form>

</td>
                      </tr>

                                     @endforeach

 
            



                    </tbody>
                    <tfoot>
                      <tr>
                        <th>اسم المنتج</th>
                        <th>الكمية</th>
                        <th>الوحدة</th>
                        <th>سعر بيع المنتج</th>
                        <th>الكمية المتوفرة</th>
                        <th>الاجراء</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


              <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
          <form method="post" action="{{route('selles.ConcatData')}}">  
      @csrf

    
  <button  formtarget="_blank" id="redirectButton" class="btn btn-success btn-lg btn-block">اصدار فاتورة</button>
              </div><!-- /.box-header -->
              <div class="box-body" style="text-align: center;">
                <div class="form-check">

  <input class="form-check-input" type="checkbox" value="" id="chexks">
  <label class="form-browser" class="form-label" for="chexks">
   الدفعات
  </label>
<div class="form-check" id="chexksinWrapper" style="display: none;">

  <input  class="form-control" type="number"  name="cuspayam" id="chexksin">
</div>
</form>
</div>

                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                <th>رقم  الفاتورة</th>
                      <th>العميل</th>
                      <th>اسم  الصنف</th>
                      <th>الكمية</th>
                      <th>المبلغ</th>
                      <th>الوحدة</th>
                      <th>الاجراء</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sells as $showda)
                    @if ($showda->invono == session()->get('invo'))
                    <tr>
                      <td>{{ $showda->invono}}</td>
                      <td>{{ $showda->custname }}</td>
                      <td>{{ $showda->proname}}</td>
                      <td>{{ $showda->proquan}}</td>
                      <td>{{ $showda->total }}</td>
                      <td>{{ $showda->prounite }}</td>
                      <td><a href="selles/{{$showda->id}}" type="button" class="btn btn-danger">حذف</a></td>
                    </tr>
@endif
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>رقم  الفاتورة</th>
                      <th>العميل</th>
                      <th>اسم  الصنف</th>
                      <th>الكمية</th>
                      <th>المبلغ</th>
                      <th>الوحدة</th>
                      <th>الاجراء</th>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->




            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
   

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
@include('sweetalert::alert')

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
       $(function () {
        $('#example1').DataTable({

          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true 
        });
      });

$(function () {
        $('#example2').DataTable({

          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true 
        });
      });


   $(document).ready(function() {
    // Add event listener for checkbox change
    $("#chexks").on("change", function() {
      // Check if the checkbox is checked or not
      if ($(this).prop("checked")) {
        // Show the input field if the checkbox is checked
        $("#chexksinWrapper").show();
      } else {
        // Hide the input field if the checkbox is not checked
        $("#chexksinWrapper").hide();
      }
    });
  });


     $(document).ready(function() {
        // Add an event listener to the button
        $('#redirectButton').click(function() {
            // Perform the redirect
  setTimeout(function() {
                window.location.href = "/selles";
            }, 2000); // 2000 milliseconds = 2 seconds
                    });
    });
    </script>
    <style>
        td{
            font-size: 18px;
                text-align: center;

        }

th{
    text-align: center;
}

    select {
        width: 250px;
        margin: 10px;
    font-size:20px;}
    select:focus {
        min-width: 250px;
        width: auto;
    }
    </style>
  </body>
</html>
  