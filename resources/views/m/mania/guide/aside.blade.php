<style>
    .aside .nav_subject > a {
        background: initial !important;
        text-indent: initial !important;
        display: block !important;
        margin-top: 14px
    }
    .aside .nav_subject {
        height: 115px;
    }
    .aside .nav > .nav_title {
        font-size: 16px;
        height: 50px;
        line-height: 50px;
        padding-left: 0px;
    }
    .aside .nav a {
        border-bottom: solid 1px gray;
        text-align: center;
    }
    .aside .nav_subject {
        background: white;
        /*border: solid 1px #3AB7D3;*/
    }
    .aside {
        border: solid 1px #3AB7D3;
    }
</style>
<div class="aside">
    <div class="nav_subject">
        <a href="{{route("guide")}}" class="m-0">
            <p class="f-18 m-0 c-black align-center" style="padding-top: 10px;">이용안내</p>
            <div class="m-auto align-center" style="margin-top: 10px;">
                <img src="/angel/img/icons/guide2.png" />
            </div>
        </a>
    </div>
    {{--    <div class="nav_subject"><a href="/guide/" class="guide">이용안내</a></div>--}}
    <div class="nav">
        <div class="@if($group == 'guide') on_active @endif nav_title"><a href="#">이용안내</a></div>
        <div class="@if($group == 'new_guide') on_active @endif nav_title"><a href="#">초보자 가이드</a></div>
        <div class="@if($group == 'notices') on_active @endif nav_title"><a href="#">공지사항</a></div>
    </div>

</div>
