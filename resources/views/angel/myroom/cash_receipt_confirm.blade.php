<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
        <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css">
        <link type="text/css" rel="stylesheet" href="/angel/myroom/cash_receipt/css/cash_receipt_confirm.css">
        <script type="text/javascript" src="/angel/_js/jquery.js"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js"></script>
        <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    </head>
    <body>
    <div id="global_root" class="mainEntity d-none ">
        <div id="thirdys" class="fluid-div"></div>
    </div>
    <div id="angel">
        <div id="model_titlebar">현금영수증 승인번호 확인</div>
        <div id="g_POPUP">
            <table class="table-primary">
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
            <div class="btn-groups_angel">
                <a href="javascript:self.close();" class="btn-default btn-suc">확인</a>
            </div>

        </div>
    </div>
    </body>
</html>
