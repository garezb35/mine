@foreach($games as $v)
    @php
        $href = "";
        if($type == 0){
            $href = "/myroom/sell/sell_regist_view?id=".$v['orderNo'];
        }
        if($type == 1){
            $href = route('sell_check_view')."?id=".$v['orderNo']."&type=".$v['type'];
        }
        if($type == 2){
            $href = route('sell_pay_wait_view')."?id=".$v['orderNo']."&type=".$v['type'];
        }
        if($type == 3){
            $href = route('sell_ing_view')."?id=".$v['orderNo']."&type=".$v['type'];
        }
        $gamemoney_unit = !empty($v['gamemoney_unit']) & $v['gamemoney_unit'] != 1 ? $v['gamemoney_unit'] : '';
        $price = number_format($v['user_price']);
    @endphp
    @if($v['user_goods_type'] == 'division')
        @php
            $price = number_format($v['user_division_unit']).$gamemoney_unit.'개당 '.number_format($v['user_division_price']);
        @endphp
    @endif
    <tr>
        <td class="first"><a href='/sell/list_search?search_type=sell&filtered_items=all&filtered_game_id={{$v['game']['id']}}&filtered_game_alias={{$v['game']['game']}}&filtered_child_id={{$v['Server']['id']}}&filtered_child_alias={{$v['Server']['id']}}'><strong>{{$v['game']['game']}}</strong>  <br />{{$v['Server']['game']}}</a></td>
        <td>{{$v['good_type']}}</td>
        <td class="left">
            <input type="hidden" name="check[]" value="{{$v['orderNo']}}">
            @if($v['status'] == 2 || $v['status'] == 3 || $v['status'] == 1)
            <span class="attached_noti">거래중</span><br>
            @endif
            <div class="trade_title">
                <a href="{{$href}}">{{$v['user_title']}}</a>
            </div>
        </td>
        <td class="right text-rock">{{$price}}원</td>
        <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
        @if($type == 0)
            <td>
                @if(empty($v['payitem']) && $v['status'] == 0 && empty($v['toId']) && $v['userId'] == $me['id'])
                <a href="javascript:;" onclick="reInsert('{{$v['orderNo']}}');" class="regist_btn09">재등록</a>
                <a href="javascript:;" onclick="tradeProcess('deleteSelect', '{{$v['orderNo']}}')" class="regist_btn10">삭제</a>
                @endif
                @if($v['status'] == 23 || $v['status'] == 32)
                <span>판매완료</span>
                @endif
            </td>
        @endif
        @if($type == 1)
            <td>
                <a href="{{$href}}"  class="btn-default-medium btn-suc-rect">물품보기</a>
            </td>
        @endif
    </tr>
@endforeach
