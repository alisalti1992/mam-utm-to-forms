jQuery(document).ready(function($){
    const mam_utm_to_forms_fields = jQuery.parseJSON(Cookies.get("mam_utm_to_forms_fields"));
    $(window).on("load", function () {
        mam_forms_set_fields();
        setInterval(function(){
            mam_forms_set_fields();
        }, 500);
    });
    mam_forms_set_fields();

    function mam_forms_set_fields(){
        for (const [key, value] of Object.entries(mam_utm_to_forms_fields)) {
            let field_name = '';
            let field_value = '';
            for (const [_key, _value] of Object.entries(value)) {
                if(_key === 'field'){
                    field_name = _value;
                }
                if(_key === 'value'){
                    field_value = _value;
                }
            }
            if($('input[name="' + field_name + '"]').length){
                $('input[name="' + field_name + '"]').val(decodeURIComponent(field_value));
            }
        }
    }
});