

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
        // debugger;
        var frm = $('#searchForm');
        frm.find('[name="searchWord"]').val($(this).text());
        frm.submit();
    }
});
