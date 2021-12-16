
function tradeProcess(flag, tid) {

    var confirmMsg;
    if (flag == 'showSelect') {
        confirmMsg = '물품을 숨김해제 하시겠습니까?';
    } else if(flag == "hideSelect"){
        confirmMsg = "숨김기능 설정 후 24시간동안 숨김해제를 하지 않으시면 해당 물품은 자동으로 삭제됩니다.\n물품을 숨기시겠습니까?";
    } else if (flag === 'deleteSelect') {
        confirmMsg = "해당 물품을 삭제하시겠습니까?";
    } else if (flag === 'deleteSelectAll') {
        confirmMsg = "현재 보여지는 페이지의 물품 (최대 10개, 숨김포함) 삭제가 가능합니다.\n삭제하시겠습니까 ?";
        flag = 'deleteSelect';
    }

    if (!confirm(confirmMsg)) {
        return false;
    }

    var frm = $("#frmList");
    if (tid) {
        frm.find("[name='trade_id']").val(tid);
    }
    frm.find("[name='process']").val(flag);
    frm.attr("action", "/sell_regist");
    frm.submit();
}


function reInsert(tid) {
    if (confirm("재등록 하시겠습니까?")) {
        var frm = $("#reInsertFrm");
        frm.find("[name='id']").val(tid);
        frm.attr("action", "/sell_re_reg_auto_ok");
        frm.submit();
    }
}


