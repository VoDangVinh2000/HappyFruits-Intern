function pushEvent(action, opt_label, opt_value){
    if (typeof _gaq == 'undefined') {
        // GA Tracking variable is not defined.
        // Cannot continue
        return false;    
    }
    _gaq.push(['_trackEvent', action, opt_label, opt_value]);
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