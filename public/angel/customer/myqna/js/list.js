function _init()
{
    var frm = $("#signForm");

    if(frm)
    {
        /* â–¼ í¼ì²´í¬ */
        $.fn.extend({
            check: function()
            {
                if(confirm('ì •ë§ë¡œ ì‚­ì œ í•˜ê² ìŠµë‹ˆê¹Œ?'))
                {
                    if(frm.find('input[name="pSeq[]"]:checked').length < 1)
                    {
                        alert('1ê±´ ì´ìƒ ì„ íƒ í•˜ì„¸ìš”.');
                        return false;
                    }

                    frm.attr('action', 'customer_delete.php').submit();
                }
            }
        });
        /* â–² í¼ì²´í¬ */
    }
}

/* â–¼ ì „ì²´ì„ íƒ */
function fnCheck()
{
    var frm = $("#signForm");
    if(frm.find('input[name="cTotal"]').prop('checked') == true) {
        frm.find('input[name="pSeq[]"]').prop('checked', true);
    }
    else {
        frm.find('input[name="pSeq[]"]').prop('checked', false);
    }
}
/* â–² ì „ì²´ì„ íƒ */
