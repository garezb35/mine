function _init() {

    var	frm = $("#frmData");

    $("#mile_year #before").click(function(){
        if (parseInt($("#date_Y").val())-1 < t_SearchScope.start.year) {
            alert("ì´ì „ê±°ëž˜ë‚´ì—­ì€ ê³ ê°ê°ë™ì„¼í„°ë¡œ ë¬¸ì˜ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.")
            return false;
        }
//		if (parseInt($("#date_Y").val())-1 <= t_SearchScope.start.year && Number($("#date_M").val()) <= t_SearchScope.start.month) {
        if (parseInt($("#date_Y").val())-1 <= 2008 && Number($("#date_M").val()) < t_SearchScope.start.month) {
            alert("2008ë…„ 4ì›” 16ì¼ ì´ì „ ë‚´ì—­ì€ ì´ì „ ë§ˆì¼ë¦¬ì§€ ë‚´ì—­ì„ í†µí•´ í™•ì¸í•˜ì‹¤ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.")
            return false;
        }
        $("#date_Y").val(parseInt($("#date_Y").val())-1);
        frm.submit();
    });

    $("#mile_year #after").click(function(){
        if(parseInt($("#date_Y").val())+1 > t_SearchScope.end.year ){
            alert($("#date_Y").val()+"ë…„ë„ ì´í›„ ë‚´ì—­ì€ ê²€ìƒ‰ì´ ë¶ˆê°€ëŠ¥í•©ë‹ˆë‹¤.")
            return false;
        }
        if (parseInt($("#date_Y").val())+1 >= t_SearchScope.end.year && Number($("#date_M").val()) > t_SearchScope.end.month) {
            alert($("#date_Y").val()+"ë…„ "+t_SearchScope.end.month+"ì›” ì´í›„ ë‚´ì—­ì€ ê²€ìƒ‰ì´ ë¶ˆê°€ëŠ¥í•©ë‹ˆë‹¤.")
            return false;
        }
        $("#date_Y").val(parseInt($("#date_Y").val())+1);
        frm.submit();
    });

    $("#mile_month li").click(function(){
//		if (Number($("#date_Y").val()) <= t_SearchScope.start.year && Number(parseInt($(this).attr("name"))) <= t_SearchScope.start.month) {
        if (Number($("#date_Y").val()) <= 2008 && Number(parseInt($(this).attr("name"))) < t_SearchScope.start.month) {
            alert("2008ë…„ 4ì›” 16ì¼ ì´ì „ ë‚´ì—­ì€ ì´ì „ ë§ˆì¼ë¦¬ì§€ ë‚´ì—­ì„ í†µí•´ í™•ì¸í•˜ì‹¤ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.")
            return false;
        }
        if (Number($("#date_Y").val()) >= t_SearchScope.end.year && Number(parseInt($(this).attr("name"))) > t_SearchScope.end.month) {
            alert($("#date_Y").val()+"ë…„ "+t_SearchScope.end.month+"ì›” ì´í›„ ë‚´ì—­ì€ ê²€ìƒ‰ì´ ë¶ˆê°€ëŠ¥í•©ë‹ˆë‹¤.")
            return false;
        }
        $("#date_M").val(parseInt($(this).attr("name")));
        frm.submit();
    });

}
