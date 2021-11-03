/*
 * @title			ë‚˜ì˜ì§ˆë¬¸ê³¼ ë‹µë³€
 * @author		ìž¥ì›ì§„
 * @date			2012. 02. 20
 * @update		ìˆ˜ì •ë‚ ì§œ(ìˆ˜ì •ìž)
 * @description
 */

function _init() {
    var frm = $("#statistics");
    var checker = new _form_checker(frm);
    checker.add({
        custom: function() {
            var bCheck = $('input[name="reply_point"]:checked').length;

            if(bCheck < 1) {
                alert("ë³„ì ì„ ì„ íƒí•˜ì„¸ìš”.");
                return false;
            }

            return true;
        }
    });

    var frm2 = $("#signForm");
    var checker2 = new _form_checker(frm2);
    checker2.add({
        custom: function() {
            if(confirm("ì •ë§ë¡œ ì‚­ì œ í•˜ê² ìŠµë‹ˆê¹Œ?")) {
                return true;
            }

            return false;
        }
    });
}

/* â–¼ ì²¨ë¶€íŒŒì¼ */
function fnFileOpen(fileFolder, fileName)
{
    var width="1000";
    var height="740";
    var left;
    var top;

    left	= (window.screen.width - width)/2;
    top		= (window.screen.height - height)/2;
    window.open("/customer/myqna/image_viewer.html?fileFolder="+fileFolder+"&fileName="+fileName,"","width="+width+",height="+height+",top="+top+",left="+left+",scrollbars=yes,menubar=no,toolbar=no,status=no,directories=no,location=no,resizable=yes");
}
/* â–² ì²¨ë¶€íŒŒì¼ */
