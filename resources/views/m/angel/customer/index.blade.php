@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/index.css" />
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

        $.fn.extend({
            fnSearch : function ()
            {
                var frm = $('#searchForm');
                frm.find('[name="searchWord"]').val($(this).text());
                frm.submit();
            }
        });
    </script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">고객센터</h1>
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
            <form name="searchForm" id="searchForm" method="post" action="{{route('main_customer')}}">
                @csrf
                <div class="search">
                    <div class="search_bar">
                        <input type="text" class="s_text w-100" name="searchWord" placeholder="검색어를 입력해 주세요." value="{{$searchWord}}" style="">
                        <div class="search_img"></div>
                    </div>
                </div>
            </form>
            <div class="content">
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
                <div class="custom-menu">
                    <div class="g_title bd_none">고객센터 메뉴</div>
                    <ul class="snb">
                        <li>
                            <a href="{{route('customer_faq')}}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{route('customer_report')}}">거래취소요청</a>
                        </li>
                        <li>
                            <a href="{{route('customer_report_end')}}">거래종료요청</a>
                        </li>
                        <li>
                            <a href="{{route('customer_ask_guide')}}">이용관련문의</a>
                        </li>
                        <li>
                            <a href="{{route('myqna_list')}}">나의 질문과답변</a>
                        </li>
                        <li>
                            <a href="{{route('customer_newgame')}}">게임/서버 추가요청</a>
                        </li>
                        <li>
                            <a href="{{route('customer_safety')}}">안전거래</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="bottom_area">
                <a href="javascript:;" id="center_call">
                    <div class="bottom_info">
                        <span class="call_num">1532-9945</span>
                        <span class="call_txt">365일 24시간 연중무휴</span>
                    </div>
                </a>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
