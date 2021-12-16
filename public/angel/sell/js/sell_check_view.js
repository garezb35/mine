/*
 * @title		흥정신청된 물품
 * @author		김보람
 * @date		2012.01.27
 * @update		수정날짜(수정자)
 * @description
 */

function _init()
{
    var checker = new _form_checker($("#frmReBa"));
    var baInput = $("[name='re_ba_money']");
    checker.add({inputObj:baInput, strType:'price', protect:true, message:'재흥정 금액을 입력해주세요'});
    checker.add({inputObj:baInput, custom:fnCheck_price});

    baInput.bind('blur', fnCheck_price);
}

/* ▼ Price Check */
function fnCheck_price(bLimit) {
    if($(this).val().isEmpty() || $(this).val() == '0') { return false }
    var last = $(this).val().substring($(this).val().length-2, $(this).val().length);
    if(last!='00')
    {
        alert('거래금액에 십원단위와 일원단위는 0이외의 숫자를 입력할수 없습니다.\n\n거래금액을 다시 기재해 주세요.\n\n예) 12,345(불가능), 12,300(가능)');
        $(this).val('');
        $(this).focus();
        return false;
    }


    if((arguments.length<1 || arguments[0]!==true) && parseInt($(this).val().replace(/[^0-9]/g,""))<3000)
    {
        alert('거래금액은 3,000 원 이상으로 입력해주세요.');
        $(this).val('');
        $(this).focus();
        return false;
    }

    return true;
}
/* ▲ Price Check */

/* ▼ 흥정 처리 */
function TradeCheck(process, check_id)
{
    var frm = $('#frmCheckView');
    frm.find('input[name="id"]').val(check_id);
    frm.find('input[name="process"]').val(process);
    frm.attr('action', "sell_check_ok.php").submit();
}
/* ▲ 흥정 처리 */

/* ▼ 재흥정 레이어 */
function TradeReCheck(process)
{
    var frm = $('#frmReBa');

    if(frm.find('input[name="re_ba_money"]').val().isEmpty())
    {
        alert("재흥정 금액을 입력해주세요");
        frm.find('input[name="re_ba_money"]').focus();
        return false;
    }


    if(!confirm('재흥정 요청을 하겠습니까?'))
        return false;

    var INPUT = $('<INPUT />');
    INPUT.attr({
        type	: "hidden",
        name	: "process",
        value	: process
    });
    frm.append(INPUT);


    frm.attr('action', "/sell_check_ok").submit();
}
/* ▲ 재흥정 레이어 */

/* ▼ 삭제 */
function fnTradeDelete()
{
    if(confirm("선택한 물품을 삭제하겠습니까?")) {
        var frm = $("#frmList");
        frm.attr('action', "sell_regist.php");
        frm.submit();
    }
}
/* ▲ 삭제 */


function popLayer(elementID,params){
    nodemonPopup.enable($("#"+elementID));
    if(params)
    {
        _form.addValues($("#"+elementID).find('form').eq(0), params);
    }
}

function fnCreditViewCheck(t){
    var params = 'id='+t;

    fnAjax('/user/credit_ajax.php?t='+(new Date()).getTime(), 'text', 'POST', params, {
        complete:function(res){
            var rgResult = res.split('|');
            if(rgResult[0] == 'SUCCESS') {
                $('#encryptId').val(rgResult[1]);
                if(rgResult[2] && !rgResult[2].isEmpty()) {
                    $('#encryptType').val(rgResult[2]);
                }
                _window.open('credit_view','',570,640);
                $('#creditForm').attr({
                    'target' : 'credit_view',
                    'action' : '/user/credit_view.html'
                }).submit();
            }
            else {
                alert(rgResult[1]);
            }
        }
    });
}
