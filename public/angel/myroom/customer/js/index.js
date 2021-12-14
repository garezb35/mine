(function() {
    var service = document.getElementById('service_list');
    var serviceList = service.childNodes;

    $(serviceList).click(function() {
        if ($(this).find(':checked').length > 0) {
            this.classList.add('on');
        } else {
            this.classList.remove('on');
        }
    });

    $('#service_save').click(function() {
        var checkList = $(service).find(':checked');
        if (checkList.length < 8) {
            alert('8개 메뉴를 선택하셔야 저장이 가능합니다.');
            return;
        }
        if (checkList.length > 8) {
            alert('8개까지 선택하실 수 있습니다.');
            return;
        }

        var strParam = checkList.serializeArray();
        var param = {};
        param.api_token = a_token;
        param.list = strParam;
        ajaxRequest({
            url : '/api/_ajax/my_service',
            dataType : 'json',
            type : 'post',
            data : param ,
            success : function (res) {
                alert(res.msg);
                if(res.result === "SUCCESS") {
                    window.location.reload();
                }
                return;
            },
            error : function (err) {
                alert('서버와 접속이 원활하지 않습니다.');
                return;
            }
        });
    });

    $('#service_init').click(function() {
        $(serviceList).removeClass('on');
        $(serviceList).find(':checked').prop('checked', false);
    });
})();
