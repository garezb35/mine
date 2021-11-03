var Carousel = function(bannerSelector,options){

    var initOptions = {
        'showNavi':options==undefined || options.showNavi==undefined?true:options.showNavi,
        'showIndicate':options==undefined || options.showIndicate==undefined?true:options.showIndicate,
        'delay': options==undefined || options.delay==undefined?3000:options.delay,
        'random':options==undefined || options.random==undefined?true:options.random
    };

    var timer;

    var crOnMouseOver = false;
    var $crArea = bannerSelector;
    var $bannerArea = bannerSelector.querySelector('.banner_in');//$crArea.find('.banner_in');
    var $bannerIndicator = bannerSelector.querySelector('.banner_indicate');//$crArea.find('.banner_indicate');
    var bannerArrLength = $bannerArea.children.length;
    var random = initOptions.random?Math.floor(Math.random() * bannerSelector.querySelectorAll('.banner_item').length):0;



    setTimeout(function(){
        $bannerArea.children[random].classList.add('banner_on');
        $crArea.style.width = $bannerArea.children[0].childNodes[1].width+'px';
        $crArea.style.height = $bannerArea.children[0].childNodes[1].height+'px';

        if(initOptions.showNavi)
        {
            $crArea.insertAdjacentHTML('beforeend','<a href="javascript:;" class="arw prev" data-direction="prev" >이전</a><a href="javascript:;" class="arw next" data-direction="next">다음</a>')
            var arrow = bannerSelector.querySelectorAll('.arw')
            for(var i=0; i<arrow.length; i++)
            {
                arrow[i].addEventListener('click', function(e){
                    direction(e)
                })
            }
        }

        if(initOptions.showIndicate)
        {
            for (var iForBA = 0; iForBA < bannerArrLength; iForBA++) {
                $bannerIndicator.insertAdjacentHTML('beforeend','<span class="carousel_indicate" data-idx="'+iForBA+'"></span> ');
            }

            var carouselIndicate = bannerSelector.querySelectorAll('.carousel_indicate');

            for(var i=0; i<carouselIndicate.length; i++)
            {
                carouselIndicate[i].addEventListener('click', function(e){
                    indicateAction(e);
                })
            }

            carouselIndicate[random].classList.add('on');
        }
    },100);


    // 클릭이벤트 추가
    function indicateAction(e){
        var targetIdx = e.target.getAttribute('data-idx');

        for(var i=0; i<$bannerIndicator.children.length; i++)
        {
            $bannerIndicator.children[i].classList.remove('on');
        }

        for(var i=0; i<$bannerArea.children.length; i++)
        {
            $bannerArea.children[i].classList.remove('banner_on');
        }

        $bannerIndicator.children[targetIdx].classList.add('on')
        $bannerArea.children[targetIdx].classList.add('banner_on')

        clearTimeout(timer);

        crOnMouseOver = true;
        timer = setTimeout(function() {
            crOnMouseOver = false;
        }, initOptions.delay);
    }
    // 클릭이벤트 추가
    function direction(e){
        var dir = e.target.getAttribute('data-direction');
        switch(dir){
            case 'prev':
                bannerChange('prev');
                break;
            case 'next':
                bannerChange('next');
                break;
        }
    }

    function bannerChange(dir){
        var $currentBanner = $crArea.querySelector('.banner_item.banner_on');
        var nextIdx = 0;
        var $nextBanner = null;
        var dataIdx =  Number($currentBanner.getAttribute('data-idx'));
        switch(dir){
            case 'prev':
                nextIdx = dataIdx-1;
                $nextBanner = nextIdx == -1 ? $bannerArea.children[bannerArrLength-1] : $bannerArea.children[nextIdx];
                break;
            case 'next':
                nextIdx = dataIdx+1;
                $nextBanner  = nextIdx == bannerArrLength ? $bannerArea.children[0] : $bannerArea.children[nextIdx];
                break;
        }

        if(initOptions.showIndicate)
        {
            var $nextBannerIndi = null;

            for(var i=0; i<$bannerIndicator.children.length; i++)
            {
                $bannerIndicator.children[i].classList.remove('on');
            }

            switch(dir){
                case 'prev':
                    $nextBannerIndi =  nextIdx == -1 ? $bannerIndicator.children[bannerArrLength-1] : $bannerIndicator.children[nextIdx];
                    break;
                case 'next':
                    $nextBannerIndi  = nextIdx == bannerArrLength ? $bannerIndicator.children[0] : $bannerIndicator.children[nextIdx];
                    break;
            }

            $nextBannerIndi.classList.add('on');
        }

        for(var i=0; i<$bannerArea.children.length; i++)
        {
            $bannerArea.children[i].classList.remove('banner_on');
        }

        $nextBanner.classList.add('banner_on');
    }

    // // 자동롤링, 배너가 한개면 안함
    if (bannerArrLength > 1) {
        setInterval(function() {
            // 마우스오버시 자동롤링 안함
            if (crOnMouseOver) return;
            bannerChange('next');
        }, initOptions.delay);

        // 마우스오버, 아웃 체크
        $bannerArea.addEventListener('mouseover',function() {
            clearTimeout(timer);
            crOnMouseOver = true;
        });
        $bannerArea.addEventListener('mouseout',function() {
            timer = setTimeout(function() {
                crOnMouseOver = false;
            }, initOptions.delay);
        });
    }

};
