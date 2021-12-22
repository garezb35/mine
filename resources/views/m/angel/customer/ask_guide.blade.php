@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/index.css">
    <link rel="stylesheet" href="/angel_mobile/customer/css/report.css" />
    <style>
        #customer_report {
            margin-bottom: 12px;
        }
        .content_part textarea {
            height: 70px;
        }
        #user_phone1 {
            width: 50px;
        }
        #user_phone2, #user_phone3 {
            width: 90px;
        }
        #trade_num {
            width: calc(100% - 20px);
            padding: 3px 5px;
        }
    </style>
@endsection

@section('foot_attach')
    <script>
        window.addEventListener('load', function() {
            $('.question').click(function() {
                var _index = $('.question').index($(this));
                $('.answer').eq(_index).slideToggle('slow');
            });

            $('#board').click(function() {
                alert('현재 등록된 자료가 없습니다.');
            });

            $('#center_call').click(function() {
                if(confirm('고객센터로\n전화연결을 하시겠습니까 ?')) {
                    location.href = 'tel:15448278';
                }
            })
        });
    </script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">이용관련문의</h1>
                <button class="btn_menu" id="btn_menu"><em>메뉴</em></button>
            </div>
        </div>
        <div class="container">
            @php
                $isLogined = '';
                if (Auth::check()) {
                    $isLogined = 1;
                }
            @endphp
            <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
            <div class="content">
                <div class="g_title mg0 fs-16">상담 분류 선택</div>
                <div class="mb_tbl_part">
                    <div class="g_tab2">
                        <div>
                            <a href="{{route('customer_ask_guide')}}?type=login">로그인</a>
                        </div>
                        <div>
                            <a href="{{route('customer_ask_guide')}}?type=exchange">출금</a>
                        </div>
                        <div>
                            <a href="{{route('customer_ask_guide')}}?type=charge">충전/입금</a>
                        </div>
                        <div>
                            <a href="{{route('customer_ask_guide')}}?type=other">기타</a>
                        </div>
                        <div>
                            <a href="{{route('customer_ask_guide')}}?type=faulty" id="faulty">비거래신고</a>
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="g_title mg0 fs-16">자주하는 질문 TOP</div>
                <div class="faq_list">
                    @foreach ($faqRecord as $rec)
                        <div class="question">
                            <span class="category">{{$rec['type']}}</span><br>
                            <div>{{$rec['title']}}</div>
                        </div>
                        <div class="answer" style="display: none;">
                            {!! $rec['content'] !!}
                        </div>
                    @endforeach
                </div>
                @if ($faqType != 'normal')
                    @if ($faqType != 'faulty')
                        <style>
                            .content_part input,
                            .content_part textarea {
                                padding: 6px 6px;
                                border: solid 1px #bdbdbd;
                                width: calc(100% - 14px);
                            }
                        </style>
                        <div class="g_title mg0 fs-16" style="margin-top: 6px;">상담서작성하기</div>
                        <form id="customer_report" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type_ask" value="" id="type_ask">
                            <div style="border: solid 1px #d1d1d1;">
                                <div class="head_part">제목</div>
                                <div class="content_part">
                                    <input type="text" name="subject" value="" id="title" maxlength="40" class="angel__text w-100" placeholder="※ 제목을 입력해 주세요." required>
                                </div>
                                <div class="head_part">상담내용</div>
                                <div class="content_part">
                                    <textarea name="ask_content" id="content" class="" placeholder="※ 상담내용을 입력해 주세요." required></textarea>
                                </div>
                                <div class="head_part">통화가능한 번호</div>
                                <div class="content_part">
                                    <input type="text" placeholder="000" name="user_phone1" id="user_phone1" value="" class="angel__text" maxlength="3" required> -
                                    <input type="text" placeholder="0000" name="user_phone2" id="user_phone2" value="" class="angel__text" maxlength="4" required> -
                                    <input type="text" placeholder="0000" name="user_phone3" id="user_phone3" value="" class="angel__text" maxlength="4" required>
                                </div>
                            </div>
                            <div class="btn-groups_angel" style="margin: 10px 0;">
                                <button class="btn-color-img btn-blue-img" type="submit">확인</button>
                                <button class="btn-color-img btn-gray-img" type="reset">취소</button>
                            </div>
                        </form>
                    @else
                        <style>
                            .content_part label {
                                line-height: 26px;
                            }
                        </style>
                        <form id="customer_report" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="strType" value="faulty">
                            <input type="hidden" name="subject" value="비거래물품">
                            <input type="hidden" name="content" id="content" value="">
                            <input type="hidden" name="type_ask" value="" id="type_ask">
                            <div style="border: solid 1px #d1d1d1;">
                                <div class="head_part">접수분야</div>
                                <div class="content_part">비거래 물품 신고</div>
                                <div class="head_part">이름</div>
                                <div class="content_part">{{$user['name']}}</div>
                                <div class="head_part">거래번호</div>
                                <div class="content_part">#
                                    <input type="text" id="trade_num" name="trade_num" class="angel__text trade_num" value="" required>
                                </div>
                                <div class="head_part">신고사유</div>
                                <div class="content_part">
                                    <input id="option1" type="radio" id="content_type" name="ask_content" value="직거래유도 (연락처 기재, 각종 게임 아이디, 메신저 아이디, 캐릭명 등)">
                                    <label for="option1" style="line-height: 22px;">직거래유도 (연락처 기재, 각종 게임 아이디, 메신저 아이디, 캐릭명 등)</label>
                                    <br>
                                    <input id="option2" type="radio" id="content_type" name="ask_content" value="불법프로그램 ">
                                    <label for="option2">불법프로그램</label>
                                    <br>
                                    <input id="option3" type="radio" id="content_type" name="ask_content" value="카테고리 위반 ">
                                    <label for="option3">카테고리 위반</label>
                                    <br>
                                    <input id="option4" type="radio" id="content_type" name="ask_content" value="거래와 관련 없는 글(욕설, 대화성글 등) ">
                                    <label for="option4">거래와 관련 없는 글(욕설, 대화성글 등)</label>
                                    <br>
                                    <input id="option5" type="radio" id="content_type" name="ask_content" value="그 외 비거래 물품 ">
                                    <label for="option5">그 외 비거래 물품</label>
                                    <br>
                                </div>
                            </div>
                            <div class="btn-groups_angel ">
                                <button class="btn-color-img btn-blue-img " type="submit ">확인</button>
                                <button class="btn-color-img btn-gray-img " type="reset">취소</button>
                            </div>
                        </form>
                    @endif
                @endif
            </div>

        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
