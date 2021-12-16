/*
 * @title		판매중인 물품
 * @author		김보람
 * @date		2012.03.19
 * @update		수정날짜(수정자)
 * @description
 */

// 판매유형
var e_type = {
    'sell' : 0,
    'buy' : 1
};

var angel_item_s_alias = {
    'general':	0,
    'division':	1,
    'bargain':	2
};

// 상품유형
var e_goods = {
    'money' :	0,
    'item'	:	1,
    'etc'	:	2
};
var angel_item_alias = {
    'money':	'게임머니',
    'item':		'아이템',
    'character': '캐릭터',
    'etc':		'기타'
};
// 현재선택된 타입
var angel_enable_type = {
    sale:	'general',
    org_sale: 'general',
    goods:	'money',
    trade_type : 'sell'
};

var bAjax	= false;
var simpleTradeParams = null;
var obj_content_text = '취소 사유선택이 상대방의 직거래 유도일 경우, 해당 직거래에 대한 상황을 구체적으로 기재해주시기 바랍니다. 직거래 신고에 대한 사항은 담당자가 조사 후 답변을 드리도록 하겠습니다. 허위로 직거래 신고를 할 경우 사이트 이용에 제재가 될 수 있으니 이점 양지해주시기 바랍니다.';

function _init(){
    if(simpleTradeParams != null && simpleTradeParams.refer_type == 'simple') {
        if(simpleTradeParams.process == 'ok') {
            $('#trade_btn')[0].click();
        }
        else if(simpleTradeParams.process == 'cancel') {
            $('#cancel_btn')[0].click();
        }
    }

    if($('#dfGameNotice').length > 0) {
        nodemonPopup.enable($('#dfGameNotice'));
    }

    var screenshot = document.getElementsByClassName('screenshot');
    var scLen = screenshot.length;
    for(var i=0; i<scLen; i++) {
        screenshot[i].getElementsByTagName('a')[0].addEventListener('click', function(evt) {
            var idx = this.getAttribute('data-idx');
            var info = document.getElementById('screenshot_info').value;
            _window.open('imgview', '/myroom/sell/image_viewer.html?idx='+idx+'&info='+info, 2000, 1000,'scrollbars=yes');
        })
    }
}

function popLayer(elementID,params){
    nodemonPopup.enable($("#"+elementID));
    if(params)
    {
        _form.addValues($("#"+elementID).find('form').eq(0), params);
    }
}

//물품인수 확인
function popLayer_2(elementID) {
    var params = {
        id: $("#id").val(),
        trade_type:$("#trade_type").val()
    };

    if ($('[name=sell_reserve]:checked').val() == undefined) {
        alert('적립방법을 선택해주세요.');

        return;
    }

    if ($('[name=sell_reserve]:checked').val() == 'phone') {
        if ($('#trade_reserve td').eq(1).find('span.g_red1_b').length < 1) {
            alert('휴대폰번호 출금 정보 등록 후 선택이 가능합니다.');

            return;
        }

        if (bAjax) {
            alert('처리중입니다.\n잠시만 기다려주세요.');

            return;
        }

        bAjax	= true;

        $.ajax({
            url: '/_include/_trade_complete_payment_phone.php',
            async: false,
            data: $('#frm_reserve').serialize(),
            type: 'post',
            dataType: 'text',
            success: function (r) {
                if (r == 'successTcashTarget') {
                    nodemonPopup.disable();

                    popLayer(elementID, params);
                }
                else {
                    alert(r);
                }

                bAjax	= false;
            },
            error: function () {
                alert('서버와의 접속이 원활하지 않습니다.');

                nodemonPopup.disable();

                bAjax	= false;

                return;
            }
        });
    }
    else {
        nodemonPopup.disable();

        popLayer(elementID, params);
    }
}

// 판매금액 적립
function popLayer_3() {
    nodemonPopup.enable($('#trade_reserve'));
}

/* ▼ 거래가능확인 */
function TradeCheck(process,tid)
{
    var frm = $('#frmIngView');

    frm.find('input[name="process"]').val(process);
    frm.attr('action', "sell_ing_ok.php?tid="+tid);
    frm.submit();
}
/* ▲ 거래가능확인 */

/* ▼ 거래취소 */
function TraceCancel(process,tid)
{
    var select_cancel = $('#SELECT_CANCEL')[0];
    var cancel_detail = $('#CANCEL_DETAIL_CONTENT').val();

    if(select_cancel.getValue() == "")
    {
        alert("취소사유를 선택해 주세요.");
        return false;
    }

    if(select_cancel.getValue() == "4")
    {
        if (cancel_detail == "" || cancel_detail == obj_content_text)
        {
            alert("사유내용을 기재해 주시기 바랍니다.");
            return false;
        }
    }

    if(!confirm('거래를 취소하겠습니까?'))
        return false;


    var reReg = "N";

    if(angel_item_s_alias[angel_enable_type.org_sale]==angel_item_s_alias.general && e_type[angel_enable_type.trade_type] == e_type.sell)
    {
        if(confirm('현재 물품이 취소된 후 같은 내용으로 물품을 다시 등록하시겠습니까?\n확인을 누르시면 물품이 재등록됩니다.'))
        {
            reReg = "Y";
        }
        else
        {
            reReg = "N";

        }
    }

    var frm = $('#frmIngView');
//	Object.extend(frm,_item.dom);

    var INPUT = $('<INPUT />', {
        type : "hidden",
        name : "cancel_contents",
        value : select_cancel.getValue()
    });
    frm.append(INPUT);

    INPUT = $('<INPUT />', {
        type : "hidden",
        name : "CANCEL_DETAIL_CONTENT",
        value : cancel_detail
    });
    frm.append(INPUT);

    INPUT = $('<INPUT />', {
        type : "hidden",
        name : "trade_rereg",
        value : reReg
    });
    frm.append(INPUT);

    frm.find('input[name="process"]').val(process);
    frm.attr('action', "/sell_ing_ok?tid="+tid);
    frm.submit();
}
/* ▲ 거래취소 */

/* ▼ 물품인계확인 */
function TradeComplete(process, tid, tMode, sUserType) {
    var frm			= $('#moneyreceipt'),
        returnValue	= true;

    if (sUserType == 'N') {
        returnValue =  moneyreceipt_ck();
    }

    if (returnValue != false) {
        if (!confirm('물품 인계 확인을 하겠습니까?')) {
            return;
        }

        frm.find('input[name="process"]').val(process);

        frm.attr({
            method : 'post',
            action : '/sell_ing_ok?tid=' + tid + '&mode=' + tMode
        }).submit();
    }
}
/* ▲ 물품인계확인 */

/* ▼ 현금영수증 */
function inputChange(su){
    if(su == 1){
        $('#juminnumber').show();
        $('#jobnumber').hide();
    }else if(su == 2){
        $('#juminnumber').hide();
        $('#jobnumber').show();
    }
}

function moneyreceipt_ck(){
    var frm = $('#moneyreceipt');
    if(frm.find('input[name="moneyreceipt_check"]:checked').val() == 'ok') {

        if (frm.find('[name="moneyreceipt_name"]').val().isEmpty()) {
            alert('신청자 성명을 입력해주세요.');
            frm.find('[name="moneyreceipt_name"]').focus();
            return false;
        }

        if(frm.find('input[name="moneyreceipt_type"]:checked').val() == 'u') {

            if (frm.find('[name="member_info"]:checked').val() == 'p') {
                if (frm.find('#user_phone1').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone1').focus();
                    return false;
                }
                if (frm.find('#user_phone2').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone2').focus();
                    return false;
                }
                if (frm.find('#user_phone3').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone3').focus();
                    return false;
                }
                if (frm.find('[name*="user_phone"]').val().length < 3) {
                    alert('올바른 휴대폰 번호가 아닙니다.');
                    frm.find('[name*="user_phone"]').val('');
                    frm.find('#user_phone1').focus();
                    return false;
                }
                if (frm.find('#user_phone3').val().length < 4) {
                    alert('올바른 휴대폰 번호가 아닙니다.');
                    frm.find('#user_phone3').val('');
                    frm.find('#user_phone3').focus();
                    return false;
                }
            }
        } else if(frm.find('input[name="moneyreceipt_type"]:checked').val() == 'j') {

            if(frm.find('input[name="taxnumber1"]').val().length != 3 || frm.find('input[name="taxnumber2"]').val().length != 2  || frm.find('input[name="taxnumber3"]').val().length != 5){
                alert("사업자번호를 입력하세요!");
                return false;
            }

            if(!check_busino(frm.find('input[name="taxnumber1"]').val() + frm.find('input[name="taxnumber2"]').val() + frm.find('input[name="taxnumber3"]').val())){
                alert("잘못된 사업자등록번호입니다!\n\n다시입력하세요!");
                return false;
            }
        }
    }
}

$(function () {
    $('#juminnumber .g_radio').change(function () {
        $('.sub_div').hide();
        $('#' + $(this).attr('id') + '_div').show();
    });

    _form.protect.number($('[name*="user_phone"]'));
    _form.protect.number($('[name*="moneyreceipt_jumin"]'));

    _form.autotab($('#user_phone1'), $('#user_phone2'));
    _form.autotab($('#user_phone2'), $('#user_phone3'));
    _form.autotab($('#user_phone3'), $('[name="moneyreceipt_email"]'));
    _form.autotab($('#moneyreceipt_jumin1'), $('#moneyreceipt_jumin2'));
    _form.autotab($('#moneyreceipt_jumin2'), $('[name="moneyreceipt_email"]'));
});
/* ▲ 현금영수증 */

/* ▼ 주민등록번호 체크 */
function check_jumin(val1,val2) {
    //앞자리가 일자인지 체크
    var tmp1,tmp2
    var t1,t2,t3,t4,t5,t6,t7
    var ok=true;
    tmp1=val1.substring(2,4);
    tmp2=val1.substring(4);

    if ((tmp1<"01") || (tmp1>"12")) {ok=false; return ok;}
    if ((tmp2<"01") || (tmp2>"31")) {ok=false; return ok;}

    //뒷자리 체크
    t1=val1.substring(0,1);
    t2=val1.substring(1,2);
    t3=val1.substring(2,3);
    t4=val1.substring(3,4);
    t5=val1.substring(4,5);
    t6=val1.substring(5,6);

    t11=val2.substring(0,1);
    t12=val2.substring(1,2);
    t13=val2.substring(2,3);
    t14=val2.substring(3,4);
    t15=val2.substring(4,5);
    t16=val2.substring(5,6);
    t17=val2.substring(6,7);

    var tot=t1*2 + t2*3 + t3*4 + t4*5 + t5*6 + t6*7 ;
    tot = tot+ t11*8 + t12*9 + t13*2 + t14*3 + t15*4 + t16*5 ;

    var result= tot%11;
    result=(11-result)%10;
    if (result!=t17) {ok=false; return ok;}

    return ok;

}
/* ▲ 주민등록번호 체크 */


/* ▼ 사업자등록번호 체크 */
function check_busino(vencod){
    var sum = 0;
    var getlist = new Array(10);
    var chkvalue =new Array("1","3","7","1","3","7","1","3","5");
    try{
        for(var i=0; i<10; i++){
            getlist[i] = vencod.substring(i, i+1);
        }
        for(var i=0; i<9; i++) {
            sum += getlist[i]*chkvalue[i];
        }
        sum = sum + parseInt((getlist[8]*5)/10);
        sidliy = sum % 10;
        sidchk = 0;

        if(sidliy != 0){
            sidchk = 10 - sidliy;
        }else{
            sidchk = 0;
        }

        if(sidchk != getlist[9]){
            return false;
        }
        return true;
    }catch(e){
        return false;
    }
}
/* ▲ 사업자등록번호 체크 */

/* ▼ 거래취소사유 선택 */
function cancel_select(regData)
{
    var cancelDetail = $('#cancelDetail');

    $('#CANCEL_DETAIL_CONTENT').val(obj_content_text);

    $('#CANCEL_DETAIL_CONTENT').bind({
        focus : function() {
            if($(this).val() == obj_content_text) { $(this).val(''); }
        },
        blur : function() {
            if($(this).val().isEmpty()) { $(this).val(obj_content_text); }
        }
    });

    if(regData == '4') {
        cancelDetail.show();
    }
    else {
        cancelDetail.hide();
    }
}
/* ▲ 거래취소사유 선택 */

/* ▼ 다른글꼴로보기 */
function fnDifferentFacePopup(buyercharacter)
{
    if(arguments.length != 1 || arguments[0] === 'undefiend') return;

    var sellerid = null;
    var INPUT = null;
    var frm = null;
    this.buyerid = buyercharacter;

    frm = $("#frmDiffer");

    INPUT = $('<INPUT />', {
        type	: "hidden",
        name	: "buyer_id",
        value	: this.buyerid
    }).appendTo(frm);

    _window.open('buyeridview','',440,240);
    frm.attr({
        target	: "buyeridview",
        action	: "sell_ing_view_name.html"
    }).submit();
}
/* ▲ 다른글꼴로보기 */

function fnCreditViewCheck(){
    var infoId = $('#infoId').val();
    var params = 'id='+infoId;

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

// 휴대폰번호 등록하기, 등록된 휴대폰번호 변경하기
function fnPaymentPhone(tId, tType) {
    if (!confirm('휴대폰번호 출금 신규 등록 또는 변경 후 다시 인계확인을 진행해 주시기바랍니다.')) {
        return;
    }

    location.href	= '/myroom/myinfo/payment_phone_set.html?trade_id=' + tId + '&trade_type=' + tType;
}

/* ▼ 다시보지 않음 */
function newSetDeny(strName) {
    if(this.checked === true) {
        _cookie.add(strName, 'deny', 365, '/');
    }
    else {
        _cookie.remove(strName);
    }
}
/* ▲ 다시보지않음 */
