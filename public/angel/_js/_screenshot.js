(function($) {
    $.fn.filestyle = function(objPosition, _option) {
        var _setting = {width: 150};
        if (_option) {
            $.extend(_setting, _option);
        }
        ;
        $(this).each(function() {
            var selfObj = $(this);
            var selfParent = $(this).parent();
            var newObj = $('<div />').addClass('g_screenshot').css({
                'width': _setting.width + 75
            });
            var filename = $('<input />', {'type': 'text'}).addClass('angel__text float-left').attr('readonly', 'readonly').css({
                'display': 'inline-block',
                'width': _setting.width + 'px',
                'height': '20px',
                'margin-right': '5px',
                'background-color': '#F7F7F7',
                'vertical-align': 'middle'
            });
            if ($(selfObj).attr('class') != "undefined") filename.addClass($(selfObj).attr('class'));
            newObj.append(filename);

            var wrapper = $('<div />').css({
                'display': 'inline-block',
                'width': '57px',
                'height': '20px',
                'background': 'url(' + IMG_DOMAIN1 + '/images/btn/btn_search2.gif) no-repeat 0 0',
                'position': 'relative',
                'overflow': 'hidden',
                'margin-right': '5px',
                'vertical-align': 'middle'
            });
            newObj.append(wrapper);

            if (objPosition == 0) $(selfObj).parent().prepend(newObj);
            if (objPosition == 1) $(selfObj).before(newObj);
            else selfParent.append(newObj);

            $(selfObj).css({
                'position': 'relative',
                'width': '57px',
                'height': '20px',
                'cursor': 'pointer',
                'opacity': '0.0'
            });
            if (_BROWSER.name == "FF" && parseInt(_BROWSER.version) <= 20) $(selfObj).css('left', '-' + (_setting.width + 5) + "px");
            wrapper.append($(selfObj));

            $(selfObj).bind('change', function() {
                filename.val($(this).val());
            });
            return newObj;
        });
    };
})(jQuery);
