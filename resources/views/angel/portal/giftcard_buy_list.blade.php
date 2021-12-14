@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/portal/giftcard/css/giftcard_buy_list.css">
@endsection

@section('foot_attach')
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        <script type="text/javascript">
            function serviceCert() {
                if (confirm('I-Pin(아이핀)을 이용하여 아이템천사에 가입하신 회원\n님들께서는 마일리지 충전 및 물품 거래 시 정상적인 이용\n을 위하여 최초 1회 이름 및 주민등록 번호로 본인 확인 절\n차를 거쳐야만 모든 기능을 사용하실 수 있습니다.\n인증을 하시겠습니까?')) {
                    location.href = '/portal/user/ipin_name_index';
                } else {
                    location.href = '/';
                }
            }
        </script>
        @include('aside.portal',['portal'=>$gift])
        <div class="g_content">
            <div class="g_title noborder">
                나의 구매내역
            </div>
            <select name="pMode" id="gift_card" onchange="location.href='giftcard_buy_list?pMode='+this.value;">
                <option value="">===============</option>
                @foreach($gift as $v)
                    <option value="{{$v['alias']}}" @if(Request::get('pMode') == $v['alias']) selected @endif>{{$v['name']}}</option>
                @endforeach
            </select>
            <table class="g_blue_table tb_list">
                <tbody>
                <tr>
                    <th class="first">순번</th>
                    <th>핀번호</th>
                    <th>금액</th>
                    <th>구매시간</th>
                </tr>
                @foreach($list as $key=>$v)
                <tr>
                    <td class="first">{{$key+1}}</td>
                    <td>
                        {{$v['serial_number']}}
                    </td>
                    <td>{{number_format($v['mileage'])}}</td>
                    <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="dvPaging">
                {{$list->withQueryString()->links()}}
            </div>
            <div class="notice_box dash">
                <dt>알아두기</dt>
                <dd>상품권 번호를 확인 하신 후 사용하실 수 있으며, PIN번호가 타인에게 누출이 되어 피해를 당하시지 않도록 주의하시기 바랍니다.</dd>
                <dd>번호 관리 소홀의 문제로 인해 등록이 안 되는 경우, 판매사는 책임을 지지 않습니다.</dd>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
