(function(){
    var app = angular.module('app.directives', [])
        .directive('auto', function($timeout) {
            return {
                restrict : 'A',
                require : 'ngModel',
                link : function(scope, iElement, iAttrs) {
                    if (typeof iElement.autocomplete != 'function')
                        return;
                    iElement.autocomplete({
                        source: function(request, response) {
                            var final_results = [];
                            if (typeof scope.settings != 'undefined' && typeof scope.settings.language != 'undefined')
                            {
                                if (scope.settings.language == 'en')
                                    var results = $.ui.autocomplete.filter(scope.itemsForAutocompleteEn, request.term);
                                else
                                    var results = $.ui.autocomplete.filter(scope.itemsForAutocomplete, request.term);
                            }
                            else
                                var results = $.ui.autocomplete.filter(scope.itemsForAutocomplete, request.term);
                            var limit = 10;
                            var index = 0;
                            for(var j in results)
                            {
                                final_results.push({value: results[j].value, extra: results[j].extra});
                                if (index > limit)
                                    break;
                                index++;
                            }
                            response(final_results);
                        },
                        select: function(event, ui) {
                            if (ui.item)
                                scope.addItem(ui.item.extra);
                            
                            $timeout(function() {
                                iElement.val('');
                                iElement.trigger('input');
                            }, 0);
                            
                        },
                        change: function( event, ui ) {
                            iElement.val('');
                            if (ui.item)
                                pushEvent('Chọn món nhanh', ui.item.extra, 1);
                        }
                    });
            }
            };
        })
        .directive('autoForFruitBoxOnly', function($timeout) {
            return {
                restrict : 'A',
                require : 'ngModel',
                link : function(scope, iElement, iAttrs) {
                    if (typeof iElement.autocomplete != 'function')
                        return;
                    iElement.autocomplete({
                        source: function(request, response) {
                            var final_results = [];
                            if (typeof scope.settings != 'undefined' && typeof scope.settings.language != 'undefined')
                            {
                                if (scope.settings.language == 'en')
                                    var results = $.ui.autocomplete.filter(scope.itemsForAutocompleteEn, request.term);
                                else
                                    var results = $.ui.autocomplete.filter(scope.itemsForAutocomplete, request.term);
                            }
                            else
                                var results = $.ui.autocomplete.filter(scope.itemsForAutocomplete, request.term);
                            var limit = 10;
                            var index = 0;
                            console.log(results);
                            for(var j in results)
                            {
                                if(results[j].can_be_added_to_box == 0)
                                    continue;

                                final_results.push({value: results[j].value, extra: results[j].extra});
                                if (index > limit)
                                    break;
                                index++;
                            }
                            response(final_results);
                        },
                        select: function(event, ui) {
                            if (ui.item)
                                scope.addCustomBoxItem(ui.item.extra, 1);

                            $timeout(function() {
                                iElement.val('');
                                iElement.trigger('input');
                            }, 0);

                        },
                        change: function( event, ui ) {
                            iElement.val('');
                        },
                        minLength: 0
                    });
                }
            };
        })
        .directive('onlyNumber', function() {
            return function(scope, element, attrs) {
                element.bind('keydown', function(event) {
                    var charCode  = event.which || event.keyCode;
                    if (!charCode)
                        return;
                    // Allow special chars + arrows 
                    if (charCode == 46 || charCode == 8 || charCode == 9 
                        || charCode == 27 || charCode == 13 
                        || (charCode == 65 && event.ctrlKey === true) 
                        || (charCode == 67 && event.ctrlKey === true) 
                        || (charCode == 86 && event.ctrlKey === true) 
                        || (charCode >= 35 && charCode <= 39)){
                            return;
                    }else {
                        // If it's not a number stop the keypress
                        if (event.shiftKey || (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105 )) {
                            event.preventDefault(); 
                        }   
                    }
                });
            };
        })
        .directive('ngRightClick', function($parse) {
            return function(scope, element, attrs) {
                var fn = $parse(attrs.ngRightClick);
                element.bind('contextmenu', function(event) {
                    scope.$apply(function() {
                        event.preventDefault();
                        fn(scope, {$event:event});
                    });
                });
            };
        })
        .directive('myRepeatDirective', function() {
            return function(scope, element, attrs) {
                //There are the $index, $first, $middle and $last properties you can use to trigger events, e.g. scope.$last
                
            };
        })
        .directive('onlyFloat', function() {
            return function(scope, element, attrs) {
                element.bind('keydown', function(event) {
                    var charCode  = event.which || charCode;
                    if (!charCode)
                        return;
                    // Allow special chars + arrows 
                    if (charCode == 46 || charCode == 8 || charCode == 9 
                        || charCode == 27 || charCode == 13 
                        || (charCode == 65 && event.ctrlKey === true) 
                        || (charCode >= 35 && charCode <= 39)
                        || (charCode == 190)){
                            return;
                    }else {
                        // If it's not a number stop the keypress
                        if (event.shiftKey || (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105 )) {
                            event.preventDefault(); 
                        }   
                    }
                });
            };
        })
        .directive('onReady', ['$interpolate', function($interpolate) {
            return {
                restrict: 'A',
                priority: Number.MIN_SAFE_INTEGER, // execute last, after all other directives if any.
                link: function($scope, $element, $attributes) {
                    $scope.onReady($element, $attributes);
                }
            };
        }])
        .directive('jChange', function() {
            return {
                restrict : 'A',
                require : 'ngModel',
                link: function(scope, element, attrs) {        
                    element.bind('change', function() {});
                }
            }
        })
        .directive('bindTranslate', function() {
            return {
                restrict : 'A',
                link: function (scope, element, attrs) {
                    scope.$watch(function () {
                        var text = attrs.bindTranslate;
                        if (text.length)
                            element.html(translate(text));
                        else
                            element.html(translate(element.html()));
                    }, function (value) {
                        if (typeof value != 'undefined' && value.length)
                            element.html(translate(value));
                        else
                            element.html(translate(element.html()));
                    });
                }
            }
        });
    
    
    
    
    var myNav = navigator.userAgent.toLowerCase();
    var isIE10orLower = (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
    if (isIE10orLower && isIE10orLower <= 9){
        console.log('IE' + isIE10orLower);
        $('.ie_warning').show();
        (function (undef) {
            "use strict";
        
            var propName, needsShimByNodeName;
        
            propName = 'placeholder';
            needsShimByNodeName = {};
        
            angular.module('app.directives').directive("placeholder", [
                "$document",
                function ($document) {
                    // Determine if we need to perform the visual shimming
                    angular.forEach([ 'INPUT', 'TEXTAREA' ], function (val) {
                        needsShimByNodeName[val] = $document[0].createElement(val)[propName] === undef;
                    });
        
                    /**
                     * Determine if a given type (string) is a password field
                     *
                     * @param {string} type
                     * @return {boolean}
                     */
                    function isPasswordType(type) {
                        return type && type.toLowerCase() === "password";
                    }
        
                    return {
                        require: "ngModel",
                        restrict: "A",
                        link: function ($scope, $element, $attributes, $controller) {
                            var className, currentValue, text;
        
                            text = $attributes[propName];
                            className = $attributes[propName + "Class"] || propName;
        
                            // This does the class toggling depending on if there
                            // is a value or not.
                            $scope.$watch($attributes.ngModel, function (newVal) {
                                currentValue = newVal || "";
        
                                if (!currentValue) {
                                    $element.addClass(className);
                                } else {
                                    $element.removeClass(className);
                                }
                            });
        
                            if (needsShimByNodeName[$element[0].nodeName]) {
                                // These bound events handle user interaction
                                $element.bind("focus", function () {
                                    if (currentValue === "") {
                                        // Remove placeholder text
                                        $element.val("");
                                    }
                                });
                                $element.bind("blur", function () {
                                    if ($element.val() === "") {
                                        // Add placeholder text
                                        $element.val(text);
                                    }
                                });
        
                                // This determines if we show placeholder text or not
                                // when there was a change detected on scope.
                                $controller.$formatters.unshift(function (val) {
                                    /* Do nothing on password fields, as they would
                                     * be filled with asterisks.  Issue #2.
                                     */
                                    if (isPasswordType($element.prop("type"))) {
                                        return val;
                                    }
        
                                    // Show placeholder text instead of empty value
                                    return val || text;
                                });
                            }
                        }
                    };
                }
            ]);
        }());
    }
})();