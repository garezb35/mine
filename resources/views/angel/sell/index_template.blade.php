<tr>
    <th>판매수량</th>
    <td>
        <div class="unit_type" id="unit_type">
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
            <label class="text-blue_modern f_small">(단위)</label>
        </div>
        <div id="game_money">
            최소
            <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="angel__text text_right">
            <span class="unit"></span> 게임머니 ~
            최대
            <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="angel__text text_right">
            <span class="unit"></span> 게임머니
        </div>
    </td>
</tr>
<tr>
    <th>판매금액</th>
    <td>
        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="angel__text text_right" size="18">
        <span class="unit"></span> 게임머니 당
        <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="angel__text text_right" size="18"> 원에 판매합니다.
        <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
        <div class="discount">
            <label><input type="checkbox" class="angel_game_sel" name="discount_use" id="discount_use" value="1" onclick="ComplexDiscount();">복수구매 할인적용</label>
            <div id="reven_discount">
                <input type="text" class="angel__text" name="discount_quantity" id="discount_quantity" maxlength="10" disabled readonly onfocus="$(this).blur();"><span class="unit"></span> x
                <input type="text" class="angel__text discount_quantity_cnt" name="discount_quantity_cnt" id="discount_quantity_cnt" maxlength="10" disabled>번 구매시
                <input type="text" class="angel__text discount_price" name="discount_pri ce" id="discount_price" maxlength="10" disabled>원 할인
            </div>
        </div>
    </td>
</tr>
<tr>
    <th>캐릭터명</th>
    <td>
        <div class="dfServer" id="dfServer">
        </div>
        <div class="float-left">
            <input type="text" class="angel__text mode-active" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
            <span id="sub_text" class="text-rock"></span>
        </div>
        <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
    </td>
</tr>
