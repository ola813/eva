@extends('front.home.home')
@section('title','الطلبات الخارجية')
@section('content')
    <div class="container-fluid  dir">
        <div class="product-data">
            <form action="{{route('AddOrderOut')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="m-t-30 fs-20" >{{trans('message/mesage.Enter your Order')}}</label>
                    <textarea type="text" cols="20" rows="10" class="form-control message" placeholder="{{trans('message/mesage.Enter your Order')}}" name='message' required></textarea>
                </div>
                <div class="form-group">
                    <label class="m-t-30 fs-20" >{{trans('message/mesage.Enter your price')}}</label>
                    <input type="text" class="form-control price" placeholder="{{trans('message/mesage.Enter your price')}}" name='price' required></input>
                </div>
                <button type="submit" class="btn btn-danger m-r-89 m-t-30 orderout">{{trans('message/mesage.Send Order')}}</button>
            </form>
            </div>
            </div>
@endsection