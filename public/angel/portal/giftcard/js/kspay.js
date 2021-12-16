
function FormatNumber2(num) {
    var fl = '';

    if(isNaN(num)) {
        alert('문자는 사용할 수 없습니다.');
        return 0;
    }

    if(num == 0) {
        return num;
    }

    if(num < 0) {
        num = num * (-1);
        fl = '-';
    }
    else {
        num = num * 1;
    }

    num	= new String(num);

    var temp = '';
    var co = 3;
    var num_len = num.length;

    while(num_len > 0) {
        num_len = num_len - co;

        if(num_len < 0) {
            co = num_len + co;
            num_len	= 0;
        }

        temp = ',' + num.substr(num_len, co) + temp;
    }

    return fl + temp.substr(1);
}

function NumberFormat(num) {
    var num = new String(num);
    num = num.replace(/,/gi, '');

    return FormatNumber2(num);
}

function CalcMoney(pMode) {
    var money = 0;
    var j = [];
    var objSelect = $('select');
    var card_val = 'false';

    $.each(objSelect, function(i, v) {
        j.push($(v).attr('name').replace('bill', ''));
    });

    for(var i=0; i<j.length; i++) {
        money += $('select :selected').eq(i).val() * j[i];
    }

    if(money > 0) {
        card_val = 'true';
    }

    $('[name="card"]').val(card_val);


    if(eventPromotion == true) {
        money = money - (money * (eventDiscount/100));
    }


    if(money > user_Totmile) {
        alert('마일리지가 부족합니다!');

        $('select').find('option:eq(0)').attr('selected', true);
        $('[name="bookWon"]').val('-');
        $('[name="mileageWon"]').val('-');
        $('[name="cash_amount_txt"]').val('');
    }
    else {
        $('[name="bookWon"]').val(NumberFormat(money) + '원');
        $('[name="mileageWon"]').val(NumberFormat(user_Totmile - money) + '원');
        $('[name="cash_amount_txt"]').val(money);
    }
}

var b_check = false;

$(function () {
    g_fnSECURITY();

    $('#giftcard_btn').on({
        click : function () {
            if (b_check) {
                return false;
            }

            b_check = true;

            if($(':selected[value=""]').length >= $('select').length) {
                alert('구매하실 상품권을 선택해주세요.');

                b_check = false;

                return false;
            }

            $('[class="btn-groups_angel"]').hide();
            $('#loding').show();

            $('#buy_form').submit();

            b_check = false;
        }
    });
});
