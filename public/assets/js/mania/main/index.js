var service_list_clone;
function _init() {
	fnPopup();

	//////// Center Banner Rolling function 180312 나상권 ////////
	// Get Banner List
	// var CRbannerList = Array.prototype.slice.call(document.querySelector('#center_banner').children);
	// var CRbannerIdx = CRbannerList.indexOf(document.querySelector('#center_banner > .banner_on'));
	// var CRmouseover = false;
	// var rollerCBanner = function (target) { // ITM-8173 나상권
	//     var selobjli = target || ($("#banner_text li.selected").next()[0] ? $("#banner_text li.selected").next() : $("#banner_text li.first"));
	//     var objli = $("#banner_text li");
	//     objli.removeClass("selected");
	//     $("#trade_banner").find("div").hide();
	//     $("#trade_banner").find("div").eq(objli.index(selobjli)).show();
	//     objli.eq(objli.index(selobjli)).addClass("selected");
	//     CRbannerIdx = objli.index(selobjli); // Center Banner Rolling function 180312 나상권
	// }
	//
	// var CRbannerRollInterval = setInterval(function () {
	//     if (CRmouseover) return;
	//     rollerCBanner();
	//     CRbannerIdx++;
	//     if (CRbannerIdx >= CRbannerList.length) CRbannerIdx = 0;
	// }, 4000);

	$("#trade_banner").mouseenter(function () {
	    CRmouseover = true;
	});

	$("#trade_banner").mouseleave(function () {
	    CRmouseover = false;
	});

	$('#serviceBtn > a').click(moveServiceList);
	$('#chargeBtn > a').click(moveChargeList);
	$('#power_indicate').find('span').click(movePowerList);

	LayerControl({
		el: document.getElementById('service_btn'),
		layer: document.getElementById('service_layer'),
		close_btn: document.getElementById('service_close'),
		type: 'style'
	});

	$('#service_btn').on('click', function () {
        service_list_clone = $('.service_list').html();
    });

    $('#service_close').on('click', function () {
        $('.service_list').html(service_list_clone);
        service_list_clone = '';
    });

	moveServiceList();
}

/* 나만의 서비스 설정 */
(function() {
	$(document).on('click', '.service_list_btn', function() {
		if ($(this).find(':checked').length > 0) {
			this.classList.add('on');
		} else {
			this.classList.remove('on');
		}
	});

	$('#service_save').click(function() {
		var checkList = $('#service_list').find(':checked');
		if (checkList.length < 8) {
			alert('8개 메뉴를 선택하셔야 저장이 가능합니다.');
			return;
		}
		if (checkList.length > 8) {
			alert('8개까지 선택하실 수 있습니다.');
			return;
		}

		var strParam = checkList.serializeArray();
        ajaxRequest({
            url : '/_ajax/my_service.php',
            dataType : 'json',
            type : 'post',
            data : strParam ,
            success : function (res) {
                alert(res.msg);
                if(res.result === "SUCCESS") {
                	window.location.reload();
				}
				return;
            },
            error : function () {
                alert('서버와 접속이 원활하지 않습니다.');
                return;
            }
        });
	});

	$('#service_init').click(function() {
		$('.service_list_btn').removeClass('on');
		$('.service_list_btn').find(':checked').prop('checked', false);
	});
})();
/* 나만의 서비스 설정 */

/* ▼ 롤링 함수 */
function moveChargeList() {
	var rType = $(this).attr('data-type');
	if (rType === undefined) {
		rType = 'n';
	}

	var nowObj = $('#charge_list > ul:visible');

	switch (rType) {
	case 'p':		// 이전배너
		nowObj.hide();
		if (nowObj.prev('ul').length < 1) $('#charge_list > ul:last').show();
		else nowObj.prev('ul').show();
		break;
	case 'n':		// 다음배너
	default :
		nowObj.hide();
		if (nowObj.next('ul').length < 1) $('#charge_list > ul:first').show();
		else nowObj.next('ul').show();
		break;
	}
}

var nBanner = -1;
function moveServiceList() {
	var serviceList = [
		{img: 'img_service01.jpg', link: 'http://giftcard.itemmania.com/portal/giftcard/'}, // 상품권몰
		{img: 'img_service03.jpg', link: 'http://blog.itemmania.com/', target:'_blank'}, // IMI스토리
		{img: 'img_service04.jpg', link: '/guide/add/mobile.html'}, // 모바일 서비스
		{img: 'img_service05.jpg', link: 'http://www.itemmania.com/counter/survey.php?imcounter=banner_tradebn_tmmservers&returnUrl=' + encodeURIComponent('http://trade.itemmania.com/event/event_ing/e131105_marketprice_guide/')},		// 매니아시세
		{img: 'img_service06.jpg?190909', link: 'http://www.itemmania.com/portal/free_coupon/?game_genre=99'}, // 게임쿠폰
		{img: 'img_service07.jpg', link: 'http://www.itemmania.com/portal/maniaplay/free/'}, // 스폰서충전
		{img: 'img_service08.jpg', link: 'http://www.itemmania.com/portal/guide/pointcharge.html'}, // 포인트충전
		{img: 'img_service09.jpg', link: 'http://ssadaprice.itemmania.com/', target:'_blank'}, // 싸다프라이스
		{img: 'img_service10.jpg', link: 'http://www.itemmania.com/portal/free_coupon/'},// 모바일 급상승 게임
		// {img: 'img_service11.jpg', link: 'http://www.itemmania.com/event/event_ing/e190408_lotto/', target:'_blank'},// 로또추천번호
		{img: 'img_service14.jpg', link: 'http://www.itemmania.com/portal/pluszone/'}// 플러스존
	];

	/*
	if(document.getElementsByName('new_except')[0].value === '') {
		serviceList.push({img: 'img_service12.jpg', link: 'http://www.itemmania.com/portal/fulltv/index.html', target:'_blank'}); // 라이브TV
	}
	 */

	var rType = $(this).attr('data-type');
	if (rType === undefined) {
		rType = 'n';
	}

	switch (rType) {
	case 'p':		// 이전배너
		nBanner--;
		nBanner = (nBanner < 0) ? serviceList.length - 1 : nBanner;
		break;
	case 'n':		// 다음배너
	default :
		nBanner++;
		nBanner = (nBanner >= serviceList.length) ? 0 : nBanner;
		break;
	}

	document.getElementById('mania_bn').innerHTML = '<a href="' + serviceList[nBanner].link + '" '+((serviceList[nBanner].target !== undefined) ? "target=\""+ serviceList[nBanner].target +"\"":"")+'><img src="' + IMG_DOMAIN4 + '/new_images/main/' + serviceList[nBanner].img + '" width="328" height="143" alt=""></a>';
}
/* ▲ 롤링 함수 */

function movePowerList() {
	var indecate = $('#power_indicate').find('span');
	var plist = $('#power_list').find('li');
	var on = $('#power_list').find('.on');
	var idx = indecate.index($(this));
	if(plist.index(on) === idx) {
		return;
	}
	if(idx < 0) {
		idx = 0;
	}
	var sliceEnd = (idx + 1) * 12;
	var sliceStart = (sliceEnd - 12) < 0 ? 0 : sliceEnd - 12;
	plist.addClass('g_hidden');
	plist.slice(sliceStart, sliceEnd).removeClass('g_hidden');
	indecate.removeClass('on');
	$(this).addClass('on');
}

/* ▼ 관리자 공지 팝업 */
function fnPopup() {
	// try {
	// 	ajaxRequest({
	// 		url: '/tmp/popup_notice.xml',
	// 		dataType: 'xml',
	// 		type: 'get',
	// 		success: function(xml) {
	// 			if ($(xml).find('LIST').attr('applys') === 'Y') {
	// 				_window.open('popup_notice', '/_banner/popup_notice.html', 500, 380);
	// 			}
	// 		}
	// 	});
	// } catch (e) {}
}
/* ▲ 관리자 공지 팝업 */


var timer;
/* ▼ 롤링 배너 함수 */
function bannerRolling(bannerSelector) {
	var crOnMouseOver = false;
	var $crArea = $(bannerSelector);
	var $bannerArea = $crArea.find('.banner_in');
	var $bannerIndicator = $crArea.find('.banner_indicate');
	var bannerArrLength = $bannerArea.children().length;
    var random = Math.floor(Math.random() * $bannerArea.find('.banner_item').length);

	for (var iForBA = 0; iForBA < bannerArrLength; iForBA++) {
		$bannerIndicator.append('<span></span> ');
	}

	// 클릭이벤트 추가
	$bannerIndicator.find('span').click(function(e) {
		var targetIdx = $(e.target).index();

		$(e.target).siblings().removeClass('on');
		$(e.target).addClass('on');

		$crArea.find('.banner_in').children().removeClass('banner_on');
		$($crArea.find('.banner_in').children()[targetIdx]).addClass('banner_on');

		clearTimeout(timer);

		crOnMouseOver = true;
		timer = setTimeout(function() {
			crOnMouseOver = false;
		}, 3000);
	});

	// 출력시 처음 배너를 활성상태로 변경
	$bannerArea.find('.banner_item').eq(random).addClass('banner_on');
    $bannerIndicator.find('span').eq(random).addClass('on');

	// 자동롤링, 배너가 한개면 안함
	if (bannerArrLength > 1) {
		setInterval(function() {
			// 마우스오버시 자동롤링 안함
			if (crOnMouseOver) return;

			var $currentBanner = $bannerArea.find('.banner_item.banner_on');
			var $currentBannerIndi = $bannerIndicator.find('span.on');
			var $nextBanner = $currentBanner.next().length !== 0 ? $currentBanner.next() : $bannerArea.find('.banner_item').eq(0);
			var $nextBannerIndi = $currentBannerIndi.next().length !== 0 ? $currentBannerIndi.next() : $bannerIndicator.find('span').eq(0);

			$currentBanner.removeClass('banner_on');
			$currentBannerIndi.removeClass('on');
			$nextBanner.addClass('banner_on');
			$nextBannerIndi.addClass('on');
		}, 3000);

		// 마우스오버, 아웃 체크
		$bannerArea.mouseover(function() {
			clearTimeout(timer);
			crOnMouseOver = true;
		});
		$bannerArea.mouseout(function() {
			timer = setTimeout(function() {
				crOnMouseOver = false;
			}, 3000);
		});
	}
}
/* ▲ 롤링 배너 함수 */

bannerRolling('#center_rolling_banner'); // 중앙 롤링 배너
bannerRolling('.gamemania'); // 게임매니아 롤링 배너
