@extends('admin.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
      <h2 class="text-white m-t-30 m-b-20">{{trans('Blance/Blance.Oreder details')}}</h2>
      </div>
      <div class="card-body">
      <table class="table table-re">
         <thead class="table-dark">
          <tr>
          
          <td>{{trans('Blance/Blance.fname')}}</td>
          <td>{{trans('Blance/Blance.lname')}}</td>
          <td>{{trans('Blance/Blance.email')}}</td>
          <td>{{trans('Blance/Blance.User_id')}}</td>
          <td>{{trans('Blance/Blance.phone')}}</td>
            <td scope="col">{{trans('Blance/Blance.type')}}</td>
            <td scope="col">{{trans('Blance/Blance.price')}}</td>
            <td scope="col">{{trans('Blance/Blance.value')}}</td>
            <td scope="col">{{trans('Blance/Blance.status')}}</td>
            <td>{{trans('Blance/Blance.date')}}</td>
            <td scope="col">{{trans('Blance/Blance.notation')}}</td>
            <td>{{trans('Blance/Blance.name_admin')}}</td>
            <td scope="col">{{trans('Blance/Blance.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($Balances as $Balance)
          <tr>
            <td scope="row" data-label="{{trans('Blance/Blance.fname')}}">{{$Balance->user->fname}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.lname')}}">{{$Balance->user->lname}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.email')}}">{{$Balance->user->email}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.User_id')}}">{{$Balance->user->user_id}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.phone')}}">{{$Balance->user->phone}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.type')}}">{{$Balance->type}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.price')}}">{{$Balance->price}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.value')}}">{{$Balance->valueaccount->value}}</td>
              <td scope="row" data-label="{{trans('Blance/Blance.status')}}">
              @if ($Balance->status == '0')
             <span class="pending">{{trans('Blance/Blance.pending')}}</span>
            @elseif($Balance->status == '1')
              <span class="complete">{{trans('Blance/Blance.Completed')}}</span>
            @elseif($Balance->status == '2')
             <span class="cancel">{{trans('Blance/Blance.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('Blance/Blance.date')}}">{{date("F j, Y, g:i a",strtotime($Balance->created_at))}}</td>
              <td scope="row" data-label="{{trans('Blance/Blance.message')}}">{{$Balance->messages->message}}</td>
              <td scope="row" data-label="{{trans('Blance/Blance.name_admin')}}">{{$Balance->name_admin}}</td>
            
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('AllAccount')}}" class="text-white"> رجوع </a></button>
            </td>
          </form>
          </tr>
           @empty
            <tr>
              <th colspan='4'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
     
    </div>
  </div>
@endsection