@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-2">신규게임/서버 추가</h3>
                        <form class="form-inline" action="{{route('new_gaming')}}" method="GET" >
                            <div class="form-group mb-2">
                                <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" placeholder="닉네임 이름 이메일">
                            </div>

                            <div class="form-group mb-2 mx-sm-3">
                                <label for="bank_verified">응답구분&nbsp;&nbsp;</label>
                                <select class="form-control" name="response">
                                    <option value=""  {{Request::get("bank_verified") == "" || is_null(Request::get("bank_verified")) ? "selected":""}}>선택하세요</option>
                                    <option value="1" {{Request::get("response") == 1 ? "selected":""}}>응답전</option>
                                    <option value="2" {{Request::get("response") == 2 ? "selected":""}}>응답함</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">검색</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">아이디</th>
                                    <th scope="col" class="sort" data-sort="budget">신청자</th>
                                    <th scope="col" class="sort" data-sort="budget">요청내용</th>
                                    <th scope="col" class="sort" data-sort="budget">휴대폰번호</th>
                                    <th scope="col" class="sort" data-sort="budget">등록일</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr id="tr_{{$item['askid']}}">
                                    <td>{{$item['askid']}}</td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['content']}}</td>
                                    <td>{{$item['phone']}}</td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
                                    <td>{{!empty($item['response']) ? '응답했음' : '응답전'}}</td>
                                    <td>
                                        <a href="javascript:openOrderRequest({{$item['askid']}})" class="btn btn-sm btn-primary">보기</a>
                                        <a href="#" class="btn btn-sm btn-danger deleteRequest" data-id="{{$item['askid']}}">삭제</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer py-4">
                            {{$items->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('footer')
            <script>
                $(".deleteRequest").click(function(){
                    if(confirm('삭제하시겠습니까?')){
                        var id = $(this).data("id");
                        var cur_tr = $("#tr_"+id);
                        $.ajax({
                                url: '/api/admin/deleteOrderRequest',
                                dataType: 'json',
                                type: 'post',
                                data: {id: id, api_token: a_token},
                                success: function (data) {
                                    alert(data.msg);
                                    if(data.status == 1){
                                        cur_tr.remove();
                                    }
                                }
                            }
                        );
                    }
                })
            </script>
@endsection
