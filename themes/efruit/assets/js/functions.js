function pushEvent(action, opt_label, opt_value){
    if (typeof ga == 'undefined') {
        // GA Tracking variable is not defined.
        // Cannot continue
        return false;    
    }
    ga('send', 'event', action, opt_label, typeof user_ip != 'undefined'?'(' + user_ip + ')':opt_value);
}

function changeTooltipColorTo(color) {
    $('.tooltip-inner').css('background-color', color)
    $('.tooltip.top .tooltip-arrow').css('border-top-color', color);
    $('.tooltip.right .tooltip-arrow').css('border-right-color', color);
    $('.tooltip.left .tooltip-arrow').css('border-left-color', color);
    $('.tooltip.bottom .tooltip-arrow').css('border-bottom-color', color);
}

function numberFormat(number, decimal, x){
    number = parseFloat(number);
    if (typeof decimal == 'undefined')
        decimal = 3;
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (decimal > 0 ? '\\.' : '$') + ')';
    return number.toFixed(Math.max(0, ~~decimal)).replace(new RegExp(re, 'g'), '$&,');
}

function roundNumber(floatNumber, decimal)
{
    if (typeof decimal == 'undefined')
        decimal = 2;
    return parseFloat(floatNumber.toFixed(decimal));
}

function getImagePath(original_path, type)
{
    if (typeof original_path != 'undefined')
    {
        var filename = original_path.split(/(\\|\/)/g).pop();
        return original_path.replace(filename, '') + type + '/' + filename;
    }
    return null;
}

function showAlertError(msg, callback_fn, class_name)
{
    if (typeof bootbox != 'undefined' && typeof bootbox.alert != 'undefined'){
        if(typeof class_name == 'undefined')
            class_name = 'bootbox-sm';
        bootbox.alert({
    		message: msg,
    		callback: function() {if (typeof callback_fn == 'function') callback_fn();},
    		className: class_name
    	});
        $('div.bootbox').focus();
    }else{
        alert(msg);
        if (typeof callback_fn == 'function') callback_fn();
    }
}

function sanitize_string(str)
{
    str = str.replace(/[^a-zA-Z0-9 ]/g, '', str);
    str = str.replace(/ /g, '-', str);
    return str.toLowerCase();
}

function get_parameter_from_url( name, url ) {
    if (!url) url = location.href;
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( url );
    return results == null ? null : results[1];
}

function scrollToTop(top, duration){
    if (typeof duration == 'undefined' || isNaN(duration))
        duration = 1000;
    if (typeof top == 'undefined' || isNaN(top))
        top = 0;
    $("html, body").animate({
        scrollTop: top
    }, duration);
}

function bindButtonsForNumberInput(container_selector){
    $(container_selector + ' .btn-number').click(function(e){
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $(container_selector + " input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }
            }
        } else {
            input.val(0);
        }
    });
    $(container_selector + ' .input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $(container_selector + ' .input-number').change(function() {
        var minValue =  parseInt($(this).attr('min'));
        var maxValue =  parseInt($(this).attr('max'));
        var valueCurrent = parseInt($(this).val());
        if(valueCurrent >= minValue) {
            $(container_selector + " .btn-number[data-type='minus']").removeAttr('disabled');
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(container_selector + " .btn-number[data-type='plus']").removeAttr('disabled');
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });
}

function formatQuantity(val){
    if (parseInt(val) == val)
        return parseInt(val);
    return val;
}

function money_format(input, separator){
    if (typeof separator == 'undefined' || separator.length > 1)
        separator = '.'
    if (isNaN(input) || input == 0) {
        return 0;
    } else {
        input = parseFloat(input).toFixed(0);
        input = input.toString();
        var s = '';
        for(var i = input.length - 1, j = 1; i >= 0; i--, j++)
        {
            s += input[i];
            if (j%3 == 0 && i > 0)
                s += separator;
        }
        var r = '';
        for(var i = s.length-1; i >= 0; i--)
            r += s[i];
        return r;
    };
}

function getDomain(){
    return typeof domain_name == 'undefined'?window.location.hostname.replace('www.', '').replace('/', ''):domain_name;
}