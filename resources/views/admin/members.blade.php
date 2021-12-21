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

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header border-0">
                        <h3 class="mb-2">{{$title}}</h3>
                        <form class="form-inline" action="{{route('members')}}" method="GET" >
                            <div class="form-group mb-2">
                                <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" placeholder="닉네임 이름 이메일">
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="user_rate">회원등급&nbsp;</label>
                                <select class="form-control" name="user_rate">
                                    <option value="">선택하세요</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role["level"]}}" {{Request::get("user_rate") == $role["level"] ? "selected":""}}>{{$role["alias"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="email_verified_at">이메일 인증&nbsp;</label>
                                <select class="form-control" name="email_verified_at">
                                    <option value="" {{Request::get("email_verified_at") == "" || is_null(Request::get("email_verified_at")) ? "selected":""}}>선택하세요</option>
                                    <option value="1" {{Request::get("email_verified_at") == 1 ? "selected":""}}>인증됨</option>
                                    <option value="0" {{!is_null(Request::get("email_verified_at")) && Request::get("email_verified_at") == 0 ? "selected":""}}>인증안됨</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="mobile_verified">휴대폰 인증&nbsp;</label>
                                <select class="form-control" name="mobile_verified">
                                    <option value="" {{Request::get("mobile_verified") == "" || is_null(Request::get("mobile_verified")) ? "selected":""}}>선택하세요</option>
                                    <option value="1" {{Request::get("mobile_verified") == 1 ? "selected":""}}>인증됨</option>
                                    <option value="0" {{!is_null(Request::get("mobile_verified")) && Request::get("mobile_verified") == 0 ? "selected":""}}>인증안됨</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <label for="bank_verified">계좌정보 인증&nbsp;</label>
                                <select class="form-control" name="bank_verified">
                                    <option value=""  {{Request::get("bank_verified") == "" || is_null(Request::get("bank_verified")) ? "selected":""}}>선택하세요</option>
                                    <option value="1" {{Request::get("bank_verified") == 1 ? "selected":""}}>인증됨</option>
                                    <option value="0" {{!is_null(Request::get("bank_verified")) && Request::get("bank_verified") == 0 ? "selected":""}}>인증안됨</option>
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
                                        <input type="checkbox" class="uids" onclick="tickCheckBox('uids')"/> 아이디</th>
                                    <th scope="col" class="sort" data-sort="budget">이름</th>
                                    <th scope="col" class="sort" data-sort="status">닉네임</th>
                                    <th scope="col" class="sort" data-sort="status">이메일</th>
                                    <th scope="col" class="sort" data-sort="status">모바일</th>
                                    <th scope="col" class="sort" data-sort="status">계좌정보</th>
                                    <th scope="col" class="sort" data-sort="status">회원등급</th>
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
                                        <input type="checkbox" name="uids[]" value="{{$member['id']}}" /> {{$member['id']}}
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
                                        {{$member['roles']['alias']}}
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
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route("member_edit")}}?id={{$member['id']}}&page={{Request::get("page")}}">편집</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer py-4">
                        <form class="form-inline" action="{{route('member_control')}}" method="POST" id="member_control">
                            <input type="hidden" id="userIds" name="userIds">
                            @csrf
                            @if(Request::get("state") != "3-2")
                                <div class="form-group mb-2">
                                    <label for="user_exit">회원탈퇴&nbsp;</label>
                                    <select class="form-control" name="user_exit" id="user_exit">
                                        <option value="">선택하세요</option>
                                        <option value="3">회원탈퇴</option>
                                        <option value="1">탈퇴취소</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="user_rate">회원등급&nbsp;</label>
                                    <select class="form-control" name="user_rate" id="user_rate">
                                        <option value="">선택하세요</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role["level"]}}">{{$role["alias"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">확인</button>
                                <a href="javascript:sendMemo()" class="btn btn-google-plus mb-2">쪽지보내기</a>
                            @else
                                <input type="hidden" name="exit_cancel" value="1" id="exit_cancel"/>
                                <button type="submit" class="btn btn-primary mb-2">탈퇴취소</button>
                                <a href="javascript:deleteMembers()" class="btn btn-google-plus mb-2">회원삭제</a>
                            @endif
                        </form>
                        {{$members->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript">
        function deleteMembers(){
            $("#exit_cancel").val(2);
            $("#member_control").submit();
        }
        $(document).ready(function(){
            @if (\Session::has('message'))
                alert("{{\Session::get('message')}}")
            @endif
            $('#member_control').submit(function(){
                let submit_checked = true;
                let uids = new Array();
                $('input[name="uids[]"]').each(function(index,ele){
                    if ($(ele).prop("checked")) {
                        uids.push($(ele).val())
                    }
                })
                if(uids.length == 0){
                    alert("회원들을 선택하세요");
                    submit_checked = false;
                    return false;
                }
                if(confirm('변경하시겠습니까?')){
                    if($("#user_rate").val() == "" && $("#user_exit").val() == ""){
                        alert("옵션을 선택하세요");
                        submit_checked = false;
                    }

                    $("#userIds").val(uids.join())
                }
                else {
                    submit_checked = false;
                }
                return submit_checked;
            })
        })
    </script>
@endsection
