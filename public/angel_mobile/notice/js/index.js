window.addEventListener('load',function(){
    this.wrapper = document.getElementById('notice_wrapper');
    (function fnNotice() {
        try {
            ajaxRequest({
                // 수정
                // url: '/tmp/popup_notice.xml',
                url: '',
                dataType: 'xml',
                type: 'get',
                success: function(xml) {

                    var xmlP = xml.getElementsByTagName('LIST');
                    if (xmlP[0].getAttribute('applys') === 'Y') {

                        var title = document.getElementById('notice_title');
                        var content = document.getElementById('notice_content');
                        var btn = document.getElementById('notice_close');

                        title.innerText = xmlP[0].getAttribute('subject');

                        var textArr =  xmlP[0].getAttribute('content').split('\\n');
                        var statement = ""

                        for(var i=0; i<textArr.length; i++)
                        {
                            if(textArr[i] != "")
                            {
                                statement += '<span>'+textArr[i]+'</span>'
                            }
                            statement += '<br/>'
                        }

                        content.innerHTML = statement

                        _layer.control(this.wrapper);
                        this.wrapper.style.display = 'block';
                        btn.addEventListener('click', function(){
                            _layer.hide();
                        });
                    }
                    else
                    {
                        this.wrapper.style.display = 'none';
                    }
                },
                error: function(e){
                    if(e.status == 404)
                    {
                        this.wrapper.style.display = 'none';
                    }
                }
            });
        } catch (e) {}
    })();
})
