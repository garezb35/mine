@php
    $price = str_replace(",","",$user_price);
    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
        $price = str_replace(",",'',$user_division_price) * str_replace(",","",$user_quantity_min) / str_replace(",","",$user_division_unit);
    }
    if(!empty($user_goods_type) && $user_goods_type == 'bargain'){
        $selltype = '할인';
    }

    $category = '> > 기타';
    if(!empty($game['game'])){
        $category = $game['game']." > ";
    }
    if(!empty($server['game'])){
        $category .= $server['game']." > ";
    }
    if(!empty($good_type)){
        $category .= $good_type;
    }
@endphp
@extends('layouts-angel.app-frame')

@section('head_attach')

    <link type="text/css" rel="stylesheet" href="/angel/buy/css/index_view.css">
@endsection

@section('foot_attach')
    <script type="text/javascript">
        function _init() {
            $('#btn_list').delay(1200).fadeIn(500);
        }
    </script>

@endsection

@section('content')

    <div>
        <div class="pagecontainer_full">
            <div class="box6 text-center bg-reg pt-45">
                <span class="reg_icon"></span>
                @if(!empty($user_goods_type))
                    <p class="complete_txt">축하합니다<br>물품이 정상적으로 등록되었습니다.</p> 현재 연락처로 꼭 수정해주세요!
                    <br> 연락처가 불분명 시 거래에 불이익을 받을 수 있습니다.
                @endif
            </div>

            <div class="highlight_contextual_nodemon">물품정보</div>
            <table class="table-green1 table-striped">
                <colgroup>
                    <col width="130">
                    <col>
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">{{$category}}</td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="3">{{$user_title ?? ''}}</td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td class="e--pc">#{{$orderNo ?? '#'}}</td>
                    <th class="visible--table--pc">등록일시</th>
                    <td class="visible--table--pc">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr class="visible--table-m">
                    <th>등록일시</th>
                    <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    <th>물품종류</th>
                    <td class="e--pc">{{$good_type ?? ''}}</td>
                    <th class="visible--table--pc">거래유형</th>
                    <td class="visible--table--pc">{{$selltype ?? '일반'}}판매</td>
                </tr>
                <tr class="visible--table-m">
                    <th>거래유형</th>
                    <td>{{$selltype ?? '일반'}}판매</td>
                </tr>
                @if($selltype == '일반')
                    @php
                        $gamemoney_unit = $gamemoney_unit ?? '';
                        $user_quantity = $user_quantity ?? '';
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                    @endphp
                    @if($c != 1)
                        <tr>
                            <th>구매수량</th>
                            <td class="e--pc">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                            <th class="visible--table--pc">구매금액</th>
                            <td class="visible--table--pc">{{number_format($price)}}원</td>
                        </tr>
                    @endif
                    <tr @if($c != 1) class="visible--table-m" @endif>
                        <th>구매금액</th>
                        <td colspan="3">{{number_format($price)}}원</td>
                    </tr>
                @else
                    <tr>
                        <th>구매수량</th>
                        <td class="e--pc">{{number_format($user_quantity_max)}} (최소 {{number_format($user_quantity_min)}})</td>
                        <th class="visible--table--pc">구매금액</th>
                        <td class="visible--table--pc">{{number_format($user_division_unit)}}당 {{number_format($user_division_price)}}원</td>
                    </tr>
                    <tr class="visible--table-m">
                        <th>구매금액</th>
                        <td colspan="3">{{number_format($user_division_unit)}}당 {{number_format($user_division_price)}}원</td>
                    </tr>
                @endif
            </table>
            <div id="btn_list" class="b_input_group btn_list">
                <a href="/myroom/buy/buy_regist_view?id={{$orderNo ?? ''}}" class="btn-default btn-rok" >등록 물품보기</a>
                <a href="/homepage" class="btn-default btn-rok">메인으로 가기</a>
                <a href="/myroom/buy/buy_regist"class="btn-default btn-rok">마이룸으로 가기</a>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
