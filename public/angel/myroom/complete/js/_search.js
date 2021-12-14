function _init() {
    var frm = $("#frmSearch");

    var objGamelist		= $.extend($('#dvGame'),_gamelist);
    var objServerlist	= $.extend($('#dvServer'),_serverlist);
    objGamelist.bind	= objServerlist;
    objServerlist.bind	= objGamelist;
    objGamelist.initialize();
    objServerlist.initialize();

    _form.protect.price(frm.find('[name="search_price_min"]'));
    _form.protect.price(frm.find('[name="search_price_max"]'));
}
