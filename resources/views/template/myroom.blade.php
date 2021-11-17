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
        <td class="first"><a href='/sell/list_search?search_type=sell&search_goods=all&search_game={{$v['game']['id']}}&search_game_text={{$v['game']['game']}}&search_server={{$v['Server']['id']}}&search_server_text={{$v['Server']['id']}}'><strong>{{$v['game']['game']}}</strong>  <br />{{$v['Server']['game']}}</a></td>
        <td>{{$v['good_type']}}</td>
        <td class="left">
            <input type="hidden" name="check[]" value="{{$v['orderNo']}}">
            <div class="trade_title"><a href="{{$href}}">{{$v['user_title']}}</a> </div>
        </td>
        <td class="right f_red1">{{$price}}원</td>
        <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
        @if($type == 0)
            <td><a href="javascript:;" onclick="reInsert('{{$v['orderNo']}}');" class="regist_btn09">재등록</a><a href="javascript:;" onclick="tradeProcess('deleteSelect', '{{$v['orderNo']}}')" class="regist_btn10">삭제</a></td>
        @endif
    </tr>
@endforeach
