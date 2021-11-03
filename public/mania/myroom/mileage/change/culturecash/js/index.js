function _init() {

    var mileageEl = document.getElementById('mileage');
    var cultureId = document.getElementById('culture_id');
    var orderID = document.getElementById('oid');
    var cultureidCheck = document.getElementById('cultureid_check');
    var cultureName = document.getElementById('culture_name')
    var totalMileage = Number(document.getElementById('total_mileage').value.replace(/[^0-9]/g, ''));  //ì „í™˜ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€

    document.getElementById('btn_culture_id').addEventListener('click', function() {

        var cultureID = document.getElementById('culture_id').value;
        if (cultureID.isEmpty()) {
            alert('ì „í™˜ í•  ì»¬ì³ëžœë“œ IDë¥¼ ìž…ë ¥ í›„ í™•ì¸í•´ì£¼ì„¸ìš”.');
            return;
        }

        if (!confirm('ì»¬ì³ëžœë“œ ì•„ì´ë””ë¥¼ ì¡°íšŒí•˜ì‹œê² ìŠµë‹ˆê¹Œ?')) {
            return;
        }

        ajaxRequest({
            url: 'inquiryCultureName.html',
            dataType: 'json',
            type: 'post',
            data: 'cultureID='+cultureID,
            success: function(res) {

                if(res.result === 'SUCCESS') {
                    cultureName.parentNode.classList.remove('g_hidden');
                    cultureName.innerHTML = res.data;
                    orderID.value = res.oid;

                } else {
                    cultureName.parentNode.classList.add('g_hidden');
                    alert(res.msg);
//					cultureName.innerHTML = res.msg;
                }
            },
            error: function() {
                alert('ë©”ì‹œì§€ë¥¼ ë¶ˆëŸ¬ì˜¤ì§€ ëª»í–ˆìŠµë‹ˆë‹¤.\n\në‹¤ì‹œ ì‹œë„í•´ ì£¼ì„¸ìš”.');
                window.location.reload();
            }
        });
    });

    mileageEl.addEventListener('keyup', function() {
        var mileage = Number(this.value.replace(/[^0-9]/g, '')); //ìž…ë ¥ëœ ë§ˆì¼ë¦¬ì§€
        var expMileage = 0;

        if (mileage > 0) {
            expMileage = mileage;
        }

        document.getElementById('spnPayment_mileage').innerHTML = expMileage.currency();
    });

    cultureidCheck.addEventListener('click', function() {
        alert(cultureId.value + '(' + cultureName.innerHTML + ')\nìœ„ ì»¬ì³ëžœë“œ IDì •ë³´ë¥¼ í™•ì¸í•©ë‹ˆë‹¤.');
        return;
    });

    document.getElementById('exchange_btn').addEventListener('click', function() {
        var mileage = Number(mileageEl.value.replace(/[^0-9]/g, '')); //ìž…ë ¥ëœ ë§ˆì¼ë¦¬ì§€

        if (mileage === 0) {
            alert('ì „í™˜ í•  ê¸ˆì•¡ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
            mileageEl.focus();
            return;
        } else if (mileage < 1000) {
            alert('ìµœì†Œ 1,000ì› ì´ìƒ ì „í™˜ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
            mileageEl.focus();
            return;
        } else if (mileage > 1000000) {
            alert('1íšŒ 1,000,000ì› ì´í•˜ ì „í™˜ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
            mileageEl.focus();
            return;
        } else if (mileage > totalMileage) {
            alert('ì „í™˜í•  ë§ˆì¼ë¦¬ì§€ê°€ ë¶€ì¡±í•©ë‹ˆë‹¤.\n' +
                'ì¶©ì „ í›„ ì´ìš© ë¶€íƒë“œë¦½ë‹ˆë‹¤.');
            mileageEl.focus();
            return;
        }

        if (cultureidCheck.checked === false) {
            alert('ì»¬ì³ëžœë“œ ID ëª…ì˜ë¥¼ í™•ì¸ í•´ì£¼ì„¸ìš”.');
            return;
        }

        if (!confirm(cultureId.value + '(' + cultureName.innerHTML + ')\nìœ„ ì•„ì´ë””ë¡œ ì „í™˜ ë©ë‹ˆë‹¤.')) {
            return;
        }

        var securityType = document.getElementById('security_type').value;
        if (securityType !== 'PASS') {

            _window.open('pay', '', 600, 400, '', true);
            document.frmCertify.target = 'pay';
            document.frmCertify.action = '/certify/payment/user_certify.html';
            document.frmCertify.submit();

        } else {
            document.frmPayment.action = 'exchange.php';
            document.frmPayment.submit();
        }

    });

    document.frmPayment.onsubmit = function() {

//		var postData = $("#frmPayment").serialize();
//		ajaxRequest({
//			url: 'exchange.php',
//			dataType: 'json',
//			type: 'post',
//			data: postData,
//			success: function(res) {
//				alert(res.msg);
//				window.location.reload();
//			},
//			error: function() {
//				alert('ë©”ì‹œì§€ë¥¼ ë¶ˆëŸ¬ì˜¤ì§€ ëª»í–ˆìŠµë‹ˆë‹¤.\n\në‹¤ì‹œ ì‹œë„í•´ ì£¼ì„¸ìš”.');
//				window.location.reload();
//			}
//		});
    };

    Form.protect.price(mileageEl);
}
