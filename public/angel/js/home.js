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
    var moreBtn = document.querySelectorAll('.goods_more_btn');
    for(var i=0; i<moreBtn.length; i++) {
        moreBtn[i].addEventListener('click', function () {
            var code = this.getAttribute('data-code');
            var name = this.getAttribute('data-gamename');
            moreBtnAction(code, name);
        })
    }
})();


(function($) {
    $.fn.noticerolling = function() {
        var $element = $(this).find('ul');
        var speed = 3000;
        var timer = null;
        var move = $element.children().outerHeight();
        var first = false;
        var lastChild;
        lastChild = $element.children().eq(-1).clone(true);
        lastChild.prependTo($element);
        $element.children().eq(-1).remove();
        if ($element.children().length == 1) {
            $element.css('top', '0px');
        } else {
            $element.css('top', '-' + move + 'px');
        }
        timer = setInterval(movenextslide, speed);
        $element.find('>li').bind({
            'mouseenter': function() {
                clearInterval(timer);
            },
            'mouseleave': function() {
                timer = setInterval(movenextslide, speed);
            }
        });
        function movenextslide() {
            $element.each(function(idx) {
                var firstChild = $element.children().filter(':first-child').clone(true);
                firstChild.appendTo($element.eq(idx));
                $element.children().filter(':first-child').remove();
                $element.css('top', '0px');
                $element.eq(idx).animate({
                    'top': '-' + move + 'px'
                }, 'normal');
            });
        }
    }
}(jQuery));

function moreBtnAction(code, name){
    var form = document.getElementById("search-overlay-container");
    form.setAttribute("method", "post");
    form.setAttribute("action", "/sell/list");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "filtered_game_id");
    hiddenField.setAttribute("value", code);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "filtered_game_alias");
    hiddenField.setAttribute("value", name);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "filtered_child_id");
    hiddenField.setAttribute("value", 0);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "filtered_child_alias");
    hiddenField.setAttribute("value", '서버전체');
    form.appendChild(hiddenField);


    form.submit();
}

