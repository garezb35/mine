@extends('admin.layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-2">등록물품관리</h3>
                        <form class="form-inline" action="{{route('order_list')}}" method="GET" >
                            @csrf
                            <div class="mb-2">
                                <label for="orderNo" class="form-control-label">주문번호</label>
                                <input type="text" name="orderNo" value="{{Request::get("orderNo")}}" class="form-control" placeholder="주문번호" id="orderNo">
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="username" class="form-control-label">회원검색</label>
                                <input type="text" name="username" value="{{Request::get("username")}}" class="form-control" placeholder="이름 이메일 닉네임" id="username">
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="select-type" class="form-control-label">물품형태</label>
                                <select class="form-control" name="type" id="select-type">
                                    <option value="">=선택하세요=</option>
                                    <option value="sell" {{Request::get('type') == 'sell' ? 'selected':'' }}>판매물품</option>
                                    <option value="buy"  {{Request::get('type') == 'buy' ? 'selected':'' }}>구매물품</option>
                                </select>
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="select-state" class="form-control-label">물품상태</label>
                                <select class="form-control" name="state" id="select-state">
                                    <option value="">=선택하세요=</option>
                                    <option value="0-0" {{Request::get('state') == '0-0' ? 'selected':'' }}>물품 등록</option>
                                    <option value="pay_pending"  {{Request::get('state') == 'pay_pending' ? 'selected':'' }}>입금대기</option>
                                    <option value="discount_pending"  {{Request::get('state') == 'discount_pending' ? 'selected':'' }}>흥정신청</option>
                                    <option value="2"  {{Request::get('state') == '2' ? 'selected':'' }}>인수완료</option>
                                    <option value="1"  {{Request::get('state') == '1' ? 'selected':'' }}>판매중</option>
                                    <option value="3"  {{Request::get('state') == '3' ? 'selected':'' }}>인계완료</option>
                                    <option value="2"  {{Request::get('state') == '2' ? 'selected':'' }}>인수완료</option>
                                    <option value="32|23"  {{Request::get('state') == '32|23' ? 'selected':'' }}>거래완료</option>
                                    <option value="-1"  {{Request::get('state') == '-1' ? 'selected':'' }}>거래취소</option>
                                </select>
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="select-good_type" class="form-control-label">물품유형</label>
                                <select class="form-control" name="good_type" id="select-good_type">
                                    <option value="">=선택하세요=</option>
                                    <option value="general" {{Request::get('good_type') == 'general' ? 'selected':'' }}>일반</option>
                                    <option value="division"  {{Request::get('good_type') == 'division' ? 'selected':'' }}>분할</option>
                                    <option value="bargain"  {{Request::get('good_type') == 'bargain' ? 'selected':'' }}>흥정</option>
                                </select>
                            </div>

                            <div class="mb-2 mx-sm-3">
                                <label for="select-game" class="form-control-label">게임</label>
                                <select class="form-control js-example-basic-single" name="game" id="select-game">
                                    <option value="">전체</option>
                                    @foreach($game as $g)
                                    <option value="{{$g["id"]}}" {{Request::get("game") == $g["id"] ? "selected": ""}}>{{$g["game"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="select-server_code" class="form-control-label">서버</label>
                                <select class="form-control js-example-basic-single-server_code" name="server_code" id="select-server_code">
                                    <option value="">전체</option>
                                    @foreach($servers as $s)
                                    <option value="{{$s['id']}}" {{Request::get("server_code") == $s["id"] ? "selected": ""}}>{{$s['game']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 mx-sm-3">
                                <label for="select-type" class="form-control-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary mb-2">검색</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">아이디</th>
                                    <th scope="col" class="sort" data-sort="budget">주문번호</th>
                                    <th scope="col" class="sort" data-sort="budget">물품형태</th>
                                    <th scope="col" class="sort" data-sort="budget">물품유형</th>
                                    <th scope="col" class="sort" data-sort="budget">카테고리</th>
                                    <th scope="col" class="sort" data-sort="budget">거래상태</th>
                                    <th scope="col" class="sort" data-sort="status">판매자</th>
                                    <th scope="col" class="sort" data-sort="status">구매자</th>
                                    <th scope="col" class="sort" data-sort="status">등록일</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $o_v)
                                @php
                                    $seller = $buyer = "";
                                    if($o_v["type"] == 'sell'){
                                        $seller = $o_v['user'];
                                        $buyer = $o_v['other'];
                                    }
                                    else{
                                        $seller = $o_v['other'];
                                        $buyer = $o_v['user'];
                                    }
                                    $order_state = "";
                                    if($o_v["status"] == 0){
                                        if(sizeof($o_v['bargain_requests']) > 0){
                                            $order_state = "흥정신청중";
                                        }
                                        else{
                                            $order_state = "등록물품";
                                        }
                                    }
                                    if($o_v['status'] == 1){
                                        if($o_v['payitem']['status'] == 0){
                                            $order_state = "입금대기중";
                                        }
                                        if($o_v['payitem']['status'] == 1){
                                            $order_state = "거래중";
                                        }
                                    }
                                    if($o_v['status'] == 2){
                                        $order_state = "인수 완료";
                                    }
                                    if($o_v['status'] == 3){
                                        $order_state = "인계 완료";
                                    }
                                    if($o_v['status'] == 23 || $o_v['state'] == 32){
                                        $order_state = "거래 완료";
                                    }
                                    if($o_v['status'] == -1){
                                        $order_state = "거래 취소";
                                    }
                                @endphp
                                <tr id="tr_{{$o_v["id"]}}">
                                    <td>
                                        {{$o_v['id']}}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openOrder('{{$o_v['orderNo']}}')">#{{$o_v['orderNo']}}</a>
                                    </td>
                                    <td>
                                        {{$o_v['type'] == "sell" ? '판매물품':'구매물품'}}
                                    </td>
                                    <td>
                                        @switch($o_v['user_goods_type'])
                                            @case("general")
                                                일반
                                            @break
                                            @case("division")
                                                분할
                                            @break
                                            @default
                                                흥정
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        {{$o_v['game']['game']}} > {{$o_v['server']['game']}} > {{$o_v["good_type"]}}
                                    </td>
                                    <td>
                                        {{$order_state}}
                                    </td>
                                    <td>
                                        @if(!empty($seller))
                                        <a href="">{{$seller['name']}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($buyer))
                                            <a href="">{{$buyer['name']}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date("Y-m-d H:i:s",strtotime($o_v['created_at']))}}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item order-item" href="javascript:void(0)" data-id="{{$o_v['id']}}" data-type="cancel">거래취소</a>
                                                <a class="dropdown-item order-item" href="javascript:void(0)" data-id="{{$o_v['id']}}" data-type="end">거래종료</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{$orders->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        let single_server = $('.js-example-basic-single-server_code');
        $('.js-example-basic-single').select2();
        $('.js-example-basic-single-server_code').select2();
        $(".js-example-basic-single").on("select2:select", function (e) {
            let game_id = e.params.data.id;
            $.ajax({
                    url: '/api/admin/servers',
                    dataType: 'json',
                    type: 'post',
                    data: {id: game_id,api_token:a_token},
                    success: function (data) {
                        single_server.html('')
                        single_server.select2(
                            {
                                data:data
                            }
                        )
                    }
                }
            );
        });
        $(".order-item").click(function(){
            let confirm_msg = "";
            let confirm_type = $(this).data("type");
            let confirm_id = $(this).data('id');
            let cur_tr = $("#tr_"+confirm_id);
            if(confirm_type == "remove")
                confirm_msg = "삭제하시겠습니까?";
            if(confirm_type == "cancel")
                confirm_msg = "거래취소하시겠습니까?";
            if(confirm_type == "end")
                confirm_msg = "거래종료하시겠습니까?";
            if(confirm(confirm_msg)){

                $.ajax({
                        url: '/api/admin/order_control',
                        dataType: 'json',
                        type: 'post',
                        data: {id: confirm_id, type: confirm_type, api_token: a_token},
                        success: function (data) {
                            if(data.status == 1){
                                alert('변경되었습니다.');
                                if (confirm_type == 'remove') {
                                    cur_tr.remove();
                                }
                            }
                            else{
                                alert(data.msg);
                            }
                        }
                    }
                );
            }
        })
    });
</script>
<style>
    .select2-container{
        font-size: 14px;
        min-width: 150px;
    }
</style>
@endsection
