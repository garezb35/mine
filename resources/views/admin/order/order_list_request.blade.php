@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-2">주문 종료/취소 요청</h3>
                        <form class="form-inline" action="{{route('order_list_request')}}" method="GET" >
                            <div class="form-group mb-2">
                                <input type="text" name="usr_alias" value="{{Request::get("usr_alias")}}" class="form-control" placeholder="닉네임 이름 이메일">
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <input type="text" name="orderNo" value="{{Request::get("orderNo")}}" class="form-control" placeholder="주문번호">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">검색</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">아이디</th>
                                    <th scope="col" class="sort" data-sort="budget">주문번호</th>
                                    <th scope="col" class="sort" data-sort="budget">요청자</th>
                                    <th scope="col" class="sort" data-sort="budget">요청</th>
                                    <th scope="col" class="sort" data-sort="budget">이유</th>
                                    <th scope="col" class="sort" data-sort="budget">휴대폰번호</th>
                                    <th scope="col" class="sort" data-sort="budget">등록일</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr id="tr_{{$item['askid']}}">
                                    <td>{{$item['askid']}}</td>
                                    <td><a href="javascript:void(0)" onclick="openOrder('{{$item['order_no']}}')">#{{$item['order_no']}}</a></td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['type'] == 'cancel' ? '거래종료' : '거래완료'}}</td>
                                    <td>{{$item['reason']}}</td>
                                    <td>{{$item['phone']}}</td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
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
