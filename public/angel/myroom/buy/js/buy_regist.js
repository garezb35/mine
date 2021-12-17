
function tradeProcess(flag, tid) {

    var confirmMsg;
    if (flag == 'showSelect') {
        confirmMsg = '물품을 숨김해제 하시겠습니까?';
    } else if(flag == "hideSelect"){
        confirmMsg = "물품을 숨기시겠습니까?";
    } else if (flag === 'deleteSelect') {
        confirmMsg = "해당 물품을 삭제하시겠습니까?";
    } else if (flag === 'deleteSelectAll') {
        confirmMsg = "삭제하시겠습니까 ?";
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
    frm.attr("action", "/buy_regist");
    frm.submit();
}


function reInsert(tid) {
    if (confirm("재등록 하시겠습니까?")) {
        var frm = $("#reInsertFrm");
        frm.find("[name='id']").val(tid);
        frm.attr("action", "buy_re_reg_auto_ok.php");
        frm.submit();
    }
}

