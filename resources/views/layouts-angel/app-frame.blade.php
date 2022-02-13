
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>아이템천사</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="/angel_mobile/main/css/component.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/photoswipe.css">
    <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/header_1.css">
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
    <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
    <link type="text/css" rel="stylesheet" href="/angel/dev/change.css">
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel.css">
    <link rel="stylesheet" href="/argon/select2/select2.min.css" />
    <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
    <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
    <script>
        var server_domain = '210.112.174.178';
        var a_token = '';
        var socket_client = io.connect('http://'+server_domain+':7443/adminWith', {
            path: '/socket.io',
            reconnectionAttempts:1,
            reconnectionDelay:500,
            reconnectionDelayMax:500,
            transports: ['websocket']
        });
    </script>

        @yield('head_attach')

</head>
<body style="min-height: 500px;background: #fff">
<div id="global_root" class="mainEntity d-none ">
    <div id="thirdys" class="fluid-div"></div>
</div>
<script>

    @if(Auth::check())
        a_token = '{{Auth::user()->api_token}}';

    @else
    var a_token = '';

    @endif
    function basicPopup(url) {
        popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }
</script>
<div class="w_854">
@yield('content')
</div>
<script type="text/javascript" src="/angel/_js/jquery.js"></script>
<script type="text/javascript" src="/angel/_js/webpack.js"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
<script type="text/javascript" src="/angel/_js/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
<script type="text/javascript" src="/angel/photoswipe/js/jquery.photoswipe-global.js"></script>
<script type="text/javascript" src="/angel/_js/fed.min.js"></script>
<script src="/argon/select2/select2.min.js"></script>
<script src="/angel_mobile/main/js/modernizr.custom.js"></script>
<script src="/angel_mobile/main/js/jquery.dlmenu.js"></script>
@yield('foot_attach')

<script type="text/javascript">
    loadGlobalItems()
</script>

</body>

</html>
<script>
    var width = $(window).width();
    function heightResize()
    {
        var resizeHeight = $('body').height();
        try{
            $('#mainFrame', window.parent.document).height(resizeHeight + 20);
            stated++;
        }
        catch(e){}
    }

    // function enterSearchList(id,game){
    //     $('input[name="filtered_game_id"]').val(id);
    //     $('input[name="filtered_game_alias"]').val(game);
    //     $("#search-overlay-container").submit()
    // }


    // function controlFavorite() {
    //     $(".showing_fav").find("i").removeClass('fa-plus')
    //     $(".showing_fav").find("i").removeClass('fa-minus')
    //     var x = document.getElementById("my_game");
    //     if (x.style.display === "none") {
    //         x.style.display = "block";
    //         $(".showing_fav").find("i").addClass('fa-minus')
    //     } else {
    //         x.style.display = "none";
    //         $(".showing_fav").find("i").addClass('fa-plus')
    //     }
    // }

    {{--function changePosL(){--}}
    {{--    $(".siteHeader .nav_wrap .nav_menu_nodemon").css('margin-left',($(document).width()-895) / 2 + 50);--}}
    {{--    $(".siteHeader .nav_wrap .nav_menu_nodemon").css('display','block')--}}
    {{--    $(".top-leftli").css("left",$(".highlight__first").offset().left - 180 + "px")--}}

    {{--    $(".top-leftli").css('display','block')--}}
    {{--}--}}
    {{--function fixChattingPos(){--}}
    {{--    var w__s = $(window).width() + 17;--}}
    {{--    @if(request()->route()->getName() == "index")--}}
    {{--    if(w__s > 1216)--}}
    {{--    {--}}
    {{--        $("#home__content").css('margin-left',($(document).width()-1200) / 2 + 347);--}}
    {{--        $("#home__content").css('display','block')--}}
    {{--        var pos_left = $("#home__content").offset();--}}
    {{--        $("#topbar-left").css("left",pos_left.left - 345 + "px")--}}
    {{--        $("#topbar-left").css("top",pos_left.top + "px")--}}
    {{--        $("#topbar-left").css('display','block')--}}
    {{--    }--}}
    {{--    else{--}}
    {{--        $("#home__content").css('margin-left',0);--}}
    {{--        $("#home__content").css('display','block')--}}
    {{--    }--}}
    {{--    @else--}}
    {{--    if(w__s > 1216)--}}
    {{--    {--}}
    {{--        $(".container_fulids").css('margin-left',($(document).width()-1200) / 2 + 347);--}}
    {{--        $(".container_fulids").css('display','block')--}}
    {{--        var pos_left = $(".container_fulids").offset();--}}
    {{--        $("#topbar-left").css("left",pos_left.left - 345 + "px")--}}
    {{--        $("#topbar-left").css("top",pos_left.top + "px")--}}
    {{--        $("#topbar-left").css('display','block')--}}
    {{--    }--}}
    {{--    else{--}}
    {{--        $(".container_fulids").css('margin-left',0);--}}
    {{--        $(".container_fulids").css('display','block')--}}
    {{--    }--}}
    {{--    @endif--}}
    {{--}--}}
    {{--fixChattingPos();--}}
    {{--changePosL();--}}
    $(document).ready(function(){
        heightResize();
    //     $( '#dl-menu' ).dlmenu();
    //     $(".dropdown").hover(
    //         function() {
    //             $('.dropdown-menu').stop( true, true ).slideDown("fast");
    //             $(this).toggleClass('open');
    //         },
    //         function() {
    //             $('.dropdown-menu').stop( true, true ).slideUp("fast");
    //             $(this).toggleClass('open');
    //         }
    //     );
    //
    //     $(".drop-menu-right li a").click(function(){
    //         var id = $(this).data('id');
    //         var name = $(this).data('name');
    //         $('input[name="filtered_game_id"]').val(id);
    //         $('input[name="filtered_game_alias"]').val(name);
    //         $('#search-overlay-container').submit()
    //     })
    // })
        $(window).on('resize', function() {
            heightResize()
        })

    });

</script>

