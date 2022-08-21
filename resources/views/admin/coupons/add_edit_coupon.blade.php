@extends('admin.admin')
@section('title','إضافة وتعديل الكوبون')
@section('content')
    <div class="container-fluid">

            <!-- @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif -->

              <form method="POST" @if(empty($coupon['id'])) action="{{ url('Coupons/add-edit-coupon')}}" @else action="{{ url('Coupons/add-edit-coupon/'.$coupon['id'])}}" @endif enctype="multipart/form-data">
                  @csrf
                  @if(empty($coupon['coupon_code']))
                  <div class="form-group">
                      <label for="coupon_option" class="text-danger">{{trans('coupon/coupon.Coupon Option')}}</label><br>
                      <div class="flex-div">
                            <span class="text-white"><input id="AutomaticCoupon" type="radio"  name='coupon_option' value="Automatic" checked="" />&nbsp;
                            {{trans('coupon/coupon.Automatic')}}&nbsp;&nbsp;</span>
                            <span class="text-white"><input id="ManualCoupon" type="radio" name='coupon_option' value="Manual" />
                            {{trans('coupon/coupon.Manual')}}&nbsp;&nbsp;</span>
                            @error('coupon_option')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                    </div>
                  </div>
                    <div class="form-group"style="display:none" id="couponField">
                                <label for="coupon_code" class="text-danger">{{trans('coupon/coupon.Coupon code')}}</label>
                                <input type="text" class="form-control " placeholder="Enter Coupon Code" name='coupon_code' id="coupon_code" />
                                @error('coupon_code')
                                <small class='form-text text-danger'>{{$message}}</small>
                                @enderror
                    </div>
                    @else
                    <input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}">
                    <input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}">
                    <div class="form-group">
                                <label for="coupon_code" class="text-danger">{{trans('coupon/coupon.Coupon code')}}:</label>
                                <span class=" text-white fs-20 p-r-20">{{$coupon['coupon_code']}}</span>
                           
                    </div>
                    @endif

                <div class="form-group">
                    <label for="coupon_type" class="text-danger">{{trans('coupon/coupon.Coupon Type')}}</label><br>
                    
                    <div class="flex-div">
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Single time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Single time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Single time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Two time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Two time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Two time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Five time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Five time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Five time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Ten time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Ten time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Ten time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Twenty time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Twenty time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Twenty time')}}&nbsp;&nbsp;</span>
                        <span class="text-white"><input  type="radio"  name='coupon_type' value="Multi time" 
                        @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Multi time") checked="" @endif/>&nbsp;
                        {{trans('coupon/coupon.Multi time')}}&nbsp;&nbsp;</span>
                        @error('coupon_type')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount_type" class="text-danger">{{trans('coupon/coupon.Amount Type')}}</label><br>
                    <div class="flex-div">
                                <span class="text-white"><input  type="radio"  name='amount_type' value="Percentage"
                                @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Percentage") checked="" @endif />&nbsp;
                                {{trans('coupon/coupon.Percentage')}}&nbsp;(%)&nbsp;</span>
                                <span class="text-white"><input  type="radio"  name='amount_type' value="Fixed" 
                                @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Fixed") checked="" @endif/>&nbsp;
                                {{trans('coupon/coupon.Fixed')}}&nbsp;(ل.س)&nbsp;</span>
                                @error('amount_type')
                                <small class='form-text text-danger'>{{$message}}</small>
                                @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="text-danger">{{trans('coupon/coupon.amount')}}</label>
                    <input type="text" class="form-control " placeholder="{{trans('coupon/coupon.Enter Amount')}} " name='amount' id="amount"
                    required="" @if(isset($coupon['amount'])) value="{{$coupon['amount']}}" @endif />
                    @error('amount')
                    <small class='form-text text-danger'>{{$message}}</small>
                    @enderror
                </div>

                  <div class="form-group">
                      <label for="coupon_code" class="text-danger">{{trans('coupon/coupon.Select Porducts')}}</label>
                      <select id="products" name='products[]'class="form-control" multiple="multiple" required>
                          <option value="">select</option>
                            @foreach($Products as $product)
                                <option value="{{$product->id}}" @if(in_array($product['id'],$selCats)) selected="" @endif>{{$product->title}}</option>
                                @endforeach
                    </select>        
                      @error('products[]')
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
                          <option value="">select</option>
                            @foreach($users as $user)
                                <option value="{{$user->email}}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{$user->email}}</option>
                                @endforeach
                                >
                    </select>        
                      @error('users[]')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="expiry_date" class="text-danger">{{trans('coupon/coupon.Expiry Date')}}</label><br>
                    <input id="expiry_date"  type="date" class="form-control" name='expiry_date' placeholder="yyyy/mm/dd"
                    required="" @if(isset($coupon['expiry_date'])) value="{{$coupon['expiry_date']}}" @endif
                     />
                    @error('expiry_date')
                    <small class='form-text text-danger'>{{$message}}</small>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-danger">{{trans('coupon/coupon.Add Coupon')}}</button>
                </form>
            </div>
@endsection