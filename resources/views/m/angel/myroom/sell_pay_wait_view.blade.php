@php
    $category = '> > 기타';
    if(!empty($game['game'])){
        $category = $game['game']." > ";
    }
    if(!empty($server['game'])){
        $category .= $server['game']." > ";
    }

@endphp
@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type='text/css' rel='stylesheet' href='/angel/myroom/sell/css/common_view.css?v=210114'>
@endsection

@section('foot_attach')
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

@section('content')


<div class="container_fulids" id="module-teaser-fullscreen">
    @include("aside.myroom",['group'=>'buy'])
    <div class="pagecontainer">
        <a name="top"></a>

        <div class="contextual--title noborder"> 구매자의 입금을 기다리는 <span>물품</span>
        </div>
        <div class="g_gray_border"></div>


        <div class="highlight_contextual_nodemon first">물품정보</div>
        <table class="table-striped table-green1">
            <colgroup>
                <col width="160">
                <col width="250">
                <col width="160">
                <col /> </colgroup>
            <tr>
                <th>카테고리</th>
                <td colspan="3">{{$category}}</td>
            </tr>
            <tr>
                <th>물품제목</th>
                <td colspan="3"> {{$user_title}} </td>
            </tr>
            <tr>
                <th>거래번호</th>
                <td>#{{$orderNo}}</td>
                <th>등록일시</th>
                <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
            </tr>
            <tr>
                @php
                    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                @endphp
                @if($c != 1)
                    <th>판매수량</th>
                    <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                @endif
                <th>판매금액</th>
                <td @if($c ==1)colspan="3" @endif>{{number_format($payitem['price'])}} 원 </td>
            </tr>
            <tr>
                <th>판매자 캐릭터명</th>
                <td colspan="3">{{$seller['character']}}</td>
            </tr>
        </table>


        <div class="highlight_contextual_nodemon">내 거래정보</div>
        <table class="table-striped table-green1">
            <colgroup>
                <col width="160">
                <col>
            </colgroup>
            <tr>
                <th>이름</th>
                <td>{{$seller['name']}}</td>
            </tr>
            <tr>
                <th>연락처</th>
                <td>{{$seller['home']}} / {{$seller['number']}} <span class="f_blue3 font-weight-bold">(SMS수신)</span></td>
            </tr>
        </table>



        <div class="trade_progress">
            <div class="highlight_contextual_nodemon"> 거래 진행 상황 </div>
            <div class="trade_progress_content">
                <div class="guide_wrap">
                    <div class="guide_set"> <span class="has-sprite sell_regist_icon"></span> <span class="state">판매등록</span>
                        <p>판매할 물품을 등록해놓은
                            <br/>[거래대기] 상태입니다.
                            <br/>구매신청이 들어올때까지
                            <br/>기다려주세요.</p>
                    </div>
                    <div class="guide_set @if($status == 0) active @endif"> <span class="has-sprite pay_wait_icon"></span> <span class="state">입금대기</span>
                        <p>구매자가 구매신청 후
                            <br/>입금을 준비하고 있습니다.
                            <br/>입금완료 후, 판매중 상태가
                            <br/>되면 거래를 시작해주세요.</p> <i class="has-sprite arr_mini"></i> </div>
                    <div class="guide_set @if(($status == 1) || (!str_contains($status, '3')  && $status != 10 && $status !=32 && $status !=23 && $status != 0)) {{'active'}}@endif"> <span class="has-sprite sell_ing_icon"></span> <span class="state">판매중</span>
                        <p>현재 구매자와 거래중입니다.
                            <br/>구매자와 반드시 전화통화로
                            <br/>거래할 캐릭터명을 확인 후
                            <br/>물품을 건네시기 바랍니다. </p> <i class="has-sprite arr_mini"></i> </div>
                    <div class="guide_set @if($status == 3) {{'active'}} @endif"> <span class="has-sprite trade_icon"></span> <span class="state">인계완료</span>
                        <p>거래종료 예정입니다.
                            <br/>구매자가 인수할때까지
                            <br/>기다려주세요.</p> <i class="has-sprite arr_mini"></i> </div>
                    <div class="guide_set @if($status == 23 || $status == 32) {{'active'}} @endif"> <span class="has-sprite sell_complete_icon"></span> <span class="state">판매완료</span>
                        <p>거래가 정상적으로
                            <br/>종료되었습니다.
                            <br/>문제 발생 시
                            <br/>고객센터로 문의해주세요.</p> <i class="has-sprite arr_mini"></i> </div>
                </div>
            </div>
        </div>


        <div class="empty-high"></div>

        <div class="highlight_contextual_nodemon">상세설명</div>
        <div class="detail_info">
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
    </div>
    <div class="empty-high"></div>
</div>

@endsection
