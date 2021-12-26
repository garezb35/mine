
@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid mt-100 {{Request::get("character_enabled")}}">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="card-header border-0">
                        <h3 class="mb-2">게임관리</h3>
                        <form class="form-inline" action="{{route('game_management')}}" method="GET" >
                            <div class="form-group mb-2 ">
                                <select class="form-control" name="depth">
                                    <option value="0" {{Request::get("depth") == 0 || is_null(Request::get("depth")) ? "selected":""}}>게임</option>
                                    <option value="1" {{Request::get("depth") == 1 ? "selected":""}}>서버</option>
                                    <option value="2" {{Request::get("depth") == 2 ? "selected":""}}>속성</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 mx-sm-3">
                                <input type="text" name="name" value="{{Request::get("name")}}" class="form-control" placeholder="네임">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">검색</button>
                            <a href="{{route('gamemake')}}" class="btn btn-danger mb-2">등록하기</a>
                        </form>
                    </div>


                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">아이디</th>
                                <th scope="col" class="sort" data-sort="status">구분</th>
                                <th scope="col" class="sort" data-sort="budget">네임</th>
                                <th scope="col" class="sort" data-sort="character">캐릭터 거래</th>
                                <th scope="col" class="sort" data-sort="balin">할인가능</th>
                                <th scope="col" class="sort" data-sort="game">게임머니 단위</th>
                                <th>아이콘</th>
                                <th>등록일</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($games as $game)
                                <tr>
                                    <td>
                                        {{$game['id']}}
                                    </td>
                                    <td>
                                        @if($game['depth'] == 0) 게임 @endif
                                        @if($game['depth'] == 1) 서버 @endif
                                        @if($game['depth'] == 2) 속성 @endif
                                    </td>
                                    <td class="budget">
                                        <a href="/admin/gamemake?id={{$game['id']}}">{{$game['game']}}</a>
                                    </td>
                                    <td>
                                        {{$game['character_enabled'] == 1 ? "캐릭터 거래 가능" : ""}}
                                    </td>
                                    <td>
                                        {{$game['discount'] == 1 ? "할인가능" : ""}}
                                    </td>
                                    <td>
                                        {{$game['gamemoney_unit'] == 1 ? "판매수량단위 현시" : ""}}
                                    </td>
                                    <td>
                                        @if(!empty($game['icon']))
                                        <img src="{{$game['icon']}}" width="40"/>
                                        @endif
                                    </td>
                                    <td>{{date("Y-m-d H:i:s",strtotime($game['created_at']))}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer py-4">
                        {{$games->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
