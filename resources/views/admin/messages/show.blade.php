@extends('admin.admin')
@section('title','قائمة الرد التلقائي')
@section('content')
<a href="{{route('Addmessage')}}" class="btn btn-success m-b-30 dis-block-inline m-t-30">{{trans('message/mesage.Add Message')}}</a>
<div class="table-responsive">
<table class="table" id="datatable1">

    <thead class="table-dark">
      <tr>
      <th scope="col">#</th>
      <th scope="col">{{trans('message/mesage.messages')}}</th>
      <th scope="col">{{trans('message/mesage.operation')}}</th>
      

    </tr>
  </thead>
  <tbody>
    @forelse($messages as $message)
    <tr>
      <th scope="row">{{$message->id}}</th>
      <td>{{$message->message}}</td>
            <td>
              
              <a href="{{route('Editmessage',$message->id)}}" class="btn btn-success m-b-20"><i class="fa fa-edit"></i></a>
              <a href="{{route('Deletemessage',$message->id)}}" class="btn btn-danger m-b-20"><i class="fa fa-trash"></i></a>
          
            </td>
            </td>
          </tr>
          @empty
          <tr>
            <th colspan='4'>لا يوجد بيانات في الجدول</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>


@endsection