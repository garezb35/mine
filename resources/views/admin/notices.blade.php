@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-xl-6">
                                <h3 class="mb-2">공지사항관리</h3>
                            </div>
                            <div class="col-xl-6 text-right">
                                <a class="btn btn-primary" href="javascript:openNotice('')">새 공지사항</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">아이디</th>
                                <th scope="col" class="sort" data-sort="budget">제목</th>
                                <th scope="col" class="sort" data-sort="budget">페이지뷰</th>
                                <th scope="col" class="sort" data-sort="budget">등록일</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr id="tr_{{$item['id']}}">
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{$item['view']}}</td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
                                    <td>
                                        <a href="javascript:openNotice({{$item['id']}})" class="btn btn-sm btn-primary">보기</a>
                                        <a href="#" class="btn btn-sm btn-danger deleteRequest" data-id="{{$item['id']}}">삭제</a>
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
                                url: '/api/admin/deleteNotice',
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
