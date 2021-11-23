@php
$params = array();
$params['recommended']= array();
foreach($portal as $v){
    if(empty($params[$v['category_alias']]))
        $params[$v['category_alias']] = array();
    array_push($params[$v['category_alias']],$v);
    if($v['recommended'] ==  1)
        array_push($params['recommended'],$v);
}
@endphp
<div class="aside">
    <div class="nav_subject"> <a href="/portal/giftcard/" class="giftcard">상품권몰</a> </div>
    <div class="nav">
        <div class="nav_title"> <a href="/portal/giftcard/giftcard_buy_list?pMode=O">나의 구매내역</a> </div>
        <div class="nav_title align-center"><a href="#">추천 상품권</a></div>
        @if(!empty($params['recommended']) && sizeof($params['recommended']) > 0)
            <ul class="nav_sub g_list">
                @foreach($params['recommended'] as $v)
                    <li class="">
                        <a href="/portal/giftcard/{{$v['alias']}}">
                            {{$v['name']}}
                            @if($v['new'] == 1)
                                <span style="padding:0 5px 1px 3px;color:#fff;font-weight:bold;letter-spacing:-1px;font-size:11px; margin-left:1px;background-color:#1DB8B4">NEW</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="nav_title align-center"><a href="#">온라인 상품권</a></div>
        @if(!empty($params['online']) && sizeof($params['online']) > 0)
        <ul class="nav_sub g_list">
            @foreach($params['online'] as $v)
             <li class="">
                 <a href="/portal/giftcard/{{$v['alias']}}">
                     {{$v['name']}}
                     @if($v['new'] == 1)
                         <span style="padding:0 5px 1px 3px;color:#fff;font-weight:bold;letter-spacing:-1px;font-size:11px; margin-left:1px;background-color:#1DB8B4">NEW</span>
                     @endif
                 </a>
             </li>
            @endforeach
        </ul>
        @endif
        <div class="nav_title align-center"><a href="#">모바일 상품권</a></div>
        @if(!empty($params['mobile']) && sizeof($params['mobile']) > 0)
            <ul class="nav_sub g_list">
                @foreach($params['mobile'] as $v)
                    <li class="">
                        <a href="/portal/giftcard/{{$v['alias']}}">
                            {{$v['name']}}
                            @if($v['new'] == 1)
                                <span style="padding:0 5px 1px 3px;color:#fff;font-weight:bold;letter-spacing:-1px;font-size:11px; margin-left:1px;background-color:#1DB8B4">NEW</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="nav_title align-center"><a href="#">생활/쇼핑</a></div>
        @if(!empty($params['life']) && sizeof($params['life']) > 0)
            <ul class="nav_sub g_list">
                @foreach($params['life'] as $v)
                    <li class="">
                        <a href="/portal/giftcard/{{$v['alias']}}">
                            {{$v['name']}}
                            @if($v['new'] == 1)
                                <span style="padding:0 5px 1px 3px;color:#fff;font-weight:bold;letter-spacing:-1px;font-size:11px; margin-left:1px;background-color:#1DB8B4">NEW</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div id="giftcard_left_banner" style="overflow:hidden;width:200px;height:178px;margin-top:15px">
        <form method="post" id="frmbanner" name="frmbanner"></form>
    </div>
</div>
<style>
    .aside .nav  a{
        text-align: left;
        padding-left: 25px;
    }
    .aside .nav .nav_sub a{
        border-bottom: none;
        text-align: left;
        padding-left: 0px;
        padding-top: 7px;
    }
</style>
