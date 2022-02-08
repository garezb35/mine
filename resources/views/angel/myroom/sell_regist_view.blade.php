@php

    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
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
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type='text/css' rel='stylesheet' href='/angel/myroom/sell/css/common_view.css?v=210114'>
@endsection

@section('content')
    <div class="bg-white">
        <div>
            @include("angel.myroom.header")
        </div>
        <div >
        @include('aside.myroom',['group'=>'sell'])
        <div class="pagecontainer">
            <a name="top"></a>
            <div class="highlight_contextual_nodemon first">물품정보</div>
            @if($user_goods_type == 'general')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="110px"/>
                        <col width="*"/>
                    </colgroup>
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
                            <td colspan="3" class="bg-ggray">#{{$orderNo}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>등록일시</th>
                            <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                        </tr>
                        <tr>
                            <th>거래유형</th>
                            <td>{{$selltype}}</td>
                            <th class="visible--table--pc" style="width: 110px">판매자 캐릭터명</th>
                            <td class="visible--table--pc">{{$user_character}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>판매자 캐릭터명</th>
                            <td colspan="3">{{$user_character}}</td>
                        </tr>
                        <tr>
                            @php
                            $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                            @endphp
                            @if($c != 1)
                                <th>판매수량</th>
                                <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                            @endif
                            <th @if($c != 1) class="visible--table--pc" @endif>판매금액</th>
                            <td @if($c ==1)colspan="3" class="bg-ggray" @else class="visible--table--pc bg-ggray" @endif>{{number_format($user_price)}}원</td>
                        </tr>
                        @if($c != 1)
                        <tr class="visible--table-m">
                            <th>판매금액</th>
                            <td class="bg-ggray" colspan="3">{{number_format($user_price)}}원</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            @endif
{{--            @if($user_goods_type == 'bargain')--}}
{{--            @endif--}}
            @if($user_goods_type == 'division')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="110px"/>
                        <col width="*"/>
                    </colgroup>
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
                            <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                        </tr>
                        <tr>
                            <th>거래유형</th>
                            <td colspan="3">{{$selltype}}</td>
                        </tr>
                        <tr>
                            <th>판매금액</th>
                            <td class="bg-ggray">{{number_format($user_division_unit)}} 개 당 {{number_format($user_division_price)}}원</td>
                            <th class="visible--table--pc">판매자 캐릭터명</th>
                            <td class="visible--table--pc bg-ggray">{{$user_character}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>판매자 캐릭터명</th>
                            <td colspan="3">{{$user_character}}</td>
                        </tr>
                        <tr>
                            <th>최소수량</th>
                            <td>{{number_format($user_quantity_min)}} 개</td>
                            <th class="visible--table--pc">최대수량</th>
                            <td class="visible--table--pc">{{number_format($user_quantity_max)}} 개&nbsp;</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>최대수량</th>
                            <td colspan="3">{{number_format($user_quantity_max)}} 개&nbsp;</td>
                        </tr>

                    </tbody>
                </table>
                @if($discount_use == 1)
                <div class="highlight_contextual_nodemon">복수 구매 할인</div>
                <table class="table-striped table-green1">
                    <tbody>
                        <tr>
                            <th>할인적용</th>
                            <td>{{$discount_quantity * $discount_quantity_cnt}}개 구매 시 마다 {{number_format($discount_price)}}원씩 추가로 할인됨.</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            @endif


            <div class="highlight_contextual_nodemon mt-15">내 거래정보</div>
            <table class="table-striped table-green1">
                <tr>
                    <th>이름</th>
                    <td>{{$cuser['name']}}</td>
                    <th class="visible--table--pc">연락처</th>
                    <td class="visible--table--pc"> @if(empty($cuser["home"])){{'자택번호없음'}}@else{{$cuser['home']}}@endif / {{$cuser['number']}} <span class='f_blue3 font-weight-bold'></span> </td>
                <tr class="visible--table-m">
                    <th>연락처</th>
                    <td colspan="2"> @if(empty($cuser["home"])){{'자택번호없음'}}@else{{$cuser['home']}}@endif / {{$cuser['number']}} <span class='f_blue3 font-weight-bold'></span> </td>
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

            <div class="trade_progress">
                <div class="highlight_contextual_nodemon"> 거래 진행 상황 </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap ww25">
                        <div class="guide_set @if($status == 0){{'active'}} @endif"> <span class="has-sprite sell_regist_icon"></span> <span class="state">판매등록</span>
                            <p>판매할 물품을 등록해놓은
                                <br/>[거래대기] 상태입니다.
                                <br/>구매신청이 들어올때까지
                                <br/>기다려주세요.</p>
                        </div>
                        <div class="guide_set @if($status == 1){{'active'}} @endif"> <span class="has-sprite sell_ing_icon"></span> <span class="state">판매중</span>
                            <p>현재 구매자와 거래중입니다.
                                <br/>구매자와 반드시 전화통화로
                                <br/>거래할 캐릭터명을 확인 후
                                <br/>물품을 건네시기 바랍니다. </p> <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set @if(str_contains($status,3)){{'active'}} @endif"> <span class="has-sprite trade_icon"></span> <span class="state">인계완료</span>
                            <p>거래종료 예정입니다.
                                <br/>구매자가 인수할때까지
                                <br/>기다려주세요.</p> <i class="has-sprite arr_mini"></i> </div>
                        <div class="guide_set @if(str_contains($status,4)){{'active'}} @endif"> <span class="has-sprite sell_complete_icon"></span> <span class="state">판매완료</span>
                            <p>거래가 정상적으로
                                <br/>종료되었습니다.
                                <br/>문제 발생 시
                                <br/>고객센터로 문의해주세요.</p> <i class="has-sprite arr_mini"></i> </div>
                    </div>
                </div>
            </div>
            <div class="warning">
                <p class="warning_title">
                    물품을 넘겨주기전에 꼭 읽어보세요!
                </p>
                <p>
                    1 구매자의 연락처가 다를경우 거래를 중지하시고 고객센터를 통해 문의해 주시기 바랍니다.<br>
                    2 게임상에서 거래할 캐릭터명이 위의 구매자 캐릭터명과 같은지 확인하시기 바랍니다.<br>
                    3 거래시에는 게임상에서 채팅이나 귓말은 감가하시고 가능하면 전화통화를 유지하시기 바랍니다.<br>
                    4 반드시 물품을 정상적으로 인계하신후 물품인계확인을 하시기 바랍니다.<br>
                    5 거래취소 sns 수신 후 1시간 이내 인계확인 되지 않을 경우 거래가 자동취소 될수 있으니 유희하시기 바랍니다.
                </p>
            </div>


            <form id="frmList" name="frmList" method="post">
                @csrf
                <input type="hidden" name="trade_id" value="{{$orderNo}}">
                <input type="hidden" id="process" name="process"> </form>
            <div class="b_input_group">
                @if($status == 0)
                    <a href="/myroom/sell/sell_re_reg?id={{$orderNo}}" class="button-success">재등록</a>
                    <a href="javascript:;" onclick="tradeProcess('@if($hide == 0){{'hideSelect'}}@else{{'showSelect'}}@endif')" class="button-cancel">
                        @if($hide == 0) 숨기기 @else 보이기 @endif
                    </a>
                    <a class="button-cancel" onclick="tradeProcess('deleteSelect');">삭제</a>
                @endif
            </div>



        </div>
        <div class="empty-high"></div>
    </div>
    </div>

@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/sell/js/sell_regist.js"></script>
    <script type='text/javascript' src='/angel/js/sell_regist_view.js'></script>
    <script>
        $('#js-gallery')
            .packery({
                itemSelector: '.slide',
                gutter: 10
            })
            .photoSwipe('.slide', {bgOpacity: 0.8, shareEl: false}, {
                close: function () {
                    console.log('closed');
                }
            });
    </script>
@endsection
