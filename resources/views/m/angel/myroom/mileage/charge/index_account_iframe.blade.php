@extends('layouts-angel-mobile.app')

@section('head_attach')
    <style>
        .container {
            padding: 16px;
        }
        .mileage-part {
            background: #fffffa;
            border: solid 1px lightgrey;
            margin-bottom: 150px;
        }
        .payment-info {
            border-bottom: solid 1px lightgrey;
            padding: 12px 10px;
            margin-bottom: 25px;
        }
        .pay-mny-option {
            padding: 0 16px;
        }
        .pay-mny-option li {
            display: inline-block;
            width: 32%;
            margin-bottom: 10px;
        }
        .pay-mny-option li label {
            padding-left: 5px;
        }
        #payment-proc {
            width: 200px;
            background: #35bf4d;
            color: white;
            padding: 10px 20px;
            font-size: 15px;
            border-radius: 2px;
            border: none;
        }
        .proc-ex {
            background: #3579bf !important;
        }
        #selectPriceTxt {
            padding: 0 4px;
        }
    </style>
@endsection

@section('foot_attach')
    <script>
        $(document).ready(function() {
            $("#selectPriceTxt").click(function() {
                $("#selectPrice").click();
            });

            $("#payment-proc").click(function() {
                var nPrice = $("input[name='selectPrice']:checked").val();
                if (typeof(nPrice) == "undefined") {
                    alert("금액 선택해 주세요!");
                    return;
                }

                if (nPrice == 1) {
                    nPrice = $("#selectPriceTxt").val().replaceAll(",", "");
                    if (!nPrice.match(/^\d+$/)) {
                        alert("입력형식 오유!");
                        return;
                    }
                }
                if (confirm("{{$snzProc}}하시겟습니까?")) {
                    var hitURL = "";
                    @if ($snzProc == "충전") hitURL = "/api/mileage/charge/proc";
                    @else hitURL = "/api/mileage/exchange/proc";
                    @endif

                    ajaxRequest({
                        url:  hitURL,
                        type: "POST",
                        dataType: "json",
                        data: {
                            price: nPrice,
                            api_token: a_token
                        },
                        success: function(response) {
                            $(".pay-mny-option input").prop("checked", false);
                            if (response.status == "success")
                                alert("조작이 성공햇습니다.");
                            else
                                alert("조작이 실패햇습니다.");
                        }
                    });
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $userDetail])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">마일리지 {{$snzProc}}</h1>
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
            <div class="align-right f-bold fs-16" style="margin-bottom: 14px;">내 마일리지 <span style="color: #ff2323;">{{number_format($userDetail['mileage'])}}</span> 원</div>
            <div class="mileage-part">
                <div class="payment-info">계좌번호: {{$bankDetail['accAlias'] ?? ''}} <b>{{$bankDetail['accNumber'] ?? ''}}</b> {{$bankDetail['accName'] ?? ''}}</div>
                <div class="align-center fs-16" style="padding: 0 12px; margin-bottom: 20px;">{{$snzProc}}금액 선택</div>
                <form action="#" method="post" >
                    <ul class="pay-mny-option">
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice10000" value="10000" ><label for="selectPrice10000">10,000원</label>
                        </li>
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice20000" value="20000" ><label for="selectPrice20000">20,000원</label>
                        </li>
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice30000" value="30000" ><label for="selectPrice30000">30,000원</label>
                        </li>
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice100000" value="100000" ><label for="selectPrice100000">100,000원</label>
                        </li>
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice300000" value="300000" ><label for="selectPrice300000">300,000원</label>
                        </li>
                        <li>
                            <input type="radio" name="selectPrice" id="selectPrice500000" value="500000" ><label for="selectPrice500000">500,000원</label>
                        </li>
                        <li style="width: initial;">
                            <input type="radio" name="selectPrice" id="selectPrice" value="1" >
                            <input type="text" id="selectPriceTxt" name="selectPriceTxt" placeholder="직접입력" />원
                        </li>
                    </ul>
                    <div class="align-center" style="margin-top: 10px; margin-bottom: 30px;">
                        <input type="button" value="{{$snzProc}}하기" id="payment-proc" class="@if ($snzProc != "충전") proc-ex @endif"/>
                    </div>
                </form>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
