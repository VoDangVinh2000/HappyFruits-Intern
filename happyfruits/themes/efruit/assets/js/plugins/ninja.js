(function($) {
    "use strict";

    function t() {
        this.keys = {
            arrowDown: 40,
            arrowLeft: 37,
            arrowRight: 39,
            arrowUp: 38,
            enter: 13,
            escape: 27,
            tab: 9
        }, this.version = "1.1.24"
    }
    t.prototype.log = function(e) {
        console && "log" in console && console.log("Ninja: " + e)
    }, t.prototype.warn = function(e) {
        console && "warn" in console && console.warn("Ninja: " + e)
    }, t.prototype.error = function(e) {
        var t = "Ninja: " + e;
        throw console && "error" in console && console.error(t), t
    }, t.prototype.key = function(t, n) {
        var i = this.keys,
            a = $.map(n, function(e) {
                return i[e]
            });
        return $.inArray(t, a) > -1
    }, $.Ninja = function(t, n) {
        $.isPlainObject(t) ? (this.$element = $("<span>"), this.options = t) : (this.$element = $(t), this.options = n || {})
    }, $.Ninja.prototype.deselect = function() {
        this.$element.hasClass("nui-slc") && !this.$element.hasClass("nui-dsb") && this.$element.trigger("deselect.ninja")
    }, $.Ninja.prototype.disable = function() {
        this.$element.addClass("nui-dsb").trigger("disable.ninja")
    }, $.Ninja.prototype.enable = function() {
        this.$element.removeClass("nui-dsb").trigger("enable.ninja")
    }, $.Ninja.prototype.select = function() {
        this.$element.hasClass("nui-dsb") || this.$element.trigger("select.ninja")
    }, $.ninja = new t, $.fn.ninja = function(t, n) {
        return this.each(function() {
            $.data(this, "ninja." + t) || ($.data(this, "ninja." + t), $.ninja[t](this, n))
        })
    }
}(jQuery),
function($) {
    "use strict";
    $.Ninja.Autocomplete = function(t, n) {
        var i = this;
        t ? (i.$element = $(t), i.$element.is("input") || $.ninja.error("Autocomplete may only be called with an <input> element.")) : $.ninja.error("Autocomplete must include an <input> element."), i.$wrapper = i.$element.wrap('<span class="ninja-autocomplete">').parent(), i.$list = $("<div>", {
            "class": "ninja-list",
            css: {
                top: this.$wrapper.outerHeight()
            }
        }), n ? ("list" in n ? i.list = n.list : i.list = [], "get" in n && (i.get = n.get), "select" in n && $.isFunction(n.select) && (i.select = n.select)) : $.ninja.error("Autocomplete called without options."), i.index = -1, i.matchlist = [], i.$element.attr({
            autocomplete: "off"
        }).data("ninja", {
            autocomplete: n
        }).on("blur.ninja", function() {
            i.$list.remove()
        }).on("focus.ninja, keyup.ninja", function(t) {
            if (i.$element.data("ninja-completed")) i.$element.removeData("ninja-completed");
            else {
                var n = t.which;
                i.$element.val() ? $.ninja.key(n, ["arrowDown", "arrowUp", "escape", "tab"]) || (e.isFunction(i.get) ? i.get(i.$element.val(), function(e) {
                    i.list = e, i.suggest(e)
                }) : i.suggest(i.list)) : i.$list.remove()
            }
        }).on("keydown.ninja", function(t) {
            var n = t.which;
            $.ninja.key(n, ["escape", "tab"]) ? i.$list.remove() : n === $.ninja.keys.enter && i.index > -1 ? i.$element.trigger("select.ninja") : $.ninja.key(n, ["arrowDown", "arrowUp"]) && (i.index > -1 && i.$list.find("div:eq(" + i.index + ")").removeClass("ninja-hover"), n === $.ninja.keys.arrowDown ? i.index === i.last() ? i.index = 0 : i.index += 1 : i.index <= 0 ? i.index = i.last() : i.index -= 1, i.$list.find("div:eq(" + i.index + ")").addClass("ninja-hover"))
        }).on("select.ninja", function(e) {
            i.matchlist[i.index] && (i.$element.data("ninja-completed", !0), i.$element.val(i.matchlist[i.index]), i.$list.remove(), "select" in i && i.select())
        })
    }, $.Ninja.Autocomplete.prototype.last = function() {
        return this.matchlist.length - 1
    }, $.Ninja.Autocomplete.prototype.suggest = function(t) {
        var n = this;
        $.isFunction(n.get) ? n.matchlist = t : n.matchlist = $.map(t, function(e) {
            var t = n.$element.val();
            return t !== e && new RegExp("^" + t, "i").test(e) ? e : null
        }), n.$list.empty(), n.matchlist.length > 0 && (e.each(n.matchlist, function(t, i) {
            $("<div>", {
                "class": "ninja-item",
                html: i
            }).on("mouseenter.ninja", function() {
                n.index > -1 && n.$list.find("div:eq(" + n.index + ")").removeClass("ninja-hover"), n.index = t
            }).on("mousedown.ninja", function() {
                n.$element.trigger("select.ninja")
            }).on("mouseleave.ninja", function() {
                n.index = -1
            }).appendTo(n.$list)
        }), n.index = -1, n.$list.appendTo(n.$wrapper))
    }, $.ninja.autocomplete = function(t, n) {
        var i = $(t);
        i.data("ninja") && "autocomplete" in i.data("ninja") ? $.ninja.warn("Autocomplete called on the same element multiple times.") : $.extend(new $.Ninja(t, n), new $.Ninja.Autocomplete(t, n))
    }
}(jQuery),
function($) {
    "use strict";
    $.Ninja.Dialog = function(t) {
        var n = this;
        t && "html" in t ? n.$html = $("<span>", {
            html: t.html
        }) : $.ninja.error("JavaScript option html required."), n.$dialog = $('<span class="ninja-dialog">').append(n.$html), n.$screen = $('<div class="ninja-screen">').on("click.ninja", function(e) {
            t.clickscreen && t.clickscreen(), $.stopImmediatePropagation(), n.close()
        })
    }, $.Ninja.Dialog.prototype.open = function() {
        var t = this;
        t.$window = $(window), t.windowHeight = t.$window.height(), t.windowWidth = t.$window.width(), t.viewport = {
            left: t.$window.scrollLeft(),
            top: t.$window.scrollTop()
        }, $(document.body).append(t.$screen, t.$dialog), t.height = t.$dialog.outerHeight(), t.width = t.$dialog.outerWidth(), t.height > t.windowHeight ? t.$dialog.css({
            top: t.viewport.top
        }) : t.$dialog.css({
            top: Math.round(t.viewport.top + (t.windowHeight / 2 - t.height / 2))
        }), t.width > t.windowWidth ? t.$dialog.css({
            left: t.viewport.left
        }) : t.$dialog.css({
            left: Math.round(t.viewport.left + (t.windowWidth / 2 - t.width / 2))
        })
    }, $.Ninja.Dialog.prototype.close = function() {
        this.$dialog.detach(), this.$screen.detach()
    }, $.ninja.dialog = function(t) {
        return new $.Ninja.Dialog(t)
    }
}(jQuery),
function($) {
    "use strict";
    $.Ninja.Menu = function(t, n) {
        var i = this;
        t ? i.$element = $(t) : $.ninja.error("Menu must include an element."), n && "list" in n ? i.list = n.list : $.ninja.error("Menu must include a list."), i.$element.addClass("ninja-menu").append('<div class="ninja-arrow-down">'), i.$list = $('<div class="ninja-list">'), i.$point = $('<div class="ninja-point-up">').appendTo(i.$list), $.each(i.list, function(t, n) {
            var a = $(n).addClass("ninja-item");
            0 === t && a.addClass("ninja-first"), i.$list.append(a)
        }), $(document).on("click.ninja", function() {
            i.$list.detach(), i.$element.removeClass("ninja-select")
        }), i.$element.on("click.ninja", function(t) {
            t.stopPropagation();
            var n, a, r;
            i.$list.is(":visible") ? (i.$list.detach(), i.$element.removeClass("ninja-select")) : ($(".ninja-menu").removeClass("ninja-select"), $(".ninja-list").detach(), i.$element.append(i.$list), i.$element.addClass("ninja-select"), n = i.$element.outerWidth() / 2 - 4, a = i.$element.outerHeight() + 6, r = i.$list.offset(), r.top + i.$list.outerHeight() > $(window).scrollTop() + $(window).height() ? i.$list.css("bottom", a) : i.$list.css("top", a), r.left + i.$list.outerWidth() > $(window).scrollLeft() + $(window).width() ? (i.$list.css({
                left: "auto",
                right: 0
            }), i.$point.css("right", n)) : "auto" === i.$point.css("right") && i.$point.css("left", n))
        })
    }, $.ninja.menu = function(t, n) {
        $.extend(new $.Ninja(t, n), new $.Ninja.Menu(t, n))
    }
}(jQuery),
function($) {
    "use strict";
    $.Ninja.Popup = function(t, n) {
        var i = this;
        t ? i.$element = $(t) : $.ninja.error("Popup must include an element."), n && "html" in n ? i.$html = $("<span>", {
            html: n.html
        }) : i.$element.data("popup") ? i.$html = $("<span>", {
            html: i.$element.data("popup")
        }) : $.ninja.error("Popup must include JavaScipt html option or HTML data-popup attribute."), n && "hover" in n && n.hover === !0 ? i.trigger = "hover.ninja" : i.trigger = "click.ninja", i.$point = $("<span>"), i.$popup = $('<span class="ninja-popup">').append(i.$point, i.$html), i.$element.on(i.trigger, function(t) {
            t.stopImmediatePropagation(), "active" === i.$element.data("ninja-popup") ? (i.$element.data("ninja-popup", "inactive"), i.$popup.detach()) : (i.$element.data("ninja-popup", "active"), i.$window = $(window), i.viewport = {
                left: i.$window.scrollLeft(),
                top: i.$window.scrollTop()
            }, i.viewport.bottom = i.viewport.top + i.$window.height(), i.viewport.right = i.viewport.left + i.$window.width(), $(document.body).append(i.$popup), "click.ninja" === i.trigger && $(document).on("click.ninja-popup", function() {
                i.$element.data("ninja-popup", "inactive"), i.$popup.detach(), $(document).off("click.ninja-popup")
            }), "inline" === i.$element.css("display") ? (i.elementHeight = i.$element.height(), i.elementWidth = i.$element.width()) : (i.elementHeight = i.$element.outerHeight(), i.elementWidth = i.$element.outerWidth()), i.elementHalfHeight = i.elementHeight / 2, i.elementHalfWidth = i.elementWidth / 2, i.offset = i.$element.offset(), i.offset.center = i.offset.left + i.elementHalfWidth, i.offset.middle = i.offset.top + i.elementHalfHeight, i.height = i.$popup.outerHeight(), i.width = i.$popup.outerWidth(), i.halfHeight = i.height / 2, i.halfWidth = i.width / 2, i.offset.top - i.height < i.viewport.top ? (i.$point.attr("class", "ninja-point-up"), i.$popup.css("top", Math.round(i.offset.top + i.elementHeight + 6))) : (i.$point.attr("class", "ninja-point-down"), i.$popup.css("top", Math.round(i.offset.top - i.height - 6))), i.$point.css("left", Math.round(i.halfWidth - 5)), i.offset.left + i.elementHalfWidth + i.halfWidth > i.viewport.right ? (i.$popup.css({
                right: 0
            }), i.$point.css("right", Math.round(i.offset.center))) : i.offset.left + i.elementHalfWidth - i.halfWidth < i.viewport.left ? i.$popup.css({
                left: 0
            }) : i.$popup.css({
                left: Math.round(i.offset.left + i.elementHalfWidth - i.halfWidth)
            }))
        })
    }, $.ninja.popup = function(t, n) {
        $.extend(new $.Ninja(t, n), new $.Ninja.Popup(t, n))
    }
}(jQuery),
function($) {
    "use strict";
    $.Ninja.Slider = function(t, n) {
        var i = this;
        t ? (i.$input = $(t), i.$input.is("input") && "hidden" === i.$input.attr("type") || $.ninja.error("Slider may only be called with a hidden <input> input.")) : $.ninja.error("Slider must include a hidden <input> input."), n ? ("list" in n ? (i.list = n.list, i.slots = i.list.length - 1, 0 === i.slots && $.ninja.error("Slider list must include at least two elements.")) : $.ninja.error("Slider must include a list option."), "select" in n && $.isFunction(n.select) && (i.select = n.select), i.$input.attr("value") ? i.index = $.inArray(i.$input.val(), i.list) : (i.$input.val(i.list[0]), i.index = 0)) : $.ninja.error("Slider called without options."), i.$input.parent().is("label") ? i.$wrapper = i.$input.parent().addClass("ninja-slider") : i.$wrapper = i.$input.wrap('<label class="ninja-slider">').parent(), i.width = i.$wrapper.outerWidth(), i.increment = i.width / i.slots, i.$level = $("<div>", {
            "class": "ninja-level",
            css: {
                width: i.left()
            }
        }), i.$groove = $('<div class="ninja-groove">').on("click.ninja", function(e) {
            i.move(Math.round((e.pageX - i.$track.offset().left) / i.increment)), i.change()
        }).append(i.$level), i.$value = $("<span>", {
            "class": "ninja-value",
            html: i.list[i.index]
        }), i.$button = $("<button>", {
            type: "button",
            css: {
                left: i.left()
            }
        }).on({
            "keyup.ninja": function(t) {
                var n = t.which;
                $.ninja.key(n, ["arrowLeft", "arrowRight"]) && (n === $.ninja.keys.arrowLeft ? i.move(i.index - 1) : n === $.ninja.keys.arrowRight && i.move(i.index + 1), i.change())
            },
            "mousedown.ninja": function(t) {
                i.$wrapper.addClass("ninja-active"), i.offsetX = t.pageX - Math.round(i.$button.position().left), $(document).on({
                    "mousemove.ninja": function(e) {
                        i.move(Math.round((e.pageX - i.offsetX) / i.increment))
                    },
                    "mouseup.ninja": function() {
                        i.change(), i.$wrapper.removeClass("ninja-active"), $(document).off("mousemove.ninja mouseup.ninja")
                    }
                })
            },
            "touchstart.ninja": function(e) {
                i.$wrapper.addClass("ninja-active"), i.touch = $.originalEvent.targetTouches[0] || $.originalEvent.changedTouches[0], i.offsetX = i.touch.pageX - Math.round(i.$button.position().left)
            },
            "touchmove.ninja": function(e) {
                $.preventDefault(), i.touch = $.originalEvent.targetTouches[0] || $.originalEvent.changedTouches[0], i.move(Math.round((i.touch.pageX - i.offsetX) / i.increment))
            },
            "touchend.ninja": function(e) {
                $.preventDefault(), i.$wrapper.removeClass("ninja-active"), i.change()
            }
        }), i.$track = $("<div>", {
            "class": "ninja-track",
            css: {
                width: i.width + 16
            }
        }).append(i.$groove, i.$button), i.$wrapper.append(i.$value, i.$track), i.drag = !1, i.offsetX = 0, i.$input.data("ninja", {
            slider: n
        })
    }, $.Ninja.Slider.prototype.change = function() {
        var e = this.list[this.index];
        this.$input.val() !== e && (this.$input.val(e).change(), "select" in this && this.select())
    }, $.Ninja.Slider.prototype.left = function() {
        return Math.round(this.index * this.increment)
    }, $.Ninja.Slider.prototype.move = function(e) {
        e !== this.index && (0 > e ? this.index = 0 : e > this.slots ? this.index = this.slots : this.index = e, this.$button.css("left", this.left()), this.$level.css("width", this.left()), this.$value.text(this.list[this.index]))
    }, $.ninja.slider = function(t, n) {
        var i = $(t);
        i.data("ninja") && "slider" in i.data("ninja") ? $.ninja.warn("Slider called on the same input multiple times.") : $.extend(new $.Ninja(t, n), new $.Ninja.Slider(t, n))
    }
}(jQuery));