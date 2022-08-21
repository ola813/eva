@extends('admin.admin')
@section('title',' قائمة الكوبونات')
@section('content')
   <div class="card-header">
        <h2 class="text-white  m-b-20">{{trans('coupon/coupon.Coupons')}}</h2>
      </div>
      
  <div id="wrapper dir">
    <div id="tabContainer">
        <div id="tabs">
            <ul>
                <li id="tabHeader_1">{{trans('coupon/coupon.coupon discount cart')}}</li>
                <li id="tabHeader_2">{{trans('coupon/coupon.coupon point')}}</li>
            </ul>
        </div>
        <div id="tabscontent">
            <div class="tabpage" id="tabpage_1">
            <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('EditCoupon')}}" class="text-white">{{trans('coupon/coupon.Add Coupon')}}</a></button>
            <table class="table">
         <thead class="table-dark">
          <tr>
              <td>#</td>
            <td>{{trans('coupon/coupon.code')}}</td>
            <td>{{trans('coupon/coupon.coupon type')}}</td>
            <td>{{trans('coupon/coupon.Amount')}}</td>
            <td>{{trans('coupon/coupon.Expiry Date')}}</td>
            <td>{{trans('coupon/coupon.Action')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($coupons as $coupon)
          <tr>
              <td>{{$coupon->id}}</td>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_type}}</td>
            <td>
              @if($coupon->amount_type =='Percentage')
              %
              @else
              ل.س
              @endif
              {{$coupon->amount}}
            </td>
            <td>
              {{$coupon->expiry_date}}
           
          </td>
            <td>
              @if($coupon->status == 1)
              <a class="updateCouponStatus" id ="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}" aria-hidden='true' href="javascript:void(0)"><i class="fa fa-toggle-on" status="Active"></i></a>
              @else
              <a class="updateCouponStatus" id ="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}" aria-hidden='true' href="javascript:void(0)"><i class="fa fa-toggle-off" status="Inactive"></i></a>
              @endif  
             <a href="{{url('Coupons/add-edit-coupon/'.$coupon['id'])}}"><i class="fa fa-edit color-blue"></i></a>
              <a href="javascript:void(0)" title="Delete Coupon" class="confirmDelete"
              record="coupon" recordid="{{$coupon['id']}}"><i class="fa fa-trash color-blue"></i></a>
            </td>
          </tr>
          @empty
            <tr>
              <th colspan='6'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
            </div>

            <div class="tabpage hidden" id="tabpage_2">
            <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('EditpointCoupon')}}" class="text-white">{{trans('coupon/coupon.Add Coupon point')}}</a></button>
            <table class="table">
         <thead class="table-dark">
          <tr>
              <td>#</td>
            <td>{{trans('coupon/coupon.code')}}</td>
            <td>{{trans('coupon/coupon.coupon type')}}</td>
            <td>{{trans('coupon/coupon.Amount')}}</td>
            <td>{{trans('coupon/coupon.Expiry Date')}}</td>
            <td>{{trans('coupon/coupon.Action')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($couponspoints as $couponspoint)
          <tr>
              <td>{{$couponspoint->id}}</td>
            <td>{{$couponspoint->point_code}}</td>
            <td>{{$couponspoint->couponpoint_type}}</td>
            <td>{{$couponspoint->amount}}</td>
            <td>{{$couponspoint->expiry_date}}</td>
            <td>
              @if($couponspoint->status == 1)
              <a class="updateCouponpointStatus" id ="couponpoint-{{$couponspoint->id}}" couponspoint_id="{{$couponspoint->id}}" aria-hidden='true' href="javascript:void(0)"><i class="fa fa-toggle-on" statuss="Active"></i></a>
              @else
              <a class="updateCouponpointStatus" id ="couponpoint-{{$couponspoint->id}}" couponspoint_id="{{$couponspoint->id}}" aria-hidden='true' href="javascript:void(0)"><i class="fa fa-toggle-off" statuss="Inactive"></i></a>
              @endif  
             <a href="{{url('CouponPoints/coupon-point/'.$couponspoint['id'])}}"><i class="fa fa-edit color-blue"></i></a>
              <a href="javascript:void(0)" title="Delete Coupon point" class="confirmDeletepoint"
              record="coupon-point" recordid="{{$couponspoint['id']}}"><i class="fa fa-trash color-blue"></i></a>
            </td>
          </tr>
          @empty
            <tr>
              <th colspan='6'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
            </div>
        </div>
      </div>
    </div>
  @endsection