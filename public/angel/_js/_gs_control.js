(function($) {
    function extend(obj1, obj2) {
        for (var key in obj2) {
            if (typeof (obj2[key]) === 'object') {
                obj1[key] = [];
                for (var key2 in obj2[key]) {
                    obj1[key][key2] = obj2[key][key2];
                }
            } else {
                obj1[key] = obj2[key];
            }
        }
        return obj1;
    }

    var Suggest = {
        hangul: {
            rgJaumCode: [0x3131, 0x3132, 0x3134, 0x3137, 0x3138, 0x3139, 0x3141, 0x3142, 0x3143, 0x3145, 0x3146, 0x3147, 0x3148, 0x3149, 0x314a, 0x314b, 0x314c, 0x314d, 0x314e],
            cho: ['ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'],
            jung: ['ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ', 'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ', 'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ'],
            jong: ['', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'],
            _jung: ['ㅏ', '', '', '', 'ㅓ', 'ㅔ', '', '', 'ㅗ', '', '', '', '', 'ㅜ', '', '', '', '', 'ㅡ', 'ㅢ', 'ㅣ'],
            _jong: ['', 'ㄱ', '', '', 'ㄴ', '', '', 'ㅁ', 'ㄹ', '', '', '', '', '', '', '', '', 'ㅂ', '', '', 'ㅆ', 'ㅇ', '', '', '', '', '', '']
        },
        unicode: function(text) {
            var code = [];
            for (var i = 0; i < text.length; i++) {
                code[i] = text.substr(i, 1).charCodeAt(0);
            }
            return code;
        },
        trans: function(text) {
            var tmp = new Array();

            if ((text >= 0xAC00 && text <= 0xD7A3)) {
                var unicode = text - 0xAC00;
                var jongsung = unicode % 0x1C;
                var jungsung = ((unicode - jongsung) / 0x1C) % 0x15;
                var chosung = parseInt(((unicode - jongsung) / 0x1C) / 0x15, 10);

                tmp[0] = chosung;
                tmp[1] = jungsung;

                if (jongsung !== 0) {
                    tmp[2] = jongsung;
                }
            } else if (text >= 0x3131 && text <= 0x314e) {
                tmp[0] = $.inArray(text, this.hangul.rgJaumCode);
            } else {
                tmp[0] = text;
            }
            return tmp;
        },
        compare: function(org, tg) {
            var orgTmp = this.unicode(org);
            var tgTmp = this.unicode(tg);

            for (var i = 0; i < orgTmp.length; i++) {
                var inputTmp = this.trans(orgTmp[i]);
                var listTmp = this.trans(tgTmp[i]);

                for (var j = 0; j < inputTmp.length; j++) {
                    if (inputTmp[j] !== listTmp[j]) {
                        return false;
                    }
                }
            }
            return true;
        },
        getHangulList: function(srhList, word) {
            var len = srhList.length,
                k = 0, rgResult = [],
                strSubString;

            for (var i = 0; i < len; i++) {
                strSubString = (srhList[i].N).substring(0, word.length);
                if (this.compare(word.toUpperCase(), strSubString.toUpperCase()) === true) {
                    rgResult[k++] = srhList[i];
                }
            }
            return rgResult;
        }
    };

    var hide = function(el) {
        var rgClass = el.className.split(' ');
        var strClass = 'g_hidden';
        if (rgClass.indexOf(strClass) === -1) {
            el.className += ' ' + strClass;
        }
    };

    var show = function(el) {
        el.className = el.className.replace(/ g_hidden/g, '');
    };

    var GameServerList = function(container, params) {
        var game = {};
        var server = {};
        var goods = {};

        game = extend(game, params.game);
        server = extend(server, params.server);
        goods = extend(goods, params.goods);

        var m = this;
        m.container = $(container);
        if (m.container.length === 0) {
            return;
        }
        if (m.container.length > 1) {
            var gameserver = [];
            m.container.each(function() {
                gameserver.push(new GameServerList(this, params));
            });
            return gameserver;
        }

        m.container[0].gameserver = m;
        m.container.data('gameserver', m);
        if (typeof params.listContainer === 'object') {
            this.listContainer = params.listContainer[0];
        }

        var gameList = new GameList(m.container, game);
        gameList.gameserver = this;
        this.gameList = gameList;

        if (server.use === true) {
            var serverList = new ServerList(m.container, server);
            serverList.gameserver = this;
            this.serverList = serverList;
        }

        if (goods.use === true) {
            var goodsList = new GoodsList(m.container, goods);
            goodsList.gameserver = this;
            this.goodsList = goodsList;
        } else {
            this.serverList.listWrap.classList.add('server_t');
        }

        if (gameList.gameCode !== '') {
            gameList.changeAction = true;
            window.setTimeout(function() {
                gameList.createList.call(gameList);
            }, 10);
        }

        return this;
    };

    GameServerList.prototype = {
        onOpen: function(e) {
            if (this.gameserver && this.gameserver.listContainer.mode === 'open' || this.mode === 'open') {
                return;
            }

            if (this.gameserver && this.gameserver.listContainer) {
                this.gameserver.listContainer.mode = 'open';
                this.gameserver.listContainer.classList.remove('g_hidden');
            } else {
                this.mode = 'open';
            }

            show(this.listWrap);

            var m = this;
            this.tmpBlur = function(e) {
                m.onBlur.call(m, e);
            };

            document.addEventListener('click', m.tmpBlur);
        },
        onClose: function(e, t) {
            if (this.gameserver && this.gameserver.listContainer.mode === 'close' || this.mode === 'close') {
                return;
            }

            if (this.gameserver && this.gameserver.onCustomCloseBefore) {
                var closeCheck = this.gameserver.onCustomCloseBefore.call(this.gameserver, e);
                if (closeCheck === false) {
                    return;
                }
            }

            var m = this;
            if (this.gameserver && this.gameserver.listContainer) {
                this.gameserver.listContainer.mode = 'close';
                this.gameserver.listContainer.classList.add('g_hidden');
            } else {
                this.mode = 'close';
                hide(this.listWrap);
            }

            document.removeEventListener('click', m.tmpBlur);

            if (t === 'blur') {
                if (m.blurSetTimeout) {
                    window.clearTimeout(m.blurSetTimeout);
                }

                if (this.blurAction === true) {
                    this.blurAction = false;
                    this.changeAction = true;

                    if (this.gameserver && this.gameserver.gameList && this.gameserver.gameList.selectedData) {
                        if (this.gameserver.serverList) {
                            hide(this.gameserver.serverList.listWrap);
                        }
                        if (this.gameserver.goodsList) {
                            hide(this.gameserver.goodsList.listWrap);
                        }

                        m.blurSetTimeout = setTimeout(function() {
                            var resultList = Suggest.getHangulList(m.data, '');
                            m.createList(resultList);
                        }, 1);
                    }
                }

                if (m.gameserver && m.gameserver.viewValue && m.gameserver.viewValue !== document.querySelector(m.gameserver.gameList.autoComplete).value) {
                    document.querySelector(m.gameserver.gameList.autoComplete).value = m.gameserver.viewValue;
                    document.querySelector(m.gameserver.gameList.autoComplete).classList.remove('placeholder');
                }

                if (m.gameserver.gameList.autoComplete !== false) {
                    var me;
                    var pos = m.gameserver.gameList.position;
                    if (pos === 'game') {
                        me = m.gameserver.gameList;
                    } else if (pos === 'server') {
                        me = m.gameserver.serverList;
                    } else if (pos === 'goods') {
                        me = m.gameserver.goodsList;
                    }

                    if (me && me.selectedIndex && me.list.children[me.selectedIndex]) {
                        me.list.children[me.selectedIndex].classList.remove('focus');
                        delete me.selectedIndex;
                    }
                }
            }
        },
        onBlur: function(e) {
            var listContainer = this.listWrap;
            if (this.gameserver && this.gameserver.listContainer) {
                listContainer = this.gameserver.listContainer;
            }

            extend(document.querySelector(this.autoComplete), _gui);
            extend(listContainer, _gui);
            var rgPointer = _event.pointer(e);
            var rgBound = document.querySelector(this.autoComplete).getBound();
            var rgBoundList = listContainer.getBound();
            if ((rgPointer.x >= rgBound.x && rgPointer.x <= (rgBound.x + rgBound.width) && rgPointer.y >= rgBound.y && rgPointer.y <= (rgBound.y + rgBound.height)) || (rgPointer.x >= rgBoundList.x && rgPointer.x <= (rgBoundList.x + rgBoundList.width) && rgPointer.y >= rgBoundList.y && rgPointer.y <= (rgBoundList.y + rgBoundList.height))) {
                return;
            }

            this.onClose(e, 'blur');
        },
        getValue: function() {
            var returns = {};
            if (this.hidden_use.code) {
                returns.code = document.querySelector(this.hidden_use.code).value;
            }
            if (this.hidden_use.text) {
                returns.text = document.querySelector(this.hidden_use.text).value;
            }

            return returns;
        },
        setValue: function(code, txt) {

            var m = this;

            if (code) {
                document.querySelector(this.hidden_use.code).value = code;
            }

            if (txt) {
                document.querySelector(this.hidden_use.text).value = txt;
            }

            if (code === '' && txt === '') {
                if (this.selected) {
                    this.selected.classList.remove('sel_on');
                    this.selected = null;
                    this.selectedData = null;
                }
            }

            if (this.type === 'game' && this.data === null) {
                this.getData(function() {
                    m.setValue(code, txt);
                });
                return;
            }

            if (this.type === 'server') {
                var gameVal = this.gameserver.gameList.getValue();
                if (gameVal.code !== this.gameCode) {
                    this.gameCode = gameVal.code;
                    this.getData(function() {
                        m.setValue(code, txt);
                    });
                    return;
                }
            }

            var list = this.data;
            var len = list.length;
            for (var i = 0; i < len; i++) {
                if (list[i].C == code) {
                    if (this.type === 'goods') {
                        this.selectedData = {idx: i, code: list[i].C, name: list[i].N};
                    }
                    this.selectedData = {
                        idx: i,
                        code: list[i].C,
                        name: list[i].N,
                        unit: list[i].U,
                        search: list[i].S,
                        level: list[i].L,
                        chr_trade: list[i].V
                    };
                    this.blurAction = true;
                    break;
                }
            }
        }
    };

    var GameList = function(container, params) {
        if (container.length === 0) {
            return;
        }

        extend(this, params);

        this.type = 'game';
        this.searchText = '';

        container[0].gameList = this;
        container.data('gameList', this);

        this.listWrap = document.createElement('div');
        this.listWrap.className = 'game g_hidden';
        if (this.title === true) {
            var title = document.createElement('div');
            title.classList.add('title');
            title.innerHTML = '게임선택';
            this.listWrap.appendChild(title);
        }
        this.list = document.createElement('ul');
        container[0].appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);
        this.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';

        if (this.hidden_use && document.querySelector(this.hidden_use.code).value.isEmpty() === false) {
            this.gameCode = document.querySelector(this.hidden_use.code).value;
        }

        if (this.autoComplete !== null || this.autoComplete !== false) {
            this.setKeyEvent();
        }

        if (this.view === true) {
            this.createList();
            show(this.listWrap);
        }
    };

    GameList.prototype = {
        autoComplete: '#searchGameServer',
        view: false,
        data: null,
        request: true,
        gameCode: '',
        notGames: [45, 512],
        tradeType: '',
        hidden_use: {
            code: '[name="search_game"]',
            text: '[name="search_game_text"]'
        },
        getData: function(callback) {
            var m = this;
            if (_gameListData === null) {
                ajaxRequest({
                    url: '/_json/gamelist.php',
                    dataType: 'json',
                    async: false,
                    success: function(res) {
                        _gameListData = res;
                        m.data = res;
                        if (callback) {
                            callback.call(m, m.data);
                        }
                    }
                });
            } else {
                m.data = _gameListData;
                if (callback) {
                    callback.call(m, m.data);
                }
            }
        },
        createList: function(list) {
            if (list === undefined) {
                if (this.data === null) {
                    this.getData(this.createList);
                    return;
                } else {
                    list = this.data;
                }
            }

            if (this.hidden_use) {
                if (this.hidden_use.code) {
                    document.querySelector(this.hidden_use.code).value = '';
                }
                if (this.hidden_use.text) {
                    document.querySelector(this.hidden_use.text).value = '';
                }
            }

            var m = this;
            var len = list.length;
            var inputVal = document.querySelector(this.autoComplete).value;
            var selected;

            m.list.innerHTML = '';
            for (var i = 0; i < len; i++) {
                var childNode = document.createElement('li');
                var strInner = list[i].N;

                if (inputVal !== '' && strInner.indexOf(inputVal) !== -1) {
                    strInner = '<span class="f_red1">' + inputVal + '</span>' + (list[i].N.substr(inputVal.length, list[i].N.length));
                }
                childNode.innerHTML = strInner;
                childNode.addEventListener('click', function(e) {
                    m.onChange.call(m, this, e);
                });

                if (list[i].L === 2) {
                    childNode.className = 'new';
                } else if (list[i].L === 1) {
                    childNode.className = 'pop';
                } else if (list[i].L === 3) {
                    childNode.className = 'mobile';
                } else if (list[i].L === 4) {
                    childNode.className = 'channeling';
                }

                $.data(childNode, {
                    idx: i,
                    code: list[i].C,
                    name: list[i].N,
                    unit: list[i].U,
                    search: list[i].S,
                    level: list[i].L,
                    chr_trade: list[i].V
                });
                m.list.appendChild(childNode);

                if (selected === undefined && this.selectedData) {
                    if (this.selectedData.code === list[i].C && this.selectedData.level === list[i].L) {
                        selected = childNode;
                    }
                }

                if (m.gameCode !== '' && String(m.gameCode) === String(list[i].C)) {
                    m.selected = childNode;
                    m.selected.classList.add('sel_on');
                    m.selectedData = $.data(childNode);
                    m.gameCode = '';
                }
            }

            if (selected !== undefined) {
                this.selected = selected;
            }

            if (this.selected) {
                if (m.changeAction === true) {
                    this.onChange(this.selected);
                }
            }
        },
        onChange: function(el, e) {
            var elData = $.data(el);
            if (this.selected) {
                if (String(elData.code) === String(this.getValue().code)) {
                    return;
                }
                this.selected.classList.remove('sel_on');
            }
            el.classList.add('sel_on');
            this.selected = el;
            this.selectedData = elData;

            if (this.autoComplete !== false) {
                this.blurAction = false;
                if (this.gameserver) {
                    this.gameserver.viewValue = this.selectedData.name;
                    if (this.gameserver.serverList.allView === true) {
                        this.gameserver.viewValue += ' > 서버전체';
                    }
                }
                document.querySelector(this.autoComplete).value = this.gameserver.viewValue;
                document.querySelector(this.autoComplete).classList.remove('placeholder');

                delete this.position;
                if (this.selectedIndex && this.list.children[this.selectedIndex]) {
                    this.list.children[this.selectedIndex].classList.remove('focus');
                }

            }

            if (this.hidden_use) {
                if (this.hidden_use.code) {
                    document.querySelector(this.hidden_use.code).value = this.selectedData.code;
                }
                if (this.hidden_use.text) {
                    document.querySelector(this.hidden_use.text).value = this.selectedData.name;
                }
            }

            if (this.gameserver === undefined) {
                hide(this.listWrap);
            }

            if (this.gameserver && this.gameserver.serverList) {
                if (e) {
                    this.gameserver.serverList.setValue('', '');
                    if (this.gameserver.goodsList) {
                        this.gameserver.goodsList.setValue('', '');
                    }
                }

                if (this.gameserver.serverList.request === true) {
                    if (this.gameserver.serverList.gameCode != this.selectedData.code) {
                        this.gameserver.serverList.gameCode = this.selectedData.code;
                        this.gameserver.serverList.data = null;
                    }
                }

                this.gameserver.serverList.list.scrollTop = 0;
                this.gameserver.serverList.view = true;
                this.gameserver.serverList.createList();
            }
            if (this.gameserver && this.gameserver.goodsList) {

                /* 캐릭터 거래 */
                if (this.selectedData.chr_trade.toUpperCase() === 'Y') {
                    this.gameserver.goodsList.data[3].V = true;
                } else {
                    this.gameserver.goodsList.data[3].V = false;
                }

                /* 비게임 (싸이월드 216, 기타 45, 상품권 512) */
                if (this.selectedData.code === 216) {
                    this.gameserver.goodsList.exceptCode = ['item'];
                    this.gameserver.goodsList.data[1].N = '도토리';
                    this.gameserver.goodsList.createList();
                } else if (this.notGames.indexOf(this.selectedData.code) !== -1) {
                    this.gameserver.goodsList.exceptCode = ['money', 'item'];
                    this.gameserver.goodsList.createList();
                } else {
                    this.gameserver.goodsList.exceptCode = [];
                    this.gameserver.goodsList.data[1].N = this.selectedData.unit;
                    this.gameserver.goodsList.createList();
                }
            }

            if (this.onCustomChange) {
                this.onCustomChange.call(this, el, e);
            }
        },
        setKeyEvent: function() {
            var m = this;

            if (m.useKeyboard !== false) {
                document.body.addEventListener('keydown', function(e) {
                    m.onKeydown.call(this, m, e);
                });
            }

            document.querySelector(this.autoComplete).addEventListener('keyup', function(e) {
                m.onKeyup.call(this, m, e);
            });

            document.querySelector(this.autoComplete).addEventListener('focus', function(e) {
                m.onFocus.call(this, m);
            });
        },
        onKeydown: function(m, e) {

            if (m.mode !== 'open' && m.gameserver.listContainer.mode !== 'open') {
                return;
            }

            var kc = _event.keycode(e);
            if (kc == _event.KEY_RETURN || kc == _event.KEY_DOWN || kc == _event.KEY_UP || kc == _event.KEY_LEFT || kc == _event.KEY_RIGHT) {
                document.querySelector(m.autoComplete).blur();
            }

            if (m.position === undefined) {
                m.position = 'game';
                m.gameserver.gameList.selectedIndex = -1;
            }
            if (m.position !== 'goods' && m.gameserver.goodsList && m.gameserver.goodsList.listWrap.classList.contains('g_hidden') === false && m.gameserver.serverList.selected) {
                m.position = 'goods';
                m.gameserver.goodsList.selectedIndex = 0;
            } else if (m.position !== 'goods' && m.position !== 'server' && m.gameserver.serverList && m.gameserver.serverList.list.children.length > 0 && m.gameserver.serverList.listWrap.classList.contains('g_hidden') === false) {
                m.position = 'server';
                delete m.gameserver.serverList.selectedIndex;
            }

            var me;
            if (m.position === 'game') {
                me = m.gameserver.gameList;
            } else if (m.position === 'server') {
                me = m.gameserver.serverList;
            } else if (m.position === 'goods') {
                me = m.gameserver.goodsList;
            }

            var selectedIndex = me.selectedIndex;
            var list = me.list;
            var child = list.children;

            if (selectedIndex == undefined && me.selected) {
                selectedIndex = Array.prototype.indexOf.call(child, me.selected);
            }

            if (kc == _event.KEY_RETURN) {
                _event.stop(e);

                var selectEl;

                if (selectedIndex == undefined) {
                    var len = child.length;
                    for (var i = 0; i < len; i++) {
                        var d = $.data(child[i]);
                        if (d.name === this.value) {
                            selectEl = child[i];
                            break;
                        }
                    }
                } else {
                    selectEl = child[selectedIndex];
                }

                if (m.position === 'game' && m.gameserver.serverList !== undefined) {
                    m.position = 'server';
                    m.gameserver.serverList.selectedIndex = -1;
                } else if (m.position === 'server' && m.gameserver.goodsList !== undefined) {
                    m.position = 'goods';
                    m.gameserver.goodsList.selectedIndex = 0;
                }

                me.selectedIndex = selectedIndex;

                if (selectEl != undefined) {
                    selectEl.classList.remove('focus');
                    me.onChange(selectEl, e);
                }

            } else if (kc == _event.KEY_UP || kc == _event.KEY_DOWN || kc == _event.KEY_LEFT || kc == _event.KEY_RIGHT) {
                _event.stop(e);

                if ((kc == _event.KEY_LEFT || kc == _event.KEY_RIGHT) && me.updownIndex === undefined) {
                    return;
                }

                var updownIndex = (me.updownIndex === undefined) ? 1 : me.updownIndex;
                var maxIndex = child.length - 1;
                var base = {
                    index: 1,
                    offset: -(54 + (child[0].clientHeight * 5))
                };
                var el;

                if (selectedIndex == undefined) {
                    selectedIndex = 0;
                } else {
                    if (kc == _event.KEY_RIGHT || kc == _event.KEY_DOWN) {
                        if (m.position === 'server' && kc == _event.KEY_DOWN) {
                            base.index = updownIndex;
                        }
                    } else if (kc == _event.KEY_LEFT || kc == _event.KEY_UP) {
                        base.index = -(base.index);
                        if (m.position === 'server' && kc == _event.KEY_UP) {
                            base.index = -(updownIndex);
                        }
                    }

                    el = child[selectedIndex];

                    selectedIndex += base.index;
                }

                if (selectedIndex < 0 || selectedIndex > maxIndex) {
                    return;
                }

                if (el) {
                    el.classList.remove('focus');
                }

                me.selectedIndex = selectedIndex;
                el = child[me.selectedIndex];
                el.classList.add('focus');
                me.list.scrollTop = el.offsetTop + base.offset;

            }
        },
        onKeyup: function(m, e) {

            var kc = _event.keycode(e);
            if (kc == _event.KEY_RETURN || kc == _event.KEY_DOWN || kc == _event.KEY_UP || kc == _event.KEY_LEFT || kc == _event.KEY_RIGHT) {
                return;
            }

            if (m.searchText !== this.value) {

                delete m.position;
                m.selectedIndex = -1;
                m.searchText = this.value;

                if (m.keyuupEventQueue) {
                    window.clearTimeout(m.keyuupEventQueue);
                }

                m.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                m.changeAction = false;
                m.blurAction = true;

                var val = this.value;
                m.keyuupEventQueue = window.setTimeout(function() {
                    if (m.gameserver.serverList) {
                        hide(m.gameserver.serverList.listWrap);
                        delete m.gameserver.serverList.selectedIndex;
                    }
                    if (m.gameserver.goodsList) {
                        hide(m.gameserver.goodsList.listWrap);
                    }
                    var resultList = Suggest.getHangulList(m.data, val);
                    m.createList(resultList);
                }, 1);
            }
        },
        onFocus: function(m) {
            if (m.focusSetTimeout) {
                window.clearTimeout(m.focusSetTimeout);
            }
            m.changeAction = false;
            this.value = '';
            m.onOpen();

            m.focusSetTimeout = setTimeout(function() {
                if (m.data === null) {
                    m.createList();
                }
            });


            if (m.selected) {
                var scrollTop = m.selected.offsetTop - 184;
                m.list.scrollTop = scrollTop;
                if (m.selectedIndex != undefined && m.list.children[m.selectedIndex]) {
                    m.list.children[m.selectedIndex].classList.remove('focus');
                }
                m.selectedIndex = Array.prototype.indexOf.call(m.list.children, m.selected);
            } else {
                m.list.scrollTop = 0;
            }

            if (m.gameserver.serverList) {
                if (m.gameserver.serverList.selected) {
                    var scrollTop = m.gameserver.serverList.selected.offsetTop - 184;
                } else {
                    var scrollTop = 0;
                }
                m.gameserver.serverList.list.scrollTop = scrollTop;
            }
        }
    };

    extend(GameList.prototype, GameServerList.prototype);

    var ServerList = function(container, params) {
        if (container.length === 0) {
            return;
        }

        var container = $(container);

        extend(this, params);
        this.type = 'server';
        container[0].serverList = this;
        container.data('serverList', this);

        this.listWrap = document.createElement('div');
        this.listWrap.className = 'server g_hidden';
        if (this.title === true) {
            var title = document.createElement('div');
            title.classList.add('title');
            title.innerHTML = '서버선택';
            this.listWrap.appendChild(title);
        }
        this.list = document.createElement('ul');
        container[0].appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);

        if (this.hidden_use) {
            if (this.hidden_use.code != '' && document.querySelector(this.hidden_use.code).value.isEmpty() === false) {
                this.serverCode = document.querySelector(this.hidden_use.code).value;
            }
            if (this.hidden_use.text != '' && document.querySelector(this.hidden_use.text).value.isEmpty() === false) {
                this.serverText = document.querySelector(this.hidden_use.text).value;
            }
        }

        if (this.gameCode === '') {
            return;
        }

        if (this.autoComplete !== null && this.autoComplete !== false) {
            this.listWrap.classList.add('gs_list_wrap');
            this.setKeyEvent();
        }

        if (this.selected) {
            this.selected.classList.add('sel_on');
        }
    };

    ServerList.prototype = {
        autoComplete: false,
        view: false,
        data: null,
        request: true,
        allView: true,
        gameCode: '',
        serverCode: '',
        serverText: '',
        exceptCode: [],
        hidden_use: {
            code: '[name="search_server"]',
            text: '[name="search_server_text"]'
        },
        getData: function(callback) {
            var m = this;
            $.ajax({
                url: '/_xml/serverlist.php',
                dataType: 'xml',
                data: 'game=' + m.gameCode,
                async: false,
                success: function(res) {
                    var serverList = res.getElementsByTagName('SERVER');
                    var len = serverList.length;
                    var result = [];
                    for (var i = 0; i < len; i++) {
                        if (m.allView !== true) {
                            if (serverList[i].getAttribute('ID') === '0') {
                                continue;
                            }
                        }
                        result.push({
                            'C': serverList[i].getAttribute('ID'),
                            'N': serverList[i].getAttribute('NAME'),
                            'U': serverList[i].getAttribute('UNIT')
                        });
                    }
                    m.data = JSON.parse(JSON.stringify(result));
                    if (callback) {
                        callback.call(m, m.data);
                    }
                }
            });
        },
        createList: function(list) {
            if (this.gameCode === '') {
                alert('게임을 선택해주세요.');
                return;
            }

            if (list === undefined) {
                if (this.data === null) {
                    this.getData(this.createList);
                    return;
                } else {
                    list = this.data;
                }
            }

            if (this.hidden_use) {
                if (this.hidden_use.code) {
                    document.querySelector(this.hidden_use.code).value = '';
                }
                if (this.hidden_use.text) {
                    document.querySelector(this.hidden_use.text).value = '';
                }
            }

            var m = this;
            var len = list.length;
            var selected;

            m.list.innerHTML = '';
            for (var i = 0; i < len; i++) {
                if (m.exceptCode.indexOf(list[i].C) === -1) {
                    var childNode = document.createElement('li');
                    childNode.innerHTML = list[i].N;
                    childNode.addEventListener('click', function(e) {
                        m.onChange.call(m, this, e);
                    });

                    if (this.allView === true && i === 0) {
                        childNode.className = 'all';
                    }

                    $.data(childNode, {idx: i, code: list[i].C, name: list[i].N, unit: list[i].U});
                    this.list.appendChild(childNode);

                    if (this.serverCode !== '' && (String(this.serverCode) === String(list[i].C) || this.serverText === list[i].N)) {
                        this.selected = childNode;
                        this.serverCode = '';
                        this.serverText = '';
                    }

                    if (selected === undefined && this.selectedData) {
                        if (this.selectedData.code === list[i].C) {
                            selected = childNode;
                        }
                    }
                }
            }

            if (this.view === true) {
                show(this.listWrap);
            }

            if (this.gameserver && this.gameserver.goodsList) {
                show(this.gameserver.goodsList.listWrap);
            }

            if (selected !== undefined) {
                this.selected = selected;
            }

            // if(this.allView === true && this.selected == null) {
            // 	this.list.children[0].classList.add('focus');
            // 	this.selectedIndex = 0;
            // }

            if (this.selected) {
                var scrollTop = m.selected.offsetTop - 184;
                m.list.scrollTop = scrollTop;
                if (m.gameserver && m.gameserver.gameList.changeAction === true) {
                    this.onChange(this.selected);
                }
            }
        },
        onChange: function(el, e) {
            var elData = $.data(el);
            if (this.selected) {
                this.selected.classList.remove('sel_on');
            }
            el.classList.add('sel_on');
            this.selected = el;
            this.selectedData = elData;

            if (this.autoComplete !== false) {
                document.querySelector(this.autoComplete).value = this.selectedData.name;
            } else if (this.gameserver.gameList.autoComplete !== false) {
                var gameAutoComplete = this.gameserver.gameList.autoComplete;
                var inputAutoComplete = document.querySelector(gameAutoComplete);
                inputAutoComplete.value = this.gameserver.gameList.selectedData.name + ' > ' + this.selectedData.name;
                inputAutoComplete.classList.remove('placeholder');
                this.gameserver.viewValue = inputAutoComplete.value;

                delete this.position;
                if (this.selectedIndex && this.list.children[this.selectedIndex]) {
                    this.list.children[this.selectedIndex].classList.remove('focus');
                }
            }

            if (this.hidden_use) {
                if (this.hidden_use.code) {
                    document.querySelector(this.hidden_use.code).value = this.selectedData.code;
                }
                if (this.hidden_use.text) {
                    document.querySelector(this.hidden_use.text).value = this.selectedData.name;
                }
            }

            if (e && this.onCustomChange) {
                this.onCustomChange.call(this, el, e);
            }

            if (this.gameserver === undefined) {
                hide(this.listWrap);
            }

            if (e && this.gameserver && this.gameserver.goodsList) {
                if (this.gameserver.goodsList.selected) {
                    this.gameserver.goodsList.onChange(this.gameserver.goodsList.selected);
                } else {
                    this.gameserver.goodsList.onChange(this.gameserver.goodsList.list.childNodes[0]);
                }
            }
        },
        setKeyEvent: function() {
            var m = this;
            document.querySelector(this.autoComplete).addEventListener('keyup', function() {
                if (m.searchText !== this.value) {
                    m.searchText = this.value;

                    if (m.keyuupEventQueue) {
                        window.clearTimeout(m.keyuupEventQueue);
                    }
                    m.list.innerHTML = '<li class="search_ing">검색중입니다....</li>';
                    m.changeAction = false;

                    var val = this.value;
                    m.keyuupEventQueue = window.setTimeout(function() {
                        var resultList = Suggest.getHangulList(m.data, val);
                        m.createList(resultList);
                    }, 1);
                }
            });

            document.querySelector(this.autoComplete).addEventListener('focus', function() {
                if (m.focusSetTimeout) {
                    window.clearTimeout(m.focusSetTimeout);
                }
                m.changeAction = false;
                m.onOpen();

                m.focusSetTimeout = setTimeout(function() {
                    if (m.data === null) {
                        m.createList();
                    }
                });

                if (m.selected) {
                    var scrollTop = m.selected.offsetTop - 184;
                    m.list.scrollTop = scrollTop;
                }
            });
        }
    };

    extend(ServerList.prototype, GameServerList.prototype);

    var GoodsList = function(container, params) {
        if (container.length === 0) {
            return;
        }

        extend(this, params);
        this.type = 'goods';
        container[0].goodsList = this;
        container.data('goodsList', this);

        this.listWrap = document.createElement('div');
        this.listWrap.className = 'goods g_hidden';
        if (this.title === true) {
            var title = document.createElement('div');
            title.classList.add('title');
            title.innerHTML = '물품종류';
            this.listWrap.appendChild(title);
        }
        this.list = document.createElement('ul');
        container[0].appendChild(this.listWrap);
        this.listWrap.appendChild(this.list);

        if (this.hidden_use && document.querySelector(this.hidden_use.code).value.isEmpty() === false) {
            this.goodsCode = document.querySelector(this.hidden_use.code).value;
        }

        if (this.allView === true) {
            this.data[0].V = true;
        }

        // this.createList();

        // if (this.selected) {
        // 	this.selected.classList.add('sel_on');
        // }
    };

    GoodsList.prototype = {
        view: false,
        allView: false,
        goodsCode: '',
        data: [
            {'C': 'all', 'N': '물품전체', 'V': false},
            {'C': 'money', 'N': '게임머니', 'V': true},
            {'C': 'item', 'N': '아이템', 'V': true},
            {'C': 'character', 'N': '캐릭터', 'V': false, 'NI':true},
            {'C': 'etc', 'N': '기타', 'V': true}
        ],
        hidden_use: {
            code: '[name="search_goods"]',
            text: ''
        },
        exceptCode: [],
        createList: function() {
            var m = this;
            var list = this.data;
            var len = list.length;
            var selected;

            m.list.innerHTML = '';
            for (var i = 0; i < len; i++) {
                if (this.exceptCode.indexOf(list[i].C) === -1) {
                    if (list[i].V === true) {
                        var childNode = document.createElement('li');
                        childNode.innerHTML = list[i].N;
                        childNode.addEventListener('click', function(e) {
                            m.onChange.call(m, this, e);
                        });

                        if(list[i].NI === true) {
                            var icon = document.createElement('span');
                            icon.classList.add('icon_new');
                            childNode.appendChild(icon);
                        }

                        $.data(childNode, {idx: i, code: list[i].C, name: list[i].N});
                        m.list.appendChild(childNode);

                        if (m.goodsCode !== '' && String(m.goodsCode) === String(list[i].C)) {
                            selected = childNode;
                            m.selectedData = $.data(childNode);
                            m.goodsCode = '';
                        }

                        if (selected === undefined && m.selectedData) {
                            if (m.selectedData.code === list[i].C) {
                                selected = childNode;
                            }
                        }
                    }
                }
            }

            if (m.view === true) {
                show(m.listWrap);
            }

            if (selected !== undefined) {
                m.selected = selected;
            }

            if (m.selected) {
                m.onChange(m.selected);
            }
        },
        onChange: function(el, e) {
            if (this.gameserver && this.gameserver.serverList && this.gameserver.serverList.getValue().code == '') {
                alert('서버를 선택해주세요.');
                return;
            }

            if (this.selected) {
                this.selected.classList.remove('sel_on');
            }
            el.classList.add('sel_on');
            this.selected = el;
            this.selectedData = $.data(el);

            if (this.gameserver && this.gameserver.gameList && this.gameserver.gameList.autoComplete !== false) {
                var gameAutoComplete = this.gameserver.gameList.autoComplete;
                var inputAutoComplete = document.querySelector(gameAutoComplete);
                if (this.gameserver.serverList.selectedData) {
                    inputAutoComplete.value = this.gameserver.gameList.selectedData.name + ' > ' + this.gameserver.serverList.selectedData.name + ' > ' + this.selectedData.name;
                    inputAutoComplete.classList.remove('placeholder');
                    this.gameserver.viewValue = inputAutoComplete.value;
                }
            }

            if (this.hidden_use) {
                if (this.hidden_use.code) {
                    document.querySelector(this.hidden_use.code).value = this.selectedData.code;
                }
                if (this.hidden_use.text) {
                    document.querySelector(this.hidden_use.text).value = this.selectedData.name;
                }
            }

            if (this.onCustomChange) {
                this.onCustomChange.call(this, el, e);
            }

            if (e !== undefined) {
                var m = this;
                setTimeout(function() {
                    m.onClose();
                }, 100);
            }
        }
    };

    extend(GoodsList.prototype, GameServerList.prototype);

    window.Suggest = Suggest;
    window.GameList = GameList;
    window.ServerList = ServerList;
    window.GoodsList = GoodsList;
    window.GameServerList = GameServerList;
})(jQuery);

// 게임데이터
var _gamedata = {xml: null, xsl: null};
var _serverdata = {xml: null, xsl: null};
var strkey = '20150813';

/* ▼ SUGGEST */
var _suggest = $.extend({}, _selectbox);
$.extend(_suggest, {
    modeView: 'slide',
    view_count: 20,
    widthMargin: 10,
    initialize: function(nodeList) {
        $.extend(this, _gui);

        var g_this = this;
        var thisName = $(this).attr('name');

        $(this).addClass('g_selectbox');
        var nodeSelected = $(this).find('input').eq(0);

        if ($(this).onchange !== null) {
            this.OnUpdate = $(this).onchange;
        }

        var input_obj = $('<input />', {
            type: 'hidden',
            name: thisName
        });
        this.nodeInput = input_obj.appendTo($(this));

        input_obj = $('<input />', {
            type: 'text',
            name: thisName + '_text'
        }).addClass('g_search_input');
        $(this).removeAttr('name');

        if ('OnKeyDown' in this) {
            input_obj.bind('keydown', function(evt) {
                g_this.OnKeyDown(evt);
            });
        }
        if ('OnKeyUp' in this) {
            input_obj.bind('keyup', function(evt) {
                g_this.OnKeyUp(evt);
            });
        }
        if ('OnFocus' in this) {
            input_obj.bind('focus', function(evt) {
                g_this.OnFocus(evt);
            });
        }
        if ('OnBlur' in this) {
            input_obj.bind('blur', function(evt) {
                g_this.OnBlur(evt);
            });
        }
        this.nodeSearch = input_obj.appendTo($(this));

        // 파이어폭스
        if (_BROWSER.name === 'FF') {
            if (typeof (window.instances) === 'undefined') {
                window.instances = [];
            }

            var thisClass = this;
            this.keyEventCheck = null;
            this.db = null;
            window.instances[this.nodeSearch.attr('name')] = this;

            var focusFunc = function() {
                if (!thisClass.keyEventCheck) thisClass.watchInput();
            };

            var blurFunc = function() {
                if (thisClass.keyEventCheck) {
                    window.clearInterval(thisClass.keyEventCheck);
                    thisClass.keyEventCheck = null;
                }
            };

            $(this.nodeSearch).bind('focus', focusFunc);
            $(this.nodeSearch).bind('blur', blurFunc);

            this.watchInput = function() {
                if (this.db !== $(this.nodeSearch).val()) {
                    $(this.nodeSearch).trigger('keyup');
                }
                this.db = $(this.nodeSearch).val();

                if (this.keyEventCheck) window.clearInterval(this.keyEventCheck);
                this.keyEventCheck = window.setInterval("window.instances['" + this.nodeSearch.attr('name') + "'].watchInput()", 100);
            };
        }

        if (nodeList) {
            this.modeView = 'fix';
            this.nodeList = $.extend(nodeList, _gui);
            this.nodeList.addClass('g_selectbox_list');

            this.open = function(params) {
                if ('OnOpen' in this) this.OnOpen(params);
            };
            this.close = function(type) {
                if ('OnClose' in this && type !== 'default') this.OnClose();
            };
        } else {
            this.nodeList = $('<DIV />').addClass('g_selectbox_list').appendTo(rootObj);
            this.nodeList.css('overflow', 'auto');
            $.extend(this.nodeList, _gui);

            this.nodeButton = $('<div />').addClass('arrow_img').appendTo($(this));
            this.nodeButton.click(function() {
                if (g_this.mode === 'open') {
                    g_this.close();
                } else {
                    g_this.open();
                }
            });

            var rgBound = this.getBound();
            this.changeSize(rgBound.width);
            this.close();
        }

        if (this.modeView === 'fix' && this.type === 'gamelist') {
            if (nodeSelected && nodeSelected.attr('name') === 'selected' && !nodeSelected.val().isEmpty() && ('applyDefault' in this)) {
                this.status = {type: 'sub', where: nodeSelected.val(), duplicate: true, selected: nodeSelected.val()};
            }
            this.open();
        } else if ('status' in this && $(this).attr('id') !== 'g_SEARCHBAR_GAME' && $(this).attr('id') !== 'dvGame') {
            this.status = {active: true, type: 'all', where: null, duplicate: false};
        }

        if (nodeSelected && nodeSelected.attr('name') === 'selected' && !nodeSelected.val().isEmpty() && ('applyDefault' in this)) {
            if (this.type === 'gamelist') {
                this.applyDefault(nodeSelected.val());
            }

            this.selectedValue = nodeSelected.val();
            nodeSelected.remove();
        } else if (this.type === 'gamelist') {
            this.nodeSearch.val('게임검색');
        } else if (this.type === 'serverlist') {
            this.nodeSearch.val('서버검색');
        }

        if (this.type === 'serverlist') {
            this.applyDefault();
        }
    },
    changeSize: function(w) {
        var nOuterWidth = this.nodeButton.outerWidth(true);
        $(this).css('width', w + 'px');
        this.nodeList.css('width', w + 'px');
        this.nodeSearch.css('width', w - nOuterWidth - this.widthMargin + 'px');
    },
    addOption: function(pos, rgValue, text) {
        var node = $('<div />');
        $(node).text(text);

        if (pos === null || this.nodeList.children().length < 1 || this.nodeList.children().length < pos) {
            this.nodeList.append(node);
        } else if (pos === 0) {
            this.nodeList.prepend(node);
        } else {
            this.nodeList.append(node);
        }

        try {
            return node;
        } finally {
            node = null;
        }
    },
    setText: function(text) {
        this.nodeSearch.val(text);
    },
    getText: function() {
        return this.nodeSearch.val();
    },
    fnSelect: function(id) {
        var rgList = this.nodeList.find('DIV');
        var length = rgList.length;
        if (length < 2) {
            if (length === 1 && this.modeView !== 'slide') {
                rgList.eq(0).trigger('click');
            }
            return;
        }

        for (var i = 0; i < length; i++) {
            if (rgList.eq(i).attr('value') === id) {
                rgList.eq(i).trigger('click');
                return;
            }
        }
    },
    hangul: {
        rgJaumCode: [0x3131, 0x3132, 0x3134, 0x3137, 0x3138, 0x3139, 0x3141, 0x3142, 0x3143, 0x3145, 0x3146, 0x3147, 0x3148, 0x3149, 0x314a, 0x314b, 0x314c, 0x314d, 0x314e],
        cho: ['ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'],
        jung: ['ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ', 'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ', 'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ'],
        jong: ['', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'],
        _jung: ['ㅏ', '', '', '', 'ㅓ', 'ㅔ', '', '', 'ㅗ', '', '', '', '', 'ㅜ', '', '', '', '', 'ㅡ', 'ㅢ', 'ㅣ'],
        _jong: ['', 'ㄱ', '', '', 'ㄴ', '', '', 'ㅁ', 'ㄹ', '', '', '', '', '', '', '', '', 'ㅂ', '', '', 'ㅆ', 'ㅇ', '', '', '', '', '', '']
    },
    unicode: function(text) {
        var code = new Array();
        for (var i = 0; i < text.length; i++) {
            code[i] = text.substr(i, 1).charCodeAt(0);
        }
        return code;
    },
    trans: function(text) {
        var tmp = new Array();

        if ((text >= 0xAC00 && text <= 0xD7A3)) {
            var unicode = text - 0xAC00;
            var jongsung = unicode % 0x1C;
            var jungsung = ((unicode - jongsung) / 0x1C) % 0x15;
            var chosung = parseInt(((unicode - jongsung) / 0x1C) / 0x15);

            tmp[0] = chosung;
            tmp[1] = jungsung;

            if (jongsung !== 0) {
                tmp[2] = jongsung;
            }
        } else if (text >= 0x3131 && text <= 0x314e) {
            tmp[0] = $.inArray(text, this.hangul.rgJaumCode);
        } else {
            tmp[0] = text;
        }
        return tmp;
    },
    compare: function(org, tg) {
        var orgTmp = new Array();
        var tgTmp = new Array();

        orgTmp = this.unicode(org);
        tgTmp = this.unicode(tg);

        for (var i = 0; i < orgTmp.length; i++) {
            var inputTmp = this.trans(orgTmp[i]);
            var listTmp = this.trans(tgTmp[i]);

            for (var j = 0; j < inputTmp.length; j++) {
                if (inputTmp[j] !== listTmp[j]) {
                    return false;
                }
            }
        }
        return true;
    },
    getHangulList: function(word) {
        var strType = 'game',
            getAttr = 'name';
        if (this.type === 'serverlist') {
            strType = 'SERVER',
                getAttr = 'NAME';
        }
        var objXml = _xml.getElements(this.xml, strType),
            k = 0, rgResult = new Array(),
            strSubString;

        for (var i = 0; i < objXml.length; i++) {
            strSubString = objXml[i].getAttribute(getAttr).substring(0, word.length);
            if (this.compare(word, strSubString.toUpperCase()) === true && $.inArray(strSubString, rgResult) === -1) {
                rgResult[k++] = strSubString;
            }
        }
        return rgResult;
    }
});
/* ▲ SUGGEST */

var _gamelist = $.extend({}, _suggest);
$.extend(_gamelist, {
    type: 'gamelist',
    xml: _gamedata.xml,
    xsl: _gamedata.xsl,
    bind: null,
    template: '',
    status: {active: true, type: 'all', where: null, duplicate: false, selected: ''},
    applyDefault: function(strValue) {
        this.open({type: 'sub', where: strValue});
        this.close();
    },
    OnOpen: function(params) {
        var g_this = this;

        if (this.nodeSearch.val() === '게임검색' || this.nodeSearch.val() === '서버검색') {
            this.nodeSearch.val('');
        }
        if (!this.status.active && !(this.bind && this.bind.status.type === 'sub')) {
            return;
        }
        if (this.bind && this.bind.mode === 'open') {
            this.bind.close();
        }
        this.nodeMove = null;

        if (params) {
            if (this.status.type === params.type && this.status.where === params.where) {
                return;
            }

            this.status.type = params.type;
            this.status.where = params.where;

            if ('selected' in params && !params.selected.isEmpty()) {
                this.status.selected = params.selected;
            }
        } else {
            this.status = {active: true, type: 'all', where: null, duplicate: false};
        }

        this.nodeList.children().remove();
        if (this.modeView === 'slide') {
            this.nodeList.css('height', 'auto');
        }
        var loading = this.addOption(null, null, '검색중입니다...');
        loading.click = _DISABLE;
        loading.mouseover = _DISABLE;
        loading.mouseout = _DISABLE;

        this.loadXML();
    },
    loadXML: function() {
        ajaxRequest({
            scope: this,
            url: '/_xml/gamelist.xml',
            dataType: 'xml',
            cache: 6,
            success: this.OnLoadXML,
            error: this.OnError
        });
    },
    OnLoadXML: function(request) {
        var g_this = this;
        if (_gamedata.xsl) {
            this.xsl = _gamedata.xsl;
        }

        if (this.xml && this.xsl) {
            this.setMode();
            this.fnPrint.delay(100, this);
        } else {
            this.xml = new Object(request);
            ajaxRequest({
                scope: this,
                url: '/_xslt/gamelist' + this.template + '.xsl',
                dataType: 'xml',
                cache: true,
                success: this.OnLoadXSLT,
                error: this.OnError
            });
        }
    },
    OnLoadXSLT: function(request) {
        if (this.type === 'gamelist') {
            _gamedata.xsl = request;
        } else {
            _serverdata.xsl = request;
        }
        this.xsl = request;
        this.setMode();
        this.fnPrint();
    },
    OnError: function() {
        this.close();
        this.nodeList.children().remove();
        this.open(this.status);
    },
    OnChange: function(optionObj) {
        this.status = {type: 'search', where: optionObj.attr('value')};
        this.nodeSearch.val($(optionObj).text());

        if (this.bind) {
            this.bind.setValue('');
            this.bind.nodeSelect = null;
            this.bind.nodeSearch.val('');
            this.bind.status.active = true;
            this.bind.status.duplicate = false;
            this.bind.open({type: 'sub', where: optionObj.attr('value')});
            this.bind.nodeSearch.focus();
        }
        this.nodeSearch.blur();

        if ('OnChangeAfter' in this) {
            this.OnChangeAfter.call(this);
        }
    },
    OnFocus: function() {
        if (this.nodeSearch.val() === '게임검색') {
            this.nodeSearch.val('');
        }
        this.status.active = true;
        if (this.bind) {
            if (this.modeView === 'fix') {
                this.bind.nodeList.children().remove();
            }
            this.bind.nodeSelect = null;
            this.bind.setValue('');
            this.bind.nodeSearch.val('');
            this.bind.close();
        }
        this.OnKeyUp();
    },
    OnBlur: function() {
        if (!this.nodeSearch.val().isEmpty()) {
            var objSelected = null;
            var strText = this.nodeSearch.val().trim();
            var objItem = null;


            this.nodeList.children().each(function() {
                if ($(this).get(0).tagName !== 'DIV') {
                    return false;
                }

                objItem = $(this).text().trim();
                if (objItem && objItem.toUpperCase() === strText.toUpperCase()) {
                    objSelected = $(this);
                }
            });

            this.nodeSelect = objSelected;
        }
    },
    OnClose: function() {
        if (!this.nodeSearch.val().isEmpty()) {
            var objSelected = null;
            var strText = this.nodeSearch.val().trim();
            var objItem = null;

            this.nodeList.children().each(function() {
                if ($(this).get(0).tagName !== 'DIV') {
                    return false;
                }

                objItem = $(this).text().trim();
                if (objItem && objItem.toUpperCase() === strText.toUpperCase()) {
                    objSelected = $(this);
                }
            });

            if (objSelected) {
                this.nodeSelect = objSelected;
                var strValue = this.nodeSelect.attr('value');
                this.setValue(strValue);
                this.nodeSearch.val(this.nodeSelect.text());
                return;
            }
        }

        this.setValue('');
        this.nodeSelect = null;
        this.nodeSearch.val('');
        if (this.bind) {
            if (this.bind.mode === 'open') this.bind.close();
            this.bind.nodeSelect = null;
        }
    },
    OnMouseOver: function(option) {
        this.nodeMove = option;
    },
    OnKeyUp: function(Event) {
        var keycode = _event.keycode(Event);
        if (keycode === _event.KEY_RETURN) {
            return;
        }
        if (this.status.where === this.nodeSearch.val() && this.type === 'serverlist') {
            return false;
        }
        if (keycode === _event.KEY_UP || keycode === _event.KEY_PAGEUP || keycode === _event.KEY_DOWN || keycode === _event.KEY_PAGEDOWN) {
            return;
        }

        if (this.status.type !== 'sub' && this.nodeSearch.val().isEmpty()) {
            this.status = {active: true, type: 'all', where: null};
            this.close();
            if (this.modeView === 'fix' && this.type === 'gamelist') {
                this.open();
            }
            if (this.bind) {
                this.bind.status = {active: true, type: 'all', where: null};
            }
        } else if (this.type === 'serverlist') {
            this.open({type: 'sub', where: this.nodeSearch.val().trim(), duplicate: false});
        } else {
            this.open({type: 'search', where: this.nodeSearch.val().trim()});
        }
    },
    OnKeyDown: function(Event) {
        var keycode = _event.keycode(Event);
        if (keycode === _event.KEY_RETURN) {
            if (this.nodeMove) {
                this.nodeMove.trigger('click');
            }
            _event.stop(Event);
            if (this.type === 'serverlist' && this.modeView === 'slide') {
                this.nodeSearch.blur();
            }
            return false;
        } else if (keycode === _event.KEY_UP || keycode === _event.KEY_PAGEUP || keycode === _event.KEY_DOWN || keycode === _event.KEY_PAGEDOWN) {
            if (this.nodeList.children().length < 1) {
                return;
            }
            var flow = (keycode === _event.KEY_UP || keycode === _event.KEY_PAGEUP) ? 'up' : 'down';
            if (flow === 'up') {
                if (!this.nodeMove) {
                    _event.stop(Event);
                    return;
                } else if (this.nodeList.children().first().get(0) === this.nodeMove.get(0)) {
                    if (keycode === _event.KEY_PAGEUP) return;
                    this.nodeList.scrollTop = '0px';
                    _event.stop(Event);
                    return;
                }

                this.nodeMove.mouseout();
                if (keycode === _event.KEY_UP) {
                    this.nodeMove = this.nodeMove.prev();
                } else {
                    var node = this.nodeMove;
                    for (var i = 0; i < this.view_count; i++) {
                        if (node.prev().length > 0) {
                            node = node.prev();
                            if (node === this.nodeList.children().first()) {
                                break;
                            }
                        } else {
                            break;
                        }
                    }
                    this.nodeMove = node;
                }
                this.nodeMove.mouseover();

                if (this.nodeList.scrollTop() > this.nodeMove.offset().top) {
                    this.nodeList.scrollTop(this.nodeMove.offset().top - 3);
                }
            } else {
                if (!this.nodeMove) {
                    this.nodeMove = this.nodeList.children().first();
                    this.nodeMove.mouseover();
                    this.status.active = false;
                    return;
                } else if (this.nodeMove.get(0) === this.nodeList.children().last().get(0)) {
                    _event.stop(Event);
                    return;
                }

                this.nodeMove.mouseout();
                if (keycode === _event.KEY_DOWN) {
                    this.nodeMove = this.nodeMove.next();
                } else {
                    var node = this.nodeMove;
                    for (var i = 0; i < this.view_count; i++) {
                        if (node.next().length) {
                            node = node.next();
                            if (node === this.nodeList.children().last()) {
                                break;
                            }
                        } else {
                            break;
                        }
                    }
                    this.nodeMove = node;
                }
                this.nodeMove.mouseover();

                var height = this.nodeList.getBound().height;
                if (height < this.nodeMove.offset().top - 100) {
                    this.nodeList.scrollTop(parseInt(this.nodeList.scrollTop() + 20));
                }
            }
        } else {
            if (this.type === 'serverlist' && this.status.type === 'sub') {
                this.status.duplicate = true;
            }
            this.status.active = true;
            return true;
        }
    },
    setMode: function() {
        var tagFor = _xml.getElement(this.xsl, 'xsl:for-each', 0);
        var tagVar = _xml.getElement(this.xsl, 'xsl:variable', 0);
        tagVar.setAttribute('select', 0);

        if (this.status.type === 'all') {
            tagFor.setAttribute('select', '/gamelist/game');
        } else if (this.status.type === 'sub') {
            tagFor.setAttribute('select', "/gamelist/game[@id='" + this.status.where + "']");
        } else if (this.status.type === 'search') {
            var inputValue = this.status.where.toUpperCase(),
                rgWord = this.getHangulList(inputValue),
                inputLen = 0,
                query = '/gamelist/game[';

            if (rgWord.length < 1) {
                rgWord[0] = inputValue;
            }

            if (inputValue.substr(inputValue.length - 1, inputValue.length) === rgWord[0].substr(rgWord[0].length - 1, rgWord[0].length).toUpperCase()) {
                inputLen = inputValue.length;
            }

            var rgWordLen = rgWord.length;

            for (var i = 0; i < rgWordLen; i++) {
                if (i !== 0) query += ' or ';
                query += "starts-with(@name,'" + rgWord[i] + "')";
            }
            query += ']';


            tagFor.setAttribute('select', query);
            tagVar.setAttribute('select', inputLen);
        }
    },
    fnPrint: function() {
        this.nodeList.children().remove();
        var g_this = this;

        _xslt.parseXML(this.nodeList, this.xml, this.xsl);

        this.nodeList.children().bind({
            click: function(e) {
                g_this.fnClick($(this));
                e.stopPropagation();
            },
            mouseover: function() {
                g_this.fnMouseover($(this));
            },
            mouseout: function() {
                g_this.fnMouseout($(this));
            }
        });

        if (this.nodeList.children().length < 1) {
            var result = this.addOption(null, null, '검색결과가 없습니다.');
            result.click = _DISABLE;
            result.mouseover = _DISABLE;
            result.mouseout = _DISABLE;
        }
        //		else if((!this.bind || (this.bind && this.bind.type==='serverlist')) && this.status.type==='sub') {
        else if ((this.bind && this.bind.type === 'serverlist') && this.status.type === 'sub') {
            this.nodeSelect = this.nodeList.children().first();
            var rgInfo = this.nodeSelect;

            this.setValue(rgInfo.attr('value'));
            this.nodeSearch.val($(rgInfo).text());
        }

        if ('selected' in this.status && !this.status.selected.isEmpty()) {
            this.fnSelect(this.status.selected);
        }

        if (this.modeView === 'fix') {
        } else if (this.nodeList.children().length > this.view_count) {
            this.nodeList.css('height', ($.extend(this.nodeList.children().get(0), _gui).getBound().height * this.view_count + 9) + 'px');
            this.nodeList.css('overflow', 'auto');
        } else {
            this.nodeList.css('height', 'auto');
        }

        if ('selectedValue' in this && this.selectedValue.isEmpty() === false) {
            if (this.type === 'gamelist') {
                if (this.bind && 'useDefault' in this.bind && $.isFunction(this.bind.useDefault) === true) {
                    this.bind.useDefault(this.selectedValue);
                    this.bind.useDefault = null;
                }
            } else if (this.type === 'serverlist') {
                this.fnSelect(this.selectedValue);
            }
            this.selectedValue = '';
        }
    },
    fnClick: function(thisObj) {
        this.nodeSelect = $(thisObj);
        if ('setText' in this) this.setText($(thisObj).text());
        this.setValue($(thisObj).attr('value'));
        if ('OnChange' in this) this.OnChange($(thisObj));
        this.close();
    },
    getUnit: function() {
        if (this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="unit"]').val();
            } catch (Err) {
                return '';
            }
        }
        return '';
    }
});

// 서버리스트
var _serverlist = {};
$.extend(_serverlist, _gamelist);
$.extend(_serverlist, {
    type: 'serverlist',
    xml: _serverdata.xml,
    xsl: _serverdata.xsl,
    status: {active: true, type: 'sub', where: null, duplicate: false, selected: ''},
    exceptCode: null,
    applyDefault: function() {
        this.useDefault = function(strValue) {
            this.open({type: 'sub', where: strValue});
            this.close();
        };
    },
    OnOpen: function(params) {
        if (!this.status.active) {
            return;
        }
        if (this.bind && this.bind.getValue().isEmpty()) {
            this.close();
            alert('게임을 선택해 주세요.');
            this.bind.nodeSearch.focus();
            return;
        }

        this.nodeMove = null;

        if (params) {
            this.status.type = params.type;
            this.status.where = params.where;
        }

        this.nodeList.children().remove();
        if (this.modeView === 'slide') {
            this.nodeList.css('height', 'auto');
        }
        var loading = this.addOption(null, null, '검색중입니다...');
        loading.click = _DISABLE;
        loading.mouseover = _DISABLE;
        loading.mouseout = _DISABLE;

        this.loadXML();
    },
    loadXML: function() {
        var g_this = this;
        if (this.status.type === 'search' || this.status.type === 'sub' && this.status.duplicate === true) {
            this.setMode();
            this.fnPrint.delay(100, this);
            return;
        }

        ajaxRequest({
            scope: this,
            url: '/_xml/serverlist.php',
            dataType: 'xml',
            data: 'game=' + this.status.where,
            cache: 6,
            success: this.OnLoadXML,
            error: this.OnError
        });
    },
    OnLoadXML: function(request) {
        var g_this = this;
        this.xml = new Object(request);
        if (_serverdata.xsl) {
            this.xsl = _serverdata.xsl;
        }

        if (this.xsl) {
            this.setMode();
            this.fnPrint.delay(100, this);
        } else {
            ajaxRequest({
                scope: this,
                url: '/_xslt/serverlist' + this.template + '.xsl',
                dataType: 'xml',
                cache: true,
                success: this.OnLoadXSLT,
                error: this.OnError
            });
        }
    },
    OnChange: function(optionObj) {
        var rgInfo = optionObj.find("input[name='gamecode']");
        this.nodeSearch.val($(optionObj).text());

        if (this.status.type !== 'sub') {
            this.status = {type: 'search', where: optionObj.attr('value')};
            if (this.bind) {
                this.bind.status.active = true;
                this.bind.open({type: 'sub', where: rgInfo.val()});
                this.bind.close();
                this.bind.status.active = false;
                this.status.active = true;
                this.open({type: 'sub', where: rgInfo.val()});
                this.status.active = false;
                this.close();
            }
        } else {
            if (this.bind) {
                if (!this.bind.nodeSelect || this.bind.nodeSelect.attr('value') !== rgInfo.val()) {
                    this.bind.status.active = true;
                    this.bind.open({type: 'sub', where: rgInfo.val()});
                    this.bind.close();
                    this.bind.status.active = false;
                }
            }
            this.status.active = false;
            this.close();
        }

        if ('OnChangeAfter' in this) {
            this.OnChangeAfter.call(this);
        }
    },
    OnFocus: function() {
        if (this.nodeSearch.val() === '서버검색') {
            this.nodeSearch.val('');
        }
        if (this.bind && this.bind.getValue().isEmpty()) {
            this.close();
            alert('게임을 선택해 주세요.');
            this.bind.nodeSearch.focus();
            return;
        }
        if (this.bind && this.bind.mode === 'open') {
            this.bind.close();
        }
        if (this.status.type === 'sub') {
            this.status.active = false;
            if (this.mode !== 'open') {
                this.open();
            }
        }
    },
    OnClose: _ENABLE,
    OnBlur: function() {
        var objSelected = null;
        var strText = this.nodeSearch.val().trim();
        var objItem = null;

        this.nodeList.children().each(function() {
            if ($(this).get(0).tagName !== 'DIV') {
                return false;
            }

            objItem = $(this).text().trim();
            if (objItem && objItem.toUpperCase() === strText.toUpperCase()) {
                objSelected = $(this);
            }
        });

        if (objSelected && this.nodeSelect !== objSelected) {
            this.setValue(objSelected.attr('value'));
        }

        this.nodeSelect = objSelected;
        if (!this.nodeSelect) {
            this.setValue('');
            this.status.active = true;
        }
    },
    setMode: function() {
        var tagFor = _xml.getElement(this.xsl, 'xsl:for-each', 0);
        var tagVar = _xml.getElement(this.xsl, 'xsl:variable', 0);
        tagVar.setAttribute('select', 0);

        if (this.status.type === 'sub' || this.status.type === 'search') {
            var exceptCode = this.exceptCode;
            if (this.status.type === 'sub' && !this.status.duplicate) {
                var query = '/SERVERLIST/SERVER',
                    subQuery = '', subQuery2 = '';

                if (this.modeView !== 'slide') {
                    subQuery = "(not(@TYPE) or @TYPE!=='all')";
                }
                if (exceptCode !== null && exceptCode.length > 0) {
                    if (subQuery !== '') {
                        subQuery2 += ' and ';
                    }

                    subQuery2 += '(';

                    var exceptLen = exceptCode.length;
                    for (var i = 0; i < exceptLen; i++) {
                        if (i !== 0) subQuery2 += ' and ';
                        subQuery2 += "@ID !== '" + exceptCode[i] + "'";
                    }

                    subQuery2 += ')';
                }

                if (subQuery !== '' || subQuery2 !== '') {
                    query += '[' + subQuery + subQuery2 + ']';
                }

                tagFor.setAttribute('select', query);
            } else {
                var inputValue = ((this.status.type === 'sub') ? this.nodeSearch.val() : this.status.where).toUpperCase(),
                    rgWord = this.getHangulList(inputValue),
                    inputLen = 0,
                    query = '/SERVERLIST/SERVER[(';

                if (rgWord.length < 1) {
                    rgWord[0] = inputValue;
                } else if (inputValue.substr(inputValue.length - 1, inputValue.length) === rgWord[0].substr(rgWord[0].length - 1, rgWord[0].length)) {
                    inputLen = inputValue.length;
                }

                var rgWordLen = rgWord.length;

                for (var i = 0; i < rgWordLen; i++) {
                    if (i !== 0) query += ' or ';
                    query += "starts-with(@NAME,'" + rgWord[i] + "')";
                }

                if (exceptCode !== null && exceptCode.length > 0) {
                    query += ' and (';
                    var exceptLen = exceptCode.length;
                    for (var i = 0; i < exceptLen; i++) {
                        if (i !== 0) query += ' and ';
                        query += "@ID !== '" + exceptCode[i] + "'";
                    }
                    query += ')';
                }

                query += (this.modeView !== 'slide') ? ") and (not(@TYPE) or @TYPE!=='all')" : ')';
                query += ']';

                tagFor.setAttribute('select', query);
                tagVar.setAttribute('select', inputLen);
            }
        } else {
            return;
        }
    },
    getMoney: function() {
        if (this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="money"]').val();
            } catch (Err) {
                return '';
            }
        }
        return '';
    },
    getMoneyUnit: function() {
        if (this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="money_unit"]').val();
            } catch (Err) {
                return '';
            }
        }
        return '';
    },
    getUnit: function() {
        if (this.nodeSelect) {
            try {
                return this.nodeSelect.find('input[name="unit"]').val();
            } catch (Err) {
                return '';
            }
        }
        return '';
    }
});
