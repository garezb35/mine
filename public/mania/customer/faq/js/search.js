/*
 * @title		고객감동센터 FAQ 검색
 * @author		김현진
 * @date		2012.03.26
 * @update		수정날짜(수정자)
 * @description
 */

$(function(){
    var frm = $('#searchForm');
    checker = new _form_checker(frm);
    checker.add({
        custom : function(){
            if($('[name="searchWord"]').val() == '검색어를 입력해 주세요.' || $('[name="searchWord"]').val() == '') {
                alert('검색어를 입력해 주세요.');
                $('[name="searchWord"]').val('');
                $('[name="searchWord"]').focus();
                return false;
            }
            return true;
        }
    });
    $('[name="searchWord"]').bind({
        blur : function() {
            if($('[name="searchWord"]').val() == '') $('[name="searchWord"]').val('검색어를 입력해 주세요.');
        },
        click : function() {
            if($('[name="searchWord"]').val() == '검색어를 입력해 주세요.') $('[name="searchWord"]').val('');
        }
    });
});

$.fn.extend({
    fnSearch : function ()
    {
        var frm = $('#searchForm');
        frm.find('[name="searchWord"]').val($(this).text());
        frm.submit();
    }
});
