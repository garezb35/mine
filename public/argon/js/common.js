function tickCheckBox(class_name = ""){
    let updated_value = $("."+class_name).prop("checked");
    $('input[name="'+class_name+'[]"]').prop('checked',updated_value);
}
