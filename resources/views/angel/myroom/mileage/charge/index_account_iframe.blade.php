<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
        <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/charge/css/_common.css" />
        <script type="text/javascript" src="/angel/_js/jquery.js"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js"></script>
        <script type="text/javascript" src="/angel/_js/_gs_control.js"></script>
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
        <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
        <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
        <script>
            var server_domain = '210.112.174.178';
            var a_token = '{{Auth::user()->api_token}}';
            var socket_client = io.connect('http://'+server_domain+':7443/adminWith', {
                path: '/socket.io',
                reconnectionAttempts:1,
                reconnectionDelay:500,
                reconnectionDelayMax:500,
                transports: ['websocket']
            });
        </script>
        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
    </head>
    <body>
        <div id="global_root" class="mainEntity d-none ">
            <div id="thirdys" class="fluid-div"></div>
        </div>
        <div id="angel">
            <div @class('mileage__h')>
                <div class="my_mileage">
                    <span class="m_price c-black">나의 마일리지</span>
                    <span class="m_price clc3" style="">{{number_format($userDetail->mileage)}}</span>
                    <span class="m_price c-black p-0">원</span>
                </div>
                <div class="part-border">
                    <span>계좌번호 : </span>
                    <span>{{$bankDetail['accAlias'] ?? ''}}</span>
                    <span>{{$bankDetail['accNumber'] ?? ''}} </span>
                    <span>{{$bankDetail['accName'] ?? ''}}&nbsp;&nbsp;</span>
                </div>
            </div>
            <script type="text/javascript">
                if(self.name == "mileage_charge_event") {
                    $('charge_menu').style.display = "none";
                    $('charge_menu_event').style.display = "block";
                }
            </script>
            <div id="charge_main" @class('w-100')>
                <form id="ini" name="ini" action="" method="post">
                    <input type="hidden" name="commission" id="commission" value="0" />
                    <input type="hidden" name="charge_rate" id="charge_rate" value="2" />
                    <input type="hidden" name="ITEM_OID" value="" />
                    <input type="hidden" name="price" id="price" />
                    <div id="" class="highlight_contextual_nodemon">{{$snzProc}}금액 선택</div>
                    <div @class('mileage_prices_part')>
                        <div>
                            <div class="align-center" >
                                <input type="radio" name="selectPrice" id="selectPrice10000" value="10000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice10000">10,000 원</label>
                            </div>
                            <div class="align-center" >
                                <input type="radio" name="selectPrice" id="selectPrice20000" value="20000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice20000">20,000 원</label>
                            </div>
                            <div class="align-center">
                                <input type="radio" name="selectPrice" id="selectPrice30000" value="30000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice30000">30,000 원</label>
                            </div>
                        </div>
                        <div >
                            <div class="align-center">
                                <input type="radio" name="selectPrice" id="selectPrice100000" value="100000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice100000">100,000 원</label>
                            </div>
                            <div class="align-center">
                                <input type="radio" name="selectPrice" id="selectPrice300000" value="300000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice300000">300,000 원</label>
                            </div>
                            <div class="align-center">
                                <input type="radio" name="selectPrice" id="selectPrice500000" value="500000" class="g_radio" onclick="selectedPrice(this.value);" />
                                <label for="selectPrice500000">500,000 원</label>
                            </div>
                        </div>
                        <div class="m-auto align-center">
                            <input type="radio" name="selectPrice" id="priceD" value="0" class="g_radio" onclick="selectedPrice(this.value)" />
                            <input type="text" name="price_custom" id="price_custom" maxlength="6" onclick="selectedPrice(0)" onblur="fnCustomOut()" onkeyup="onlynum(this.value);selectedPrice(this.value)" maxlength="5" />
                            <span @class('lh_30')>원</span>
                            <span @class('mr-10')></span>
                            @if ($snzProc == "충전")
                                <a href="javascript:void(0)" class="mileage_charge btn-default-medium_w btn-yes" >충전하기</a>
                            @else
                                <a href="javascript:void(0)" class="mileage_charge btn-default-medium_w btn-yes" >출금하기</a>
                            @endif
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <script type="text/javascript" src="/angel/_js/_window.js?v=190220"></script>
        <script type="text/javascript" src="/angel/_js/_form_check.js?v=190220"></script>
        <script type="text/javascript" src="/angel/myroom/mileage/charge/js/common.js?v=191226"></script>
        <script type='text/javascript'>

            var width = $(window).width();
            function heightResize()
            {
                var resizeHeight = $('body').height();
                try{
                    $('#mileage_frame', window.parent.document).height(resizeHeight + 30);
                    stated++;
                }
                catch(e){}
            }
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
                        $(".mileage_prices_part>div label").removeClass('selected');
                    }

                } else {
                    if(v < 0 || v < 1000) {
                        return;
                    }
                }
                $('input[name="price"]').val(v);
            }
        </script>
        <script>
            $(document).ready(function (){
                heightResize();
            })
            loadGlobalItems()
            $(".mileage_prices_part>div label").click(function(){
                $(".mileage_prices_part>div label").removeClass('selected');
                $(this).addClass('selected');
            })
            $(".mileage_charge").click(function() {
                var type = 1;
                if (confirm("{{$snzProc}}하시겟습니까?")) {
                    var hitURL = "";
                    @if ($snzProc == "충전")
                        hitURL = "/api/mileage/charge/proc";
                    @else
                        hitURL = "/api/mileage/exchange/proc";
                        type = 2;
                    @endif

                    ajaxRequest({
                        url:  hitURL,
                        type: "POST",
                        data: {
                            price: $("#price").val(),
                            api_token: a_token
                        },
                        dataType:'json',
                        success: function(response) {
                            if (response.status == "success") {
                                alert("조작이 성공햇습니다.");
                                socket_client.emit("admin_notice",{
                                    type: type,
                                    userName: "{{$me['name']}}"
                                })
                                window.parent.location = "{{route('my_mileage_detail_list')}}";
                            }
                            else
                                alert("조작이 실패햇습니다.");

                        }
                    });
                }
            });
        </script>
    </body>

</html>
