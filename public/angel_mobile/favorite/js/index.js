window.addEventListener('load',function(){
    var bookmark = document.querySelectorAll('.bookmark');
    var saveBtn = document.querySelector('#save_btn');
    var backBtn = document.getElementById("back_btn");
    this.count = document.querySelector('.count');

    userBookmarkList();

    for(var i=0; i<bookmark.length; i++)
    {
        bookmark[i].addEventListener('click',function(){
            var getEls = document.querySelectorAll('.bookmark.on').length;
            //8개 이상 선택할 수 없게 제한
            if((getEls <= 6) || (getEls = 7 && this.classList.contains('on'))){
                selected(this);
            }else{
                alert("7개까지만 선택 가능합니다.");
            }
        })
    }

    saveBtn.addEventListener('click', function(){
        saveAction(this);
    });
    backBtn.addEventListener('click', function(){
        location.href="/";
    });
});

function userBookmarkList(){
    ajaxRequest({
        url: '',//유저 저장 북마크리스트 get
        type:'GET',
        dataType:'json',
        success : function(res){
            this.count.innerText = res.length;
        }
    });
}

function selected(el){
    el.classList.toggle('on');
    el.querySelector('.icon_check').classList.toggle('on');
    el.querySelector('.bookmark_icon').classList.toggle('on');
}

function saveAction(el){
    // if (!fnCheckLogin()) {
    //     return;
    // }
    var enabled = el.getAttribute('data-enabled');
    if(enabled == 'true')
    {
        el.setAttribute('data-enabled', false);
        var seqArr = [];
        var activeElement = document.querySelectorAll('.bookmark.on');
        for(var i=0; i<activeElement.length; i++)
        {
            seqArr.push(activeElement[i].getAttribute('data-seq'))
        }
        if(seqArr.length != 7)
        {
            alert('메뉴는 7개로 선택해주세요.');
            el.setAttribute('data-enabled', true);
            return;
        }
        ajaxRequest({
            url: '_ajax_bookmark.php',//유저 북마크 리스트 저장
            type:'POST',
            data: {bookmark : seqArr},
            dataType:'json',
            success : function(res){
                if(res.result == 'success') {
                    el.setAttribute('data-enabled', true);
                    alert('즐겨찾기에 추가했습니다.');
                    location.href="/";
                }else{
                    alert(res.message);
                }
            }
        });
    }
    else
    {
        alert('저장 진행 중입니다.')
    }

}
