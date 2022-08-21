@extends('admin.admin')
@section('title','إضافة وتعديل الكوبون')
@section('content')
    <div class="container-fluid">

            <!-- @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif -->

              <form method="POST" @if(empty($couponspoints['id'])) action="{{url('CouponPoints/coupon-point')}}" @else action="{{url('CouponPoints/coupon-point/'.$couponspoints['id'])}}" @endif enctype="multipart/form-data">
                  @csrf
                  @if(empty($couponspoints['point_code']))
                  <div class="form-group">
                      <label for="couponpoint_option" class="text-danger">{{trans('coupon/coupon.Coupon Option')}}</label><br>
                      <div class="flex-div">
                            <span class="text-white"><input id="AutomaticCoupon" type="radio"  name='couponpoint_option' value="Automatic" checked="" />&nbsp;
                            {{trans('coupon/coupon.Automatic')}}&nbsp;&nbsp;</span>
                            <span class="text-white"><input id="ManualCoupon" type="radio" name='couponpoint_option' value="Manual" />
                            {{trans('coupon/coupon.Manual')}}&nbsp;&nbsp;</span>
                            @error('couponpoint_option')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                    </div>
                  </div>
                    <div class="form-group"style="display:none" id="couponField">
                                <label for="point_code" class="text-danger">{{trans('coupon/coupon.Coupon code')}}</label>
                                <input type="text" class="form-control " placeholder="Enter Coupon Code" name='point_code' id="point_code" />
                                @error('point_code')
                                <small class='form-text text-danger'>{{$message}}</small>
                                @enderror
                    </div>
                    @else
                    <input type="hidden" name="couponpoint_option" value="{{$couponspoints['couponpoint_option']}}">
                    <input type="hidden" name="point_code" value="{{$couponspoints['point_code']}}">
                    <div class="form-group">
                                <label for="point_code" class="text-danger">{{trans('coupon/coupon.Coupon code')}}:</label>
                                <span class=" text-white fs-20 p-r-20">{{$couponspoints['point_code']}}</span>
                           
                    </div>
                    @endif

                <div class="form-group">
                    <label for="couponpoint_type" class="text-danger">{{trans('coupon/coupon.Coupon Type')}}</label><br>
                    
                    <div class="flex-div">
                        <span class="text-white"><input  type="radio"  name='couponpoint_type' value="Single time" 
                        @if(isset($couponspoints['couponpoint_type'])&&$couponspoints['couponpoint_type']=="Single time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Single time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Two time" 
                        @if(isset($couponspoints['couponpoint_type'])&&$couponspoints['couponpoint_type']=="Two time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Two time')}}&nbsp;&nbsp;</span>
                        @error('couponpoint_type')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="amount" class="text-danger">{{trans('coupon/coupon.amount')}}</label>
                    <input type="text" class="form-control " placeholder="{{trans('coupon/coupon.Enter Amount')}} " name='amount' id="amount"
                    required="" @if(isset($couponspoints['amount'])) value="{{$couponspoints['amount']}}" @endif />
                    @error('amount')
                    <small class='form-text text-danger'>{{$message}}</small>
                    @enderror
                </div>
               <div class="form-group">
                      <label for="users" class="text-danger">{{trans('coupon/coupon.Select Users')}}</label>
                      <div class="button-container">
                        <button type="button" class="selectAll">{{trans('coupon/coupon.select All')}}</button>
                        <button type="button" class="deselectAll">{{trans('coupon/coupon.Deselect All')}}</button>
                      </div>
                      <select id="users" name='users[]'class="form-control my-select" multiple="multiple" data-live-search="true" required>
                       
                            @foreach($users as $user)
                                   
                                <option value="{{$user->email}}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{$user->email}}

                                </option>
                               @endforeach
                                
                      @error('users[]')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="expiry_date" class="text-danger">{{trans('coupon/coupon.Expiry Date')}}</label><br>
                    <input id="expiry_date"  type="date" class="form-control" name='expiry_date' placeholder="yyyy/mm/dd"
                    required="" @if(isset($couponspoints['expiry_date'])) value="{{$couponspoints['expiry_date']}}" @endif
                     />
                    @error('expiry_date')
                    <small class='form-text text-danger'>{{$message}}</small>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-danger">{{trans('coupon/coupon.Add Coupon')}}</button>
                </form>
            </div>
@endsection