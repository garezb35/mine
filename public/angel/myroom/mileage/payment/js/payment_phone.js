/*
 * @title		ë§ˆì¼ë¦¬ì§€ ì¶œê¸ˆ > íœ´ëŒ€í°ë²ˆí˜¸ ì¶œê¸ˆ(í‹°ìºì‹œ)
 * @author		[F/E]ê¹€í˜„ì§„
 * @date		2016.04.06
 * @update
 * @description
 */

$('#mileage').focus();

_form.protect.price($('#mileage'));

// ë“±ë¡í•˜ê¸°
$('#btn_reg').on({
    click: function (){
        var phoneReg = window.open('payment_phone_certify.html', 'phoneReg', 'height=500,width=500,status=no,toolbar=no,menubar=no,location=no,fullscreen=no,scrollbars=no,resizable=no,titlebar=no,left=300,top=100');

        var objInterval = setInterval(function () {
            if (phoneReg.closed) {
                g_nodeSleep.disable();

                clearInterval(objInterval);
            }
        }, 500);
    }
});

// ë§ˆì¼ë¦¬ì§€ ì¶œê¸ˆ
var bAjax	= false;

$('#btn_payment').on({
    click: function (){
        var paymentFrm			= $('#payment'),
            mileage				= paymentFrm.find('#mileage'),	// ì¶œê¸ˆí•  ë§ˆì¼ë¦¬ì§€
            enableMileage		= paymentFrm.find('#enable_mileage'),	// ì¶œê¸ˆê°€ëŠ¥ ë§ˆì¼ë¦¬ì§€
            spnPaymentMileage	= paymentFrm.find('#spnPayment_mileage'),	// ì‹¤ì œ ì¶œê¸ˆ ë§ˆì¼ë¦¬ì§€
            mileageMoney        = $('.mileage_money'),
            nMileage			= parseInt(mileage.val().replace(/[^0-9]/gi, '')),
            nSeq				= paymentFrm.find('[name=seq]');

        nMileage	= isNaN(nMileage) ? 0 : nMileage;

        if (nSeq.val() < 1){
            alert('íœ´ëŒ€í° ë²ˆí˜¸ë¥¼ ë“±ë¡í›„ ì¶œê¸ˆì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.');

            return;
        }

        if(enableMileage.val() == 0 || parseInt(enableMileage.val()) < 1){
            alert('ì¶œê¸ˆ ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€ê°€ ì—†ìŠµë‹ˆë‹¤.');

            return;
        }

        if (isNaN(nMileage) || nMileage < 2000){
            alert('ìµœì†Œ ì¶œê¸ˆê¸ˆì•¡ì€ 2,000ì›ìž…ë‹ˆë‹¤!');

            mileage.val('').focus();

            return;
        }

        if (nMileage % 100 > 0){
            alert('100ì› ë‹¨ìœ„ë¡œ ì‹ ì²­ ê°€ëŠ¥í•©ë‹ˆë‹¤.');

            mileage.val('').focus();

            return;
        }

        if (parseInt(enableMileage.val()) < nMileage){
            alert('ì¶œê¸ˆí•˜ì‹¤ ë§ˆì¼ë¦¬ì§€ê°€ ì¶œê¸ˆ ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€ë³´ë‹¤ ë§ŽìŠµë‹ˆë‹¤.');

            spnPaymentMileage.text('0');
            mileageMoney.text(0);
            mileage.val('').focus();

            return;
        }

        if (bAjax){
            alert('ì²˜ë¦¬ì¤‘ìž…ë‹ˆë‹¤.\nìž ì‹œë§Œ ê¸°ë‹¤ë ¤ì£¼ì„¸ìš”.');

            return;
        }

        bAjax	= true;

        if (confirm(mileage.val() + ' ì› \në§ˆì¼ë¦¬ì§€ë¥¼ íœ´ëŒ€í°ë²ˆí˜¸ ì¶œê¸ˆ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?')){
            $.ajax({
                url: 'payment_directly_tcash_AJAX.php',
                dataType: 'html',
                type: 'post',
                data: 'outMileage=' + nMileage + '&seq=' + nSeq.val(),
                success: function(r){
                    var result = r.split(';');

                    alert(result[1]);

                    if (result[0] == 'true'){
                        location.reload();
                    }
                    else{
                        if (result[2] == '01'){
                            location.href = '/myroom/mileage/payment_guide.html';
                        }
                        else{
                            location.reload();
                        }
                    }

                    bAjax	= false;
                },
                error: function(){
                    alert('ë©”ì‹œì§€ë¥¼ ë¶ˆëŸ¬ì˜¤ì§€ ëª»í–ˆìŠµë‹ˆë‹¤.\n\në‹¤ì‹œ ì‹œë„í•´ ì£¼ì„¸ìš”.');

                    bAjax	= false;

                    window.location.reload();
                }
            });
        }
        else{
            bAjax	= false;
        }
    }
});

// ì¶œê¸ˆí•  ë§ˆì¼ë¦¬ì§€ ì²´í¬
$('#mileage').on({
    keyup: function (){
        var mileage				= $(this),	// ì¶œê¸ˆí•  ë§ˆì¼ë¦¬ì§€
            enableMileage		= $('#enable_mileage'),	// ì¶œê¸ˆê°€ëŠ¥ ë§ˆì¼ë¦¬ì§€
            spnPaymentMileage	= $('#spnPayment_mileage'),	// ì‹¤ì œ ì¶œê¸ˆ ë§ˆì¼ë¦¬ì§€
            spnPaymentCharge	= $('#spnPayment_charge'),	// ì¶œê¸ˆ ìˆ˜ìˆ˜ë£Œ
            mileageMoney        = $('.mileage_money'),
            nMileage			= parseInt(mileage.val().replace(/[^0-9]/gi, '')),
            nEnableMileage		= parseInt(enableMileage.val().replace(/[^0-9]/gi, '')),
            nSpnPaymentCharge	= parseInt(spnPaymentCharge.text().replace(/[^0-9]/gi, ''));

        nMileage		    = isNaN(nMileage) ? 0 : nMileage;
        nEnableMileage	    = isNaN(nEnableMileage) ? 0 : nEnableMileage;
        nSpnPaymentCharge   = isNaN(nSpnPaymentCharge) ? 0 : nSpnPaymentCharge;

        if (nMileage > nEnableMileage){
            alert('ì¶œê¸ˆí•˜ì‹¤ ë§ˆì¼ë¦¬ì§€ê°€ ì¶œê¸ˆ ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€ë³´ë‹¤ ë§ŽìŠµë‹ˆë‹¤.');

            mileage.val('').focus();
            spnPaymentMileage.text(0);
            mileageMoney.text(0);

            return;
        }

        if (nMileage >= 2000) {
            spnPaymentMileage.text(Number(nMileage - nSpnPaymentCharge).currency());
            mileageMoney.text(Number(nMileage - nSpnPaymentCharge).currency());
        }
        else{
            spnPaymentMileage.text(0);
            mileageMoney.text(0);
        }
    }
});
