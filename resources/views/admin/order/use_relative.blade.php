@extends('admin.layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-2">이용관련</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">아이디</th>
                                <th scope="col" class="sort" data-sort="budget">구분</th>
                                <th scope="col" class="sort" data-sort="budget">요청자</th>
                                <th scope="col" class="sort" data-sort="budget">이유</th>
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
                                    <td>{{requestTypes($item['type'])}}</td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['reason']}}</td>
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
