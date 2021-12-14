{{--
0:신청
1:재흥정
10:수락
2:판매자흥정취소
3:유저재흥정거절
4:유저흥정취소
--}}
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
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/buy_pay_wait_view.css">
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_view.css">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_check_view.js"></script>
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
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'buy'])
        <input type="hidden" id="screenshot_info" value="TiUzQg==">
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="130">
                    <col width="250">
                    <col width="130">
                    <col>
                </colgroup>
                <tbody>
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
                    <td>#{{$orderNo}}</td>
                    <th>등록날자,시간</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    <th>거래유형</th>
                    <td colspan="3">흥정</td>
                </tr>
                <tr>
                    <th>즉시 판매금액</th>
                    <td colspan="3">{{number_format($user_price)}} 원</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 판매자정보 //-->
            <div class="g_subtitle">판매자 정보</div>
            <table class="table-greenwith">
                <colgroup>
                    <col width="310px" />
                    <col width="*" />
                </colgroup>
                <tr>
                    <th class="p-left-10">
                        <div>
                            <img src="/angel/img/level/{{$seller['roles']['icon']}}" width="37"/>
                            <span class="f_green4 f_bold">{{$seller['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($seller['point'])}}점)
                        </div>
                    </th>
                    <td>
                        <dl class="add_info">
                            <dd>
                                <span class="w80 cert_state">인증상태</span>
                                <span class="con w80 btn_state">
                                        @if($seller['mobile_verified'] == 1)
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif휴대폰</span>
                                <span class="on w80 btn_state">
                                        @if($seller['bank_verified'] == 1)
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif계좌</span>
                                <span class="on w80 btn_state">
                                        @if($seller['pin'] == 1)
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif아이핀</span>
                                <span class="w80 btn_state">
                                        @if(!empty($seller['email_verified_at']))
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif이메일</span>
                            </dd>
                        </dl>
                        <div class="g_right">
                            <a href="javascript:fnCreditViewCheck()"></a>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="trade_progress_content">
                <!-- ▼ 판매진행안내 //-->
                <div class="trade_progress buy">
                    <div class="g_subtitle">
                        거래 진행 상황
                    </div>
                    <div class="trade_progress_txt">
                        (흥정 대기 중)
                    </div>
                    <div class="trade_progress_content">
                        <div class="guide_wrap">
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 0 || $bargains[0]['status'] == 3){{'active'}}@endif">
                                <span class="SpGroup check_apply"></span>
                                <span class="state">흥정신청</span>
                                <p>판매자의 흥정수락을<br>기다리고 있습니다.<br>판매자가 흥정을 거부할 경우,<br>재흥정이 불가합니다.</p>
                            </div>
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 1){{'active'}}@endif">
                                <span class="SpGroup check_re_apply"></span>
                                <span class="state">재흥정신청</span>
                                <p>판매자가 재 흥정 신청을 했습니다.<br>30분안에 재흥정에 대한<br>수락여부를 결정해주세요.</p>
                                <i class="SpGroup arr_mini"></i>
                            </div>
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 10){{'active'}}@endif">
                                <span class="SpGroup check_ok"></span>
                                <span class="state">흥정수락</span>
                                <p>흥정이 성사되었습니다.<br>입금해야할 물품에서 결제 후<br>거래를 진행해주세요.</p>
                                <i class="SpGroup arr_mini"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ▲ 판매진행안내 //-->
            </div>
            <!-- ▲ 거래진행상황 //-->
            <!-- ▼ 흥정거래 정보 //-->
            <form id="frmCheckView" name="frmCheckView" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$orderNo}}">
                <input type="hidden" name="process">
            </form>
            <div class="g_subtitle">흥정거래 정보</div>
            <table class="g_green_table2">
                <tbody>
                <tr>
                    <th>흥정일시</th>
                    <th>흥정제시금액</th>
                    <th>흥정상태</th>
                    <th class="bd_right_non">흥정합의</th>
                </tr>
                @foreach($bargains as $value)
                <tr>
                    <td>{{date("Y-m-d H:i:s",strtotime($value['created_at']))}}</td>
                    <td>{{number_format($value['price'])}} 원</td>
                    @if($value['status'] == 0)
                    <td>&nbsp;</td>
                    <td class="bd_right_non">
                        <a href="javascript:void(0)"  class="btn-default btn-default-sm btn-secondary" onclick="if(confirm('흥정을 취소하시겠습니까?')) TradeCheck('Y2FuY2Vs', 'OTM3NDQ2NA=='); ">흥정취소</a>
                    </td>

                    @elseif($value['status'] == 1)
                        <td>재흥정중({{number_format($value['price1'])}}원)</td>
                        <td class="bd_right_non">
                            <a href="javascript:void(0)" class="btn-default btn-default-sm btn-green" onclick="if(confirm('재흥정을 수락하시겠습니까?')) TradeCheck('1', '{{$value['id']}}'); ">재흥정 수락</a>
                            <a href="javascript:void(0)" class="btn-default btn-default-sm btn-green" onclick="if(confirm('재흥정을 거부하시겠습니까?')) TradeCheck('0', '{{$value['id']}}'); ">재흥정 거부</a>
                        </td>

                    @elseif($value['status'] == 3)
                        <td>흥정거절</td>
                        <td class="bd_right_non">

                        </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- ▲ 흥정거래 정보 //-->
            <!-- ▼ 상세설명 //-->
            <div class="g_subtitle">상세설명</div>
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
        <div class="g_finish"></div>
    </div>
@endsection
