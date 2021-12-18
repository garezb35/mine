<div class="footer_wrap">
    <div class="footer">
        <a href="{{route('index')}}" class="home">홈</a>
        {{--                <a href="">불법촬영물신고</a> --}}
        {{--                <a href="javascript:fnChangeVersion()">PC버전</a> --}}
        @if (Auth::check())
            <a href="{{route('logout')}}">로그아웃</a>
        @else
            <a href="{{route('login')}}">로그인</a>
        @endif
    </div>
    <div class="copyright">
        <ul class="f_menu">
            <li><a href="">이용약관</a></li>
            <li>| <a href="" class="ft_bu">개인정보 처리방침</a></li>
            <li>| <a href="">청소년보호정책</a></li>
        </ul>
        <ul class="copyright_txt">
            <li>(주)아이템천사 대표이사:홍길동</li>
            <li>사업자등록번호:010-33-33333</li>
            <li>통신판매업신고번호:제3003-서울-0055호</li>
            <li>고객센터:5555-5555 FAX:0505-333-3333</li>
            <li>ⓒ IMI AII Right Reserved.</li>
        </ul>
    </div>
</div>
