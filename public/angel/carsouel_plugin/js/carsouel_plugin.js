window.addEventListener('load', function() {
    initModule();
    checkLogo();
});

var defaultImages = {
};

var checkLogo = function() {
    var logoWrapper = document.querySelector('.siteHeader');
    if (logoWrapper == null) {
        return;
    }
    var url = window.getComputedStyle(logoWrapper).backgroundImage.slice(4, -1).replace(/['"]/g, '');
    if (url !== '') {
        var logoImg = new Image();
        logoImg.src = url;
        ValidationImg.check(logoImg,
            function() {

            }, function() {
                var logo = logoWrapper.querySelector('#hsds-nav__logo');
                logo.style.display = 'block';
            });
    }
};

var initModule = function() {
    var content = document.querySelectorAll('.banner_content');
    for (var i = 0; i < content.length; i++) {
        if (content[i] != null) {
            var img = content[i].childNodes[1].childNodes[1];
            (function(img, parent) {
                ValidationImg.check(img,
                    function(e) {

                    }, function(e) {
                        if (defaultImages[img.id] == undefined) {
                            parent.style.display = 'none';
                        } else {
                            img.setAttribute('src', defaultImages[img.id].img);
                            img.parentNode.setAttribute('href', defaultImages[img.id].link);
                            img.parentNode.setAttribute('target', '_blank');
                            img.parentNode.parentNode.style.height = defaultImages[img.id].height + 'px';
                        }

                    });
            })(img, content[i]);
        }
    }
};

var Layer_module = function(id) {
    var el = document.querySelector('#' + id);
    var layerImg = el.querySelector('.layer_image_wrapper').children[0].childNodes[1];

    (function(img, parent) {
        ValidationImg.check(img,
            function(e) {

            }, function(e) {
                el.style.display = 'none';
            });
    })(layerImg, el);

    return {
        closeLayer: function() {
            el.style.display = 'none';
        },
        addCookie: function() {
            var check = document.querySelector('#' + id + '_inptDeny');

            try {
                var checkVal = check.checked;
                if (checkVal) {
                    _cookie.add(id, 'deny', 1);
                } else {
                    _cookie.remove(id);
                }
            } catch (e) {
            }
        }
    };
};


var Carousel = function(bannerSelector, options) {

    var initOptions = {
        'showNavi': options == undefined || options.showNavi == undefined ? true : options.showNavi,
        'showIndicate': options == undefined || options.showIndicate == undefined ? true : options.showIndicate,
        'delay': options == undefined || options.delay == undefined ? 3000 : options.delay,
        'random': options == undefined || options.random == undefined ? true : options.random
    };

    var timer;

    var crOnMouseOver = false;
    var $crArea = bannerSelector;
    var code = $crArea.getAttribute('data-code');
    var $bannerArea = bannerSelector.querySelector('.banner_in');//$crArea.find('.banner_in');
    var $bannerIndicator = bannerSelector.querySelector('.banner_indicate');//$crArea.find('.banner_indicate');
    var bannerArr = $bannerArea.children;
    var checkedArr = [];
    var indexArr = [];
    if (bannerArr.length > 0) {
        for (var i = 0; i < bannerArr.length; i++) {
            (function(img, parent, i, callback) {
                ValidationImg.check(img,
                    function(e) {
                        checkedArr.push(i);
                        callback(i);
                    }, function(e) {
                        callback(i);
                    });
            })(bannerArr[i].childNodes[1].childNodes[1], bannerArr[i], i, function(i) {
                indexArr.push(i);
                if (bannerArr.length == indexArr.length) {
                    carouselSetting();
                }
            });
        }
    } else {
        carouselSetting();
    }


    function carouselSetting() {
        var idx = checkedArr.length - 1;

        for (var i = bannerArr.length - 1; i >= 0; i--) {
            if (checkedArr.indexOf(i) === -1) {
                bannerArr[i].parentNode.removeChild(bannerArr[i]);
            } else {
                bannerArr[i].setAttribute('data-idx', idx--);
            }
        }

        if (bannerArr.length == 0) {
            var statement = '<div class="banner_item" data-idx="0">';
            statement += '<a href="' + defaultImages[code].link + '" target="_blank">';
            statement += '<img class="carousel_images" src="' + defaultImages[code].img + '" alt="" title="">';
            statement += '</a>';
            statement += '</div>';
            $crArea.style.height = defaultImages[code].height + 'px';
            $bannerArea.insertAdjacentHTML('beforeend', statement);
        }

        var random = initOptions.random ? Math.floor(Math.random() * bannerSelector.querySelectorAll('.banner_item').length) : 0;

        $bannerArea.children[random].classList.add('banner_on');

        if (initOptions.showNavi) {
            $crArea.insertAdjacentHTML('beforeend', '<a href="javascript:;" class="arw prev" data-direction="prev" >ì´ì „</a><a href="javascript:;" class="arw next" data-direction="next">ë‹¤ìŒ</a>');
            var arrow = bannerSelector.querySelectorAll('.arw');
            for (var i = 0; i < arrow.length; i++) {
                arrow[i].addEventListener('click', function(e) {
                    direction(e);
                });
            }
        }

        if (initOptions.showIndicate) {
            for (var iForBA = 0; iForBA < bannerArr.length; iForBA++) {
                $bannerIndicator.insertAdjacentHTML('beforeend', '<span class="carousel_indicate" data-idx="' + iForBA + '"></span> ');
                var carouselIndicate = bannerSelector.querySelectorAll('.carousel_indicate');
                carouselIndicate[iForBA].addEventListener('click', function(e) {
                    indicateAction(e);
                });
            }

            carouselIndicate[random].classList.add('on');
        }

        // ìžë™ë¡¤ë§, ë°°ë„ˆê°€ í•œê°œë©´ ì•ˆí•¨
        if (bannerArr.length > 1) {
            setInterval(function() {
                // ë§ˆìš°ìŠ¤ì˜¤ë²„ì‹œ ìžë™ë¡¤ë§ ì•ˆí•¨
                if (crOnMouseOver) {
                    return;
                }
                bannerChange('next');
            }, initOptions.delay);

            // ë§ˆìš°ìŠ¤ì˜¤ë²„, ì•„ì›ƒ ì²´í¬
            $bannerArea.addEventListener('mouseover', function() {
                clearTimeout(timer);
                crOnMouseOver = true;
            });
            $bannerArea.addEventListener('mouseout', function() {
                timer = setTimeout(function() {
                    crOnMouseOver = false;
                }, initOptions.delay);
            });
        }

    }


    // í´ë¦­ì´ë²¤íŠ¸ ì¶”ê°€
    function indicateAction(e) {
        var targetIdx = e.target.getAttribute('data-idx');

        for (var i = 0; i < $bannerIndicator.children.length; i++) {
            $bannerIndicator.children[i].classList.remove('on');
            $bannerArea.children[i].classList.remove('banner_on');
        }

        $bannerIndicator.children[targetIdx].classList.add('on');
        $bannerArea.children[targetIdx].classList.add('banner_on');

        clearTimeout(timer);

        crOnMouseOver = true;
        timer = setTimeout(function() {
            crOnMouseOver = false;
        }, initOptions.delay);
    }

    // í´ë¦­ì´ë²¤íŠ¸ ì¶”ê°€
    function direction(e) {
        var dir = e.target.getAttribute('data-direction');
        switch (dir) {
            case 'prev':
                bannerChange('prev');
                break;
            case 'next':
                bannerChange('next');
                break;
        }
    }

    function bannerChange(dir) {
        var $currentBanner = $crArea.querySelector('.banner_item.banner_on');
        var nextIdx = 0;
        var $nextBanner = null;
        var dataIdx = Number($currentBanner.getAttribute('data-idx'));
        switch (dir) {
            case 'prev':
                nextIdx = dataIdx - 1;
                $nextBanner = nextIdx == -1 ? $bannerArea.children[bannerArr.length - 1] : $bannerArea.children[nextIdx];
                break;
            case 'next':
                nextIdx = dataIdx + 1;
                $nextBanner = nextIdx == bannerArr.length ? $bannerArea.children[0] : $bannerArea.children[nextIdx];
                break;
        }

        if (initOptions.showIndicate) {
            var $nextBannerIndi = null;

            for (var i = 0; i < $bannerIndicator.children.length; i++) {
                $bannerIndicator.children[i].classList.remove('on');
            }

            switch (dir) {
                case 'prev':
                    $nextBannerIndi = nextIdx == -1 ? $bannerIndicator.children[bannerArr.length - 1] : $bannerIndicator.children[nextIdx];
                    break;
                case 'next':
                    $nextBannerIndi = nextIdx == bannerArr.length ? $bannerIndicator.children[0] : $bannerIndicator.children[nextIdx];
                    break;
            }

            $nextBannerIndi.classList.add('on');
        }

        for (var i = 0; i < $bannerArea.children.length; i++) {
            $bannerArea.children[i].classList.remove('banner_on');
        }

        $nextBanner.classList.add('banner_on');
    }

};

var ValidationImg = {
    check: function(el, success, fail) {
        var imgCheck = new Image();
        imgCheck.onload = success;
        imgCheck.onerror = fail;
        imgCheck.src = el.src;
    }
};
