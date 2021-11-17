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
        1=>array('alias'=>"내 마일리지",'href'=>''),
        2=>array('alias'=>"상담내역보기",'href'=>''),
        3=>array('alias'=>"판매관련물품",'href'=>'/myroom/sell/sell_regist'),
        4=>array('alias'=>"구매관련물품",'href'=>'/myroom/buy/buy_regist'),
        5=>array('alias'=>"마일리지충전",'href'=>''),
        6=>array('alias'=>"수수료",'href'=>''),
        7=>array('alias'=>"신용등급/수수료",'href'=>''),
        8=>array('alias'=>"초보가이드",'href'=>''),
        9=>array('alias'=>"FAQ",'href'=>''),
        10=>array('alias'=>"메시지함",'href'=>'/myroom/message/')
    );
}
?>
