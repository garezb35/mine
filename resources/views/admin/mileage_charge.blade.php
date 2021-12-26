@extends('admin.layouts.app')
@php
    $title = "마일리지충환전관리";
@endphp
@section('content')

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header border-0">
                        <h3 class="mb-2">{{$title}}</h3>
                        <form class="form-inline" action="{{route('mileage_charge')}}" method="GET" >
                            @csrf
                            <div class="form-group mb-2">
                                <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" placeholder="닉네임 이름 이메일">
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="state">신청상태&nbsp;</label>
                                <select class="form-control" name="state">
                                    <option value=""  {{Request::get("state") == "" || is_null(Request::get("state")) ? "selected":""}}>선택하세요</option>
                                    <option value="0" {{!is_null(Request::get("state")) &&  Request::get("state") == 0 ? "selected":""}}>신청중</option>
                                    <option value="1" {{Request::get("state") == 1 ? "selected":""}}>대기중</option>
                                    <option value="2" {{Request::get("state") == 2 ? "selected":""}}>처리</option>
                                    <option value="3" {{Request::get("state") == 3 ? "selected":""}}>취소</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="type">신청형태&nbsp;</label>
                                <select class="form-control" name="type">
                                    <option value=""  {{Request::get("type") == "" || is_null(Request::get("type")) ? "selected":""}}>선택하세요</option>
                                    <option value="0" {{!is_null(Request::get("type")) && Request::get("type") == 0 ? "selected":""}}>마일리지 충전</option>
                                    <option value="1" {{Request::get("type") == 1 ? "selected":""}}>마일리지 출금</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">검색</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">
                                    <input type="checkbox" class="mids" onclick="tickCheckBox('mids')"/> 아이디
                                </th>
                                <th scope="col" class="sort" data-sort="budget">이름</th>
                                <th scope="col" class="sort" data-sort="budget">현재 마일리지</th>
                                <th scope="col" class="sort" data-sort="status">신청구분</th>
                                <th scope="col" class="sort" data-sort="status">신청금액</th>
                                <th scope="col" class="sort" data-sort="status">상태</th>
                                <th scope="col" class="sort" data-sort="created">등록일</th>
                                <th scope="col" class="sort" data-sort="updated"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mileage as $m)
                                <tr>
                                    <td>
                                        @if($m['status'] == 0 || $m['status'] == 1)
                                            <input type="checkbox" name="mids[]" value="{{$m['id']}}"/>
                                        @endif
                                        &nbsp;{{$m['id']}}
                                    </td>
                                    <td>
                                        {{$m['user']['name']}}
                                    </td>
                                    <td>
                                        {{number_format($m['user']['mileage'])}}
                                    </td>
                                    <td>
                                        {{$m['memo']}}
                                    </td>
                                    <td>
                                        {{number_format($m['money'])}}원
                                    </td>
                                    <td>
                                        {{getStateMileage($m['status'])}}
                                    </td>
                                    <td>
                                        {{date("Y-m-d H:i",strtotime($m["createdByDtm"]))}}
                                    </td>
                                    <td class="text-left">
                                        @if($m['status'] == 0 || $m['status'] == 1)
                                        <button class="btn btn-primary btn-sm control-re_mi" @if($m['status'] == 1) disabled @endif data-id="{{$m['id']}}" data-type="1" data-mode = "1">대기중</button>
                                        <button class="btn btn-danger btn-sm control-re_mi" data-id="{{$m['id']}}" data-type="2" data-mode = "1">처리</button>
                                        <button class="btn btn-info btn-sm control-re_mi" data-id="{{$m['id']}}" data-type="3" data-mode = "1">취소</button>
                                        @endif
                                        @if($m['status'] == 2)
                                                <button class="btn btn-danger btn-sm" disabled>처리됨</button>
                                        @endif
                                        @if($m['status'] == 3)
                                            <button class="btn btn-info btn-sm" disabled>취소됨</button>
                                        @endif
                                        <button class="btn btn-cyan btn-sm control-re_mi" data-id="{{$m['id']}}" data-type="4" data-mode = "2">삭제</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <form class="form-inline" action="{{route('mileage_control')}}" method="POST" id="mileage_control">
                            <input type="hidden" id="mids" name="mids">
                            @csrf
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="state">신청상태&nbsp;</label>
                                <select class="form-control" name="state" id="state">
                                    <option value="">선택하세요</option>
                                    <option value="1">대기중</option>
                                    <option value="2" >처리</option>
                                    <option value="3" >취소</option>
                                </select>
                            </div>
                            <input type="hidden" name="mode" value="1" id="mode"/>
                            <button type="submit" class="btn btn-primary mb-2">확인</button>
                            <a href="javascript:deleteMileages()" class="btn btn-google-plus mb-2">삭제</a>
                        </form>
                        {{$mileage->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    var submit_type = 0;
    function deleteMileages(){
        $("#mode").val(2);
        $("#mileage_control").submit();
    }
    $(document).ready(function(){
        @if (\Session::has('message'))
        alert("{{\Session::get('message')}}")
        @endif

        $(".control-re_mi").click(function(){
            submit_type = 1;
            var id = $(this).data("id");
            var type = $(this).data("type");
            var mode = $(this).data("mode");
            let mids = new Array();
            mids.push(id);
            $("#mids").val(mids.join());
            $("#state").val(type);
            $("#mode").val(mode);
            $("#mileage_control").submit();
        })
        $("#mileage_control").submit(function(){
            let submit_checked = true;
            let mids = new Array();
            $('input[name="mids[]"]').each(function(index,ele){
                if ($(ele).prop("checked")) {
                    mids.push($(ele).val())
                }
            })
            if(submit_type == 0){
                if(mids.length == 0){
                    alert("자료들을 선택하세요");
                    submit_checked = false;
                    return false;
                }
                $("#mids").val(mids.join());
            }
            if(confirm('변경하시겠습니까?')){
                if($("#mode").val() == 1 && $("#state").val() == ""){
                    submit_checked = false;
                    alert("옵션을 선택하세요");
                    $("#state").focus();
                }
            }
            else {
                submit_checked = false;
            }
            return submit_checked;
        });
    });
</script>
@endsection
