! function(e, t) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function(e, t) {
    function n(e) {
        var t = e.length,
            n = re.type(e);
        return "function" === n || re.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e
    }

    function i(e, t, n) {
        if (re.isFunction(t)) return re.grep(e, function(e, i) {
            return !!t.call(e, i, e) !== n
        });
        if (t.nodeType) return re.grep(e, function(e) {
            return e === t !== n
        });
        if ("string" == typeof t) {
            if (fe.test(t)) return re.filter(t, e, n);
            t = re.filter(t, e)
        }
        return re.grep(e, function(e) {
            return re.inArray(e, t) >= 0 !== n
        })
    }

    function a(e, t) {
        do e = e[t]; while (e && 1 !== e.nodeType);
        return e
    }

    function r(e) {
        var t = we[e] = {};
        return re.each(e.match(xe) || [], function(e, n) {
            t[n] = !0
        }), t
    }

    function o() {
        he.addEventListener ? (he.removeEventListener("DOMContentLoaded", s, !1), e.removeEventListener("load", s, !1)) : (he.detachEvent("onreadystatechange", s), e.detachEvent("onload", s))
    }

    function s() {
        (he.addEventListener || "load" === event.type || "complete" === he.readyState) && (o(), re.ready())
    }

    function l(e, t, n) {
        if (void 0 === n && 1 === e.nodeType) {
            var i = "data-" + t.replace(Se, "-$1").toLowerCase();
            if (n = e.getAttribute(i), "string" == typeof n) {
                try {
                    n = "true" === n ? !0 : "false" === n ? !1 : "null" === n ? null : +n + "" === n ? +n : Te.test(n) ? re.parseJSON(n) : n
                } catch (a) {}
                re.data(e, t, n)
            } else n = void 0
        }
        return n
    }

    function c(e) {
        var t;
        for (t in e)
            if (("data" !== t || !re.isEmptyObject(e[t])) && "toJSON" !== t) return !1;
        return !0
    }

    function u(e, t, n, i) {
        if (re.acceptData(e)) {
            var a, r, o = re.expando,
                s = e.nodeType,
                l = s ? re.cache : e,
                c = s ? e[o] : e[o] && o;
            if (c && l[c] && (i || l[c].data) || void 0 !== n || "string" != typeof t) return c || (c = s ? e[o] = V.pop() || re.guid++ : o), l[c] || (l[c] = s ? {} : {
                toJSON: re.noop
            }), ("object" == typeof t || "function" == typeof t) && (i ? l[c] = re.extend(l[c], t) : l[c].data = re.extend(l[c].data, t)), r = l[c], i || (r.data || (r.data = {}), r = r.data), void 0 !== n && (r[re.camelCase(t)] = n), "string" == typeof t ? (a = r[t], null == a && (a = r[re.camelCase(t)])) : a = r, a
        }
    }

    function d(e, t, n) {
        if (re.acceptData(e)) {
            var i, a, r = e.nodeType,
                o = r ? re.cache : e,
                s = r ? e[re.expando] : re.expando;
            if (o[s]) {
                if (t && (i = n ? o[s] : o[s].data)) {
                    re.isArray(t) ? t = t.concat(re.map(t, re.camelCase)) : t in i ? t = [t] : (t = re.camelCase(t), t = t in i ? [t] : t.split(" ")), a = t.length;
                    for (; a--;) delete i[t[a]];
                    if (n ? !c(i) : !re.isEmptyObject(i)) return
                }(n || (delete o[s].data, c(o[s]))) && (r ? re.cleanData([e], !0) : ie.deleteExpando || o != o.window ? delete o[s] : o[s] = null)
            }
        }
    }

    function p() {
        return !0
    }

    function f() {
        return !1
    }

    function m() {
        try {
            return he.activeElement
        } catch (e) {}
    }

    function h(e) {
        var t = Ie.split("|"),
            n = e.createDocumentFragment();
        if (n.createElement)
            for (; t.length;) n.createElement(t.pop());
        return n
    }

    function g(e, t) {
        var n, i, a = 0,
            r = typeof e.getElementsByTagName !== je ? e.getElementsByTagName(t || "*") : typeof e.querySelectorAll !== je ? e.querySelectorAll(t || "*") : void 0;
        if (!r)
            for (r = [], n = e.childNodes || e; null != (i = n[a]); a++) !t || re.nodeName(i, t) ? r.push(i) : re.merge(r, g(i, t));
        return void 0 === t || t && re.nodeName(e, t) ? re.merge([e], r) : r
    }

    function v(e) {
        Le.test(e.type) && (e.defaultChecked = e.checked)
    }

    function y(e, t) {
        return re.nodeName(e, "table") && re.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
    }

    function b(e) {
        return e.type = (null !== re.find.attr(e, "type")) + "/" + e.type, e
    }

    function x(e) {
        var t = Ve.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function w(e, t) {
        for (var n, i = 0; null != (n = e[i]); i++) re._data(n, "globalEval", !t || re._data(t[i], "globalEval"))
    }

    function k(e, t) {
        if (1 === t.nodeType && re.hasData(e)) {
            var n, i, a, r = re._data(e),
                o = re._data(t, r),
                s = r.events;
            if (s) {
                delete o.handle, o.events = {};
                for (n in s)
                    for (i = 0, a = s[n].length; a > i; i++) re.event.add(t, n, s[n][i])
            }
            o.data && (o.data = re.extend({}, o.data))
        }
    }

    function C(e, t) {
        var n, i, a;
        if (1 === t.nodeType) {
            if (n = t.nodeName.toLowerCase(), !ie.noCloneEvent && t[re.expando]) {
                a = re._data(t);
                for (i in a.events) re.removeEvent(t, i, a.handle);
                t.removeAttribute(re.expando)
            }
            "script" === n && t.text !== e.text ? (b(t).text = e.text, x(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), ie.html5Clone && e.innerHTML && !re.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Le.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
        }
    }

    function j(t, n) {
        var i = re(n.createElement(t)).appendTo(n.body),
            a = e.getDefaultComputedStyle ? e.getDefaultComputedStyle(i[0]).display : re.css(i[0], "display");
        return i.detach(), a
    }

    function T(e) {
        var t = he,
            n = et[e];
        return n || (n = j(e, t), "none" !== n && n || (Ze = (Ze || re("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement), t = (Ze[0].contentWindow || Ze[0].contentDocument).document, t.write(), t.close(), n = j(e, t), Ze.detach()), et[e] = n), n
    }

    function S(e, t) {
        return {
            get: function() {
                var n = e();
                if (null != n) return n ? void delete this.get : (this.get = t).apply(this, arguments)
            }
        }
    }

    function N(e, t) {
        if (t in e) return t;
        for (var n = t.charAt(0).toUpperCase() + t.slice(1), i = t, a = ft.length; a--;)
            if (t = ft[a] + n, t in e) return t;
        return i
    }

    function E(e, t) {
        for (var n, i, a, r = [], o = 0, s = e.length; s > o; o++) i = e[o], i.style && (r[o] = re._data(i, "olddisplay"), n = i.style.display, t ? (r[o] || "none" !== n || (i.style.display = ""), "" === i.style.display && De(i) && (r[o] = re._data(i, "olddisplay", T(i.nodeName)))) : r[o] || (a = De(i), (n && "none" !== n || !a) && re._data(i, "olddisplay", a ? n : re.css(i, "display"))));
        for (o = 0; s > o; o++) i = e[o], i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? r[o] || "" : "none"));
        return e
    }

    function D(e, t, n) {
        var i = ct.exec(t);
        return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : t
    }

    function A(e, t, n, i, a) {
        for (var r = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, o = 0; 4 > r; r += 2) "margin" === n && (o += re.css(e, n + Ee[r], !0, a)), i ? ("content" === n && (o -= re.css(e, "padding" + Ee[r], !0, a)), "margin" !== n && (o -= re.css(e, "border" + Ee[r] + "Width", !0, a))) : (o += re.css(e, "padding" + Ee[r], !0, a), "padding" !== n && (o += re.css(e, "border" + Ee[r] + "Width", !0, a)));
        return o
    }

    function L(e, t, n) {
        var i = !0,
            a = "width" === t ? e.offsetWidth : e.offsetHeight,
            r = tt(e),
            o = ie.boxSizing() && "border-box" === re.css(e, "boxSizing", !1, r);
        if (0 >= a || null == a) {
            if (a = nt(e, t, r), (0 > a || null == a) && (a = e.style[t]), at.test(a)) return a;
            i = o && (ie.boxSizingReliable() || a === e.style[t]), a = parseFloat(a) || 0
        }
        return a + A(e, t, n || (o ? "border" : "content"), i, r) + "px"
    }

    function $(e, t, n, i, a) {
        return new $.prototype.init(e, t, n, i, a)
    }

    function q() {
        return setTimeout(function() {
            mt = void 0
        }), mt = re.now()
    }

    function _(e, t) {
        var n, i = {
                height: e
            },
            a = 0;
        for (t = t ? 1 : 0; 4 > a; a += 2 - t) n = Ee[a], i["margin" + n] = i["padding" + n] = e;
        return t && (i.opacity = i.width = e), i
    }

    function R(e, t, n) {
        for (var i, a = (xt[t] || []).concat(xt["*"]), r = 0, o = a.length; o > r; r++)
            if (i = a[r].call(n, t, e)) return i
    }

    function P(e, t, n) {
        var i, a, r, o, s, l, c, u, d = this,
            p = {},
            f = e.style,
            m = e.nodeType && De(e),
            h = re._data(e, "fxshow");
        n.queue || (s = re._queueHooks(e, "fx"), null == s.unqueued && (s.unqueued = 0, l = s.empty.fire, s.empty.fire = function() {
            s.unqueued || l()
        }), s.unqueued++, d.always(function() {
            d.always(function() {
                s.unqueued--, re.queue(e, "fx").length || s.empty.fire()
            })
        })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [f.overflow, f.overflowX, f.overflowY], c = re.css(e, "display"), u = T(e.nodeName), "none" === c && (c = u), "inline" === c && "none" === re.css(e, "float") && (ie.inlineBlockNeedsLayout && "inline" !== u ? f.zoom = 1 : f.display = "inline-block")), n.overflow && (f.overflow = "hidden", ie.shrinkWrapBlocks() || d.always(function() {
            f.overflow = n.overflow[0], f.overflowX = n.overflow[1], f.overflowY = n.overflow[2]
        }));
        for (i in t)
            if (a = t[i], gt.exec(a)) {
                if (delete t[i], r = r || "toggle" === a, a === (m ? "hide" : "show")) {
                    if ("show" !== a || !h || void 0 === h[i]) continue;
                    m = !0
                }
                p[i] = h && h[i] || re.style(e, i)
            }
        if (!re.isEmptyObject(p)) {
            h ? "hidden" in h && (m = h.hidden) : h = re._data(e, "fxshow", {}), r && (h.hidden = !m), m ? re(e).show() : d.done(function() {
                re(e).hide()
            }), d.done(function() {
                var t;
                re._removeData(e, "fxshow");
                for (t in p) re.style(e, t, p[t])
            });
            for (i in p) o = R(m ? h[i] : 0, i, d), i in h || (h[i] = o.start, m && (o.end = o.start, o.start = "width" === i || "height" === i ? 1 : 0))
        }
    }

    function I(e, t) {
        var n, i, a, r, o;
        for (n in e)
            if (i = re.camelCase(n), a = t[i], r = e[n], re.isArray(r) && (a = r[1], r = e[n] = r[0]), n !== i && (e[i] = r, delete e[n]), o = re.cssHooks[i], o && "expand" in o) {
                r = o.expand(r), delete e[i];
                for (n in r) n in e || (e[n] = r[n], t[n] = a)
            } else t[i] = a
    }

    function O(e, t, n) {
        var i, a, r = 0,
            o = bt.length,
            s = re.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (a) return !1;
                for (var t = mt || q(), n = Math.max(0, c.startTime + c.duration - t), i = n / c.duration || 0, r = 1 - i, o = 0, l = c.tweens.length; l > o; o++) c.tweens[o].run(r);
                return s.notifyWith(e, [c, r, n]), 1 > r && l ? n : (s.resolveWith(e, [c]), !1)
            },
            c = s.promise({
                elem: e,
                props: re.extend({}, t),
                opts: re.extend(!0, {
                    specialEasing: {}
                }, n),
                originalProperties: t,
                originalOptions: n,
                startTime: mt || q(),
                duration: n.duration,
                tweens: [],
                createTween: function(t, n) {
                    var i = re.Tween(e, c.opts, t, n, c.opts.specialEasing[t] || c.opts.easing);
                    return c.tweens.push(i), i
                },
                stop: function(t) {
                    var n = 0,
                        i = t ? c.tweens.length : 0;
                    if (a) return this;
                    for (a = !0; i > n; n++) c.tweens[n].run(1);
                    return t ? s.resolveWith(e, [c, t]) : s.rejectWith(e, [c, t]), this
                }
            }),
            u = c.props;
        for (I(u, c.opts.specialEasing); o > r; r++)
            if (i = bt[r].call(c, e, u, c.opts)) return i;
        return re.map(u, R, c), re.isFunction(c.opts.start) && c.opts.start.call(e, c), re.fx.timer(re.extend(l, {
            elem: e,
            anim: c,
            queue: c.opts.queue
        })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
    }

    function M(e) {
        return function(t, n) {
            "string" != typeof t && (n = t, t = "*");
            var i, a = 0,
                r = t.toLowerCase().match(xe) || [];
            if (re.isFunction(n))
                for (; i = r[a++];) "+" === i.charAt(0) ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
        }
    }

    function F(e, t, n, i) {
        function a(s) {
            var l;
            return r[s] = !0, re.each(e[s] || [], function(e, s) {
                var c = s(t, n, i);
                return "string" != typeof c || o || r[c] ? o ? !(l = c) : void 0 : (t.dataTypes.unshift(c), a(c), !1)
            }), l
        }
        var r = {},
            o = e === zt;
        return a(t.dataTypes[0]) || !r["*"] && a("*")
    }

    function H(e, t) {
        var n, i, a = re.ajaxSettings.flatOptions || {};
        for (i in t) void 0 !== t[i] && ((a[i] ? e : n || (n = {}))[i] = t[i]);
        return n && re.extend(!0, e, n), e
    }

    function U(e, t, n) {
        for (var i, a, r, o, s = e.contents, l = e.dataTypes;
            "*" === l[0];) l.shift(), void 0 === a && (a = e.mimeType || t.getResponseHeader("Content-Type"));
        if (a)
            for (o in s)
                if (s[o] && s[o].test(a)) {
                    l.unshift(o);
                    break
                }
        if (l[0] in n) r = l[0];
        else {
            for (o in n) {
                if (!l[0] || e.converters[o + " " + l[0]]) {
                    r = o;
                    break
                }
                i || (i = o)
            }
            r = r || i
        }
        return r ? (r !== l[0] && l.unshift(r), n[r]) : void 0
    }

    function B(e, t, n, i) {
        var a, r, o, s, l, c = {},
            u = e.dataTypes.slice();
        if (u[1])
            for (o in e.converters) c[o.toLowerCase()] = e.converters[o];
        for (r = u.shift(); r;)
            if (e.responseFields[r] && (n[e.responseFields[r]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = u.shift())
                if ("*" === r) r = l;
                else if ("*" !== l && l !== r) {
            if (o = c[l + " " + r] || c["* " + r], !o)
                for (a in c)
                    if (s = a.split(" "), s[1] === r && (o = c[l + " " + s[0]] || c["* " + s[0]])) {
                        o === !0 ? o = c[a] : c[a] !== !0 && (r = s[0], u.unshift(s[1]));
                        break
                    }
            if (o !== !0)
                if (o && e["throws"]) t = o(t);
                else try {
                    t = o(t)
                } catch (d) {
                    return {
                        state: "parsererror",
                        error: o ? d : "No conversion from " + l + " to " + r
                    }
                }
        }
        return {
            state: "success",
            data: t
        }
    }

    function z(e, t, n, i) {
        var a;
        if (re.isArray(t)) re.each(t, function(t, a) {
            n || Vt.test(e) ? i(e, a) : z(e + "[" + ("object" == typeof a ? t : "") + "]", a, n, i)
        });
        else if (n || "object" !== re.type(t)) i(e, t);
        else
            for (a in t) z(e + "[" + a + "]", t[a], n, i)
    }

    function W() {
        try {
            return new e.XMLHttpRequest
        } catch (t) {}
    }

    function X() {
        try {
            return new e.ActiveXObject("Microsoft.XMLHTTP")
        } catch (t) {}
    }

    function Y(e) {
        return re.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1
    }
    var V = [],
        J = V.slice,
        K = V.concat,
        G = V.push,
        Q = V.indexOf,
        Z = {},
        ee = Z.toString,
        te = Z.hasOwnProperty,
        ne = "".trim,
        ie = {},
        ae = "1.11.0",
        re = function(e, t) {
            return new re.fn.init(e, t)
        },
        oe = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        se = /^-ms-/,
        le = /-([\da-z])/gi,
        ce = function(e, t) {
            return t.toUpperCase()
        };
    re.fn = re.prototype = {
        jquery: ae,
        constructor: re,
        selector: "",
        length: 0,
        toArray: function() {
            return J.call(this)
        },
        get: function(e) {
            return null != e ? 0 > e ? this[e + this.length] : this[e] : J.call(this)
        },
        pushStack: function(e) {
            var t = re.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        },
        each: function(e, t) {
            return re.each(this, e, t)
        },
        map: function(e) {
            return this.pushStack(re.map(this, function(t, n) {
                return e.call(t, n, t)
            }))
        },
        slice: function() {
            return this.pushStack(J.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(e) {
            var t = this.length,
                n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor(null)
        },
        push: G,
        sort: V.sort,
        splice: V.splice
    }, re.extend = re.fn.extend = function() {
        var e, t, n, i, a, r, o = arguments[0] || {},
            s = 1,
            l = arguments.length,
            c = !1;
        for ("boolean" == typeof o && (c = o, o = arguments[s] || {}, s++), "object" == typeof o || re.isFunction(o) || (o = {}), s === l && (o = this, s--); l > s; s++)
            if (null != (a = arguments[s]))
                for (i in a) e = o[i], n = a[i], o !== n && (c && n && (re.isPlainObject(n) || (t = re.isArray(n))) ? (t ? (t = !1, r = e && re.isArray(e) ? e : []) : r = e && re.isPlainObject(e) ? e : {}, o[i] = re.extend(c, r, n)) : void 0 !== n && (o[i] = n));
        return o
    }, re.extend({
        expando: "jQuery" + (ae + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(e) {
            throw new Error(e)
        },
        noop: function() {},
        isFunction: function(e) {
            return "function" === re.type(e)
        },
        isArray: Array.isArray || function(e) {
            return "array" === re.type(e)
        },
        isWindow: function(e) {
            return null != e && e == e.window
        },
        isNumeric: function(e) {
            return e - parseFloat(e) >= 0
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        isPlainObject: function(e) {
            var t;
            if (!e || "object" !== re.type(e) || e.nodeType || re.isWindow(e)) return !1;
            try {
                if (e.constructor && !te.call(e, "constructor") && !te.call(e.constructor.prototype, "isPrototypeOf")) return !1
            } catch (n) {
                return !1
            }
            if (ie.ownLast)
                for (t in e) return te.call(e, t);
            for (t in e);
            return void 0 === t || te.call(e, t)
        },
        type: function(e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? Z[ee.call(e)] || "object" : typeof e
        },
        globalEval: function(t) {
            t && re.trim(t) && (e.execScript || function(t) {
                e.eval.call(e, t)
            })(t)
        },
        camelCase: function(e) {
            return e.replace(se, "ms-").replace(le, ce)
        },
        nodeName: function(e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        },
        each: function(e, t, i) {
            var a, r = 0,
                o = e.length,
                s = n(e);
            if (i) {
                if (s)
                    for (; o > r && (a = t.apply(e[r], i), a !== !1); r++);
                else
                    for (r in e)
                        if (a = t.apply(e[r], i), a === !1) break
            } else if (s)
                for (; o > r && (a = t.call(e[r], r, e[r]), a !== !1); r++);
            else
                for (r in e)
                    if (a = t.call(e[r], r, e[r]), a === !1) break; return e
        },
        trim: ne && !ne.call("\ufeff ") ? function(e) {
            return null == e ? "" : ne.call(e)
        } : function(e) {
            return null == e ? "" : (e + "").replace(oe, "")
        },
        makeArray: function(e, t) {
            var i = t || [];
            return null != e && (n(Object(e)) ? re.merge(i, "string" == typeof e ? [e] : e) : G.call(i, e)), i
        },
        inArray: function(e, t, n) {
            var i;
            if (t) {
                if (Q) return Q.call(t, e, n);
                for (i = t.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)
                    if (n in t && t[n] === e) return n
            }
            return -1
        },
        merge: function(e, t) {
            for (var n = +t.length, i = 0, a = e.length; n > i;) e[a++] = t[i++];
            if (n !== n)
                for (; void 0 !== t[i];) e[a++] = t[i++];
            return e.length = a, e
        },
        grep: function(e, t, n) {
            for (var i, a = [], r = 0, o = e.length, s = !n; o > r; r++) i = !t(e[r], r), i !== s && a.push(e[r]);
            return a
        },
        map: function(e, t, i) {
            var a, r = 0,
                o = e.length,
                s = n(e),
                l = [];
            if (s)
                for (; o > r; r++) a = t(e[r], r, i), null != a && l.push(a);
            else
                for (r in e) a = t(e[r], r, i), null != a && l.push(a);
            return K.apply([], l)
        },
        guid: 1,
        proxy: function(e, t) {
            var n, i, a;
            return "string" == typeof t && (a = e[t], t = e, e = a), re.isFunction(e) ? (n = J.call(arguments, 2), i = function() {
                return e.apply(t || this, n.concat(J.call(arguments)))
            }, i.guid = e.guid = e.guid || re.guid++, i) : void 0
        },
        now: function() {
            return +new Date
        },
        support: ie
    }), re.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(e, t) {
        Z["[object " + t + "]"] = t.toLowerCase()
    });
    var ue = function(e) {
        function t(e, t, n, i) {
            var a, r, o, s, l, c, d, m, h, g;
            if ((t ? t.ownerDocument || t : F) !== $ && L(t), t = t || $, n = n || [], !e || "string" != typeof e) return n;
            if (1 !== (s = t.nodeType) && 9 !== s) return [];
            if (_ && !i) {
                if (a = ye.exec(e))
                    if (o = a[1]) {
                        if (9 === s) {
                            if (r = t.getElementById(o), !r || !r.parentNode) return n;
                            if (r.id === o) return n.push(r), n
                        } else if (t.ownerDocument && (r = t.ownerDocument.getElementById(o)) && O(t, r) && r.id === o) return n.push(r), n
                    } else {
                        if (a[2]) return Z.apply(n, t.getElementsByTagName(e)), n;
                        if ((o = a[3]) && C.getElementsByClassName && t.getElementsByClassName) return Z.apply(n, t.getElementsByClassName(o)), n
                    }
                if (C.qsa && (!R || !R.test(e))) {
                    if (m = d = M, h = t, g = 9 === s && e, 1 === s && "object" !== t.nodeName.toLowerCase()) {
                        for (c = p(e), (d = t.getAttribute("id")) ? m = d.replace(xe, "\\$&") : t.setAttribute("id", m), m = "[id='" + m + "'] ", l = c.length; l--;) c[l] = m + f(c[l]);
                        h = be.test(e) && u(t.parentNode) || t, g = c.join(",")
                    }
                    if (g) try {
                        return Z.apply(n, h.querySelectorAll(g)), n
                    } catch (v) {} finally {
                        d || t.removeAttribute("id")
                    }
                }
            }
            return w(e.replace(le, "$1"), t, n, i)
        }

        function n() {
            function e(n, i) {
                return t.push(n + " ") > j.cacheLength && delete e[t.shift()], e[n + " "] = i
            }
            var t = [];
            return e
        }

        function i(e) {
            return e[M] = !0, e
        }

        function a(e) {
            var t = $.createElement("div");
            try {
                return !!e(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function r(e, t) {
            for (var n = e.split("|"), i = e.length; i--;) j.attrHandle[n[i]] = t
        }

        function o(e, t) {
            var n = t && e,
                i = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || V) - (~e.sourceIndex || V);
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === t) return -1;
            return e ? 1 : -1
        }

        function s(e) {
            return function(t) {
                var n = t.nodeName.toLowerCase();
                return "input" === n && t.type === e
            }
        }

        function l(e) {
            return function(t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function c(e) {
            return i(function(t) {
                return t = +t, i(function(n, i) {
                    for (var a, r = e([], n.length, t), o = r.length; o--;) n[a = r[o]] && (n[a] = !(i[a] = n[a]))
                })
            })
        }

        function u(e) {
            return e && typeof e.getElementsByTagName !== Y && e
        }

        function d() {}

        function p(e, n) {
            var i, a, r, o, s, l, c, u = z[e + " "];
            if (u) return n ? 0 : u.slice(0);
            for (s = e, l = [], c = j.preFilter; s;) {
                (!i || (a = ce.exec(s))) && (a && (s = s.slice(a[0].length) || s), l.push(r = [])), i = !1, (a = ue.exec(s)) && (i = a.shift(), r.push({
                    value: i,
                    type: a[0].replace(le, " ")
                }), s = s.slice(i.length));
                for (o in j.filter) !(a = me[o].exec(s)) || c[o] && !(a = c[o](a)) || (i = a.shift(), r.push({
                    value: i,
                    type: o,
                    matches: a
                }), s = s.slice(i.length));
                if (!i) break
            }
            return n ? s.length : s ? t.error(e) : z(e, l).slice(0)
        }

        function f(e) {
            for (var t = 0, n = e.length, i = ""; n > t; t++) i += e[t].value;
            return i
        }

        function m(e, t, n) {
            var i = t.dir,
                a = n && "parentNode" === i,
                r = U++;
            return t.first ? function(t, n, r) {
                for (; t = t[i];)
                    if (1 === t.nodeType || a) return e(t, n, r)
            } : function(t, n, o) {
                var s, l, c = [H, r];
                if (o) {
                    for (; t = t[i];)
                        if ((1 === t.nodeType || a) && e(t, n, o)) return !0
                } else
                    for (; t = t[i];)
                        if (1 === t.nodeType || a) {
                            if (l = t[M] || (t[M] = {}), (s = l[i]) && s[0] === H && s[1] === r) return c[2] = s[2];
                            if (l[i] = c, c[2] = e(t, n, o)) return !0
                        }
            }
        }

        function h(e) {
            return e.length > 1 ? function(t, n, i) {
                for (var a = e.length; a--;)
                    if (!e[a](t, n, i)) return !1;
                return !0
            } : e[0]
        }

        function g(e, t, n, i, a) {
            for (var r, o = [], s = 0, l = e.length, c = null != t; l > s; s++)(r = e[s]) && (!n || n(r, i, a)) && (o.push(r), c && t.push(s));
            return o
        }

        function v(e, t, n, a, r, o) {
            return a && !a[M] && (a = v(a)), r && !r[M] && (r = v(r, o)), i(function(i, o, s, l) {
                var c, u, d, p = [],
                    f = [],
                    m = o.length,
                    h = i || x(t || "*", s.nodeType ? [s] : s, []),
                    v = !e || !i && t ? h : g(h, p, e, s, l),
                    y = n ? r || (i ? e : m || a) ? [] : o : v;
                if (n && n(v, y, s, l), a)
                    for (c = g(y, f), a(c, [], s, l), u = c.length; u--;)(d = c[u]) && (y[f[u]] = !(v[f[u]] = d));
                if (i) {
                    if (r || e) {
                        if (r) {
                            for (c = [], u = y.length; u--;)(d = y[u]) && c.push(v[u] = d);
                            r(null, y = [], c, l)
                        }
                        for (u = y.length; u--;)(d = y[u]) && (c = r ? te.call(i, d) : p[u]) > -1 && (i[c] = !(o[c] = d))
                    }
                } else y = g(y === o ? y.splice(m, y.length) : y), r ? r(null, o, y, l) : Z.apply(o, y)
            })
        }

        function y(e) {
            for (var t, n, i, a = e.length, r = j.relative[e[0].type], o = r || j.relative[" "], s = r ? 1 : 0, l = m(function(e) {
                    return e === t
                }, o, !0), c = m(function(e) {
                    return te.call(t, e) > -1
                }, o, !0), u = [function(e, n, i) {
                    return !r && (i || n !== E) || ((t = n).nodeType ? l(e, n, i) : c(e, n, i))
                }]; a > s; s++)
                if (n = j.relative[e[s].type]) u = [m(h(u), n)];
                else {
                    if (n = j.filter[e[s].type].apply(null, e[s].matches), n[M]) {
                        for (i = ++s; a > i && !j.relative[e[i].type]; i++);
                        return v(s > 1 && h(u), s > 1 && f(e.slice(0, s - 1).concat({
                            value: " " === e[s - 2].type ? "*" : ""
                        })).replace(le, "$1"), n, i > s && y(e.slice(s, i)), a > i && y(e = e.slice(i)), a > i && f(e))
                    }
                    u.push(n)
                }
            return h(u)
        }

        function b(e, n) {
            var a = n.length > 0,
                r = e.length > 0,
                o = function(i, o, s, l, c) {
                    var u, d, p, f = 0,
                        m = "0",
                        h = i && [],
                        v = [],
                        y = E,
                        b = i || r && j.find.TAG("*", c),
                        x = H += null == y ? 1 : Math.random() || .1,
                        w = b.length;
                    for (c && (E = o !== $ && o); m !== w && null != (u = b[m]); m++) {
                        if (r && u) {
                            for (d = 0; p = e[d++];)
                                if (p(u, o, s)) {
                                    l.push(u);
                                    break
                                }
                            c && (H = x)
                        }
                        a && ((u = !p && u) && f--, i && h.push(u))
                    }
                    if (f += m, a && m !== f) {
                        for (d = 0; p = n[d++];) p(h, v, o, s);
                        if (i) {
                            if (f > 0)
                                for (; m--;) h[m] || v[m] || (v[m] = G.call(l));
                            v = g(v)
                        }
                        Z.apply(l, v), c && !i && v.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                    }
                    return c && (H = x, E = y), h
                };
            return a ? i(o) : o
        }

        function x(e, n, i) {
            for (var a = 0, r = n.length; r > a; a++) t(e, n[a], i);
            return i
        }

        function w(e, t, n, i) {
            var a, r, o, s, l, c = p(e);
            if (!i && 1 === c.length) {
                if (r = c[0] = c[0].slice(0), r.length > 2 && "ID" === (o = r[0]).type && C.getById && 9 === t.nodeType && _ && j.relative[r[1].type]) {
                    if (t = (j.find.ID(o.matches[0].replace(we, ke), t) || [])[0], !t) return n;
                    e = e.slice(r.shift().value.length)
                }
                for (a = me.needsContext.test(e) ? 0 : r.length; a-- && (o = r[a], !j.relative[s = o.type]);)
                    if ((l = j.find[s]) && (i = l(o.matches[0].replace(we, ke), be.test(r[0].type) && u(t.parentNode) || t))) {
                        if (r.splice(a, 1), e = i.length && f(r), !e) return Z.apply(n, i), n;
                        break
                    }
            }
            return N(e, c)(i, t, !_, n, be.test(e) && u(t.parentNode) || t), n
        }
        var k, C, j, T, S, N, E, D, A, L, $, q, _, R, P, I, O, M = "sizzle" + -new Date,
            F = e.document,
            H = 0,
            U = 0,
            B = n(),
            z = n(),
            W = n(),
            X = function(e, t) {
                return e === t && (A = !0), 0
            },
            Y = "undefined",
            V = 1 << 31,
            J = {}.hasOwnProperty,
            K = [],
            G = K.pop,
            Q = K.push,
            Z = K.push,
            ee = K.slice,
            te = K.indexOf || function(e) {
                for (var t = 0, n = this.length; n > t; t++)
                    if (this[t] === e) return t;
                return -1
            },
            ne = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            ie = "[\\x20\\t\\r\\n\\f]",
            ae = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            re = ae.replace("w", "w#"),
            oe = "\\[" + ie + "*(" + ae + ")" + ie + "*(?:([*^$|!~]?=)" + ie + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + re + ")|)|)" + ie + "*\\]",
            se = ":(" + ae + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + oe.replace(3, 8) + ")*)|.*)\\)|)",
            le = new RegExp("^" + ie + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ie + "+$", "g"),
            ce = new RegExp("^" + ie + "*," + ie + "*"),
            ue = new RegExp("^" + ie + "*([>+~]|" + ie + ")" + ie + "*"),
            de = new RegExp("=" + ie + "*([^\\]'\"]*?)" + ie + "*\\]", "g"),
            pe = new RegExp(se),
            fe = new RegExp("^" + re + "$"),
            me = {
                ID: new RegExp("^#(" + ae + ")"),
                CLASS: new RegExp("^\\.(" + ae + ")"),
                TAG: new RegExp("^(" + ae.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + oe),
                PSEUDO: new RegExp("^" + se),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ie + "*(even|odd|(([+-]|)(\\d*)n|)" + ie + "*(?:([+-]|)" + ie + "*(\\d+)|))" + ie + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + ne + ")$", "i"),
                needsContext: new RegExp("^" + ie + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ie + "*((?:-\\d)?\\d*)" + ie + "*\\)|)(?=[^-]|$)", "i")
            },
            he = /^(?:input|select|textarea|button)$/i,
            ge = /^h\d$/i,
            ve = /^[^{]+\{\s*\[native \w/,
            ye = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            be = /[+~]/,
            xe = /'|\\/g,
            we = new RegExp("\\\\([\\da-f]{1,6}" + ie + "?|(" + ie + ")|.)", "ig"),
            ke = function(e, t, n) {
                var i = "0x" + t - 65536;
                return i !== i || n ? t : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            };
        try {
            Z.apply(K = ee.call(F.childNodes), F.childNodes), K[F.childNodes.length].nodeType
        } catch (Ce) {
            Z = {
                apply: K.length ? function(e, t) {
                    Q.apply(e, ee.call(t))
                } : function(e, t) {
                    for (var n = e.length, i = 0; e[n++] = t[i++];);
                    e.length = n - 1
                }
            }
        }
        C = t.support = {}, S = t.isXML = function(e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return t ? "HTML" !== t.nodeName : !1
        }, L = t.setDocument = function(e) {
            var t, n = e ? e.ownerDocument || e : F,
                i = n.defaultView;
            return n !== $ && 9 === n.nodeType && n.documentElement ? ($ = n, q = n.documentElement, _ = !S(n), i && i !== i.top && (i.addEventListener ? i.addEventListener("unload", function() {
                L()
            }, !1) : i.attachEvent && i.attachEvent("onunload", function() {
                L()
            })), C.attributes = a(function(e) {
                return e.className = "i", !e.getAttribute("className")
            }), C.getElementsByTagName = a(function(e) {
                return e.appendChild(n.createComment("")), !e.getElementsByTagName("*").length
            }), C.getElementsByClassName = ve.test(n.getElementsByClassName) && a(function(e) {
                return e.innerHTML = "<div class='a'></div><div class='a i'></div>", e.firstChild.className = "i", 2 === e.getElementsByClassName("i").length
            }), C.getById = a(function(e) {
                return q.appendChild(e).id = M, !n.getElementsByName || !n.getElementsByName(M).length
            }), C.getById ? (j.find.ID = function(e, t) {
                if (typeof t.getElementById !== Y && _) {
                    var n = t.getElementById(e);
                    return n && n.parentNode ? [n] : []
                }
            }, j.filter.ID = function(e) {
                var t = e.replace(we, ke);
                return function(e) {
                    return e.getAttribute("id") === t
                }
            }) : (delete j.find.ID, j.filter.ID = function(e) {
                var t = e.replace(we, ke);
                return function(e) {
                    var n = typeof e.getAttributeNode !== Y && e.getAttributeNode("id");
                    return n && n.value === t
                }
            }), j.find.TAG = C.getElementsByTagName ? function(e, t) {
                return typeof t.getElementsByTagName !== Y ? t.getElementsByTagName(e) : void 0
            } : function(e, t) {
                var n, i = [],
                    a = 0,
                    r = t.getElementsByTagName(e);
                if ("*" === e) {
                    for (; n = r[a++];) 1 === n.nodeType && i.push(n);
                    return i
                }
                return r
            }, j.find.CLASS = C.getElementsByClassName && function(e, t) {
                return typeof t.getElementsByClassName !== Y && _ ? t.getElementsByClassName(e) : void 0
            }, P = [], R = [], (C.qsa = ve.test(n.querySelectorAll)) && (a(function(e) {
                e.innerHTML = "<select t=''><option selected=''></option></select>", e.querySelectorAll("[t^='']").length && R.push("[*^$]=" + ie + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || R.push("\\[" + ie + "*(?:value|" + ne + ")"), e.querySelectorAll(":checked").length || R.push(":checked")
            }), a(function(e) {
                var t = n.createElement("input");
                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && R.push("name" + ie + "*[*^$|!~]?="), e.querySelectorAll(":enabled").length || R.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), R.push(",.*:")
            })), (C.matchesSelector = ve.test(I = q.webkitMatchesSelector || q.mozMatchesSelector || q.oMatchesSelector || q.msMatchesSelector)) && a(function(e) {
                C.disconnectedMatch = I.call(e, "div"), I.call(e, "[s!='']:x"), P.push("!=", se)
            }), R = R.length && new RegExp(R.join("|")), P = P.length && new RegExp(P.join("|")), t = ve.test(q.compareDocumentPosition), O = t || ve.test(q.contains) ? function(e, t) {
                var n = 9 === e.nodeType ? e.documentElement : e,
                    i = t && t.parentNode;
                return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
            } : function(e, t) {
                if (t)
                    for (; t = t.parentNode;)
                        if (t === e) return !0;
                return !1
            }, X = t ? function(e, t) {
                if (e === t) return A = !0, 0;
                var i = !e.compareDocumentPosition - !t.compareDocumentPosition;
                return i ? i : (i = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & i || !C.sortDetached && t.compareDocumentPosition(e) === i ? e === n || e.ownerDocument === F && O(F, e) ? -1 : t === n || t.ownerDocument === F && O(F, t) ? 1 : D ? te.call(D, e) - te.call(D, t) : 0 : 4 & i ? -1 : 1)
            } : function(e, t) {
                if (e === t) return A = !0, 0;
                var i, a = 0,
                    r = e.parentNode,
                    s = t.parentNode,
                    l = [e],
                    c = [t];
                if (!r || !s) return e === n ? -1 : t === n ? 1 : r ? -1 : s ? 1 : D ? te.call(D, e) - te.call(D, t) : 0;
                if (r === s) return o(e, t);
                for (i = e; i = i.parentNode;) l.unshift(i);
                for (i = t; i = i.parentNode;) c.unshift(i);
                for (; l[a] === c[a];) a++;
                return a ? o(l[a], c[a]) : l[a] === F ? -1 : c[a] === F ? 1 : 0
            }, n) : $
        }, t.matches = function(e, n) {
            return t(e, null, null, n)
        }, t.matchesSelector = function(e, n) {
            if ((e.ownerDocument || e) !== $ && L(e), n = n.replace(de, "='$1']"), C.matchesSelector && _ && (!P || !P.test(n)) && (!R || !R.test(n))) try {
                var i = I.call(e, n);
                if (i || C.disconnectedMatch || e.document && 11 !== e.document.nodeType) return i
            } catch (a) {}
            return t(n, $, null, [e]).length > 0
        }, t.contains = function(e, t) {
            return (e.ownerDocument || e) !== $ && L(e), O(e, t)
        }, t.attr = function(e, t) {
            (e.ownerDocument || e) !== $ && L(e);
            var n = j.attrHandle[t.toLowerCase()],
                i = n && J.call(j.attrHandle, t.toLowerCase()) ? n(e, t, !_) : void 0;
            return void 0 !== i ? i : C.attributes || !_ ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }, t.error = function(e) {
            throw new Error("Syntax error, unrecognized expression: " + e)
        }, t.uniqueSort = function(e) {
            var t, n = [],
                i = 0,
                a = 0;
            if (A = !C.detectDuplicates, D = !C.sortStable && e.slice(0), e.sort(X), A) {
                for (; t = e[a++];) t === e[a] && (i = n.push(a));
                for (; i--;) e.splice(n[i], 1)
            }
            return D = null, e
        }, T = t.getText = function(e) {
            var t, n = "",
                i = 0,
                a = e.nodeType;
            if (a) {
                if (1 === a || 9 === a || 11 === a) {
                    if ("string" == typeof e.textContent) return e.textContent;
                    for (e = e.firstChild; e; e = e.nextSibling) n += T(e)
                } else if (3 === a || 4 === a) return e.nodeValue
            } else
                for (; t = e[i++];) n += T(t);
            return n
        }, j = t.selectors = {
            cacheLength: 50,
            createPseudo: i,
            match: me,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function(e) {
                    return e[1] = e[1].replace(we, ke), e[3] = (e[4] || e[5] || "").replace(we, ke), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                },
                CHILD: function(e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                },
                PSEUDO: function(e) {
                    var t, n = !e[5] && e[2];
                    return me.CHILD.test(e[0]) ? null : (e[3] && void 0 !== e[4] ? e[2] = e[4] : n && pe.test(n) && (t = p(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function(e) {
                    var t = e.replace(we, ke).toLowerCase();
                    return "*" === e ? function() {
                        return !0
                    } : function(e) {
                        return e.nodeName && e.nodeName.toLowerCase() === t
                    }
                },
                CLASS: function(e) {
                    var t = B[e + " "];
                    return t || (t = new RegExp("(^|" + ie + ")" + e + "(" + ie + "|$)")) && B(e, function(e) {
                        return t.test("string" == typeof e.className && e.className || typeof e.getAttribute !== Y && e.getAttribute("class") || "")
                    })
                },
                ATTR: function(e, n, i) {
                    return function(a) {
                        var r = t.attr(a, e);
                        return null == r ? "!=" === n : n ? (r += "", "=" === n ? r === i : "!=" === n ? r !== i : "^=" === n ? i && 0 === r.indexOf(i) : "*=" === n ? i && r.indexOf(i) > -1 : "$=" === n ? i && r.slice(-i.length) === i : "~=" === n ? (" " + r + " ").indexOf(i) > -1 : "|=" === n ? r === i || r.slice(0, i.length + 1) === i + "-" : !1) : !0
                    }
                },
                CHILD: function(e, t, n, i, a) {
                    var r = "nth" !== e.slice(0, 3),
                        o = "last" !== e.slice(-4),
                        s = "of-type" === t;
                    return 1 === i && 0 === a ? function(e) {
                        return !!e.parentNode
                    } : function(t, n, l) {
                        var c, u, d, p, f, m, h = r !== o ? "nextSibling" : "previousSibling",
                            g = t.parentNode,
                            v = s && t.nodeName.toLowerCase(),
                            y = !l && !s;
                        if (g) {
                            if (r) {
                                for (; h;) {
                                    for (d = t; d = d[h];)
                                        if (s ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
                                    m = h = "only" === e && !m && "nextSibling"
                                }
                                return !0
                            }
                            if (m = [o ? g.firstChild : g.lastChild], o && y) {
                                for (u = g[M] || (g[M] = {}), c = u[e] || [], f = c[0] === H && c[1], p = c[0] === H && c[2], d = f && g.childNodes[f]; d = ++f && d && d[h] || (p = f = 0) || m.pop();)
                                    if (1 === d.nodeType && ++p && d === t) {
                                        u[e] = [H, f, p];
                                        break
                                    }
                            } else if (y && (c = (t[M] || (t[M] = {}))[e]) && c[0] === H) p = c[1];
                            else
                                for (;
                                    (d = ++f && d && d[h] || (p = f = 0) || m.pop()) && ((s ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++p || (y && ((d[M] || (d[M] = {}))[e] = [H, p]), d !== t)););
                            return p -= a, p === i || p % i === 0 && p / i >= 0
                        }
                    }
                },
                PSEUDO: function(e, n) {
                    var a, r = j.pseudos[e] || j.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                    return r[M] ? r(n) : r.length > 1 ? (a = [e, e, "", n], j.setFilters.hasOwnProperty(e.toLowerCase()) ? i(function(e, t) {
                        for (var i, a = r(e, n), o = a.length; o--;) i = te.call(e, a[o]), e[i] = !(t[i] = a[o])
                    }) : function(e) {
                        return r(e, 0, a)
                    }) : r
                }
            },
            pseudos: {
                not: i(function(e) {
                    var t = [],
                        n = [],
                        a = N(e.replace(le, "$1"));
                    return a[M] ? i(function(e, t, n, i) {
                        for (var r, o = a(e, null, i, []), s = e.length; s--;)(r = o[s]) && (e[s] = !(t[s] = r))
                    }) : function(e, i, r) {
                        return t[0] = e, a(t, null, r, n), !n.pop()
                    }
                }),
                has: i(function(e) {
                    return function(n) {
                        return t(e, n).length > 0
                    }
                }),
                contains: i(function(e) {
                    return function(t) {
                        return (t.textContent || t.innerText || T(t)).indexOf(e) > -1
                    }
                }),
                lang: i(function(e) {
                    return fe.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(we, ke).toLowerCase(),
                        function(t) {
                            var n;
                            do
                                if (n = _ ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-");
                            while ((t = t.parentNode) && 1 === t.nodeType);
                            return !1
                        }
                }),
                target: function(t) {
                    var n = e.location && e.location.hash;
                    return n && n.slice(1) === t.id
                },
                root: function(e) {
                    return e === q
                },
                focus: function(e) {
                    return e === $.activeElement && (!$.hasFocus || $.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                },
                enabled: function(e) {
                    return e.disabled === !1
                },
                disabled: function(e) {
                    return e.disabled === !0
                },
                checked: function(e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !!e.checked || "option" === t && !!e.selected
                },
                selected: function(e) {
                    return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                },
                empty: function(e) {
                    for (e = e.firstChild; e; e = e.nextSibling)
                        if (e.nodeType < 6) return !1;
                    return !0
                },
                parent: function(e) {
                    return !j.pseudos.empty(e)
                },
                header: function(e) {
                    return ge.test(e.nodeName)
                },
                input: function(e) {
                    return he.test(e.nodeName)
                },
                button: function(e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                },
                text: function(e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                },
                first: c(function() {
                    return [0]
                }),
                last: c(function(e, t) {
                    return [t - 1]
                }),
                eq: c(function(e, t, n) {
                    return [0 > n ? n + t : n]
                }),
                even: c(function(e, t) {
                    for (var n = 0; t > n; n += 2) e.push(n);
                    return e
                }),
                odd: c(function(e, t) {
                    for (var n = 1; t > n; n += 2) e.push(n);
                    return e
                }),
                lt: c(function(e, t, n) {
                    for (var i = 0 > n ? n + t : n; --i >= 0;) e.push(i);
                    return e
                }),
                gt: c(function(e, t, n) {
                    for (var i = 0 > n ? n + t : n; ++i < t;) e.push(i);
                    return e
                })
            }
        }, j.pseudos.nth = j.pseudos.eq;
        for (k in {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) j.pseudos[k] = s(k);
        for (k in {
                submit: !0,
                reset: !0
            }) j.pseudos[k] = l(k);
        return d.prototype = j.filters = j.pseudos, j.setFilters = new d, N = t.compile = function(e, t) {
            var n, i = [],
                a = [],
                r = W[e + " "];
            if (!r) {
                for (t || (t = p(e)), n = t.length; n--;) r = y(t[n]), r[M] ? i.push(r) : a.push(r);
                r = W(e, b(a, i))
            }
            return r
        }, C.sortStable = M.split("").sort(X).join("") === M, C.detectDuplicates = !!A, L(), C.sortDetached = a(function(e) {
            return 1 & e.compareDocumentPosition($.createElement("div"))
        }), a(function(e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || r("type|href|height|width", function(e, t, n) {
            return n ? void 0 : e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), C.attributes && a(function(e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || r("value", function(e, t, n) {
            return n || "input" !== e.nodeName.toLowerCase() ? void 0 : e.defaultValue
        }), a(function(e) {
            return null == e.getAttribute("disabled")
        }) || r(ne, function(e, t, n) {
            var i;
            return n ? void 0 : e[t] === !0 ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }), t
    }(e);
    re.find = ue, re.expr = ue.selectors, re.expr[":"] = re.expr.pseudos, re.unique = ue.uniqueSort, re.text = ue.getText, re.isXMLDoc = ue.isXML, re.contains = ue.contains;
    var de = re.expr.match.needsContext,
        pe = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        fe = /^.[^:#\[\.,]*$/;
    re.filter = function(e, t, n) {
        var i = t[0];
        return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? re.find.matchesSelector(i, e) ? [i] : [] : re.find.matches(e, re.grep(t, function(e) {
            return 1 === e.nodeType
        }))
    }, re.fn.extend({
        find: function(e) {
            var t, n = [],
                i = this,
                a = i.length;
            if ("string" != typeof e) return this.pushStack(re(e).filter(function() {
                for (t = 0; a > t; t++)
                    if (re.contains(i[t], this)) return !0
            }));
            for (t = 0; a > t; t++) re.find(e, i[t], n);
            return n = this.pushStack(a > 1 ? re.unique(n) : n), n.selector = this.selector ? this.selector + " " + e : e, n
        },
        filter: function(e) {
            return this.pushStack(i(this, e || [], !1))
        },
        not: function(e) {
            return this.pushStack(i(this, e || [], !0))
        },
        is: function(e) {
            return !!i(this, "string" == typeof e && de.test(e) ? re(e) : e || [], !1).length
        }
    });
    var me, he = e.document,
        ge = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        ve = re.fn.init = function(e, t) {
            var n, i;
            if (!e) return this;
            if ("string" == typeof e) {
                if (n = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : ge.exec(e), !n || !n[1] && t) return !t || t.jquery ? (t || me).find(e) : this.constructor(t).find(e);
                if (n[1]) {
                    if (t = t instanceof re ? t[0] : t, re.merge(this, re.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : he, !0)), pe.test(n[1]) && re.isPlainObject(t))
                        for (n in t) re.isFunction(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
                    return this
                }
                if (i = he.getElementById(n[2]), i && i.parentNode) {
                    if (i.id !== n[2]) return me.find(e);
                    this.length = 1, this[0] = i
                }
                return this.context = he, this.selector = e, this
            }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : re.isFunction(e) ? "undefined" != typeof me.ready ? me.ready(e) : e(re) : (void 0 !== e.selector && (this.selector = e.selector, this.context = e.context), re.makeArray(e, this))
        };
    ve.prototype = re.fn, me = re(he);
    var ye = /^(?:parents|prev(?:Until|All))/,
        be = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    re.extend({
        dir: function(e, t, n) {
            for (var i = [], a = e[t]; a && 9 !== a.nodeType && (void 0 === n || 1 !== a.nodeType || !re(a).is(n));) 1 === a.nodeType && i.push(a), a = a[t];
            return i
        },
        sibling: function(e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        }
    }), re.fn.extend({
        has: function(e) {
            var t, n = re(e, this),
                i = n.length;
            return this.filter(function() {
                for (t = 0; i > t; t++)
                    if (re.contains(this, n[t])) return !0
            })
        },
        closest: function(e, t) {
            for (var n, i = 0, a = this.length, r = [], o = de.test(e) || "string" != typeof e ? re(e, t || this.context) : 0; a > i; i++)
                for (n = this[i]; n && n !== t; n = n.parentNode)
                    if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && re.find.matchesSelector(n, e))) {
                        r.push(n);
                        break
                    }
            return this.pushStack(r.length > 1 ? re.unique(r) : r)
        },
        index: function(e) {
            return e ? "string" == typeof e ? re.inArray(this[0], re(e)) : re.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(e, t) {
            return this.pushStack(re.unique(re.merge(this.get(), re(e, t))))
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), re.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return re.dir(e, "parentNode")
        },
        parentsUntil: function(e, t, n) {
            return re.dir(e, "parentNode", n)
        },
        next: function(e) {
            return a(e, "nextSibling")
        },
        prev: function(e) {
            return a(e, "previousSibling")
        },
        nextAll: function(e) {
            return re.dir(e, "nextSibling")
        },
        prevAll: function(e) {
            return re.dir(e, "previousSibling")
        },
        nextUntil: function(e, t, n) {
            return re.dir(e, "nextSibling", n)
        },
        prevUntil: function(e, t, n) {
            return re.dir(e, "previousSibling", n)
        },
        siblings: function(e) {
            return re.sibling((e.parentNode || {}).firstChild, e)
        },
        children: function(e) {
            return re.sibling(e.firstChild)
        },
        contents: function(e) {
            return re.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : re.merge([], e.childNodes)
        }
    }, function(e, t) {
        re.fn[e] = function(n, i) {
            var a = re.map(this, t, n);
            return "Until" !== e.slice(-5) && (i = n), i && "string" == typeof i && (a = re.filter(i, a)), this.length > 1 && (be[e] || (a = re.unique(a)), ye.test(e) && (a = a.reverse())), this.pushStack(a)
        }
    });
    var xe = /\S+/g,
        we = {};
    re.Callbacks = function(e) {
        e = "string" == typeof e ? we[e] || r(e) : re.extend({}, e);
        var t, n, i, a, o, s, l = [],
            c = !e.once && [],
            u = function(r) {
                for (n = e.memory && r, i = !0, o = s || 0, s = 0, a = l.length, t = !0; l && a > o; o++)
                    if (l[o].apply(r[0], r[1]) === !1 && e.stopOnFalse) {
                        n = !1;
                        break
                    }
                t = !1, l && (c ? c.length && u(c.shift()) : n ? l = [] : d.disable())
            },
            d = {
                add: function() {
                    if (l) {
                        var i = l.length;
                        ! function r(t) {
                            re.each(t, function(t, n) {
                                var i = re.type(n);
                                "function" === i ? e.unique && d.has(n) || l.push(n) : n && n.length && "string" !== i && r(n)
                            })
                        }(arguments), t ? a = l.length : n && (s = i, u(n))
                    }
                    return this
                },
                remove: function() {
                    return l && re.each(arguments, function(e, n) {
                        for (var i;
                            (i = re.inArray(n, l, i)) > -1;) l.splice(i, 1), t && (a >= i && a--, o >= i && o--)
                    }), this
                },
                has: function(e) {
                    return e ? re.inArray(e, l) > -1 : !(!l || !l.length)
                },
                empty: function() {
                    return l = [], a = 0, this
                },
                disable: function() {
                    return l = c = n = void 0, this
                },
                disabled: function() {
                    return !l
                },
                lock: function() {
                    return c = void 0, n || d.disable(), this
                },
                locked: function() {
                    return !c
                },
                fireWith: function(e, n) {
                    return !l || i && !c || (n = n || [], n = [e, n.slice ? n.slice() : n], t ? c.push(n) : u(n)), this
                },
                fire: function() {
                    return d.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!i
                }
            };
        return d
    }, re.extend({
        Deferred: function(e) {
            var t = [
                    ["resolve", "done", re.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", re.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", re.Callbacks("memory")]
                ],
                n = "pending",
                i = {
                    state: function() {
                        return n
                    },
                    always: function() {
                        return a.done(arguments).fail(arguments), this
                    },
                    then: function() {
                        var e = arguments;
                        return re.Deferred(function(n) {
                            re.each(t, function(t, r) {
                                var o = re.isFunction(e[t]) && e[t];
                                a[r[1]](function() {
                                    var e = o && o.apply(this, arguments);
                                    e && re.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[r[0] + "With"](this === i ? n.promise() : this, o ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    },
                    promise: function(e) {
                        return null != e ? re.extend(e, i) : i
                    }
                },
                a = {};
            return i.pipe = i.then, re.each(t, function(e, r) {
                var o = r[2],
                    s = r[3];
                i[r[1]] = o.add, s && o.add(function() {
                    n = s
                }, t[1 ^ e][2].disable, t[2][2].lock), a[r[0]] = function() {
                    return a[r[0] + "With"](this === a ? i : this, arguments), this
                }, a[r[0] + "With"] = o.fireWith
            }), i.promise(a), e && e.call(a, a), a
        },
        when: function(e) {
            var t, n, i, a = 0,
                r = J.call(arguments),
                o = r.length,
                s = 1 !== o || e && re.isFunction(e.promise) ? o : 0,
                l = 1 === s ? e : re.Deferred(),
                c = function(e, n, i) {
                    return function(a) {
                        n[e] = this, i[e] = arguments.length > 1 ? J.call(arguments) : a, i === t ? l.notifyWith(n, i) : --s || l.resolveWith(n, i)
                    }
                };
            if (o > 1)
                for (t = new Array(o), n = new Array(o), i = new Array(o); o > a; a++) r[a] && re.isFunction(r[a].promise) ? r[a].promise().done(c(a, i, r)).fail(l.reject).progress(c(a, n, t)) : --s;
            return s || l.resolveWith(i, r), l.promise()
        }
    });
    var ke;
    re.fn.ready = function(e) {
        return re.ready.promise().done(e), this
    }, re.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(e) {
            e ? re.readyWait++ : re.ready(!0)
        },
        ready: function(e) {
            if (e === !0 ? !--re.readyWait : !re.isReady) {
                if (!he.body) return setTimeout(re.ready);
                re.isReady = !0, e !== !0 && --re.readyWait > 0 || (ke.resolveWith(he, [re]), re.fn.trigger && re(he).trigger("ready").off("ready"))
            }
        }
    }), re.ready.promise = function(t) {
        if (!ke)
            if (ke = re.Deferred(), "complete" === he.readyState) setTimeout(re.ready);
            else if (he.addEventListener) he.addEventListener("DOMContentLoaded", s, !1), e.addEventListener("load", s, !1);
        else {
            he.attachEvent("onreadystatechange", s), e.attachEvent("onload", s);
            var n = !1;
            try {
                n = null == e.frameElement && he.documentElement
            } catch (i) {}
            n && n.doScroll && ! function a() {
                if (!re.isReady) {
                    try {
                        n.doScroll("left")
                    } catch (e) {
                        return setTimeout(a, 50)
                    }
                    o(), re.ready()
                }
            }()
        }
        return ke.promise(t)
    };
    var Ce, je = "undefined";
    for (Ce in re(ie)) break;
    ie.ownLast = "0" !== Ce, ie.inlineBlockNeedsLayout = !1, re(function() {
            var e, t, n = he.getElementsByTagName("body")[0];
            n && (e = he.createElement("div"), e.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", t = he.createElement("div"), n.appendChild(e).appendChild(t), typeof t.style.zoom !== je && (t.style.cssText = "border:0;margin:0;width:1px;padding:1px;display:inline;zoom:1", (ie.inlineBlockNeedsLayout = 3 === t.offsetWidth) && (n.style.zoom = 1)), n.removeChild(e), e = t = null)
        }),
        function() {
            var e = he.createElement("div");
            if (null == ie.deleteExpando) {
                ie.deleteExpando = !0;
                try {
                    delete e.test
                } catch (t) {
                    ie.deleteExpando = !1
                }
            }
            e = null
        }(), re.acceptData = function(e) {
            var t = re.noData[(e.nodeName + " ").toLowerCase()],
                n = +e.nodeType || 1;
            return 1 !== n && 9 !== n ? !1 : !t || t !== !0 && e.getAttribute("classid") === t
        };
    var Te = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        Se = /([A-Z])/g;
    re.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function(e) {
            return e = e.nodeType ? re.cache[e[re.expando]] : e[re.expando], !!e && !c(e)
        },
        data: function(e, t, n) {
            return u(e, t, n)
        },
        removeData: function(e, t) {
            return d(e, t)
        },
        _data: function(e, t, n) {
            return u(e, t, n, !0)
        },
        _removeData: function(e, t) {
            return d(e, t, !0)
        }
    }), re.fn.extend({
        data: function(e, t) {
            var n, i, a, r = this[0],
                o = r && r.attributes;
            if (void 0 === e) {
                if (this.length && (a = re.data(r), 1 === r.nodeType && !re._data(r, "parsedAttrs"))) {
                    for (n = o.length; n--;) i = o[n].name, 0 === i.indexOf("data-") && (i = re.camelCase(i.slice(5)), l(r, i, a[i]));
                    re._data(r, "parsedAttrs", !0)
                }
                return a
            }
            return "object" == typeof e ? this.each(function() {
                re.data(this, e)
            }) : arguments.length > 1 ? this.each(function() {
                re.data(this, e, t)
            }) : r ? l(r, e, re.data(r, e)) : void 0
        },
        removeData: function(e) {
            return this.each(function() {
                re.removeData(this, e)
            })
        }
    }), re.extend({
        queue: function(e, t, n) {
            var i;
            return e ? (t = (t || "fx") + "queue", i = re._data(e, t), n && (!i || re.isArray(n) ? i = re._data(e, t, re.makeArray(n)) : i.push(n)), i || []) : void 0
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var n = re.queue(e, t),
                i = n.length,
                a = n.shift(),
                r = re._queueHooks(e, t),
                o = function() {
                    re.dequeue(e, t)
                };
            "inprogress" === a && (a = n.shift(), i--), a && ("fx" === t && n.unshift("inprogress"), delete r.stop, a.call(e, o, r)), !i && r && r.empty.fire()
        },
        _queueHooks: function(e, t) {
            var n = t + "queueHooks";
            return re._data(e, n) || re._data(e, n, {
                empty: re.Callbacks("once memory").add(function() {
                    re._removeData(e, t + "queue"), re._removeData(e, n)
                })
            })
        }
    }), re.fn.extend({
        queue: function(e, t) {
            var n = 2;
            return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? re.queue(this[0], e) : void 0 === t ? this : this.each(function() {
                var n = re.queue(this, e, t);
                re._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && re.dequeue(this, e)
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                re.dequeue(this, e)
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(e, t) {
            var n, i = 1,
                a = re.Deferred(),
                r = this,
                o = this.length,
                s = function() {
                    --i || a.resolveWith(r, [r])
                };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; o--;) n = re._data(r[o], e + "queueHooks"), n && n.empty && (i++, n.empty.add(s));
            return s(), a.promise(t)
        }
    });
    var Ne = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        Ee = ["Top", "Right", "Bottom", "Left"],
        De = function(e, t) {
            return e = t || e, "none" === re.css(e, "display") || !re.contains(e.ownerDocument, e)
        },
        Ae = re.access = function(e, t, n, i, a, r, o) {
            var s = 0,
                l = e.length,
                c = null == n;
            if ("object" === re.type(n)) {
                a = !0;
                for (s in n) re.access(e, t, s, n[s], !0, r, o)
            } else if (void 0 !== i && (a = !0, re.isFunction(i) || (o = !0), c && (o ? (t.call(e, i), t = null) : (c = t, t = function(e, t, n) {
                    return c.call(re(e), n)
                })), t))
                for (; l > s; s++) t(e[s], n, o ? i : i.call(e[s], s, t(e[s], n)));
            return a ? e : c ? t.call(e) : l ? t(e[0], n) : r
        },
        Le = /^(?:checkbox|radio)$/i;
    ! function() {
        var e = he.createDocumentFragment(),
            t = he.createElement("div"),
            n = he.createElement("input");
        if (t.setAttribute("className", "t"), t.innerHTML = "  <link/><table></table><a href='/a'>a</a>", ie.leadingWhitespace = 3 === t.firstChild.nodeType, ie.tbody = !t.getElementsByTagName("tbody").length, ie.htmlSerialize = !!t.getElementsByTagName("link").length, ie.html5Clone = "<:nav></:nav>" !== he.createElement("nav").cloneNode(!0).outerHTML, n.type = "checkbox", n.checked = !0, e.appendChild(n), ie.appendChecked = n.checked, t.innerHTML = "<textarea>x</textarea>", ie.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue, e.appendChild(t), t.innerHTML = "<input type='radio' checked='checked' name='t'/>", ie.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, ie.noCloneEvent = !0, t.attachEvent && (t.attachEvent("onclick", function() {
                ie.noCloneEvent = !1
            }), t.cloneNode(!0).click()), null == ie.deleteExpando) {
            ie.deleteExpando = !0;
            try {
                delete t.test
            } catch (i) {
                ie.deleteExpando = !1
            }
        }
        e = t = n = null
    }(),
    function() {
        var t, n, i = he.createElement("div");
        for (t in {
                submit: !0,
                change: !0,
                focusin: !0
            }) n = "on" + t, (ie[t + "Bubbles"] = n in e) || (i.setAttribute(n, "t"), ie[t + "Bubbles"] = i.attributes[n].expando === !1);
        i = null
    }();
    var $e = /^(?:input|select|textarea)$/i,
        qe = /^key/,
        _e = /^(?:mouse|contextmenu)|click/,
        Re = /^(?:focusinfocus|focusoutblur)$/,
        Pe = /^([^.]*)(?:\.(.+)|)$/;
    re.event = {
        global: {},
        add: function(e, t, n, i, a) {
            var r, o, s, l, c, u, d, p, f, m, h, g = re._data(e);
            if (g) {
                for (n.handler && (l = n, n = l.handler, a = l.selector), n.guid || (n.guid = re.guid++), (o = g.events) || (o = g.events = {}), (u = g.handle) || (u = g.handle = function(e) {
                        return typeof re === je || e && re.event.triggered === e.type ? void 0 : re.event.dispatch.apply(u.elem, arguments)
                    }, u.elem = e), t = (t || "").match(xe) || [""], s = t.length; s--;) r = Pe.exec(t[s]) || [], f = h = r[1], m = (r[2] || "").split(".").sort(), f && (c = re.event.special[f] || {}, f = (a ? c.delegateType : c.bindType) || f, c = re.event.special[f] || {}, d = re.extend({
                    type: f,
                    origType: h,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: a,
                    needsContext: a && re.expr.match.needsContext.test(a),
                    namespace: m.join(".")
                }, l), (p = o[f]) || (p = o[f] = [], p.delegateCount = 0, c.setup && c.setup.call(e, i, m, u) !== !1 || (e.addEventListener ? e.addEventListener(f, u, !1) : e.attachEvent && e.attachEvent("on" + f, u))), c.add && (c.add.call(e, d), d.handler.guid || (d.handler.guid = n.guid)), a ? p.splice(p.delegateCount++, 0, d) : p.push(d), re.event.global[f] = !0);
                e = null
            }
        },
        remove: function(e, t, n, i, a) {
            var r, o, s, l, c, u, d, p, f, m, h, g = re.hasData(e) && re._data(e);
            if (g && (u = g.events)) {
                for (t = (t || "").match(xe) || [""], c = t.length; c--;)
                    if (s = Pe.exec(t[c]) || [], f = h = s[1], m = (s[2] || "").split(".").sort(), f) {
                        for (d = re.event.special[f] || {}, f = (i ? d.delegateType : d.bindType) || f, p = u[f] || [], s = s[2] && new RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = r = p.length; r--;) o = p[r], !a && h !== o.origType || n && n.guid !== o.guid || s && !s.test(o.namespace) || i && i !== o.selector && ("**" !== i || !o.selector) || (p.splice(r, 1), o.selector && p.delegateCount--, d.remove && d.remove.call(e, o));
                        l && !p.length && (d.teardown && d.teardown.call(e, m, g.handle) !== !1 || re.removeEvent(e, f, g.handle), delete u[f])
                    } else
                        for (f in u) re.event.remove(e, f + t[c], n, i, !0);
                re.isEmptyObject(u) && (delete g.handle, re._removeData(e, "events"))
            }
        },
        trigger: function(t, n, i, a) {
            var r, o, s, l, c, u, d, p = [i || he],
                f = te.call(t, "type") ? t.type : t,
                m = te.call(t, "namespace") ? t.namespace.split(".") : [];
            if (s = u = i = i || he, 3 !== i.nodeType && 8 !== i.nodeType && !Re.test(f + re.event.triggered) && (f.indexOf(".") >= 0 && (m = f.split("."), f = m.shift(), m.sort()), o = f.indexOf(":") < 0 && "on" + f, t = t[re.expando] ? t : new re.Event(f, "object" == typeof t && t), t.isTrigger = a ? 2 : 3, t.namespace = m.join("."), t.namespace_re = t.namespace ? new RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = i), n = null == n ? [t] : re.makeArray(n, [t]), c = re.event.special[f] || {}, a || !c.trigger || c.trigger.apply(i, n) !== !1)) {
                if (!a && !c.noBubble && !re.isWindow(i)) {
                    for (l = c.delegateType || f, Re.test(l + f) || (s = s.parentNode); s; s = s.parentNode) p.push(s), u = s;
                    u === (i.ownerDocument || he) && p.push(u.defaultView || u.parentWindow || e)
                }
                for (d = 0;
                    (s = p[d++]) && !t.isPropagationStopped();) t.type = d > 1 ? l : c.bindType || f, r = (re._data(s, "events") || {})[t.type] && re._data(s, "handle"), r && r.apply(s, n), r = o && s[o], r && r.apply && re.acceptData(s) && (t.result = r.apply(s, n), t.result === !1 && t.preventDefault());
                if (t.type = f, !a && !t.isDefaultPrevented() && (!c._default || c._default.apply(p.pop(), n) === !1) && re.acceptData(i) && o && i[f] && !re.isWindow(i)) {
                    u = i[o], u && (i[o] = null), re.event.triggered = f;
                    try {
                        i[f]()
                    } catch (h) {}
                    re.event.triggered = void 0, u && (i[o] = u)
                }
                return t.result
            }
        },
        dispatch: function(e) {
            e = re.event.fix(e);
            var t, n, i, a, r, o = [],
                s = J.call(arguments),
                l = (re._data(this, "events") || {})[e.type] || [],
                c = re.event.special[e.type] || {};
            if (s[0] = e, e.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, e) !== !1) {
                for (o = re.event.handlers.call(this, e, l), t = 0;
                    (a = o[t++]) && !e.isPropagationStopped();)
                    for (e.currentTarget = a.elem, r = 0;
                        (i = a.handlers[r++]) && !e.isImmediatePropagationStopped();)(!e.namespace_re || e.namespace_re.test(i.namespace)) && (e.handleObj = i, e.data = i.data, n = ((re.event.special[i.origType] || {}).handle || i.handler).apply(a.elem, s), void 0 !== n && (e.result = n) === !1 && (e.preventDefault(), e.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, e), e.result
            }
        },
        handlers: function(e, t) {
            var n, i, a, r, o = [],
                s = t.delegateCount,
                l = e.target;
            if (s && l.nodeType && (!e.button || "click" !== e.type))
                for (; l != this; l = l.parentNode || this)
                    if (1 === l.nodeType && (l.disabled !== !0 || "click" !== e.type)) {
                        for (a = [], r = 0; s > r; r++) i = t[r], n = i.selector + " ", void 0 === a[n] && (a[n] = i.needsContext ? re(n, this).index(l) >= 0 : re.find(n, this, null, [l]).length), a[n] && a.push(i);
                        a.length && o.push({
                            elem: l,
                            handlers: a
                        })
                    }
            return s < t.length && o.push({
                elem: this,
                handlers: t.slice(s)
            }), o
        },
        fix: function(e) {
            if (e[re.expando]) return e;
            var t, n, i, a = e.type,
                r = e,
                o = this.fixHooks[a];
            for (o || (this.fixHooks[a] = o = _e.test(a) ? this.mouseHooks : qe.test(a) ? this.keyHooks : {}), i = o.props ? this.props.concat(o.props) : this.props, e = new re.Event(r), t = i.length; t--;) n = i[t], e[n] = r[n];
            return e.target || (e.target = r.srcElement || he), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, o.filter ? o.filter(e, r) : e
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(e, t) {
                return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(e, t) {
                var n, i, a, r = t.button,
                    o = t.fromElement;
                return null == e.pageX && null != t.clientX && (i = e.target.ownerDocument || he, a = i.documentElement, n = i.body, e.pageX = t.clientX + (a && a.scrollLeft || n && n.scrollLeft || 0) - (a && a.clientLeft || n && n.clientLeft || 0), e.pageY = t.clientY + (a && a.scrollTop || n && n.scrollTop || 0) - (a && a.clientTop || n && n.clientTop || 0)), !e.relatedTarget && o && (e.relatedTarget = o === e.target ? t.toElement : o), e.which || void 0 === r || (e.which = 1 & r ? 1 : 2 & r ? 3 : 4 & r ? 2 : 0), e
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== m() && this.focus) try {
                        return this.focus(), !1
                    } catch (e) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === m() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return re.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                },
                _default: function(e) {
                    return re.nodeName(e.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(e) {
                    void 0 !== e.result && (e.originalEvent.returnValue = e.result)
                }
            }
        },
        simulate: function(e, t, n, i) {
            var a = re.extend(new re.Event, n, {
                type: e,
                isSimulated: !0,
                originalEvent: {}
            });
            i ? re.event.trigger(a, null, t) : re.event.dispatch.call(t, a), a.isDefaultPrevented() && n.preventDefault()
        }
    }, re.removeEvent = he.removeEventListener ? function(e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n, !1)
    } : function(e, t, n) {
        var i = "on" + t;
        e.detachEvent && (typeof e[i] === je && (e[i] = null), e.detachEvent(i, n))
    }, re.Event = function(e, t) {
        return this instanceof re.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && (e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault()) ? p : f) : this.type = e, t && re.extend(this, t), this.timeStamp = e && e.timeStamp || re.now(), void(this[re.expando] = !0)) : new re.Event(e, t)
    }, re.Event.prototype = {
        isDefaultPrevented: f,
        isPropagationStopped: f,
        isImmediatePropagationStopped: f,
        preventDefault: function() {
            var e = this.originalEvent;
            this.isDefaultPrevented = p, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        },
        stopPropagation: function() {
            var e = this.originalEvent;
            this.isPropagationStopped = p, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
        },
        stopImmediatePropagation: function() {
            this.isImmediatePropagationStopped = p, this.stopPropagation()
        }
    }, re.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function(e, t) {
        re.event.special[e] = {
            delegateType: t,
            bindType: t,
            handle: function(e) {
                var n, i = this,
                    a = e.relatedTarget,
                    r = e.handleObj;
                return (!a || a !== i && !re.contains(i, a)) && (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n
            }
        }
    }), ie.submitBubbles || (re.event.special.submit = {
        setup: function() {
            return re.nodeName(this, "form") ? !1 : void re.event.add(this, "click._submit keypress._submit", function(e) {
                var t = e.target,
                    n = re.nodeName(t, "input") || re.nodeName(t, "button") ? t.form : void 0;
                n && !re._data(n, "submitBubbles") && (re.event.add(n, "submit._submit", function(e) {
                    e._submit_bubble = !0
                }), re._data(n, "submitBubbles", !0))
            })
        },
        postDispatch: function(e) {
            e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && re.event.simulate("submit", this.parentNode, e, !0))
        },
        teardown: function() {
            return re.nodeName(this, "form") ? !1 : void re.event.remove(this, "._submit")
        }
    }), ie.changeBubbles || (re.event.special.change = {
        setup: function() {
            return $e.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (re.event.add(this, "propertychange._change", function(e) {
                "checked" === e.originalEvent.propertyName && (this._just_changed = !0)
            }), re.event.add(this, "click._change", function(e) {
                this._just_changed && !e.isTrigger && (this._just_changed = !1), re.event.simulate("change", this, e, !0)
            })), !1) : void re.event.add(this, "beforeactivate._change", function(e) {
                var t = e.target;
                $e.test(t.nodeName) && !re._data(t, "changeBubbles") && (re.event.add(t, "change._change", function(e) {
                    !this.parentNode || e.isSimulated || e.isTrigger || re.event.simulate("change", this.parentNode, e, !0)
                }), re._data(t, "changeBubbles", !0))
            })
        },
        handle: function(e) {
            var t = e.target;
            return this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type ? e.handleObj.handler.apply(this, arguments) : void 0
        },
        teardown: function() {
            return re.event.remove(this, "._change"), !$e.test(this.nodeName)
        }
    }), ie.focusinBubbles || re.each({
        focus: "focusin",
        blur: "focusout"
    }, function(e, t) {
        var n = function(e) {
            re.event.simulate(t, e.target, re.event.fix(e), !0)
        };
        re.event.special[t] = {
            setup: function() {
                var i = this.ownerDocument || this,
                    a = re._data(i, t);
                a || i.addEventListener(e, n, !0), re._data(i, t, (a || 0) + 1)
            },
            teardown: function() {
                var i = this.ownerDocument || this,
                    a = re._data(i, t) - 1;
                a ? re._data(i, t, a) : (i.removeEventListener(e, n, !0), re._removeData(i, t))
            }
        }
    }), re.fn.extend({
        on: function(e, t, n, i, a) {
            var r, o;
            if ("object" == typeof e) {
                "string" != typeof t && (n = n || t, t = void 0);
                for (r in e) this.on(r, t, n, e[r], a);
                return this
            }
            if (null == n && null == i ? (i = t, n = t = void 0) : null == i && ("string" == typeof t ? (i = n, n = void 0) : (i = n, n = t, t = void 0)), i === !1) i = f;
            else if (!i) return this;
            return 1 === a && (o = i, i = function(e) {
                return re().off(e), o.apply(this, arguments)
            }, i.guid = o.guid || (o.guid = re.guid++)), this.each(function() {
                re.event.add(this, e, i, n, t)
            })
        },
        one: function(e, t, n, i) {
            return this.on(e, t, n, i, 1)
        },
        off: function(e, t, n) {
            var i, a;
            if (e && e.preventDefault && e.handleObj) return i = e.handleObj, re(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (a in e) this.off(a, t, e[a]);
                return this
            }
            return (t === !1 || "function" == typeof t) && (n = t, t = void 0), n === !1 && (n = f), this.each(function() {
                re.event.remove(this, e, n, t)
            })
        },
        trigger: function(e, t) {
            return this.each(function() {
                re.event.trigger(e, t, this)
            })
        },
        triggerHandler: function(e, t) {
            var n = this[0];
            return n ? re.event.trigger(e, t, n, !0) : void 0
        }
    });
    var Ie = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        Oe = / jQuery\d+="(?:null|\d+)"/g,
        Me = new RegExp("<(?:" + Ie + ")[\\s/>]", "i"),
        Fe = /^\s+/,
        He = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        Ue = /<([\w:]+)/,
        Be = /<tbody/i,
        ze = /<|&#?\w+;/,
        We = /<(?:script|style|link)/i,
        Xe = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Ye = /^$|\/(?:java|ecma)script/i,
        Ve = /^true\/(.*)/,
        Je = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        Ke = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: ie.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        Ge = h(he),
        Qe = Ge.appendChild(he.createElement("div"));
    Ke.optgroup = Ke.option, Ke.tbody = Ke.tfoot = Ke.colgroup = Ke.caption = Ke.thead, Ke.th = Ke.td, re.extend({
        clone: function(e, t, n) {
            var i, a, r, o, s, l = re.contains(e.ownerDocument, e);
            if (ie.html5Clone || re.isXMLDoc(e) || !Me.test("<" + e.nodeName + ">") ? r = e.cloneNode(!0) : (Qe.innerHTML = e.outerHTML, Qe.removeChild(r = Qe.firstChild)), !(ie.noCloneEvent && ie.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || re.isXMLDoc(e)))
                for (i = g(r), s = g(e), o = 0; null != (a = s[o]); ++o) i[o] && C(a, i[o]);
            if (t)
                if (n)
                    for (s = s || g(e), i = i || g(r), o = 0; null != (a = s[o]); o++) k(a, i[o]);
                else k(e, r);
            return i = g(r, "script"), i.length > 0 && w(i, !l && g(e, "script")), i = s = a = null, r
        },
        buildFragment: function(e, t, n, i) {
            for (var a, r, o, s, l, c, u, d = e.length, p = h(t), f = [], m = 0; d > m; m++)
                if (r = e[m], r || 0 === r)
                    if ("object" === re.type(r)) re.merge(f, r.nodeType ? [r] : r);
                    else if (ze.test(r)) {
                for (s = s || p.appendChild(t.createElement("div")), l = (Ue.exec(r) || ["", ""])[1].toLowerCase(), u = Ke[l] || Ke._default, s.innerHTML = u[1] + r.replace(He, "<$1></$2>") + u[2], a = u[0]; a--;) s = s.lastChild;
                if (!ie.leadingWhitespace && Fe.test(r) && f.push(t.createTextNode(Fe.exec(r)[0])), !ie.tbody)
                    for (r = "table" !== l || Be.test(r) ? "<table>" !== u[1] || Be.test(r) ? 0 : s : s.firstChild, a = r && r.childNodes.length; a--;) re.nodeName(c = r.childNodes[a], "tbody") && !c.childNodes.length && r.removeChild(c);
                for (re.merge(f, s.childNodes), s.textContent = ""; s.firstChild;) s.removeChild(s.firstChild);
                s = p.lastChild
            } else f.push(t.createTextNode(r));
            for (s && p.removeChild(s), ie.appendChecked || re.grep(g(f, "input"), v), m = 0; r = f[m++];)
                if ((!i || -1 === re.inArray(r, i)) && (o = re.contains(r.ownerDocument, r), s = g(p.appendChild(r), "script"), o && w(s), n))
                    for (a = 0; r = s[a++];) Ye.test(r.type || "") && n.push(r);
            return s = null, p
        },
        cleanData: function(e, t) {
            for (var n, i, a, r, o = 0, s = re.expando, l = re.cache, c = ie.deleteExpando, u = re.event.special; null != (n = e[o]); o++)
                if ((t || re.acceptData(n)) && (a = n[s], r = a && l[a])) {
                    if (r.events)
                        for (i in r.events) u[i] ? re.event.remove(n, i) : re.removeEvent(n, i, r.handle);
                    l[a] && (delete l[a], c ? delete n[s] : typeof n.removeAttribute !== je ? n.removeAttribute(s) : n[s] = null, V.push(a))
                }
        }
    }), re.fn.extend({
        text: function(e) {
            return Ae(this, function(e) {
                return void 0 === e ? re.text(this) : this.empty().append((this[0] && this[0].ownerDocument || he).createTextNode(e))
            }, null, e, arguments.length)
        },
        append: function() {
            return this.domManip(arguments, function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = y(this, e);
                    t.appendChild(e)
                }
            })
        },
        prepend: function() {
            return this.domManip(arguments, function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = y(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function() {
            return this.domManip(arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function() {
            return this.domManip(arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        remove: function(e, t) {
            for (var n, i = e ? re.filter(e, this) : this, a = 0; null != (n = i[a]); a++) t || 1 !== n.nodeType || re.cleanData(g(n)), n.parentNode && (t && re.contains(n.ownerDocument, n) && w(g(n, "script")), n.parentNode.removeChild(n));
            return this
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) {
                for (1 === e.nodeType && re.cleanData(g(e, !1)); e.firstChild;) e.removeChild(e.firstChild);
                e.options && re.nodeName(e, "select") && (e.options.length = 0)
            }
            return this
        },
        clone: function(e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function() {
                return re.clone(this, e, t)
            })
        },
        html: function(e) {
            return Ae(this, function(e) {
                var t = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === e) return 1 === t.nodeType ? t.innerHTML.replace(Oe, "") : void 0;
                if ("string" == typeof e && !We.test(e) && (ie.htmlSerialize || !Me.test(e)) && (ie.leadingWhitespace || !Fe.test(e)) && !Ke[(Ue.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = e.replace(He, "<$1></$2>");
                    try {
                        for (; i > n; n++) t = this[n] || {}, 1 === t.nodeType && (re.cleanData(g(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (a) {}
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function() {
            var e = arguments[0];
            return this.domManip(arguments, function(t) {
                e = this.parentNode, re.cleanData(g(this)), e && e.replaceChild(t, this)
            }), e && (e.length || e.nodeType) ? this : this.remove()
        },
        detach: function(e) {
            return this.remove(e, !0)
        },
        domManip: function(e, t) {
            e = K.apply([], e);
            var n, i, a, r, o, s, l = 0,
                c = this.length,
                u = this,
                d = c - 1,
                p = e[0],
                f = re.isFunction(p);
            if (f || c > 1 && "string" == typeof p && !ie.checkClone && Xe.test(p)) return this.each(function(n) {
                var i = u.eq(n);
                f && (e[0] = p.call(this, n, i.html())), i.domManip(e, t)
            });
            if (c && (s = re.buildFragment(e, this[0].ownerDocument, !1, this), n = s.firstChild, 1 === s.childNodes.length && (s = n), n)) {
                for (r = re.map(g(s, "script"), b), a = r.length; c > l; l++) i = s, l !== d && (i = re.clone(i, !0, !0), a && re.merge(r, g(i, "script"))), t.call(this[l], i, l);
                if (a)
                    for (o = r[r.length - 1].ownerDocument, re.map(r, x), l = 0; a > l; l++) i = r[l], Ye.test(i.type || "") && !re._data(i, "globalEval") && re.contains(o, i) && (i.src ? re._evalUrl && re._evalUrl(i.src) : re.globalEval((i.text || i.textContent || i.innerHTML || "").replace(Je, "")));
                s = n = null
            }
            return this
        }
    }), re.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(e, t) {
        re.fn[e] = function(e) {
            for (var n, i = 0, a = [], r = re(e), o = r.length - 1; o >= i; i++) n = i === o ? this : this.clone(!0), re(r[i])[t](n), G.apply(a, n.get());
            return this.pushStack(a)
        }
    });
    var Ze, et = {};
    ! function() {
        var e, t, n = he.createElement("div"),
            i = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
        n.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", e = n.getElementsByTagName("a")[0], e.style.cssText = "float:left;opacity:.5", ie.opacity = /^0.5/.test(e.style.opacity), ie.cssFloat = !!e.style.cssFloat, n.style.backgroundClip = "content-box", n.cloneNode(!0).style.backgroundClip = "", ie.clearCloneStyle = "content-box" === n.style.backgroundClip, e = n = null, ie.shrinkWrapBlocks = function() {
            var e, n, a, r;
            if (null == t) {
                if (e = he.getElementsByTagName("body")[0], !e) return;
                r = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px", n = he.createElement("div"), a = he.createElement("div"), e.appendChild(n).appendChild(a), t = !1, typeof a.style.zoom !== je && (a.style.cssText = i + ";width:1px;padding:1px;zoom:1", a.innerHTML = "<div></div>", a.firstChild.style.width = "5px", t = 3 !== a.offsetWidth), e.removeChild(n), e = n = a = null
            }
            return t
        }
    }();
    var tt, nt, it = /^margin/,
        at = new RegExp("^(" + Ne + ")(?!px)[a-z%]+$", "i"),
        rt = /^(top|right|bottom|left)$/;
    e.getComputedStyle ? (tt = function(e) {
            return e.ownerDocument.defaultView.getComputedStyle(e, null)
        }, nt = function(e, t, n) {
            var i, a, r, o, s = e.style;
            return n = n || tt(e), o = n ? n.getPropertyValue(t) || n[t] : void 0, n && ("" !== o || re.contains(e.ownerDocument, e) || (o = re.style(e, t)), at.test(o) && it.test(t) && (i = s.width, a = s.minWidth, r = s.maxWidth, s.minWidth = s.maxWidth = s.width = o,
                o = n.width, s.width = i, s.minWidth = a, s.maxWidth = r)), void 0 === o ? o : o + ""
        }) : he.documentElement.currentStyle && (tt = function(e) {
            return e.currentStyle
        }, nt = function(e, t, n) {
            var i, a, r, o, s = e.style;
            return n = n || tt(e), o = n ? n[t] : void 0, null == o && s && s[t] && (o = s[t]), at.test(o) && !rt.test(t) && (i = s.left, a = e.runtimeStyle, r = a && a.left, r && (a.left = e.currentStyle.left), s.left = "fontSize" === t ? "1em" : o, o = s.pixelLeft + "px", s.left = i, r && (a.left = r)), void 0 === o ? o : o + "" || "auto"
        }),
        function() {
            function t() {
                var t, n, i = he.getElementsByTagName("body")[0];
                i && (t = he.createElement("div"), n = he.createElement("div"), t.style.cssText = c, i.appendChild(t).appendChild(n), n.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;display:block;padding:1px;border:1px;width:4px;margin-top:1%;top:1%", re.swap(i, null != i.style.zoom ? {
                    zoom: 1
                } : {}, function() {
                    a = 4 === n.offsetWidth
                }), r = !0, o = !1, s = !0, e.getComputedStyle && (o = "1%" !== (e.getComputedStyle(n, null) || {}).top, r = "4px" === (e.getComputedStyle(n, null) || {
                    width: "4px"
                }).width), i.removeChild(t), n = i = null)
            }
            var n, i, a, r, o, s, l = he.createElement("div"),
                c = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px",
                u = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
            l.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = l.getElementsByTagName("a")[0], n.style.cssText = "float:left;opacity:.5", ie.opacity = /^0.5/.test(n.style.opacity), ie.cssFloat = !!n.style.cssFloat, l.style.backgroundClip = "content-box", l.cloneNode(!0).style.backgroundClip = "", ie.clearCloneStyle = "content-box" === l.style.backgroundClip, n = l = null, re.extend(ie, {
                reliableHiddenOffsets: function() {
                    if (null != i) return i;
                    var e, t, n, a = he.createElement("div"),
                        r = he.getElementsByTagName("body")[0];
                    if (r) return a.setAttribute("className", "t"), a.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", e = he.createElement("div"), e.style.cssText = c, r.appendChild(e).appendChild(a), a.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", t = a.getElementsByTagName("td"), t[0].style.cssText = "padding:0;margin:0;border:0;display:none", n = 0 === t[0].offsetHeight, t[0].style.display = "", t[1].style.display = "none", i = n && 0 === t[0].offsetHeight, r.removeChild(e), a = r = null, i
                },
                boxSizing: function() {
                    return null == a && t(), a
                },
                boxSizingReliable: function() {
                    return null == r && t(), r
                },
                pixelPosition: function() {
                    return null == o && t(), o
                },
                reliableMarginRight: function() {
                    var t, n, i, a;
                    if (null == s && e.getComputedStyle) {
                        if (t = he.getElementsByTagName("body")[0], !t) return;
                        n = he.createElement("div"), i = he.createElement("div"), n.style.cssText = c, t.appendChild(n).appendChild(i), a = i.appendChild(he.createElement("div")), a.style.cssText = i.style.cssText = u, a.style.marginRight = a.style.width = "0", i.style.width = "1px", s = !parseFloat((e.getComputedStyle(a, null) || {}).marginRight), t.removeChild(n)
                    }
                    return s
                }
            })
        }(), re.swap = function(e, t, n, i) {
            var a, r, o = {};
            for (r in t) o[r] = e.style[r], e.style[r] = t[r];
            a = n.apply(e, i || []);
            for (r in t) e.style[r] = o[r];
            return a
        };
    var ot = /alpha\([^)]*\)/i,
        st = /opacity\s*=\s*([^)]*)/,
        lt = /^(none|table(?!-c[ea]).+)/,
        ct = new RegExp("^(" + Ne + ")(.*)$", "i"),
        ut = new RegExp("^([+-])=(" + Ne + ")", "i"),
        dt = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        pt = {
            letterSpacing: 0,
            fontWeight: 400
        },
        ft = ["Webkit", "O", "Moz", "ms"];
    re.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var n = nt(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": ie.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var a, r, o, s = re.camelCase(t),
                    l = e.style;
                if (t = re.cssProps[s] || (re.cssProps[s] = N(l, s)), o = re.cssHooks[t] || re.cssHooks[s], void 0 === n) return o && "get" in o && void 0 !== (a = o.get(e, !1, i)) ? a : l[t];
                if (r = typeof n, "string" === r && (a = ut.exec(n)) && (n = (a[1] + 1) * a[2] + parseFloat(re.css(e, t)), r = "number"), null != n && n === n && ("number" !== r || re.cssNumber[s] || (n += "px"), ie.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"), !(o && "set" in o && void 0 === (n = o.set(e, n, i))))) try {
                    l[t] = "", l[t] = n
                } catch (c) {}
            }
        },
        css: function(e, t, n, i) {
            var a, r, o, s = re.camelCase(t);
            return t = re.cssProps[s] || (re.cssProps[s] = N(e.style, s)), o = re.cssHooks[t] || re.cssHooks[s], o && "get" in o && (r = o.get(e, !0, n)), void 0 === r && (r = nt(e, t, i)), "normal" === r && t in pt && (r = pt[t]), "" === n || n ? (a = parseFloat(r), n === !0 || re.isNumeric(a) ? a || 0 : r) : r
        }
    }), re.each(["height", "width"], function(e, t) {
        re.cssHooks[t] = {
            get: function(e, n, i) {
                return n ? 0 === e.offsetWidth && lt.test(re.css(e, "display")) ? re.swap(e, dt, function() {
                    return L(e, t, i)
                }) : L(e, t, i) : void 0
            },
            set: function(e, n, i) {
                var a = i && tt(e);
                return D(e, n, i ? A(e, t, i, ie.boxSizing() && "border-box" === re.css(e, "boxSizing", !1, a), a) : 0)
            }
        }
    }), ie.opacity || (re.cssHooks.opacity = {
        get: function(e, t) {
            return st.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
        },
        set: function(e, t) {
            var n = e.style,
                i = e.currentStyle,
                a = re.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                r = i && i.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === re.trim(r.replace(ot, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || i && !i.filter) || (n.filter = ot.test(r) ? r.replace(ot, a) : r + " " + a)
        }
    }), re.cssHooks.marginRight = S(ie.reliableMarginRight, function(e, t) {
        return t ? re.swap(e, {
            display: "inline-block"
        }, nt, [e, "marginRight"]) : void 0
    }), re.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(e, t) {
        re.cssHooks[e + t] = {
            expand: function(n) {
                for (var i = 0, a = {}, r = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) a[e + Ee[i] + t] = r[i] || r[i - 2] || r[0];
                return a
            }
        }, it.test(e) || (re.cssHooks[e + t].set = D)
    }), re.fn.extend({
        css: function(e, t) {
            return Ae(this, function(e, t, n) {
                var i, a, r = {},
                    o = 0;
                if (re.isArray(t)) {
                    for (i = tt(e), a = t.length; a > o; o++) r[t[o]] = re.css(e, t[o], !1, i);
                    return r
                }
                return void 0 !== n ? re.style(e, t, n) : re.css(e, t)
            }, e, t, arguments.length > 1)
        },
        show: function() {
            return E(this, !0)
        },
        hide: function() {
            return E(this)
        },
        toggle: function(e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                De(this) ? re(this).show() : re(this).hide()
            })
        }
    }), re.Tween = $, $.prototype = {
        constructor: $,
        init: function(e, t, n, i, a, r) {
            this.elem = e, this.prop = n, this.easing = a || "swing", this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (re.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var e = $.propHooks[this.prop];
            return e && e.get ? e.get(this) : $.propHooks._default.get(this)
        },
        run: function(e) {
            var t, n = $.propHooks[this.prop];
            return this.options.duration ? this.pos = t = re.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : $.propHooks._default.set(this), this
        }
    }, $.prototype.init.prototype = $.prototype, $.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = re.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
            },
            set: function(e) {
                re.fx.step[e.prop] ? re.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[re.cssProps[e.prop]] || re.cssHooks[e.prop]) ? re.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
            }
        }
    }, $.propHooks.scrollTop = $.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, re.easing = {
        linear: function(e) {
            return e
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }
    }, re.fx = $.prototype.init, re.fx.step = {};
    var mt, ht, gt = /^(?:toggle|show|hide)$/,
        vt = new RegExp("^(?:([+-])=|)(" + Ne + ")([a-z%]*)$", "i"),
        yt = /queueHooks$/,
        bt = [P],
        xt = {
            "*": [function(e, t) {
                var n = this.createTween(e, t),
                    i = n.cur(),
                    a = vt.exec(t),
                    r = a && a[3] || (re.cssNumber[e] ? "" : "px"),
                    o = (re.cssNumber[e] || "px" !== r && +i) && vt.exec(re.css(n.elem, e)),
                    s = 1,
                    l = 20;
                if (o && o[3] !== r) {
                    r = r || o[3], a = a || [], o = +i || 1;
                    do s = s || ".5", o /= s, re.style(n.elem, e, o + r); while (s !== (s = n.cur() / i) && 1 !== s && --l)
                }
                return a && (o = n.start = +o || +i || 0, n.unit = r, n.end = a[1] ? o + (a[1] + 1) * a[2] : +a[2]), n
            }]
        };
    re.Animation = re.extend(O, {
            tweener: function(e, t) {
                re.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
                for (var n, i = 0, a = e.length; a > i; i++) n = e[i], xt[n] = xt[n] || [], xt[n].unshift(t)
            },
            prefilter: function(e, t) {
                t ? bt.unshift(e) : bt.push(e)
            }
        }), re.speed = function(e, t, n) {
            var i = e && "object" == typeof e ? re.extend({}, e) : {
                complete: n || !n && t || re.isFunction(e) && e,
                duration: e,
                easing: n && t || t && !re.isFunction(t) && t
            };
            return i.duration = re.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in re.fx.speeds ? re.fx.speeds[i.duration] : re.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                re.isFunction(i.old) && i.old.call(this), i.queue && re.dequeue(this, i.queue)
            }, i
        }, re.fn.extend({
            fadeTo: function(e, t, n, i) {
                return this.filter(De).css("opacity", 0).show().end().animate({
                    opacity: t
                }, e, n, i)
            },
            animate: function(e, t, n, i) {
                var a = re.isEmptyObject(e),
                    r = re.speed(t, n, i),
                    o = function() {
                        var t = O(this, re.extend({}, e), r);
                        (a || re._data(this, "finish")) && t.stop(!0)
                    };
                return o.finish = o, a || r.queue === !1 ? this.each(o) : this.queue(r.queue, o)
            },
            stop: function(e, t, n) {
                var i = function(e) {
                    var t = e.stop;
                    delete e.stop, t(n)
                };
                return "string" != typeof e && (n = t, t = e, e = void 0), t && e !== !1 && this.queue(e || "fx", []), this.each(function() {
                    var t = !0,
                        a = null != e && e + "queueHooks",
                        r = re.timers,
                        o = re._data(this);
                    if (a) o[a] && o[a].stop && i(o[a]);
                    else
                        for (a in o) o[a] && o[a].stop && yt.test(a) && i(o[a]);
                    for (a = r.length; a--;) r[a].elem !== this || null != e && r[a].queue !== e || (r[a].anim.stop(n), t = !1, r.splice(a, 1));
                    (t || !n) && re.dequeue(this, e)
                })
            },
            finish: function(e) {
                return e !== !1 && (e = e || "fx"), this.each(function() {
                    var t, n = re._data(this),
                        i = n[e + "queue"],
                        a = n[e + "queueHooks"],
                        r = re.timers,
                        o = i ? i.length : 0;
                    for (n.finish = !0, re.queue(this, e, []), a && a.stop && a.stop.call(this, !0), t = r.length; t--;) r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), r.splice(t, 1));
                    for (t = 0; o > t; t++) i[t] && i[t].finish && i[t].finish.call(this);
                    delete n.finish
                })
            }
        }), re.each(["toggle", "show", "hide"], function(e, t) {
            var n = re.fn[t];
            re.fn[t] = function(e, i, a) {
                return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(_(t, !0), e, i, a)
            }
        }), re.each({
            slideDown: _("show"),
            slideUp: _("hide"),
            slideToggle: _("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(e, t) {
            re.fn[e] = function(e, n, i) {
                return this.animate(t, e, n, i)
            }
        }), re.timers = [], re.fx.tick = function() {
            var e, t = re.timers,
                n = 0;
            for (mt = re.now(); n < t.length; n++) e = t[n], e() || t[n] !== e || t.splice(n--, 1);
            t.length || re.fx.stop(), mt = void 0
        }, re.fx.timer = function(e) {
            re.timers.push(e), e() ? re.fx.start() : re.timers.pop()
        }, re.fx.interval = 13, re.fx.start = function() {
            ht || (ht = setInterval(re.fx.tick, re.fx.interval))
        }, re.fx.stop = function() {
            clearInterval(ht), ht = null
        }, re.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, re.fn.delay = function(e, t) {
            return e = re.fx ? re.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function(t, n) {
                var i = setTimeout(t, e);
                n.stop = function() {
                    clearTimeout(i)
                }
            })
        },
        function() {
            var e, t, n, i, a = he.createElement("div");
            a.setAttribute("className", "t"), a.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", e = a.getElementsByTagName("a")[0], n = he.createElement("select"), i = n.appendChild(he.createElement("option")), t = a.getElementsByTagName("input")[0], e.style.cssText = "top:1px", ie.getSetAttribute = "t" !== a.className, ie.style = /top/.test(e.getAttribute("style")), ie.hrefNormalized = "/a" === e.getAttribute("href"), ie.checkOn = !!t.value, ie.optSelected = i.selected, ie.enctype = !!he.createElement("form").enctype, n.disabled = !0, ie.optDisabled = !i.disabled, t = he.createElement("input"), t.setAttribute("value", ""), ie.input = "" === t.getAttribute("value"), t.value = "t", t.setAttribute("type", "radio"), ie.radioValue = "t" === t.value, e = t = n = i = a = null
        }();
    var wt = /\r/g;
    re.fn.extend({
        val: function(e) {
            var t, n, i, a = this[0]; {
                if (arguments.length) return i = re.isFunction(e), this.each(function(n) {
                    var a;
                    1 === this.nodeType && (a = i ? e.call(this, n, re(this).val()) : e, null == a ? a = "" : "number" == typeof a ? a += "" : re.isArray(a) && (a = re.map(a, function(e) {
                        return null == e ? "" : e + ""
                    })), t = re.valHooks[this.type] || re.valHooks[this.nodeName.toLowerCase()], t && "set" in t && void 0 !== t.set(this, a, "value") || (this.value = a))
                });
                if (a) return t = re.valHooks[a.type] || re.valHooks[a.nodeName.toLowerCase()], t && "get" in t && void 0 !== (n = t.get(a, "value")) ? n : (n = a.value, "string" == typeof n ? n.replace(wt, "") : null == n ? "" : n)
            }
        }
    }), re.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = re.find.attr(e, "value");
                    return null != t ? t : re.text(e)
                }
            },
            select: {
                get: function(e) {
                    for (var t, n, i = e.options, a = e.selectedIndex, r = "select-one" === e.type || 0 > a, o = r ? null : [], s = r ? a + 1 : i.length, l = 0 > a ? s : r ? a : 0; s > l; l++)
                        if (n = i[l], (n.selected || l === a) && (ie.optDisabled ? !n.disabled : null === n.getAttribute("disabled")) && (!n.parentNode.disabled || !re.nodeName(n.parentNode, "optgroup"))) {
                            if (t = re(n).val(), r) return t;
                            o.push(t)
                        }
                    return o
                },
                set: function(e, t) {
                    for (var n, i, a = e.options, r = re.makeArray(t), o = a.length; o--;)
                        if (i = a[o], re.inArray(re.valHooks.option.get(i), r) >= 0) try {
                            i.selected = n = !0
                        } catch (s) {
                            i.scrollHeight
                        } else i.selected = !1;
                    return n || (e.selectedIndex = -1), a
                }
            }
        }
    }), re.each(["radio", "checkbox"], function() {
        re.valHooks[this] = {
            set: function(e, t) {
                return re.isArray(t) ? e.checked = re.inArray(re(e).val(), t) >= 0 : void 0
            }
        }, ie.checkOn || (re.valHooks[this].get = function(e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    });
    var kt, Ct, jt = re.expr.attrHandle,
        Tt = /^(?:checked|selected)$/i,
        St = ie.getSetAttribute,
        Nt = ie.input;
    re.fn.extend({
        attr: function(e, t) {
            return Ae(this, re.attr, e, t, arguments.length > 1)
        },
        removeAttr: function(e) {
            return this.each(function() {
                re.removeAttr(this, e)
            })
        }
    }), re.extend({
        attr: function(e, t, n) {
            var i, a, r = e.nodeType;
            if (e && 3 !== r && 8 !== r && 2 !== r) return typeof e.getAttribute === je ? re.prop(e, t, n) : (1 === r && re.isXMLDoc(e) || (t = t.toLowerCase(), i = re.attrHooks[t] || (re.expr.match.bool.test(t) ? Ct : kt)), void 0 === n ? i && "get" in i && null !== (a = i.get(e, t)) ? a : (a = re.find.attr(e, t), null == a ? void 0 : a) : null !== n ? i && "set" in i && void 0 !== (a = i.set(e, n, t)) ? a : (e.setAttribute(t, n + ""), n) : void re.removeAttr(e, t))
        },
        removeAttr: function(e, t) {
            var n, i, a = 0,
                r = t && t.match(xe);
            if (r && 1 === e.nodeType)
                for (; n = r[a++];) i = re.propFix[n] || n, re.expr.match.bool.test(n) ? Nt && St || !Tt.test(n) ? e[i] = !1 : e[re.camelCase("default-" + n)] = e[i] = !1 : re.attr(e, n, ""), e.removeAttribute(St ? n : i)
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!ie.radioValue && "radio" === t && re.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        }
    }), Ct = {
        set: function(e, t, n) {
            return t === !1 ? re.removeAttr(e, n) : Nt && St || !Tt.test(n) ? e.setAttribute(!St && re.propFix[n] || n, n) : e[re.camelCase("default-" + n)] = e[n] = !0, n
        }
    }, re.each(re.expr.match.bool.source.match(/\w+/g), function(e, t) {
        var n = jt[t] || re.find.attr;
        jt[t] = Nt && St || !Tt.test(t) ? function(e, t, i) {
            var a, r;
            return i || (r = jt[t], jt[t] = a, a = null != n(e, t, i) ? t.toLowerCase() : null, jt[t] = r), a
        } : function(e, t, n) {
            return n ? void 0 : e[re.camelCase("default-" + t)] ? t.toLowerCase() : null
        }
    }), Nt && St || (re.attrHooks.value = {
        set: function(e, t, n) {
            return re.nodeName(e, "input") ? void(e.defaultValue = t) : kt && kt.set(e, t, n)
        }
    }), St || (kt = {
        set: function(e, t, n) {
            var i = e.getAttributeNode(n);
            return i || e.setAttributeNode(i = e.ownerDocument.createAttribute(n)), i.value = t += "", "value" === n || t === e.getAttribute(n) ? t : void 0
        }
    }, jt.id = jt.name = jt.coords = function(e, t, n) {
        var i;
        return n ? void 0 : (i = e.getAttributeNode(t)) && "" !== i.value ? i.value : null
    }, re.valHooks.button = {
        get: function(e, t) {
            var n = e.getAttributeNode(t);
            return n && n.specified ? n.value : void 0
        },
        set: kt.set
    }, re.attrHooks.contenteditable = {
        set: function(e, t, n) {
            kt.set(e, "" === t ? !1 : t, n)
        }
    }, re.each(["width", "height"], function(e, t) {
        re.attrHooks[t] = {
            set: function(e, n) {
                return "" === n ? (e.setAttribute(t, "auto"), n) : void 0
            }
        }
    })), ie.style || (re.attrHooks.style = {
        get: function(e) {
            return e.style.cssText || void 0
        },
        set: function(e, t) {
            return e.style.cssText = t + ""
        }
    });
    var Et = /^(?:input|select|textarea|button|object)$/i,
        Dt = /^(?:a|area)$/i;
    re.fn.extend({
        prop: function(e, t) {
            return Ae(this, re.prop, e, t, arguments.length > 1)
        },
        removeProp: function(e) {
            return e = re.propFix[e] || e, this.each(function() {
                try {
                    this[e] = void 0, delete this[e]
                } catch (t) {}
            })
        }
    }), re.extend({
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function(e, t, n) {
            var i, a, r, o = e.nodeType;
            if (e && 3 !== o && 8 !== o && 2 !== o) return r = 1 !== o || !re.isXMLDoc(e), r && (t = re.propFix[t] || t, a = re.propHooks[t]), void 0 !== n ? a && "set" in a && void 0 !== (i = a.set(e, n, t)) ? i : e[t] = n : a && "get" in a && null !== (i = a.get(e, t)) ? i : e[t]
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var t = re.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : Et.test(e.nodeName) || Dt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        }
    }), ie.hrefNormalized || re.each(["href", "src"], function(e, t) {
        re.propHooks[t] = {
            get: function(e) {
                return e.getAttribute(t, 4)
            }
        }
    }), ie.optSelected || (re.propHooks.selected = {
        get: function(e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
        }
    }), re.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        re.propFix[this.toLowerCase()] = this
    }), ie.enctype || (re.propFix.enctype = "encoding");
    var At = /[\t\r\n\f]/g;
    re.fn.extend({
        addClass: function(e) {
            var t, n, i, a, r, o, s = 0,
                l = this.length,
                c = "string" == typeof e && e;
            if (re.isFunction(e)) return this.each(function(t) {
                re(this).addClass(e.call(this, t, this.className))
            });
            if (c)
                for (t = (e || "").match(xe) || []; l > s; s++)
                    if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(At, " ") : " ")) {
                        for (r = 0; a = t[r++];) i.indexOf(" " + a + " ") < 0 && (i += a + " ");
                        o = re.trim(i), n.className !== o && (n.className = o)
                    }
            return this
        },
        removeClass: function(e) {
            var t, n, i, a, r, o, s = 0,
                l = this.length,
                c = 0 === arguments.length || "string" == typeof e && e;
            if (re.isFunction(e)) return this.each(function(t) {
                re(this).removeClass(e.call(this, t, this.className))
            });
            if (c)
                for (t = (e || "").match(xe) || []; l > s; s++)
                    if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(At, " ") : "")) {
                        for (r = 0; a = t[r++];)
                            for (; i.indexOf(" " + a + " ") >= 0;) i = i.replace(" " + a + " ", " ");
                        o = e ? re.trim(i) : "", n.className !== o && (n.className = o)
                    }
            return this
        },
        toggleClass: function(e, t) {
            var n = typeof e;
            return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : re.isFunction(e) ? this.each(function(n) {
                re(this).toggleClass(e.call(this, n, this.className, t), t)
            }) : this.each(function() {
                if ("string" === n)
                    for (var t, i = 0, a = re(this), r = e.match(xe) || []; t = r[i++];) a.hasClass(t) ? a.removeClass(t) : a.addClass(t);
                else(n === je || "boolean" === n) && (this.className && re._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : re._data(this, "__className__") || "")
            })
        },
        hasClass: function(e) {
            for (var t = " " + e + " ", n = 0, i = this.length; i > n; n++)
                if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(At, " ").indexOf(t) >= 0) return !0;
            return !1
        }
    }), re.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, t) {
        re.fn[t] = function(e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), re.fn.extend({
        hover: function(e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        },
        bind: function(e, t, n) {
            return this.on(e, null, t, n)
        },
        unbind: function(e, t) {
            return this.off(e, null, t)
        },
        delegate: function(e, t, n, i) {
            return this.on(t, e, n, i)
        },
        undelegate: function(e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    });
    var Lt = re.now(),
        $t = /\?/,
        qt = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    re.parseJSON = function(t) {
        if (e.JSON && e.JSON.parse) return e.JSON.parse(t + "");
        var n, i = null,
            a = re.trim(t + "");
        return a && !re.trim(a.replace(qt, function(e, t, a, r) {
            return n && t && (i = 0), 0 === i ? e : (n = a || t, i += !r - !a, "")
        })) ? Function("return " + a)() : re.error("Invalid JSON: " + t)
    }, re.parseXML = function(t) {
        var n, i;
        if (!t || "string" != typeof t) return null;
        try {
            e.DOMParser ? (i = new DOMParser, n = i.parseFromString(t, "text/xml")) : (n = new ActiveXObject("Microsoft.XMLDOM"), n.async = "false", n.loadXML(t))
        } catch (a) {
            n = void 0
        }
        return n && n.documentElement && !n.getElementsByTagName("parsererror").length || re.error("Invalid XML: " + t), n
    };
    var _t, Rt, Pt = /#.*$/,
        It = /([?&])_=[^&]*/,
        Ot = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Mt = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Ft = /^(?:GET|HEAD)$/,
        Ht = /^\/\//,
        Ut = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
        Bt = {},
        zt = {},
        Wt = "*/".concat("*");
    try {
        Rt = location.href
    } catch (Xt) {
        Rt = he.createElement("a"), Rt.href = "", Rt = Rt.href
    }
    _t = Ut.exec(Rt.toLowerCase()) || [], re.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Rt,
            type: "GET",
            isLocal: Mt.test(_t[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Wt,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": re.parseJSON,
                "text xml": re.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? H(H(e, re.ajaxSettings), t) : H(re.ajaxSettings, e)
        },
        ajaxPrefilter: M(Bt),
        ajaxTransport: M(zt),
        ajax: function(e, t) {
            function n(e, t, n, i) {
                var a, u, v, y, x, k = t;
                2 !== b && (b = 2, s && clearTimeout(s), c = void 0, o = i || "", w.readyState = e > 0 ? 4 : 0, a = e >= 200 && 300 > e || 304 === e, n && (y = U(d, w, n)), y = B(d, y, w, a), a ? (d.ifModified && (x = w.getResponseHeader("Last-Modified"), x && (re.lastModified[r] = x), x = w.getResponseHeader("etag"), x && (re.etag[r] = x)), 204 === e || "HEAD" === d.type ? k = "nocontent" : 304 === e ? k = "notmodified" : (k = y.state, u = y.data, v = y.error, a = !v)) : (v = k, (e || !k) && (k = "error", 0 > e && (e = 0))), w.status = e, w.statusText = (t || k) + "", a ? m.resolveWith(p, [u, k, w]) : m.rejectWith(p, [w, k, v]), w.statusCode(g), g = void 0, l && f.trigger(a ? "ajaxSuccess" : "ajaxError", [w, d, a ? u : v]), h.fireWith(p, [w, k]), l && (f.trigger("ajaxComplete", [w, d]), --re.active || re.event.trigger("ajaxStop")))
            }
            "object" == typeof e && (t = e, e = void 0), t = t || {};
            var i, a, r, o, s, l, c, u, d = re.ajaxSetup({}, t),
                p = d.context || d,
                f = d.context && (p.nodeType || p.jquery) ? re(p) : re.event,
                m = re.Deferred(),
                h = re.Callbacks("once memory"),
                g = d.statusCode || {},
                v = {},
                y = {},
                b = 0,
                x = "canceled",
                w = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (2 === b) {
                            if (!u)
                                for (u = {}; t = Ot.exec(o);) u[t[1].toLowerCase()] = t[2];
                            t = u[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function() {
                        return 2 === b ? o : null
                    },
                    setRequestHeader: function(e, t) {
                        var n = e.toLowerCase();
                        return b || (e = y[n] = y[n] || e, v[e] = t), this
                    },
                    overrideMimeType: function(e) {
                        return b || (d.mimeType = e), this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (2 > b)
                                for (t in e) g[t] = [g[t], e[t]];
                            else w.always(e[w.status]);
                        return this
                    },
                    abort: function(e) {
                        var t = e || x;
                        return c && c.abort(t), n(0, t), this
                    }
                };
            if (m.promise(w).complete = h.add, w.success = w.done, w.error = w.fail, d.url = ((e || d.url || Rt) + "").replace(Pt, "").replace(Ht, _t[1] + "//"), d.type = t.method || t.type || d.method || d.type, d.dataTypes = re.trim(d.dataType || "*").toLowerCase().match(xe) || [""], null == d.crossDomain && (i = Ut.exec(d.url.toLowerCase()), d.crossDomain = !(!i || i[1] === _t[1] && i[2] === _t[2] && (i[3] || ("http:" === i[1] ? "80" : "443")) === (_t[3] || ("http:" === _t[1] ? "80" : "443")))), d.data && d.processData && "string" != typeof d.data && (d.data = re.param(d.data, d.traditional)), F(Bt, d, t, w), 2 === b) return w;
            l = d.global, l && 0 === re.active++ && re.event.trigger("ajaxStart"), d.type = d.type.toUpperCase(), d.hasContent = !Ft.test(d.type), r = d.url, d.hasContent || (d.data && (r = d.url += ($t.test(r) ? "&" : "?") + d.data, delete d.data), d.cache === !1 && (d.url = It.test(r) ? r.replace(It, "$1_=" + Lt++) : r + ($t.test(r) ? "&" : "?") + "_=" + Lt++)), d.ifModified && (re.lastModified[r] && w.setRequestHeader("If-Modified-Since", re.lastModified[r]), re.etag[r] && w.setRequestHeader("If-None-Match", re.etag[r])), (d.data && d.hasContent && d.contentType !== !1 || t.contentType) && w.setRequestHeader("Content-Type", d.contentType), w.setRequestHeader("Accept", d.dataTypes[0] && d.accepts[d.dataTypes[0]] ? d.accepts[d.dataTypes[0]] + ("*" !== d.dataTypes[0] ? ", " + Wt + "; q=0.01" : "") : d.accepts["*"]);
            for (a in d.headers) w.setRequestHeader(a, d.headers[a]);
            if (d.beforeSend && (d.beforeSend.call(p, w, d) === !1 || 2 === b)) return w.abort();
            x = "abort";
            for (a in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) w[a](d[a]);
            if (c = F(zt, d, t, w)) {
                w.readyState = 1, l && f.trigger("ajaxSend", [w, d]), d.async && d.timeout > 0 && (s = setTimeout(function() {
                    w.abort("timeout")
                }, d.timeout));
                try {
                    b = 1, c.send(v, n)
                } catch (k) {
                    if (!(2 > b)) throw k;
                    n(-1, k)
                }
            } else n(-1, "No Transport");
            return w
        },
        getJSON: function(e, t, n) {
            return re.get(e, t, n, "json")
        },
        getScript: function(e, t) {
            return re.get(e, void 0, t, "script")
        }
    }), re.each(["get", "post"], function(e, t) {
        re[t] = function(e, n, i, a) {
            return re.isFunction(n) && (a = a || i, i = n, n = void 0), re.ajax({
                url: e,
                type: t,
                dataType: a,
                data: n,
                success: i
            })
        }
    }), re.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
        re.fn[t] = function(e) {
            return this.on(t, e)
        }
    }), re._evalUrl = function(e) {
        return re.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
        })
    }, re.fn.extend({
        wrapAll: function(e) {
            if (re.isFunction(e)) return this.each(function(t) {
                re(this).wrapAll(e.call(this, t))
            });
            if (this[0]) {
                var t = re(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                    for (var e = this; e.firstChild && 1 === e.firstChild.nodeType;) e = e.firstChild;
                    return e
                }).append(this)
            }
            return this
        },
        wrapInner: function(e) {
            return re.isFunction(e) ? this.each(function(t) {
                re(this).wrapInner(e.call(this, t))
            }) : this.each(function() {
                var t = re(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        },
        wrap: function(e) {
            var t = re.isFunction(e);
            return this.each(function(n) {
                re(this).wrapAll(t ? e.call(this, n) : e)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                re.nodeName(this, "body") || re(this).replaceWith(this.childNodes)
            }).end()
        }
    }), re.expr.filters.hidden = function(e) {
        return e.offsetWidth <= 0 && e.offsetHeight <= 0 || !ie.reliableHiddenOffsets() && "none" === (e.style && e.style.display || re.css(e, "display"))
    }, re.expr.filters.visible = function(e) {
        return !re.expr.filters.hidden(e)
    };
    var Yt = /%20/g,
        Vt = /\[\]$/,
        Jt = /\r?\n/g,
        Kt = /^(?:submit|button|image|reset|file)$/i,
        Gt = /^(?:input|select|textarea|keygen)/i;
    re.param = function(e, t) {
        var n, i = [],
            a = function(e, t) {
                t = re.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
            };
        if (void 0 === t && (t = re.ajaxSettings && re.ajaxSettings.traditional), re.isArray(e) || e.jquery && !re.isPlainObject(e)) re.each(e, function() {
            a(this.name, this.value)
        });
        else
            for (n in e) z(n, e[n], t, a);
        return i.join("&").replace(Yt, "+")
    }, re.fn.extend({
        serialize: function() {
            return re.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var e = re.prop(this, "elements");
                return e ? re.makeArray(e) : this
            }).filter(function() {
                var e = this.type;
                return this.name && !re(this).is(":disabled") && Gt.test(this.nodeName) && !Kt.test(e) && (this.checked || !Le.test(e))
            }).map(function(e, t) {
                var n = re(this).val();
                return null == n ? null : re.isArray(n) ? re.map(n, function(e) {
                    return {
                        name: t.name,
                        value: e.replace(Jt, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(Jt, "\r\n")
                }
            }).get()
        }
    }), re.ajaxSettings.xhr = void 0 !== e.ActiveXObject ? function() {
        return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && W() || X()
    } : W;
    var Qt = 0,
        Zt = {},
        en = re.ajaxSettings.xhr();
    e.ActiveXObject && re(e).on("unload", function() {
        for (var e in Zt) Zt[e](void 0, !0)
    }), ie.cors = !!en && "withCredentials" in en, en = ie.ajax = !!en, en && re.ajaxTransport(function(e) {
        if (!e.crossDomain || ie.cors) {
            var t;
            return {
                send: function(n, i) {
                    var a, r = e.xhr(),
                        o = ++Qt;
                    if (r.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)
                        for (a in e.xhrFields) r[a] = e.xhrFields[a];
                    e.mimeType && r.overrideMimeType && r.overrideMimeType(e.mimeType), e.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
                    for (a in n) void 0 !== n[a] && r.setRequestHeader(a, n[a] + "");
                    r.send(e.hasContent && e.data || null), t = function(n, a) {
                        var s, l, c;
                        if (t && (a || 4 === r.readyState))
                            if (delete Zt[o], t = void 0, r.onreadystatechange = re.noop, a) 4 !== r.readyState && r.abort();
                            else {
                                c = {}, s = r.status, "string" == typeof r.responseText && (c.text = r.responseText);
                                try {
                                    l = r.statusText
                                } catch (u) {
                                    l = ""
                                }
                                s || !e.isLocal || e.crossDomain ? 1223 === s && (s = 204) : s = c.text ? 200 : 404
                            }
                        c && i(s, l, c, r.getAllResponseHeaders())
                    }, e.async ? 4 === r.readyState ? setTimeout(t) : r.onreadystatechange = Zt[o] = t : t()
                },
                abort: function() {
                    t && t(void 0, !0)
                }
            }
        }
    }), re.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(e) {
                return re.globalEval(e), e
            }
        }
    }), re.ajaxPrefilter("script", function(e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
    }), re.ajaxTransport("script", function(e) {
        if (e.crossDomain) {
            var t, n = he.head || re("head")[0] || he.documentElement;
            return {
                send: function(i, a) {
                    t = he.createElement("script"), t.async = !0, e.scriptCharset && (t.charset = e.scriptCharset), t.src = e.url, t.onload = t.onreadystatechange = function(e, n) {
                        (n || !t.readyState || /loaded|complete/.test(t.readyState)) && (t.onload = t.onreadystatechange = null, t.parentNode && t.parentNode.removeChild(t), t = null, n || a(200, "success"))
                    }, n.insertBefore(t, n.firstChild)
                },
                abort: function() {
                    t && t.onload(void 0, !0)
                }
            }
        }
    });
    var tn = [],
        nn = /(=)\?(?=&|$)|\?\?/;
    re.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = tn.pop() || re.expando + "_" + Lt++;
            return this[e] = !0, e
        }
    }), re.ajaxPrefilter("json jsonp", function(t, n, i) {
        var a, r, o, s = t.jsonp !== !1 && (nn.test(t.url) ? "url" : "string" == typeof t.data && !(t.contentType || "").indexOf("application/x-www-form-urlencoded") && nn.test(t.data) && "data");
        return s || "jsonp" === t.dataTypes[0] ? (a = t.jsonpCallback = re.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(nn, "$1" + a) : t.jsonp !== !1 && (t.url += ($t.test(t.url) ? "&" : "?") + t.jsonp + "=" + a), t.converters["script json"] = function() {
            return o || re.error(a + " was not called"), o[0]
        }, t.dataTypes[0] = "json", r = e[a], e[a] = function() {
            o = arguments
        }, i.always(function() {
            e[a] = r, t[a] && (t.jsonpCallback = n.jsonpCallback, tn.push(a)), o && re.isFunction(r) && r(o[0]), o = r = void 0
        }), "script") : void 0
    }), re.parseHTML = function(e, t, n) {
        if (!e || "string" != typeof e) return null;
        "boolean" == typeof t && (n = t, t = !1), t = t || he;
        var i = pe.exec(e),
            a = !n && [];
        return i ? [t.createElement(i[1])] : (i = re.buildFragment([e], t, a), a && a.length && re(a).remove(), re.merge([], i.childNodes))
    };
    var an = re.fn.load;
    re.fn.load = function(e, t, n) {
        if ("string" != typeof e && an) return an.apply(this, arguments);
        var i, a, r, o = this,
            s = e.indexOf(" ");
        return s >= 0 && (i = e.slice(s, e.length), e = e.slice(0, s)), re.isFunction(t) ? (n = t, t = void 0) : t && "object" == typeof t && (r = "POST"), o.length > 0 && re.ajax({
            url: e,
            type: r,
            dataType: "html",
            data: t
        }).done(function(e) {
            a = arguments, o.html(i ? re("<div>").append(re.parseHTML(e)).find(i) : e)
        }).complete(n && function(e, t) {
            o.each(n, a || [e.responseText, t, e])
        }), this
    }, re.expr.filters.animated = function(e) {
        return re.grep(re.timers, function(t) {
            return e === t.elem
        }).length
    };
    var rn = e.document.documentElement;
    re.offset = {
        setOffset: function(e, t, n) {
            var i, a, r, o, s, l, c, u = re.css(e, "position"),
                d = re(e),
                p = {};
            "static" === u && (e.style.position = "relative"), s = d.offset(), r = re.css(e, "top"), l = re.css(e, "left"), c = ("absolute" === u || "fixed" === u) && re.inArray("auto", [r, l]) > -1, c ? (i = d.position(), o = i.top, a = i.left) : (o = parseFloat(r) || 0, a = parseFloat(l) || 0), re.isFunction(t) && (t = t.call(e, n, s)), null != t.top && (p.top = t.top - s.top + o), null != t.left && (p.left = t.left - s.left + a), "using" in t ? t.using.call(e, p) : d.css(p)
        }
    }, re.fn.extend({
        offset: function(e) {
            if (arguments.length) return void 0 === e ? this : this.each(function(t) {
                re.offset.setOffset(this, e, t)
            });
            var t, n, i = {
                    top: 0,
                    left: 0
                },
                a = this[0],
                r = a && a.ownerDocument;
            if (r) return t = r.documentElement, re.contains(t, a) ? (typeof a.getBoundingClientRect !== je && (i = a.getBoundingClientRect()), n = Y(r), {
                top: i.top + (n.pageYOffset || t.scrollTop) - (t.clientTop || 0),
                left: i.left + (n.pageXOffset || t.scrollLeft) - (t.clientLeft || 0)
            }) : i
        },
        position: function() {
            if (this[0]) {
                var e, t, n = {
                        top: 0,
                        left: 0
                    },
                    i = this[0];
                return "fixed" === re.css(i, "position") ? t = i.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), re.nodeName(e[0], "html") || (n = e.offset()), n.top += re.css(e[0], "borderTopWidth", !0), n.left += re.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - n.top - re.css(i, "marginTop", !0),
                    left: t.left - n.left - re.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent || rn; e && !re.nodeName(e, "html") && "static" === re.css(e, "position");) e = e.offsetParent;
                return e || rn
            })
        }
    }), re.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(e, t) {
        var n = /Y/.test(t);
        re.fn[e] = function(i) {
            return Ae(this, function(e, i, a) {
                var r = Y(e);
                return void 0 === a ? r ? t in r ? r[t] : r.document.documentElement[i] : e[i] : void(r ? r.scrollTo(n ? re(r).scrollLeft() : a, n ? a : re(r).scrollTop()) : e[i] = a);
            }, e, i, arguments.length, null)
        }
    }), re.each(["top", "left"], function(e, t) {
        re.cssHooks[t] = S(ie.pixelPosition, function(e, n) {
            return n ? (n = nt(e, t), at.test(n) ? re(e).position()[t] + "px" : n) : void 0
        })
    }), re.each({
        Height: "height",
        Width: "width"
    }, function(e, t) {
        re.each({
            padding: "inner" + e,
            content: t,
            "": "outer" + e
        }, function(n, i) {
            re.fn[i] = function(i, a) {
                var r = arguments.length && (n || "boolean" != typeof i),
                    o = n || (i === !0 || a === !0 ? "margin" : "border");
                return Ae(this, function(t, n, i) {
                    var a;
                    return re.isWindow(t) ? t.document.documentElement["client" + e] : 9 === t.nodeType ? (a = t.documentElement, Math.max(t.body["scroll" + e], a["scroll" + e], t.body["offset" + e], a["offset" + e], a["client" + e])) : void 0 === i ? re.css(t, n, o) : re.style(t, n, i, o)
                }, t, r ? i : void 0, r, null)
            }
        })
    }), re.fn.size = function() {
        return this.length
    }, re.fn.andSelf = re.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return re
    });
    var on = e.jQuery,
        sn = e.$;
    return re.noConflict = function(t) {
        return e.$ === re && (e.$ = sn), t && e.jQuery === re && (e.jQuery = on), re
    }, typeof t === je && (e.jQuery = e.$ = re), re
}),
function(e) {
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
            a = e.map(n, function(e) {
                return i[e]
            });
        return e.inArray(t, a) > -1
    }, e.Ninja = function(t, n) {
        e.isPlainObject(t) ? (this.$element = e("<span>"), this.options = t) : (this.$element = e(t), this.options = n || {})
    }, e.Ninja.prototype.deselect = function() {
        this.$element.hasClass("nui-slc") && !this.$element.hasClass("nui-dsb") && this.$element.trigger("deselect.ninja")
    }, e.Ninja.prototype.disable = function() {
        this.$element.addClass("nui-dsb").trigger("disable.ninja")
    }, e.Ninja.prototype.enable = function() {
        this.$element.removeClass("nui-dsb").trigger("enable.ninja")
    }, e.Ninja.prototype.select = function() {
        this.$element.hasClass("nui-dsb") || this.$element.trigger("select.ninja")
    }, e.ninja = new t, e.fn.ninja = function(t, n) {
        return this.each(function() {
            e.data(this, "ninja." + t) || (e.data(this, "ninja." + t), e.ninja[t](this, n))
        })
    }
}(jQuery),
function(e) {
    "use strict";
    e.Ninja.Autocomplete = function(t, n) {
        var i = this;
        t ? (i.$element = e(t), i.$element.is("input") || e.ninja.error("Autocomplete may only be called with an <input> element.")) : e.ninja.error("Autocomplete must include an <input> element."), i.$wrapper = i.$element.wrap('<span class="ninja-autocomplete">').parent(), i.$list = e("<div>", {
            "class": "ninja-list",
            css: {
                top: this.$wrapper.outerHeight()
            }
        }), n ? ("list" in n ? i.list = n.list : i.list = [], "get" in n && (i.get = n.get), "select" in n && e.isFunction(n.select) && (i.select = n.select)) : e.ninja.error("Autocomplete called without options."), i.index = -1, i.matchlist = [], i.$element.attr({
            autocomplete: "off"
        }).data("ninja", {
            autocomplete: n
        }).on("blur.ninja", function() {
            i.$list.remove()
        }).on("focus.ninja, keyup.ninja", function(t) {
            if (i.$element.data("ninja-completed")) i.$element.removeData("ninja-completed");
            else {
                var n = t.which;
                i.$element.val() ? e.ninja.key(n, ["arrowDown", "arrowUp", "escape", "tab"]) || (e.isFunction(i.get) ? i.get(i.$element.val(), function(e) {
                    i.list = e, i.suggest(e)
                }) : i.suggest(i.list)) : i.$list.remove()
            }
        }).on("keydown.ninja", function(t) {
            var n = t.which;
            e.ninja.key(n, ["escape", "tab"]) ? i.$list.remove() : n === e.ninja.keys.enter && i.index > -1 ? i.$element.trigger("select.ninja") : e.ninja.key(n, ["arrowDown", "arrowUp"]) && (i.index > -1 && i.$list.find("div:eq(" + i.index + ")").removeClass("ninja-hover"), n === e.ninja.keys.arrowDown ? i.index === i.last() ? i.index = 0 : i.index += 1 : i.index <= 0 ? i.index = i.last() : i.index -= 1, i.$list.find("div:eq(" + i.index + ")").addClass("ninja-hover"))
        }).on("select.ninja", function(e) {
            i.matchlist[i.index] && (i.$element.data("ninja-completed", !0), i.$element.val(i.matchlist[i.index]), i.$list.remove(), "select" in i && i.select())
        })
    }, e.Ninja.Autocomplete.prototype.last = function() {
        return this.matchlist.length - 1
    }, e.Ninja.Autocomplete.prototype.suggest = function(t) {
        var n = this;
        e.isFunction(n.get) ? n.matchlist = t : n.matchlist = e.map(t, function(e) {
            var t = n.$element.val();
            return t !== e && new RegExp("^" + t, "i").test(e) ? e : null
        }), n.$list.empty(), n.matchlist.length > 0 && (e.each(n.matchlist, function(t, i) {
            e("<div>", {
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
    }, e.ninja.autocomplete = function(t, n) {
        var i = e(t);
        i.data("ninja") && "autocomplete" in i.data("ninja") ? e.ninja.warn("Autocomplete called on the same element multiple times.") : e.extend(new e.Ninja(t, n), new e.Ninja.Autocomplete(t, n))
    }
}(jQuery),
function(e) {
    "use strict";
    e.Ninja.Dialog = function(t) {
        var n = this;
        t && "html" in t ? n.$html = e("<span>", {
            html: t.html
        }) : e.ninja.error("JavaScript option html required."), n.$dialog = e('<span class="ninja-dialog">').append(n.$html), n.$screen = e('<div class="ninja-screen">').on("click.ninja", function(e) {
            t.clickscreen && t.clickscreen(), e.stopImmediatePropagation(), n.close()
        })
    }, e.Ninja.Dialog.prototype.open = function() {
        var t = this;
        t.$window = e(window), t.windowHeight = t.$window.height(), t.windowWidth = t.$window.width(), t.viewport = {
            left: t.$window.scrollLeft(),
            top: t.$window.scrollTop()
        }, e(document.body).append(t.$screen, t.$dialog), t.height = t.$dialog.outerHeight(), t.width = t.$dialog.outerWidth(), t.height > t.windowHeight ? t.$dialog.css({
            top: t.viewport.top
        }) : t.$dialog.css({
            top: Math.round(t.viewport.top + (t.windowHeight / 2 - t.height / 2))
        }), t.width > t.windowWidth ? t.$dialog.css({
            left: t.viewport.left
        }) : t.$dialog.css({
            left: Math.round(t.viewport.left + (t.windowWidth / 2 - t.width / 2))
        })
    }, e.Ninja.Dialog.prototype.close = function() {
        this.$dialog.detach(), this.$screen.detach()
    }, e.ninja.dialog = function(t) {
        return new e.Ninja.Dialog(t)
    }
}(jQuery),
function(e) {
    "use strict";
    e.Ninja.Menu = function(t, n) {
        var i = this;
        t ? i.$element = e(t) : e.ninja.error("Menu must include an element."), n && "list" in n ? i.list = n.list : e.ninja.error("Menu must include a list."), i.$element.addClass("ninja-menu").append('<div class="ninja-arrow-down">'), i.$list = e('<div class="ninja-list">'), i.$point = e('<div class="ninja-point-up">').appendTo(i.$list), e.each(i.list, function(t, n) {
            var a = e(n).addClass("ninja-item");
            0 === t && a.addClass("ninja-first"), i.$list.append(a)
        }), e(document).on("click.ninja", function() {
            i.$list.detach(), i.$element.removeClass("ninja-select")
        }), i.$element.on("click.ninja", function(t) {
            t.stopPropagation();
            var n, a, r;
            i.$list.is(":visible") ? (i.$list.detach(), i.$element.removeClass("ninja-select")) : (e(".ninja-menu").removeClass("ninja-select"), e(".ninja-list").detach(), i.$element.append(i.$list), i.$element.addClass("ninja-select"), n = i.$element.outerWidth() / 2 - 4, a = i.$element.outerHeight() + 6, r = i.$list.offset(), r.top + i.$list.outerHeight() > e(window).scrollTop() + e(window).height() ? i.$list.css("bottom", a) : i.$list.css("top", a), r.left + i.$list.outerWidth() > e(window).scrollLeft() + e(window).width() ? (i.$list.css({
                left: "auto",
                right: 0
            }), i.$point.css("right", n)) : "auto" === i.$point.css("right") && i.$point.css("left", n))
        })
    }, e.ninja.menu = function(t, n) {
        e.extend(new e.Ninja(t, n), new e.Ninja.Menu(t, n))
    }
}(jQuery),
function(e) {
    "use strict";
    e.Ninja.Popup = function(t, n) {
        var i = this;
        t ? i.$element = e(t) : e.ninja.error("Popup must include an element."), n && "html" in n ? i.$html = e("<span>", {
            html: n.html
        }) : i.$element.data("popup") ? i.$html = e("<span>", {
            html: i.$element.data("popup")
        }) : e.ninja.error("Popup must include JavaScipt html option or HTML data-popup attribute."), n && "hover" in n && n.hover === !0 ? i.trigger = "hover.ninja" : i.trigger = "click.ninja", i.$point = e("<span>"), i.$popup = e('<span class="ninja-popup">').append(i.$point, i.$html), i.$element.on(i.trigger, function(t) {
            t.stopImmediatePropagation(), "active" === i.$element.data("ninja-popup") ? (i.$element.data("ninja-popup", "inactive"), i.$popup.detach()) : (i.$element.data("ninja-popup", "active"), i.$window = e(window), i.viewport = {
                left: i.$window.scrollLeft(),
                top: i.$window.scrollTop()
            }, i.viewport.bottom = i.viewport.top + i.$window.height(), i.viewport.right = i.viewport.left + i.$window.width(), e(document.body).append(i.$popup), "click.ninja" === i.trigger && e(document).on("click.ninja-popup", function() {
                i.$element.data("ninja-popup", "inactive"), i.$popup.detach(), e(document).off("click.ninja-popup")
            }), "inline" === i.$element.css("display") ? (i.elementHeight = i.$element.height(), i.elementWidth = i.$element.width()) : (i.elementHeight = i.$element.outerHeight(), i.elementWidth = i.$element.outerWidth()), i.elementHalfHeight = i.elementHeight / 2, i.elementHalfWidth = i.elementWidth / 2, i.offset = i.$element.offset(), i.offset.center = i.offset.left + i.elementHalfWidth, i.offset.middle = i.offset.top + i.elementHalfHeight, i.height = i.$popup.outerHeight(), i.width = i.$popup.outerWidth(), i.halfHeight = i.height / 2, i.halfWidth = i.width / 2, i.offset.top - i.height < i.viewport.top ? (i.$point.attr("class", "ninja-point-up"), i.$popup.css("top", Math.round(i.offset.top + i.elementHeight + 6))) : (i.$point.attr("class", "ninja-point-down"), i.$popup.css("top", Math.round(i.offset.top - i.height - 6))), i.$point.css("left", Math.round(i.halfWidth - 5)), i.offset.left + i.elementHalfWidth + i.halfWidth > i.viewport.right ? (i.$popup.css({
                right: 0
            }), i.$point.css("right", Math.round(i.offset.center))) : i.offset.left + i.elementHalfWidth - i.halfWidth < i.viewport.left ? i.$popup.css({
                left: 0
            }) : i.$popup.css({
                left: Math.round(i.offset.left + i.elementHalfWidth - i.halfWidth)
            }))
        })
    }, e.ninja.popup = function(t, n) {
        e.extend(new e.Ninja(t, n), new e.Ninja.Popup(t, n))
    }
}(jQuery),
function(e) {
    "use strict";
    e.Ninja.Slider = function(t, n) {
        var i = this;
        t ? (i.$input = e(t), i.$input.is("input") && "hidden" === i.$input.attr("type") || e.ninja.error("Slider may only be called with a hidden <input> input.")) : e.ninja.error("Slider must include a hidden <input> input."), n ? ("list" in n ? (i.list = n.list, i.slots = i.list.length - 1, 0 === i.slots && e.ninja.error("Slider list must include at least two elements.")) : e.ninja.error("Slider must include a list option."), "select" in n && e.isFunction(n.select) && (i.select = n.select), i.$input.attr("value") ? i.index = e.inArray(i.$input.val(), i.list) : (i.$input.val(i.list[0]), i.index = 0)) : e.ninja.error("Slider called without options."), i.$input.parent().is("label") ? i.$wrapper = i.$input.parent().addClass("ninja-slider") : i.$wrapper = i.$input.wrap('<label class="ninja-slider">').parent(), i.width = i.$wrapper.outerWidth(), i.increment = i.width / i.slots, i.$level = e("<div>", {
            "class": "ninja-level",
            css: {
                width: i.left()
            }
        }), i.$groove = e('<div class="ninja-groove">').on("click.ninja", function(e) {
            i.move(Math.round((e.pageX - i.$track.offset().left) / i.increment)), i.change()
        }).append(i.$level), i.$value = e("<span>", {
            "class": "ninja-value",
            html: i.list[i.index]
        }), i.$button = e("<button>", {
            type: "button",
            css: {
                left: i.left()
            }
        }).on({
            "keyup.ninja": function(t) {
                var n = t.which;
                e.ninja.key(n, ["arrowLeft", "arrowRight"]) && (n === e.ninja.keys.arrowLeft ? i.move(i.index - 1) : n === e.ninja.keys.arrowRight && i.move(i.index + 1), i.change())
            },
            "mousedown.ninja": function(t) {
                i.$wrapper.addClass("ninja-active"), i.offsetX = t.pageX - Math.round(i.$button.position().left), e(document).on({
                    "mousemove.ninja": function(e) {
                        i.move(Math.round((e.pageX - i.offsetX) / i.increment))
                    },
                    "mouseup.ninja": function() {
                        i.change(), i.$wrapper.removeClass("ninja-active"), e(document).off("mousemove.ninja mouseup.ninja")
                    }
                })
            },
            "touchstart.ninja": function(e) {
                i.$wrapper.addClass("ninja-active"), i.touch = e.originalEvent.targetTouches[0] || e.originalEvent.changedTouches[0], i.offsetX = i.touch.pageX - Math.round(i.$button.position().left)
            },
            "touchmove.ninja": function(e) {
                e.preventDefault(), i.touch = e.originalEvent.targetTouches[0] || e.originalEvent.changedTouches[0], i.move(Math.round((i.touch.pageX - i.offsetX) / i.increment))
            },
            "touchend.ninja": function(e) {
                e.preventDefault(), i.$wrapper.removeClass("ninja-active"), i.change()
            }
        }), i.$track = e("<div>", {
            "class": "ninja-track",
            css: {
                width: i.width + 16
            }
        }).append(i.$groove, i.$button), i.$wrapper.append(i.$value, i.$track), i.drag = !1, i.offsetX = 0, i.$input.data("ninja", {
            slider: n
        })
    }, e.Ninja.Slider.prototype.change = function() {
        var e = this.list[this.index];
        this.$input.val() !== e && (this.$input.val(e).change(), "select" in this && this.select())
    }, e.Ninja.Slider.prototype.left = function() {
        return Math.round(this.index * this.increment)
    }, e.Ninja.Slider.prototype.move = function(e) {
        e !== this.index && (0 > e ? this.index = 0 : e > this.slots ? this.index = this.slots : this.index = e, this.$button.css("left", this.left()), this.$level.css("width", this.left()), this.$value.text(this.list[this.index]))
    }, e.ninja.slider = function(t, n) {
        var i = e(t);
        i.data("ninja") && "slider" in i.data("ninja") ? e.ninja.warn("Slider called on the same input multiple times.") : e.extend(new e.Ninja(t, n), new e.Ninja.Slider(t, n))
    }
}(jQuery),
function(e, t, n) {
    function i(e) {
        return e
    }

    function a(e) {
        return r(decodeURIComponent(e.replace(s, " ")))
    }

    function r(e) {
        return 0 === e.indexOf('"') && (e = e.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\")), e
    }

    function o(e) {
        return l.json ? JSON.parse(e) : e
    }
    var s = /\+/g,
        l = e.cookie = function(r, s, c) {
            if (s !== n) {
                if (c = e.extend({}, l.defaults, c), null === s && (c.expires = -1), "number" == typeof c.expires) {
                    var u = c.expires,
                        d = c.expires = new Date;
                    d.setDate(d.getDate() + u)
                }
                return s = l.json ? JSON.stringify(s) : String(s), t.cookie = [encodeURIComponent(r), "=", l.raw ? s : encodeURIComponent(s), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")
            }
            for (var p = l.raw ? i : a, f = t.cookie.split("; "), m = r ? null : {}, h = 0, g = f.length; g > h; h++) {
                var v = f[h].split("="),
                    y = p(v.shift()),
                    b = p(v.join("="));
                if (r && r === y) {
                    m = o(b);
                    break
                }
                r || (m[y] = o(b))
            }
            return m
        };
    l.defaults = {}, e.removeCookie = function(t, n) {
        return null !== e.cookie(t) ? (e.cookie(t, null, n), !0) : !1
    }
}(jQuery, document),
function(e) {
    "use strict";

    function t(t) {
        var n = t.data;
        t.isDefaultPrevented() || (t.preventDefault(), e(this).ajaxSubmit(n))
    }

    function n(t) {
        var n = t.target,
            i = e(n);
        if (!i.is("[type=submit],[type=image]")) {
            var a = i.closest("[type=submit]");
            if (0 === a.length) return;
            n = a[0]
        }
        var r = this;
        if (r.clk = n, "image" == n.type)
            if (void 0 !== t.offsetX) r.clk_x = t.offsetX, r.clk_y = t.offsetY;
            else if ("function" == typeof e.fn.offset) {
            var o = i.offset();
            r.clk_x = t.pageX - o.left, r.clk_y = t.pageY - o.top
        } else r.clk_x = t.pageX - n.offsetLeft, r.clk_y = t.pageY - n.offsetTop;
        setTimeout(function() {
            r.clk = r.clk_x = r.clk_y = null
        }, 100)
    }

    function i() {
        if (e.fn.ajaxSubmit.debug) {
            var t = "[jquery.form] " + Array.prototype.join.call(arguments, "");
            window.console && window.console.log ? window.console.log(t) : window.opera && window.opera.postError && window.opera.postError(t)
        }
    }
    var a = {};
    a.fileapi = void 0 !== e("<input type='file'/>").get(0).files, a.formdata = void 0 !== window.FormData;
    var r = !!e.fn.prop;
    e.fn.attr2 = function(e, t) {
        if (!r) return this.attr.apply(this, arguments);
        var n = this.prop.apply(this, arguments);
        return n && n.jquery || "string" == typeof n ? n : this.attr.apply(this, arguments)
    }, e.fn.ajaxSubmit = function(t) {
        function n(t) {
            var n, i, a = e.param(t).split("&"),
                r = a.length,
                o = [];
            for (n = 0; r > n; n++) a[n] = a[n].replace(/\+/g, " "), i = a[n].split("="), o.push([decodeURIComponent(i[0]), decodeURIComponent(i[1])]);
            return o
        }

        function o(i) {
            for (var a = new FormData, r = 0; r < i.length; r++) a.append(i[r].name, i[r].value);
            if (t.extraData) {
                var o = n(t.extraData);
                for (r = 0; r < o.length; r++) o[r] && a.append(o[r][0], o[r][1])
            }
            t.data = null;
            var s = e.extend(!0, {}, e.ajaxSettings, t, {
                contentType: !1,
                processData: !1,
                cache: !1,
                type: l || "POST"
            });
            t.uploadProgress && (s.xhr = function() {
                var e = jQuery.ajaxSettings.xhr();
                return e.upload && e.upload.addEventListener("progress", function(e) {
                    var n = 0,
                        i = e.loaded || e.position,
                        a = e.total;
                    e.lengthComputable && (n = Math.ceil(i / a * 100)), t.uploadProgress(e, i, a, n)
                }, !1), e
            }), s.data = null;
            var c = s.beforeSend;
            return s.beforeSend = function(e, t) {
                t.data = a, c && c.call(this, e, t)
            }, e.ajax(s)
        }

        function s(n) {
            function a(e) {
                var t = e.contentWindow ? e.contentWindow.document : e.contentDocument ? e.contentDocument : e.document;
                return t
            }

            function o() {
                function t() {
                    try {
                        var e = a(v).readyState;
                        i("state = " + e), e && "uninitialized" == e.toLowerCase() && setTimeout(t, 50)
                    } catch (n) {
                        i("Server abort: ", n, " (", n.name, ")"), s(S), k && clearTimeout(k), k = void 0
                    }
                }
                var n = d.attr2("target"),
                    r = d.attr2("action");
                C.setAttribute("target", m), l || C.setAttribute("method", "POST"), r != p.url && C.setAttribute("action", p.url), p.skipEncodingOverride || l && !/post/i.test(l) || d.attr({
                    encoding: "multipart/form-data",
                    enctype: "multipart/form-data"
                }), p.timeout && (k = setTimeout(function() {
                    w = !0, s(T)
                }, p.timeout));
                var o = [];
                try {
                    if (p.extraData)
                        for (var c in p.extraData) p.extraData.hasOwnProperty(c) && (e.isPlainObject(p.extraData[c]) && p.extraData[c].hasOwnProperty("name") && p.extraData[c].hasOwnProperty("value") ? o.push(e('<input type="hidden" name="' + p.extraData[c].name + '">').val(p.extraData[c].value).appendTo(C)[0]) : o.push(e('<input type="hidden" name="' + c + '">').val(p.extraData[c]).appendTo(C)[0]));
                    p.iframeTarget || (g.appendTo("body"), v.attachEvent ? v.attachEvent("onload", s) : v.addEventListener("load", s, !1)), setTimeout(t, 15);
                    try {
                        C.submit()
                    } catch (u) {
                        var f = document.createElement("form").submit;
                        f.apply(C)
                    }
                } finally {
                    C.setAttribute("action", r), n ? C.setAttribute("target", n) : d.removeAttr("target"), e(o).remove()
                }
            }

            function s(t) {
                if (!y.aborted && !L) {
                    try {
                        A = a(v)
                    } catch (n) {
                        i("cannot access response document: ", n), t = S
                    }
                    if (t === T && y) return y.abort("timeout"), void j.reject(y, "timeout");
                    if (t == S && y) return y.abort("server abort"), void j.reject(y, "error", "server abort");
                    if (A && A.location.href != p.iframeSrc || w) {
                        v.detachEvent ? v.detachEvent("onload", s) : v.removeEventListener("load", s, !1);
                        var r, o = "success";
                        try {
                            if (w) throw "timeout";
                            var l = "xml" == p.dataType || A.XMLDocument || e.isXMLDoc(A);
                            if (i("isXml=" + l), !l && window.opera && (null === A.body || !A.body.innerHTML) && --$) return i("requeing onLoad callback, DOM not available"), void setTimeout(s, 250);
                            var c = A.body ? A.body : A.documentElement;
                            y.responseText = c ? c.innerHTML : null, y.responseXML = A.XMLDocument ? A.XMLDocument : A, l && (p.dataType = "xml"), y.getResponseHeader = function(e) {
                                var t = {
                                    "content-type": p.dataType
                                };
                                return t[e]
                            }, c && (y.status = Number(c.getAttribute("status")) || y.status, y.statusText = c.getAttribute("statusText") || y.statusText);
                            var u = (p.dataType || "").toLowerCase(),
                                d = /(json|script|text)/.test(u);
                            if (d || p.textarea) {
                                var m = A.getElementsByTagName("textarea")[0];
                                if (m) y.responseText = m.value, y.status = Number(m.getAttribute("status")) || y.status, y.statusText = m.getAttribute("statusText") || y.statusText;
                                else if (d) {
                                    var h = A.getElementsByTagName("pre")[0],
                                        b = A.getElementsByTagName("body")[0];
                                    h ? y.responseText = h.textContent ? h.textContent : h.innerText : b && (y.responseText = b.textContent ? b.textContent : b.innerText)
                                }
                            } else "xml" == u && !y.responseXML && y.responseText && (y.responseXML = q(y.responseText));
                            try {
                                D = R(y, u, p)
                            } catch (x) {
                                o = "parsererror", y.error = r = x || o
                            }
                        } catch (x) {
                            i("error caught: ", x), o = "error", y.error = r = x || o
                        }
                        y.aborted && (i("upload aborted"), o = null), y.status && (o = y.status >= 200 && y.status < 300 || 304 === y.status ? "success" : "error"), "success" === o ? (p.success && p.success.call(p.context, D, "success", y), j.resolve(y.responseText, "success", y), f && e.event.trigger("ajaxSuccess", [y, p])) : o && (void 0 === r && (r = y.statusText), p.error && p.error.call(p.context, y, o, r), j.reject(y, "error", r), f && e.event.trigger("ajaxError", [y, p, r])), f && e.event.trigger("ajaxComplete", [y, p]), f && !--e.active && e.event.trigger("ajaxStop"), p.complete && p.complete.call(p.context, y, o), L = !0, p.timeout && clearTimeout(k), setTimeout(function() {
                            p.iframeTarget || g.remove(), y.responseXML = null
                        }, 100)
                    }
                }
            }
            var c, u, p, f, m, g, v, y, b, x, w, k, C = d[0],
                j = e.Deferred();
            if (n)
                for (u = 0; u < h.length; u++) c = e(h[u]), r ? c.prop("disabled", !1) : c.removeAttr("disabled");
            if (p = e.extend(!0, {}, e.ajaxSettings, t), p.context = p.context || p, m = "jqFormIO" + (new Date).getTime(), p.iframeTarget ? (g = e(p.iframeTarget), x = g.attr2("name"), x ? m = x : g.attr2("name", m)) : (g = e('<iframe name="' + m + '" src="' + p.iframeSrc + '" />'), g.css({
                    position: "absolute",
                    top: "-1000px",
                    left: "-1000px"
                })), v = g[0], y = {
                    aborted: 0,
                    responseText: null,
                    responseXML: null,
                    status: 0,
                    statusText: "n/a",
                    getAllResponseHeaders: function() {},
                    getResponseHeader: function() {},
                    setRequestHeader: function() {},
                    abort: function(t) {
                        var n = "timeout" === t ? "timeout" : "aborted";
                        i("aborting upload... " + n), this.aborted = 1;
                        try {
                            v.contentWindow.document.execCommand && v.contentWindow.document.execCommand("Stop")
                        } catch (a) {}
                        g.attr("src", p.iframeSrc), y.error = n, p.error && p.error.call(p.context, y, n, t), f && e.event.trigger("ajaxError", [y, p, n]), p.complete && p.complete.call(p.context, y, n)
                    }
                }, f = p.global, f && 0 === e.active++ && e.event.trigger("ajaxStart"), f && e.event.trigger("ajaxSend", [y, p]), p.beforeSend && p.beforeSend.call(p.context, y, p) === !1) return p.global && e.active--, j.reject(), j;
            if (y.aborted) return j.reject(), j;
            b = C.clk, b && (x = b.name, x && !b.disabled && (p.extraData = p.extraData || {}, p.extraData[x] = b.value, "image" == b.type && (p.extraData[x + ".x"] = C.clk_x, p.extraData[x + ".y"] = C.clk_y)));
            var T = 1,
                S = 2,
                N = e("meta[name=csrf-token]").attr("content"),
                E = e("meta[name=csrf-param]").attr("content");
            E && N && (p.extraData = p.extraData || {}, p.extraData[E] = N), p.forceSync ? o() : setTimeout(o, 10);
            var D, A, L, $ = 50,
                q = e.parseXML || function(e, t) {
                    return window.ActiveXObject ? (t = new ActiveXObject("Microsoft.XMLDOM"), t.async = "false", t.loadXML(e)) : t = (new DOMParser).parseFromString(e, "text/xml"), t && t.documentElement && "parsererror" != t.documentElement.nodeName ? t : null
                },
                _ = e.parseJSON || function(e) {
                    return window.eval("(" + e + ")")
                },
                R = function(t, n, i) {
                    var a = t.getResponseHeader("content-type") || "",
                        r = "xml" === n || !n && a.indexOf("xml") >= 0,
                        o = r ? t.responseXML : t.responseText;
                    return r && "parsererror" === o.documentElement.nodeName && e.error && e.error("parsererror"), i && i.dataFilter && (o = i.dataFilter(o, n)), "string" == typeof o && ("json" === n || !n && a.indexOf("json") >= 0 ? o = _(o) : ("script" === n || !n && a.indexOf("javascript") >= 0) && e.globalEval(o)), o
                };
            return j
        }
        if (!this.length) return i("ajaxSubmit: skipping submit process - no element selected"), this;
        var l, c, u, d = this;
        "function" == typeof t && (t = {
            success: t
        }), l = this.attr2("method"), c = this.attr2("action"), u = "string" == typeof c ? e.trim(c) : "", u = u || window.location.href || "", u && (u = (u.match(/^([^#]+)/) || [])[1]), t = e.extend(!0, {
            url: u,
            success: e.ajaxSettings.success,
            type: l || "GET",
            iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
        }, t);
        var p = {};
        if (this.trigger("form-pre-serialize", [this, t, p]), p.veto) return i("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
        if (t.beforeSerialize && t.beforeSerialize(this, t) === !1) return i("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
        var f = t.traditional;
        void 0 === f && (f = e.ajaxSettings.traditional);
        var m, h = [],
            g = this.formToArray(t.semantic, h);
        if (t.data && (t.extraData = t.data, m = e.param(t.data, f)), t.beforeSubmit && t.beforeSubmit(g, this, t) === !1) return i("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
        if (this.trigger("form-submit-validate", [g, this, t, p]), p.veto) return i("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
        var v = e.param(g, f);
        m && (v = v ? v + "&" + m : m), "GET" == t.type.toUpperCase() ? (t.url += (t.url.indexOf("?") >= 0 ? "&" : "?") + v, t.data = null) : t.data = v;
        var y = [];
        if (t.resetForm && y.push(function() {
                d.resetForm()
            }), t.clearForm && y.push(function() {
                d.clearForm(t.includeHidden)
            }), !t.dataType && t.target) {
            var b = t.success || function() {};
            y.push(function(n) {
                var i = t.replaceTarget ? "replaceWith" : "html";
                e(t.target)[i](n).each(b, arguments)
            })
        } else t.success && y.push(t.success);
        t.success = function(e, n, i) {
            for (var a = t.context || this, r = 0, o = y.length; o > r; r++) y[r].apply(a, [e, n, i || d, d])
        };
        var x = e('input[type=file]:enabled[value!=""]', this),
            w = x.length > 0,
            k = "multipart/form-data",
            C = d.attr("enctype") == k || d.attr("encoding") == k,
            j = a.fileapi && a.formdata;
        i("fileAPI :" + j);
        var T, S = (w || C) && !j;
        t.iframe !== !1 && (t.iframe || S) ? t.closeKeepAlive ? e.get(t.closeKeepAlive, function() {
            T = s(g)
        }) : T = s(g) : T = (w || C) && j ? o(g) : e.ajax(t), d.removeData("jqxhr").data("jqxhr", T);
        for (var N = 0; N < h.length; N++) h[N] = null;
        return this.trigger("form-submit-notify", [this, t]), this
    }, e.fn.ajaxForm = function(a) {
        if (a = a || {}, a.delegation = a.delegation && e.isFunction(e.fn.on), !a.delegation && 0 === this.length) {
            var r = {
                s: this.selector,
                c: this.context
            };
            return !e.isReady && r.s ? (i("DOM not ready, queuing ajaxForm"), e(function() {
                e(r.s, r.c).ajaxForm(a)
            }), this) : (i("terminating; zero elements found by selector" + (e.isReady ? "" : " (DOM not ready)")), this)
        }
        return a.delegation ? (e(document).off("submit.form-plugin", this.selector, t).off("click.form-plugin", this.selector, n).on("submit.form-plugin", this.selector, a, t).on("click.form-plugin", this.selector, a, n), this) : this.ajaxFormUnbind().bind("submit.form-plugin", a, t).bind("click.form-plugin", a, n)
    }, e.fn.ajaxFormUnbind = function() {
        return this.unbind("submit.form-plugin click.form-plugin")
    }, e.fn.formToArray = function(t, n) {
        var i = [];
        if (0 === this.length) return i;
        var r = this[0],
            o = t ? r.getElementsByTagName("*") : r.elements;
        if (!o) return i;
        var s, l, c, u, d, p, f;
        for (s = 0, p = o.length; p > s; s++)
            if (d = o[s], c = d.name, c && !d.disabled)
                if (t && r.clk && "image" == d.type) r.clk == d && (i.push({
                    name: c,
                    value: e(d).val(),
                    type: d.type
                }), i.push({
                    name: c + ".x",
                    value: r.clk_x
                }, {
                    name: c + ".y",
                    value: r.clk_y
                }));
                else if (u = e.fieldValue(d, !0), u && u.constructor == Array)
            for (n && n.push(d), l = 0, f = u.length; f > l; l++) i.push({
                name: c,
                value: u[l]
            });
        else if (a.fileapi && "file" == d.type) {
            n && n.push(d);
            var m = d.files;
            if (m.length)
                for (l = 0; l < m.length; l++) i.push({
                    name: c,
                    value: m[l],
                    type: d.type
                });
            else i.push({
                name: c,
                value: "",
                type: d.type
            })
        } else null !== u && "undefined" != typeof u && (n && n.push(d), i.push({
            name: c,
            value: u,
            type: d.type,
            required: d.required
        }));
        if (!t && r.clk) {
            var h = e(r.clk),
                g = h[0];
            c = g.name, c && !g.disabled && "image" == g.type && (i.push({
                name: c,
                value: h.val()
            }), i.push({
                name: c + ".x",
                value: r.clk_x
            }, {
                name: c + ".y",
                value: r.clk_y
            }))
        }
        return i
    }, e.fn.formSerialize = function(t) {
        return e.param(this.formToArray(t))
    }, e.fn.fieldSerialize = function(t) {
        var n = [];
        return this.each(function() {
            var i = this.name;
            if (i) {
                var a = e.fieldValue(this, t);
                if (a && a.constructor == Array)
                    for (var r = 0, o = a.length; o > r; r++) n.push({
                        name: i,
                        value: a[r]
                    });
                else null !== a && "undefined" != typeof a && n.push({
                    name: this.name,
                    value: a
                })
            }
        }), e.param(n)
    }, e.fn.fieldValue = function(t) {
        for (var n = [], i = 0, a = this.length; a > i; i++) {
            var r = this[i],
                o = e.fieldValue(r, t);
            null === o || "undefined" == typeof o || o.constructor == Array && !o.length || (o.constructor == Array ? e.merge(n, o) : n.push(o))
        }
        return n
    }, e.fieldValue = function(t, n) {
        var i = t.name,
            a = t.type,
            r = t.tagName.toLowerCase();
        if (void 0 === n && (n = !0), n && (!i || t.disabled || "reset" == a || "button" == a || ("checkbox" == a || "radio" == a) && !t.checked || ("submit" == a || "image" == a) && t.form && t.form.clk != t || "select" == r && -1 == t.selectedIndex)) return null;
        if ("select" == r) {
            var o = t.selectedIndex;
            if (0 > o) return null;
            for (var s = [], l = t.options, c = "select-one" == a, u = c ? o + 1 : l.length, d = c ? o : 0; u > d; d++) {
                var p = l[d];
                if (p.selected) {
                    var f = p.value;
                    if (f || (f = p.attributes && p.attributes.value && !p.attributes.value.specified ? p.text : p.value), c) return f;
                    s.push(f)
                }
            }
            return s
        }
        return e(t).val()
    }, e.fn.clearForm = function(t) {
        return this.each(function() {
            e("input,select,textarea", this).clearFields(t)
        })
    }, e.fn.clearFields = e.fn.clearInputs = function(t) {
        var n = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
        return this.each(function() {
            var i = this.type,
                a = this.tagName.toLowerCase();
            n.test(i) || "textarea" == a ? this.value = "" : "checkbox" == i || "radio" == i ? this.checked = !1 : "select" == a ? this.selectedIndex = -1 : "file" == i ? /MSIE/.test(navigator.userAgent) ? e(this).replaceWith(e(this).clone(!0)) : e(this).val("") : t && (t === !0 && /hidden/.test(i) || "string" == typeof t && e(this).is(t)) && (this.value = "")
        })
    }, e.fn.resetForm = function() {
        return this.each(function() {
            ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
        })
    }, e.fn.enable = function(e) {
        return void 0 === e && (e = !0), this.each(function() {
            this.disabled = !e
        })
    }, e.fn.selected = function(t) {
        return void 0 === t && (t = !0), this.each(function() {
            var n = this.type;
            if ("checkbox" == n || "radio" == n) this.checked = t;
            else if ("option" == this.tagName.toLowerCase()) {
                var i = e(this).parent("select");
                t && i[0] && "select-one" == i[0].type && i.find("option").selected(!1), this.selected = t
            }
        })
    }, e.fn.ajaxSubmit.debug = !1
}(jQuery),
function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
}(function(e) {
    function t() {
        if (!e.contains(document.documentElement, this)) return e(this).timeago("dispose"), this;
        var t = n(this),
            o = r.settings;
        return isNaN(t.datetime) || (0 == o.cutoff || Math.abs(a(t.datetime)) < o.cutoff) && e(this).text(i(t.datetime)), this
    }

    function n(t) {
        if (t = e(t), !t.data("timeago")) {
            t.data("timeago", {
                datetime: r.datetime(t)
            });
            var n = e.trim(t.text());
            r.settings.localeTitle ? t.attr("title", t.data("timeago").datetime.toLocaleString()) : !(n.length > 0) || r.isTime(t) && t.attr("title") || t.attr("title", n)
        }
        return t.data("timeago")
    }

    function i(e) {
        return r.inWords(a(e))
    }

    function a(e) {
        return (new Date).getTime() - e.getTime()
    }
    e.timeago = function(t) {
        return i(t instanceof Date ? t : "string" == typeof t ? e.timeago.parse(t) : "number" == typeof t ? new Date(t) : e.timeago.datetime(t))
    };
    var r = e.timeago;
    e.extend(e.timeago, {
        settings: {
            refreshMillis: 6e4,
            allowPast: !0,
            allowFuture: !1,
            localeTitle: !1,
            cutoff: 0,
            strings: {
                prefixAgo: null,
                prefixFromNow: null,
                suffixAgo: "ago",
                suffixFromNow: "from now",
                inPast: "any moment now",
                seconds: "less than a minute",
                minute: "about a minute",
                minutes: "%d minutes",
                hour: "about an hour",
                hours: "about %d hours",
                day: "a day",
                days: "%d days",
                month: "about a month",
                months: "%d months",
                year: "about a year",
                years: "%d years",
                wordSeparator: " ",
                numbers: []
            }
        },
        inWords: function(t) {
            function n(n, a) {
                var r = e.isFunction(n) ? n(a, t) : n,
                    o = i.numbers && i.numbers[a] || a;
                return r.replace(/%d/i, o)
            }
            if (!this.settings.allowPast && !this.settings.allowFuture) throw "timeago allowPast and allowFuture settings can not both be set to false.";
            var i = this.settings.strings,
                a = i.prefixAgo,
                r = i.suffixAgo;
            if (this.settings.allowFuture && 0 > t && (a = i.prefixFromNow, r = i.suffixFromNow), !this.settings.allowPast && t >= 0) return this.settings.strings.inPast;
            var o = Math.abs(t) / 1e3,
                s = o / 60,
                l = s / 60,
                c = l / 24,
                u = c / 365,
                d = 45 > o && n(i.seconds, Math.round(o)) || 90 > o && n(i.minute, 1) || 45 > s && n(i.minutes, Math.round(s)) || 90 > s && n(i.hour, 1) || 24 > l && n(i.hours, Math.round(l)) || 42 > l && n(i.day, 1) || 30 > c && n(i.days, Math.round(c)) || 45 > c && n(i.month, 1) || 365 > c && n(i.months, Math.round(c / 30)) || 1.5 > u && n(i.year, 1) || n(i.years, Math.round(u)),
                p = i.wordSeparator || "";
            return void 0 === i.wordSeparator && (p = " "), e.trim([a, d, r].join(p))
        },
        parse: function(t) {
            var n = e.trim(t);
            return n = n.replace(/\.\d+/, ""), n = n.replace(/-/, "/").replace(/-/, "/"), n = n.replace(/T/, " ").replace(/Z/, " UTC"), n = n.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2"), n = n.replace(/([\+\-]\d\d)$/, " $100"), new Date(n)
        },
        datetime: function(t) {
            var n = r.isTime(t) ? e(t).attr("datetime") : e(t).attr("title");
            return r.parse(n)
        },
        isTime: function(t) {
            return "time" === e(t).get(0).tagName.toLowerCase()
        }
    });
    var o = {
        init: function() {
            var n = e.proxy(t, this);
            n();
            var i = r.settings;
            i.refreshMillis > 0 && (this._timeagoInterval = setInterval(n, i.refreshMillis))
        },
        update: function(n) {
            var i = r.parse(n);
            e(this).data("timeago", {
                datetime: i
            }), r.settings.localeTitle && e(this).attr("title", i.toLocaleString()), t.apply(this)
        },
        updateFromDOM: function() {
            e(this).data("timeago", {
                datetime: r.parse(r.isTime(this) ? e(this).attr("datetime") : e(this).attr("title"))
            }), t.apply(this)
        },
        dispose: function() {
            this._timeagoInterval && (window.clearInterval(this._timeagoInterval), this._timeagoInterval = null)
        }
    };
    e.fn.timeago = function(e, t) {
        var n = e ? o[e] : o.init;
        if (!n) throw new Error("Unknown function name '" + e + "' for timeago");
        return this.each(function() {
            n.call(this, t)
        }), this
    }, document.createElement("abbr"), document.createElement("time")
}),
function(e, t, n) {
    var i = {
            messages: {
                required: "The %s field is required.",
                matches: "The %s field does not match the %s field.",
                "default": "The %s field is still set to default, please change.",
                valid_email: "The %s field must contain a valid email address.",
                valid_emails: "The %s field must contain all valid email addresses.",
                min_length: "The %s field must be at least %s characters in length.",
                max_length: "The %s field must not exceed %s characters in length.",
                exact_length: "The %s field must be exactly %s characters in length.",
                greater_than: "The %s field must contain a number greater than %s.",
                less_than: "The %s field must contain a number less than %s.",
                alpha: "The %s field must only contain alphabetical characters.",
                alpha_numeric: "The %s field must only contain alpha-numeric characters.",
                alpha_dash: "The %s field allows only alpha-numeric characters, underscores, and dashes.",
                alpha_name: "The %s field allows only alphabetical characters, apostrophes, and hyphens.",
                numeric: "The %s field must contain only numbers.",
                integer: "The %s field must contain an integer.",
                decimal: "The %s field must contain a decimal number.",
                is_natural: "The %s field must contain only positive numbers.",
                is_natural_no_zero: "The %s field must contain a number greater than zero.",
                valid_ip: "The %s field must contain a valid IP.",
                valid_base64: "The %s field must contain a base64 string.",
                valid_credit_card: "The %s field must contain a valid credit card number.",
                is_file_type: "The %s field must contain only %s files.",
                valid_url: "The %s field must contain a valid URL."
            },
            callback: function(e) {}
        },
        a = /^(.+?)\[(.+)\]$/,
        r = /^[0-9]+$/,
        o = /^\-?[0-9]+$/,
        s = /^\-?[0-9]*\.?[0-9]+$/,
        l = /^.+@.+\..+$/,
        c = /^[a-z]+$/i,
        u = /^[a-z0-9]+$/i,
        d = /^[a-z0-9_\-]+$/i,
        p = /^[a-z-']+$/i,
        f = /^[0-9]+$/i,
        m = /^[1-9][0-9]*$/i,
        h = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,
        g = /[^a-zA-Z0-9\/\+=]/i,
        v = /^[\d\-\s]+$/,
        y = /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,
        b = function(e, t, a) {
            this.callback = a || i.callback, this.errors = [], this.fields = {}, this.form = this._formByNameOrNode(e) || {}, this.messages = {}, this.handlers = {};
            for (var r = 0, o = t.length; o > r; r++) {
                var s = t[r];
                if ((s.name || s.names) && s.rules)
                    if (s.names)
                        for (var l = 0; l < s.names.length; l++) this._addField(s, s.names[l]);
                    else this._addField(s, s.name)
            }
            var c = this.form.onsubmit;
            this.form.onsubmit = function(e) {
                return function(t) {
                    try {
                        return e._validateForm(t) && (c === n || c())
                    } catch (i) {}
                }
            }(this)
        },
        x = function(e, t) {
            var n; {
                if (!(e.length > 0) || "radio" !== e[0].type && "checkbox" !== e[0].type) return e[t];
                for (n = 0; n < e.length; n++)
                    if (e[n].checked) return e[n][t]
            }
        };
    b.prototype.setMessage = function(e, t) {
        return this.messages[e] = t, this
    }, b.prototype.registerCallback = function(e, t) {
        return e && "string" == typeof e && t && "function" == typeof t && (this.handlers[e] = t), this
    }, b.prototype._formByNameOrNode = function(e) {
        return "object" == typeof e ? e : t.forms[e]
    }, b.prototype._addField = function(e, t) {
        this.fields[t] = {
            name: t,
            display: e.display || t,
            rules: e.rules,
            id: null,
            type: null,
            value: null,
            checked: null
        }
    }, b.prototype._validateForm = function(e) {
        this.errors = [];
        for (var t in this.fields)
            if (this.fields.hasOwnProperty(t)) {
                var i = this.fields[t] || {},
                    a = this.form[i.name];
                a && a !== n && (i.id = x(a, "id"), i.type = a.length > 0 ? a[0].type : a.type, i.value = x(a, "value"), i.checked = x(a, "checked"), this._validateField(i))
            }
        return "function" == typeof this.callback && this.callback(this.errors, e), this.errors.length > 0 && (e && e.preventDefault ? e.preventDefault() : event && (event.returnValue = !1)), !0
    }, b.prototype._validateField = function(e) {
        for (var t = e.rules.split("|"), r = e.rules.indexOf("required"), o = !e.value || "" === e.value || e.value === n, s = 0, l = t.length; l > s; s++) {
            var c = t[s],
                u = null,
                d = !1,
                p = a.exec(c);
            if ((-1 !== r || -1 !== c.indexOf("!callback_") || !o) && (p && (c = p[1], u = p[2]), "!" === c.charAt(0) && (c = c.substring(1, c.length)), "function" == typeof this._hooks[c] ? this._hooks[c].apply(this, [e, u]) || (d = !0) : "callback_" === c.substring(0, 9) && (c = c.substring(9, c.length), "function" == typeof this.handlers[c] && this.handlers[c].apply(this, [e.value, u]) === !1 && (d = !0)), d)) {
                var f = this.messages[c] || i.messages[c],
                    m = "An error has occurred with the " + e.display + " field.";
                f && (m = f.replace("%s", e.display), u && (m = m.replace("%s", this.fields[u] ? this.fields[u].display : u))), this.errors.push({
                    id: e.id,
                    name: e.name,
                    message: m,
                    rule: c
                });
                break
            }
        }
    }, b.prototype._hooks = {
        required: function(e) {
            var t = e.value;
            return "checkbox" === e.type || "radio" === e.type ? e.checked === !0 : null !== t && "" !== t
        },
        "default": function(e, t) {
            return e.value !== t
        },
        matches: function(e, t) {
            var n = this.form[t];
            return n ? e.value === n.value : !1
        },
        valid_email: function(e) {
            return l.test(e.value)
        },
        valid_emails: function(e) {
            for (var t = e.value.split(","), n = 0; n < t.length; n++)
                if (!l.test(t[n])) return !1;
            return !0
        },
        min_length: function(e, t) {
            return r.test(t) ? e.value.length >= parseInt(t, 10) : !1
        },
        max_length: function(e, t) {
            return r.test(t) ? e.value.length <= parseInt(t, 10) : !1
        },
        exact_length: function(e, t) {
            return r.test(t) ? e.value.length === parseInt(t, 10) : !1
        },
        greater_than: function(e, t) {
            return s.test(e.value) ? parseFloat(e.value) > parseFloat(t) : !1
        },
        less_than: function(e, t) {
            return s.test(e.value) ? parseFloat(e.value) < parseFloat(t) : !1
        },
        alpha: function(e) {
            return c.test(e.value)
        },
        alpha_numeric: function(e) {
            return u.test(e.value)
        },
        alpha_dash: function(e) {
            return d.test(e.value)
        },
        alpha_name: function(e) {
            return p.test(e.value)
        },
        numeric: function(e) {
            return r.test(e.value)
        },
        integer: function(e) {
            return o.test(e.value)
        },
        decimal: function(e) {
            return s.test(e.value)
        },
        is_natural: function(e) {
            return f.test(e.value)
        },
        is_natural_no_zero: function(e) {
            return m.test(e.value)
        },
        valid_ip: function(e) {
            return h.test(e.value)
        },
        valid_base64: function(e) {
            return g.test(e.value)
        },
        valid_url: function(e) {
            return y.test(e.value)
        },
        valid_credit_card: function(e) {
            if (!v.test(e.value)) return !1;
            for (var t = 0, n = 0, i = !1, a = e.value.replace(/\D/g, ""), r = a.length - 1; r >= 0; r--) {
                var o = a.charAt(r);
                n = parseInt(o, 10), i && (n *= 2) > 9 && (n -= 9), t += n, i = !i
            }
            return t % 10 === 0
        },
        is_file_type: function(e, t) {
            if ("file" !== e.type) return !0;
            var n = e.value.substr(e.value.lastIndexOf(".") + 1),
                i = t.split(","),
                a = !1,
                r = 0,
                o = i.length;
            for (r; o > r; r++) n == i[r] && (a = !0);
            return a
        }
    }, e.FormValidator = b
}(window, document),
function() {
    var e = function() {
        var e = "function" == typeof require && require,
            t = function(n, i, a) {
                i || (i = 0);
                var r = t.resolve(n, i),
                    o = t.m[i][r];
                if (!o && e) {
                    if (o = e(r)) return o
                } else if (o && o.c && (i = o.c, r = o.m, o = t.m[i][o.m], !o)) throw new Error('failed to require "' + r + '" from ' + i);
                if (!o) throw new Error('failed to require "' + n + '" from ' + a);
                return o.exports || (o.exports = {}, o.call(o.exports, o, o.exports, t.relative(r, i))), o.exports
            };
        return t.resolve = function(e, n) {
            var i = e,
                a = e + ".js",
                r = e + "/index.js";
            return t.m[n][a] && a ? a : t.m[n][r] && r ? r : i
        }, t.relative = function(e, n) {
            return function(i) {
                if ("." != i.charAt(0)) return t(i, n, e);
                var a = e.split("/"),
                    r = i.split("/");
                a.pop();
                for (var o = 0; o < r.length; o++) {
                    var s = r[o];
                    ".." == s ? a.pop() : "." != s && a.push(s)
                }
                return t(a.join("/"), n, e)
            }
        }, t
    }();
    e.m = [], e.m[0] = {
        window: {
            exports: window
        },
        jquery: {
            exports: window.jQuery
        },
        validate: {
            exports: window.FormValidator
        },
        yummly: {
            exports: window.Yummly
        },
        "ads.js": function(e, t, n) {
            function i(e, t, n) {
                var i = n ? "insertAfter" : "insertBefore";
                e.length && t.length && (e.closest(".wsz, wsp").length ? e.closest(".wsz, .wsp")[i](t) : e[i](t))
            }

            function a(e) {
                l.ajax({
                    url: e,
                    cache: !1
                })
            }

            function r(e, t, n, i, a) {
                l.ajax({
                    url: a ? "/click" : "/imp_client",
                    cache: !1,
                    data: {
                        adId: e,
                        impId: t,
                        z: n,
                        i: i
                    },
                    headers: s.locale.headers
                })
            }
            var o = n("window"),
                s = n("yummly"),
                l = n("jquery"),
                c = s.view.replace(/.+\/([^\/]+)$/, "$1"),
                u = n("./utilities/debug"),
                d = n("./utilities/width"),
                p = d.small(),
                f = "div-gpt-ad-",
                m = {},
                h = function(e) {
                    o.optimizely ? o.optimizely.push(["trackEvent", e]) : setTimeout(function() {
                        h(e)
                    }, 200)
                },
                g = "outsearch" === c,
                v = l("html").hasClass("list-view");
            g && (c = "search"), e.exports.refreshAds = function() {
                o.googletag && !o.document.hidden && o.googletag.pubads().refresh(s.ads.refresh)
            }, e.exports.trackNativeAdImpressions = function(e) {
                var t, n = s.ads,
                    i = l(".ad-recipe"),
                    o = i,
                    c = l(".ad .suggestion, .products .suggestion"),
                    u = c,
                    d = l(".ingredient-line-handle");
                n && (e && (t = l(".y-card, .y-grid-card").slice(e), o = t.nextAll(".ad-recipe"), u = t.nextAll(".ad, .products").find(".suggestion")), o.each(function(e, t) {
                    var i = l(t),
                        s = i.find("[name=ws_unit]"),
                        c = i.data("imp");
                    c ? a(c) : n.adRequestRecipe && r(i.data("ad"), n.impressionRecipe, n.adRequestRecipe.z, n.adRequestRecipe.i + "/" + o.index(t)), s.length && s.replaceWith(l('<script>window.ws_unit={id:"' + s.val() + '"};</script><script src="//wfpscripts.webspectator.com/ws-ad.js"></script>'))
                }), u.each(function(e, t) {
                    r(l(t).data("ad"), n.impressionProduct, n.adRequestProduct.z, n.adRequestProduct.i + "/" + u.index(t))
                }), d.length && h("IngLineExists"), d.each(function(e, t) {
                    t = l(t), t.click(function() {
                        setTimeout(function() {
                            "block" === t.find(".ingredient-line-modifier").css("display") && (h("IngLineClientImpression"), r(t.data("ad"), t.data("impression"), t.data("zone"), "0/1/0"), t.find(".ingredient-line-tracker").length && l.ajax({
                                url: t.find(".ingredient-line-tracker").data("src")
                            }))
                        })
                    }).find(".ingredient-line-modifier").click(function() {
                        var e = l(this).parents(".ingredient-line-handle");
                        h("IngLineClick"), r(e.data("ad"), e.data("impression"), e.data("zone"), "0/1/0", !0)
                    }).find("a").click(function() {
                        var e = l(this).parents(".ingredient-line-handle");
                        h("IngLineClick"), r(e.data("ad"), e.data("impression"), e.data("zone"), "0/1/0", !0)
                    })
                }))
            }, e.exports.initIabAds = function() {
                function e(e, t) {
                    this.array = [e, t], this.string = e + "x" + t
                }

                function t(e, t, n) {
                    e && e.name && e.id && j(function() {
                        var i = e.name + "_" + r.string;
                        y.defineSlot(i), k.push({
                            name: i,
                            id: f + e.id,
                            refresh: t,
                            size: r.array,
                            onload: n
                        })
                    })
                }

                function n(e, t) {
                    return t ? e.wrap('<div class="wsz" data-pid="' + t + '"></div>').parent() : e
                }

                function a(e, t, i, a) {
                    var r = x.eq(t),
                        o = m[c] && m[c][e];
                    a || (a = i ? "ad-iab-banner" : "ad-iab-card"), r && o && o.id && (r.before(n(l('<div id="' + f + o.id + '" class="' + a + '"></div>'), o.pid)), j(function() {
                        h.display(f + o.id)
                    }))
                }
                var r, d = s.vendors.dfp[s.locale.domain.top],
                    h = o.googletag,
                    y = o.yieldbot,
                    b = o.ybotq,
                    x = l(".y-card, .y-grid-card"),
                    w = "/5742684/",
                    k = [],
                    C = {},
                    j = function(e) {
                        b.push(function() {
                            h.cmd.push(e)
                        })
                    };
                if (y && b && h && h.cmd && !l("html").hasClass("layout-prep-steps") && !l("html").hasClass("hide-sidebar")) {
                    switch (s.ads || (s.ads = {}), s.ads.refresh = [], s.ads.onload = [], c) {
                        case "home":
                            m[c] = [d.hero].concat(d[s.tab] || []);
                            break;
                        case "recipe":
                            m[c] = p ? [{}, d.recipe[3], d.recipe[4], d.recipe[9], {}, {}, d.recipe[11], d.recipe[5], {}, d.recipe[12]] : [d.recipe[0], {}, d.recipe[2], {}, d.recipe[7], d.recipe[8], d.recipe[6], {}, d.recipe[10]], l("#sidebar").prepend(l("#google-ads-3").clone().toggleClass("ad-banner-bottom ad-banner-sidebar").attr("id", "google-ads-4")).append(l("#google-ads-4").clone().attr("id", "google-ads-5")).append(l("#google-ads-4").clone().attr("id", "google-ads-8"));
                            break;
                        case "search":
                            v && (d.search[5] = null, d.search[9] = null, d.search[11] = null, d.search[12] = null), m[c] = p ? [d.search[2], d.search[3], d.search[4], d.search[5], d.search[8]] : [d.search[0], d.search[1], {}, d.search[5], {}], g && (m[c][3] = d.search[9], m[c].push(d.search[10]), m[c].push(d.search[11]), m[c].push(d.search[12]), p ? m[c].push(d.search[16]) : (m[c].push(d.search[13]), m[c].push(d.search[14]), m[c].push(d.search[15])))
                    }
                    m[c] && (j(function() {
                        var d, v = s.recipe,
                            b = s.numRecipes,
                            x = .3,
                            T = /dfp_brand=([^&]+)/.exec(o.location.search),
                            S = {},
                            N = /^(recipe|search)$/.test(c) && s.enabledFeatures.indexOf("refresh-leaderboard-" + c) > -1;
                        "recipe" === c ? v && (C.ingreds = v.ingredients, C.source = v.sourceName, C.branded = !C.displayIngredientAds, C.tags = [v.tags, v.hiddenTags].join(", "), C.serves = parseInt(l(".yield").text(), 10).toString()) : "search" === c && (s.query && s.query.q && (C.search = s.query.q), C.tags = [], l("#ad-filter-data .facet-count").each(function(e, t) {
                            var n = l(t),
                                i = n.attr("name").replace(/[^-]+-(.+)$/, "$1"),
                                a = n.attr("value");
                            i && a && a / b > x && C.tags.push(i)
                        }), l("#ad-filter-data .checkbox").each(function(e, t) {
                            var n = l(t),
                                i = n.text().trim(),
                                a = n.find(".count").text(),
                                r = i && i.slice(0, i.indexOf(a)).trim();
                            r && a && (a = a.slice(1, -1).replace(/,/g, ""), a / b > x && C.tags.push(r))
                        }), C.isexternal = g.toString(), C.tags = C.tags.join(", "), C.ingreds = [], l(".y-ingredients").each(function(e, t) {
                            var n;
                            l(t).find(".y-truncated").length ? (n = l(t).find(".y-truncated").data("popup"), n = n.substring(25, n.length - 7).split(/,\s*| and /)) : n = l(t).text().split(/,\s*| and /), l.each(n, function(e, t) {
                                S[t] ? S[t] += 1 : S[t] = 1
                            })
                        }), l.each(S, function(e, t) {
                            C.ingreds.push({
                                ing: l.trim(e),
                                count: t
                            })
                        }), C.ingreds.sort(function(e, t) {
                            return t.count - e.count
                        }), C.ingreds = l.map(C.ingreds.slice(0, 12), function(e) {
                            return e.ing
                        }).join(",")), C.logged = (!!s.user && !s.user.anonymous).toString(), T && T[1] && (C.dfp_brand = T[1]), C.ingredientclass = (s.ingredientclass || []).join(","), j(function() {
                            l.each(o.document.amzn_slots || [], function(e, t) {
                                C[t] = "1"
                            })
                        }), j(function() {
                            switch (y.pub(p ? "9678" : "3158"), c) {
                                case "home":
                                    r = new e(1200, 400), t(m[c][0]), r = new e(230, 457), t(m[c][1], !1, function() {
                                        l(o).trigger("debouncedresize")
                                    }), t(m[c][2], !1, function() {
                                        l(o).trigger("debouncedresize")
                                    }), "seasonal" === s.tab && m[c][3] && (r = new e(350, 125), t(m[c][3]));
                                    break;
                                case "recipe":
                                    p ? (r = new e(300, 250), t(m[c][1]), t(m[c][2]), t(m[c][3]), t(m[c][7]), t(m[c][9])) : (r = new e(728, 90), t(m[c][0]), t(m[c][2]), r = new e(300, 250), t(m[c][4]), t(m[c][5]), t(m[c][8])), r = new e(620, 80), t(m[c][6]);
                                    break;
                                case "search":
                                    p ? (r = new e(300, 250), t(m[c][0]), t(m[c][1]), t(m[c][2]), t(m[c][4])) : (r = new e(728, 90), t(m[c][0]), t(m[c][1], !0)), g ? (r = new e(400, 400), t(m[c][3], !1, function() {
                                        l(o).trigger("debouncedresize")
                                    }), r = new e(120, 40), t(m[c][5], !1, function() {
                                        setTimeout(function() {
                                            "none" !== l(".sponsor-logo").css("display") && l(".intro-text").css("color", "transparent")
                                        }, 100)
                                    }), r = new e(400, 400), t(m[c][6], !1, function() {
                                        l(o).trigger("debouncedresize")
                                    }), t(m[c][7], !1, function() {
                                        l(o).trigger("debouncedresize")
                                    }), r = new e(300, 250), p ? t(m[c][8]) : (t(m[c][8]), t(m[c][9]), t(m[c][10]))) : (r = new e(230, 456), t(m[c][3]))
                            }
                            y.enableAsync(), y.go()
                        }), j(function() {
                            l.each(k, function(e, t) {
                                var n = h.defineSlot(w + t.name, t.size, t.id).addService(h.pubads()).setTargeting("ybot_ad", y.adAvailable(t.name)).setTargeting("ybot_slot", t.name).setCollapseEmptyDiv(!0, !1);
                                t.refresh && s.ads.refresh.push(n), t.onload && (n.onload = t.onload, s.ads.onload.push(n)), k[e] = n
                            }), l.each(C, function(e, t) {
                                t && t.toLowerCase && h.pubads().setTargeting(e, t.toLowerCase().replace(/[#'"*.()=+<>\[\]!]/g, "").split(", "))
                            }), h.pubads().addEventListener("slotRenderEnded", function(e) {
                                l.each(s.ads.onload, function(t, n) {
                                    n === e.slot && n.onload()
                                })
                            }), h.pubads().enableAsyncRendering(), h.pubads().enableSingleRequest(), h.enableServices(), "home" === c || "recipe" === c ? (p && l("#google-ads-6").insertAfter(l(".image-wrapper").eq(0)), l.each(m[c], function(e, t) {
                                var i = l("#google-ads-" + e);
                                t && t.id && i.length && (n(i.attr("id", f + t.id), t.pid), j(function() {
                                    h.display(f + t.id)
                                }))
                            }), "seasonal" === s.tab && m[c][3] && (l('<div id="' + f + m[c][3].id + '" class="browse-sponsorship-wrapper"></div>').insertBefore(l("#cards")), j(function() {
                                h.display(f + m[c][3].id)
                            }))) : "search" === c && (p ? (a(0, 0), a(3, 2, !1, "y-grid-card ad-card-testing"), a(4, 5), a(1, 11), a(8, 17), a(2, 23)) : (l.each(m[c], function(e, t) {
                                var i = l("#google-ads-" + e);
                                t && t.id && i.length && (n(i.attr("id", f + t.id), t.pid), j(function() {
                                    h.display(f + t.id)
                                }))
                            }), a(3, 3, !1, "y-grid-card ad-card-testing")), g && (a(6, 20, !1, "y-grid-card ad-card-testing"), a(7, 32, !1, "y-grid-card ad-card-testing"), p || (a(8, 9, !1, "y-grid-card ad-iab-rectangle"), a(9, 15, !1, "y-grid-card ad-iab-rectangle"), a(10, 21, !1, "y-grid-card ad-iab-rectangle"), l(".ad-iab-rectangle").append('<span class="iab-label">' + s.strings.ads.advertisement + "</span>")), m[c][5] && m[c][5].id && (l(".sponsor-logo").attr("id", f + m[c][5].id), j(function() {
                                h.display(f + m[c][5].id)
                            })))), "home" === c ? (d = l("#" + f + m[c][1].id), d.length && d.insertAfter(d.siblings(".y-card, .y-grid-card").eq(2)), d = l("#" + f + m[c][2].id), d.length && d.insertAfter(d.siblings(".y-card, .y-grid-card").eq(12))) : "recipe" === c && (p ? (i(l("#" + f + m[c][3].id), l("#sidebar .y-grid-card").eq(5)), i(l("#" + f + m[c][9].id), l("#sidebar .y-grid-card").eq(10)), i(l("#" + f + m[c][7].id), l("#sidebar .y-grid-card").eq(14), !0), s.showPersistentRectangle ? (i(l("#" + f + m[c][1].id).addClass("ad-rectangle-top"), l(".recipe-main").eq(0)), i(l("#" + f + m[c][2].id), l(".review-tertiary"))) : i(l("#" + f + m[c][1].id), l(".review-tertiary"))) : (i(l("#sidebar .ad-banner-sidebar").eq(0), l("#sidebar .y-grid-card").eq(0)), i(l("#sidebar .ad-banner-sidebar").eq(2), l("#sidebar .y-grid-card").eq(1)))), N && setInterval(function() {
                                l("html").is(".persistent-iab:not(.collapsed)") && /block/.test(l(".ad-banner-top").css("display")) && !o.document.hidden && o.googletag.pubads().refresh([k[0]])
                            }, 15e3), u.log(c + " ads displayed", "google-tag")
                        })
                    }), u.log("ads initialized", "google-tag"))
                }
            }
        },
        "page.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = {
                    ESC: 27
                };
            e.exports = function() {
                var e = function() {
                        var n = a('<div class="video-overlay visuallyhidden"><span class="y-icon">Y</span></div>').on("click", function() {
                                e.hide()
                            }).appendTo(a("body")),
                            o = a('<div class="video"></div>').appendTo(n),
                            s = a('<iframe src="about:blank" frameborder="0" allowfullscreen></iframe>').appendTo(o);
                        return {
                            show: function(o) {
                                o = o.replace(/https?:\/\/vimeo\.com\//, "http://player.vimeo.com/video/").replace(/https?:\/\/youtu\.be\//, "http://www.youtube.com/embed/").replace(/https?:\/\/www\.youtube\.com\/watch\?v=/, "http://www.youtube.com/embed/").replace(/[?&].*/, ""), o += "?autoplay=1", s.attr("src", o), n.removeClass("visuallyhidden"), t.stop(), a(i.document).on("keydown", function(t) {
                                    t.keyCode === r.ESC && e.hide()
                                })
                            },
                            hide: function() {
                                s.attr("src", "about:blank"), n.addClass("visuallyhidden"), t.start(), a(i.document).un("keydown")
                            }
                        }
                    }(),
                    t = function() {
                        function t() {
                            var e = m + 1;
                            e > h && (e = 0), n(e)
                        }

                        function n(e) {
                            m !== e && (s = {
                                item: d.eq(m),
                                nav: u.eq(m)
                            }, l = {
                                item: d.eq(e),
                                nav: u.eq(e)
                            }, s.item.css("z-index", "25"), d.not(s.item).css("z-index", "20"), l.item.css({
                                opacity: 0,
                                zIndex: 30
                            }).animate({
                                opacity: 1
                            }, {
                                duration: 333,
                                done: function() {
                                    m = e, f && r()
                                }
                            }), s.nav.removeClass("active"), l.nav.addClass("active"))
                        }

                        function i() {
                            clearTimeout(f), f = null
                        }

                        function r() {
                            clearTimeout(f), f = setTimeout(t, p)
                        }
                        var o, s, l, c, u, d, p, f, m = 0,
                            h = 0;
                        return {
                            init: function(t, s) {
                                return t && t.length && (p = 1e3 * (s || 6), o = t, d = a(">.y-carousel-list li", o), c = a(".y-carousel-navigation", o), u = a("li", c), h = u.length - 1, d.eq(0).css("opacity", 1), u.length > 1 && (c.css("display", "block"), u.eq(0).addClass("active"), u.find("button").on("click", function() {
                                    a(this).parent().hasClass("active") || (i(), n(a(this).data("index")), r())
                                })), t.find(".y-carousel-link").each(function(t, n) {
                                    n = a(n), n.data("video") && n.on("click", function(t) {
                                        t.preventDefault(), e.show(n.data("video"))
                                    }).append(a('<div class="y-carousel-play-background"></div><div class="y-carousel-play"></div>'))
                                })), this
                            },
                            start: function() {
                                return o && (o.hover(i, r), r()), this
                            },
                            stop: function() {
                                return o && (o.off("mouseenter mouseleave"), i()), this
                            }
                        }
                    }();
                t.init(a(".y-carousel")).start()
            }
        },
        "more.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("./vendors/google/universal-analytics").track,
                o = n("../utilities/debug"),
                s = n("../utilities/history"),
                l = n("../utilities/postload"),
                c = a("#cards"),
                u = a("#more"),
                d = n("yummly"),
                p = d.more,
                f = p ? p.limit : null,
                m = d.query.max,
                h = m ? m - f : 0,
                g = p ? p.total : null,
                v = 0;
            e.exports = function() {
                p ? u.on("click", function() {
                    if (!u.hasClass("disabled")) {
                        var e = p.url;
                        v += 1, h += f, e += h, p.query && (e += "?" + decodeURIComponent(p.query)), o.log("MORE URL: " + e), u.addClass("disabled"), a.ajax({
                            url: e,
                            cache: !1,
                            complete: function() {
                                u.removeClass("disabled")
                            },
                            success: function(e) {
                                r("send", "pageview"), c.append(e), a(i).trigger("debouncedresize"), n("./recipe/card")(), n("./recipe/truncate")(), n("./ads").trackNativeAdImpressions(h - 1), n("./ads").refreshAds(), l.lowres(), l.all(".y-source img"), !a.trim(e) || h + f >= g ? u.hide() : u.show(), s.max(h + f)
                            },
                            headers: d.locale.headers
                        })
                    }
                }) : u.length && o.error("Add `more: locals.more` to client utility object of /server/routes" + d.view + ".")
            }
        },
        "index.js": function(e, t, n) {
            var i = n("yummly"),
                a = n("./forms/keywords"),
                r = n("./vendors"),
                o = n("./utilities/debug"),
                s = n("./utilities/view");
            n("./utilities/compat/array"), r.init(),
                function() {
                    if (!/^(login|settings|insights)/.test(s())) {
                        if (!i.fn) return setTimeout(arguments.callee, 250);
                        i.showMobilePromo ? n("./overlays/promos/mobile-promo")() : i.showMobileTopBanner && n("./overlays/promos/mobile-web-top-banner")(3)
                    }
                }(), s(["admin", "error", "home", "insights/*", "login", "navigation", "page", "profile/collections/index", "profile/collections/collection", "profile/recipes", "profile/recommended", "recipe/external", "recipe/print", "recipe/recipe", "recipe/search", "recipe/outsearch", "privacy", "scoreboard", "settings", "settings/admin", "settings/email", "settings/password/forgot", "settings/password/reset", "settings/profile", "settings/taste", "styleguide", "terms", "tools/complementary-product", "tools/content", "tools/hero", "tools/promoted", "tools/search-sponsor", "urb/custom-recipes", "urb/goodies/goodies", "urb/goodies/publishers", "urb/goodies/yumbutton", "urb/grab"]) ? (n("./utilities/debounced")("resize"), n("./utilities/debounced")("scroll"), n("./user/login")(), n("./vendors/buttons")(), n("./menus/browse")(), n("./menus/urb")(), n("./mobile")(), n("./filters")(), n("./page-tracking")(), n("./profile/reco/new-recommendations")(), n("./profile/collections/collections").init(), n("./locale")(), n("../overlays/onboarding/prefs")(), n("./utilities/postload").init(), a.render()) : s("test") ? t.keywords = a : o.error("Uncaught View. Add " + i.view + " to static regex test."), s(["page", "profile/collections/index", "profile/recipes", "profile/recommended"]) && n("./profile-search")(), s(["page", "profile/collections/collection", "profile/recipes", "profile/recommended", "recipe/search", "recipe/outsearch", "home"]) && (n("./more")(), n("./utilities/track").viewability()), s("login") && n("./user/page")(), s("recipe/recipe") && (n("./recipe")(), n("./utilities/track").viewability(), -1 === i.enabledFeatures.indexOf("disable-reviews") && (n("./utilities/timeago")(), n("./recipe/user-reviews")())), s("settings/taste") && n("./settings/taste/page")(), s(["recipe/search", "recipe/outsearch"]) && n("./search")(), s("profile/collections/index") && n("./profile/collections/create")(), s(["profile/collections/index", "profile/collections/collection"]) && n("./profile/collections/edit")(), s(["urb/custom-recipes"]) && n("./profile/urb/custom-recipes")(), s(["urb/grab"]) && n("./profile/urb/grab")(), s(["urb/verify"]) && n("./profile/urb/verify")(), s(["urb/yum"]) && n("./profile/urb/yums")(), s(["urb/goodies/yumbutton"]) && n("./profile/urb/goodies/yumbutton")(), s("profile/recommended") && n("./profile/reco/recommended")(), s(["recipe/recipe", "recipe/search", "recipe/outsearch", "home", "page", "insights/*"]) && n("./search/phrases")(), s(["recipe/recipe", "recipe/search", "recipe/outsearch"]) && (n("./ads").trackNativeAdImpressions(), n("./utilities/persistent-ad")()), s(["page", "profile/collections/index"]) && n("./page")(), s("home") && n("./browse")(), s(["home", "page", "profile/collections/index", "profile/collections/collection", "profile/recommended", "profile/recipes", "recipe/recipe", "recipe/search", "recipe/outsearch"]) && (n("./recipe/card")(), n("./recipe/truncate")(), n("./recipe/dialog-email-script")()), s(["recipe/external", "recipe/print", "scoreboard", "settings/admin", "settings/email", "settings/profile", "settings/password/forgot", "settings/password/reset", "tools/complementary-product", "tools/content", "tools/hero", "tools/promoted", "tools/search-sponsor"]) && n("./" + i.view)(), s(["home", "recipe/recipe", "recipe/external", "recipe/search", "recipe/outsearch"]) && n("./overlays/onboarding/navi")(), s(["insights/*"]) && n("./insights")()
        },
        "sheet.js": function(e, t, n) {
            function i() {
                w.empty(), k.empty()
            }

            function a(e) {
                e = e || "", m = e.body || e, h = e.header || ""
            }

            function r(e) {
                v = e || ""
            }

            function o(e) {
                e && (x = e)
            }

            function s(e) {
                g = e || "sheet"
            }

            function l() {
                b = !1, i(), k.remove(), a(""), s(""), r(""), f && f()
            }

            function c() {
                x && x.stopPropagation(), k.on("click", function(e) {
                    e.stopPropagation()
                }), y("body").on("click", function() {
                    if (b) {
                        var e = f;
                        f = null, l(), f = e, e = null
                    }
                })
            }

            function u() {
                var e = y("<div>", {
                        "class": "yummly-message-header",
                        html: h
                    }),
                    t = y("<div>", {
                        "class": "yummly-message-body",
                        html: m
                    }),
                    n = y("<button>", {
                        "class": "btn-secondary yummly-message-exit",
                        click: function() {
                            l()
                        },
                        html: "Continue"
                    }),
                    a = y("<button>", {
                        "class": "yummly-sheet-close nochrome",
                        click: function() {
                            l()
                        },
                        html: '<span class="y-icon">&#x23;</span>'
                    });
                i(), w.append(a, e, t, n), k.attr("class", "yummly-sheet yummly-message"), k.append(w)
            }

            function d() {
                var e = y("<button>", {
                    "class": "yummly-sheet-close nochrome",
                    click: function() {
                        l()
                    },
                    html: '<span class="y-icon">&#x23;</span>'
                });
                i(), w.append(m, e), k.attr("class", "yummly-sheet"), k.append(w)
            }

            function p() {
                "message" === g ? u() : d(), C.append(k), b = !0, v && v(), c()
            }
            var f, m, h, g, v, y = n("jquery"),
                b = !1,
                x = null,
                w = y("<div>", {
                    "class": "yummly-sheet-content"
                }),
                k = y("<div>"),
                C = y("#navigation");
            t.open = function(e) {
                f = e.dismiss, a(e.content || ""), s(e.type), r(e.fn), o(e.event), m && p(e.fn)
            }, t.close = function() {
                l()
            }, t.isOpen = function() {
                return b
            }
        },
        "browse.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window");
            e.exports = function() {
                var e = i(".browse-tabs").clone().addClass("visuallyhidden browse-header").appendTo(i(".browse-box")),
                    t = parseInt(e.css("top"), 10);
                i(".application-body").scroll(function() {
                    i(".browse-box").offset().top <= t ? e.removeClass("visuallyhidden") : e.addClass("visuallyhidden")
                }), i(".browse-box .active a")[0].href.indexOf("recommended") > -1 && n("./profile/reco/recommended").sendRecommendedPageLoad(), i(a).on("debouncedresize", function() {
                    i(".ad-y-card").each(function(e, t) {
                        i(t).css("height", i(t).prev().css("height"))
                    })
                })
            }
        },
        "mobile.js": function(e, t, n) {
            var i = n("window"),
                a = n("./utilities/view"),
                r = i.navigator.userAgent.match(/Android [\d+\.]{3,5}/),
                o = i.navigator.userAgent.match(/iPhone/i),
                s = n("jquery"),
                l = n("./utilities/width"),
                c = s("html"),
                u = s("body");
            e.exports = function() {
                r && 2 === r[0].replace("Android ", "").charAt(0) ? u.addClass("android-2") : o && u.addClass("iphone-all"), s("#button-navigation").on("click", function(e) {
                    e.preventDefault(), c.toggleClass("reveal-navigation"), s(i).scrollTop(0)
                }), s("#button-filters").on("click", function(e) {
                    e.preventDefault(), c.toggleClass("reveal-filters"), s(i).scrollTop(0)
                }), s("#logout").on("click", function() {
                    n("../user/logout")()
                }), s(i).on("debouncedresize", function() {
                    var e = l.small() || l.medium();
                    e || c.removeClass("reveal-navigation reveal-filters"), a("page") && (e ? s("#profile-tabs [type=text]").val() && s("#profile-tabs").addClass("show-search") : s("#profile-tabs").removeClass("show-search"))
                }), s("#tab-dropdown").on("change", function() {
                    var e = s(this).val();
                    i.location.href = e
                })
            }
        },
        "filters.js": function(e, t, n) {
            function i() {
                p.trim(v.html()) || v.append(g)
            }

            function a() {
                p.trim(y.html()) || y.append(g)
            }

            function r() {
                var e = p("#images-only").prop("checked"),
                    t = p("#blogs-only").prop("checked"),
                    n = p("#my-recipes-only").prop("checked"),
                    i = p("#sort-by").val();
                p("<input>").attr({
                    type: "hidden",
                    name: "imagesOnly",
                    value: e
                }).appendTo("#filters-form"), p("<input>").attr({
                    type: "hidden",
                    name: "blogsOnly",
                    value: t
                }).appendTo("#filters-form"), p("<input>").attr({
                    type: "hidden",
                    name: "myRecipesOnly",
                    value: n
                }).appendTo("#filters-form"), p("<input>").attr({
                    type: "hidden",
                    name: "sortBy",
                    value: i
                }).appendTo("#filters-form")
            }

            function o() {
                x || g.length || (x = !0, y.load("/partials/filters" + (u.location.search || ""), function() {
                    b = p("#ingredient-choices").data("values") || null, g = p(".panel-filters"), setTimeout(e.exports, 0)
                }))
            }

            function s() {
                h() ? a() : ("recipe/search" === d.view && o(), i())
            }

            function l() {
                var e = p(this).prop("id"),
                    t = p(this).prop("checked");
                u.mixpanel && u.mixpanel.track("Sorts", {
                    SortType: e,
                    Sorted: t
                })
            }

            function c() {
                r(), p('[name="q"]').val() || p('[name="q"]').val(d.query.q), g.find(".facet-count").remove()
            }
            var u = n("window"),
                d = n("yummly"),
                p = n("jquery"),
                d = n("yummly"),
                f = d.strings,
                m = n("./utilities/debug"),
                h = function() {
                    return "none" === p(".y-filters").css("display")
                },
                g = p(".panel-filters"),
                v = p("#y-filters"),
                y = p(".filters-m"),
                b = p("#ingredient-choices").data("values") || null,
                x = !1;
            e.exports = function() {
                return x ? (g.addClass("loaded"), n("./search").attachRandomMessage(), p("#filters-form").on("submit", c), g.find(".only-filter").on("click", l), g.find(".immediate").on("change", function() {
                    p("#filters-form").submit()
                }), p(".ingredient > .remove-ingredient").on("click", function() {
                    var e = p(this),
                        t = p(e.siblings("input[type=hidden]")[0]);
                    t.removeAttr("name"), p("#filters-form").submit()
                }), p(".ingredient-add").each(function() {
                    var e = p(this).find("input.ingredient-suggest"),
                        t = p(this).find("button"),
                        n = e.offset().top - 50,
                        i = 0;
                    e.on({
                        focus: function() {
                            h() ? p(".filters-m").scrollTop(n) : 90 === Math.abs(u.orientation) && p(".application-body").scrollTop(n), t.addClass("btn-on-state")
                        },
                        blur: function() {
                            t.removeClass("btn-on-state")
                        }
                    }), e.ninja("autocomplete", {
                        get: function(t, n) {
                            i += 1, p.ajax({
                                url: "/api/metadata/ingredient-suggest?prefix=" + t,
                                dataType: "json",
                                context: {
                                    callId: i
                                },
                                success: function(t) {
                                    if (this.callId === i) {
                                        var a = [],
                                            r = {};
                                        p.isArray(t) && p.each(t, function(e, t) {
                                            (!b || b[t]) && (a.push(t), r[t] = !0)
                                        }), e.data("choices", r), n(a.slice(0, 10)), p(".ninja-list").css("top", "25px")
                                    }
                                },
                                error: function(e, t, n) {
                                    m.log("autocomplete error: " + t + ", " + n)
                                },
                                headers: d.locale.headers
                            })
                        },
                        select: function() {
                            var t = e.val(),
                                n = e.data("choices") || {};
                            return t && n[t] && p("#filters-form").submit(), !1
                        }
                    })
                }), p(".ingredient-remove-all").on("click", function() {
                    var e = p(this),
                        t = p(e.parent().find("input[type=hidden]")),
                        n = t.length,
                        i = [];
                    return 0 === n ? !1 : (t.each(function(e) {
                        i.push(e.value)
                    }), t.removeAttr("name"), void p("#filters-form").submit())
                }), p(".slider").each(function(e, t) {
                    var n = p(t),
                        i = n.data("stops");
                    n.ninja("slider", {
                        list: i
                    })
                }), p(".expander").each(function() {
                    var e = p(this),
                        t = e.parent().find(".hidden"),
                        n = e.find(".point"),
                        i = e.find(".text");
                    e.on("click", function(e) {
                        var a = n.hasClass("less") ? f.search.filters.see.more : f.search.filters.see.less;
                        e.preventDefault(), t.toggle(), i.text(a), n.toggleClass("less")
                    })
                }), void s()) : (p(u).on("debouncedresize", s), p("#button-filters").on("mousedown", o), p(".y-results").find(".only-filter, .immediate").on("change", function() {
                    p(this).is(".only-filter") && l.call(this), p("#filters-form").length || (p("body").append('<form id="filters-form" action="/recipes"></form>').on("submit", c), n("./search").attachRandomMessage()), p("#filters-form").submit()
                }), void s())
            }
        },
        "user/page.js": function(e, t, n) {
            e.exports = function() {
                var e = n("window"),
                    t = e.mixpanel,
                    i = n("../utilities/page");
                t && t.track("Login View", {
                    "Screen Type": i.isFirstPageview ? "Registration" : "Registration-2nd-Pageview"
                })
            }
        },
        "menus/urb.js": function(e, t, n) {
            var i, a, r = n("window"),
                o = n("jquery"),
                s = n("yummly"),
                l = s.strings,
                c = s.enabledFeatures,
                u = [];
            c && o.inArray("add-a-recipe", c) > -1 && (i = o("<div>" + l.navigation.addyourrecipe + "</div>").on("click", function() {
                r.location.assign("/addyourrecipe")
            }), u.push(i)), c && o.inArray("bookmarklet", c) > -1 && (a = o("<div>" + l.navigation.getbookmarklet + "</div>").on("click", function() {
                r.location.assign("/bookmarklet")
            }), u.push(a)), c && o.inArray("publisher-page", c) > -1 && u.push(o("<div>" + l.navigation.becomepublisher + "</div>").on("click", function() {
                r.location.assign("/publishers")
            })), e.exports = function() {
                o("#menu-urb").ninja("menu", {
                    list: u
                })
            }
        },
        "tools/hero.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly"),
                r = n("jquery");
            e.exports = function() {
                r(".tools-content form").on("submit", function(e) {
                    e.preventDefault();
                    var t = r("[name=recipe]").eq(0),
                        n = r.trim(t.val()),
                        o = /.+(unitType=[a-z]+).*/,
                        s = n.match(o) ? "?" + n.match(o)[1] : "",
                        l = n.replace(/\?.+$/, s),
                        c = r.trim(t.closest("label").text()),
                        u = c.replace(/recipe\/$/, ""),
                        d = c + l,
                        p = Date.parse(r("[name=dateStart]").val()),
                        f = isNaN(p) ? new Date : new Date(p),
                        m = r("[name=includeBrand]").prop("checked"),
                        h = r("[name=thirdPartyImpression]").val(),
                        g = r("[name=thirdPartyClick]").val(),
                        v = a.locale.headers["x-yummly-locale"];
                    l && (r(".tool-output").removeClass("hidden").find("textarea").val("Please wait..."), r.ajax({
                        url: "/tools/proxy?url=" + d,
                        dataType: "text",
                        complete: function(e) {
                            var t = r(e.responseText),
                                n = {
                                    id: l,
                                    name: t.find(".primary h1").text(),
                                    url: d,
                                    source: {
                                        icon: t.find(".recipeFavicon").attr("src"),
                                        name: r.trim(t.find("#sourceLink a, .source-name a").first().text()),
                                        url: u + t.find("#sourceLink a, .source-name a").first().attr("href").substr(1)
                                    }
                                },
                                a = f.getUTCFullYear(),
                                o = f.getUTCMonth() + 1,
                                s = f.getUTCDate(),
                                c = "",
                                p = "";
                            return 10 > o && (o = "0" + o), 10 > s && (s = "0" + s), t.each(function(e, t) {
                                t = r(t);
                                var n = t.attr("href");
                                return "stylesheet" === t.attr("rel") && /^https?:\/\/.+yummly.css$/.test(n) ? (c = '<link rel="stylesheet" href="' + n + '">', !1) : void 0
                            }), r(".tool-output textarea").val(""), n.name ? n.source.name ? n.source.url ? (g && (n.url = g + "?" + n.url, n.source.url = g + "?" + n.source.url), p += '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway:400,700">' + c, p += "<style>html{background:transparent;}</style>", p += '<div id="' + n.id + '" class="views-home"><div class="hero-wrapper"><a target="_top" class="imglink" href="%%CLICK_URL_ESC%%' + n.url + '"><img alt="' + n.name + '" src="//s.yumm.ly/promoted/' + v + "/homepage/" + [a, o, s].join("-") + '/hero.jpg" class="bigimage"></a><div class="infobox">', m && (p += '<a target="_top" href="%%CLICK_URL_ESC%%' + n.source.url + '"><img class="logo" alt="' + n.source.name + '" src="//s.yumm.ly/promoted/' + v + "/homepage/" + [a, o, s].join("-") + '/logo.png"></a>'), p += '<h1 class="recipe-name"><a target="_top" class="recipe-link" href="%%CLICK_URL_ESC%%' + n.url + '">' + n.name + "</a></h1></div></div></div>", h && (h = h.replace(/\[timestamp\]/g, "%%CACHEBUSTER%%"), p += /^http/.test(h) ? '<img src="' + h + '" style="width: 1px; height: 1px margin-top: -1px;">' : h), void r(".tool-output textarea").val(p)) : i.alert("Unable to parse recipe source url.") : i.alert("Unable to parse recipe source name.") : i.alert("Unable to parse recipe name.");
                        }
                    }))
                })
            }
        },
        "scoreboard.js": function(e, t, n) {
            e.exports = function() {
                n("../vendors/buttons")()
            }
        },
        "user/login.js": function(e, t, n) {
            function i() {
                r.encoded ? r.encoded = {
                    id: r.encoded.id ? s.unescapeHtml(r.encoded.id) : void 0,
                    userName: r.encoded.userName ? s.unescapeHtml(r.encoded.userName) : void 0,
                    userId: r.encoded.userId ? s.unescapeHtml(r.encoded.userId) : void 0
                } : r.encoded = {}, n("../menus/user")()
            }
            var a = n("yummly"),
                r = a.user,
                o = n("../vendors"),
                s = n("../utilities/entities");
            e.exports = function() {
                r.anonymous ? "login" === a.view ? (n("./buttons")(), n("../overlays/onboarding/prefs").handleLoginClicks()) : n("./sheet")() : i(), o.load("facebook", function() {
                    o.init("facebook", function(e) {
                        e && n("../vendors/facebook/login")(e, function() {})
                    })
                }), o.load("google", function() {
                    o.init("google", function(e) {
                        e && n("../vendors/google/login")(e)
                    })
                }), n("./check")()
            }
        },
        "user/sheet.js": function(e, t, n) {
            function i(e, t, n) {
                var i = n ? "regPromo" : "regPromoSheet";
                "impression" === e ? (p("send", "event", i, e, {
                    nonInteraction: 1
                }), s.mixpanel && s.mixpanel.track("Login View", {
                    "Screen Type": f.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                    Sheet: !0
                })) : p("send", "event", i, e, t, {
                    nonInteraction: 1
                })
            }

            function a(e, t) {
                var n = new Date,
                    l = 15,
                    p = {
                        type: "sheet",
                        content: o("#shared-login-content").html(),
                        fn: u,
                        event: e
                    };
                n.setTime(n.getTime() + 24 * l * 60 * 60 * 1e3), r || (r = !0, d.pushState(null, {
                    regPromo: !0
                }, function() {
                    var n = s.history,
                        i = n && n.state,
                        r = i && i.regPromo;
                    r ? a(e, t) : c.close()
                })), c.open(p), i("impression", null, t), o.cookie("yLogin", "dismissed", {
                    expires: n,
                    path: "/"
                }), e && o(e.target).hasClass("btn-secondary") ? o(".yummly-login").removeClass("yummly-login-new") : o(".yummly-login").addClass("yummly-login-new"), o(".yummly-sheet").unbind("mousedown").on("mousedown", function(e) {
                    var n = o(e.target);
                    n.closest("button").length && n.closest(".yummly-login-buttonwrap").length ? i("click", n.closest("button").attr("id"), t) : n.hasClass("yummly-sheet-overlay") ? i("dismiss", "background", t) : n.closest(".yummly-sheet-close").length && i("dismiss", "X", t)
                }), t && o(".yummly-sheet").addClass("yummly-sheet-overlay").appendTo(o("body"))
            }
            var r, o = n("jquery"),
                s = n("window"),
                l = n("yummly"),
                c = n("../sheet"),
                u = n("./buttons"),
                d = n("../utilities/history"),
                p = n("../vendors/google/universal-analytics").track,
                f = n("../utilities/page");
            e.exports = function() {
                var e = "dismissed" !== o.cookie("yLogin"),
                    t = /iP[aho]/.test(s.navigator.userAgent),
                    i = /Android/.test(s.navigator.userAgent),
                    r = t ? "auto-login-sheet-ios" : i ? "auto-login-sheet-android" : "auto-login-sheet",
                    c = l.enabledFeatures.indexOf(r) > -1,
                    u = !/^(home|insights|login|settings)/.test(l.view),
                    d = function() {
                        return o(".yummly-sheet").length && "block" === o(".yummly-sheet").css("display")
                    },
                    p = !1,
                    f = t && !/Version/.test(s.navigator.userAgent),
                    m = p || f,
                    h = /[?&]prm-v1/.test(s.location.search);
                e && c && u && !m && !d() && !h && "auto-login-sheet" === r && (l.enabledFeatures.indexOf("new-auto-login-sheet") < 0 || o(s).height() < 680) && a(null, !0), n("../overlays/onboarding/prefs").handleLoginClicks()
            }
        },
        "menus/user.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly"),
                o = r.strings,
                s = r.user,
                l = r.enabledFeatures,
                c = [a("<div>" + o.navigation.recipes + "</div>").on("click", function() {
                    i.location.assign("/profile/" + s.encoded.id + "/recipes")
                }), a("<div>" + o.navigation.collections + "</div>").on("click", function() {
                    i.location.assign("/profile/" + s.encoded.id + "/collections")
                })];
            l && a.inArray("add-a-recipe", l) > -1 && c.push(a("<div>" + o.navigation.addyourrecipe + "</div>").on("click", function() {
                i.location.assign("/addyourrecipe")
            })), l && a.inArray("bookmarklet", l) > -1 && c.push(a("<div>" + o.navigation.getbookmarklet + "</div>").on("click", function() {
                i.location.assign("/bookmarklet")
            })), l && a.inArray("publisher-page", l) > -1 && c.push(a("<div>" + o.navigation.becomepublisher + "</div>").on("click", function() {
                i.location.assign("/publishers")
            })), l && a.inArray("show-discuss-link", l) > -1 && c.push(a("<div>" + o.navigation.discuss + "</div>").on("click", function() {
                i.location.assign("/discuss")
            })), c.push("<hr>"), l && -1 === a.inArray("disable-recommendation-tab", l) && c.unshift(a("<div>" + o.recommendations.title + "</div>").on("click", function() {
                i.location.assign("/my-recommended")
            })), s.hasAdminTab && c.push(a("<div>" + o.settings.tab.admin + "</div>").on("click", function() {
                i.location.assign("/settings/admin")
            })), c.push(a("<div>" + o.settings.tab.profile + "</div>").on("click", function() {
                i.location.assign("/settings/profile")
            })), s.hasAdminTab || c.push(a("<div>" + o.settings.tab.taste + "</div>").on("click", function() {
                i.location.assign("/settings/taste-preferences")
            })), c.push(a("<div>" + o.settings.tab.email + "</div>").on("click", function() {
                i.location.assign("/settings/email")
            })), c.push(a("<hr><div>" + o.sign.out + "</div>").on("click", function() {
                n("../user/logout")()
            })), e.exports = function() {
                a("#menu-user").ninja("menu", {
                    list: c
                })
            }
        },
        "user/check.js": function(e, t, n) {
            var i = n("yummly"),
                a = n("../sheet"),
                r = i.user,
                o = i.view,
                s = r.regStatus,
                l = r.fullName,
                c = r.email;
            e.exports = function() {
                ("recipe/external" !== o || s) && ("migrated" === s ? a.open({
                    type: "message",
                    content: {
                        header: "<h3>Welcome Back</h3>",
                        body: "Welcome to the new Yummly, " + l.first + '. Your favorite recipes are now in your <a href="/profile/recipes">Recipe Box</a>.'
                    }
                }) : "connected" === s && a.open({
                    type: "message",
                    content: {
                        header: "<h3>Accounts merged</h3>",
                        body: c + " is attached to an existing account. Your accounts are now merged."
                    }
                }))
            }
        },
        "recipe/card.js": function(e, t, n) {
            function i() {
                var e = ".ad .suggestion, .products .suggestion, a.y-image, a.y-full, a.y-truncated, .y-title a, a.y-ingredients",
                    t = /Firefox\//.test(r.navigator.userAgent),
                    n = s.enabledFeatures.indexOf("target-blank") > -1;
                n && o(".y-card, .y-grid-card").find("a").attr("target", "_blank"), o("#y-results").on("mousedown", e, function(e) {
                    var i = ".y-card, .y-grid-card",
                        a = o(this),
                        c = a.closest(i).length ? a.closest(i) : a.parent(),
                        u = c.data("position") || 1 + c.index(i),
                        d = o("#cards").data("columns") || o("#sidebar").data("columns") || Math.floor(c.parent("div").width() / c.width()),
                        p = a.attr("href") || c.data("id") && "/recipe/" + c.data("id"),
                        f = p && p.replace(/.columns=\d+/, "").replace(/.position=\d+%2F\d+/, ""),
                        m = s.ads || {},
                        h = {},
                        g = c.data("click");
                    p && (/^\d+$/.test(u) && (u += "/" + o(i).length), c.hasClass("ad-recipe") ? g ? o.ajax({
                        url: "/adzerk-tracking?url=" + encodeURIComponent(g),
                        async: !1,
                        cache: !1,
                        headers: s.locale.headers
                    }) : o.ajax({
                        url: "/click",
                        async: !1,
                        cache: !1,
                        data: {
                            impId: m.impressionRecipe,
                            adId: c.data("ad"),
                            z: m.adRequestRecipe ? m.adRequestRecipe.z : "",
                            i: m.adRequestRecipe ? m.adRequestRecipe.i + "/" + o(".ad-recipe").index(c) : ""
                        },
                        headers: s.locale.headers
                    }) : a.hasClass("suggestion") && o.ajax({
                        url: "/click",
                        async: !1,
                        cache: !1,
                        data: {
                            impId: m.impressionProduct,
                            adId: a.data("ad"),
                            z: m.adRequestProduct.z,
                            i: m.adRequestProduct.i + "/" + o(".suggestion").index(a)
                        },
                        headers: s.locale.headers
                    }), "urb-url" === c.data("type") || a.hasClass("suggestion") || ("columns" in h || !d || (h.columns = d), "position" in h || !u || (h.position = u), h = o.param(h), h && (f += /\?/.test(f) ? "&" : "?", f += h), a.attr("href", f), l.state()), !n && t && (e.preventDefault(), 1 === e.which && (r.location = p)))
                })
            }

            function a() {
                o(".y-grid-card.compact").hover(function() {
                    var e, t = o(this).find(".y-ingredients");
                    t.css({
                        position: "absolute",
                        visibility: "hidden",
                        maxHeight: "none"
                    }), e = t.height(), t.css({
                        position: "static",
                        visibility: "visible",
                        maxHeight: "0px"
                    }).stop().animate({
                        maxHeight: e + "px"
                    }, 600)
                }, function() {
                    o(this).find(".y-ingredients").stop().animate({
                        maxHeight: "0px"
                    }, 600)
                })
            }
            var r = n("window"),
                o = n("jquery"),
                s = n("yummly"),
                l = n("../utilities/history");
            e.exports = function() {
                i(), a()
            }
        },
        "forms/index.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("validate"),
                o = n("yummly"),
                s = o.locale,
                l = o.strings,
                c = o.forms,
                u = n("../utilities/debug");
            t.auth = function(e, t) {
                var d = c[e],
                    p = a.map(d.fields, function(e) {
                        return a.extend({}, c.fields[e])
                    }),
                    f = a('[name="' + e + '"]');
                a.each(p, function(e, t) {
                    n("./fields/" + t.type)(f, t)
                }), new r(e, p, function(r, c) {
                    var d = f.find(">.message"),
                        m = "/mapi/v1/auth",
                        h = {
                            app: "web",
                            cookie: !0,
                            type: "email"
                        };
                    if (c.preventDefault(), f.find(".error").removeClass("error"), f.find(".message").text(""), r.length > 0) u.group("input errors:"), a.each(r, function(e, t) {
                        var n = f.find('label[for="' + t.name + '"]');
                        n.addClass("error").find(".message").text(t.message), u.warn(t.name, t.rule)
                    }), u.groupEnd();
                    else {
                        if ("reset" === e) return;
                        a.each(p, function(e, t) {
                            function n() {
                                return f.find('input[name="' + i + '"]').val()
                            }
                            var i = t.name;
                            "email" === i ? h["email-address"] = n() : "nameFirst" === i ? h["first-name"] = n() : "nameLast" === i ? h["last-name"] = n() : "passwordCurrent" === i || (h[i] = n())
                        }), "forgot" === e && (m += "/reset-email"), a.ajax({
                            url: m,
                            cache: !1,
                            data: h,
                            dataType: "json",
                            headers: s.headers,
                            error: function(e, t, n) {
                                d.addClass("error").text(l.forms.errors.internal), n ? u.error(n, t) : t && u.error(t)
                            },
                            statusCode: {
                                500: function() {
                                    "forgot" === e && d.addClass("error").text(l.forms.errors.internal)
                                },
                                400: function() {
                                    "forgot" === e && d.addClass("error").text(l.forms.errors.notFound), "reset" === e && d.addClass("error").text(l.forms.errors.internal)
                                },
                                401: function() {
                                    "login" === e && d.addClass("error").text(l.forms.errors.unauthorized), "register" === e && d.addClass("error").text(l.forms.errors.takenOrSignIn)
                                },
                                200: function(r) {
                                    if (f.find(".error").removeClass("error"), f.find(".message").text(""), "forgot" === e) {
                                        var c = a("[name=forgot] [name=email]").val();
                                        return "login" === o.view ? (d.html(l.forms.successes.forgot.body), a(".user-email").text(c), a("label, button, .back").remove(), a('<button type="button" class="btn-primary yummly-message-exit">' + l.forms.actions.home + "</button>").appendTo("[name=forgot]").css("margin-top", "20px")) : (o.enabledFeatures.indexOf("new-manual-login-sheet") > -1 ? (f.find("label").add(".login-email .back").addClass("visuallyhidden"), f.find(".message").first().html(l.forms.successes.forgot.body).find(".user-email").text(c), f.find(".btn-tertiary").html(l.forms.actions.ok).attr("type", "button").one("click", function() {
                                            var e = a(this);
                                            setTimeout(function() {
                                                e.text(o.strings.forms.actions.forgot).attr("type", "submit"), f.find("label").add(".login-email .back").removeClass("visuallyhidden").filter(".back").click()
                                            }, 0)
                                        })) : (n("../sheet").open({
                                            type: "message",
                                            content: {
                                                header: "<h1>" + l.forms.successes.forgot.header + "</h1>",
                                                body: l.forms.successes.forgot.body
                                            }
                                        }), a(".yummly-sheet .yummly-message-body .user-email").text(c)), a("input").blur()), void a(".yummly-message-exit").on("click", function() {
                                            i.location = "/"
                                        })
                                    }
                                    var p = s.headers;
                                    p["x-yummly-auth-type"] = "yummly", p["x-yummly-auth-token"] = encodeURIComponent(r.access_token), a.ajax({
                                        url: "/mapi/v1/user",
                                        cache: !1,
                                        dataType: "json",
                                        headers: p,
                                        error: function(e, t, n) {
                                            d.addClass("error").text(l.forms.errors.internal), n ? u.error(n, t) : t && u.error(t)
                                        },
                                        statusCode: {
                                            200: function(e) {
                                                "function" == typeof t && t(e)
                                            }
                                        }
                                    })
                                }
                            }
                        })
                    }
                }).messages = l.validate
            }
        },
        "user/logout.js": function(e, t, n) {
            function i() {
                r.removeCookie("au", {
                    path: "/",
                    secure: !1
                }), r.removeCookie("yLogin", {
                    path: "/"
                }), r.removeCookie("yOP", {
                    path: "/"
                }), s.temp.set("landing-page", !1), s.temp.set("logging-in", !1), s.temp.set("session", !1), a.location.reload(!0)
            }
            var a = n("window"),
                r = n("jquery"),
                o = n("../vendors/kahuna"),
                s = n("../utilities/storage");
            e.exports = function() {
                o.logout(), i()
            }
        },
        "recipe/index.js": function(e, t, n) {
            function i(e) {
                var t = s('<span class="loading-message">').append(s(".loading-image").first().show()).append(l.strings.recipe.message.remove),
                    n = s.ninja.dialog({
                        html: t
                    });
                n.open(), s.ajax({
                    url: "/mapi/v4/recipe/" + e,
                    type: "DELETE",
                    timeout: 5e3,
                    success: function() {
                        n.close(), o.location.href = o.location.origin
                    },
                    error: function() {
                        n.close();
                        var e = s.ninja.dialog({
                            html: s("#recipe-delete-error").html()
                        });
                        e.open(), s(".btn-cancel, #closeDialogSuccess").on("click", function() {
                            e.close()
                        })
                    },
                    headers: l.locale.headers
                })
            }

            function a(e) {
                var t = s.ninja.dialog({
                    html: s("#recipe-delete-confirm").html()
                });
                t.open(), s(".btn-remove").on("click", function() {
                    t.close(), i(e)
                }), s(".btn-cancel, #closeDialogSuccess").on("click", function() {
                    t.close()
                })
            }

            function r() {
                var e = s("#sidebar > div"),
                    t = e.filter(".y-grid-card").first(),
                    n = s(".more-related-recipes"),
                    i = s(".recipe").height() - 2 * t.height();
                "static" === s("#sidebar").css("position") ? e.removeClass("compact") : (e.each(function(e, t) {
                    t = s(t), t.addClass(t.position().top + t.height() > i ? "related-footer" : "related-sidebar")
                }), s(".related-sidebar").addClass("compact"), s(".related-footer").appendTo(n).removeClass("compact"))
            }
            var o = n("window"),
                s = n("jquery"),
                l = n("yummly"),
                c = n("../vendors/kahuna"),
                u = n("../utilities/debug");
            e.exports = function() {
                function e(e) {
                    function t(t) {
                        s.each(t, function() {
                            a.append("<li>" + this.text + "</li>")
                        }), r.append(a), e.remove()
                    }

                    function n(e) {
                        u.error("Prep step loading error: " + e)
                    }
                    e = s(e);
                    var i = e.attr("prepLink"),
                        a = s('<ol itemprop="recipeInstructions"/>'),
                        r = e.parent(".yummly-prep-steps");
                    s.ajax({
                        url: i,
                        dataType: "jsonp",
                        jsonpCallback: "__prepSteps",
                        timeout: 5e3,
                        success: function(e) {
                            t(e)
                        },
                        error: function(e, t) {
                            n(t)
                        },
                        headers: l.locale.headers
                    })
                }
                n("../vendors/buttons")(), s("#custom-delete-link").on("click", function(e) {
                    e.preventDefault(), a(s(this).data("id"))
                }), s(".open-window").on("click", function(e) {
                    e.preventDefault(), o.open(s(this).attr("link"))
                }), s(".mixpanel-track").on("click", function() {
                    if (o.mixpanel) try {
                        var e = s(this).data("mixpanel-event"),
                            t = s(this).data("mixpanel-props"),
                            n = t ? JSON.parse(decodeURIComponent(t)) : null;
                        n && ("Print" === e ? c.track("Printed") : "Nutrition Tracker Click" === e && (n.Vendor = "Jawbone"), o.mixpanel.track(e, n))
                    } catch (i) {
                        u.error("bad mixpanel payload: " + i)
                    }
                }), s("#load-prep-steps").on("click", function() {
                    e(this)
                }), s("#newServings").on("click", function(e) {
                    var t = s("#servings-text"),
                        n = t.val().trim();
                    /^\d+$/.test(n) && 0 !== n || (e.preventDefault(), t.addClass("alert"))
                }), s("#servings-text").on("focus", function() {
                    s("#newServings").prop("disabled", !1)
                }), s(".desc-more").on("click", function() {
                    s(".desc-partial, .desc-full").toggleClass("visuallyhidden")
                }), s(".ingredient-line-handle").each(function() {
                    var e = s(this),
                        t = e.prev(),
                        n = e.prepend(t.html()).appendTo(t.empty()).get(0).outerHTML.replace(/^<li/, "<div").replace(/li>$/, "div>");
                    e.replaceWith(n), t.addClass("has-ingredient-ad")
                }), s(o.document).on("click", function(e) {
                    var t = s(e.target),
                        n = t.closest(".ingredient-line-handle"),
                        i = t.closest(".ingredient-line-modifier"),
                        a = t.closest("a");
                    i.length && !a.length ? (s(".ingredient-line-handle").removeClass("active"), o.open(i.find("a").attr("href"))) : n.length ? (s(".ingredient-line-handle").not(n).removeClass("active"), n.toggleClass("active")) : s(".ingredient-line-handle").removeClass("active")
                }), s(".track-fitness[href]").on("click", function(e) {
                    var t = s(this),
                        n = t.data("width") || "auto",
                        i = t.data("height") || "auto",
                        a = Math.round(o.screen.width / 2 - n / 2),
                        r = Math.round(o.screen.height / 2 - i / 2);
                    e.preventDefault(), o.open(t.attr("href"), "yummly-jawbone", "location=no,menubar=no,resizable=no,personalbar=no,scrollbars=yes,status=no,toolbar=no,width=" + n + ",height=" + i + ",left=" + a + ",top=" + r)
                }), s(".recipe-data li").on("click", function(e) {
                    var t, n = s(e.target).closest("li").attr("class");
                    switch (n) {
                        case "ingredient-data":
                            t = s(".yummly-recipe-ingredients").first();
                            break;
                        case "nutrition-data":
                            t = s(".nutrition").first();
                            break;
                        case "time-data":
                            t = s(".yummly-prep-steps").first();
                            break;
                        case "rating-data":
                            t = s(".review-tertiary").first()
                    }
                    s(".application-body").animate({
                        scrollTop: t.offset().top - 100
                    }, 1e3)
                }), r()
            }, e.exports.moveRelatedRecipes = r
        },
        "locale/index.js": function(e, t, n) {
            e.exports = function() {
                var e = n("window"),
                    t = n("yummly").locale,
                    i = n("jquery"),
                    a = e.navigator.userAgent.match(/iPhone/i);
                t.warn && n("./cookie")(), t.redirect && !a && n("./redirect")(), i(".y-foot .intl").change(function() {
                    e.location = e.location.href.replace(t.domain.base, i(this).find(":selected").val())
                })
            }
        },
        "menus/browse.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly"),
                o = r.strings,
                s = a("<div>" + o.navigation.seasonal + "</div>").on("click", function() {
                    i.location.assign("/browse/seasonal")
                }),
                l = a("<div>" + o.navigation.popular + "</div>").on("click", function() {
                    i.location.assign("/browse/popular-now")
                }),
                c = a("<div>" + o.navigation.quickeasy + "</div>").on("click", function() {
                    i.location.assign("/browse/quick-and-easy")
                }),
                u = a("<div>" + o.navigation.publishers + "</div>").on("click", function() {
                    i.location.assign("/top-publishers")
                }),
                d = "com" === r.locale.domain.top ? [s, l, c, u] : [s, c];
            e.exports = function() {
                a("#menu-browse").ninja("menu", {
                    list: d
                })
            }
        },
        "user/buttons.js": function(e, t, n) {
            function i() {
                var e = l(".yummly-sheet .tab.active").index();
                0 === e ? l(".secondary-cta").html(c.strings.login.sheet.signin.ctaSecondary) : l(".secondary-cta").html(c.strings.onboarding.gatherPrefs.ctaSecondary)
            }

            function a(e) {
                function t() {
                    var t = a || r,
                        n = t.split("?"),
                        i = (n.length > 1 ? n[1] : "").replace(/&?loginRecipe=[^&=]+/, ""),
                        o = "";
                    e && (o += "My Recipe Box Login" === e ? "?recipeboxSearch=true" : "My Review" === e ? "?loginReview=true" : "?loginRecipe=" + e, i && (o += "&" + i.split("#")[0]), t = n[0] + o), s.location.replace(t.replace(/#.*/, ""))
                }
                var n, i, a = "",
                    r = s.location.href,
                    o = r.split("?")[1] ? r.split("?")[1].split("&") : [];
                if (l.each(o, function(e, t) {
                        "sso" === t.split("=")[0] && (n = !0), "sig" === t.split("=")[0] && (i = !0)
                    }), n && i) return s.location.reload(!0);
                if ("login" === d) {
                    var c = p.entry && p.entry.split("?");
                    if (a = p.entry || "/", p.urbQueryTitle && c && c.length > 1) {
                        var u = c[1].split("=");
                        u.length > 1 && (a = c[0] + "?" + u[0] + "=" + encodeURIComponent(u[1]) + "&title=" + encodeURIComponent(p.urbQueryTitle) + "&image=" + encodeURIComponent(p.urbQueryImage))
                    }
                }
                e ? v.publishAction(e, "all-yums", null, t) : t()
            }

            function r(e, t, n) {
                s.mixpanel && (m.init(e, t), s.mixpanel.identify(t), s.mixpanel.people.set({
                    "Set Last Seen": !0
                })), setTimeout(n, 400)
            }

            function o(e, t, n) {
                var i;
                i = "fb" === e ? "facebook" : "google" === e || "gplus" === e ? "google" : "email", l.ajax({
                    cache: !1,
                    dataType: "json",
                    success: function(e) {
                        var t = u.headers;
                        t["x-yummly-auth-type"] = "yummly", t["x-yummly-auth-token"] = encodeURIComponent(e.access_token), l.ajax({
                            cache: !1,
                            dataType: "json",
                            success: function(e) {
                                r(e.userName, e.email, function() {
                                    a(n)
                                })
                            },
                            url: "/mapi/v1/user",
                            headers: t
                        })
                    },
                    url: "/mapi/v1/auth",
                    data: {
                        app: "web",
                        type: e,
                        cookie: !0,
                        token: t
                    },
                    headers: u.headers
                })
            }
            var s = n("window"),
                l = n("jquery"),
                c = n("yummly"),
                u = c.locale,
                d = c.view,
                p = c.query,
                f = n("../utilities/width"),
                m = n("../vendors/kahuna"),
                h = n("../vendors/facebook/config"),
                g = n("../vendors/google/config"),
                v = n("../profile/collections/collections"),
                y = n("../utilities/page");
            e.exports = function(e) {
                c.yumUrl = e, l(".yummly-sheet").unbind("click").on("click", function(e) {
                    this === e.target && n("../sheet").close()
                }), l("#facebook, #onboarding-prefs .btn-facebook").unbind("click").on("click", function() {
                    s.mixpanel && (s.mixpanel.track("Login Vendor Button Click", {
                        "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                        Vendor: "Facebook"
                    }), s.mixpanel.track("Prompt Click", {
                        "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                        "Prompt Action": "Login",
                        "Prompt Label": "Facebook"
                    })), s.FB.login(function(t) {
                        t.authResponse && o("fb", t.authResponse.accessToken, e)
                    }, {
                        scope: h.scope
                    })
                }), l("#google, #onboarding-prefs .btn-google").unbind("click").on("click", function() {
                    return s.gapi && s.gapi.auth ? (s.mixpanel && (s.mixpanel.track("Login Vendor Button Click", {
                        "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                        Vendor: "Google"
                    }), s.mixpanel.track("Prompt Click", {
                        "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                        "Prompt Action": "Login",
                        "Prompt Label": "Google"
                    })), void s.gapi.auth.authorize({
                        client_id: g.oauthId,
                        scope: g.oauthScope,
                        immediate: !1
                    }, function(t) {
                        t && !t.error && o("gplus", t.access_token, e)
                    })) : setTimeout(arguments.callee, 250)
                });
                var t = l(".yummly-login"),
                    u = l(".login-email");
                l("#email, .pane-login .btn-tertiary").unbind("click").on("click", function() {
                    var o = c.enabledFeatures.indexOf("email-reg-test") > -1,
                        p = c.enabledFeatures.indexOf("inline-email-login") > -1,
                        m = "login" === d,
                        h = l(".multistep-email .btn-tertiary");
                    if (!l(this).is(h) && (s.mixpanel && (s.mixpanel.track("Login Vendor Button Click", {
                            "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                            Vendor: "Email"
                        }), s.mixpanel.track("Prompt Click", {
                            "Screen Type": y.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                            "Prompt Action": "Login",
                            "Prompt Label": "Email"
                        })), !m && p && !o && !f.supportsOnboarding())) return void(s.location = "/login?tab=email&entry=" + encodeURIComponent(s.location.pathname + s.location.search));
                    if (o) return n("../overlays/onboarding/multistep-email-login")(h, l(this));
                    if (u.length) t.hide(), u.show(), l("html").addClass("show-login-email");
                    else {
                        var g = n("../forms"),
                            v = l("#login-email").html(),
                            b = l(".yummly-sheet-content"),
                            x = function(t) {
                                s.mixpanel ? r(t.name, t.email, function() {
                                    a(e)
                                }) : a(e)
                            };
                        t.hide(), b.append(v), l("html").addClass("show-login-email"), u = l(".login-email"), g.auth("login", x), g.auth("register", x), g.auth("forgot");
                        var w = u.find(".back"),
                            k = u.find(".tabs"),
                            C = k.find(".tab"),
                            j = u.find("form"),
                            T = u.find('form[name="forgot"]'),
                            S = u.find('form[name="login"]'),
                            N = j.find(".forgot"),
                            E = u.find(".sheet-header");
                        w.add("#onboarding-prefs .dismiss, .secondary-cta").on("click", function() {
                            l("html").removeClass("show-login-email"), u.hide(), t.show(), j.find(".error").removeClass("error"), j.find(".message").text(""), E.show(), l(this).is(".secondary-cta") && C.not(".active").click()
                        }), C.on("click", function() {
                            l(".yummly-login").removeClass("yummly-login-new"), l(this).hasClass("active") || (C.toggleClass("active"), j.hide(), l(j[C.index(l(this))]).show()), i()
                        }), N.on("click", function() {
                            k.hide(), w.on("click", function() {
                                k.show(), j.hide(), S.show()
                            }), j.hide(), T.show(), E.hide()
                        })
                    }
                    l(".yummly-sheet").hasClass("tab-first") ? u.find(".tab").first().click() : u.find(".tab").last().click()
                }), /tab=email/.test(s.location.search) && (l(".pane-login .btn-tertiary").eq(0).click(), u.find(".tab").last().click())
            }, e.exports.mixpanelTrackPostLoginEvents = r, e.exports.afterLoginAction = a
        },
        "search/index.js": function(e, t, n) {
            function i() {
                return u[Math.floor(Math.random() * u.length)]
            }

            function a() {
                var e = r(".search-tags"),
                    t = e.clone().appendTo(e.parent());
                return r(".ad-card-testing, .ad-iab-rectangle").each(function(e, t) {
                    r(t).css("height", r(t).prev().css("height"))
                }), t.css({
                    position: "absolute",
                    top: "0px",
                    left: "0px",
                    width: e.outerWidth() + "px",
                    height: "auto"
                }), e.add(t).removeClass("collapsed expanded"), t.height() / t.find(".search-tag").height() >= 2 && e.addClass("collapsed"), t.remove(), a
            }
            var r = n("jquery"),
                o = n("window"),
                s = n("yummly"),
                l = s.strings,
                c = n("../vendors/kahuna"),
                u = [l.messages.sheets.random1, l.messages.sheets.random2, l.messages.sheets.random3, l.messages.sheets.random4],
                d = r('<span class="loading-message">').append(r(".loading-image").first().show());
            e.exports = function() {
                var e = n("../user/buttons"),
                    t = n("../sheet");
                o.mixpanel && /^https?:\/\/[^\/]+\.yummly\.com/.test(o.document.referrer) && (c.track("Searched"), o.mixpanel.track("Search Query UI", {
                    "Search String": r(".search-box input").val(),
                    "Search Success": !0
                })), r(o).on("debouncedresize", a()), r(".login-my-recipes").on("click", function(n) {
                    r("#my-recipes-only").prop("checked", !1), t.open({
                        type: "sheet",
                        content: r("#shared-login-content").html(),
                        fn: function() {
                            e("My Recipe Box Login")
                        },
                        event: n
                    })
                }), r("html").hasClass("list-view") && (r(".list-view .ad .meta").each(function(e, t) {
                    r(t).closest(".ad").find(".y-heading").eq(0).clone().prependTo(t).text(s.strings.card.grid.suggestedSingular)
                }), r(".list-view .ad-recipe .sponsored").each(function(e, t) {
                    r(t).appendTo(r(t).siblings(".y-meta").find(".y-source"))
                })), r(".search-tag-more, .search-tag-less").on("click", function() {
                    r(".search-tags").toggleClass("collapsed").toggleClass("expanded")
                }), r(".seo-separator").insertAfter(r(".y-grid-card").eq(11)), r(".header-background").css("background-image", "url(" + r(".y-grid-card.has-image .recipe-image").first().data("src") + ")").addClass("active")
            }, e.exports.attachRandomMessage = function() {
                r("#filters-form").on("submit", function() {
                    r.ninja.dialog({
                        html: d.clone().append(i())
                    }).open()
                })
            }
        },
        "recipe/print.js": function(e, t, n) {
            var i = n("window");
            e.exports = function() {
                i.print()
            }
        },
        "locale/cookie.js": function(e, t, n) {
            function i() {
                a(".application-body").prepend(a("#yummlyDomainCookieWarnTemplate").html()), a("#yummlyDomainCookieWarnDismiss").on("click", function() {
                    a.cookie("yummlyDomainCookieWarn", "dismissed", {
                        path: "/"
                    }), a("#yummlyDomainCookieWarn").remove()
                })
            }
            var a = n("jquery");
            e.exports = function() {
                "dismissed" !== a.cookie("yummlyDomainCookieWarn") && i()
            }
        },
        "tools/content.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i(".tools-content form").on("submit", function(e) {
                    e.preventDefault();
                    var t = i("[name=destination]").val(),
                        n = i("[name=image]").val(),
                        a = i("[name=thirdPartyImpression]").val(),
                        r = i("[name=thirdPartyClick]").val(),
                        o = "";
                    r && (t = r + "?" + t), o = '<style>html,body,a{display:block;height:100%;font-size:0;line-height:0;}img{width:100%;}</style><a href="%%CLICK_URL_ESC%%' + t + '" target="_blank"><img src="' + n + '"></a>', a && (a = a.replace(/\[timestamp\]/g, "%%CACHEBUSTER%%"), o += /^http/.test(a) ? '<img src="' + a + '" style="width: 1px; height: 1px margin-top: -1px;">' : a), i(".tool-output").removeClass("hidden").find("textarea").val(o)
                })
            }
        },
        "page-tracking.js": function(e, t, n) {
            function i(e) {
                var t = (new Date).getTime(),
                    n = "/api/recommendation/sendTrackingEvent";
                o.encoded && o.encoded.id && (n += "?username=" + o.encoded.id), a.ajax({
                    url: n,
                    type: "POST",
                    cache: !1,
                    data: {
                        event: "page:load",
                        yv: o.yvCookie,
                        time_stamp: t,
                        current_url: o.current_url,
                        previous_url: o.previous_url
                    },
                    complete: function() {
                        e && e()
                    },
                    headers: r.locale.headers
                })
            }
            var a = n("jquery"),
                r = n("yummly"),
                o = r.user;
            e.exports = function() {
                i()
            }
        },
        "vendors/index.js": function(e, t, n) {
            function i() {
                return "https:" === l.document.location.protocol.toLowerCase()
            }

            function a(e, t) {
                var n = t || "G_cb" + g;
                return g += 1, l[n] = e, n
            }

            function r(e, t, n) {
                var r = "//",
                    o = !0,
                    s = !1,
                    d = !1,
                    m = i();
                switch (e) {
                    case "a9":
                        o = !1, l.amzn_slots = [], l.amzn_render = function() {}, r += "aax-us-east.amazon-Adsystem.com/e/dtb/bid?src=3019&u=", r += encodeURIComponent(l.document.location), r += "&cb=" + Math.round(1e7 * Math.random());
                        break;
                    case "comscore":
                        r += m ? "sb" : "b", r += ".scorecardresearch.com/beacon";
                        break;
                    case "facebook":
                        d = !0, r += "connect.facebook.net/en_US/sdk", u.development && (r += "/debug"), t && (a(t, "fbAsyncInit"), t = null);
                        break;
                    case "foodity-basket":
                        r += "service.foodity.com/foodity";
                        break;
                    case "universal-analytics":
                        l.GoogleAnalyticsObject = "ga", l.ga = l.ga || function() {
                            (l.ga.q = l.ga.q || []).push(arguments)
                        }, l.ga.l = 1 * new Date, r = "//www.google-analytics.com/analytics";
                        break;
                    case "google":
                        d = !0, r += "apis.google.com/js/client.js", o = !1, t && (r += "?onload=" + a(t), t = null);
                        break;
                    case "google-plus-one":
                        r += "apis.google.com/js/plusone.js", o = !1, t && (r += "?onload=" + a(t), t = null);
                        break;
                    case "tapstream":
                        r += "cdn.tapstream.com/static/js/tapstream";
                        break;
                    case "google-tag":
                        r += "www.googletagservices.com/tag/js/gpt_mobile";
                        break;
                    case "mixpanel":
                        r += "cdn.mxpnl.com/libs/mixpanel-" + p.mixpanel.version + ".min";
                        break;
                    case "optimizely":
                        r += "cdn.optimizely.com/js/" + n;
                        break;
                    case "pinterest":
                        r += "assets.pinterest.com/js/pinit";
                        break;
                    case "roost":
                        l._roost = l._roost || [
                            ["appkey", "081fd32895e64d309f9d982fb38899c4"]
                        ], r += "cdn.goroost.com/js/roost";
                        break;
                    case "stumbleupon":
                        r += "platform.stumbleupon.com/1/widgets";
                        break;
                    case "twitter":
                        r += "platform.twitter.com/widgets";
                        break;
                    case "yieldbot":
                        r += "cdn.yldbt.com/js/yieldbot.intent";
                        break;
                    case "webspectator":
                        r += "scripts.webspectator.com/ws-B9008435";
                        break;
                    case "kahuna":
                        r += "tap-nexus.appspot.com/js/sdk/kahunaAPI_min";
                        break;
                    case "urx-omnilinks":
                        r += "static.urx.io/omnilinks-latest"
                }
                "//" !== r && (o && (r += ".js"), d ? r = "https:" + r : s && (r = "http:" + r), c.ajaxSetup({
                    cache: !0
                }), c.getScript(r).done(function(i, a, r) {
                    "success" === a ? ("optimizely" === e && (e += " project " + n), f.log("loaded", e), t && t()) : f.error(r.status + " " + a, e)
                }).fail(function(n, i, a) {
                    f.error(n.status + " " + a, e), t && t(a)
                }))
            }

            function o() {
                var e, t, n = u.enabledFeatures.indexOf("use-deep-linking") > -1,
                    i = u.enabledFeatures.indexOf("use-deferred-deep-linking") > -1,
                    a = c("meta"),
                    r = l.navigator.userAgent,
                    o = /iPa/.test(r),
                    s = !o && /iP[ho]/.test(r),
                    d = /Android/.test(r),
                    p = u.strings.ads.app.track.click,
                    f = "";
                if (n || !i) {
                    if (o) e = a.filter('[name="twitter:app:id:ipad"]').attr("content"), t = a.filter('[name="twitter:app:url:ipad"]').attr("content");
                    else if (s) e = a.filter('[name="twitter:app:id:iphone"]').attr("content"), t = a.filter('[name="twitter:app:url:iphone"]').attr("content");
                    else {
                        if (!d) return;
                        e = a.filter('[name="twitter:app:id:googleplay"]').attr("content"), t = a.filter('[name="twitter:app:url:googleplay"]').attr("content")
                    }
                    e && t && (n && (f = "?deeplink=" + encodeURIComponent(t)), i && (f += (f ? "&" : "?") + "appurl=" + encodeURIComponent(t))), c("#mobile-promo-overlay a").attr("href", h.isFirstPageview() ? p + f : p + "2" + f).data("appid", e), c(".experiment-activation-mobile-banner a").each(function(t, n) {
                        c(n).attr("href", c(n).attr("href") + f).data("appid", e)
                    })
                }
            }

            function s(e, t) {
                if (e) n("./" + e + "/init")(function(n) {
                    f.log("initialized", e), t(n)
                });
                else {
                    if (o(), !l.$omnilinks && u.enabledFeatures.indexOf("urx-automatic-redirect") > -1) return void r("urx-omnilinks", function() {
                        try {
                            l.localStorage.supported = !0, l.$omnilinks.launch({
                                app_not_available_retry_time: 432e5
                            })
                        } catch (e) {} finally {
                            s()
                        }
                    });
                    r("comscore", function() {
                        l.$omnilinks && l.$omnilinks.storage.isAttemptingDeeplink() || ("urb/yum" === u.view ? n("./comscore-distributed")() : n("./comscore")())
                    }), r("universal-analytics", function() {
                        l.$omnilinks && l.$omnilinks.storage.isAttemptingDeeplink() || ("urb/yum" === u.view ? n("./google/external-yum-analytics")() : n("./google/universal-analytics")())
                    }), r("tapstream", function() {
                        n("./tapstream")()
                    }), !(u.enabledFeatures.indexOf("use-optimizely") > -1 && p.optimizely.projects.length) || l.$omnilinks && l.$omnilinks.storage.isAttemptingDeeplink() || c.each(p.optimizely.projects, function(e, t) {
                        r("optimizely", function() {}, t)
                    }), -1 === u.enabledFeatures.indexOf("disable-mixpanel") && s("mixpanel", function() {
                        var e = u.view,
                            t = /^urb\/(?!custom-recipes)/.test(u.view),
                            i = "";
                        l.$omnilinks && l.$omnilinks.storage.isAttemptingDeeplink() || (u.tab && (e += "/" + u.tab), r("kahuna", function() {
                            var a = n("./kahuna"),
                                o = {
                                    "Local Domain": u.locale.domain.base.substr(7),
                                    Platform: "Website App",
                                    "Website View Type": e
                                };
                            r("mixpanel"), d.anonymous ? (o.Anonymous = !0, l.mixpanel.register(o)) : (l.mixpanel.identify(d.email), a.init(d.userName, d.email, d.identities.fb && d.identities.fb.id || null, d.identities.twitter && d.identities.twitter.username, null, d.identities.google && d.identities.google.id || null), a.set({
                                created: d.createDate,
                                email: d.email,
                                emailVerified: d.emailVerified,
                                nameFirst: d.firstName,
                                nameLast: d.lastName,
                                gender: d.isMale ? "male" : d.isFemale ? "female" : "unspecified",
                                userName: d.userName
                            }), d.identities.fb.id ? i = "facebook" : d.identities.google.id ? i = "google" : d.identities.yummly.hasPassword && (i = "email"), o.distinct_id = d.email, o.Anonymous = !1, o.Gender = d.gender, o["Authentication Method"] = i, l.mixpanel.register(o)), m.temp.get("session") || t || (m.temp.set("session", !0), l.mixpanel.track("App Open"), d.anonymous || a.track("Website App Open"))
                        }))
                    }), l.$omnilinks && l.$omnilinks.storage.isAttemptingDeeplink() || r("google-tag", function() {
                        r("yieldbot", function() {
                            r("a9", function() {
                                r("webspectator", function() {
                                    n("../ads").initIabAds()
                                })
                            })
                        })
                    }), !d.anonymous && u.enabledFeatures.indexOf("desktop-notifications") > -1 && r("roost"), "uk" === u.locale.domain.top && r("foodity-basket")
                }
            }
            var l = n("window"),
                c = n("jquery"),
                u = n("yummly"),
                d = u.user,
                p = u.vendors,
                f = n("../utilities/debug"),
                m = n("../utilities/storage"),
                h = n("../utilities/page"),
                g = 0;
            t.deepLink = o, t.load = r, t.init = s
        },
        "forms/keywords.js": function(e, t, n) {
            function i(e, t) {
                var n = {
                    q: e,
                    yv: o.yvCookie
                };
                o.id && (n.userID = o.id), s.ajax({
                    url: "/api/keywords",
                    dataType: "json",
                    data: n,
                    headers: r.locale.headers
                }).done(function(e) {
                    return s.isFunction(t) ? (t(e), void(s.isEmptyObject(e) && s(".ninja-list").remove())) : e
                })
            }

            function a(e, n) {
                /^\s*$/.test(e) || (t.timeout && clearTimeout(t.timeout), t.timeout = setTimeout(function() {
                    i(e, n)
                }, 200))
            }
            var r = n("yummly"),
                o = r.user,
                s = n("jquery");
            t.get = a, t.render = function() {
                s("form.keywords").each(function(e, t) {
                    var n = s(t);
                    n.find('input[name="q"]').ninja("autocomplete", {
                        get: a,
                        select: function() {
                            n.trigger("submit")
                        }
                    })
                })
            }
        },
        "insights/index.js": function(e, t, n) {
            function i(e, t, n, i) {
                var a = c('<div class="y-line hidden">'),
                    r = 180 * Math.atan2(i - t, n - e) / Math.PI;
                a.css({
                    left: e + "px",
                    top: t + "px",
                    transform: "rotate(" + r + "deg)",
                    width: Math.sqrt(Math.pow(e - n, 2) + Math.pow(t - i, 2)) + "px"
                }).appendTo(c(".y-chart-data")), setTimeout(function() {
                    a.removeClass("hidden")
                }, 100)
            }

            function a() {
                if (u.location.hash) {
                    var e = decodeURIComponent(u.location.hash.substr(1)).replace(/-/g, " ").split("~");
                    c(".search-category .y-select-list li").filter(function() {
                        return c(this).text() === e[0]
                    }).click(), c(".search-term .y-select-list li").filter(function() {
                        return c(this).text() === e[1]
                    }).click(), c(".search-region .y-select-list li").filter(function() {
                        return c(this).text() === e[2]
                    }).click()
                }
            }

            function r(e, t) {
                e.empty(), c.each(t, function(t) {
                    e.append(c("<li>" + t + "</li>"))
                }), c(e.children()[0]).click(), e.children().length < 2 ? e.closest(".y-select-list").hide() : e.closest(".y-select-list").show();
            }

            function o(e) {
                return e >= 0 ? Math.min(e, 300) : Math.max(e, -300)
            }

            function s(e) {
                return (e >= 0 ? "+" + Math.max(e, .1).toFixed(1) : Math.min(e, -.1).toFixed(1)) + "%"
            }

            function l(e, t) {
                var n = c(".search-category .y-select-list span").text(),
                    r = c(".search-term .y-select-list span").text(),
                    l = "#" + encodeURIComponent(n.replace(/ /g, "-") + "~" + r.replace(/ /g, "-")),
                    d = 0,
                    p = c(".y-chart-data");
                p.find("li").addClass("visuallyhidden"), p.find(".y-line").remove(), c.each(t, function(t, n) {
                    var i = e[n],
                        a = i >= 0 ? "positive" : "negative",
                        r = o(i),
                        l = s(i);
                    p.find("li").eq(t).length || p.append(c('<li class="y-row-' + a + '"><span class="y-row-label">' + n + '</span><span class="y-row-value" data-value="' + r + '"></span><span class="y-row-bubble">' + l + "</span></li>")), p.find("li").eq(t).removeClass("y-row-positive y-row-negative visuallyhidden").addClass(i >= 0 ? "y-row-positive" : "y-row-negative").find(".y-row-label").text(n).next().data("value", r).next().text(l), d < Math.abs(r) && (d = Math.abs(r))
                }), c.each(p.find(".y-row-value"), function(e, t) {
                    t = c(t);
                    var n = p.hasClass("vertical-bars") ? 200 : 300,
                        a = Math.floor(n * Math.abs(t.data("value")) / d) + "px";
                    if (t.css("width", a), t.data("width", parseInt(a, 10)), t.next().css("margin", "0 " + a), m && e) {
                        var r = t.parent().prev().find(".y-row-value"),
                            o = r.parent().hasClass("y-row-positive"),
                            s = t.parent().hasClass("y-row-positive"),
                            l = r.data("width"),
                            u = t.data("width");
                        i(o ? Math.max(222, l + 212) : Math.min(202, 212 - l), 85 * (e - 1) + 43, s ? Math.max(222, u + 212) : Math.min(202, 212 - u), 85 * e + 43)
                    }
                }), u.location.hash !== l && f.pushState(l, null, a), c(".y-select-list ul").addClass("visuallyhidden"), setTimeout(function() {
                    c(".y-select-list ul").removeClass("visuallyhidden")
                }, 400)
            }
            var c = n("jquery"),
                u = n("window"),
                d = n("yummly"),
                p = n("../forms/fields/select-list"),
                f = n("../utilities/history"),
                m = !!c(".line-graph").length;
            e.exports = function() {
                var e = d.insightsData,
                    t = c(".search-category .y-select-list ul"),
                    n = c(".search-term .y-select-list ul"),
                    i = c(".search-region .y-select-list ul");
                p(), c(".search-category .y-select-list").on("change", function(t, i, a) {
                    r(n, e[a])
                }), c(".search-term .y-select-list").on("change", function(t, n, a) {
                    var o = c(".search-category .y-select-list span").text(),
                        s = a,
                        u = e[o][s],
                        d = Object.keys(u).sort(function(e, t) {
                            return m ? !1 : u[t] - u[e]
                        });
                    d[0] && u[d[0]] && "object" == typeof u[d[0]] ? r(i, u) : l(u, d)
                }), c(".search-region .y-select-list").on("change", function(t, n, i) {
                    var a = c(".search-category .y-select-list span").text(),
                        r = c(".search-term .y-select-list span").text(),
                        o = i,
                        s = e[a][r][o],
                        u = Object.keys(s).sort(function(e, t) {
                            return m ? !1 : s[t] - s[e]
                        });
                    l(s, u)
                }), c.each(e, function(e) {
                    t.append(c("<li>" + e + "</li>"))
                }), u.location.hash ? a() : c(t.children()[0]).click(), c(".y-chart-data li").hover(function() {
                    c(this).css("z-index", 100)
                }, function() {
                    c(this).css("z-index", 0)
                })
            }
        },
        "tools/promoted.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery");
            e.exports = function() {
                a(".tools-content form").on("submit", function(e) {
                    e.preventDefault();
                    var t = a("[name=recipe]").eq(0),
                        n = a.trim(t.val()),
                        r = /.+(unitType=[a-z]+).*/,
                        o = n.match(r) ? "?" + n.match(r)[1] : "",
                        s = n.replace(/\?.+$/, o),
                        l = a.trim(t.closest("label").text()),
                        c = l.replace(/\/recipe\/$/, ""),
                        u = l + s,
                        d = a("[name=thirdPartyImpression]").val(),
                        p = a("[name=thirdPartyClick]").val();
                    s && (a(".tool-output").removeClass("hidden").find("textarea").val("Please wait..."), a.ajax({
                        url: "/tools/proxy?url=" + u,
                        dataType: "text",
                        complete: function(e) {
                            var t = a(e.responseText),
                                n = {
                                    id: s,
                                    image: t.find("#main .image img").attr("src"),
                                    name: t.find(".primary h1").text(),
                                    url: u,
                                    rating: '<span class="y-icon">1</span><span class="y-icon">1</span><span class="y-icon">1</span><span class="y-icon">1</span><span class="empty"><span class="y-icon">1</span></span>',
                                    ingredients: "",
                                    source: {
                                        icon: t.find('[name="ad-logo"]').attr("content") || "",
                                        link: ""
                                    }
                                },
                                r = "",
                                o = "";
                            return t.each(function(e, t) {
                                t = a(t);
                                var n = t.attr("href");
                                return "stylesheet" === t.attr("rel") && /^https?:\/\/.+yummly.css$/.test(n) ? (r = '<link rel="stylesheet" href="' + n + '">', !1) : void 0
                            }), t.each(function(e, t) {
                                var i = 70,
                                    r = a(t),
                                    o = r.attr("content"),
                                    s = 0;
                                if ("yummlyfood:ingredients" === r.attr("property")) {
                                    if (s = n.ingredients.length + o.length, !(i > s)) return n.ingredients += " &hellip;", !1;
                                    n.ingredients.length && (n.ingredients += ", "), n.ingredients += o
                                }
                            }), a(".tool-output textarea").val(""), n.image ? (n.image = n.image.replace("=s730", "=s230-c"), n.name ? (p && (n.url = p + "?" + n.url, c = p + "?" + c), a.each(t.find(".source-name a"), function(e, t) {
                                t = a(t), t.attr("href", "%%CLICK_URL_UNESC%%" + c + t.attr("href")), t.attr("target", "_top"), n.source.link && (n.source.link += " / "), n.source.link += a.trim(t.get(0).outerHTML)
                            }), n.source.icon && (n.source.icon = '<img src="' + n.source.icon + '" height="50" width="50" alt="" data-pin-nopin="true">'), o += '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway:400,700">' + r, o += '<div class="y-grid-card animate compact has-image ad-recipe has-sponsor" id="' + n.id + '" data-id="' + n.id + '" data-type="recipe">  <a class="y-image" target="_top" href="%%CLICK_URL_ESC%%' + n.url + '" data-imagelow="' + n.image.replace(/=sd+/, "=s2") + '" style="background-image: url(http:' + n.image.replace(/=sd+/, "=s2") + ');"><img class="recipe-image" src="' + n.image + '" data-src="' + n.image + '" alt="' + n.name + '" height="320" width="320"><img class="gradient" src="http://s.yumm.ly/yummly-website/124cbc1b3f277e5fb4a514695697ad891b822b98/img/card-gradient.png" height="320" width="320"></a><div class="y-info"><h3 class="y-title"><a target="_top" href="%%CLICK_URL_ESC%%' + n.url + '">' + n.name + '</a></h3><span class="y-source">' + n.source.link + '</span></div><div class="sponsored"><span>Promoted</span></div><div class="sponsored-image"><a target="_top" href="' + n.url + '">' + n.source.icon + "</a></div></div>", d && (d = d.replace(/\[timestamp\]/g, "%%CACHEBUSTER%%"), o += /^http/.test(d) ? '<img src="' + d + '" style="position:absolute;top:0;left:0;width:1px;height:1px;">' : d), void a(".tool-output textarea").val(o)) : i.alert("Unable to parse recipe name.")) : i.alert("Unable to parse recipe image.")
                        }
                    }))
                })
            }
        },
        "utilities/view.js": function(e, t, n) {
            e.exports = function(e) {
                var t = n("./debug"),
                    i = n("yummly").view;
                return i || t.error("Add client.view() to the route file."), n("jquery").isArray(e) ? new RegExp(e.join("|")).test(i) : e ? i === e : i
            }
        },
        "settings/email.js": function(e, t, n) {
            function i() {
                var e = s.ninja.dialog({
                    html: s("#dialog-error-profile").html()
                });
                e.open(), s(".dismiss").on("click", function() {
                    e.close()
                })
            }

            function a() {
                var e = s.ninja.dialog({
                    html: s("#dialog-saved-profile").html()
                });
                e.open(), s(".dismiss").on("click", function() {
                    e.close()
                })
            }
            var r = n("window"),
                o = n("yummly"),
                s = n("jquery");
            e.exports = function() {
                var e = s("#emailNotificationsForm .checkbox input"),
                    t = e.first();
                e.on("change", function() {
                    s(this).is(t) ? e.prop("checked", t.prop("checked")) : t.prop("checked", e.slice(1).filter(":checked").length)
                }), s("#emailNotificationsForm").on("submit", function(t) {
                    t.preventDefault();
                    var n = "";
                    e.each(function(e, t) {
                        t = s(t), t.prop("checked") || (n.length && (n += "&"), n += "email-preference[]=" + t.val())
                    }), r.location.search.indexOf("token=") > -1 && (n.length && (n += "&"), n += "token=" + encodeURIComponent(r.location.search.replace(/.*token=([^&]+).*/, "$1").replace(/%20/g, "+"))), s.ajax({
                        url: "/mapi/v1/user/email-unsubscribe",
                        type: "POST",
                        data: n,
                        headers: o.locale.headers,
                        success: function() {
                            a()
                        },
                        error: function() {
                            i()
                        }
                    })
                })
            }
        },
        "settings/admin.js": function(e, t, n) {
            function i(e) {
                var t = p("#label-href");
                e ? (t.get(0).childNodes[1].nodeValue = f.strings.admin.destination.video, t.find("input").attr("placeholder", f.strings.admin.placeholders.destination.video)) : (t.get(0).childNodes[1].nodeValue = f.strings.admin.destination.link, t.find("input").attr("placeholder", f.strings.admin.placeholders.destination.link))
            }

            function a() {
                p("#easel .slide").each(function(e, t) {
                    p("span", t).html(e + 1), p(t).data("index", e).data("displayindex", e + 1)
                })
            }

            function r() {
                var e = p("#easel"),
                    t = e.find(".slide");
                switch (t.length) {
                    case 0:
                        e.addClass("empty");
                        break;
                    case 5:
                        e.addClass("full");
                        break;
                    default:
                        e.removeClass("empty").removeClass("full")
                }
            }

            function o(e, t) {
                var n = p("#admin-upload-src"),
                    i = p(".dialog-wrapper .image img"),
                    o = p("#label-src .error");
                e.success && e.src ? (n.val(e.src), "edit" === t ? p("#easel .slide img").eq(e.index).attr("src", e.src).parent().data("src", e.src) : (p(".dialog-wrapper .upload-index").val(e.index), p("#easel .slides").append('<div class="slide small" data-src="' + e.src + '" data-href="" data-index="' + e.index + '" data-displayindex="' + (e.index + 1) + '"><img src="' + e.src + '"> <span>' + (e.index + 1) + '</span> <button type="button" class="btn-secondary">' + f.strings.settings.admin.images.button + "</button> </div>"), p("#easel .slide").last().removeClass("small"), a(), r()), i.attr("src", e.src).removeClass("loading")) : (i.attr("src", "/img/1x1.gif").removeClass("loading"), /incorrect size/i.test(e.error) ? o.html(m.settings.admin.images.error.size) : o.html(m.settings.admin.images.error.fail))
            }

            function s(e) {
                var t = p("#admin-upload-src"),
                    n = p(".dialog-wrapper .image img"),
                    i = p("#newImage"),
                    a = p("#label-src .error");
                t.val(""), a.html(""), n.addClass("loading").attr("src", "/img/loading-greyscale.gif"), i.parent("form").ajaxSubmit({
                    dataType: "json",
                    error: function(t) {
                        o({
                            error: t
                        }, e)
                    },
                    success: function(t) {
                        o(t, e)
                    }
                })
            }

            function l(e) {
                var t = p("#easel .slide").eq(e);
                t.css({
                    opacity: .5
                }), p.ajax({
                    type: "post",
                    url: "/settings/admin/delete",
                    data: {
                        index: e
                    },
                    success: function(e) {
                        t.css({
                            opacity: 1
                        }), e = p.parseJSON(e), e && e.success ? (d.dialogUpload.close(), t.addClass("small"), setTimeout(function() {
                            t.remove(), a(), r()
                        }, 400)) : p("#label-src .error").html("Unable to delete image. Please refresh and try again.")
                    },
                    headers: h
                })
            }

            function c(e, t, n, a, r, o) {
                d.dialogUpload = p.ninja.dialog({
                    html: p("#dialog-admin-upload").html()
                }), d.dialogUpload.open(), p(".dialog-wrapper").addClass(e || "add");
                var c = p("#admin-upload-src"),
                    u = p("#admin-upload-href"),
                    f = p(".dialog-wrapper .image img"),
                    m = p(".dialog-wrapper .media-type"),
                    g = p("#newImage");
                f.attr("src", a || "/img/1x1.gif"), c.val(a || ""), u.val(r || o || ""), m.val(o ? 1 : 0), i(o), p(".upload-type").val(e), p(".upload-index").val(t), p(".image-number").html(n), g.on("change", function() {
                    var t = this.value || "";
                    if (t) {
                        if (t.indexOf("\\") > -1 && (t = t.replace(/.+\\([^\\]+)/, "$1")), !/\.(jpe?g|png)$/i.test(t)) return p("#label-src .error").html("Image must be a JPG or PNG");
                        if (d.URL) {
                            var n, i = this.files[0];
                            i && (n = new d.Image, n.onload = function() {
                                return 980 !== this.width || 424 !== this.height ? p("#label-src .error").html("Upload an image 980px wide by 424px high") : void s(e)
                            }, n.src = d.URL.createObjectURL(i))
                        } else s(e)
                    }
                }), p(".dialog-wrapper .btn-primary").on("click", function() {
                    var e = p(".dialog-wrapper .upload-index").val(),
                        t = p("#admin-upload-src").val(),
                        n = p("#admin-upload-href").val(),
                        i = p(".dialog-wrapper").hasClass("add"),
                        a = i ? m.eq(0).find(":selected").index() : m.eq(1).find(":selected").index();
                    return t ? n ? (/https?:\/\//i.test(n) || (n = "http://" + n), p("#label-href .error").html(""), void p.ajax({
                        type: "post",
                        url: "/settings/admin/update",
                        data: {
                            index: e,
                            href: n,
                            type: a
                        },
                        success: function(t) {
                            t = p.parseJSON(t), t && t.success && t.field ? (p("#easel .slide").eq(e).data(t.field, n), d.dialogUpload.close()) : p("#label-href .error").html("Unknown error. Please refresh and try again.")
                        },
                        headers: h
                    })) : p("#label-href .error").html("Add a link destination for your image") : p("#label-src .error").html("Upload an image 980px wide by 424px high")
                }), p(".delete-image").on("click", function() {
                    l(p(".dialog-wrapper .upload-index").val())
                }), p(".dismiss").on("click", function() {
                    d.dialogUpload.close()
                }), p(".dismiss, .ninja-screen").on("mouseup", function() {
                    p(".dialog-wrapper.add").length && p("#admin-upload-src").val() && l(p(".image-number").text() - 1)
                }), m.on("change", function() {
                    i(parseInt(p(this).find(":selected").val(), 10))
                })
            }

            function u() {
                p.ajax({
                    url: "/mapi/v1/user-attribute/" + f.user.encoded.userName,
                    success: function(e) {
                        var t = e && e["user-featured-collection"] && e["user-featured-collection"].value;
                        t ? p(".my-collections").val(t) : p(".my-collections option").first().prop("selected", !0)
                    },
                    headers: h
                })
            }
            var d = n("window"),
                p = n("jquery"),
                f = n("yummly"),
                m = f.strings,
                h = f.locale.headers;
            e.exports = function() {
                u(), p("#enable-slideshow input").on("click", function() {
                    p("#easel").toggleClass("disabled", !this.checked)
                }), p(".add-image button").on("click", function() {
                    c("add", -1, p("#easel .slide").length + 1)
                }), p("#easel").delegate(".slide button", "click", function() {
                    var e = p(this).parent(".slide");
                    c("edit", e.data("index"), e.data("displayindex"), e.data("src"), e.data("href"), e.data("video"))
                }), p("#saveChangesImages").on("click", function(e) {
                    e.preventDefault();
                    var t = p("#enable-slideshow input").prop("checked") ? ["user-has-featured-tab", "user-has-slideshow"] : [];
                    p.ajax({
                        type: "post",
                        url: "/mapi/v1/user-settings/" + f.user.encoded.userName,
                        data: {
                            "user-property": t
                        },
                        cache: !1,
                        timeout: 2e3,
                        success: function() {
                            d.dialogSuccess = p.ninja.dialog({
                                html: p("#dialog-saved-profile").html()
                            }), d.dialogSuccess.open(), p("#close-dialog-taste, .dismiss").on("click", function() {
                                d.dialogSuccess.close()
                            })
                        },
                        error: function() {
                            d.alert("Unknown error. Please refresh and try again.")
                        },
                        headers: h
                    })
                }), p("#easel .slide").each(function(e, t) {
                    var n = p(t),
                        i = n.data("src"),
                        a = n.data("href") || n.data("video");
                    i && a || n.addClass("error")
                }), p("#saveChangesRecipes").on("click", function() {
                    var e = p(".my-collections").val();
                    h["x-yummly-auth-type"] = "yummly", h["x-yummly-auth-token"] = p.cookie("au"), p.ajax({
                        type: e ? "post" : "delete",
                        url: "/mapi/v1/user-attribute/user-featured-collection/attribute",
                        data: e ? {
                            value: p(".my-collections").val()
                        } : {},
                        headers: h,
                        cache: !1,
                        timeout: 2e3,
                        success: function() {
                            d.dialogSuccess = p.ninja.dialog({
                                html: p("#dialog-saved-profile").html()
                            }), d.dialogSuccess.open(), p("#close-dialog-taste, .dismiss").on("click", function() {
                                d.dialogSuccess.close()
                            })
                        },
                        error: function() {
                            d.alert("Unknown error. Please refresh and try again.")
                        }
                    })
                })
            }
        },
        "search/phrases.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i(".phrases-more").on("click", function() {
                    i(this).siblings(".visuallyhidden").children().appendTo(i(this).siblings(".anchor-list").eq(0)), i(this).detach()
                })
            }
        },
        "utilities/page.js": function(e, t, n) {
            var i = n("window"),
                a = n("./storage"),
                r = a.temp.get("landing-page"),
                o = !r,
                s = i.location.pathname + i.location.search;
            o && (r = a.temp.set("landing-page", s)), e.exports.isFirstPageview = function() {
                return o || r === s
            }, e.exports.landing = function() {
                return r
            }, e.exports.current = function() {
                return s
            }
        },
        "profile-search.js": function(e, t, n) {
            function i() {
                return l[Math.floor(Math.random() * l.length)]
            }
            var a = n("jquery"),
                r = n("./utilities/width").width,
                o = n("yummly"),
                s = o.strings,
                l = [s.messages.sheets.random1, s.messages.sheets.random2, s.messages.sheets.random3, s.messages.sheets.random4],
                c = a("#profile-tabs"),
                u = a(".profile-search"),
                d = u.find("input[type=text]"),
                p = a('<span class="loading-message">').append(a(".loading-image").first().show());
            e.exports = function() {
                function e(e) {
                    if (r() < 790 && !d.val() && !c.hasClass("show-search")) return e.preventDefault(), t(), !1;
                    var n = p.clone().append(i());
                    a.ninja.dialog({
                        html: n
                    }).open()
                }

                function t() {
                    c.toggleClass("show-search"), c.hasClass("show-search") || d.val("")
                }
                d.val() && r() < 790 && c.addClass("show-search"), u.find(".submit").on("click", e), u.find("form").on("submit", e), u.find(".inset").on("click", t), o.query.pq && !a(".y-grid-card").length && a(".results-message").show()
            }
        },
        "locale/redirect.js": function(e, t, n) {
            function i() {
                var e = a(a.parseHTML(a("#yummlyDomainRedirectTemplate").html())),
                    t = a.ninja.dialog({
                        html: e
                    });
                e.find(".ninja-close-dialog").on("click", function(e) {
                    e.preventDefault(), a.cookie("yummlyDomainPreventRedirect", "true", {
                        expires: 30,
                        path: "/"
                    }), t.close(), "dismissed" !== a.cookie("yLogin") && n("../sheet").open({
                        type: "sheet",
                        content: a("#shared-login-content").html(),
                        dismiss: function() {
                            var e = new Date,
                                t = 60;
                            e.setTime(e.getTime() + 60 * t * 1e3), a.cookie("yLogin", "dismissed", {
                                expires: e,
                                path: "/"
                            })
                        },
                        fn: n("../user/buttons"),
                        event: e
                    })
                }), t.open()
            }
            var a = n("jquery");
            e.exports = function() {
                "true" !== a.cookie("yummlyDomainPreventRedirect") && i()
            }
        },
        "vendors/buttons.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("../utilities/debug"),
                o = n("../utilities/view"),
                s = n("."),
                l = n("./facebook/like"),
                c = n("./facebook/comments");
            s.load("pinterest", function() {
                var e = a(".pin-wrap a"),
                    t = e.attr("href");
                t && e.attr("href", t.replace(/(media=http%3A%2F%2Fgraph.facebook.com%2F[^%]+%2Fpicture)&/, "$1%3Fheight%3D200%26width%3D200&"))
            }), o("scoreboard") || s.load("stumbleupon", function() {
                r.log("ignore post error", "stumbleupon")
            }), s.load("twitter"), e.exports = function() {
                o("recipe/recipe") && (s.load("google-plus-one"), a(i.document).on("facebook:ready", function() {
                    l(), c()
                })), o(["page", "profile/collections/index", "profile/recipes", "scoreboard", "urb/grab"]) && a(i.document).on("facebook:ready", function() {
                    l(), a(".share-social-popup").ninja("popup", {
                        html: a("#share-social-popup-content").html()
                    })
                }), a(".application-body").scroll(function() {
                    a(".ninja-popup .social").length && a(".share-social-popup").click(), a("#foodity-stores").length && a("#foodity-stores").remove()
                }), a(".social-share [data-popup]").on("click", function(e) {
                    var t = a(this),
                        n = t.data("width"),
                        r = t.data("height");
                    return n && r ? (e.preventDefault(), i.open(t.attr("href"), "", "scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=" + n + ",height=" + r + ",left=" + Math.round(i.screen.width / 2 - n / 2) + ",top=" + Math.round(i.screen.height / 2 - r / 2)), !1) : void 0
                }), a("[data-action]").on("click", function(e) {
                    var t = a(this),
                        n = t.data("action"),
                        i = !0;
                    switch (n) {
                        case "pinmarklet":
                            a(".y-image img").each(function() {
                                a(this).attr("src", a(this).attr("src").replace(/s\d{3}-c/, "s730-c"))
                            }), a('<script src="//assets.pinterest.com/js/pinmarklet.js?r=' + 99999999 * Math.random() + '"></script>').appendTo("body");
                            break;
                        default:
                            i = !1
                    }
                    return i ? (e.preventDefault(), !1) : void 0
                })
            }
        },
        "utilities/track.js": function(e, t, n) {
            function i() {
                var e, t;
                e = c.numColumns(), t = c.numRows(), e && e !== 1 / 0 && t && t !== 1 / 0 && p.data("columns", e).data("rows", t)
            }

            function a() {
                i(), d(g).each(function(e, t) {
                    var n, i, a = d(t),
                        r = a.data("id"),
                        s = r || a.attr("id"),
                        c = r ? "[data-id=" + r.replace(/([^\w])/g, "\\$1") + "]" : "#" + s,
                        p = d("#cards").data("columns") || d("#sidebar").data("columns"),
                        v = encodeURIComponent(a.data("position") || 1 + a.index(g) + "/" + d(g).length),
                        y = s + "?columns=" + p + "&position=" + v,
                        b = d(o).height(),
                        x = 100;
                    s && !f[[s, p, v].join("~")] && (n = t.getBoundingClientRect(), i = (n.top + n.bottom) / 2, u && i >= 0 && b >= i && (h.push(y), m.push({
                        col: p,
                        pos: v
                    })), (n.bottom >= -x && n.bottom < b + x || n.top >= -x && n.top <= b + x) && l(d(c + " .postload")))
                }), h.length && (clearTimeout(r), r = setTimeout(function() {
                    d.ajax({
                        url: "/api/recommendation/sendBatchTrackingEvent",
                        method: "POST",
                        cache: !1,
                        data: {
                            session: o.JSON.stringify({
                                action: "view",
                                time_stamp: (new Date).getTime(),
                                yv: s.user.yvCookie,
                                username: s.user.userName,
                                current_url: s.user.current_url,
                                previous_url: s.user.previous_url
                            }),
                            data: '[{"recipe_url":"' + h.join('"},{"recipe_url":"') + '"}]'
                        },
                        success: function() {
                            d.each(h, function(e, t) {
                                f[[t.split("?")[0], m[e].col, m[e].pos].join("~")] = !0
                            }), h = [], m = []
                        }
                    })
                }, 1e3))
            }
            var r, o = n("window"),
                s = n("yummly"),
                l = n("../utilities/postload"),
                c = n("../utilities/width"),
                u = s.enabledFeatures.indexOf("track-card-viewability") > -1,
                d = n("jquery"),
                p = d(d("#cards").length ? "#cards" : "#sidebar"),
                f = {},
                m = [],
                h = [],
                g = ".y-card, .y-grid-card";
            t.viewability = function() {
                i(), d(o).on("debouncedresize", a), d(o.document).add(".application-body").on("debouncedscroll", a), a()
            }
        },
        "recipe/external.js": function(e, t, n) {
            var i = n("../utilities/width"),
                a = n("window"),
                r = n("jquery");
            e.exports = function() {
                var e = r("#yFrame");
                r("#info-button").ninja("popup", {
                    html: r("#info-popup").html()
                }), e.length && !i.large() && (a.location = e.attr("src"))
            }
        },
        "utilities/width.js": function(e, t, n) {
            function i() {
                return c.height()
            }

            function a() {
                return c.width()
            }

            function r() {
                return a() < u.small
            }

            function o() {
                return !r() && a() < u.medium
            }
            var s = n("window"),
                l = n("jquery"),
                c = l(s),
                u = {
                    small: 768,
                    medium: 992
                };
            e.exports = {
                height: i,
                width: a,
                small: r,
                medium: o,
                large: function() {
                    return !r() && !o()
                },
                supportsOnboarding: function() {
                    return a() >= 860 && i() >= 680
                },
                numColumns: function() {
                    var e = l(".y-card, .y-grid-card"),
                        t = e.first(),
                        n = t.parent(),
                        i = t.hasClass("y-card") ? "floor" : "round";
                    return e.length ? Math[i](n.width() / t.outerWidth(!0)) : 0
                },
                numRows: function() {
                    var e = l(".y-card, .y-grid-card"),
                        t = e.first(),
                        n = t.parent(),
                        i = t.hasClass("y-card") ? "floor" : "round";
                    return e.length ? Math[i](n.height() / t.outerHeight(!0)) : 0
                }
            }
        },
        "recipe/truncate.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly"),
                r = n("jquery");
            e.exports = function() {
                var e = r(".y-ingredients"),
                    t = a.enabledFeatures.indexOf("target-blank") > -1;
                e.unbind("mouseup").on("mouseup", function(e) {
                    var n = r(this).closest(".y-card, .y-grid-card"),
                        a = n.find("a").first();
                    a.mousedown(), t || e.metaKey || 2 === e.which ? i.open(a.attr("href"), "_blank") : i.location = a.attr("href")
                })
            }
        },
        "utilities/debug.js": function(e, t, n) {
            function i(e, t, n) {
                if (o.development || o.query.debug) {
                    var i = "";
                    n && (i += n + ": "), i += t, r && r[e] ? "dir" === e ? r.dir(t) : a.chrome && /(info|log)/.test(e) ? r[e]("%c" + i, "color:#aaa") : r[e](i) : a.alert(i)
                }
            }
            var a = n("window"),
                r = a.console,
                o = n("yummly");
            t.dir = function(e) {
                i("dir", e)
            }, t.error = function(e, t) {
                i("error", e, t)
            }, t.group = function(e) {
                i("group", e)
            }, t.groupEnd = function() {
                i("groupEnd")
            }, t.info = function(e, t) {
                i("info", e, t)
            }, t.log = function(e, t) {
                i("log", e, t)
            }, t.warn = function(e, t) {
                i("warn", e, t)
            }
        },
        "experiments/dde.js": function(e, t, n) {},
        "vendors/comscore.js": function(e, t, n) {
            var i = n("window"),
                a = n("../../utilities/debug");
            e.exports = function() {
                if (i.COMSCORE && i.COMSCORE.beacon) {
                    var e = 14761013,
                        t = {
                            beacon: i.COMSCORE.beacon,
                            options: i._comscore
                        };
                    t.options.push({
                        c1: 2,
                        c2: e
                    }), t.beacon({
                        c2: e,
                        c4: n("yummly").view
                    }), a.log("page view", "comscore")
                }
            }
        },
        "profile/urb/grab.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("../../vendors/kahuna");
            e.exports = function() {
                a(".how-to").on("click", function() {
                    a(".how-to-dropdown").toggleClass("hide-dropdown")
                }), a(".yummly-badge").mousedown(function() {
                    i.mixpanel && (r.track("Bookmarklet Install"), i.mixpanel.track("Bookmarklet Install"))
                }), a(".yummly-badge").on("click", function(e) {
                    e.preventDefault()
                }), a(".yummly-badge").on("dragstart", function(e) {
                    var t = i.document.createElement("img");
                    t.src = "img/urb/yumlet-badge.png", e.originalEvent.dataTransfer.setDragImage(t, 1, 1)
                })
            }
        },
        "profile/urb/yums.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window");
            e.exports = function() {
                function e() {
                    var e = a.location.search + "&yumtype=button",
                        t = a.location.origin + "/urb/verify" + e,
                        n = "Verify",
                        i = a.screen.width,
                        r = a.screen.height,
                        o = i >= 480 ? "600" : 320,
                        s = i >= 480 ? "530" : 500,
                        l = Math.round(i / 2 - o / 2),
                        c = Math.round(r / 2 - s / 2),
                        u = "scrollbars=yes,resizable=yes,toolbar=no,location=yes";
                    return u += ",width=" + o + ",height=" + s + ",left=" + l + ",top=" + c, a.open(t, n, u)
                }
                i(".not-yum").on("click", function() {
                    e()
                })
            }
        },
        "settings/profile.js": function(e, t, n) {
            function i(e, t, i) {
                var s = !e || "success" === e,
                    l = r("#dialog-saved-profile").html(),
                    c = r.ninja.dialog({
                        html: s ? l : l.replace(o.strings.profile.saved.message, o.strings.forms.errors.internal).replace(o.strings.profile.saved.title, o.strings.errors.title)
                    });
                e && s ? n("../sheet").open({
                    type: "message",
                    content: {
                        header: "<h1>" + t + "</h1>",
                        body: i,
                        button: o.strings.admin.buttons.done
                    }
                }) : (c.open(), r("#close-dialog-taste, .dismiss").on("click", function() {
                    c.close(), s && a.location.reload(!0)
                }))
            }
            var a = n("window"),
                r = n("jquery"),
                o = n("yummly"),
                s = o.strings;
            e.exports = function() {
                function e(e) {
                    var t = /[@#$%\^&*\/:?\s<>]/;
                    return e ? !t.test(e) : !0
                }

                function t(e) {
                    var t = /[\-@#$%\^&*\/:?.\s<>]/;
                    return e ? !t.test(e) : !0
                }

                function n(n) {
                    n.firstName || (r("#firstName").addClass("alert"), 0 === r("#firstNameAlert").length && r('[for="firstName"]').text("").append('<span id="firstNameAlert" class="alert">' + s.settings.profile.error.fname + "</span>")), n.lastName || (r("#lastName").addClass("alert"), 0 === r("#lastNameAlert").length && r('[for="lastName"]').text("").append('<span id="lastNameAlert" class="alert">' + s.settings.profile.error.lname + "</span>")), t(n.twitterName) ? r('[for="twitterName"]').text("Twitter") : (r("#twitterName").addClass("alert"), r('[for="twitterName"]').text("").append('<span class="alert">' + s.settings.profile.error.twitter + "</span>")), t(n.pinterestUserName) ? r('[for="pinterestUserName"]').text("Pinterest") : (r("#pinterestUserName").addClass("alert"), r('[for="pinterestUserName"]').text("").append('<span class="alert">' + s.settings.profile.error.pin + "</span>")), e(n.facebookUsername) ? r('[for="facebookUsername"]').text("Facebook") : (r("#facebookUsername").addClass("alert"), r('[for="facebookUsername"]').text("").append('<span class="alert">' + s.settings.profile.error.fb + "</span>"))
                }

                function l() {
                    S.input.val(""), S.message.text("")
                }

                function c(e) {
                    return "image/png" === e || "image/gif" === e || "image/bmp" === e || "image/jpg" === e || "image/jpeg" === e
                }

                function u(e) {
                    S.imgPlaceholder.attr("src", e.target.currentSrc), S.imgPlaceholder.removeClass("anonymous"), N.picture.off("load")
                }

                function d(e, t, n) {
                    var i = e.val(),
                        a = i.length;
                    return 0 > t - a ? n.html(C) : n.html(k.replace("%s", t - a)), a > t ? (e.val(i.substr(0, t)), !1) : !0
                }

                function p(e, t, n) {
                    var i = e.val(),
                        a = i.length;
                    0 > n - a ? t.html(C) : v.html(k.replace("%s", n - a))
                }

                function f(e, t, n) {
                    e.keyup(function(i) {
                        i.preventDefault(), d(e, t, n)
                    }), p(e, n, t)
                }
                r("#saveChanges").on("click", function(a) {
                    function s(e) {
                        var t = parseInt(u.find('[name="' + e + '"]').val() || "", 10);
                        return isNaN(t) || 0 > t ? "" : t
                    }
                    a.preventDefault();
                    var l, c, u = r("#profileForm"),
                        d = {},
                        p = function(e) {
                            return u.find('[name="' + e + '"]').val()
                        },
                        f = function(e) {
                            return u.find('[name="' + e + '"]:checked').val()
                        },
                        m = ["fb-sharing-preference", "privacy-preference", "search-index-preference"];
                    r("#new-password, #current-password").addClass("visuallyhidden"), r("#user-password").removeClass("visuallyhidden"), d.firstName = p("firstName"), d.lastName = p("lastName"), d.gender = p("gender"), d.city = p("city"), d.region = p("region"), d.countryCode = "--" === p("country") ? null : p("country"), d.twitterName = p("twitterName"), d.pinterestUserName = p("pinterestUserName"), d.facebookUsername = p("facebookUsername"), d.description = p("description"), d.website = "http://" === p("website") ? null : p("website"), d.website && "http://" !== d.website.slice(0, 7) && (d.website = "http://" + d.website), r.each(m, function(e, t) {
                        c = f(t), l = p(t), "search-index-preference" === t ? void 0 === c && (d[t] = [l]) : void 0 !== c && (d[t] = [c])
                    }), d.firstName && d.lastName && t(d.twitterName) && t(d.pinterestUserName) && e(d.facebookUsername) ? r.ajax({
                        url: "/api/profile/me",
                        type: "POST",
                        cache: !1,
                        timeout: 2e3,
                        data: d,
                        error: function(e, t, n) {
                            r.ninja.log("set user profile info error " + n)
                        },
                        success: function() {
                            var e = {
                                age: s("age"),
                                "gender-preference": u.find('[name="gender-preference"]:checked').val() || "",
                                "household-size-adults": s("household-adults"),
                                "household-size-children": s("household-kids"),
                                "allergy-preference": o.user.attributes["allergy-preference"] || [],
                                "cooking-skill": (o.user.attributes["cooking-skill"] || [])[0] || "",
                                "cuisine-preference": o.user.attributes["cuisine-preference"] || [],
                                "diet-preference": o.user.attributes["diet-preference"] || [],
                                dislikedIng: o.user.dislikes || []
                            };
                            r.ajax({
                                url: "/api/taste/me",
                                type: "POST",
                                cache: !1,
                                timeout: 2e3,
                                data: e,
                                error: function(e, t, n) {
                                    r.ninja.log("set user taste info error " + n)
                                },
                                success: i,
                                headers: o.locale.headers
                            })
                        },
                        headers: o.locale.headers
                    }) : n(d)
                });
                var m = r("#description"),
                    h = r("#lastName"),
                    g = r("#firstName"),
                    v = r("#desc-char-count"),
                    y = r("#ln-char-count"),
                    b = r("#fn-char-count"),
                    x = 250,
                    w = 35,
                    k = s.forms.errors.characters,
                    C = k.replace("%s", "0"),
                    j = {
                        button: r("#user-password"),
                        currentWrapper: r("#current-password"),
                        inputWrapper: r("#new-password")
                    },
                    T = {
                        button: r("#user-email"),
                        currentWrapper: r("#user-email").prev().find("em"),
                        inputWrapper: r("#new-email")
                    },
                    S = {
                        imgPlaceholder: r("#profile-image-placeholder").find("img"),
                        button: r("#edit-photo"),
                        input: r("#new-picture"),
                        message: r("#new-picture-message")
                    },
                    N = {
                        picture: r("#menu-user").find(".profile-picture")
                    },
                    E = r('<span class="loading-message">').append(r(".loading-image").first().show()).append(o.strings.profile.image.uploading),
                    D = r.ninja.dialog({
                        html: E
                    });
                T.input = T.inputWrapper.find("input"), T.cancel = T.inputWrapper.find(".btn-secondary"), T.save = T.inputWrapper.find(".btn-tertiary"), T.button.on("click", function() {
                    T.cancel.click(), T.input.focus()
                }), T.cancel.on("click", function() {
                    T.input.val(""), T.button.toggleClass("visuallyhidden"), T.inputWrapper.toggleClass("visuallyhidden").find("label").removeClass("error").find(".message").text("")
                }), T.save.on("click", function() {
                    var e = T.currentWrapper.text(),
                        t = T.input.val(),
                        n = o.strings;
                    T.inputWrapper.find("label").removeClass("error").find(".message").text(""), t && t !== e ? /^.+@.+\..+$/.test(t) ? r.ajax({
                        url: "/mapi/v1/user/update-email",
                        method: "POST",
                        data: {
                            email: t
                        },
                        headers: {
                            "X-Yummly-Auth-Token": encodeURIComponent(r.cookie("au"))
                        },
                        complete: function(e, a) {
                            if (401 === e.status) T.inputWrapper.find("label").addClass("error").find(".message").text(n.forms.errors.taken);
                            else if (500 === e.status) T.inputWrapper.find("label").addClass("error").find(".message").text(n.forms.errors.internal);
                            else if ("success" === a) {
                                var s = o.strings.profile.saved.title,
                                    l = o.strings.profile.saved.messageConfirmation.replace("%s", t);
                                r("#profileForm label em").eq(0).text(t), T.cancel.click(), i(a, s, l)
                            } else T.inputWrapper.find("label").addClass("error").find(".message").text(n.forms.errors.internal)
                        }
                    }) : T.inputWrapper.find("label").addClass("error").find(".message").text(n.validate.valid_email) : T.cancel.click()
                }), S.imgPlaceholder.hasClass("anonymous") && N.picture.on("load", u), S.button.on("click", function() {
                    S.input.click()
                }), S.input.on("change", function(e) {
                    if (S.message.text(""), 1 === e.target.files.length) {
                        var t = e.target.files[0],
                            n = new a.FormData,
                            i = t.type,
                            s = t.size;
                        n.append("imageData", t), c(i) && 10485760 > s ? r.ajax({
                            url: "/mapi/v1/user/profile-image",
                            method: "PUT",
                            headers: {
                                "X-Yummly-Auth-Token": encodeURIComponent(r.cookie("au"))
                            },
                            beforeSend: function() {
                                D.open()
                            },
                            success: function(e) {
                                S.imgPlaceholder.attr("src", e.imageUrl), N.picture.attr("src", e.imageUrl), l()
                            },
                            error: function() {
                                S.message.text(o.strings.profile.image.uploadFailed)
                            },
                            complete: function() {
                                D.close()
                            },
                            data: n,
                            cache: !1,
                            contentType: !1,
                            processData: !1
                        }) : S.message.text(o.strings.profile.image.typeOrSizeViolation)
                    }
                }), j.input = j.inputWrapper.find("input"), j.cancel = j.inputWrapper.find(".btn-secondary"), j.save = j.inputWrapper.find(".btn-tertiary"), j.toggle = r("#primary .toggle"), j.button.on("click", function() {
                    j.button.data("value") ? (j.currentWrapper.toggleClass("visuallyhidden").find("input").attr("placeholder", o.strings.forms.fields.passwordCurrent).focus(), j.input.attr("placeholder", o.strings.forms.fields.passwordNew)) : j.input.focus(), j.button.toggleClass("visuallyhidden"), j.inputWrapper.toggleClass("visuallyhidden")
                }), j.cancel.on("click", function() {
                    j.button.data("value") && j.currentWrapper.toggleClass("visuallyhidden").find("input").val("").attr("type", "password"), j.input.val("").attr("type", "password"), j.inputWrapper.toggleClass("visuallyhidden"), j.button.toggleClass("visuallyhidden"), j.toggle.text(o.strings.forms.actions.show), j.inputWrapper.find("label").removeClass("error").find(".message").text(""), j.currentWrapper.find("label").removeClass("error").find(".message").text("")
                }), j.save.on("click", function() {
                    var e = j.currentWrapper.find("input").val(),
                        t = j.input.val(),
                        n = j.input.closest("label");
                    n.removeClass("error").find(".message").text(""), t.length < 6 ? n.addClass("error").find(".message").text(o.strings.validate.min_length.replace("%s", o.strings.forms.fields.password).replace("%s", "6")) : (r.ajax({
                        url: "/mapi/v1/user/update-password",
                        method: "POST",
                        data: {
                            cookie: !0,
                            "current-password": e,
                            "new-password": t
                        },
                        headers: {
                            "X-Yummly-Auth-Token": encodeURIComponent(r.cookie("au"))
                        },
                        complete: function(e, t) {
                            if (401 === e.status) j.button.click(), j.currentWrapper.find("label").addClass("error").find(".message").text(o.strings.forms.errors.unauthorizedCurrentPassword), j.currentWrapper.find("input").focus();
                            else try {
                                var n = r.parseJSON(e.responseText);
                                r.cookie("au", n.access_token, {
                                    expires: n.expires,
                                    path: "/"
                                })
                            } catch (a) {} finally {
                                if ("success" === t) {
                                    var s = !!j.button.data("value"),
                                        l = o.strings.forms.successes[s ? "changed" : "added"].title,
                                        c = o.strings.forms.successes[s ? "changed" : "added"].body;
                                    i(t, l, c), j.button.data("value", 1), j.button.val(o.strings.settings.profile.password.change)
                                }
                            }
                        }
                    }), j.cancel.click())
                }), j.toggle.on("click", function() {
                    var e = r(this).closest("label"),
                        t = e.find("input");
                    "password" === t.attr("type") ? (t.attr("type", "text"), r(this).text(o.strings.forms.actions.hide)) : (t.attr("type", "password"), r(this).text(o.strings.forms.actions.show)), t.focus()
                }), r("#deactivateAccount").on("click", function() {
                    var e = r.parseHTML(r("#dialog-settings-deactivate").html()),
                        t = r(e),
                        n = t.find(".dialog-content"),
                        i = r.ninja.dialog({
                            html: t
                        });
                    t.find(".ninja-close-dialog, .dialog-cancel").unbind("click").on("click", function(e) {
                        e.preventDefault(), i.close()
                    }), t.find(".dialog-submit").unbind("click").on("click", function() {
                        var e = "";
                        a.location.search.indexOf("token=") > -1 && (e = "token=" + encodeURIComponent(a.location.search.replace(/.*token=([^&]+).*/, "$1"))), r.ajax({
                            url: "/mapi/v1/user/deactivate-account",
                            type: "POST",
                            cache: !1,
                            timeout: 3e4,
                            data: e,
                            error: function() {
                                n.find("p, span, .dialog-submit").remove(), n.find(".dialog-cancel").text(o.strings.forms.actions.ok), n.prepend("<p>" + o.strings.forms.errors.internal + "</p>")
                            },
                            success: function() {
                                a.location = "/"
                            },
                            headers: o.locale.headers
                        })
                    }), i.open()
                }), f(m, x, v), f(h, w, y), f(g, w, b), o.user && o.user.deactivate && (r("#profileForm").find("input, textarea, button, select").attr("disabled", !0), r("#deactivateAccount").attr("disabled", !1).click())
            }
        },
        "utilities/storage.js": function(e, t, n) {
            var i = n("window"),
                a = function() {
                    var e, t, n = "storage",
                        a = "enabled";
                    try {
                        return i.localStorage.setItem(n, a), i.sessionStorage.setItem(n, a), e = i.localStorage.getItem(n), t = i.sessionStorage.getItem(n), i.localStorage.removeItem(n), i.sessionStorage.removeItem(n), e === t && e === a
                    } catch (r) {
                        return !1
                    }
                }();
            t.temp = {
                set: function(e, t) {
                    return a ? t ? (i.sessionStorage.setItem(e, t), i.sessionStorage.getItem(e)) : i.sessionStorage.removeItem(e) : void 0
                },
                get: function(e) {
                    return a ? i.sessionStorage.getItem(e) : void 0
                }
            }, t.perm = {
                set: function(e, t) {
                    return a ? t ? (i.localStorage.setItem(e, t), i.localStorage.getItem(e)) : i.localStorage.removeItem(e) : void 0
                },
                get: function(e) {
                    return a ? i.localStorage.getItem(e) : void 0
                }
            }
        },
        "utilities/timeago.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i("abbr.timeago").timeago()
            }
        },
        "locale/redirected.js": function(e, t, n) {},
        "forms/fields/name.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("yummly").forms.fields.name;
            e.exports = function(e, t) {
                var n = i.extend(a, t),
                    r = i(e),
                    o = r.find('label[for="' + n.name + '"]');
                return o
            }
        },
        "experiments/index.js": function(e, t, n) {
            var i = n("jquery");
            t.show = function(e) {
                i("#" + e).removeClass("experiment")
            }, t.hide = function(e) {
                i("#" + e).addClass("experiment")
            }, t.activation = n("./activation"), t.dde = n("./dde"), t.revenue = n("./revenue"), t.growth = n("./growth")
        },
        "utilities/history.js": function(e, t, n) {
            var i, a = n("window"),
                r = n("jquery"),
                o = r(".application-body"),
                s = a.location,
                l = s.pathname,
                c = s.search.replace(/(\?|&)max=\d+/g, "");
            a.onpopstate || (a.onpopstate = function(e) {
                e && e.state && e.state.scroll && o.scrollTop(e.state.scroll), r.each(a.onpopstateHandlers || [], function(t, n) {
                    "function" == typeof n && n.call(e, e)
                })
            }, a.onpopstateHandlers || (a.onpopstateHandlers = []), a.history && a.history.state && a.history.state.scroll && a.onpopstate({
                state: {
                    scroll: a.history.state.scroll
                }
            })), t.state = function() {
                a.history && a.history.replaceState && (i ? a.history.replaceState({
                    scroll: o.scrollTop()
                }, null, l + (c ? c + "&" : "?") + "max=" + i) : a.history.replaceState({
                    scroll: o.scrollTop()
                }, null))
            }, t.max = function(e) {
                i = e
            }, t.pushState = function(e, t, n) {
                a.history && a.history.pushState && (n && a.onpopstateHandlers.indexOf(n) < 0 && a.onpopstateHandlers.push(n), a.history.pushState(t || null, null, e || ""))
            }
        },
        "utilities/postload.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function(e) {
                return e = i(e), e.data("src") ? void setTimeout(function() {
                    e.on("load error", function() {
                        i(this).removeClass("postload")
                    }).attr("src", e.data("src"))
                }, 100) : e.removeClass("postload")
            }, e.exports.all = function(t) {
                i(t).each(function(t, n) {
                    e.exports(n)
                })
            }, e.exports.lowres = function() {
                i("[data-imagelow]").each(function(e, t) {
                    t = i(t), t.css("background-image", 'url("' + t.data("imagelow") + '")')
                })
            }, e.exports.init = function() {
                e.exports.all(".y-foot img, .press img, .marketing img, .y-source img"), e.exports.lowres()
            }
        },
        "experiments/growth.js": function(e, t, n) {
            function i(e) {
                var t = a(e.target);
                (t.hasClass("yummly-sheet") || t.hasClass("opt-dismiss") || t.hasClass("yummly-sheet-close")) && a(".yummly-sheet").remove()
            }
            var a = n("jquery");
            t.regOverlay = function(e) {
                e = e || 0;
                var t = a("#x-reg-" + e);
                t.find(".opt-btn-google, .btn-google").attr("id", "google"), t.find(".opt-btn-facebook, .btn-facebook").attr("id", "facebook"), t.on("mouseup", i), n("../user/buttons")()
            }
        },
        "utilities/entities.js": function(e, t, n) {
            t.escapeHtml = function(e) {
                return e && "string" == typeof e ? e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&apos;") : e
            }, t.unescapeHtml = function(e) {
                return e && "string" == typeof e ? e.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&quot;/g, '"').replace(/&apos;/g, "'") : e
            }
        },
        "profile/urb/verify.js": function(e, t, n) {
            var i, a, r = n("jquery"),
                o = n("window"),
                s = n("yummly"),
                l = n("../../vendors/kahuna"),
                c = "button" === s.urbObject.yumtype ? "external button" : "bookmarklet",
                u = new o.Image,
                d = "",
                p = function() {
                    r.ajax({
                        url: "/mapi/v1/urb",
                        type: "POST",
                        cache: !1,
                        data: {
                            "recipe-url": s.urbObject.url,
                            "recipe-title": s.urbObject.title,
                            "recipe-image-url": d
                        },
                        headers: s.locale.headers,
                        success: function() {
                            if (r(".saved-content").toggle(), r(".wait-content").toggle(), d && i > a) {
                                var e = (r("#passed-image").height() - r("#passed-image").width()) / 2 + "px";
                                r("#passed-image").css("marginLeft", e)
                            }
                        },
                        error: function() {
                            r(".delayed-content").toggle(), r(".wait-content").toggle()
                        }
                    })
                };
            e.exports = function() {
                s.urbObject.image ? (u.onload = function() {
                    d = s.urbObject.image, i = u.width, a = u.height, r(function() {
                        r("#passed-image").attr("src", d), i > a && r("#passed-image").addClass("horizontal"), p()
                    })
                }, u.onerror = function() {
                    r(function() {
                        p()
                    })
                }, u.src = s.urbObject.image) : r(function() {
                    p()
                }), r(function() {
                    o.mixpanel && (l.track("Yums via " + c), o.mixpanel.track("Yum Button", {
                        Platform: "External Web",
                        "Recipe ID": s.urbObject.url,
                        "URB Title": s.urbObject.title || "",
                        "Yum UI Type": c
                    }))
                })
            }
        },
        "forms/fields/email.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("yummly").forms.fields.email;
            e.exports = function(e, t) {
                var n = i.extend(a, t),
                    r = i(e),
                    o = r.find('label[for="' + n.name + '"]');
                return o
            }
        },
        "settings/taste/page.js": function(e, t, n) {
            function i() {
                r.ajax({
                    url: "/api/recommendation/sendTrackingEvent?username=" + s + "&action=tasteChange",
                    type: "POST",
                    cache: !1,
                    headers: o.locale.headers
                })
            }
            var a = n("window"),
                r = n("jquery"),
                o = n("yummly"),
                s = o.user.encoded && o.user.encoded.id,
                l = n("../../utilities/debug");
            n("./common"), e.exports = function() {
                r("#taste-save-changes").on("click", function(e) {
                    e.preventDefault();
                    var t = r("#tasteForm"),
                        n = {};
                    n["allergy-preference"] = t.find('[name="allergy-preference"]:checked').map(function() {
                        return this.value
                    }).get(), n["diet-preference"] = t.find('[name="diet-preference"]:checked').map(function() {
                        return this.value
                    }).get(), n.dislikedIng = t.find('[name="disliked-ing"]').map(function() {
                        return this.value
                    }).get(), n["cooking-skill"] = t.find('[name="cooking-skill"]:checked').val() || "", n["cuisine-preference"] = t.find('[name="cuisine-preference"]:checked').map(function() {
                        return this.value
                    }).get(), n.age = o.user["attribute-preferences"]["age-preference"] || "", n["gender-preference"] = o.user["attribute-preferences"]["gender-preference"] || "", n["household-size-adults"] = o.user["attribute-preferences"]["household-size-adults"] || "", n["household-size-children"] = o.user["attribute-preferences"]["household-size-children"] || "", r.ajax({
                        url: "/api/taste/me",
                        type: "POST",
                        cache: !1,
                        timeout: 2e3,
                        data: n,
                        error: function(e, t, n) {
                            l.log("get taste info error " + n)
                        },
                        success: function() {
                            var e = r.ninja.dialog({
                                html: r("#dialog-saved-profile").html()
                            });
                            e.open(), r("#close-dialog-taste, .dismiss").on("click", function() {
                                e.close(), a.location.reload(!0)
                            }), i()
                        },
                        headers: o.locale.headers
                    })
                })
            }
        },
        "vendors/google/init.js": function(e, t, n) {
            function i(e, t) {
                t || (t = 1), a.gapi && a.gapi.client ? (t > 1 && a.Rollbar && a.Rollbar.info("google api load succeeded after " + t + " attempts"), a.gapi.client.setApiKey(o.oauthId), a.setTimeout(function() {
                    a.gapi.auth.authorize({
                        client_id: o.oauthId,
                        scope: o.oauthScope,
                        immediate: !0
                    }, function(t) {
                        r(a.document).trigger("google:ready"), e(t && !t.error ? t.access_token : null)
                    })
                }, 1)) : (a.Rollbar && a.Rollbar.error("gapi.client is not available yet, will retry, attempt " + t), 10 > t && a.setTimeout(function() {
                    i(e, t + 1)
                }, 1))
            }
            var a = n("window"),
                r = n("jquery"),
                o = n("./config");
            e.exports = i
        },
        "experiments/revenue.js": function(e, t, n) {},
        "utilities/debounced.js": function(e, t, n) {
            var i = n("jquery"),
                a = i.event,
                r = {},
                o = {};
            e.exports = function(e, t) {
                r[e] = a.special["debounced" + e] = {
                    setup: function() {
                        i(this).on(e, r[e].handler)
                    },
                    teardown: function() {
                        i(this).off(e, r[e].handler)
                    },
                    handler: function(n, i) {
                        var r = this,
                            s = arguments,
                            l = function() {
                                n.type = "debounced" + e, a.dispatch.apply(r, s)
                            };
                        o[e] && clearTimeout(o[e]), i ? l() : o[e] = setTimeout(l, t || 200)
                    }
                }
            }
        },
        "recipe/user-reviews.js": function(e, t, n) {
            function i() {
                q(".options-list").prev().removeClass("clicked"), q(".options-list").remove()
            }

            function a(e) {
                e = e || q(".review-error"), e.html(""), e.hide()
            }

            function r(e, t) {
                t = t || q(".review-error"), t.html(I[e]), t.css("display", "inline-block")
            }

            function o(e) {
                return e || !1
            }

            function s(e) {
                return e.length < 100 ? "invalid-input-too-short" : e.length > 5e3 ? "invalid-input-too-long" : !1
            }

            function l(e) {
                var t = q(this),
                    n = t.siblings().add(t),
                    i = t.prevAll().add(t);
                n.removeClass("full-star"), i.addClass("full-star"), "click" === e.type && (t.closest(".stars").data("rating", i.length), i.css({
                    opacity: .5
                }).animate({
                    opacity: 1
                }))
            }

            function c() {
                var e = q(this).closest(".stars"),
                    t = e.data("rating");
                e.find(".full-star").removeClass("full-star"), t && e.find(".empty-star").slice(0, t).addClass("full-star")
            }

            function u(e) {
                var t = q("#" + e + "-review-text").val(),
                    n = s(t);
                return n ? (r(n), !1) : t
            }

            function d(e) {
                var t = q("#" + e + "-stars").find(".full-star").length;
                return o(t) ? t : (r("text-no-stars"), !1)
            }

            function p() {
                q("#my-review-edit").hide(), q(".my-review-actions a").show()
            }

            function f() {
                q("#my-review-edit").show(), q(".my-review-actions a").hide()
            }

            function m() {
                var e = q(".my-review-text textarea");
                q(".my-review-text div").hide(), e.show(), e.css("height", e.get(0).scrollHeight + "px")
            }

            function h() {
                q(".my-review-text div").show(), q(".my-review-text textarea").hide()
            }

            function g() {
                var e = q(".my-review-stars"),
                    t = q("#edit-stars"),
                    n = e.find(".full").length;
                t.find(".empty-star:nth-child(" + n + ")").click(), e.hide(), t.show()
            }

            function v() {
                var e = q(".my-review-stars"),
                    t = q("#edit-stars"),
                    n = e.find("> .y-icon").length;
                t.find(".empty-star:nth-child(" + n + ")").click(), e.show(), t.hide()
            }

            function y() {
                p(), m(), g()
            }

            function b() {
                f(), h(), v()
            }

            function x() {
                var e = q("#my-review").data("id"),
                    t = "/mapi/v1/comment/" + e;
                q.ajax({
                    url: t,
                    type: "DELETE",
                    contentType: "application/json; charset=utf-8",
                    success: function() {
                        a(), q("#new-review-text").val(""), q("#new-review-box").show(), q("#my-review-box").html("")
                    },
                    headers: $
                }), L.mixpanel.track("Review Delete", {
                    "Recipe ID": q("#main").data("id"),
                    "Recipe Source": q("#source-name").data("name"),
                    "Screen Type": A.view
                })
            }

            function w() {
                var e = A.recipe.gid,
                    t = u("new"),
                    n = d("new"),
                    i = {
                        text: t,
                        rating: n,
                        globalId: e
                    },
                    o = "/user-reviews/submit-new/" + e;
                t && n && (q.ajax({
                    url: o,
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(i),
                    error: function(e) {
                        var t = e.responseJSON,
                            n = t && t.error || "review-general";
                        r(n)
                    },
                    success: function(e) {
                        a(), e && (q("#my-review-box").html(e), q("#my-review-box .timeago").timeago(), q("#new-review-box").hide())
                    },
                    headers: $
                }), L.mixpanel.track("Review Add", {
                    "Recipe Length": t.length,
                    "Recipe ID": q("#main").data("id"),
                    "Recipe Source": q("#source-name").data("name"),
                    "Rating in Stars": n,
                    "Screen Type": A.view
                }), _.track("Review"))
            }

            function k() {
                var e = q("#my-review").data("id"),
                    t = u("edit"),
                    n = d("edit"),
                    i = {
                        text: t,
                        rating: n
                    },
                    o = "/user-reviews/submit-edit/" + e;
                t && n && (q.ajax({
                    url: o,
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(i),
                    error: function(e) {
                        var t = e.responseJSON,
                            n = t && t.error || "review-general";
                        r(n)
                    },
                    success: function(e) {
                        a(), e && (q("#my-review-box").html(e), q("#my-review-box .timeago").timeago(), q("#new-review-box").hide())
                    },
                    headers: $
                }), L.mixpanel.track("Review Edit", {
                    "Recipe Length": t.length,
                    "Recipe ID": q("#main").data("id"),
                    "Recipe Source": q("#source-name").data("name"),
                    "Rating in Stars": n,
                    "Screen Type": A.view
                }))
            }

            function C() {
                var e = q(this),
                    t = e.next(),
                    n = e.closest(".review-box"),
                    i = n.find(".action-error").first(),
                    o = e.hasClass("liked"),
                    s = t.text() || 0,
                    l = e.data("id"),
                    c = e.data("username"),
                    u = parseInt(s, 10),
                    d = o ? u - 1 : u + 1,
                    p = "helpful",
                    f = o ? "DELETE" : "POST",
                    m = "/mapi/v1/comment/" + l + "/action/" + p;
                l && (q.ajax({
                    url: m,
                    type: f,
                    contentType: "application/json; charset=utf-8",
                    error: function() {
                        r("helpful-general", i)
                    },
                    success: function() {
                        a(i), t.text(d || ""), e.toggleClass("liked")
                    },
                    headers: $
                }), L.mixpanel.track("Review Like", {
                    "Recipe ID": q("#main").data("id"),
                    "Recipe Source": q("#source-name").data("name"),
                    "Username of Liked Review": c,
                    "Screen Type": A.view
                }))
            }

            function j(e, t) {
                var n = t || q(this),
                    i = n.closest(".review-box"),
                    o = i.find(".flag-action").first(),
                    s = i.find(".action-error").first(),
                    l = "unFlag" === e ? null : n.val(),
                    c = "unFlag" === e || o.hasClass("flagged"),
                    u = i.data("id"),
                    d = "flag",
                    p = c ? "DELETE" : "POST",
                    f = "/mapi/v1/comment/" + u + "/action/" + d;
                u && q.ajax({
                    url: f,
                    type: p,
                    contentType: "application/json; charset=utf-8",
                    data: l && JSON.stringify({
                        actionReason: l
                    }),
                    error: function() {
                        i.find(".options-list").remove(), r("flag-general", s)
                    },
                    success: function() {
                        i.find(".options-list").remove(), a(s), o.toggleClass("flagged"), o.removeClass("clicked")
                    },
                    headers: $
                })
            }

            function T() {
                if (q(this).hasClass("clicked")) return !1;
                var e = q(this).parent(),
                    t = q("<span>"),
                    n = {
                        spam: R.recipe.reviews.flagoptions.spam,
                        "off-topic": R.recipe.reviews.flagoptions.offtopic,
                        inappropriate: R.recipe.reviews.flagoptions.inappropriate
                    };
                i(), q(this).addClass("clicked"), q(this).hasClass("flagged") ? j("unFlag", e) : (q.each(n, function(e, n) {
                    var i = q("<label>"),
                        a = q("<input>");
                    a.attr({
                        type: "radio",
                        name: "flag-option",
                        value: e
                    }), i.append(a), i.append("<span>" + n + "</span>"), a.on("click", j), t.attr({
                        "class": "options-list"
                    }), t.append(i)
                }), e.append(t))
            }

            function S() {
                var e = A.recipe.gid,
                    t = q('input[name="review-sort"]:checked').val(),
                    i = "/user-reviews/get-list/" + e + "?sortBy=" + t;
                q(".review-sort-label").toggleClass("checked"), e && q.ajax({
                    url: i,
                    type: "GET",
                    success: function(e) {
                        e && (q("#reviews-list").html(e), n("../utilities/timeago")())
                    },
                    headers: $
                })
            }

            function N() {
                var e = q("#user-reviews"),
                    t = e.height() + e.offset().top,
                    n = 500;
                return n > t
            }

            function E() {
                var e = q("#user-reviews").data("userreview") ? 1 : 0,
                    t = parseInt(q("#user-reviews").data("total")) - e,
                    n = q(".review-box").length - e;
                return t > n ? n : !1
            }

            function D() {
                var e = q("#reviews-list"),
                    t = e.hasClass("getting"),
                    i = A.recipe.gid,
                    a = q('input[name="review-sort"]:checked').val(),
                    r = E(),
                    o = "/user-reviews/get-list/" + i + "?sortBy=" + a + "&offset=" + r;
                !t && r && i && N() && (q("#reviews-list").addClass("getting"), q.ajax({
                    url: o,
                    type: "GET",
                    success: function(t) {
                        t && (e.append(t), e.removeClass("getting"), n("../utilities/timeago")())
                    },
                    headers: $
                }))
            }
            var A = n("yummly"),
                L = n("window"),
                $ = A.locale.headers,
                q = n("jquery"),
                _ = n("../vendors/kahuna"),
                R = A.strings,
                P = A.query.loginReview,
                I = R.recipe.reviews.errors;
            e.exports = function() {
                P && q("#new-review-text").focus(), q(L.document).on("mouseover", ".empty-star", l).on("mouseout", ".empty-star", c).on("click", ".empty-star", l).on("click", ".review-write", w).on("click", "#my-review-edit", y).on("click", "#my-review-save", k).on("click", "#my-review-cancel", b).on("click", "#my-review-delete", x).on("click", ".like-action", C).on("click", ".flag-action", T).on("click", function(e) {
                    var t = q(e.target).closest(".flag").first();
                    t.length || i()
                }), q("textarea").on("blur keyup change", function() {
                    q(this).css("height", q(this).css("height", "auto").get(0).scrollHeight + "px")
                }), q(".application-body").on("scroll", D), q('input[name="review-sort"]').on("change", S), 1 === q(".user-reviews").data("total") && q(".review-title").html("1 " + A.strings.recipe.reviews.review)
            }
        },
        "vendors/google/login.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("yummly"),
                r = a.locale,
                o = a.user;
            e.exports = function(e, t) {
                o.anonymous || (o.pictureUrl && "string" == typeof o.pictureUrl ? i(".profile-picture").attr("src", o.pictureUrl) : i.ajax({
                    url: "https://www.googleapis.com/plus/v1/people/me",
                    data: {
                        alt: "json",
                        access_token: e
                    },
                    dataType: "jsonp",
                    timeout: 5e3,
                    success: function(e) {
                        e.image && e.image.url && o.identities.google.id === e.id && i(".profile-picture").attr("src", e.image.url)
                    },
                    error: function() {},
                    complete: function() {
                        t && t()
                    },
                    headers: r.headers
                }))
            }
        },
        "vendors/kahuna/index.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly");
            e.exports = a.kahuna = {
                init: function(e, t) {
                    var n = i.Kahuna,
                        r = "production" === a.environment ? "p" : "s";
                    n && (n.setEnvironment(r), n.init("2cfc8c79900f4fc2a028d8fef386cd27", "YummlyWebsite", "1.0"), (e || t) && n.setUserCredentials(e || null, t || null), n.trackEvent("start"))
                },
                set: function(e, t) {
                    var n = i.Kahuna;
                    n && e && ("string" == typeof e ? n.setUserAttributes({
                        key: t
                    }) : n.setUserAttributes(e))
                },
                track: function(e) {
                    var t = i.Kahuna,
                        n = i.mixpanel;
                    t && e && t.trackEvent(e), n && e && n.people.increment(e)
                },
                logout: function() {
                    var e = i.Kahuna;
                    e && e.logout()
                }
            }
        },
        "utilities/error/ajax.js": function(e, t, n) {
            function i(e, t, n) {
                a("Ajax Error. textStatus: " + t + ", errorThrown: " + n)
            }
            var a = n("../debug");
            e.exports = function(e, t, n) {
                i(e, t, n)
            }
        },
        "tools/search-sponsor.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i(".tools-content form").on("submit", function(e) {
                    e.preventDefault();
                    var t = i("[name=destination]").val(),
                        n = i("[name=image]").val(),
                        a = i("[name=thirdPartyImpression]").val(),
                        r = i("[name=thirdPartyClick]").val(),
                        o = "";
                    r && (t = r + "?" + t), o = '<a href="%%CLICK_URL_ESC%%' + t + '" style="display:block;text-align:center;" target="_blank"><img src="' + n + '" style="border:0;outline:none;height:40px;"></a>', a && (a = a.replace(/\[timestamp\]/g, "%%CACHEBUSTER%%"), o += /^http/.test(a) ? '<img src="' + a + '" style="width: 1px; height: 1px margin-top: -1px;">' : a), i(".tool-output").removeClass("hidden").find("textarea").val(o)
                })
            }
        },
        "settings/taste/common.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly"),
                o = n("../../utilities/debug"),
                s = a("#taste-ingredient-suggest"),
                l = a("#tasteAddDislike"),
                c = 0;
            s.ninja("autocomplete", {
                get: function(e, t) {
                    c += 1, a.ajax({
                        url: "/api/metadata/ingredient-suggest",
                        data: {
                            prefix: e
                        },
                        dataType: "json",
                        context: {
                            callId: c
                        },
                        success: function(e) {
                            o.log("Fired ingredient suggest I want"), this.callId === c && (a.isArray(e) && t(e.slice(0, 10)), (a.isEmptyObject(e) || 0 === e.length) && a(".ninja-list").remove())
                        },
                        error: function(e, t, n) {
                            o.log("autocomplete error: " + t + ", " + n)
                        },
                        headers: r.locale.headers
                    })
                },
                select: function() {
                    var e = s.val(),
                        t = a("#dislikedIngs .scrollable"),
                        n = e && t.find('input[value="' + e + '"]');
                    e && !n.length && (t.prepend('<div class="ingredient"><a href="#" class="taste-remove-ingredient"><span class="y-icon">&#x23;</span></a>' + e + '<input type="hidden" name="disliked-ing" value="' + e + '"/></div>'), s.val(""))
                }
            }), l.on("click", function(e) {
                e.preventDefault()
            }), a(i.document).on("click", ".taste-remove-ingredient", function() {
                a(this).parents("div:first").remove()
            }), a(".ingredient-add").each(function() {
                var e = a("input.ingredient-suggest", this),
                    t = a("button", this);
                e.on("focus", function() {
                    t.addClass("btn-on-state")
                }), e.on("blur", function() {
                    t.removeClass("btn-on-state")
                })
            })
        },
        "vendors/facebook/like.js": function(e, t, n) {
            var i = n("window"),
                a = n("../google/universal-analytics").track;
            e.exports = function() {
                i.FB.XFBML.parse(i.document.getElementById("fb-like")), i.FB.Event.subscribe("edge.create", function(e) {
                    a("send", "social", "facebook", "like", e)
                }), i.FB.Event.subscribe("edge.remove", function(e) {
                    a("send", "social", "facebook", "unlike", e)
                })
            }
        },
        "vendors/facebook/init.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("./config");
            e.exports = function(e) {
                var t = "";
                i.location.port.length > 0 && (t += ":" + i.location.port), i.FB.init({
                    appId: r.appId,
                    version: "v2.2",
                    channelUrl: "//" + i.location.hostname + t + "/channel.html",
                    cookie: !0,
                    status: !0,
                    xfbml: !0
                }), i.FB.getLoginStatus(function(t) {
                    a(i.document).trigger("facebook:ready"), e("connected" === t.status ? t.authResponse.accessToken : null)
                })
            }
        },
        "vendors/mixpanel/user.js": function(e, t, n) {
            var i = n("yummly");
            e.exports = function(e) {
                var t = "",
                    n = e.identities;
                return n.fb.id ? t = "facebook" : n.google.id ? t = "google" : n.yummly.hasPassword && (t = "email"), {
                    $created: (new Date).toJSON(),
                    $username: n.yummly.name,
                    $email: e.email,
                    $first_name: e.fullName.first,
                    $last_name: e.fullName.last,
                    Gender: e.gender.toLowerCase(),
                    "Acquisition View Type": i.view,
                    "Authentication Method": t
                }
            }
        },
        "forms/fields/password.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("yummly"),
                r = a.strings,
                o = r.forms.actions,
                s = a.forms.fields.password;
            e.exports = function(e, t) {
                var n = i.extend(s, t),
                    a = i(e),
                    r = a.find('label[for="' + n.name + '"]'),
                    l = r.find(".toggle"),
                    c = r.find("input");
                return l.off("click").on("click", function() {
                    "password" === c.attr("type") ? (l.text(o.hide), c.attr("type", "text")) : (l.text(o.show), c.attr("type", "password")), c.focus()
                }), r
            }
        },
        "vendors/mixpanel/init.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly");
            e.exports = function(e) {
                var t = "mixpanel",
                    r = n("window").mixpanel = [];
                r.__SV || (r._i = [], r.init = function(e, n, i) {
                    function a(e, t) {
                        var n = t.split(".");
                        2 === n.length && (e = e[n[0]], t = n[1]), e[t] = function() {
                            e.push([t].concat(Array.prototype.slice.call(arguments, 0)))
                        }
                    }
                    var o = r,
                        s = "disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
                    "undefined" != typeof i ? o = r[i] = [] : i = t, o.people = o.people || [], o.toString = function(e) {
                        var n = t;
                        return i !== t && (n += "." + i), e || (n += " (stub)"), n
                    }, o.people.toString = function() {
                        return o.toString(1) + ".people (stub)"
                    };
                    for (var l = 0; l < s.length; l += 1) a(o, s[l]);
                    r._i.push([e, n, i])
                }, r.campaignParams = function() {
                    function e(e, t) {
                        t = t.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                        var n = "[\\?&]" + t + "=([^&#]*)",
                            i = new RegExp(n),
                            a = i.exec(e);
                        return null === a || a && "string" != typeof a[1] && a[1].length ? "" : decodeURIComponent(a[1]).replace(/\+/g, " ")
                    }
                    var t, n = "utm_source utm_medium utm_campaign utm_content utm_term".split(" "),
                        a = "UTM Source, UTM Medium, UTM Campaign, UTM Content, UTM Term".split(","),
                        o = "",
                        s = {},
                        l = {},
                        c = n.length;
                    for (t = 0; c > t; t += 1) o = e(i.document.URL, n[t]), o ? (s[a[t] + " [Last Touch]"] = o, l[a[t] + " [First Touch]"] = o) : s[a[t] + " [Last Touch]"] = "";
                    r.people.set(s), r.people.set_once(l), r.register(s)
                }, r.__SV = 1.2), r.init(a.vendors.mixpanel.projects[a.environment], {
                    track_pageview: !1,
                    debug: a.development
                }), r.campaignParams(), e && e()
            }
        },
        "vendors/google/config.js": function(e, t, n) {
            e.exports = {
                gaId: "UA-7906151-4",
                oauthId: "1087349110916-16g3ffa551b09ppr86824f0qvuno5rnq.apps.googleusercontent.com",
                oauthSecret: "KT57rBvXiDPxr1B9biCTXECZ",
                oauthScope: ["profile", "email"].join(" ")
            }
        },
        "vendors/facebook/login.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly"),
                o = r.user,
                s = n("./token");
            e.exports = function(e, t) {
                o.anonymous || (o.pictureUrl && "string" == typeof o.pictureUrl ? a(".profile-picture").attr("src", o.pictureUrl) : i.FB.api("/me", {
                    access_token: e
                }, function(n) {
                    o.identities.fb.id !== n.id ? s.set(null) : (s.set(e), a(".profile-picture").attr("src", "http://graph.facebook.com/v2.2/" + (n.username || n.id) + "/picture")), t()
                }))
            }
        },
        "utilities/compat/array.js": function(e, t, n) {
            Array.prototype.indexOf || (Array.prototype.indexOf = function(e, t) {
                if (void 0 === this || null === this) throw new TypeError('"this" is null or not defined');
                var n = this.length >>> 0;
                for (t = +t || 0, Math.abs(t) === 1 / 0 && (t = 0), 0 > t && (t += n, 0 > t && (t = 0)); n > t; t += 1)
                    if (this[t] === e) return t;
                return -1
            })
        },
        "experiments/activation.js": function(e, t, n) {
            var i = n("jquery");
            t.loginSwap = function(e) {
                i("#navigation").addClass("experiment-activation-login"), e && e()
            }, t.cardsSwap = function(e) {
                i(".y-card.ad").addClass("experimental"), i(".y-card:not(.ad)").each(function(t, n) {
                    var a = i(n),
                        r = a.find(".btn-wrapper"),
                        o = a.find(".y-title");
                    r.addClass("experiment"), e && o.addClass("experiment"), a.removeClass("y-card").addClass("experiment-design-card").on("mouseenter", function() {
                        r.removeClass("experiment"), e && o.removeClass("experiment")
                    }).on("mouseleave", function() {
                        r.addClass("experiment"), e && o.addClass("experiment")
                    })
                })
            }
        },
        "vendors/facebook/token.js": function(e, t, n) {
            var i;
            t.get = function() {
                return i
            }, t.set = function(e) {
                i = e
            }
        },
        "utilities/persistent-ad.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window"),
                r = n("./width");
            e.exports = function() {
                var e = i(".persistent-iab");
                i(a.document).add(".application-body").on("debouncedscroll", function() {
                    var t = 0 !== i(".navigation table").offset().top,
                        n = e.hasClass("collapsed"),
                        a = i(this).scrollTop(),
                        o = r.small() ? 240 : 480;
                    t && !n && a >= o ? e.addClass("collapsed") : n && o > a && e.removeClass("collapsed")
                })
            }
        },
        "vendors/tapstream/index.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly");
            e.exports = function() {
                i._tsq = i._tsq || [], i._tsq.push(["setAccountName", a.vendors.tapstream.accountName]), i._tsq.push(["fireHit", "javascript_tracker", []])
            }
        },
        "vendors/facebook/config.js": function(e, t, n) {
            e.exports = {
                appId: "54208124338",
                admins: "521616638,678870357,500721039,553471374",
                scope: "email, publish_actions"
            }
        },
        "settings/password/reset.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly").strings.settings.account.password,
                r = n("jquery");
            e.exports = function() {
                n("../../forms").auth("reset"), r(".form-dialog form").on("submit", function(e) {
                    e.preventDefault(), r("[name=reset] label").hasClass("error") || r.ajax({
                        url: "/mapi/v1/user/update-password",
                        method: "POST",
                        data: {
                            cookie: !0,
                            "new-password": r(".form-dialog [name=password]").val()
                        },
                        headers: {
                            "X-Yummly-Auth-Token": i.location.search.replace(/.*[?&]token=([^?&]+)/, "$1")
                        },
                        complete: function(e, t) {
                            r.cookie("au", e.responseText);
                            var n = r(".form-dialog .paper"),
                                i = "success" === t,
                                o = i ? a.success.title : a.failure.title,
                                s = i ? a.success.body : a.failure.body,
                                l = r(i ? '<a href="/" class="submit btn-secondary">' + a.success.button + "</a>" : '<a href="/account/password/forgot" class="submit btn-secondary">' + a.title + "</a>");
                            n.find("label, input").hide(), n.find(".submit").remove(), n.find("h1").text(o), n.find("p").text(s), n.append(l)
                        }
                    })
                })
            }
        },
        "forms/fields/select-list.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i(".y-select-list").unbind("click").on("click", "li", function() {
                    var e = i(this),
                        t = e.closest(".y-select-list"),
                        n = t.find("span");
                    n.text(e.text()).data("value", e.data("value")), t.trigger("change", [n.data("value"), n.text()])
                })
            }
        },
        "profile/collections/edit.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly").errors,
                o = r && r[0] && "edit" === r[0].form;
            e.exports = function() {
                function e(e, t) {
                    var n = a(t),
                        s = a.parseHTML(a("#" + e).html()),
                        l = a(s),
                        c = a.ninja.dialog({
                            html: l
                        }),
                        u = l.find(".dialog-content-edit"),
                        d = l.find(".dialog-content-delete");
                    u.find("[type=submit]").on("click", function(e) {
                        var t = u.attr("action"),
                            n = t.replace(/\/profile\/([^\/]+).+/, "$1"),
                            a = u.find("[name=name]").val();
                        a && i.mixpanel && (e.preventDefault(), i.mixpanel.track("Collection Edited", {
                            "Collection Name By Owner": n + "/" + a,
                            "Collection Name Unique": a
                        }, function() {
                            u.submit()
                        }))
                    }), d.find("[type=submit]").on("click", function(e) {
                        var t = d.attr("action"),
                            n = t.replace(/\/profile\/([^\/]+).+/, "$1"),
                            a = t.replace(/.+?([^\/]+)$/, "$1");
                        a && i.mixpanel && (e.preventDefault(), i.mixpanel.track("Collection Deleted", {
                            "Collection Name By Owner": n + "/" + a,
                            "Collection Name Unique": a
                        }, function() {
                            d.submit()
                        }))
                    }), l.find(".ninja-close-dialog").on("click", function(e) {
                        e.preventDefault(), c.close()
                    }), l.find("form").attr("action", n.attr("href")), d.attr("action", d.attr("action") + "?_method=DELETE"), l.find("input[name=name]").attr("value", n.data("name")), n.data("description") && l.find("textarea[name=description]").text(n.data("description")), l.find(".dialog-delete").on("click", function(e) {
                        e.preventDefault(), u.hide(), d.show()
                    }), l.find(".dialog-cancel").on("click", function(e) {
                        e.preventDefault(), d.hide(), u.show()
                    }), o && a.each(r, function(e, t) {
                        t.field ? (l.find("[name=" + t.field + "]").addClass("error"), l.find("label[for=" + t.field + "]").append('<span class="error">' + t.message + "</span>")) : l.find("form").prepend('<div class="error">' + t.message + "</div>")
                    }), c.open()
                }
                a(".collection-edit").on("click", function(t) {
                    t.preventDefault(), e("dialog-collection-edit", this)
                }), o && e("dialog-collection-edit")
            }
        },
        "utilities/error/required.js": function(e, t, n) {
            function i(e, t) {
                if (!t || t.length < 1) return !1;
                for (var n = 0, i = t.length; i > n; n += 1) {
                    var r = t[n];
                    "undefined" == typeof e[r] && o.push(r)
                }
                o.length > 0 && (a = "Missing required options: " + o.join(", "))
            }
            var a = "",
                r = n("../debug").error,
                o = [];
            e.exports = function(e, t) {
                return i(e, t), a ? (r(a), !1) : !0
            }
        },
        "profile/reco/recommended.js": function(e, t, n) {
            function i() {
                s.open({
                    type: "sheet",
                    content: r("#recommended-explanation").html()
                }), r("#reco-continue").on("click", function() {
                    s.close()
                })
            }

            function a(e) {
                r.ajax({
                    url: "/api/recommendation/sendEvent?username=" + c.id + "&event=status:old",
                    type: "GET",
                    cache: !1,
                    data: {},
                    complete: function() {
                        e && e()
                    },
                    headers: o.locale.headers
                })
            }
            var r = n("jquery"),
                o = n("yummly"),
                s = n("../../sheet"),
                l = o.recoFirstTime,
                c = o.user;
            e.exports = function() {
                a(), l && i(), n("./not-interested")()
            }, e.exports.sendRecommendedPageLoad = a
        },
        "overlays/onboarding/navi.js": function(e, t, n) {
            function i(e) {
                var t = (new Date).valueOf(),
                    n = new Date(Date.parse(e)).valueOf(),
                    i = t - n,
                    a = Math.round(i / 1e3 / 86400 - .5);
                return a
            }

            function a(e) {
                var t, n = "callout-" + e,
                    a = new Date;
                return m.user.anonymous && g.perm.set(n, "0"), t = g.perm.get(n) || 0, (!t || i(t) > 14) && (g.perm.set(n, [a.getFullYear(), a.getMonth() + 1, a.getDate()].join("-") + " " + [a.getHours(), ("0" + a.getMinutes()).substr(-2)].join(":")), t = g.perm.get(n)), i(t) < 2 && !/dismissed/.test(y.cookie(n))
            }

            function r() {
                return y("#onboarding-navi")
            }

            function o(e) {
                var t = y(f),
                    n = t.width(),
                    i = e.width(),
                    a = e.offset();
                return (a.left + i) / n <= .5 ? "right" : "left"
            }

            function s(e) {
                y(".modal-bg").removeClass("active"), r().addClass("navi-hiding"), setTimeout(function() {
                    r().addClass("navi-hide").removeClass("navi-hiding"), e && u(e)
                }, 200)
            }

            function l(e) {
                var t = e.what,
                    n = e.where || o(t),
                    i = r(),
                    a = "vMargin" in e ? e.vMargin : 20,
                    s = "hMargin" in e ? e.hMargin : 20,
                    l = t.offset(),
                    c = t.outerHeight(),
                    u = t.outerWidth(),
                    d = i.outerHeight(),
                    p = i.outerWidth(),
                    f = i.parent().scrollTop();
                switch (n) {
                    case "top left":
                        i.css({
                            top: f + l.top - d - a + "px",
                            left: l.left - p + s + "px"
                        });
                        break;
                    case "top":
                        e.hMargin || (s = 0), i.css({
                            top: f + l.top - d - a + "px",
                            left: l.left + u / 2 - p / 2 + s + "px"
                        });
                        break;
                    case "top right":
                        i.css({
                            top: f + l.top - d - a + "px",
                            left: l.left + u - s + "px"
                        });
                        break;
                    case "right":
                        e.vMargin || (a = 0), i.css({
                            top: f + l.top + a + "px",
                            left: l.left + u + s + "px"
                        });
                        break;
                    case "bottom right":
                        i.css({
                            top: f + l.top + c + a + "px",
                            left: l.left + u - s + "px"
                        });
                        break;
                    case "bottom":
                        e.hMargin || (s = 0), i.css({
                            top: f + l.top + c + a + "px",
                            left: l.left + u / 2 - p / 2 + s + "px"
                        });
                        break;
                    case "bottom left":
                        i.css({
                            top: f + l.top + c + a + "px",
                            left: l.left - p + s + "px"
                        });
                        break;
                    case "left":
                        e.vMargin || (a = 0), i.css({
                            top: f + l.top + a + "px",
                            left: l.left - p - s + "px"
                        })
                }
            }

            function c() {
                var e = r();
                e.hasClass("navi-hiding") || e.hasClass("navi-hide") || (e.addClass("navi-shake"), setTimeout(function() {
                    e.removeClass("navi-shake")
                }, 400))
            }

            function u(e) {
                if (-1 !== m.enabledFeatures.indexOf("onboarding-bubble") && e && e.what && e.what.length && "function" == typeof e.what.offset) {
                    var t = e.what,
                        n = e.where || o(t),
                        i = r(),
                        a = i.find(".navi-dismiss"),
                        u = b[Math.floor(Math.random() * b.length)];
                    if (!i.hasClass("navi-hiding") && !i.hasClass("navi-hide")) return s(e);
                    i.find(".hd").html(e.hd || ""), i.find(".bd").html(e.bd || ""), i.find(".ft").html(e.ft ? '<button class="btn-tertiary">' + e.ft + "</button>" : ""), e.ft && i.find("button").on("click", e.click || function() {
                        s(), d()
                    }), y.trim(a.html()) || a.html("&times;").on("click", function() {
                        s()
                    }), a.toggleClass("visuallyhidden", !e.showDismiss), e.showFace && i.css("background-image", "url(../img/navi/people/" + u.toLowerCase() + ".png)").find(".navi-face").html(m.strings.onboarding.face.replace("%s", u)), i.removeClass(function(e, t) {
                        return (t.match(/(^|\s)navi-\S+/g) || []).join(" ")
                    }).addClass("navi-location-" + n.replace(/ /g, "-")), y(f).on("debouncedresize", function() {
                        l(e)
                    }), l(e), e.shake && (p = setTimeout(c, e.shake)), e.modal && (y(".modal-bg").length || y('<div class="modal-bg">').insertBefore(i).on("click", function() {
                        s()
                    }), y(".modal-bg").addClass("active"))
                }
            }

            function d(e) {
                y.cookie("callout-" + (e || "yum"), "dismissed", {
                    expires: 1,
                    path: "/"
                })
            }
            var p, f = n("window"),
                m = n("yummly"),
                h = n("../../utilities/view"),
                g = n("../../utilities/storage"),
                v = n("../../utilities/width"),
                y = n("jquery"),
                b = ["Shelley"];
            e.exports = function() {
                var e = r(),
                    t = m.enabledFeatures.indexOf("dde-test-1") > -1,
                    n = '.browse-tabs li:not(.active) a[href="/my-recommended"]';
                e.unbind("mouseover").on("mouseover", function() {
                    p && (clearTimeout(p), p = null)
                }), setTimeout(function() {
                    var i = !m.collectionList || !m.collectionList["all-yums"] || !m.collectionList["all-yums"].totalCount,
                        r = h("home"),
                        o = h("recipe/recipe"),
                        l = h("recipe/external"),
                        c = h(["recipe/search", "recipe/outsearch"]),
                        p = y("html").hasClass("list-view");
                    if (i && (o && y(".image-wrapper .image:not(.no-image)").length || l && y(".external-yum").length) && a("yum") && !m.showPersistentRectangle) {
                        var g = {
                            hd: m.strings.onboarding.yumRecipePage.title,
                            bd: m.strings.onboarding.yumRecipePage.body,
                            where: v.small() ? "bottom left" : "left",
                            what: y(".primary .btn-yum, .external-yum"),
                            shake: 4e3,
                            showFace: !0,
                            showDismiss: !0
                        };
                        t && (g.showFace = !1, g.modal = !0, l && (g.where = "bottom left", g.vMargin = 60, g.hMargin = 35), g.hd = "LIKE IT? SAVE IT!", g.bd = "Click <strong>Yum</strong> to save recipe to your personal recipe box.",
                            g.ft = "GOT IT", e.addClass("dde-test-1")), u(g), y(".yum-click").on("click", function() {
                            s()
                        }), e.find(".navi-dismiss").on("click", function() {
                            d()
                        })
                    } else if (c && i && a("yum") && y(".y-grid-card, .y-card").length) {
                        var b = v.numColumns() > 2 || !v.small() && p;
                        u({
                            hd: m.strings.onboarding.yumRecipePage.title,
                            bd: m.strings.onboarding.yumRecipePage.body,
                            where: b ? "left" : "bottom",
                            what: b ? y(".y-card .btn-wrapper, .y-grid-card .btn-yum").eq(2) : y(".y-card, .y-grid-card").eq(2),
                            shake: 4e3,
                            showFace: !0,
                            showDismiss: !0,
                            hMargin: p ? 21 : b ? 8 : 0,
                            vMargin: p ? b ? 3 : -5 : b ? 3 : -13
                        }), y(".yum-click").on("click", function() {
                            s()
                        }), e.find(".navi-dismiss").on("click", function() {
                            d()
                        })
                    } else r && a("reco") && y(n).length && "none" !== y(".browse-tabs .tab-list").css("display") && (u({
                        hd: m.strings.onboarding.yumJustForYou.title,
                        bd: m.strings.onboarding.yumJustForYou.body,
                        where: "bottom",
                        what: y(n).parent(),
                        shake: 4e3,
                        showFace: !0,
                        showDismiss: !0,
                        vMargin: 0
                    }), y(n).add(".navi-dismiss").on("click", function() {
                        d("reco")
                    }), y(f).on("debouncedresize", function x() {
                        return e.css("display", y(".browse-tabs .tab-list").css("display")), x
                    }()))
                }, 1e3)
            }, e.exports.show = u, e.exports.hide = s, e.exports.move = l, e.exports.shake = c
        },
        "settings/password/forgot.js": function(e, t, n) {
            e.exports = function() {
                n("../../forms").auth("forgot")
            }
        },
        "vendors/facebook/comments.js": function(e, t, n) {
            var i = n("window"),
                a = n("../google/universal-analytics").track;
            e.exports = function() {
                i.FB.XFBML.parse(i.document.getElementById("fb-like")), i.FB.Event.subscribe("edge.create", function(e) {
                    a("send", "social", "facebook", "like", e)
                }), i.FB.Event.subscribe("edge.remove", function(e) {
                    a("send", "social", "facebook", "unlike", e)
                })
            }
        },
        "overlays/onboarding/prefs.js": function(e, t, n) {
            function i(e) {
                return function(t, n) {
                    var i = h(n).data("id");
                    i && e && L[e] && "function" == typeof L[e].push && L[e].push(i)
                }
            }

            function a() {
                var e = j.find(".pane-demographics input"),
                    t = parseInt(e.eq(0).val() || "", 10);
                (isNaN(t) || 0 > t) && (t = ""), L = {
                    age: t,
                    "allergy-preference": [],
                    "cooking-skill": "",
                    "cuisine-preference": [],
                    "diet-preference": [],
                    dislikedIng: [],
                    "gender-preference": e.eq(1).val()
                }, j.find(".pane-allergies .onboarding-bubbles .active").each(i("allergy-preference")), j.find(".pane-diets .onboarding-bubbles .active").each(i("diet-preference")), j.find(".pane-cuisines .onboarding-bubbles .active").each(i("cuisine-preference")), L["cooking-skill"] = j.find(".pane-skills .onboarding-bubbles .active").data("id") || "", L["household-size-adults"] = j.find(".pane-demographics .onboarding-family-adults .amount").text() || "", L["household-size-children"] = j.find(".pane-demographics .onboarding-family-kids .amount").text() || "", h.ajax({
                    url: "/api/taste/me",
                    method: "POST",
                    cache: !1,
                    data: L,
                    headers: v.locale.headers
                })
            }

            function r(e, t, n) {
                if (t = t || "", e) {
                    var i = e,
                        a = {
                            "Screen Type": j.find(".pane.active").data("name") || "Unknown",
                            "Prompt Type": "Onboarding v0.1"
                        },
                        r = "EmailRegistration-" + ["Email", "Password", "FirstName", "LastName"][h(".multistep-email .wrap.active").last().index()];
                    switch (e) {
                        case "navigate":
                            i = "Prompt Click", a["Prompt Action"] = t;
                            break;
                        case "slider":
                            i = "Prompt Click", a["Prompt Action"] = "Slider Set", a["Prompt Label"] = t;
                            break;
                        case "spinner":
                            i = "Prompt Click", a["Prompt Action"] = "Arrow " + n, a["Prompt Label"] = t;
                            break;
                        case "typed":
                            i = "Prompt Click", a["Prompt Action"] = "Enter Text", a["Prompt Label"] = t;
                            break;
                        case "view":
                            i = "Prompt View", C.isFirstPageview() || "Registration" !== a["Screen Type"] || (a["Screen Type"] = "Registration-2nd-Pageview"), n && (a["Screen Type"] += "-" + n);
                            break;
                        case "set":
                            i = "Prompt Click", a["Prompt Action"] = "Set Preference", a["Prompt Label"] = t;
                            break;
                        case "unset":
                            i = "Prompt Click", a["Prompt Action"] = "Unset Preference", a["Prompt Label"] = t;
                            break;
                        case "dismiss":
                            i = "Prompt Click", a["Prompt Action"] = "Dismiss", a["Prompt Label"] = t;
                            break;
                        case "email-view":
                            i = "Prompt View", a["Screen Type"] = r;
                            break;
                        case "email-click":
                            i = "Prompt Click", a["Screen Type"] = r, a["Prompt Action"] = t, a["Form Data"] = n;
                            break;
                        default:
                            return
                    }
                    try {
                        g.mixpanel.track(i, a), g.ga("send", "event", "onboardingOverlay", a["Screen Type"].toLowerCase() + "-" + e, t)
                    } catch (o) {}
                }
            }

            function o(e, t) {
                return Math.floor(Math.random() * (t - e + 1) + e)
            }

            function s() {
                var e;
                return T.length < 4 ? S : (D === T.length && (D = 0), e = T.eq(D).data("src") || T.eq(D).attr("src") || S, D += 1, e)
            }

            function l(e, t) {
                var n = h(".onboarding-recipes").eq(e).find("li").eq(t),
                    i = "url(" + s() + ")";
                n.data("animating") || n.css("background-image") === i || (n.data("animating", !0).addClass("flip-forward").css("z-index", 20), setTimeout(function() {
                    n.removeClass("flip-forward").addClass("flip-backward").css("background-image", i), setTimeout(function() {
                        n.removeClass("flip-backward"), setTimeout(function() {
                            n.css("z-index", 10).data("animating", !1)
                        }, N + E)
                    }, N)
                }, N + E))
            }

            function c() {
                var e, t = o(0, 6),
                    n = t + 4,
                    i = 0;
                l(i, t), setTimeout(function() {
                    n > 6 && (i += 1, n -= 7), l(i % 2, n), setTimeout(function() {
                        e = n + 4, e > 6 && (i += 1, e -= 7), l(i % 2, e)
                    }, E)
                }, E)
            }

            function u(e, t) {
                t = h(t), t.text(t.text().replace(/-Free/, ""));
                var n = t.clone().insertAfter(t).css({
                        position: "static",
                        height: "auto"
                    }),
                    i = t.closest("li");
                setTimeout(function() {
                    t.removeClass("big"), n.height() >= 2 * t.height() && t.addClass("big"), n.remove(), setTimeout(function() {
                        i.addClass("animated")
                    }, 100 * (e + 1))
                }, 0)
            }

            function d(e, t, i) {
                e = e || 0;
                var o, s = j.find(".pane.active"),
                    l = j.find(".pane").eq(e),
                    c = v.locale.headers,
                    p = 0;
                if (0 > e || e > j.find(".pane-done").index()) {
                    if (!b("login")) return j.addClass("visuallyhidden");
                    g.history.back()
                }
                if (e && v.enabledFeatures.indexOf("show-onboarding-" + A[e]) < 0) return t ? setTimeout(function() {
                    d(e - 1, t, i)
                }, 0) : setTimeout(function() {
                    d(e + 1, t, i)
                }, 0);
                if (l.length) {
                    if (m = m || l, m.hasClass("pane-done")) return j.addClass("visuallyhidden");
                    j.removeClass("visuallyhidden").find(".pane").removeClass("active").filter(l).addClass("active").find(".onboarding-bubbles span").each(u), k.all(l.find(".postload")), r("view"), i && l.find(".btn-secondary").addClass("visuallyhidden"), 0 === e && (v.query && v.query.q && j.find(".pane-login h1 span").html(v.query.q), n("../../user/buttons")(), j.find(".secondary-cta").removeClass("visuallyhidden")), c["x-yummly-auth-type"] = "yummly", c["x-yummly-auth-token"] = h.cookie("au"), A[s.index()] && (h.ajax({
                        url: "/mapi/v1/user/add-attribute",
                        method: "POST",
                        headers: c,
                        data: "attribute-type=onboarding-status&attribute=" + A[s.index()] + "-completed"
                    }), a()), A[e] && h.ajax({
                        url: "/mapi/v1/user/add-attribute",
                        method: "POST",
                        headers: c,
                        data: "attribute-type=onboarding-status&attribute=" + A[e] + "-shown"
                    }), j.find(".pane-demographics.active").length ? j.find('.pane-demographics input[name="onboarding-age"]').focus() : j.find(".pane-done.active").length && (j.addClass("animating"), o = setInterval(function() {
                        5 > p || (24 > p ? p % 2 && j.find(".pane-done li").eq(p / 2 - 1.5).toggleClass("active") : (j.find(".pane-done").addClass("collapsing"), clearInterval(o), g.location.reload(!0))), p += 1
                    }, E))
                }
            }

            function p() {
                var e = j.find(".pane-demographics"),
                    t = e.find(".onboarding-sentence");
                t.html(t.text().replace(/__([a-z]+)__/g, function(e, t) {
                    var n = "gender" === t ? "text" : "tel";
                    return '<input type="' + n + '" name="onboarding-' + t + '">'
                })), e.find("input").on("focus", function() {
                    var e = h('.onboarding-helper[data-target="' + h(this).attr("name") + '"]');
                    j.find(".onboarding-helper").addClass("visuallyhidden"), e && e.removeClass("visuallyhidden"), r("view", null, h(this).attr("name").replace(/onboarding-(.)/, function(e, t) {
                        return t.toUpperCase()
                    }))
                }).on("blur", function() {
                    "onboarding-gender" !== h(this).attr("name") && (h(this).val(h(this).val().replace(/[^0-9]/g, "")), h(this).val() && r("typed", h(this).val()))
                }).filter('[name="onboarding-gender"]').on("keypress", function(e) {
                    e.preventDefault()
                }), e.find(".amount").text(0).siblings(".spinner-up, .spinner-down").on("click", function() {
                    var t = h(this),
                        n = t.hasClass("spinner-up"),
                        i = n ? 1 : -1,
                        a = t.siblings(".amount"),
                        o = t.siblings(".active"),
                        s = e.find('[name="onboarding-family"]'),
                        l = 0;
                    a.text(Math.max(0, parseInt(a.text(), 10) + i)), o.css("opacity", 1).animate({
                        opacity: 0
                    }), e.find(".amount").each(function(e, t) {
                        l += parseInt(h(t).text(), 10)
                    }), s.val(l), r("spinner", l, n ? "Up" : "Down")
                }), e.find(".slider-handle").on("mousedown", function() {
                    var t = h(this),
                        n = t.siblings(".slider-background"),
                        i = n.width(),
                        a = n.offset().left,
                        o = t.width(),
                        s = e.find('[name="onboarding-age"]'),
                        l = function(e) {
                            e.clientX >= a + 3.75 * o && e.clientX <= a + i - 4.25 * o && (t.css("margin-left", e.clientX - a - 4.25 * o + "px"), s.val(Math.max(0, Math.round(140 * parseInt(t.css("margin-left"), 10) / i))))
                        },
                        c = function() {
                            h(g).off("mousemove", l).off("mouseup", c), r("slider", s.val())
                        };
                    h(g).on("mousemove", l).on("mouseup", c)
                })
            }

            function f(e, t, n) {
                var i = j.find(".pane-login"),
                    a = i.find("h1"),
                    r = i.find("h4"),
                    o = i.find(".wrap").eq(1),
                    s = j.find(".secondary-cta"),
                    l = j.find(".yummly-sheet");
                w.temp.set("logging-in", !0), e && a.html(e), n ? (o.data("type", "passwordExisting"), r.html(v.strings.login.sheet.signin.tagline), s.html(v.strings.login.sheet.signin.ctaSecondary), l.removeClass("tab-first tab-last").addClass("tab-first")) : (o.data("type", "password"), r.html(v.strings.onboarding.gatherPrefs.login.tagline), s.html(v.strings.onboarding.gatherPrefs.ctaSecondary), l.removeClass("tab-first tab-last").addClass("tab-last")), d(0), t && x.pushState(null, {
                    regPromo: !0,
                    title: e
                }, function(e) {
                    return function() {
                        var t = g.history,
                            n = t && t.state,
                            i = n && n.regPromo,
                            a = n && n.title;
                        j.toggleClass("visuallyhidden", !i).find(".dismiss").removeClass("visuallyhidden"), a && (j.find(".pane-login h1").html(a), e ? (r.html(v.strings.login.sheet.signin.tagline), s.html(v.strings.login.sheet.signin.ctaSecondary), l.removeClass("tab-first tab-last").addClass("tab-first")) : (r.html(v.strings.onboarding.gatherPrefs.login.tagline), s.html(v.strings.onboarding.gatherPrefs.ctaSecondary), l.removeClass("tab-first tab-last").addClass("tab-last")))
                    }
                }(n))
            }
            var m, h = n("jquery"),
                g = n("window"),
                v = n("yummly"),
                y = n("../../utilities/width"),
                b = n("../../utilities/view"),
                x = n("../../utilities/history"),
                w = n("../../utilities/storage"),
                k = n("../../utilities/postload"),
                C = n("../../utilities/page"),
                j = h("#onboarding-prefs"),
                T = h(".y-image img[data-src], img[itemprop=image]"),
                S = g.location.origin + "/img/1x1.gif",
                N = 50,
                E = 250,
                D = 0,
                A = [null, "cooking-skill", "demographic-preference", "cuisine-preference", "diet-preference", "allergy-preference", null, "animation"],
                L = {},
                $ = v.enabledFeatures.indexOf("auto-login-sheet") > -1;
            e.exports = function() {
                var t = v.user && !v.user.anonymous,
                    n = v.user && v.user.attributes && v.user.attributes["onboarding-status"] || [],
                    i = /[?&]prm-v1/.test(g.location.search);
                if (j.find(".onboarding-recipes li").each(function(e, t) {
                        h(t).css("background-image", "url(" + s() + ")"), e || j.find(".onboarding-small-background").css("background-image", h(t).css("background-image"))
                    }), j.find(".dismiss").on("click", function() {
                        var e = new Date;
                        e.setTime(e.getTime() + 1296e6), v.user && !v.user.anonymous && h.cookie("yOP", "dismissed", {
                            expires: e,
                            path: "/"
                        }), r("dismiss", "X"), j.addClass("visuallyhidden").find(".pane").removeClass("active show-email").find(".multistep-email form").find(">:first-child, >:last-child").addClass("init"), j.find(".multistep-email .wrap").removeClass("active completed").first().addClass("active")
                    }), j.find(".onboarding-bubbles li").on("click", function() {
                        var e = h(this),
                            t = e.siblings(".active"),
                            n = e.closest("[data-target]");
                        e.toggleClass("active"), e.data("id") ? (e.parent().data("xor") ? t.removeClass("active") : t.filter(function() {
                            return !h(this).data("id")
                        }).removeClass("active"), c()) : t.filter("[data-id]").removeClass("active"), n.length && setTimeout(function() {
                            j.find('[name="' + n.data("target") + '"]').val(e.hasClass("active") ? e.text() : "").next("input").focus()
                        }, 500), e.hasClass("active") ? r("set", e.text()) : r("unset", e.text())
                    }).each(function(e, t) {
                        var n = h(t),
                            i = n.css("background-image"),
                            a = n.data("id");
                        a && i && "none" !== i && n.css("background-image", i.replace("1x1.gif", "navi/prefs/" + (a || "none").replace(/.+\^/, "") + ".png"))
                    }), j.find(".pane .btn-primary").on("click", function() {
                        if (!h(this).data("animating")) {
                            var e = h(this),
                                t = e.closest(".pane"),
                                n = t.find(".onboarding-bubbles li"),
                                i = parseInt(n.css("top"), 10),
                                a = parseInt(n.css("margin-top"), 10),
                                r = parseInt(n.css("margin-bottom"), 10),
                                o = i - 2 * (n.height() + a + r + 4),
                                s = 5,
                                l = Math.ceil(n.length / s);
                            o <= -1 * n.height() * l && (o = "0"), n.css("top", o + "px"), e.data("animating", !0), setTimeout(function() {
                                e.data("animating", !1)
                            }, 4 * E)
                        }
                    }), j.find(".btn-onboarding").not(".multistep-email .btn-onboarding").on("click", function() {
                        var e, t = h(this).hasClass("btn-tertiary"),
                            n = t ? 1 : -1,
                            i = h(this).closest(".pane");
                        return i.hasClass("pane-demographics") && (e = i.find(".onboarding-helper").not(".visuallyhidden"), t && "onboarding-family" !== e.data("target") || !t && "onboarding-age" !== e.data("target")) ? i.find('input[name="' + e.data("target") + '"]')[t ? "next" : "prev"]().focus() : (d(i.index() + n, !t), void r("navigate", t ? "Next" : "Previous"))
                    }), p(), v.isRegularPage && !i)
                    if (t || j.hasClass("manual") || !$) {
                        if (t && w.temp.get("logging-in") && y.supportsOnboarding()) {
                            w.temp.set("logging-in", !1);
                            for (var a = 0, o = A.length; o > a; a += 1)
                                if (A[a] && n.indexOf(A[a] + "-completed") < 0) return d(a, !1, !0)
                        }
                    } else if (C.isFirstPageview() && !b("login")) {
                    if ("dismissed" !== h.cookie("yLogin")) {
                        var l = new Date;
                        l.setTime(l.getTime() + 1296e6), h.cookie("yLogin", "dismissed", {
                            expires: l,
                            path: "/"
                        }), f(null, !0)
                    }
                } else e.exports.showSecondLogin()
            }, e.exports.showSecondLogin = function() {
                v.user && !v.user.anonymous || /[?&]prm-v1/.test(g.location.search) || (f(b("recipe/recipe") && v.strings.onboarding.gatherPrefs.login.genericRecipe), v.enabledFeatures.indexOf("show-second-login-dismiss") < 0 && j.find(".dismiss").addClass("visuallyhidden"))
            }, e.exports.handleLoginClicks = function() {
                h(".nav-login, .yummly-login-sheet").on("click", function(e) {
                    e.preventDefault(), h(this).hasClass("btn-secondary") ? f(v.strings.login.sheet.signin.title, !0, !0) : f(v.strings.login.sheet.generic, !0)
                }), h(".login-yum-click").on("click", function(e) {
                    e.preventDefault(), f(v.strings.login.sheet.yum, !0), n("../../user/buttons")(h(this).attr("urlname"))
                }), h(".login-write").on("click", function(e) {
                    e.preventDefault(), f(v.strings.login.sheet.yum, !0), n("../../user/buttons")("My Review")
                }), j.find(".secondary-cta").on("click", function() {
                    h(this).html() === v.strings.login.sheet.signin.ctaSecondary ? h(".login-state button").first().click() : h(".login-state button").last().click(), h(this).blur()
                }), e.exports.handleLoginClicks = function() {}
            }, e.exports.track = r
        },
        "profile/urb/custom-recipes.js": function(e, t, n) {
            function i(e) {
                var t = e.elements,
                    n = {},
                    i = w("#recipe-image").data("image"),
                    a = ["ingredientLines", "preparationSteps"];
                return w.each(t, function(e, t) {
                    var i = t.name,
                        r = w(t).val();
                    "numberOfServings" === i && (r = parseInt(r)), r && (w.inArray(i, a) > -1 ? ("undefined" == typeof n[i] && (n[i] = []), n[i].push(r)) : n[i] = r)
                }), i && (n.matchingImages = ["string" == typeof i ? JSON.parse(i) : i]), n
            }

            function a() {
                w(".error").html(""), w.each(C, function(e, t) {
                    w("input[name=" + t + "], textarea[name=" + t + "], button[name=" + t + "]").closest(".section").find(".error").html(j[t])
                }), w(".error:not(:empty)").length && w(".application-body").scrollTop(w(".error:not(:empty)").first().position().top)
            }

            function r(e) {
                (!e.title || e.title.length < 2) && C.push("title")
            }

            function o(e) {
                var t = "ingredientLines";
                return !e[t] || e[t].length < 2 ? void C.push(t) : void w.each(e.ingredientLines, function(e, n) {
                    return n.length < 2 ? void C.push(t) : void 0
                })
            }

            function s(e) {
                var t = "numberOfServings";
                return e[t] && isNaN(e[t]) ? void C.push(t) : void 0
            }

            function l(e) {
                var t = "preparationSteps";
                return !e[t] || e[t].length < 1 ? void C.push(t) : void w.each(e[t], function(e, n) {
                    return n.length < 2 ? void C.push(t) : void 0
                })
            }

            function c(e) {
                return C = [], r(e), C.length > 0 ? C : null
            }

            function u(e) {
                return C = [], r(e), o(e), s(e), l(e), C.length > 0 ? C : null
            }

            function d(e) {
                if (e.success && e.src) {
                    var t = e.src.resizableImageWidth < 480 || e.src.resizableImageHeight > 1.15 * e.src.resizableImageWidth,
                        n = t ? "=s230-c" : "=s730";
                    w(".upload-link").addClass("hide"), w(".upload-change").removeClass("hide"), w("#recipe-image").attr("src", e.src.resizableImageUrl + n).data("image", JSON.stringify(e.src)).closest(".image-wrapper").css("background-image", 'url("/img/recipe-page-gradient.png"),url("' + e.src.resizableImageUrl + n + '")'), w("#customRecipe").addClass("has-image").toggleClass("small-image", t)
                }
            }

            function p() {
                var e = w("#newImage"),
                    t = k.clone().append(v.addrecipe.message.upload),
                    n = w.ninja.dialog({
                        html: t
                    });
                n.open(), e.parent("form").ajaxSubmit({
                    error: function() {
                        n.close(), w("#label-src .error").html(j.images)
                    },
                    success: function(e) {
                        n.close(), d(JSON.parse(e))
                    }
                })
            }

            function f() {
                var e = w("#newImage"),
                    t = w("#image-mime-type");
                e.off("change").on("change", function() {
                    var e = this.value || "";
                    if (w("#label-src .error").html(""), e) {
                        if (e.indexOf("\\") > -1 && (e = e.replace(/.+\\([^\\]+)/, "$1")), !/\.(jpe?g|png)$/i.test(e)) return w("#label-src .error").html(j.images);
                        if (/\.(jpe?g)$/i.test(e) && t.val("jpeg"), h.URL) {
                            var n, i = this.files[0];
                            if (i) {
                                if (i.size / 1024 / 1024 > 10) return w("#label-src .error").html(j.images);
                                n = new h.Image, n.onload = function() {
                                    return this.width < 230 || this.height < 230 ? w("#label-src .error").html(j.images) : void p()
                                }, n.src = h.URL.createObjectURL(i), h.URL.revokeObjectURL(i)
                            }
                        }
                        w("#admin-upload-src").val(e)
                    }
                }).click()
            }

            function m() {
                w(".step-text").first().attr("placeholder", v.addrecipe.phdirectionslong), w(".ingredient-text").first().attr("placeholder", v.addrecipe.phaddlong)
            }
            var h = n("window"),
                g = n("yummly"),
                v = g.strings,
                y = g.locale.headers,
                b = n("../../utilities/entities"),
                x = n("../../vendors/kahuna"),
                w = n("jquery"),
                k = w('<span class="loading-message">').append(w(".loading-image").first().show()),
                C = [],
                j = {
                    ingredientLines: v.addrecipe.error.ing,
                    images: v.addrecipe.error.images,
                    title: v.addrecipe.error.title,
                    preparationSteps: v.addrecipe.error.prep,
                    numberOfServings: v.addrecipe.error.serv,
                    maxDrafts: v.addrecipe.error.maxDrafts,
                    general: v.addrecipe.error.gen
                },
                T = !1;
            e.exports = function() {
                function e(e) {
                    var t = e.find(".delete-row");
                    t.toggleClass("visuallyhidden", t.length < 2)
                }

                function t() {
                    var t = w(this).closest(".all-list"),
                        n = t.children(".line-wrapper"),
                        i = n.first(),
                        a = i.clone(!0).addClass("visuallyhidden"),
                        r = n.length,
                        o = a.find("textarea").first(),
                        s = o.hasClass("ingredient-text"),
                        l = o.hasClass("step-text");
                    100 > r && (o.val("").attr("placeholder", s ? v.addrecipe.phaddshort : l ? v.addrecipe.phdirectionsshort : ""), n.last().after(a), setTimeout(function() {
                        a.removeClass("visuallyhidden"), e(t)
                    }, 20))
                }
                var n = w("#customRecipe")[0],
                    r = w(".add-line"),
                    o = w(".delete-row"),
                    s = w("#saveDraft"),
                    l = w("#publish"),
                    p = w("form:not(.draft-max) .upload-link"),
                    S = w(".upload-change-menu .remove"),
                    N = w(".upload-change-menu .edit"),
                    E = w("#recipe-image").data("image");
                m(), w(".draft-max input, .draft-max textarea").on("keyup", function() {
                    w(this).val(""), w(".section-title").find(".error").html(j.maxDrafts)
                }), w(".draft-max .upload-link").on("click", function() {
                    w(".section-title").find(".error").html(j.maxDrafts)
                }), p.add(N).on("click", function() {
                    w("#label-src .error").html(""), f()
                }), S.on("click", function() {
                    w("#label-src .error").html(""), w(".upload-link").removeClass("hide"), w(".upload-change").addClass("hide"), w("#recipe-image").attr("src", "img/1x1.gif").data("image", "").closest(".image-wrapper").css("background-image", "none"), w("#customRecipe").removeClass("has-image small-image")
                }), w("#deleteRecipe").on("click", function(e) {
                    e.preventDefault();
                    var t = i(n);
                    return t.recipeId ? void w.ajax({
                        url: "/api/custom-recipes/id/" + encodeURIComponent(t.recipeId),
                        type: "DELETE",
                        error: function(e, t, n) {
                            w.ninja.log("Custom recipes delete error " + n)
                        },
                        success: function() {
                            h.location.href = h.location.origin + h.location.pathname
                        },
                        headers: y
                    }) : !1
                }), s.on("click", function(e) {
                    e.preventDefault();
                    var t = i(n);
                    if (c(t)) a();
                    else {
                        var r = t.recipeId ? "/api/custom-recipes/id/" + encodeURIComponent(t.recipeId) : "/api/custom-recipes/insert",
                            o = k.clone().append(v.addrecipe.message.upload),
                            s = w.ninja.dialog({
                                html: o
                            });
                        s.open(), y["X-Yummly-Auth-Token"] = encodeURIComponent(w.cookie("au")), w.ajax({
                            url: r,
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify(t),
                            error: function(e) {
                                if (s.close(), 400 === e.status) {
                                    var t = e.responseJSON;
                                    w.each(t, function(e) {
                                        C.push(e)
                                    })
                                } else C.push("general")
                            },
                            success: function(e) {
                                e && (x.track("Recipe Draft Add"), h.mixpanel.track("Recipe Draft Add", {
                                    "Recipe Add Type": "Add your recipe",
                                    "Draft ID": b.unescapeHtml(e),
                                    "Recipe Source": "",
                                    "User Profile Name": b.unescapeHtml(g.user.userName)
                                }), h.location.href = h.location.origin + "/addyourrecipe")
                            },
                            headers: y
                        })
                    }
                }), l.on("click", function(e) {
                    function t(e) {
                        if (l.close(), 400 === e.status) {
                            var t = e.responseJSON;
                            w.each(t, function(e) {
                                C.push(e)
                            })
                        } else C.push("general");
                        a()
                    }
                    h.document.activeElement.blur(), w("input, textarea").blur(), h.scrollTo(0, 0), e.preventDefault();
                    var r = i(n);
                    if (u(r)) a();
                    else {
                        var o = "/api/custom-recipes/publish",
                            s = k.clone().append(v.addrecipe.message.publish),
                            l = w.ninja.dialog({
                                html: s
                            });
                        l.open(), y["X-Yummly-Auth-Token"] = encodeURIComponent(w.cookie("au")), w.ajax({
                            url: o,
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify(r),
                            error: t,
                            success: function(e) {
                                if ("string" == typeof e) try {
                                    e = JSON.parse(e)
                                } catch (n) {
                                    return t({
                                        status: 500
                                    })
                                }
                                if (e && e.recipeUrl) {
                                    x.track("Recipe Add"), h.mixpanel.track("Recipe Add", {
                                        "Recipe Add Type": "Add your recipe",
                                        "Recipe ID": e.recipeUrl,
                                        "Recipe Source": "",
                                        "User Profile Name": b.unescapeHtml(g.user.userName)
                                    }), h.mixpanel.track("Yum Button", {
                                        "Recipe ID": e.recipeUrl,
                                        "Recipe Source": "",
                                        "Yum UI Type": "Add your recipe",
                                        Yum: !0
                                    });
                                    var i = w.ninja.dialog({
                                        html: w("#recipe-published").html(),
                                        clickscreen: function() {
                                            w("#closeDialogSuccess").click()
                                        }
                                    });
                                    l.close(), i.open(), w("#closeDialogSuccess").on("click", function() {
                                        i.close(), h.location.href = h.location.origin + "/addyourrecipe"
                                    }), w("#recipe-link").attr("href", "/recipe/" + e.recipeUrl), w("#recipe-link").html(b.escapeHtml(r.title))
                                }
                            },
                            headers: y
                        })
                    }
                }), r.on("click", t), o.on("click", function() {
                    var t = w(this),
                        n = t.closest(".line-wrapper"),
                        i = n.closest(".all-list"),
                        a = n.hasClass("ing-wrapper") ? v.addrecipe.phaddlong : v.addrecipe.phdirectionslong;
                    !T && n.siblings(".line-wrapper").length ? (T = !0, n.addClass("visuallyhidden"), setTimeout(function() {
                        n.remove(), i.find("textarea").first().attr("placeholder", a), e(i), T = !1
                    }, 600)) : n.find("textarea").first().val(""), m()
                }), w(".ingredient-text, .step-text").on("keyup", function() {
                    w(this).closest(".all-list").find("textarea").last().val() && t.apply(this)
                }), w(".description textarea").on("blur keyup change", function() {
                    w(this).css("height", w(this).css("height", "auto").get(0).scrollHeight + "px")
                }), E && d({
                    success: !0,
                    src: E
                })
            }
        },
        "recipe/dialog-email-script.js": function(e, t, n) {
            function i(e, t) {
                var n, i = !0,
                    a = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (e && e.length > 0) {
                    if (n = e.split(/[,;\s]/), !(t && n.length > 1)) return a.test(e);
                    d.each(n, function(e, t) {
                        t = t.trim(), t && !a.test(t) && (i = !1)
                    })
                } else i = !1;
                return i
            }

            function a(e, t, n) {
                var i = e.val(),
                    a = i.length;
                return a > t ? (n.html("You are limited to " + t + " characters."), e.val(i.substr(0, t)), !1) : (n.html(t - a + " characters remaining."), !0)
            }

            function r() {
                m.close(), h.open(), d("#closeDialogSuccess").on("click", function() {
                    h.close()
                })
            }

            function o(e) {
                p.log(e)
            }

            function s(e) {
                d.ajax({
                    url: "/api/emailRecipe",
                    type: "POST",
                    cache: !1,
                    data: e,
                    error: function(e, t, n) {
                        o(n)
                    },
                    success: function(e) {
                        r(e)
                    },
                    headers: u.locale.headers
                })
            }

            function l(e) {
                var t = {};
                return t.recipeId = d('input[name="recipeId"]', e).val(), t.recipeUrl = d('input[name="recipeUrl"]', e).val(), t.recipeTitle = d('input[name="recipeTitle"]', e).val(), t.toEmail = d('input[name="toEmail"]', e).val(), t.fromEmail = d('input[name="fromEmail"]', e).val(), t.fromName = d('input[name="fromName"]', e).val(), t.personalNote = d('textarea[name="personalNote"]', e).val(), t.ccChecked = "on" === d('input[name="ccChecked"]:checked').val(), t
            }

            function c(e, t, n) {
                e.addClass("alert"), t.text("").append(n)
            }
            var u = n("yummly"),
                d = n("jquery"),
                p = n("../utilities/debug"),
                f = n("../utilities/entities").unescapeHtml,
                m = d.ninja.dialog({
                    html: d("#dialog-email").html()
                }),
                h = d.ninja.dialog({
                    html: d("#dialog-email-success").html()
                });
            e.exports = function() {
                d("#button-email, .share-mail").on("click", function() {
                    m.open(), d('input[name="fromEmail"]').val(u.user.email || ""), d('input[name="fromName"]').val(f(u.user.name || u.user.fullName && u.user.fullName.first || ""));
                    var e = d('textarea[name="personalNote"]'),
                        t = d("#emailForm"),
                        n = d("#remainingCharsEmailMsg");
                    d("#closeDialogEmail").unbind("click").on("click", function() {
                        m.close()
                    }), e.unbind("keyup").on("keyup", function(t) {
                        t.preventDefault(), a(e, 400, n)
                    }), d("#emailRecipeButton").unbind("click").on("click", function(e) {
                        e.preventDefault();
                        var n = l(t),
                            a = i(n.toEmail, !0),
                            r = i(n.fromEmail, !1),
                            o = a && r;
                        o ? s(n) : (a || c(d('input[name="toEmail"]'), d('label[for="toEmail"]'), '<span id="toEmailMsg" class="alert">Please enter your recipients email address(es)</span>'), r || c(d('input[name="fromEmail"]'), d('label[for="fromEmail"]'), '<span id="fromEmailMsg" class="alert">Please enter your email address</span>'))
                    })
                })
            }
        },
        "profile/collections/create.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window"),
                r = n("yummly"),
                o = n("../../vendors/kahuna"),
                s = n("../../utilities/entities"),
                l = r.errors,
                c = l && l[0] && "create" === l[0].form;
            e.exports = function() {
                function e(e) {
                    var t = i(i.parseHTML(i("#" + e).html())),
                        n = i.ninja.dialog({
                            html: t
                        });
                    t.find(".ninja-close-dialog").on("click", function(e) {
                        e.preventDefault(), n.close()
                    }), t.find("[type=submit]").on("click", function(e) {
                        var n = s.unescapeHtml(r.user.userName),
                            i = t.find("[name=name]").val();
                        i && a.mixpanel && (e.preventDefault(), o.track("Collection Created"), a.mixpanel.track("Collection Created", {
                            "Collection Name By Owner": n + "/" + i,
                            "Collection Name Unique": i
                        }, function() {
                            t.find("form").submit()
                        }))
                    }), c && i.each(l, function(e, n) {
                        n.field ? (t.find("[name=" + n.field + "]").addClass("error"), t.find("label[for=" + n.field + "]").append('<span class="error">' + n.message + "</span>")) : t.find("form").prepend('<div class="error">' + n.message + "</div>")
                    }), n.open()
                }
                c && e("dialog-collection-create"), i(".y-collection-create").on("click", function() {
                    e("dialog-collection-create")
                })
            }
        },
        "profile/reco/not-interested.js": function(e, t, n) {
            function i(e) {
                s.ajax({
                    url: "/api/widget/action",
                    type: "POST",
                    cache: !1,
                    data: {
                        "action-type": "notInterested",
                        vote: "yes",
                        href: d + "recipe/" + e
                    },
                    success: function() {
                        n("./get-reco-status")({
                            userID: u,
                            timer: 1e4,
                            pollStatus: !0
                        })
                    },
                    headers: l.locale.headers
                })
            }

            function a(e) {
                var t = (new Date).getTime(),
                    n = {
                        time_stamp: t,
                        yv: c.yvCookie,
                        action: "notInterested",
                        recipe_url: e.data("id"),
                        current_url: c.current_url,
                        previous_url: c.previous_url,
                        row: e.data("row"),
                        position: e.data("position"),
                        cluster: e.data("cluster")
                    };
                s.ajax({
                    url: "/api/recommendation/sendTrackingEvent?username=" + u,
                    type: "POST",
                    cache: !1,
                    data: n,
                    headers: l.locale.headers
                })
            }

            function r(e) {
                s("#" + e).remove()
            }
            var o = n("window"),
                s = n("jquery"),
                l = n("yummly"),
                c = l.user,
                u = c.encoded && c.encoded.id,
                d = l.locale.domain.canonical;
            e.exports = function() {
                s(o.document).on("click", ".not-interested", function() {
                    var e = s(this).parents(".y-card"),
                        t = e.data("id");
                    i(t), a(e), r(t)
                })
            }
        },
        "tools/complementary-product.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i(".tools-content form").on("submit", function(e) {
                    e.preventDefault();
                    var t = i("[name=brand]").val(),
                        n = i("[name=image]").val(),
                        a = i("[name=destination]").val(),
                        r = i("[name=textPrimary]").val(),
                        o = i("[name=textSecondary]").val(),
                        s = i("[name=thirdPartyImpression]").val(),
                        l = i("[name=thirdPartyClick]").val(),
                        c = "";
                    l && (a = l + "?" + a), c = '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway:400,700"><style>*{color:#383838;font-size:14px;font-weight:300;line-height:20px;margin:0;padding:0;font-family:Raleway,"Helvetica Neue",Helvetica,Arial,sans-serif}.ad{background:#e1ddd2;display:block;height:100%;width:100%}a{text-decoration:none}img{background:#fff;float:left;height:64px;margin:0;padding:5px 20px 5px 10px;width:64px}.ad:after{display:block;content:"";position:absolute;top:28px;left:76px;border:9px solid transparent;border-right-color:#e1ddd2}strong{font-weight:600}.light{color:#bab39a;font-size:11px;font-weight:700}.copy{position:absolute;top:17px;left:84px;right:15px;max-height:60px;margin:0 30px 0 60px;overflow:hidden}.copy a{border-right:5px solid transparent}@media only screen and (max-width:480px){a,strong{font-size:12px}.copy{top:8px;max-height:60px;margin:0 0 0 30px}}</style><div class="ad"><a target="_blank" href="%%CLICK_URL_ESC%%' + a + '"><img src="' + n + '"></a><span class="copy"><a target="_blank" href="%%CLICK_URL_ESC%%' + a + '"><strong>' + r + "</strong> " + o + '</a><a target="_blank" href="%%CLICK_URL_ESC%%' + a + '" class="light">Sponsored by ' + t + "</a></span></div>", s && (s = s.replace(/\[timestamp\]/g, "%%CACHEBUSTER%%"), c += /^http/.test(s) ? '<img src="' + s + '" style="width: 1px; height: 1px margin-top: -1px;">' : s), i(".tool-output").removeClass("hidden").find("textarea").val(c)
                })
            }
        },
        "overlays/promos/mobile-promo.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly"),
                r = n("../../utilities/history"),
                o = n("../../utilities/page"),
                s = n("./mobile-promo-track"),
                l = n("jquery");
            e.exports = function() {
                function e(e) {
                    e ? (c.removeClass("visuallyhidden"), l("body").addClass("lock-position")) : (c.addClass("visuallyhidden"), l("body").removeClass("lock-position"), i.scrollTo(0, 0))
                }
                var t = !a.user || a.user.anonymous,
                    c = l("#mobile-promo-overlay"),
                    u = "dismissed" === l.cookie("yMO"),
                    d = /[?&]prm-v1/.test(i.location.search);
                if (!o.isFirstPageview() && t) {
                    if (!(a.enabledFeatures.indexOf("second-pageview-download") > -1)) return n("../onboarding/prefs").showSecondLogin();
                    u = !1, a.enabledFeatures.indexOf("show-second-download-dismiss") < 0 && c.find(".action-dismiss").remove()
                }
                if (!d && !u && c.length) {
                    var p = a.strings.ads,
                        f = l(".landing .title").text(),
                        m = l("[itemprop=name]:first").text(),
                        h = p.overlay.taglineGeneric,
                        g = f || m,
                        v = c.find(".mobile-promo-background"),
                        y = l("#cards .y-image img, img[itemprop=image]").eq(0).attr("src"),
                        b = p.app.track.click,
                        x = /recipe\/(recipe|external)/.test(a.view),
                        w = /recipe\/(search|outsearch)/.test(a.view),
                        k = "Overlay 2.0",
                        C = function() {
                            e(), i.history && i.history.state && i.history.state.promo && i.history.back()
                        };
                    c.on("click", function(e) {
                        e.preventDefault();
                        var t = l(e.target),
                            n = c.find("a").attr("href") || "";
                        t.hasClass("action-dismiss") ? (s("dismiss", b, k), l.cookie("yMO", "dismissed", {
                            expires: 15,
                            path: "/"
                        }), C()) : n ? (s("click", b, k), i.open(n)) : C()
                    }), x ? c.find(".btn").text(p.overlay.downloadSingular) : w ? !g && a.query.q && (g = p.overlay.recipes.replace("%s", a.query.q)) : (y = "", g = "", c.find(".btn").text(p.overlay.downloadGeneric)), g ? c.find("strong").text(g) : c.find(".mobile-promo-tagline").html(h), y && (y = y.replace("s230-c", "s730-c"), v.css({
                        "background-image": "url(" + y + ")",
                        opacity: "0.5",
                        filter: "blur(10px)",
                        "-webkit-filter": "blur(10px)"
                    })), o.isFirstPageview() && t && r.pushState(null, {
                        promo: !0
                    }, function() {
                        var t = i.history,
                            n = t && t.state,
                            a = n && n.promo;
                        e(a)
                    }), e(!0), s("impression", b, k)
                }
            }
        },
        "vendors/comscore-distributed.js": function(e, t, n) {
            var i = n("window"),
                a = n("../../utilities/debug");
            e.exports = function() {
                if (i.COMSCORE && i.COMSCORE.beacon) {
                    var e = 7,
                        t = 14761013,
                        n = 986,
                        r = {
                            beacon: i.COMSCORE.beacon,
                            options: i._comscore
                        };
                    r.options.push({
                        c1: e,
                        c2: t,
                        c3: n
                    }), r.beacon({
                        c1: e,
                        c2: t,
                        c3: n
                    }), a.log("page view", "comscore")
                }
            }
        },
        "profile/reco/get-reco-status.js": function(e, t, n) {
            function i() {
                o("#reco-notice-dot").addClass("new-dot"), o(".reco-notice").addClass("new-rec"), o("#reco-notice-dot").on("mouseenter", function() {
                    o("#reco-notice-message").removeClass("notice-timed")
                }), o("#reco-notice-dot").on("mouseleave", function() {
                    o("#reco-notice-message").addClass("notice-timed")
                }), r.setTimeout(function() {
                    o("#reco-notice-message").addClass("notice-timed")
                }, 3e3)
            }

            function a(e, t, n, l) {
                var c = n ? 2 * parseInt(n, 10) : 3e3;
                o.ajax({
                    url: "/api/recommendation/getStatus?username=" + e,
                    type: "GET",
                    cache: !1,
                    dataType: "json",
                    error: function() {
                        l && l()
                    },
                    success: function(n) {
                        "new" === n.status ? i() : t && 6e4 >= c && r.setTimeout(function() {
                            a(e, t, c)
                        }, c)
                    },
                    headers: s.locale.headers
                })
            }
            var r = n("window"),
                o = n("jquery"),
                s = n("yummly"),
                l = s.view,
                c = n("../../utilities/error/required");
            e.exports = function(e, t) {
                if (!c(e, ["userID"])) return !1;
                var n = e.userID,
                    i = e.timer,
                    r = e.pollStatus;
                return "profile/recommended" !== l || r ? void a(n, r, i, t) : !1
            }
        },
        "profile/urb/goodies/yumbutton.js": function(e, t, n) {
            var i = n("jquery");
            e.exports = function() {
                i("input[name=platform]").on("change", function() {
                    i("#blog-platform").submit()
                })
            }
        },
        "profile/collections/add-recipe.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window"),
                r = n("yummly"),
                o = n("../../vendors/kahuna"),
                s = n("../../utilities/error/required"),
                l = n("../../utilities/error/ajax"),
                c = n("../../utilities/entities");
            e.exports = function(e, t) {
                if (!s(e, ["recipeID", "collectionName"])) return !1;
                var n = e.recipeID,
                    u = e.itemType || "recipe",
                    d = e.collectionName,
                    p = r.myCollections[d].urlName,
                    f = p === i("#default-collection").data("url"),
                    m = f ? "/yum" : "/recipe",
                    h = f ? e.user : p;
                if (!f && a.mixpanel) {
                    var g = i("div").find('[data-id="' + n + '"]').find(".y-source").text();
                    o.track("Collection Item Added"), a.mixpanel.track("Collection Add Recipe", {
                        "Recipe ID": n,
                        "Recipe Source": i.trim(g || i("#sourceLink").text()).replace(/\s+\/\s+/, " / "),
                        "Collection Name By Owner": c.unescapeHtml(r.user.userName) + "/" + d,
                        "Collection Name Unique": d
                    })
                }
                i.ajax({
                    url: "/mapi/v3/collections/" + encodeURIComponent(h) + m,
                    type: "POST",
                    cache: !1,
                    data: {
                        recipe: n,
                        type: u,
                        "collect-once": !1
                    },
                    error: l,
                    success: function() {
                        t && t()
                    },
                    headers: r.locale.headers
                })
            }
        },
        "profile/collections/collections.js": function(e, t, n) {
            function i(e) {
                this.collectedPrefix = p.pronoun, this.collectedClass = "yummed", this.$yumButton = o(e), this.$yumButtonWrapper = o(e).parent(), this.$card = this.$yumButton.parents(".y-card, .y-grid-card"), this.urlName = o(e).attr("urlName"), this.$youLink = o('<a class="pronoun" href="/profile/' + (h.encoded && h.encoded.id) + '">' + p.pronoun + "</a>"), this.$label = o(".display-count", this.$yumButtonWrapper), this.collected = this.$label.attr("y") && "true" === this.$label.attr("y"), this.currYumCount = this.$label.length && o.trim(this.$label.text().replace(this.collectedPrefix, "").replace("+", "")), this.memberCount = 0, this.updateMyCollections()
            }

            function a(e, t, n) {
                var r = o(t),
                    l = t.getElementsByTagName("iframe"),
                    c = l && l[0],
                    u = c ? c.contentDocument || c.contentWindow.document : null,
                    f = u && u.getElementsByTagName("div"),
                    m = f && f[0],
                    g = m && m.id,
                    v = h.anonymous ? "login-yum-click" : "yum-click";
                return g ? (r.append('<div data-tooltip="' + p.tooltip + '" class="btn-yum btn-wrapper tooltip ' + v + '" urlname="' + g + '"><span class="yum"></span><span class="count" data-count="0"></span></div>'), o(r).hasClass("ad-y-card") || o(m).find(".infobox img").length || r.addClass("no-sponsor"), void o.ajax({
                    url: "/yum/info/" + g,
                    cache: !1,
                    headers: s.locale.headers
                }).done(function(e) {
                    if (e) {
                        var t = r.find("." + v),
                            n = o.data(t, "collection");
                        e.collections && o.each(e.collections, function() {
                            var e = s.collectionList[this].name;
                            s.myCollections[e].recipes.push(g)
                        }), n || (n = o.data(t, "collection", new i(t))), (e.userYummed || e.displayCount) && (e.userYummed && (n.collected = !0), n.currYumCount = e.displayCount, n.makeYumBubble(), n.makeYumButton(), r.find(".count").data("count", e.rawCount).text(e.displayCount))
                    }
                    d.handleLoginClicks()
                })) : setTimeout(function() {
                    n = n || 0, 20 > n && a(e, t, n + 1)
                }, 500)
            }
            var r = n("window"),
                o = n("jquery"),
                s = n("yummly"),
                l = n("../../vendors/kahuna"),
                c = n("../../utilities/entities"),
                u = n("../../utilities/page"),
                d = n("../../overlays/onboarding/prefs"),
                p = s.strings.yum,
                f = s.query,
                m = s.view,
                h = s.user,
                g = s.locale.domain.canonical;
            i.prototype = {
                updateMyCollections: function() {
                    var e = this.$card.data("collections") ? this.$card.data("collections").split(",") : [],
                        t = this.urlName;
                    o.each(e, function(e, n) {
                        var i = s.collectionList[n].name,
                            a = s.myCollections[i].recipes; - 1 === o.inArray(t, a) && a.push(t)
                    })
                },
                makeBasicLabel: function() {
                    var e = o("<span>");
                    return e.attr("y", this.collected), e.addClass("display-count"), e.addClass("mini"), e
                },
                changeUIElements: function() {
                    this.closeAllOverlays(), this.makeYumBubble(), this.makeYumButton(), this.makeOverlay()
                },
                getMemberCollectionList: function() {
                    var e = this,
                        t = 0,
                        n = [];
                    return o.each(s.myCollections, function(i, a) {
                        var r = o.inArray(e.urlName, a.recipes) > -1;
                        r && (t += 1), n.push({
                            name: a.name,
                            member: r,
                            urlName: a.urlName
                        })
                    }), this.memberCount = t, n
                },
                addCollection: function(e, t) {
                    s.myCollections[e] = {
                        recipes: [],
                        name: e,
                        urlName: t
                    }, this.updateCollectionRecipes(e)
                },
                updateCollectionRecipes: function(e) {
                    var t = o.inArray(this.urlName, s.myCollections[e].recipes);
                    t > -1 ? (s.myCollections[e].recipes.splice(t, 1), this.memberCount -= 1) : (s.myCollections[e].recipes.push(this.urlName), this.memberCount += 1), this.collected = !0, this.memberCount <= 0 && (this.collected = !1, i.trackYums(this.urlName, !1)), this.makeYumBubble(), this.makeYumButton()
                },
                updateItemList: function() {
                    var e = this.makeItemList();
                    this.$itemList.replaceWith(e), this.$itemList = e, e.find(":checked").length && !e.find("input").eq(0).prop("checked") && e.find("input").eq(0).click()
                },
                clickCollection: function(e, t) {
                    var i = this,
                        a = i.urlName,
                        r = o("#default-collection"),
                        s = r.prop("checked"),
                        l = "All Yums" === e,
                        c = n("./remove-recipe");
                    o(t).prop("checked") ? (n("./add-recipe")({
                        user: h.encoded && h.encoded.id,
                        itemType: this.$card.data("type"),
                        recipeID: a,
                        collectionName: e
                    }), l ? r.next().html(p.dialog.yummed) : s || r.click()) : (c({
                        recipeID: a,
                        collectionName: e
                    }), l && (r.next().html(p.dialog.unyummed), o(".item-container :checked").each(function(e, t) {
                        t = o(t), t.prop("checked", !1), i.updateCollectionRecipes(t.val()), c({
                            recipeID: a,
                            collectionName: t.val(),
                            preventAction: !0
                        })
                    }))), this.updateCollectionRecipes(e)
                },
                makeItemList: function() {
                    var e = this,
                        t = this.getMemberCollectionList(),
                        n = o("<div>"),
                        i = "All Yums";
                    return t.sort(function(e, t) {
                        return e.name === i ? -1 : t.name === i ? 1 : e.name.toLowerCase() < t.name.toLowerCase() ? -1 : 1
                    }), n.addClass("item-container"), o.each(t, function(t, i) {
                        var a = o("<label>"),
                            r = o("<input>"),
                            s = i.member,
                            l = i.name,
                            c = i.urlName,
                            u = "All Yums" === l;
                        a.addClass("checkbox"), r.addClass("checkbox"), r.attr({
                            type: "checkbox",
                            value: l
                        }).data("url", c), s && r.prop("checked", !0), u && r.attr("id", "default-collection"), r.on("click", function() {
                            e.clickCollection(l, this)
                        }), a.append(r), a.append("<span>" + (u ? r.prop("checked") ? p.dialog.yummed : p.dialog.unyummed : l) + "</span>"), n.append(a)
                    }), n
                },
                makeClose: function() {
                    var e = this,
                        t = o('<span class="y-icon">Y</span>');
                    return t.on("click", function(t) {
                        t.preventDefault(), e.closeOverlay()
                    }), this.currRecipe = !1, t
                },
                closeOverlay: function() {
                    this.$overlayContainer.remove()
                },
                closeAllOverlays: function() {
                    o(".overlay-wrapper").remove()
                },
                makeCreateCollectionBox: function() {
                    var e = this,
                        t = o("<div>"),
                        n = o('<div class="create-collection">'),
                        a = o('<button class="btn-nochrome" type="button">' + p.dialog.create + "</button>"),
                        u = o('<input class="ingredient-suggest" maxlength="40">'),
                        d = o('<div class="error">'),
                        f = o('<button class="btn-secondary" type="button">' + p.dialog.createButton + "</button>");
                    return t.hide(), d.hide(), u.keydown(function(e) {
                        13 === e.keyCode && (e.preventDefault(), f.trigger("click"))
                    }), a.on("click", function() {
                        t.show(), a.hide(), u.focus()
                    }), f.on("click", function() {
                        function t(e) {
                            d.text(e), d.show(), f.show()
                        }

                        function n(t) {
                            if (e.addCollection(a, t), e.updateItemList(), e.makeCreateCollectionBox().insertAfter(e.$overlayContainer.find("label").eq(0)), r.mixpanel) {
                                var n = o("div").find('[data-id="' + t + '"]').find(".y-source").text();
                                l.track("Collection Created"), r.mixpanel.track("Collection Created", {
                                    "Collection Name By Owner": c.unescapeHtml(s.user.userName) + "/" + a,
                                    "Collection Name Unique": a
                                }), l.track("Collection Item Added"), r.mixpanel.track("Collection Add Recipe", {
                                    "Recipe ID": t,
                                    "Recipe Source": o.trim(n || o("#sourceLink").text()).replace(/\s+\/\s+/, " / "),
                                    "Collection Name By Owner": c.unescapeHtml(s.user.userName) + "/" + a,
                                    "Collection Name Unique": a
                                })
                            }
                        }
                        var a = o.trim(u.val()),
                            p = e.clientCollectionErrorCheck(a);
                        p ? t(p) : (f.hide(), i.createCollectionAddRecipe(a, e.urlName, e.$card.data("type"), t, n))
                    }), t.append(u, f), n.append(d, a, t), n
                },
                clientCollectionErrorCheck: function(e) {
                    var t = /^([']*)$/,
                        n = !1;
                    return e ? t.test(e) && (n = p.error.notAllowed) : n = p.error.empty, n
                },
                makeOverlay: function() {
                    var e = this;
                    this.$overlayContainer = o("<form>"), this.$overlayContainer.addClass("overlay-wrapper"), this.$overlayContainer.append('<span class="overlay-title">' + p.dialog.add + "</span>"), this.$itemList = this.makeItemList(), this.$overlayContainer.append(this.$itemList), this.makeCreateCollectionBox().insertAfter(this.$overlayContainer.find("label").eq(0)), this.$overlayContainer.append(this.makeClose()), this.$yumButtonWrapper.append(this.$overlayContainer), this.$overlayContainer.hover(function() {
                        e.closeTimeout && (clearTimeout(e.closeTimeout), e.closeTimeout = null)
                    }, function() {
                        e.closeTimeout = setTimeout(function() {
                            e.closeOverlay()
                        }, 2e3)
                    })
                },
                makeYumBubble: function() {
                    var e, t, n = this.$yumButtonWrapper.closest(".primary, .y-grid-card").length;
                    n ? (t = this.$yumButtonWrapper.find(".count"), e = parseInt(t.data("count"), 10), isNaN(e) && (e = 0, t.data("count", "0")), t.text(s.formatYumCount(this.collected ? e + 1 : e))) : (t = this.currYumCount || this.collected ? this.makeBasicLabel() : null, this.removeLabel(), t && (this.collected && t.append(this.$youLink), this.currYumCount && (this.collected && t.append('<span class="conjunction"> + </span>'), t.append(this.currYumCount)), o("html").hasClass("list-view") && this.collected && !t.find(".conjunction").length && t.find(".pronoun").addClass("no-count"), this.$yumButtonWrapper.append(t)))
                },
                makeYumButton: function() {
                    var e = this;
                    setTimeout(function() {
                        e.collected ? e.$yumButton.addClass(e.collectedClass) : e.$yumButton.removeClass(e.collectedClass)
                    }, 0)
                },
                removeLabel: function() {
                    this.$label = o(".display-count", this.$yumButtonWrapper), this.$label.remove()
                },
                yumClick: function() {
                    var e = this.collected,
                        t = "All Yums",
                        n = "";
                    this.collected = !0, this.changeUIElements(), n = o("#default-collection").data("url"), e || o("#default-collection").prop("checked") || (i.publishAction(this.urlName, n, this.$card.data("type")), o("#default-collection").prop("checked", !0).next().html(p.dialog.yummed), this.updateCollectionRecipes(t), i.trackYums(this.urlName, !0, this.$yumButton))
                }
            }, i.trackYums = function(e, t, i, a) {
                var l = t === !0 ? "yum" : "unyum",
                    c = (new Date).getTime(),
                    u = {
                        time_stamp: c,
                        yv: h.yvCookie,
                        action: l,
                        recipe_url: e,
                        current_url: h.current_url,
                        previous_url: h.previous_url
                    },
                    d = o(i).closest(".y-card, .y-grid-card");
                d.length || (d = o(".y-card, .y-grid-card").find('[data-id="' + e + '"]')), "profile/recommended" === m && (u.row = d.data("row"), u.position = d.data("position"), u.cluster = d.data("cluster")), o.ajax({
                    url: "/api/recommendation/sendTrackingEvent?username=" + (h.encoded && h.encoded.id),
                    type: "POST",
                    cache: !1,
                    data: u,
                    error: function() {
                        a && a()
                    },
                    success: function() {
                        n("../reco/get-reco-status")({
                            userID: h.encoded && h.encoded.id,
                            pollStatus: !0
                        })
                    },
                    headers: s.locale.headers
                }), r.mixpanel && r.mixpanel.track("Yum Button", {
                    "Recipe ID": e,
                    "Recipe Source": o.trim(d.find(".y-source").text() || o("#sourceLink").text()).replace(/\s+\/\s+/, " / "),
                    "Yum UI Type": "button",
                    Yum: t
                })
            }, i.loginYumClick = function(e, t) {
                if (!(s.enabledFeatures.indexOf("new-manual-login-sheet") > -1)) {
                    var i = n("../../user/buttons"),
                        a = n("../../sheet");
                    "recipe/external" === m ? r.location.replace("/login") : a.open({
                        type: "sheet",
                        content: o("#shared-login-content").html(),
                        fn: function() {
                            i(e)
                        },
                        event: t
                    })
                }
            }, i.publishAction = function(e, t, n, a) {
                var o = "";
                "urb-url" === n ? i.addURBRecipeToFirstCollection(e, a) : r.FB && r.FB.getLoginStatus ? r.FB.getLoginStatus(function(n) {
                    "connected" === n.status && (o = n.authResponse.accessToken), i.addRecipeToFirstCollection(e, t, o, a)
                }) : i.addRecipeToFirstCollection(e, t, o, a)
            }, i.addRecipeToFirstCollection = function(e, t, n, i) {
                o.ajax({
                    url: "/mapi/v3/collections/" + (h.encoded && h.encoded.id) + "/yum",
                    type: "POST",
                    cache: !1,
                    data: {
                        recipe: e,
                        "collect-once": !0,
                        href: g + "recipe/" + e,
                        token: n || null
                    },
                    complete: function() {
                        i && i()
                    },
                    headers: s.locale.headers
                })
            }, i.addURBRecipeToFirstCollection = function(e, t) {
                o.ajax({
                    url: "/mapi/v3/collections/" + (h.encoded && h.encoded.id) + "/yum",
                    type: "POST",
                    cache: !1,
                    data: {
                        recipe: e,
                        "collect-once": !0,
                        type: "urb-url"
                    },
                    complete: function() {
                        t && t()
                    },
                    headers: s.locale.headers
                })
            }, i.createCollectionAddRecipe = function(e, t, n, i, a) {
                o.ajax({
                    url: "/mapi/v3/collections",
                    type: "POST",
                    cache: !1,
                    data: {
                        name: e,
                        recipe: t,
                        type: n || "recipe"
                    },
                    error: function(e) {
                        i && i(e.responseText)
                    },
                    success: function(e) {
                        a && a(e.urlName)
                    },
                    headers: s.locale.headers
                })
            }, e.exports = i, e.exports.init = function() {
                var e = f.loginRecipe.split(",")[0],
                    t = e && o('[urlname="' + e + '"]');
                o(r.document).on("click", function(e) {
                    o(e.target).closest(".btn-wrapper, .overlay-wrapper").length || o(".overlay-wrapper").remove()
                }), o(r.document).on("click", ".yum-click", function() {
                    o.data(this, "collection") || o.data(this, "collection", new i(this)), o.data(this, "collection").yumClick()
                }), o(r.document).on("click", ".login-yum-click", function(e) {
                    var t = o(e.target),
                        n = t.closest(".y-card, .y-grid-card");
                    n.length || (n = o(".y-card, .y-grid-card").find('[data-id="' + t.attr("urlname") + '"]')), r.mixpanel && (r.mixpanel.track("Login View", {
                        "Screen Type": u.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview",
                        Sheet: !0
                    }), r.mixpanel.track("Yum Button", {
                        "Recipe ID": n.attr("data-id"),
                        "Recipe Source": o.trim(n.find(".y-source").text() || o("#sourceLink").text()).replace(/\s+\/\s+/, " / "),
                        "Yum UI Type": "button",
                        Yum: !0
                    })), i.loginYumClick(o(this).attr("urlName"), e)
                }), "_" === e && s.recipe && s.recipe.id && (t = o('[urlname="' + s.recipe.id + '"]')), t.length && setTimeout(function() {
                    t.trigger("click").closest(".y-card, .y-grid-card, .recipe").get(0).scrollIntoView()
                }, 1e3), "home" === m && o("#hero, .ad-y-card").each(a)
            }
        },
        "profile/reco/new-recommendations.js": function(e, t, n) {
            var i = n("window"),
                a = n("jquery"),
                r = n("yummly"),
                o = r.user.encoded && r.user.encoded.id;
            e.exports = function() {
                a(i).on("ready", function() {
                    o && n("./get-reco-status")({
                        userID: o
                    })
                })
            }
        },
        "profile/collections/remove-recipe.js": function(e, t, n) {
            var i = n("jquery"),
                a = n("window"),
                r = n("yummly"),
                o = n("../../utilities/error/ajax"),
                s = n("../../utilities/error/required"),
                l = r.user && r.user.encoded && r.user.encoded.id;
            e.exports = function(e, t) {
                if (!s(i.extend({}, e, {
                        userId: l || void 0
                    }), ["recipeID", "collectionName", "userId"])) return !1;
                var n = e.recipeID,
                    c = e.collectionName,
                    u = encodeURIComponent(r.myCollections[c].urlName),
                    d = u === i("#default-collection").data("url");
                if (!d && a.mixpanel) {
                    var p = i("div").find('[data-id="' + n + '"]').find(".y-source").text();
                    a.mixpanel.track("Collection Remove Recipe", {
                        "Recipe ID": n,
                        "Recipe Source": i.trim(p || i("#sourceLink").text()).replace(/\s+\/\s+/, " / "),
                        "Collection Name By Owner": decodeURIComponent(l) + "/" + c,
                        "Collection Name Unique": c
                    })
                }
                if (!e.preventAction) {
                    var f = "urb-url" === i("div").find('[data-id="' + n + '"]').data("type") ? "/mapi/v3/collections/" + l + "/collection/" + u + "/recipes/" + encodeURIComponent(n) + "?type=urb-url" : "/mapi/v3/collections/" + l + "/collection/" + u + "/recipes/" + n;
                    i.ajax({
                        url: f,
                        type: "DELETE",
                        cache: !1,
                        data: {
                            recipe: n,
                            "collect-once": !1
                        },
                        error: o,
                        success: function(e) {
                            t && t(e)
                        },
                        headers: r.locale.headers
                    })
                }
            }
        },
        "vendors/google/universal-analytics.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly");
            e.exports = function() {
                i.ga("create", a.vendors.google.analytics, "auto"), i.ga("require", "displayfeatures"), i.ga("create", a.vendors.google.universalAnalytics, {
                    name: "localeTracker"
                }), i.ga("localeTracker.require", "displayfeatures"), e.exports.track("send", "pageview")
            }, e.exports.track = function() {
                var t = [].slice.call(arguments),
                    n = (!!a.user && !a.user.anonymous).toString();
                i.ga && "function" == typeof i.ga.getAll ? (i.ga("set", "dimension1", n.substr(0, 1).toUpperCase() + n.substr(1)), i.ga.apply(i.ga, t), "send" === t[0] && (t[0] = "localeTracker.send", i.ga("localeTracker.set", "dimension1", n.substr(0, 1).toUpperCase() + n.substr(1)), i.ga.apply(i.ga, t))) : setTimeout(function() {
                    e.exports.track.apply(e.exports, t)
                }, 100)
            }
        },
        "overlays/promos/mobile-promo-track.js": function(e, t, n) {
            var i = n("window"),
                a = n("../../vendors/google/universal-analytics").track,
                r = n("../../utilities/page");
            e.exports = function(e, t, n) {
                var o = i.navigator.userAgent,
                    s = /iPa/.test(o) ? "iPad" : /Android/.test(o) ? "Android" : "iPhone",
                    l = /iP[aho]/.test(o) ? "iTunes for " + s : /Android/.test(o) ? "Google Play" : /Windows/.test(o) ? "Windows Store" : "Unknown Store (" + s + ")",
                    c = {
                        click: "App Promo Store Click",
                        dismiss: "App Promo Dismiss"
                    },
                    u = {
                        "Promo Type": n ? [s, n].join(" ") : s,
                        "Store Visited": l,
                        "Store Not Visited": l,
                        "Screen Type": r.isFirstPageview() ? "Registration" : "Registration-2nd-Pageview"
                    };
                t = t.replace(/^\/\//, "http://").replace(/\?.+/, ""), a("send", "event", "promo", e, t, {
                    nonInteraction: 1
                }), i.mixpanel && c[e] && ("click" === e ? delete u["Store Not Visited"] : delete u["Store Visited"], i.mixpanel.track(c[e], u))
            }
        },
        "vendors/google/external-yum-analytics.js": function(e, t, n) {
            var i = n("window"),
                a = n("yummly");
            e.exports = function() {
                var e = (!!a.user && !a.user.anonymous).toString();
                i.ga("create", a.vendors.google.externalYumAnalytics, "auto"), i.ga("set", "dimension1", e.substr(0, 1).toUpperCase() + e.substr(1)), i.ga("require", "displayfeatures"), i.ga("send", "pageview")
            }
        },
        "overlays/promos/mobile-web-top-banner.js": function(e, t, n) {
            var i = n("window"),
                a = n("./mobile-promo-track"),
                r = n("jquery");
            e.exports = function() {
                var e = "dismissed" === r.cookie("yMB"),
                    t = r("#mobile-banner-background");
                e || (r("#content").addClass("show-mobile-banner"), t.addClass("inverse"), t.on("click", function(e) {
                    e.preventDefault();
                    var t = r(e.target),
                        n = r(this).find("a").attr("href"),
                        o = n.replace(/\?.+/, "");
                    t.hasClass("y-icon") ? (a("dismiss", o, "Banner 1.1"), r("#content").removeClass("show-mobile-banner"), r.cookie("yMB", "dismissed", {
                        expires: 15,
                        path: "/"
                    })) : (a("click", o, "Banner 1.1"), i.open(n))
                }))
            }
        },
        "overlays/onboarding/multistep-email-login.js": function(e, t, n) {
            function i(e, t) {
                var n = f.strings.onboarding.gatherPrefs.login.email[e.data("type")],
                    i = v.find("h1");
                t ? e.addClass("active").prev(".wrap").addClass("completed") : e.removeClass("completed").next(".wrap").removeClass("active"), e.find("input").focus(), i.text(n || w || i.text()), h("email-view")
            }

            function a() {
                var e = g.find(".wrap.active").last().find("input"),
                    t = e.closest(".wrap").prev(".wrap");
                e.closest("label").removeClass("error").find(".message").text(""), h("email-click", "Back", /^pass/.test(e.closest(".wrap").data("type")) ? "" : e.val()), t.length ? i(t) : v.removeClass("show-email").find("h1").text(w)
            }

            function r() {
                g.find(".error").removeClass("error"), g.find(".message").text("")
            }

            function o() {
                p(".show-email, .show-login-email").removeClass("show-email show-login-email"), p(".login-email").hide(), p(".yummly-login").show(), g.find(".wrap").removeClass("active completed").first().addClass("active"), r()
            }

            function s() {
                n("../../forms/fields/password")(g.find("form")), v.addClass("show-email"), g.find(".wrap:first input").focus(), g.find(".init").each(function(e, t) {
                    setTimeout(function() {
                        p(t).removeClass("init")
                    }, 300 * (e + 1))
                }), h("email-view"), p(".secondary-cta").off("mouseup", o).on("mouseup", o), g.find("input").off("keydown", r).on("keydown", r), v.find(".back").off("click", a).on("click", a)
            }

            function l(e) {
                var t = e.val(),
                    n = 6;
                switch (e.attr("type")) {
                    case "name":
                        if (!b.isNotEmpty(t)) return y = x.required.replace("%s", e.attr("placeholder")), !1;
                        break;
                    case "password":
                    case "passwordExisting":
                        if (!b.isNotEmpty(t)) return y = x.required.replace("%s", e.attr("placeholder")), !1;
                        if (!b.isMinLength(t, n)) return y = x.min_length.replace("%s", e.attr("placeholder")).replace("%s", n), !1;
                        break;
                    case "email":
                        if (!b.isNotEmpty(t)) return y = x.required.replace("%s", e.attr("placeholder")), !1;
                        if (!b.isEmail(t)) return y = x.valid_email, !1
                }
                return !0
            }

            function c(e) {
                var t = p(p.parseHTML(p("#yummly-generic-dialog").html())),
                    n = p.ninja.dialog({
                        html: t
                    });
                n.open(), t.find(".confirm").html(e || f.strings.forms.errors.internal), t.find(".ninja-dismiss").off("click").on("click", function() {
                    n.close()
                }).focus()
            }

            function u(e) {
                var t = "password" === e.data("type") ? "register" : "login",
                    i = f.locale.headers,
                    a = g.find("input").toArray(),
                    r = {
                        app: "web",
                        cookie: !0,
                        type: "email",
                        "email-address": p(a.shift()).val(),
                        password: p(a.shift()).val(),
                        "first-name": p(a.shift()).val(),
                        "last-name": p(a.shift()).val()
                    };
                p.ajax({
                    url: "/mapi/v1/auth",
                    cache: !1,
                    dataType: "json",
                    headers: i,
                    data: r,
                    error: function(e, t, n) {
                        m.error(t + ": " + (n || "Unknown error. "))
                    },
                    statusCode: {
                        500: function() {
                            c()
                        },
                        401: function() {
                            c("register" === t ? f.strings.forms.errors.takenOrSignIn : f.strings.forms.errors.unauthorized)
                        },
                        200: function(e) {
                            i["x-yummly-auth-type"] = "yummly", i["x-yummly-auth-token"] = encodeURIComponent(e.access_token), p.ajax({
                                url: "/mapi/v1/user",
                                cache: !1,
                                dataType: "json",
                                headers: i,
                                error: function() {
                                    c()
                                },
                                success: function(e) {
                                    var t = n("../../user/buttons");
                                    t.mixpanelTrackPostLoginEvents(e.name, e.email, function() {
                                        t.afterLoginAction(f.yumUrl)
                                    })
                                }
                            })
                        }
                    }
                })
            }

            function d() {
                var e = g.find(".wrap.active").last().find("input"),
                    t = g.find(".wrap:not(.active)").first(),
                    n = e.closest(".wrap"),
                    a = /^pass/.test(n.data("type")),
                    r = /^passwordExisting$/.test(n.data("type"));
                l(e) ? (h("email-click", "Next", a ? "" : e.val()), t.length && !r ? i(t, !0) : u(e)) : e.closest("label").addClass("error").find(".message").text(y)
            }
            var p = n("jquery"),
                f = n("yummly"),
                m = n("../../utilities/debug"),
                h = n("./prefs").track,
                g = p(".multistep-email"),
                v = p(".pane-login"),
                y = "",
                b = {
                    isNotEmpty: function(e) {
                        return !(!e || !e.length)
                    },
                    isMinLength: function(e, t) {
                        return this.isNotEmpty(e) && e.length >= t
                    },
                    isEmail: function(e) {
                        return this.isNotEmpty(e) && /^.+@.+\..+$/.test(e)
                    }
                },
                x = f.strings.validate,
                w = v.find("h1").text();
            e.exports = function(e, t) {
                t.is(e) ? d() : (s(), v.find("h1").text(f.strings.onboarding.gatherPrefs.login.email.email))
            }
        }
    }, Yummly.fn = e("index.js")
}();
//# sourceMappingURL=yummly.js.map