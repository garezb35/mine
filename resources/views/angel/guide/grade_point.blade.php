@extends('layouts-angel.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/angel/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/angel/dev/guide_arrow.css">
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <style>
        .g_title_blue {
            margin-left: 20px;
        }
        .g_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .g_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .g_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .g_blue_table tr th {
            background-color: #e3f0f3;
        }
        .g_blue_table,
        .g_blue_table tr th,
        .g_blue_table tr td {
            border: solid 1px #89c1ce;
        }
    </style>

    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <style>
            .aside .img_wrap {
                width: 214px;
                height: 98px;
                box-sizing: border-box;
                text-align: center;
                margin: 10px 0;
                border: 1px solid #E1E1E1;
            }
            .aside .img_wrap > .title {
                width: 182px;
                height: 30px;
                margin: 0 auto 10px;
                font-size: 13px;
                font-weight: bold;
                color: #636363;
                border-bottom: 1px solid #F1F1F1;
                line-height: 30px;
            }

            .aside .img_wrap > .content {
                font-size: 12px;
                font-weight: bold;
                color: #767676;
            }
            .aside .callme {
                display: block;
                height: auto;
                padding: 15px 0;
                background-color: #EBF2F8
            }
            .aside .callme > .img_callme {
                display: inline-block;
                width: 43px;
                height: 35px;
                background-position: -826px -545px;
                margin: 0 3px 0 15px;
            }
            .aside .callme > .callme_title {
                margin-top: -2px;
                font-size: 13px;
                font-weight: bold;
                color: #0081DB;
                border: none;
                height: auto;
            }
            .aside .callme > .callme_title > span {
                font-size: 16px;
                font-weight: bold;
                color: #1D1D1D;
            }
            .aside .callme > .callme_title .go_btn {
                display: inline-block;
                width: 57px;
                height: 19px;
                margin-left: 6px;
                font-size: 11px;
                font-weight: bold;
                color: #FFF;
                background-color: #216ED7;
                text-align: center;
                line-height: 19px;
                vertical-align: text-bottom;
            }
            .ft_orange {
                color: #FF4E00;
            }
        </style>
        @include('angel.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue">
                <div class="g_left"><img src="http://img3.itemmania.com/images/guide/title_cred.gif" width="145" height="20" alt="신용등급/인증센터"></div>
            </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
{{--                <div><a href="safe_grade.html">신용등급</a></div>--}}
                <div class="selected"><a href="{{route('safe_grade_point')}}">관리점수</a></div>
                <div ><a href="{{route('safe_grade_certify')}}">인증센터</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="g_subtitle_blue">관리점수</div> 안전한 거래를 위해 불량거래나 사이트 이용 시 규정을 위반한 경우 관리점수를 부과합니다.
            <div class="guide_subtitle">■ 감점사항</div>
            <table class="g_blue_table" id="point_table">
                <colgroup>
                    <col width="55">
                    <col width="">
                    <col width="61">
                </colgroup>
                <tbody>
                <tr>
                    <th colspan="3" class="first align_left">불량 거래 관련 벌점 사항</th>
                </tr>
                <tr>
                    <td class="first">1</td>
                    <td class="align_left">등록물품의 연락처 기재 적발 시 1회 마다</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">2</td>
                    <td class="align_left">이벤트 등 편법 사용 적발시</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">3</td>
                    <td class="align_left">타사이트 광고 글 등록 적발 시 1회마다</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">4</td>
                    <td class="align_left">욕설 등록 적발시 1회마다</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">5</td>
                    <td class="align_left">사이트 거래와 관련없는 글 등록 적발 시 1회마다</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">6</td>
                    <td class="align_left">기타 관리자가 판단하여 감점 사항에 해당될 수 있다고 판단되는 경우 1회마다</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <th colspan="3" class="first align_left table_top">이용규정 위반 벌점 사항</th>
                </tr>
                <tr>
                    <td class="first">1</td>
                    <td class="align_left">연락처 허위기재, 상습 기재</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">2</td>
                    <td class="align_left">직거래 유도, 허위구매/판매 신청</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">3</td>
                    <td class="align_left">직거래 유도, 타사이트 광고글 거래등록</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">4</td>
                    <td class="align_left">해킹, 사기사고 발생, 사고관련 거래</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">5</td>
                    <td class="align_left">사이트와 관계없는 글 기재, 불법 프로그램 거래 등록</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">6</td>
                    <td class="align_left">물품도배, 서비스 진행 방해, 비정상결제(핸드폰 도용)</td>
                    <td>-10점</td>
                </tr>
                <tr>
                    <td class="first">7</td>
                    <td class="align_left">기타 관리자가 판단하여 일시중지 사항에 해당될 수 있다고 판단되는 경우 1회마다</td>
                    <td>-10점</td>
                </tr>
                </tbody>
            </table>
            <div class="guide_subtitle">■ 감점에 따른 제재</div>
            <table class="g_blue_table" id="point_table2">
                <colgroup>
                    <col width="160">
                    <col width="199">
                    <col width="199">
                    <col width="">
                </colgroup>
                <tbody>
                <tr>
                    <th class="first">구분</th>
                    <th>-20점이 넘은 경우</th>
                    <th>-40점이 넘은 경우</th>
                    <th>-60점이 넘은 경우</th>
                </tr>
                <tr>
                    <td class="first">제재사항</td>
                    <td>1등급 하락</td>
                    <td>1등급 하락</td>
                    <td>사이트 이용불가</td>
                </tr>
                <tr>
                    <td class="first">제재기간</td>
                    <td>2주</td>
                    <td>4주</td>
                    <td>무기한</td>
                </tr>
                </tbody>
            </table>
            <div class="guide_subtxt"> - 1등급 하락은 판매등급, 구매등급 모두 적용됩니다.
                <br> - 제재기간에는 하락된 등급에서 상승이나 하락이 불가능합니다.
                <br> - 제재기간 후에는 신용등급 책정 기준에 따라 신용등급이 다시 책정됩니다. </div>
            <div class="divi_line"></div>
            <a href="#top"><img class="g_right" src="http://img2.itemmania.com/images/btn/Scroll-to-top.png" width="61" height="20" alt="맨위로"></a>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
