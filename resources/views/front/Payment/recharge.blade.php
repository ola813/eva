
@extends('front.home.home')
@section('content')
<!----products----->
<section class="bg0 p-t-20 p-b-40 " id="products ">
  <div class="container dir">
  
    <h2 class="text-white m-b-40 p-r-6 txt-right font-charge style-title-change">{{trans('Payment/Payment.Payment_account')}} : {{$paymenttotal}}</h2>
    <h2 class="text-white m-b-22 p-r-6 txt-right font-charge style-charge">{{trans('Payment/Payment.proccess Charge')}}</h2>
    <div class="table-responsive">
      
      <table class="table text-center" id="datatable2">
        <thead class="table-danger text-white fs-9">
          <tr>
      <th scope="col">#</th>
      <th scope="col">{{trans('Payment/Payment.Amount')}}</th>
      <th scope="col">{{trans('Payment/Payment.type Payment')}}</th>
      <th scope="col">{{trans('Payment/Payment.status')}}</th>
      <th scope="col">{{trans('Payment/Payment.message')}}</th>
      <th scope="col">{{trans('Payment/Payment.see moore')}}</th>
    

    </tr>
  </thead>
  <tbody class="fs-9">
    @forelse($Payments as $Payment)
    <tr>
    <th scope="row">{{$Payment->id}}</th>
    
    <td>{{$Payment->account}}</td>
    <td>{{$Payment->type}}</td>
    
    <td>
      @if ($Payment->status == '0')
      <span>pending</span>
      @elseif($Payment->status == '1')
      <span>complete</span>
      @elseif($Payment->status == '2')
      <span>Cancel</span>
      @endif
    </td>
    @if($Payment->messages==null)
      <td>{{$Payment->message}}</td>
      @else
      <td>{{$Payment->messages->message}}</td>
      @endif
      <td><a href="" class="text-danger"><i class="fa fa-eye"></i></a></td>
    </tr>
    @empty
    <tr>
      <th colspan='7' class="text-center">لا يوجد بيانات في الجدول</th>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
</div>
</section>
@endsection