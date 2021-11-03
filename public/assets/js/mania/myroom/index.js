/*
 * @title		마이룸
 * @author		김보람
 * @date		2012.01.19
 * @update		2020.07.21 (강희경)
 * @description
 */

function _init(){
// 	g_fnSECURITY2();
//	StartSmartUpdate();

	// $.ajax({
	// 	url			: "/_include/_loginbox_security.php",
	// 	dataType	: "text",
	// 	type		: "get",
	// 	data		: null,
	// 	success		: function(request) {
	// 		reqData = request.split("$");
    //
	// 		var strSecuResult = "미설정";
	// 		var strLoginAlarm = "미설정";
	// 		var strLoginResult = "미설정";
	// 		var strUseService = "<span class='f_blue1'>설정완료</span>";
	// 		if (reqData[0] == true) { strSecuResult = strUseService; }
	// 		if (reqData[3] == true) { strLoginResult = strUseService; }
	// 		if (reqData[4] == true) { strLoginAlarm = strUseService; }
    //
	// 		// $("#login_security_service").html("로그인 보안 서비스 : <b>"+strLoginResult+"</b>");
    //         // $("#login_alert_service").html("로그인 알림 서비스 : <b>"+strLoginAlarm+"</b>");
    //         // $("#payment_security_service").html("결제 보안 서비스 : <b>"+strSecuResult+"</b>");
    //
	// 		$("#login_security_state").html("<b>"+strLoginResult+"</b>");
	// 		$("#login_alert_state").html("<b>"+strLoginAlarm+"</b>");
	// 		$("#payment_state").html("<b>"+strSecuResult+"</b>");
    //
	// 		//$('#loading_img').hide();
	// 	},
	// 	error : function (xhr) {
	// 		alert("접속이 원활하지 않습니다."+xhr.status);
	// 	}
	// });

}

function fnTradePage(url){
	if(url) {
		location.href = url;
	}
}

function fnipin()
{
	$("#reqCBAForm").submit();
}

function fnemail(){
	if (confirm($('#user_email').val() + '에 인증메일 발송 하시겠습니까?')) {
		fnAjax('/certify/email/sendmail.php', 'xml', 'POST', '', {
			complete: function (res) {
				if ($(res).find('result').attr('type') == 'fail') {
					alert($(res).find('result').attr('message'));
				} else if ($(res).find('result').attr('type') == 'success') {
					_window.open('auth_mail', '/certify/email/sendmail_ok.php', 440, 260);
				}
			},
			error: function () {
				alert('시스템 점검중입니다. 잠시 후 이용해 주세요.');
			}
		});
	}else{
		location.href='/myroom/myinfo/myinfo_check.html';
	}
}

function cardauth(mode)
{
    alert("서비스 점검중입니다.");
	//_window.open('mobile_certify','/certify/ini_pubauth/pub_auth_request.php?wis=MI',430,700);
}
