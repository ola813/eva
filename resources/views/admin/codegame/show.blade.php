@extends('admin.admin')
@section('title','  قائمة كوبونات الالعاب')
@section('content')
   <div class="card-header">
        <h2 class="text-white  m-b-20">{{trans('coupon/coupon.Coupons')}}</h2>
      </div>
      
  <div id="wrapper dir">
    <div id="tabContainer">
                <div id="tabs">
                    <ul>
                        <li id="tabHeader_1">free fire 110</li>
                        <li id="tabHeader_2">free fire 231</li>
                        <li id="tabHeader_3">free fire 583</li>
                        <li id="tabHeader_4">pubge mobile 60</li>
                        <li id="tabHeader_5">pubge mobile 325</li>
                        <li id="tabHeader_6">Roblox 10</li>
                        <li id="tabHeader_7">Razar Gold 5</li>
                        <li id="tabHeader_8">Razar Gold 10</li>
                        <li id="tabHeader_9">Razar Gold 20</li>
                        <li id="tabHeader_10">Itunes 5</li>
                        <li id="tabHeader_11">Itunes 10</li>
                        <li id="tabHeader_12">Itunes 20</li>
                        <li id="tabHeader_13">Oroba code 200</li>
                        <li id="tabHeader_14">Oroba code 315</li>
                        <li id="tabHeader_15">Oroba code 795</li>
                    </ul>
                </div>
        <div id="tabscontent">
            <div class="tabpage" id="tabpage_1">
                              <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                              <table class="table">
                                <thead class="table-dark">
                                  <tr>
                                    <td>#</td>
                                    <td>{{trans('coupon/coupon.code')}}</td>
                                    <td>{{trans('coupon/coupon.Action')}}</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse($free110 as $freefire)
                                  @if($freefire->freefire110 !=null)
                                      <tr>
                                        <td>{{$freefire->id}}</td>
                                        <td>{{$freefire->freefire110}}</td>
                                        <td>  
                                        <a href="{{url('Code-game/update-code-game/'.$freefire['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                          <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                          record="code-game" recordid="{{$freefire['id']}}"><i class="fa fa-trash color-blue"></i></a>
                                        </td>
                                      </tr>
                                  @endif
                                  @empty
                                    <tr>
                                      <th colspan='3'>لا يوجد بيانات في الجدول</th>
                                      </tr>
                                  @endforelse
                                </tbody>
                        </table>
            </div>

            <div class="tabpage hidden" id="tabpage_2">
                  <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                  <table class="table">
                        <thead class="table-dark">
                          <tr>
                            <td>#</td>
                            <td>{{trans('coupon/coupon.code')}}</td>
                            <td>{{trans('coupon/coupon.Action')}}</td>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($free231 as $free23)
                          @if($free23->freefire231 !=null)
                              <tr>
                                <td>{{$free23->id}}</td>
                                <td>{{$free23->freefire231}}</td>
                                <td>  
                                <a href="{{url('Code-game/update-code-game/'.$free23['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                  <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                  record="code-game" recordid="{{$free23['id']}}"><i class="fa fa-trash color-blue"></i></a>
                                </td>
                              </tr>
                          @endif
                          @empty
                            <tr>
                              <th colspan='3'>لا يوجد بيانات في الجدول</th>
                              </tr>
                          @endforelse
                        </tbody>
                    </table>
            </div>

            <div class="tabpage" id="tabpage_3">
                  <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                  <table class="table">
                        <thead class="table-dark">
                          <tr>
                            <td>#</td>
                            <td>{{trans('coupon/coupon.code')}}</td>
                            <td>{{trans('coupon/coupon.Action')}}</td>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($free583 as $free58)
                          @if($free58->freefire583 !=null)
                              <tr>
                                <td>{{$free58->id}}</td>
                                <td>{{$free58->freefire583}}</td>
                                <td>  
                                <a href="{{url('Code-game/update-code-game/'.$free58['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                  <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                  record="code-game" recordid="{{$free58['id']}}"><i class="fa fa-trash color-blue"></i></a>
                                </td>
                              </tr>
                          @endif
                          @empty
                            <tr>
                              <th colspan='3'>لا يوجد بيانات في الجدول</th>
                              </tr>
                          @endforelse
                        </tbody>
                </table>  
            </div>

            <div class="tabpage hidden" id="tabpage_4">
              <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                  <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($pubge60 as $pubge)
                        @if($pubge->pubge60 !=null)
                            <tr>
                              <td>{{$pubge->id}}</td>
                              <td>{{$pubge->pubge60}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$pubge['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$pubge['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
                  </table>
            </div>

            <div class="tabpage" id="tabpage_5">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($pubge325 as $pubge32)
                        @if($pubge32->pubge325 !=null)
                            <tr>
                              <td>{{$pubge32->id}}</td>
                              <td>{{$pubge32->pubge325}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$pubge32['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$pubge32['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
                  </table>  
            </div>

            <div class="tabpage hidden" id="tabpage_6">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($robloxs as $roblox)
                        @if($roblox->Roblox10 !=null)
                            <tr>
                              <td>{{$roblox->id}}</td>
                              <td>{{$roblox->Roblox10}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$roblox['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$roblox['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
            </div>

            <div class="tabpage" id="tabpage_7">      
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($Razar5 as $Razar55)
                        @if($Razar55->Razar5 !=null)
                            <tr>
                              <td>{{$Razar55->id}}</td>
                              <td>{{$Razar55->Razar5}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$Razar55['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$Razar55['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
            </div>

            <div class="tabpage hidden" id="tabpage_8">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($Razar10 as $Razar110)
                        @if($Razar110->Razar10 !=null)
                            <tr>
                              <td>{{$Razar110->id}}</td>
                              <td>{{$Razar110->Razar10}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$Razar110['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$Razar110['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
              </table>
            </div>
            <div class="tabpage" id="tabpage_9">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($Razar20 as $Razar220)
                        @if($Razar220->Razar20 !=null)
                            <tr>
                              <td>{{$Razar220->id}}</td>
                              <td>{{$Razar220->Razar20}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$Razar220['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$Razar220['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
                  </table>
            </div>

            <div class="tabpage hidden" id="tabpage_10">
                  <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                  <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <td>#</td>
                        <td>{{trans('coupon/coupon.code')}}</td>
                        <td>{{trans('coupon/coupon.Action')}}</td>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($ituns5 as $ituns55)
                      @if($ituns55->ituns5 !=null)
                          <tr>
                            <td>{{$ituns55->id}}</td>
                            <td>{{$ituns55->ituns5}}</td>
                            <td>  
                            <a href="{{url('Code-game/update-code-game/'.$ituns55['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                              <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                              record="code-game" recordid="{{$ituns55['id']}}"><i class="fa fa-trash color-blue"></i></a>
                            </td>
                          </tr>
                      @endif
                      @empty
                        <tr>
                          <th colspan='3'>لا يوجد بيانات في الجدول</th>
                          </tr>
                      @endforelse
                    </tbody>
                  </table>
            </div>

            <div class="tabpage" id="tabpage_11">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($ituns10 as $ituns110)
                        @if($ituns110->ituns10 !=null)
                            <tr>
                              <td>{{$ituns110->id}}</td>
                              <td>{{$ituns110->ituns10}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$ituns110['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$ituns110['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
              </table>
            </div>

            <div class="tabpage hidden" id="tabpage_12"> 
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($ituns20 as $ituns220)
                        @if($ituns220->ituns20 !=null)
                            <tr>
                              <td>{{$ituns220->id}}</td>
                              <td>{{$ituns220->ituns20}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$ituns220['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$ituns220['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
              </table>


            </div>

            <div class="tabpage hidden" id="tabpage_13">
                        <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <td>#</td>
                              <td>{{trans('coupon/coupon.code')}}</td>
                              <td>{{trans('coupon/coupon.Action')}}</td>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($oropa200 as $oropa2002)
                            @if($oropa2002->oropa200 !=null)
                                <tr>
                                  <td>{{$oropa2002->id}}</td>
                                  <td>{{$oropa2002->oropa200}}</td>
                                  <td>  
                                  <a href="{{url('Code-game/update-code-game/'.$oropa2002['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                    <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                    record="code-game" recordid="{{$oropa2002['id']}}"><i class="fa fa-trash color-blue"></i></a>
                                  </td>
                                </tr>
                            @endif
                            @empty
                              <tr>
                                <th colspan='3'>لا يوجد بيانات في الجدول</th>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
            </div>

            <div class="tabpage hidden" id="tabpage_14">
                    <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <td>#</td>
                          <td>{{trans('coupon/coupon.code')}}</td>
                          <td>{{trans('coupon/coupon.Action')}}</td>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($oropa315 as $oropa3155)
                        @if($oropa3155->oropa315 !=null)
                            <tr>
                              <td>{{$oropa3155->id}}</td>
                              <td>{{$oropa3155->oropa315}}</td>
                              <td>  
                              <a href="{{url('Code-game/update-code-game/'.$oropa3155['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                record="code-game" recordid="{{$oropa3155['id']}}"><i class="fa fa-trash color-blue"></i></a>
                              </td>
                            </tr>
                        @endif
                        @empty
                          <tr>
                            <th colspan='3'>لا يوجد بيانات في الجدول</th>
                            </tr>
                        @endforelse
                      </tbody>
              </table>
            </div>

            <div class="tabpage hidden" id="tabpage_15">
                        <button type="submit" class="btn btn-success m-b-20"> <a href="{{route('Addecodegame')}}" class="text-white">{{trans('coupon/coupon.Add code games')}}</a></button>
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <td>#</td>
                              <td>{{trans('coupon/coupon.code')}}</td>
                              <td>{{trans('coupon/coupon.Action')}}</td>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($oropa795 as $oropa7955)
                            @if($oropa7955->oropa795 !=null)
                                <tr>
                                  <td>{{$oropa7955->id}}</td>
                                  <td>{{$oropa7955->oropa795}}</td>
                                  <td>  
                                  <a href="{{url('Code-game/update-code-game/'.$oropa7955['id'])}}"><i class="fa fa-edit color-blue"></i></a>
                                    <a href="javascript:void(0)" title="Delete code game" class="confirmDeletecodegame"
                                    record="code-game" recordid="{{$oropa7955['id']}}"><i class="fa fa-trash color-blue"></i></a>
                                  </td>
                                </tr>
                            @endif
                            @empty
                              <tr>
                                <th colspan='3'>لا يوجد بيانات في الجدول</th>
                                </tr>
                            @endforelse
                          </tbody>
                  </table>
            </div>
       
      </div>
    </div>
  </div>
  @endsection