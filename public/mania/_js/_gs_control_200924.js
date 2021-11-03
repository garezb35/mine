(function(a) {
    if(typeof Object.assign != "function") {
        Object.defineProperty(Object, "assign", {
            value: function j(n, p) {
                if(n == null) {
                    throw new TypeError("Cannot convert undefined or null to object")
                }
                var o = Object(n);
                for(var m = 1; m < arguments.length; m++) {
                    var l = arguments[m];
                    if(l != null) {
                        for(var k in l) {
                            if(Object.prototype.hasOwnProperty.call(l, k)) {
                                o[k] = l[k]
                            }
                        }
                    }
                }
                return o
            },
            writable: true,
            configurable: true
        })
    }
    if(!Array.from) {
        Array.from = (function() {
            var n = Object.prototype.toString;
            var o = function(q) {
                return typeof q === "function" || n.call(q) === "[object Function]"
            };
            var m = function(r) {
                var q = Number(r);
                if(isNaN(q)) {
                    return 0
                }
                if(q === 0 || !isFinite(q)) {
                    return q
                }
                return(q > 0 ? 1 : -1) * Math.floor(Math.abs(q))
            };
            var l = Math.pow(2, 53) - 1;
            var k = function(r) {
                var q = m(r);
                return Math.min(Math.max(q, 0), l)
            };
            return function p(y) {
                var q = this;
                var x = Object(y);
                if(y == null) {
                    throw new TypeError("Array.from requires an array-like object - not null or undefined")
                }
                var v = arguments.length > 1 ? arguments[1] : void undefined;
                var s;
                if(typeof v !== "undefined") {
                    if(!o(v)) {
                        throw new TypeError("Array.from: when provided, the second argument must be a function")
                    }
                    if(arguments.length > 2) {
                        s = arguments[2]
                    }
                }
                var w = k(x.length);
                var r = o(q) ? Object(new q(w)) : new Array(w);
                var t = 0;
                var u;
                while(t < w) {
                    u = x[t];
                    if(v) {
                        r[t] = typeof s === "undefined" ? v(u, t) : v.call(s, u, t)
                    } else {
                        r[t] = u
                    }
                    t += 1
                }
                r.length = w;
                return r
            }
        }())
    }

    function f(n, m) {
        for(var k in m) {
            if(String(m[k]) === "[object Object]") {
                for(var l in m[k]) {
                    if(n[k] === undefined) {
                        n[k] = []
                    }
                    n[k][l] = m[k][l]
                }
            } else {
                n[k] = m[k]
            }
        }
        return n
    }
    var i = function() {
        return {
            hangul: {
                cho: ["ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"],
                jung: ["ㅏ", "ㅐ", "ㅑ", "ㅒ", "ㅓ", "ㅔ", "ㅕ", "ㅖ", "ㅗ", "ㅘ", "ㅙ", "ㅚ", "ㅛ", "ㅜ", "ㅝ", "ㅞ", "ㅟ", "ㅠ", "ㅡ", "ㅢ", "ㅣ"],
                jong: ["", "ㄱ", "ㄲ", "ㄳ", "ㄴ", "ㄵ", "ㄶ", "ㄷ", "ㄹ", "ㄺ", "ㄻ", "ㄼ", "ㄽ", "ㄾ", "ㄿ", "ㅀ", "ㅁ", "ㅂ", "ㅄ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"]
            },
            unicode: function(m) {
                var l = [];
                for(var k = 0; k < m.length; k++) {
                    l[k] = m.substr(k, 1).charCodeAt(0)
                }
                return l
            },
            trans: function(q) {
                var p;
                var k;
                var s;
                var t;
                var m = q.length;
                var r = [];
                var l = [];
                var n = [];
                for(var o = 0; o < m; o++) {
                    t = q.charCodeAt(o);
                    if(t === 32) {
                        continue
                    }
                    if(t < 44032 || t > 55203) {
                        r.push(q.charAt(o));
                        l.push(q.charAt(o));
                        n.push(q.charAt(o));
                        continue
                    }
                    t = q.charCodeAt(o) - 44032;
                    s = t % 28;
                    k = (t - s) / 28 % 21;
                    p = ((t - s) / 28 - k) / 21;
                    r.push(this.hangul.cho[p], this.hangul.jung[k]);
                    n.push(String.fromCharCode(q.charCodeAt(o) - s));
                    l.push(this.hangul.cho[p]);
                    if(this.hangul.jong[s] !== "") {
                        r.push(this.hangul.jong[s])
                    }
                }
                return this.checkChoSung ? l : r
            },
            transCho: function(r) {
                var p;
                var k;
                var m;
                var l;
                var o = r.length;
                var q = [];
                for(var n = 0; n < o; n++) {
                    l = r.charCodeAt(n);
                    if(l === 32) {
                        continue
                    }
                    if(l < 44032 || l > 55203) {
                        q.push(r.charAt(n));
                        continue
                    }
                    l = r.charCodeAt(n) - 44032;
                    m = l % 28;
                    k = (l - m) / 28 % 21;
                    p = ((l - m) / 28 - k) / 21;
                    q.push(this.hangul.cho[p])
                }
                return q
            },
            compare: function(n, m) {
                var q = m.length;
                var p = this.transCho(n).join("");
                var k = p.indexOf(this.inWordTrans.join(""));
                if(k >= 0) {
                    for(var o = 0; o < q; o++) {
                        var l = this.trans(m.substr(o, 1)).join("");
                        if(this.trans(n.substr(k + o, 1)).join("").indexOf(l) === -1) {
                            return false
                        }
                    }
                    return k
                }
                return false
            },
            getHangulList: function(p, m, n) {
                var w = p,
                    s = p.length,
                    q = true,
                    o = 0,
                    t = [];
                if(p.constructor === Object) {
                    q = false;
                    w = Object.keys(p);
                    s = w.length
                }
                m = m.alltrim().toUpperCase();
                this.inWordTrans = this.transCho(m);
                for(var r = 0; r < s; r++) {
                    var v = (q === true) ? w[r] : p[w[r]];
                    var u = -1;
                    var l = this.compare(v.N.alltrim().toUpperCase(), m);
                    u = l;
                    if(l === false && v.S !== undefined && v.S.isEmpty() === false) {
                        l = this.compare(v.S.alltrim().toUpperCase(), m)
                    }
                    if(l !== false) {
                        t[o++] = Object.assign({}, v, {
                            matchIndex: u,
                            idx: r
                        });
                        if(n !== undefined && n !== "" && t.length >= n) {
                            break
                        }
                    }
                }
                return t
            }
        }
    };
    var c = function(l) {
        var k = l.className.split(" ");
        var m = "g_hidden";
        if(k.indexOf(m) === -1) {
            l.className += " " + m
        }
    };
    var h = function(k) {
        k.className = k.className.replace(/ g_hidden/g, "")
    };
    var g = function(k, o) {
        var v = {};
        var n = {};
        var r = {};
        var p = {
            game: {
                view: true
            },
            server: {
                view: true
            }
        };
        o = f(p, o);
        f(this, o);
        v = f(v, o.game);
        n = f(n, o.server);
        r = f(r, o.goods);
        var l = this;
        if(k === null || k.length < 1) {
            return
        }
        if(k.length > 1) {
            var t = [];
            l.container.each(function() {
                t.push(new g(this, o))
            });
            return t
        }
        l.container = k;
        if(k.length === 1) {
            l.container = k[0]
        }
        l.container.gameserver = l;
        a(l.container).data("gameserver", l);
        l.searchState = false;
        if(typeof(l.containerWrapper) === "string") {
            l.containerWrapper = document.querySelector(l.containerWrapper)
        } else {
            if(String(l.containerWrapper).indexOf("object Object") !== -1) {
                l.containerWrapper = l.containerWrapper[0]
            }
        }
        if(typeof(l.toggleContainer) === "string") {
            l.toggleContainer = document.querySelector(l.toggleContainer)
        } else {
            if(String(l.toggleContainer).indexOf("object Object") !== -1) {
                l.toggleContainer = l.toggleContainer[0]
            }
        }
        if(typeof(l.formElement) === "string") {
            l.formElement = document.querySelector(l.formElement)
        } else {
            if(String(l.formElement).indexOf("object Object") !== -1) {
                l.formElement = l.formElement[0]
            }
        }
        if(l.formElement === null || l.formElement === undefined) {
            l.formElement = document
        }
        if(l.toggleContainer !== undefined) {
            l.createBeginComponent()
        }
        var u = new d(l.container, v);
        u.gameserver = this;
        l.gameList = u;
        if(n.use === true) {
            var s = new b(l.container, n);
            s.gameserver = this;
            l.serverList = s
        }
        if(r.use === true) {
            var q = new e(l.container, r);
            q.gameserver = this;
            l.goodsList = q
        } else {
            if(l.serverList) {
                l.serverList.listWrap.classList.add("server_t")
            }
        }
        if(u.gameCode !== "") {
            l.changeAction = true;
            window.setTimeout(function() {
                u.createList.call(u);
                l.onClose()
            }, 10)
        }
        return this
    };
    g.prototype = {
        createBeginComponent: function() {
            var k = document.getElementsByClassName("searchbar_tab");
            var m = k.length;
            if(m > 0) {
                for(var l = 0; l < m; l++) {
                    k[l].addEventListener("click", function(q) {
                        var s = q.target.getAttribute("data-target");
                        var p = this.nextElementSibling;
                        var r = p.querySelector('[data-content="' + s + '"]');
                        if(r !== null && r.classList.contains("show") === false) {
                            var o = p.getElementsByClassName("show");
                            var n = this.getElementsByClassName("active");
                            if(s === "tab_mygame") {
                                _myService.makeFavoriteList()
                            }
                            if(o[0]) {
                                o[0].classList.remove("show")
                            }
                            if(n[0]) {
                                n[0].classList.remove("active")
                            }
                            r.classList.add("show");
                            if(q.target.tagName.toUpperCase() === "A") {
                                q.target.parentElement.classList.add("active")
                            } else {
                                q.target.classList.add("active")
                            }
                        }
                    })
                }
            }
        },
        setTradeType: function(l) {
            var m = this.formElement || document;
            var k = m.querySelector(this.tradeType.selector);
            if(k !== null) {
                if(this.tradeType.type === "select") {
                    k.querySelector('[value="' + l + '"]').selected = true
                } else {
                    m.querySelector(this.tradeType.selector + '[value="' + l + '"]').checked = true
                }
            }
        },
        onOpen: function(n) {
            var k = this.gameserver || this;
            var l = this;
            if((k.containerWrapper && k.containerWrapper.mode === "open") || l.mode === "open") {
                return
            }
            if(k.focusSetTimeout) {
                window.clearTimeout(k.focusSetTimeout)
            }
            if(k.containerWrapper) {
                k.containerWrapper.mode = "open";
                k.containerWrapper.classList.remove("g_hidden");
                if(k.gameList.autoComplete !== false) {
                    k.focusSetTimeout = setTimeout(function() {
                        k.gameList.getData()
                    });
                    if(k.toggleContainer && k.container.className.indexOf("g_hidden") === -1 && k.gameList.autoCompleteEl.value.isEmpty() === true) {
                        k.container.mode = "close";
                        c(k.container);
                        if(k.toggleContainer) {
                            h(k.toggleContainer)
                        }
                    }
                }
                if(k.toggleContainer !== undefined) {
                    if(_myService.lastSearchHandler !== true) {
                        _myService.makeLastSearch()
                    }
                }
            } else {
                l.mode = "open";
                h(l.listWrap)
            }
            l.tmpBlur = function(m) {
                l.onBlur.call(l, m)
            };
            document.addEventListener("click", l.tmpBlur)
        },
        onClose: function(q, n) {
            var k = this.gameserver || this;
            var p = this;
            if((k.containerWrapper && k.containerWrapper.mode === "close") || p.mode === "close") {
                return
            }
            if(k.onCustomCloseBefore) {
                var l = k.onCustomCloseBefore.call(k, q);
                if(l === false) {
                    return
                }
            }
            if(k.containerWrapper) {
                k.containerWrapper.mode = "close";
                k.containerWrapper.classList.add("g_hidden")
            } else {
                p.mode = "close";
                c(p.listWrap)
            }
            document.removeEventListener("click", k.tmpBlur);
            if(n === "blur") {
                if(k.blurSetTimeout) {
                    window.clearTimeout(k.blurSetTimeout)
                }
                if(k.gameserver && k.gameserver.blurAction === true) {
                    k.gameserver.blurAction = false;
                    k.gameserver.changeAction = true;
                    if(k.gameserver && k.gameserver.gameList) {
                        if(k.gameserver.gameList.selectedData) {
                            if(k.gameserver.serverList) {
                                c(k.gameserver.serverList.listWrap)
                            }
                            if(k.gameserver.goodsList) {
                                c(k.gameserver.goodsList.listWrap)
                            }
                            k.blurSetTimeout = setTimeout(function() {
                                k.gameserver.gameList.gameCode = k.gameserver.gameList.selectedData.C;
                                k.gameserver.gameList.createList()
                            }, 1)
                        }
                    }
                }
                if(k.gameserver && k.gameserver.gameList.autoComplete !== false) {
                    if(k.gameserver && k.gameserver.viewValue && k.gameserver.viewValue !== k.gameserver.gameList.autoCompleteEl.value) {
                        k.gameserver.gameList.autoCompleteEl.value = k.gameserver.viewValue;
                        k.gameserver.gameList.autoCompleteEl.classList.remove("placeholder")
                    }
                    var o;
                    var r = k.gameserver.position;
                    if(r === "game") {
                        o = k.gameserver.gameList
                    } else {
                        if(r === "server") {
                            o = k.gameserver.serverList
                        } else {
                            if(r === "goods") {
                                o = k.gameserver.goodsList
                            }
                        }
                    }
                    if(o && o.selectedIndex && o.list.children[o.selectedIndex]) {
                        o.list.children[o.selectedIndex].classList.remove("focus");
                        delete o.selectedIndex
                    }
                }
            }
        },
        onBlur: function(o) {
            var n = this.listWrap;
            if(this.gameserver && this.gameserver.containerWrapper) {
                n = this.gameserver.containerWrapper
            }
            f(n, _gui);
            var l = _event.pointer(o);
            var m = n.getBound();
            if(this.autoComplete !== false) {
                f(this.autoCompleteEl.parentElement, _gui);
                var k = this.autoCompleteEl.parentElement.getBound();
                if(l.x >= k.x && l.x <= (k.x + k.offsetWidth) && l.y >= k.y && l.y <= (k.y + k.offsetHeight)) {
                    return
                }
            }
            if(l.x >= m.x && l.x <= (m.x + m.offsetWidth) && l.y >= m.y && l.y <= (m.y + m.offsetHeight)) {
                return
            }
            this.onClose(o, "blur")
        },
        getValue: function() {
            var l = {};
            var k = (this.gameserver && this.gameserver.formElement) ? this.gameserver.formElement : document;
            if(this.hidden_use.code) {
                l.code = k.querySelector(this.hidden_use.code).value
            }
            if(this.hidden_use.text) {
                l.text = k.querySelector(this.hidden_use.text).value
            }
            return l
        },
        setValue: function(k, p) {
            var l = this;
            var t = (l.gameserver && l.gameserver.formElement) ? l.gameserver.formElement : document;
            if(k !== undefined && l.hidden_use.code) {
                t.querySelector(l.hidden_use.code).value = k
            }
            if(p !== undefined && l.hidden_use.text) {
                t.querySelector(l.hidden_use.text).value = p
            }
            if(k === "" && p === "") {
                if(l.selected) {
                    l.selected.classList.remove("sel_on");
                    delete l.selected
                }
                if(l.selectedData) {
                    delete l.selectedData
                }
                if(l.type === "game" && l.gameserver && l.gameserver.gameList && l.gameserver.gameList.autoCompleteEl) {
                    l.searchText = "";
                    l.gameserver.viewValue = "";
                    l.gameserver.gameList.autoCompleteEl.value = ""
                }
                return
            }
            if(l.type === "game") {
                l.gameCode = k;
                if(_gamedata.json === null) {
                    l.getData(function() {
                        l.setValue(k, p)
                    });
                    return
                } else {
                    if(l.data === null) {
                        l.data = _gamedata.json
                    }
                }
            } else {
                if(l.type === "server") {
                    var u = "";
                    if(l.gameserver && l.gameserver.gameList) {
                        u = l.gameserver.gameList.getValue().code
                    }
                    if(u.isEmpty() === true) {
                        l.setValue("", "");
                        return
                    }
                    if(String(u) !== String(l.gameCode)) {
                        delete l.selected;
                        l.gameCode = u;
                        l.getData(function() {
                            l.setValue(k, p)
                        });
                        return
                    }
                } else {
                    if(l.type === "goods") {
                        var n = "";
                        if(l.gameserver && l.gameserver.serverList) {
                            n = l.gameserver.serverList.getValue().code
                        }
                        if(n.isEmpty() === true) {
                            l.setValue("", "");
                            return
                        }
                    }
                }
            }
            var r = l.data;
            var q = r.length;
            var s;
            for(var o = 0; o < q; o++) {
                if(String(r[o].C) === String(k)) {
                    s = Object.assign({}, r[o], {
                        idx: o
                    });
                    l.gameserver.blurAction = true;
                    break
                }
            }
            l.selectedData = s;
            if(l.selectedData === undefined) {
                l.setValue("", "")
            }
        }
    };
    var d = function(l, p) {
        if(l === null || l.length < 1) {
            return
        }
        f(this, p);
        var k = this;
        k.type = "game";
        k.searchText = "";
        l.gameList = this;
        k.suggest = new i();
        k.listWrap = document.createElement("div");
        k.listWrap.className = "game g_hidden";
        k.list = document.createElement("ul");
        l.appendChild(k.listWrap);
        k.listWrap.appendChild(k.list);
        k.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
        var n = (l.gameserver && l.gameserver.formElement) ? l.gameserver.formElement : document;
        if(k.hidden_use && k.hidden_use.code.isEmpty() === false && n.querySelector(k.hidden_use.code).value.isEmpty() === false) {
            k.gameCode = n.querySelector(k.hidden_use.code).value
        }
        if(k.autoComplete !== null || k.autoComplete !== false) {
            k.autoCompleteEl = k.autoComplete;
            if(typeof(k.autoComplete) === "string") {
                k.autoCompleteEl = n.querySelector(k.autoComplete)
            }
            var o = document.createElement("a");
            o.href = "javascript:;";
            o.classList.add("delete_btn");
            o.addEventListener("click", function() {
                k.autoCompleteEl.value = "";
                k.searchText = "";
                k.setValue("", "");
                if(k.onCustomChange) {
                    k.onCustomChange.call(k)
                }
                if(k.gameserver) {
                    k.gameserver.viewValue = "";
                    if(k.gameserver.serverList) {
                        k.gameserver.serverList.setValue("", "");
                        if(k.gameserver.serverList.onCustomChange) {
                            k.gameserver.serverList.onCustomChange.call(k.gameserver.serverList)
                        }
                    }
                    if(k.gameserver.goodsList) {
                        k.gameserver.goodsList.setValue("", "");
                        if(k.gameserver.goodsList.onCustomChange) {
                            k.gameserver.goodsList.onCustomChange.call(k.gameserver.goodsList)
                        }
                    }
                }
                var m = document.createEvent("HTMLEvents");
                m.initEvent("keyup", false, true);
                k.autoCompleteEl.dispatchEvent(m);
                k.autoCompleteEl.focus()
            });
            if(k.autoCompleteEl.nextElementSibling) {
                k.autoCompleteEl.parentElement.insertBefore(o, k.autoCompleteEl.nextElementSibling)
            } else {
                k.autoCompleteEl.parentElement.appendChild(o)
            }
            k.setKeyEvent()
        }
    };
    d.prototype = {
        autoComplete: "#searchGameServer",
        allView: false,
        view: false,
        data: null,
        request: true,
        gameCode: "",
        gameText: "",
        searchCount: 50,
        notGames: [45, 216, 512],
        hidden_use: {
            code: '[name="search_game"]',
            text: '[name="search_game_text"]'
        },
        getData: function(l) {
            var k = this;
            if(_gamedata.json === null && _serverdata.json === null && _gamedata.state === null) {
                _gamedata.state = false;
                ajaxRequest({
                    url: "/api/json/gameserverlist.json",
                    dataType: "json",
                    cache: false,
                    success: function(o) {
                        if(o === null) {
                            return
                        }
                        var p = o.gamelist,
                            q = {},
                            m = p.length,
                            n;
                        for(n = 0; n < m; n++) {
                            q[p[n].C] = p[n]
                        }
                        _gamedata.json = p;
                        _gamedata.searchJSON = q;
                        _gamedata.state = true;
                        _serverdata.json = o.serverlist;
                        k.data = _gamedata.json;
                        if(l) {
                            l.call(k)
                        }
                    }
                })
            } else {
                if(_gamedata.json === null || _serverdata.json === null) {
                    setTimeout(function() {
                        k.getData.call(k, l)
                    })
                } else {
                    if(l) {
                        l.call(k)
                    }
                }
            }
        },
        createList: function(s) {
            if(s === undefined) {
                if(_gamedata.json === null) {
                    this.getData(this.createList);
                    return
                } else {
                    s = _gamedata.json
                }
            }
            var n = this;
            var r = s.length;
            var w = document.createDocumentFragment();
            var l = n.autoCompleteEl.value;
            var q = l.length;
            var o;
            if(n.hidden_use) {
                var u = (n.gameserver && n.gameserver.formElement) ? n.gameserver.formElement : document;
                if(n.hidden_use.code) {
                    u.querySelector(n.hidden_use.code).value = ""
                }
                if(n.hidden_use.text) {
                    u.querySelector(n.hidden_use.text).value = ""
                }
            }
            n.list.innerHTML = "";
            for(var p = 0; p < r; p++) {
                if((String(n.gameCode) !== "" && String(n.gameCode) !== String(s[p].C)) || (String(n.gameText.alltrim()) !== "" && String(n.gameText.alltrim()) !== String(s[p].N.alltrim()))) {
                    continue
                }
                if(n.gameCode !== "" || n.gameText.alltrim() !== "") {
                    q = 0;
                    s[p].matchIndex = -1
                }
                var k = document.createElement("li");
                var v = s[p].N.alltrim();
                var t = s[p].matchIndex;
                if(q > 0 && t >= 0) {
                    var x = "";
                    if(t > 0) {
                        x += v.substr(0, t)
                    }
                    x += ("<span>" + v.substr(t, q) + "</span>" + v.substr(t + q));
                    v = x
                }
                k.innerHTML = v;
                k.addEventListener("click", function(m) {
                    n.gameserver.searchState = false;
                    n.onChange.call(n, this, m)
                });
                a.data(k, Object.assign({}, s[p], {
                    idx: p
                }));
                w.appendChild(k);
                if((n.gameCode !== "" && String(n.gameCode) === String(s[p].C)) || (String(n.gameText.alltrim()) !== "" && String(n.gameText.alltrim()) === String(s[p].N.alltrim()))) {
                    o = k;
                    n.gameCode = "";
                    n.gameText = "";
                    break
                }
                if(o === undefined && n.selectedData) {
                    if(n.selectedData.C === s[p].C && n.selectedData.L === s[p].L) {
                        o = k
                    }
                }
            }
            n.list.appendChild(w);
            if(n.listWrap.className.indexOf("g_hidden") !== -1 && n.view !== false) {
                h(n.listWrap)
            }
            if(o) {
                if(n.gameserver.changeAction === true) {
                    if(n.gameserver.container.className.indexOf("g_hidden") !== -1 && n.view !== false) {
                        n.gameserver.container.mode = "open";
                        h(n.gameserver.container);
                        if(n.gameserver.toggleContainer) {
                            c(n.gameserver.toggleContainer)
                        }
                    }
                    n.onChange(o)
                }
            }
        },
        onChange: function(o, p) {
            var k = this;
            if(String(o).toLowerCase().indexOf("element") !== -1) {
                var l = a.data(o)
            } else {
                var l = o
            }
            if(k.selected) {
                if(String(l.C) === String(k.getValue().code)) {
                    return
                }
                k.selected.classList.remove("sel_on")
            }
            if(String(o).toLowerCase().indexOf("element") !== -1) {
                k.selected = o;
                o.classList.add("sel_on")
            }
            k.gameserver.searchState = false;
            k.gameserver.container.classList.add("gs_selection");
            k.selectedData = l;
            if(k.autoComplete !== false) {
                k.gameserver.blurAction = false;
                if(k.gameserver) {
                    k.gameserver.viewValue = k.selectedData.N
                }
                k.autoCompleteEl.value = k.gameserver.viewValue;
                k.autoCompleteEl.classList.remove("placeholder");
                if(k.selectedIndex && k.list.children[k.selectedIndex]) {
                    k.list.children[k.selectedIndex].classList.remove("focus")
                }
            }
            if(k.hidden_use) {
                var n = (k.gameserver && k.gameserver.formElement) ? k.gameserver.formElement : document;
                if(k.hidden_use.code) {
                    n.querySelector(k.hidden_use.code).value = k.selectedData.C
                }
                if(k.hidden_use.text) {
                    n.querySelector(k.hidden_use.text).value = k.selectedData.N
                }
            }
            if(k.gameserver === undefined) {
                c(k.listWrap)
            } else {
                delete k.selectedIndex;
                if(k.gameserver.serverList) {
                    k.gameserver.position = "server";
                    delete k.gameserver.serverList.selectedIndex;
                    if(p) {
                        k.gameserver.changeAction = true;
                        k.gameserver.serverList.setValue("", "")
                    }
                    if(k.gameserver.serverList.request === true) {
                        if(k.gameserver.serverList.gameCode != k.selectedData.C) {
                            k.gameserver.serverList.gameCode = k.selectedData.C;
                            k.gameserver.serverList.data = null
                        }
                    }
                    k.gameserver.serverList.list.scrollTop = 0;
                    k.gameserver.serverList.view = true;
                    k.gameserver.serverList.createList()
                }
                if(k.gameserver.goodsList) {
                    delete k.gameserver.goodsList.selectedIndex;
                    if(p) {
                        k.gameserver.goodsList.setValue("", "")
                    }
                    if(k.selectedData.CV.toUpperCase() === "Y") {
                        k.gameserver.goodsList.data[3].V = true
                    } else {
                        k.gameserver.goodsList.data[3].V = false
                    }
                    if(k.notGames.indexOf(Number(k.selectedData.C)) !== -1) {
                        k.gameserver.goodsList.exceptCode = ["all", "money", "item"]
                    } else {
                        k.gameserver.goodsList.exceptCode = [];
                        k.gameserver.goodsList.data[1].N = k.selectedData.U
                    }
                    k.gameserver.goodsList.createList()
                }
            }
            if(k.onCustomChange) {
                k.onCustomChange.call(k, o, p)
            }
            if(k.gameserver.serverList === undefined && k.onAction) {
                k.onAction.call(k, o, p)
            }
        },
        setKeyEvent: function() {
            var k = this;
            if(k.useKeyboard !== false) {
                document.body.addEventListener("keydown", function(l) {
                    k.onKeydown.call(l.target, k, l)
                })
            }
            k.autoCompleteEl.addEventListener("keyup", function(l) {
                k.onKeyup.call(this, k, l)
            });
            k.autoCompleteEl.addEventListener("click", function(l) {
                k.onFocus.call(this, k)
            })
        },
        onKeydown: function(p, x) {
            if(p.gameserver === undefined) {
                return
            }
            if(p.mode !== "open" && (p.gameserver && (p.gameserver.containerWrapper.mode !== "open" || p.gameserver.container.mode !== "open"))) {
                return
            }
            var u = _event.keycode(x);
            if(u !== _event.KEY_RETURN && u !== _event.KEY_DOWN && u !== _event.KEY_UP && u !== _event.KEY_LEFT && u !== _event.KEY_RIGHT) {
                return
            }
            if(u == _event.KEY_LEFT || u == _event.KEY_RIGHT) {
                this.blur()
            }
            if(p.gameserver.position === undefined) {
                if(p.gameserver.searchState === true) {
                    p.gameserver.position = "game";
                    delete p.gameserver.gameList.selectedIndex
                } else {
                    if(p.gameserver.goodsList && p.gameserver.goodsList.listWrap.classList.contains("g_hidden") === false && p.gameserver.serverList.selected) {
                        p.gameserver.position = "goods";
                        delete p.gameserver.goodsList.selectedIndex
                    } else {
                        if(p.gameserver.serverList && p.gameserver.serverList.list.children.length > 0 && p.gameserver.gameList.selected) {
                            p.gameserver.position = "server";
                            delete p.gameserver.serverList.selectedIndex
                        } else {
                            return
                        }
                    }
                }
            }
            var A;
            if(p.gameserver.position === "game") {
                A = p.gameserver.gameList
            } else {
                if(p.gameserver.position === "server") {
                    A = p.gameserver.serverList
                } else {
                    if(p.gameserver.position === "goods") {
                        A = p.gameserver.goodsList
                    }
                }
            }
            p.gameserver.returnKey = false;
            var y = A.list;
            var o = y.children;
            var r = A.selectedIndex;
            if(p.gameserver.searchState === false && r == undefined && A.selected) {
                r = Array.prototype.indexOf.call(o, A.selected)
            }
            if(u == _event.KEY_RETURN || (u == _event.KEY_RIGHT && (p.gameserver.position !== "server" || (p.gameserver.position === "server" && (p.gameserver.goodsList !== undefined || p.gameserver.searchState === true))))) {
                this.blur();
                _event.stop(x);
                if(p.gameserver.position === "game") {
                    if(r === undefined || r === -1) {
                        var w = o.length;
                        var v = this.value.alltrim().toUpperCase();
                        for(var t = 0; t < w; t++) {
                            var z = a.data(o[t]);
                            if(z.N.alltrim().toUpperCase() === v) {
                                r = t;
                                break
                            }
                        }
                    }
                    if(p.gameserver.serverList !== undefined) {
                        p.gameserver.position = "server";
                        p.gameserver.serverList.selectedIndex = 0
                    }
                } else {
                    if(p.gameserver.position === "server" && p.gameserver.goodsList !== undefined) {
                        p.gameserver.position = "goods";
                        p.gameserver.goodsList.selectedIndex = 0;
                        if(p.gameserver.serverList !== undefined) {
                            A = p.gameserver.serverList
                        }
                    }
                }
                if(r === undefined || r === -1) {
                    r = 0
                }
                A.selectedIndex = r;
                var n = o[A.selectedIndex];
                n.classList.add("focus");
                if(A.selected !== undefined) {
                    A.selected.classList.remove("focus")
                }
                p.gameserver.returnKey = true;
                A.onChange(n, x)
            } else {
                if(u == _event.KEY_UP || u == _event.KEY_DOWN || u == _event.KEY_LEFT || u == _event.KEY_RIGHT) {
                    _event.stop(x);
                    if((u == _event.KEY_LEFT || u == _event.KEY_RIGHT) && A.updownIndex === undefined) {
                        return
                    }
                    var s = (A.updownIndex === undefined) ? 1 : A.updownIndex;
                    var q = o.length - 1;
                    var k = {
                        offset: -(54 + (o[0].clientHeight * 3))
                    };
                    var l;
                    switch(u) {
                        case _event.KEY_DOWN:
                            if(p.gameserver.searchState === true) {
                                k.index = 1
                            } else {
                                k.index = s
                            }
                            break;
                        case _event.KEY_UP:
                            if(p.gameserver.searchState === true) {
                                k.index = -1
                            } else {
                                k.index = -(s)
                            }
                            break;
                        case _event.KEY_LEFT:
                            k.index = -1;
                            break;
                        case _event.KEY_RIGHT:
                            k.index = 1;
                            break
                    }
                    if(r == undefined) {
                        r = 0
                    } else {
                        l = o[r];
                        r += k.index
                    }
                    if(r < 0 || r > q) {
                        if(p.gameserver.searchState === true) {
                            if(p.gameserver.position === "game" && u == _event.KEY_DOWN && r > q && p.gameserver.serverList.list.children.length > 0) {
                                p.gameserver.position = "server";
                                A = p.gameserver.serverList;
                                o = A.list.children;
                                r = 0
                            } else {
                                if(p.gameserver.position === "server" && u == _event.KEY_UP && r < 0 && p.gameserver.gameList.list.children.length > 0) {
                                    p.gameserver.position = "game";
                                    A = p.gameserver.gameList;
                                    o = A.list.children;
                                    r = o.length - 1
                                } else {
                                    return
                                }
                            }
                        } else {
                            return
                        }
                    }
                    if(l) {
                        l.classList.remove("focus")
                    }
                    A.selectedIndex = r;
                    l = o[A.selectedIndex];
                    l.classList.add("focus");
                    A.list.scrollTop = (l.offsetTop - A.list.offsetTop) + k.offset
                }
            }
        },
        onKeyup: function(k, n) {
            var l = _event.keycode(n);
            if(l == _event.KEY_RETURN || l == _event.KEY_DOWN || l == _event.KEY_UP || l == _event.KEY_LEFT || l == _event.KEY_RIGHT) {
                return
            }
            k.onOpen();
            if(k.keyuupEventQueue) {
                window.clearTimeout(k.keyuupEventQueue)
            }
            k.view = true;
            k.gameserver.changeAction = false;
            k.gameserver.blurAction = true;
            if(this.value.isEmpty() === true) {
                k.gameserver.container.classList.add("game_empty");
                k.list.innerHTML = '<li class="search_ing">검색 결과가 없습니다.</li>';
                k.searchText = "";
                if(k.gameserver.serverList) {
                    k.gameserver.serverList.list.innerHTML = "";
                    c(k.gameserver.serverList.listWrap)
                }
                if(k.gameserver.goodsList) {
                    c(k.gameserver.goodsList.listWrap)
                }
                if(k.gameserver.toggleContainer && k.gameserver.container.className.indexOf("g_hidden") === -1) {
                    k.gameserver.container.mode = "close";
                    c(k.gameserver.container);
                    if(k.gameserver.toggleContainer) {
                        h(k.gameserver.toggleContainer)
                    }
                }
                return
            }
            if(k.searchText !== this.value) {
                delete k.gameserver.position;
                delete k.selectedIndex;
                if(k.gameserver.searchState === false) {
                    k.gameserver.searchState = true;
                    k.gameserver.container.classList.remove("gs_selection")
                }
                if(k.gameserver.toggleContainer && k.gameserver.container.className.indexOf("g_hidden") !== -1) {
                    k.gameserver.container.mode = "open";
                    h(k.gameserver.container);
                    if(k.gameserver.toggleContainer) {
                        c(k.gameserver.toggleContainer)
                    }
                }
                k.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                if(k.gameserver.serverList) {
                    k.gameserver.serverList.list.innerHTML = ""
                }
                if(k.gameserver.goodsList) {
                    c(k.gameserver.goodsList.listWrap)
                }
                var o = this.value.alltrim().toUpperCase();
                k.keyuupEventQueue = window.setTimeout(function() {
                    if(k.gameserver.serverList && _serverdata.json === null) {
                        k.getData(function() {
                            k.onKeyup.call(k.autoCompleteEl, k, n)
                        });
                        return
                    }
                    k.searchText = o;
                    k.gameserver.container.classList.remove("game_empty");
                    if(k.gameserver.serverList) {
                        delete k.gameserver.serverList.selectedIndex;
                        delete k.gameserver.serverList.selected;
                        k.gameserver.serverList.view = true;
                        var p = k.suggest.getHangulList(_serverdata.json, o, k.gameserver.serverList.searchCount);
                        if(p.length > 0) {
                            k.gameserver.serverList.createList(p, true);
                            k.gameserver.serverList.list.scrollTop = 0
                        } else {
                            c(k.gameserver.serverList.listWrap)
                        }
                    }
                    if(k.gameserver.goodsList) {
                        k.gameserver.goodsList.view = true;
                        delete k.gameserver.goodsList.selectedIndex;
                        delete k.gameserver.goodsList.selected
                    }
                    var m = k.suggest.getHangulList(_gamedata.json, o, k.searchCount);
                    if(p.length < 1 && m.length < 1) {
                        k.list.innerHTML = '<li class="search_ing">검색 결과가 없습니다.</li>';
                        return
                    }
                    if(p.length < 1 || m.length < 1) {
                        k.gameserver.container.classList.add("game_empty")
                    }
                    if(m.length < 1) {
                        c(k.listWrap)
                    } else {
                        h(k.listWrap);
                        k.createList(m)
                    }
                }, 1)
            }
        },
        onFocus: function(k) {
            if(k.gameserver) {
                k.gameserver.changeAction = false
            }
            k.onOpen();
            if(k.selected) {
                k.selectedIndex = Array.prototype.indexOf.call(k.list.children, k.selected)
            } else {
                k.list.scrollTop = 0
            }
            if(k.gameserver.serverList) {
                if(k.gameserver.serverList.selected) {
                    var l = k.gameserver.serverList.selected.offsetTop - (k.gameserver.serverList.list.offsetHeight / 2)
                } else {
                    var l = 0
                }
                k.gameserver.serverList.list.scrollTop = l
            }
        }
    };
    f(d.prototype, g.prototype);
    var b = function(k, m) {
        if(k === null || k.length < 1) {
            return
        }
        f(this, m);
        this.type = "server";
        k.serverList = this;
        this.suggest = new i();
        this.listWrap = document.createElement("div");
        this.listWrap.className = "server g_hidden";
        this.list = document.createElement("ul");
        k.appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);
        if(this.hidden_use) {
            var l = (k.gameserver && k.gameserver.formElement) ? k.gameserver.formElement : document;
            if(this.hidden_use.code != "" && l.querySelector(this.hidden_use.code).value.isEmpty() === false) {
                this.serverCode = l.querySelector(this.hidden_use.code).value
            }
            if(this.hidden_use.text != "" && l.querySelector(this.hidden_use.text).value.isEmpty() === false) {
                this.serverText = l.querySelector(this.hidden_use.text).value;
                if(this.serverText === "서버전체") {
                    this.serverCode = "0"
                }
            }
        }
        if(this.gameCode === "") {
            return
        }
        if(this.autoComplete !== null && this.autoComplete !== false) {
            this.autoCompleteEl = this.autoComplete;
            if(typeof(this.autoComplete) === "string") {
                this.autoCompleteEl = document.querySelector(this.autoComplete)
            }
            this.listWrap.classList.add("gs_list_wrap");
            this.setKeyEvent()
        }
        if(this.selected) {
            this.selected.classList.add("sel_on")
        }
    };
    b.prototype = {
        autoComplete: false,
        view: false,
        data: null,
        request: true,
        allView: true,
        gameCode: "",
        serverCode: "",
        serverText: "",
        searchCount: 50,
        exceptCode: [],
        hidden_use: {
            code: '[name="search_server"]',
            text: '[name="search_server_text"]'
        },
        getData: function(q) {
            var n = this;
            if(n.gameCode === "") {
                alert("게임을 선택해주세요.");
                return
            }
            var o = _serverdata.json;
            if(o === null) {
                setTimeout(function() {
                    n.getData(q)
                });
                return
            }
            var l = o.length;
            var k = [];
            if(n.allView === true) {
                k.push({
                    BG: 0,
                    C: "0",
                    N: "서버전체"
                })
            }
            for(var p = 0; p < l; p++) {
                if(String(o[p].GC) === String(n.gameCode)) {
                    k.push(o[p])
                }
            }
            k.sort(function(r, m) {
                if(Number(r.BG) < Number(m.BG)) {
                    return -1
                }
                if(Number(r.BG) > Number(m.BG)) {
                    return 1
                }
                return 0
            });
            n.data = JSON.parse(JSON.stringify(k));
            if(q) {
                q.call(n, n.data)
            }
        },
        createList: function(u) {
            if(u === undefined) {
                if(this.data === null) {
                    this.getData(this.createList);
                    return
                } else {
                    u = this.data
                }
            }
            if(u.length < 1) {
                console.log("server_not_data");
                return
            }
            var o = this;
            var t = u.length;
            var z = document.createDocumentFragment();
            var l = (o.gameserver && o.gameserver.gameList.autoComplete) ? document.querySelector(o.gameserver.gameList.autoComplete).value : "";
            var s = l.length || 0;
            var p;
            if(o.hidden_use) {
                var w = (o.gameserver && o.gameserver.formElement) ? o.gameserver.formElement : document;
                if(o.hidden_use.code) {
                    w.querySelector(o.hidden_use.code).value = ""
                }
                if(o.hidden_use.text) {
                    w.querySelector(o.hidden_use.text).value = ""
                }
            }
            o.list.innerHTML = "";
            for(var r = 0; r < t; r++) {
                if(o.exceptCode.indexOf(u[r].C) === -1) {
                    var k = document.createElement("li");
                    var y = u[r].N;
                    var v = u[r].matchIndex;
                    var x = r;
                    if(s > 0 && v >= 0) {
                        var A = "";
                        if(v > 0) {
                            A += y.substr(0, v)
                        }
                        A += ("<span>" + y.substr(v, s) + "</span>" + y.substr(v + s));
                        y = A
                    }
                    if(o.gameserver && o.gameserver.searchState === true) {
                        var q = _gamedata.searchJSON[u[r].GC];
                        y = q.N + " > " + y
                    }
                    k.innerHTML = y;
                    k.addEventListener("click", function(m) {
                        o.onChange.call(o, this, m)
                    });
                    a.data(k, Object.assign({}, u[r], {
                        idx: x
                    }));
                    z.appendChild(k);
                    if(o.serverCode !== "" && (String(o.serverCode) === String(u[r].C) || o.serverText.alltrim() === u[r].N.alltrim())) {
                        p = k;
                        o.serverCode = "";
                        o.serverText = ""
                    }
                    if(p === undefined && o.selectedData && (o.selectedData.C === u[r].C)) {
                        p = k
                    }
                }
            }
            o.list.appendChild(z);
            if(o.listWrap.className.indexOf("g_hidden") !== -1 && o.view !== false) {
                h(o.listWrap)
            }
            if(o.gameserver && o.gameserver.goodsList && o.gameserver.searchState === false) {
                h(o.gameserver.goodsList.listWrap)
            }
            if(o.gameserver && o.gameserver.returnKey === true && o.gameserver.position === "server") {
                o.list.children[0].classList.add("focus")
            }
            if(p === undefined && ((o.allView === true && o.list.childElementCount <= 2) || (o.allView !== true && o.list.childElementCount <= 1))) {
                p = o.list.children[o.list.childElementCount - 1];
                o.selectedIndex = o.list.childElementCount - 1
            }
            if(p) {
                var n = p.offsetTop - (o.list.offsetHeight / 2);
                o.list.scrollTop = n;
                if(o.gameserver && o.gameserver.changeAction === true) {
                    o.onChange(p)
                }
            }
        },
        onChange: function(q, s) {
            var k = this;
            var o = a.data(q);
            if(k.gameserver && k.gameserver.searchState === true) {
                var n = _gamedata.searchJSON[o.GC];
                if(n !== undefined) {
                    k.gameserver.changeAction = true;
                    k.gameserver.gameList.selectedData = n;
                    k.gameserver.gameList.setValue(n.C, n.N);
                    k.gameserver.serverList.setValue(o.C, o.N);
                    if(s && k.gameserver && k.gameserver.goodsList) {
                        if(k.gameserver.goodsList.selected) {
                            k.gameserver.goodsList.selected.classList.remove("sel_on");
                            k.gameserver.goodsList.setValue("", "")
                        }
                    }
                    k.gameserver.gameList.createList([n]);
                    if(k.onAction) {
                        k.onAction.call(k, q, s)
                    }
                }
                return
            }
            if(k.selected) {
                k.selected.classList.remove("sel_on")
            }
            q.classList.add("sel_on");
            k.selected = q;
            k.selectedData = o;
            if(k.autoComplete !== false) {
                k.autoCompleteEl.value = k.selectedData.N
            } else {
                if(k.gameserver.gameList.autoComplete !== false) {
                    var l = k.gameserver.gameList.autoComplete;
                    var r = document.querySelector(l);
                    r.value = k.gameserver.gameList.selectedData.N + " > " + k.selectedData.N;
                    r.classList.remove("placeholder");
                    k.gameserver.viewValue = r.value;
                    if(k.selectedIndex && k.list.children[k.selectedIndex]) {
                        k.list.children[k.selectedIndex].classList.remove("focus")
                    }
                }
            }
            if(k.hidden_use) {
                var p = (k.gameserver && k.gameserver.formElement) ? k.gameserver.formElement : document;
                if(k.hidden_use.code) {
                    p.querySelector(k.hidden_use.code).value = k.selectedData.C
                }
                if(k.hidden_use.text) {
                    p.querySelector(k.hidden_use.text).value = k.selectedData.N
                }
            }
            if((k.mode === "open" || (this.gameserver.containerWrapper && k.gameserver.containerWrapper.mode === "open")) && k.onCustomChange) {
                k.onCustomChange.call(k, q, s)
            }
            if(k.gameserver === undefined) {
                c(k.listWrap)
            } else {
                delete k.gameserver.position
            }
            if(k.onAction) {
                k.onAction.call(k, q, s)
            }
            if(k.gameserver && k.gameserver.returnKey === true && k.gameserver.goodsList) {
                if(k.gameserver.goodsList.list.childElementCount > 0) {
                    k.gameserver.goodsList.list.children[0].classList.add("focus")
                }
            }
            if(s && k.gameserver && k.gameserver.goodsList) {
                if(k.gameserver.goodsList.selected) {
                    k.gameserver.goodsList.selected.classList.remove("sel_on");
                    k.gameserver.goodsList.setValue("", "")
                }
            }
        },
        setKeyEvent: function() {
            var k = this;
            this.autoCompleteEl.addEventListener("keyup", function() {
                if(k.searchText !== this.value) {
                    if(k.keyuupEventQueue) {
                        window.clearTimeout(k.keyuupEventQueue)
                    }
                    if(k.gameserver) {
                        k.gameserver.changeAction = false
                    } else {
                        k.changeAction = false
                    }
                    k.searchText = this.value;
                    k.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                    var l = this.value;
                    k.keyuupEventQueue = window.setTimeout(function() {
                        var m = k.suggest.getHangulList(k.data, l);
                        if(m.length < 1) {
                            k.list.innerHTML = '<li class="search_ing">검색결과가 없습니다.</li>';
                            return
                        }
                        k.createList(m)
                    }, 1)
                }
            });
            this.autoCompleteEl.addEventListener("focus", function() {
                if(k.focusSetTimeout) {
                    window.clearTimeout(k.focusSetTimeout)
                }
                if(k.gameserver) {
                    k.gameserver.changeAction = false
                } else {
                    k.changeAction = false
                }
                k.onOpen();
                k.focusSetTimeout = setTimeout(function() {
                    if(k.data === null) {
                        k.createList()
                    }
                });
                if(k.selected) {
                    var l = k.selected.offsetTop - (k.list.offsetHeight / 2);
                    k.list.scrollTop = l
                }
            })
        }
    };
    f(b.prototype, g.prototype);
    var e = function(k, m) {
        if(k === null || k.length < 1) {
            return
        }
        f(this, m);
        this.type = "goods";
        k.goodsList = this;
        a(k).data("goodsList", this);
        this.listWrap = document.createElement("div");
        this.listWrap.className = "goods g_hidden";
        this.list = document.createElement("ul");
        k.appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);
        var l = (k.gameserver && k.gameserver.formElement) ? k.gameserver.formElement : document;
        if(this.hidden_use && this.hidden_use.code.isEmpty() === false && l.querySelector(this.hidden_use.code).value.isEmpty() === false) {
            this.goodsCode = l.querySelector(this.hidden_use.code).value
        }
        if(this.allView === true) {
            this.data[0].V = true
        }
    };
    e.prototype = {
        view: false,
        allView: false,
        goodsCode: "",
        data: [{
            C: "all",
            N: "물품전체",
            V: false
        }, {
            C: "money",
            N: "게임머니",
            V: true
        }, {
            C: "item",
            N: "아이템",
            V: true
        }, {
            C: "character",
            N: "캐릭터",
            V: false,
            NI: true
        }, {
            C: "etc",
            N: "기타",
            V: true
        }],
        hidden_use: {
            code: '[name="search_goods"]',
            text: ""
        },
        exceptCode: [],
        createList: function() {
            var l = this;
            var s = l.data;
            var k = s.length;
            var r;
            if(l.hidden_use) {
                var q = (l.gameserver && l.gameserver.formElement) ? l.gameserver.formElement : document;
                if(l.hidden_use.code) {
                    q.querySelector(l.hidden_use.code).value = ""
                }
                if(l.hidden_use.text) {
                    q.querySelector(l.hidden_use.text).value = ""
                }
            }
            l.list.innerHTML = "";
            for(var o = 0; o < k; o++) {
                if(l.exceptCode.indexOf(s[o].C) === -1) {
                    if(s[o].V === true) {
                        var n = document.createElement("li");
                        n.innerHTML = s[o].N;
                        n.addEventListener("click", function(m) {
                            l.onChange.call(l, this, m)
                        });
                        if(s[o].NI === true) {
                            var p = document.createElement("span");
                            p.classList.add("icon_new");
                            n.appendChild(p)
                        }
                        a.data(n, Object.assign({}, s[o], {
                            idx: o
                        }));
                        l.list.appendChild(n);
                        if(l.goodsCode !== "" && String(l.goodsCode) === String(s[o].C)) {
                            r = n;
                            l.selectedData = a.data(n);
                            l.goodsCode = ""
                        }
                        if(r === undefined && l.selectedData) {
                            if(l.selectedData.C === s[o].C) {
                                r = n
                            }
                        }
                    }
                }
            }
            if(l.gameserver.returnKey === true && (l.gameserver.position === "goods" || (l.gameserver.position === "server" && l.gameserver.serverList.list.childElementCount < 2))) {
                l.gameserver.position = "goods";
                l.list.children[0].classList.add("focus")
            }
            if(r) {
                l.onChange(r)
            }
        },
        onChange: function(n, p) {
            if(this.gameserver && this.gameserver.serverList && this.gameserver.serverList.getValue().code == "") {
                alert("서버 정보가 없습니다.");
                return
            }
            if(this.selected) {
                this.selected.classList.remove("sel_on")
            }
            n.classList.add("sel_on");
            this.selected = n;
            this.selectedData = a.data(n);
            if(this.gameserver && this.gameserver.gameList && this.gameserver.gameList.autoComplete !== false) {
                var o = this.gameserver.gameList.autoCompleteEl;
                if(this.gameserver.serverList.selectedData) {
                    o.value = this.gameserver.gameList.selectedData.N + " > " + this.gameserver.serverList.selectedData.N + " > " + this.selectedData.N;
                    o.classList.remove("placeholder");
                    this.gameserver.viewValue = o.value
                }
            }
            if(this.hidden_use) {
                var l = (this.gameserver && this.gameserver.formElement) ? this.gameserver.formElement : document;
                if(this.hidden_use.code) {
                    l.querySelector(this.hidden_use.code).value = this.selectedData.C
                }
                if(this.hidden_use.text) {
                    l.querySelector(this.hidden_use.text).value = this.selectedData.N
                }
            }
            if(this.onCustomChange) {
                this.onCustomChange.call(this, n, p)
            }
            if(p !== undefined) {
                var k = this;
                setTimeout(function() {
                    k.onClose()
                }, 100)
            }
        }
    };
    f(e.prototype, g.prototype);
    window.GameList = d;
    window.ServerList = b;
    window.GoodsList = e;
    window.GameServerList = g
})(jQuery);
var _gamedata = {
    xml: null,
    xsl: null,
    json: null,
    searchJSON: null,
    state: null
};
var _serverdata = {
    xml: null,
    xsl: null,
    json: null,
    state: null
};
var _suggest = $.extend({}, _selectbox);
$.extend(_suggest, {
    modeView: "slide",
    view_count: 20,
    widthMargin: 10,
    initialize: function(c) {
        $.extend(this, _gui);
        var a = this;
        var b = $(this).attr("name");
        $(this).addClass("g_selectbox");
        var e = $(this).find("input").eq(0);
        if($(this).onchange !== null) {
            this.OnUpdate = $(this).onchange
        }
        var i = $("<input />", {
            type: "hidden",
            name: b
        });
        this.nodeInput = i.appendTo($(this));
        i = $("<input />", {
            type: "text",
            name: b + "_text"
        }).addClass("g_search_input");
        $(this).removeAttr("name");
        if("OnKeyDown" in this) {
            i.bind("keydown", function(j) {
                a.OnKeyDown(j)
            })
        }
        if("OnKeyUp" in this) {
            i.bind("keyup", function(j) {
                a.OnKeyUp(j)
            })
        }
        if("OnFocus" in this) {
            i.bind("focus", function(j) {
                a.OnFocus(j)
            })
        }
        if("OnBlur" in this) {
            i.bind("blur", function(j) {
                a.OnBlur(j)
            })
        }
        this.nodeSearch = i.appendTo($(this));
        if(_BROWSER.name === "FF") {
            if(typeof(window.instances) === "undefined") {
                window.instances = []
            }
            var h = this;
            this.keyEventCheck = null;
            this.db = null;
            window.instances[this.nodeSearch.attr("name")] = this;
            var d = function() {
                if(!h.keyEventCheck) {
                    h.watchInput()
                }
            };
            var f = function() {
                if(h.keyEventCheck) {
                    window.clearInterval(h.keyEventCheck);
                    h.keyEventCheck = null
                }
            };
            $(this.nodeSearch).bind("focus", d);
            $(this.nodeSearch).bind("blur", f);
            this.watchInput = function() {
                if(this.db !== $(this.nodeSearch).val()) {
                    $(this.nodeSearch).trigger("keyup")
                }
                this.db = $(this.nodeSearch).val();
                if(this.keyEventCheck) {
                    window.clearInterval(this.keyEventCheck)
                }
                this.keyEventCheck = window.setInterval("window.instances['" + this.nodeSearch.attr("name") + "'].watchInput()", 100)
            }
        }
        if(c) {
            this.modeView = "fix";
            this.nodeList = $.extend(c, _gui);
            this.nodeList.addClass("g_selectbox_list");
            this.open = function(j) {
                if("OnOpen" in this) {
                    this.OnOpen(j)
                }
            };
            this.close = function(j) {
                if("OnClose" in this && j !== "default") {
                    this.OnClose()
                }
            }
        } else {
            this.nodeList = $("<DIV />").addClass("g_selectbox_list").appendTo(rootObj);
            this.nodeList.css("overflow", "auto");
            $.extend(this.nodeList, _gui);
            this.nodeButton = $("<div />").addClass("arrow_img").appendTo($(this));
            this.nodeButton.click(function() {
                if(a.mode === "open") {
                    a.close()
                } else {
                    a.open()
                }
            });
            var g = this.getBound();
            this.changeSize(g.width);
            this.close()
        }
        if(this.modeView === "fix" && this.type === "gamelist") {
            if(e && e.attr("name") === "selected" && !e.val().isEmpty() && ("applyDefault" in this)) {
                this.status = {
                    type: "sub",
                    where: e.val(),
                    duplicate: true,
                    selected: e.val()
                }
            }
            this.open()
        } else {
            if("status" in this && $(this).attr("id") !== "g_SEARCHBAR_GAME" && $(this).attr("id") !== "dvGame") {
                this.status = {
                    active: true,
                    type: "all",
                    where: null,
                    duplicate: false
                }
            }
        }
        if(e && e.attr("name") === "selected" && !e.val().isEmpty() && ("applyDefault" in this)) {
            if(this.type === "gamelist") {
                this.applyDefault(e.val())
            }
            this.selectedValue = e.val();
            e.remove()
        } else {
            if(this.type === "gamelist") {
                this.nodeSearch.val("게임검색")
            } else {
                if(this.type === "serverlist") {
                    this.nodeSearch.val("서버검색")
                }
            }
        }
        if(this.type === "serverlist") {
            this.applyDefault()
        }
    },
    changeSize: function(a) {
        var b = this.nodeButton.outerWidth(true);
        $(this).css("width", a + "px");
        this.nodeList.css("width", a + "px");
        this.nodeSearch.css("width", a - b - this.widthMargin + "px")
    },
    addOption: function(d, a, c) {
        var b = $("<div />");
        $(b).text(c);
        if(d === null || this.nodeList.children().length < 1 || this.nodeList.children().length < d) {
            this.nodeList.append(b)
        } else {
            if(d === 0) {
                this.nodeList.prepend(b)
            } else {
                this.nodeList.append(b)
            }
        }
        try {
            return b
        } finally {
            b = null
        }
    },
    setText: function(a) {
        this.nodeSearch.val(a)
    },
    getText: function() {
        return this.nodeSearch.val()
    },
    fnSelect: function(d) {
        var b = this.nodeList.find("DIV");
        var c = b.length;
        if(c < 2) {
            if(c === 1 && this.modeView !== "slide") {
                b.eq(0).trigger("click")
            }
            return
        }
        for(var a = 0; a < c; a++) {
            if(b.eq(a).attr("value") === d) {
                b.eq(a).trigger("click");
                return
            }
        }
    },
    hangul: {
        rgJaumCode: [12593, 12594, 12596, 12599, 12600, 12601, 12609, 12610, 12611, 12613, 12614, 12615, 12616, 12617, 12618, 12619, 12620, 12621, 12622],
        cho: ["ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"],
        jung: ["ㅏ", "ㅐ", "ㅑ", "ㅒ", "ㅓ", "ㅔ", "ㅕ", "ㅖ", "ㅗ", "ㅘ", "ㅙ", "ㅚ", "ㅛ", "ㅜ", "ㅝ", "ㅞ", "ㅟ", "ㅠ", "ㅡ", "ㅢ", "ㅣ"],
        jong: ["", "ㄱ", "ㄲ", "ㄳ", "ㄴ", "ㄵ", "ㄶ", "ㄷ", "ㄹ", "ㄺ", "ㄻ", "ㄼ", "ㄽ", "ㄾ", "ㄿ", "ㅀ", "ㅁ", "ㅂ", "ㅄ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"],
        _jung: ["ㅏ", "", "", "", "ㅓ", "ㅔ", "", "", "ㅗ", "", "", "", "", "ㅜ", "", "", "", "", "ㅡ", "ㅢ", "ㅣ"],
        _jong: ["", "ㄱ", "", "", "ㄴ", "", "", "ㅁ", "ㄹ", "", "", "", "", "", "", "", "", "ㅂ", "", "", "ㅆ", "ㅇ", "", "", "", "", "", ""]
    },
    unicode: function(c) {
        var b = new Array();
        for(var a = 0; a < c.length; a++) {
            b[a] = c.substr(a, 1).charCodeAt(0)
        }
        return b
    },
    trans: function(e) {
        var d = new Array();
        if((e >= 44032 && e <= 55203)) {
            var a = e - 44032;
            var f = a % 28;
            var c = ((a - f) / 28) % 21;
            var b = parseInt(((a - f) / 28) / 21);
            d[0] = b;
            d[1] = c;
            if(f !== 0) {
                d[2] = f
            }
        } else {
            if(e >= 12593 && e <= 12622) {
                d[0] = $.inArray(e, this.hangul.rgJaumCode)
            } else {
                d[0] = e
            }
        }
        return d
    },
    compare: function(h, f) {
        var b = new Array();
        var a = new Array();
        b = this.unicode(h);
        a = this.unicode(f);
        for(var d = 0; d < b.length; d++) {
            var g = this.trans(b[d]);
            var e = this.trans(a[d]);
            for(var c = 0; c < g.length; c++) {
                if(g[c] !== e[c]) {
                    return false
                }
            }
        }
        return true
    },
    getHangulList: function(g) {
        var f = "game",
            c = "name";
        if(this.type === "serverlist") {
            f = "SERVER", c = "NAME"
        }
        var e = _xml.getElements(this.xml, f),
            a = 0,
            d = new Array(),
            h;
        for(var b = 0; b < e.length; b++) {
            h = e[b].getAttribute(c).substring(0, g.length);
            if(this.compare(g, h.toUpperCase()) === true && $.inArray(h, d) === -1) {
                d[a++] = h
            }
        }
        return d
    }
});
var _gamelist = $.extend({}, _suggest);
$.extend(_gamelist, {
    type: "gamelist",
    xml: _gamedata.xml,
    xsl: _gamedata.xsl,
    bind: null,
    template: "",
    status: {
        active: true,
        type: "all",
        where: null,
        duplicate: false,
        selected: ""
    },
    applyDefault: function(a) {
        this.open({
            type: "sub",
            where: a
        });
        this.close()
    },
    OnOpen: function(b) {
        var a = this;
        if(this.nodeSearch.val() === "게임검색" || this.nodeSearch.val() === "서버검색") {
            this.nodeSearch.val("")
        }
        if(!this.status.active && !(this.bind && this.bind.status.type === "sub")) {
            return
        }
        if(this.bind && this.bind.mode === "open") {
            this.bind.close()
        }
        this.nodeMove = null;
        if(b) {
            if(this.status.type === b.type && this.status.where === b.where) {
                return
            }
            this.status.type = b.type;
            this.status.where = b.where;
            if("selected" in b && !b.selected.isEmpty()) {
                this.status.selected = b.selected
            }
        } else {
            this.status = {
                active: true,
                type: "all",
                where: null,
                duplicate: false
            }
        }
        this.nodeList.children().remove();
        if(this.modeView === "slide") {
            this.nodeList.css("height", "auto")
        }
        var c = this.addOption(null, null, "검색중입니다...");
        c.click = _DISABLE;
        c.mouseover = _DISABLE;
        c.mouseout = _DISABLE;
        this.loadXML()
    },
    loadXML: function() {
        ajaxRequest({
            scope: this,
            url: "/_xml/gamelist.xml",
            dataType: "xml",
            cache: 6,
            success: this.OnLoadXML,
            error: this.OnError
        })
    },
    OnLoadXML: function(a) {
        var b = this;
        if(_gamedata.xsl) {
            this.xsl = _gamedata.xsl
        }
        if(this.xml && this.xsl) {
            this.setMode();
            this.fnPrint.delay(100, this)
        } else {
            this.xml = new Object(a);
            ajaxRequest({
                scope: this,
                url: "/_xslt/gamelist" + this.template + ".xsl",
                dataType: "xml",
                cache: true,
                success: this.OnLoadXSLT,
                error: this.OnError
            })
        }
    },
    OnLoadXSLT: function(a) {
        if(this.type === "gamelist") {
            _gamedata.xsl = a
        } else {
            _serverdata.xsl = a
        }
        this.xsl = a;
        this.setMode();
        this.fnPrint()
    },
    OnError: function() {
        this.close();
        this.nodeList.children().remove();
        this.open(this.status)
    },
    OnChange: function(a) {
        this.status = {
            type: "search",
            where: a.attr("value")
        };
        this.nodeSearch.val($(a).text());
        if(this.bind) {
            this.bind.setValue("");
            this.bind.nodeSelect = null;
            this.bind.nodeSearch.val("");
            this.bind.status.active = true;
            this.bind.status.duplicate = false;
            this.bind.open({
                type: "sub",
                where: a.attr("value")
            });
            this.bind.nodeSearch.focus()
        }
        this.nodeSearch.blur();
        if("OnChangeAfter" in this) {
            this.OnChangeAfter.call(this)
        }
    },
    OnFocus: function() {
        if(this.nodeSearch.val() === "게임검색") {
            this.nodeSearch.val("")
        }
        this.status.active = true;
        if(this.bind) {
            if(this.modeView === "fix") {
                this.bind.nodeList.children().remove()
            }
            this.bind.nodeSelect = null;
            this.bind.setValue("");
            this.bind.nodeSearch.val("");
            this.bind.close()
        }
        this.OnKeyUp()
    },
    OnBlur: function() {
        if(!this.nodeSearch.val().isEmpty()) {
            var b = null;
            var a = this.nodeSearch.val().trim();
            var c = null;
            this.nodeList.children().each(function() {
                if($(this).get(0).tagName !== "DIV") {
                    return false
                }
                c = $(this).text().trim();
                if(c && c.toUpperCase() === a.toUpperCase()) {
                    b = $(this)
                }
            });
            this.nodeSelect = b
        }
    },
    OnClose: function() {
        if(!this.nodeSearch.val().isEmpty()) {
            var c = null;
            var a = this.nodeSearch.val().trim();
            var d = null;
            this.nodeList.children().each(function() {
                if($(this).get(0).tagName !== "DIV") {
                    return false
                }
                d = $(this).text().trim();
                if(d && d.toUpperCase() === a.toUpperCase()) {
                    c = $(this)
                }
            });
            if(c) {
                this.nodeSelect = c;
                var b = this.nodeSelect.attr("value");
                this.setValue(b);
                this.nodeSearch.val(this.nodeSelect.text());
                return
            }
        }
        this.setValue("");
        this.nodeSelect = null;
        this.nodeSearch.val("");
        if(this.bind) {
            if(this.bind.mode === "open") {
                this.bind.close()
            }
            this.bind.nodeSelect = null
        }
    },
    OnMouseOver: function(a) {
        this.nodeMove = a
    },
    OnKeyUp: function(b) {
        var a = _event.keycode(b);
        if(a === _event.KEY_RETURN) {
            return
        }
        if(this.status.where === this.nodeSearch.val() && this.type === "serverlist") {
            return false
        }
        if(a === _event.KEY_UP || a === _event.KEY_PAGEUP || a === _event.KEY_DOWN || a === _event.KEY_PAGEDOWN) {
            return
        }
        if(this.status.type !== "sub" && this.nodeSearch.val().isEmpty()) {
            this.status = {
                active: true,
                type: "all",
                where: null
            };
            this.close();
            if(this.modeView === "fix" && this.type === "gamelist") {
                this.open()
            }
            if(this.bind) {
                this.bind.status = {
                    active: true,
                    type: "all",
                    where: null
                }
            }
        } else {
            if(this.type === "serverlist") {
                this.open({
                    type: "sub",
                    where: this.nodeSearch.val().trim(),
                    duplicate: false
                })
            } else {
                this.open({
                    type: "search",
                    where: this.nodeSearch.val().trim()
                })
            }
        }
    },
    OnKeyDown: function(c) {
        var b = _event.keycode(c);
        if(b === _event.KEY_RETURN) {
            if(this.nodeMove) {
                this.nodeMove.trigger("click")
            }
            _event.stop(c);
            if(this.type === "serverlist" && this.modeView === "slide") {
                this.nodeSearch.blur()
            }
            return false
        } else {
            if(b === _event.KEY_UP || b === _event.KEY_PAGEUP || b === _event.KEY_DOWN || b === _event.KEY_PAGEDOWN) {
                if(this.nodeList.children().length < 1) {
                    return
                }
                var d = (b === _event.KEY_UP || b === _event.KEY_PAGEUP) ? "up" : "down";
                if(d === "up") {
                    if(!this.nodeMove) {
                        _event.stop(c);
                        return
                    } else {
                        if(this.nodeList.children().first().get(0) === this.nodeMove.get(0)) {
                            if(b === _event.KEY_PAGEUP) {
                                return
                            }
                            this.nodeList.scrollTop = "0px";
                            _event.stop(c);
                            return
                        }
                    }
                    this.nodeMove.mouseout();
                    if(b === _event.KEY_UP) {
                        this.nodeMove = this.nodeMove.prev()
                    } else {
                        var f = this.nodeMove;
                        for(var e = 0; e < this.view_count; e++) {
                            if(f.prev().length > 0) {
                                f = f.prev();
                                if(f === this.nodeList.children().first()) {
                                    break
                                }
                            } else {
                                break
                            }
                        }
                        this.nodeMove = f
                    }
                    this.nodeMove.mouseover();
                    if(this.nodeList.scrollTop() > this.nodeMove.offset().top) {
                        this.nodeList.scrollTop(this.nodeMove.offset().top - 3)
                    }
                } else {
                    if(!this.nodeMove) {
                        this.nodeMove = this.nodeList.children().first();
                        this.nodeMove.mouseover();
                        this.status.active = false;
                        return
                    } else {
                        if(this.nodeMove.get(0) === this.nodeList.children().last().get(0)) {
                            _event.stop(c);
                            return
                        }
                    }
                    this.nodeMove.mouseout();
                    if(b === _event.KEY_DOWN) {
                        this.nodeMove = this.nodeMove.next()
                    } else {
                        var f = this.nodeMove;
                        for(var e = 0; e < this.view_count; e++) {
                            if(f.next().length) {
                                f = f.next();
                                if(f === this.nodeList.children().last()) {
                                    break
                                }
                            } else {
                                break
                            }
                        }
                        this.nodeMove = f
                    }
                    this.nodeMove.mouseover();
                    var a = this.nodeList.getBound().height;
                    if(a < this.nodeMove.offset().top - 100) {
                        this.nodeList.scrollTop(parseInt(this.nodeList.scrollTop() + 20))
                    }
                }
            } else {
                if(this.type === "serverlist" && this.status.type === "sub") {
                    this.status.duplicate = true
                }
                this.status.active = true;
                return true
            }
        }
    },
    setMode: function() {
        var h = _xml.getElement(this.xsl, "xsl:for-each", 0);
        var c = _xml.getElement(this.xsl, "xsl:variable", 0);
        c.setAttribute("select", 0);
        if(this.status.type === "all") {
            h.setAttribute("select", "/gamelist/game")
        } else {
            if(this.status.type === "sub") {
                h.setAttribute("select", "/gamelist/game[@id='" + this.status.where + "']")
            } else {
                if(this.status.type === "search") {
                    var a = this.status.where.toUpperCase(),
                        e = this.getHangulList(a),
                        f = 0,
                        g = "/gamelist/game[";
                    if(e.length < 1) {
                        e[0] = a
                    }
                    if(a.substr(a.length - 1, a.length) === e[0].substr(e[0].length - 1, e[0].length).toUpperCase()) {
                        f = a.length
                    }
                    var d = e.length;
                    for(var b = 0; b < d; b++) {
                        if(b !== 0) {
                            g += " or "
                        }
                        g += "starts-with(@name,'" + e[b] + "')"
                    }
                    g += "]";
                    h.setAttribute("select", g);
                    c.setAttribute("select", f)
                }
            }
        }
    },
    fnPrint: function() {
        this.nodeList.children().remove();
        var c = this;
        _xslt.parseXML(this.nodeList, this.xml, this.xsl);
        this.nodeList.children().bind({
            click: function(d) {
                c.fnClick($(this));
                d.stopPropagation()
            },
            mouseover: function() {
                c.fnMouseover($(this))
            },
            mouseout: function() {
                c.fnMouseout($(this))
            }
        });
        if(this.nodeList.children().length < 1) {
            var a = this.addOption(null, null, "검색결과가 없습니다.");
            a.click = _DISABLE;
            a.mouseover = _DISABLE;
            a.mouseout = _DISABLE
        } else {
            if((this.bind && this.bind.type === "serverlist") && this.status.type === "sub") {
                this.nodeSelect = this.nodeList.children().first();
                var b = this.nodeSelect;
                this.setValue(b.attr("value"));
                this.nodeSearch.val($(b).text())
            }
        }
        if("selected" in this.status && !this.status.selected.isEmpty()) {
            this.fnSelect(this.status.selected)
        }
        if(this.modeView === "fix") {} else {
            if(this.nodeList.children().length > this.view_count) {
                this.nodeList.css("height", ($.extend(this.nodeList.children().get(0), _gui).getBound().height * this.view_count + 9) + "px");
                this.nodeList.css("overflow", "auto")
            } else {
                this.nodeList.css("height", "auto")
            }
        }
        if("selectedValue" in this && this.selectedValue.isEmpty() === false) {
            if(this.type === "gamelist") {
                if(this.bind && "useDefault" in this.bind && $.isFunction(this.bind.useDefault) === true) {
                    this.bind.useDefault(this.selectedValue);
                    this.bind.useDefault = null
                }
            } else {
                if(this.type === "serverlist") {
                    this.fnSelect(this.selectedValue)
                }
            }
            this.selectedValue = ""
        }
    },
    fnClick: function(a) {
        this.nodeSelect = $(a);
        if("setText" in this) {
            this.setText($(a).text())
        }
        this.setValue($(a).attr("value"));
        if("OnChange" in this) {
            this.OnChange($(a))
        }
        this.close()
    },
    getUnit: function() {
        if(this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="unit"]').val()
            } catch(a) {
                return ""
            }
        }
        return ""
    }
});
var _serverlist = {};
$.extend(_serverlist, _gamelist);
$.extend(_serverlist, {
    type: "serverlist",
    xml: _serverdata.xml,
    xsl: _serverdata.xsl,
    status: {
        active: true,
        type: "sub",
        where: null,
        duplicate: false,
        selected: ""
    },
    exceptCode: null,
    applyDefault: function() {
        this.useDefault = function(a) {
            this.open({
                type: "sub",
                where: a
            });
            this.close()
        }
    },
    OnOpen: function(a) {
        if(!this.status.active) {
            return
        }
        if(this.bind && this.bind.getValue().isEmpty()) {
            this.close();
            alert("게임을 선택해 주세요.");
            this.bind.nodeSearch.focus();
            return
        }
        this.nodeMove = null;
        if(a) {
            this.status.type = a.type;
            this.status.where = a.where
        }
        this.nodeList.children().remove();
        if(this.modeView === "slide") {
            this.nodeList.css("height", "auto")
        }
        var b = this.addOption(null, null, "검색중입니다...");
        b.click = _DISABLE;
        b.mouseover = _DISABLE;
        b.mouseout = _DISABLE;
        this.loadXML()
    },
    loadXML: function() {
        var a = this;
        if(this.status.type === "search" || this.status.type === "sub" && this.status.duplicate === true) {
            this.setMode();
            this.fnPrint.delay(100, this);
            return
        }
        ajaxRequest({
            scope: this,
            url: "/_xml/serverlist.php",
            dataType: "xml",
            data: "game=" + this.status.where,
            cache: 6,
            success: this.OnLoadXML,
            error: this.OnError
        })
    },
    OnLoadXML: function(a) {
        var b = this;
        this.xml = new Object(a);
        if(_serverdata.xsl) {
            this.xsl = _serverdata.xsl
        }
        if(this.xsl) {
            this.setMode();
            this.fnPrint.delay(100, this)
        } else {
            ajaxRequest({
                scope: this,
                url: "/_xslt/serverlist" + this.template + ".xsl",
                dataType: "xml",
                cache: true,
                success: this.OnLoadXSLT,
                error: this.OnError
            })
        }
    },
    OnChange: function(b) {
        var a = b.find("input[name='gamecode']");
        this.nodeSearch.val($(b).text());
        if(this.status.type !== "sub") {
            this.status = {
                type: "search",
                where: b.attr("value")
            };
            if(this.bind) {
                this.bind.status.active = true;
                this.bind.open({
                    type: "sub",
                    where: a.val()
                });
                this.bind.close();
                this.bind.status.active = false;
                this.status.active = true;
                this.open({
                    type: "sub",
                    where: a.val()
                });
                this.status.active = false;
                this.close()
            }
        } else {
            if(this.bind) {
                if(!this.bind.nodeSelect || this.bind.nodeSelect.attr("value") !== a.val()) {
                    this.bind.status.active = true;
                    this.bind.open({
                        type: "sub",
                        where: a.val()
                    });
                    this.bind.close();
                    this.bind.status.active = false
                }
            }
            this.status.active = false;
            this.close()
        }
        if("OnChangeAfter" in this) {
            this.OnChangeAfter.call(this)
        }
    },
    OnFocus: function() {
        if(this.nodeSearch.val() === "서버검색") {
            this.nodeSearch.val("")
        }
        if(this.bind && this.bind.getValue().isEmpty()) {
            this.close();
            alert("게임을 선택해 주세요.");
            this.bind.nodeSearch.focus();
            return
        }
        if(this.bind && this.bind.mode === "open") {
            this.bind.close()
        }
        if(this.status.type === "sub") {
            this.status.active = false;
            if(this.mode !== "open") {
                this.open()
            }
        }
    },
    OnClose: _ENABLE,
    OnBlur: function() {
        var b = null;
        var a = this.nodeSearch.val().trim();
        var c = null;
        this.nodeList.children().each(function() {
            if($(this).get(0).tagName !== "DIV") {
                return false
            }
            c = $(this).text().trim();
            if(c && c.toUpperCase() === a.toUpperCase()) {
                b = $(this)
            }
        });
        if(b && this.nodeSelect !== b) {
            this.setValue(b.attr("value"))
        }
        this.nodeSelect = b;
        if(!this.nodeSelect) {
            this.setValue("");
            this.status.active = true
        }
    },
    setMode: function() {
        var m = _xml.getElement(this.xsl, "xsl:for-each", 0);
        var c = _xml.getElement(this.xsl, "xsl:variable", 0);
        c.setAttribute("select", 0);
        if(this.status.type === "sub" || this.status.type === "search") {
            var a = this.exceptCode;
            if(this.status.type === "sub" && !this.status.duplicate) {
                var k = "/SERVERLIST/SERVER",
                    h = "",
                    j = "";
                if(this.modeView !== "slide") {
                    h = "(not(@TYPE) or @TYPE!=='all')"
                }
                if(a !== null && a.length > 0) {
                    if(h !== "") {
                        j += " and "
                    }
                    j += "(";
                    var d = a.length;
                    for(var g = 0; g < d; g++) {
                        if(g !== 0) {
                            j += " and "
                        }
                        j += "@ID !== '" + a[g] + "'"
                    }
                    j += ")"
                }
                if(h !== "" || j !== "") {
                    k += "[" + h + j + "]"
                }
                m.setAttribute("select", k)
            } else {
                var b = ((this.status.type === "sub") ? this.nodeSearch.val() : this.status.where).toUpperCase(),
                    f = this.getHangulList(b),
                    e = 0,
                    k = "/SERVERLIST/SERVER[(";
                if(f.length < 1) {
                    f[0] = b
                } else {
                    if(b.substr(b.length - 1, b.length) === f[0].substr(f[0].length - 1, f[0].length)) {
                        e = b.length
                    }
                }
                var l = f.length;
                for(var g = 0; g < l; g++) {
                    if(g !== 0) {
                        k += " or "
                    }
                    k += "starts-with(@NAME,'" + f[g] + "')"
                }
                if(a !== null && a.length > 0) {
                    k += " and (";
                    var d = a.length;
                    for(var g = 0; g < d; g++) {
                        if(g !== 0) {
                            k += " and "
                        }
                        k += "@ID !== '" + a[g] + "'"
                    }
                    k += ")"
                }
                k += (this.modeView !== "slide") ? ") and (not(@TYPE) or @TYPE!=='all')" : ")";
                k += "]";
                m.setAttribute("select", k);
                c.setAttribute("select", e)
            }
        } else {
            return
        }
    },
    getMoney: function() {
        if(this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="money"]').val()
            } catch(a) {
                return ""
            }
        }
        return ""
    },
    getMoneyUnit: function() {
        if(this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="money_unit"]').val()
            } catch(a) {
                return ""
            }
        }
        return ""
    },
    getUnit: function() {
        if(this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="unit"]').val()
            } catch(a) {
                return ""
            }
        }
        return ""
    }
});
