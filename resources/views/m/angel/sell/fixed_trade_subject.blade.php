<!DOCTYPE html>
<html lang="ko">

<head>
	<title>아이템천사</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="description" content="">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/css/fixed_trade_subject.css">

    <style>
        #top_title{text-align:center}
        #top_txt{margin-top:10px}
        #top_txt #txt_fixed_title{width:200px}
    </style>
</head>

<body>
	<div id="global_root" class="mainEntity d-none ">
		<div id="thirdys" class="fluid-div"></div>
	</div>
	<div id="angel">
		<div id="model_titlebar">물품제목 기본값 설정</div>
		<div id="g_POPUP">
			<form name='ini' id='ini' method='post' action='/sell/fixed_trade_subject' onsubmit='return sendit()'>
                @csrf
				<div id="top_title" class="g_black3_11">모든 물품 등록 시 마다 미리 설정해둔 문구를<br />물품제목의 맨 앞으로 자동 기입해주는 기능입니다</div>
				<div class="empty-high"></div>
				<div id="top_txt" class="g_notice_box1"> <span class='g_org1_b'>텍스트 : </span>
					<input type='text' class='angel__text' id='txt_fixed_title' name='txt_fixed_title' value='{{$title}}' maxlength='8'> (8자/16Byte) </div>
				<div class="empty-high"></div>
				<div class="btn-groups_angel">
					<input type='submit'   value="확인" class="btn-submit"/>
                </div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="/assets/js/angel/_window.js"></script>
	<script type="text/javascript">
	function _init() {
        _window.resize(500, 330);
    }

	function sendit() {
        if($('#txt_fixed_title').val().isEmpty()) {
            alert('물품 제목 기본값을 입력하세요.');
            $('#txt_fixed_title').focus();
            return false;
        }
    }
    function setTit(title){
	    opener.setTit(title)
    }
	</script>
	<script>
loadGlobalItems()
	</script>
</body>

</html>
