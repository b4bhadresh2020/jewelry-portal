// trigger material css componets TextFields

M.updateTextFields();
if( $('.form-select').length ){
    $('.form-select').formSelect();
}
if( $('.dropdown-trigger').length ){
    $('.dropdown-trigger').dropdown();
}
if( $('.modal').length ){
    $('.modal').modal();
}
if( $('.custom-datepicker').length ){
    $('.custom-datepicker').datepicker({
        format : 'dd-mm-yyyy'
    });
}
if ($('.single-select2').length) {
    $(".single-select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
    });
}
