@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/_banner.css?v=210107101945">
    <link type="text/css" rel="stylesheet" href="/mania/home/index.css">
    <link type="text/css" rel="stylesheet" href="/mania/home/custom.css">

    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/_js/_xml2json.js?190220"></script>

    <script type="text/javascript" src="/mania/_js_chart/_avgGameChart.js?210304"></script>
    <script type="text/javascript" src="/mania/js/index.js?210429"></script>
@endsection

@section('content')
    <style>
        #gameChart .gameChart_title_list div {
            border: solid 1px #3d9fff;
            border-top: none;
            border-right: none;
            width: 136.4px;
        }
        #gameChart .gameChart_title_list .game_on {
            background: initial !important;
            color: black;
            border: solid 1px #3d9fff;
            border-bottom: none;
        }
        #gameChart .gameChart_title_list {
            border: none !important;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <input type="hidden" name="new_except" value="">
    <div class="g_layer service_layer" id="service_layer">
        <div class="inner"> <a href="javascript:;" class="close" id="service_close">닫기</a>
            <div class="title f-15"> 즐겨찾는 서비스 <span class="f-13">최대 8개를 선택할수 잇습니다.</span>
                <div class="r_area"> <a href="javascript:;" class="btn_white2 save" id="service_save">저장</a> <a href="javascript:;" class="btn_white2 init" id="service_init">초기화</a> </div>
            </div>
            <ul class="service_list" id="service_list">
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="1"> <span class="tmp_checkbox"></span> <span class="SpGroup mileage"></span> 내 마일리지 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="2" checked> <span class="tmp_checkbox"></span> <span class="SpGroup counsel"></span> 상담내역보기 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="3" checked> <span class="tmp_checkbox"></span> <span class="SpGroup sell"></span> 판매관련물품 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="4" checked> <span class="tmp_checkbox"></span> <span class="SpGroup buy"></span> 구매관련물품 </label>
                </li>
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="5"> <span class="tmp_checkbox"></span> <span class="SpGroup payment"></span> 마일리지출금 </label>
                </li>
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="6"> <span class="tmp_checkbox"></span> <span class="SpGroup calc"></span> 수수료 </label>
                </li>
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="7"> <span class="tmp_checkbox"></span> <span class="SpGroup charge"></span> 마일리지충전 </label>
                </li>
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="8"> <span class="tmp_checkbox"></span> <span class="SpGroup pointmall"></span> 쇼핑포인트 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="9" checked> <span class="tmp_checkbox"></span> <span class="SpGroup credit_rating"></span> 신용등급/수수료 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="10" checked> <span class="tmp_checkbox"></span> <span class="SpGroup guide"></span> 초보자가이드 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="11" checked> <span class="tmp_checkbox"></span> <span class="SpGroup coupon"></span> 할인쿠폰현황 </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="12" checked> <span class="tmp_checkbox"></span> <span class="SpGroup faq"></span> FAQ </label>
                </li>
                <li class="service_list_btn on">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="13" checked> <span class="tmp_checkbox"></span> <span class="SpGroup message"></span> 메시지함 </label>
                </li>
                <li class="service_list_btn">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="14"> <span class="tmp_checkbox"></span> <span class="SpGroup chat"></span> 실시간채팅상담 </label>
                </li>
            </ul>
        </div>
    </div>
    <div class="top_full">
        <div class="top_area">
            <!--▼▼▼ 거래 중앙 롤링 배너 ▼▼▼ -->
            <div class="carousel_module" data-code="TR0001">
                <div class="banner_in center_banner" id="center_banner">
                    <div class="banner_item" data-idx="0">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>
                    </div>
                    <div class="banner_item" data-idx="1">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                    <div class="banner_item" data-idx="2">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                    <div class="banner_item" data-idx="3">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                </div>
                <div class='banner_indicate indicate'></div>
            </div>
            <script>
                var selector = document.querySelector(".carousel_module")
                new Carousel(selector, {
                    "showNavi": false,
                    "showIndicate": true,
                    "delay": 3000,
                    "random": true
                });
            </script>
            <!--▲▲▲ 거래 중앙 롤링 배너 ▲▲▲ -->
            <div class="service_wrap">
                <div class="service_set">
                    <div class="service_favorite">즐겨찾는 서비스</div>
                    <a href="javascript:;" id="service_btn"><i class="sp_icon setting">설정</i></a>
                    <ul>
                        <a href="{{route('myqna_list')}}" target="_self">
                            <li>
                                <span class="SpGroup counsel"></span><div class="f-16">상담내역보기</div>
                            </li>
                        </a>
                        <a href="{{route('sell_regist')}}" target="_self">
                            <li>
                                <span class="SpGroup sell"></span><div class="f-16">판매관련물품</div>
                            </li>
                        </a>
                        <a href="{{route('buy_regist')}}" target="_self">
                            <li>
                                <span class="SpGroup buy"></span><div class="f-16">구매관련물품</div>
                            </li>
                        </a>
                        <a href="{{route('credit_rating')}}" target="_self">
                            <li>
                                <span class="SpGroup credit_rating"></span><div class="f-16">신용등급/수수료</div>
                            </li>
                        </a>
                        <a href="#" target="_self">
                            <li>
                                <span class="SpGroup guide"></span><div class="f-16">초보자가이드</div>
                            </li>
                        </a>
                        <a href="#" target="_self">
                            <li>
                                <span class="SpGroup coupon"></span><div class="f-16">할인쿠폰현황</div>
                            </li>
                        </a>
                        <a href="#" target="_self">
                            <li>
                                <span class="SpGroup faq"></span><div class="f-16">FAQ</div>
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="bg_opacity"></div>
            </div>
        </div>
    </div>
    <div class="content_center">
        {{--
        <div class="power_wrap">
            <div class="power_title"> <span class="power">파워물품 ZONE</span> <a href="/power/auction_ing.html" class="more2">파워등록권 경매신청 ></a> </div>
            <ul class="list" id="power_list">
                <li class="color1 ">
                    <a href="/sell/view.html?id=2021100812271890"> <em class="label"></em> <span class="game">디아블로2:레저렉션</span> <span class="sise">1개당 1,000원</span> <span class="server">기타</span> </a>
                </li>
                <li class="color2 ">
                    <a href="/sell/view.html?id=2021100812270343"> <em class="label"></em> <span class="game">디아블로2:레저렉션</span> <span class="sise">1개당 1,000원</span> <span class="server">노말</span> </a>
                </li>
                <li class="color3 ">
                    <a href="/sell/view.html?id=2021100812433102"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">루페온</span> </a>
                </li>
                <li class="color4 ">
                    <a href="/sell/view.html?id=2021100812433402"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">카제로스</span> </a>
                </li>
                <li class="color5 ">
                    <a href="/sell/view.html?id=2021100812433688"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">아브렐슈드</span> </a>
                </li>
                <li class="color6 ">
                    <a href="/sell/view.html?id=2021100812434002"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,290원</span> <span class="server">실리안</span> </a>
                </li>
                <li class="color1 ">
                    <a href="/sell/view.html?id=2021100812470636"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">아만</span> </a>
                </li>
                <li class="color2 ">
                    <a href="/sell/view.html?id=2021100812470919"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,290원</span> <span class="server">카마인</span> </a>
                </li>
                <li class="color3 ">
                    <a href="/sell/view.html?id=2021100812471191"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">카단</span> </a>
                </li>
                <li class="color4 ">
                    <a href="/sell/view.html?id=2021100812471505"> <em class="label"></em> <span class="game">로스트아크</span> <span class="sise">1,000당 1,390원</span> <span class="server">니나브</span> </a>
                </li>
                <li class="color5 ">
                    <a href="/sell/view.html?id=2021100812418279"> <em class="label"></em> <span class="game">월드오브워크래프트:클래식</span> <span class="sise">100당 630원</span> <span class="server">로크홀라[호드]-불성</span> </a>
                </li>
                <li class="color6 ">
                    <a href="/sell/view.html?id=2021100812418660"> <em class="label"></em> <span class="game">월드오브워크래프트:클래식</span> <span class="sise">100당 730원</span> <span class="server">로크홀라[얼라]-불성</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100812425626"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 2,990원</span> <span class="server">루나</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100812423294"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,170원</span> <span class="server">스카니아</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812425314"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 2,990원</span> <span class="server">엘리시움</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812421667"> <em class="label"></em> <span class="game">바람의나라</span> <span class="sise">100만당 1,010원</span> <span class="server">연</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100810597610"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,150원</span> <span class="server">오로라</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100807242017"> <em class="label"></em> <span class="game">서든어택</span> <span class="sise">1,000당 2,280원</span> <span class="server">기타</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100810969304"> <em class="label"></em> <span class="game">마비노기</span> <span class="sise">100만당 1,050원</span> <span class="server">류트</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100812425001"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,490원</span> <span class="server">RED</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812424297"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,390원</span> <span class="server">유니온</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812424615"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,390원</span> <span class="server">이노시스</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100812423914"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 2,720원</span> <span class="server">크로아</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100812423608"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 3,240원</span> <span class="server">제니스</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100812422960"> <em class="label"></em> <span class="game">메이플스토리</span> <span class="sise">1억당 2,890원</span> <span class="server">베라</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100811336012"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">100만당 1,090원</span> <span class="server">클래식-유스티엘(마족)</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812436634"> <em class="label"></em> <span class="game">마비노기영웅전</span> <span class="sise">100만당 1,120원</span> <span class="server">프리미어</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812427464"> <em class="label"></em> <span class="game">패스오브엑자일</span> <span class="sise">10당 1,500원</span> <span class="server">스탠다드</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100809243731"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">100만당 1,110원</span> <span class="server">클래식-유스티엘(천족)</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100810265532"> <em class="label"></em> <span class="game">디아블로2:레저렉션</span> <span class="sise">1개당 5,000원</span> <span class="server">하드코어</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100812448544"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,380원</span> <span class="server">클래식-루미엘(마족)</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100812427820"> <em class="label"></em> <span class="game">패스오브엑자일</span> <span class="sise">10당 2,000원</span> <span class="server">4개월리그</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812419694"> <em class="label"></em> <span class="game">월드오브워크래프트:클래식</span> <span class="sise">100당 760원</span> <span class="server">얼음피[호드]-불성</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812420708"> <em class="label"></em> <span class="game">월드오브워크래프트:클래식</span> <span class="sise">100당 710원</span> <span class="server">얼음피[얼라]-불성</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100812421049"> <em class="label"></em> <span class="game">월드오브워크래프트:클래식</span> <span class="sise">100당 630원</span> <span class="server">라그나로스[얼라]-불성</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100812429495"> <em class="label"></em> <span class="game">월드오브워크래프트</span> <span class="sise">1만당 650원</span> <span class="server">아즈샤라[호드]전쟁</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100808529255"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,730원</span> <span class="server">클래식-이스라펠(천족)</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100811678507"> <em class="label"></em> <span class="game">마비노기</span> <span class="sise">100만당 1,050원</span> <span class="server">만돌린</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812453911"> <em class="label"></em> <span class="game">마비노기</span> <span class="sise">100만당 1,060원</span> <span class="server">하프</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812169076"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">카인</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100812208272"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">디레지에</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100812246200"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">시로코</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100812284848"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">프레이</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100812320155"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">카시야스</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100812357583"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">힐더</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100812393900"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">안톤</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100812431600"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">바칼</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100812466454"> <em class="label"></em> <span class="game">던전앤파이터</span> <span class="sise">100만당 1,020원</span> <span class="server">통합서버</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100811321359"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,230원</span> <span class="server">클래식-루미엘(천족)</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100809881194"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,490원</span> <span class="server">클래식-이스라펠(마족)</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100809888239"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,720원</span> <span class="server">클래식-네자칸(천족)</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100809892371"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,740원</span> <span class="server">클래식-네자칸(마족)</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100809898227"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,710원</span> <span class="server">클래식-지켈(천족)</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100809907488"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,560원</span> <span class="server">클래식-지켈(마족)</span> </a>
                </li>
                <li class="color1  g_hidden">
                    <a href="/sell/view.html?id=2021100809910830"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,520원</span> <span class="server">클래식-바이젤(천족)</span> </a>
                </li>
                <li class="color2  g_hidden">
                    <a href="/sell/view.html?id=2021100808512438"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,580원</span> <span class="server">클래식-바이젤(마족)</span> </a>
                </li>
                <li class="color3  g_hidden">
                    <a href="/sell/view.html?id=2021100800128065"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,500원</span> <span class="server">클래식-트리니엘(마족)</span> </a>
                </li>
                <li class="color4  g_hidden">
                    <a href="/sell/view.html?id=2021100811095576"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,520원</span> <span class="server">클래식-트리니엘(천족)</span> </a>
                </li>
                <li class="color5  g_hidden">
                    <a href="/sell/view.html?id=2021100802537244"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,310원</span> <span class="server">클래식-카이시넬(천족)</span> </a>
                </li>
                <li class="color6  g_hidden">
                    <a href="/sell/view.html?id=2021100811313908"> <em class="label"></em> <span class="game">아이온</span> <span class="sise">1,000만당 1,500원</span> <span class="server">클래식-카이시넬(마족)</span> </a>
                </li>
            </ul>
            <div id="power_indicate" class="indicate"> <span class="on"></span><span></span><span></span><span></span><span></span> </div>
        </div>
        <div class="g_finish"></div>
        <!--▼▼▼ 거래 메인 랜덤 up 980x80 ▼▼▼ -->
        <div class="banner_module">
            <div class="banner_content_wrapper">
                <div class="banner_content">
                    <a href="http://www.itemmania.com/portal/free_coupon/index.html" target=""> <img id="TF0001" class="banner_content_images" src="http://img1.itemmania.com/new_images/banner_manager/20210312/20210312164330_r283Z.jpg" alt="게임쿠폰" title="게임쿠폰"> </a>
                </div>
            </div>
        </div>
        <p class="spacer_bottom_10"></p> -->
        <!--▲▲▲ 거래 메인 랜덤 up 980x80 ▲▲▲ -->
        --}}
        <div class="sec_left realtime_status">
            <div class="initial_screen">
                <div class="tab searchbar_tab">
                    <div class="active">
                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 팝니다 목록</a>
                    </div>
                    <div>
                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 삽니다 목록</a>
                    </div>
                </div>
                <div class="tab_content">
                    <div class="tab_child show" data-content="tab_lastsearch">
                        <table class="f-14 no-border">
                            <tr>
                                <td class="realtime_list align-center no-border" >종류</td>
                                <td class="realtime_game align-center no-border" >게임명/서버명</td>
                                <td class="realtime_desc align-center no-border" >멘트</td>
                                <td class="realtime_money align-center no-border" >거래가격</td>
                            </tr>
                        </table>
                        <hr>
                        <div class="realtime_sell_wrapper">
                            <table class="realtime_sell_table f-14 no-border">
                                <tbody>
                                @for ($i = 0; $i < 20; $i++)
                                    <tr>
                                        <td class="realtime_list align-center no-border" >게임머니</td>
                                        <td class="realtime_game no-border" >리니지 > 린델</td>
                                        <td class="realtime_desc no-border" >(수량보유즁) 다이아 최저가 판매중</td>
                                        <td class="realtime_money align-right no-border" >1,000원</td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab_child" data-content="tab_mygame">
                        <ul class="g_my_search"></ul>
                    </div>
                </div>
            </div>
            <div class="gs_list g_hidden" data-gslist="true"></div>
        </div>
        <div class="sec_right">
            <div class="box3 gamenews">
                <div class="title f-18 f-normal"> 공지사항 </div>
                <ul class="g_list news_list f-14">
                    <li>
                        <a href="/portal/gamemeca/news/view.html?seq=32957">
                            게임 나오면 흥할 넷플릭스 오리지널 콘텐츠, 뭐가 있을까?<span class="comp">2021-10-07 18:09:38</span>
                        </a>
                    </li>
                    <li>
                        <a href="/portal/gamemeca/news/view.html?seq=32961">
                            엔씨소프트 사내 성희롱 사건 발생, 사측 조사 나서<span class="comp">2021-10-07 15:47:17</span>
                        </a>
                    </li>
                    <li>
                        <a href="/portal/gamemeca/news/view.html?seq=32958">
                            독재타도 위해 싸우자, 파 크라이 6 정식 발매<span class="comp">2021-10-07 15:45:27</span>
                        </a>
                    </li>
                    <li>
                        <a href="/portal/gamemeca/news/view.html?seq=32959">
                            [순정남] 그걸로 정체가 감춰져? 의미 없는 가면 TOP 5<span class="comp">2021-10-07 14:56:54</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>

        <div class="sec_left no-border">
            <div class="title">게임별 시세정보
                <a href="javascript:_window.open('game_money', '{{route("gameinfo_money")}}', 800, 900);">
                    <i class="sp_icon plus_icon">더보기</i>
                </a>
            </div>
            <div id="gameChart" class="border-normal"></div>
        </div>
        <div class="sec_right no-border">
            <div class="title"> 게임순위 <a href="{{route('gameinfo_rank_game')}}"><i class="sp_icon plus_icon">더보기</i></a> </div>
            <div class="border-normal d-flex">
                <ul class="rank_list">
                    <li class="top"> <span class="num">1</span> <span class="game_name">디아블로2:레저렉션</span> <span class="sp_icon none"></span> </li>
                    <li class="top"> <span class="num">2</span> <span class="game_name">오딘:발할라라이징</span> <span class="sp_icon none"></span> </li>
                    <li class="top"> <span class="num">3</span> <span class="game_name">로스트아크</span> <span class="sp_icon none"></span> </li>
                    <li> <span class="num">4</span> <span class="game_name">메이플스토리</span> <span class="sp_icon none"></span> </li>
                    <li> <span class="num">5</span> <span class="game_name">던전앤파이터</span> <span class="sp_icon none"></span> </li>
                </ul>
                <ul class="rank_list">
                    <li> <span class="num">6</span> <span class="game_name">블레이드앤소울2</span> <span class="sp_icon none"></span> </li>
                    <li> <span class="num">7</span> <span class="game_name">아이온</span> <span class="sp_icon up"></span> </li>
                    <li> <span class="num">8</span> <span class="game_name">바람의나라:연</span> <span class="sp_icon up"></span> </li>
                    <li> <span class="num">9</span> <span class="game_name">리니지M</span> <span class="sp_icon down"></span> </li>
                    <li> <span class="num">10</span> <span class="game_name">월드오브워크래프트:클래식</span> <span class="sp_icon up"></span> </li>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>

        <div class="d-flex w-100">
            <div class="w-50 sec_left no-border back-normal " style="margin-right: 10px;">
                <div class="title no-border">
                    전화 상담안내
                </div>
                <div class="d-flex w-100 inquery_part">
                    <img src="/assets/img/icons/inquery_time.png" height="91" width="97" />
                    <div class="bottom_info">
                        <span class="call_num">1532-9945</span>
                        <span class="call_txt">365일 24시간 연중무휴</span>
                    </div>
                </div>
            </div>
            <div class="w-50 sec_right no-border">
                <div class="title">
                    마일리지 충전
                    <div class="move_btn" id="chargeBtn">
                        <a href="javascript:;" data-type="p"><i class="sp_icon btn_prev">이전</i></a>
                        <a href="javascript:;" data-type="n"><i class="sp_icon btn_next">다음</i></a>
                    </div>
                </div>
                <div class="charge_wrap border-normal fixed-height" id="charge_list">
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/tcash.html',700,900);">
                                <span class="c_name">티캐시</span>
                                <span class="sp_main tcash"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/ktclip.html',700,900);">
                                <span class="c_name">카드포인트 </span>
                                <span class="sp_main ktclip"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/onlyhpmn.html',700,900);">
                                <span class="c_name">해피머니상품권</span>
                                <span class="sp_main happy"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/onlyculture.html',700,900);">
                                <span class="c_name">문화상품권</span>
                                <span class="sp_main culture"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/phone_ars.html',700,900);">
                                <span class="c_name">휴대폰 ARS충전</span>
                                <span class="sp_main phone_ars"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/bookgift.html',700,900);">
                                <span class="c_name">도서문화상품권</span><span class="sp_main book"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/realaccount.html',700,900);"><span
                                    class="c_name">자동이체</span><span class="sp_main realaccount"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/onlydgcl.html',700,900);"><span
                                    class="c_name">스마트문상(게임문상)</span><span class="sp_main smart"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/cashgate.html',700,900);"><span
                                    class="c_name">캐시플러스</span><span class="sp_main cashgate"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/touchpay.html',700,900);"><span
                                    class="c_name">터치페이</span><span class="sp_main touchpay"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/teencash.html',700,900);"><span
                                    class="c_name">틴캐시</span><span class="sp_main teen"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/eggmoney.html',700,900);"><span
                                    class="c_name">에그머니</span><span class="sp_main eggmoney"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/tmoney.html',700,900);"><span
                                    class="c_name">모바일 티머니</span><span class="sp_main tmoney"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/pointpark.html',700,900);"><span
                                    class="c_name">포인트충전</span><span class="sp_main point"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/gpgw.html',700,900);"><span
                                    class="c_name">GP쿠폰</span><span class="sp_main gpcoupon"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/maniacoupon.html',700,900);"><span
                                    class="c_name">매니아 선불</span><span class="sp_main maniacoupon"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/funnycard.html',700,900);"><span
                                    class="c_name">퍼니카드</span><span class="sp_main funny"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/coupon.html',700,900);"><span
                                    class="c_name">이벤트쿠폰</span><span class="sp_main coupon"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/ars.html',700,900);"><span
                                    class="c_name">ARS</span><span class="sp_main ars"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/cashbee.html',700,900);"><span
                                    class="c_name">모바일 캐시비</span><span class="sp_main cashbee"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/creditcard.html',700,900);"><span
                                    class="c_name">신용카드 충전</span><span class="sp_main creditcard"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/okcashbag.html',700,900);"><span
                                    class="c_name">OK캐시백</span><span class="sp_main okcashbag"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/mileage.html',700,900);"><span
                                    class="c_name">마일리지 상품권</span><span class="sp_main mileage"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/index.html',700,900);"><span
                                    class="c_name">전용계좌</span><span class="sp_main account"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/mmileage.html',700,900);"><span
                                    class="c_name">M마일리지 이용권</span><span class="sp_main mmileage"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/im_gift.html',700,900);"><span
                                    class="c_name">IM기프트</span><span class="sp_main imgift"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/mobilepop.html',700,900);"><span
                                    class="c_name">모바일팝</span><span class="sp_main mobilepop"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/pipe.html',700,900);"><span
                                    class="c_name">암호화폐 충전</span><span class="sp_main pipe"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/paycoin.html',700,900);"><span
                                    class="c_name">페이코인 충전</span><span class="sp_main paycoin"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', 'http://trade.itemmania.com/myroom/mileage/charge/kbank.html',700,900);"><span
                                    class="c_name">케이뱅크 페이</span><span class="sp_main kbank"></span></a>
                        </li>
                    </ul>
                    <i class="border_hz"></i>
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 테스트 홈 //-->
    <!-- ▲ 컨텐츠 영역 //-->
    <script>
        $(document).ready(function() {
            $(".tab-title").click(function() {
                var elem = $(this);
                if (!elem.parent().hasClass("active")) {
                    $(".tab-title").parent().removeClass("active");
                    elem.parent().addClass("active")
                }
            });
        });
    </script>
@endsection
