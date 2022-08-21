@extends('admin.admin')
@section('title','لوحة التحكم')
@section('content')
     <div class="row">
              <!-- ./col -->  
              <div class="col-lg-3 col-md-6 col-sm-12 mt-40">
                    <!-- small box -->
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{\App\Models\User::query()->count()}}</h3>

                        <p> العملاء</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{route('admin.view-user')}}" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
          </div>
         <!-- ./col -->

             <!-- ./col -->
                 <div class="col-lg-3 col-md-6 col-sm-12 mt-40">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                    <h3>{{\App\Models\Order::query()->count()}}</h3>

                        <p> الطلبات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
             </div>
          <!-- ./col -->
             <!-- ./col -->
                 <div class="col-lg-3 col-md-6 col-sm-12 mt-40">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                      
                    <h3>{{\App\Models\Product::query()->count()}}</h3>
                        <p> المنتجات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
             </div>
          <!-- ./col -->
             <!-- ./col -->
                 <div class="col-lg-3 col-md-6 col-sm-12 mt-40">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                      
                    <h3>{{\App\Models\Order::where('status',0)->count()}}</h3>
                        <p> الطلبات المعلقة</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
             </div>
          <!-- ./col -->
     </div>
@endsection