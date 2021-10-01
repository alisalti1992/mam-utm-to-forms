jQuery(document).ready(function($){
    const mam_utm_to_forms_fields = jQuery.parseJSON(Cookies.get("mam_utm_to_forms_fields"));
    for (const [key, value] of Object.entries(mam_utm_to_forms_fields)) {
        var field_name = '';
        var field_value = '';
        for (const [_key, _value] of Object.entries(value)) {
            if(_key == 'field'){
                field_name = _value;
            }
            if(_key == 'value'){
                field_value = _value;
            }
        }
        if($('input[name="' + field_name + '"]').length){
            $('input[name="' + field_name + '"]').val(decodeURIComponent(field_value));
        }
    }
});