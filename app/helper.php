<?php

function generateRandomString($length = 10,$characters = '0123456789') {
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get($id){
    $content = array('alias'=>'','value'=>'');
    switch ($id){
        case 1:
            $content['alias'] = 'item';
            $content['value'] = '아이템';
            break;
        case 2:
            break;
        case 3:
            $content['alias'] = 'money';
            $content['value'] = '게임머니';
            break;
        case 4:
            $content['alias'] = 'etc';
            $content['value'] = '기타';
            break;
        case 6:
            $content['alias'] = 'character';
            $content['value'] = '캐릭터';
            break;
        default:
            break;
    }

    return $content;
}

function getImage($str){
    preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $str, $matches);
    if(!empty($matches[0]) && !empty($matches[0][0])){
        return $matches[0][0];
    }
    return '';
}
function getmyService(){
    return array(
        1=>array('alias'=>"내 마일리지",'href'=>'/myroom/','img'=>'/mania/img/home/mileage.png','height'=>'17'),
        2=>array('alias'=>"상담내역보기",'href'=>'/customer/myqna/list','img'=>'/mania/img/home/chat_history.png','height'=>'17'),
        3=>array('alias'=>"판매관련물품",'href'=>'/myroom/sell/sell_regist','img'=>'/mania/img/home/sell.png','height'=>'8'),
        4=>array('alias'=>"구매관련물품",'href'=>'/myroom/buy/buy_regist','img'=>'/mania/img/home/buy.png','height'=>'14'),
        5=>array('alias'=>"마일리지충전",'href'=>'/myroom/my_mileage/index_c','img'=>'/mania/img/home/mileage_charge.png','height'=>'14'),
        6=>array('alias'=>"수수료",'href'=>'','img'=>'/mania/img/home/fee.png','height'=>'14'),
        7=>array('alias'=>"신용등급/수수료",'href'=>'/myroom/myinfo/credit_rating','img'=>'/mania/img/home/rating.png','height'=>'14'),
        8=>array('alias'=>"초보가이드",'href'=>'','img'=>'/mania/img/home/beginner.png','height'=>'14'),
        9=>array('alias'=>"FAQ",'href'=>'/customer','img'=>'/mania/img/home/faq.png','height'=>'14'),
        10=>array('alias'=>"메시지함",'href'=>'/myroom/message/','img'=>'/mania/img/home/message.png','height'=>'16')
    );
}

function getReasonList(){
    return array(
        1=>"상대방 연락 안됨",
        2=>"이미 팔린 물품",
        3=>"잘못 등록 또는 신청한 물품",
        4=>"상대방이 직거래 유도",
        5=>"상대방이 타사이트 거래 유도",
        6=>"상대방이 가격 흥정 요청",
        7=>"기타 사유"
    );
}

function itemAlias($alias){
    $en_alias = 'all';
    if($alias == '아이템')
        $alias = 'item';
    if($alias == '캐릭터')
        $alias = 'character';
    if($alias == '게임머니')
        $alias = 'money';
    if($alias == '기타')
        $alias = 'etc';
    return $alias;
}
function active_class($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function numberUnit($param){
    $unit = '1';
    if($param == '만')
        $unit = 10000;
    if($param == '억')
        $unit = 100000000;
    return $unit;
}

function numberReverseUnit($param){
    $unit = $param;
    if($param == '1000')
        $unit = '1,000';
    if($param == '10000')
        $unit = '1만';
    if($param == '100000')
        $unit = '십만';
    if($param == '1000000')
        $unit = '백만';
    if($param == '10000000')
        $unit = '천만';
    if($param == '100000000')
        $unit = '1억';
    if($param == '1000000000')
        $unit = '십억';
    if($param == '10000000000')
        $unit = '백억';
    return $unit;
}

function getItemNameType($value)
{
    $snzGoodType = "";
    switch ($value)
    {
        case '1':
            $snzGoodType = "아이템";
            break;
        case '2':
            $snzGoodType = "캐릭터";
            break;
        case '3':
            $snzGoodType = "게임머니";
            break;
        case '4':
            $snzGoodType = "기타";
            break;
    }
    return $snzGoodType;
}

function createDateRangeArray($start, $end) {
// Modified by JJ Geewax

    $range = array();

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
        $range[] = [date('m', $start),date('d', $start)];
        $start = strtotime("+ 1 day", $start);
    }
    while($start < $end);

    return $range;
}


function orderState($state){
    $state_alias = "";
    if ($state == '1'){
        $state_alias = "판매중";
    }
    else if ($state == '2'){
        $state_alias = "구매자 물품인수확인";
    }
    else if ($state == '3'){
        $state_alias = "판매자 물품인계확인";
    }
    return $state_alias;
}
?>
