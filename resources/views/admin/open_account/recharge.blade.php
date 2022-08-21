
@extends('admin.admin')
@section('content')
<div class="table-responsive">
      <div class="card-header">
        <h2 class="text-white m-t-10 m-b-20">{{trans('Payment/Payment.New Order Pyment')}}</h2>
      </div>
  <table class="table text-center table-re" id="datatable1">
    <thead class="table-dark">
          <tr>
              <th scope="col">{{trans('Payment/Payment.id')}}</th>
              <th scope="col">{{trans('Payment/Payment.Date')}}</th>
              <th scope="col">{{trans('Payment/Payment.Amount')}}</th>
              <th scope="col">{{trans('Payment/Payment.type Payment')}}</th>
              <th scope="col">{{trans('Payment/Payment.photo')}}</th>
              <th scope="col">{{trans('Payment/Payment.status')}}</th>
              <!-- <th scope="col">{{trans('Payment/Payment.message')}}</th> -->
              <th scope="col">{{trans('Payment/Payment.operation')}}</th>
            

            </tr>
  </thead>
  <tbody>
    @forelse($Payments as $Payment)
  <tr>
      <th scope="row">{{$Payment->id}}</th>
      <td>{{date("F j, Y, g:i a" ,strtotime($Payment->created_at))}}</td>
      <td>{{$Payment->account}}</td>
      <td>{{$Payment->type}}</td>
      <td>
        @if($Payment->image)
        <div>
        <img class="popup" width="100px" height="100px"  alt="image" src="{{asset('assets/front/images/Payment/'.$Payment->image)}}"/>
        </div>
        @else
        {{$Payment->image}}
        @endif
      </td>
      <td>
        @if ($Payment->status == '0')
        <span class="pending">{{trans('Payment/Payment.pending')}}</span>
        @elseif($Payment->status == '1')
        <span class="complete">{{trans('Payment/Payment.Completed')}}</span>
        @elseif($Payment->status == '2')
        <span class="cancel">{{trans('Payment/Payment.Cancel')}}</span>
        @endif
      </td>
      <!-- <td>{{$Payment->message}}</td> -->
      <td>
        <a href="{{route('detailsopenaccount', $Payment->id)}}"><button class="btn btn-success">معالجة الطلب</button></a>
      </td>
    </tr>
    @empty
    <tr>
      <th colspan='8' class="text-center">لا يوجد بيانات في الجدول</th>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
<div class=" modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <img id="popup-img"  alt="image" src=""  />
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <a class="text-white btn btn-danger" type="button" data-bs-dismiss="modal">Close</a>
        <a href="" type="button" class="btn btn-success download" download>Download</a>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script>


    $('.popup').on('click',function(){
      var src=$(this).attr('src');
      $('.modal').modal('show');
          $('#popup-img').attr('src',src);
          $('.download').attr('href',src);
         
    });
  
  // $(document).ready(function(){

  //   $('#small-image').on('click',function(){
  //     var path=$(this).attr('src');
  //     $('#large-image').attr('src',path);
  //     $('#show_image_popup').fadeIn();
  //   })
  //   $('#close-btn').click(function(){
  //     $('#show_image_popup').slideUp();

  //   });
  // });
</script>
@endsection