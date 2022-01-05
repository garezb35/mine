(function(c) {
    function i(q, p) {
        for (var n in p) {
            if (String(p[n]) === "[object Object]") {
                for (var o in p[n]) {
                    if (q[n] === undefined) {
                        q[n] = []
                    }
                    q[n][o] = p[n][o]
                }
            } else {
                q[n] = p[n]
            }
        }
        return q
    }
    var m = {
        hangul: {
            cho: ["ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"],
            jung: ["ㅏ", "ㅐ", "ㅑ", "ㅒ", "ㅓ", "ㅔ", "ㅕ", "ㅖ", "ㅗ", "ㅘ", "ㅙ", "ㅚ", "ㅛ", "ㅜ", "ㅝ", "ㅞ", "ㅟ", "ㅠ", "ㅡ", "ㅢ", "ㅣ"],
            jong: ["", "ㄱ", "ㄲ", "ㄳ", "ㄴ", "ㄵ", "ㄶ", "ㄷ", "ㄹ", "ㄺ", "ㄻ", "ㄼ", "ㄽ", "ㄾ", "ㄿ", "ㅀ", "ㅁ", "ㅂ", "ㅄ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"]
        },
        unicode: function(p) {
            var o = [];
            for (var n = 0; n < p.length; n++) {
                o[n] = p.substr(n, 1).charCodeAt(0)
            }
            return o
        },
        trans: function(t) {
            var s;
            var n;
            var v;
            var w;
            var p = t.length;
            var u = [];
            var o = [];
            var q = [];
            for (var r = 0; r < p; r++) {
                w = t.charCodeAt(r);
                if (w === 32) {
                    continue
                }
                if (w < 44032 || w > 55203) {
                    u.push(t.charAt(r));
                    o.push(t.charAt(r));
                    q.push(t.charAt(r));
                    continue
                }
                w = t.charCodeAt(r) - 44032;
                v = w % 28;
                n = (w - v) / 28 % 21;
                s = ((w - v) / 28 - n) / 21;
                u.push(this.hangul.cho[s], this.hangul.jung[n]);
                q.push(String.fromCharCode(t.charCodeAt(r) - v));
                o.push(this.hangul.cho[s]);
                if (this.hangul.jong[v] !== "") {
                    u.push(this.hangul.jong[v])
                }
            }
            return this.checkChoSung ? o : u
        },
        transCho: function(u) {
            var s;
            var n;
            var p;
            var o;
            var r = u.length;
            var t = [];
            for (var q = 0; q < r; q++) {
                o = u.charCodeAt(q);
                if (o === 32) {
                    continue
                }
                if (o < 44032 || o > 55203) {
                    t.push(u.charAt(q));
                    continue
                }
                o = u.charCodeAt(q) - 44032;
                p = o % 28;
                n = (o - p) / 28 % 21;
                s = ((o - p) / 28 - n) / 21;
                t.push(this.hangul.cho[s])
            }
            return t
        },
        compare: function(q, p) {
            var t = p.length;
            var s = this.transCho(q).join("");
            var n = s.indexOf(this.inWordTrans.join(""));
            if (n >= 0) {
                for (var r = 0; r < t; r++) {
                    var o = this.trans(p.substr(r, 1)).join("");
                    if (this.trans(q.substr(n + r, 1)).join("").indexOf(o) === -1) {
                        return false
                    }
                }
                return n
            }
            return false
        },
        getHangulList: function(r, o, p) {
            var y = r,
                u = r.length,
                s = true,
                q = 0,
                v = [];
            if (r.constructor === Object) {
                s = false;
                y = Object.keys(r);
                u = y.length
            }
            o = o.alltrim().toUpperCase();
            this.inWordTrans = this.transCho(o);
            for (var t = 0; t < u; t++) {
                var x = (s === true) ? y[t] : r[y[t]];
                var w = -1;
                var n = this.compare(x.N.alltrim().toUpperCase(), o);
                w = n;
                if (n === false && x.S !== undefined && x.S.isEmpty() === false) {
                    n = this.compare(x.S.alltrim().toUpperCase(), o)
                }
                if (n !== false) {
                    v[q++] = Object.assign({}, x, {
                        matchIndex: w,
                        idx: t
                    });
                    if (p !== undefined && p !== "" && v.length >= p) {
                        break
                    }
                }
            }
            return v
        }
    };
    var e = function(o) {
        var n = o.className.split(" ");
        var p = "over__hidden";
        if (n.indexOf(p) === -1) {
            o.className += " " + p
        }
    };
    var l = function(n) {
        n.className = n.className.replace(/ over__hidden/g, "")
    };
    var j = function(n, q) {
        var x = {};
        var p = {};
        var t = {};
        var r = {
            server: {
                use: true,
                allView: false
            },
            tradeType: {
                type: "select",
                selector: '[name="search_type"]'
            },
            viewType: "full",
            formElement: "#juret__react56",
            containerWrapper: "#hgt34TR",
            toggleContainer: "#initial_screen"
        };
        q = i(r, q);
        Object.assign(this, b, q);
        x = i(x, q.game);
        p = i(p, q.server);
        t = i(t, q.goods);
        var o = this;
        if (n === null || n.length < 1) {
            return
        }
        if (n.length > 1) {
            var v = [];
            o.container.each(function() {
                v.push(new j(this, q))
            });
            return v
        }
        o.container = n;
        if (n.length === 1) {
            o.container = n[0]
        }
        o.container.gameserver = o;
        c(o.container).data("gameserver", o);
        o.searchState = false;
        if (typeof(o.containerWrapper) === "string") {
            o.containerWrapper = document.querySelector(o.containerWrapper)
        } else {
            if (String(o.containerWrapper).indexOf("object Object") !== -1) {
                o.containerWrapper = o.containerWrapper[0]
            }
        }
        if (typeof(o.toggleContainer) === "string") {
            o.toggleContainer = document.querySelector(o.toggleContainer)
        } else {
            if (String(o.toggleContainer).indexOf("object Object") !== -1) {
                o.toggleContainer = o.toggleContainer[0]
            }
        }
        if (typeof(o.formElement) === "string") {
            o.formElement = document.querySelector(o.formElement)
        } else {
            if (String(o.formElement).indexOf("object Object") !== -1) {
                o.formElement = o.formElement[0]
            }
        }
        if (o.formElement === null || o.formElement === undefined) {
            o.formElement = document
        }
        if (o.toggleContainer !== undefined) {
            o.createBeginComponent()
        }
        var w = new f(o.container, x);
        w.gameserver = this;
        o.gameList = w;
        if (p.use === true) {
            var u = new d(o.container, p);
            u.gameserver = this;
            o.serverList = u
        }
        if (t.use === true) {
            var s = new g(o.container, t);
            s.gameserver = this;
            o.goodsList = s
        } else {
            if (o.serverList) {
                o.serverList.listWrap.classList.add("server_t")
            }
        }
        if (w.gameCode !== "") {
            o.changeAction = true;
            window.setTimeout(function() {
                w.createList.call(w);
                o.onClose()
            }, 10)
        }
        return this
    };
    var b = {
        createBeginComponent: function() {
            var n = document.getElementsByClassName("searchbar_tab");
            var p = n.length;
            if (p > 0) {
                for (var o = 0; o < p; o++) {
                    n[o].addEventListener("click", function(t) {
                        var v = t.target.getAttribute("data-target");
                        var s = this.nextElementSibling;
                        var u = s.querySelector('[data-content="' + v + '"]');
                        if (u !== null && u.classList.contains("show") === false) {
                            var r = s.getElementsByClassName("show");
                            var q = this.getElementsByClassName("active");
                            if (v === "tab_mygame") {
                                _myService.makeFavoriteList()
                            }
                            if (r[0]) {
                                r[0].classList.remove("show")
                            }
                            if (q[0]) {
                                q[0].classList.remove("active")
                            }
                            u.classList.add("show");
                            if (t.target.tagName.toUpperCase() === "A") {
                                t.target.parentElement.classList.add("active")
                            } else {
                                t.target.classList.add("active")
                            }
                        }
                    })
                }
            }
        },
        setTradeType: function(o) {
            var p = this.formElement || document;
            var n = p.querySelector(this.tradeType.selector);
            if (n !== null) {
                if (this.tradeType.type === "select") {
                    n.querySelector('[value="' + o + '"]').selected = true
                } else {
                    p.querySelector(this.tradeType.selector + '[value="' + o + '"]').checked = true
                }
            }
        },
        onOpen: function(p) {
            var n = this.gameserver || this;
            var o = this;
            if ((n.containerWrapper && n.containerWrapper.mode === "open") || o.mode === "open") {
                return
            }
            if (n.focusSetTimeout) {
                window.clearTimeout(n.focusSetTimeout)
            }
            if (n.containerWrapper) {
                n.containerWrapper.mode = "open";
                n.containerWrapper.classList.remove("over__hidden");
                if (n.gameList.autoComplete !== false) {
                    n.focusSetTimeout = setTimeout(function() {
                        n.gameList.getData();
                        if (document.activeElement.name !== n.gameList.autoCompleteEl.name) {
                            n.gameList.autoCompleteEl.focus()
                        }
                    });
                    if (n.toggleContainer && n.container.className.indexOf("over__hidden") === -1 && n.gameList.autoCompleteEl.value.isEmpty() === true) {
                        n.container.mode = "close";
                        e(n.container);
                        if (n.toggleContainer) {
                            l(n.toggleContainer)
                        }
                    }
                }
                if (n.toggleContainer !== undefined) {
                    if (_myService.lastSearchHandler !== true) {
                        _myService.makeLastSearch()
                    }
                }
            } else {
                o.mode = "open";
                l(o.listWrap)
            }
            if (n.viewType === "full") {
                document.body.classList.add("fixed_on")
            }
        },
        onClose: function(q) {
            var n = this.gameserver || this;
            var p = this;
            if ((n.containerWrapper && n.containerWrapper.mode === "close") || p.mode === "close") {
                return
            }
            if (n.onCustomCloseBefore) {
                var o = n.onCustomCloseBefore.call(n, q);
                if (o === false) {
                    return
                }
            }
            if (n.containerWrapper) {
                n.containerWrapper.mode = "close";
                n.containerWrapper.classList.add("over__hidden")
            } else {
                p.mode = "close"
            }
            if (n.viewType === "full") {
                document.body.classList.remove("fixed_on");
                if (hashControll.hasHash(n.hashName)) {
                    location.hash = ""
                }
            }
        },
        getValue: function() {
            var o = {};
            var n = (this.gameserver && this.gameserver.formElement) ? this.gameserver.formElement : document;
            if (this.hidden_use.code) {
                o.code = n.querySelector(this.hidden_use.code).value
            }
            if (this.hidden_use.text) {
                o.text = n.querySelector(this.hidden_use.text).value
            }
            return o
        },
        setValue: function(n, r) {
            var o = this;
            var v = (o.gameserver && o.gameserver.formElement) ? o.gameserver.formElement : document;
            if (n !== undefined && o.hidden_use.code) {
                v.querySelector(o.hidden_use.code).value = n
            }
            if (r !== undefined && o.hidden_use.text) {
                v.querySelector(o.hidden_use.text).value = r
            }
            if (n === "" && r === "") {
                if (o.selected) {
                    o.selected.classList.remove("sel_on");
                    delete o.selected
                }
                if (o.selectedData) {
                    delete o.selectedData
                }
                if (o.type === "game" && o.gameserver && o.gameserver.gameList && o.gameserver.gameList.autoCompleteEl) {
                    o.searchText = "";
                    o.gameserver.viewValue = "";
                    o.gameserver.gameList.autoCompleteEl.value = ""
                }
                return
            }
            if (o.type === "game") {
                o.gameCode = n;
                if (_gamedata.json === null) {
                    o.getData(function() {
                        o.setValue(n, r)
                    });
                    return
                } else {
                    if (o.data === null) {
                        o.data = _gamedata.json
                    }
                }
            } else {
                if (o.type === "server") {
                    var w = "";
                    if (o.gameserver && o.gameserver.gameList) {
                        w = o.gameserver.gameList.getValue().code
                    }
                    if (w.isEmpty() === true) {
                        o.setValue("", "");
                        return
                    }
                    if (String(w) !== String(o.gameCode)) {
                        delete o.selected;
                        o.gameCode = w;
                        o.getData(function() {
                            o.setValue(n, r)
                        });
                        return
                    }
                } else {
                    if (o.type === "goods") {
                        var p = "";
                        if (o.gameserver && o.gameserver.serverList) {
                            p = o.gameserver.serverList.getValue().code
                        }
                        if (p.isEmpty() === true) {
                            o.setValue("", "");
                            return
                        }
                    }
                }
            }
            var t = o.data;
            var s = t.length;
            var u;
            for (var q = 0; q < s; q++) {
                if (String(t[q].C) === String(n)) {
                    u = Object.assign({}, t[q], {
                        idx: q
                    });
                    o.gameserver.blurAction = true;
                    break
                }
            }
            o.selectedData = u;
            if (o.selectedData === undefined) {
                o.setValue("", "")
            }
        }
    };
    var f = function(o, r) {
        if (o === null || o.length < 1) {
            return
        }
        Object.assign(this, h, r);
        var n = this;
        n.type = "game";
        n.searchText = "";
        o.gameList = this;
        n.listWrap = document.createElement("div");
        n.listWrap.className = "game over__hidden";
        n.list = document.createElement("ul");
        o.appendChild(n.listWrap);
        n.listWrap.appendChild(n.list);
        n.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
        var p = (o.gameserver && o.gameserver.formElement) ? o.gameserver.formElement : document;
        if (n.autoComplete !== null || n.autoComplete !== false) {
            n.autoCompleteEl = n.autoComplete;
            if (typeof(n.autoComplete) === "string") {
                n.autoCompleteEl = p.querySelector(n.autoComplete)
            }
            var q = document.createElement("a");
            q.href = "javascript:;";
            // q.classList.add("delete_btn");
            q.addEventListener("click", function() {
                n.autoCompleteEl.value = "";
                n.searchText = "";
                n.setValue("", "");
                if (n.onCustomChange) {
                    n.onCustomChange.call(n)
                }
                if (n.gameserver) {
                    n.gameserver.viewValue = "";
                    if (n.gameserver.serverList) {
                        n.gameserver.serverList.setValue("", "");
                        if (n.gameserver.serverList.onCustomChange) {
                            n.gameserver.serverList.onCustomChange.call(n.gameserver.serverList)
                        }
                    }
                    if (n.gameserver.goodsList) {
                        n.gameserver.goodsList.setValue("", "");
                        if (n.gameserver.goodsList.onCustomChange) {
                            n.gameserver.goodsList.onCustomChange.call(n.gameserver.goodsList)
                        }
                    }
                }
                var s = document.createEvent("HTMLEvents");
                s.initEvent("keyup", false, true);
                n.autoCompleteEl.dispatchEvent(s);
                n.autoCompleteEl.focus()
            });
            if (n.autoCompleteEl.nextElementSibling) {
                n.autoCompleteEl.parentElement.insertBefore(q, n.autoCompleteEl.nextElementSibling)
            } else {
                n.autoCompleteEl.parentElement.appendChild(q)
            }
            n.setKeyEvent()
        }
        if (n.view === true) {
            n.createList();
            l(n.listWrap)
        }
    };
    var h = {
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
            code: '[name="filtered_game_id"]',
            text: '[name="filtered_game_alias"]'
        },
        getData: function(p) {
            var n = this;
            if (_gamedata.json === null && _serverdata.json === null && _gamedata.state === null) {
                _gamedata.state = false;
                if (typeof(gsVersion) === "undefined") {
                    var o = new Date();
                    gsVersion = String(o.getFullYear()).substr(-2) + ("0" + (o.getMonth() + 1)).substr(-2) + ("0" + o.getDate()).substr(-2)
                }
                ajaxRequest({
                    url: "api/json/gameserverlist.json?" + gsVersion,
                    dataType: "json",
                    cache: true,
                    success: function(s) {
                        if (s === null) {
                            return
                        }
                        var t = s.gamelist,
                            u = {},
                            q = t.length,
                            r;
                        for (r = 0; r < q; r++) {
                            u[t[r].C] = t[r]
                        }
                        _gamedata.json = t;
                        _gamedata.searchJSON = u;
                        _gamedata.state = true;
                        _serverdata.json = s.serverlist;
                        n.data = _gamedata.json;
                        if (p) {
                            p.call(n)
                        }
                    }
                })
            } else {
                if (_gamedata.json === null || _serverdata.json === null) {
                    setTimeout(function() {
                        n.getData.call(n, p)
                    })
                } else {
                    if (p) {
                        p.call(n)
                    }
                }
            }
        },
        createList: function(u) {
            if (u === undefined) {
                if (_gamedata.json === null) {
                    this.getData(this.createList);
                    return
                } else {
                    u = _gamedata.json
                }
            }
            var p = this;
            var t = u.length;
            var y = document.createDocumentFragment();
            var o = p.autoCompleteEl.value;
            var s = o.length;
            var q;
            if (p.hidden_use) {
                var w = (p.gameserver && p.gameserver.formElement) ? p.gameserver.formElement : document;
                if (p.hidden_use.code) {
                    w.querySelector(p.hidden_use.code).value = ""
                }
                if (p.hidden_use.text) {
                    w.querySelector(p.hidden_use.text).value = ""
                }
            }
            p.list.innerHTML = "";
            for (var r = 0; r < t; r++) {
                if ((String(p.gameCode) !== "" && String(p.gameCode) !== String(u[r].C)) || (String(p.gameText.alltrim()) !== "" && String(p.gameText.alltrim()) !== String(u[r].N.alltrim()))) {
                    continue
                }
                if (p.gameCode !== "" || p.gameText.alltrim() !== "") {
                    s = 0;
                    u[r].matchIndex = -1
                }
                var n = document.createElement("li");
                var x = u[r].N.alltrim();
                var v = u[r].matchIndex;
                if (s > 0 && v >= 0) {
                    var z = "";
                    if (v > 0) {
                        z += x.substr(0, v)
                    }
                    z += ("<span>" + x.substr(v, s) + "</span>" + x.substr(v + s));
                    x = z
                }
                n.innerHTML = x;
                n.addEventListener("click", function(A) {
                    p.gameserver.searchState = false;
                    p.onChange.call(p, this, A)
                });
                c.data(n, Object.assign({}, u[r], {
                    idx: r
                }));
                y.appendChild(n);
                if ((p.gameCode !== "" && String(p.gameCode) === String(u[r].C)) || (String(p.gameText.alltrim()) !== "" && String(p.gameText.alltrim()) === String(u[r].N.alltrim()))) {
                    q = n;
                    p.gameCode = "";
                    p.gameText = "";
                    break
                }
                if (q === undefined && p.selectedData) {
                    if (p.selectedData.C === u[r].C && p.selectedData.L === u[r].L) {
                        q = n
                    }
                }
            }
            p.list.appendChild(y);
            if (p.listWrap.className.indexOf("over__hidden") !== -1 && p.view !== false) {
                l(p.listWrap)
            }
            if (q) {
                if (p.gameserver.changeAction === true) {
                    if (p.gameserver.container.className.indexOf("over__hidden") !== -1 && p.view !== false) {
                        p.gameserver.container.mode = "open";
                        l(p.gameserver.container);
                        if (p.gameserver.toggleContainer) {
                            e(p.gameserver.toggleContainer)
                        }
                    }
                    p.onChange(q)
                }
            }
        },
        onChange: function(q, r) {
            var n = this;
            if (String(q).toLowerCase().indexOf("element") !== -1) {
                var o = c.data(q)
            } else {
                var o = q
            }
            if (n.selected) {
                if (String(o.C) === String(n.getValue().code)) {
                    return
                }
                n.selected.classList.remove("sel_on")
            }
            if (String(q).toLowerCase().indexOf("element") !== -1) {
                n.selected = q;
                q.classList.add("sel_on")
            }
            n.gameserver.searchState = false;
            n.gameserver.container.classList.add("gs_selection");
            n.selectedData = o;
            if (n.autoComplete !== false) {
                n.gameserver.blurAction = false;
                if (n.gameserver) {
                    n.gameserver.viewValue = n.selectedData.N
                }
                n.autoCompleteEl.value = n.gameserver.viewValue;
                n.autoCompleteEl.classList.remove("placeholder");
                if (n.selectedIndex && n.list.children[n.selectedIndex]) {
                    n.list.children[n.selectedIndex].classList.remove("focus")
                }
            }
            if (n.hidden_use) {
                var p = (n.gameserver && n.gameserver.formElement) ? n.gameserver.formElement : document;
                if (n.hidden_use.code) {
                    p.querySelector(n.hidden_use.code).value = n.selectedData.C
                }
                if (n.hidden_use.text) {
                    p.querySelector(n.hidden_use.text).value = n.selectedData.N
                }
            }
            if (n.onCustomChange) {
                n.onCustomChange.call(n, q, r)
            }
            if (n.gameserver.serverList === undefined && n.onAction) {
                n.onAction.call(n, q, r)
            }
            if (n.gameserver === undefined) {
                e(n.listWrap)
            } else {
                e(n.listWrap);
                delete n.selectedIndex;
                if (n.gameserver.serverList) {
                    n.gameserver.position = "server";
                    delete n.gameserver.serverList.selectedIndex;
                    if (r) {
                        n.gameserver.changeAction = true;
                        n.gameserver.serverList.setValue("", "")
                    }
                    if (n.gameserver.serverList.request === true) {
                        if (n.gameserver.serverList.gameCode != n.selectedData.C) {
                            n.gameserver.serverList.gameCode = n.selectedData.C;
                            n.gameserver.serverList.data = null
                        }
                    }
                    n.gameserver.serverList.list.scrollTop = 0;
                    n.gameserver.serverList.view = true;
                    n.gameserver.serverList.createList()
                }
                if (n.gameserver.goodsList) {
                    delete n.gameserver.goodsList.selectedIndex;
                    if (r) {
                        n.gameserver.goodsList.setValue("", "")
                    }
                    if (n.selectedData.CV.toUpperCase() === "Y") {
                        n.gameserver.goodsList.data[3].V = true
                    } else {
                        n.gameserver.goodsList.data[3].V = false
                    }
                    if (n.notGames.indexOf(Number(n.selectedData.C)) !== -1) {
                        n.gameserver.goodsList.exceptCode = ["all", "money", "item"]
                    } else {
                        n.gameserver.goodsList.exceptCode = [];
                        n.gameserver.goodsList.data[1].N = n.selectedData.U
                    }
                    n.gameserver.goodsList.createList()
                }
            }
        },
        setKeyEvent: function() {
            var n = this;
            if (n.useKeyboard !== false) {
                document.body.addEventListener("keydown", function(o) {
                    n.onKeydown.call(o.target, n, o)
                })
            }
            n.autoCompleteEl.addEventListener("keyup", function(o) {
                n.onKeyup.call(this, n, o)
            });
            n.autoCompleteEl.addEventListener("click", function(o) {
                n.onFocus.call(this, n)
            })
        },
        onKeydown: function(r, z) {
            if (r.gameserver === undefined) {
                return
            }
            if (r.mode !== "open" && (r.gameserver && (r.gameserver.containerWrapper.mode !== "open" || r.gameserver.container.mode !== "open"))) {
                return
            }
            var w = _event.keycode(z);
            if (w !== _event.KEY_RETURN && w !== _event.KEY_DOWN && w !== _event.KEY_UP && w !== _event.KEY_LEFT && w !== _event.KEY_RIGHT) {
                return
            }
            if (w == _event.KEY_LEFT || w == _event.KEY_RIGHT) {
                this.blur()
            }
            if (r.gameserver.position === undefined) {
                if (r.gameserver.searchState === true) {
                    r.gameserver.position = "game";
                    delete r.gameserver.gameList.selectedIndex
                } else {
                    if (r.gameserver.goodsList && r.gameserver.goodsList.listWrap.classList.contains("over__hidden") === false && r.gameserver.serverList.selected) {
                        r.gameserver.position = "goods";
                        delete r.gameserver.goodsList.selectedIndex
                    } else {
                        if (r.gameserver.serverList && r.gameserver.serverList.list.children.length > 0 && r.gameserver.gameList.selected) {
                            r.gameserver.position = "server";
                            delete r.gameserver.serverList.selectedIndex
                        } else {
                            return
                        }
                    }
                }
            }
            var C;
            if (r.gameserver.position === "game") {
                C = r.gameserver.gameList
            } else {
                if (r.gameserver.position === "server") {
                    C = r.gameserver.serverList
                } else {
                    if (r.gameserver.position === "goods") {
                        C = r.gameserver.goodsList
                    }
                }
            }
            r.gameserver.returnKey = false;
            var A = C.list;
            var q = A.children;
            var t = C.selectedIndex;
            if (r.gameserver.searchState === false && t == undefined && C.selected) {
                t = Array.prototype.indexOf.call(q, C.selected)
            }
            if (w == _event.KEY_RETURN || (w == _event.KEY_RIGHT && (r.gameserver.position !== "server" || (r.gameserver.position === "server" && (r.gameserver.goodsList !== undefined || r.gameserver.searchState === true))))) {
                this.blur();
                _event.stop(z);
                if (r.gameserver.position === "game") {
                    if (t === undefined || t === -1) {
                        var y = q.length;
                        var x = this.value.alltrim().toUpperCase();
                        for (var v = 0; v < y; v++) {
                            var B = c.data(q[v]);
                            if (B.N.alltrim().toUpperCase() === x) {
                                t = v;
                                break
                            }
                        }
                    }
                    if (r.gameserver.serverList !== undefined) {
                        r.gameserver.position = "server";
                        r.gameserver.serverList.selectedIndex = 0
                    }
                } else {
                    if (r.gameserver.position === "server" && r.gameserver.goodsList !== undefined) {
                        r.gameserver.position = "goods";
                        r.gameserver.goodsList.selectedIndex = 0;
                        if (r.gameserver.serverList !== undefined) {
                            C = r.gameserver.serverList
                        }
                    }
                }
                if (t === undefined || t === -1) {
                    t = 0
                }
                C.selectedIndex = t;
                var p = q[C.selectedIndex];
                p.classList.add("focus");
                if (C.selected !== undefined) {
                    C.selected.classList.remove("focus")
                }
                r.gameserver.returnKey = true;
                C.onChange(p, z)
            } else {
                if (w == _event.KEY_UP || w == _event.KEY_DOWN || w == _event.KEY_LEFT || w == _event.KEY_RIGHT) {
                    _event.stop(z);
                    if ((w == _event.KEY_LEFT || w == _event.KEY_RIGHT) && C.updownIndex === undefined) {
                        return
                    }
                    var u = (C.updownIndex === undefined) ? 1 : C.updownIndex;
                    var s = q.length - 1;
                    var n = {
                        offset: -(54 + (q[0].clientHeight * 3))
                    };
                    var o;
                    switch (w) {
                        case _event.KEY_DOWN:
                            if (r.gameserver.searchState === true) {
                                n.index = 1
                            } else {
                                n.index = u
                            }
                            break;
                        case _event.KEY_UP:
                            if (r.gameserver.searchState === true) {
                                n.index = -1
                            } else {
                                n.index = -(u)
                            }
                            break;
                        case _event.KEY_LEFT:
                            n.index = -1;
                            break;
                        case _event.KEY_RIGHT:
                            n.index = 1;
                            break
                    }
                    if (t == undefined) {
                        t = 0
                    } else {
                        o = q[t];
                        t += n.index
                    }
                    if (t < 0 || t > s) {
                        if (r.gameserver.searchState === true) {
                            if (r.gameserver.position === "game" && w == _event.KEY_DOWN && t > s && r.gameserver.serverList.list.children.length > 0) {
                                r.gameserver.position = "server";
                                C = r.gameserver.serverList;
                                q = C.list.children;
                                t = 0
                            } else {
                                if (r.gameserver.position === "server" && w == _event.KEY_UP && t < 0 && r.gameserver.gameList.list.children.length > 0) {
                                    r.gameserver.position = "game";
                                    C = r.gameserver.gameList;
                                    q = C.list.children;
                                    t = q.length - 1
                                } else {
                                    return
                                }
                            }
                        } else {
                            return
                        }
                    }
                    if (o) {
                        o.classList.remove("focus")
                    }
                    C.selectedIndex = t;
                    o = q[C.selectedIndex];
                    o.classList.add("focus");
                    C.list.scrollTop = (o.offsetTop - C.list.offsetTop) + n.offset
                }
            }
        },
        onKeyup: function(n, p) {
            var o = _event.keycode(p);
            if (o == _event.KEY_RETURN || o == _event.KEY_DOWN || o == _event.KEY_UP || o == _event.KEY_LEFT || o == _event.KEY_RIGHT) {
                return
            }
            n.onOpen();
            if (n.keyuupEventQueue) {
                window.clearTimeout(n.keyuupEventQueue)
            }
            n.view = true;
            n.gameserver.changeAction = false;
            n.gameserver.blurAction = true;
            if (this.value.isEmpty() === true) {
                n.gameserver.container.classList.add("game_empty");
                n.list.innerHTML = '<li class="search_ing">검색 결과가 없습니다.</li>';
                n.searchText = "";
                if (n.gameserver.serverList) {
                    n.gameserver.serverList.list.innerHTML = "";
                    e(n.gameserver.serverList.listWrap)
                }
                if (n.gameserver.goodsList) {
                    e(n.gameserver.goodsList.listWrap)
                }
                if (n.gameserver.toggleContainer && n.gameserver.container.className.indexOf("over__hidden") === -1) {
                    n.gameserver.container.mode = "close";
                    e(n.gameserver.container);
                    if (n.gameserver.toggleContainer) {
                        l(n.gameserver.toggleContainer)
                    }
                }
                return
            }
            if (n.searchText !== this.value) {
                delete n.gameserver.position;
                delete n.selectedIndex;
                if (n.gameserver.searchState === false) {
                    n.gameserver.searchState = true;
                    n.gameserver.container.classList.remove("gs_selection")
                }
                if (n.gameserver.toggleContainer && n.gameserver.container.className.indexOf("over__hidden") !== -1) {
                    n.gameserver.container.mode = "open";
                    l(n.gameserver.container);
                    if (n.gameserver.toggleContainer) {
                        e(n.gameserver.toggleContainer)
                    }
                }
                n.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                if (n.gameserver.serverList) {
                    n.gameserver.serverList.list.innerHTML = ""
                }
                if (n.gameserver.goodsList) {
                    e(n.gameserver.goodsList.listWrap)
                }
                var q = this.value.alltrim().toUpperCase();
                n.keyuupEventQueue = window.setTimeout(function() {
                    if (n.gameserver.serverList && _serverdata.json === null) {
                        n.getData(function() {
                            n.onKeyup.call(n.autoCompleteEl, n, p)
                        });
                        return
                    }
                    n.searchText = q;
                    n.gameserver.container.classList.remove("game_empty");
                    if (n.gameserver.serverList) {
                        delete n.gameserver.serverList.selectedIndex;
                        delete n.gameserver.serverList.selected;
                        n.gameserver.serverList.view = true;
                        var s = m.getHangulList(_serverdata.json, q, n.gameserver.serverList.searchCount);
                        if (s.length > 0) {
                            n.gameserver.serverList.createList(s, true);
                            n.gameserver.serverList.list.scrollTop = 0
                        } else {
                            e(n.gameserver.serverList.listWrap)
                        }
                    }
                    if (n.gameserver.goodsList) {
                        n.gameserver.goodsList.view = true;
                        delete n.gameserver.goodsList.selectedIndex;
                        delete n.gameserver.goodsList.selected
                    }
                    var r = m.getHangulList(_gamedata.json, q, n.searchCount);
                    if (s.length < 1 && r.length < 1) {
                        n.list.innerHTML = '<li class="search_ing">검색 결과가 없습니다.</li>';
                        return
                    }
                    if (s.length < 1 || r.length < 1) {
                        n.gameserver.container.classList.add("game_empty")
                    }
                    if (r.length < 1) {
                        e(n.listWrap)
                    } else {
                        l(n.listWrap);
                        n.createList(r)
                    }
                }, 1)
            }
        },
        onFocus: function(n) {
            if (n.gameserver) {
                n.gameserver.changeAction = false
            }
            n.onOpen();
            if (n.selected) {
                n.selectedIndex = Array.prototype.indexOf.call(n.list.children, n.selected)
            } else {
                n.list.scrollTop = 0
            }
            if (n.gameserver.serverList) {
                if (n.gameserver.serverList.selected) {
                    var o = n.gameserver.serverList.selected.offsetTop - (n.gameserver.serverList.list.offsetHeight / 2)
                } else {
                    var o = 0
                }
                n.gameserver.serverList.list.scrollTop = o
            }
        }
    };
    i(h, b);
    var d = function(n, o) {
        if (n === null || n.length < 1) {
            return
        }
        Object.assign(this, a, o);
        this.type = "server";
        n.serverList = this;
        this.listWrap = document.createElement("div");
        this.listWrap.className = "server over__hidden";
        this.list = document.createElement("ul");
        n.appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);
        if (this.gameCode === "") {
            return
        }
        if (this.autoComplete !== null && this.autoComplete !== false) {
            this.autoCompleteEl = this.autoComplete;
            if (typeof(this.autoComplete) === "string") {
                this.autoCompleteEl = document.querySelector(this.autoComplete)
            }
            this.listWrap.classList.add("gs_list_wrap");
            this.setKeyEvent()
        }
        if (this.selected) {
            this.selected.classList.add("sel_on")
        }
    };
    var a = {
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
            code: '[name="filtered_child_id"]',
            text: '[name="filtered_child_alias"]'
        },
        getData: function(s) {
            var p = this;
            if (p.gameCode === "") {
                alert("게임을 선택해주세요.");
                return
            }
            var q = _serverdata.json;
            if (q === null) {
                setTimeout(function() {
                    p.getData(s)
                });
                return
            }
            var o = q.length;
            var n = [];
            if (p.allView === true) {
                n.push({
                    BG: 0,
                    C: "0",
                    N: "서버전체"
                })
            }
            for (var r = 0; r < o; r++) {
                if (String(q[r].GC) === String(p.gameCode)) {
                    n.push(q[r])
                }
            }
            n.sort(function(u, t) {
                if (Number(u.BG) < Number(t.BG)) {
                    return -1
                }
                if (Number(u.BG) > Number(t.BG)) {
                    return 1
                }
                return 0
            });
            p.data = JSON.parse(JSON.stringify(n));
            if (s) {
                s.call(p, p.data)
            }
        },
        createList: function(w) {
            if (w === undefined) {
                if (this.data === null) {
                    this.getData(this.createList);
                    return
                } else {
                    w = this.data
                }
            }
            if (w.length < 1) {
                console.log("server_not_data");
                return
            }
            var q = this;
            var v = w.length;
            var B = document.createDocumentFragment();
            var o = (q.gameserver && q.gameserver.gameList.autoComplete) ? document.querySelector(q.gameserver.gameList.autoComplete).value : "";
            var u = o.length || 0;
            var r;
            if (q.hidden_use) {
                var y = (q.gameserver && q.gameserver.formElement) ? q.gameserver.formElement : document;
                if (q.hidden_use.code) {
                    y.querySelector(q.hidden_use.code).value = ""
                }
                if (q.hidden_use.text) {
                    y.querySelector(q.hidden_use.text).value = ""
                }
            }
            q.list.innerHTML = "";
            for (var t = 0; t < v; t++) {
                if (q.exceptCode.indexOf(w[t].C) === -1) {
                    var n = document.createElement("li");
                    var A = w[t].N;
                    var x = w[t].matchIndex;
                    var z = t;
                    if (u > 0 && x >= 0) {
                        var C = "";
                        if (x > 0) {
                            C += A.substr(0, x)
                        }
                        C += ("<span>" + A.substr(x, u) + "</span>" + A.substr(x + u));
                        A = C
                    }
                    if (q.gameserver && q.gameserver.searchState === true) {
                        var s = _gamedata.searchJSON[w[t].GC];
                        A = s.N + " > " + A
                    }
                    n.innerHTML = A;
                    n.addEventListener("click", function(D) {
                        q.onChange.call(q, this, D)
                    });
                    c.data(n, Object.assign({}, w[t], {
                        idx: z
                    }));
                    B.appendChild(n);
                    if (q.serverCode !== "" && (String(q.serverCode) === String(w[t].C) || q.serverText.alltrim() === w[t].N.alltrim())) {
                        r = n;
                        q.serverCode = "";
                        q.serverText = ""
                    }
                    if (r === undefined && q.selectedData && (q.selectedData.C === w[t].C)) {
                        r = n
                    }
                }
            }
            q.list.appendChild(B);
            if (q.listWrap.className.indexOf("over__hidden") !== -1 && q.view !== false) {
                l(q.listWrap)
            }
            if (q.gameserver && q.gameserver.goodsList && q.gameserver.searchState === false) {
                l(q.gameserver.goodsList.listWrap)
            }
            if (q.gameserver && q.gameserver.returnKey === true && q.gameserver.position === "server") {
                q.list.children[0].classList.add("focus")
            }
            if (r === undefined && ((q.allView === true && q.list.childElementCount <= 2) || (q.allView !== true && q.list.childElementCount <= 1))) {
                r = q.list.children[q.list.childElementCount - 1];
                q.selectedIndex = q.list.childElementCount - 1
            }
            if (r) {
                var p = r.offsetTop - (q.list.offsetHeight / 2);
                q.list.scrollTop = p;
                if (q.gameserver && q.gameserver.changeAction === true) {
                    q.onChange(r)
                }
            }
        },
        onChange: function(r, s) {
            var n = this;
            var p = c.data(r);
            if (n.gameserver && n.gameserver.searchState === true) {
                var o = _gamedata.searchJSON[p.GC];
                if (o !== undefined) {
                    n.gameserver.changeAction = true;
                    n.gameserver.gameList.selectedData = o;
                    n.gameserver.gameList.setValue(o.C, o.N);
                    n.gameserver.serverList.setValue(p.C, p.N);
                    if (s && n.gameserver && n.gameserver.goodsList) {
                        if (n.gameserver.goodsList.selected) {
                            n.gameserver.goodsList.selected.classList.remove("sel_on");
                            n.gameserver.goodsList.setValue("", "")
                        }
                    }
                    n.gameserver.gameList.createList([o]);
                    if (n.onAction) {
                        n.onAction.call(n, r, s)
                    }
                }
                return
            }
            if (n.selected) {
                n.selected.classList.remove("sel_on")
            }
            r.classList.add("sel_on");
            n.selected = r;
            n.selectedData = p;
            if (n.autoComplete !== false) {
                n.autoCompleteEl.value = n.selectedData.N
            } else {
                if (n.gameserver.gameList.autoComplete !== false) {
                    if (n.selectedIndex && n.list.children[n.selectedIndex]) {
                        n.list.children[n.selectedIndex].classList.remove("focus")
                    }
                }
            }
            if (n.hidden_use) {
                var q = (n.gameserver && n.gameserver.formElement) ? n.gameserver.formElement : document;
                if (n.hidden_use.code) {
                    q.querySelector(n.hidden_use.code).value = n.selectedData.C
                }
                if (n.hidden_use.text) {
                    q.querySelector(n.hidden_use.text).value = n.selectedData.N
                }
            }
            if ((n.mode === "open" || (this.gameserver.containerWrapper && n.gameserver.containerWrapper.mode === "open")) && n.onCustomChange) {
                n.onCustomChange.call(n, r, s)
            }
            if (n.onAction) {
                n.onAction.call(n, r, s)
            }
            if (n.gameserver === undefined) {
                e(n.listWrap)
            } else {
                delete n.gameserver.position
            }
            if (n.gameserver && n.gameserver.returnKey === true && n.gameserver.goodsList) {
                if (n.gameserver.goodsList.list.childElementCount > 0) {
                    n.gameserver.goodsList.list.children[0].classList.add("focus")
                }
            }
            if (s && n.gameserver && n.gameserver.goodsList) {
                if (n.gameserver.goodsList.selected) {
                    n.gameserver.goodsList.selected.classList.remove("sel_on");
                    n.gameserver.goodsList.setValue("", "")
                }
            }
        },
        setKeyEvent: function() {
            var n = this;
            this.autoCompleteEl.addEventListener("keyup", function() {
                if (n.searchText !== this.value) {
                    if (n.keyuupEventQueue) {
                        window.clearTimeout(n.keyuupEventQueue)
                    }
                    if (n.gameserver) {
                        n.gameserver.changeAction = false
                    } else {
                        n.changeAction = false
                    }
                    n.searchText = this.value;
                    n.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                    var o = this.value;
                    n.keyuupEventQueue = window.setTimeout(function() {
                        var p = m.getHangulList(n.data, o);
                        if (p.length < 1) {
                            n.list.innerHTML = '<li class="search_ing">검색결과가 없습니다.</li>';
                            return
                        }
                        n.createList(p)
                    }, 1)
                }
            });
            this.autoCompleteEl.addEventListener("focus", function() {
                if (n.focusSetTimeout) {
                    window.clearTimeout(n.focusSetTimeout)
                }
                if (n.gameserver) {
                    n.gameserver.changeAction = false
                } else {
                    n.changeAction = false
                }
                n.onOpen();
                n.focusSetTimeout = setTimeout(function() {
                    if (n.data === null) {
                        n.createList()
                    }
                });
                if (n.selected) {
                    var o = n.selected.offsetTop - (n.list.offsetHeight / 2);
                    n.list.scrollTop = o
                }
            })
        }
    };
    i(a, b);
    var g = function(n, o) {
        if (n === null || n.length < 1) {
            return
        }
        Object.assign(this, k, o);
        this.type = "goods";
        n.goodsList = this;
        c(n).data("goodsList", this);
        this.listWrap = document.createElement("div");
        this.listWrap.className = "goods over__hidden";
        this.list = document.createElement("ul");
        n.appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);
        if (this.allView === true) {
            this.data[0].V = true
        }
    };
    var k = {
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
            var o = this;
            var u = o.data;
            var n = u.length;
            var t;
            if (o.hidden_use) {
                var s = (o.gameserver && o.gameserver.formElement) ? o.gameserver.formElement : document;
                if (o.hidden_use.code) {
                    s.querySelector(o.hidden_use.code).value = ""
                }
                if (o.hidden_use.text) {
                    s.querySelector(o.hidden_use.text).value = ""
                }
            }
            o.list.innerHTML = "";
            for (var q = 0; q < n; q++) {
                if (o.exceptCode.indexOf(u[q].C) === -1) {
                    if (u[q].V === true) {
                        var p = document.createElement("li");
                        p.innerHTML = u[q].N;
                        p.addEventListener("click", function(v) {
                            o.onChange.call(o, this, v)
                        });
                        if (u[q].NI === true) {
                            var r = document.createElement("span");
                            r.classList.add("icon_new");
                            p.appendChild(r)
                        }
                        c.data(p, Object.assign({}, u[q], {
                            idx: q
                        }));
                        o.list.appendChild(p);
                        if (o.goodsCode !== "" && String(o.goodsCode) === String(u[q].C)) {
                            t = p;
                            o.selectedData = c.data(p);
                            o.goodsCode = ""
                        }
                        if (t === undefined && o.selectedData) {
                            if (o.selectedData.C === u[q].C) {
                                t = p
                            }
                        }
                    }
                }
            }
            if (o.gameserver.returnKey === true && (o.gameserver.position === "goods" || (o.gameserver.position === "server" && o.gameserver.serverList.list.childElementCount < 2))) {
                o.gameserver.position = "goods";
                o.list.children[0].classList.add("focus")
            }
            if (t) {
                o.onChange(t)
            }
        },
        onChange: function(p, q) {
            if (this.gameserver && this.gameserver.serverList && this.gameserver.serverList.getValue().code == "") {
                alert("서버 정보가 없습니다.");
                return
            }
            if (this.selected) {
                this.selected.classList.remove("sel_on")
            }
            p.classList.add("sel_on");
            this.selected = p;
            this.selectedData = c.data(p);
            if (this.hidden_use) {
                var o = (this.gameserver && this.gameserver.formElement) ? this.gameserver.formElement : document;
                if (this.hidden_use.code) {
                    o.querySelector(this.hidden_use.code).value = this.selectedData.C
                }
                if (this.hidden_use.text) {
                    o.querySelector(this.hidden_use.text).value = this.selectedData.N
                }
            }
            if (this.onCustomChange) {
                this.onCustomChange.call(this, p, q)
            }
            if (q !== undefined) {
                var n = this;
                setTimeout(function() {
                    n.onClose()
                }, 100)
            }
        }
    };
    i(k, b);
    window.Suggest = m;
    window.GameList = f;
    window.ServerList = d;
    window.GoodsList = g;
    window.GameServerList = j
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
var _Suggest = {};
$.extend(_Suggest, {
    viewcount: 4,
    nodeList: null,
    initialize: function() {
        var d = $(this),
            e = d.attr("name"),
            c = this;
        this.nodeInput = $(this);
        d.attr("name", e + "_text").on({
            keyup: function(f) {
                c.onKeyUp.call(c, f)
            },
            focus: function(f) {
                c.onFocus.call(c, f)
            },
            blur: function(f) {
                c.onBlur.call(c, f)
            }
        });
        d.wrap('<div class="g_selectbox"></div>');
        this.nodeHidden = $("<input>", {
            type: "hidden",
            name: e
        }).insertBefore(d);
        if (this.nodeList == null) {
            this.nodeList = $("<div />");
            $(this).after(this.nodeList)
        }
        var a = this.nodeList.addClass("gs_list"),
            b = document.createElement("div");
        b.id = e + "_scroller";
        a.after($(b).addClass("gs_wrap"));
        $(b).append(a);
        this.scrollNodeWrap = $(b);
        if (this.mode == "infinite") {
            a.addClass("infinite_list")
        }
        if (a[0].tagName.toUpperCase() == "UL") {
            this.childNodeString = "li"
        } else {
            this.childNodeString = "div"
        }
        this.onLoad()
    },
    rgJaumCode: [12593, 12594, 12596, 12599, 12600, 12601, 12609, 12610, 12611, 12613, 12614, 12615, 12616, 12617, 12618, 12619, 12620, 12621, 12622],
    unicode: function(a) {
        var b = [],
            d = a.length;
        for (var c = 0; c < d; c++) {
            b[c] = a[c].charCodeAt(0)
        }
        return b
    },
    trans: function(b) {
        var e = [];
        if ((b >= 44032 && b <= 55203)) {
            var a = b - 44032,
                f = a % 28,
                d = ((a - f) / 28) % 21,
                c = parseInt(((a - f) / 28) / 21);
            e[0] = c;
            e[1] = d;
            if (f != 0) {
                e[2] = f
            }
        } else {
            if (b >= 12593 && b <= 12622) {
                e[0] = this.rgJaumCode.indexOf(b)
            } else {
                e[0] = b
            }
        }
        return e
    },
    compare: function(k, b) {
        var h = [],
            f = [];
        h = this.unicode(k);
        f = this.unicode(b);
        var l = h.length;
        for (var e = 0; e < l; e++) {
            var c = this.trans(h[e]),
                a = this.trans(f[e]),
                g = c.length;
            for (var d = 0; d < g; d++) {
                if (c[d] != a[d]) {
                    return false
                }
            }
        }
        return true
    },
    open: function() {
        if (this.showMode != "open") {
            this.showMode = "open";
            this.scrollNodeWrap.show()
        }
        if ("onOpen" in this) {
            this.onOpen()
        }
    },
    close: function() {
        if (this.showMode != "close") {
            this.showMode = "close";
            this.scrollNodeWrap.hide()
        }
        if ("onClose" in this) {
            this.onClose()
        }
    },
    getValue: function() {
        return this.nodeHidden.val()
    }
});
var _GameList2 = $.extend({}, _Suggest),
    _ServerList2 = $.extend({}, _Suggest);
$.extend(_GameList2, {
    strType: "game",
    json: _gamedata.json,
    filter: {
        type: "all",
        where: "",
        selected: ""
    },
    filterCode: null,
    nodeList: null,
    mode: "infinite",
    bind: null,
    onLoad: function() {
        if (this.json == null) {
            ajaxRequest({
                url: "/_json/gamelist.php",
                scope: this,
                mask: false,
                success: this.onLoadComplete
            })
        } else {
            this.createScroll()
        }
    },
    onLoadComplete: function(g) {
        var l = this,
            m = this.json = _gamedata.json = g,
            f = this.nodeList,
            c = m.gamelist,
            k = this.viewcount * 3,
            n = [];
        for (var j = 0; j < k; j++) {
            var e = c[j],
                h = e.name,
                a = this.createElHtml(h)[0];
            $.data(a, {
                id: e.id
            });
            n.push(a)
        }
        f.append(n);
        var o = f.children(),
            d = o[0].offsetHeight * this.viewcount;
        if (d > 0) {
            this.scrollNodeWrap.css("height", d);
            this.close()
        } else {
            var b = o.parents(":hidden").last().show();
            d = o[0].offsetHeight * this.viewcount;
            b.hide();
            this.scrollNodeWrap.css("height", d);
            this.close()
        }
    },
    onLoadError: function() {
        alert("Game List Load Fail.[609]")
    },
    createScroll: function() {
        var c = this,
            a = c.scrollNodeWrap[0].id,
            b = {
                me: c,
                mouseWheel: true,
                click: true
            };
        if (this.mode == "infinite") {
            b.infiniteElements = c.nodeList.children();
            b.infiniteLimit = c.json.gamelist.length;
            b.dataset = c.scrollSetDate;
            b.dataFiller = c.updateContent;
            b.cacheSize = 200
        }
        this.iscroll = new IScroll("#" + a, b);
        this.close()
    },
    onChange: function(a) {
        this.filter.type = "search";
        this.filter.where = $(a).text();
        this.filter.selected = $.data(a, "id");
        this.nodeInput.blur();
        if (this.bind) {
            this.bind.setValue("");
            this.bind.nodeSelect = null;
            this.bind.open();
            this.bind.nodeInput.focus()
        }
        if ("OnUpdate" in this && this.OnUpdate) {
            this.OnUpdate()
        }
    },
    onKeyUp: function() {
        if (this.nodeSelect && this.nodeSelect.text() != this.nodeInput.val()) {
            this.setValue()
        }
        this.filter.type = "search";
        this.filter.where = this.nodeInput.val();
        this.createList()
    },
    onFocus: function() {
        var a = this;
        if (this.bind) {
            this.bind.filter = {
                type: "all",
                game: "",
                where: "",
                selected: "",
                list: "all"
            };
            this.bind.nodeInput.val("");
            this.bind.nodeInput.blur();
            this.bind.close()
        }
        if ((this.filter.type == "all" && !this.nodeInput.val().isEmpty()) || (this.filter.type != this.filter.list)) {
            this.createList()
        } else {
            if (this.showMode != "open" && this.scrollNodeWrap.css("height").replace("px", "") != "0") {
                this.iscroll.scrollTo(0, 0);
                this.open()
            }
        }
        this._timer = window.setInterval(function() {
            if (a.nodeSelect && a.nodeSelect.text() != a.nodeInput.val()) {
                a.setValue()
            }
            if (a.nodeInput.val() != a.filter.where) {
                a.createList()
            }
        }, 50)
    },
    onBlur: function() {
        window.clearInterval(this._timer)
    },
    scrollSetDate: function(d, a, e) {
        var b = this.options.me;
        var c = (b.codeList === undefined) ? null : b.codeList.join(",");
        ajaxRequest({
            url: "/_json/gamelist.php",
            data: {
                start: d,
                limit: a,
                rgCode: c,
                strType: e
            },
            scope: this,
            mask: false,
            success: function(l) {
                var m = this.options.me;
                if (m.codeList && (l.codelist && l.codelist.length > 0 && l.codelist != m.codeList.join(","))) {
                    return
                }
                var k = l.gamelist,
                    g = k.length,
                    f = m.viewcount,
                    i = f * 3,
                    h = m.nodeList,
                    j = false;
                if (g < 1) {
                    m.scrollNodeWrap.css("height", "0");
                    m.close()
                } else {
                    m.open();
                    h.children().show();
                    this.changePhase = false;
                    if (e) {
                        this.scrollTo(0, 0);
                        this.changePhase = true;
                        this.infiniteCache = undefined;
                        if (g < i) {
                            this.options.infiniteElements = h.children().slice(0, g);
                            h.children().slice(g).hide();
                            this._initInfinite()
                        } else {
                            this.options.infiniteElements = h.children().show();
                            this._initInfinite()
                        }
                        var n = (g < f) ? g : f;
                        m.scrollNodeWrap.css("height", h.children()[0].offsetHeight * n);
                        if (f >= g) {
                            this.scrollEnable = false
                        } else {
                            this.scrollEnable = true
                        }
                    }
                    this.updateCache(d, k);
                    this.options.infiniteLimit = Object.keys(this.infiniteCache).length;
                    this.refresh()
                }
            },
            error: function(f) {
                this.options.me.close()
            }
        })
    },
    updateContent: function(f, b) {
        try {
            var g = this.options.me,
                d = b.name,
                a = g.nodeInput.val(),
                c = a.length;
            if (d === "empty") {
                d = "검색 결과가 없습니다";
                $(f).off("click")
            } else {
                if (c > 0 && d.substr(0, c).toUpperCase() == a.toUpperCase()) {
                    d = '<span class="g_red1">' + (d.substr(0, c)) + "</span>" + (d.substr(c, d.length - c))
                }
                $(f).off("click").on("click", function() {
                    g.selectNode.call(g, this)
                })
            }
            f.innerHTML = d
        } catch (h) {
            return
        }
    },
    createElHtml: function(a) {
        var b = $("<" + this.childNodeString + " />").html(a);
        return b
    },
    createList: function() {
        var j = this,
            m = "",
            k = this.json,
            b = k.gamelist,
            d = this.nodeList,
            g = new Array(),
            f = b.length,
            l = this.filter.where = this.nodeInput.val(),
            a;
        if (!this.iscroll) {
            this.open();
            this.createScroll()
        }
        var h = this.iscroll;
        if (l == "") {
            this.filter.list = "all";
            m = "all";
            delete this.codeList
        } else {
            this.filter.list = "search";
            for (var e = 0; e < f; e++) {
                var c = b[e];
                if (this.compare(l.toUpperCase(), c.name.substring(0, l.length).toUpperCase()) == true && $.inArray(c.id, g) == -1) {
                    if (j.filterCode == null || j.filterCode != null && $.inArray(c.id, j.filterCode) != -1) {
                        g.push(c.id)
                    }
                }
            }
            this.codeList = g
        }
        h.options.dataset.call(h, 0, h.options.cacheSize, this.filter.list)
    },
    selectNode: function(a) {
        this.nodeSelect = $(a);
        if ("setText" in this) {
            this.setText($(a).text())
        }
        this.setValue(a);
        if ("onChange" in this) {
            this.onChange(a)
        }
        this.close();
        return false
    },
    setText: function(a) {
        this.nodeInput.val(a)
    },
    setValue: function(a) {
        if (typeof(a) === "object") {
            this.filter.selected = $.data(a, "id")
        } else {
            if (typeof(a) === "string") {
                this.filter.selected = a
            } else {
                this.filter.selected = ""
            }
        }
        this.nodeHidden.val(this.filter.selected)
    }
});
$.extend(_ServerList2, _GameList2, {
    strType: "server",
    xml: _serverdata.xml,
    filter: {
        type: "all",
        game: "",
        where: "",
        selected: ""
    },
    filterCode: null,
    nodeList: null,
    mode: "scroll",
    bind: null,
    onLoad: function() {
        var c = this,
            a = c.scrollNodeWrap[0].id,
            b = {
                me: c,
                mouseWheel: true,
                click: true
            };
        this.iscroll = new IScroll("#" + a, b);
        if (!this.filter.game.isEmpty()) {
            this.onLoadXML()
        }
    },
    onLoadXML: function() {
        ajaxRequest({
            url: "/_json/serverlist.php",
            data: "game=" + this.filter.game,
            scope: this,
            mask: false,
            success: this.onLoadComplete,
            error: this.onLoadError
        })
    },
    onLoadComplete: function(a) {
        this.json = a;
        this.createList()
    },
    onLoadError: function() {
        alert("Server List Load Fail.[881]")
    },
    createList: function() {
        var l = this,
            m = this.json,
            f = this.nodeList,
            d = m.serverlist,
            h = d.length,
            n = [],
            o = (this.filter.type == "search") ? this.nodeInput.val() : "";
        if (!this.iscroll) {
            this.open();
            this.createScroll()
        }
        var k = this.iscroll;
        this.open();
        k.scrollTo(0, 0);
        f.children().remove();
        for (var g = 0; g < h; g++) {
            var e = d[g],
                j = e.name;
            if (j != "서버전체" && this.compare(o.toUpperCase(), j.substring(0, o.length).toUpperCase()) == true) {
                if (l.filterCode == null || l.filterCode != null && $.inArray(e.id, l.filterCode) != -1) {
                    var c = o.length;
                    if (c > 0 && j.substr(0, c) == o) {
                        j = '<span class="ft_red">' + (j.substr(0, c)) + "</span>" + (j.substr(c, j.length - c))
                    }
                    var a = this.createElHtml(j)[0];
                    $.data(a, {
                        id: e.id
                    });
                    n.push(a)
                }
            }
        }
        var p = n.length,
            b = (l.viewcount < p) ? l.viewcount : p;
        if (p < 1) {
            this.close();
            return
        }
        f.append(n).css("height", f.children()[0].offsetHeight * p);
        this.scrollNodeWrap.css("height", f.children()[0].offsetHeight * b);
        if (o.isEmpty() && f.children().length < 2) {
            window.setTimeout(function() {
                l.selectNode.call(l, f.children()[0])
            }, 200)
        } else {
            f.children().on("click", function() {
                l.selectNode.call(l, this)
            })
        }
        if (b >= p) {
            k.scrollEnable = false
        } else {
            k.scrollEnable = true
        }
        k.refresh();
        window.setTimeout(function() {
            if (l.showMode == "open" && !l.nodeInput.is(":focus")) {
                l.nodeInput.focus()
            }
        }, 300)
    },
    onOpen: function() {
        if ((this.bind && this.bind.filter.selected.isEmpty()) && this.filter.game.isEmpty()) {
            this.close();
            alert("게임을 선택해주세요.");
            this.bind.nodeInput.focus();
            return
        }
    },
    onChange: function(a) {
        this.filter.type = "search";
        this.filter.where = $(a).text();
        this.filter.game = this.bind.filter.selected;
        this.filter.selected = $.data(a, "id");
        this.nodeInput.blur();
        if ("OnUpdate" in this && this.OnUpdate) {
            this.OnUpdate()
        }
    },
    onFocus: function() {
        var a = this;
        if ((this.bind && this.bind.filter.selected.isEmpty()) && this.filter.game.isEmpty()) {
            alert("게임을 선택해주세요.");
            this.bind.nodeInput.focus();
            return
        }
        if (this.bind && this.bind.showMode == "open") {
            this.bind.close()
        }
        this.filter.type = "all";
        if (this.bind && this.filter.game == this.bind.filter.selected) {
            this.createList()
        } else {
            if (this.bind) {
                this.filter.game = this.bind.filter.selected
            }
            this.onLoadXML()
        }
        this._timer = window.setInterval(function() {
            if (a.nodeSelect && a.nodeSelect.text() != a.nodeInput.val()) {
                a.setValue()
            }
            if (a.filter.type != "all" && a.nodeInput.val() != a.filter.where) {
                a.createList()
            }
        }, 50)
    },
    setValue: function(a) {
        if (typeof(a) === "object") {
            this.filter.selected = $.data(a, "ID")
        } else {
            if (typeof(a) === "string") {
                this.filter.selected = a
            } else {
                this.filter.selected = ""
            }
        }
        this.nodeHidden.val(this.filter.selected)
    }
});
