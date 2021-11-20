/*
 * @title	    고객감동센터
 * @author		이진수
 * @date		2010.01.08
 * @update		수정날짜(수정자)
 * @description
 */

/* ▼ initialize */
// 제목
var obj_subject = {
    'general': 0,
    'special': 1
};

// 상담내용
var obj_content = {
    'general': 0
};

// 취소사유선택
var obj_cancel_text = {
    'a': '상대방과 연락이 안됩니다.',
    'b': '이미 팔린 물품 입니다',
    'c': '잘못 등록 또는 신청한 물품 입니다',
    'd': '상대방이 직거래를 유도 합니다',
    'e': '상대방이 타사이트 거래를 유도 합니다',
    'form_member': '상대방이 가격 흥정을 합니다',
    'g': '기타 사유'
};

// 종료사유선택
var obj_complete_text = {
    'a': '물품 인계 후 구매자 연락 안됨',
    'b': '물품 인계 후 구매자 물품인수확인 안됨',
    'c': '물품 인계 후 종료안됨',
    'd': '기타 사유'
};

//선택문의
var obj_selecter = {
    'a': '해킹 물품입니다',
    'b': '물품을 받지 않았으나 거래가 완료되었습니다',
    'c': '기타 다른 문제가 발생 되었습니다',
    'd': '문제는 없으며, 거래자의 연락처를 알려주세요'
};

// 해킹여부
var obj_hacking = {
    'a': '해킹 당한게 확실합니다',
    'b': '해킹이 아닙니다` 1대 도움을 받으려 문의하였습니다',
    'c': '해킹이 아닙니다. 거래자의 연락처를 알려주세요',
    'd': '해킹이 아닌, 다른 문제가 발생 되었습니다'
};

// 해킹일자
var obj_hacking_info = {
    'a': '물품 인수 후 바로 해킹 당함',
    'b': '구매 후 24시간이내에 해킹 당함',
    'c': '3일 이상 지난후 해킹 당함'
};

// 정보변경 확인
var obj_hacking_check = {
    'a': '일부 변경함',
    'b': '바꿀수 있는 정보는 모두 변경함',
    'c': '모두 변경 못함'
};

// 정보변경 확인 => 일부 변경함
var obj_hacking_check_b = {
    'info_question': '질문/답변/퀴즈',
    'info_email': '이메일',
    'info_password': '비밀번호',
    'info_otp_password': '2차 비밀번호'
};

// 현재지정
var obj_select = {
    subject: 'general',
    content: 'general'
};

// 제목 기본 문구
var obj_subject_text = {
    'A003': '사용 및 출금이 가능한 마일리지로 전환을 요청합니다.'
};

// 상담내용 기본 문구
var obj_content_text = {
    'A001': '※ 공통계좌로 입금하셨다면 마일리지 충전요청에 접수해 주시기 바랍니다.',
    'A003': '리니지1, 2의 판매대금은 출금내역이 있어야만 마일리지 전환이 가능합니다. \n아래의 내용을 반드시 기재해 주세요.\n판매한 게임명 : \n연락 가능한 핸드폰 번호 : \n핸드폰 명의자의 주민등록번호 : \n집 전화번호 : ',
    'A201': '※ 상담 내용을 입력해 주세요. 상담은 오전 9시부터 오후 10시까지 진행하며, 이 외 시간에 문의 시\n답변이 익일 처리되거나 다소 늦어질 수 있는 점 양해 바랍니다.',
    'A202': '※ 상담 내용을 입력해 주세요. 상담은 오전 9시부터 오후 10시까지 진행하며, 이 외 시간에 문의 시\n답변이 익일 처리되거나 다소 늦어질 수 있는 점 양해 바랍니다.',
    'A203': '※ 상담 내용을 입력해 주세요. 상담은 오전 9시부터 오후 10시까지 진행하며, 이 외 시간에 문의 시\n답변이 익일 처리되거나 다소 늦어질 수 있는 점 양해 바랍니다.',
    'A204': '※ 상담 내용을 입력해 주세요. 상담은 오전 9시부터 오후 10시까지 진행하며, 이 외 시간에 문의 시\n답변이 익일 처리되거나 다소 늦어질 수 있는 점 양해 바랍니다.',
    'A101': '※ 취소 사유선택이 상대방의 직거래 유도일 경우, 해당 직거래에 대한 상황을 구체적으로 기재해주시기 바랍니다.\n직거래 신고에 대한 사항은 담당자가 조사 후 답변을 드리도록 하겠습니다.\n허위로 직거래 신고를 할 경우 사이트 이용에 제한이 있을 수 있으니 이점 양지해주시기 바랍니다.'
};

//// 첨부파일이 필요한 코드
//var obj_upload_code = Array(
//	'A001',		// 충전/입금문의
//	'A002',		// 출금문의
//	'A003',		// 마일리지 전환요청
//	'A102',		// 거래중 문제 발생
//	'A201',		// 거래 문제 발생(거래종료)
//	'A202',		// 거래 문제 발생(거래중)
//	'A301',		// 개선/건의요청
//	'A302',		// 버그/오류신고
//	'A701'		// 서비스문의
//);

/* ▲ initialize */

var checker = null;
var strThisCode2 = null;

function _init() {
    if ($('#dvGame').length > 0) {
        var objGamelist = $.extend($('#dvGame'), _gamelist);
        var objServerlist = $.extend($('#dvServer'), _serverlist);
        objGamelist.bind = objServerlist;
        objServerlist.bind = objGamelist;
        objGamelist.initialize();
        objServerlist.initialize();

        _form.protect.price($('#frmSearch').find('input[name="search_price_min"]'));
        _form.protect.price($('#frmSearch').find('input[name="search_price_max"]'));
    }

    var frmCustomer = $('#form_member');

    _form.protect.number(frmCustomer.find('input[name="phone1"]'));
    _form.protect.number(frmCustomer.find('input[name="phone2"]'));
    _form.protect.number(frmCustomer.find('input[name="phone3"]'));

    if (frmCustomer.length > 0) {
        checker = new _form_checker(frmCustomer);
//
//		/* ▼ 폼체크 */
//		$.extend(checker,{
//			OnSubmit: function()
//			{
//				if(confirm('접수를 하시겠습니까??'))
//				{
//					$('#form_member').attr('action', '../report_ok.html');
//					$('#form_member').submit();
//				}
//			}
//		});
//		/* ▲ 폼체크 */
    }

    $('#category_tb').find('input[type="radio"]').click(function() {
        var nowAcode = $(this).parents('ul').attr('data-type');
        var locationHref = "";
        if (nowAcode == 'A1') {
            var cCode = (this.id == 'a10101') ? "01" : "02";
            locationHref = "/customer/trade/trade_ing_list?a_code=" + nowAcode + "&b_code=01&c_code=" + cCode;
        }
        else if (nowAcode == 'A2') {
            var returnUrl = "";
            var tType = "";
            switch (this.id) {
                case 'a20100' :
                    returnUrl = "sell_complete_list.html";
                    tType = 'sc';
                    break;
                case 'a20200' :
                    returnUrl = "trade_ing_list.html";
                    tType = 'ti';
                    break;
                case 'a20300' :
                    returnUrl = "trade_cancel_list.html";
                    tType = 'ti';
                    break;
                case 'a20400' :
                    returnUrl = "trade_etc.html";
                    break;
            }
            locationHref = "/customer/trade/" + returnUrl + "?a_code=" + nowAcode + "&b_code=" + $(this).val() + "&t_type=" + tType;
        }
        else {
            var nowAcode = $(this).attr('data-acode');
            if (this.id == 'faulty') {
                locationHref = "/customer/faulty";
            }
            else {
                locationHref = "/customer/report?a_code=" + nowAcode + "&b_code=" + $(this).val() + '#customer_report';
            }
        }
        location.href = locationHref;
    });

    $('.subject').click(function() {
        var _index = $('.subject').index($(this));
        $('.detail_content').eq(_index).slideToggle('slow');
    });

    _form.protect.number($('#user_phone1, #user_phone2, #user_phone3'));
}

/* ▼ 거래취소/종료 요청 */
function move_self_A1(value) {
    if (value == "") {
        $("#Form_table").hide();
    } else {
        $("#Form_table").show();
        location.href = "#form_member";
    }
}

/* ▲ 거래취소/종료 요청 */

/* ▼ 거래사고신고 */
function move_self_A2(code, t_type) {
    var frm = $("#form_member");
    var rowSpanTH = $("#TR_trade_th");

    $('#Form_table').show();
    if (code != "A204") {
        strThisCode2 = strThisCode.substring(0, 4) + code;
        frm.find('input[name="c_code"]').val((!code) ? "01" : code);
    }

    if (code == "A203" || code == "A204") {
        strThisCode2 = code + "01";
        frm.find('input[name="a_code"]').val(code.substring(0, 2));
        frm.find('input[name="b_code"]').val(code.substring(2, 4));
        frm.find('input[name="c_code"]').val('01');

        if (code == "A204") {
            $("#TR_trade").hide();
            $("#TR_trade1").hide();
            $("#TR_trade3").hide();
        } else {
            rowSpanTH.attr("rowspan", "3");
        }
    }
    else if (code == "A101") {
    }
    else {	// 거래번호 없음 선택 후 다시 접수하기 누를때 거래내역 보이기
        $("#TR_trade").show();
        $("#TR_trade1").show();
        $("#TR_trade3").show();
    }
    fnCreateDom('', t_type);
}

/* ▲ 거래사고신고 */

/* ▼ 테이블 DOM 생성 */
function fnCreateDom(strType, c_code) {
    /* ▼ form check initialize */
    var nSelect_subject = obj_subject[obj_select.subject];
    var nSelect_content = obj_content[obj_select.content];
    /* ▲ form check initialize */

    if (checker) {
        checker.free();
    }

    /* ▼ 폼체크 */
    if (strType === 'ACS') {
        $.extend(checker, {
            OnSubmit: function() {
                if (c_code === "02") {
                    fnTrade_Ajax($("#form_member").find('input[name="trade_num"]').val(), 'complete');
                } else {
                    fnTrade_Ajax($("#form_member").find('input[name="trade_num"]').val(), 'cancel');
                }
            }
        });
    }
    else {
        $.extend(checker, {
            OnSubmit: function() {
                if ($('#reply_sms').length > 0 && $('#reply_sms')[0].checked === true) {
                    var user_phone1 = $('#user_phone1');
                    var user_phone2 = $('#user_phone2');
                    var user_phone3 = $('#user_phone3');
                    if (user_phone1.val().isEmpty()) {
                        alert('통화 가능한 번호를 입력해주세요.');
                        user_phone1.focus();
                        return false;
                    }
                    if (user_phone2.val().isEmpty()) {
                        alert('통화 가능한 번호를 입력해주세요.');
                        user_phone2.focus();
                        return false;
                    }
                    if (user_phone3.val().isEmpty()) {
                        alert('통화 가능한 번호를 입력해주세요.');
                        user_phone3.focus();
                        return false;
                    }
                }

                if (!confirm('접수를 하시겠습니까???')) return false;

                $('#form_member').attr('action', '../report_ok.html');
                return true;
//					$('#form_member').submit();

            }
        });
    }
    /* ▲ 폼체크 */

    var goodsTable = $('#goods_table');
    goodsTable.find('.m_tmp').remove();

    if (strThisCode.substring(0, 2) == "A1") {
        var iIndex = 3;
        if (strThisCode == "A101") {
            if (c_code == "02") {	// c_code : c_code (취소/종료 구분값)
                goodsTable.find('tr').eq(iIndex++).getCompleteReason();
            } else {
                goodsTable.find('tr').eq(iIndex++).getCancelReason();
            }
        }
        else {
            goodsTable.find('tr').eq(iIndex++).getSubject(nSelect_subject);
            goodsTable.find('tr').eq(iIndex++).getContent();
        }
    } else if (strThisCode.substring(0, 2) == "A2") {
        var iIndex = 3;
        if (strThisCode2 == "A20101" || strThisCode2 == "A20201") {	// 거래종료-계정
            goodsTable.find('tr').eq(iIndex++).getUserId();
            goodsTable.find('tr').eq(iIndex++).getCharacter();
            goodsTable.find('tr').eq(iIndex++).getHacking();
            goodsTable.find('tr').eq(iIndex++).getHackingInfo();
            goodsTable.find('tr').eq(iIndex++).getHackingCheck();
            goodsTable.find('tr').eq(iIndex++).getContent();
        } else if (strThisCode == "A201" && (c_code == "sc" || c_code == "bs")) {	// c_code : t_type (판매종료, 이전판매종료)
            goodsTable.find('tr').eq(iIndex++).getContent();
        } else if (strThisCode2 == "A20102" || strThisCode2 == "A20301") {	// 거래종료-게임머니/아이템, 거래취소
            goodsTable.find('tr').eq(iIndex++).getContent();
        } else if (strThisCode2 == "A20103" || strThisCode == "A202") {	// 거래종료-기타, 거래중, 거래중물품
            goodsTable.find('tr').eq(iIndex++).getContent();
        } else if (strThisCode2 == "A20401") {	// 거래번호 없음
            goodsTable.find('tr').eq(iIndex++).getSubject(nSelect_subject);
            goodsTable.find('tr').eq(iIndex).find('td').width(615);
            goodsTable.find('tr').eq(iIndex++).getContent();
        }
    }

    if (goodsTable.find('tr').length < 8) {
        goodsTable.find('tr').eq(iIndex++).getUpLoad();
    }

    struct = null;
    delete struct;
    location.href = "#form_member";
}

/* ▲ 테이블 DOM 생성 */

$.fn.extend({
    getSubject: function(subject) {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('제목');
        var TD = $('<TD />').attr('colspan', '3');
        var INPUT = $('<INPUT />');


        if (subject == 0) {
            var strText = (obj_subject_text[strThisCode] == null || obj_subject_text[strThisCode] == '') ? '※ 제목을 입력해 주세요.' : obj_subject_text[strThisCode];

            INPUT.attr({
                type: "text",
                name: "subject",
                value: strText,
                id: "subject",
                maxlength: 40
            }).addClass('g_text').bind({
                focus: function() {
                    if ($(this).val() == strText) {
                        $(this).val('')
                    }
                },
                blur: function() {
                    if ($(this).val() == '') $(this).val(strText)
                }
            });

            TD.append(INPUT);
            //checker.add({input:INPUT, type:'string', protect:true, message:'제목을 입력해 주세요'});
            checker.add({inputObj: INPUT, custom: fnCheck_Subject});
        }
        else if (subject == 1) {
            TD.text(obj_subject_text[strThisCode]);
        }

        if (strThisCode.substring(0, 2) == "A2") {
            TD.attr('colspan', '4');
        }
        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getContent: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />');
        var TD = $('<TD />').addClass("h_auto").attr('colspan', '3');
        var TEXTAREA = $('<TEXTAREA />');
        var strText = (obj_content_text[strThisCode] == null || obj_content_text[strThisCode] == '') ? '※ 상담내용을 입력해 주세요.' : obj_content_text[strThisCode];

        if (strThisCode.substring(0, 2) == "A2") {
            TH.text("내용 기재란");
        } else {
            TH.text('상담내용');
        }
        TR.append(TH);

        TEXTAREA.attr({
            name: "content",
            value: strText,
            id: "content"
        });

        TEXTAREA.bind({
            focus: function() {
                if ($(this).val() == strText) {
                    $(this).val('')
                }
            },
            blur: function() {
                if ($(this).val() == '') $(this).val(strText)
            }
        });

        TD.append(TEXTAREA);

        //checker.add({input:TEXTAREA, type:'string', protect:true, message:'상담내용을 입력해 주세요'});
        checker.add({inputObj: TEXTAREA, custom: fnCheck_Content});
        if (strThisCode.substring(0, 2) == "A2") {
            TD.attr('colspan', '4');
        }

        TR.append(TD);
        TR.attr("id", "TR_content");
        $(this).after(TR);

    },
    getUserId: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('아이디');
        var TD = $('<TD />');
        var INPUT = $('<INPUT />');
        var INPUT2 = $('<INPUT />');

        INPUT.attr({
            type: "text",
            name: "user_id"
        }).addClass('g_text');

        INPUT2.attr({
            type: "checkbox",
            name: "not_user_id"
        }).addClass('g_checkbox').bind({
            click: function() {
                if ($(this).prop('checked') == true) {
                    INPUT.attr('disabled', true);
                } else {
                    INPUT.attr('disabled', false);
                }
            }
        });

        TD.append(INPUT, " ", INPUT2, "아이디를 모를 경우 체크", $("<br />"), "(정확한 아이디를 기재해주셔야 빠른 조사가 가능합니다.)");
        TD.attr('colspan', '4');

        checker.add({inputObj: INPUT, custom: fnCheck_UserId});

        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getCharacter: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('캐릭명');
        var TD = $('<TD />');
        var INPUT = $('<INPUT />');
        var INPUT2 = $('<INPUT />');


        INPUT.attr({
            type: "text",
            name: "character"
        }).addClass('g_text');

        INPUT2.attr({
            type: "checkbox",
            name: "not_character"
        }).addClass('g_checkbox').bind({
            click: function() {
                if ($(this).prop('checked') == true) {
                    INPUT.attr('disabled', true);
                } else {
                    INPUT.attr('disabled', false);
                }
            }
        });


        TD.append(INPUT, " ", INPUT2, "캐릭명을 모를 경우 체크", $("<br />"), "(정확한 캐릭명을 기재해주셔야 빠른 조사가 가능합니다.)");
        TD.attr('colspan', '4');

        checker.add({inputObj: INPUT, custom: fnCheck_Character});

        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getCancelReason: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('취소사유선택');
        var TD = $('<TD />').addClass("h_auto");
        var INPUT = null;
        var TEXT = null;


        for (radioValue in obj_cancel_text) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "privates",
                value: obj_cancel_text[radioValue]
            }).addClass('g_radio').bind('click', function() {
                if (this.value == "기타 사유" || this.value == "상대방이 직거래 유도") {
                    $("#TR_content").attr('disabled', false);
                    $("#TR_content").show()
                    checker.add({inputObj: $("textarea[name='content']"), custom: fnCheck_Content});
                } else {
                    $("#TR_content").attr('disabled', true);
                    $("#TR_content").hide();
                    checker.free();
                }
            });

            TD.append(INPUT, obj_cancel_text[radioValue], $("<BR />"));

            if (radioValue == "g") {
                var bCheck = true;
            }
        }

        checker.add({inputObj: INPUT, custom: fnCheck_CancelReason});


        TR.append(TH);
        TR.append(TD);
        $(this).after(TR);

        if (bCheck == true) {
            $(TR).next().getContent();
            $("#TR_content").attr('disabled', true);
            $("#TR_content").hide();
        }
    },
    getCompleteReason: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('종료사유선택');
        var TD = $('<TD />').addClass("h_auto");
        var INPUT = null;
        var TEXT = null;


        for (radioValue in obj_complete_text) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "privates",
                value: obj_complete_text[radioValue]
            }).addClass('g_radio').bind('click', function() {
                if (this.value == "기타 사유") {
                    $("#TR_content").attr('disabled', false);
                    $("#TR_content").show()
                    checker.add({inputObj: $("textarea[name='content']"), custom: fnCheck_Content});
                } else {
                    $("#TR_content").attr('disabled', true);
                    $("#TR_content").hide();
                    checker.free();
                }
            });

            TD.append(INPUT, obj_complete_text[radioValue], $("<BR />"));

            if (radioValue == "d") {
                var bCheck = true;
            }
        }

        checker.add({inputObj: INPUT, custom: fnCheck_CompleteReason});


        TR.append(TH);
        TR.append(TD);
        $(this).after(TR);

        if (bCheck == true) {
            $(TR).next().getContent();
            $("#TR_content").attr('disabled', true);
            $("#TR_content").hide();
        }
    },
    getSelecter: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('선택문의');
        var TD = $('<TD />').addClass('h_auto');
        var INPUT = null;


        for (radioValue in obj_selecter) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "choice",
                value: obj_selecter[radioValue]
            }).addClass('g_radio');

            TD.append(INPUT, obj_selecter[radioValue], $("<BR />"));
        }

        //checker.add({input:INPUT, type:'string', protect:true, message:'제목을 입력해 주세요'});
        checker.add({inputObj: INPUT, custom: fnCheck_Selecter});
        TD.attr('colspan', '4');

        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getHacking: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('해킹여부');
        var TD = $('<TD />').addClass("h_auto");
        var INPUT = null;


        for (radioValue in obj_hacking) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "hacking",
                value: obj_hacking[radioValue]
            }).addClass('g_radio');

            TD.append(INPUT, obj_hacking[radioValue], $("<BR />"));
        }

        checker.add({inputObj: INPUT, custom: fnCheck_Hacking});

        TD.attr('colspan', '4');
        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getHackingInfo: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('해킹일자');
        var TD = $('<TD />').addClass("h_auto");
        var INPUT = null;


        for (radioValue in obj_hacking_info) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "hacking_date",
                value: obj_hacking_info[radioValue]
            }).addClass('g_radio');

            TD.append(INPUT, obj_hacking_info[radioValue], $("<BR />"));
        }

        checker.add({inputObj: INPUT, custom: fnCheck_HackingInfo});

        TD.attr('colspan', '4');
        TR.append(TH);
        TR.append(TD);

        $(this).after(TR);
    },
    getHackingCheck: function() {
        var TR = $('<TR />').addClass('m_tmp');
        var TH = $('<TH />').text('정보변경 확인');
        var TD = $('<TD />').addClass("h_auto");
        var INPUT = null;
        var DIV = null;
        var INPUT2 = null;

        for (radioValue in obj_hacking_check) {
            INPUT = $('<INPUT />', {
                type: "radio",
                name: "information",
                value: obj_hacking_check[radioValue]
            }).addClass('g_radio').bind({
                click: function() {
                    if ($(this).val() == "일부 변경함") {
                        $("#information_check").attr('disabled', false);
                        $("#information_check").show();
                    } else {
                        $("#information_check").attr('disabled', true);
                        $("#information_check").hide();
                    }
                }
            });

            TD.append(INPUT, obj_hacking_check[radioValue], $("<BR />"));

            if (radioValue == "a") {
                DIV = $("<DIV />");
                DIV.attr("id", "information_check");
                DIV.append("( ");
                for (checkValue in obj_hacking_check_b) {
                    DIV.append(obj_hacking_check_b[checkValue]);
                    INPUT2 = $("<INPUT />");
                    INPUT2.attr({
                        type: "checkbox",
                        name: "information_b[]",
                        value: obj_hacking_check_b[checkValue]
                    }).addClass("g_checkbox");
                    DIV.append(INPUT2);
                    DIV.append(" ");
                }
                DIV.append(")");
                DIV.append($('<br />'));
                DIV.append("* 변경한 정보를 체크해주세요.");
                DIV.attr('disabled', true);
                DIV.hide();
                TD.append(DIV);
            }
        }

        checker.add({inputObj: INPUT, custom: fnCheck_HackingCheck});

        TD.attr('colspan', '4');
        TR.append(TH);

        TR.append(TD);

        $(this).after(TR);
    },
    getUpLoad: function() {

        var TR = $('<TR />');
        var TR2 = $('<TR />');
        var TH = $('<TH />').attr('rowspan', 2).text('첨부파일');
        var TD = $('<TD />').attr('colspan', 4);
        var TD2 = $('<TD />').attr('colspan', 4).addClass('screenshot_sub').text('* 첨부파일 용량이 초과될 경우 itemmania@itemmania.com로 이메일 발송 후 고객감동센터(1544-8278)로 문의바랍니다.');
        var DIV = $('<DIV />').addClass('screenshot_wrap').attr('id', 'screenshot');
        var DIV2 = $('<DIV />').addClass('screen_guide').text('용량 300KB이하 jpg만 가능(최대 3개)');
        var SCREEN = $('<input />', {
            type: 'file',
            name: 'user_screen[]'
        });

        DIV.append(DIV2, SCREEN);
        TD.append(DIV);

        TR.append(TH, TD);
        TR2.append(TD2);

        $(this).after(TR, TR2);

        new FileStyle(document.querySelectorAll('[name="user_screen[]"]'), {btn: true, limit: 3});
    }
});

/* ▼ check CUSTOM */
function fnCheck_Subject() {
    if ($(this).val().isEmpty() || $(this).val() == '※ 제목을 입력해 주세요.') {
        alert('제목을 입력해 주세요.');
        $(this).focus();
        return false;
    }

    return true;
}

function fnCheck_Content() {
    if ($(this).val().isEmpty() || $(this).val() == '※ 상담내용을 입력해 주세요.' || $(this).val() == obj_content_text[strThisCode]) {
        alert('상담내용을 입력해 주세요');
        $(this).focus();
        return false;
    }

    return true;
}

function fnCheck_UserId() {
    if ($(this).val().isEmpty() && $(this).attr('disabled') == false) {
        alert("아이디를 입력해 주세요.");
        $(this).focus();
        return false;
    }
    return true;
}

function fnCheck_Character() {
    if ($(this).val().isEmpty() && $(this).attr('disabled') == false) {
        alert("캐릭명을 입력해 주세요.");
        $(this).focus();
        return false;
    }
    return true;
}

function fnCheck_CancelReason() {
    var bCheck = false;
    var frm = $('#form_member');
    var privates = frm.find('input[name="privates"]');

    if (frm.find('input[name="privates"]:checked').length < 1) {
        alert('취소사유를 선택해주세요.');
        return false;
    }
    return true;
}

function fnCheck_CompleteReason() {
    var bCheck = false;
    var frm = $('#form_member');
    var privates = frm.find('input[name="privates"]');

    if (frm.find('input[name="privates"]:checked').length < 1) {
        alert('종료사유를 선택해주세요.');
        return false;
    }
    return true;
}

function fnCheck_Selecter() {
    var bCheck = false;
    var frm = $('#form_member');

    if (frm.find('input[name="choice"]:checked').length < 1) {
        alert('선택문의를 선택해주세요.');
        return false;
    }

    return true;
}

function fnCheck_Hacking() {
    var bCheck = false;
    var frm = $('#form_member');

    if (frm.find('input[name="hacking"]:checked').length < 1) {
        alert('해킹여부를 선택해주세요.');
        return false;
    }
    return true;
}

function fnCheck_HackingInfo() {
    var bCheck = false;
    var frm = $('#form_member');

    if (frm.find('input[name="hacking_date"]:checked').length < 1) {
        alert('해킹일자를 선택해주세요.');
        return false;
    }

    return true;
}

function fnCheck_HackingCheck() {
    var bCheck = false;
    var frm = $('#form_member');

    if (frm.find('input[name="information"]:checked').length < 1) {
        alert("정보변경 확인을 선택해주세요.");
        return false;
    }
    return true;
}

/* ▲ check CUSTOM */

/* ▼ 접수하기버튼 처리 */
function fnImgBtn(code, strType)		// 신고서 작성 중 접수하기 버튼 숨김
{
    if (strType == "h") {
        $('#trade_list div.btn_red1').hide();
        if (code == "A2") $('#trade_non').hide();
    }
    else {
        $('#trade_list div.btn_red1').show();
        if (code == "A2") $('#trade_non').show();
    }

    if ($('#trade_list div.btn_red1').css('display') != "none") {
        $("#Form_table").hide();
    }
}

/* ▲ 접수하기버튼 처리 */

/* ▼ 비동기요청 */
function initXhr(seq, table, code, type, reflag, t_type) {
    var procPage = "";
    var paramsValue = "";

    procPage = "./trade_process";
    paramsValue = "seq=" + seq + "&table=" + table + "&code=" + code + "&type=" + type + "&reflag=" + reflag + "&key=trade" + seq + "777&t_type=" + t_type;
    fnAjax(procPage, 'text', 'POST', paramsValue, {complete: insertRs});
}

/* ▲ 비동기요청 */

/* ▼ 요청에 대한 결과 처리 */
function insertRs(request) {
    var rsText = request;

    var rsData = rsText.split("::###::");
    var form_member = $("#form_member");
    var sign_form = $("#signForm");
    var splitRs = rsData[0].split("::&&&::");
    var gsName = splitRs[5].split("|");
    var mCategory = rsData[2].substring(0, 4);

    form_member.find('input[name="trade_num"]').val(splitRs[0]);
    form_member.find('input[name="game_code"]').val(splitRs[3]);
    form_member.find('input[name="server_code"]').val(splitRs[4]);
    form_member.find('input[name="gs_name"]').val(splitRs[5]);

    if (mCategory == "A101" || mCategory == "A102") {
        sign_form.find('input[name="trade_num"]').val(splitRs[0]);
        sign_form.find('input[name="game_code"]').val(splitRs[3]);
        sign_form.find('input[name="server_code"]').val(splitRs[4]);
        sign_form.find('input[name="gs_name"]').val(splitRs[5]);
        sign_form.find("input[name='ct_name']").val(gsName[0] + " > " + gsName[1] + " > " + splitRs[12]);
        sign_form.find("input[name='subject']").val(splitRs[8]);
        sign_form.find("input[name='trade_money']").val(Number(splitRs[6]).currency());
        sign_form.find("input[name='m_type_table']").val(splitRs[11]);

        var user_id = sign_form.find('input[name="user_id"]').val();
        var seller_id = splitRs[1];
        var buyer_id = splitRs[2];

        if (user_id == buyer_id) {
            $("#counsel_end").hide();
        }

        if (rsData[3] == "y") {
            form_member.find('input[name="trade_num"]').val(splitRs[0]);
            $("#tradeNum").text(splitRs[0]);
        }
        else {
            if (rsData[2] == "A10101" && user_id == seller_id) {	// 판매자 취소요청(즉시취소)
                var a_code = rsData[2].substring(0, 2);
//				fnImgBtn(a_code);
                fnDirect();
            } else if ((rsData[2] == "A10101" && user_id == buyer_id) || (rsData[2] == "A10102" && user_id == seller_id)) {
                $("#tradeNum").text('');
                $("#tradeNum").text(splitRs[0]);
                g_nodeSleep.enable($('#dvPopup'));
            } else {
                $("#tradeNum").text('');
                $("#tradeNum").text(splitRs[0]);
                move_self_A1("01");
            }
        }

    } else if (mCategory == "A102") {
        $("#tradeNum").text('');
        $("#tradeNum").text(splitRs[0]);
        move_self_A1("02");
    } else {

        var trade_id0 = $("#TR_trade").find("TD").eq(0);
        var trade_id1 = $("#TR_trade").find("TD").eq(1);
        var trade_id2 = $("#TR_trade1").find("TD").eq(0);
        var trade_id3 = $("#TR_trade1").find("TD").eq(1);
        var trade_id6 = $("#TR_trade3").find("TD").eq(0);
        var trade_id7 = $("#TR_trade3").find("TD").eq(1);

        var tradeInfo = "[ 게임명: " + gsName[0] + " ]\r\n";
        tradeInfo += "[ 서버: " + gsName[1] + " ]\r\n";
        tradeInfo += "[ 물품제목: " + splitRs[8] + " ]\r\n";
        tradeInfo += "[ 거래금액: " + splitRs[6] + " ]\r\n";
        tradeInfo += "[ 입금확인일: " + splitRs[9] + " ]\r\n";
        tradeInfo += "[ 종료일시: " + splitRs[10] + " ]\r\n";

        form_member.find('input[name="trade_info"]').val(tradeInfo);		// 거래물품정보

        trade_id0.text("#" + splitRs[0]);
        trade_id1.text(splitRs[7]);
        trade_id2.text(gsName[0]);
        trade_id3.text(gsName[1]);
        trade_id6.text(splitRs[8]);
        trade_id7.text(Number(splitRs[6]).currency());

//		if (mCategory == "A202") {
//			move_self_A2(mCategory);
//		} else {
        if (rsData[4] != "" && rsData[4] != "undefined") {
            move_self_A2(rsData[1], rsData[4]);		// 거래종료건 > 판매종료내역, 이전 판매종료내역 구분값 전달
        } else {
            move_self_A2(rsData[1]);
        }
//		}

    }
}

/* ▲ 요청에 대한 결과 처리 */

/* ▼ 답변준비중, 답변완료 시 재문의 팝업관련 */
function fnReLayerShow(layer, hA_code, hCount, trade_id, getTable, return_c, code) {
    var hiddenFrm = $('#hiddenForm');

    hiddenFrm.find('input[name="hA_code"]').val(hA_code);
    hiddenFrm.find('input[name="hCount"]').val(hCount);
    hiddenFrm.find('input[name="iTrade_id"]').val(trade_id);
    hiddenFrm.find('input[name="iGetTable"]').val(getTable);
    hiddenFrm.find('input[name="iReturn_c"]').val(return_c);
    hiddenFrm.find('input[name="iCode"]').val(code);
    if (layer == "2") {
        g_nodeSleep.enable($("#dvPopup2"));
    } else {
        g_nodeSleep.enable($("#dvPopup3"));
    }
}

function fnReLayerHide() {
    var hiddenFrm = $('#hiddenForm');

    g_nodeSleep.disable();
    fnImgBtn(hiddenFrm.find('input[name="hA_code.value"]'));
    initXhr(hiddenFrm.find('input[name="iTrade_id"]').val(), hiddenFrm.find('input[name="iGetTable"]').val(), hiddenFrm.find('input[name="iReturn_c"]').val(), hiddenFrm.find('input[name="iCode"]').val());
}

/* ▲ 답변준비중, 답변완료 시 재문의 팝업관련 */

/* ▼ 거래 취소 요청시 판매자 즉시 취소 팝업관련 */
function fnDirect() {
    var signFrm = $('#signForm');
    var trade_id = signFrm.find('input[name="trade_num"]').val();
    var m_type_table = signFrm.find("input[name='m_type_table']").val();
    var m_type_realTable = m_type_table.split("_");
    m_type_realTable[1] = Base64.encode(m_type_realTable[1]);
    $('#frmIngView').find('input[name="id"]').val(trade_id);
    $("#cancel_trade_num").text("# " + trade_id);
    $("#cancel_trade_category").text(signFrm.find("input[name='ct_name']").val());
    $("#cancel_trade_title").text(signFrm.find("input[name='subject']").val());
    $("#cancel_trade_money").text(signFrm.find("input[name='trade_money']").val() + "원");
    $("input[name='trade_type']").val(m_type_realTable[1]);
    $("#SELECT_CANCEL").select("");
    g_nodeSleep.enable($("#trade_cancel"));
}

/* ▲ 거래 취소 요청시 판매자 즉시 취소 팝업관련 */

/* ▼ 거래 취소 사유선택 관련 */
function cancel_select(regData) {
    var cancelDetail = document.getElementById('cancelDetail');

    if (regData == '4') {
        cancelDetail.style.display = '';
    }
    else {
        cancelDetail.style.display = 'none';
    }
}

/* ▲ 거래 취소 사유선택 관련 */

/* ▼ 거래 즉시 취소/종료 */
function TraceCancel(process, tid, c_code) {
    var select_cancel = $('#SELECT_CANCEL')[0];
    var frm = $('#frmIngView');
    var strType = (c_code == "02") ? "종료" : "취소";

    if (c_code != "01" && c_code != "02") {
        alert("정상적인 경로를 이용하세요.[TDC001]");
        return false;
    }

    if (c_code == "01") {
        if (select_cancel.getValue() == "") {
            alert("취소사유를 선택해 주세요.");
            return false;
        }
        //	if(select_cancel.getValue() == "4" && $("#CANCEL_DETAIL_CONTENT").val() == "") {
        //		alert("사유내용을 기재해 주세요.");
        //		return false;
        //	}

        var reReg = "N";

        var input_obj1 = $('<input />', {
            type: 'hidden',
            name: 'cancel_contents',
            value: select_cancel.getValue()
        });
        var input_obj2 = $('<input />', {
            type: 'hidden',
            name: 'trade_rereg',
            value: reReg
        });
        input_obj1.appendTo(frm);
        input_obj2.appendTo(frm);
    }

    $("input[name='process']").val(process);

    if (confirm('거래를 ' + strType + '하겠습니까?')) {
//		alert($("input[name='id']").val());
//		alert($("input[name='process']").val());
//		alert($("input[name='trade_type']").val());
        frm.attr("action", "/myroom/sell/sell_ing_ok?mode=pass");
        frm.submit();
    }
    return false;
}

/* ▲ 거래 즉시 취소/종료 */

/* ▼ 거래취소 */
var element_trade_id;

function fnTrade_Ajax(trade_id, pMode) {
    element_trade_id = trade_id;

//	var paramsValue = _http.encodeURI("trade_id="+trade_id+"&pMode="+pMode);
    var paramsValue = "trade_id=" + trade_id + "&pMode=" + pMode;

    if (pMode == 'cancel') {
        fnAjax('/_include/_ACS_check_AJAX', 'text', 'POST', paramsValue, {complete: fnTrade_Cancel_Ajax_Complete});
    }
    else if (pMode == 'complete') {
        fnAjax('/_include/_ACS_check_AJAX', 'text', 'POST', paramsValue, {complete: fnTrade_Complete_Ajax_Complete});
//		new _xhr('/_include/_ACS_check_AJAX.html',{type:'POST',params:paramsValue},null,{complete:fnTrade_Complete_Ajax_Complete});
    }
    else {
        alert('관리자에게 문의 하세요.');
    }
}

function fnTrade_Cancel_Ajax_Complete(request) {
    returnData = request;

    if (returnData == "ERROR") {
        alert('데이터베이스의 접속이 원할하지 않습니다.\n\n문제가 지속된다면 고객센터 [1:1상담] 을 이용해주시길 바랍니다.\n\n이용에 불편을 드려 죄송합니다.');
    }
    else if (returnData == "DORMANT") {
        alert('상대 이용자가 정보통신망법 제29조 제2항에 의거 휴면회원 전환됨에 따라\n\n이용자 정보가 분리저장 되어 거래 진행이 불가 합니다.');
    }
    else if (returnData == "FALSE") {
        alert(returnData + '_고객님 마이룸에서 현재 거래건의 진행상태를 다시 한번 확인해주세요.\n\n문제가 지속된다면 고객센터 [1:1상담] 을 이용해주시길 바랍니다.\n\n이용에 불편을 드려 죄송합니다.');
    }
    else {
        if ($("#Form_table").css("display") == "block") {
            if (returnData == "ACS") {
                if (confirm('거래 취소 요청을 하겠습니까?')) {
                    var frm = $('#frmACS');
                    var frm1 = $('#form_member');

                    frm.find('input[name="acs_trade_id"]').val(element_trade_id);
                    frm.find('input[name="privates"]').val(frm1.find('input[name="privates"]:checked').val());


                    var private_index = frm1.find('input[name="privates"]').index(frm1.find('input[name="privates"]:checked'));

                    if (private_index == 6 || private_index == 3) {
                        frm.find('input[name="content"]').val(frm1.find('[name="content"]').val());
                    }

                    frm.find('input[name="user_phone1"]').val(frm1.find('[name="user_phone1"]').val());
                    frm.find('input[name="user_phone2"]').val(frm1.find('[name="user_phone2"]').val());
                    frm.find('input[name="user_phone3"]').val(frm1.find('[name="user_phone3"]').val());

//					frm.off('submit');
                    frm.attr('action', "buy_acs_cancel_ok.php").submit();
                }
            }
            else if (returnData == "BOARD") {
                if (confirm('접수 하시겠습니까?')) {
                    $('#form_member').off('submit');
                    $('#form_member').attr('action', '../report_ok.html').submit();
                }
            }
            else if (returnData == "FRIST") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup5"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else if (returnData == "SECOND") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup10"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else if (returnData == "THIRD") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup10more"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else {
                alert('관리자에게 문의 하세요.');
            }
        }
        else {
            if (returnData == "ACS") {
                if (confirm('거래 취소 요청을 하겠습니까?')) {
                    var frm = $('#frmACS');

                    frm.find('input[name="acs_trade_id"]').val(element_trade_id);
                    frm.attr('action', "buy_acs_cancel_ok").submit();
                }
            }
            else if (returnData == "BOARD") {
                g_nodeSleep.disable($('#dvPopup'));
                move_self_A1("01");
//				if(confirm('접수 하시겠습니까?'))
//				{
//					var frm = $('#signForm');
//
//					frm.find('input[name="c_code"]').val("01");
//					frm.submit();
//				}
            }
            else if (returnData == "FRIST") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup5"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else if (returnData == "SECOND") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup10"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else if (returnData == "THIRD") {
                /* ▼ 팝업 레이어 설정 및 뷰 */
                g_nodeSleep.disable();
                g_nodeSleep.enable($("#cancelPopup10more"));
                /* ▲ 팝업 레이어 설정 및 뷰 */
            }
            else {
                alert('관리자에게 문의 하세요.');
            }
        }
    }
}

/* ▲ 거래취소 */

/* ▼ 거래종료 */
function fnTrade_Complete_Ajax_Complete(request) {
    returnData = request;

    if (returnData == "ERROR") {
        alert('데이터베이스의 접속이 원할하지 않습니다.\n\n문제가 지속된다면 고객센터 [1:1상담] 을 이용해주시길 바랍니다.\n\n이용에 불편을 드려 죄송합니다.');
    }
    else if (returnData == "FALSE") {
        alert('고객님 마이룸에서 현재 거래건의 진행상태를 다시 한번 확인해주세요.\n\n문제가 지속된다면 고객센터 [1:1상담] 을 이용해주시길 바랍니다.\n\n이용에 불편을 드려 죄송합니다.');
    }
    else if (returnData == "DORMANT") {
        alert('상대 이용자가 정보통신망법 제29조 제2항에 의거 휴면회원 전환됨에 따라\n\n이용자 정보가 분리저장 되어 거래 진행이 불가 합니다.');
    }
    else {
        if (returnData == "NEXT") {
            if (confirm('거래 종료 요청을 하겠습니까?')) {
                var frm = $('#frmACS');
                frm.find('input[name="acs_trade_id"]').val(element_trade_id);
                frm.attr('action', "sell_acs_complete_ok.php").submit();
            }
        }
        else if (returnData == "CONFIRM") {
            /* ▼ 팝업 레이어 설정 및 뷰 */
            g_nodeSleep.disable();
            g_nodeSleep.enable($('#failPopup'));
            /* ▲ 팝업 레이어 설정 및 뷰 */
        }
        else if (returnData == "STOP") {
            /* ▼ 팝업 레이어 설정 및 뷰 */
            g_nodeSleep.disable();
            g_nodeSleep.enable($('#failPopup'));
            /* ▲ 팝업 레이어 설정 및 뷰 */
        }
        else if (returnData == "FRIST") {
            /* ▼ 팝업 레이어 설정 및 뷰 */
            g_nodeSleep.disable();
            g_nodeSleep.enable($('#endPopup5'));
            /* ▲ 팝업 레이어 설정 및 뷰 */
        }
        else if (returnData == "SECOND") {
            /* ▼ 팝업 레이어 설정 및 뷰 */
            g_nodeSleep.disable();
            g_nodeSleep.enable($('#endPopup10'));
            /* ▲ 팝업 레이어 설정 및 뷰 */
        }
        else if (returnData == "THIRD") {
            /* ▼ 팝업 레이어 설정 및 뷰 */
            g_nodeSleep.disable();
            g_nodeSleep.enable($('#endPopup10more'));
            /* ▲ 팝업 레이어 설정 및 뷰 */
        }
        else if (returnData == "BOARD") {
            if (confirm('거래 종료 요청을 하겠습니까?')) {
                var frm = $('#frmACS');
                frm.find('input[name="acs_trade_id"]').val(element_trade_id);
                frm.find('input[name="pMode"]').val('BOARD');
                frm.attr('action', "sell_acs_complete_ok.php").submit();
            }
        }
        else {
            alert('관리자에게 문의 하세요.');
        }
    }
}

/* ▲ 거래종료 */

/* ▼ Base64 encode_decode */
var Base64 = {

    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

    // public method for decoding
    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}
/* ▲ Base64 encode_decode */
