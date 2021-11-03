
(function(j, l, f) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            401: function(){
                alert("로그아웃상태이므로 요청을 수락할수 없습니다.")
                // Redirec the to the login page.
            }
        }
    });
    var b = Object.prototype.toString.call(j.operamini) == "[object OperaMini]";
    var a = "placeholder" in l.createElement("input") && !b;
    var g = "placeholder" in l.createElement("textarea") && !b;
    var m = f.fn;
    var e = f.valHooks;
    var c = f.propHooks;
    var o;
    var n;
    if (a && g) {
        n = m.placeholder = function() {
            return this
        };
        n.input = n.textarea = true
    } else {
        n = m.placeholder = function() {
            var q = this;
            q.filter((a ? "textarea" : ":input") + "[placeholder]").not(".placeholder").bind({
                "focus.placeholder": d,
                "blur.placeholder": h
            }).data("placeholder-enabled", true).trigger("blur.placeholder");
            return q
        };
        n.input = a;
        n.textarea = g;
        o = {
            get: function(r) {
                var q = f(r);
                var s = q.data("placeholder-password");
                if (s) {
                    return s[0].value
                }
                return q.data("placeholder-enabled") && q.hasClass("placeholder") ? "" : r.value
            },
            set: function(r, t) {
                var q = f(r);
                var s = q.data("placeholder-password");
                if (s) {
                    return s[0].value = t
                }
                if (!q.data("placeholder-enabled")) {
                    return r.value = t
                }
                if (t == "") {
                    r.value = t;
                    if (r != p()) {
                        h.call(r)
                    }
                } else {
                    if (q.hasClass("placeholder")) {
                        d.call(r, true, t) || (r.value = t)
                    } else {
                        r.value = t
                    }
                }
                return q
            }
        };
        if (!a) {
            e.input = o;
            c.value = o
        }
        if (!g) {
            e.textarea = o;
            c.value = o
        }
        f(function() {
            f(l).delegate("form", "submit.placeholder", function() {
                var q = f(".placeholder", this).each(d);
                setTimeout(function() {
                    q.each(h)
                }, 10)
            })
        });
        f(j).bind("beforeunload.placeholder", function() {
            f(".placeholder").each(function() {
                this.value = ""
            })
        })
    }

    function k(r) {
        var q = {};
        var s = /^jQuery\d+$/;
        f.each(r.attributes, function(u, t) {
            if (t.specified && !s.test(t.name)) {
                q[t.name] = t.value
            }
        });
        return q
    }

    function d(r, s) {
        var q = this;
        var t = f(q);
        if (q.value == t.attr("placeholder") && t.hasClass("placeholder")) {
            if (t.data("placeholder-password")) {
                t = t.hide().next().show().attr("id", t.removeAttr("id").data("placeholder-id"));
                if (r === true) {
                    return t[0].value = s
                }
                t.focus()
            } else {
                q.value = "";
                t.removeClass("placeholder");
                q == p() && q.select()
            }
        }
    }

    function h() {
        var u;
        var q = this;
        var t = f(q);
        var s = this.id;
        if (q.value == "") {
            if (q.type == "password") {
                if (!t.data("placeholder-textinput")) {
                    try {
                        u = t.clone().attr({
                            type: "text"
                        })
                    } catch (r) {
                        u = f("<input>").attr(f.extend(k(this), {
                            type: "text"
                        }))
                    }
                    u.removeAttr("name").data({
                        "placeholder-password": t,
                        "placeholder-id": s
                    }).bind("focus.placeholder", d);
                    t.data({
                        "placeholder-textinput": u,
                        "placeholder-id": s
                    }).before(u)
                }
                t = t.removeAttr("id").hide().prev().attr("id", s).show()
            }
            t.addClass("placeholder");
            t[0].value = t.attr("placeholder")
        } else {
            t.removeClass("placeholder")
        }
    }

    function p() {
        try {
            return l.activeElement
        } catch (q) {}
    }
}(this, document, jQuery));
(function() {
    var a = function(d) {
        return new RegExp("(^| )" + d + "( |$)")
    };
    var c = function(g, f, e) {
        for (var d = 0; d < g.length; d++) {
            f.call(e, g[d])
        }
    };

    function b(d) {
        this.element = d
    }
    b.prototype = {
        add: function() {
            c(arguments, function(d) {
                if (!this.contains(d)) {
                    this.element.className += this.element.className.length > 0 ? " " + d : d
                }
            }, this)
        },
        remove: function() {
            c(arguments, function(d) {
                this.element.className = this.element.className.replace(d, "")
            }, this)
        },
        toggle: function(d) {
            return this.contains(d) ? (this.remove(d), false) : (this.add(d), true)
        },
        contains: function(d) {
            return a(d).test(this.element.className)
        },
        replace: function(e, d) {
            this.remove(e), this.add(d)
        }
    };
    if (!("classList" in Element.prototype)) {
        Object.defineProperty(Element.prototype, "classList", {
            get: function() {
                return new b(this)
            }
        })
    }
    if (window.DOMTokenList && DOMTokenList.prototype.replace === null) {
        DOMTokenList.prototype.replace = b.prototype.replace
    }
    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector
    }
    if (!Element.prototype.closest) {
        Element.prototype.closest = function(e) {
            var d = this;
            if (!document.documentElement.contains(d)) {
                return null
            }
            do {
                if (d.matches(e)) {
                    return d
                }
                d = d.parentElement || d.parentNode
            } while (d !== null && d.nodeType === 1);
            return null
        }
    }
})();
(function() {
    var a = function(f, g) {
        var n = f[0].parentNode;
        n.filestyle = this;
        n.filestyle.opts = g || {};
        var l = f.length;
        var c = n.filestyle.opts;
        for (var k = 0; k < l; k++) {
            var e = document.createElement("div");
            e.className = "g_screenshot";
            n.appendChild(e);
            n.insertBefore(e, f[k]);
            var j = document.createElement("input");
            j.type = "text";
            j.className = "g_text";
            j.readOnly = true;
            e.appendChild(j);
            var b = document.createElement("div");
            b.className = "tmp_file";
            e.appendChild(b);
            var d = document.createElement("span");
            d.className = "tmp_btn";
            d.innerHTML = "찾아보기";
            b.appendChild(d);
            b.appendChild(f[k]);
            if (c.btn === true) {
                var m = document.createElement("div");
                m.className = "ad_btn";
                e.appendChild(m);
                var p = document.createElement("a");
                p.href = "javascript:;";
                p.className = "screen_del";
                m.appendChild(p);
                var h = document.createElement("a");
                h.href = "javascript:;";
                h.className = "screen_add";
                m.appendChild(h)
            }
        }
        if (c.btn === true) {
            document.addEventListener("change", function(s) {
                if (s.target.name === f[0].name) {
                    var o = s.target.parentNode;
                    while (o.classList.contains("g_screenshot") === false) {
                        o = o.parentNode
                    }
                    if (s.target.files === undefined) {
                        o.querySelector('[type="text"]').value = s.target.value
                    } else {
                        var r = s.target.files[0];
                        if (r) {
                            var q = r.type.toLowerCase();
                            if (q.indexOf("jpg") === -1 && q.indexOf("jpeg") === -1) {
                                alert("JPG 파일만 첨부 가능합니다.");
                                s.target.value = "";
                                o.querySelector('[type="text"]').value = s.target.value;
                                return
                            }
                            if (r.size > 300000) {
                                alert("300kb 이하의 이미지만 등록할 수 있습니다.");
                                s.target.value = "";
                                o.querySelector('[type="text"]').value = s.target.value;
                                return
                            }
                            o.querySelector('[type="text"]').value = s.target.value
                        }
                    }
                }
            });
            document.addEventListener("click", function(u) {
                if (u.target.className === "screen_del") {
                    var s = n.querySelectorAll(".g_screenshot");
                    if (s.length < 1) {
                        return
                    }
                    var q = u.target.parentNode;
                    while (q.classList.contains("g_screenshot") === false) {
                        q = q.parentNode
                    }
                    if (s.length == 1) {
                        q.querySelector('[type="text"]').value = "";
                        q.querySelector('[type="file"]').value = "";
                        return
                    }
                    var o = Array.prototype.indexOf.call(s, q);
                    var t = n.querySelector(".screen_add").cloneNode(true);
                    n.removeChild(s[o]);
                    if (o === 0) {
                        n.querySelectorAll(".ad_btn")[0].appendChild(t)
                    }
                }
                if (u.target.className === "screen_add") {
                    var w = c.remain || 0;
                    if (w + n.querySelectorAll(".g_screenshot").length >= c.limit) {
                        alert("최대 " + c.limit + "개 까지 등록 가능합니다.");
                        return
                    }
                    var v = e.cloneNode(true);
                    v.querySelector('[type="text"]').value = "";
                    n.appendChild(v);
                    var r = v.querySelector(".screen_add");
                    r.parentNode.removeChild(r)
                }
            })
        }
    };
    window.FileStyle = a
})(jQuery);
(function() {
    var a = function(d, e) {
        var p = d[0].parentElement;
        while (p.classList.contains("screenshot_wrap") === false) {
            p = p.parentNode
        }
        p.filestyle = this;
        p.filestyle.opts = e || {};
        p.classList.add("screenshot_wrap2");
        var b = p.filestyle.opts;
        var m = b.count || 10;
        if (m > 5) {
            var s = document.createElement("div");
            s.className = "view_info";
            if (d.length > 5) {
                p.classList.add("on");
                s.innerHTML = "닫기 ▲"
            } else {
                s.innerHTML = "스샷추가 등록 ▼"
            }
            p.parentElement.appendChild(s);
            s.addEventListener("click", function() {
                if (p.classList.contains("on") === true) {
                    p.classList.remove("on");
                    this.innerHTML = "스샷추가 등록 ▼"
                } else {
                    p.classList.add("on");
                    this.innerHTML = "닫기 ▲"
                }
            })
        }
        for (var k = 0; k < m; k++) {
            var g = d[k];
            if (g === undefined) {
                g = d[0].cloneNode();
                g.removeAttribute("data-seq");
                g.removeAttribute("data-img");
                p.appendChild(g)
            }
            if (g.parentElement.classList.contains("g_screenshot2") === true) {
                var c = g.parentElement
            } else {
                var c = document.createElement("div");
                c.className = "g_screenshot2";
                p.appendChild(c);
                p.insertBefore(c, g)
            }
            var r = document.createElement("a");
            r.href = "javascript:;";
            r.className = "screen_del";
            c.appendChild(r);
            var f = document.createElement("div");
            f.className = "tmp_file";
            c.appendChild(g);
            c.appendChild(f);
            var l = document.createElement("span");
            var n = document.createElement("span");
            l.className = "tmp_file_info";
            n.className = "tmp_file_ext";
            f.appendChild(l);
            f.appendChild(n);
            var h = g.getAttribute("data-img");
            if (h !== null) {
                c.classList.add("active");
                var q = h.split("/");
                q = q[q.length - 1].split(".");
                var j = q[0];
                var t = "." + q[1];
                l.innerHTML = j;
                n.innerHTML = t
            } else {
                r.style.display = "none"
            }
            f.addEventListener("click", function(o) {
                if (o.target.className !== "screen_del") {
                    this.previousElementSibling.click()
                }
            })
        }
        document.addEventListener("change", function(y) {
            if (y.target.name === d[0].name) {
                if (y.target.value !== "") {
                    var o = y.target.parentNode;
                    while (o.classList.contains("g_screenshot2") === false) {
                        o = o.parentNode
                    }
                    var A = y.target.getAttribute("data-seq");
                    if (A !== null) {
                        var B = document.createElement("input");
                        B.type = "hidden";
                        B.name = "screen_del[]";
                        B.value = A;
                        o.appendChild(B);
                        y.target.removeAttribute("data-img");
                        y.target.removeAttribute("data-seq")
                    }
                    var C = y.target.nextElementSibling;
                    var v = C.getElementsByClassName("tmp_file_info")[0];
                    var z = C.getElementsByClassName("tmp_file_ext")[0];
                    var D = y.target.value.split("\\");
                    D = D[D.length - 1].split(".");
                    var u = D[0];
                    var E = "." + D[1];
                    if (y.target.files !== undefined) {
                        var x = y.target.files[0];
                        if (x) {
                            var w = x.type.toLowerCase();
                            if (w.indexOf("jpg") === -1 && w.indexOf("jpeg") === -1) {
                                alert("JPG 파일만 첨부 가능합니다.");
                                y.target.value = "";
                                v.innerHTML = "";
                                z.innerHTML = "";
                                o.classList.remove("active");
                                return
                            }
                            if (x.size > 300000) {
                                alert("300kb 이하의 이미지만 등록할 수 있습니다.");
                                y.target.value = "";
                                v.innerHTML = "";
                                z.innerHTML = "";
                                o.classList.remove("active");
                                return
                            }
                        }
                    }
                    v.innerHTML = u;
                    z.innerHTML = E;
                    o.getElementsByClassName("screen_del")[0].style.display = "block";
                    o.classList.add("active")
                }
            }
        });
        document.addEventListener("click", function(y) {
            if (y.target.className === "screen_del") {
                var u = y.target.parentElement;
                while (u.classList.contains("g_screenshot2") === false) {
                    u = u.parentElement
                }
                var o = u.querySelector('[type="file"]');
                var B = o.getAttribute("data-seq");
                if (B !== null) {
                    var C = document.createElement("input");
                    C.type = "hidden";
                    C.name = "screen_del[]";
                    C.value = B;
                    u.appendChild(C);
                    o.removeAttribute("data-seq");
                    o.removeAttribute("data-img")
                }
                var D = u.getElementsByClassName("tmp_file")[0];
                var x = D.getElementsByClassName("tmp_file_info")[0];
                var A = D.getElementsByClassName("tmp_file_ext")[0];
                u.getElementsByClassName("screen_del")[0].style.display = "none";
                x.innerHTML = "";
                A.innerHTML = "";
                o.value = "";
                u.classList.remove("active")
            }
            if (y.target.className === "screen_add") {
                var w = b.remain || 0;
                if (w + p.querySelectorAll(".g_screenshot").length >= b.limit) {
                    alert("최대 " + b.limit + "개 까지 등록 가능합니다.");
                    return
                }
                var z = c.cloneNode(true);
                z.querySelector('[type="text"]').value = "";
                p.appendChild(z);
                var v = z.querySelector(".screen_add");
                v.parentNode.removeChild(v)
            }
        })
    };
    window.FileStyleVer2 = a
})();
var _DEBUG = false;
var _ENABLE = function() {
    return true
};
var _DISABLE = function() {
    return false
};
var ROOT_DOMAIN = "http://" + location.host;
var SSL_DOMAIN = "https://" + location.host;
var IMG_DOMAIN1 = "//img1.itemmania.com";
var IMG_DOMAIN2 = "//img2.itemmania.com";
var IMG_DOMAIN3 = "//img3.itemmania.com";
var IMG_DOMAIN4 = "//img4.itemmania.com";
var getBrowserData = function() {
    var a = window.navigator || navigator;
    var e = {};
    var b = e.uaString = a.userAgent;
    var c = b.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
    if (c[1]) {
        c[1] = c[1].toLowerCase()
    }
    var g = c[1] === "chrome";
    if (g) {
        g = b.match(/\bOPR\/([\d\.]+)/)
    }
    if (/trident/i.test(c[1])) {
        var h = /\brv[ :]+([\d\.]+)/g.exec(b) || [];
        e.name = "msie";
        e.version = h[1]
    } else {
        if (g) {
            e.name = "opera";
            e.version = g[1]
        } else {
            if (c[1] === "safari") {
                var j = b.match(/version\/([\d\.]+)/i);
                e.name = "safari";
                e.version = j[1]
            } else {
                e.name = c[1];
                e.version = c[2]
            }
        }
    }
    var k = [];
    if (e.version) {
        var f = e.version.match(/(\d+)/g) || [];
        for (var d = 0; d < f.length; d++) {
            k.push(f[d])
        }
        if (k.length > 0) {
            e.majorVersion = k[0]
        }
    }
    e.name = e.name || "(unknown browser name)";
    e.version = {
        full: e.version || "(unknown full browser version)",
        parts: k,
        major: k.length > 0 ? k[0] : "(unknown major browser version)"
    };
    return e
};
var _BROWSER = getBrowserData();
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
        return (((a.which) && (a.which === 1)) || ((a.button) && (a.button === 1)))
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
        return (this === null || this.trim() === "") ? true : false
    },
    isHangul: function() {
        var d = 0,
            a = "";
        var c = this.length;
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
        if (b.length === 8) {
            var c = Number(b.substring(0, 4));
            var e = Number(b.substring(4, 6));
            var a = Number(b.substring(6, 8))
        } else {
            if (b.length === 6) {
                var c = Number("19" + b.substring(0, 2));
                var e = Number(b.substring(2, 4));
                var a = Number(b.substring(4, 6))
            } else {
                return false
            }
        }
        var d = new Array(31, ((((c % 4 === 0) && (c % 100 !== 0)) || (c % 400 === 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        if (e < 1 || e > 12) {
            return false
        }
        if (a < 1 || a > d[e - 1]) {
            return false
        }
        return true
    },
    getWidth: function() {
        var k, b = this.length;
        var c, g, j = 0,
            e = 0;
        var d = 6,
            l = 12,
            h = 32,
            f = 127;
        var a = Array(4, 4, 4, 6, 6, 10, 8, 4, 5, 5, 6, 6, 4, 6, 4, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 4, 4, 8, 6, 8, 6, 12, 8, 8, 9, 8, 8, 7, 9, 8, 3, 6, 8, 7, 11, 9, 9, 8, 9, 8, 8, 8, 8, 8, 10, 8, 8, 8, 6, 11, 6, 6, 6, 4, 7, 7, 7, 7, 7, 3, 7, 7, 3, 3, 6, 3, 11, 7, 7, 7, 7, 4, 7, 3, 7, 6, 10, 7, 7, 7, 6, 6, 6, 9, 6);
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
        if (this.isEmpty()) {
            return 0
        }
        var d = 0;
        var b = new String(this);
        var c = b.length;
        for (var a = 0; a < c; a++) {
            d += (escape(b.charAt(a)).length > 4) ? 2 : 1
        }
        return d
    },
    subbyte: function(a) {
        if (this.isEmpty()) {
            return ""
        }
        var f = 0;
        var b = 0;
        var d = new String(this);
        var e = d.length;
        for (var c = 0; c < e; c++) {
            b = (escape(d.charAt(c)).length > 4) ? 2 : 1;
            if ((f + b) > a) {
                return this.substring(0, c)
            }
            f += b
        }
        return this
    },
    toQueryParams: function(b) {
        var a = this.trim().match(/([^?#]*)(#.*)?$/);
        if (!a) {
            return {}
        }
        return a[1].split(b || "&").inject({}, function(e, f) {
            if ((f = f.split("="))[0]) {
                var c = decodeURIComponent(f.shift());
                var d = f.length > 1 ? f.join("=") : f[0];
                if (d !== undefined) {
                    d = decodeURIComponent(d)
                }
                if (c in e) {
                    if (!$.isArray(e[c])) {
                        e[c] = [e[c]]
                    }
                    e[c].push(d)
                } else {
                    e[c] = d
                }
            }
            return e
        })
    },
    currency: function(c) {
        number = String(this).trim();
        c = (c) ? c : 3;
        var b = "";
        var e = number.length,
            d = (e % c),
            a = (e - c + 1);
        d = (d === 0) ? c : d;
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
        return Number(this.replace(/[^0-9]/g, ""), 10)
    },
    koreanToNumber: function() {
        var a = 1;
        switch (String(this)) {
            case "만":
                a = 10000;
                break;
            case "억":
                a = 100000000;
                break;
            case "조":
                a = 1000000000000;
                break
        }
        return a
    }
});
$.extend(Array.prototype, {
    inject: function(a, d, c) {
        for (var b = 0; b < this.length; b++) {
            a = d(a, this[b], b)
        }
        return a
    }
});
$.extend(Date.prototype, {
    getDayName: function(a) {
        var c = new Array("일", "월", "화", "수", "목", "금", "토");
        var b = (arguments.length === 1) ? a : this.getDay();
        return c[b]
    },
    getTotalDay: function() {
        var a = this.getFullYear();
        var b = new Array(31, ((((a % 4 === 0) && (a % 100 !== 0)) || (a % 400 === 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        return b[this.getMonth()]
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
        d = (d === 0) ? c : d;
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
        var j = new Array("", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구");
        var g = new Array("", "십", "백", "천");
        var b = new Array("", "만", "억", "조", "경", "해", "자", "양", "구", "간", "정재극");
        var d = String(this).trim();
        var c = Math.floor(d.length / 4);
        var f = (d.length % 4) - 1;
        var e = 0,
            a = 0;
        var h = "";
        for (; c >= 0; c--) {
            for (; f >= 0; f--) {
                a = Number(d.charAt(e));
                h += (a === 1 && f !== 0) ? "" : j[a];
                h += (a === 0) ? "" : g[f];
                e++
            }
            f = 3;
            h += (a === 0 && Number(d.substring(e - 4, e)) === 0) ? "" : b[c] + " "
        }
        if (h.substring(h.length - 1, h.length) === " ") {
            h = h.substring(0, h.length - 1)
        }
        return h
    }
});
$.extend(Function.prototype, {
    delay: function() {
        var a = this,
            c = arguments[0],
            b = arguments[1] || this;
        return window.setTimeout(function() {
            return a.call(b)
        }, c)
    }
});
var _http = {};
$.extend(_http, {
    encodeURI: function(f) {
        var c = f.substring(0, f.indexOf("?"));
        var b = f.substring(f.indexOf("?") + 1, f.length);
        var a = "";
        var d = b.toQueryParams();
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
    decodeURI: function(f) {
        var c = f.substring(0, f.indexOf("?"));
        var b = f.substring(f.indexOf("?") + 1, f.length);
        var a = "";
        var d = b.toQueryParams();
        for (var e in d) {
            d[e] = decodeURIComponent(d[e]);
            a += e + "=" + d[e] + "&"
        }
        if (!a.isEmpty()) {
            a = a.substring(0, a.length - 1)
        }
        if (!c.isEmpty()) {
            c += "?"
        }
        return c + a
    }
});
var _object = {};
$.extend(_object, {
    count: 0,
    find: function(a) {
        return (_BROWSER.name() === "explorer") ? document[a] : window[a]
    },
    flash: function(b, a, c, j, d, g, l, h) {
        var k = null;
        if (h === null) {
            h = false
        }
        var f = {
            wmode: "opaque",
            bgcolor: "#FFF"
        };
        d = (arguments[4]) ? d.toQueryParams() : {};
        for (k in d) {
            f[k] = d[k]
        }
        if (_BROWSER.name === "explorer") {
            strHTML = '<object id="' + b + '"';
            strHTML += ' type="application/x-shockwave-flash"';
            strHTML += ' classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
            strHTML += ' codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab"';
            strHTML += ' width="' + c + '" height="' + j + '">';
            strHTML += '<param name="movie" value="' + a + '" />';
            strHTML += '<param name="quality" value="high" />';
            strHTML += '<param name="menu" value="false" />';
            strHTML += '<param name="allowScriptAccess" value="sameDomain" />';
            strHTML += '<param name="allowscale" value="false" />';
            strHTML += '<param name="swliveconnect" value="false" />';
            for (k in f) {
                strHTML += '<param name="' + k + '" value="' + f[k] + '" />'
            }
            strHTML += '<p><img src="' + g + '" width="' + c + '" height="' + j + '" alt="' + l + '" /></p>';
            strHTML += "</object>"
        } else {
            strHTML = '<embed src="' + a + '" id="' + b + '"';
            strHTML += ' type="application/x-shockwave-flash"';
            strHTML += ' pluginspage="http://www.macromedia.com/go/getflashplayer"';
            strHTML += ' menu="false" width="' + c + '" height="' + j + '"';
            strHTML += ' quality="high" allowScriptAccess="sameDomain"';
            strHTML += ' swliveconnect="false" allowscale="false"';
            for (k in f) {
                strHTML += " " + k + '="' + f[k] + '"'
            }
            strHTML += " />";
            window[b] = document.getElementById(b)
        }
        _object.count++;
        if (_object.count === 1) {
            if (typeof window.onbeforeunload === "function") {
                var e = window.onbeforeunload;
                window.onbeforeunload = function() {
                    _object.prepunload.call(_object);
                    e()
                }
            } else {
                window.onbeforeunload = function() {
                    _object.prepunload()
                }
            }
        }
        if (h === true) {
            return strHTML
        }
        document.writeln(strHTML)
    },
    prepunload: function() {
        if (typeof window.unload === "function") {
            var a = window.onunload;
            window.onunload = function() {
                _object.clean();
                a()
            }
        } else {
            window.onunload = this.clean
        }
    },
    clean: function() {
        if (window.opera || !document.all) {
            return
        }
        var c = document.getElementsByTagName("OBJECT");
        for (var b = 0; b < c.length; b++) {
            c[b].style.display = "none";
            for (var a in c[b]) {
                if (typeof c[b][a] === "function") {
                    c[b][a] = function() {}
                }
            }
        }
    }
});
var _gui = {};
_gui = {
    getXY: function() {
        if ($(this).parent() === null || $(this).css("display") === "none") {
            return false
        }
        var a = null,
            c = [],
            b;
        if (document.getBoxObjectFor) {
            b = document.getBoxObjectFor(this);
            c = [b.x, b.y]
        } else {
            c = [$(this).offset().left, $(this).offset().top]
        }
        return {
            x: c[0],
            y: c[1]
        }
    },
    setXY: function(b, e) {
        var d = this.getXY();
        if (!d) {
            return false
        }
        var a = $(this).css("position");
        if (!a || a === "static") {
            $(this).css("position", "relative")
        }
        var c = {
            x: parseFloat($(this).css("left"), 10),
            y: parseFloat($(this).css("top"), 10)
        };
        if (isNaN(c.x)) {
            c.x = 0
        }
        if (isNaN(c.y)) {
            c.y = 0
        }
        if (b !== null) {
            $(this).css("left", (b - d.x + c.x) + "px")
        }
        if (e !== null) {
            $(this).css("top", (e - d.y + c.y) + "px")
        }
        return true
    },
    getBound: function() {
        var a = this.getXY();
        return {
            x: a.x,
            y: a.y,
            width: $(this).width(),
            height: $(this).height(),
            offsetWidth: $(this)[0].offsetWidth,
            offsetHeight: $(this)[0].offsetHeight
        }
    }
};
var _selectbox = {};
_selectbox.convertAll = function(c) {
    if (arguments.length < 1) {
        var c = $("body")
    }
    var d = null;
    var b = c.find("SELECT");
    for (var a = 0; a < b.length; a++) {
        if (!$(b[a]).hasClass("g_hidden")) {
            continue
        }
        d = $("<DIV />");
        d.insertAfter($(b[a]));
        $.extend(d[0], _selectbox);
        d[0].initialize(b[a])
    }
};
$.extend(_selectbox, {
    initialize: function(c) {
        if (c.tagName !== "SELECT") {
            return
        }
        var f = this;
        c.classList.remove("g_hidden");
        var b = $("<input />", {
            type: "hidden",
            name: $(c).attr("name")
        });
        $(this).addClass("g_selectbox").attr("id", $(c).attr("id")).click(function() {
            f.fnClick()
        });
        if (c.className.isEmpty() === false) {
            $(this).addClass(c.className)
        }
        this.nodeInput = b.appendTo($(this));
        this.nodeText = $("<div />").addClass("value").appendTo($(this));
        this.nodeButton = $("<div />").addClass("arrow_img").appendTo($(this));
        this.nodeList = $("<div />").hide().addClass("g_selectbox_list").appendTo(rootObj);
        this.nWidth = $(this).width();
        $.extend(this, _gui);
        $.extend(this.nodeList, _gui);
        var a = "";
        var g = $(c).find("option");
        for (var e = 0; e < g.length; e++) {
            a = $(g[e]).text();
            var d = $(g[e]).attr("selected");
            if (d === true || d === "selected") {
                this.nodeSelect = this.addOption($(this), null, $(g[e]).attr("value"), a)
            } else {
                this.addOption($(this), null, $(g[e]).attr("value"), a)
            }
        }
        if (this.nodeSelect === undefined && this.nodeList.children().length > 0) {
            this.nodeSelect = this.nodeList.children().first();
            this.setText(this.nodeSelect.text())
        }
        if (this.nodeSelect !== undefined) {
            this.setText(this.nodeSelect.text());
            this.setValue(this.nodeSelect.attr("value"));
            this.nodeSelect.addClass("over")
        }
        if ("onchange" in c) {
            this.OnUpdate = c.onchange;
            c.onchange = null
        }
        $(c).remove();
        this.close()
    },
    view_count: 15,
    nWidth: 0,
    widthMargin: 0,
    setText: function(a) {
        this.nodeText.text(a)
    },
    getText: function() {
        return this.nodeText.text()
    },
    setValue: function(a) {
        this.nodeInput.val(a);
        if ("OnUpdate" in this && this.OnUpdate) {
            this.OnUpdate(a)
        }
    },
    getValue: function() {
        return this.nodeInput.val()
    },
    getLength: function() {
        return $(this.nodeList).children().length
    },
    addOption: function(d, h, g, b) {
        var f = this,
            c = b.getWidth(),
            a = this.nWidth;
        this.nodeList.css("width", a);
        if (a < c) {
            this.nWidth = c + this.widthMargin + 32;
            $(d).css("width", (this.nWidth).toString() + "px");
            this.nodeList.css("width", (this.nWidth).toString() + "px")
        }
        var e = $("<div />").attr("value", g).text(b);
        if (h === null || this.nodeList.children().length < 1 || this.nodeList.children().length < h) {
            this.nodeList.append(e)
        } else {
            if (h === 0) {
                this.nodeList.prepend(e)
            } else {
                this.nodeList.append(e)
            }
        }
        if (this.mode === "open" && this.getLength() === this.view_count) {
            this.nodeList.css("height", ($.extend(this.nodeList.childNodes[0], _gui).getBound().height * this.view_count + 9) + "px");
            this.nodeList.css("overflow", "auto")
        }
        $(e).bind({
            click: function() {
                f.fnOptionClick($(this))
            },
            mouseover: function() {
                f.fnMouseover($(this))
            },
            mouseout: function() {
                f.fnMouseout($(this))
            }
        });
        try {
            return e
        } finally {
            e = null
        }
    },
    fnClick: function() {
        if (this.mode === "open") {
            this.close()
        } else {
            this.open();
            this.nodeList.scrollTop(0);
            this.nodeList.scrollTop(this.nodeSelect.position().top)
        }
    },
    fnOptionSelect: function(d) {
        var b = this.nodeList.getElements("DIV");
        var c = b.length;
        for (var a = 0; a < c; a++) {
            if (b[a].value === d) {
                b[a].onclick();
                return
            }
        }
    },
    fnOptionClick: function(a) {
        this.nodeSelect.removeClass("over");
        this.nodeSelect = $(a);
        this.nodeSelect.addClass("over");
        this.setText($(a).text());
        this.setValue($(a).attr("value"));
        this.close()
    },
    fnMouseover: function(a) {
        $(a).addClass("select");
        if ("OnMouseOver" in this) {
            this.OnMouseOver($(a))
        }
    },
    fnMouseout: function(a) {
        $(a).removeClass("select")
    },
    _blur: function(c) {
        if (this.mode === "close") {
            return
        }
        var b = _event.pointer(c);
        var a = this.getBound();
        var d = this.nodeList.getBound();
        if ((b.x >= a.x && b.x <= (a.x + a.width) && b.y >= a.y && b.y <= (a.y + a.height)) || (b.x >= d.x && b.x <= (d.x + d.width) && b.y >= d.y && b.y <= (d.y + d.height))) {
            return
        }
        this.close()
    },
    open: function(c) {
        var b = this;
        if (this.mode !== "open") {
            this.mode = "open";
            this.nodeList.show();
            if (this.getLength() > this.view_count) {
                this.nodeList.css("height", ($.extend(this.nodeList.children().eq(0), _gui).getBound().height * this.view_count + 9) + "px");
                this.nodeList.css("overflow", "auto")
            }
            var a = this.getBound();
            this.nodeList.setXY(a.x, a.y + a.offsetHeight)
        }
        if (!this.tmpBind) {
            this.tmpBind = this._blur
        }
        $(document).on("click", function(d) {
            b.tmpBind(d)
        });
        $(window).on("resize", function(d) {
            b.tmpBind(d)
        });
        if ("OnOpen" in this) {
            this.OnOpen(c)
        }
    },
    close: function(a) {
        if (this.mode !== "close") {
            this.mode = "close";
            this.nodeList.hide()
        }
        if (!this.tmpBind) {
            this.tmpBind = this._blur
        }
        $(document).off("click", function(b) {
            g_this.tmpBind(b)
        });
        $(window).off("resize", function(b) {
            g_this.tmpBind(b)
        });
        if ("onClose" in this && a !== "default") {
            this.onClose()
        }
    }
});

function getXmlDocument(a, f, b) {
    if (window.ActiveXObject === undefined) {
        return a
    }
    if (typeof(a.hasOwnProperty) !== "undefined" && a.selectNodes) {
        return a
    }
    try {
        var d = new ActiveXObject("Microsoft.XMLDOM");
        d.async = false;
        d.loadXML(b.responseText);
        a = d
    } catch (c) {}
    return a
}

function fnAjax(d, c, e, a, f, b) {
    ajaxRequest({
        url: d,
        dataType: c,
        type: e,
        data: a,
        scope: f.self || null,
        async: (b == false) ? false : true,
        success: f.complete,
        error: f.error
    })
}

function ajaxRequest(j) {
    var j = j || {};
    if (!j.url) {
        return
    }
    var g = j.url;
    if ((j.cache !== undefined && typeof(j.cache) !== "boolean") || (j.type && j.type.toUpperCase() === "POST" && j.cache === false)) {
        var f = j.cache;
        var n = new Date();
        var b = n.getMonth() + 1;
        var h = n.getDate();
        var k = Math.floor(n.getHours() / f) * f;
        if (("" + b).length === 1) {
            b = "0" + b
        }
        if (("" + h).length === 1) {
            h = "0" + h
        }
        if (("" + k).length === 1) {
            k = "0" + k
        }
        var a = ("" + n.getFullYear()) + b + h + (k);
        if (g.indexOf("?") === -1) {
            g += "?"
        }
        g += "_=" + a;
        j.cache = true
    }
    var l = j.scope || this,
        e = {
            url: g,
            dataType: j.dataType || null,
            type: j.type || "GET",
            data: j.data || "",
            cache: (j.cache === undefined) ? false : j.cache,
            async: (j.async === undefined) ? true : j.async,
            success: function(c, m, d) {
                if (c && j.dataType === "xml") {
                    c = getXmlDocument(c, m, d)
                }
                if (j.success) {
                    j.success.call(l, c)
                }
            },
            error: function(c) {
                if (j.error) {
                    j.error.call(l, c)
                }
            },
            complete: function(c) {
                if (j.complete) {
                    j.complete.call(l, c)
                }
            }
        };
    if (j.timeout) {
        e.timeout = j.timeout
    }
    return $.ajax(e)
}
var _cookie = {};
$.extend(_cookie, {
    add: function(b, h) {
        var g = arguments;
        var e = arguments.length;
        var d = (e > 2) ? g[2] : null;
        var j = (e > 3) ? g[3] : null;
        var f = (e > 4) ? g[4] : null;
        var a = (e > 5) ? g[5] : false;
        if (d) {
            var c = new Date();
            c.setTime(c.getTime() + parseInt(d * 24 * 60 * 60 * 1000))
        }
        document.cookie = b + "=" + escape(h) + ((d === null) ? "" : ("; expires=" + c.toGMTString())) + ((j === null) ? "" : ("; path=" + j)) + ((f === null) ? "" : ("; domain=" + f)) + ((a === true) ? "; secure" : "")
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
        c += "=";
        var b = 0,
            d, a;
        while (b <= document.cookie.length) {
            d = b + c.length;
            if (document.cookie.substring(b, d) === c) {
                if ((a = document.cookie.indexOf(";", d)) === -1) {
                    a = document.cookie.length
                }
                return unescape(document.cookie.substring(d, a))
            }
            b = document.cookie.indexOf(" ", b) + 1;
            if (b === 0) {
                break
            }
        }
        return ""
    },
    getNames: function() {
        var a = Array();
        var e = document.cookie.split(";");
        var c;
        var d = 0;
        for (var b = 0; b < e.length; b++) {
            if (e[b] === "") {
                continue
            }
            c = e[b].split("=");
            if (c[0] !== "") {
                a[d++] = c[0]
            }
        }
        return a
    },
    free: function() {
        var c = new Date();
        c.setDate(c.getDate() - 1);
        var d = document.cookie.split(";");
        var b;
        for (var a = 0; a < d.length; a++) {
            if (d[a] === "") {
                continue
            }
            b = d[a].split("=");
            if (b[0] !== "") {
                document.cookie = b[0] + "=; expires=" + c.toGMTString() + ";"
            }
        }
    },
    isEnable: function() {
        return navigator.cookieEnabled
    }
});
var _xml = {};
$.extend(_xml, {
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
});
var _xslt = {};
$.extend(_xslt, {
    parseXML: function(f, a, b) {
        try {
            var c = transformToHtmlText(a, b);
            f.append(c)
        } catch (d) {}
        return f.children().length
    }
});

function transformToHtmlText(n, l) {
    if (typeof(XSLTProcessor) !== "undefined") {
        var h = new XSLTProcessor();
        h.importStylesheet(l);
        var d = h.transformToFragment(n, document);
        if (typeof(GetXmlStringFromXmlDoc) !== "undefined") {
            return GetXmlStringFromXmlDoc(d)
        }
        var m = new XMLSerializer();
        var g = m.serializeToString(d);
        return g
    }
    if (typeof(n.transformNode) !== "undefined") {
        return n.transformNode(l)
    }
    var c = null;
    try {
        c = new ActiveXObject("Msxml2.XSLTemplate")
    } catch (k) {}
    try {
        if (c) {
            var b = c;
            var f = new ActiveXObject("Msxml2.FreeThreadedDOMDocument");
            f.loadXML(l.xml);
            b.stylesheet = f;
            var a = b.createProcessor();
            a.input = n;
            a.transform();
            return a.output
        }
    } catch (j) {
        return null
    }
}
var _jaso = {};
$.extend(_jaso, {
    hangul: {
        cho: Array("ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"),
        jung: Array("ㅏ", "ㅐ", "ㅑ", "ㅒ", "ㅓ", "ㅔ", "ㅕ", "ㅖ", "ㅗ", "ㅘ", "ㅙ", "ㅚ", "ㅛ", "ㅜ", "ㅝ", "ㅞ", "ㅟ", "ㅠ", "ㅡ", "ㅢ", "ㅣ"),
        jong: Array("", "ㄱ", "ㄲ", "ㄳ", "ㄴ", "ㄵ", "ㄶ", "ㄷ", "ㄹ", "ㄺ", "ㄻ", "ㄼ", "ㄽ", "ㄾ", "ㄿ", "ㅀ", "ㅁ", "ㅂ", "ㅄ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"),
        _jung: Array("ㅏ", "", "", "", "ㅓ", "ㅔ", "", "", "ㅗ", "", "", "", "", "ㅜ", "", "", "", "", "ㅡ", "ㅢ", "ㅣ"),
        _jong: Array("", "ㄱ", "", "", "ㄴ", "", "", "ㅁ", "ㄹ", "", "", "", "", "", "", "", "", "ㅂ", "", "", "ㅆ", "ㅇ", "", "", "", "", "", "")
    },
    hangulJASO: function(h) {
        var l = [12593, 12594, 12596, 12599, 12600, 12601, 12609, 12610, 12611, 12613, 12614, 12615, 12616, 12617, 12618, 12619, 12620, 12621, 12622];
        var j = [12623, 12624, 12625, 12626, 12627, 12628, 12629, 12630, 12631, 12632, 12633, 12634, 12635, 12636, 12637, 12638, 12639, 12640, 12641, 12642, 12643];
        var e = [0, 12593, 12594, 12595, 12596, 12597, 12598, 12599, 12601, 12602, 12603, 12604, 12605, 12606, 12607, 12608, 12609, 12610, 12612, 12613, 12614, 12615, 12616, 12618, 12619, 12620, 12621, 12622];
        var k = new Array();
        var c = new Array();
        for (var b = 0; b < h.length; b++) {
            k[b] = h.charCodeAt(b);
            if (k[b] >= 44032 && k[b] <= 55203) {
                var d, a, f;
                var g = k[b] - 44032;
                f = g % 28;
                a = ((g - f) / 28) % 21;
                d = (((g - f) / 28) - a) / 21;
                c.push(String.fromCharCode(l[parseInt(d)]));
                c.push(String.fromCharCode(j[parseInt(a)]));
                if (f !== 0) {
                    c.push(String.fromCharCode(e[parseInt(f)]))
                }
            } else {
                c.push(String.fromCharCode(k[b]))
            }
        }
        return c
    },
    getHangulList: function(t) {
        var b, e, d, p, s, m, c = false,
            k = 0;
        var f = t.substring(0, t.length - 1);
        var g = Array();
        if (!String(t.charAt(t.length - 1)).isHangul()) {
            g[0] = t;
            return g
        }
        b = t.charAt(t.length - 1);
        e = b.charCodeAt(0);
        d = e - 44032;
        m = d % 28;
        s = ((d - m) / 28) % 21;
        p = parseInt(((d - m) / 28) / 21);
        if (p < 0) {
            var u = this.hangul.cho.length;
            var n = this.hangul._jung.length;
            var a = this.hangul._jong.length;
            for (var o = 0; o < u; o++) {
                if (this.hangul.cho[o] === b) {
                    c = true;
                    for (var r = 0; r < n; r++) {
                        if (this.hangul.jung[r] === "") {
                            continue
                        }
                        for (var l = 0; l < a; l++) {
                            if (l !== 0 && this.hangul._jong[l] === "") {
                                continue
                            }
                            g[k++] = f + String.fromCharCode(44032 + o * 588 + r * 28 + l)
                        }
                    }
                }
            }
            if (!c) {
                g[0] = f
            }
            try {
                return g
            } finally {
                g = null
            }
        }
        g[0] = f + String.fromCharCode(44032 + p * 588 + s * 28 + m);
        var h = this.hangul.jong.length;
        for (var q = 1; q < h && m === 0; q++) {
            g[q] = f + String.fromCharCode(44032 + p * 588 + s * 28 + q)
        }
        try {
            return g
        } finally {
            g = null
        }
    },
    isHangul: function() {
        var d = 0,
            a = "";
        var c = this.length;
        for (var b = 0; b < c; b++) {
            d = parseInt(this.charCodeAt(b));
            a = this.substr(b, 1).toUpperCase();
            if ((a < "0" || a > "9") && (a < "A" || a > "Z") && ((d > 255) || (d < 0))) {
                return true
            }
        }
        return false
    }
});
(function() {
    var b = function(d) {
        var c = this;
        this.rgItem = [];
        this.objForm = document.forms[d];
        this.objForm.onsubmit = function() {
            return c.send.call(c)
        };
        this.objForm.checker = this;
        return this
    };
    b.prototype = {
        send: function() {
            var c = this.check();
            if (!c) {
                return false
            }
            if ("OnSubmit" in this && this.OnSubmit) {
                c = this.OnSubmit.call(this.objForm);
                if (!c) {
                    return false
                }
            }
            return true
        },
        send_manual: function() {
            var c = this.check();
            if (!c) {
                return
            }
            if ("OnSubmit" in this && this.OnSubmit) {
                c = this.OnSubmit.call(this.objForm);
                if (!c) {
                    return
                }
            }
            this.objForm.submit()
        },
        check: function() {
            if (this.rgItem.length < 1) {
                return true
            }
            var c = true;
            var f = this.rgItem.length;
            try {
                for (var e = 0; e < f; e++) {
                    if ("custom" in this.rgItem[e]) {
                        var g = ("name" in this.rgItem[e]) ? this.objForm[this.rgItem[e].name] : this.objForm;
                        if (!this.rgItem[e].custom.call(g, g.value)) {
                            c = false;
                            break
                        }
                    } else {
                        c = this.handCheck(this.rgItem[e]);
                        if (!c) {
                            this.showAlert(this.rgItem[e]);
                            break
                        }
                    }
                }
            } catch (d) {
                if (_DEBUG === true) {
                    d.print()
                }
                c = false
            }
            return c
        },
        add: function(c) {
            if (!("custom" in c) && !c.name) {
                return
            }
            this.rgItem.push(c);
            if (("protect" in c) && c.protect && (c.type in a.protect)) {
                a.protect[c.type].call(a.protect, this.objForm[c.name])
            }
        },
        free: function() {
            this.rgItem = []
        },
        handCheck: function(l) {
            var m = true;
            var d = this.objForm[l.name];
            if (d[0] && (d[0].type === "radio" || d[0].type === "checkbox")) {
                m = false;
                var g = d.length;
                for (var e = 0; e < g; e++) {
                    if (d[e].checked === true && d[e].value.isEmpty() === false) {
                        m = true;
                        break
                    }
                }
            } else {
                var c = d.value.trim();
                var h = a.validator.string;
                if (l.type) {
                    h = a.validator[l.type]
                }
                var f = null,
                    j = null;
                if ("range" in l) {
                    f = ("min" in l.range) ? l.range.min : 0.1;
                    j = ("max" in l.range) ? l.range.max : null
                } else {
                    f = 0.1
                }
                if (!h.call(a.validator, c, f, j)) {
                    m = false
                }
            }
            if (m === false && l.alert === true) {
                this.showAlert(l)
            }
            return m
        },
        showAlert: function(f) {
            var e = this.objForm[f.name];
            if (e.length !== undefined) {
                e = e[0]
            }
            var d = e.tagName.toUpperCase();
            var c = e.type.toUpperCase();
            if ("msg" in f) {
                alert(f.msg)
            }
            if (f.focus) {
                this.objForm.querySelector(f.focus).focus()
            } else {
                if (("name" in f) && (c === "TEXT" || c === "PASSWORD" || d === "TEXTAREA")) {
                    e.value = "";
                    e.focus()
                }
            }
            return false
        }
    };
    var a = {
        validator: {
            number: function(e, d, c) {
                if (e.isEmpty()) {
                    return false
                }
                e = Number(e);
                if (isNaN(e)) {
                    return false
                }
                if ((d && isNaN(d)) || (c && isNaN(c))) {
                    return false
                }
                if (d && (e < d)) {
                    return false
                }
                if (c && (e > c)) {
                    return false
                }
                return true
            },
            price: function(e, d, c) {
                e = e.replace(/[^0-9]/g, "");
                return this.number(e, d, c)
            },
            string: function(e, d, c) {
                if (e.isEmpty()) {
                    return false
                }
                if (d && (e.length < d)) {
                    return false
                }
                if (c && (e.length > c)) {
                    return false
                }
                return true
            },
            hangul: function(e, d, c) {
                if (!this.string(e, d, c)) {
                    return false
                }
                return e.isHangul()
            },
            domain: function(d) {
                var c = (/^(http\:\/\/)?((\w+)[.])+(asia|biz|cc|cn|com|de|eu|in|info|jobs|jp|kr|mobi|mx|name|net|nz|org|travel|tv|tw|uk|us)(\/(\w*))*$/i);
                return c.test(d)
            },
            url: function(d) {
                if (this.domain(d)) {
                    return true
                }
                var c = d.lastIndexOf("/");
                if (c > -1) {
                    return this.domain(d.substring(0, c))
                }
                return false
            },
            userid: function(c) {
                c = c.replace(/[^a-zA-Z0-9]/g, "");
                if (!isNaN(c.substring(0, 1))) {
                    return false
                }
                if (!isNaN(c)) {
                    return false
                }
                return this.string(c, 4, 12)
            },
            password: function(c) {
                var d = /(?=.*\d)(?=.*[a-zA-Z])/;
                if (!d.test(c)) {
                    return false
                }
                return this.string(c, 10, 16)
            },
            four_string: function(f) {
                var e = f.length;
                var c = 0;
                if (e < 3) {
                    return false
                }
                for (var d = 0; d < e; d++) {
                    if (d !== 0 && f.substring(d - 1, d) === f.substring(d, d + 1)) {
                        if (c >= 2) {
                            return false
                        }
                        c++
                    } else {
                        c = 0
                    }
                }
                return true
            },
            email: function(d) {
                var c = /^[a-zA-z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9]{2,4}$/i;
                return c.test(d)
            },
            birth: function(d) {
                var c = /^((19|20)[0-9]{2})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])$/i;
                return c.test(d)
            }
        },
        protect: {
            functionkey: [8, 9, 13, 16, 17, 18, 20, 21, 22, 25, 27, 32, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 96],
            functioncheck: function(f) {
                var d = this.functionkey.length;
                for (var e = 0; e < d; e++) {
                    if (this.functionkey[e] === f) {
                        return true
                    }
                }
                return false
            },
            set: function(c, e, f, d) {
                if (!d) {
                    var d = f
                }
                if (e) {
                    c.onkeydown = e
                }
                if (f) {
                    c.onkeyup = f
                }
                if (d) {
                    c.onblur = d
                }
            },
            number: function(c) {
                c.style.imeMode = "disabled";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if ((d >= 48 && d <= 57) || (d >= 96 && d <= 105)) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, function(g) {
                    var f = new RegExp("[^0-9]", "g");
                    if (a.protect.value_test($(this), f) === false) {
                        var d = $(this).val().replace(/[^0-9]/g, "");
                        $(this).val(d)
                    }
                })
            },
            birth: function(c) {
                c.style.imeMode = "disabled";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if ((d >= 48 && d <= 57) || (d >= 96 && d <= 105)) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, function(g) {
                    var f = new RegExp("[^0-9]", "g");
                    if (a.protect.value_test($(this), f) === false) {
                        var d = $(this).val().replace(/[^0-9]/g, "");
                        $(this).val(d)
                    }
                })
            },
            price: function(c) {
                c.style.imeMode = "disabled";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if ((d >= 48 && d <= 57) || (d >= 96 && d <= 105)) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, function(f) {
                    var d = this.value.numeric().currency();
                    if (this.value !== d) {
                        if ($(this).attr("maxlength") && d.length > $(this).attr("maxlength")) {
                            var g = d.length - parseInt($(this).attr("maxLength"));
                            d = d.substring(0, d.length - g);
                            d = d.replace(/[^0-9]/g, "");
                            d = Number(d).currency()
                        }
                        $(this).val(d)
                    }
                    if ($(this).val() === "0") {
                        $(this).val("")
                    }
                })
            },
            hangul: function(c) {
                c.style.imeMode = "active";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if (d === 229) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, null, function(f) {
                    var d = ($(this).val().isEmpty()) ? "" : $(this).val().replace(/[^가-힣]/g, "");
                    $(this).val(d)
                })
            },
            userid: function(c) {
                c.style.imeMode = "disabled";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if ((d >= 48 && d <= 57) || (d >= 65 && d <= 90) || (d >= 97 && d <= 122)) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, function(g) {
                    var f = new RegExp("[^a-zA-Z0-9]", "g");
                    if (a.protect.value_test($(this), f) === false) {
                        var d = $(this).val().replace(f, "");
                        $(this).val(d)
                    }
                })
            },
            english: function(c) {
                c.style.imeMode = "disabled";
                this.set(c, function(f) {
                    var d = f.keyCode;
                    if (a.protect.functioncheck(d)) {
                        return true
                    }
                    if ((d >= 65 && d <= 90) || (d >= 97 && d <= 122)) {
                        return true
                    }
                    f.returnValue = "";
                    return false
                }, function(g) {
                    var f = new RegExp("[^a-zA-Z]", "g");
                    if (a.protect.value_test($(this), f) === false) {
                        var d = $(this).val().replace(f, "");
                        $(this).val(d)
                    }
                })
            },
            value_test: function(c, d) {
                if (d.test($(c).val()) === true) {
                    return false
                }
                return true
            }
        }
    };
    window.FormChecker = b;
    window.Form = a
})();
var _form_checker = function(a) {
    this.init(a)
};
$.extend(_form_checker.prototype, {
    objForm: null,
    rgItem: null,
    init: function(a) {
        var b = this;
        this.rgItem = new Array();
        this.objForm = a;
        this.objForm.checker = this;
        this.objForm.on("submit", function() {
            return b.send()
        })
    },
    send: function() {
        var a = this.check();
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
        var a = this.check();
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
    check: function() {
        if (this.rgItem.length < 1) {
            return true
        }
        var result = true,
            strType = "",
            strValue = "",
            length = this.rgItem.length;
        for (var i = 0; i < length; i++) {
            if ("inputObj" in this.rgItem[i]) {
                tag = this.rgItem[i].inputObj.get(0).tagName.toUpperCase();
                strType = this.rgItem[i].inputObj.attr("type");
                strValue = this.rgItem[i].inputObj.val().trim()
            }
            try {
                if ("custom" in this.rgItem[i]) {
                    var obj = ("inputObj" in this.rgItem[i]) ? this.rgItem[i].inputObj : this.objForm;
                    if (!this.rgItem[i].custom.call(obj, strValue)) {
                        result = false;
                        break
                    }
                } else {
                    if (strType === "radio" || strType === "checkbox") {
                        var checkObj = this.rgItem[i].inputObj.filter(":checked");
                        if (checkObj.val().isEmpty()) {
                            result = false;
                            break
                        }
                    } else {
                        var fnValidator = eval("_form.validator." + this.rgItem[i].strType);
                        var min = null,
                            max = null;
                        if ("range" in this.rgItem[i]) {
                            min = ("min" in this.rgItem[i].range) ? this.rgItem[i].range.min : 0.1;
                            max = ("max" in this.rgItem[i].range) ? this.rgItem[i].range.max : null
                        } else {
                            min = 0.1
                        }
                        if (!fnValidator.call(_form.validator, strValue, min, max)) {
                            result = false;
                            break
                        }
                    }
                }
            } catch (error) {
                if (_DEBUG === true) {
                    error.print()
                }
                result = false;
                break
            }
        }
        if (!result) {
            if ("message" in this.rgItem[i]) {
                alert(this.rgItem[i].message)
            }
            if (("inputObj" in this.rgItem[i]) && (strType === "text" || strType === "password" || tag === "TEXTAREA")) {
                this.rgItem[i].inputObj.val("");
                this.rgItem[i].inputObj.focus()
            }
            return false
        }
        return true
    },
    add: function(objItem) {
        if (!("custom" in objItem) && !objItem.inputObj) {
            return
        }
        this.rgItem.push(objItem);
        if (("protect" in objItem) && objItem.protect && (objItem.strType in _form.protect)) {
            eval("_form.protect." + objItem.strType).call(_form.protect, (objItem.inputObj))
        }
    },
    free: function() {
        this.rgItem = []
    }
});
var _form = {};
_form.validator = {};
$.extend(_form.validator, {
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
            if (b !== 0 && d.substring(b - 1, b) === d.substring(b, b + 1)) {
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
_form.protect = {};
$.extend(_form.protect, {
    functionkey: [8, 9, 13, 16, 17, 18, 20, 21, 22, 25, 27, 32, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 96],
    functioncheck: function(a) {
        var c = this.functionkey.length;
        for (var b = 0; b < c; b++) {
            if (this.functionkey[b] === a) {
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
            a.bind("keydown", c)
        }
        if (d) {
            a.bind("keyup", d)
        }
        if (b) {
            a.bind("blur", b)
        }
    },
    number: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 96 && b <= 105)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function(d) {
            var c = new RegExp("[^0-9]", "g");
            if (_form.protect.value_test($(this), c) === false) {
                var b = $(this).val().replace(/[^0-9]/g, "");
                $(this).val(b)
            }
        })
    },
    price: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 96 && b <= 105)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function(c) {
            var b = Number($(this).val().replace(/[^0-9]/g, "")).currency();
            if ($(this).val() !== b) {
                if ($(this).attr("maxlength") && b.length > $(this).attr("maxlength")) {
                    var d = b.length - parseInt($(this).attr("maxLength"));
                    b = b.substring(0, b.length - d);
                    b = b.replace(/[^0-9]/g, "");
                    b = Number(b).currency()
                }
                $(this).val(b)
            }
            if ($(this).val() === "0") {
                $(this).val("")
            }
        })
    },
    hangul: function(a) {
        a.css("ime-mode", "active");
        this.set(a, function(c) {
            var b = c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if (b === 229) {
                return true
            }
            c.returnValue = "";
            return false
        }, null, function(c) {
            var b = ($(this).val().isEmpty()) ? "" : $(this).val().replace(/[^가-힣]/g, "");
            $(this).val(b)
        })
    },
    userid: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 48 && b <= 57) || (b >= 65 && b <= 90) || (b >= 97 && b <= 122)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function(d) {
            var c = new RegExp("[^a-zA-Z0-9]", "g");
            if (_form.protect.value_test($(this), c) === false) {
                var b = $(this).val().replace(c, "");
                $(this).val(b)
            }
        })
    },
    english: function(a) {
        a.css("ime-mode", "disabled");
        this.set(a, function(c) {
            var b = c.keyCode;
            if (_form.protect.functioncheck(b)) {
                return true
            }
            if ((b >= 65 && b <= 90) || (b >= 97 && b <= 122)) {
                return true
            }
            c.returnValue = "";
            return false
        }, function(d) {
            var c = new RegExp("[^a-zA-Z]", "g");
            if (_form.protect.value_test($(this), c) === false) {
                var b = $(this).val().replace(c, "");
                $(this).val(b)
            }
        })
    },
    value_test: function(a, b) {
        if (b.test($(a).val()) === true) {
            return false
        }
        return true
    }
});
_form.addValues = function(a, f) {
    if (!a || !f) {
        return
    }
    var b = null;
    try {
        $.each(f, function(e, g) {
            b = document.createElement("INPUT");
            b.setAttribute("type", "hidden");
            b.setAttribute("name", e);
            b.setAttribute("value", g);
            a.append(b)
        })
    } catch (d) {
        for (var c in f) {
            b = document.createElement("INPUT");
            b.setAttribute("type", "hidden");
            b.setAttribute("name", c);
            b.setAttribute("value", f[c]);
            a.append(b)
        }
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
        if ($(this).val().length >= c) {
            $(a).focus()
        }
    })
};
var _window = {
    agent: null,
    browser: function() {
        var b = navigator.userAgent.toLowerCase();
        if (b.indexOf("firefox") > -1) {
            return "F"
        } else {
            if (b.indexOf("safari") > -1) {
                if (b.indexOf("chrome") > -1) {
                    return "C"
                }
                return "S"
            } else {
                if (b.indexOf("msie") > -1 || b.indexOf("trident") > -1) {
                    if (b.indexOf("trident/7") > -1) {
                        var c = 11
                    } else {
                        if (b.indexOf("trident/6") > -1) {
                            if (b.indexOf("msie 10") > -1 || b.indexOf("msie 9") > -1 || b.indexOf("msie 7") > -1) {
                                var c = 10
                            }
                        } else {
                            if (b.indexOf("trident/5") > -1) {
                                if (b.indexOf("msie 9") > -1 || b.indexOf("msie 7") > -1) {
                                    var c = 9
                                }
                            } else {
                                if (b.indexOf("trident/4") > -1) {
                                    if (b.indexOf("msie 8") > -1 || b.indexOf("msie 7") > -1) {
                                        var c = 8
                                    }
                                    if (b.indexOf("nt 6.1") > -1) {
                                        var c = "8_2"
                                    }
                                } else {
                                    if (b.indexOf("msie 7") > -1) {
                                        var c = 7
                                    } else {
                                        var c = 6
                                    }
                                }
                            }
                        }
                    }
                    return "I" + c
                }
            }
        }
        return "E"
    },
    open: function(f, d, c, g, j, e) {
        var k = "width=" + c + ", height=" + g;
        k += (!j) ? "status=no, toolbar=no, menubar=no, location=no, fullscreen=no, scrollbars=yes, resizable=no, titlebar=no" : "," + j;
        var b = window.open(d, f, k);
        if (b) {
            this.resize(c, g, b);
            b.focus();
            if (e) {
                return b
            }
        }
    },
    resize: function(a, b, c) {
        if (!c) {
            c = window
        }
        this.agent = this.browser();
        switch (this.agent) {
            case "F":
                a += 18;
                b += 73;
                break;
            case "C":
                c.resizeTo(a + 100, b + 100);
                a += 16;
                b += 68;
                break;
            case "S":
                c.resizeTo(a + 100, b + 100);
                a += 16;
                b += 38;
                break;
            case "I11":
                a += 20;
                b += 71;
                break;
            case "I10":
                a += 20;
                b += 71;
                break;
            case "I9":
                a += 20;
                b += 71;
                break;
            case "I8":
                a += 10;
                b += 78;
                break;
            case "I8_2":
                a += 10;
                b += 83;
                break;
            case "I7":
                a += 10;
                b += 78;
                break;
            case "I6":
                a += 10;
                b += 54;
                break;
            default:
                a += 20;
                b += 72
        }
        c.resizeTo(a, b);
        this.center(c, a, b)
    },
    center: function(e, b, d) {
        if (!e) {
            e = window
        }
        var c = {
            width: 0,
            height: 0
        };
        if (this.agent !== null && this.agent.indexOf("I") > -1) {
            c.width = b;
            c.height = d;
            var a = (screen.availWidth - c.width) / 2;
            var f = (screen.availHeight - c.height) / 2
        } else {
            c.width = e.outerWidth;
            c.height = e.outerHeight;
            var a = (screen.width - c.width) / 2;
            var f = (screen.height - c.height) / 2
        }
        e.moveTo(a, f);
        e.focus()
    },
    close: function(a) {
        if (!a) {
            a = window
        }
        a.close()
    }
};

function g_fnBLUR() {
    var a = null;
    var d = Array("A", "IMG", "AREA", "INPUT");
    for (var c = 0; c < d.length; c++) {
        a = document.getElementsByTagName(d[c]);
        for (var b = 0; b < a.length; b++) {
            if (d[c] === "INPUT" && (a[b].getAttribute("type") === "text" || a[b].getAttribute("type") === "password" || a[b].getAttribute("type") === "file")) {
                continue
            }
            a[b].onfocus = function() {
                this.blur()
            }
        }
    }
}

function g_fnSECURITY() {
    document.oncontextmenu = _DISABLE;
    document.ondragstart = _DISABLE;
    document.onselectstart = _DISABLE;
    document.addEventListener("mousedown", function(a) {
        a = _event.event(a);
        if (a.button !== 2) {
            return true
        }
        _event.stop(a);
        return false
    });
    document.addEventListener("keydown", function(c) {
        c = _event.event(c);
        var b = _event.keycode(c);
        b = parseInt(b);
        var f = new Array(114, 115, 116, 117, 118, 121, 122, 8);
        if (c.altKey || c.altLeft || c.ctrlKey || c.ctrlLeft) {
            try {
                c.keyCode = 0
            } catch (d) {}
            _event.stop(c);
            return false
        }
        for (var a = 0; a < f.length; a++) {
            if (f[a] === b) {
                try {
                    c.keyCode = 0
                } catch (d) {}
                _event.stop(c);
                return false
            }
        }
        return true
    })
}

function g_fnSECURITY2() {
    document.oncontextmenu = _DISABLE;
    document.ondragstart = _DISABLE;
    document.onselectstart = _DISABLE;
    document.addEventListener("mousedown", function(a) {
        a = _event.event(a);
        if (a.button !== 2) {
            return true
        }
        _event.stop(a);
        return false
    });
    document.addEventListener("keydown", function(c) {
        c = _event.event(c);
        var b = _event.keycode(c);
        b = parseInt(b);
        var f = new Array(114, 115, 116, 117, 118, 121, 122);
        if (c.altKey || c.altLeft || c.ctrlKey || c.ctrlLeft) {
            try {
                c.keyCode = 0
            } catch (d) {}
            _event.stop(c);
            return false
        }
        for (var a = 0; a < f.length; a++) {
            if (f[a] === b) {
                try {
                    c.keyCode = 0
                } catch (d) {}
                _event.stop(c);
                return false
            }
        }
        return true
    })
}(function() {
    var a = function(c) {
        var e = document.getElementById("g_SLEEP");
        var d = {
            el: null,
            layer: null,
            close_btn: null,
            mask: true,
            type: "class"
        };
        for (var b in c) {
            d[b] = c[b]
        }
        this.options = d;
        d.layer.layerControl = this;
        if (d.el !== null) {
            d.el.addEventListener("click", function() {
                if (d.mask === true) {
                    e.classList.toggle("g_hidden");
                    document.body.classList.add("mask_on")
                }
                if (d.type === "class") {
                    d.layer.classList.toggle("g_hidden")
                } else {
                    if (d.layer.style.display !== "block") {
                        d.layer.style.display = "block"
                    } else {
                        d.layer.style.display = "none"
                    }
                }
            })
        }
        if (d.close_btn !== null) {
            d.close_btn.addEventListener("click", function() {
                a.close({
                    mask: d.mask,
                    layer: d.layer
                })
            })
        }
    };
    a.open = function(b) {
        var c = document.getElementById("g_SLEEP");
        if (b.mask !== false) {
            document.body.classList.add("mask_on");
            c.classList.remove("g_hidden");
            if (c.style.display !== "block") {
                c.removeAttribute("style")
            }
        }
        if (b.type === "class") {
            b.layer.classList.remove("g_hidden")
        } else {
            b.layer.style.display = "block"
        }
    };
    a.close = function(b) {
        var c = document.getElementById("g_SLEEP");
        if (b.mask !== false) {
            document.body.classList.remove("mask_on");
            c.classList.add("g_hidden")
        }
        if (b.type === "class") {
            b.layer.classList.add("g_hidden")
        } else {
            b.layer.style.display = "none"
        }
    };
    window.LayerControl = a;
    document.addEventListener("click", function(d) {
        if (d.target.getAttribute("data-close") === "true") {
            var b = d.target;
            var c = b.closest(".g_layer");
            if (c !== null) {
                a.close({
                    layer: c
                })
            }
        }
    })
})();
var _myService = {
    mySearchXml: null,
    getFavorite: function(e) {
        var d = document.querySelectorAll('[data-content="tab_mygame"]');
        var a = d.length;
        for (var b = 0; b < a; b++) {
            var c = d[b].querySelector("ul");
            c.innerHTML = '<li class="empty">LOADING..</li>'
        }
        ajaxRequest({
            url: "/api/mySearch",
            dataType: "xml",
            type: "get",
            data:{api_token:a_token},
            success: function(f) {
                _myService.mySearchXml = _xml.getElement(f, "mysearch", 0);
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
        if (this.mySearchXml === null) {
            this.getFavorite(this.makeFavoriteList);
            return
        }
        var m = [];
        var p = this.mySearchXml.getAttribute("result");
        if (p === "fail") {
            var j = this.mySearchXml.getAttribute("reason");
            if (j === "nologin") {
                m.push('<li class="empty">로그인 후 이용 가능합니다.</li>')
            } else {
                alert((j.isEmpty()) ? "서비스 장애입니다. 잠시 후 이용하세요." : j)
            }
        } else {
            var g = _xml.getElements(this.mySearchXml, "item");
            if (g.length < 1) {
                m.push('<li class="empty">등록된 나만의 게임이 없습니다.<br>나만의 게임을 등록하시면 보다 쉽게 검색 가능합니다.<br><br><a href="/myroom/customer/search" class="search_add_btn">등록하기 +</a></li>')
            } else {
                var a = g.length;
                for (var h = 0; h < a; h++) {
                    var o = g[h];
                    var d = (o.getAttribute("type") === "sell") ? "팝니다" : "삽니다";
                    var n = o.getElementsByTagName("game")[0].childNodes[0];
                    var l = o.getElementsByTagName("server")[0].childNodes[0];
                    var b = o.getElementsByTagName("goods")[0].childNodes[0];
                    var f = n.nodeValue + " > " + l.nodeValue + " > " + b.nodeValue;
                    m.push('<li data-id="' + o.getAttribute("id") + '" data-idx="' + h + '">');
                    m.push('<a href="javascript:;" class="gs_name"><span class="' + o.getAttribute("type") + '">[' + d + "]</span>" + f + "</a>");
                    m.push('<a href="javascript:;" class="delete_btn"></a>');
                    m.push("</li>")
                }
            }
        }
        var c = document.querySelectorAll('[data-content="tab_mygame"]');
        var k = c.length;
        for (var h = 0; h < k; h++) {
            var e = c[h].querySelector("ul");
            e.innerHTML = m.join("");
            if (_myService.myGameHandler !== true) {
                e.addEventListener("click", _myService.myGameClickHandler)
            }
        }
    },
    myGameClickHandler: function(j) {
        _myService.myGameHandler = true;
        var l = _myService.getGameServerEl(j.target);
        var c = _xml.getElements(_myService.mySearchXml, "item");
        if (j.target.classList.contains("delete_btn") === true) {
            var k = j.target.parentNode.getAttribute("data-idx");
            var h = c[k].getElementsByTagName("game")[0];
            var g = c[k].getElementsByTagName("server")[0];
            var b = (c[k].getAttribute("type") === "sell") ? "팝니다" : "삽니다";
            if (confirm(b + " > " + h.childNodes[0].nodeValue + " > " + g.childNodes[0].nodeValue + " 게임을 나만의 게임리스트에서 삭제하시겠습니까?") === true) {
                _myService.deleteFavorite(j.target.parentElement.getAttribute("data-id"), function() {
                    _myService.getFavorite()
                })
            }
            return
        }
        var d = j.target;
        while (d !== null && d.classList.contains("gs_name") === false) {
            d = d.parentElement
        }
        if (d !== null && d.className === "gs_name") {
            var k = d.parentElement.getAttribute("data-idx");
            var h = c[k].getElementsByTagName("game")[0];
            var g = c[k].getElementsByTagName("server")[0];
            if (l !== null) {
                var a = c[k].getElementsByTagName("goods_type")[0];
                var f = (a.getAttribute("id") === "all") ? "money" : a.getAttribute("id");
                if (l.formElement.querySelector('[value="' + c[k].getAttribute("type") + '"]') !== null) {
                    l.formElement.querySelector('[value="' + c[k].getAttribute("type") + '"]').checked = true
                }
                l.changeAction = true;
                l.gameList.gameCode = h.getAttribute("id");
                l.serverList.serverCode = g.getAttribute("id");
                if (l.goodsList !== undefined) {
                    l.goodsList.goodsCode = f
                } else {
                    l.serverList.goodsCode = f
                }
                l.gameList.createList()
            }
        }
    },
    deleteFavorite: function(a, b) {
        ajaxRequest({
            url: "/myroom/customer/search_delete.php",
            data: "id=" + a,
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
                        b.call(_myService, c)
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
    count: 14,
    getLastCount: function() {
        var b = _cookie.get("userSerachListNew") || [];
        var a = 0;
        if (b.length > 0) {
            a = Object.keys(JSON.parse(b)).length
        }
        return a
    },
    getLastSearch: function() {
        var a = _cookie.get("userSerachListNew") || [];
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
        var j = _cookie.get("userSerachListNew") || [],
            k, b = document.getElementById("g_searchbar_form"),
            h = b.querySelector('[name="search_type"]:checked').value,
            e = b.querySelector('[name="search_game"]').value,
            d = b.querySelector('[name="search_game_text"]').value,
            c = b.querySelector('[name="search_server"]').value,
            a = b.querySelector('[name="search_server_text"]').value;
        if (e.isEmpty()) {
            return
        }
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
        _cookie.add("userSerachListNew", JSON.stringify(j), null, "/", ".localhost")
    },
    makeLastSearch: function() {
        var o = _myService.getLastCount();
        if (o > 0) {
            if (this.mySearchXml === null) {
                this.getFavorite(_myService.makeLastSearch);
                return
            }
        }
        var b = _myService.getLastSearch();
        var t = [];
        if (b.length > 0) {
            if (this.mySearchXml === null) {
                var s = {}
            } else {
                var s = {};
                var l = _xml.getElements(_myService.mySearchXml, "item");
                var q = l.length;
                for (var n = 0; n < q; n++) {
                    var p = $(l[n]);
                    var z = p.find("game");
                    var f = p.find("server");
                    if (s[z.attr("id")] === undefined) {
                        s[z.attr("id")] = [];
                        s[z.attr("id")]["seq"] = [];
                        s[z.attr("id")]["server"] = []
                    }
                    s[z.attr("id")]["seq"].push(p.attr("id"));
                    s[z.attr("id")]["server"].push(f.attr("id"))
                }
            }
            var x = b.length;
            for (var y = 0; y < x; y++) {
                var j = b[y];
                if (j) {
                    var c = j.type;
                    var h = (c === "sell") ? "팝니다" : "삽니다";
                    var u = j.gameCode;
                    var e = j.gameName;
                    var k = j.serverCode;
                    var w = j.serverName;
                    var r = e + " > " + w;
                    var m = "";
                    var v = "";
                    if (s[u] !== undefined && s[u]["server"].indexOf(k) !== -1) {
                        m = " on";
                        v = s[u]["seq"][s[u]["server"].indexOf(k)]
                    }
                    t.push('<li data-id="' + y + '">');
                    if (k !== "0") {
                        t.push('<i class="icon_star_' + c + m + '" data-mygame="' + v + '"></i>')
                    }
                    t.push('<a href="javascript:;" class="gs_name"><span class="' + c + '">[' + h + "]</span>" + r + "</a>");
                    t.push('<a href="javascript:;" class="delete_btn"></a>');
                    t.push("</li>")
                }
            }
        } else {
            t.push('<li class="empty">최근 검색 게임이 없습니다.</li>')
        }
        var g = document.querySelectorAll('[data-content="tab_lastsearch"]');
        var d = g.length;
        for (var n = 0; n < d; n++) {
            var a = g[n].querySelector("ul");
            a.innerHTML = t.join("");
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
        if (c.target.classList.contains("icon_star_sell") === true || c.target.classList.contains("icon_star_buy") === true) {
            var d = _myService.getLastSearch();
            var g = c.target.parentElement.getAttribute("data-id");
            var j = c.target.getAttribute("data-mygame");
            var f = {
                type: d[g].type,
                game: d[g].gameCode,
                game_text: d[g].gameName,
                server: d[g].serverCode,
                server_text: d[g].serverName,
                goods: "0",
                goods_text: "물품전체"
            };
            var a = (d[g].type === "sell") ? "팝니다" : "삽니다";
            if (j.isEmpty() === true) {
                if (confirm(a + " > " + f.game_text + " > " + f.server_text + " 게임을 나만의 게임리스트에 추가하시겠습니까?") === true) {
                    _myService.addFavorite(f, function(e) {
                        if (e.result === "SUCCESS") {
                            c.target.setAttribute("data-mygame", e.mygameID);
                            c.target.classList.add("on");
                            _myService.getFavorite()
                        }
                    })
                }
            } else {
                if (confirm(a + " > " + f.game_text + " > " + f.server_text + " 게임을 나만의 게임리스트에서 삭제하시겠습니까?") === true) {
                    _myService.deleteFavorite(j, function(e) {
                        if (e.result === "SUCCESS") {
                            c.target.setAttribute("data-mygame", "");
                            c.target.classList.remove("on");
                            _myService.getFavorite()
                        }
                    })
                }
            }
        }
        var b = c.target;
        while (b !== null && b.classList.contains("gs_name") === false) {
            b = b.parentElement
        }
        if (b !== null && b.className === "gs_name") {
            var k = _myService.getGameServerEl(b);
            if (k !== null) {
                var d = _myService.getLastSearch();
                var h = b.parentElement.getAttribute("data-id");
                if (k.formElement.querySelector('[value="' + d[h].type + '"]') !== null) {
                    k.formElement.querySelector('[value="' + d[h].type + '"]').checked = true
                }
                k.changeAction = true;
                k.gameList.gameCode = d[h].gameCode;
                k.serverList.serverCode = d[h].serverCode;
                k.gameList.createList()
            }
        }
    },
    deleteLastSearch: function(b) {
        if (b.isEmpty()) {
            return
        }
        var a = _cookie.get("userSerachListNew") || [];
        if (a.length > 0) {
            var a = JSON.parse(a);
            a.splice(b, 1);
            _cookie.add("userSerachListNew", JSON.stringify(a), null, "/", ".localhost")
        }
    },
    deleteListAll: function(a) {
        _cookie.remove("userSerachListNew", "/", ".localhost");
        a.remove()
    },
    getGameServerEl: function(b) {
        var a = b.parentElement;
        while (a !== null && a.classList.contains("g_search_frame") === false) {
            a = a.parentElement
        }
        var c = a.querySelector('[data-gslist="true"]');
        return c.gameserver || null
    }
};
var rootObj = {};
var g_nodeSleep;

function _initialize() {
    rootObj = $("#g_BODY");
    g_nodeSleep = $("#g_SLEEP")[0];
    if (g_nodeSleep) {
        $.extend(g_nodeSleep, {
            enable: function(h) {
                var m = $("#g_OVERLAY");
                m.show();
                $(this).removeClass("g_hidden");
                if (h.length > 0) {
                    this.node = h;
                    h.appendTo($(this));
                    var o = h.outerWidth();
                    var e = $(h).outerHeight();
                    var f = {
                        position: "relative",
                        left: "50%",
                        "margin-left": "-" + (o / 2) + "px",
                        "z-index": "99"
                    };
                    if (document.body.clientHeight > e) {
                        var l = (document.documentElement.scrollTop || document.body.scrollTop);
                        var k = e / 2;
                        k = k + ((document.body.scrollHeight - window.innerHeight) / 2);
                        if (l > 0) {
                            k = k - l
                        }
                        f.top = "50%";
                        f["margin-top"] = -k + "px"
                    } else {
                        m.css("height", e + "px")
                    }
                    if (document.body.clientWidth < h.css("width").replace("px", "")) {
                        m.css("width", o + "px")
                    }
                    h.removeClass("g_hidden").css(f).show().focus();
                    var j = this.node.find("DIV");
                    var g = j.length;
                    for (var n = 0; n < g; n++) {
                        if (j[n].className == "g_selectbox") {
                            j[n].nodeList.css("z-index", "99");
                            $("body").append(j[n].nodeList)
                        }
                    }
                    $(window).on("resize", this.repositionLayer)
                }
                if ("OnOpen" in this) {
                    this.OnOpen.call(this)
                }
            },
            disable: function() {
                if (this.node) {
                    this.node.hide()
                }
                $(this).addClass("g_hidden");
                $("#g_OVERLAY").hide();
                $(window).off("resize", this.repositionLayer);
                if ("OnClose" in this) {
                    this.OnClose.call(this)
                }
            },
            repositionLayer: function() {
                var f = g_nodeSleep.node;
                var e = $("#g_OVERLAY");
                if (document.body.clientHeight > f.css("height").replace("px", "")) {
                    f.css({
                        top: "50%",
                        "margin-top": "-" + (f.height() / 2) + "px"
                    });
                    e.css("height", "100%")
                } else {
                    f.css({
                        top: "auto",
                        "margin-top": "0"
                    });
                    e.css("height", f.height() + "px")
                }
                if (document.body.clientWidth > f.css("width").replace("px", "")) {
                    e.css("width", "100%")
                } else {
                    e.css("width", f.width() + "px")
                }
            }
        })
    }
    var b = document.querySelectorAll("[data-popular]");
    var c = b.length;
    for (var d = 0; d < c; d++) {
        b[d].addEventListener("click", function(g) {
            var h = g.target;
            while (h !== null && h.getAttribute("data-pgame") === null) {
                h = h.parentElement
            }
            if (h !== null && h.getAttribute("data-pgame") !== null) {
                var j = _myService.getGameServerEl(h);
                if (j !== null) {
                    var f = h.getAttribute("data-pgame");
                    j.changeAction = true;
                    j.gameList.gameCode = f;
                    delete j.serverList.selectedData;
                    j.gameList.createList()
                }
            }
        })
    }
    _selectbox.convertAll();
    g_fnBLUR();
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
            __init()
        }
        $("input, textarea").placeholder()
    } catch (a) {
        if (_DEBUG) {
            a.print();
            return false
        }
    }
}

function login() {
    var a = encodeURIComponent(document.URL);
    window.open(SSL_DOMAIN + "/portal/user/login_form.html?returnUrl=" + a, "login", "height=564,width=330, status=no,toolbar=no,menubar=no,location=no,fullscreen=no,scrollbars=no,resizable=no,titlebar=no")
}
