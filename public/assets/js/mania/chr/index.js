function _init(){

    var content = document.querySelectorAll('.banner_content');
    //var bannerCarousel = document.querySelector('.carousel_module');
    var gameGoodsCarousel = document.querySelectorAll('.games_goods_carousel');
    var moreBtn = document.querySelectorAll('.goods_more_btn');
    var characterMenu = document.querySelectorAll('.character_menu')
    var selectGoods = document.querySelectorAll('.goods');
    for(var i=0; i<content.length; i++)
    {
        var img = content[i].childNodes[1];
        content[i].style.height = img.height+'px';
    }

    //new Carousel(bannerCarousel, {showIndicate:true, showNavi: false});

    for(var i=0; i<gameGoodsCarousel.length; i++)
    {
        var goodsCarousel = gameGoodsCarousel[i].querySelector('.carousel_module');
        var item = goodsCarousel.querySelectorAll('.banner_item');
        if(item.length>0)
        {
            new Carousel(goodsCarousel, {showIndicate:true, showNavi: false,delay:20000, random:false});
        }

    }

    for(var i=0; i<characterMenu.length; i++)
    {
        characterMenu[i].addEventListener('click', function(){
            var code = this.getAttribute('data-code');
            var name = this.getAttribute('data-gamename');
            moreBtnAction(code,name);
        });
    }

    for(var i=0; i<moreBtn.length; i++)
    {
        moreBtn[i].addEventListener('click', function(){
            var code = this.getAttribute('data-code');
            var name = this.getAttribute('data-gamename');
            moreBtnAction(code, name);
        })
    }

    for(var i=0; i<selectGoods.length; i++)
    {
        selectGoods[i].addEventListener('click', function(e){
            var code = this.getAttribute('data-goods');

            selectGoodsAction(code);
        });
    }

}

function moreBtnAction(code, name){
    var form = document.getElementById("g_searchbar_form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "/sell/list.html");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "search_game");
    hiddenField.setAttribute("value", code);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "search_game_text");
    hiddenField.setAttribute("value", name);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "search_server");
    hiddenField.setAttribute("value", 0);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "search_server_text");
    hiddenField.setAttribute("value", '서버전체');
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "search_goods");
    hiddenField.setAttribute("value", 'character');
    form.appendChild(hiddenField);

    form.submit();
}

function selectGoodsAction(code){

    ajaxRequest({
        url: 'ajax_trade_check.php',
        type: 'post',
        dataType: 'json',
        data: {
            'trade_id': code
        },
        async: false,
        success: function (res) {
            switch (res.result) {
                case 'SUCCESS':
                    location.href = 'http://trade.itemmania.com/sell/view.html?id='+code;
                    break;
                case 'FAIL':
                    alert(res.msg);
                    break;
            }
        },
        error: function (e) {
            alert('서버와의 접속이 원활하지 않습니다.\n잠시후 다시 시도해주세요.' + e.message);
            return;
        }
    });
}