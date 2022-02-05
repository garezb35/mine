@foreach($games as $v)
    @php
        $href = "";
        if($type == 0){
            $href = "/myroom/buy/buy_regist_view?id=".$v['orderNo'];
        }
        if($type == 1){
            $href = route('buy_check_view')."?id=".$v['orderNo']."&type=".$v['type'];
        }
        if($type == 2){
            $href = route('buy_pay_wait_view')."?id=".$v['orderNo']."&type=".$v['type'];
        }
        if($type == 3){
            $href = route('buy_ing_view')."?id=".$v['orderNo']."&type=".$v['type'];
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
        <td class="first"><a href='/buy/list_search?search_type=buy&filtered_items=all&filtered_game_id={{$v['game']['id']}}&filtered_game_alias={{$v['game']['game']}}&filtered_child_id={{$v['Server']['id']}}&filtered_child_alias={{$v['Server']['id']}}'><strong>{{$v['game']['game']}}</strong>  <br />{{$v['Server']['game']}}</a></td>
        <td>{{$v['good_type']}}</td>
        <td class="left">
            <input type="hidden" name="check[]" value="{{$v['orderNo']}}">
            @if($v['status'] == 2 || $v['status'] == 3 || $v['status'] == 1)
                <div @class('text-right')>
                    <span class="attached_noti">거래중</span>
                </div>
            @endif
            <div class="trade_title text-center">
                <a href="{{$href}}">{{$v['user_title']}}</a>
            </div>
        </td>
        <td class="center">{{$price}}원</td>
        <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
        @if($type == 0)
            <td>
                @if(empty($v['payitem']) && $v['status'] == 0 && empty($v['toId']))
                <a href="javascript:;" onclick="reInsert('{{$v['orderNo']}}');" class="regist_btn09">재등록</a>
                <a href="javascript:;" onclick="tradeProcess('deleteSelect', '{{$v['orderNo']}}')" class="regist_btn10">삭제</a>
                @endif
            </td>
        @endif
        @if($type == 1)
        <td>
            @if($v['bargain_requests'][0]['status'] == 0)
                <a href="javascript:void(0)" class="btn-default btn-default-sm btn-secondary" onclick="if(confirm('흥정을 취소하시겠습니까?')) TradeCheck(0,{{$v['bargain_requests'][0]['id']}}); ">흥정취소</a>
            @elseif($v['bargain_requests'][0]['status'] == 1)
                <a href="javascript:void(0)" class="btn-default btn-default-sm btn-green mb-5" onclick="if(confirm('재흥정을 수락하시겠습니까?')) TradeCheck('1', '{{$v['bargain_requests'][0]['id']}}'); ">재흥정 수락</a>
                <a href="javascript:void(0)" class="btn-default btn-default-sm btn-green" onclick="if(confirm('재흥정을 거부하시겠습니까?')) TradeCheck('0', '{{$v['bargain_requests'][0]['id']}}'); ">재흥정 거부</a>
            @endif
        </td>
        @endif
    </tr>

@endforeach
