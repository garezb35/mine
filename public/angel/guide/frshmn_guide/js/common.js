$(function() {
    $('div.top_menu span').click(function() {
        if($(this).attr('id') == 'sell_btn') {
            $('#guide_sell').show();
            $('#guide_buy').hide();
        } else {
            $('#guide_sell').hide();
            $('#guide_buy').show();
        }
    });

    $('#guide_sell li a img').bind({
        hover : function() {
            var crtSRC = $(this).attr('src');
            var tmp1 = crtSRC.substr(0, (crtSRC.indexOf('_on.gif')));
            var tmp2 = crtSRC.substr(0, (crtSRC.indexOf('.gif')));

            if(tmp1) {
                $(this).attr('src', tmp1 + '.gif');
            } else if(tmp2) {
                $(this).attr('src', tmp2 + '_on.gif');
            }
        }
    });

    $('#guide_buy li a img').bind({
        hover : function() {
            var crtSRC = $(this).attr('src');
            var tmp1 = crtSRC.substr(0, (crtSRC.indexOf('_on.gif')));
            var tmp2 = crtSRC.substr(0, (crtSRC.indexOf('.gif')));

            if(tmp1) {
                $(this).attr('src', tmp1 + '.gif');
            } else if(tmp2) {
                $(this).attr('src', tmp2 + '_on.gif');
            }
        }
    });
});
