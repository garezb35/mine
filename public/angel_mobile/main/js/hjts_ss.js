var IMG_DOMAIN1 = "/public/angel_mobile/";

var _DEBUG = false,
    _DOMAIN = "http://" + location.host,
    _SSL_DOMAIN = "https://" + location.host,
    g_ajaxLoading = [];
$.extend(String.prototype, {
    trim: function() {
        return this.replace(/(^\s*)|(\s*$)/g, "")
    },
    alltrim: function() {
        return this.replace(/\s*/g, "")
    },
    ltrim: function() {
        return this.replace(/^\s*/g, "")
    },
    rtrim: function() {
        return this.replace(/\s*$/g, "")
    },
    isEmpty: function() {
        return (this == null || this.trim() == "") ? true : false
    },
    isHangul: function() {
        var d = 0,
            a = "",
            c = this.length;
        for (var b = 0; b < c; b++) {
            d = parseInt(this.charCodeAt(b));
            a = this.substr(b, 1).toUpperCase();
            if ((a < "0" || a > "9") && (a < "A" || a > "Z") && ((d > 255) || (d < 0))) {
                return true
            }
        }
        return false
    },
    isDate: function() {
        var b = this.replace(/[^0-9]/, "");
        if (b.length == 8) {
            var c = Number(b.substring(0, 4)),
                e = Number(b.substring(4, 6)),
                a = Number(b.substring(6, 8))
        } else {
            if (b.length == 6) {
                var c = Number("19" + b.substring(0, 2)),
                    e = Number(b.substring(2, 4)),
                    a = Number(b.substring(4, 6))
            } else {
                return false
            }
        }
        var d = new Array(31, ((((c % 4 == 0) && (c % 100 != 0)) || (c % 400 == 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        if (e < 1 || e > 12) {
            return false
        }
        if (a < 1 || a > d[e - 1]) {
            return false
        }
        return true
    },
    currency: function(c) {
        number = this.trim();
        c = (c) ? c : 3;
        var b = "";
        var e = number.length,
            d = (e % c),
            a = (e - c + 1);
        d = (d == 0) ? c : d;
        if (e <= c || c < 1) {
            return number
        }
        b = number.substring(0, d);
        while (d <= a) {
            b += "," + number.substring(d, d + 3);
            d += c
        }
        return b
    },
    numeric: function() {
        return +(this.replace(/[^0-9]/g, ""))
    },
    getWidth: function() {
        var k, c, g, b = this.length,
            j = 0,
            e = 0,
            d = 6,
            l = 12,
            h = 32,
            f = 127,
            a = [4, 4, 4, 6, 6, 10, 8, 4, 5, 5, 6, 6, 4, 6, 4, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 4, 4, 8, 6, 8, 6, 12, 8, 8, 9, 8, 8, 7, 9, 8, 3, 6, 8, 7, 11, 9, 9, 8, 9, 8, 8, 8, 8, 8, 10, 8, 8, 8, 6, 11, 6, 6, 6, 4, 7, 7, 7, 7, 7, 3, 7, 7, 3, 3, 6, 3, 11, 7, 7, 7, 7, 4, 7, 3, 7, 6, 10, 7, 7, 7, 6, 6, 6, 9, 6];
        for (i = 0; i < b; i++) {
            c = this.substring(i, (i + 1));
            k = c.charCodeAt(0);
            if (k < h) {
                g = d
            } else {
                if (k <= f) {
                    idx = k - h;
                    g = a[idx]
                } else {
                    if (k > f) {
                        g = l
                    }
                }
            }
            j += g
        }
        return j
    },
    getByte: function() {
        var d = 0,
            b = new String(this),
            c = b.length;
        if (this.isEmpty()) {
            return 0
        }
        for (var a = 0; a < c; a++) {
            d += (escape(b.charAt(a)).length > 4) ? 2 : 1
        }
        return d
    },
    subbyte: function(a) {
        var c = 0;
        tmpCount = 0;
        tmp = new String(this);
        length = tmp.length;
        if (this.isEmpty()) {
            return ""
        }
        for (var b = 0; b < length; b++) {
            tmpCount = (escape(tmp.charAt(b)).length > 4) ? 2 : 1;
            if ((c + tmpCount) > a) {
                return this.substring(0, b)
            }
            c += tmpCount
        }
        return this
    },
    toQueryParams: function(b) {
        var a = this.trim().match(/([^?#]*)(#.*)?$/);
        if (!a) {
            return {}
        }
        return a[1].split(b || "&").inject({}, function(d, e) {
            if ((e = e.split("="))[0]) {
                var c = decodeURIComponent(e.shift());
                value = e.length > 1 ? e.join("=") : e[0];
                if (value != undefined) {
                    value = decodeURIComponent(value)
                }
                if (c in d) {
                    if (!$.isArray(d[c])) {
                        d[c] = [d[c]]
                    }
                    d[c].push(value)
                } else {
                    d[c] = value
                }
            }
            return d
        })
    }
});
$.extend(Date.prototype, {
    getDayName: function(a) {
        var b = new Array("일", "월", "화", "수", "목", "금", "토");
        day = (arguments.length == 1) ? a : this.getDay();
        return b[day]
    },
    getTotalDay: function() {
        var a = this.getFullYear();
        days = new Array(31, ((((a % 4 == 0) && (a % 100 != 0)) || (a % 400 == 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        return days[this.getMonth()]
    }
});
$.extend(Number.prototype, {
    currency: function(c) {
        number = String(this).trim();
        c = (c) ? c : 3;
        var b = "";
        var e = number.length,
            d = (e % c),
            a = (e - c + 1);
        d = (d == 0) ? c : d;
        if (e <= c || c < 1) {
            return number
        }
        b = number.substring(0, d);
        while (d <= a) {
            b += "," + number.substring(d, d + 3);
            d += c
        }
        return b
    },
    korean: function() {
        var j = ["", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구"],
            g = ["", "십", "백", "천"],
            b = ["", "만", "억", "조", "경", "해", "자", "양", "구", "간", "정재극"],
            d = String(this).trim(),
            c = Math.floor(d.length / 4),
            f = (d.length % 4) - 1,
            e = 0,
            a = 0,
            h = "";
        for (; c >= 0; c--) {
            for (; f >= 0; f--) {
                a = Number(d.charAt(e));
                h += (a == 1 && f != 0) ? "" : j[a];
                h += (a == 0) ? "" : g[f];
                e++
            }
            f = 3;
            h += (a == 0 && Number(d.substring(e - 4, e)) == 0) ? "" : b[c] + " "
        }
        if (h.substring(h.length - 1, h.length) == " ") {
            h = h.substring(0, h.length - 1)
        }
        return h
    }
});
var _event = {};
$.extend(_event, {
    KEY_BACKSPACE: 8,
    KEY_TAB: 9,
    KEY_RETURN: 13,
    KEY_ESC: 27,
    KEY_LEFT: 37,
    KEY_UP: 38,
    KEY_RIGHT: 39,
    KEY_DOWN: 40,
    KEY_DELETE: 46,
    KEY_HOME: 36,
    KEY_END: 35,
    KEY_PAGEUP: 33,
    KEY_PAGEDOWN: 34,
    KEY_INSERT: 45,
    DOMEvents: ["click", "dblclick", "mousedown", "mouseup", "mouseover", "mousemove", "mouseout", "keypress", "keydown", "keyup", "load", "unload", "abort", "error", "resize", "scroll", "select", "change", "submit", "reset", "focus", "blur"],
    cache: {},
    relatedTarget: function(b) {
        b = this.event(b);
        var a;
        switch (b.type) {
            case "mouseover":
                a = b.fromElement;
                break;
            case "mouseout":
                a = b.toElement;
                break;
            default:
                return null
        }
        return a
    },
    isLeftClick: function(a) {
        a = this.event(a);
        return (((a.which) && (a.which == 1)) || ((a.button) && (a.button == 1)))
    },
    pointer: function(a) {
        a = this.event(a);
        return {
            x: a.pageX || (a.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft)),
            y: a.pageY || (a.clientY + (document.documentElement.scrollTop || document.body.scrollTop))
        }
    },
    pointerX: function(a) {
        a = this.event(a);
        return _event.pointer(a).x
    },
    pointerY: function(a) {
        a = this.event(a);
        return _event.pointer(a).y
    },
    stopPropagation: function(a) {
        a = this.event(a);
        if (a.stopPropagation) {
            a.stopPropagation()
        } else {
            a.cancelBubble = true
        }
    },
    preventDefault: function(a) {
        a = this.event(a);
        try {
            (a.which) ? a.which: a.keyCode = 0
        } catch (b) {}
        if (a.preventDefault) {
            a.preventDefault()
        } else {
            a.returnValue = false
        }
    },
    keycode: function(a) {
        a = this.event(a);
        if (!a) {
            return -1
        }
        return (a.which) ? a.which : a.keyCode
    },
    stop: function(a) {
        _event.preventDefault(a);
        _event.stopPropagation(a)
    },
    event: function(a) {
        return window.event || a
    }
});
jQuery.fn.serializeObject = function() {
    var c = null;
    try {
        if (this[0].tagName && this[0].tagName.toUpperCase() == "FORM") {
            var a = this.serializeArray();
            if (a) {
                c = {};
                $.each(a, function() {
                    c[this.name] = this.value
                })
            }
        }
    } catch (b) {}
    return c
};
var _layer = {
    node: null,
    el: null,
    control: function(a) {
        if (this.node != a) {
            this.el = null;
            this.node = a
        }
        if ($(a).css("display") == "none") {
            $(a).show()
        }
        if (this.el == null) {
            this.el = $(a)
        }
        if (this.el) {
            $("#g_layer").show();
            this.el.appendTo("#l_content");
            this.el = ""
        } else {
            $("#g_layer").hide();
            this.el = $(a).hide().appendTo("body")
        }
    },
    hide: function() {
        $("#g_layer").hide();
        this.el = $(this.node).hide().appendTo("body")
    }
};
var _http = {
    encodeURI: function(f) {
        var c = f.substring(0, f.indexOf("?")),
            b = f.substring(f.indexOf("?") + 1, f.length),
            a = "",
            d = b.toQueryParams();
        for (var e in d) {
            d[e] = encodeURIComponent(d[e]);
            a += e + "=" + d[e] + "&"
        }
        if (!a.isEmpty()) {
            a = a.substring(0, a.length - 1)
        }
        if (!c.isEmpty()) {
            c += "?"
        }
        return c + a
    },
    decodeURI: function(c) {
        var a = c.substring(0, c.indexOf("?"));
        get = c.substring(c.indexOf("?") + 1, c.length);
        strResult = "";
        rgData = get.toQueryParams();
        for (var b in rgData) {
            rgData[b] = decodeURIComponent(rgData[b]);
            strResult += b + "=" + rgData[b] + "&"
        }
        if (!strResult.isEmpty()) {
            strResult = strResult.substring(0, strResult.length - 1)
        }
        if (!a.isEmpty()) {
            a += "?"
        }
        return a + strResult
    }
};
var _cookie = {
    add: function(b, h) {
        var g = arguments,
            e = g.length,
            d = (e > 2) ? g[2] : null,
            j = (e > 3) ? g[3] : null,
            f = (e > 4) ? g[4] : null,
            a = (e > 5) ? g[5] : false;
        if (d) {
            var c = new Date();
            c.setTime(c.getTime() + parseInt(d * 24 * 60 * 60 * 1000))
        }
        document.cookie = b + "=" + escape(h) + ((d == null) ? "" : ("; expires=" + c.toGMTString())) + ((j == null) ? "" : ("; path=" + j)) + ((f == null) ? "" : ("; domain=" + f)) + ((a == true) ? "; secure" : "")
    },
    remove: function(b) {
        var a = arguments;
        var f = arguments.length;
        var e = (f > 1) ? a[1] : null;
        var d = (f > 2) ? a[2] : null;
        var c = new Date();
        c.setDate(c.getDate() - 1);
        document.cookie = b + "=; expires=" + c.toGMTString() + ((e === null) ? "" : ("; path=" + e)) + ((d === null) ? "" : ("; domain=" + d))
    },
    get: function(c) {
        var b = 0,
            d, a;
        c += "=";
        while (b <= document.cookie.length) {
            d = b + c.length;
            if (document.cookie.substring(b, d) == c) {
                if ((a = document.cookie.indexOf(";", d)) == -1) {
                    a = document.cookie.length
                }
                return unescape(document.cookie.substring(d, a))
            }
            b = document.cookie.indexOf(" ", b) + 1;
            if (b == 0) {
                break
            }
        }
        return ""
    },
    getNames: function() {
        var a = Array(),
            e = document.cookie.split(";"),
            d = 0,
            c;
        for (var b = 0; b < e.length; b++) {
            if (e[b] == "") {
                continue
            }
            c = e[b].split("=");
            if (c[0] != "") {
                a[d++] = c[0]
            }
        }
        return a
    },
    free: function() {
        var c = new Date();
        c.setDate(c.getDate() - 1);
        var d = document.cookie.split(";"),
            b;
        for (var a = 0; a < d.length; a++) {
            if (d[a] == "") {
                continue
            }
            b = d[a].split("=");
            if (b[0] != "") {
                document.cookie = b[0] + "=; expires=" + c.toGMTString() + ";"
            }
        }
    },
    isEnable: function() {
        return navigator.cookieEnabled
    }
};
var _xml = {
    getElement: function(d, b, a) {
        var c = null;
        if (!(c = d.getElementsByTagName(b).item(a))) {
            b = b.replace("xsl:", "");
            c = d.getElementsByTagName(b)[a]
        }
        try {
            return c
        } finally {
            c = null
        }
    },
    getElements: function(c, a) {
        var b = null;
        if (!(b = c.getElementsByTagName(a).item(0))) {
            a = a.replace("xsl:", "");
            return c.getElementsByTagName(a)
        }
        return c.getElementsByTagName(a)
    }
};
var _WebStorage = {
    localsave: function(a) {
        window.localStorage[a.key] = a.value
    },
    localadd: function(a) {
        if (window.localStorage[a.key] == undefined) {
            window.localStorage[a.key] = a.value
        } else {
            window.localStorage[a.key] += a.value
        }
    },
    localload: function(c, a) {
        var e = [];
        if (a == true) {
            var f = window.localStorage,
                d = f.length;
            for (var b = 0; b < d; b++) {
                e[b] = [f.key(b), f.getItem(f.key(b))]
            }
            if (d < 1) {
                e = null
            }
        } else {
            e = window.localStorage.getItem(c)
        }
        return e
    },
    localdel: function(b, a) {
        if (a == true) {
            window.localStorage.clear()
        } else {
            window.localStorage.removeItem(b)
        }
    },
    sessionsave: function(a) {
        window.sessionStorage[a.key] = a.value
    },
    sessionadd: function(a) {
        if (window.sessionStorage[a.key] == undefined) {
            window.sessionStorage[a.key] = a.value
        } else {
            window.sessionStorage[a.key] += a.value
        }
    },
    sessionload: function(c, a) {
        var e = [];
        if (a == true) {
            var f = window.sessionStorage,
                d = f.length;
            for (var b = 0; b < d; b++) {
                e[b] = [f.key(b), f.getItem(f.key(b))]
            }
            if (d < 1) {
                e = null
            }
        } else {
            e = window.sessionStorage.getItem(c)
        }
        return e
    },
    sessiondel: function(b, a) {
        if (a == true) {
            window.sessionStorage.clear()
        } else {
            window.sessionStorage.removeItem(b)
        }
    }
};

function ajaxRequest(f) {
    var f = f || {};
    if (!f.url) {
        return
    }
    var b = f.url;
    if (b.indexOf("gamelist.php") !== -1 || b.indexOf("serverlist.php") !== -1) {
        var d = f.cache;
        var c = new Date();
        c.setSeconds(0);
        c.setMilliseconds(0);
        var h = Math.floor(c.getTime() / 100000);
        if (b.indexOf("?") == -1) {
            b += "?"
        } else {
            b += "&"
        }
        b += "_=" + h;
        f.cache = true
    }
    var e = f.scope || this,
        a = (f.mask == undefined) ? true : f.mask,
        g = {
            url: b,
            dataType: f.dataType || "JSON",
            type: f.type || "GET",
            data: f.data || "",
            async: (f.async === undefined) ? true : f.async,
            cache: (f.cache === undefined) ? false : f.cache,
            success: function(k) {
                var j = k;
                if (g.dataType.toUpperCase() === "JSON") {
                    j = $.extend(true, {}, k)
                }
                try {
                    j = $.parseJSON(k)
                } catch (l) {}
                if (j.alert) {
                    if (f.alert !== "undefined" && f.alert === false) {
                        j.alert = ""
                    } else {
                        j.alert = j.alert.replace(/\\n/g, "\n")
                    }
                }
                if (f.failure && j.FAIL && j.FAIL == "true") {
                    f.failure.call(e, k);
                    _AJAX_MSG.show(j);
                    return
                }
                if (f.success) {
                    f.success.call(e, k)
                }
                _AJAX_MSG.show(j)
            },
            error: function(j) {
                if (f.error) {
                    f.error.call(e, j)
                }
            },
            complete: function(j) {
                if (f.complete) {
                    f.complete.call(e, j)
                }
            }
        };
    if (f.timeout) {
        g.timeout = f.timeout
    }
    if (a) {
        g_ajaxLoading.push(f.url)
    }
    return $.ajax(g)
}
var _AJAX_MSG = {
    show: function(a) {
        if (a.alert != undefined && !(a.alert).isEmpty()) {
            alert(a.alert)
        }
    }
};
var _LOAD_MASK = {
    addText: function(a) {
        $("#loading_txt").html(a)
    },
    show: function() {
        $("html, body").addClass("fixed_on");
        $("#preview_ife").show()
    },
    hide: function() {
        $("html, body").removeClass("fixed_on");
        $("#preview_ife").hide()
    }
};

function newSetDeny(b) {
    if (!$("#" + b + "_inptDeny") && !$("#" + b)) {
        return
    }
    var a = $("#" + b + "_inptDeny")[0].checked,
        c = "";
    if (a) {
        c = "deny"
    }
    _cookie.add(b, c, 1, "/")
}(function(b) {
    var a = function(f, k) {
        var h = this,
            m = (k && k.ajaxSetting) || null,
            l = b(f).find(".swiper-wrapper");
        if (!b(f).hasClass("swiper-container")) {
            b(f).addClass("swiper-container")
        }
        if (l.length < 1) {
            b(f).prepend('<div class="swiper-wrapper"></div>');
            l = b(f).find(".swiper-wrapper")
        }
        if (k.child !== undefined) {
            l.append(k.child)
        }
        h.newSwiperAjax = function() {
            ajaxRequest({
                url: m.url,
                success: function(d) {
                    if (m.markUp) {
                        tmplRst = b.tmpl(m.markUp, d)
                    } else {
                        if (m.tmpl) {
                            tmplRst = b(m.tmpl).tmpl(d)
                        }
                    }
                    if (tmplRst) {
                        b(l).html(tmplRst)
                    }
                    h.newSwiper();
                    if ("ajaxComplete" in k.ajaxSetting) {
                        k.ajaxSetting.ajaxComplete.call(h, d)
                    }
                }
            })
        };
        h.newSwiper = function() {
            if (k && k.swiper.pagination) {
                b(f).append(b('<div class="swiper-pagination" />'))
            }
            h.s = new Swiper(f, k && k.swiper)
        };
        if (b('script[src*="swiper.min.js"]').length < 1) {
            var j = document,
                e = j.body || j.getElementsByTagName("body")[0],
                g = j.createElement("script");
            g.src = IMG_DOMAIN1 + "main/js/swiper.min.js";
            g.onload = function() {
                if (m) {
                    h.newSwiperAjax()
                } else {
                    h.newSwiper()
                }
            };
            e.appendChild(g)
        } else {
            h.newSwiper()
        }
        return h
    };
    var c = function(g, n) {
        var t = this,
            w, q = document,
            u = q.body || q.getElementsByTagName("body")[0],
            j = {},
            f = b(".swiper-wrapper"),
            r = n.ajaxSetting,
            m = n.loading || true,
            v = n.pagination || true,
            p = n.hash || "page",
            l = false;
        t.data = n.ajaxSetting.data || {};
        j.longSwipesRatio = 0.4;
        j.autoHeight = true;
        j.onSlideChangeStart = function(d) {
            var x = d.slides.eq(d.activeIndex);
            if (n.ajaxSetting !== undefined && b(x).data("load") !== true) {
                f.css("height", 0);
                if (t.preloader) {
                    t.preloader.show()
                }
                t.data.page = d.activeIndex + 1;
                ajaxRequest({
                    url: r.url,
                    type: r.type || "POST",
                    data: t.data,
                    success: function(y) {
                        d.update(true);
                        var B = d.slides.eq(d.activeIndex),
                            s;
                        if (r.markUp) {
                            s = b.tmpl(r.markUp, y)
                        } else {
                            if (r.tmpl) {
                                s = b(r.tmpl).tmpl(y)
                            }
                        }
                        if (s) {
                            b(B).html(s).data({
                                load: true
                            })
                        }
                        if (t.preloader) {
                            t.preloader.hide()
                        }
                        if ("onChangeAfter" in n) {
                            n.onChangeAfter.call(t, y)
                        }
                        if (v === true) {
                            var z = Number(y.now_page),
                                A = b(g).find(".btn_first")[0];
                            if (y.next_page == "Y") {
                                d.appendSlide('<div class="swiper-slide" data-hash="' + p + (z + 1) + '"></div>')
                            }
                            t.buttonStateChange(d)
                        }
                        d.onResize()
                    }
                })
            } else {
                if (v === true) {
                    t.buttonStateChange(d)
                }
                d.onResize()
            }
        };
        t.buttonStateChange = function(d) {
            b(g).find(".pagination").show();
            var x = b(g).find(".btn_first");
            if (d.prevButton.hasClass(d.params.buttonDisabledClass)) {
                x.addClass(d.params.buttonDisabledClass)
            } else {
                x.removeClass(d.params.buttonDisabledClass)
            }
        };
        t.onSlideChangeData = function() {
            w.slides.each(function() {
                b(this).removeData("load")
            });
            if (r.form) {
                t.data = r.form.serializeObject()
            }
            if (w.activeIndex == 0) {
                w.emit("onSlideChangeStart", w)
            } else {
                w.slideTo(0)
            }
        };
        t.init = function() {
            if (f.find("swiper-slide").length < 1) {
                if (hashControll.hasHash("page")) {
                    l = true;
                    var x = document.location.hash.replace("#page", "")
                } else {
                    var x = 1
                }
                var d = [];
                for (var s = 1; s <= x; s++) {
                    d.push('<div class="swiper-slide" data-hash="' + p + s + '"></div>')
                }
                f.append(d.join(""));
                t.data.page = x
            }
            if (t.swiper) {
                t.swiper.activeIndex = 0
            }
            if (m == true && t.preloader === undefined) {
                t.preloader = b('<div class="loading"></div>');
                b(g).prepend(t.preloader)
            }
        };
        if (!b(g).hasClass("swiper-container")) {
            b(g).addClass("swiper-container")
        }
        if (n.tab !== undefined) {
            var k = n.tab.container;
            var o = n.tab.key || "type";
            window.addEventListener("popstate", function(y) {
                if (location.search == "" && y.state == undefined) {
                    var x = b(k).children().eq(0);
                    if (x.hasClass("selected") === false) {
                        x.trigger("click")
                    }
                } else {
                    if (y.state == undefined) {
                        var s = location.search.replace("?", "");
                        var d = s.split("&");
                        var z = "";
                        b.each(d, function() {
                            var A = this.split("=");
                            if (A[0] == o) {
                                z = A[1]
                            }
                        })
                    } else {
                        var z = y.state.tab
                    }
                    b(k).find('[data-type="' + z + '"]').trigger("click")
                }
            });
            b(k).children().click(function() {
                var d = b(this).data("type");
                if (!b(this).hasClass("selected")) {
                    if (b(k).children().index(this) !== 0 && (history.state == undefined || (history.state && history.state.tab != d))) {
                        history.pushState({
                            tab: d
                        }, "", "?" + o + "=" + d)
                    }
                    if (n.tab.onBeforeChangeTab) {
                        n.tab.onBeforeChangeTab.call(this)
                    }
                    b(k).find("div").removeClass("selected");
                    b(this).addClass("selected");
                    if (r.form) {
                        r.form.find('[name="' + o + '"]').val(d)
                    } else {
                        t.data[o] = d
                    }
                    t.swiper.removeAllSlides();
                    t.init();
                    t.onSlideChangeData();
                    if (n.tab.onChangeTab) {
                        n.tab.onChangeTab.call(this)
                    }
                }
            })
        }
        if (n.ajaxSetting !== undefined) {
            if (r.form) {
                t.data = r.form.serializeObject()
            }
            if (f.length < 1) {
                b(g).prepend('<div class="swiper-wrapper"></div>');
                f = b(".swiper-wrapper")
            }
            t.init()
        }
        if (v === true) {
            b(g).append('<div class="pagination"><span class="btn_first">처음</span><span class="btn_prev">이전페이지</span><span class="btn_next">다음페이지</span></div>');
            j.hashname = "page";
            j.hashnav = true;
            j.hashnavWatchState = true;
            j.nextButton = ".btn_next";
            j.prevButton = ".btn_prev";
            b(g).find(".btn_first").click(function() {
                w.slideTo(0)
            })
        }
        if (b('script[src*="swiper.min.js"]').length < 1) {
            var e = q.createElement("script");
            e.src = IMG_DOMAIN1 + "main/js/swiper.min.js";
            e.onload = h;
            u.appendChild(e)
        } else {
            h()
        }

        function h() {
            w = t.swiper = new Swiper(g, j);
            b(g).find(".btn_first").addClass(w.params.buttonDisabledClass);
            if (l == false || (l == true && t.data.page == 1)) {
                w.emit("onSlideChangeStart", w);
                l = true
            }
        }
        return t
    };
    window.Pagination = c;
    window.SwiperCustom = a
})(jQuery);
var hashControll = {
    hasHash: function(a) {
        var b = location.hash;
        if (b.indexOf(a) !== -1) {
            return true
        }
        return false
    },
    getHash: function() {
        var b = location.hash;
        var a = b.split("#");
        if (a[1] === undefined) {
            return ""
        }
        return a[1]
    }
};
var _form_checker = function(a) {
    this.init(a)
};
$.extend(_form_checker.prototype, {
    objForm: null,
    rgItem: null,
    init: function(a) {
        try {
            $.extend(a[0], this);
            var c = this;
            this.rgItem = new Array();
            this.objForm = a;
            this.objForm.checker = this;
            this.objForm.on("submit", function() {
                return c.send()
            })
        } catch (b) {
            alert(b.name + ":" + b.message)
        }
    },
    fnRequiredCheck: function() {
        var a = this.objForm.find("input[required],select[required]");
        var b = true;
        $.each(a, function(c, d) {
            if ($(d).val().isEmpty()) {
                alert($(d).attr("label") + "을(를) 입력해주세요,");
                d.focus();
                b = false;
                return false
            }
        });
        return b
    },
    send: function() {
        if (this.requiredCheck !== false) {
            var b = this.fnRequiredCheck();
            if (!b) {
                return false
            }
        }
        var a = this.checkElement();
        if (!a) {
            return false
        }
        if ("OnSubmit" in this && this.OnSubmit) {
            a = this.OnSubmit.call(this.objForm);
            if (!a) {
                return false
            }
        }
        return true
    },
    send_manual: function() {
        if (this.requiredCheck !== false) {
            var b = this.fnRequiredCheck();
            if (!b) {
                return
            }
        }
        var a = this.checkElement();
        if (!a) {
            return
        }
        if ("OnSubmit" in this && this.OnSubmit) {
            a = this.OnSubmit.call(this.objForm);
            if (!a) {
                return
            }
        }
        this.objForm.submit()
    },
    checkElement: function() {
        if (this.rgItem.length < 1) {
            return true
        }
        var o = true,
            f, b = "",
            n = "",
            a = this.rgItem.length,
            h;
        for (var e = 0; e < a; e++) {
            try {
                if ("inputObj" in this.rgItem[e]) {
                    h = this.rgItem[e].inputObj
                } else {
                    if ("findObj" in this.rgItem[e]) {
                        h = $(this.rgItem[e].findObj)
                    }
                }
                if (h !== undefined) {
                    f = h.get(0).tagName.toUpperCase();
                    b = h.attr("type");
                    n = h.val().trim()
                }
                if ("custom" in this.rgItem[e]) {
                    var d = ("inputObj" in this.rgItem[e]) ? this.rgItem[e].inputObj : this.objForm;
                    if (!this.rgItem[e].custom.call(d, n)) {
                        o = false;
                        break
                    }
                } else {
                    if (b == "radio" || b == "checkbox") {
                        var g = h.filter(":checked");
                        if (g.val().isEmpty()) {
                            o = false;
                            break
                        }
                    } else {
                        var m = this.rgItem[e].strType || "string";
                        var j = _form.validator[m];
                        var c = null,
                            l = null;
                        if ("range" in this.rgItem[e]) {
                            c = ("min" in this.rgItem[e].range) ? this.rgItem[e].range.min : 0.1;
                            l = ("max" in this.rgItem[e].range) ? this.rgItem[e].range.max : null
                        } else {
                            c = 0.1
                        }
                        if (!j.call(_form.validator, n, c, l)) {
                            o = false;
                            break
                        }
                    }
                }
            } catch (k) {
                if (_DEBUG == true) {
                    k.print()
                }
                o = false;
                break
            }
        }
        if (!o) {
            if ("message" in this.rgItem[e]) {
                alert(this.rgItem[e].message)
            }
            if (("inputObj" in this.rgItem[e]) && (b == "text" || b == "password" || b == "tel" || b == "number" || f == "TEXTAREA")) {
                h.val("").focus()
            }
            return false
        }
        return true
    },
    add: function(c, b) {
        var a = false;
        if (c.inputObj !== undefined) {
            a = c.inputObj
        } else {
            if (c.findObj !== undefined) {
                a = $(c.findObj)
            } else {
                if ("custom" in c) {
                    a = true
                }
            }
        }
        if (a === false) {
            return
        }
        if (b == "s") {
            this.rgItem.unshift(c)
        } else {
            this.rgItem.push(c)
        }
        if (("protect" in c) && c.protect && (c.strType in _form.protect)) {
            _form.protect[c.strType].call(_form.protect, (c.inputObj))
        }
    },
    free: function() {
        this.rgItem = []
    }
});
var _form = {};
_form.validator = $.extend({}, {
    number: function(c, b, a) {
        if (c.isEmpty()) {
            return false
        }
        c = Number(c);
        if (isNaN(c)) {
            return false
        }
        if ((b && isNaN(b)) || (a && isNaN(a))) {
            return false
        }
        if (b && (c < b)) {
            return false
        }
        if (a && (c > a)) {
            return false
        }
        return true
    },
    price: function(c, b, a) {
        c = c.replace(/[^0-9]/g, "");
        return this.number(c, b, a)
    },
    string: function(c, b, a) {
        if (c.isEmpty()) {
            return false
        }
        if (b && (c.length < b)) {
            return false
        }
        if (a && (c.length > a)) {
            return false
        }
        return true
    },
    hangul: function(c, b, a) {
        if (!this.string(c, b, a)) {
            return false
        }
        return c.isHangul()
    },
    domain: function(b) {
        var a = (/^(http\:\/\/)?((\w+)[.])+(asia|biz|cc|cn|com|de|eu|in|info|jobs|jp|kr|mobi|mx|name|net|nz|org|travel|tv|tw|uk|us)(\/(\w*))*$/i);
        return a.test(b)
    },
    url: function(b) {
        if (this.domain(b)) {
            return true
        }
        var a = b.lastIndexOf("/");
        if (a > -1) {
            return this.domain(b.substring(0, a))
        }
        return false
    },
    userid: function(a) {
        a = a.replace(/[^a-zA-Z0-9]/g, "");
        if (!isNaN(a.substring(0, 1))) {
            return false
        }
        if (!isNaN(a)) {
            return false
        }
        return this.string(a, 4, 12)
    },
    password: function(a) {
        var b = /(?=.*\d)(?=.*[a-zA-Z])/;
        if (!b.test(a)) {
            return false
        }
        return this.string(a, 10, 16)
    },
    four_string: function(d) {
        var c = d.length;
        var a = 0;
        if (c < 3) {
            return false
        }
        for (var b = 0; b < c; b++) {
            if (b != 0 && d.substring(b - 1, b) == d.substring(b, b + 1)) {
                if (a >= 2) {
                    return false
                }
                a++
            } else {
                a = 0
            }
        }
        return true
    },
    email: function(a) {
        var b = /^[a-zA-z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9]{2,4}$/i;
        return b.test(a)
    }
});
_form.protect = $.extend({}, {
    functionkey: [8, 9, 13, 16, 17, 18, 20, 21, 22, 25, 27, 32, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 96],
    functioncheck: function(a) {
        var c = this.functionkey.length;
        for (var b = 0; b < c; b++) {
            if (this.functionkey[b] == a) {
                return true
            }
        }
        return false
    },
    set: function(a, c, d, b) {
        if (!b) {
            b = d
        }
        if (c) {
            if (("keypress" in a) === true) {
                a.on("keypress", c)
            } else {
                if (("keydown" in a) === true) {
                    a.on("keydown", c)
                }
            }
        }
        if (d) {
            a.on("keyup", d)
        }
        if (b) {
            a.on("blur", b)
        }
    },
    number: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.which || c.keyCode,
                d = this.value;
            if ($(this).attr("maxlength") && d.length > $(this).attr("maxlength")) {
                return false
            }
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 96 && b <= 105)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function(b) {
            var c = new RegExp("[^0-9]", "g");
            if (_form.protect.value_test($(this), c) == false) {
                var d = this.value.replace(/[^0-9]/g, "");
                this.value = d
            }
        })
    },
    price: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.which || c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 96 && b <= 105)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function() {
            var b = Number(this.value.replace(/[^0-9]/g, "")).currency();
            if (this.value != b) {
                if ($(this).attr("maxlength") && b.length > $(this).attr("maxlength")) {
                    var c = b.length - parseInt($(this).attr("maxLength"));
                    b = b.substring(0, b.length - c);
                    b = b.replace(/[^0-9]/g, "");
                    b = Number(b).currency()
                }
                this.value = b
            }
            if (this.value == 0) {
                this.value = ""
            }
        })
    },
    hangul: function(a) {
        a.css("ime-mode", "active");
        this.set(a, function(c) {
            var b = c.which || c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if (b == 229) {
                return true
            }
            c.returnValue = "";
            return false
        }, null, function() {
            var b = (this.value.isEmpty()) ? "" : this.value.replace(/[^가-힣]/g, "");
            this.value = b
        })
    },
    userid: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.which || c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 65 && b <= 90) || (b >= 97 && b <= 122)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function() {
            var b = new RegExp("[^a-zA-Z0-9]", "g");
            if (_form.protect.value_test($(this), b) == false) {
                var c = this.value.replace(b, "");
                this.value = c
            }
        })
    },
    english: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.which || c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 65 && b <= 90) || (b >= 97 && b <= 122)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function() {
            var b = new RegExp("[^a-zA-Z]", "g");
            if (_form.protect.value_test($(this), b) == false) {
                var c = this.value.replace(b, "");
                this.value = c
            }
        })
    },
    value_test: function(a, b) {
        if (b.test($(a).val()) == true) {
            return false
        }
        return true
    }
});
_form.addValues = function(a, d) {
    if (!a || !d) {
        return
    }
    var b = null;
    for (var c in d) {
        b = document.createElement("INPUT");
        b.setAttribute("type", "hidden");
        b.setAttribute("name", c);
        b.setAttribute("value", d[c]);
        a.append(b)
    }
};
_form.autotab = function(b, a, c) {
    if ($(b).attr("maxlength") > 0) {
        c = $(b).attr("maxlength")
    }
    if (c < 1) {
        return
    }
    $(b).bind("keyup", function() {
        if (this.value.length >= c) {
            $(a).focus()
        }
    })
};
var _myService = {
    mySearch: null,
    getFavorite: function(e) {
        var d = document.querySelectorAll('[data-content="tab_mygame"]');
        var a = d.length;
        for (var b = 0; b < a; b++) {
            var c = d[b].querySelector("ul");
            c.innerHTML = '<li class="empty">LOADING..</li>'
        }
        ajaxRequest({
            url: "/api/favoritedgames",
            data:{api_token: a_token},
            success: function(f) {
                _myService.mySearch = f;
                if (e) {
                    e.call(_myService)
                } else {
                    _myService.makeFavoriteList()
                }
            },
            error: _myService.OnError
        })
    },
    makeFavoriteList: function() {
        if (this.mySearch === null) {
            this.getFavorite(this.makeFavoriteList);
            return
        }
        var k = [];
        var d = this.mySearch;
        if (d.result === "nologin") {
            k.push('<li class="empty">로그인 후 이용 가능합니다.</li>')
        } else {
            var f = d.list;
            if (f.length < 1) {
                k.push('<li class="empty">등록된 나만의 게임이 없습니다.</li>')
            } else {
                var a = f.length;
                for (var h = 0; h < a; h++) {
                    var l = f[h];
                    var c = (l.type === "sell") ? "팝니다" : "삽니다";
                    var g = l.gameName + " > " + l.serverName + " > " + l.goodsName;
                    k.push('<li data-id="' + l.id + '" data-idx="' + h + '">');
                    k.push('<a href="javascript:;" class="gs_name"><span class="' + l.type + '">' + c + "</span>" + g + "</a>");
                    k.push('<a href="javascript:;" class="delete_btn"></a>');
                    k.push("</li>")
                }
            }
        }
        var b = document.querySelectorAll('[data-content="tab_mygame"]');
        var j = b.length;
        for (var h = 0; h < j; h++) {
            var e = b[h].querySelector("ul");
            e.innerHTML = k.join("");
            if (_myService.myGameHandler !== true) {
                e.addEventListener("click", _myService.myGameClickHandler)
            }
        }
    },
    myGameClickHandler: function(d) {
        _myService.myGameHandler = true;
        var g = _myService.getGameServerEl(d.target);
        var b = _myService.mySearch.list;
        if (d.target.classList.contains("delete_btn") === true) {
            var a = d.target.parentNode.getAttribute("data-idx");
            var c = (b[a].type === "sell") ? "팝니다" : "삽니다";
            if (confirm(c + " > " + b[a].gameName + " > " + b[a].serverName + " 게임을 나만의 게임리스트에서 삭제하시겠습니까?") === true) {
                _myService.deleteFavorite(d.target.parentElement.getAttribute("data-id"), function() {
                    _myService.getFavorite()
                })
            }
            return
        }
        var f = d.target;
        while (f !== null && f.classList.contains("gs_name") === false) {
            f = f.parentElement
        }
        if (f !== null && f.className === "gs_name") {
            if (g !== null) {
                var a = f.parentElement.getAttribute("data-idx");
                if (g.formElement.querySelector('[value="' + b[a].type + '"]') !== null) {
                    g.formElement.querySelector('[value="' + b[a].type + '"]').selected = true
                }
                g.changeAction = true;
                g.gameList.view = false;
                g.gameList.gameCode = b[a].gameCode;
                g.serverList.serverCode = b[a].serverCode;
                if (g.goodsList !== undefined) {
                    g.goodsList.goodsCode = (b[a].goodsCode === "all") ? "" : b[a].goodsCode
                } else {
                    g.serverList.goodsCode = (b[a].goodsCode === "all") ? "" : b[a].goodsCode
                }
                g.gameList.createList()
            }
        }
    },
    deleteFavorite: function(a, b) {
        ajaxRequest({
            url: "/api/myroom/customer/search_delete",
            data: {
                id: a,
                api_token: a_token
            },
            type: "POST",
            dataType: "JSON",
            success: function(c) {
                if (c.result === "LOGIN") {
                    alert(c.msg);
                    login();
                    return
                }
                if (c.result === "ERROR" && c.msg) {
                    alert(c.msg);
                    return
                }
                if (c.result === "SUCCESS") {
                    if (b) {
                        b.call(_myService)
                    }
                }
            }
        })
    },
    addFavorite: function(a, b) {
        ajaxRequest({
            url: "/myroom/customer/search_add.php",
            type: "POST",
            dataType: "json",
            data: a,
            success: function(c) {
                if (c.result === "LOGIN") {
                    alert(c.msg);
                    login();
                    return
                }
                if (c.result === "ERROR" && c.msg) {
                    alert(c.msg);
                    return
                }
                if (c.result === "SUCCESS") {
                    if (b) {
                        b.call(_myService, c)
                    }
                }
            }
        })
    },
    count: 10,
    getLastCount: function() {
        var b = _WebStorage.localload("last_search") || [];
        var a = 0;
        if (b.length > 0) {
            a = Object.keys(JSON.parse(b)).length
        }
        return a
    },
    getLastSearch: function() {
        var a = _WebStorage.localload("last_search") || [];
        if (a.length > 0) {
            a = JSON.parse(a);
            a = Object.keys(a).map(function(b) {
                if (a[b].gameName.indexOf(" > ") !== -1) {
                    var c = a[b].gameName.split(" > ");
                    a[b].gameName = c[0].trim();
                    a[b].serverName = c[1].trim()
                }
                return a[b]
            }).slice(0, _myService.count)
        }
        return a
    },
    setLastSearch: function() {
        var j = _WebStorage.localload("last_search") || [],
            k, b = document.getElementById("juret__react56"),
            h = b.querySelector('[name="search_type"]').value,
            e = b.querySelector('[name="search_game"]').value,
            d = b.querySelector('[name="search_game_text"]').value,
            c = b.querySelector('[name="search_server"]').value,
            a = b.querySelector('[name="search_server_text"]').value;
        if (e.isEmpty() === false) {
            if (j.length > 0) {
                var j = JSON.parse(j),
                    g = j.length;
                for (var f = 0; f < g; f++) {
                    if (j[f].type === h && j[f].gameCode === e && j[f].serverCode === c) {
                        k = f;
                        break
                    }
                }
                if (k !== undefined) {
                    j.splice(f, 1)
                }
            }
            j.unshift({
                type: "" + h + "",
                gameCode: "" + e + "",
                gameName: "" + d + "",
                serverCode: "" + c + "",
                serverName: "" + a + ""
            });
            if (j.length > _myService.count) {
                j = j.slice(0, _myService.count)
            }
            _WebStorage.localsave({
                key: "last_search",
                value: JSON.stringify(j)
            })
        }
    },
    makeLastSearch: function() {
        var l = _myService.getLastCount();
        if (l > 0) {
            if (this.mySearch === null) {
                this.getFavorite(_myService.makeLastSearch);
                return
            }
        }
        var b = _myService.getLastSearch();
        var q = [];
        if (b.length > 0) {
            if (this.mySearch === null) {
                var p = {}
            } else {
                var p = {};
                var j = _myService.mySearch.list;
                var n = j.length;
                for (var k = 0; k < n; k++) {
                    var m = j[k];
                    if (p[m.gameCode] === undefined) {
                        p[m.gameCode] = [];
                        p[m.gameCode]["seq"] = [];
                        p[m.gameCode]["server"] = []
                    }
                    p[m.gameCode]["seq"].push(m.id);
                    p[m.gameCode]["server"].push(m.serverCode)
                }
            }
            var r = b.length;
            for (var t = 0; t < r; t++) {
                var h = b[t];
                if (h) {
                    var c = h.type;
                    var g = (c === "sell") ? "팝니다" : "삽니다";
                    var e = h.gameName;
                    var s = h.serverName;
                    var o = e + " > " + s;
                    q.push('<li data-id="' + t + '">');
                    q.push('<a href="javascript:;" class="gs_name"><span class="' + c + '">' + g + "</span>" + o + "</a>");
                    q.push('<a href="javascript:;" class="delete_btn"></a>');
                    q.push("</li>")
                }
            }
        } else {
            q.push('<li class="empty">최근 검색 게임이 없습니다.</li>')
        }
        var f = document.querySelectorAll('[data-content="tab_lastsearch"]');
        var d = f.length;
        for (var k = 0; k < d; k++) {
            var a = f[k].querySelector("ul");
            a.innerHTML = q.join("");
            if (_myService.lastSearchHandler !== true) {
                a.addEventListener("click", _myService.lastSearchClickHandler)
            }
        }
    },
    lastSearchClickHandler: function(c) {
        _myService.lastSearchHandler = true;
        if (c.target.classList.contains("delete_btn") === true) {
            _myService.deleteLastSearch(c.target.parentElement.getAttribute("data-id"));
            _myService.makeLastSearch();
            return
        }
        var d = c.target;
        while (d !== null && d.classList.contains("gs_name") === false) {
            d = d.parentElement
        }
        if (d !== null && d.className === "gs_name") {
            var f = _myService.getGameServerEl(d);
            if (f !== null) {
                var b = _myService.getLastSearch();
                var a = d.parentElement.getAttribute("data-id");
                if (f.formElement.querySelector('[value="' + b[a].type + '"]') !== null) {
                    f.formElement.querySelector('[value="' + b[a].type + '"]').selected = true
                }
                f.changeAction = true;
                f.gameList.view = false;
                f.gameList.gameCode = b[a].gameCode;
                f.serverList.serverCode = b[a].serverCode;
                f.gameList.createList()
            }
        }
    },
    deleteLastSearch: function(b) {
        if (b.isEmpty()) {
            return
        }
        var a = _WebStorage.localload("last_search") || [];
        if (a.length > 0) {
            var a = JSON.parse(a);
            a.splice(b, 1);
            _WebStorage.localsave({
                key: "last_search",
                value: JSON.stringify(a)
            })
        }
    },
    deleteListAll: function(a) {
        _WebStorage.localdel("last_search");
        a.remove()
    },
    getGameServerEl: function(b) {
        var a = b.parentElement;
        while (a !== null && a.classList.contains("hgt34TR") === false) {
            a = a.parentElement
        }
        var c = a.querySelector('[data-gslist="true"]');
        return c.gameserver || null
    }
};

function fnSearchHashCheck(g) {
    var f = ["regSell", "regBuy", "searchSell", "searchBuy"];
    var c = document.getElementById("g_gameServerList");
    if (hashControll.hasHash("page")) {
        if (c.gameserver !== undefined) {
            c.gameserver.onClose()
        }
        return
    }
    var d = hashControll.getHash();
    if (d !== "" && f.indexOf(d) !== -1) {
        if ($("#_LOGINCHECK").val() !== "1") {
            login(1);
            return
        }
        if (document.getElementById("btn_menu") !== null && document.getElementById("hamburger").classList.contains("on")) {
            document.getElementById("btn_menu").click()
        }
    }
    if (f.indexOf(d) !== -1) {
        var a;
        if (c !== null && c.gameserver === undefined) {
            a = new GameServerList(c, {
                hashName: d
            })
        } else {
            a = c.gameserver
        }
        var b = a.formElement.querySelector(a.tradeType.selector);
        if (b !== null) {
            var h = b.parentElement
        }
        if (d === "regSell") {
            a.setTradeType("sell");
            a.formElement.action = _DOMAIN + "/sell/";
            if (h !== null && h.classList.contains("search_type_empty") === false) {
                h.classList.add("search_type_empty")
            }
        } else {
            if (d === "regBuy") {
                a.setTradeType("buy");
                a.formElement.action = _DOMAIN + "/buy/";
                if (h !== null && h.classList.contains("search_type_empty") === false) {
                    h.classList.add("search_type_empty")
                }
            } else {
                if (d === "searchSell") {
                    a.setTradeType("sell");
                    if (h !== null && h.classList.contains("search_type_empty") === true) {
                        h.classList.remove("search_type_empty")
                    }
                } else {
                    if (d === "searchBuy") {
                        a.setTradeType("buy");
                        if (h !== null && h.classList.contains("search_type_empty") === true) {
                            h.classList.remove("search_type_empty")
                        }
                    }
                }
            }
        }
        a.serverList.onAction = function() {
            if (this.goodsCode !== undefined) {
                this.gameserver.formElement.querySelector('[name="search_goods"]').value = (this.goodsCode === "all") ? "" : this.goodsCode
            } else {
                this.gameserver.formElement.querySelector('[name="search_goods"]').value = ""
            }
            if (d === "searchSell" || d === "searchBuy") {
                var e = this.gameserver.formElement.querySelector(this.gameserver.tradeType.selector).value || "sell";
                this.gameserver.formElement.action = _DOMAIN + "/" + e + "/list_search"
            }
            this.gameserver.formElement.submit()
        };
        a.onOpen()
    } else {
        if (g == undefined && c !== null && c.gameserver !== undefined) {
            c.gameserver.onClose()
        }
    }
}

function login(a) {
    var b = encodeURIComponent(document.URL);
    if (a == "1") {
        alert("로그인 후 이용하실 수 있습니다.")
    }
    if (b.indexOf("returnUrl") != -1) {
        b = b.split("returnUrl=")[1]
    }

    location.href = _DOMAIN + "/login"
}

function fnChangeVersion() {
    _cookie.add("MOBILE_CHECK", "PC", 1, "/", "itemmania.com");
    location.href = "http://www.itemmania.com/"
}

function _initialize() {
    $(document).ajaxComplete(function(m, n, l) {
        var o = l.url;
        if (o.indexOf("?") != -1) {
            o = o.split("?")[0]
        }
        var k = $.inArray(o, g_ajaxLoading);
        if (k != -1) {
            g_ajaxLoading.splice(k, 1);
            if (g_ajaxLoading.length < 1) {
                $("#e4rn34RT").animate({
                    opacity: 1
                }, 100, function() {})
            }
        }
    });
    $(".g_checkbox").change(function() {
        if (this.checked == true) {
            $(this).addClass("on")
        } else {
            $(this).removeClass("on")
        }
    });
    $("#btn_back").click(function() {
        if (location.href.indexOf("igaw_deeplink_cvr=true") >= 0 && mobileAgent.type == "a") {
            window.androidMania.deepBack(location.href);
            return
        }
        if (window.opener) {
            self.close()
        } else {
            var k = document.referrer.replace(location.origin, "");
            var e = ["/portal/user/login_form_ok.php"];
            if ($.inArray(k, e) != -1) {
                location.href = "/"
            } else {
                history.back()
            }
        }
    });
    $("#btn_menu").on("click", h);

    function h() {
        if (!$("#_LOGINCHECK").val()) {
            alert("로그인이 필요합니다");
            location.href = "/login";
            return
        }
        c(function(k) {
            var l = "basic";
            $("#h_mileage").text(k.mile.currency() + "");
            if (k.credit == "A001") {} else {
                if (k.credit == "A101") {
                    l = "silver"
                } else {
                    if (k.credit == "A201") {
                        l = "gold"
                    } else {
                        if (k.credit == "A301") {
                            l = "platinum"
                        } else {
                            if (k.credit == "A401") {
                                l = "royal"
                            } else {
                                if (k.credit == "A501") {
                                    l = "vip"
                                }
                            }
                        }
                    }
                }
            }
            $("#c_credit").addClass("credit_mark " + l);
            var n = $("#menu_list");
            if (n.find("li").length < 1) {
                k.HamburgerMenu.forEach(function(r) {
                    var p = "<li>";
                    p += r.code == "ssadaprice" ? '<a href="javascript:fnSsadapriceGo()">' : '<a href="' + r.link + '">';
                    p += '<span class="menu_icon ' + r.code + '">';
                    if (r.code === "selling" || r.code === "buying") {
                        var q = k.sell_ing > 0 ? "" : "over__hidden";
                        var o = k.buy_ing > 0 ? "" : "over__hidden";
                        p += r.code == "selling" ? '<span class="badge ' + q + '" id="sell_badge">' + k.sell_ing + "</span>" : '<span class="badge ' + o + '" id="buy_badge">' + k.buy_ing + "</span>"
                    }
                    p += "</span>";
                    p += '<span class="menu_title">' + r.name + "</span></a></li>";
                    n.append(p)
                })
            }
            var e = $("#sell_badge"),
                m = $("#buy_badge");
            if (k.sell_ing != e.text()) {
                e.text(k.sell_ing);
                if (k.sell_ing > 0 && e.hasClass("over__hidden")) {
                    e.removeClass("over__hidden")
                } else {
                    if (k.sell_ing == 0) {
                        e.addClass("over__hidden")
                    }
                }
            } else {
                if (k.buy_ing != m.text()) {
                    m.text(k.buy_ing);
                    if (k.buy_ing > 0 && m.hasClass("over__hidden")) {
                        m.removeClass("over__hidden")
                    } else {
                        if (k.buy_ing == 0) {
                            m.addClass("over__hidden")
                        }
                    }
                }
            }
            a()
        })
    }
    var d = function() {
        $("#btn_menu").on("click", h);
        clearTimeout(d)
    };

    function c(e) {
        if ($("#btn_menu").data("ajaxCheck") !== true) {
            $("#btn_menu").off("click");
            setTimeout(d, 300);
            $("#btn_menu").data("ajaxCheck", true);
            ajaxRequest({
                url: '',
                success: function(k) {
                    if (k.result == "FAIL") {
                        $("#btn_menu").data("ajaxCheck", false);
                        alert(k.message);
                        return
                    } else {
                        e(k)
                    }
                },
                error: function() {
                    $("#btn_menu").data("ajaxCheck", false);
                    $("#h_mileage").text("0");
                    $("#c_credit").addClass("credit_mark basic")
                }
            })
        } else {
            a()
        }
    }

    function a() {
        if ($("#hamburger").hasClass("on")) {
            $("#hamburger").animate({
                right: "-100%"
            }, 300, function() {
                $("html, body").removeClass("fixed_on");
                $(this).removeClass("on")
            })
        } else {
            $("html, body").addClass("fixed_on");
            $("#hamburger").addClass("on").animate({
                right: "0"
            }, 300);
            $("#btn_m_close").on("click", function() {
                $("#btn_menu").trigger("click");
                $("#btn_menu").data("ajaxCheck", false);
                $(this).off("click")
            })
        }
    }
    $("[data-hash]").click(function(k) {
        if ($("#_LOGINCHECK").val() !== "1") {
            login(1);
            return
        }
        location.hash = this.getAttribute("data-hash");
        if (document.getElementById("btn_menu") !== null && document.getElementById("hamburger").classList.contains("on")) {
            document.getElementById("btn_menu").click()
        }
    });
    $("#srhButton").click(function() {
        var l = _myService.getGameServerEl(this);
        if (l !== null) {
            var k = new KeyboardEvent("keydown", {
                bubbles: true,
                cancelable: true,
                keyCode: 13
            });
            l.gameList.autoCompleteEl.dispatchEvent(k)
        }
    });
    var b = document.querySelectorAll("[data-popular]");
    var f = b.length;
    for (var j = 0; j < f; j++) {
        b[j].addEventListener("click", function(l) {
            var m = l.target;
            while (m !== null && m.getAttribute("data-pgame") === null) {
                m = m.parentElement
            }
            if (m !== null && m.getAttribute("data-pgame") !== null) {
                var n = _myService.getGameServerEl(m);
                if (n !== null) {
                    var k = m.getAttribute("data-pgame");
                    n.changeAction = true;
                    n.gameList.view = true;
                    n.gameList.gameCode = k;
                    delete n.serverList.selectedData;
                    n.gameList.createList()
                }
            }
        })
    }
    if (mobileAgent.type === "w") {
        try {
            (function(l, n, t, q, p, k, e) {
                l.GoogleAnalyticsObject = p;
                l[p] = l[p] || function() {
                    (l[p].q = l[p].q || []).push(arguments)
                }, l[p].l = 1 * new Date();
                k = n.createElement(t), e = n.getElementsByTagName(t)[0];
                k.async = 1;
                k.src = q;
                e.parentNode.insertBefore(k, e)
            })(window, document, "script", "//www.google-analytics.com/analytics.js", "ga");
            ga("create", "UA-47318075-5", "auto");
            ga("require", "displayfeatures");
            ga("send", "pageview")
        } catch (g) {
            if (_DEBUG) {
                g.print();
                return false
            }
        }
    }
    try {
        if ("_header" in window) {
            _header()
        }
        if ("_init" in window) {
            _init()
        }
        if ("__init" in window) {
            __init()
        }
        if ("___init" in window) {
            ___init()
        }
    } catch (g) {
        if (_DEBUG) {
            g.print();
            return false
        }
    }
}

function checkPeriod(o, g) {
    if (typeof o === "undefined" || typeof g === "undefined") {
        return false
    }
    if (o.length < 10 || g.length < 10) {
        console.log('%c checkPeriod() date format error: require format = "YYYY-MM-DD" or "YYYY-MM-DD HH:MM:SS"', "color:green;font-size:15px");
        return false
    }
    var a = new Date(o).valueOf(),
        l = new Date(g).valueOf(),
        b = new Date().valueOf();
    if (!a) {
        var n = o.split(" "),
            k = n[0].split("-"),
            j = n[1].split(":"),
            d = g.split(" "),
            h = d[0].split("-"),
            f = d[1].split(":");
        var m = {
            year: k[0],
            month: k[1] - 1,
            day: k[2],
            hour: j[0],
            minute: j[1],
            second: j[2]
        };
        var c = {
            year: h[0],
            month: h[1] - 1,
            day: h[2],
            hour: f[0],
            minute: f[1],
            second: f[2]
        };
        a = new Date(m.year, m.month, m.day, m.hour, m.minute, m.second).valueOf();
        l = new Date(c.year, c.month, c.day, c.hour, c.minute, c.second).valueOf()
    }
    if (b < a || b > l) {
        return false
    }
    return true
}

function fnSsadapriceGo() {
    if (mobileAgent.type === "i") {
        alert("준비중입니다.")
    } else {
        window.open("http://mssadaprice.itemmania.com")
    }
}
var mobileAgent = (function() {
    var c = navigator.userAgent;
    var b = {
        IOS: "IMI_APP_IOS",
        ANDROID: "IMIAPP"
    };
    var a = {
        type: "w",
        app: false
    };
    if (c.indexOf(b.ANDROID) !== -1) {
        a.type = "a";
        a.app = true
    } else {
        if (c.indexOf(b.IOS) !== -1) {
            a.type = "i";
            a.app = true
        }
    }
    return {
        type: a.type,
        app: a.app
    }
})();
$(window).on({
    hashchange: function() {
        fnSearchHashCheck()
    },
    load: fnSearchHashCheck
});
$(document).ready(function() {
    _initialize()
});
(function(b) {
    var a = function(f, r) {
        if (f[0] === null || f[0] === undefined) {
            return
        }
        var c = f[0].parentElement;
        while (c.classList.contains("screenshot_wrap2") === false) {
            c = c.parentNode
        }
        c.filestyle = this;
        c.filestyle.opts = r || {};
        c.classList.add("screenshot_wrap2");
        var q = c.filestyle.opts;
        var u = q.count || 10;
        var p = q.allowFiles || ["jpg", "jpeg"];
        var w = {
            jpg: "image/jpeg",
            jpeg: "image/jpeg",
            png: "image/png",
            gif: "image/gif"
        };
        if (u > 5) {
            if (document.getElementsByClassName("view_info").length < 1) {
                var n = document.createElement("div");
                n.className = "view_info";
                if (f.length > 5) {
                    c.classList.add("on");
                    n.innerHTML = "닫기"
                } else {
                    n.innerHTML = "이미지 추가 등록 +"
                }
                c.parentElement.appendChild(n);
                n.addEventListener("click", function() {
                    if (c.classList.contains("on") === true) {
                        c.classList.remove("on");
                        this.innerHTML = "이미지 추가 등록 +"
                    } else {
                        c.classList.add("on");
                        this.innerHTML = "닫기"
                    }
                })
            }
        }
        for (var t = 0; t < u; t++) {
            var l = f[t];
            if (l === undefined) {
                l = f[0].cloneNode();
                l.removeAttribute("data-seq");
                l.removeAttribute("data-img");
                c.appendChild(l)
            }
            if (l.parentElement.classList.contains("g_screenshot2") === true) {
                var j = l.parentElement
            } else {
                var j = document.createElement("div");
                j.className = "g_screenshot2";
                c.appendChild(j);
                c.insertBefore(j, l)
            }
            if (!isApp) {
                var g = document.createElement("a");
                g.href = "javascript:;";
                g.className = "screen_del";
                j.appendChild(g)
            }
            var d = document.createElement("div");
            d.className = "tmp_file";
            j.appendChild(l);
            j.appendChild(d);
            if (!isApp) {
                var v = document.createElement("span");
                var k = document.createElement("span");
                v.className = "tmp_file_info";
                k.className = "tmp_file_ext";
                d.appendChild(v);
                d.appendChild(k)
            }
            var h = l.getAttribute("data-img");
            if (h !== null) {
                if (isApp) {
                    var s = document.createElement("img");
                    s.src = h;
                    s.setAttribute("width", "100%");
                    d.appendChild(s)
                } else {
                    j.classList.add("active");
                    var e = h.split("/");
                    e = e[e.length - 1].split(".");
                    var x = e[0];
                    var m = "." + e[1];
                    v.innerHTML = x;
                    k.innerHTML = m
                }
            } else {
                if (!isApp) {
                    g.style.display = "none"
                }
            }
            d.addEventListener("click", function(A) {
                if (A.target.className !== "screen_del") {
                    nSelectFile = b(".tmp_file").index(b(this));
                    var o = this.previousElementSibling;
                    var z = this.parentElement;
                    if (isApp) {
                        if (o.getAttribute("data-seq") && confirm("삭제 하시겠습니까?")) {
                            var y = document.createElement("input");
                            y.type = "hidden";
                            y.name = "screen_del[]";
                            y.value = o.getAttribute("data-seq");
                            z.appendChild(y);
                            o.removeAttribute("data-seq");
                            o.removeAttribute("data-img");
                            this.innerHTML = ""
                        } else {
                            window.androidMania.chooseImg(1, 1)
                        }
                    } else {
                        o.click()
                    }
                }
            })
        }
        if (!isApp) {
            document.addEventListener("change", function(C) {
                if (C.target.name === f[0].name) {
                    if (C.target.value !== "") {
                        var o = C.target.parentNode;
                        while (o.classList.contains("g_screenshot2") === false) {
                            o = o.parentNode
                        }
                        var F = C.target.getAttribute("data-seq");
                        if (F !== null) {
                            var G = document.createElement("input");
                            G.type = "hidden";
                            G.name = "screen_del[]";
                            G.value = F;
                            o.appendChild(G);
                            C.target.removeAttribute("data-img");
                            C.target.removeAttribute("data-seq")
                        }
                        var H = C.target.nextElementSibling;
                        var z = H.getElementsByClassName("tmp_file_info")[0];
                        var E = H.getElementsByClassName("tmp_file_ext")[0];
                        var I = C.target.value.split("\\");
                        I = I[I.length - 1].split(".");
                        var y = I[0];
                        var J = "." + I[1];
                        if (C.target.files !== undefined) {
                            var B = C.target.files[0];
                            if (B) {
                                var y = B.name.split(".");
                                var A = y.pop().toLowerCase();
                                var D = true;
                                if (p.indexOf(A) === -1) {
                                    alert(p.join(",") + " 파일만 첨부 가능합니다.");
                                    D = false
                                } else {
                                    if (typeof(w[A]) !== "undefined" && B.type && w[A].indexOf(B.type) === -1) {
                                        alert(p.join(",") + " 파일만 첨부 가능합니다.");
                                        D = false
                                    } else {
                                        if (B.size > 300000) {
                                            alert("300kb이하의 이미지만 등록할 수 있습니다.");
                                            D = false
                                        }
                                    }
                                }
                                if (D === false) {
                                    C.target.value = "";
                                    z.innerHTML = "";
                                    E.innerHTML = "";
                                    o.getElementsByClassName("screen_del")[0].style.display = "none";
                                    o.classList.remove("active");
                                    return
                                }
                            }
                        }
                        z.innerHTML = y;
                        E.innerHTML = J;
                        o.getElementsByClassName("screen_del")[0].style.display = "block";
                        o.classList.add("active")
                    }
                }
            });
            document.addEventListener("click", function(C) {
                if (C.target.className === "screen_del") {
                    var y = C.target.parentElement;
                    while (y.classList.contains("g_screenshot2") === false) {
                        y = y.parentElement
                    }
                    var o = y.querySelector('[type="file"]');
                    var F = o.getAttribute("data-seq");
                    if (F !== null) {
                        var G = document.createElement("input");
                        G.type = "hidden";
                        G.name = "screen_del[]";
                        G.value = F;
                        y.appendChild(G);
                        o.removeAttribute("data-seq");
                        o.removeAttribute("data-img")
                    }
                    var H = y.getElementsByClassName("tmp_file")[0];
                    var B = H.getElementsByClassName("tmp_file_info")[0];
                    var E = H.getElementsByClassName("tmp_file_ext")[0];
                    y.getElementsByClassName("screen_del")[0].style.display = "none";
                    B.innerHTML = "";
                    E.innerHTML = "";
                    o.value = "";
                    y.classList.remove("active")
                }
                if (C.target.className === "screen_add") {
                    var A = q.remain || 0;
                    if (A + c.querySelectorAll(".g_screenshot").length >= q.limit) {
                        alert("최대 " + q.limit + "개 까지 등록 가능합니다.");
                        return
                    }
                    var D = j.cloneNode(true);
                    D.querySelector('[type="text"]').value = "";
                    c.appendChild(D);
                    var z = D.querySelector(".screen_add");
                    z.parentNode.removeChild(z)
                }
            })
        }
    };
    window.FileStyleVer1 = a
})(jQuery);
(function(V) {
    var E = V.fn.domManip,
        S = "_tmplitem",
        F = /^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,
        U = {},
        Q = {},
        R, G = {
            key: 0,
            data: {}
        },
        N = 0,
        T = 0,
        K = [];

    function P(b, j, a, f) {
        var k = {
            data: f || (f === 0 || f === false) ? f : j ? j.data : {},
            _wrap: j ? j._wrap : null,
            tmpl: null,
            parent: j || null,
            nodes: [],
            calls: B,
            nest: z,
            wrap: y,
            html: A,
            update: C
        };
        b && V.extend(k, b, {
            nodes: [],
            parent: j
        });
        if (a) {
            k.tmpl = a;
            k._ctnt = k._ctnt || k.tmpl(V, k);
            k.key = ++N;
            (K.length ? Q : U)[N] = k
        }
        return k
    }
    V.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(a, b) {
        V.fn[a] = function(r) {
            var q = [],
                o = V(r),
                e, p, c, d, f = this.length === 1 && this[0].parentNode;
            R = U || {};
            if (f && f.nodeType === 11 && f.childNodes.length === 1 && o.length === 1) {
                o[b](this[0]);
                q = this
            } else {
                for (p = 0, c = o.length; p < c; p++) {
                    T = p;
                    e = (p > 0 ? this.clone(true) : this).get();
                    V(o[p])[b](e);
                    q = q.concat(e)
                }
                T = 0;
                q = this.pushStack(q, a, o.selector)
            }
            d = R;
            R = null;
            V.tmpl.complete(d);
            return q
        }
    });
    V.fn.extend({
        tmpl: function(e, f, a) {
            return V.tmpl(this[0], e, f, a)
        },
        tmplItem: function() {
            return V.tmplItem(this[0])
        },
        template: function(a) {
            return V.template(a, this[0])
        },
        domManip: function(p, a, b) {
            if (p[0] && V.isArray(p[0])) {
                var n = V.makeArray(arguments),
                    l = p[0],
                    c = l.length,
                    e = 0,
                    o;
                while (e < c && !(o = V.data(l[e++], "tmplItem"))) {}
                if (o && T) {
                    n[2] = function(d) {
                        V.tmpl.afterManip(this, d, b)
                    }
                }
                E.apply(this, n)
            } else {
                E.apply(this, arguments)
            }
            T = 0;
            !R && V.tmpl.complete(U);
            return this
        }
    });
    V.extend({
        tmpl: function(j, f, g, l) {
            var b, a = !l;
            if (a) {
                l = G;
                j = V.template[j] || V.template(null, j);
                Q = {}
            } else {
                if (!j) {
                    j = l.tmpl;
                    U[l.key] = l;
                    l.nodes = [];
                    l.wrapped && I(l, l.wrapped);
                    return V(M(l, null, l.tmpl(V, l)))
                }
            }
            if (!j) {
                return []
            }
            if (typeof f === "function") {
                f = f.call(l || {})
            }
            g && g.wrapped && I(g, g.wrapped);
            b = V.isArray(f) ? V.map(f, function(c) {
                return c ? P(g, l, j, c) : null
            }) : [P(g, l, j, f)];
            return a ? V(M(l, null, b)) : b
        },
        tmplItem: function(a) {
            var d;
            if (a instanceof V) {
                a = a[0]
            }
            while (a && a.nodeType === 1 && !(d = V.data(a, "tmplItem")) && (a = a.parentNode)) {}
            return d || G
        },
        template: function(d, a) {
            if (a) {
                if (typeof a === "string") {
                    a = H(a)
                } else {
                    if (a instanceof V) {
                        a = a[0] || {}
                    }
                }
                if (a.nodeType) {
                    a = V.data(a, "tmpl") || V.data(a, "tmpl", H(a.innerHTML))
                }
                return typeof d === "string" ? (V.template[d] = a) : a
            }
            return d ? typeof d !== "string" ? V.template(null, d) : V.template[d] || V.template(null, F.test(d) ? d : V(d)) : null
        },
        encode: function(b) {
            return ("" + b).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")
        }
    });
    V.extend(V.tmpl, {
        tag: {
            tmpl: {
                _default: {
                    $2: "null"
                },
                open: "if($notnull_1){__=__.concat($item.nest($1,$2));}"
            },
            wrap: {
                _default: {
                    $2: "null"
                },
                open: "$item.calls(__,$1,$2);__=[];",
                close: "call=$item.calls();__=call._.concat($item.wrap(call,__));"
            },
            each: {
                _default: {
                    $2: "$index, $value"
                },
                open: "if($notnull_1){$.each($1a,function($2){with(this){",
                close: "}});}"
            },
            "if": {
                open: "if(($notnull_1) && $1a){",
                close: "}"
            },
            "else": {
                _default: {
                    $1: "true"
                },
                open: "}else if(($notnull_1) && $1a){"
            },
            html: {
                open: "if($notnull_1){__.push($1a);}"
            },
            "=": {
                _default: {
                    $1: "$data"
                },
                open: "if($notnull_1){__.push($.encode($1a));}"
            },
            "!": {
                open: ""
            }
        },
        complete: function() {
            U = {}
        },
        afterManip: function(c, a, h) {
            var g = a.nodeType === 11 ? V.makeArray(a.childNodes) : a.nodeType === 1 ? [a] : [];
            h.call(c, a);
            J(g);
            T++
        }
    });

    function M(j, d, h) {
        var a, k = h ? V.map(h, function(b) {
            return typeof b === "string" ? j.key ? b.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g, "$1 " + S + '="' + j.key + '" $2') : b : M(b, j, b._ctnt)
        }) : j;
        if (d) {
            return k
        }
        k = k.join("");
        k.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/, function(b, m, g, l) {
            a = V(g).get();
            J(a);
            if (m) {
                a = L(m).concat(a)
            }
            if (l) {
                a = a.concat(L(l))
            }
        });
        return a ? a : L(k)
    }

    function L(d) {
        var a = document.createElement("div");
        a.innerHTML = d;
        return V.makeArray(a.childNodes)
    }

    function H(a) {
        return new Function("jQuery", "$item", "var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('" + V.trim(a).replace(/([\\'])/g, "\\$1").replace(/[\r\t\n]/g, " ").replace(/\$\{([^\}]*)\}/g, "{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g, function(h, n, o, r, w, v, u) {
            var p = V.tmpl.tag[o],
                q, t, s;
            if (!p) {
                throw "Unknown template tag: " + o
            }
            q = p._default || [];
            if (v && !/\w$/.test(w)) {
                w += v;
                v = ""
            }
            if (w) {
                w = O(w);
                u = u ? "," + O(u) + ")" : v ? ")" : "";
                t = v ? w.indexOf(".") > -1 ? w + O(v) : "(" + w + ").call($item" + u : w;
                s = v ? t : "(typeof(" + w + ")==='function'?(" + w + ").call($item):(" + w + "))"
            } else {
                s = t = q.$1 || "null"
            }
            r = O(r);
            return "');" + p[n ? "close" : "open"].split("$notnull_1").join(w ? "typeof(" + w + ")!=='undefined' && (" + w + ")!=null" : "true").split("$1a").join(s).split("$1").join(t).split("$2").join(r || q.$2 || "") + "__.push('"
        }) + "');}return __;")
    }

    function I(d, a) {
        d._wrap = M(d, true, V.isArray(a) ? a : [F.test(a) ? a : V(a).html()]).join("")
    }

    function O(b) {
        return b ? b.replace(/\\'/g, "'").replace(/\\\\/g, "\\") : null
    }

    function D(c) {
        var d = document.createElement("div");
        d.appendChild(c.cloneNode(true));
        return d.innerHTML
    }

    function J(b) {
        var c = "_" + T,
            g, q, f = {},
            s, a, r;
        for (s = 0, a = b.length; s < a; s++) {
            if ((g = b[s]).nodeType !== 1) {
                continue
            }
            q = g.getElementsByTagName("*");
            for (r = q.length - 1; r >= 0; r--) {
                d(q[r])
            }
            d(g)
        }

        function d(t) {
            var w, u = t,
                n, v, l;
            if (l = t.getAttribute(S)) {
                while (u.parentNode && (u = u.parentNode).nodeType === 1 && !(w = u.getAttribute(S))) {}
                if (w !== l) {
                    u = u.parentNode ? u.nodeType === 11 ? 0 : u.getAttribute(S) || 0 : 0;
                    if (!(v = U[l])) {
                        v = Q[l];
                        v = P(v, U[u] || Q[u]);
                        v.key = ++N;
                        U[N] = v
                    }
                    T && x(l)
                }
                t.removeAttribute(S)
            } else {
                if (T && (v = V.data(t, "tmplItem"))) {
                    x(v.key);
                    U[v.key] = v;
                    u = V.data(t.parentNode, "tmplItem");
                    u = u ? u.key : 0
                }
            }
            if (v) {
                n = v;
                while (n && n.key != u) {
                    n.nodes.push(t);
                    n = n.parent
                }
                delete v._ctnt;
                delete v._wrap;
                V.data(t, "tmplItem", v)
            }

            function x(e) {
                e = e + c;
                v = f[e] = f[e] || P(v, U[v.parent.key + c] || v.parent)
            }
        }
    }

    function B(f, g, h, e) {
        if (!f) {
            return K.pop()
        }
        K.push({
            _: f,
            tmpl: g,
            item: this,
            data: h,
            options: e
        })
    }

    function z(e, f, a) {
        return V.tmpl(V.template(e), f, a, this)
    }

    function y(a, e) {
        var f = a.options || {};
        f.wrapped = e;
        return V.tmpl(V.template(a.tmpl), a.data, f, a.item)
    }

    function A(e, f) {
        var a = this._wrap;
        return V.map(V(V.isArray(a) ? a.join("") : a).filter(e || "*"), function(b) {
            return f ? b.innerText || b.textContent : b.outerHTML || D(b)
        })
    }

    function C() {
        var a = this.nodes;
        V.tmpl(null, null, null, this).insertBefore(a[0]);
        V(a).remove()
    }
})(jQuery);
/*! iScroll v5.2.0-snapshot ~ (c) 2008-2017 Matteo Spinelli ~ http://cubiq.org/license */
(function(d, a, c) {
    var f = d.requestAnimationFrame || d.webkitRequestAnimationFrame || d.mozRequestAnimationFrame || d.oRequestAnimationFrame || d.msRequestAnimationFrame || function(g) {
        d.setTimeout(g, 1000 / 60)
    };
    var b = (function() {
        var l = {};
        var m = a.createElement("div").style;
        var j = (function() {
            var q = ["t", "webkitT", "MozT", "msT", "OT"],
                o, p = 0,
                n = q.length;
            for (; p < n; p++) {
                o = q[p] + "ransform";
                if (o in m) {
                    return q[p].substr(0, q[p].length - 1)
                }
            }
            return false
        })();

        function k(n) {
            if (j === false) {
                return false
            }
            if (j === "") {
                return n
            }
            return j + n.charAt(0).toUpperCase() + n.substr(1)
        }
        l.getTime = Date.now || function g() {
            return new Date().getTime()
        };
        l.extend = function(p, o) {
            for (var n in o) {
                p[n] = o[n]
            }
        };
        l.addEvent = function(q, p, o, n) {
            q.addEventListener(p, o, !!n)
        };
        l.removeEvent = function(q, p, o, n) {
            q.removeEventListener(p, o, !!n)
        };
        l.prefixPointerEvent = function(n) {
            return d.MSPointerEvent ? "MSPointer" + n.charAt(7).toUpperCase() + n.substr(8) : n
        };
        l.momentum = function(t, p, q, n, u, v) {
            var o = t - p,
                r = c.abs(o) / q,
                w, s;
            v = v === undefined ? 0.0006 : v;
            w = t + (r * r) / (2 * v) * (o < 0 ? -1 : 1);
            s = r / v;
            if (w < n) {
                w = u ? n - (u / 2.5 * (r / 8)) : n;
                o = c.abs(w - t);
                s = o / r
            } else {
                if (w > 0) {
                    w = u ? u / 2.5 * (r / 8) : 0;
                    o = c.abs(t) + w;
                    s = o / r
                }
            }
            return {
                destination: c.round(w),
                duration: s
            }
        };
        var h = k("transform");
        l.extend(l, {
            hasTransform: h !== false,
            hasPerspective: k("perspective") in m,
            hasTouch: "ontouchstart" in d,
            hasPointer: !!(d.PointerEvent || d.MSPointerEvent),
            hasTransition: k("transition") in m
        });
        l.isBadAndroid = (function() {
            var n = d.navigator.appVersion;
            if (/Android/.test(n) && !(/Chrome\/\d/.test(n))) {
                var o = n.match(/Safari\/(\d+.\d)/);
                if (o && typeof o === "object" && o.length >= 2) {
                    return parseFloat(o[1]) < 535.19
                }
                return true
            }
            return false
        })();
        l.extend(l.style = {}, {
            transform: h,
            transitionTimingFunction: k("transitionTimingFunction"),
            transitionDuration: k("transitionDuration"),
            transitionDelay: k("transitionDelay"),
            transformOrigin: k("transformOrigin"),
            touchAction: k("touchAction")
        });
        l.hasClass = function(o, p) {
            var n = new RegExp("(^|\\s)" + p + "(\\s|$)");
            return n.test(o.className)
        };
        l.addClass = function(o, p) {
            if (l.hasClass(o, p)) {
                return
            }
            var n = o.className.split(" ");
            n.push(p);
            o.className = n.join(" ")
        };
        l.removeClass = function(o, p) {
            if (!l.hasClass(o, p)) {
                return
            }
            var n = new RegExp("(^|\\s)" + p + "(\\s|$)", "g");
            o.className = o.className.replace(n, " ")
        };
        l.offset = function(n) {
            var p = -n.offsetLeft,
                o = -n.offsetTop;
            while (n = n.offsetParent) {
                p -= n.offsetLeft;
                o -= n.offsetTop
            }
            return {
                left: p,
                top: o
            }
        };
        l.preventDefaultException = function(p, o) {
            for (var n in o) {
                if (o[n].test(p[n])) {
                    return true
                }
            }
            return false
        };
        l.extend(l.eventType = {}, {
            touchstart: 1,
            touchmove: 1,
            touchend: 1,
            mousedown: 2,
            mousemove: 2,
            mouseup: 2,
            pointerdown: 3,
            pointermove: 3,
            pointerup: 3,
            MSPointerDown: 3,
            MSPointerMove: 3,
            MSPointerUp: 3
        });
        l.extend(l.ease = {}, {
            quadratic: {
                style: "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
                fn: function(n) {
                    return n * (2 - n)
                }
            },
            circular: {
                style: "cubic-bezier(0.1, 0.57, 0.1, 1)",
                fn: function(n) {
                    return c.sqrt(1 - (--n * n))
                }
            },
            back: {
                style: "cubic-bezier(0.175, 0.885, 0.32, 1.275)",
                fn: function(o) {
                    var n = 4;
                    return (o = o - 1) * o * ((n + 1) * o + n) + 1
                }
            },
            bounce: {
                style: "",
                fn: function(n) {
                    if ((n /= 1) < (1 / 2.75)) {
                        return 7.5625 * n * n
                    } else {
                        if (n < (2 / 2.75)) {
                            return 7.5625 * (n -= (1.5 / 2.75)) * n + 0.75
                        } else {
                            if (n < (2.5 / 2.75)) {
                                return 7.5625 * (n -= (2.25 / 2.75)) * n + 0.9375
                            }
                        }
                    }
                    return 7.5625 * (n -= (2.625 / 2.75)) * n + 0.984375
                }
            },
            elastic: {
                style: "",
                fn: function(n) {
                    var o = 0.22,
                        p = 0.4;
                    if (n === 0) {
                        return 0
                    }
                    if (n == 1) {
                        return 1
                    }
                    return (p * c.pow(2, -10 * n) * c.sin((n - o / 4) * (2 * c.PI) / o) + 1)
                }
            }
        });
        l.tap = function(p, n) {
            var o = a.createEvent("Event");
            o.initEvent(n, true, true);
            o.pageX = p.pageX;
            o.pageY = p.pageY;
            p.target.dispatchEvent(o)
        };
        l.click = function(p) {
            var o = p.target,
                n;
            if (!(/(SELECT|INPUT|TEXTAREA)/i).test(o.tagName)) {
                n = a.createEvent(d.MouseEvent ? "MouseEvents" : "Event");
                n.initEvent("click", true, true);
                n.view = p.view || d;
                n.detail = 1;
                n.screenX = o.screenX || 0;
                n.screenY = o.screenY || 0;
                n.clientX = o.clientX || 0;
                n.clientY = o.clientY || 0;
                n.ctrlKey = !!p.ctrlKey;
                n.altKey = !!p.altKey;
                n.shiftKey = !!p.shiftKey;
                n.metaKey = !!p.metaKey;
                n.button = 0;
                n.relatedTarget = null;
                n._constructed = true;
                o.dispatchEvent(n)
            }
        };
        l.getTouchAction = function(n, p) {
            var o = "none";
            if (n === "vertical") {
                o = "pan-y"
            } else {
                if (n === "horizontal") {
                    o = "pan-x"
                }
            }
            if (p && o != "none") {
                o += " pinch-zoom"
            }
            return o
        };
        l.getRect = function(n) {
            if (n instanceof SVGElement) {
                var o = n.getBoundingClientRect();
                return {
                    top: o.top,
                    left: o.left,
                    width: o.width,
                    height: o.height
                }
            }
            return {
                top: n.offsetTop,
                left: n.offsetLeft,
                width: n.offsetWidth,
                height: n.offsetHeight
            }
        };
        return l
    })();

    function e(j, g) {
        this.wrapper = typeof j === "string" ? a.querySelector(j) : j;
        this.scroller = this.wrapper.children[0];
        this.scrollerStyle = this.scroller.style;
        this.options = {
            mouseWheelSpeed: 20,
            snapThreshold: 0.334,
            infiniteUseTransform: true,
            deceleration: 0.004,
            disablePointer: !b.hasPointer,
            disableTouch: b.hasPointer || !b.hasTouch,
            disableMouse: b.hasPointer || b.hasTouch,
            startX: 0,
            startY: 0,
            scrollY: true,
            directionLockThreshold: 5,
            momentum: true,
            bounce: true,
            bounceTime: 600,
            bounceEasing: "",
            preventDefault: true,
            preventDefaultException: {
                tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT)$/
            },
            HWCompositing: true,
            useTransition: true,
            useTransform: true,
            bindToWrapper: typeof d.onmousedown === "undefined"
        };
        for (var h in g) {
            this.options[h] = g[h]
        }
        this.translateZ = this.options.HWCompositing && b.hasPerspective ? " translateZ(0)" : "";
        this.options.useTransition = b.hasTransition && this.options.useTransition;
        this.options.useTransform = b.hasTransform && this.options.useTransform;
        this.options.eventPassthrough = this.options.eventPassthrough === true ? "vertical" : this.options.eventPassthrough;
        this.options.preventDefault = !this.options.eventPassthrough && this.options.preventDefault;
        this.options.scrollY = this.options.eventPassthrough == "vertical" ? false : this.options.scrollY;
        this.options.scrollX = this.options.eventPassthrough == "horizontal" ? false : this.options.scrollX;
        this.options.freeScroll = this.options.freeScroll && !this.options.eventPassthrough;
        this.options.directionLockThreshold = this.options.eventPassthrough ? 0 : this.options.directionLockThreshold;
        this.options.bounceEasing = typeof this.options.bounceEasing === "string" ? b.ease[this.options.bounceEasing] || b.ease.circular : this.options.bounceEasing;
        this.options.resizePolling = this.options.resizePolling === undefined ? 60 : this.options.resizePolling;
        if (this.options.tap === true) {
            this.options.tap = "tap"
        }
        if (!this.options.useTransition && !this.options.useTransform) {
            if (!(/relative|absolute/i).test(this.scrollerStyle.position)) {
                this.scrollerStyle.position = "relative"
            }
        }
        this.options.invertWheelDirection = this.options.invertWheelDirection ? -1 : 1;
        if (this.options.infiniteElements) {
            this.options.probeType = 3
        }
        this.options.infiniteUseTransform = this.options.infiniteUseTransform && this.options.useTransform;
        if (this.options.probeType == 3) {
            this.options.useTransition = false
        }
        this.x = 0;
        this.y = 0;
        this.directionX = 0;
        this.directionY = 0;
        this._events = {};
        this._init();
        this.refresh();
        this.scrollTo(this.options.startX, this.options.startY);
        this.enable()
    }
    e.prototype = {
        version: "5.2.0-snapshot",
        _init: function() {
            this._initEvents();
            if (this.options.mouseWheel) {
                this._initWheel()
            }
            if (this.options.snap) {
                this._initSnap()
            }
            if (this.options.keyBindings) {
                this._initKeys()
            }
            if (this.options.infiniteElements) {
                this._initInfinite()
            }
        },
        destroy: function() {
            this._initEvents(true);
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = null;
            this._execEvent("destroy")
        },
        _transitionEnd: function(g) {
            if (g.target != this.scroller || !this.isInTransition) {
                return
            }
            this._transitionTime();
            if (!this.resetPosition(this.options.bounceTime)) {
                this.isInTransition = false;
                this._execEvent("scrollEnd")
            }
        },
        _start: function(j) {
            if (b.eventType[j.type] != 1) {
                var h;
                if (!j.which) {
                    h = (j.button < 2) ? 0 : ((j.button == 4) ? 1 : 2)
                } else {
                    h = j.button
                }
                if (h !== 0) {
                    return
                }
            }
            if (!this.enabled || (this.initiated && b.eventType[j.type] !== this.initiated)) {
                return
            }
            if (this.options.preventDefault && !b.isBadAndroid && !b.preventDefaultException(j.target, this.options.preventDefaultException)) {
                j.preventDefault()
            }
            var g = j.touches ? j.touches[0] : j,
                k;
            this.initiated = b.eventType[j.type];
            this.moved = false;
            this.distX = 0;
            this.distY = 0;
            this.directionX = 0;
            this.directionY = 0;
            this.directionLocked = 0;
            this.startTime = b.getTime();
            if (this.options.useTransition && this.isInTransition) {
                this._transitionTime();
                this.isInTransition = false;
                k = this.getComputedPosition();
                this._translate(c.round(k.x), c.round(k.y));
                this._execEvent("scrollEnd")
            } else {
                if (!this.options.useTransition && this.isAnimating) {
                    this.isAnimating = false;
                    this._execEvent("scrollEnd")
                }
            }
            this.startX = this.x;
            this.startY = this.y;
            this.absStartX = this.x;
            this.absStartY = this.y;
            this.pointX = g.pageX;
            this.pointY = g.pageY;
            this._execEvent("beforeScrollStart")
        },
        _move: function(m) {
            if (!this.enabled || b.eventType[m.type] !== this.initiated) {
                return
            }
            if (this.options.preventDefault) {
                m.preventDefault()
            }
            var o = m.touches ? m.touches[0] : m,
                j = o.pageX - this.pointX,
                h = o.pageY - this.pointY,
                n = b.getTime(),
                g, p, l, k;
            this.pointX = o.pageX;
            this.pointY = o.pageY;
            this.distX += j;
            this.distY += h;
            l = c.abs(this.distX);
            k = c.abs(this.distY);
            if (n - this.endTime > 300 && (l < 10 && k < 10)) {
                return
            }
            if (!this.directionLocked && !this.options.freeScroll) {
                if (l > k + this.options.directionLockThreshold) {
                    this.directionLocked = "h"
                } else {
                    if (k >= l + this.options.directionLockThreshold) {
                        this.directionLocked = "v"
                    } else {
                        this.directionLocked = "n"
                    }
                }
            }
            if (this.directionLocked == "h") {
                if (this.options.eventPassthrough == "vertical") {
                    m.preventDefault()
                } else {
                    if (this.options.eventPassthrough == "horizontal") {
                        this.initiated = false;
                        return
                    }
                }
                h = 0
            } else {
                if (this.directionLocked == "v") {
                    if (this.options.eventPassthrough == "horizontal") {
                        m.preventDefault()
                    } else {
                        if (this.options.eventPassthrough == "vertical") {
                            this.initiated = false;
                            return
                        }
                    }
                    j = 0
                }
            }
            j = this.hasHorizontalScroll ? j : 0;
            h = this.hasVerticalScroll ? h : 0;
            g = this.x + j;
            p = this.y + h;
            if (g > 0 || g < this.maxScrollX) {
                g = this.options.bounce ? this.x + j / 3 : g > 0 ? 0 : this.maxScrollX
            }
            if (p > 0 || p < this.maxScrollY) {
                p = this.options.bounce ? this.y + h / 3 : p > 0 ? 0 : this.maxScrollY
            }
            this.directionX = j > 0 ? -1 : j < 0 ? 1 : 0;
            this.directionY = h > 0 ? -1 : h < 0 ? 1 : 0;
            if (!this.moved) {
                this._execEvent("scrollStart")
            }
            this.moved = true;
            this._translate(g, p);
            if (n - this.startTime > 300) {
                this.startTime = n;
                this.startX = this.x;
                this.startY = this.y;
                if (this.options.probeType == 1) {
                    this._execEvent("scroll")
                }
            }
            if (this.options.probeType > 1) {
                this._execEvent("scroll")
            }
        },
        _end: function(n) {
            if (!this.enabled || b.eventType[n.type] !== this.initiated) {
                return
            }
            if (this.options.preventDefault && !b.preventDefaultException(n.target, this.options.preventDefaultException)) {
                n.preventDefault()
            }
            var p = n.changedTouches ? n.changedTouches[0] : n,
                j, h, m = b.getTime() - this.startTime,
                g = c.round(this.x),
                s = c.round(this.y),
                r = c.abs(g - this.startX),
                q = c.abs(s - this.startY),
                k = 0,
                o = "";
            this.isInTransition = 0;
            this.initiated = 0;
            this.endTime = b.getTime();
            if (this.resetPosition(this.options.bounceTime)) {
                return
            }
            this.scrollTo(g, s);
            if (!this.moved) {
                if (this.options.tap) {
                    b.tap(n, this.options.tap)
                }
                if (this.options.click) {
                    b.click(n)
                }
                this._execEvent("scrollCancel");
                return
            }
            if (this._events.flick && m < 200 && r < 100 && q < 100) {
                this._execEvent("flick");
                return
            }
            if (this.options.momentum && m < 300) {
                j = this.hasHorizontalScroll ? b.momentum(this.x, this.startX, m, this.maxScrollX, this.options.bounce ? this.wrapperWidth : 0, this.options.deceleration) : {
                    destination: g,
                    duration: 0
                };
                h = this.hasVerticalScroll ? b.momentum(this.y, this.startY, m, this.maxScrollY, this.options.bounce ? this.wrapperHeight : 0, this.options.deceleration) : {
                    destination: s,
                    duration: 0
                };
                g = j.destination;
                s = h.destination;
                k = c.max(j.duration, h.duration);
                this.isInTransition = 1
            }
            if (this.options.snap) {
                var l = this._nearestSnap(g, s);
                this.currentPage = l;
                k = this.options.snapSpeed || c.max(c.max(c.min(c.abs(g - l.x), 1000), c.min(c.abs(s - l.y), 1000)), 300);
                g = l.x;
                s = l.y;
                this.directionX = 0;
                this.directionY = 0;
                o = this.options.bounceEasing
            }
            if (g != this.x || s != this.y) {
                if (g > 0 || g < this.maxScrollX || s > 0 || s < this.maxScrollY) {
                    o = b.ease.quadratic
                }
                this.scrollTo(g, s, k, o);
                return
            }
            this._execEvent("scrollEnd")
        },
        _resize: function() {
            var g = this;
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(function() {
                g.refresh()
            }, this.options.resizePolling)
        },
        resetPosition: function(h) {
            var g = this.x,
                j = this.y;
            h = h || 0;
            if (!this.hasHorizontalScroll || this.x > 0) {
                g = 0
            } else {
                if (this.x < this.maxScrollX) {
                    g = this.maxScrollX
                }
            }
            if (!this.hasVerticalScroll || this.y > 0) {
                j = 0
            } else {
                if (this.y < this.maxScrollY) {
                    j = this.maxScrollY
                }
            }
            if (g == this.x && j == this.y) {
                return false
            }
            this.scrollTo(g, j, h, this.options.bounceEasing);
            return true
        },
        disable: function() {
            this.enabled = false
        },
        enable: function() {
            this.enabled = true
        },
        refresh: function() {
            b.getRect(this.wrapper);
            this.wrapperWidth = this.wrapper.clientWidth;
            this.wrapperHeight = this.wrapper.clientHeight;
            var h = b.getRect(this.scroller);
            this.scrollerWidth = h.width;
            this.scrollerHeight = h.height;
            this.maxScrollX = this.wrapperWidth - this.scrollerWidth;
            var g;
            if (this.options.infiniteElements) {
                this.options.infiniteLimit = this.options.infiniteLimit || c.floor(2147483645 / this.infiniteElementHeight);
                g = -this.options.infiniteLimit * this.infiniteElementHeight + this.wrapperHeight
            }
            this.maxScrollY = g !== undefined ? g : this.wrapperHeight - this.scrollerHeight;
            this.hasHorizontalScroll = this.options.scrollX && this.maxScrollX < 0;
            this.hasVerticalScroll = this.options.scrollY && this.maxScrollY < 0;
            if (!this.hasHorizontalScroll) {
                this.maxScrollX = 0;
                this.scrollerWidth = this.wrapperWidth
            }
            if (!this.hasVerticalScroll) {
                this.maxScrollY = 0;
                this.scrollerHeight = this.wrapperHeight
            }
            this.endTime = 0;
            this.directionX = 0;
            this.directionY = 0;
            if (b.hasPointer && !this.options.disablePointer) {
                this.wrapper.style[b.style.touchAction] = b.getTouchAction(this.options.eventPassthrough, true);
                if (!this.wrapper.style[b.style.touchAction]) {
                    this.wrapper.style[b.style.touchAction] = b.getTouchAction(this.options.eventPassthrough, false)
                }
            }
            this.wrapperOffset = b.offset(this.wrapper);
            this._execEvent("refresh");
            this.resetPosition()
        },
        on: function(h, g) {
            if (!this._events[h]) {
                this._events[h] = []
            }
            this._events[h].push(g)
        },
        off: function(j, h) {
            if (!this._events[j]) {
                return
            }
            var g = this._events[j].indexOf(h);
            if (g > -1) {
                this._events[j].splice(g, 1)
            }
        },
        _execEvent: function(j) {
            if (!this._events[j]) {
                return
            }
            var h = 0,
                g = this._events[j].length;
            if (!g) {
                return
            }
            for (; h < g; h++) {
                this._events[j][h].apply(this, [].slice.call(arguments, 1))
            }
        },
        scrollBy: function(g, k, h, j) {
            g = this.x + g;
            k = this.y + k;
            h = h || 0;
            this.scrollTo(g, k, h, j)
        },
        scrollTo: function(g, l, j, k) {
            k = k || b.ease.circular;
            this.isInTransition = this.options.useTransition && j > 0;
            var h = this.options.useTransition && k.style;
            if (!j || h) {
                if (h) {
                    this._transitionTimingFunction(k.style);
                    this._transitionTime(j)
                }
                this._translate(g, l)
            } else {
                this._animate(g, l, j, k.fn)
            }
        },
        scrollToElement: function(j, l, g, o, n) {
            j = j.nodeType ? j : this.scroller.querySelector(j);
            if (!j) {
                return
            }
            var m = b.offset(j);
            m.left -= this.wrapperOffset.left;
            m.top -= this.wrapperOffset.top;
            var h = b.getRect(j);
            var k = b.getRect(this.wrapper);
            if (g === true) {
                g = c.round(h.width / 2 - k.width / 2)
            }
            if (o === true) {
                o = c.round(h.height / 2 - k.height / 2)
            }
            m.left -= g || 0;
            m.top -= o || 0;
            m.left = m.left > 0 ? 0 : m.left < this.maxScrollX ? this.maxScrollX : m.left;
            m.top = m.top > 0 ? 0 : m.top < this.maxScrollY ? this.maxScrollY : m.top;
            l = l === undefined || l === null || l === "auto" ? c.max(c.abs(this.x - m.left), c.abs(this.y - m.top)) : l;
            this.scrollTo(m.left, m.top, l, n)
        },
        _transitionTime: function(j) {
            if (!this.options.useTransition) {
                return
            }
            j = j || 0;
            var g = b.style.transitionDuration;
            if (!g) {
                return
            }
            this.scrollerStyle[g] = j + "ms";
            if (!j && b.isBadAndroid) {
                this.scrollerStyle[g] = "0.0001ms";
                var h = this;
                f(function() {
                    if (h.scrollerStyle[g] === "0.0001ms") {
                        h.scrollerStyle[g] = "0s"
                    }
                })
            }
        },
        _transitionTimingFunction: function(g) {
            this.scrollerStyle[b.style.transitionTimingFunction] = g
        },
        _translate: function(g, h) {
            if (this.options.useTransform) {
                this.scrollerStyle[b.style.transform] = "translate(" + g + "px," + h + "px)" + this.translateZ
            } else {
                g = c.round(g);
                h = c.round(h);
                this.scrollerStyle.left = g + "px";
                this.scrollerStyle.top = h + "px"
            }
            this.x = g;
            this.y = h
        },
        _initEvents: function(g) {
            var h = g ? b.removeEvent : b.addEvent,
                j = this.options.bindToWrapper ? this.wrapper : d;
            h(d, "orientationchange", this);
            h(d, "resize", this);
            if (this.options.click) {
                h(this.wrapper, "click", this, true)
            }
            if (!this.options.disableMouse) {
                h(this.wrapper, "mousedown", this);
                h(j, "mousemove", this);
                h(j, "mousecancel", this);
                h(j, "mouseup", this)
            }
            if (b.hasPointer && !this.options.disablePointer) {
                h(this.wrapper, b.prefixPointerEvent("pointerdown"), this);
                h(j, b.prefixPointerEvent("pointermove"), this);
                h(j, b.prefixPointerEvent("pointercancel"), this);
                h(j, b.prefixPointerEvent("pointerup"), this)
            }
            if (b.hasTouch && !this.options.disableTouch) {
                h(this.wrapper, "touchstart", this);
                h(j, "touchmove", this);
                h(j, "touchcancel", this);
                h(j, "touchend", this)
            }
            h(this.scroller, "transitionend", this);
            h(this.scroller, "webkitTransitionEnd", this);
            h(this.scroller, "oTransitionEnd", this);
            h(this.scroller, "MSTransitionEnd", this)
        },
        getComputedPosition: function() {
            var h = d.getComputedStyle(this.scroller, null),
                g, j;
            if (this.options.useTransform) {
                h = h[b.style.transform].split(")")[0].split(", ");
                g = +(h[12] || h[4]);
                j = +(h[13] || h[5])
            } else {
                g = +h.left.replace(/[^-\d.]/g, "");
                j = +h.top.replace(/[^-\d.]/g, "")
            }
            return {
                x: g,
                y: j
            }
        },
        _initWheel: function() {
            b.addEvent(this.wrapper, "wheel", this);
            b.addEvent(this.wrapper, "mousewheel", this);
            b.addEvent(this.wrapper, "DOMMouseScroll", this);
            this.on("destroy", function() {
                clearTimeout(this.wheelTimeout);
                this.wheelTimeout = null;
                b.removeEvent(this.wrapper, "wheel", this);
                b.removeEvent(this.wrapper, "mousewheel", this);
                b.removeEvent(this.wrapper, "DOMMouseScroll", this)
            })
        },
        _wheel: function(l) {
            if (!this.enabled) {
                return
            }
            l.preventDefault();
            var j, h, m, k, g = this;
            if (this.wheelTimeout === undefined) {
                g._execEvent("scrollStart")
            }
            clearTimeout(this.wheelTimeout);
            this.wheelTimeout = setTimeout(function() {
                if (!g.options.snap) {
                    g._execEvent("scrollEnd")
                }
                g.wheelTimeout = undefined
            }, 400);
            if ("deltaX" in l) {
                if (l.deltaMode === 1) {
                    j = -l.deltaX * this.options.mouseWheelSpeed;
                    h = -l.deltaY * this.options.mouseWheelSpeed
                } else {
                    j = -l.deltaX;
                    h = -l.deltaY
                }
            } else {
                if ("wheelDeltaX" in l) {
                    j = l.wheelDeltaX / 120 * this.options.mouseWheelSpeed;
                    h = l.wheelDeltaY / 120 * this.options.mouseWheelSpeed
                } else {
                    if ("wheelDelta" in l) {
                        j = h = l.wheelDelta / 120 * this.options.mouseWheelSpeed
                    } else {
                        if ("detail" in l) {
                            j = h = -l.detail / 3 * this.options.mouseWheelSpeed
                        } else {
                            return
                        }
                    }
                }
            }
            j *= this.options.invertWheelDirection;
            h *= this.options.invertWheelDirection;
            if (!this.hasVerticalScroll) {
                j = h;
                h = 0
            }
            if (this.options.snap) {
                m = this.currentPage.pageX;
                k = this.currentPage.pageY;
                if (j > 0) {
                    m--
                } else {
                    if (j < 0) {
                        m++
                    }
                }
                if (h > 0) {
                    k--
                } else {
                    if (h < 0) {
                        k++
                    }
                }
                this.goToPage(m, k);
                return
            }
            m = this.x + c.round(this.hasHorizontalScroll ? j : 0);
            k = this.y + c.round(this.hasVerticalScroll ? h : 0);
            this.directionX = j > 0 ? -1 : j < 0 ? 1 : 0;
            this.directionY = h > 0 ? -1 : h < 0 ? 1 : 0;
            if (m > 0) {
                m = 0
            } else {
                if (m < this.maxScrollX) {
                    m = this.maxScrollX
                }
            }
            if (k > 0) {
                k = 0
            } else {
                if (k < this.maxScrollY) {
                    k = this.maxScrollY
                }
            }
            this.scrollTo(m, k, 0);
            if (this.options.probeType > 1) {
                this._execEvent("scroll")
            }
        },
        _initSnap: function() {
            this.currentPage = {};
            if (typeof this.options.snap === "string") {
                this.options.snap = this.scroller.querySelectorAll(this.options.snap)
            }
            this.on("refresh", function() {
                var q = 0,
                    o, j = 0,
                    h, p, k, t = 0,
                    s, v = this.options.snapStepX || this.wrapperWidth,
                    u = this.options.snapStepY || this.wrapperHeight,
                    g, r;
                this.pages = [];
                if (!this.wrapperWidth || !this.wrapperHeight || !this.scrollerWidth || !this.scrollerHeight) {
                    return
                }
                if (this.options.snap === true) {
                    p = c.round(v / 2);
                    k = c.round(u / 2);
                    while (t > -this.scrollerWidth) {
                        this.pages[q] = [];
                        o = 0;
                        s = 0;
                        while (s > -this.scrollerHeight) {
                            this.pages[q][o] = {
                                x: c.max(t, this.maxScrollX),
                                y: c.max(s, this.maxScrollY),
                                width: v,
                                height: u,
                                cx: t - p,
                                cy: s - k
                            };
                            s -= u;
                            o++
                        }
                        t -= v;
                        q++
                    }
                } else {
                    g = this.options.snap;
                    o = g.length;
                    h = -1;
                    for (; q < o; q++) {
                        r = b.getRect(g[q]);
                        if (q === 0 || r.left <= b.getRect(g[q - 1]).left) {
                            j = 0;
                            h++
                        }
                        if (!this.pages[j]) {
                            this.pages[j] = []
                        }
                        t = c.max(-r.left, this.maxScrollX);
                        s = c.max(-r.top, this.maxScrollY);
                        p = t - c.round(r.width / 2);
                        k = s - c.round(r.height / 2);
                        this.pages[j][h] = {
                            x: t,
                            y: s,
                            width: r.width,
                            height: r.height,
                            cx: p,
                            cy: k
                        };
                        if (t > this.maxScrollX) {
                            j++
                        }
                    }
                }
                this.goToPage(this.currentPage.pageX || 0, this.currentPage.pageY || 0, 0);
                if (this.options.snapThreshold % 1 === 0) {
                    this.snapThresholdX = this.options.snapThreshold;
                    this.snapThresholdY = this.options.snapThreshold
                } else {
                    this.snapThresholdX = c.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width * this.options.snapThreshold);
                    this.snapThresholdY = c.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height * this.options.snapThreshold)
                }
            });
            this.on("flick", function() {
                var g = this.options.snapSpeed || c.max(c.max(c.min(c.abs(this.x - this.startX), 1000), c.min(c.abs(this.y - this.startY), 1000)), 300);
                this.goToPage(this.currentPage.pageX + this.directionX, this.currentPage.pageY + this.directionY, g)
            })
        },
        _nearestSnap: function(h, n) {
            if (!this.pages.length) {
                return {
                    x: 0,
                    y: 0,
                    pageX: 0,
                    pageY: 0
                }
            }
            var k = 0,
                j = this.pages.length,
                g = 0;
            if (c.abs(h - this.absStartX) < this.snapThresholdX && c.abs(n - this.absStartY) < this.snapThresholdY) {
                return this.currentPage
            }
            if (h > 0) {
                h = 0
            } else {
                if (h < this.maxScrollX) {
                    h = this.maxScrollX
                }
            }
            if (n > 0) {
                n = 0
            } else {
                if (n < this.maxScrollY) {
                    n = this.maxScrollY
                }
            }
            for (; k < j; k++) {
                if (h >= this.pages[k][0].cx) {
                    h = this.pages[k][0].x;
                    break
                }
            }
            j = this.pages[k].length;
            for (; g < j; g++) {
                if (n >= this.pages[0][g].cy) {
                    n = this.pages[0][g].y;
                    break
                }
            }
            if (k == this.currentPage.pageX) {
                k += this.directionX;
                if (k < 0) {
                    k = 0
                } else {
                    if (k >= this.pages.length) {
                        k = this.pages.length - 1
                    }
                }
                h = this.pages[k][0].x
            }
            if (g == this.currentPage.pageY) {
                g += this.directionY;
                if (g < 0) {
                    g = 0
                } else {
                    if (g >= this.pages[0].length) {
                        g = this.pages[0].length - 1
                    }
                }
                n = this.pages[0][g].y
            }
            return {
                x: h,
                y: n,
                pageX: k,
                pageY: g
            }
        },
        goToPage: function(g, m, h, l) {
            l = l || this.options.bounceEasing;
            if (g >= this.pages.length) {
                g = this.pages.length - 1
            } else {
                if (g < 0) {
                    g = 0
                }
            }
            if (m >= this.pages[g].length) {
                m = this.pages[g].length - 1
            } else {
                if (m < 0) {
                    m = 0
                }
            }
            var k = this.pages[g][m].x,
                j = this.pages[g][m].y;
            h = h === undefined ? this.options.snapSpeed || c.max(c.max(c.min(c.abs(k - this.x), 1000), c.min(c.abs(j - this.y), 1000)), 300) : h;
            this.currentPage = {
                x: k,
                y: j,
                pageX: g,
                pageY: m
            };
            this.scrollTo(k, j, h, l)
        },
        next: function(h, k) {
            var g = this.currentPage.pageX,
                j = this.currentPage.pageY;
            g++;
            if (g >= this.pages.length && this.hasVerticalScroll) {
                g = 0;
                j++
            }
            this.goToPage(g, j, h, k)
        },
        prev: function(h, k) {
            var g = this.currentPage.pageX,
                j = this.currentPage.pageY;
            g--;
            if (g < 0 && this.hasVerticalScroll) {
                g = 0;
                j--
            }
            this.goToPage(g, j, h, k)
        },
        _initKeys: function(j) {
            var h = {
                pageUp: 33,
                pageDown: 34,
                end: 35,
                home: 36,
                left: 37,
                up: 38,
                right: 39,
                down: 40
            };
            var g;
            if (typeof this.options.keyBindings === "object") {
                for (g in this.options.keyBindings) {
                    if (typeof this.options.keyBindings[g] === "string") {
                        this.options.keyBindings[g] = this.options.keyBindings[g].toUpperCase().charCodeAt(0)
                    }
                }
            } else {
                this.options.keyBindings = {}
            }
            for (g in h) {
                this.options.keyBindings[g] = this.options.keyBindings[g] || h[g]
            }
            b.addEvent(d, "keydown", this);
            this.on("destroy", function() {
                b.removeEvent(d, "keydown", this)
            })
        },
        _key: function(m) {
            if (!this.enabled) {
                return
            }
            var g = this.options.snap,
                n = g ? this.currentPage.pageX : this.x,
                l = g ? this.currentPage.pageY : this.y,
                j = b.getTime(),
                h = this.keyTime || 0,
                k = 0.25,
                o;
            if (this.options.useTransition && this.isInTransition) {
                o = this.getComputedPosition();
                this._translate(c.round(o.x), c.round(o.y));
                this.isInTransition = false
            }
            this.keyAcceleration = j - h < 200 ? c.min(this.keyAcceleration + k, 50) : 0;
            switch (m.keyCode) {
                case this.options.keyBindings.pageUp:
                    if (this.hasHorizontalScroll && !this.hasVerticalScroll) {
                        n += g ? 1 : this.wrapperWidth
                    } else {
                        l += g ? 1 : this.wrapperHeight
                    }
                    break;
                case this.options.keyBindings.pageDown:
                    if (this.hasHorizontalScroll && !this.hasVerticalScroll) {
                        n -= g ? 1 : this.wrapperWidth
                    } else {
                        l -= g ? 1 : this.wrapperHeight
                    }
                    break;
                case this.options.keyBindings.end:
                    n = g ? this.pages.length - 1 : this.maxScrollX;
                    l = g ? this.pages[0].length - 1 : this.maxScrollY;
                    break;
                case this.options.keyBindings.home:
                    n = 0;
                    l = 0;
                    break;
                case this.options.keyBindings.left:
                    n += g ? -1 : 5 + this.keyAcceleration >> 0;
                    break;
                case this.options.keyBindings.up:
                    l += g ? 1 : 5 + this.keyAcceleration >> 0;
                    break;
                case this.options.keyBindings.right:
                    n -= g ? -1 : 5 + this.keyAcceleration >> 0;
                    break;
                case this.options.keyBindings.down:
                    l -= g ? 1 : 5 + this.keyAcceleration >> 0;
                    break;
                default:
                    return
            }
            if (g) {
                this.goToPage(n, l);
                return
            }
            if (n > 0) {
                n = 0;
                this.keyAcceleration = 0
            } else {
                if (n < this.maxScrollX) {
                    n = this.maxScrollX;
                    this.keyAcceleration = 0
                }
            }
            if (l > 0) {
                l = 0;
                this.keyAcceleration = 0
            } else {
                if (l < this.maxScrollY) {
                    l = this.maxScrollY;
                    this.keyAcceleration = 0
                }
            }
            this.scrollTo(n, l, 0);
            this.keyTime = j
        },
        _animate: function(q, p, k, g) {
            var n = this,
                m = this.x,
                l = this.y,
                h = b.getTime(),
                o = h + k;

            function j() {
                var r = b.getTime(),
                    t, s, u;
                if (r >= o) {
                    n.isAnimating = false;
                    n._translate(q, p);
                    if (!n.resetPosition(n.options.bounceTime)) {
                        n._execEvent("scrollEnd")
                    }
                    return
                }
                r = (r - h) / k;
                u = g(r);
                t = (q - m) * u + m;
                s = (p - l) * u + l;
                n._translate(t, s);
                if (n.isAnimating) {
                    f(j)
                }
                if (n.options.probeType == 3) {
                    n._execEvent("scroll")
                }
            }
            this.isAnimating = true;
            j()
        },
        _initInfinite: function() {
            var g = this.options.infiniteElements;
            this.infiniteElements = typeof g === "string" ? a.querySelectorAll(g) : g;
            this.infiniteLength = this.infiniteElements.length;
            this.infiniteMaster = this.infiniteElements[0];
            this.infiniteElementHeight = b.getRect(this.infiniteMaster).height;
            this.infiniteHeight = this.infiniteLength * this.infiniteElementHeight;
            this.options.cacheSize = this.options.cacheSize || 1000;
            this.infiniteCacheBuffer = c.round(this.options.cacheSize / 4);
            this.options.dataset.call(this, 0, this.options.cacheSize);
            this.on("refresh", function() {
                var h = c.ceil(this.wrapperHeight / this.infiniteElementHeight);
                this.infiniteUpperBufferSize = c.floor((this.infiniteLength - h) / 2);
                this.reorderInfinite()
            });
            this.on("scroll", this.reorderInfinite)
        },
        reorderInfinite: function() {
            var g = -this.y + this.wrapperHeight / 2;
            var n = c.max(c.floor(-this.y / this.infiniteElementHeight) - this.infiniteUpperBufferSize, 0),
                l = c.floor(n / this.infiniteLength),
                h = n - l * this.infiniteLength;
            var m = 0;
            var k = 0;
            var o = [];
            var j = c.floor(n / this.infiniteCacheBuffer);
            while (k < this.infiniteLength) {
                m = k * this.infiniteElementHeight + l * this.infiniteHeight;
                if (h > k) {
                    m += this.infiniteElementHeight * this.infiniteLength
                }
                if (this.infiniteElements[k]._top !== m) {
                    this.infiniteElements[k]._phase = m / this.infiniteElementHeight;
                    if (this.infiniteElements[k]._phase < this.options.infiniteLimit) {
                        this.infiniteElements[k]._top = m;
                        if (this.options.infiniteUseTransform) {
                            this.infiniteElements[k].style[b.style.transform] = "translate(0, " + m + "px)" + this.translateZ
                        } else {
                            this.infiniteElements[k].style.top = m + "px"
                        }
                        o.push(this.infiniteElements[k])
                    }
                }
                k++
            }
            if (this.cachePhase != j && (j === 0 || n - this.infiniteCacheBuffer > 0)) {
                this.options.dataset.call(this, c.max(j * this.infiniteCacheBuffer - this.infiniteCacheBuffer, 0), this.options.cacheSize)
            }
            this.cachePhase = j;
            this.updateContent(o)
        },
        updateContent: function(j) {
            if (this.infiniteCache === undefined) {
                return
            }
            for (var h = 0, g = j.length; h < g; h++) {
                this.options.dataFiller.call(this, j[h], this.infiniteCache[j[h]._phase])
            }
        },
        updateCache: function(m, j) {
            var k = this.infiniteCache === undefined;
            this.infiniteCache = {};
            for (var h = 0, g = j.length; h < g; h++) {
                this.infiniteCache[m++] = j[h]
            }
            if (k) {
                this.updateContent(this.infiniteElements)
            }
        },
        handleEvent: function(g) {
            switch (g.type) {
                case "touchstart":
                case "pointerdown":
                case "MSPointerDown":
                case "mousedown":
                    this._start(g);
                    break;
                case "touchmove":
                case "pointermove":
                case "MSPointerMove":
                case "mousemove":
                    this._move(g);
                    break;
                case "touchend":
                case "pointerup":
                case "MSPointerUp":
                case "mouseup":
                case "touchcancel":
                case "pointercancel":
                case "MSPointerCancel":
                case "mousecancel":
                    this._end(g);
                    break;
                case "orientationchange":
                case "resize":
                    this._resize();
                    break;
                case "transitionend":
                case "webkitTransitionEnd":
                case "oTransitionEnd":
                case "MSTransitionEnd":
                    this._transitionEnd(g);
                    break;
                case "wheel":
                case "DOMMouseScroll":
                case "mousewheel":
                    this._wheel(g);
                    break;
                case "keydown":
                    this._key(g);
                    break;
                case "click":
                    if (this.enabled && !g._constructed) {
                        g.preventDefault();
                        g.stopPropagation()
                    }
                    break
            }
        }
    };
    e.utils = b;
    if (typeof module !== "undefined" && module.exports) {
        module.exports = e
    } else {
        if (typeof define === "function" && define.amd) {
            define(function() {
                return e
            })
        } else {
            d.IScroll = e
        }
    }
})(window, document, Math);
