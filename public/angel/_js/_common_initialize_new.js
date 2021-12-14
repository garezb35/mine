function _header() {
    var h = document.getElementById("g_searchbar_form");
    if(h !== null) {
        var c = h.querySelector('[name="search_game"]');
        var g = h.querySelector('[name="search_server"]');
        var d = h.getElementsByClassName("g_search_frame")[0];
        new GameServerList(h.querySelector('[data-gslist="true"]'), {
            formElement: h,
            containerWrapper: d,
            toggleContainer: d.getElementsByClassName("initial_screen")[0],
            game: {
                gameCode: c.value
            },
            server: {
                updownIndex: 2,
                use: true,
                gameCode: c.value,
                serverCode: g.value,
                onCustomChange: function() {
                    if(c.value.isEmpty() === true && g.value.isEmpty() === true) {
                        return
                    }
                    if(this.goodsCode !== undefined) {
                        h.querySelector('[name="search_goods"]').value = this.goodsCode
                    } else {
                        h.querySelector('[name="search_goods"]').value = ""
                    }
                    var l = (g.value === "0") ? "list" : "list_search";
                    var k = h.querySelector('[name="search_type"]:checked').value;
                    var m = "/" + k + "/" + l;
                    h.action = m;
                    _myService.setLastSearch();
                    h.submit()
                }
            }
        })
    }
    var j = document.getElementById("quickmenu_dtl");
    if(j !== null) {
        var i;
        var e = document.getElementById("quickmenu_area");
        var b = document.getElementById("quickmenu");

        document.getElementById("quickmenu_close").addEventListener("click", function() {
            e.classList.remove("qickmenu_on");
            $(b).addClass("close");
            $(b).children().removeClass("on")
        });
        $(b).find("li").click(function() {
            var k = $(this).find("a").attr("data-type");
            if(k) {
                var l = e.classList.contains("qickmenu_on");
                if(l === true && i === k) {
                    e.classList.remove("qickmenu_on");
                    $(b).addClass("close");
                    $(b).children().removeClass("on");
                    $("#topbar-left").css('display','none')
                    return
                }
                if(l === false) {
                    e.classList.add("qickmenu_on");
                    $(b).removeClass("close");
                    $(b).children().eq(0).addClass("on")
                }
                $(b).children().removeClass("on");
                $(this).addClass("on");
                $("#topbar-left").css('display','block')
                var position = $("#topbar-left").position();

            }
        })
    }
    if(document.getElementById("all_menu") !== null) {
        $("#all_menu").on("click", function() {
            ajaxRequest({
                url: "/html/sitemap",
                dataType: "html",
                success: function(k) {
                    $("#all_menu_layer").find(".inner").append(k);
                    $("#all_menu").off("click")
                }
            })
        });
        LayerControl({
            el: document.getElementById("all_menu"),
            layer: document.getElementById("all_menu_layer"),
            close_btn: document.getElementById("menu_close"),
            type: "style"
        })
    }

    if(document.getElementById("top_btn") !== null) {
        document.getElementById("top_btn").addEventListener("click", function() {
            var k = (document.documentElement || document.body);
            k.scrollTop = 0
        })
    }
    if(document.getElementById("alarm_noti") !== null) {
        var f = document.getElementById("alarm_noti");
        ajaxRequest({
            url: "/api/myroom/goods_alarm/_ajax_process",
            type: "post",
            dataType: "json",
            data: {
                mode: "new",
                api_token: a_token
            },
            async: false,
            success: function(k) {
                if(k.DAT == "Y") {
                    f.querySelector(".new_alarm").classList.add("on")
                } else {
                    f.querySelector(".new_alarm").classList.remove("on")
                }
            },
            error: function(k) {
                alert("서버와의 접속이 원활하지 않습니다.\n잠시후 다시 시도해주세요." + k.message);
                return
            }
        })
    }
    if(document.getElementById("dialog_close") !== null) {
        var a = document.getElementById("dialog_close");
        a.addEventListener("click", function() {
            dialogAction(function() {
                a.parentNode.style.display = "none"
            })
        })
    }
    if(document.getElementById("dialog_move") !== null) {
        document.getElementById("dialog_move").addEventListener("click", function() {
            dialogAction(function() {
                location.href = "/myroom/goods_alarm/alarm_sell_list.html"
            })
        })
    }
}

function searchbarSubmit() {

    var f = document.getElementById("g_searchbar_form");
    var h = f.querySelector('[name="search_game"]');
    var c = f.querySelector('[name="search_server"]');
    var a = h.value;
    var g = c.value;
    var b = f.querySelector('[name="search_type"]:checked').value;
    var d = (g === "0" || g === "") ? "list" : "list_search";
    var e = "/" + b + "/" + d;
    if(a.isEmpty()) {
        alert("게임을 선택해주세요.");
        return false
    } else {
        _myService.setLastSearch()
    }
    f.action = e;
    return true
}

function dialogAction(a) {
    ajaxRequest({
        url: "/api/myroom/goods_alarm/_ajax_process",
        type: "post",
        dataType: "json",
        data: {
            mode: "new_layer",
            api_token:a_token
        },
        async: false,
        success: function(b) {
            a()
        },
        error: function(b) {
            alert("서버와의 접속이 원활하지 않습니다.\n잠시후 다시 시도해주세요." + b.message);
            return
        }
    })
};
