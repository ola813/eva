@extends('admin.admin')
@section('content')
<div class="row">
<form action="{{route('Search_Report_Mobile')}}" method="POST" role="search" autocomplete="off" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <!-- <p class="mg-b-10">تحديد نوع الفواتير</p> -->
    <select class="form-control select2 m-t-40 m-b-20" name="typeStatus" required>
        <option value="3" >حدد نوع التقرير </option>

        <option value="0">الطلبات الغير مكتملة</option>
        <option value="1"> الطلبات المكتملة</option>
        <option value="2">الطلبات  المرفوضة</option>

    </select>
</div><!-- col-4 -->

<div class="col-lg-3" id="start_at">
    <label class="m-b-20" for="exampleFormControlSelect1">من تاريخ</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div><input type="date" class="form-control fc-datepicker" value=""
            name="start_at" placeholder="YYYY-MM-DD" type="text">
    </div><!-- input-group -->
</div>

<div class="col-lg-3" id="end_at">
    <label class=" m-b-20 m-t-20" for="exampleFormControlSelect1">الي تاريخ</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div><input type="date" class="form-control fc-datepicker" name="end_at"
            value="" placeholder="YYYY-MM-DD" type="text">
    </div><!-- input-group -->
</div>
<<br>



                <!-- <div class="row">
                    <div class="col-sm-1 col-md-1"> -->
                        <button class="btn btn-danger m-b-20 m-r-10">بحث</button>
                    <!-- </div>
                </div> -->

</form>
</div>

<div class="card-body">
                <div class="table-responsive">
                    @if (isset($orderReports))
                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">ايميل صاحب الطلب</th>
                                    <th class="border-bottom-0">معرف المستخدم</th>
                                    <th class="border-bottom-0">اسم منفذ</th>
                                    <th class="border-bottom-0">نوع الفاتورة</th>
                                    <th class="border-bottom-0">المبلغ</th>
                                    <th class="border-bottom-0">العمولة</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">تاريخ الطلب</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($orderReports as $orderReport)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{$orderReport->user->email}} </td>
                                        <td>{{$orderReport->user->user_id}}</td>
                                        <td>{{$name}}</td>
                                        <td>{{$orderReport->type}}</td>
                                        <td>{{$orderReport->price}}</td>
                                        <td>{{$orderReport->commission}}</td>
                                        
                                        <td>
                                            @if ($orderReport->status == 0)
                                            <span class="text-success">{{trans('electronic/electronic.pending')}}</span>
                                            @elseif($orderReport->status == 1)
                                            <span class="text-danger">{{trans('electronic/electronic.Completed')}}</span>
                                            @else
                                            <span class="text-warning">{{trans('electronic/electronic.Cancel')}}</span>
                                            @endif
                                        </td>
                                        <td>{{$orderReport->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($i == 0)
                        <button class="btn btn-success m-r-10"  disabled onclick="tablesToExcel(['example'], ['OrderReport'], 'تقارير فواتير الموبايل.xls', 'Excel')">{{trans('electronic/electronic.Export to Excel')}}</button>
                        @else
                        <button class="btn btn-success m-r-10"   onclick="tablesToExcel(['example'], ['OrderReport'], 'تقارير فواتير الموبايل.xls', 'Excel')">{{trans('electronic/electronic.Export to Excel')}}</button>
                        @endif
                        @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/js_export.js')}}"></script>
@endsection