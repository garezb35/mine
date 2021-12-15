var menu_lists_eight;
function _init() {
    $("#css_e4reede").mouseenter(function () {
        CRmouseover = true;
    });

    $("#css_e4reede").mouseleave(function () {
        CRmouseover = false;
    });

    KeepAlivesRaw({
        el: document.getElementById('enableSettings'),
        layer: document.getElementById('settings_window'),
        close_btn: document.getElementById('disableSettings'),
        type: 'style'
    });

    $('#enableSettings').on('click', function () {
        menu_lists_eight = $('.service_list').html();
    });

    $('#disableSettings').on('click', function () {
        $('.service_list').html(menu_lists_eight);
        menu_lists_eight = '';
    });

}

(function() {
    $(document).on('click', '.arrange_menus', function() {
        if ($(this).find(':checked').length > 0) {
            this.classList.add('on');
        } else {
            this.classList.remove('on');
        }
    });

    $('#submit_menus').click(function() {
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

    $('#reset_menus').click(function() {
        $('.arrange_menus').removeClass('on');
        $('.arrange_menus').find(':checked').prop('checked', false);
    });
})();







