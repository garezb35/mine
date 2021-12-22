@extends('admin.layouts.app')

@section('content')

    <style>
        .cl_0{
            background: lightgrey;
        }
    </style>
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h3 class="mb-2">알림목록</h3>
                                <form class="form-inline" action="{{route('notice_list_admin')}}" method="GET" >
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="isReaded">알림상태</label>
                                        <select class="form-control" name="isReaded" id="isReaded">
                                            <option value="1" {{Request::get("isReaded") == 1 || empty(Request::get("isReaded")) ? "selected" : ""}}>읽지 않음</option>
                                            <option value="2" {{Request::get("isReaded") == 2 ? "selected" : ""}}>읽음</option>
                                            <option value="3" {{Request::get("isReaded") == 3 ? "selected" : ""}}>전체</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2 mx-sm-3">
                                        <label for="usr_alias">유저네임&nbsp;</label>
                                        <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" id="usr_alias">
                                    </div>
                                    <div class="form-group mb-2 mx-sm-3">
                                        <label for="orderNo">주문번호&nbsp;</label>
                                        <input type="text" name="orderNo" value="{{Request::get("orderNo")}}" class="form-control" id="orderNo">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">검색</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">아이디</th>
                                <th scope="col" class="sort" data-sort="budget">회원네임</th>
                                <th scope="col" class="sort" data-sort="budget">주문번호</th>
                                <th scope="col" class="sort" data-sort="budget">구분</th>
                                <th scope="col" class="sort" data-sort="budget">등록일</th>
                                <th scope="col" class="sort" data-sort="budget">상태</th>
                                <td scope="col" class="sort" data-sort="budget"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr id="tr_{{$item['id']}}" class="cl_{{$item['isReaded']}}">
                                    <td>{{$item['id']}} </td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['orderNo']}}</td>
                                    <td>{{noticetype($item['type'])}}</td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
                                    <td class="read">{{$item['isReaded'] == 0 ? "읽지 않음" : '읽음'}}</td>
                                    <td>
                                        <button
                                                class="btn btn-sm btn-primary view-notice"
                                                data-id="{{$item['id']}}"
                                                data-type="{{$item['type']}}"
                                                data-orderNo="{{$item['orderNo']}}"
                                                data-username="{{$item['user']['name']}}">보기</button>
                                        <button class="btn btn-sm btn-danger delete-notice" data-id="{{$item['id']}}">삭제</button>
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

<div id="ex1" class="modal">
    <p>Thanks for clicking. That felt good.</p>
    <a href="#" rel="modal:close">Close</a>
</div>
@section('footer')
    <script type="text/javascript">
        $(".delete-notice").click(function(){
            var id = $(this).data('id');
            var cur_tr = $("#tr_" + id);
            $.ajax({
                    url: '/api/admin/deleteNoticeAdmin',
                    dataType: 'json',
                    type: 'post',
                    data: {id: id, api_token: a_token},
                    success: function (data) {
                        if(data.status == 1){
                            cur_tr.remove();
                            if(data.dec == 1){
                                notice_count--;
                                $("#mail-count").text(notice_count);
                            }
                        }
                        else{
                            alert('처리오류');
                        }
                    }
                }
            );
        })
        $(".view-notice").click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            var orderNo = $(this).data('orderNo');
            var username = $(this).data('username');
            var cur_tr = $("#tr_" + id);
            var cur_read = $("#tr_" + id).find(".read")
            $.ajax({
                    url: '/api/admin/checkNotice',
                    dataType: 'json',
                    type: 'post',
                    data: {id: id, api_token: a_token},
                    success: function (data) {
                        var return_url = "";
                        if(data.status == 1){
                            cur_tr.removeClass('cl_0');
                            cur_read.text('읽음')
                            if(data.dec == 1){
                                notice_count--;
                                $("#mail-count").text(notice_count);
                            }
                            if(type == 1){
                                return_url = '/admin/mileage_charge?usr_alias=' + username + '&state=0&type=0';
                            }
                            if(type == 2){
                                return_url = '/admin/mileage_charge?usr_alias=' + username + '&state=0&type=1';
                            }
                            if(type == 3 || type == 4 || type == 5 || type == 6){
                                return_url = '/admin/order_list_request?usr_alias='+username+'&orderNo='+orderNo;
                            }
                            if(type == 7){
                                return_url = '/admin/new_gaming?usr_alias='+username+'&response=1';
                            }
                            if(type == 8){
                                return_url = '/admin/use_relative?usr_alias='+username+'&reply=1';
                            }
                            window.open(return_url)
                        }
                        else{
                            alert('처리오류');
                        }
                    }
                }
            );

        })
        $(".delete-notice").click(function(){
            var id = $(this).data('id');
        })
    </script>
@endsection

