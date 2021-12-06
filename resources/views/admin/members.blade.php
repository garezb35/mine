@extends('admin.layouts.app')
@php
$title=  '회원목록';
if(Request::get('state') == 6){
    $title =  '회원탈퇴신청관리';
}
if(Request::get('state') == '3-2'){
    $title =  '회원탈퇴관리';
}
@endphp
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{$title}}</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">아이디</th>
                                    <th scope="col" class="sort" data-sort="budget">이름</th>
                                    <th scope="col" class="sort" data-sort="status">닉네임</th>
                                    <th scope="col" class="sort" data-sort="status">이메일</th>
                                    <th scope="col" class="sort" data-sort="status">모바일</th>
                                    <th scope="col" class="sort" data-sort="status">계좌정보</th>
                                    <th scope="col">마일리지</th>
                                    <th scope="col" class="sort" data-sort="completion">포인트</th>
                                    <th scope="col">주문완료건수</th>
                                    <th scope="col">등록일</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        {{$member['id']}}
                                    </td>
                                    <td class="budget">
                                        {{$member['name']}}
                                    </td>
                                    <td>
                                        {{$member['nickname']}}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot">
                                               <i class="{{empty($member['email_verified_at']) ? "bg-warning":"bg-success"}}"></i>
                                            </span>{{$member['email']}}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot">
                                               <i class="{{$member['mobile_verified'] == 0 || empty($member['mobile_verified']) ? "bg-warning":"bg-success"}}"></i>
                                            </span>{{$member['number']}}
                                    </td>
                                    <td>
                                        @if(!empty($member['bank']))
                                        <span class="badge badge-dot">
                                           <i class="{{$member['bank_verified'] == 0 || empty($member['bank_verified']) ? "bg-warning":"bg-success"}}"></i>
                                        </span>
                                        {{$member['bank']['accAlias']}}<br>{{$member['bank']['accNumber']}}({{$member['bank']['accName']}})
                                        @endif
                                    </td>
                                    <td>
                                        {{number_format($member['mileage'])}}
                                    </td>
                                    <td>
                                        {{number_format($member['point'])}}
                                    </td>
                                    <td>
                                        <div>판매 : {{number_format($member['completed_orders'])}}</div>
                                        <div>구매 : {{number_format($member['completed_orders1'])}}</div>
                                    </td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($member['created_at']))}}</td>
{{--                                    <td>--}}
{{--                                        <div class="avatar-group">--}}
{{--                                            <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">--}}
{{--                                                <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">--}}
{{--                                            </a>--}}
{{--                                            <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">--}}
{{--                                                <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">--}}
{{--                                            </a>--}}
{{--                                            <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">--}}
{{--                                                <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">--}}
{{--                                            </a>--}}
{{--                                            <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">--}}
{{--                                                <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <span class="completion mr-2">60%</span>--}}
{{--                                            <div>--}}
{{--                                                <div class="progress">--}}
{{--                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#">편집</a>
                                                <a class="dropdown-item" href="#">탈퇴</a>
                                                <a class="dropdown-item" href="#"></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        {{$members->withQueryString()->links()}}
{{--                        <nav aria-label="...">--}}
{{--                            <ul class="pagination justify-content-end mb-0">--}}
{{--                                <li class="page-item disabled">--}}
{{--                                    <a class="page-link" href="#" tabindex="-1">--}}
{{--                                        <i class="fas fa-angle-left"></i>--}}
{{--                                        <span class="sr-only">Previous</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item active">--}}
{{--                                    <a class="page-link" href="#">1</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="#">--}}
{{--                                        <i class="fas fa-angle-right"></i>--}}
{{--                                        <span class="sr-only">Next</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
