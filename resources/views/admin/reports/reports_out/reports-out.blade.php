@extends('admin.admin')
@section('content')
<div class="row">
            <form action="{{route('Search_Report_OrderOut')}}" method="POST" role="search" autocomplete="off" enctype="multipart/form-data">
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
<br>

                <!-- <div class="row"> -->
                                <!-- <div class="col-sm-1 col-md-1"> -->
                                    <button class="btn btn-danger m-b-20 m-r-10">بحث</button>
                                <!-- </div> -->
                <!-- </div> -->
</form>


<div class="card-body">
    <div class="table-responsive">
                    @if (isset($orderReports))
                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                        <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الطلب</th>
                                    <th class="border-bottom-0">نوع المنتج</th>
                                    <th class="border-bottom-0">اسم المستخدم</th>
                                    <th class="border-bottom-0">اسم منفذ</th>
                                    <th class="border-bottom-0">تاريخ الطلب</th>
                                    <th class="border-bottom-0">حالة  الطلب</th>
                                    <th class="border-bottom-0">سعر المبيع</th>
                                    <th class="border-bottom-0">سعر الشراء</th>
                                    <th class="border-bottom-0">العمولة</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($orderReports as $orderReport)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{$orderReport->id }} </td>
                                        <td>{{$orderReport->message}} </td>
                                        <td>{{$orderReport->Userinfo->fname }}</td>
                                        <td>{{$orderReport->name_admin }}</td>
                                        <td>{{$orderReport->updated_at}}</td>
                                        <td>
                                            @if ($orderReport->status == 0)
                                            <span class="text-success">{{ $orderReport->status }}</span>
                                            @elseif($orderReport->status == 1)
                                            <span class="text-danger">{{ $orderReport->status }}</span>
                                            @else
                                            <span class="text-warning">{{ $orderReport->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{$orderReport->price}}</td>
                                        <td>{{$orderReport->price_act}}</td>
                                        <td>{{$orderReport->commission}}</td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($i == 0)
                        <button class="btn btn-success m-r-10"  disabled onclick="tablesToExcel(['example'], ['OrderReport'], 'تقارير الطلبات.xls', 'Excel')">{{trans('electronic/electronic.Export to Excel')}}</button>
                        @else
                        <button class="btn btn-success m-r-10"   onclick="tablesToExcel(['example'], ['OrderReport'], 'تقارير الطلبات.xls', 'Excel')">{{trans('electronic/electronic.Export to Excel')}}</button>
                        @endif
                        @endif
                        

                        </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/js_export.js')}}"></script>
@endsection