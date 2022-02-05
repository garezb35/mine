@php
    $user_coupon = array(1=>0,2=>0,3=>0,4=>0);
    $user = Auth::user();
    $roleGift_items = App\Models\MGift::where('userId',$user->id)->get();
    $role = App\Models\MRole::where('level',$user->role)->first();
    foreach($roleGift_items as $v){
        $user_coupon[$v['type']] = $v['time'];
    }
    $coupon = $user_coupon;
    $selling_register = App\Models\MItem::
        where('userId',$user->id)->
        where('type','sell')->
        where('status',"!=",-1)->
        whereDoesntHave('bargains')->
        get()->count();
        $bargain_request_selling = App\Models\MItem::
        where('userId',$user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending_selling = App\Models\MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query) use ($user) {
            $query->where(function($query1) use ($user) {
                $query1->where('userId',$user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2) use ($user) {
                $query2->where('toId',$user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $selling_count = App\Models\MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query) use ($user) {
            $query->where('userId',$user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query) use ($user) {
            $query->where('toId',$user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $buying_register = App\Models\MItem::
        where('userId',$user->id)->
        where('type','buy')->
        where('status','!=',-1)->
        get()->count();
        $bargain_request = App\Models\MItem::
        where('userId','!=',$user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query) use($user) {
            $query->where('userId',$user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = App\Models\MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query)  use ($user) {
            $query->where(function($query1) use ($user) {
                $query1->where('toId',$user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2)  use ($user) {
                $query2->where('userId',$user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $buying_count = App\Models\MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query) use ($user) {
            $query->where('toId',$user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query) use ($user){
            $query->where('userId',$user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();

@endphp
<div @class('myroom__header')>
    <h3><span>아이템천사</span> 에 오신 것을 환영합니다!</h3>
    <div>
        <div class="fileright">
            <div class="filerighttop">
                <div class="filerightrg">

                    <dl><dt @class('font-weight-bold')>내 이메일</dt><dd>{{$me['email']}}</dd></dl>
                    <dl><dt @class('font-weight-bold')>등급정보</dt><dd class="clc3">{{$role['alias']}} 회원</dd></dl>
                    <dl><dt @class('font-weight-bold')>거래점수</dt><dd class="clc3">{{number_format($user['point'])}}</dd></dl>
                    <dl><dt @class('font-weight-bold')>총 마일리지</dt><dd class="clc3">{{number_format($user['mileage'])}} <span @class('text-black')>원</span></dd></dl>
                    <dl><dt @class('font-weight-bold')>나의 쿠폰</dt><dd class="clc3">프리미엄 <span @class('text-black')>{{$coupon[1]}}</span>, 물품강조 <span @class('text-black')>{{$coupon[2]}}</span></dd></dl>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div @class('fileright')>
            <table class="table nobordertable th_white noborderth th__30 f13">
                <tbody>
                <tr>
                    <th @class('text-center')>판매등록</th>
                    <td @class('text-center')><a  href="/myroom/sell/sell_regist?strRelationType=regist">{{$selling_register}}건</a> </td>
                    <th @class('text-center')>구매등록</th>
                    <td @class('text-center')><a  href="/myroom/buy/buy_regist?strRelationType=regist">{{$buying_register}}건</a> </td>
                <tr>
                    <th @class('text-center')>입금대기</th>
                    <td @class('text-center')><a  href="/myroom/sell/sell_pay_wait?strRelationType=pay">{{$pay_pending_selling}}건</a></td>
                    <th @class('text-center')>입금예정</th>
                    <td @class('text-center')><a  href="/myroom/buy/buy_pay_wait?strRelationType=pay">{{$pay_pending}}건</a> </td>
                </tr>
                <tr>
                    <th @class('text-center')>판매중</th>
                    <td @class('text-center')><a  href="/myroom/sell/sell_ing?strRelationType=ing">{{$selling_count}}건</a></td>
                    <th @class('text-center')>구매중</th>
                    <td @class('text-center')><a  href="/myroom/buy/buy_ing?strRelationType=ing">{{$buying_count}}건</a></td>
                </tr>
                <tr>
                    <th @class('text-center')>판매종료</th>
                    <td @class('text-center')><a  href="/myroom/complete/sell" >자세히보기</a></td>
                    <th @class('text-center')>구매종료</th>
                    <td @class('text-center')><a  href="/myroom/complete/buy" >자세히보기</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>





<style>
    .myroom__header{
        padding-bottom: 8px;
        background-image: url(/angel/img/icons/myroom_banner.png);
        background-repeat: no-repeat;
        background-position:top right;
        background-size:contain;
    }
    .myroom__header>div{
        display: flex;
        justify-content: space-between;
        margin-right: 12px;
        margin-left: 12px;
    }
    .fileright {
        border: 1px solid #d9dada;
        background: #FFF;
        vertical-align: top;
    }

    .filerighttop {
        padding: 15px;
        overflow: hidden;
    }

    .filerightlf {
        width: 28%;
        float: left;
        margin-right: 2%;
    }

    .filerightlfimg {
        width: 100%;
        text-align: center;
    }

    .filerightlfimg img {
        border: 1px solid #ebeaea;
        padding: 3px 15px;
    }

    .filerightrg {
        float: left;
    }
    .myroom__header h3{
        font-size: 17px;
        color: #2d58a1;
        padding-left: 30px;
        padding-top: 45px;
        padding-bottom: 30px;
    }
    .myroom__header h3 span {
        font-size: 31px;
        line-height: 36px;
    }

    .filerightrg dl {
        float: left;
        width: 100%;
        line-height: 26px;
    }
    .filerightrg dt {
        float: left;
        color: #444444;
        width: 86px;
    }
    .filerightrg dd {
        font-size: 14px;
    }

    .myroom__header .fileright:first-child{
        width: 364px;
    }

    .myroom__header .fileright:last-child{
        width: calc(100% - 380px);
        padding: 16px 0 16px 0px;
    }

    @media screen and (max-width: 726px){
        .myroom__header>div{
            display: block;
        }
        .myroom__header .fileright:first-child{
            margin-bottom: 10px;
        }

        .myroom__header .fileright{
            width: 100% !important;
        }
    }
</style>
