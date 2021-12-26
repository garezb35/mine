function _init() {
    if($('#first_con').length > 0) {
        $('html, body').addClass('fixed_on');

        var now = new Date();
        now.setDate(now.getDate() + 1);
        now.setHours(0);
        now.setMinutes(0);
        now.setSeconds(0);
        now.setMilliseconds(0);

        document.cookie = 'FIRST_APP_CHECK=ON;expires='+now.toGMTString();

        $('#first_close').click(function() {
            $('html, body').removeClass('fixed_on');
            $('#first_con').hide();
        });
    }
    var swiperOptions = {
        pagination: '#spot_paging',
        paginationClickable: true,
        effect: 'coverflow',
        lazyLoading : true,
    };
    swiperOptions.initialSlide = Math.floor(Math.random()*window.rollingBannerLength);
    new Swiper('#spotBanner', swiperOptions);

    if($('#bt_rolling').find('.swiper-slide').length > 1) {
        new Swiper('#bt_rolling', {
            pagination: '#bt_paging',
            paginationClickable: true,
            loop: true,
            speed: 1000,
            autoplay: 3000
        });
    }
    $('.main_floating_banner').each(function(i, b){
        new Swiper(b, {
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            loop: false,
            onSlideChangeEnd: function(t) {
                var bnName = $(b).find('.swiper-slide-active').data('cookie');
                if(bnName) {
                    _cookie.add(bnName, true, 1, '/');
                }
            },
            onInit: function () {
                this.onSlideChangeEnd();
            }
        });
        // If there are existing banner
        if($(b).find('.swiper-slide').length > 0) {
            $('.mk78F_ret').eq(i).show();

            // Closing
            $(b).find('.close').on({
                click : function() {
                    $(this).parents('.main_floating_banner').hide();
                    if($('#main_floating_banner2').length < 1 || ($('#main_floating_banner2').length > 0 && $(this).parents('.main_floating_banner')[0].id == 'main_floating_banner2')) {
                        $('.mk78F_ret').eq(i).hide();
                    }
                }
            });
        }

        if($(b).find('.swiper-slide').length == 1) {
            $(b).find('.swiper-button-prev, .swiper-button-next').hide();
        }
    })

    if (mobileAgent.type !== 'i') {
        fnCheckHeight();
    }
    else {
        new Swiper('#mainGame', {
            nextButton: '.button-next',
            prevButton: '.button-prev',
            pagination: '#mainGame_paging',
            paginationClickable: true,
            onInit:function(s) {
                $('#mainGame_pagination').show();
            }
        });

        $('#mainGame').find('li').click(function() {
            if(_GameServerController.serverlist == undefined) {
                _GameServerController();
            }
            _GameServerController.setSubmitType('serverSearch');
            _GameServerController.serverlist[0].onChange = function() {
                $('#juret__react56').attr('action', 'search_index.html').submit();
            };
            _GameServerController.gamelist[0].close();
            _GameServerController.gamelist[0].setValue(this);
            _GameServerController.serverlist[0].filter.game = $(this).attr('data-id');
            _GameServerController.serverlist[0].loadData();
            _GameServerController.serverlist[0].wrapperOpen();
        });
    }

    if(document.getElementById('appBannerClose') !== null ) {
        document.getElementById('appBannerClose').addEventListener('click', function() {
            var now = new Date();
            now.setHours(23);
            now.setMinutes(59);
            now.setSeconds(59);
            document.cookie = 'appSetupBanner=deny;expires='+now.toGMTString();
            $('#appSetupBanner').slideUp();
        });
    }

    if($('#ima_area').length > 0) {
        fnGetPlatformNineURL();
    }
    $(window).scroll(function(){
        var height = $(document).scrollTop();
        if(height>243)
        {
            $('.srh_inp_wrap').css('opacity', '0');
            $('.srh_inp_wrap_scroll').show();
        }
        else
        {
            $('.srh_inp_wrap').css('opacity', '1');
            $('.srh_inp_wrap_scroll').hide();
        }
    });

    ajaxRequest({
        // 수정
        // url: '/_ajax/bookmark.php',
        url: '',
        success: function(res) {
            var wrapper =	$('#bookmark_list');

            res.BookmarkList.forEach(function(bookmark){
                var bookmarkEl = '<li>';
                bookmarkEl += '<a href="'+bookmark.link+'">';
                bookmarkEl += '<span class="bookmark_icon '+bookmark.code+'">';
                if(bookmark.code === 'selling' && res.sell_ing > 0){
                    bookmarkEl += '<span class="badge">'+res.sell_ing+'</span>';
                }else if(bookmark.code === 'buying' && res.buy_ing > 0){
                    bookmarkEl += '<span class="badge">'+res.buy_ing+'</span>';
                }
                bookmarkEl += '</span>';
                bookmarkEl += '<span class="bookmark_title">'+bookmark.name+'</span></a></li>';
                wrapper.append(bookmarkEl)
            })
            var favorite = '<li>';
            favorite += $('#main_login_check').val()?'<a href="/bookmark">':'<a href="/login">';
            favorite	+= '<span class="bookmark_icon bookmark_add"></span></a></li>';

            wrapper.append(favorite)
        },
        error: function() {

        }
    });

    if($('.notice_ct').children('a').length<=0)
    {
        $('.notice').hide();
    }

    if(document.getElementById('alarm_noti') !== null)
    {
        var alarmNoti = document.getElementById('alarm_noti');

        ajaxRequest({
            // 수정
            // url: '/myroom/goods_alarm/_ajax_process.php',
            url: '',
            type: 'post',
            dataType: 'json',
            data: {
                'mode': 'new'
            },
            success: function (res) {
                if(res.DAT == 'Y')
                {
                    alarmNoti.querySelector('.new').classList.add('on');
                }
                else
                {
                    alarmNoti.querySelector('.new').classList.remove('on');
                }
            },
            error: function (e) {
                //alert('서버와의 접속이 원활하지 않습니다.\n잠시후 다시 시도해주세요.' + e.message);
                return;
            }
        });
    }
}

function fnGetPlatformNineURL() {
    try {
        window.androidMania.getPlatform9URL();
    } catch (e) {
        $('#ima_area').hide();
    }
}

function loadPage(url) {
    if (url) {
        $('#ima_frame').attr('src', url);
    } else {
        $('#ima_area').hide();
    }
}

function fnCheckHeight() {
    var screenWidth = document.body.clientWidth;
    var checkRatio = screenWidth / 720;
    var returnHeight = 150 * checkRatio;

    $('.html_bn').css('height', returnHeight+'px');
    //return 'style="height:'+returnHeight+'px"';
}
