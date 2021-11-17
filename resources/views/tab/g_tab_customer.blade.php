<div class="g_tab g_tab_myroom">
    <div @if($group == 'index')class="selected"@endif><a href="/myroom/customer">나의 서비스 메뉴</a></div>
    <div @if($group == 'search')class="selected"@endif><a href="/myroom/customer/search">나만의 게임</a></div>
{{--    <div @if($group == 'private')class="selected"@endif><a href="/myroom/customer/private">개인환경</a></div>--}}
</div>
