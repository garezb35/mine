@php

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
    $price = 0;
    if($user_goods_type != 'division')
        $price = $user_price;
    if($user_goods_type == 'division')
        $price = $user_division_price;
@endphp
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_view.css?210114" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_regist.js?v=190426"></script>
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_regist_view.js?v=210512"></script>
    <script type="text/javascript">
        function __init() {
            angel_premiun_items.premium=7;
            angel_premiun_items.highlight=7;
        }
    </script>

@endsection

@section('content')

    <div class="bg-white">
        <div>
            @include("angel.myroom.header")
        </div>
        <div>
            @include('aside.myroom',['group'=>'buy'])
            <div class="pagecontainer">
                <a name="top"></a>
                <div class="highlight_contextual_nodemon first">물품정보</div>
                @if($user_goods_type == 'general')
                    <table class="table-striped table-green1">
                        <tr>
                            <th>카테고리</th>
                            <td colspan="3" class="bg-ggray">{{$category}}</td>
                        </tr>
                        <tr>
                            <th>물품제목</th>
                            <td colspan="3">{{$user_title}}</td>
                        </tr>
                        <tr>
                            <th>거래번호</th>
                            <td class="bg-ggray">#{{$orderNo}}</td>
                            <th class="visible--table--pc">등록일시</th>
                            <td class="visible--table--pc bg-ggray">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>등록일시</th>
                            <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                        </tr>
                        <tr>
                            <th>거래유형</th>
                            <td>일반</td>
                            <th class="visible--table--pc">구매자 캐릭터명</th>
                            <td class="visible--table--pc">{{$user_character}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>구매자 캐릭터명</th>
                            <td colspan="3">{{$user_character}}</td>
                        </tr>
                        <tr>
                            @php
                                $gamemoney_unit = $gamemoney_unit ?? '';
                                $user_quantity = $user_quantity ?? '';
                                $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                            @endphp
                            @if($c != 1)
                                <th class="bg-white">구매수량</th>
                                <td>{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                            @endif
                            <th>구매금액</th>
                            <td @if($c == 1) colspan='3' class="bg-ggray" @endif>{{number_format($price)}}원</td>
                        </tr>
                    </table>
                @endif
                @if($user_goods_type == 'division')
                    <table class="table-striped table-green1">
                        <tbody>
                            <tr>
                                <th>카테고리</th>
                                <td colspan="3" class="bg-ggray">{{$category}}</td>
                            </tr>
                            <tr>
                                <th>물품제목</th>
                                <td colspan="3">
                                    {{$user_title}}
                                </td>
                            </tr>
                            <tr>
                                <th>거래번호</th>
                                <td class="bg-ggray">#{{$orderNo}}</td>
                                <th class="visible--table--pc">등록일시</th>
                                <td class="visible--table--pc bg-ggray">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>등록일시</th>
                                <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr>
                                <th>거래유형</th>
                                <td colspan="3">분할</td>
                                <th class="visible--table--pc">구매자 캐릭터명</th>
                                <td class="visible--table--pc">{{$user_character}}</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>구매자 캐릭터명</th>
                                <td>{{$user_character}}</td>
                            </tr>
                            <tr>
                                <th>최소구매수량</th>
                                <td class="bg-ggray">{{$user_quantity_min}}{{$unit}} 개</td>
                                <th class="visible--table--pc">최대구매수량</th>
                                <td class="visible--table--pc bg-ggray">{{$user_quantity_max}}{{$unit}} 개</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>최대구매수량</th>
                                <td>{{$user_quantity_max}}{{$unit}} 개</td>
                            </tr>
                            <tr>
                                <th>단위금액</th>
                                <td>{{$user_division_unit}}개당 {{number_format($user_division_price)}}원</td>
                                <th>구매할인</th>
                                <td>
                                    @if($discount_use == 1)
                                        {{$discount_quantity_cnt * $user_division_unit}}개 당 {{number_format($discount_price)}}원 할인
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <div class="highlight_contextual_nodemon mt-10">내 거래정보</div>
                <table class="table-striped table-green1">
                    <tr>
                        <th>이름</th>
                        <td>이장훈</td>
                        <th class="bd_left visible--table--pc">연락처</th>
                        <td class="visible--table--pc">자택번호없음 / 010-4797-3690 <span class='f_green2 font-weight-bold'></span></td>
                    </tr>
                    <tr class="visible--table-m">
                        <th class="bd_left">연락처</th>
                        <td >자택번호없음 / 010-4797-3690 <span class='f_green2 font-weight-bold'></span></td>
                    </tr>
                </table>
                <div class="highlight_contextual_nodemon gray mt-15 pt-5 pl-5">상세설명</div>
                <div class="detail_info mt-0">
                    <div class="detail_text">
                        <div id="js-gallery" class="mb-5">
                            @foreach (\File::glob(public_path('assets/images/angel/'.$id).'/*') as $file)
                                <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">
                                    <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">
                                </a>
                            @endforeach
                        </div>

                        {{$user_text}}
                    </div>
                </div>

                <div class="trade_progress buy">
                    <div class="highlight_contextual_nodemon"> 거래 진행 상황 </div>
                    <div class="trade_progress_content">
                        <div class="guide_wrap">
                            <div class="guide_set active"> <span class="has-sprite buy_regist_icon"></span> <span class="state">구매등록</span>
                                <p>구매할 물품을 등록해놓
                                    <br/>은 [거래대기] 상태.
                                    <br/>판매신청이 들어올때까
                                    <br/>지 기다려주세요.
                                </p>
                            </div>
                            <div class="guide_set"> <span class="has-sprite pay_wait_icon"></span> <span class="state">입금대기</span>
                                <p>구매자가 입금을
                                    <br/>준비하고 있습니다.
                                    <br/>입금완료후,구매중
                                    <br/>상태가 되면 거래를 <br/> 시작해주세요.
                                </p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set"> <span class="has-sprite buy_ing_icon"></span> <span class="state">구매중</span>
                                <p>현재 판매자와 거래중.
                                    <br/>판매자와 반드시 전화
                                    <br/>통화로 거래하시기 <br> 바랍니다.
                                    </p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set"> <span class="has-sprite trade_icon"></span> <span class="state">인수완료</span>
                                <p>거래종료 예정입니다.
                                    <br/>판매자가 인계확인 <br> 할 때까지
                                    <br/>기다려주세요.
                                </p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set"> <span class="has-sprite buy_complete_icon"></span> <span class="state">구매완료</span>
                                <p>거래가 정상적으로
                                    <br/>종료되었습니다.
                                    <br/>문제 발생 시
                                    <br/>고객센터로 <br> 문의해주세요.
                                </p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="frmList" name="frmList" method="post">
                    @csrf
                    <input type="hidden" name="trade_id" value="{{$orderNo}}">
                    <input type="hidden" id="process" name="process"> </form>
                <div class="btn-groups_angel">
                    <a href="/myroom/buy/buy_re_reg?id={{$orderNo}}" class="button-success">
                        재등록
                    </a>
                    <a href="javascript:;" onclick="tradeProcess('@if($hide == 0){{'hideSelect'}}@else{{'showSelect'}}@endif')" class="button-cancel">
                        @if($hide == 0) 숨기기 @else 보이기 @endif
                    </a>
                    <a href="javascript:void(0)" class="button-cancel" onclick="tradeProcess('deleteSelect');">
                        삭제
                    </a>
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection
