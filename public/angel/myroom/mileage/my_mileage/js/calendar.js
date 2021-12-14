/*
 * @title			내마일리지 - 달력
 * @author		장원진
 * @date			2012.02.27
 * @update		수정날짜(수정자)
 * @description
 */

function _init() {

    var	frm = $("#frmData");

    $("#mile_year #before").click(function(){
        if (parseInt($("#date_Y").val())-1 < t_SearchScope.start.year) {
            alert("이전거래내역은 고객감동센터로 문의 주시기 바랍니다.")
            return false;
        }
//		if (parseInt($("#date_Y").val())-1 <= t_SearchScope.start.year && Number($("#date_M").val()) <= t_SearchScope.start.month) {
        if (parseInt($("#date_Y").val())-1 <= 2008 && Number($("#date_M").val()) < t_SearchScope.start.month) {
            alert("2008년 4월 16일 이전 내역은 이전 마일리지 내역을 통해 확인하실 수 있습니다.")
            return false;
        }
        $("#date_Y").val(parseInt($("#date_Y").val())-1);
        frm.submit();
    });

    $("#mile_year #after").click(function(){
        if(parseInt($("#date_Y").val())+1 > t_SearchScope.end.year ){
            alert($("#date_Y").val()+"년도 이후 내역은 검색이 불가능합니다.")
            return false;
        }
        if (parseInt($("#date_Y").val())+1 >= t_SearchScope.end.year && Number($("#date_M").val()) > t_SearchScope.end.month) {
            alert($("#date_Y").val()+"년 "+t_SearchScope.end.month+"월 이후 내역은 검색이 불가능합니다.")
            return false;
        }
        $("#date_Y").val(parseInt($("#date_Y").val())+1);
        frm.submit();
    });

    $("#mile_month li").click(function(){
//		if (Number($("#date_Y").val()) <= t_SearchScope.start.year && Number(parseInt($(this).attr("name"))) <= t_SearchScope.start.month) {
        if (Number($("#date_Y").val()) <= 2008 && Number(parseInt($(this).attr("name"))) < t_SearchScope.start.month) {
            alert("2008년 4월 16일 이전 내역은 이전 마일리지 내역을 통해 확인하실 수 있습니다.")
            return false;
        }
        if (Number($("#date_Y").val()) >= t_SearchScope.end.year && Number(parseInt($(this).attr("name"))) > t_SearchScope.end.month) {
            alert($("#date_Y").val()+"년 "+t_SearchScope.end.month+"월 이후 내역은 검색이 불가능합니다.")
            return false;
        }
        $("#date_M").val(parseInt($(this).attr("name")));
        frm.submit();
    });

}
