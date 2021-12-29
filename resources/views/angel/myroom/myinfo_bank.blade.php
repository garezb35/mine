@php
$accAlias = $bank ? $bank['accAlias'] : '';
$accNumber = $bank ? $bank['accNumber'] : '';
$accName = $bank ? $bank['accName'] : '';
$id = $bank ? $bank['id'] : '';

@endphp

<!DOCTYPE html>
<html lang="ko">
<head>
    <title>아이템천사</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="아이템천사,아이템거래,아이템,천사,아이템천사주소,아이템천사바로가기">
    <meta name="description" content="">
    <meta name="referrer" content="no-referrer-when-downgrade" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/css/user_certify.css" />
</head>
<body>
<div id="global_root" class="mainEntity d-none">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div class="myotp_id_layer_wrapper">
        <div class="inner"></div>
    </div>
    <div class="model_titlebar">출금계좌</div>
    <div id="g_POPUP2" style="text-align: center">
        <form name="ini_hpp" id="ini_hpp" method="post" action="{{route('updatebank')}}">
           @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <table class="g_gray_tb g_sky_table p-00" id="report_tb" style="margin: auto">
                <colgroup>
                    <col width="200">
                </colgroup>
                <tbody>
                <tr class="report_tr">
                    <th>은행명</th>
                    <td>
                        <select name="accAlias">
                            <option value="">계좌없음</option>
                            @foreach($banks as $b)
                            <option value="{{$b['name']}}" @if($b['name'] == $accAlias) selected @endif>{{$b['name']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="report_tr">
                    <th>계좌번호</th>
                    <td>
                        <input type="text" name="accNumber" value="{{$accNumber}}"   class="pass_ele" >
                    </td>
                </tr>
                <tr class="report_tr">
                    <th>예금주</th>
                    <td>
                        <input type="text" name="accName" value="{{$accName}}"  class="pass_ele">
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="submit" value="확인" class="btn btn-secondary" style="margin-top: 10px">
        </form>
    </div>
</div>
<script type="text/javascript" src="/angel/_js/jquery.js"></script>
<script type="text/javascript" src="/angel/_js/webpack.js"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
<script>

    loadGlobalItems()
</script>
<style>
    .pass_ele{
        width: 170px;
        height: 25px;
    }


</style>
<script>
   @if ($message = Session::get('message'))
        alert("{{$message}}")
    @endif
</script>

</body>
</html>

