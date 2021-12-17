(function(){
    angular.module('app.filters', [])
        .filter('efruit_money', function ($filter) {
            return function (input) {
                if (isNaN(input) || input == 0) {
                    return input;
                } else {
                    input = parseFloat(input).toFixed(0);
                    input = input.toString();
                    var s = '';
                    for(var i = input.length - 1, j = 1; i >= 0; i--, j++)
                    {
                        s += input[i];
                        if (j%3 == 0 && i > 0)
                            s += '.';
                    }
                    var r = '';
                    for(var i = s.length-1; i >= 0; i--)
                        r += s[i];
                    return r;
                };
            };
        })
        .filter('efruit_break_line', function ($sce) {
            return function (input) {
                if (typeof input == 'undefined')
                    return '';
                var limit_length = 50;
                var window_width = $(window).width();
                if (window_width >= 768)
                    limit_length = input.length;
                else if (window_width >= 350)
                    limit_length = 30;
                else
                    limit_length = 20;
                var s = input;
                if (input.length > limit_length){
                    var line = '';
                    s = '';
                    var words = input.split(' ');
                    for(i = 0; i < words.length; i++){
                        if (line.length)
                            line += ' ';
                        var temp = line + words[i];
                        if (temp.length > limit_length){
                            if (s.length)
                                s += '<br/>';
                            s += line;
                            line = words[i];
                        }else
                            line = temp;
                    }
                    if (s.length)
                        s += '<br/>';
                    s += line;
                }
                return $sce.trustAsHtml(s);
            };
        })
        .filter('sub_product_name', function ($filter) {
            return function (input) {
                return input.replace('Thêm ', '').replace('Add ', '');
            };
        })
        .filter('htmlunsafe', function($sce) {
            return function(val) {
                if (val){
                    val = val.replace(/\n/g, ". ");
                    return $sce.trustAsHtml(val);
                }
                
            };
        })
        .filter('break_line', function($sce) {
            return function(val) {
                if (val){
                    val = val.replace(/\n/g, "<br/>");
                    return $sce.trustAsHtml(val);
                }
                
            };
        })
        .filter('orderObjectByNumber', function() {
            return function(items, field, reverse) {
            var filtered = [];
            angular.forEach(items, function(item) {
                filtered.push(item);
            });
            filtered.sort(function (a, b) {
                return (parseInt(a[field]) > parseInt(b[field]) ? 1 : -1);
            });
            if(reverse) filtered.reverse();
                return filtered;
            };
        })
        .filter('range', function() {
            return function(input, total) {
                var i_total = parseInt(total);
                if (i_total - parseFloat(total) != 0){
                    input.push(0);
                }else{
                    for (var i=0; i<i_total; i++)
                        input.push(i);
                }
                return input;
            };
        })
        .filter('cut', function () {
            return function (value, wordwise, max, tail) {
                if (!value) return '';

                max = parseInt(max, 10);
                if (!max) return value;
                if (value.length <= max) return value;

                value = value.substr(0, max);
                if (wordwise) {
                    var lastspace = value.lastIndexOf(' ');
                    if (lastspace !== -1) {
                        //Also remove . and , so its gives a cleaner result.
                        if (value.charAt(lastspace - 1) === '.' || value.charAt(lastspace - 1) === ',') {
                            lastspace = lastspace - 1;
                        }
                        value = value.substr(0, lastspace);
                    }
                }

                return value + (tail || ' …');
            };
        })
        .filter('formatQuanity', function(){
            return function(value, decimals) {
                if (typeof value == 'undefined' || value == null || !value || isNaN(value))
                    return '';
                if(parseInt(value) == value)
                    return parseInt(value);
                if(typeof decimals == 'undefined')
                    decimals = 1;
                return value.toFixed(decimals);
            }
        });
})();