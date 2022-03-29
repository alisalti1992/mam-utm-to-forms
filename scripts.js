var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};
jQuery(document).ready(function($){
    let mam_utm_to_forms_fields;
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
        if(!$('input[name="utm_source"]').val() || $('input[name="utm_source"]').val() == '-' || $('input[name="utm_source"]').val() == 'null'){
            if(getUrlParameter('utm_source')){
                $('input[name="utm_source"]').val(getUrlParameter('utm_source'));
            }
        }
        if(!$('input[name="utm_medium"]').val() || $('input[name="utm_medium"]').val() == '-' || $('input[name="utm_medium"]').val() == 'null'){
            if(getUrlParameter('utm_medium')){
                $('input[name="utm_medium"]').val(getUrlParameter('utm_medium'));
            }
        }
        if(!$('input[name="utm_campaign"]').val() || $('input[name="utm_campaign"]').val() == '-' || $('input[name="utm_campaign"]').val() == 'null'){
            if(getUrlParameter('utm_campaign')){
                $('input[name="utm_campaign"]').val(getUrlParameter('utm_campaign'));
            }
        }
    }
    try {
        mam_utm_to_forms_fields = $.parseJSON(Cookies.get("mam_utm_to_forms_fields"));
        $(window).on("load", function () {
            mam_forms_set_fields();
            setInterval(function(){
                mam_forms_set_fields();
            }, 500);
        });
        mam_forms_set_fields();
    } catch(e) {
        console.log(e.message);
        console.log(Cookies.get("mam_utm_to_forms_fields"));
    }
});