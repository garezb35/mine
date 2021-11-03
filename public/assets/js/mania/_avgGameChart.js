window.requestAFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || function(a) {
        return window.setTimeout(a, 1000 / 60)
    }
})();
window.cancelAFrame = (function() {
    return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.oCancelAnimationFrame || function(a) {
        window.clearTimeout(a)
    }
})();
var fSs, findE, canvas, x2js = new X2JS(),
    gameChart, gameChartDataGame, gameChartDataServer, gameChartFilterDataGame, gameChart_XY_mapData, gameChartTitleStatus = 0,
    gameChart_ServerListDefaultWidth = 165,
    gameChart_ServerListmaxWidth = 0,
    gameChart_ServerList_WrapperIndex = 0,
    gameChart_ListServerCode = 0,
    canvasLayer = ["lineLayer", "circleLayer", "mouseOverLayer"],
    gameChart_title = "최근 시세현황",
    gameChart_DOM_create = "",
    onText = "",
    gameChart_priceUpdown = "",
    gameChart_browser = navigator.userAgent.toLocaleLowerCase(),
    gameChart_Element = document.getElementById("gameChart"),
    cacheDate = new Date();
if (cacheDate.getHours() >= 6) {
    var cacheDateString = cacheDate.getFullYear() + ("0" + (cacheDate.getMonth() + 1)).slice(-2) + ("0" + cacheDate.getDate()).slice(-2)
} else {
    var cacheDateString = cacheDate.getFullYear() + ("0" + (cacheDate.getMonth() + 1)).slice(-2) + ("0" + (cacheDate.getDate() - 1)).slice(-2)
}
findE = function(a) {
    return document.querySelectorAll(a).length == 1 ? document.querySelectorAll(a)[0] : document.querySelectorAll(a)
};
fSs = {
    statusChange: function(a) {
        switch (a) {
            case "gameChartTitleStatus":
                gameChartTitleStatus = 1;
                break;
            default:
                return
        }
    },
    comma: function(c) {
        var b, a, d;
        c = c + "";
        a = c.length % 3;
        b = c.length;
        d = c.substring(0, a);
        while (a < b) {
            if (d != "") {
                d += ","
            }
            d += c.substring(a, a + 3);
            a += 3
        }
        return d
    },
    getAvgPrice: function(b) {
        var c, e, f = 0,
            d = "";
        gameChartFilterDataGame.server.filter(function(g) {
            if (g._code == b) {
                c = g;
                return
            }
        });
        if (c.price === undefined) {
            c.price = []
        }
        if (Array.isArray(c.price) === false) {
            var a = c.price;
            c.price = [];
            c.price[0] = a
        }
        c.price.map(function(h, g) {
            f = Number(h.__text);
            if (g == c.price.length - 1) {
                return
            }
            d = Number(h.__text)
        });
        e = {
            avgPrice: Math.round(f),
            prevPrice: (d !== "") ? Math.round(d) : ""
        };
        return e
    },
    hasClass: function(b, a) {
        return !!b.className.match(new RegExp("(\\s|^)" + a + "(\\s|$)"))
    },
    addClass: function(b, a) {
        if (!this.hasClass(b, a)) {
            b.className += " " + a
        }
    },
    removeClass: function(c, a) {
        if (this.hasClass(c, a)) {
            var b = new RegExp("(\\s|^)" + a + "(\\s|$)");
            c.className = c.className.replace(b, " ")
        }
    },
    clearChart: function() {
        var a, b;
        canvasLayer.map(function(c) {
            a = document.getElementById(c);
            b = a.getContext("2d");
            b.clearRect(0, 0, a.width, a.height)
        })
    }
};
gameChart = {
    getData: function() {
        var a = "/assets/_xml/avgPriceXml/gamechart.xml?" + cacheDateString;
        if (gameChart_browser.indexOf("trident") != -1) {
            objDoc = new ActiveXObject("MSXML.DOMDocument");
            objDoc.async = false;
            objDoc.load(a)
        } else {
            xhttp = new XMLHttpRequest();
            xhttp.open("GET", a, false);
            xhttp.send();
            objDoc = xhttp.responseXML
        }
        return objDoc
    },
    gameChartclearDOM: function(a) {
        a.innerHTML = ""
    },
    gameChartArrowChange: function(b) {
        var a = document.getElementById("gameChart_server_wrap_all"),
            c = b.getAttribute("data-arrow");
        gameChart_ServerList_WrapperIndex = c == "right" ? gameChart_ServerList_WrapperIndex + 1 : gameChart_ServerList_WrapperIndex - 1;
        if (gameChart_ServerList_WrapperIndex < 0) {
            gameChart_ServerList_WrapperIndex = 0
        }
        if (gameChart_ServerList_WrapperIndex >= a.childNodes.length - 1) {
            gameChart_ServerList_WrapperIndex = a.childNodes.length - 1
        }
        if (gameChart_ServerList_WrapperIndex == 0) {
            fSs.addClass(findE(".gamechart_arrow_left"), "gamechart_arrow_disabled")
        } else {
            fSs.removeClass(findE(".gamechart_arrow_left"), "gamechart_arrow_disabled")
        }
        if (gameChart_ServerList_WrapperIndex == a.childNodes.length - 1) {
            fSs.addClass(findE(".gamechart_arrow_right"), "gamechart_arrow_disabled")
        } else {
            fSs.removeClass(findE(".gamechart_arrow_right"), "gamechart_arrow_disabled")
        }
        if (c == "right") {
            a.style.left = -(gameChart_ServerListDefaultWidth * gameChart_ServerList_WrapperIndex) + "px"
        } else {
            a.style.left = -(gameChart_ServerListDefaultWidth * gameChart_ServerList_WrapperIndex) + "px"
        }
    },
    gmmeChartDomCreate: function() {
        gameChart_DOM_create += '<div class="gameChart_title_list"></div><div class="gameChart_server_list_area"></div><div class="gameChart_drawGraph_area"><div class="gameChart_drawGraph_title"></div><div class="gameChart_drawGraph_wrap"><div class="gameChart_drawGraph"></div><div class="gameChart_drawGraph_basePrice"></div><div class="gameChart_drawGraph_date_list"></div></div></div>';
        gameChart_Element.insertAdjacentHTML("beforeend", gameChart_DOM_create);
        gameChart_DOM_create = "";
        canvasLayer.map(function(b, a) {
            canvas = document.createElement("canvas");
            canvas.id = b;
            canvas.width = 445;
            canvas.height = 125;
            canvas.style.zIndex = a;
            canvas.style.position = "absolute";
            canvas.style.top = "0px";
            canvas.style.left = "0";
            canvas.style.cursor = "pointer";
            findE(".gameChart_drawGraph").appendChild(canvas)
        })
    },
    gmmeChartGameListDomCreate: function() {
        gameChartDataGame.map(function(b, a) {
            if (a == 0) {
                onText = "game_on"
            } else {
                onText = ""
            }
            gameChart_DOM_create += '<div class="gameChart_server_title ' + onText + '" onclick="gameChart.gameChartDomCreateStart(' + b._code + ', this)" data-type="game">' + b._name + "</div>"
        });
        findE(".gameChart_title_list").insertAdjacentHTML("beforeend", gameChart_DOM_create);
        gameChart_DOM_create = "";
        fSs.statusChange("gameChartTitleStatus")
    },
    gmmeChartServerListDomCreate: function(a, b) {
        gameChartFilterDataGame = gameChartDataGame.filter(function(d, c) {
            if (a == d._code) {
                return d
            }
        })[0];
        gameChart_ServerListmaxWidth = Number(gameChart_ServerListDefaultWidth * (Math.ceil(gameChartFilterDataGame.server.length / 4)));
        if (!b) {
            this.gameChartclearDOM(findE(".gameChart_server_list_area"));
            gameChart_DOM_create = '<div class="gameChart_server_list_title">' + gameChart_title + '</div><div class="gameChart_server_wrap_all" id="gameChart_server_wrap_all" style="width:' + gameChart_ServerListmaxWidth + 'px">';
            gameChartFilterDataGame.server.map(function(d, c) {
                gameChart_priceUpdown = '<span class="priceArrow arrowSame">-</span>';
                if (fSs.getAvgPrice(d._code).prevPrice !== "") {
                    if (fSs.getAvgPrice(d._code).avgPrice > fSs.getAvgPrice(d._code).prevPrice) {
                        gameChart_priceUpdown = '<span class="priceArrow mania-blue">▲</span>'
                    } else {
                        if (fSs.getAvgPrice(d._code).avgPrice == fSs.getAvgPrice(d._code).prevPrice) {
                            gameChart_priceUpdown = '<span class="priceArrow arrowSame">-</span>'
                        } else {
                            gameChart_priceUpdown = '<span class="priceArrow mania-red">▼</span>'
                        }
                    }
                }
                onText = c == 0 ? "server_on" : "";
                if (c % 4 == 0) {
                    gameChart_DOM_create += '<div class="gameChart_server_wrap" data-index="' + c / 4 + '">'
                }
                gameChart_DOM_create += '<div class="gameChart_server ' + onText + '" onclick="gameChart.gameChartDomCreateStart(' + a + ', this)" data-type="server" data-code="' + d._code + '"><div class="server_name">' + d._name + '</div><div class="server_price">' + fSs.comma(fSs.getAvgPrice(d._code).avgPrice) + " " + gameChart_priceUpdown + "</div></div>";
                if (c % 4 == 3) {
                    gameChart_DOM_create += "</div>"
                } else {
                    if (c == gameChartFilterDataGame.server.length - 1) {
                        gameChart_DOM_create += "</div>"
                    }
                }
            });
            onText = gameChartFilterDataGame.server.length - 1 <= 3 ? "gamechart_arrow_disabled" : "";
            gameChart_DOM_create += '</div><div class="gamechart_arrow_wrap"><div class="gamechart_arrow gamechart_arrow_left gamechart_arrow_disabled" onclick=gameChart.gameChartArrowChange(this) data-arrow="left"></div><div class="gamechart_arrow gamechart_arrow_right ' + onText + '" onclick=gameChart.gameChartArrowChange(this) data-arrow="right"></div></div>';
            findE(".gameChart_server_list_area").insertAdjacentHTML("beforeend", gameChart_DOM_create);
            gameChart_DOM_create = ""
        }
    },
    gameChartDrawAreaBaseCreate: function(b) {
        gameChartDataServer = gameChartFilterDataGame.server.filter(function(e, d) {
            if (b == e._code) {
                return e
            }
        })[0];
        if (Array.isArray(gameChartDataServer.price) === false) {
            gameChartDataServer.price[0] = gameChartDataServer.price
        }
        var a = gameChartDataServer._standardUnit.substr(-1);
        var c = gameChartDataServer._standardUnit.replace(a, "");
        if (a === "일") {
            a = ""
        }
        gameChart_DOM_create = '<span><span class="mania-blue">' + gameChartFilterDataGame._name + " |</span> " + gameChartDataServer._name + "</span> (기준 " + c.currency() + a + " " + gameChartDataServer._Unit + ')<a class="mania-blue-btn gameChart_drawGraph_title_Btn" href="http://trade.itemmania.com/sell/list_search.html?search_type=sell&search_game=' + gameChartFilterDataGame._code + "&search_game_text=" + gameChartFilterDataGame._name + "&search_server=" + gameChartDataServer._code + "&search_server_text=" + gameChartDataServer._name + '">거래하러가기</a>';
        findE(".gameChart_drawGraph_title").innerHTML = gameChart_DOM_create;
        gmaeChart_DOM_create = "<div>" + fSs.comma(fSs.getAvgPrice(b).avgPrice * 2) + "</div><div>" + fSs.comma(fSs.getAvgPrice(b).avgPrice) + "</div><div>0</div>";
        findE(".gameChart_drawGraph_basePrice").innerHTML = gmaeChart_DOM_create;
        gameChart_DOM_create = "";
        gameChartDataServer.price.map(function(e, d) {
            gameChart_DOM_create += "<div>" + e._day + "</div>"
        });
        findE(".gameChart_drawGraph_date_list").innerHTML = gameChart_DOM_create;
        gameChart_DOM_create = ""
    },
    gamChartCanvasChartData: function() {
        fSs.clearChart();
        var a = [],
            b = (fSs.getAvgPrice(gameChartDataServer._code).avgPrice * 2) / 100;
        a = gameChartDataServer.price.map(function(d, c) {
            return {
                x: 37 * (c + 1),
                y: 125 - (Math.ceil(d.__text / b) * 1.25)
            }
        });
        if (a.length > 0) {
            this.gameChartdrawLine(a)
        }
    },
    gameChartdrawLine: function(a) {
        var b = findE("#lineLayer");
        ctx = b.getContext("2d");
        ctx.lineWidth = 1.5;
        ctx.strokeStyle = "#3D9FFF";
        ctx.beginPath();
        ctx.moveTo(a[0].x, a[0].y);
        a.map(function(c) {
            ctx.lineTo(c.x, c.y)
        });
        ctx.stroke();
        this.gameChartdrawCircle(a)
    },
    gameChartdrawCircle: function(a) {
        var b = findE("#circleLayer");
        ctx = b.getContext("2d");
        a.map(function(c) {
            ctx.fillStyle = "#3D9FFF";
            ctx.beginPath();
            ctx.arc(c.x, c.y, 6, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill();
            ctx.beginPath();
            ctx.fillStyle = "white";
            ctx.arc(c.x, c.y, 4, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill()
        });
        gameChart_XY_mapData = a
    },
    gameChartDomCreateStart: function(a, b) {
        if (!gameChartTitleStatus) {
            this.gmmeChartDomCreate();
            this.gmmeChartGameListDomCreate()
        }
        if (b) {
            if (b.getAttribute("data-type") == "game") {
                Array.prototype.forEach.call(findE(".gameChart_server_title"), function(c) {
                    fSs.removeClass(c, "game_on")
                });
                fSs.addClass(b, "game_on");
                gameChart_ListServerCode = 0;
                this.gmmeChartServerListDomCreate(a);
                this.gameChartDrawAreaBaseCreate(gameChartFilterDataGame.server[0]._code)
            } else {
                Array.prototype.forEach.call(findE(".gameChart_server"), function(c) {
                    fSs.removeClass(c, "server_on")
                });
                fSs.addClass(b, "server_on");
                gameChart_ListServerCode = 1;
                this.gmmeChartServerListDomCreate(a, gameChart_ListServerCode);
                this.gameChartDrawAreaBaseCreate(b.getAttribute("data-code"))
            }
        } else {
            this.gmmeChartServerListDomCreate(gameChartDataGame[0]._code);
            this.gameChartDrawAreaBaseCreate(gameChartFilterDataGame.server[0]._code)
        }
        this.gamChartCanvasChartData()
    }
};
if (gameChart_Element) {
    if (gameChartDataGame === undefined) {
        gameChartDataGame = x2js.xml2json(gameChart.getData()).games.game
    }
    gameChart.gameChartDomCreateStart(gameChartDataGame[0]._code);
    var gameChart_mouseOverEvent_Element = findE("#mouseOverLayer");
    gameChart_mouseOverEvent_Element.onmousemove = function(g) {
        var d = gameChart_mouseOverEvent_Element.getBoundingClientRect(),
            a = gameChart_mouseOverEvent_Element.getContext("2d"),
            c = (g.pageX - d.left) - window.scrollX,
            f = (g.pageY - d.top) - window.scrollY,
            b;
        a.clearRect(0, 0, gameChart_mouseOverEvent_Element.width, gameChart_mouseOverEvent_Element.height);
        gameChart_XY_mapData.map(function(h, e) {
            if (c >= h.x - 10 && c <= h.x + 5 && f >= h.y - 10 && f <= h.y + 5) {
                b = e;
                return
            }
        });
        if (b !== undefined) {
            gameChart_XY_mapData[b].x > 300 ? a.textAlign = "end" : a.textAlign = "start";
            a.fillStyle = "#333";
            a.font = "11px Dotum";
            a.fillText(gameChartDataServer.price[b]._day + "일 : " + fSs.comma(gameChartDataServer.price[b].__text), gameChart_XY_mapData[b].x, gameChart_XY_mapData[b].y - 10)
        }
    }
};
