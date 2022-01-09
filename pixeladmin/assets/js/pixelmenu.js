var Settings = {
    is_mobile: false,
    resize_delay: 400,
    stored_values_prefix: 'pa_',
    main_menu: {
        accordion: true,
        animation_speed: 250,
        store_state: true,
        store_state_key: 'mmstate',
        disable_animation_on: ['small'],
        dropdown_close_delay: 300,
        detect_active: true,
        detect_active_predicate: function(href, url) {
            return href === url;
        }
    },
    consts: {
    COLORS: ['#71c73e', '#77b7c5', '#d54848', '#6c42e5', '#e8e64e', '#dd56e6', '#ecad3f', '#618b9d', '#b68b68', '#36a766', '#3156be', '#00b3ff', '#646464', '#a946e8', '#9d9d9d']
    }
};

/*
 * Detect screen size.
 * 
 * @param  {jQuery Object} $ssw_point
 * @param  {jQuery Object} $tsw_point
 * @return {String}
 */

window.getScreenSize = function($ssw_point, $tsw_point) {
    if ($ssw_point.is(':visible')) {
        return 'small';
    } else if ($tsw_point.is(':visible')) {
        return 'tablet';
    } else {
        return 'desktop';
    }
};


window.elHasClass = function(el, selector) {
    return (" " + el.className + " ").indexOf(" " + selector + " ") > -1;
};
window.elRemoveClass = function(el, selector) {
    return el.className = (" " + el.className + " ").replace(" " + selector + " ", ' ').trim();
};

/*
 * Save value in the localStorage/Cookies.
 * 
 * @param  {String}  key
 * @param  {String}  value
 * @param  {Boolean} use_cookies
 */

window.storeValue = function(key, value, use_cookies) {
    var e;
    if (use_cookies == null) {
        use_cookies = false;
    }
    if (this.localStorageSupported && !use_cookies) {
        try {
            window.localStorage.setItem(Settings.stored_values_prefix + key, value);
            return;
        } catch (_error) {
            e = _error;
            1;
        }
    }
    return document.cookie = Settings.stored_values_prefix + key + '=' + escape(value);
};

/*
 * Save key/value pairs in the localStorage/Cookies.
 * 
 * @param  {Object} pairs
 * @param  {Boolean} use_cookies
*/

window.storeValues = function(pairs, use_cookies) {
    var e, key, value, _results;
    if (use_cookies == null) {
        use_cookies = false;
    }
    if (this.localStorageSupported && !use_cookies) {
        try {
            for (key in pairs) {
                value = pairs[key];
                window.localStorage.setItem(Settings.stored_values_prefix + key, value);
            }
            return;
        } catch (_error) {
            e = _error;
            1;
        }
    }
    _results = [];
    for (key in pairs) {
        value = pairs[key];
        _results.push(document.cookie = Settings.stored_values_prefix + key + '=' + escape(value));
    }
    return _results;
};


/*
 * Get value from the localStorage/Cookies.
 * 
 * @param  {String} key
 * @param  {Boolean} use_cookies
 */

window.getStoredValue = function(key, use_cookies, deflt) {
    var cookie, cookies, e, k, pos, r, v, _i, _len;
    if (use_cookies == null) {
        use_cookies = false;
    }
    if (deflt == null) {
        deflt = null;
    }
    if (this.localStorageSupported && !use_cookies) {
        try {
            r = window.localStorage.getItem(Settings.stored_values_prefix + key);
            return (r ? r : deflt);
        } catch (_error) {
            e = _error;
            1;
        }
    }
    cookies = document.cookie.split(';');
    for (_i = 0, _len = cookies.length; _i < _len; _i++) {
        cookie = cookies[_i];
        pos = cookie.indexOf('=');
        k = cookie.substr(0, pos).replace(/^\s+|\s+$/g, '');
        v = cookie.substr(pos + 1).replace(/^\s+|\s+$/g, '');
        if (k === (Settings.stored_values_prefix + key)) {
            return v;
        }
    }
    return deflt;
};

var delayedResizeHandler;

delayedResizeHandler = function(callback) {
    var resizeTimer;
    resizeTimer = null;
    return function() {
        if (resizeTimer) {
            clearTimeout(resizeTimer);
        }
        return resizeTimer = setTimeout(function() {
            resizeTimer = null;
            return callback.call(this);
        }, Settings.resize_delay);
    };
};



/*
 * Class that provides the main menu functionality.
 *
 * @class MainMenu
 */

(function() {    
    MainMenu = function() {
        this._screen = null;
        this._last_screen = null;
        this._animate = false;
        this._close_timer = null;
        this._dropdown_li = null;
        this._dropdown = null;
        return this;
    };


  /*
   * Initialize plugin.
   */

    MainMenu.prototype.init = function() {
        var self, state;
        var $ssw_point, $tsw_point, $window, _last_screen;
        _last_screen = null;
        $window = $(window);
        $ssw_point = $('<div id="small-screen-width-point" style="position:absolute;top:-10000px;width:10px;height:10px;background:#fff;"></div>');
        $tsw_point = $('<div id="tablet-screen-width-point" style="position:absolute;top:-10000px;width:10px;height:10px;background:#fff;"></div>');
        $('body').append($ssw_point).append($tsw_point);
        $window.on('resize', delayedResizeHandler(function() {
            $window.trigger("pa.resize");
            if ($ssw_point.is(':visible')) {
                if (_last_screen !== 'small') {
                    $window.trigger("pa.screen.small");
                }
                return _last_screen = 'small';
            } else if ($tsw_point.is(':visible')) {
                if (_last_screen !== 'tablet') {
                    $window.trigger("pa.screen.tablet");
                }
                return _last_screen = 'tablet';
            } else {
                if (_last_screen !== 'desktop') {
                    $window.trigger("pa.screen.desktop");
                }
                return _last_screen = 'desktop';
            }
        }));
        
        this.$menu = $('#main-menu');
        if (!this.$menu.length) {
            return;
        }
        this.$body = $('body');
        this.menu = this.$menu[0];
        this.$ssw_point = $('#small-screen-width-point');
        this.$tsw_point = $('#tablet-screen-width-point');
        self = this;
        if (Settings.main_menu.store_state) {
            state = this._getMenuState();
            document.body.className += ' disable-mm-animation';
            if (state !== null) {
                this.$body[state === 'collapsed' ? 'addClass' : 'removeClass']('mmc');
            }
            setTimeout((function(_this) {
                return function() {
                    return elRemoveClass(document.body, 'disable-mm-animation');
                };
            })(this), 20);
        }
        this.setupAnimation();
        $(window).on('resize.pa.mm', $.proxy(this.onResize, this));
        this.onResize();
        this.$menu.find('.navigation > .mm-dropdown').addClass('mm-dropdown-root');
        this.detectActiveItem();
        if ($.support.transition) {
            this.$menu.on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', $.proxy(this._onAnimationEnd, this));
        }
        $('#main-menu-toggle').on('click', $.proxy(this.toggle, this));
        $('#main-menu-inner').slimScroll({
            height: '100%'
        }).on('slimscrolling', (function(_this) {
            return function() {
                return _this.closeCurrentDropdown(true);
            };
        })(this));
        this.$menu.on('click', '.mm-dropdown > a', function() {
            var li;
            li = this.parentNode;
            if (elHasClass(li, 'mm-dropdown-root') && self._collapsed()) {
                if (elHasClass(li, 'mmc-dropdown-open')) {
                    if (elHasClass(li, 'freeze')) {
                        self.closeCurrentDropdown(true);
                    } else {
                        self.freezeDropdown(li);
                    }
                } else {
                    self.openDropdown(li, true);
                }
            } else {
                self.toggleSubmenu(li);
            }
            return false;
        });
        this.$menu.find('.navigation').on('mouseenter.pa.mm-dropdown', '.mm-dropdown-root', function() {
            self.clearCloseTimer();
            if (self._dropdown_li === this) {
                return;
            }
            if (self._collapsed() && (!self._dropdown_li || !elHasClass(self._dropdown_li, 'freeze'))) {
                return self.openDropdown(this);
            }
        }).on('mouseleave.pa.mm-dropdown', '.mm-dropdown-root', function() {
            return self._close_timer = setTimeout(function() {
                return self.closeCurrentDropdown();
            }, Settings.main_menu.dropdown_close_delay);
        });
        return this;
    };

    MainMenu.prototype._collapsed = function() {
        return (this._screen === 'desktop' && elHasClass(document.body, 'mmc')) || (this._screen !== 'desktop' && !elHasClass(document.body, 'mme'));
    };

    MainMenu.prototype.onResize = function() {
        this._screen = getScreenSize(this.$ssw_point, this.$tsw_point);
        this._animate = Settings.main_menu.disable_animation_on.indexOf(screen) === -1;
        if (this._dropdown_li) {
            this.closeCurrentDropdown(true);
        }
        if ((this._screen === 'small' && this._last_screen !== this._screen) || (this._screen === 'tablet' && this._last_screen === 'small')) {
            document.body.className += ' disable-mm-animation';
            setTimeout((function(_this) {
                return function() {
                    return elRemoveClass(document.body, 'disable-mm-animation');
                };
            })(this), 20);
        }
        return this._last_screen = this._screen;
    };

    MainMenu.prototype.clearCloseTimer = function() {
        if (this._close_timer) {
            clearTimeout(this._close_timer);
            return this._close_timer = null;
        }
    };

    MainMenu.prototype._onAnimationEnd = function(e) {
        if (this._screen !== 'desktop' || e.target.id !== 'main-menu') {
            return;
        }
        return $(window).trigger('resize');
    };

    MainMenu.prototype.toggle = function() {
        var cls, collapse;
        cls = this._screen === 'small' || this._screen === 'tablet' ? 'mme' : 'mmc';
        if (elHasClass(document.body, cls)) {
            elRemoveClass(document.body, cls);
        } else {
            document.body.className += ' ' + cls;
        }
        if (cls === 'mmc') {
            if (Settings.main_menu.store_state) {
                this._storeMenuState(elHasClass(document.body, 'mmc'));
            }
            if (!$.support.transition) {
                return $(window).trigger('resize');
            }
        } else {
            collapse = document.getElementById('');
            $('#main-navbar-collapse').stop().removeClass('in collapsing').addClass('collapse')[0].style.height = '0px';
            return $('#main-navbar .navbar-toggle').addClass('collapsed');
        }
    };

    MainMenu.prototype.toggleSubmenu = function(li) {
        this[elHasClass(li, 'open') ? 'collapseSubmenu' : 'expandSubmenu'](li);
        return false;
    };

    MainMenu.prototype.collapseSubmenu = function(li) {
        var $li, $ul;
        $li = $(li);
        $ul = $li.find('> ul');
        if (this._animate) {
            $ul.animate({
                height: 0
            }, Settings.main_menu.animation_speed, (function(_this) {
                return function() {
                    elRemoveClass(li, 'open');
                    $ul.attr('style', '');
                    return $li.find('.mm-dropdown.open').removeClass('open').find('> ul').attr('style', '');
                };
            })(this));
        } else {
            elRemoveClass(li, 'open');
        }
        return false;
    };

    MainMenu.prototype.expandSubmenu = function(li) {
        var $li, $ul, h, ul;
        $li = $(li);
        if (Settings.main_menu.accordion) {
            this.collapseAllSubmenus(li);
        }
        if (this._animate) {
            $ul = $li.find('> ul');
            ul = $ul[0];
            ul.className += ' get-height';
            h = $ul.height();
            elRemoveClass(ul, 'get-height');
            ul.style.display = 'block';
            ul.style.height = '0px';
            li.className += ' open';
            return $ul.animate({
                height: h
            }, Settings.main_menu.animation_speed, (function(_this) {
                return function() {
                    return $ul.attr('style', '');
                };
            })(this));
        } else {
            return li.className += ' open';
        }
    };

    MainMenu.prototype.collapseAllSubmenus = function(li) {
        var self;
        self = this;
        return $(li).parent().find('> .mm-dropdown.open').each(function() {
            return self.collapseSubmenu(this);
        });
    };

    MainMenu.prototype.openDropdown = function(li, freeze) {
        var $li, $title, $ul, $wrapper, max_height, min_height, title_h, top, ul, w_height, wrapper;
        if (freeze == null) {
            freeze = false;
        }
        if (this._dropdown_li) {
            this.closeCurrentDropdown(freeze);
        }
        $li = $(li);
        $ul = $li.find('> ul');
        ul = $ul[0];
        this._dropdown_li = li;
        this._dropdown = ul;
        $title = $ul.find('> .mmc-title');
        if (!$title.length) {
            $title = $('<div class="mmc-title"></div>').text($li.find('> a > .mm-text').text());
            ul.insertBefore($title[0], ul.firstChild);
        }
        li.className += ' mmc-dropdown-open';
        ul.className += ' mmc-dropdown-open-ul';
        top = $li.position().top;
        if (elHasClass(document.body, 'main-menu-fixed')) {
            $wrapper = $ul.find('.mmc-wrapper');
            if (!$wrapper.length) {
                wrapper = document.createElement('div');
                wrapper.className = 'mmc-wrapper';
                wrapper.style.overflow = 'hidden';
                wrapper.style.position = 'relative';
                $wrapper = $(wrapper);
                $wrapper.append($ul.find('> li'));
                ul.appendChild(wrapper);
            }
            w_height = $(window).innerHeight();
            title_h = $title.outerHeight();
            min_height = title_h + $ul.find('.mmc-wrapper > li').first().outerHeight() * 3;
            if ((top + min_height) > w_height) {
                max_height = top - $('#main-navbar').outerHeight();
                ul.className += ' top';
                ul.style.bottom = (w_height - top - title_h) + 'px';
            } else {
                max_height = w_height - top - title_h;
                ul.style.top = top + 'px';
            }
            if (elHasClass(ul, 'top')) {
                ul.appendChild($title[0]);
            } else {
                ul.insertBefore($title[0], ul.firstChild);
            }
            li.className += ' slimscroll-attached';
            $wrapper[0].style.maxHeight = (max_height - 10) + 'px';
            $wrapper.pixelSlimScroll({});
        } else {
            ul.style.top = top + 'px';
        }
        if (freeze) {
            this.freezeDropdown(li);
        }
        if (!freeze) {
            $ul.on('mouseenter', (function(_this) {
                return function() {
                    return _this.clearCloseTimer();
                };
            })(this)).on('mouseleave', (function(_this) {
                return function() {
                    return _this._close_timer = setTimeout(function() {
                        return _this.closeCurrentDropdown();
                    }, Settings.main_menu.dropdown_close_delay);
                };
            })(this));
            this;
        }
        return this.menu.appendChild(ul);
    };

    MainMenu.prototype.closeCurrentDropdown = function(force) {
        var $dropdown, $wrapper;
        if (force == null) {
            force = false;
        }
        if (!this._dropdown_li || (elHasClass(this._dropdown_li, 'freeze') && !force)) {
            return;
        }
        this.clearCloseTimer();
        $dropdown = $(this._dropdown);
        if (elHasClass(this._dropdown_li, 'slimscroll-attached')) {
            elRemoveClass(this._dropdown_li, 'slimscroll-attached');
            $wrapper = $dropdown.find('.mmc-wrapper');
            $wrapper.pixelSlimScroll({
                destroy: 'destroy'
            }).find('> *').appendTo($dropdown);
            $wrapper.remove();
        }
        this._dropdown_li.appendChild(this._dropdown);
        elRemoveClass(this._dropdown, 'mmc-dropdown-open-ul');
        elRemoveClass(this._dropdown, 'top');
        elRemoveClass(this._dropdown_li, 'mmc-dropdown-open');
        elRemoveClass(this._dropdown_li, 'freeze');
        $(this._dropdown_li).attr('style', '');
        $dropdown.attr('style', '').off('mouseenter').off('mouseleave');
        this._dropdown = null;
        return this._dropdown_li = null;
    };

    MainMenu.prototype.freezeDropdown = function(li) {
        return li.className += ' freeze';
    };

    MainMenu.prototype.setupAnimation = function() {
        var $mm, $mm_nav, d_body, dsbl_animation_on;
        d_body = document.body;
        dsbl_animation_on = Settings.main_menu.disable_animation_on;
        d_body.className += ' dont-animate-mm-content';
        $mm = $('#main-menu');
        $mm_nav = $mm.find('.navigation');
        $mm_nav.find('> .mm-dropdown > ul').addClass('mmc-dropdown-delay animated');
        $mm_nav.find('> li > a > .mm-text').addClass('mmc-dropdown-delay animated fadeIn');
        $mm.find('.menu-content').addClass('animated fadeIn');
        if (elHasClass(d_body, 'main-menu-right') || (elHasClass(d_body, 'right-to-left') && !elHasClass(d_body, 'main-menu-right'))) {
            $mm_nav.find('> .mm-dropdown > ul').addClass('fadeInRight');
        } else {
            $mm_nav.find('> .mm-dropdown > ul').addClass('fadeInLeft');
        }
        d_body.className += dsbl_animation_on.indexOf('small') === -1 ? ' animate-mm-sm' : ' dont-animate-mm-content-sm';
        d_body.className += dsbl_animation_on.indexOf('tablet') === -1 ? ' animate-mm-md' : ' dont-animate-mm-content-md';
        d_body.className += dsbl_animation_on.indexOf('desktop') === -1 ? ' animate-mm-lg' : ' dont-animate-mm-content-lg';
        return window.setTimeout(function() {
            return elRemoveClass(d_body, 'dont-animate-mm-content');
        }, 500);
    };

    MainMenu.prototype.detectActiveItem = function() {
        var a, bubble, links, nav, predicate, url, _i, _len, _results;
        url = (document.location + '').replace(/\#.*?$/, '');
        predicate = Settings.main_menu.detect_active_predicate;
        nav = $('#main-menu .navigation');
        nav.find('li').removeClass('open active');
        links = nav[0].getElementsByTagName('a');
        bubble = (function(_this) {
            return function(li) {
                li.className += ' active';
                if (!elHasClass(li.parentNode, 'navigation')) {
                    li = li.parentNode.parentNode;
                    li.className += ' open';
                    return bubble(li);
                }
            };
        })(this);
        _results = [];
        for (_i = 0, _len = links.length; _i < _len; _i++) {
            a = links[_i];
            if (a.href.indexOf('#') === -1 && predicate(a.href, url)) {
                bubble(a.parentNode);
                break;
            } else {
                _results.push(void 0);
            }
        }
        return _results;
    };


    /*
     * Load menu state.
     */

    MainMenu.prototype._getMenuState = function() {
        return getStoredValue(Settings.main_menu.store_state_key, null);
    };


    /*
     * Store menu state.
     */

    MainMenu.prototype._storeMenuState = function(is_collapsed) {
        if (!Settings.main_menu.store_state) {
            return;
        }
        return storeValue(Settings.main_menu.store_state_key, is_collapsed ? 'collapsed' : 'expanded');
    };

    MainMenu.Constructor = MainMenu;

}).call(this);
;