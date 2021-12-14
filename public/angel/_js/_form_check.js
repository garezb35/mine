var _form_checker = function(frm) {
    this.init(frm);
}
$.extend(_form_checker.prototype, {
    objForm: null,
    rgItem: null,
    init: function(frm) {
        var g_this = this;
        this.rgItem = new Array();
        this.objForm = frm;
        this.objForm.checker = this;
        this.objForm.on('submit', function(){ return g_this.send(); });
    },
    send: function() {
        var result	= this.check();
        if(!result) { return false; }
        if('OnSubmit' in this && this.OnSubmit) {
            result = this.OnSubmit.call(this.objForm);
            if(!result) { return false; }
        }

        return true;
    },
    send_manual: function() {
        var result	= this.check();
        if(!result) { return; }
        if('OnSubmit' in this && this.OnSubmit) {
            result = this.OnSubmit.call(this.objForm);
            if(!result) { return; }
        }

        this.objForm.submit();
    },
    check: function() {
        if(this.rgItem.length<1) return true;
        var result = true, strType='', strValue='', length=this.rgItem.length;
        for(var i=0; i<length; i++) {
            if('inputObj' in this.rgItem[i]) {
                tag			= this.rgItem[i].inputObj.get(0).tagName.toUpperCase();
                strType		= this.rgItem[i].inputObj.attr('type');
                strValue	= this.rgItem[i].inputObj.val().trim();
            }
            try {
                if('custom' in this.rgItem[i]) {
                    var obj = ('inputObj' in this.rgItem[i]) ? this.rgItem[i].inputObj : this.objForm;
                    if(!this.rgItem[i].custom.call(obj, strValue)) {
                        result = false;
                        break;
                    }
                } else {
                    if(strType == "radio" || strType == "checkbox") {
                        var checkObj = this.rgItem[i].inputObj.filter(":checked");
                        if(checkObj.val().isEmpty()) {
                            result = false;
                            break;
                        }

                    } else {
                        var fnValidator = eval('_form.validator.'+this.rgItem[i].strType);
                        var min=null, max=null;
                        if('range' in this.rgItem[i]) {
                            min = ('min' in this.rgItem[i].range) ? this.rgItem[i].range.min : 0.1;
                            max = ('max' in this.rgItem[i].range) ? this.rgItem[i].range.max : null;
                        } else { min = 0.1 }
                        if(!fnValidator.call(_form.validator, strValue, min, max)) {
                            result = false;
                            break;
                        }
                    }
                }
            } catch (error) {
                if(_DEBUG==true) { error.print() };
                result = false;
                break;
            }
        }

        if(!result) {
            if('message' in this.rgItem[i])	alert(this.rgItem[i].message);
            if(('inputObj' in this.rgItem[i]) && (strType=='text' || strType=='password' || tag=='TEXTAREA')) {
                this.rgItem[i].inputObj.val('');
                this.rgItem[i].inputObj.focus();
            }
            return false;
        }
        return true;
    },
    add: function(objItem) {
        /*
         *	입력 항목의 구조
         *	custom	: 사용자 정의 함수 추가(반드시 결과를 return(true,false)해야 함)
         *  input	: 해당 컨트롤
         *	type	: 타입(number,price,string,date)
         *  range	: number일 경우 범위설정({min:0, max:100}
         *	message	: 조건실패시 메세지
         */

        if(!('custom' in objItem) && !objItem.inputObj) { return }
        this.rgItem.push(objItem);
        if(('protect' in objItem) && objItem.protect && (objItem.strType in _form.protect))
        { eval('_form.protect.'+objItem.strType).call(_form.protect,(objItem.inputObj)) }
    },
    free: function() {
        this.rgItem = [];
    }
});


var _form = {};
_form.validator = {};
$.extend(_form.validator,{
    number: function(value,min,max) {
        if(value.isEmpty())		{ return false }
        value = Number(value);
        if(isNaN(value))		{ return false }
        if((min && isNaN(min)) || (max && isNaN(max)))	{ return false }
        if(min && (value<min))	{ return false }
        if(max && (value>max))	{ return false }
        return true;
    },
    price: function(value,min,max) {
        value = value.replace(/[^0-9]/g,'');
        return this.number(value,min,max);
    },
    string: function(value,min,max) {
        if(value.isEmpty())				{ return false }
        if(min && (value.length<min))	{ return false }
        if(max && (value.length>max))	{ return false }
        return true;
    },
    hangul: function(value,min,max) {
        if(!this.string(value,min,max))	{ return false }
        return value.isHangul();
    },
    domain: function(value) {
        var regular = (/^(http\:\/\/)?((\w+)[.])+(asia|biz|cc|cn|com|de|eu|in|info|jobs|jp|kr|mobi|mx|name|net|nz|org|travel|tv|tw|uk|us)(\/(\w*))*$/i);
        return regular.test(value);
    },
    url: function(value) {
        if(this.domain(value)) { return true }
        var nIndex = value.lastIndexOf("/");
        if(nIndex>-1) { return this.domain(value.substring(0,nIndex)); }
        return false;
    },
    userid: function(value) {
        value = value.replace(/[^a-zA-Z0-9]/g,'');
        if(!isNaN(value.substring(0,1)))	{ return false }
        if(!isNaN(value))					{ return false }
        return this.string(value,4,12);
    },
    password: function(value) {
        var strexp = /(?=.*\d)(?=.*[a-zA-Z])/;
        if(!strexp.test(value)) { return false }
        return this.string(value,10,16)
    },
    four_string : function(value)
    {
        var nLength = value.length;
        var nCount = 0;

        if(nLength < 3) return false;

        for(var i=0; i<nLength; i++) {
            if(i != 0 && value.substring(i-1,i) == value.substring(i,i+1)){
                if(nCount >= 2) {
                    return false;
                }
                nCount++;
            }
            else {
                nCount=0;
            }
        }

        return true;
    },
    email: function (value) {
        var strexp = /^[a-zA-z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9]{2,4}$/i;
        return strexp.test(value);
    }
});

_form.protect = {};
$.extend(_form.protect, {
    functionkey: [8,9,13,16,17,18,20,21,22,25,27,32,33,34,35,36,37,38,39,40,45,46,96],
    functioncheck: function(keycode) {
        var length = this.functionkey.length;
        for(var i=0; i<length; i++) { if(this.functionkey[i]==keycode) { return true } }
        return false;
    },
    set: function(input,fnKey,fnKeyup,fnBlur) {
        if(!fnBlur)	fnBlur = fnKeyup;
        if(fnKey)	{ input.bind('keydown', fnKey ) }
        if(fnKeyup)	{ input.bind('keyup', fnKeyup ) }
        if(fnBlur)	{ input.bind('blur', fnBlur)	}
    },
    number: function(input) {
        input.css('ime-mode', 'disabled');
        this.set(input,function(Event) {
            var keycode = Event.keyCode;
            if(_form.protect.functioncheck(keycode)) { return true; }
            if((keycode>=48 && keycode<=57) || (keycode>=96 && keycode<=105)) { return true; }
            Event.returnValue = "";
            return false;
        },function(Event) {
            var strexp = new RegExp("[^0-9]", "g");
            if(_form.protect.value_test($(this), strexp) == false) {
                var objVal = $(this).val().replace(/[^0-9]/g,'');
                $(this).val(objVal);
            }
        });
    },
    price: function(input) {
        input.css('ime-mode', 'disabled');
        this.set(input,function(Event) {
            var keycode = Event.keyCode;
            if(_form.protect.functioncheck(keycode)) { return true; }
            if((keycode>=48 && keycode<=57) || (keycode>=96 && keycode<=105)) { return true; }
            Event.returnValue = "";
            return false;
        }, function(Event) {
            var objVal = Number($(this).val().replace(/[^0-9]/g,'')).currency();
            if($(this).val() != objVal) {
                if($(this).attr('maxlength') && objVal.length > $(this).attr('maxlength')) {
                    var gap = objVal.length - parseInt($(this).attr('maxLength'));
                    objVal = objVal.substring(0, objVal.length-gap);
                    objVal = objVal.replace(/[^0-9]/g,'');
                    objVal = Number(objVal).currency();
                }
                $(this).val(objVal);
            }

            if($(this).val() == 0) $(this).val("");
        });
    },
    hangul: function(input) {
        input.css('ime-mode', 'active');
        this.set(input,function(Event) {
                var keycode = Event.keyCode;
                if(_form.protect.functioncheck(keycode)) { return true; }
                if(keycode==229)	 { return true; }
                Event.returnValue = "";
                return false;
            },
            null,
            function(Event) {
                var objVal = ($(this).val().isEmpty()) ? "" : $(this).val().replace(/[^가-힣]/g,'');
                $(this).val(objVal);
            });
    },
    userid: function(input) {
        input.css('ime-mode', 'disabled');
        this.set(input,function(Event) {
                var keycode = Event.keyCode;
                if(_form.protect.functioncheck(keycode)) { return true; }
                if((keycode>=48 && keycode<=57) || (keycode>=65 && keycode<=90) || (keycode>=97 && keycode<=122))	{ return true; }
                Event.returnValue = "";
                return false;
            },
            function(Event) {
                var strexp = new RegExp("[^a-zA-Z0-9]", "g");
                if(_form.protect.value_test($(this), strexp) == false) {
                    var objVal = $(this).val().replace(strexp,'');
                    $(this).val(objVal);
                }
            });
    },
    english : function(input) {
        input.css('ime-mode', 'disabled');
        this.set(input,function(Event) {
                var keycode = Event.keyCode;
                if(_form.protect.functioncheck(keycode)) { return true; }
                if((keycode>=65 && keycode<=90) || (keycode>=97 && keycode<=122))	{ return true; }
                Event.returnValue = "";
                return false;
            },
            function(Event) {
                var strexp = new RegExp("[^a-zA-Z]", "g");
                if(_form.protect.value_test($(this), strexp) == false) {
                    var objVal = $(this).val().replace(strexp,'');
                    $(this).val(objVal);
                }
            });
    },
    value_test : function (obj, exp) {
        if(exp.test($(obj).val()) == true) { return false; }
        else { return true }
    }
});

_form.addValues = function(formObj, params) {
    if(!formObj || !params) { return }
    var INPUT = null;
    try{
        $.each(params, function(item,val){
            INPUT = document.createElement('INPUT');
            INPUT.setAttribute('type','hidden');
            INPUT.setAttribute('name',item);
            INPUT.setAttribute('value',val);
            formObj.append(INPUT);
        });

    } catch(e){
        for(var item in params) {
            INPUT = document.createElement('INPUT');
            INPUT.setAttribute('type','hidden');
            INPUT.setAttribute('name',item);
            INPUT.setAttribute('value',params[item]);
            formObj.append(INPUT);
        }
    }
}

_form.autotab = function(objThis, nextObj, nLength) {
    if($(objThis).attr('maxlength') > 0) nLength = $(objThis).attr('maxlength');

    if(nLength < 1) return;

    $(objThis).bind('keyup', function() {
        if($(this).val().length >= nLength) {
            $(nextObj).focus();
        }
    });
}
