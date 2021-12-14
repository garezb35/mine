
var g_trade_info = {
    id: null,
    subject: null,
    price: null,
    coupon: null,
    coupon_price: null,
    node: null,
    nodePrice: null,
    OnSelect: applyCoupon
};

function _init() {

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

function applyCoupon() {
    var frm = $('#frmBaPayment');

    var paymentPrice = 0;

    paymentPrice = this.price - this.coupon_price;

    $('#pay_mileage').text(paymentPrice.currency());
    frm.find('input[name="pay_mileage"]').val(paymentPrice.currency());
}

function TradeCheck(process, check_id) {
    var frm = $('#frmCheckView');
    frm.find('input[name="id"]').val(check_id);
    frm.find('input[name="process"]').val(process);
    frm.attr('action', "/buy_check_ok").submit();
}

function Payment() {
    var frm = $('#frmBaPayment');

    var myMileage = frm.find('input[name="my_mileage"]').val();
    myMileage = myMileage.replace(/[,]+/g, "");

    var useMileage = frm.find('#pay_mileage').text();
    useMileage = useMileage.replace(/[,]+/g, "");

    if (Number(myMileage) < Number(useMileage)) {
        alert("구매할 수 있는 마일리지가 부족합니다.");
        return;
    }

    if (!confirm("결제하시겠습니까?")) {
        return;
    }

    g_trade_info.node = frm.find('input[name="use_coupon"]');
    g_trade_info.nodePrice = $('#use_coupon_price');

    // 마일리지 보유금액 체크
    var paramsTmp = 'req_type=trade';
    fnAjax('/_include/_remocon_mileage.php', 'xml', 'POST', paramsTmp, {
        complete: function(req) {

            var xml = _xml.getElement(req, "mileage", 0);
            if (!xml) {
                location.reload();
                return;
            }

            var payMileage = frm.find('input[name="use_mileage"]').val();
            payMileage = payMileage.replace(/[,]+/g, "");

            if (Number(xml.getAttribute("use").toString()) < Number(payMileage)) {
                alert("구매할 수 있는 마일리지가 부족합니다.");
                document.location.reload();
                return;
            }

            if ($('#security_type').val() != "PASS") {
                _window.open('pay', '', 600, 400);
                frm.attr({
                    target: "pay",
                    action: "/certify/payment/user_certify.html"
                }).submit();
                $('#g_SLEEP').show();
            } else {
                frm.attr({
                    target: "_self",
                    action: "/myroom/buy/buy_check_ok.php"
                }).submit();
            }
        }
    });
}

function fnCreditViewCheck() {
    var infoId = $('#infoId').val();
    var params = 'id=' + infoId;

    fnAjax('/user/credit_ajax.php?t=' + (new Date()).getTime(), 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');
            if (rgResult[0] == 'SUCCESS') {
                $('#encryptId').val(rgResult[1]);
                if (rgResult[2] && !rgResult[2].isEmpty()) {
                    $('#encryptType').val(rgResult[2]);
                }
                _window.open('credit_view', '', 570, 640);
                $('#creditForm').attr({
                    'target': 'credit_view',
                    'action': '/user/credit_view.html'
                }).submit();
            } else {
                alert(rgResult[1]);
            }
        }
    });
}
