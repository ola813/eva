@extends('admin.admin')
@section('content')
    <div class="container-fluid">
              <form method="POST" action="{{route('AddAccount')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label class="text-white">{{trans('Blance/Blance.value')}}</label>
                      <input type="text" class="form-control" placeholder="{{trans('product/product.Enter title product....')}}" name='value' />
                      
                  </div>
                        <div class="form-group">
                            <label  class="text-white">{{trans('Blance/Blance.orginal_price')}}</label>
                            <input type="number" class="form-control" placeholder="{{trans('product/product.Enter your price....')}}" name='orginal_price'/>
                            @error('price')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white">{{trans('Blance/Blance.selling_price')}}</label>
                            <input type="number" class="form-control" placeholder="{{trans('product/product.Enter your selling_price...')}}" name='price'/>
                            @error('price')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white">{{trans('Blance/Blance.commission')}}</label>
                            <input type="number" class="form-control" disabled name='commission'/>
                            @error('price')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                          <div class="form-group">
                            <label class="text-white">{{trans('Blance/Blance.company')}}</label>
                            <select name='company_id'class="form-control">
                            @foreach(\App\Models\Company::all() as $Company)
                                <option value="{{$Company->id}}">{{$Company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    <button type="submit" class="btn btn-danger ">{{trans('product/product.Add Charge')}}</button>
                </form>
    </div>
@endsection