<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css?v=210317">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css?v=210531">
        <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/charge/css/_common.css?v=210602" />
        <script type="text/javascript" src="/angel/_js/jquery.js?190220"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js?v=211005"></script>
        <script type="text/javascript" src="/angel/_js/_gs_control.js?v=200803"></script>
        <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css?v=210422">
        <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
        <script>
            var a_token = '{{Auth::user()->api_token}}';
        </script>
        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
    </head>
    <body>
        <style>
            #charge_main .mile_detail,
            #charge_main {
                width: 100%;
            }
            .m_price {
                color: #ff1c0b;
            }
            #charge_main {
                padding: 0;
                border: 1px solid #D6D6D6;
            }
            .part-border {
                border-bottom: solid 1px #D6D6D6;
            }
        </style>

        <div id="global_root" class="mainEntity d-none ">
            <div id="thirdys" class="fluid-div"></div>
        </div>
        <div id="angel">
            <div id="model_titlebar">
                <div class="f-20">마일리지{{$snzProc}}</div>
            </div>
            <div id="g_POPUP">
                <div class="my_mileage" style="margin-bottom: 4px;">
                    <span class="m_price c-black">내 마일리지</span>
                    <span class="m_price" style="">{{number_format($userDetail->mileage)}}</span>
                    <span class="m_price c-black p-0">원</span>
                </div>
                <div class="empty-high"></div>
                <script type="text/javascript">
                    if(self.name == "mileage_charge_event") {
                        $('charge_menu').style.display = "none";
                        $('charge_menu_event').style.display = "block";
                    }
                </script>
                <div id="charge_main">
                    <div class="f-16 f-bold part-border" style="padding: 10px 25px; ">
                        <span>계좌번호:</span>
                        <span style="padding-left: 30px;">기업은행</span>
                        <span class="c-light-red f-18">493-062345-03-234</span>
                        <span>주식회사엠커넥트</span>
                    </div>
                    <form id="ini" name="ini" action="" method="post">
                        <input type="hidden" name="commission" id="commission" value="0" />
                        <input type="hidden" name="charge_rate" id="charge_rate" value="2" />
                        <input type="hidden" name="ITEM_OID" value="" />
                        <input type="hidden" name="price" id="price" />
                        <div id="" class="highlight_contextual_nodemon" style="padding-left: 100px; padding-top: 16px;">{{$snzProc}}금액 선택</div>
                        <div class="f-bold" style="background: #e4eef0; padding: 24px;">
                            <div class="d-flex m-auto" style="width: 60%;">
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice10000" value="10000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice10000">10,000 원</label>
                                </div>
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice20000" value="20000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice20000">20,000 원</label>
                                </div>
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice30000" value="30000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice30000">30,000 원</label>
                                </div>
                            </div>
                            <div class="d-flex m-auto" style="width: 60%; margin-top: 10px; margin-bottom: 10px;">
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice100000" value="100000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice100000">100,000 원</label>
                                </div>
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice300000" value="300000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice300000">300,000 원</label>
                                </div>
                                <div class="align-center" style="width: 33.33%">
                                    <input type="radio" name="selectPrice" id="selectPrice500000" value="500000" class="g_radio" onclick="selectedPrice(this.value);" />
                                    <label for="selectPrice500000">500,000 원</label>
                                </div>
                            </div>
                            <hr style="width: 60%;">
                            <div class="m-auto align-center" style="width: 60%;">
                                <input type="radio" name="selectPrice" id="priceD" value="0" class="g_radio" onclick="selectedPrice(this.value)" />
                                <input type="text" name="price_custom" id="price_custom" maxlength="6" class="angel__text" onclick="selectedPrice(0)" onblur="fnCustomOut()" onkeyup="onlynum(this.value);selectedPrice(this.value)" maxlength="5" />원
                            </div>
                        </div>

                        <div class="empty-high"></div>
                        <div class="real_price align-right part-border" style="padding-right: 18px; padding-bottom: 14px; padding-top: 10px;">
                            <span class="m_price f-14 c-black">실제 마일리지 {{$snzProc}}금액</span>
                            <span id="spnPrice" class="m_price f-16"></span>
                            <span class="m_price f-14 c-black p-0">원</span>
                        </div>
                        <div class="empty-high"></div>
                        <div class="m_button" style="padding-bottom: 24px;">
                            @if ($snzProc == "충전")
                                <a href="javascript:void(0)" class="mileage_charge btn-color-img btn-blue-img" style="" >충전하기</a>
                            @else
                                <a href="javascript:void(0)" class="mileage_charge btn-color-img btn-gray-img" style="" >출금하기</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/angel/_js/_window.js?v=190220"></script>
        <script type="text/javascript" src="/angel/_js/_form_check.js?v=190220"></script>
        <script type="text/javascript" src="/angel/myroom/mileage/charge/js/common.js?v=191226"></script>
        <script type='text/javascript'>
            function _init() {
                init_orderid();
            }

            function selectedPrice(v) {
                var fillRealMileage = $("#spnPrice");
                if($("#priceD:checked").val() != 0) {
                    $("#price_custom").val("직접입력");
                }
                if(v == "0" || v.length < 1) {
                    $("#priceD").prop('checked', true);
                    if($("#price_custom").val() == "직접입력") {
                        $("#price_custom").val("");
                    }
                    if($("#price_custom").val() == "") {
                        fillRealMileage.html("0");
                    } else {
                        var price = parseInt($("#price_custom").val()) + rgRate;
                        fillRealMileage.html(Number(price).currency());
                    }
                } else {
                    if(v < 0 || v < 1000) {
                        return;
                    }
                    // if(v >= 25000) {
                    //     fillRealMileage.html(Number(Number(v) - parseInt((Number(Number(v) / 100) * $("#charge_rate").val()))).currency());
                    // } else {
                    //     fillRealMileage.html(Number(Number(v) - Number($('#commission').val())).currency());
                    // }
                    fillRealMileage.html(Number(Number(v) - Number($('#commission').val())).currency());
                }
                $('input[name="price"]').val(v);
            }
        </script>
        <script>
            loadGlobalItems()

            $(".mileage_charge").click(function() {
                if (confirm("{{$snzProc}}하시겟습니까?")) {
                    var hitURL = "";
                    @if ($snzProc == "충전")
                        hitURL = "/api/mileage/charge/proc";
                    @else
                        hitURL = "/api/mileage/exchange/proc";
                    @endif

                    ajaxRequest({
                        url:  hitURL,
                        type: "POST",
                        data: {
                            price: $("#price").val(),
                            api_token: a_token
                        },
                        success: function(response) {
                            if (response == "success")
                                alert("조작이 성공햇습니다.");
                            else
                                alert("조작이 실패햇습니다.");

                        }
                    });
                }
            });
        </script>
    </body>

</html>
