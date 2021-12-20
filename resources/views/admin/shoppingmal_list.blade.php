@extends('admin.layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h3 class="mb-2">구매목록</h3>
                                <form class="form-inline" action="{{route('shoppingmal_list')}}" method="GET" >
                                    <div class="form-group mb-2">
                                        <label for="serial_number">핀번호&nbsp;유무</label>
                                        <select class="form-control" name="serial_number" id="serial_number">
                                            <option value="3" {{Request::get("serial_number") == 3 ? "selected" : ""}}>선택하세요</option>
                                            <option value="1" {{Request::get("serial_number") == 1 || empty(Request::get("serial_number")) ? "selected" : ""}}>핀번호 없음</option>
                                            <option value="2" {{Request::get("serial_number") == 2 ? "selected" : ""}}>핀번호 있음</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2 mx-sm-3">
                                        <label for="pin">핀번호</label>
                                        <input type="text" name="pin" value="{{Request::get("pin")}}" class="form-control">
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
                                <th scope="col" class="sort" data-sort="budget">상품권샵</th>
                                <th scope="col" class="sort" data-sort="budget">구매자</th>
                                <th scope="col" class="sort" data-sort="budget">구매한 마일리지</th>
                                <th scope="col" class="sort" data-sort="budget">핀번호</th>
                                <th scope="col" class="sort" data-sort="budget">등록일</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr id="tr_{{$item['id']}}">
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item['mall']['name']}}</td>
                                    <td>{{$item['user']['name']}}</td>
                                    <td>{{$item['mileage']}}</td>
                                    <td><input type="text" value="{{$item['serial_number']}}" class="form-control" onblur="insertPin($(this).val(),{{$item['id']}})"></td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
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
        function insertPin(cur_value,id){
            $.ajax({
                    url: '/api/admin/insertPin',
                    dataType: 'json',
                    type: 'post',
                    data: {id: id,value:cur_value, api_token: a_token},
                    success: function (data) {

                    }
                }
            );
        }
    </script>
@endsection
