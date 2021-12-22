@extends('admin.layouts.app')
@php
    $title = "마일리지사용내역";
@endphp
@section('content')

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header border-0">
                        <h3 class="mb-2">{{$title}}</h3>
                        <form class="form-inline" action="{{route('mileage_used')}}" method="GET" >
                            @csrf
                            <div class="form-group mb-2">
                                <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" placeholder="닉네임 이름 이메일">
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <select class="form-control" name="mtype">
                                    <option value=""  {{Request::get("mtype") == "" || is_null(Request::get("mtype")) ? "selected":""}}>=마일리지구분=</option>
                                    <option value="2m" {{Request::get("mtype") == "2m" ? "selected":""}}>판매완료</option>
                                    <option value="6m" {{Request::get("mtype") == "6m" ? "selected":""}}>구매완료</option>
                                    <option value="10m" {{Request::get("mtype") == "10m" ? "selected":""}}>상품권샵구매</option>
                                    <option value="21m" {{Request::get("mtype") == "21m" ? "selected":""}}>구매취소</option>
                                    <option value="1m" {{Request::get("mtype") == "1m" ? "selected":""}}>유로등록서비스 구매</option>
                                    <option value="0" {{!is_null(Request::get("mtype")) && Request::get("mtype") == "0" ? "selected":""}}>마일리지 충전</option>
                                    <option value="1" {{Request::get("mtype") == "1" ? "selected":""}}>마일리지 환전</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="price1">금액검색&nbsp;</label>
                                <input type="text" name="price1" value="{{Request::get("price1")}}" class="form-control" placeholder="0원">&nbsp;~&nbsp;
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="price2" value="{{Request::get("price2")}}" class="form-control" placeholder="10000원">
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="date1">기간검색&nbsp;</label>
                                <input type="date" name="date1" value="{{Request::get("date1")}}" class="form-control">&nbsp;~&nbsp;
                            </div>
                            <div class="form-group mb-2">
                                <input type="date" name="date2" value="{{Request::get("date2")}}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 mx-sm-3">검색</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="budget">이름</th>
                                    <th scope="col" class="sort" data-sort="budget">사용/추가금액(원)</th>
                                    <th scope="col" class="sort" data-sort="status">마일리지구분</th>
                                    <th scope="col" class="sort" data-sort="status">주문번호</th>
                                    <th scope="col" class="sort" data-sort="updated">갱신일</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($merged_mileage as $merge_v)
                                @php
                                $minus = "+";
                                if($merge_v['minus'] ==1 ){
                                    $minus = "-";
                                }
                                else if($merge_v['minus'] ==0 ){
                                    $minus = "+";
                                }
                                else{
                                    $minus = $merge_v['minus'];
                                }
                                @endphp
                            <tr>
                                <td>
                                    {{$merge_v['user']['name']}}
                                </td>
                                <td>
                                   {{$minus}}{{number_format($merge_v['price'])}}원
                                </td>
                                <td>
                                    {{getMileageType($merge_v['type'])}}
                                </td>
                                <td>
                                    @if(strlen($merge_v['orderNo']) > 5)
                                        <a href="" >#{{$merge_v['orderNo']}}</a>
                                    @endif
                                </td>
                                <td>{{date("Y-m-d H:i",strtotime($merge_v['updated_at']))}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{$merged_mileage->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
