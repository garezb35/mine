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
    $home_a = $home_b = $home_c = '';
    $home_array = $number_array = array();
    if(!empty($cuser['number'])){
        $number_array = explode('-',$cuser['number']);
        $mobile_a = $number_array[0];
        $mobile_b = $number_array[1];
        $mobile_c = $number_array[2];
    }
    if(!empty($cuser['home'])){
        $home_array = explode('-',$cuser['home']);
        $home_a = $home_array[0];
        $home_b = $home_array[1];
        $home_c = $home_array[2];
    }
    $unit = '';
    if($gamemoney_unit != 1 && !empty($gamemoney_unit)){
        $unit = $gamemoney_unit;
    }
@endphp
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/sell/css/view.css'>
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/sell/js/view.js'></script>
    <script type='text/javascript'>
        g_trade_info.sale = '{{$user_goods_type}}';
        g_trade_info.trade_money = {{$price}};
        function __init() {
            g_trade_info.goods='';
        }
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
    <div class="bg-white">
        <div></div>
        <div>
            <input type="hidden" id="screenshot_info" value="TiUzQg==">
            <div class="pagecontainer">
                <p class="mb-5 font-weight-bold">팝니다</p>
                <a name="top"></a>
                <form name="frmSell" id="frmSell">
                    <div class="highlight_contextual_nodemon">물품정보 </div>
                    @if($user_goods_type == 'general')
                        <table class="table-striped table-green1">
                            <colgroup>
                                <col width="100">
                                <col width="250">
                                <col width="100">
                                <col />
                            </colgroup>
                            <tr>
                                <th>카테고리</th>
                                <td colspan="3">{{$category}}</td>
                            </tr>
                            <tr>
                                <th>물품제목</th>
                                <td colspan="3">{{$user_title}}</td>
                            </tr>
                            <tr>
                                <th>거래번호</th>
                                <td class="e--pc">#{{$orderNo}}</td>
                                <th class="visible--table--pc">등록일시</th>
                                <td class="visible--table--pc">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th >등록일시</th>
                                <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr>
                                <th>거래유형</th>
                                <td colspan="3">일반</td>
                            </tr>

                            <tr>
                                @php
                                    $gamemoney_unit = $gamemoney_unit ?? '';
                                    $user_quantity = $user_quantity ?? '';
                                    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                                @endphp
                                @if($c != 1)
                                    <th class="bg-white">구매수량</th>
                                    <td class="e--pc">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                                @endif
                                <th @if($c != 1) class="visible--table--pc" @endif>구매금액</th>
                                <td @if($c == 1) colspan='3' @else class="visible--table--pc"  @endif>{{number_format($price)}}원</td>
                            </tr>
                            @if($c != 1)
                            <tr class="visible--table-m">
                                <th>구매금액</th>
                                <td  colspan='3'>{{number_format($price)}}원</td>
                            </tr>
                            @endif
                        </table>
                    @endif
                    @if($user_goods_type == 'division')
                        <table class="table-striped table-green1">
                            <colgroup>
                                <col width="100">
                                <col width="250">
                                <col width="100">
                                <col>
                            </colgroup>
                            <tbody><tr>
                                <th>카테고리</th>
                                <td colspan="3">{{$category}}</td>
                            </tr>
                            <tr>
                                <th>물품제목</th>
                                <td colspan="3">
                                    {{$user_title}}
                                </td>
                            </tr>
                            <tr>
                                <th>거래번호</th>
                                <td class="e--pc">#{{$orderNo}}</td>
                                <th class="visible--table--pc">등록일시</th>
                                <td class="visible--table--pc">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>등록일시</th>
                                <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                            </tr>
                            <tr>
                                <th>최소구매수량</th>
                                <td class="e--pc">{{number_format($user_quantity_min)}}{{$unit}} 개</td>
                                <th class="visible--table--pc">최대구매수량</th>
                                <td class="visible--table--pc">{{number_format($user_quantity_max)}}{{$unit}} 개</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>최대구매수량</th>
                                <td colspan="3">{{number_format($user_quantity_max)}}{{$unit}} 개</td>
                            </tr>
                            <tr>
                                <th>단위금액</th>
                                <td class="e--pc">{{number_format($user_division_unit)}}{{$unit}}개당 {{number_format($user_division_price)}}원</td>
                                <th class="visible--table--pc">구매할인</th>
                                <td class="visible--table--pc">
                                    @if($discount_use == 1)
                                        {{$discount_quantity_cnt * $user_division_unit}}개 당 {{number_format($discount_price)}}원 할인
                                    @endif
                                </td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>구매할인</th>
                                <td colspan="3">
                                    @if($discount_use == 1)
                                        {{$discount_quantity_cnt * $user_division_unit}}개 당 {{number_format($discount_price)}}원 할인
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </form>
                <div class="highlight_contextual_nodemon mt-10"> 판매자정보 </div>
                <div class="selling_middle">
                    <div class="pr-5">
                        <div class="border-gray2 pt-17 pl-10" style="padding-bottom: 53px">
                            <div class="d-flex">
                                <img src="/angel/img/level/{{$user['roles']['icon']}}" width="37"/>
                                <div class="mt-5 ml-5">
                                    <p class="f-13">{{$user['roles']['alias']}}회원</p><p class="f-13">거래점수 : {{number_format($user['point'])}}점</p>
                                </div>
                            </div>
                            <dl class="add_info mt-15">
                                <dd>
                                    <span class="con w60 btn_state @if($user['mobile_verified'] == 1)  bg-redi text-white @endif">휴대폰</span>
                                    <span class="on w60 btn_state @if($user['bank_verified'] == 1)  bg-redi text-white @endif">계좌</span>
                                    <span class="on w60 btn_state @if($user['pin'] == 1) bg-redi text-white @endif">아이핀</span>
                                    <span class="w60 btn_state @if(!empty($user['email_verified_at'])) bg-redi text-white @endif">이메일</span>
                                </dd>
                            </dl>
                        </div>
                        <div class="mt-5">
                            <div class="highlight_contextual_nodemon mt-0">거래 사기 실시간 조회 서비스</div>
                            <div class="trade_fraud" id="trade_fraud">
                                <div class="text-center mb-5"> - 물품등록의 거래사기 피해사례를 확인하세요
                                    <a href="javascript:;" data-type="user" class="srh_btn">조회</a>
                                    <input type="hidden" id="FraudTrade_id" value="{{$orderNo}}">
                                </div>
                                <div class="direct text-center">
                                    <input type="text" name="srh_txt" id="srh_txt" class="angel__text text-left" placeholder="휴대폰번호/계좌번호">
                                    <a href="javascript:;" data-type="direct" class="srh_btn">조회</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="highlight_contextual_nodemon gray pt-5" style="padding-left: 6px"> 상세설명
                            <a href="javascript:;" class="wideview"  id="wideview" style="margin-right: 6px">열기 <i class="fa fa-angle-down"></i></a>
                        </div>
                        <div class="detail_info bg-white" id="detail_info" style="height: 203px">
                            <div class="detail_text" style="height: 200px">
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
                </div>


                <div class="b_input_group">
                    @if($user_goods_type == 'general' || $user_goods_type == 'division')
                        <a href="/sell/application?id={{$orderNo}}" class="button-success">구매신청</a>
                    @endif
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection

