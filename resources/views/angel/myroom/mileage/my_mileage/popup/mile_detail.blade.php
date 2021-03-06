<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css?v=210317">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css?v=210531">
        <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css" />
        <script type="text/javascript" src="/angel/_js/jquery.js?190220"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js?v=211005"></script>
        <script type="text/javascript" src="/angel/_js/_gs_control.js?v=200803"></script>
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css?v=210422">
        <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js?v=210209"></script>

        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css?v=210422">
        <style>
            .g_red1_11b{margin-top:10px;padding:10px 0 10px 20px;border:1px solid #EBEBEB;background-color:#FBFBFB}
        </style>
    </head>
    <body>
        <div id="global_root" class="mainEntity d-none ">
            <div id="thirdys" class="fluid-div"></div>
        </div>
        <div id="angel">
            <div id="model_titlebar">
                <div class="f-20">유효기간 설정 마일리지 자세히보기</div>
            </div>
            <div id="g_POPUP">
                <table class="g_sky_table">
                    <colgroup>
                        <col width="38" />
                        <col width="55" />
                        <col width="119" />
                        <col width="169" />
                        <col width="125" />
                        <col width="64" />
                        <col width="52" />
                        <col width="110" />
                    </colgroup>
                    <tr>
                        <th class="first">No</th>
                        <th>구분</th>
                        <th>적립일시</th>
                        <th>내용</th>
                        <th>유효기간</th>
                        <th>적립</th>
                        <th>잔여</th>
                        <th>사용가능게임</th>
                    </tr>
                </table>
                <div class="pagination__bootstrap">
                    <ul class="g_paging"> </ul>
                </div>

                <div class="g_red1_11b"> 유효기간이 만료된 경우 해당 마일리지는 즉시 자동 삭감되오니 주의 바랍니다.
                    <br /> 게임전용 마일리지는 설정된 사용 가능게임의 아이템 또는 게임머니 구매시에만 이용이 가능합니다. </div>
                <div class="btn-groups_angel">
                    <a href="javascript:void(0)" class="btn-color-img btn-gray-img" onclick="window.close();">닫기</a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            window.resizeTo(800, 500);
        </script>
        <script>
            loadGlobalItems()
        </script>
    </body>
</html>
