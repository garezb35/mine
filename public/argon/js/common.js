function tickCheckBox(class_name = ""){
    let updated_value = $("."+class_name).prop("checked");
    $('input[name="'+class_name+'[]"]').prop('checked',updated_value);
}

function openOrder(order = ""){
    window.open('/admin/orderContent?id='+order,'popup','width=1024, height=800, status=no, menubar=no, toolbar=no, resizable=no,left=400,top=100');
}

function openOrderRequest(order = ""){
    window.open('/admin/orderRequestContent?id='+order,'popup','width=800, height=600, status=no, menubar=no, toolbar=no, resizable=no,left=400,top=100');
}

function openNotice(order = ""){
    window.open('/admin/noticeOpen?id='+order,'popup','width=800, height=600, status=no, menubar=no, toolbar=no, resizable=no,left=400,top=100');
}


function ajaxRequest(j) {
    var j = j || {};
    if (!j.url) {
        return
    }
    var g = j.url;
    if ((j.cache !== undefined && typeof(j.cache) !== "boolean") || (j.type && j.type.toUpperCase() === "POST" && j.cache === false)) {
        var f = j.cache;
        var n = new Date();
        var b = n.getMonth() + 1;
        var h = n.getDate();
        var k = Math.floor(n.getHours() / f) * f;
        if (("" + b).length === 1) {
            b = "0" + b
        }
        if (("" + h).length === 1) {
            h = "0" + h
        }
        if (("" + k).length === 1) {
            k = "0" + k
        }
        var a = ("" + n.getFullYear()) + b + h + (k);
        if (g.indexOf("?") === -1) {
            g += "?"
        }
        g += "_=" + a;
        j.cache = true
    }
    var l = j.scope || this,
        e = {
            url: g,
            dataType: j.dataType || null,
            type: j.type || "GET",
            data: j.data || "",
            cache: (j.cache === undefined) ? false : j.cache,
            async: (j.async === undefined) ? true : j.async,
            success: function(c, m, d) {
                if (c && j.dataType === "xml") {
                    c = getXmlDocument(c, m, d)
                }
                if (j.success) {
                    j.success.call(l, c)
                }
            },
            error: function(c) {
                if (j.error) {
                    j.error.call(l, c)
                }
            },
            complete: function(c) {
                if (j.complete) {
                    j.complete.call(l, c)
                }
            }
        };
    if (j.timeout) {
        e.timeout = j.timeout
    }
    return $.ajax(e)
}

function controlOrder(orderNo, type){
    if(confirm('변경하시겠습니까?')){
        $.ajax({
            type: "POST",
            url: '/api/admin/controlOrder',
            dataType:"json",
            data:{
                orderNo: orderNo,
                type: type,
                api_token: a_token
            },
            success: function(response){
                alert(response.msg)
                if(response.type == 2)
                    windows.history.back()
                else if(response.type == 1)
                    location.reload();
                else{
                    self.close()
                }
            }
        });
    }
}


function loadFile(event, id= "output") {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
