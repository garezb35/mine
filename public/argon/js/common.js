function tickCheckBox(class_name = ""){
    let updated_value = $("."+class_name).prop("checked");
    $('input[name="'+class_name+'[]"]').prop('checked',updated_value);
}

function openOrder(order = ""){
    window.open('/admin/orderContent?id='+order,'popup','width=800, height=600, status=no, menubar=no, toolbar=no, resizable=no,left=400,top=100');
}
