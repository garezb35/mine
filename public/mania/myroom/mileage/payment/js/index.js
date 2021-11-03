/*
 * @title			ë§ˆì¼ë¦¬ì§€ ì¶œê¸ˆìš”ì²­
 * @author			ìž¥ì›ì§„
 * @date			2012.03.26
 * @update			2013.02.07 - ë²• ê°œì •ì— ë”°ë¥¸ ì‚¬ì´íŠ¸ ê°œì„ (ê¹€í˜„ì§„)
 * @description
 */

function _init()
{
    var frm = $('#frmPayment');
    checker = new _form_checker(frm);
    checker.add({inputObj:$("#mileage"), protect:true, strType:'price', message:'ì¶œê¸ˆê¸ˆì•¡ì„ ìž…ë ¥í•˜ì„¸ìš”!'});
    checker.add({custom:function(){
            //ì¶œê¸ˆê³„ì¢Œì²´í¬
            if(bankTextCheck == "NO"){
                alert('ì¶œê¸ˆê³„ì¢Œ ìˆ˜ì •ì—ì„œ ê³„ì¢Œì •ë³´ë¥¼ ë“±ë¡í•˜ì„¸ìš”.');
                return false;
            }
            if(PaymentInfo_type2 == "N"){
                alert(PaymentInfo_type2_mess);
                return false;
            }

            //ì¶œê¸ˆê°€ëŠ¥ì‹œê°„ ì²´í¬
            if(PaymentInfo_startTime > PaymentInfo_NowTime || PaymentInfo_endTime <= PaymentInfo_NowTime){
                alert('ì£„ì†¡í•©ë‹ˆë‹¤\n\nì§€ê¸ˆ ë§ˆì¼ë¦¬ì§€ ì¶œê¸ˆ ì´ìš©ì‹œê°„ì´ ì•„ë‹™ë‹ˆë‹¤.\n\nì¶œê¸ˆ ê°€ëŠ¥ì‹œê°„ì„ í™•ì¸í•˜ì„¸ìš”!');
                return false;
            }

            //ì¶œê¸ˆê¸ˆì§€ì€í–‰ì¼ë•Œì²˜ë¦¬
            var bankCnt;
            var grBankCode = PaymentInfo_notBankCode.split(',');

            for(i=0; i<grBankCode.length ; i++){
                if(grBankCode[i] == PaymentInfo_userBankCode){
                    bankCnt++;
                }
            }
            if(bankCnt > 0){
                alert('ì€í–‰ëª… : '+PaymentInfo_userBankName+"\n\nì„œë²„ì ê²€ìœ¼ë¡œ ì†¡ê¸ˆì´ ë¶ˆê°€ëŠ¥í•©ë‹ˆë‹¤.\n\nìž ì‹œ í›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                return false;
            }

            if($("#enable_mileage").val() == 0 || parseInt($("#enable_mileage").val())<1){
                alert('ì¶œê¸ˆ ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€ê°€ ì—†ìŠµë‹ˆë‹¤.');
                return false;
            }
            mileage_val = $("#mileage").val().replace(/,/gi,'');
            //	mileage_val = $("#spnPayment_mileage").val().replace(/,/gi,'');

            if(parseInt(mileage_val) < 2000){
                alert('ìµœì†Œ ì¶œê¸ˆê¸ˆì•¡ì€ 2,000ì›ìž…ë‹ˆë‹¤! ');
                $("#mileage").focus();
                return false;
            }

            if(parseInt($("#enable_mileage").val())<parseInt(mileage_val))
            {
                alert('ì¶œê¸ˆí•˜ì‹¤ ë§ˆì¼ë¦¬ì§€ê°€ ì¶œê¸ˆ ê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€ë³´ë‹¤ ë§ŽìŠµë‹ˆë‹¤.');
                $("#mileage").val('0');
                $("#spnPayment_mileage").text('0');
                $("#mileage").focus();
                return false;
            }

            var msg = "ì€í–‰ëª… : "+PaymentInfo_userBankName+"\n\n "+ Number(mileage_val).currency();
            msg = msg+" ì› \n\në§ˆì¼ë¦¬ì§€ ì¶œê¸ˆ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?";

            var tmp=inBankModule.split(":");
            var gotoAJAXUrl='';

            if(tmp[0] == "inicis"){
                gotoAJAXUrl = "/myroom/mileage/payment/payment_directly_inicis_AJAX.php";
            }else if(tmp[0] == "settlebank"){
                gotoAJAXUrl = "/myroom/mileage/payment/payment_directly_settlebank_AJAX.php";
            }else if(tmp[0] == "ksnet"){
                gotoAJAXUrl = "/myroom/mileage/payment/payment_directly_ksnet_AJAX.php";
            }else if(tmp[0] == "duzn"){
                gotoAJAXUrl = "/myroom/mileage/payment/payment_directly_duzn_AJAX.php";
            }else{
                gotoAJAXUrl = "payment_directly_settlebank_AJAX.php";
            }

            if(confirm(msg)){
                $.ajax({
                    url : gotoAJAXUrl,
                    dataType: "html",
                    type: "POST",
                    data : "outMileage="+Number(mileage_val)+"&bankCode="+tmp[1],
                    success:function(data) {
                        var returnData = data.split(";");

                        if(returnData[0]=="true"){
                            alert(returnData[1]);
                            location.reload();	// ì¶”í›„ì— ë§ˆì¼ë¦¬ì§€ ë³€ë™ë‚´ì—­ìœ¼ë¡œ ì´ë™
                            //location.href='';
                        }else{
                            alert(returnData[1]);

                            if(returnData[2] == '01'){
                                location.href = '/myroom/mileage/payment_guide.html';
                            }else{
                                location.reload();
                            }
                        }
                    },
                    error: function(){
                        alert('ë©”ì‹œì§€ë¥¼ ë¶ˆëŸ¬ì˜¤ì§€ ëª»í–ˆìŠµë‹ˆë‹¤.\n\në‹¤ì‹œ ì‹œë„í•´ ì£¼ì„¸ìš”.');
                        window.location.reload();
                    }
                });
            }
        }});

    _form.protect.price($("#mileage"));

    $("#mileage").keyup(function(){
        var	 mileage = parseInt($("#mileage").val()); //ìž…ë ¥ëœ ë§ˆì¼ë¦¬ì§€
        var	 total_mileage = parseInt($("#total_mileage").val()); //ì¶œê¸ˆê°€ëŠ¥í•œ ë§ˆì¼ë¦¬ì§€
        var chargeType = false;
        if ($("#charge").val() == ""){
            $("#charge").val("0");
        }

        $("#spnPayment_charge").html('');
        if ($("#creditrating").val() > 0){
            if ($("#creditrating").val() > $("#dailycount").val()){
                chargeType = true;
                $("#spnPayment_charge").html("<span class=\"btn_red1\">ì¶œê¸ˆ ìˆ˜ìˆ˜ë£Œ ë¬´ë£Œ ì ìš©</span>");
            }else{
                chargeType = false;
            }
        }if(e_use_payment > 0 && parseInt($("#charge").val()) != 0){
            chargeType = true;
            $("#spnPayment_charge").html("(* ë§ˆì¼ë¦¬ì§€ì¶œê¸ˆë¬´ë£Œì´ìš©ê¶Œ 1ë§¤ì‚¬ìš©(ìž”ì—¬:"+e_use_payment+"íšŒ))");
        }

        if (!chargeType){
            $("#spnPayment_charge").html("(ì¶œê¸ˆ ìˆ˜ìˆ˜ë£Œ : "+parseInt($("#charge").val()).currency()+"ì›)");
        }

        mileage_val = $("#mileage").val().replace(/,/gi,'');

        if (!chargeType){
            comma_mileage = addComma(parseInt(mileage_val)-parseInt($("#charge").val()));
        }else{
            comma_mileage = addComma(parseInt(mileage_val));
        }

        if ($("#mileage").val() == 0 || $("#mileage").val().isEmpty()){
            $("#spnPayment_mileage").text('0');
        }else{
            $("#spnPayment_mileage").text(comma_mileage);
        }
    });

    $('#bankmodify_btn').click(function () {
        _window.open('bankaccount_modify', 'https://'+ document.domain +'/myroom/mileage/payment/popup/bankaccount_modify_ssl.html', 660, 400);
    });

    if(document.getElementById('guide_txt') !== null) {
        LayerControl({
            el: document.getElementById('guide_txt'),
            layer: document.getElementById('guide_info'),
            close_btn : document.getElementById('guide_info').querySelector('.close'),
            mask: false,
            type: 'style'
        });
    }
}

function addComma(values){
    var	str_values = ""+values+"";
    var	val = str_values.replace(/,/gi,'');
    var	pattern	= /(-?[0-9]+)([0-9]{3})/;
    while (pattern.test(val)){
        val = val.replace(pattern, "$1,$2");
    }
    return val;
}
