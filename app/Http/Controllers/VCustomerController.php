<?php

namespace App\Http\Controllers;

use App\Models\MAdminNotice;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\MFaq;
use App\Models\MItem;
use App\Models\MAsk;

class VCustomerController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 고객센터
     */
    public function customer(Request $request)
    {
        $data['searchWord'] = "";
        if (isset($request->searchWord)) {
            $data['searchWord'] = $request->searchWord;
            $data['faqRecord'] = MFaq::where('content', 'like', '%'.$data['searchWord'].'%')->get()->toArray();
        }
        else {
            $data['faqRecord'] = MFaq::limit(6)->get()->toArray();
        }

        return view('angel.customer.index', $data);
    }


    public function report(Request $request)
    {
        if ($request->privates != "") {
            $snzReason = $request->privates;
            if ($request->privates == '기타 사유') {
                $snzReason = $request->privates_txt;
            }
            MAsk::insert([
                'type' => 'cancel',
                'reason' => $snzReason,
                'subject' => '거래 취소 요청합니다.',
                'order_no' => $request->orderNo,
                'phone' => $request->user_phone1.'-'.$request->user_phone2.'-'.$request->user_phone3,
                'response' => '',
                'create_id' => $this->user->id
            ]);

            MItem::where('orderNo', $request->orderNo)
                ->update(['accept_flag' => 1]);
        }

        $param1 = 'sell';
        $param2 = 'buy';
        if ($request->type == "buy") {
            $param1 = 'buy';
            $param2 = 'sell';
        }
        $data['user'] = $this->user;
        $data['typeTxt'] = $param1;
        $data['game_text'] = $request->game;
        $data['server_text'] = $request->gserver;
        $data['search_price_min'] = $request->search_price_min;
        $data['search_price_max'] = $request->search_price_max;
        $data['filtered_items'] = $request->filtered_items;
        // To get selling items
        $data['sellingRecord'] = MItem::with(['game','server','payitem'])
            ->whereHas('payitem',function($query) {
                if(!empty($request->search_price_min))
                    $query->where('price','>=',$request->search_price_min);
                if(!empty($request->search_price_max))
                    $query->where('price','<=',$request->search_price_max);
            })
            ->where('accept_flag', 0)
            ->where('status','!=', -1)
            ->where('status','!=', 0) // initial status > 거래대상이 없을때
            ->where('status','!=', 23) // 거래종료 > 2이면 받을때
            ->where('status','!=', 32) // 거래종료 > 3이면 줄때
                // 1이면 거래상대가 돈 넣엇을때 > 거래중
                // [2, 3]이면 종료예정
            ->where(function($query) use ($param1,$param2){
                $query->where(function($query1) use ($param1){
                    $query1->where('type', $param1);
                    $query1->where('userId',$this->user->id);
                });
                $query->orWhere(function($query2) use ($param2){
                    $query2->where('type', $param2);
                    $query2->where('toId',$this->user->id);
                });
            });

        if(!empty($data['game_text'])) {
            $data['sellingRecord'] = $data['sellingRecord']->where('game_code', $data['game_text']);
            if(!empty($data['server_text']))
                $data['sellingRecord'] = $data['sellingRecord']->where('server_code',$data['server_text']);
        }
        if(!empty($data['filtered_items'])) {
            $snzGoodType = getItemNameType($data['filtered_items']);
            if ($snzGoodType != "") {
                $data['sellingRecord'] = $data['sellingRecord']->where('good_type', $snzGoodType);
            }
        }

        $data['sellingRecord'] = $data['sellingRecord']->orderByDesc("created_at")->paginate(15);
        return view('angel.customer.report', $data);
    }

    /**
     * 1:1 문의 요청 > 종료 요청
     */
    public function report_end(Request $request)
    {
        $param1 = 'sell';
        $param2 = 'buy';
        if ($request->type == "buy") {
            $param1 = 'buy';
            $param2 = 'sell';
        }
        $data['user'] = $this->user;
        $data['typeTxt'] = $param1;
        $data['game_text'] = $request->game;
        $data['server_text'] = $request->gserver;
        $data['search_price_min'] = $request->search_price_min;
        $data['search_price_max'] = $request->search_price_max;
        $data['filtered_items'] = $request->filtered_items;
        // To get selling items
        $data['sellingRecord'] = MItem::with(['game','server','payitem'])
            ->whereHas('payitem',function($query) {
                $query->where('id','>',0);
                if(!empty($request->search_price_min))
                    $query->where('price','>=',$request->search_price_min);
                if(!empty($request->search_price_max))
                    $query->where('price','<=',$request->search_price_max);
            })
            ->where('accept_flag', 0)
            ->where('status','!=', 0) // initial status > 거래대상이 없을때
            ->where('status','!=', 23) // 거래종료 > 2이면 받을때
            ->where('status','!=', 32) // 거래종료 > 3이면 줄때
            // 1이면 거래상대가 돈 넣엇을때 > 거래중
            // [2, 3]이면 종료예정
            ->where(function($query) use ($param1,$param2){
                $query->where(function($query1) use ($param1){
                    $query1->where('type', $param1);
                    $query1->where('userId',$this->user->id);
                });
                $query->orWhere(function($query2) use ($param2){
                    $query2->where('type', $param2);
                    $query2->where('toId',$this->user->id);
                });
            });

        if(!empty($data['game_text'])) {
            $data['sellingRecord'] = $data['sellingRecord']->where('game_code', $data['game_text']);
            if(!empty($data['server_text']))
                $data['sellingRecord'] = $data['sellingRecord']->where('server_code',$data['server_text']);
        }
        if(!empty($data['filtered_items'])) {
            $snzGoodType = getItemNameType($data['filtered_items']);
            if ($snzGoodType != "") {
                $data['sellingRecord'] = $data['sellingRecord']->where('good_type', $snzGoodType);
            }
        }

        $data['sellingRecord'] = $data['sellingRecord']->orderByDesc("created_at")->paginate(15);
        return view('angel.customer.report_end', $data);
    }

    public function ask_guide(Request $request)
    {
        $data = array(
            "faqRecord" => null
        );

        $faqType = "normal";
        switch ($request->type)
        {
            case 'login':
                $faqType = 'login';
                break;
            case 'charge':
                $faqType = 'charge';
                break;
            case 'exchange':
                $faqType = 'exchange';
                break;
            case 'other':
                $faqType = 'other';
                break;
            case 'report':
                $faqType = 'report';
                break;
            case 'faulty':
                $faqType = 'faulty';
                break;
            default:
                break;
        }



        $data['user'] = $this->user;
        $data['faqType'] = $faqType;
        $data['faqRecord'] = MFaq::where('group', '=', $faqType)->get()->toArray();

        return view('angel.customer.ask_guide', $data);
    }

    public function report_complete()
    {
        return view('angel.customer.report_complete');
    }

    /**
     * 신규게임
     */
    public function newgame(Request $request)
    {
        return view('angel.customer.newgame');
    }

    /**
     * 안전거래
     */
    public function safety()
    {
        return view('angel.customer.safety');
    }

    /**
     * 나의 질문과 답변
     */
    public function myqna_list()
    {
        $data['askRecord'] = MAsk::where('create_id', $this->user->id)
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('angel.customer.myqna.list', $data);
    }
    public function myqna_view(Request $request)
    {
        if ($request->seq > 0) {
            MAsk::where('askid', $request->seq)
                ->update(['is_read' => 1]);

            $data['askDetail'] = MAsk::where('askid', $request->seq)
                ->first();

            if (empty($data['askDetail'])) {
                return redirect(route('myqna_list'));
            }
            return view('angel.customer.myqna.view', $data);
        }
        else {
            redirect(route('myqna_list'));
        }
    }

    public function processReportEnd(Request $request){

        if ($request->privates != "") {
            $snzReason = $request->privates;
            if ($request->privates == '기타 사유') {
                $snzReason = $request->privates_txt;
            }
            if ($request->types_order == 'end')
            {
                $msg = "거래 종료 요청합니다.";
                $msg_type =  'complete';
            }
            else{
                $msg = "거래 취소 요청합니다.";
                $msg_type =  'cancel';
            }
            MAsk::insert([
                'type' => $msg_type,
                'subject' => $msg,
                'reason' => $snzReason,
                'order_no' => $request->orderNo,
                'phone' => $request->user_phone1.'-'.$request->user_phone2.'-'.$request->user_phone3,
                'response' => '',
                'create_id' => $this->user->id
            ]);

            MItem::where('orderNo', $request->orderNo)
                ->update(['accept_flag' => 1]);
            $re = 0;
            if($msg_type == 'complete' && $request->types == 'sell'){
                $re = 6;
            }
            if($msg_type == 'complete' && $request->types == 'buy'){
                $re = 4;
            }

            if($msg_type == 'cancel' && $request->types == 'sell'){
                $re = 5;
            }
            if($msg_type == 'cancel' && $request->types == 'buy'){
                $re = 3;
            }
            MAdminNotice::insert([
                'userId'=>$this->user->id,
                'type'=>$re,
                'orderNo'=>$request->orderNo
            ]);
            return response()->json(array('status'=>1,'data'=>array('type'=>$re,'orderNo'=>$request->orderNo,'userName'=>$this->user->name)));
        }
    }

    public function frm_game(Request $request){
        $snzSubject = $request->subject;
        $snzContent = '';
        switch ($request->new_type) {
            case 'g':
                $snzContent .= '[신규게임]'.PHP_EOL.PHP_EOL;
                $snzContent .= '게임명 : '.$request->game_name.PHP_EOL.PHP_EOL;
                $snzContent .= 'URL : '.$request->game_url.PHP_EOL;
                break;
            case 's':
                $snzContent .= '[신규서버]'.PHP_EOL.PHP_EOL;
                $snzContent .= '게임명 : '.$request->game_text.PHP_EOL.PHP_EOL;
                $snzContent .= '서버명 : '.$request->server_name.PHP_EOL;
                break;
            case 'e':
                $snzContent .= '[기타]'.PHP_EOL.PHP_EOL;
                $snzContent .= '제목 : '.$request->gs_subject.PHP_EOL.PHP_EOL;
                $snzContent .= '내용 : '.$request->gs_content.PHP_EOL;
                break;
        }

        MAsk::insert([
            'type' => 'newgame',
            'subject' => $snzSubject,
            'content' => $snzContent,
            'create_id' => $this->user->id
        ]);
        MAdminNotice::insert([
            'type'=>7,
            'userId'=>$this->user->id,
            'content'=>$snzContent
        ]);
        return response()->json(array("status"=>1,'data'=>array('type'=>7,'content'=>$snzContent,'userName'=>$this->user->name)));
    }
    public function processUsing(Request $request){
        if ($request->subject != "") {
            $faqType = "normal";
            switch ($request->type)
            {
                case 'login':
                    $faqType = 'login';
                    break;
                case 'charge':
                    $faqType = 'charge';
                    break;
                case 'exchange':
                    $faqType = 'exchange';
                    break;
                case 'other':
                    $faqType = 'other';
                    break;
                case 'report':
                    $faqType = 'report';
                    break;
                case 'faulty':
                    $faqType = 'faulty';
                    break;
                default:
                    break;
            }
            MAsk::insert([
                'type' => $faqType,
                'subject' => $request->subject,
                'order_no' => $request->trade_num,
                'content' => $request->ask_content,
                'phone' => sprintf("%s-%s-%s", $request->user_phone1, $request->user_phone2, $request->user_phone3),
                'create_id' => $this->user->id
            ]);
            MAdminNotice::insert([
                'userId'=>$this->user->id,
                'type'=>8,
                'content'=>$request->ask_content
            ]);
            return response()->json(array('status'=>1,'data'=>array('type'=>8,'userName'=>$this->user->name,'content'=>$request->ask_content)));
        }
    }

    public function faq(Request $request)
    {
        $data['searchWord'] = "";
        if (isset($request->searchWord)) {
            $data['searchWord'] = $request->searchWord;
            $data['faqRecord'] = MFaq::where('content', 'like', '%'.$data['searchWord'].'%')->get()->toArray();
        }
        else {
            $data['faqRecord'] = MFaq::limit(6)->get()->toArray();
        }

        return view('angel.customer.faq', $data);
    }

}
