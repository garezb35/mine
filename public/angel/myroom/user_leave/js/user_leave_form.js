var checker = null;
var reasonCode = '';
function _init(){
    var frm = $("#signForm");
    if(frm.length > 0) {
        checker = new _form_checker(frm);
        checker.add({inputObj:$("#user_passwd"), protect:true, strType:'string', message:'비밀번호를 입력해 주세요.'});
        checker.add({
            custom : function() {
                if($('#leave_no').length > 0) {
                    return false;
                }
                if($('#leave_check').length > 0) {
                    if($('[name=out_agree]').val() != 'on') {
                        alert('마일리지 삭감처리에 동의하셔야 탈퇴신청이 가능합니다.');
                        $('#leave_check').trigger('click');
                        return false;
                    }
                }
                return true;
            }
        });
    }

    if($('#cancelForm').length > 0) {
        $('#cancelForm').submit(function(){
            if($(this).find('[type="checkbox"]:checked').length < 1) {
                alert('불편 개선 신청사항을 선택해주세요.');
                return false;
            }
        });
    }

    if($('#reasonForm').length > 0) {
        var leaveReasonDetail = $('#leave_reason_detail'),
            reasonForm = $('#reasonForm'),
            leaveReason = reasonForm.find('[name="leave_reason"]');

        leaveReason.on({
            click : function(){
                if(this.checked == true) {
                    reasonCode = this.value;
                }

                if(this.value != '4' && !leaveReasonDetail.val().isEmpty()) {
                    leaveReasonDetail.val('');
                }
            }
        });

        leaveReasonDetail.on({
            keyup : function(){
                if(reasonCode != '4' && !this.value.isEmpty()) {
                    reasonCode = '4';
                    reasonForm.find('[name="leave_reason"][value="4"]')[0].checked = true;
                }
            }
        });

        reasonForm.submit(function(){
            var checkedReason = $(this).find('[name="leave_reason"]:checked');
            if(checkedReason.length < 1) {
                alert('서비스 이용중 불편사항을 선택해주세요.');
                return false;
            }

            if(checkedReason[0].value == '4') {
                if(leaveReasonDetail.val().isEmpty()) {
                    alert('기타 사유를 입력해주세요.');
                    leaveReasonDetail.focus();
                    return false;
                }
                if(leaveReasonDetail.val().length < 10) {
                    alert('내용은 10자 이상으로 입력해 주세요.');
                    leaveReasonDetail.focus();
                    return false;
                }
            }
            _window.open('user_leave', '', 450,280);
            this.target = 'user_leave';
        });
    }
}
