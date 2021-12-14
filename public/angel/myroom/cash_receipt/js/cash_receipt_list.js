function _init() {
    $.extend($('#SELECT_TAX_ACCOUNT_YEAR_SEARCH')[0], {
        view_count : 10
    });
}

function moneyissPoP(type,id,tbname){
    if(type == 'A'){
        popfile = "/cash_receipt_confirm?id="+id;
        width = 800;
        height = 400;
        scrollbar = "no";
    }else if(type == 'U'){
        popfile = "/cash_receipt_confirm2?id="+id;
        width = 475;
        height = 600;
        scrollbar = "yes";
    }else{
        return false;
    }

    var left = (screen.availWidth/2) - (width/2);
    var top = (screen.availHeight/2) - (height/2);

    window.open(popfile,type,'width='+width+',height='+height+',left='+left+',top='+top+',scrollbars='+scrollbar);
}
