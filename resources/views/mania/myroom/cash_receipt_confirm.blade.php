<html lang="ko">
    <head>
        <title>아이템매니아</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
        <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_popup.css">
        <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
        <link type="text/css" rel="stylesheet" href="/mania/myroom/cash_receipt/css/cash_receipt_confirm.css">
        <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
        <script type="text/javascript" src="/mania/_js/_comm.js"></script>
        <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
    </head>
    <body>
    <div id="g_SLEEP" class="g_sleep g_hidden ">
        <div id="g_OVERLAY" class="g_overlay"></div>
    </div>
    <div id="g_BODY">
        <div id="popup_title_bar"><img src="http://img3.itemmania.com/images/myroom/title/title_cash_number.gif" alt="현금영수증 승인번호 확인" width="195" height="19"></div>
        <div id="g_POPUP">
            <table class="g_blue_table">
                <colgroup>
                    <col width="200">
                    <col width="370">
                </colgroup>
                <tbody>
                <tr>
                    <th>가맹점 사업자 번호</th>
                    <td>{{$business_number}}</td>
                </tr>
                <tr>
                    <th>승인번호</th>
                    <td>{{$aceept_number}}</td>
                </tr>
                <tr>
                    <th>거래금액</th>
                    <td>{{number_format($payitem['price'])}} 원</td>
                </tr>
                <tr>
                    <th>거래일자</th>
                    <td>
                        {{date("Y-m-d",strtotime($payitem['updated_at']))}}
                    </td>
                </tr>
                <tr>
                    <th>처리상태</th>
                    <td>
                        @if($status == 0)
                        처리중입니다.
                        @endif
                        @if($status == 2)
                        정상 처리되었습니다
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="g_btn">
                <a href="javascript:self.close();" class="btn-default btn-suc">확인</a>
            </div>

        </div>
    </div>
    </body>
</html>
