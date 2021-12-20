@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.headers.cards')
    <script>
        var data = [0,0,0,0,0,0,0,0,0,0,0,0,0];
         var users = {{$user_list}};
    </script>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">거래완료
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1"></h6>
                                <h2 class="text-white mb-0">판매수치</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales">
                                        <select   id="input-address" class="form-control form-control-alternative">
                                            @for($i = date("Y"); $i >= date("Y")-4 ; $i--)
                                            <option value="{{$i}}">{{$i}}년</option>
                                            @endfor
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chart">

                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1"></h6>
                                <h2 class="mb-0">회원가입</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">구매 취소/종료신청</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route("order_list_request")}}" class="btn btn-sm btn-primary">모두 보기</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">주문번호</th>
                                    <th scope="col">요청자</th>
                                    <th scope="col">판매자</th>
                                    <th scope="col">구매자</th>
                                    <th scope="col">가격</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">창조일</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($request_orders as $ro)
                                    @php

                                    if($ro['type'] == 'sell'){
                                        $seller = $ro['user'];
                                        $buyer = $ro['other'];
                                    }
                                    else{
                                        $seller = $ro['other'];
                                        $buyer = $ro['user'];
                                    }
                                    @endphp
                                    <tr>
                                        <th scope="row">
                                            <a href="javascript:void(0)" onclick="window.open('{{Request::root()}}/admin/view_order?id={{$ro['orderNo']}}','popUpWindow','height=600,width=800,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')">#{{$ro['orderNo']}}</a>
                                        </th>
                                        <td>
                                            {{$ro['ask']['user']['nickname']}}
                                        </td>
                                        <td>
                                            {{$seller['nickname']}}
                                        </td>
                                        <td>
                                            {{$buyer['nickname']}}
                                        </td>
                                        <td>
{{--                                            <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%--}}
                                            {{number_format($ro['payitem']['price'])}}원
                                        </td>
                                        <td>
                                                {{orderState($ro['status'])}}
                                        </td>
                                        <td>
                                            {{$ro['ask']['type'] == 'cancel' ? '거래취소':'거래종료'}}
                                        </td>
                                        <td>{{date("Y-m-d H:i:s",strtotime($ro['created_at']))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">마일리지 입금/출금 신청</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route("mileage_charge")}}" class="btn btn-sm btn-primary">모두 보기</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">유저네임</th>
                                    <th scope="col">금액</th>
                                    <th scope="col">등록일시</th>
                                    <th scope="col">구분</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mileage as $m)
                                <tr>
                                    <th scope="row">
                                        {{$m['user']['name']}}
                                    </th>
                                    <td>
                                        {{number_format($m['money'])}}
                                    </td>
                                    <td>
                                        {{date("Y-m-d H:i:s",strtotime($m['createdByDtm']))}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <span class="mr-2">60%</span>--}}
{{--                                            <div>--}}
{{--                                                <div class="progress">--}}
{{--                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
@endpush
