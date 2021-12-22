@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/index.css" />
    <style>
        .content {
            padding-top: 0px;
        }
        .faq_list {
            margin-top: 0px;
        }
        .custom-menu {
            margin-top: 10px;
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
                <h1 class="c-black">FAQ</h1>
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
                    <div class="g_title bd_none">추천검색어</div>
                    <ul class="snb">
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=안전거래">안전거래</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=거래취소">거래취소</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=충전">충전</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=출금">출금</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=정지">정지</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=수수료">수수료</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=결제">결제</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=신용등급">신용등급</a>
                        </li>
                        <li>
                            <a href="{{route('customer_faq')}}?searchWord=거래방법">거래방법</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
