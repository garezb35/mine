/*
 * @title		ë‚´ë§ˆì¼ë¦¬ì§€ - ìƒì„¸ë‚´ì—­ë³´ê¸°
 * @author		ìž¥ì›ì§„
 * @date		2012.02.28
 * @update		ìˆ˜ì •ë‚ ì§œ(ìˆ˜ì •ìž)
 * @description
 */

var g_rgStart	= null;
var g_rgEnd		= null;

function _init()
{
    g_rgStart = { year:$('[name=search_year]').val(), month:$('[name=search_month]').val(), day:$('[name=search_day]').val() };
    g_rgEnd	= { year:$('[name=search_year_end]').val(), month:$('[name=search_month_end]').val(), day:$('[name=search_day_end]').val() };

    var frm = $('#frmPeriod');

    checker = new _form_checker(frm);
    checker.add({custom:function(){
            var dtStart = new Date(Number($('[name=search_year]').val()),Number($('[name=search_month]').val())-1,Number($('[name=search_day]').val()));
            var dtEnd	= new Date(Number($('[name=search_year_end]').val()),Number($('[name=search_month_end]').val())-1,Number($('[name=search_day_end]').val()));

            if(dtStart.valueOf()>dtEnd.valueOf()){
                alert('ì‹œìž‘ë‚ ì§œê°€ ë§ˆì§€ë§‰ë‚ ì§œë³´ë‹¤ ìµœê·¼ìž…ë‹ˆë‹¤');
                return false;
            }

            var nCheck = (dtEnd.valueOf()-dtStart.valueOf())/86400000;
            if(nCheck<0 || nCheck>30){
                alert('ì¡°íšŒ ê°€ëŠ¥ë‚ ì§œê°€ ì•„ë‹™ë‹ˆë‹¤\n\nì¡°íšŒëŠ” ìµœëŒ€ 30ì¼ ê¹Œì§€ë§Œ ê°€ëŠ¥í•©ë‹ˆë‹¤');
                return false;
            }

            return true;
        }});
}
$.extend({
    date_scope : function(nDay) {
        var dtNow	= new Date();
        var nGap	= (!arguments[0]) ? 0 : nDay-1;
        var dtStart	= new Date(dtNow.getFullYear(),dtNow.getMonth(),dtNow.getDate()-nGap);

        $('[name=search_year]').val(dtStart.getFullYear());
        $('[name=search_month]').val(dtStart.getMonth()+1);
        $('[name=search_day]').val(dtStart.getDate());
        $('[name=search_year_end]').val(dtNow.getFullYear());
        $('[name=search_month_end]').val(dtNow.getMonth()+1);
        $('[name=search_day_end]').val(dtNow.getDate());

        var frm = $('#frmPeriod');
        frm.submit();
    }
});

//function showLimitMileage()
//{
//	$('limit_mileage_tr').className="limit_mileage_height2";
//	$('limit_title').className="limit_mileage_height";
//	$('limit_remain').className="limit_mileage_height";
//	Object.extend($('limit_mileage'),_item.layer).show();
//}

/* â–¼ ì—°ë„ì™€ ì›”ì„ ì„ íƒí–ˆì„ ì‹œ ìµœëŒ€ ì¼ìž ìˆ˜ì • */
function fnGetDate(type){
    var strIdValue = (type == 0) ? '' : '_end';
    var strDest = 'search_day' + strIdValue;
    var nSlctedYear = $('#search_year' + strIdValue + ' input').val();
    var nSlctedMonth = $('#search_month' + strIdValue + ' input').val();
    var nSlctedDay = $('#search_day' + strIdValue + ' input').val();
    var nMaxDay = new Date(nSlctedMonth + '/1/' + nSlctedYear).getTotalDay();

    var objSlctedNode =  $('#search_day' + strIdValue)[0];
    objSlctedNode.nodeList.empty();

    for(var i=1;i<=nMaxDay;i++){
        var strValue = i.toString();
        if(i == nSlctedDay){
            objSlctedNode.nodeSelect = objSlctedNode.addOption(objSlctedNode, null, strValue, strValue);
        }
        else{
            objSlctedNode.addOption(objSlctedNode, null, strValue, strValue);
        }
    }
    if(nSlctedDay > nMaxDay || (!objSlctedNode.nodeSelect)){
        objSlctedNode.nodeSelect = objSlctedNode.nodeList.children().last();
        objSlctedNode.setText(objSlctedNode.nodeSelect.text());
        objSlctedNode.setValue(objSlctedNode.nodeSelect.val());
    }
    objSlctedNode.nodeSelect.addClass('over');
}
/* â–² ì—°ë„ì™€ ì›”ì„ ì„ íƒí–ˆì„ ì‹œ ìµœëŒ€ ì¼ìž ìˆ˜ì • */
