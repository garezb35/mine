var service_list_clone;
function _init() {
    $("#trade_banner").mouseenter(function () {
        CRmouseover = true;
    });

    $("#trade_banner").mouseleave(function () {
        CRmouseover = false;
    });


    $('#chargeBtn > a').click(moveChargeList);
    $('#power_indicate').find('span').click(movePowerList);

    LayerControl({
        el: document.getElementById('service_btn'),
        layer: document.getElementById('service_layer'),
        close_btn: document.getElementById('service_close'),
        type: 'style'
    });

    $('#service_btn').on('click', function () {
        service_list_clone = $('.service_list').html();
    });

    $('#service_close').on('click', function () {
        $('.service_list').html(service_list_clone);
        service_list_clone = '';
    });

}

/* 나만의 서비스 설정 */
(function() {
    $(document).on('click', '.service_list_btn', function() {
        if ($(this).find(':checked').length > 0) {
            this.classList.add('on');
        } else {
            this.classList.remove('on');
        }
    });

    $('#service_save').click(function() {
        var checkList = $('#service_list').find(':checked');
        if (checkList.length < 8) {
            alert('8개 메뉴를 선택하셔야 저장이 가능합니다.');
            return;
        }
        if (checkList.length > 8) {
            alert('8개까지 선택하실 수 있습니다.');
            return;
        }

        var strParam = checkList.serializeArray();
        var param = {};
        param.api_token = a_token;
        param.list = strParam;
        ajaxRequest({
            url : '/api/_ajax/my_service',
            dataType : 'json',
            type : 'post',
            data : param ,
            success : function (res) {
                alert(res.msg);
                if(res.result === "SUCCESS") {
                    window.location.reload();
                }
                return;
            },
            error : function () {
                alert('서버와 접속이 원활하지 않습니다.');
                return;
            }
        });
    });

    $('#service_init').click(function() {
        $('.service_list_btn').removeClass('on');
        $('.service_list_btn').find(':checked').prop('checked', false);
    });
})();

function moveChargeList() {
    var rType = $(this).attr('data-type');
    if (rType === undefined) {
        rType = 'n';
    }

    var nowObj = $('#charge_list > ul:visible');

    switch (rType) {
        case 'p':
            nowObj.hide();
            if (nowObj.prev('ul').length < 1) $('#charge_list > ul:last').show();
            else nowObj.prev('ul').show();
            break;
        case 'n':
        default :
            nowObj.hide();
            if (nowObj.next('ul').length < 1) $('#charge_list > ul:first').show();
            else nowObj.next('ul').show();
            break;
    }
}

var nBanner = -1;


function movePowerList() {
    var indecate = $('#power_indicate').find('span');
    var plist = $('#power_list').find('li');
    var on = $('#power_list').find('.on');
    var idx = indecate.index($(this));
    if(plist.index(on) === idx) {
        return;
    }
    if(idx < 0) {
        idx = 0;
    }
    var sliceEnd = (idx + 1) * 12;
    var sliceStart = (sliceEnd - 12) < 0 ? 0 : sliceEnd - 12;
    plist.addClass('g_hidden');
    plist.slice(sliceStart, sliceEnd).removeClass('g_hidden');
    indecate.removeClass('on');
    $(this).addClass('on');
}




var timer;

function bannerRolling(bannerSelector) {
    var crOnMouseOver = false;
    var $crArea = $(bannerSelector);
    var $bannerArea = $crArea.find('.banner_in');
    var $bannerIndicator = $crArea.find('.banner_indicate');
    var bannerArrLength = $bannerArea.children().length;
    var random = Math.floor(Math.random() * $bannerArea.find('.banner_item').length);

    for (var iForBA = 0; iForBA < bannerArrLength; iForBA++) {
        $bannerIndicator.append('<span></span> ');
    }

    $bannerIndicator.find('span').click(function(e) {
        var targetIdx = $(e.target).index();

        $(e.target).siblings().removeClass('on');
        $(e.target).addClass('on');

        $crArea.find('.banner_in').children().removeClass('banner_on');
        $($crArea.find('.banner_in').children()[targetIdx]).addClass('banner_on');

        clearTimeout(timer);

        crOnMouseOver = true;
        timer = setTimeout(function() {
            crOnMouseOver = false;
        }, 3000);
    });

    $bannerArea.find('.banner_item').eq(random).addClass('banner_on');
    $bannerIndicator.find('span').eq(random).addClass('on');


    if (bannerArrLength > 1) {
        setInterval(function() {

            if (crOnMouseOver) return;

            var $currentBanner = $bannerArea.find('.banner_item.banner_on');
            var $currentBannerIndi = $bannerIndicator.find('span.on');
            var $nextBanner = $currentBanner.next().length !== 0 ? $currentBanner.next() : $bannerArea.find('.banner_item').eq(0);
            var $nextBannerIndi = $currentBannerIndi.next().length !== 0 ? $currentBannerIndi.next() : $bannerIndicator.find('span').eq(0);

            $currentBanner.removeClass('banner_on');
            $currentBannerIndi.removeClass('on');
            $nextBanner.addClass('banner_on');
            $nextBannerIndi.addClass('on');
        }, 3000);

        // 마우스오버, 아웃 체크
        $bannerArea.mouseover(function() {
            clearTimeout(timer);
            crOnMouseOver = true;
        });
        $bannerArea.mouseout(function() {
            timer = setTimeout(function() {
                crOnMouseOver = false;
            }, 3000);
        });
    }
}


bannerRolling('#center_rolling_banner');
bannerRolling('.gamemania');
