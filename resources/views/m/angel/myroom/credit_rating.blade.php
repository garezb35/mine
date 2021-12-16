@php
$issues_list = json_decode($user['issue_count']);
@endphp
@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/credit_rating.css">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/myinfo/js/credit_rating.js"></script>
@endsection
@section('content')
    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('aside.myroom',['group'=>''])
        <div class="pagecontainer">
            <div class="contextual--title noborder">
                신용등급/인증
            </div>
            <div class="highlight_contextual_nodemon">등급별 혜택</div>
            <table class="g_ratinreact_nav_table">
                <colgroup>
                    <col width="506px"/>
                </colgroup>
                <tr style="height: 106px">
                    <td>
                        <img src="/angel/img/level/{{$user['roles']['icon']}}" />
                        <div class="credit_name">
                            <div class="font-weight-bold"><span class="text-blue_modern">{{$user['name']}}</span>님의 신용등급은
                                <span class="text-blue_modern">{{$user['roles']['alias']}}</span>입니다.
                            </div>
                            전체거래점수 : <strong class="text-rock">{{number_format($user['point'])}}점</strong>
                        </div>
                    </td>
                    <td class="point_parts text-center font-weight-bold">
                        <div class="text-center mb-10">무료이용권</div>
                        <div class="text-center"><span class="text-blue_modern">{{number_format($gift)}}</span></div>
                    </td>
                </tr>
            </table>


            <div class="benefit mt-10">
                <div class="my_benefit vip">
                    <ul class="benefit_cnt">
                        @foreach($roles as $key => $v)
                        <li @if($user['roles']['id'] == $v['id']) style="border: 3px solid #0085FF" @endif>
                            <div >
                                <img src="/angel/img/level/{{$v['icon']}}" class="mt-20"/>
                                <div class="font-weight-bold f-17" style="color: #{{$v['color']}}">{{$v['alias']}}</div>
                                <div>거래 {{number_format($v['point'])}}건</div>
                                @if(!empty($v['rolegift']) && sizeof($v['rolegift']) > 0)
                                    @foreach($v['rolegift'] as $gift_item)
                                        <div>{{$gift_item['comment']}}</div>
                                    @endforeach
                                @endif
                                <div class="last-part">
                                    {{$v['comment']}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
{{--                    <div class="over"></div>--}}
                </div>
            </div>

            <table class="admin_point_table mt-20">
                <colgroup>
                    <col width="350px"/>
                </colgroup>
                <tr>
                    <td class="fir_td">
                        <span class="font-weight-bold f-14 text-blue_modern">관리점수</span>&nbsp;&nbsp;&nbsp;
                        <span class="text-rock font-weight-bold">{{$user['issue_point']}}</span> 점
                        <span class="f_black1"> (불량거래 : {{number_format($issues_list[0])}}건, 일시정지 : {{number_format($issues_list[1])}}회)</span>
                    </td>
                    <td class="sec_td" style="height: 59px;">
                        <span class="font-weight-bold f-15">인증상태</span>&nbsp;&nbsp;&nbsp;
                        <span class="cert_states" onmouseover="$('#hppAuth').show();" onmouseout="$('#hppAuth').hide();" onclick="_window.open('mobile_certify', '/certify/ini_modi_authcenter/user_certify.html?cellNum=01047973690', 430, 700);">
                          @if($user['mobile_verified'] == 1)<img src="/angel/img/icons/icon_check.png">@endif 휴대폰
                       </span>
                        <span class="cert_states" onmouseover="$('#acAuth').show();" onmouseout="$('#acAuth').hide();">
                         @if($user['bank_verified'] == 1)<img src="/angel/img/icons/icon_check.png">@endif 계좌
                       </span>
                        <span class="cert_states" onmouseover="$('#ipinAuth').show();" onmouseout="$('#ipinAuth').hide();">
                          아이핀
                       </span>
                        <input type="hidden" id="user_email" value="{{$user['email']}}">
                         <span class="cert_states" onmouseover="$('#emailAuth').show();" onmouseout="$('#emailAuth').hide();" onclick="fnemail();">
                          @if(!empty($user['email_verified_at']))<img src="/angel/img/icons/icon_check.png">@endif 휴대폰이메일
                       </span>


                    </td>
                </tr>
            </table>
            <form id="reqCBAForm" name="reqCBAForm" method="post" action="/certify/ipin_auth/v3/module/ipin_request" target="frmTarget">
                <input type="hidden" name="wis" value="MyAuthCredit">
            </form>
            <iframe src="about:blank" width="0" height="0" name="frmTarget" style="border:0"></iframe>

            <div class="empty-high"></div>

            <table class="table-primary tb_list">
                <colgroup>
                    <col width="200px">
                </colgroup>
                <tbody>
                    <tr >
                        <th style="background: #E3F0F3" rowspan="2">
                            <div style="display: flex;justify-content: space-between;margin-right: 10px;margin-bottom: 10px">
                                <span class="p-left-10 font-weight-bold">총 판매 건수</span>
                                <div><span class="font-weight-bold text-blue_modern f-15">{{number_format($sell_all[0])}}</span>건</div>
                            </div>
                            <div style="display: flex;justify-content: space-between;margin-right: 10px;">
                                <span class="p-left-10">총 판매 금액</span>
                                <div><span class="b_bold text-blue_modern f-15">{{number_format($sell_all[1])}}</span>원</div>
                            </div>
                        </th>
                        <td class="font-weight-bold" colspan="12">판매정보 보기</td>
                    </tr>
                    <tr>
                        @for($i = 1; $i <=12; $i++)
                            <td style="background: #EDEDED">{{$i}}월</td>
                        @endfor
                    </tr>
                    <tr>
                        <td class="th2">판매건수</td>

                        @for($i = 1; $i <=12; $i++)
                            <td>{{empty($sell_list[$i.'m']['count']) ? 0 : number_format($sell_list[$i.'m']['count'])}}</td>
                        @endfor
                    </tr>

                    <tr>
                        <td class="th2">판매금액</td>
                        @for($i = 1; $i <=12; $i++)
                            <td>{{empty($sell_list[$i.'m']['order']) ? 0 : number_format($sell_list[$i.'m']['order'])}}</td>
                        @endfor
                    </tr>
                    <tr>
                        <td class="th2">취소/거부</td>
                        @for($i = 1; $i <=12; $i++)
                            <td>0</td>
                        @endfor
                    </tr>
                </tbody>
            </table>

            <table class="table-primary tb_list">
                <colgroup>
                    <col width="200px">
                </colgroup>
                <tbody>
                <tr >
                    <th style="background: #E3F0F3" rowspan="2">
                        <div style="display: flex;justify-content: space-between;margin-right: 10px;margin-bottom: 10px">
                            <span class="p-left-10 font-weight-bold">총 구매 건수</span>
                            <div><span class="font-weight-bold text-blue_modern f-15">{{number_format($buy_all[0])}}</span>건</div>
                        </div>
                        <div style="display: flex;justify-content: space-between;margin-right: 10px;">
                            <span class="p-left-10">총 구매 금액</span>
                            <div><span class="b_bold text-blue_modern f-15">{{number_format($buy_all[1])}}</span>원</div>
                        </div>
                    </th>
                    <td class="font-weight-bold" colspan="12">구매정보 보기</td>
                </tr>
                <tr>
                    @for($i = 1; $i <=12; $i++)
                        <td style="background: #EDEDED">{{$i}}월</td>
                    @endfor
                </tr>
                <tr>
                    <td class="th2">구매건수</td>

                    @for($i = 1; $i <=12; $i++)
                        <td>{{empty($buy_list[$i.'m']['count']) ? 0 : number_format($buy_list[$i.'m']['count'])}}</td>
                    @endfor
                </tr>

                <tr>
                    <td class="th2">구매금액</td>
                    @for($i = 1; $i <=12; $i++)
                        <td>{{empty($buy_list[$i.'m']['order']) ? 0 : number_format($buy_list[$i.'m']['order'])}}</td>
                    @endfor
                </tr>
                <tr>
                    <td class="th2">취소/거부</td>
                    @for($i = 1; $i <=12; $i++)
                        <td>0</td>
                    @endfor
                </tr>
                </tbody>
            </table>

        </div>

        <form id="reloadFrm" name="reloadFrm" method="post">
        </form>
        <form name="ini" method="post">
            <input type="hidden" name="buyername" value="이장훈">
            <input type="hidden" name="mid" value="itemmani15">
            <input type="hidden" name="print_msg" value="">
            <input type="hidden" name="acceptmethod" value="">
            <input type="hidden" name="encrypted" value="">
            <input type="hidden" name="sessionkey" value="">
            <input type="hidden" name="cardcode" value="">
            <input type="hidden" name="paymethod" value="">
            <input type="hidden" name="uid" value="">
            <input type="hidden" name="version" value="4000">
            <input type="hidden" name="clickcontrol" value="">
            <input type="hidden" name="merchantreserved3" value="">
        </form>
        <form name="ini_pub" id="ini_pub" method="post">
            <input type="hidden" name="buyername" value="이장훈">
            <input type="hidden" name="INIregno" value="">
            <input type="hidden" name="acceptmethod" value="authreg">
            <input type="hidden" name="encrypted" value="">
            <input type="hidden" name="clickcontrol" value="">
            <input type="hidden" name="mid" value="itemmani15">
            <input type="hidden" name="key" value="">
            <input type="hidden" name="gopaymethod" value="PUB">
        </form>
        <div class="empty-high"></div>
    </div>
@endsection
