<tr>
    <th>판매수량</th>
    <td>
        <div class="unit_type" id="unit_type">
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
            <label class="f_blue1 f_small">(단위)</label>
        </div>
        <div id="game_money">
            최소
            <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="g_text f_right">
            <span class="unit"></span> 게임머니 ~
            최대
            <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="g_text f_right">
            <span class="unit"></span> 게임머니                </div>
    </td>
</tr>
<tr>
    <th>판매금액</th>
    <td>
        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="g_text f_right" size="18">
        <span class="unit"></span> 게임머니 당
        <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="g_text f_right" size="18"> 원에 판매합니다.
        <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
        <div class="discount">
            <label><input type="checkbox" class="g_checkbox" name="discount_use" id="discount_use" value="1" onclick="fnRevenDiscount();">복수구매 할인적용</label>
            <div id="reven_discount">
                <input type="text" class="g_text" name="discount_quantity" id="discount_quantity" maxlength="10" disabled readonly onfocus="$(this).blur();"><span class="unit"></span> x
                <input type="text" class="g_text discount_quantity_cnt" name="discount_quantity_cnt" id="discount_quantity_cnt" maxlength="10" disabled>번 구매시
                <input type="text" class="g_text discount_price" name="discount_price" id="discount_price" maxlength="10" disabled>원 할인
            </div>
            <a href="javascript:;" class="guide_txt" id="discount_guide">복수구매할인이란?</a>
            <div class="g_msgbox blue" id="discount_layer">
                <div class="title">복수 구매할인이란?</div>
                <div class="cont">
                    구매자가 분할물품에 구매신청을 할 때, 판매자가 정해놓은 일정 구매수량 조건을<br>
                    충족할 경우 구매자에게 거래금액을 할인해주는 거래 방식입니다.<br>
                    복수구매할인 적용 시 물품리스트 제목에 할인마크가 부여되며 묶음당 할인금액은<br>
                    판매자의 거래금액에서 차감됩니다.<br>
                    복수구매 할인에 대한 자세한 사항은 홈페이지 > 이용안내를 참고해 주시기 바랍니다.
                </div>
                <div class="btn">
                    <a href="/guide/div_trade/index.html?file=02" class="btn_blue4">복수구매할인 이용안내 ></a>
                </div>
            </div>
        </div>
    </td>
</tr>
<tr>
    <th>캐릭터명</th>
    <td>
        <div class="dfServer" id="dfServer">
        </div>
        <div class="g_left">
            <input type="text" class="g_text mode-active" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
            <span id="sub_text" class="f_red1"></span>
        </div>
        <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
    </td>
</tr>
