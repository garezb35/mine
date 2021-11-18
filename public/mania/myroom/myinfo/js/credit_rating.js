function _init() {
//	StartSmartUpdate();
}

function cardauth(mode) {
    _window.open('mobile_certify', '/certify/ini_pubauth/pub_auth_request?wis=CI', 430, 700);
}

function fnipin() {
    $("#reqCBAForm").submit();
}

function fnCredit_vip() {
    _window.open('credit_vip', '/myroom/myinfo/popup/credit_vip', 510, 600);
}

function Fncredit_ajax(nGiftType) {

    if (nGiftType == '' && nGiftType != '9') {
        alert('상품을 선택해주세요.');
        return false;
    }

    fnAjax("/api/myroom/myinfo/credit_rating_ok", "text", "post", "type=" + nGiftType, {
        complete: function(data) {
            var returnData = data.split(";");
            switch (returnData[0]) {
                case "Empty" :
                    alert("잘못된 접근입니다.");
                    break;
                case "CreditNo" :
                    alert("신용등급을 업데이트하지 못했습니다. 관리자에게 문의해 주세요.");
                    break;
                case "CreditNo2" :
                    alert("신용등급을 가져오지 못했습니다. 관리자에게 문의해 주세요.");
                    break;
                case "EnterNo" :
                    alert("기업회원 데이터를 찾을 수 없습니다. 관리자에게 문의해 주세요.");
                    break;
                case "Dberror" :
                    alert("서비스가 원할하지 않습니다. 잠시 후 이용해주세요");
                    break;
                case "Overlap" :
                    if (returnData[1] == 1) {
                        alert("이미 무료이용권을 발급 받으셨습니다.");
                    } else {
                        alert("이미 옥션입찰권을 발급 받으셨습니다");
                    }
                    break
                case "Rowerror" :
                    alert("프리미엄 이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror2" :
                    alert("물품강조 이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror3" :
                    alert("옥션입찰권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror4" :
                    alert("출금 무료이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Success" :
                    _window.open('loading', '/myroom/myinfo/popup/user_charge.html?type=' + returnData[1], 380, 268);
                    break;
                case "IncreaseRequestError3" :
                    alert("같은 등급은 신청하실 수 없습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestError4" :
                    alert("이미 신청하셨습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestError6" :
                    alert("VIP 등급 신청조건에 만족하지 않습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestError7" :
                    alert("VIP 등급 신청조건에 만족하지 않습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestError8" :
                    alert("VIP 등급 신청조건에 만족하지 않습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestError9" :
                    alert("VIP 등급 신청조건에 만족하지 않습니다.");
                    opener.location.reload();
                    self.close();
                    break;
                case "IncreaseRequestSuccess" :
                    alert("신청되었습니다.");
                    opener.location.reload();
                    self.close();
                    break;
            }
        },
        error: function() {
            alert("시스템 점검중입니다. 잠시 후 이용해 주세요.");
        }
    });

}

function fnemail(){
    if (confirm($('#user_email').val() + '에 인증메일 발송 하시겠습니까?')) {
        fnAjax('/api/certify/email/sendmail', 'xml', 'POST', '', {
            complete: function (res) {
                if ($(res).find('result').attr('type') == 'fail') {
                    alert($(res).find('result').attr('message'));
                } else if ($(res).find('result').attr('type') == 'success') {
                    _window.open('auth_mail', '/certify/email/sendmail_ok.php', 440, 260);
                }
            },
            error: function () {
                alert('시스템 점검중입니다. 잠시 후 이용해 주세요.');
            }
        });
    }else{
        location.href='/myroom/myinfo/myinfo_check';
    }
}

function FnSsadaCouponIssue_ajax(){
    fnAjax("/api/myroom/myinfo/credit_rating_ssada_coupon_issue", "json", "post", "", {
        complete: function(data) {
            alert(data.message);
        },
        error: function(err) {
            alert("시스템 점검중입니다. 잠시 후 이용해 주세요.");
        }
    });
}

