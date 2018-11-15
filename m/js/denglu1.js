/*! jQuery v2.1.1 | (c) 2005, 2014 jQuery Foundation, Inc. | jquery.org/license */
!
function(a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a)
    }: b(a)
} ("undefined" != typeof window ? window: this,
function(a, b) {
    function s(a) {
        var b = a.length,
        c = n.type(a);
        return "function" === c || n.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
    }
    function x(a, b, c) {
        if (n.isFunction(b)) return n.grep(a,
        function(a, d) {
            return !! b.call(a, d, a) !== c
        });
        if (b.nodeType) return n.grep(a,
        function(a) {
            return a === b !== c
        });
        if ("string" == typeof b) {
            if (w.test(b)) return n.filter(b, a, c);
            b = n.filter(b, a)
        }
        return n.grep(a,
        function(a) {
            return g.call(b, a) >= 0 !== c
        })
    }
    function D(a, b) {
        while ((a = a[b]) && 1 !== a.nodeType);
        return a
    }
    function G(a) {
        var b = F[a] = {};
        return n.each(a.match(E) || [],
        function(a, c) {
            b[c] = !0
        }),
        b
    }
    function I() {
        var e = "removeEventListener";
        l[e]("DOMContentLoaded", I, !1),
        a[e]("load", I, !1),
        n.ready()
    }
    function K() {
        Object.defineProperty(this.cache = {},
        0, {
            get: function() {
                return {}
            }
        }),
        this.expando = n.expando + Math.random()
    }
    function P(a, b, c) {
        var d;
        if (void 0 === c && 1 === a.nodeType) if (d = "data-" + b.replace(O, "-$1").toLowerCase(), c = a.getAttribute(d), "string" == typeof c) {
            try {
                c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null: +c + "" === c ? +c: N.test(c) ? n.parseJSON(c) : c
            } catch(e) {}
            M.set(a, b, c)
        } else c = void 0;
        return c
    }
    function Z() {
        return ! 0
    }
    function $() {
        return ! 1
    }
    function _() {
        try {
            return l.activeElement
        } catch(a) {}
    }
    function jb(a, b) {
        return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b: b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
    }
    function kb(a) {
        return a.type = (null !== a.getAttribute("type")) + "/" + a.type,
        a
    }
    function lb(a) {
        var b = gb.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"),
        a
    }
    function mb(a, b) {
        var e = "globalEval";
        for (var c = 0,
        d = a.length; d > c; c++) L.set(a[c], e, !b || L.get(b[c], e))
    }
    function nb(a, b) {
        var c, d, e, f, g, h, i, j;
        if (1 === b.nodeType) {
            if (L.hasData(a) && (f = L.access(a), g = L.set(b, f), j = f.events)) {
                delete g.handle,
                g.events = {};
                for (e in j) for (c = 0, d = j[e].length; d > c; c++) n.event.add(b, e, j[e][c])
            }
            M.hasData(a) && (h = M.access(a), i = n.extend({},
            h), M.set(b, i))
        }
    }
    function ob(a, b) {
        var e = "getElementsByTagName",
        t = "querySelectorAll",
        c = a[e] ? a[e](b || "*") : a[t] ? a[t](b || "*") : [];
        return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], c) : c
    }
    function pb(a, b) {
        var e = "input",
        t = "defaultValue",
        c = b.nodeName.toLowerCase();
        e === c && T.test(a.type) ? b.checked = a.checked: (e === c || "textarea" === c) && (b[t] = a[t])
    }
    function sb(b, c) {
        var t = "getDefaultComputedStyle",
        r = "display",
        d, e = n(c.createElement(b)).appendTo(c.body),
        f = a[t] && (d = a[t](e[0])) ? d[r] : n.css(e[0], r);
        return e.detach(),
        f
    }
    function tb(a) {
        var b = l,
        c = rb[a];
        return c || (c = sb(a, b), "none" !== c && c || (qb = (qb || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = qb[0].contentDocument, b.write(), b.close(), c = sb(a, b), qb.detach()), rb[a] = c),
        c
    }
    function xb(a, b, c) {
        var t = "width",
        r = "minWidth",
        i = "maxWidth",
        d, e, f, g, h = a.style;
        return c = c || wb(a),
        c && (g = c.getPropertyValue(b) || c[b]),
        c && ("" !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), vb.test(g) && ub.test(b) && (d = h[t], e = h[r], f = h[i], h[r] = h[i] = h[t] = g, g = c[t], h[t] = d, h[r] = e, h[i] = f)),
        void 0 !== g ? g + "": g
    }
    function yb(a, b) {
        return {
            get: function() {
                return a() ? void delete this.get: (this.get = b).apply(this, arguments)
            }
        }
    }
    function Fb(a, b) {
        if (b in a) return b;
        var c = b[0].toUpperCase() + b.slice(1),
        d = b,
        e = Eb.length;
        while (e--) if (b = Eb[e] + c, b in a) return b;
        return d
    }
    function Gb(a, b, c) {
        var d = Ab.exec(b);
        return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
    }
    function Hb(a, b, c, d, e) {
        var t = "border",
        r = "content",
        i = "margin",
        s = "padding",
        o = "Width";
        for (var f = c === (d ? t: r) ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) i === c && (g += n.css(a, c + R[f], !0, e)),
        d ? (r === c && (g -= n.css(a, s + R[f], !0, e)), i !== c && (g -= n.css(a, t + R[f] + o, !0, e))) : (g += n.css(a, s + R[f], !0, e), s !== c && (g += n.css(a, t + R[f] + o, !0, e)));
        return g
    }
    function Ib(a, b, c) {
        var d = !0,
        e = "width" === b ? a.offsetWidth: a.offsetHeight,
        f = wb(a),
        g = "border-box" === n.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = xb(a, b, f), (0 > e || null == e) && (e = a.style[b]), vb.test(e)) return e;
            d = g && (k.boxSizingReliable() || e === a.style[b]),
            e = parseFloat(e) || 0
        }
        return e + Hb(a, b, c || (g ? "border": "content"), d, f) + "px"
    }
    function Jb(a, b) {
        var t = "style",
        r = "olddisplay",
        i = "display",
        s = "none";
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g],
        d[t] && (f[g] = L.get(d, r), c = d[t][i], b ? (f[g] || s !== c || (d[t][i] = ""), "" === d[t][i] && S(d) && (f[g] = L.access(d, r, tb(d.nodeName)))) : (e = S(d), s === c && e || L.set(d, r, e ? c: n.css(d, i))));
        for (g = 0; h > g; g++) d = a[g],
        d[t] && (b && s !== d[t][i] && "" !== d[t][i] || (d[t][i] = b ? f[g] || "": s));
        return a
    }
    function Kb(a, b, c, d, e) {
        return new Kb.prototype.init(a, b, c, d, e)
    }
    function Sb() {
        return setTimeout(function() {
            Lb = void 0
        }),
        Lb = n.now()
    }
    function Tb(a, b) {
        var c, d = 0,
        e = {
            height: a
        };
        for (b = b ? 1 : 0; 4 > d; d += 2 - b) c = R[d],
        e["margin" + c] = e["padding" + c] = a;
        return b && (e.opacity = e.width = a),
        e
    }
    function Ub(a, b, c) {
        for (var d, e = (Rb[b] || []).concat(Rb["*"]), f = 0, g = e.length; g > f; f++) if (d = e[f].call(c, b, a)) return d
    }
    function Vb(a, b, c) {
        var t = "fxshow",
        r = "unqueued",
        s = "always",
        u = "height",
        v = "width",
        y = "overflow",
        w = "display",
        E = "none",
        x = "inline",
        T = "hidden",
        N = "show",
        d, e, f, g, h, i, j, k, l = this,
        m = {},
        o = a.style,
        p = a.nodeType && S(a),
        q = L.get(a, t);
        c.queue || (h = n._queueHooks(a, "fx"), null == h[r] && (h[r] = 0, i = h.empty.fire, h.empty.fire = function() {
            h[r] || i()
        }), h[r]++, l[s](function() {
            l[s](function() {
                h[r]--,
                n.queue(a, "fx").length || h.empty.fire()
            })
        })),
        1 === a.nodeType && (u in b || v in b) && (c[y] = [o[y], o.overflowX, o.overflowY], j = n.css(a, w), k = E === j ? L.get(a, "olddisplay") || tb(a.nodeName) : j, x === k && E === n.css(a, "float") && (o[w] = "inline-block")),
        c[y] && (o[y] = T, l[s](function() {
            o[y] = c[y][0],
            o.overflowX = c[y][1],
            o.overflowY = c[y][2]
        }));
        for (d in b) if (e = b[d], Nb.exec(e)) {
            if (delete b[d], f = f || "toggle" === e, e === (p ? "hide": N)) {
                if (N !== e || !q || void 0 === q[d]) continue;
                p = !0
            }
            m[d] = q && q[d] || n.style(a, d)
        } else j = void 0;
        if (n.isEmptyObject(m)) x === (E === j ? tb(a.nodeName) : j) && (o[w] = j);
        else {
            q ? T in q && (p = q[T]) : q = L.access(a, t, {}),
            f && (q[T] = !p),
            p ? n(a)[N]() : l.done(function() {
                n(a).hide()
            }),
            l.done(function() {
                var b;
                L.remove(a, t);
                for (b in m) n.style(a, b, m[b])
            });
            for (d in m) g = Ub(p ? q[d] : 0, d, l),
            d in q || (q[d] = g.start, p && (g.end = g.start, g.start = v === d || u === d ? 1 : 0))
        }
    }
    function Wb(a, b) {
        var c, d, e, f, g;
        for (c in a) if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = n.cssHooks[d], g && "expand" in g) {
            f = g.expand(f),
            delete a[d];
            for (c in f) c in a || (a[c] = f[c], b[c] = e)
        } else b[d] = e
    }
    function Xb(a, b, c) {
        var t = "length",
        r = "always",
        s = "duration",
        o = "tweens",
        u = "resolveWith",
        l = "extend",
        p = "opts",
        v = "specialEasing",
        d, e, f = 0,
        g = Qb[t],
        h = n.Deferred()[r](function() {
            delete i.elem
        }),
        i = function() {
            if (e) return ! 1;
            for (var b = Lb || Sb(), c = Math.max(0, j.startTime + j[s] - b), d = c / j[s] || 0, f = 1 - d, g = 0, i = j[o][t]; i > g; g++) j[o][g].run(f);
            return h.notifyWith(a, [j, f, c]),
            1 > f && i ? c: (h[u](a, [j]), !1)
        },
        j = h.promise({
            elem: a,
            props: n[l]({},
            b),
            opts: n[l](!0, {
                specialEasing: {}
            },
            c),
            originalProperties: b,
            originalOptions: c,
            startTime: Lb || Sb(),
            duration: c[s],
            tweens: [],
            createTween: function(b, c) {
                var d = n.Tween(a, j[p], b, c, j[p][v][b] || j[p].easing);
                return j[o].push(d),
                d
            },
            stop: function(b) {
                var c = 0,
                d = b ? j[o][t] : 0;
                if (e) return this;
                for (e = !0; d > c; c++) j[o][c].run(1);
                return b ? h[u](a, [j, b]) : h.rejectWith(a, [j, b]),
                this
            }
        }),
        k = j.props;
        for (Wb(k, j[p][v]); g > f; f++) if (d = Qb[f].call(j, a, k, j[p])) return d;
        return n.map(k, Ub, j),
        n.isFunction(j[p].start) && j[p].start.call(a, j),
        n.fx.timer(n[l](i, {
            elem: a,
            anim: j,
            queue: j[p].queue
        })),
        j.progress(j[p].progress).done(j[p].done, j[p].complete).fail(j[p].fail)[r](j[p][r])
    }
    function rc(a) {
        return function(b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0,
            f = b.toLowerCase().match(E) || [];
            if (n.isFunction(c)) while (d = f[e++])"+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
        }
    }
    function sc(a, b, c, d) {
        function g(h) {
            var i;
            return e[h] = !0,
            n.each(a[h] || [],
            function(a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
            }),
            i
        }
        var e = {},
        f = a === oc;
        return g(b.dataTypes[0]) || !e["*"] && g("*")
    }
    function tc(a, b) {
        var c, d, e = n.ajaxSettings.flatOptions || {};
        for (c in b) void 0 !== b[c] && ((e[c] ? a: d || (d = {}))[c] = b[c]);
        return d && n.extend(!0, a, d),
        a
    }
    function uc(a, b, c) {
        var d, e, f, g, h = a.contents,
        i = a.dataTypes;
        while ("*" === i[0]) i.shift(),
        void 0 === d && (d = a.mimeType || b.getResponseHeader("Content-Type"));
        if (d) for (e in h) if (h[e] && h[e].test(d)) {
            i.unshift(e);
            break
        }
        if (i[0] in c) f = i[0];
        else {
            for (e in c) {
                if (!i[0] || a.converters[e + " " + i[0]]) {
                    f = e;
                    break
                }
                g || (g = e)
            }
            f = f || g
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
    }
    function vc(a, b, c, d) {
        var t = "converters",
        n = "responseFields",
        r = "dataFilter",
        e, f, g, h, i, j = {},
        k = a.dataTypes.slice();
        if (k[1]) for (g in a[t]) j[g.toLowerCase()] = a[t][g];
        f = k.shift();
        while (f) if (a[n][f] && (c[a[n][f]] = b), !i && d && a[r] && (b = a[r](b, a.dataType)), i = f, f = k.shift()) if ("*" === f) f = i;
        else if ("*" !== i && i !== f) {
            if (g = j[i + " " + f] || j["* " + f], !g) for (e in j) if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
                break
            }
            if (g !== !0) if (g && a["throws"]) b = g(b);
            else try {
                b = g(b)
            } catch(l) {
                return {
                    state: "parsererror",
                    error: g ? l: "No conversion from " + i + " to " + f
                }
            }
        }
        return {
            state: "success",
            data: b
        }
    }
    function Bc(a, b, c, d) {
        var t = "object",
        e;
        if (n.isArray(b)) n.each(b,
        function(b, e) {
            c || xc.test(a) ? d(a, e) : Bc(a + "[" + (t == typeof e ? b: "") + "]", e, c, d)
        });
        else if (c || t !== n.type(b)) d(a, b);
        else for (e in b) Bc(a + "[" + e + "]", b[e], c, d)
    }
    function Kc(a) {
        return n.isWindow(a) ? a: 9 === a.nodeType && a.defaultView
    }
    var c = [],
    d = c.slice,
    e = c.concat,
    f = c.push,
    g = c.indexOf,
    h = {},
    i = h.toString,
    j = h.hasOwnProperty,
    k = {},
    l = a.document,
    m = "2.1.1",
    n = function(a, b) {
        return new n.fn.init(a, b)
    },
    o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
    p = /^-ms-/,
    q = /-([\da-z])/gi,
    r = function(a, b) {
        return b.toUpperCase()
    };
    n.fn = n.prototype = {
        jquery: m,
        constructor: n,
        selector: "",
        length: 0,
        toArray: function() {
            return d.call(this)
        },
        get: function(a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this)
        },
        pushStack: function(a) {
            var b = n.merge(this.constructor(), a);
            return b.prevObject = this,
            b.context = this.context,
            b
        },
        each: function(a, b) {
            return n.each(this, a, b)
        },
        map: function(a) {
            return this.pushStack(n.map(this,
            function(b, c) {
                return a.call(b, c, b)
            }))
        },
        slice: function() {
            return this.pushStack(d.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq( - 1)
        },
        eq: function(a) {
            var b = this.length,
            c = +a + (0 > a ? b: 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor(null)
        },
        push: f,
        sort: c.sort,
        splice: c.splice
    },
    n.extend = n.fn.extend = function() {
        var t = "isPlainObject",
        a, b, c, d, e, f, g = arguments[0] || {},
        h = 1,
        i = arguments.length,
        j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {},
        h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++) if (null != (a = arguments[h])) for (b in a) c = g[b],
        d = a[b],
        g !== d && (j && d && (n[t](d) || (e = n.isArray(d))) ? (e ? (e = !1, f = c && n.isArray(c) ? c: []) : f = c && n[t](c) ? c: {},
        g[b] = n.extend(j, f, d)) : void 0 !== d && (g[b] = d));
        return g
    },
    n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(a) {
            throw new Error(a)
        },
        noop: function() {},
        isFunction: function(a) {
            return "function" === n.type(a)
        },
        isArray: Array.isArray,
        isWindow: function(a) {
            return null != a && a === a.window
        },
        isNumeric: function(a) {
            return ! n.isArray(a) && a - parseFloat(a) >= 0
        },
        isPlainObject: function(a) {
            return "object" !== n.type(a) || a.nodeType || n.isWindow(a) ? !1 : a.constructor && !j.call(a.constructor.prototype, "isPrototypeOf") ? !1 : !0
        },
        isEmptyObject: function(a) {
            var b;
            for (b in a) return ! 1;
            return ! 0
        },
        type: function(a) {
            return null == a ? a + "": "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object": typeof a
        },
        globalEval: function(a) {
            var b, c = eval;
            a = n.trim(a),
            a && (1 === a.indexOf("use strict") ? (b = l.createElement("script"), b.text = a, l.head.appendChild(b).parentNode.removeChild(b)) : c(a))
        },
        camelCase: function(a) {
            return a.replace(p, "ms-").replace(q, r)
        },
        nodeName: function(a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
        },
        each: function(a, b, c) {
            var d, e = 0,
            f = a.length,
            g = s(a);
            if (c) {
                if (g) {
                    for (; f > e; e++) if (d = b.apply(a[e], c), d === !1) break
                } else for (e in a) if (d = b.apply(a[e], c), d === !1) break
            } else if (g) {
                for (; f > e; e++) if (d = b.call(a[e], e, a[e]), d === !1) break
            } else for (e in a) if (d = b.call(a[e], e, a[e]), d === !1) break;
            return a
        },
        trim: function(a) {
            return null == a ? "": (a + "").replace(o, "")
        },
        makeArray: function(a, b) {
            var c = b || [];
            return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)),
            c
        },
        inArray: function(a, b, c) {
            return null == b ? -1 : g.call(b, a, c)
        },
        merge: function(a, b) {
            for (var c = +b.length,
            d = 0,
            e = a.length; c > d; d++) a[e++] = b[d];
            return a.length = e,
            a
        },
        grep: function(a, b, c) {
            for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++) d = !b(a[f], f),
            d !== h && e.push(a[f]);
            return e
        },
        map: function(a, b, c) {
            var d, f = 0,
            g = a.length,
            h = s(a),
            i = [];
            if (h) for (; g > f; f++) d = b(a[f], f, c),
            null != d && i.push(d);
            else for (f in a) d = b(a[f], f, c),
            null != d && i.push(d);
            return e.apply([], i)
        },
        guid: 1,
        proxy: function(a, b) {
            var c, e, f;
            return "string" == typeof b && (c = a[b], b = a, a = c),
            n.isFunction(a) ? (e = d.call(arguments, 2), f = function() {
                return a.apply(b || this, e.concat(d.call(arguments)))
            },
            f.guid = a.guid = a.guid || n.guid++, f) : void 0
        },
        now: Date.now,
        support: k
    }),
    n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),
    function(a, b) {
        h["[object " + b + "]"] = b.toLowerCase()
    });
    var t = function(a) {
        function fb(a, b, d, e) {
            var f, h, j, k, l, o, r, s, w, x;
            if ((b ? b[ht] || b: v) !== n && m(b), b = b || n, d = d || [], !a || pt != typeof a) return d;
            if (1 !== (k = b[ct]) && 9 !== k) return [];
            if (p && !e) {
                if (f = _.exec(a)) if (j = f[1]) {
                    if (9 === k) {
                        if (h = b[dt](j), !h || !h[vt]) return d;
                        if (h.id === j) return d[nt](h),
                        d
                    } else if (b[ht] && (h = b[ht][dt](j)) && t(b, h) && h.id === j) return d[nt](h),
                    d
                } else {
                    if (f[2]) return I[at](d, b[mt](a)),
                    d;
                    if ((j = f[3]) && c[gt] && b[gt]) return I[at](d, b[gt](j)),
                    d
                }
                if (c.qsa && (!q || !q[yt](a))) {
                    if (s = r = u, w = b, x = 9 === k && a, 1 === k && "object" !== b[wt][bt]()) {
                        o = g(a),
                        (r = b[Et]("id")) ? s = r[ot](bb, "\\$&") : b[St]("id", s),
                        s = "[id='" + s + "'] ",
                        l = o[st];
                        while (l--) o[l] = s + qb(o[l]);
                        w = ab[yt](a) && ob(b[vt]) || b,
                        x = o.join(",")
                    }
                    if (x) try {
                        return I[at](d, w[xt](x)),
                        d
                    } catch(y) {} finally {
                        r || b.removeAttribute("id")
                    }
                }
            }
            return i(a[ot](R, "$1"), b, d, e)
        }
        function gb() {
            function b(c, e) {
                return a[nt](c + Tt) > d.cacheLength && delete b[a.shift()],
                b[c + Tt] = e
            }
            var a = [];
            return b
        }
        function hb(a) {
            return a[u] = !0,
            a
        }
        function ib(a) {
            var b = n[Nt]("div");
            try {
                return !! a(b)
            } catch(c) {
                return ! 1
            } finally {
                b[vt] && b[vt].removeChild(b),
                b = Ct
            }
        }
        function jb(a, b) {
            var c = a.split("|"),
            e = a[st];
            while (e--) d[kt][c[e]] = b
        }
        function kb(a, b) {
            var c = b && a,
            d = c && 1 === a[ct] && 1 === b[ct] && (~b.sourceIndex || D) - (~a.sourceIndex || D);
            if (d) return d;
            if (c) while (c = c[Lt]) if (c === b) return - 1;
            return a ? 1 : -1
        }
        function lb(a) {
            return function(b) {
                var c = b[wt][bt]();
                return At === c && b[Ot] === a
            }
        }
        function mb(a) {
            return function(b) {
                var c = b[wt][bt]();
                return (At === c || Mt === c) && b[Ot] === a
            }
        }
        function nb(a) {
            return hb(function(b) {
                return b = +b,
                hb(function(c, d) {
                    var e, f = a([], c[st], b),
                    g = f[st];
                    while (g--) c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                })
            })
        }
        function ob(a) {
            return a && typeof a[mt] !== C && a
        }
        function pb() {}
        function qb(a) {
            for (var b = 0,
            c = a[st], d = ""; c > b; b++) d += a[b][Rt];
            return d
        }
        function rb(a, b, c) {
            var d = b.dir,
            e = c && vt === d,
            f = x++;
            return b.first ?
            function(b, c, f) {
                while (b = b[d]) if (1 === b[ct] || e) return a(b, c, f)
            }: function(b, c, g) {
                var h, i, j = [w, f];
                if (g) {
                    while (b = b[d]) if ((1 === b[ct] || e) && a(b, c, g)) return ! 0
                } else while (b = b[d]) if (1 === b[ct] || e) {
                    if (i = b[u] || (b[u] = {}), (h = i[d]) && h[0] === w && h[1] === f) return j[2] = h[2];
                    if (i[d] = j, j[2] = a(b, c, g)) return ! 0
                }
            }
        }
        function sb(a) {
            return a[st] > 1 ?
            function(b, c, d) {
                var e = a[st];
                while (e--) if (!a[e](b, c, d)) return ! 1;
                return ! 0
            }: a[0]
        }
        function tb(a, b, c) {
            for (var d = 0,
            e = b[st]; e > d; d++) fb(a, b[d], c);
            return c
        }
        function ub(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a[st], j = Ct != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g[nt](f), j && b[nt](h));
            return g
        }
        function vb(a, b, c, d, e, f) {
            return d && !d[u] && (d = vb(d)),
            e && !e[u] && (e = vb(e, f)),
            hb(function(f, g, h, i) {
                var j, k, l, m = [],
                n = [],
                o = g[st],
                p = f || tb(b || ut, h[ct] ? [h] : h, []),
                q = !a || !f && b ? p: ub(p, m, a, h, i),
                r = c ? e || (f ? a: o || d) ? [] : g: q;
                if (c && c(q, r, h, i), d) {
                    j = ub(r, n),
                    d(j, [], h, i),
                    k = j[st];
                    while (k--)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l))
                }
                if (f) {
                    if (e || a) {
                        if (e) {
                            j = [],
                            k = r[st];
                            while (k--)(l = r[k]) && j[nt](q[k] = l);
                            e(Ct, r = [], j, i)
                        }
                        k = r[st];
                        while (k--)(l = r[k]) && (j = e ? K[ft](f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
                    }
                } else r = ub(r === g ? r.splice(o, r[st]) : r),
                e ? e(Ct, g, r, i) : I[at](g, r)
            })
        }
        function wb(a) {
            for (var b, c, e, f = a[st], g = d[nn][a[0][Ot]], h = g || d[nn][Tt], i = g ? 1 : 0, k = rb(function(a) {
                return a === b
            },
            h, !0), l = rb(function(a) {
                return K[ft](b, a) > -1
            },
            h, !0), m = [function(a, c, d) {
                return ! g && (d || c !== j) || ((b = c)[ct] ? k(a, c, d) : l(a, c, d))
            }]; f > i; i++) if (c = d[nn][a[i][Ot]]) m = [rb(sb(m), c)];
            else {
                if (c = d.filter[a[i][Ot]][at](Ct, a[i][Xt]), c[u]) {
                    for (e = ++i; f > e; e++) if (d[nn][a[e][Ot]]) break;
                    return vb(i > 1 && sb(m), i > 1 && qb(a[rt](0, i - 1).concat({
                        value: Tt === a[i - 2][Ot] ? ut: ""
                    }))[ot](R, "$1"), c, e > i && wb(a[rt](i, e)), f > e && wb(a = a[rt](e)), f > e && qb(a))
                }
                m[nt](c)
            }
            return sb(m)
        }
        function xb(a, b) {
            var c = b[st] > 0,
            e = a[st] > 0,
            f = function(f, g, h, i, k) {
                var l, m, o, p = 0,
                q = "0",
                r = f && [],
                s = [],
                t = j,
                u = f || e && d.find.TAG(ut, k),
                v = w += Ct == t ? 1 : Math.random() || .1,
                x = u[st];
                for (k && (j = g !== n && g); q !== x && Ct != (l = u[q]); q++) {
                    if (e && l) {
                        m = 0;
                        while (o = a[m++]) if (o(l, g, h)) {
                            i[nt](l);
                            break
                        }
                        k && (w = v)
                    }
                    c && ((l = !o && l) && p--, f && r[nt](l))
                }
                if (p += q, c && q !== p) {
                    m = 0;
                    while (o = b[m++]) o(r, s, g, h);
                    if (f) {
                        if (p > 0) while (q--) r[q] || s[q] || (s[q] = G[ft](i));
                        s = ub(s)
                    }
                    I[at](i, s),
                    k && !f && s[st] > 0 && p + b[st] > 1 && fb.uniqueSort(i)
                }
                return k && (w = v, j = t),
                r
            };
            return c ? hb(f) : f
        }
        var et = "document",
        tt = "hasOwnProperty",
        nt = "push",
        rt = "slice",
        it = "indexOf",
        st = "length",
        ot = "replace",
        ut = "*",
        at = "apply",
        ft = "call",
        lt = "childNodes",
        ct = "nodeType",
        ht = "ownerDocument",
        pt = "string",
        dt = "getElementById",
        vt = "parentNode",
        mt = "getElementsByTagName",
        gt = "getElementsByClassName",
        yt = "test",
        bt = "toLowerCase",
        wt = "nodeName",
        Et = "getAttribute",
        St = "setAttribute",
        xt = "querySelectorAll",
        Tt = " ",
        Nt = "createElement",
        Ct = null,
        kt = "attrHandle",
        Lt = "nextSibling",
        At = "input",
        Ot = "type",
        Mt = "button",
        _t = "documentElement",
        Dt = "addEventListener",
        Pt = "attributes",
        Ht = "className",
        Bt = "appendChild",
        jt = "innerHTML",
        Ft = "firstChild",
        It = "getElementsByName",
        qt = "getAttributeNode",
        Rt = "value",
        Ut = ":checked",
        zt = ":enabled",
        Wt = "matchesSelector",
        Xt = "matches",
        Vt = "disconnectedMatch",
        $t = "compareDocumentPosition",
        Jt = "contains",
        Kt = "error",
        Qt = "detectDuplicates",
        Gt = "textContent",
        Yt = "previousSibling",
        Zt = "pseudos",
        en = "setFilters",
        tn = "disabled",
        nn = "relative",
        b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + -(new Date),
        v = a[et],
        w = 0,
        x = 0,
        y = gb(),
        z = gb(),
        A = gb(),
        B = function(a, b) {
            return a === b && (l = !0),
            0
        },
        C = "undefined",
        D = 1 << 31,
        E = {} [tt],
        F = [],
        G = F.pop,
        H = F[nt],
        I = F[nt],
        J = F[rt],
        K = F[it] ||
        function(a) {
            for (var b = 0,
            c = this[st]; c > b; b++) if (this[b] === a) return b;
            return - 1
        },
        L = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
        M = "[\\x20\\t\\r\\n\\f]",
        N = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
        O = N[ot]("w", "w#"),
        P = "\\[" + M + "*(" + N + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + O + "))|)" + M + "*\\]",
        Q = ":(" + N + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + P + ")*)|.*)\\)|)",
        R = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"),
        S = new RegExp("^" + M + "*," + M + ut),
        T = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + ut),
        U = new RegExp("=" + M + "*([^\\]'\"]*?)" + M + "*\\]", "g"),
        V = new RegExp(Q),
        W = new RegExp("^" + O + "$"),
        X = {
            ID: new RegExp("^#(" + N + ")"),
            CLASS: new RegExp("^\\.(" + N + ")"),
            TAG: new RegExp("^(" + N[ot]("w", "w*") + ")"),
            ATTR: new RegExp("^" + P),
            PSEUDO: new RegExp("^" + Q),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
            bool: new RegExp("^(?:" + L + ")$", "i"),
            needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
        },
        Y = /^(?:input|select|textarea|button)$/i,
        Z = /^h\d$/i,
        $ = /^[^{]+\{\s*\[native \w/,
        _ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
        ab = /[+~]/,
        bb = /'|\\/g,
        cb = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"),
        db = function(a, b, c) {
            var d = "0x" + b - 65536;
            return d !== d || c ? b: 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
        };
        try {
            I[at](F = J[ft](v[lt]), v[lt]),
            F[v[lt][st]][ct]
        } catch(eb) {
            I = {
                apply: F[st] ?
                function(a, b) {
                    H[at](a, J[ft](b))
                }: function(a, b) {
                    var c = a[st],
                    d = 0;
                    while (a[c++] = b[d++]);
                    a[st] = c - 1
                }
            }
        }
        c = fb.support = {},
        f = fb.isXML = function(a) {
            var b = a && (a[ht] || a)[_t];
            return b ? "HTML" !== b[wt] : !1
        },
        m = fb.setDocument = function(a) {
            var b, e = a ? a[ht] || a: v,
            g = e.defaultView;
            return e !== n && 9 === e[ct] && e[_t] ? (n = e, o = e[_t], p = !f(e), g && g !== g.top && (g[Dt] ? g[Dt]("unload",
            function() {
                m()
            },
            !1) : g.attachEvent && g.attachEvent("onunload",
            function() {
                m()
            })), c[Pt] = ib(function(a) {
                return a[Ht] = "i",
                !a[Et](Ht)
            }), c[mt] = ib(function(a) {
                return a[Bt](e.createComment("")),
                !a[mt](ut)[st]
            }), c[gt] = $[yt](e[gt]) && ib(function(a) {
                return a[jt] = "<div class='a'></div><div class='a i'></div>",
                a[Ft][Ht] = "i",
                2 === a[gt]("i")[st]
            }), c.getById = ib(function(a) {
                return o[Bt](a).id = u,
                !e[It] || !e[It](u)[st]
            }), c.getById ? (d.find.ID = function(a, b) {
                if (typeof b[dt] !== C && p) {
                    var c = b[dt](a);
                    return c && c[vt] ? [c] : []
                }
            },
            d.filter.ID = function(a) {
                var b = a[ot](cb, db);
                return function(a) {
                    return a[Et]("id") === b
                }
            }) : (delete d.find.ID, d.filter.ID = function(a) {
                var b = a[ot](cb, db);
                return function(a) {
                    var c = typeof a[qt] !== C && a[qt]("id");
                    return c && c[Rt] === b
                }
            }), d.find.TAG = c[mt] ?
            function(a, b) {
                return typeof b[mt] !== C ? b[mt](a) : void 0
            }: function(a, b) {
                var c, d = [],
                e = 0,
                f = b[mt](a);
                if (ut === a) {
                    while (c = f[e++]) 1 === c[ct] && d[nt](c);
                    return d
                }
                return f
            },
            d.find.CLASS = c[gt] &&
            function(a, b) {
                return typeof b[gt] !== C && p ? b[gt](a) : void 0
            },
            r = [], q = [], (c.qsa = $[yt](e[xt])) && (ib(function(a) {
                a[jt] = "<select msallowclip=''><option selected=''></option></select>",
                a[xt]("[msallowclip^='']")[st] && q[nt]("[*^$]=" + M + "*(?:''|\"\")"),
                a[xt]("[selected]")[st] || q[nt]("\\[" + M + "*(?:value|" + L + ")"),
                a[xt](Ut)[st] || q[nt](Ut)
            }), ib(function(a) {
                var b = e[Nt](At);
                b[St](Ot, "hidden"),
                a[Bt](b)[St]("name", "D"),
                a[xt]("[name=d]")[st] && q[nt]("name" + M + "*[*^$|!~]?="),
                a[xt](zt)[st] || q[nt](zt, ":disabled"),
                a[xt]("*,:x"),
                q[nt](",.*:")
            })), (c[Wt] = $[yt](s = o[Xt] || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ib(function(a) {
                c[Vt] = s[ft](a, "div"),
                s[ft](a, "[s!='']:x"),
                r[nt]("!=", Q)
            }), q = q[st] && new RegExp(q.join("|")), r = r[st] && new RegExp(r.join("|")), b = $[yt](o[$t]), t = b || $[yt](o[Jt]) ?
            function(a, b) {
                var c = 9 === a[ct] ? a[_t] : a,
                d = b && b[vt];
                return a === d || !!d && 1 === d[ct] && !!(c[Jt] ? c[Jt](d) : a[$t] && 16 & a[$t](d))
            }: function(a, b) {
                if (b) while (b = b[vt]) if (b === a) return ! 0;
                return ! 1
            },
            B = b ?
            function(a, b) {
                if (a === b) return l = !0,
                0;
                var d = !a[$t] - !b[$t];
                return d ? d: (d = (a[ht] || a) === (b[ht] || b) ? a[$t](b) : 1, 1 & d || !c.sortDetached && b[$t](a) === d ? a === e || a[ht] === v && t(v, a) ? -1 : b === e || b[ht] === v && t(v, b) ? 1 : k ? K[ft](k, a) - K[ft](k, b) : 0 : 4 & d ? -1 : 1)
            }: function(a, b) {
                if (a === b) return l = !0,
                0;
                var c, d = 0,
                f = a[vt],
                g = b[vt],
                h = [a],
                i = [b];
                if (!f || !g) return a === e ? -1 : b === e ? 1 : f ? -1 : g ? 1 : k ? K[ft](k, a) - K[ft](k, b) : 0;
                if (f === g) return kb(a, b);
                c = a;
                while (c = c[vt]) h.unshift(c);
                c = b;
                while (c = c[vt]) i.unshift(c);
                while (h[d] === i[d]) d++;
                return d ? kb(h[d], i[d]) : h[d] === v ? -1 : i[d] === v ? 1 : 0
            },
            e) : n
        },
        fb[Xt] = function(a, b) {
            return fb(a, Ct, Ct, b)
        },
        fb[Wt] = function(a, b) {
            if ((a[ht] || a) !== n && m(a), b = b[ot](U, "='$1']"), !(!c[Wt] || !p || r && r[yt](b) || q && q[yt](b))) try {
                var d = s[ft](a, b);
                if (d || c[Vt] || a[et] && 11 !== a[et][ct]) return d
            } catch(e) {}
            return fb(b, n, Ct, [a])[st] > 0
        },
        fb[Jt] = function(a, b) {
            return (a[ht] || a) !== n && m(a),
            t(a, b)
        },
        fb.attr = function(a, b) { (a[ht] || a) !== n && m(a);
            var e = d[kt][b[bt]()],
            f = e && E[ft](d[kt], b[bt]()) ? e(a, b, !p) : void 0;
            return void 0 !== f ? f: c[Pt] || !p ? a[Et](b) : (f = a[qt](b)) && f.specified ? f[Rt] : Ct
        },
        fb[Kt] = function(a) {
            throw new Error("Syntax error, unrecognized expression: " + a)
        },
        fb.uniqueSort = function(a) {
            var b, d = [],
            e = 0,
            f = 0;
            if (l = !c[Qt], k = !c.sortStable && a[rt](0), a.sort(B), l) {
                while (b = a[f++]) b === a[f] && (e = d[nt](f));
                while (e--) a.splice(d[e], 1)
            }
            return k = Ct,
            a
        },
        e = fb.getText = function(a) {
            var b, c = "",
            d = 0,
            f = a[ct];
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if (pt == typeof a[Gt]) return a[Gt];
                    for (a = a[Ft]; a; a = a[Lt]) c += e(a)
                } else if (3 === f || 4 === f) return a.nodeValue
            } else while (b = a[d++]) c += e(b);
            return c
        },
        d = fb.selectors = {
            cacheLength: 50,
            createPseudo: hb,
            match: X,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: vt,
                    first: !0
                },
                " ": {
                    dir: vt
                },
                "+": {
                    dir: Yt,
                    first: !0
                },
                "~": {
                    dir: Yt
                }
            },
            preFilter: {
                ATTR: function(a) {
                    return a[1] = a[1][ot](cb, db),
                    a[3] = (a[3] || a[4] || a[5] || "")[ot](cb, db),
                    "~=" === a[2] && (a[3] = Tt + a[3] + Tt),
                    a[rt](0, 4)
                },
                CHILD: function(a) {
                    return a[1] = a[1][bt](),
                    "nth" === a[1][rt](0, 3) ? (a[3] || fb[Kt](a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && fb[Kt](a[0]),
                    a
                },
                PSEUDO: function(a) {
                    var b, c = !a[6] && a[2];
                    return X.CHILD[yt](a[0]) ? Ct: (a[3] ? a[2] = a[4] || a[5] || "": c && V[yt](c) && (b = g(c, !0)) && (b = c[it](")", c[st] - b) - c[st]) && (a[0] = a[0][rt](0, b), a[2] = c[rt](0, b)), a[rt](0, 3))
                }
            },
            filter: {
                TAG: function(a) {
                    var b = a[ot](cb, db)[bt]();
                    return ut === a ?
                    function() {
                        return ! 0
                    }: function(a) {
                        return a[wt] && a[wt][bt]() === b
                    }
                },
                CLASS: function(a) {
                    var b = y[a + Tt];
                    return b || (b = new RegExp("(^|" + M + ")" + a + "(" + M + "|$)")) && y(a,
                    function(a) {
                        return b[yt](pt == typeof a[Ht] && a[Ht] || typeof a[Et] !== C && a[Et]("class") || "")
                    })
                },
                ATTR: function(a, b, c) {
                    return function(d) {
                        var e = fb.attr(d, a);
                        return Ct == e ? "!=" === b: b ? (e += "", "=" === b ? e === c: "!=" === b ? e !== c: "^=" === b ? c && 0 === e[it](c) : "*=" === b ? c && e[it](c) > -1 : "$=" === b ? c && e[rt]( - c[st]) === c: "~=" === b ? (Tt + e + Tt)[it](c) > -1 : "|=" === b ? e === c || e[rt](0, c[st] + 1) === c + "-": !1) : !0
                    }
                },
                CHILD: function(a, b, c, d, e) {
                    var f = "nth" !== a[rt](0, 3),
                    g = "last" !== a[rt]( - 4),
                    h = "of-type" === b;
                    return 1 === d && 0 === e ?
                    function(a) {
                        return !! a[vt]
                    }: function(b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? Lt: Yt,
                        q = b[vt],
                        r = h && b[wt][bt](),
                        s = !i && !h;
                        if (q) {
                            if (f) {
                                while (p) {
                                    l = b;
                                    while (l = l[p]) if (h ? l[wt][bt]() === r: 1 === l[ct]) return ! 1;
                                    o = p = "only" === a && !o && Lt
                                }
                                return ! 0
                            }
                            if (o = [g ? q[Ft] : q.lastChild], g && s) {
                                k = q[u] || (q[u] = {}),
                                j = k[a] || [],
                                n = j[0] === w && j[1],
                                m = j[0] === w && j[2],
                                l = n && q[lt][n];
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop()) if (1 === l[ct] && ++m && l === b) {
                                    k[a] = [w, n, m];
                                    break
                                }
                            } else if (s && (j = (b[u] || (b[u] = {}))[a]) && j[0] === w) m = j[1];
                            else while (l = ++n && l && l[p] || (m = n = 0) || o.pop()) if ((h ? l[wt][bt]() === r: 1 === l[ct]) && ++m && (s && ((l[u] || (l[u] = {}))[a] = [w, m]), l === b)) break;
                            return m -= e,
                            m === d || m % d === 0 && m / d >= 0
                        }
                    }
                },
                PSEUDO: function(a, b) {
                    var c, e = d[Zt][a] || d[en][a[bt]()] || fb[Kt]("unsupported pseudo: " + a);
                    return e[u] ? e(b) : e[st] > 1 ? (c = [a, a, "", b], d[en][tt](a[bt]()) ? hb(function(a, c) {
                        var d, f = e(a, b),
                        g = f[st];
                        while (g--) d = K[ft](a, f[g]),
                        a[d] = !(c[d] = f[g])
                    }) : function(a) {
                        return e(a, 0, c)
                    }) : e
                }
            },
            pseudos: {
                not: hb(function(a) {
                    var b = [],
                    c = [],
                    d = h(a[ot](R, "$1"));
                    return d[u] ? hb(function(a, b, c, e) {
                        var f, g = d(a, Ct, e, []),
                        h = a[st];
                        while (h--)(f = g[h]) && (a[h] = !(b[h] = f))
                    }) : function(a, e, f) {
                        return b[0] = a,
                        d(b, Ct, f, c),
                        !c.pop()
                    }
                }),
                has: hb(function(a) {
                    return function(b) {
                        return fb(a, b)[st] > 0
                    }
                }),
                contains: hb(function(a) {
                    return function(b) {
                        return (b[Gt] || b.innerText || e(b))[it](a) > -1
                    }
                }),
                lang: hb(function(a) {
                    return W[yt](a || "") || fb[Kt]("unsupported lang: " + a),
                    a = a[ot](cb, db)[bt](),
                    function(b) {
                        var c;
                        do
                        if (c = p ? b.lang: b[Et]("xml:lang") || b[Et]("lang")) return c = c[bt](),
                        c === a || 0 === c[it](a + "-");
                        while ((b = b[vt]) && 1 === b[ct]);
                        return ! 1
                    }
                }),
                target: function(b) {
                    var c = a.location && a.location.hash;
                    return c && c[rt](1) === b.id
                },
                root: function(a) {
                    return a === o
                },
                focus: function(a) {
                    return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a[Ot] || a.href || ~a.tabIndex)
                },
                enabled: function(a) {
                    return a[tn] === !1
                },
                disabled: function(a) {
                    return a[tn] === !0
                },
                checked: function(a) {
                    var b = a[wt][bt]();
                    return At === b && !!a.checked || "option" === b && !!a.selected
                },
                selected: function(a) {
                    return a[vt] && a[vt].selectedIndex,
                    a.selected === !0
                },
                empty: function(a) {
                    for (a = a[Ft]; a; a = a[Lt]) if (a[ct] < 6) return ! 1;
                    return ! 0
                },
                parent: function(a) {
                    return ! d[Zt].empty(a)
                },
                header: function(a) {
                    return Z[yt](a[wt])
                },
                input: function(a) {
                    return Y[yt](a[wt])
                },
                button: function(a) {
                    var b = a[wt][bt]();
                    return At === b && Mt === a[Ot] || Mt === b
                },
                text: function(a) {
                    var b;
                    return At === a[wt][bt]() && "text" === a[Ot] && (Ct == (b = a[Et](Ot)) || "text" === b[bt]())
                },
                first: nb(function() {
                    return [0]
                }),
                last: nb(function(a, b) {
                    return [b - 1]
                }),
                eq: nb(function(a, b, c) {
                    return [0 > c ? c + b: c]
                }),
                even: nb(function(a, b) {
                    for (var c = 0; b > c; c += 2) a[nt](c);
                    return a
                }),
                odd: nb(function(a, b) {
                    for (var c = 1; b > c; c += 2) a[nt](c);
                    return a
                }),
                lt: nb(function(a, b, c) {
                    for (var d = 0 > c ? c + b: c; --d >= 0;) a[nt](d);
                    return a
                }),
                gt: nb(function(a, b, c) {
                    for (var d = 0 > c ? c + b: c; ++d < b;) a[nt](d);
                    return a
                })
            }
        },
        d[Zt].nth = d[Zt].eq;
        for (b in {
            radio: !0,
            checkbox: !0,
            file: !0,
            password: !0,
            image: !0
        }) d[Zt][b] = lb(b);
        for (b in {
            submit: !0,
            reset: !0
        }) d[Zt][b] = mb(b);
        return pb.prototype = d.filters = d[Zt],
        d[en] = new pb,
        g = fb.tokenize = function(a, b) {
            var c, e, f, g, h, i, j, k = z[a + Tt];
            if (k) return b ? 0 : k[rt](0);
            h = a,
            i = [],
            j = d.preFilter;
            while (h) { (!c || (e = S.exec(h))) && (e && (h = h[rt](e[0][st]) || h), i[nt](f = [])),
                c = !1,
                (e = T.exec(h)) && (c = e.shift(), f[nt]({
                    value: c,
                    type: e[0][ot](R, Tt)
                }), h = h[rt](c[st]));
                for (g in d.filter) ! (e = X[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f[nt]({
                    value: c,
                    type: g,
                    matches: e
                }), h = h[rt](c[st]));
                if (!c) break
            }
            return b ? h[st] : h ? fb[Kt](a) : z(a, i)[rt](0)
        },
        h = fb.compile = function(a, b) {
            var c, d = [],
            e = [],
            f = A[a + Tt];
            if (!f) {
                b || (b = g(a)),
                c = b[st];
                while (c--) f = wb(b[c]),
                f[u] ? d[nt](f) : e[nt](f);
                f = A(a, xb(e, d)),
                f.selector = a
            }
            return f
        },
        i = fb.select = function(a, b, e, f) {
            var i, j, k, l, m, n = "function" == typeof a && a,
            o = !f && g(a = n.selector || a);
            if (e = e || [], 1 === o[st]) {
                if (j = o[0] = o[0][rt](0), j[st] > 2 && "ID" === (k = j[0])[Ot] && c.getById && 9 === b[ct] && p && d[nn][j[1][Ot]]) {
                    if (b = (d.find.ID(k[Xt][0][ot](cb, db), b) || [])[0], !b) return e;
                    n && (b = b[vt]),
                    a = a[rt](j.shift()[Rt][st])
                }
                i = X.needsContext[yt](a) ? 0 : j[st];
                while (i--) {
                    if (k = j[i], d[nn][l = k[Ot]]) break;
                    if ((m = d.find[l]) && (f = m(k[Xt][0][ot](cb, db), ab[yt](j[0][Ot]) && ob(b[vt]) || b))) {
                        if (j.splice(i, 1), a = f[st] && qb(j), !a) return I[at](e, f),
                        e;
                        break
                    }
                }
            }
            return (n || h(a, o))(f, b, !p, e, ab[yt](a) && ob(b[vt]) || b),
            e
        },
        c.sortStable = u.split("").sort(B).join("") === u,
        c[Qt] = !!l,
        m(),
        c.sortDetached = ib(function(a) {
            return 1 & a[$t](n[Nt]("div"))
        }),
        ib(function(a) {
            return a[jt] = "<a href='#'></a>",
            "#" === a[Ft][Et]("href")
        }) || jb("type|href|height|width",
        function(a, b, c) {
            return c ? void 0 : a[Et](b, Ot === b[bt]() ? 1 : 2)
        }),
        c[Pt] && ib(function(a) {
            return a[jt] = "<input/>",
            a[Ft][St](Rt, ""),
            "" === a[Ft][Et](Rt)
        }) || jb(Rt,
        function(a, b, c) {
            return c || At !== a[wt][bt]() ? void 0 : a.defaultValue
        }),
        ib(function(a) {
            return Ct == a[Et](tn)
        }) || jb(L,
        function(a, b, c) {
            var d;
            return c ? void 0 : a[b] === !0 ? b[bt]() : (d = a[qt](b)) && d.specified ? d[Rt] : Ct
        }),
        fb
    } (a);
    n.find = t,
    n.expr = t.selectors,
    n.expr[":"] = n.expr.pseudos,
    n.unique = t.uniqueSort,
    n.text = t.getText,
    n.isXMLDoc = t.isXML,
    n.contains = t.contains;
    var u = n.expr.match.needsContext,
    v = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
    w = /^.[^:#\[\.,]*$/;
    n.filter = function(a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"),
        1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b,
        function(a) {
            return 1 === a.nodeType
        }))
    },
    n.fn.extend({
        find: function(a) {
            var t = "selector",
            b, c = this.length,
            d = [],
            e = this;
            if ("string" != typeof a) return this.pushStack(n(a).filter(function() {
                for (b = 0; c > b; b++) if (n.contains(e[b], this)) return ! 0
            }));
            for (b = 0; c > b; b++) n.find(a, e[b], d);
            return d = this.pushStack(c > 1 ? n.unique(d) : d),
            d[t] = this[t] ? this[t] + " " + a: a,
            d
        },
        filter: function(a) {
            return this.pushStack(x(this, a || [], !1))
        },
        not: function(a) {
            return this.pushStack(x(this, a || [], !0))
        },
        is: function(a) {
            return !! x(this, "string" == typeof a && u.test(a) ? n(a) : a || [], !1).length
        }
    });
    var y, z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
    A = n.fn.init = function(a, b) {
        var e = "length",
        t = "isFunction",
        r = "context",
        i = "selector",
        c, d;
        if (!a) return this;
        if ("string" == typeof a) {
            if (c = "<" === a[0] && ">" === a[a[e] - 1] && a[e] >= 3 ? [null, a, null] : z.exec(a), !c || !c[1] && b) return ! b || b.jquery ? (b || y).find(a) : this.constructor(b).find(a);
            if (c[1]) {
                if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b: l, !0)), v.test(c[1]) && n.isPlainObject(b)) for (c in b) n[t](this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                return this
            }
            return d = l.getElementById(c[2]),
            d && d.parentNode && (this[e] = 1, this[0] = d),
            this[r] = l,
            this[i] = a,
            this
        }
        return a.nodeType ? (this[r] = this[0] = a, this[e] = 1, this) : n[t](a) ? "undefined" != typeof y.ready ? y.ready(a) : a(n) : (void 0 !== a[i] && (this[i] = a[i], this[r] = a[r]), n.makeArray(a, this))
    };
    A.prototype = n.fn,
    y = n(l);
    var B = /^(?:parents|prev(?:Until|All))/,
    C = {
        children: !0,
        contents: !0,
        next: !0,
        prev: !0
    };
    n.extend({
        dir: function(a, b, c) {
            var d = [],
            e = void 0 !== c;
            while ((a = a[b]) && 9 !== a.nodeType) if (1 === a.nodeType) {
                if (e && n(a).is(c)) break;
                d.push(a)
            }
            return d
        },
        sibling: function(a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c
        }
    }),
    n.fn.extend({
        has: function(a) {
            var b = n(a, this),
            c = b.length;
            return this.filter(function() {
                for (var a = 0; c > a; a++) if (n.contains(this, b[a])) return ! 0
            })
        },
        closest: function(a, b) {
            for (var c, d = 0,
            e = this.length,
            f = [], g = u.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++) for (c = this[d]; c && c !== b; c = c.parentNode) if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) {
                f.push(c);
                break
            }
            return this.pushStack(f.length > 1 ? n.unique(f) : f)
        },
        index: function(a) {
            return a ? "string" == typeof a ? g.call(n(a), this[0]) : g.call(this, a.jquery ? a[0] : a) : this[0] && this[0].parentNode ? this.first().prevAll().length: -1
        },
        add: function(a, b) {
            return this.pushStack(n.unique(n.merge(this.get(), n(a, b))))
        },
        addBack: function(a) {
            return this.add(null == a ? this.prevObject: this.prevObject.filter(a))
        }
    }),
    n.each({
        parent: function(a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b: null
        },
        parents: function(a) {
            return n.dir(a, "parentNode")
        },
        parentsUntil: function(a, b, c) {
            return n.dir(a, "parentNode", c)
        },
        next: function(a) {
            return D(a, "nextSibling")
        },
        prev: function(a) {
            return D(a, "previousSibling")
        },
        nextAll: function(a) {
            return n.dir(a, "nextSibling")
        },
        prevAll: function(a) {
            return n.dir(a, "previousSibling")
        },
        nextUntil: function(a, b, c) {
            return n.dir(a, "nextSibling", c)
        },
        prevUntil: function(a, b, c) {
            return n.dir(a, "previousSibling", c)
        },
        siblings: function(a) {
            return n.sibling((a.parentNode || {}).firstChild, a)
        },
        children: function(a) {
            return n.sibling(a.firstChild)
        },
        contents: function(a) {
            return a.contentDocument || n.merge([], a.childNodes)
        }
    },
    function(a, b) {
        n.fn[a] = function(c, d) {
            var e = n.map(this, b, c);
            return "Until" !== a.slice( - 5) && (d = c),
            d && "string" == typeof d && (e = n.filter(d, e)),
            this.length > 1 && (C[a] || n.unique(e), B.test(a) && e.reverse()),
            this.pushStack(e)
        }
    });
    var E = /\S+/g,
    F = {};
    n.Callbacks = function(a) {
        var t = "string",
        r = "length";
        a = t == typeof a ? F[a] || G(a) : n.extend({},
        a);
        var b, c, d, e, f, g, h = [],
        i = !a.once && [],
        j = function(l) {
            for (b = a.memory && l, c = !0, g = e || 0, e = 0, f = h[r], d = !0; h && f > g; g++) if (h[g].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
                b = !1;
                break
            }
            d = !1,
            h && (i ? i[r] && j(i.shift()) : b ? h = [] : k.disable())
        },
        k = {
            add: function() {
                if (h) {
                    var c = h[r]; !
                    function g(b) {
                        n.each(b,
                        function(b, c) {
                            var d = n.type(c);
                            "function" === d ? a.unique && k.has(c) || h.push(c) : c && c[r] && t !== d && g(c)
                        })
                    } (arguments),
                    d ? f = h[r] : b && (e = c, j(b))
                }
                return this
            },
            remove: function() {
                return h && n.each(arguments,
                function(a, b) {
                    var c;
                    while ((c = n.inArray(b, h, c)) > -1) h.splice(c, 1),
                    d && (f >= c && f--, g >= c && g--)
                }),
                this
            },
            has: function(a) {
                return a ? n.inArray(a, h) > -1 : !!h && !!h[r]
            },
            empty: function() {
                return h = [],
                f = 0,
                this
            },
            disable: function() {
                return h = i = b = void 0,
                this
            },
            disabled: function() {
                return ! h
            },
            lock: function() {
                return i = void 0,
                b || k.disable(),
                this
            },
            locked: function() {
                return ! i
            },
            fireWith: function(a, b) {
                return ! h || c && !i || (b = b || [], b = [a, b.slice ? b.slice() : b], d ? i.push(b) : j(b)),
                this
            },
            fire: function() {
                return k.fireWith(this, arguments),
                this
            },
            fired: function() {
                return !! c
            }
        };
        return k
    },
    n.extend({
        Deferred: function(a) {
            var t = "resolve",
            r = "Callbacks",
            i = "once memory",
            s = "progress",
            o = "promise",
            u = "isFunction",
            l = "With",
            b = [[t, "done", n[r](i), "resolved"], ["reject", "fail", n[r](i), "rejected"], ["notify", s, n[r]("memory")]],
            c = "pending",
            d = {
                state: function() {
                    return c
                },
                always: function() {
                    return e.done(arguments).fail(arguments),
                    this
                },
                then: function() {
                    var a = arguments;
                    return n.Deferred(function(c) {
                        n.each(b,
                        function(b, f) {
                            var g = n[u](a[b]) && a[b];
                            e[f[1]](function() {
                                var a = g && g.apply(this, arguments);
                                a && n[u](a[o]) ? a[o]().done(c[t]).fail(c.reject)[s](c.notify) : c[f[0] + l](this === d ? c[o]() : this, g ? [a] : arguments)
                            })
                        }),
                        a = null
                    })[o]()
                },
                promise: function(a) {
                    return null != a ? n.extend(a, d) : d
                }
            },
            e = {};
            return d.pipe = d.then,
            n.each(b,
            function(a, f) {
                var g = f[2],
                h = f[3];
                d[f[1]] = g.add,
                h && g.add(function() {
                    c = h
                },
                b[1 ^ a][2].disable, b[2][2].lock),
                e[f[0]] = function() {
                    return e[f[0] + l](this === e ? d: this, arguments),
                    this
                },
                e[f[0] + l] = g.fireWith
            }),
            d[o](e),
            a && a.call(e, e),
            e
        },
        when: function(a) {
            var t = "isFunction",
            r = "promise",
            s = "resolveWith",
            b = 0,
            c = d.call(arguments),
            e = c.length,
            f = 1 !== e || a && n[t](a[r]) ? e: 0,
            g = 1 === f ? a: n.Deferred(),
            h = function(a, b, c) {
                return function(e) {
                    b[a] = this,
                    c[a] = arguments.length > 1 ? d.call(arguments) : e,
                    c === i ? g.notifyWith(b, c) : --f || g[s](b, c)
                }
            },
            i,
            j,
            k;
            if (e > 1) for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++) c[b] && n[t](c[b][r]) ? c[b][r]().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
            return f || g[s](k, c),
            g[r]()
        }
    });
    var H;
    n.fn.ready = function(a) {
        return n.ready.promise().done(a),
        this
    },
    n.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(a) {
            a ? n.readyWait++:n.ready(!0)
        },
        ready: function(a) {
            var e = "triggerHandler",
            t = "ready"; (a === !0 ? --n.readyWait: n.isReady) || (n.isReady = !0, a !== !0 && --n.readyWait > 0 || (H.resolveWith(l, [n]), n.fn[e] && (n(l)[e](t), n(l).off(t))))
        }
    }),
    n.ready.promise = function(b) {
        var e = "addEventListener";
        return H || (H = n.Deferred(), "complete" === l.readyState ? setTimeout(n.ready) : (l[e]("DOMContentLoaded", I, !1), a[e]("load", I, !1))),
        H.promise(b)
    },
    n.ready.promise();
    var J = n.access = function(a, b, c, d, e, f, g) {
        var h = 0,
        i = a.length,
        j = null == c;
        if ("object" === n.type(c)) {
            e = !0;
            for (h in c) n.access(a, b, h, c[h], !0, f, g)
        } else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function(a, b, c) {
            return j.call(n(a), c)
        })), b)) for (; i > h; h++) b(a[h], c, g ? d: d.call(a[h], h, b(a[h], c)));
        return e ? a: j ? b.call(a) : i ? b(a[0], c) : f
    };
    n.acceptData = function(a) {
        var e = "nodeType";
        return 1 === a[e] || 9 === a[e] || !+a[e]
    },
    K.uid = 1,
    K.accepts = n.acceptData,
    K.prototype = {
        key: function(a) {
            if (!K.accepts(a)) return 0;
            var b = {},
            c = a[this.expando];
            if (!c) {
                c = K.uid++;
                try {
                    b[this.expando] = {
                        value: c
                    },
                    Object.defineProperties(a, b)
                } catch(d) {
                    b[this.expando] = c,
                    n.extend(a, b)
                }
            }
            return this.cache[c] || (this.cache[c] = {}),
            c
        },
        set: function(a, b, c) {
            var d, e = this.key(a),
            f = this.cache[e];
            if ("string" == typeof b) f[b] = c;
            else if (n.isEmptyObject(f)) n.extend(this.cache[e], b);
            else for (d in b) f[d] = b[d];
            return f
        },
        get: function(a, b) {
            var c = this.cache[this.key(a)];
            return void 0 === b ? c: c[b]
        },
        access: function(a, b, c) {
            var d;
            return void 0 === b || b && "string" == typeof b && void 0 === c ? (d = this.get(a, b), void 0 !== d ? d: this.get(a, n.camelCase(b))) : (this.set(a, b, c), void 0 !== c ? c: b)
        },
        remove: function(a, b) {
            var c, d, e, f = this.key(a),
            g = this.cache[f];
            if (void 0 === b) this.cache[f] = {};
            else {
                n.isArray(b) ? d = b.concat(b.map(n.camelCase)) : (e = n.camelCase(b), b in g ? d = [b, e] : (d = e, d = d in g ? [d] : d.match(E) || [])),
                c = d.length;
                while (c--) delete g[d[c]]
            }
        },
        hasData: function(a) {
            return ! n.isEmptyObject(this.cache[a[this.expando]] || {})
        },
        discard: function(a) {
            a[this.expando] && delete this.cache[a[this.expando]]
        }
    };
    var L = new K,
    M = new K,
    N = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
    O = /([A-Z])/g;
    n.extend({
        hasData: function(a) {
            return M.hasData(a) || L.hasData(a)
        },
        data: function(a, b, c) {
            return M.access(a, b, c)
        },
        removeData: function(a, b) {
            M.remove(a, b)
        },
        _data: function(a, b, c) {
            return L.access(a, b, c)
        },
        _removeData: function(a, b) {
            L.remove(a, b)
        }
    }),
    n.fn.extend({
        data: function(a, b) {
            var t = "length",
            r = "hasDataAttrs",
            c, d, e, f = this[0],
            g = f && f.attributes;
            if (void 0 === a) {
                if (this[t] && (e = M.get(f), 1 === f.nodeType && !L.get(f, r))) {
                    c = g[t];
                    while (c--) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), P(f, d, e[d])));
                    L.set(f, r, !0)
                }
                return e
            }
            return "object" == typeof a ? this.each(function() {
                M.set(this, a)
            }) : J(this,
            function(b) {
                var c, d = n.camelCase(a);
                if (f && void 0 === b) {
                    if (c = M.get(f, a), void 0 !== c) return c;
                    if (c = M.get(f, d), void 0 !== c) return c;
                    if (c = P(f, d, void 0), void 0 !== c) return c
                } else this.each(function() {
                    var c = M.get(this, d);
                    M.set(this, d, b),
                    -1 !== a.indexOf("-") && void 0 !== c && M.set(this, a, b)
                })
            },
            null, b, arguments[t] > 1, null, !0)
        },
        removeData: function(a) {
            return this.each(function() {
                M.remove(this, a)
            })
        }
    }),
    n.extend({
        queue: function(a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = L.get(a, b), c && (!d || n.isArray(c) ? d = L.access(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0
        },
        dequeue: function(a, b) {
            var t = "inprogress";
            b = b || "fx";
            var c = n.queue(a, b),
            d = c.length,
            e = c.shift(),
            f = n._queueHooks(a, b),
            g = function() {
                n.dequeue(a, b)
            };
            t === e && (e = c.shift(), d--),
            e && ("fx" === b && c.unshift(t), delete f.stop, e.call(a, g, f)),
            !d && f && f.empty.fire()
        },
        _queueHooks: function(a, b) {
            var c = b + "queueHooks";
            return L.get(a, c) || L.access(a, c, {
                empty: n.Callbacks("once memory").add(function() {
                    L.remove(a, [b + "queue", c])
                })
            })
        }
    }),
    n.fn.extend({
        queue: function(a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--),
            arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this: this.each(function() {
                var c = n.queue(this, a, b);
                n._queueHooks(this, a),
                "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a)
            })
        },
        dequeue: function(a) {
            return this.each(function() {
                n.dequeue(this, a)
            })
        },
        clearQueue: function(a) {
            return this.queue(a || "fx", [])
        },
        promise: function(a, b) {
            var c, d = 1,
            e = n.Deferred(),
            f = this,
            g = this.length,
            h = function() {--d || e.resolveWith(f, [f])
            };
            "string" != typeof a && (b = a, a = void 0),
            a = a || "fx";
            while (g--) c = L.get(f[g], a + "queueHooks"),
            c && c.empty && (d++, c.empty.add(h));
            return h(),
            e.promise(b)
        }
    });
    var Q = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
    R = ["Top", "Right", "Bottom", "Left"],
    S = function(a, b) {
        return a = b || a,
        "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a)
    },
    T = /^(?:checkbox|radio)$/i; !
    function() {
        var e = "appendChild",
        t = "createElement",
        n = "setAttribute",
        r = "checked",
        i = "cloneNode",
        a = l.createDocumentFragment(),
        b = a[e](l[t]("div")),
        c = l[t]("input");
        c[n]("type", "radio"),
        c[n](r, r),
        c[n]("name", "t"),
        b[e](c),
        k.checkClone = b[i](!0)[i](!0).lastChild[r],
        b.innerHTML = "<textarea>x</textarea>",
        k.noCloneChecked = !!b[i](!0).lastChild.defaultValue
    } ();
    var U = "undefined";
    k.focusinBubbles = "onfocusin" in a;
    var V = /^key/,
    W = /^(?:mouse|pointer|contextmenu)|click/,
    X = /^(?:focusinfocus|focusoutblur)$/,
    Y = /^([^.]*)(?:\.(.+)|)$/;
    n.event = {
        global: {},
        add: function(a, b, c, d, e) {
            var t = "handler",
            s = "guid",
            u = "event",
            v = "delegateCount",
            y = "addEventListener",
            f, g, h, i, j, k, l, m, o, p, q, r = L.get(a);
            if (r) {
                c[t] && (f = c, c = f[t], e = f.selector),
                c[s] || (c[s] = n[s]++),
                (i = r.events) || (i = r.events = {}),
                (g = r.handle) || (g = r.handle = function(b) {
                    return typeof n !== U && n[u].triggered !== b.type ? n[u].dispatch.apply(a, arguments) : void 0
                }),
                b = (b || "").match(E) || [""],
                j = b.length;
                while (j--) h = Y.exec(b[j]) || [],
                o = q = h[1],
                p = (h[2] || "").split(".").sort(),
                o && (l = n[u].special[o] || {},
                o = (e ? l.delegateType: l.bindType) || o, l = n[u].special[o] || {},
                k = n.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c[s],
                    selector: e,
                    needsContext: e && n.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                },
                f), (m = i[o]) || (m = i[o] = [], m[v] = 0, l.setup && l.setup.call(a, d, p, g) !== !1 || a[y] && a[y](o, g, !1)), l.add && (l.add.call(a, k), k[t][s] || (k[t][s] = c[s])), e ? m.splice(m[v]++, 0, k) : m.push(k), n[u].global[o] = !0)
            }
        },
        remove: function(a, b, c, d, e) {
            var t = "length",
            s = "selector",
            u = "remove",
            v = "handle",
            f, g, h, i, j, k, l, m, o, p, q, r = L.hasData(a) && L.get(a);
            if (r && (i = r.events)) {
                b = (b || "").match(E) || [""],
                j = b[t];
                while (j--) if (h = Y.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                    l = n.event.special[o] || {},
                    o = (d ? l.delegateType: l.bindType) || o,
                    m = i[o] || [],
                    h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"),
                    g = f = m[t];
                    while (f--) k = m[f],
                    !e && q !== k.origType || c && c.guid !== k.guid || h && !h.test(k.namespace) || d && d !== k[s] && ("**" !== d || !k[s]) || (m.splice(f, 1), k[s] && m.delegateCount--, l[u] && l[u].call(a, k));
                    g && !m[t] && (l.teardown && l.teardown.call(a, p, r[v]) !== !1 || n.removeEvent(a, o, r[v]), delete i[o])
                } else for (o in i) n.event[u](a, o + b[j], c, d, !0);
                n.isEmptyObject(i) && (delete r[v], L[u](a, "events"))
            }
        },
        trigger: function(b, c, d, e) {
            var t = "type",
            s = "namespace",
            u = ".",
            v = "triggered",
            y = "event",
            w = null,
            E = "result",
            S = "apply",
            x = "parentNode",
            T = "acceptData",
            f, g, h, i, k, m, o, p = [d || l],
            q = j.call(b, t) ? b[t] : b,
            r = j.call(b, s) ? b[s].split(u) : [];
            if (g = h = d = d || l, 3 !== d.nodeType && 8 !== d.nodeType && !X.test(q + n[y][v]) && (q.indexOf(u) >= 0 && (r = q.split(u), q = r.shift(), r.sort()), k = q.indexOf(":") < 0 && "on" + q, b = b[n.expando] ? b: new n.Event(q, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b[s] = r.join(u), b.namespace_re = b[s] ? new RegExp("(^|\\.)" + r.join("\\.(?:.*\\.|)") + "(\\.|$)") : w, b[E] = void 0, b.target || (b.target = d), c = w == c ? [b] : n.makeArray(c, [b]), o = n[y].special[q] || {},
            e || !o.trigger || o.trigger[S](d, c) !== !1)) {
                if (!e && !o.noBubble && !n.isWindow(d)) {
                    for (i = o.delegateType || q, X.test(i + q) || (g = g[x]); g; g = g[x]) p.push(g),
                    h = g;
                    h === (d.ownerDocument || l) && p.push(h.defaultView || h.parentWindow || a)
                }
                f = 0;
                while ((g = p[f++]) && !b.isPropagationStopped()) b[t] = f > 1 ? i: o.bindType || q,
                m = (L.get(g, "events") || {})[b[t]] && L.get(g, "handle"),
                m && m[S](g, c),
                m = k && g[k],
                m && m[S] && n[T](g) && (b[E] = m[S](g, c), b[E] === !1 && b.preventDefault());
                return b[t] = q,
                e || b.isDefaultPrevented() || o._default && o._default[S](p.pop(), c) !== !1 || !n[T](d) || k && n.isFunction(d[q]) && !n.isWindow(d) && (h = d[k], h && (d[k] = w), n[y][v] = q, d[q](), n[y][v] = void 0, h && (d[k] = h)),
                b[E]
            }
        },
        dispatch: function(a) {
            var t = "event",
            r = "preDispatch",
            s = "namespace_re",
            o = "postDispatch";
            a = n[t].fix(a);
            var b, c, e, f, g, h = [],
            i = d.call(arguments),
            j = (L.get(this, "events") || {})[a.type] || [],
            k = n[t].special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k[r] || k[r].call(this, a) !== !1) {
                h = n[t].handlers.call(this, a, j),
                b = 0;
                while ((f = h[b++]) && !a.isPropagationStopped()) {
                    a.currentTarget = f.elem,
                    c = 0;
                    while ((g = f.handlers[c++]) && !a.isImmediatePropagationStopped())(!a[s] || a[s].test(g.namespace)) && (a.handleObj = g, a.data = g.data, e = ((n[t].special[g.origType] || {}).handle || g.handler).apply(f.elem, i), void 0 !== e && (a.result = e) === !1 && (a.preventDefault(), a.stopPropagation()))
                }
                return k[o] && k[o].call(this, a),
                a.result
            }
        },
        handlers: function(a, b) {
            var t = "click",
            r = "length",
            c, d, e, f, g = [],
            h = b.delegateCount,
            i = a.target;
            if (h && i.nodeType && (!a.button || t !== a.type)) for (; i !== this; i = i.parentNode || this) if (i.disabled !== !0 || t !== a.type) {
                for (d = [], c = 0; h > c; c++) f = b[c],
                e = f.selector + " ",
                void 0 === d[e] && (d[e] = f.needsContext ? n(e, this).index(i) >= 0 : n.find(e, this, null, [i])[r]),
                d[e] && d.push(f);
                d[r] && g.push({
                    elem: i,
                    handlers: d
                })
            }
            return h < b[r] && g.push({
                elem: this,
                handlers: b.slice(h)
            }),
            g
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode: b.keyCode),
                a
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(a, b) {
                var t = "scrollLeft",
                n = "clientLeft",
                c, d, e, f = b.button;
                return null == a.pageX && null != b.clientX && (c = a.target.ownerDocument || l, d = c.documentElement, e = c.body, a.pageX = b.clientX + (d && d[t] || e && e[t] || 0) - (d && d[n] || e && e[n] || 0), a.pageY = b.clientY + (d && d.scrollTop || e && e.scrollTop || 0) - (d && d.clientTop || e && e.clientTop || 0)),
                a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0),
                a
            }
        },
        fix: function(a) {
            var t = "props",
            r = "target";
            if (a[n.expando]) return a;
            var b, c, d, e = a.type,
            f = a,
            g = this.fixHooks[e];
            g || (this.fixHooks[e] = g = W.test(e) ? this.mouseHooks: V.test(e) ? this.keyHooks: {}),
            d = g[t] ? this[t].concat(g[t]) : this[t],
            a = new n.Event(f),
            b = d.length;
            while (b--) c = d[b],
            a[c] = f[c];
            return a[r] || (a[r] = l),
            3 === a[r].nodeType && (a[r] = a[r].parentNode),
            g.filter ? g.filter(a, f) : a
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    return this !== _() && this.focus ? (this.focus(), !1) : void 0
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === _() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return "checkbox" === this.type && this.click && n.nodeName(this, "input") ? (this.click(), !1) : void 0
                },
                _default: function(a) {
                    return n.nodeName(a.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(a) {
                    void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result)
                }
            }
        },
        simulate: function(a, b, c, d) {
            var e = n.extend(new n.Event, c, {
                type: a,
                isSimulated: !0,
                originalEvent: {}
            });
            d ? n.event.trigger(e, null, b) : n.event.dispatch.call(b, e),
            e.isDefaultPrevented() && c.preventDefault()
        }
    },
    n.removeEvent = function(a, b, c) {
        var e = "removeEventListener";
        a[e] && a[e](b, c, !1)
    },
    n.Event = function(a, b) {
        var e = "defaultPrevented";
        return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a[e] || void 0 === a[e] && a.returnValue === !1 ? Z: $) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b)
    },
    n.Event.prototype = {
        isDefaultPrevented: $,
        isPropagationStopped: $,
        isImmediatePropagationStopped: $,
        preventDefault: function() {
            var e = "preventDefault",
            a = this.originalEvent;
            this.isDefaultPrevented = Z,
            a && a[e] && a[e]()
        },
        stopPropagation: function() {
            var e = "stopPropagation",
            a = this.originalEvent;
            this.isPropagationStopped = Z,
            a && a[e] && a[e]()
        },
        stopImmediatePropagation: function() {
            var e = "stopImmediatePropagation",
            a = this.originalEvent;
            this.isImmediatePropagationStopped = Z,
            a && a[e] && a[e](),
            this.stopPropagation()
        }
    },
    n.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    },
    function(a, b) {
        n.event.special[a] = {
            delegateType: b,
            bindType: b,
            handle: function(a) {
                var c, d = this,
                e = a.relatedTarget,
                f = a.handleObj;
                return (!e || e !== d && !n.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b),
                c
            }
        }
    }),
    k.focusinBubbles || n.each({
        focus: "focusin",
        blur: "focusout"
    },
    function(a, b) {
        var t = "ownerDocument",
        r = "access",
        c = function(a) {
            n.event.simulate(b, a.target, n.event.fix(a), !0)
        };
        n.event.special[b] = {
            setup: function() {
                var d = this[t] || this,
                e = L[r](d, b);
                e || d.addEventListener(a, c, !0),
                L[r](d, b, (e || 0) + 1)
            },
            teardown: function() {
                var d = this[t] || this,
                e = L[r](d, b) - 1;
                e ? L[r](d, b, e) : (d.removeEventListener(a, c, !0), L.remove(d, b))
            }
        }
    }),
    n.fn.extend({
        on: function(a, b, c, d, e) {
            var t = "string",
            r = null,
            f, g;
            if ("object" == typeof a) {
                t != typeof b && (c = c || b, b = void 0);
                for (g in a) this.on(g, b, c, a[g], e);
                return this
            }
            if (r == c && r == d ? (d = b, c = b = void 0) : r == d && (t == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1) d = $;
            else if (!d) return this;
            return 1 === e && (f = d, d = function(a) {
                return n().off(a),
                f.apply(this, arguments)
            },
            d.guid = f.guid || (f.guid = n.guid++)),
            this.each(function() {
                n.event.add(this, a, d, c, b)
            })
        },
        one: function(a, b, c, d) {
            return this.on(a, b, c, d, 1)
        },
        off: function(a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj,
            n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace: d.origType, d.selector, d.handler),
            this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this
            }
            return (b === !1 || "function" == typeof b) && (c = b, b = void 0),
            c === !1 && (c = $),
            this.each(function() {
                n.event.remove(this, a, c, b)
            })
        },
        trigger: function(a, b) {
            return this.each(function() {
                n.event.trigger(a, b, this)
            })
        },
        triggerHandler: function(a, b) {
            var c = this[0];
            return c ? n.event.trigger(a, b, c, !0) : void 0
        }
    });
    var ab = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
    bb = /<([\w:]+)/,
    cb = /<|&#?\w+;/,
    db = /<(?:script|style|link)/i,
    eb = /checked\s*(?:[^=]|=\s*.checked.)/i,
    fb = /^$|\/(?:java|ecma)script/i,
    gb = /^true\/(.*)/,
    hb = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
    ib = {
        option: [1, "<select multiple='multiple'>", "</select>"],
        thead: [1, "<table>", "</table>"],
        col: [2, "<table><colgroup>", "</colgroup></table>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
        _default: [0, "", ""]
    };
    ib.optgroup = ib.option,
    ib.tbody = ib.tfoot = ib.colgroup = ib.caption = ib.thead,
    ib.th = ib.td,
    n.extend({
        clone: function(a, b, c) {
            var t = "length",
            r = "script",
            d, e, f, g, h = a.cloneNode(!0),
            i = n.contains(a.ownerDocument, a);
            if (! (k.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a))) for (g = ob(h), f = ob(a), d = 0, e = f[t]; e > d; d++) pb(f[d], g[d]);
            if (b) if (c) for (f = f || ob(a), g = g || ob(h), d = 0, e = f[t]; e > d; d++) nb(f[d], g[d]);
            else nb(a, h);
            return g = ob(h, r),
            g[t] > 0 && mb(g, !i && ob(a, r)),
            h
        },
        buildFragment: function(a, b, c, d) {
            for (var e, f, g, h, i, j, k = b.createDocumentFragment(), l = [], m = 0, o = a.length; o > m; m++) if (e = a[m], e || 0 === e) if ("object" === n.type(e)) n.merge(l, e.nodeType ? [e] : e);
            else if (cb.test(e)) {
                f = f || k.appendChild(b.createElement("div")),
                g = (bb.exec(e) || ["", ""])[1].toLowerCase(),
                h = ib[g] || ib._default,
                f.innerHTML = h[1] + e.replace(ab, "<$1></$2>") + h[2],
                j = h[0];
                while (j--) f = f.lastChild;
                n.merge(l, f.childNodes),
                f = k.firstChild,
                f.textContent = ""
            } else l.push(b.createTextNode(e));
            k.textContent = "",
            m = 0;
            while (e = l[m++]) if ((!d || -1 === n.inArray(e, d)) && (i = n.contains(e.ownerDocument, e), f = ob(k.appendChild(e), "script"), i && mb(f), c)) {
                j = 0;
                while (e = f[j++]) fb.test(e.type || "") && c.push(e)
            }
            return k
        },
        cleanData: function(a) {
            for (var b, c, d, e, f = n.event.special,
            g = 0; void 0 !== (c = a[g]); g++) {
                if (n.acceptData(c) && (e = c[L.expando], e && (b = L.cache[e]))) {
                    if (b.events) for (d in b.events) f[d] ? n.event.remove(c, d) : n.removeEvent(c, d, b.handle);
                    L.cache[e] && delete L.cache[e]
                }
                delete M.cache[c[M.expando]]
            }
        }
    }),
    n.fn.extend({
        text: function(a) {
            var e = "nodeType";
            return J(this,
            function(a) {
                return void 0 === a ? n.text(this) : this.empty().each(function() { (1 === this[e] || 11 === this[e] || 9 === this[e]) && (this.textContent = a)
                })
            },
            null, a, arguments.length)
        },
        append: function() {
            var e = "nodeType";
            return this.domManip(arguments,
            function(a) {
                if (1 === this[e] || 11 === this[e] || 9 === this[e]) {
                    var b = jb(this, a);
                    b.appendChild(a)
                }
            })
        },
        prepend: function() {
            var e = "nodeType";
            return this.domManip(arguments,
            function(a) {
                if (1 === this[e] || 11 === this[e] || 9 === this[e]) {
                    var b = jb(this, a);
                    b.insertBefore(a, b.firstChild)
                }
            })
        },
        before: function() {
            return this.domManip(arguments,
            function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this)
            })
        },
        after: function() {
            return this.domManip(arguments,
            function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
            })
        },
        remove: function(a, b) {
            for (var c, d = a ? n.filter(a, this) : this, e = 0; null != (c = d[e]); e++) b || 1 !== c.nodeType || n.cleanData(ob(c)),
            c.parentNode && (b && n.contains(c.ownerDocument, c) && mb(ob(c, "script")), c.parentNode.removeChild(c));
            return this
        },
        empty: function() {
            for (var a, b = 0; null != (a = this[b]); b++) 1 === a.nodeType && (n.cleanData(ob(a, !1)), a.textContent = "");
            return this
        },
        clone: function(a, b) {
            return a = null == a ? !1 : a,
            b = null == b ? a: b,
            this.map(function() {
                return n.clone(this, a, b)
            })
        },
        html: function(a) {
            return J(this,
            function(a) {
                var b = this[0] || {},
                c = 0,
                d = this.length;
                if (void 0 === a && 1 === b.nodeType) return b.innerHTML;
                if ("string" == typeof a && !db.test(a) && !ib[(bb.exec(a) || ["", ""])[1].toLowerCase()]) {
                    a = a.replace(ab, "<$1></$2>");
                    try {
                        for (; d > c; c++) b = this[c] || {},
                        1 === b.nodeType && (n.cleanData(ob(b, !1)), b.innerHTML = a);
                        b = 0
                    } catch(e) {}
                }
                b && this.empty().append(a)
            },
            null, a, arguments.length)
        },
        replaceWith: function() {
            var a = arguments[0];
            return this.domManip(arguments,
            function(b) {
                a = this.parentNode,
                n.cleanData(ob(this)),
                a && a.replaceChild(b, this)
            }),
            a && (a.length || a.nodeType) ? this: this.remove()
        },
        detach: function(a) {
            return this.remove(a, !0)
        },
        domManip: function(a, b) {
            var t = "length",
            r = "ownerDocument",
            s = "script",
            u = "globalEval";
            a = e.apply([], a);
            var c, d, f, g, h, i, j = 0,
            l = this[t],
            m = this,
            o = l - 1,
            p = a[0],
            q = n.isFunction(p);
            if (q || l > 1 && "string" == typeof p && !k.checkClone && eb.test(p)) return this.each(function(c) {
                var d = m.eq(c);
                q && (a[0] = p.call(this, c, d.html())),
                d.domManip(a, b)
            });
            if (l && (c = n.buildFragment(a, this[0][r], !1, this), d = c.firstChild, 1 === c.childNodes[t] && (c = d), d)) {
                for (f = n.map(ob(c, s), kb), g = f[t]; l > j; j++) h = c,
                j !== o && (h = n.clone(h, !0, !0), g && n.merge(f, ob(h, s))),
                b.call(this[j], h, j);
                if (g) for (i = f[f[t] - 1][r], n.map(f, lb), j = 0; g > j; j++) h = f[j],
                fb.test(h.type || "") && !L.access(h, u) && n.contains(i, h) && (h.src ? n._evalUrl && n._evalUrl(h.src) : n[u](h.textContent.replace(hb, "")))
            }
            return this
        }
    }),
    n.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    },
    function(a, b) {
        n.fn[a] = function(a) {
            for (var c, d = [], e = n(a), g = e.length - 1, h = 0; g >= h; h++) c = h === g ? this: this.clone(!0),
            n(e[h])[b](c),
            f.apply(d, c.get());
            return this.pushStack(d)
        }
    });
    var qb, rb = {},
    ub = /^margin/,
    vb = new RegExp("^(" + Q + ")(?!px)[a-z%]+$", "i"),
    wb = function(a) {
        return a.ownerDocument.defaultView.getComputedStyle(a, null)
    }; !
    function() {
        var t = "createElement",
        r = "div",
        i = "style",
        s = "backgroundClip",
        o = "content-box",
        u = "cssText",
        h = "appendChild",
        p = "getComputedStyle",
        v = null,
        m = "removeChild",
        y = "marginRight",
        b, c, d = l.documentElement,
        e = l[t](r),
        f = l[t](r);
        if (f[i]) {
            f[i][s] = o,
            f.cloneNode(!0)[i][s] = "",
            k.clearCloneStyle = o === f[i][s],
            e[i][u] = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute",
            e[h](f);
            function g() {
                f[i][u] = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",
                f.innerHTML = "",
                d[h](e);
                var g = a[p](f, v);
                b = "1%" !== g.top,
                c = "4px" === g.width,
                d[m](e)
            }
            a[p] && n.extend(k, {
                pixelPosition: function() {
                    return g(),
                    b
                },
                boxSizingReliable: function() {
                    return v == c && g(),
                    c
                },
                reliableMarginRight: function() {
                    var b, c = f[h](l[t](r));
                    return c[i][u] = f[i][u] = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",
                    c[i][y] = c[i].width = "0",
                    f[i].width = "1px",
                    d[h](e),
                    b = !parseFloat(a[p](c, v)[y]),
                    d[m](e),
                    b
                }
            })
        }
    } (),
    n.swap = function(a, b, c, d) {
        var e, f, g = {};
        for (f in b) g[f] = a.style[f],
        a.style[f] = b[f];
        e = c.apply(a, d || []);
        for (f in b) a.style[f] = g[f];
        return e
    };
    var zb = /^(none|table(?!-c[ea]).+)/,
    Ab = new RegExp("^(" + Q + ")(.*)$", "i"),
    Bb = new RegExp("^([+-])=(" + Q + ")", "i"),
    Cb = {
        position: "absolute",
        visibility: "hidden",
        display: "block"
    },
    Db = {
        letterSpacing: "0",
        fontWeight: "400"
    },
    Eb = ["Webkit", "O", "Moz", "ms"];
    n.extend({
        cssHooks: {
            opacity: {
                get: function(a, b) {
                    if (b) {
                        var c = xb(a, "opacity");
                        return "" === c ? "1": c
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
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
            "float": "cssFloat"
        },
        style: function(a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = n.camelCase(b),
                i = a.style;
                return b = n.cssProps[h] || (n.cssProps[h] = Fb(i, h)),
                g = n.cssHooks[b] || n.cssHooks[h],
                void 0 === c ? g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e: i[b] : (f = typeof c, "string" === f && (e = Bb.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(n.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || n.cssNumber[h] || (c += "px"), k.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), g && "set" in g && void 0 === (c = g.set(a, c, d)) || (i[b] = c)), void 0)
            }
        },
        css: function(a, b, c, d) {
            var e, f, g, h = n.camelCase(b);
            return b = n.cssProps[h] || (n.cssProps[h] = Fb(a.style, h)),
            g = n.cssHooks[b] || n.cssHooks[h],
            g && "get" in g && (e = g.get(a, !0, c)),
            void 0 === e && (e = xb(a, b, d)),
            "normal" === e && b in Db && (e = Db[b]),
            "" === c || c ? (f = parseFloat(e), c === !0 || n.isNumeric(f) ? f || 0 : e) : e
        }
    }),
    n.each(["height", "width"],
    function(a, b) {
        n.cssHooks[b] = {
            get: function(a, c, d) {
                return c ? zb.test(n.css(a, "display")) && 0 === a.offsetWidth ? n.swap(a, Cb,
                function() {
                    return Ib(a, b, d)
                }) : Ib(a, b, d) : void 0
            },
            set: function(a, c, d) {
                var e = d && wb(a);
                return Gb(a, c, d ? Hb(a, b, d, "border-box" === n.css(a, "boxSizing", !1, e), e) : 0)
            }
        }
    }),
    n.cssHooks.marginRight = yb(k.reliableMarginRight,
    function(a, b) {
        return b ? n.swap(a, {
            display: "inline-block"
        },
        xb, [a, "marginRight"]) : void 0
    }),
    n.each({
        margin: "",
        padding: "",
        border: "Width"
    },
    function(a, b) {
        n.cssHooks[a + b] = {
            expand: function(c) {
                for (var d = 0,
                e = {},
                f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + R[d] + b] = f[d] || f[d - 2] || f[0];
                return e
            }
        },
        ub.test(a) || (n.cssHooks[a + b].set = Gb)
    }),
    n.fn.extend({
        css: function(a, b) {
            return J(this,
            function(a, b, c) {
                var d, e, f = {},
                g = 0;
                if (n.isArray(b)) {
                    for (d = wb(a), e = b.length; e > g; g++) f[b[g]] = n.css(a, b[g], !1, d);
                    return f
                }
                return void 0 !== c ? n.style(a, b, c) : n.css(a, b)
            },
            a, b, arguments.length > 1)
        },
        show: function() {
            return Jb(this, !0)
        },
        hide: function() {
            return Jb(this)
        },
        toggle: function(a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() {
                S(this) ? n(this).show() : n(this).hide()
            })
        }
    }),
    n.Tween = Kb,
    Kb.prototype = {
        constructor: Kb,
        init: function(a, b, c, d, e, f) {
            this.elem = a,
            this.prop = c,
            this.easing = e || "swing",
            this.options = b,
            this.start = this.now = this.cur(),
            this.end = d,
            this.unit = f || (n.cssNumber[c] ? "": "px")
        },
        cur: function() {
            var a = Kb.propHooks[this.prop];
            return a && a.get ? a.get(this) : Kb.propHooks._default.get(this)
        },
        run: function(a) {
            var e = "duration",
            t = "options",
            b, c = Kb.propHooks[this.prop];
            return this.pos = b = this[t][e] ? n.easing[this.easing](a, this[t][e] * a, 0, 1, this[t][e]) : a,
            this.now = (this.end - this.start) * b + this.start,
            this[t].step && this[t].step.call(this.elem, this.now, this),
            c && c.set ? c.set(this) : Kb.propHooks._default.set(this),
            this
        }
    },
    Kb.prototype.init.prototype = Kb.prototype,
    Kb.propHooks = {
        _default: {
            get: function(a) {
                var e = "elem",
                b;
                return null == a[e][a.prop] || a[e].style && null != a[e].style[a.prop] ? (b = n.css(a[e], a.prop, ""), b && "auto" !== b ? b: 0) : a[e][a.prop]
            },
            set: function(a) {
                n.fx.step[a.prop] ? n.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[n.cssProps[a.prop]] || n.cssHooks[a.prop]) ? n.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
            }
        }
    },
    Kb.propHooks.scrollTop = Kb.propHooks.scrollLeft = {
        set: function(a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
        }
    },
    n.easing = {
        linear: function(a) {
            return a
        },
        swing: function(a) {
            return.5 - Math.cos(a * Math.PI) / 2
        }
    },
    n.fx = Kb.prototype.init,
    n.fx.step = {};
    var Lb, Mb, Nb = /^(?:toggle|show|hide)$/,
    Ob = new RegExp("^(?:([+-])=|)(" + Q + ")([a-z%]*)$", "i"),
    Pb = /queueHooks$/,
    Qb = [Vb],
    Rb = {
        "*": [function(a, b) {
            var c = this.createTween(a, b),
            d = c.cur(),
            e = Ob.exec(b),
            f = e && e[3] || (n.cssNumber[a] ? "": "px"),
            g = (n.cssNumber[a] || "px" !== f && +d) && Ob.exec(n.css(c.elem, a)),
            h = 1,
            i = 20;
            if (g && g[3] !== f) {
                f = f || g[3],
                e = e || [],
                g = +d || 1;
                do h = h || ".5",
                g /= h,
                n.style(c.elem, a, g + f);
                while (h !== (h = c.cur() / d) && 1 !== h && --i)
            }
            return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]),
            c
        }]
    };
    n.Animation = n.extend(Xb, {
        tweener: function(a, b) {
            n.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
            for (var c, d = 0,
            e = a.length; e > d; d++) c = a[d],
            Rb[c] = Rb[c] || [],
            Rb[c].unshift(b)
        },
        prefilter: function(a, b) {
            b ? Qb.unshift(a) : Qb.push(a)
        }
    }),
    n.speed = function(a, b, c) {
        var e = "isFunction",
        t = "duration",
        r = "speeds",
        i = "queue",
        d = a && "object" == typeof a ? n.extend({},
        a) : {
            complete: c || !c && b || n[e](a) && a,
            duration: a,
            easing: c && b || b && !n[e](b) && b
        };
        return d[t] = n.fx.off ? 0 : "number" == typeof d[t] ? d[t] : d[t] in n.fx[r] ? n.fx[r][d[t]] : n.fx[r]._default,
        (null == d[i] || d[i] === !0) && (d[i] = "fx"),
        d.old = d.complete,
        d.complete = function() {
            n[e](d.old) && d.old.call(this),
            d[i] && n.dequeue(this, d[i])
        },
        d
    },
    n.fn.extend({
        fadeTo: function(a, b, c, d) {
            return this.filter(S).css("opacity", 0).show().end().animate({
                opacity: b
            },
            a, c, d)
        },
        animate: function(a, b, c, d) {
            var e = n.isEmptyObject(a),
            f = n.speed(b, c, d),
            g = function() {
                var b = Xb(this, n.extend({},
                a), f); (e || L.get(this, "finish")) && b.stop(!0)
            };
            return g.finish = g,
            e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
        },
        stop: function(a, b, c) {
            var t = "stop",
            d = function(a) {
                var b = a[t];
                delete a[t],
                b(c)
            };
            return "string" != typeof a && (c = b, b = a, a = void 0),
            b && a !== !1 && this.queue(a || "fx", []),
            this.each(function() {
                var b = !0,
                e = null != a && a + "queueHooks",
                f = n.timers,
                g = L.get(this);
                if (e) g[e] && g[e][t] && d(g[e]);
                else for (e in g) g[e] && g[e][t] && Pb.test(e) && d(g[e]);
                for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim[t](c), b = !1, f.splice(e, 1)); (b || !c) && n.dequeue(this, a)
            })
        },
        finish: function(a) {
            var t = "queue",
            r = "finish";
            return a !== !1 && (a = a || "fx"),
            this.each(function() {
                var b, c = L.get(this),
                d = c[a + t],
                e = c[a + "queueHooks"],
                f = n.timers,
                g = d ? d.length: 0;
                for (c[r] = !0, n[t](this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b][t] === a && (f[b].anim.stop(!0), f.splice(b, 1));
                for (b = 0; g > b; b++) d[b] && d[b][r] && d[b][r].call(this);
                delete c[r]
            })
        }
    }),
    n.each(["toggle", "show", "hide"],
    function(a, b) {
        var c = n.fn[b];
        n.fn[b] = function(a, d, e) {
            return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(Tb(b, !0), a, d, e)
        }
    }),
    n.each({
        slideDown: Tb("show"),
        slideUp: Tb("hide"),
        slideToggle: Tb("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    },
    function(a, b) {
        n.fn[a] = function(a, c, d) {
            return this.animate(b, a, c, d)
        }
    }),
    n.timers = [],
    n.fx.tick = function() {
        var a, b = 0,
        c = n.timers;
        for (Lb = n.now(); b < c.length; b++) a = c[b],
        a() || c[b] !== a || c.splice(b--, 1);
        c.length || n.fx.stop(),
        Lb = void 0
    },
    n.fx.timer = function(a) {
        n.timers.push(a),
        a() ? n.fx.start() : n.timers.pop()
    },
    n.fx.interval = 13,
    n.fx.start = function() {
        Mb || (Mb = setInterval(n.fx.tick, n.fx.interval))
    },
    n.fx.stop = function() {
        clearInterval(Mb),
        Mb = null
    },
    n.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    },
    n.fn.delay = function(a, b) {
        return a = n.fx ? n.fx.speeds[a] || a: a,
        b = b || "fx",
        this.queue(b,
        function(b, c) {
            var d = setTimeout(b, a);
            c.stop = function() {
                clearTimeout(d)
            }
        })
    },
    function() {
        var e = "createElement",
        t = "input",
        a = l[e](t),
        b = l[e]("select"),
        c = b.appendChild(l[e]("option"));
        a.type = "checkbox",
        k.checkOn = "" !== a.value,
        k.optSelected = c.selected,
        b.disabled = !0,
        k.optDisabled = !c.disabled,
        a = l[e](t),
        a.value = "t",
        a.type = "radio",
        k.radioValue = "t" === a.value
    } ();
    var Yb, Zb, $b = n.expr.attrHandle;
    n.fn.extend({
        attr: function(a, b) {
            return J(this, n.attr, a, b, arguments.length > 1)
        },
        removeAttr: function(a) {
            return this.each(function() {
                n.removeAttr(this, a)
            })
        }
    }),
    n.extend({
        attr: function(a, b, c) {
            var t = null,
            d, e, f = a.nodeType;
            if (a && 3 !== f && 8 !== f && 2 !== f) return typeof a.getAttribute === U ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), d = n.attrHooks[b] || (n.expr.match.bool.test(b) ? Zb: Yb)), void 0 === c ? d && "get" in d && t !== (e = d.get(a, b)) ? e: (e = n.find.attr(a, b), t == e ? void 0 : e) : t !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e: (a.setAttribute(b, c + ""), c) : void n.removeAttr(a, b))
        },
        removeAttr: function(a, b) {
            var c, d, e = 0,
            f = b && b.match(E);
            if (f && 1 === a.nodeType) while (c = f[e++]) d = n.propFix[c] || c,
            n.expr.match.bool.test(c) && (a[d] = !1),
            a.removeAttribute(c)
        },
        attrHooks: {
            type: {
                set: function(a, b) {
                    if (!k.radioValue && "radio" === b && n.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b),
                        c && (a.value = c),
                        b
                    }
                }
            }
        }
    }),
    Zb = {
        set: function(a, b, c) {
            return b === !1 ? n.removeAttr(a, c) : a.setAttribute(c, c),
            c
        }
    },
    n.each(n.expr.match.bool.source.match(/\w+/g),
    function(a, b) {
        var c = $b[b] || n.find.attr;
        $b[b] = function(a, b, d) {
            var e, f;
            return d || (f = $b[b], $b[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, $b[b] = f),
            e
        }
    });
    var _b = /^(?:input|select|textarea|button)$/i;
    n.fn.extend({
        prop: function(a, b) {
            return J(this, n.prop, a, b, arguments.length > 1)
        },
        removeProp: function(a) {
            return this.each(function() {
                delete this[n.propFix[a] || a]
            })
        }
    }),
    n.extend({
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function(a, b, c) {
            var d, e, f, g = a.nodeType;
            if (a && 3 !== g && 8 !== g && 2 !== g) return f = 1 !== g || !n.isXMLDoc(a),
            f && (b = n.propFix[b] || b, e = n.propHooks[b]),
            void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d: a[b] = c: e && "get" in e && null !== (d = e.get(a, b)) ? d: a[b]
        },
        propHooks: {
            tabIndex: {
                get: function(a) {
                    return a.hasAttribute("tabindex") || _b.test(a.nodeName) || a.href ? a.tabIndex: -1
                }
            }
        }
    }),
    k.optSelected || (n.propHooks.selected = {
        get: function(a) {
            var e = "parentNode",
            b = a[e];
            return b && b[e] && b[e].selectedIndex,
            null
        }
    }),
    n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"],
    function() {
        n.propFix[this.toLowerCase()] = this
    });
    var ac = /[\t\r\n\f]/g;
    n.fn.extend({
        addClass: function(a) {
            var t = "className",
            r = " ",
            b, c, d, e, f, g, h = "string" == typeof a && a,
            i = 0,
            j = this.length;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).addClass(a.call(this, b, this[t]))
            });
            if (h) for (b = (a || "").match(E) || []; j > i; i++) if (c = this[i], d = 1 === c.nodeType && (c[t] ? (r + c[t] + r).replace(ac, r) : r)) {
                f = 0;
                while (e = b[f++]) d.indexOf(r + e + r) < 0 && (d += e + r);
                g = n.trim(d),
                c[t] !== g && (c[t] = g)
            }
            return this
        },
        removeClass: function(a) {
            var t = "className",
            r = " ",
            b, c, d, e, f, g, h = 0 === arguments.length || "string" == typeof a && a,
            i = 0,
            j = this.length;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).removeClass(a.call(this, b, this[t]))
            });
            if (h) for (b = (a || "").match(E) || []; j > i; i++) if (c = this[i], d = 1 === c.nodeType && (c[t] ? (r + c[t] + r).replace(ac, r) : "")) {
                f = 0;
                while (e = b[f++]) while (d.indexOf(r + e + r) >= 0) d = d.replace(r + e + r, r);
                g = a ? n.trim(d) : "",
                c[t] !== g && (c[t] = g)
            }
            return this
        },
        toggleClass: function(a, b) {
            var t = "boolean",
            r = "string",
            i = "removeClass",
            s = "className",
            o = "__className__",
            c = typeof a;
            return t == typeof b && r === c ? b ? this.addClass(a) : this[i](a) : this.each(n.isFunction(a) ?
            function(c) {
                n(this).toggleClass(a.call(this, c, this[s], b), b)
            }: function() {
                if (r === c) {
                    var b, d = 0,
                    e = n(this),
                    f = a.match(E) || [];
                    while (b = f[d++]) e.hasClass(b) ? e[i](b) : e.addClass(b)
                } else(c === U || t === c) && (this[s] && L.set(this, o, this[s]), this[s] = this[s] || a === !1 ? "": L.get(this, o) || "")
            })
        },
        hasClass: function(a) {
            for (var b = " " + a + " ",
            c = 0,
            d = this.length; d > c; c++) if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(ac, " ").indexOf(b) >= 0) return ! 0;
            return ! 1
        }
    });
    var bc = /\r/g;
    n.fn.extend({
        val: function(a) {
            var t = null,
            r = "valHooks",
            i = "toLowerCase",
            s = "value",
            b, c, d, e = this[0];
            if (arguments.length) return d = n.isFunction(a),
            this.each(function(c) {
                var e;
                1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, t == e ? e = "": "number" == typeof e ? e += "": n.isArray(e) && (e = n.map(e,
                function(a) {
                    return t == a ? "": a + ""
                })), b = n[r][this.type] || n[r][this.nodeName[i]()], b && "set" in b && void 0 !== b.set(this, e, s) || (this[s] = e))
            });
            if (e) return b = n[r][e.type] || n[r][e.nodeName[i]()],
            b && "get" in b && void 0 !== (c = b.get(e, s)) ? c: (c = e[s], "string" == typeof c ? c.replace(bc, "") : t == c ? "": c)
        }
    }),
    n.extend({
        valHooks: {
            option: {
                get: function(a) {
                    var b = n.find.attr(a, "value");
                    return null != b ? b: n.trim(n.text(a))
                }
            },
            select: {
                get: function(a) {
                    var t = "disabled",
                    r = "parentNode";
                    for (var b, c, d = a.options,
                    e = a.selectedIndex,
                    f = "select-one" === a.type || 0 > e,
                    g = f ? null: [], h = f ? e + 1 : d.length, i = 0 > e ? h: f ? e: 0; h > i; i++) if (c = d[i], !(!c.selected && i !== e || (k.optDisabled ? c[t] : null !== c.getAttribute(t)) || c[r][t] && n.nodeName(c[r], "optgroup"))) {
                        if (b = n(c).val(), f) return b;
                        g.push(b)
                    }
                    return g
                },
                set: function(a, b) {
                    var c, d, e = a.options,
                    f = n.makeArray(b),
                    g = e.length;
                    while (g--) d = e[g],
                    (d.selected = n.inArray(d.value, f) >= 0) && (c = !0);
                    return c || (a.selectedIndex = -1),
                    f
                }
            }
        }
    }),
    n.each(["radio", "checkbox"],
    function() {
        n.valHooks[this] = {
            set: function(a, b) {
                return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) >= 0 : void 0
            }
        },
        k.checkOn || (n.valHooks[this].get = function(a) {
            return null === a.getAttribute("value") ? "on": a.value
        })
    }),
    n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),
    function(a, b) {
        n.fn[b] = function(a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
        }
    }),
    n.fn.extend({
        hover: function(a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        },
        bind: function(a, b, c) {
            return this.on(a, null, b, c)
        },
        unbind: function(a, b) {
            return this.off(a, null, b)
        },
        delegate: function(a, b, c, d) {
            return this.on(b, a, c, d)
        },
        undelegate: function(a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
        }
    });
    var cc = n.now(),
    dc = /\?/;
    n.parseJSON = function(a) {
        return JSON.parse(a + "")
    },
    n.parseXML = function(a) {
        var b, c;
        if (!a || "string" != typeof a) return null;
        try {
            c = new DOMParser,
            b = c.parseFromString(a, "text/xml")
        } catch(d) {
            b = void 0
        }
        return (!b || b.getElementsByTagName("parsererror").length) && n.error("Invalid XML: " + a),
        b
    };
    var ec, fc, gc = /#.*$/,
    hc = /([?&])_=[^&]*/,
    ic = /^(.*?):[ \t]*([^\r\n]*)$/gm,
    jc = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
    kc = /^(?:GET|HEAD)$/,
    lc = /^\/\//,
    mc = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
    nc = {},
    oc = {},
    pc = "*/".concat("*");
    try {
        fc = location.href
    } catch(qc) {
        fc = l.createElement("a"),
        fc.href = "",
        fc = fc.href
    }
    ec = mc.exec(fc.toLowerCase()) || [],
    n.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: fc,
            type: "GET",
            isLocal: jc.test(ec[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": pc,
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
                "text json": n.parseJSON,
                "text xml": n.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(a, b) {
            return b ? tc(tc(a, n.ajaxSettings), b) : tc(n.ajaxSettings, a)
        },
        ajaxPrefilter: rc(nc),
        ajaxTransport: rc(oc),
        ajax: function(a, b) {
            function x(a, b, f, h) {
                var j, r, s, u, w, x = b;
                2 !== t && (t = 2, g && clearTimeout(g), c = void 0, e = h || "", v[X] = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, f && (u = uc(k, v, f)), u = vc(k, u, v, j), j ? (k[B] && (w = v[$]("Last-Modified"), w && (n[F][d] = w), w = v[$](R), w && (n[R][d] = w)), 204 === a || "HEAD" === k[A] ? x = "nocontent": 304 === a ? x = "notmodified": (x = u.state, r = u[D], s = u[C], j = !s)) : (s = x, (a || !x) && (x = C, 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v[y](q), q = void 0, i && m[P](j ? "ajaxSuccess": "ajaxError", [v, k, j ? r: s]), p.fireWith(l, [v, x]), i && (m[P]("ajaxComplete", [v, k]), --n.active || n.event[P]("ajaxStop")))
            }
            var y = "statusCode",
            S = "toLowerCase",
            T = null,
            N = "abort",
            C = "error",
            L = "replace",
            A = "type",
            O = "dataTypes",
            M = "crossDomain",
            _ = "http:",
            D = "data",
            P = "trigger",
            H = "hasContent",
            B = "ifModified",
            F = "lastModified",
            I = "setRequestHeader",
            R = "etag",
            U = "contentType",
            z = "accepts",
            W = "beforeSend",
            X = "readyState",
            V = "timeout",
            $ = "getResponseHeader";
            "object" == typeof a && (b = a, a = void 0),
            b = b || {};
            var c, d, e, f, g, h, i, j, k = n.ajaxSetup({},
            b),
            l = k.context || k,
            m = k.context && (l.nodeType || l.jquery) ? n(l) : n.event,
            o = n.Deferred(),
            p = n.Callbacks("once memory"),
            q = k[y] || {},
            r = {},
            s = {},
            t = 0,
            u = "canceled",
            v = {
                readyState: 0,
                getResponseHeader: function(a) {
                    var b;
                    if (2 === t) {
                        if (!f) {
                            f = {};
                            while (b = ic.exec(e)) f[b[1][S]()] = b[2]
                        }
                        b = f[a[S]()]
                    }
                    return T == b ? T: b
                },
                getAllResponseHeaders: function() {
                    return 2 === t ? e: T
                },
                setRequestHeader: function(a, b) {
                    var c = a[S]();
                    return t || (a = s[c] = s[c] || a, r[a] = b),
                    this
                },
                overrideMimeType: function(a) {
                    return t || (k.mimeType = a),
                    this
                },
                statusCode: function(a) {
                    var b;
                    if (a) if (2 > t) for (b in a) q[b] = [q[b], a[b]];
                    else v.always(a[v.status]);
                    return this
                },
                abort: function(a) {
                    var b = a || u;
                    return c && c[N](b),
                    x(0, b),
                    this
                }
            };
            if (o.promise(v).complete = p.add, v.success = v.done, v[C] = v.fail, k.url = ((a || k.url || fc) + "")[L](gc, "")[L](lc, ec[1] + "//"), k[A] = b.method || b[A] || k.method || k[A], k[O] = n.trim(k.dataType || "*")[S]().match(E) || [""], T == k[M] && (h = mc.exec(k.url[S]()), k[M] = !(!h || h[1] === ec[1] && h[2] === ec[2] && (h[3] || (_ === h[1] ? "80": "443")) === (ec[3] || (_ === ec[1] ? "80": "443")))), k[D] && k.processData && "string" != typeof k[D] && (k[D] = n.param(k[D], k.traditional)), sc(nc, k, b, v), 2 === t) return v;
            i = k.global,
            i && 0 === n.active++&&n.event[P]("ajaxStart"),
            k[A] = k[A].toUpperCase(),
            k[H] = !kc.test(k[A]),
            d = k.url,
            k[H] || (k[D] && (d = k.url += (dc.test(d) ? "&": "?") + k[D], delete k[D]), k.cache === !1 && (k.url = hc.test(d) ? d[L](hc, "$1_=" + cc++) : d + (dc.test(d) ? "&": "?") + "_=" + cc++)),
            k[B] && (n[F][d] && v[I]("If-Modified-Since", n[F][d]), n[R][d] && v[I]("If-None-Match", n[R][d])),
            (k[D] && k[H] && k[U] !== !1 || b[U]) && v[I]("Content-Type", k[U]),
            v[I]("Accept", k[O][0] && k[z][k[O][0]] ? k[z][k[O][0]] + ("*" !== k[O][0] ? ", " + pc + "; q=0.01": "") : k[z]["*"]);
            for (j in k.headers) v[I](j, k.headers[j]);
            if (!k[W] || k[W].call(l, v, k) !== !1 && 2 !== t) {
                u = N;
                for (j in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) v[j](k[j]);
                if (c = sc(oc, k, b, v)) {
                    v[X] = 1,
                    i && m[P]("ajaxSend", [v, k]),
                    k.async && k[V] > 0 && (g = setTimeout(function() {
                        v[N](V)
                    },
                    k[V]));
                    try {
                        t = 1,
                        c.send(r, x)
                    } catch(w) {
                        if (! (2 > t)) throw w;
                        x( - 1, w)
                    }
                } else x( - 1, "No Transport");
                return v
            }
            return v[N]()
        },
        getJSON: function(a, b, c) {
            return n.get(a, b, c, "json")
        },
        getScript: function(a, b) {
            return n.get(a, void 0, b, "script")
        }
    }),
    n.each(["get", "post"],
    function(a, b) {
        n[b] = function(a, c, d, e) {
            return n.isFunction(c) && (e = e || d, d = c, c = void 0),
            n.ajax({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            })
        }
    }),
    n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"],
    function(a, b) {
        n.fn[b] = function(a) {
            return this.on(b, a)
        }
    }),
    n._evalUrl = function(a) {
        return n.ajax({
            url: a,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
        })
    },
    n.fn.extend({
        wrapAll: function(a) {
            var e = "firstElementChild",
            b;
            return n.isFunction(a) ? this.each(function(b) {
                n(this).wrapAll(a.call(this, b))
            }) : (this[0] && (b = n(a, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && b.insertBefore(this[0]), b.map(function() {
                var a = this;
                while (a[e]) a = a[e];
                return a
            }).append(this)), this)
        },
        wrapInner: function(a) {
            return this.each(n.isFunction(a) ?
            function(b) {
                n(this).wrapInner(a.call(this, b))
            }: function() {
                var b = n(this),
                c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a)
            })
        },
        wrap: function(a) {
            var b = n.isFunction(a);
            return this.each(function(c) {
                n(this).wrapAll(b ? a.call(this, c) : a)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                n.nodeName(this, "body") || n(this).replaceWith(this.childNodes)
            }).end()
        }
    }),
    n.expr.filters.hidden = function(a) {
        return a.offsetWidth <= 0 && a.offsetHeight <= 0
    },
    n.expr.filters.visible = function(a) {
        return ! n.expr.filters.hidden(a)
    };
    var wc = /%20/g,
    xc = /\[\]$/,
    yc = /\r?\n/g,
    zc = /^(?:submit|button|image|reset|file)$/i,
    Ac = /^(?:input|select|textarea|keygen)/i;
    n.param = function(a, b) {
        var t = "ajaxSettings",
        c, d = [],
        e = function(a, b) {
            b = n.isFunction(b) ? b() : null == b ? "": b,
            d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
        };
        if (void 0 === b && (b = n[t] && n[t].traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a,
        function() {
            e(this.name, this.value)
        });
        else for (c in a) Bc(c, a[c], b, e);
        return d.join("&").replace(wc, "+")
    },
    n.fn.extend({
        serialize: function() {
            return n.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var a = n.prop(this, "elements");
                return a ? n.makeArray(a) : this
            }).filter(function() {
                var a = this.type;
                return this.name && !n(this).is(":disabled") && Ac.test(this.nodeName) && !zc.test(a) && (this.checked || !T.test(a))
            }).map(function(a, b) {
                var c = n(this).val();
                return null == c ? null: n.isArray(c) ? n.map(c,
                function(a) {
                    return {
                        name: b.name,
                        value: a.replace(yc, "\r\n")
                    }
                }) : {
                    name: b.name,
                    value: c.replace(yc, "\r\n")
                }
            }).get()
        }
    }),
    n.ajaxSettings.xhr = function() {
        try {
            return new XMLHttpRequest
        } catch(a) {}
    };
    var Cc = 0,
    Dc = {},
    Ec = {
        0 : 200,
        1223 : 204
    },
    Fc = n.ajaxSettings.xhr();
    a.ActiveXObject && n(a).on("unload",
    function() {
        for (var a in Dc) Dc[a]()
    }),
    k.cors = !!Fc && "withCredentials" in Fc,
    k.ajax = Fc = !!Fc,
    n.ajaxTransport(function(a) {
        var t = "crossDomain",
        n = "xhrFields",
        r = "overrideMimeType",
        i = "X-Requested-With",
        s = "abort",
        o = "error",
        u = "status",
        l = "statusText",
        p = "responseText",
        b;
        return k.cors || Fc && !a[t] ? {
            send: function(c, d) {
                var e, f = a.xhr(),
                g = ++Cc;
                if (f.open(a.type, a.url, a.async, a.username, a.password), a[n]) for (e in a[n]) f[e] = a[n][e];
                a.mimeType && f[r] && f[r](a.mimeType),
                a[t] || c[i] || (c[i] = "XMLHttpRequest");
                for (e in c) f.setRequestHeader(e, c[e]);
                b = function(a) {
                    return function() {
                        b && (delete Dc[g], b = f.onload = f.onerror = null, s === a ? f[s]() : o === a ? d(f[u], f[l]) : d(Ec[f[u]] || f[u], f[l], "string" == typeof f[p] ? {
                            text: f[p]
                        }: void 0, f.getAllResponseHeaders()))
                    }
                },
                f.onload = b(),
                f.onerror = b(o),
                b = Dc[g] = b(s);
                try {
                    f.send(a.hasContent && a.data || null)
                } catch(h) {
                    if (b) throw h
                }
            },
            abort: function() {
                b && b()
            }
        }: void 0
    }),
    n.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(a) {
                return n.globalEval(a),
                a
            }
        }
    }),
    n.ajaxPrefilter("script",
    function(a) {
        void 0 === a.cache && (a.cache = !1),
        a.crossDomain && (a.type = "GET")
    }),
    n.ajaxTransport("script",
    function(a) {
        if (a.crossDomain) {
            var b, c;
            return {
                send: function(d, e) {
                    b = n("<script>").prop({
                        async: !0,
                        charset: a.scriptCharset,
                        src: a.url
                    }).on("load error", c = function(a) {
                        b.remove(),
                        c = null,
                        a && e("error" === a.type ? 404 : 200, a.type)
                    }),
                    l.head.appendChild(b[0])
                },
                abort: function() {
                    c && c()
                }
            }
        }
    });
    var Gc = [],
    Hc = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var a = Gc.pop() || n.expando + "_" + cc++;
            return this[a] = !0,
            a
        }
    }),
    n.ajaxPrefilter("json jsonp",
    function(b, c, d) {
        var t = "jsonp",
        r = "jsonpCallback",
        i = "isFunction",
        e, f, g, h = b[t] !== !1 && (Hc.test(b.url) ? "url": "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && Hc.test(b.data) && "data");
        return h || t === b.dataTypes[0] ? (e = b[r] = n[i](b[r]) ? b[r]() : b[r], h ? b[h] = b[h].replace(Hc, "$1" + e) : b[t] !== !1 && (b.url += (dc.test(b.url) ? "&": "?") + b[t] + "=" + e), b.converters["script json"] = function() {
            return g || n.error(e + " was not called"),
            g[0]
        },
        b.dataTypes[0] = "json", f = a[e], a[e] = function() {
            g = arguments
        },
        d.always(function() {
            a[e] = f,
            b[e] && (b[r] = c[r], Gc.push(e)),
            g && n[i](f) && f(g[0]),
            g = f = void 0
        }), "script") : void 0
    }),
    n.parseHTML = function(a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1),
        b = b || l;
        var d = v.exec(a),
        e = !c && [];
        return d ? [b.createElement(d[1])] : (d = n.buildFragment([a], b, e), e && e.length && n(e).remove(), n.merge([], d.childNodes))
    };
    var Ic = n.fn.load;
    n.fn.load = function(a, b, c) {
        if ("string" != typeof a && Ic) return Ic.apply(this, arguments);
        var d, e, f, g = this,
        h = a.indexOf(" ");
        return h >= 0 && (d = n.trim(a.slice(h)), a = a.slice(0, h)),
        n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (e = "POST"),
        g.length > 0 && n.ajax({
            url: a,
            type: e,
            dataType: "html",
            data: b
        }).done(function(a) {
            f = arguments,
            g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a)
        }).complete(c &&
        function(a, b) {
            g.each(c, f || [a.responseText, b, a])
        }),
        this
    },
    n.expr.filters.animated = function(a) {
        return n.grep(n.timers,
        function(b) {
            return a === b.elem
        }).length
    };
    var Jc = a.document.documentElement;
    n.offset = {
        setOffset: function(a, b, c) {
            var t = "position",
            r = "top",
            s = "left",
            d, e, f, g, h, i, j, k = n.css(a, t),
            l = n(a),
            m = {};
            "static" === k && (a.style[t] = "relative"),
            h = l.offset(),
            f = n.css(a, r),
            i = n.css(a, s),
            j = ("absolute" === k || "fixed" === k) && (f + i).indexOf("auto") > -1,
            j ? (d = l[t](), g = d[r], e = d[s]) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0),
            n.isFunction(b) && (b = b.call(a, c, h)),
            null != b[r] && (m[r] = b[r] - h[r] + g),
            null != b[s] && (m[s] = b[s] - h[s] + e),
            "using" in b ? b.using.call(a, m) : l.css(m)
        }
    },
    n.fn.extend({
        offset: function(a) {
            var t = "getBoundingClientRect";
            if (arguments.length) return void 0 === a ? this: this.each(function(b) {
                n.offset.setOffset(this, a, b)
            });
            var b, c, d = this[0],
            e = {
                top: 0,
                left: 0
            },
            f = d && d.ownerDocument;
            if (f) return b = f.documentElement,
            n.contains(b, d) ? (typeof d[t] !== U && (e = d[t]()), c = Kc(f), {
                top: e.top + c.pageYOffset - b.clientTop,
                left: e.left + c.pageXOffset - b.clientLeft
            }) : e
        },
        position: function() {
            if (this[0]) {
                var a, b, c = this[0],
                d = {
                    top: 0,
                    left: 0
                };
                return "fixed" === n.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (d = a.offset()), d.top += n.css(a[0], "borderTopWidth", !0), d.left += n.css(a[0], "borderLeftWidth", !0)),
                {
                    top: b.top - d.top - n.css(c, "marginTop", !0),
                    left: b.left - d.left - n.css(c, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                var a = this.offsetParent || Jc;
                while (a && !n.nodeName(a, "html") && "static" === n.css(a, "position")) a = a.offsetParent;
                return a || Jc
            })
        }
    }),
    n.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    },
    function(b, c) {
        var t = "pageYOffset",
        d = t === c;
        n.fn[b] = function(e) {
            return J(this,
            function(b, e, f) {
                var g = Kc(b);
                return void 0 === f ? g ? g[c] : b[e] : void(g ? g.scrollTo(d ? a.pageXOffset: f, d ? f: a[t]) : b[e] = f)
            },
            b, e, arguments.length, null)
        }
    }),
    n.each(["top", "left"],
    function(a, b) {
        n.cssHooks[b] = yb(k.pixelPosition,
        function(a, c) {
            return c ? (c = xb(a, b), vb.test(c) ? n(a).position()[b] + "px": c) : void 0
        })
    }),
    n.each({
        Height: "height",
        Width: "width"
    },
    function(a, b) {
        var t = "documentElement",
        r = "client",
        i = "scroll",
        s = "offset";
        n.each({
            padding: "inner" + a,
            content: b,
            "": "outer" + a
        },
        function(c, d) {
            n.fn[d] = function(d, e) {
                var f = arguments.length && (c || "boolean" != typeof d),
                g = c || (d === !0 || e === !0 ? "margin": "border");
                return J(this,
                function(b, c, d) {
                    var e;
                    return n.isWindow(b) ? b.document[t][r + a] : 9 === b.nodeType ? (e = b[t], Math.max(b.body[i + a], e[i + a], b.body[s + a], e[s + a], e[r + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g)
                },
                b, f ? d: void 0, f, null)
            }
        })
    }),
    n.fn.size = function() {
        return this.length
    },
    n.fn.andSelf = n.fn.addBack,
    "function" == typeof define && define.amd && define("jquery", [],
    function() {
        return n
    });
    var Lc = a.jQuery,
    Mc = a.$;
    return n.noConflict = function(b) {
        return a.$ === n && (a.$ = Mc),
        b && a.jQuery === n && (a.jQuery = Lc),
        n
    },
    typeof b === U && (a.jQuery = a.$ = n),
    n
}),
function(factory) {
    typeof define == "function" && define.amd ? define(factory) : window.purl = factory()
} (function() {
    function parseUri(url, strictMode) {
        var str = decodeURI(url),
        res = parser[strictMode || p ? "strict": "loose"].exec(str),
        uri = {
            attr: {},
            param: {},
            seg: {}
        },
        i = 14;
        while (i--) uri[d][key[i]] = res[i] || "";
        return uri[m][f] = parseString(uri[d][f]),
        uri[m][h] = parseString(uri[d][h]),
        uri.seg[a] = uri[d][a][y](/^\/+|\/+$/g, "")[g]("/"),
        uri.seg[h] = uri[d][h][y](/^\/+|\/+$/g, "")[g]("/"),
        uri[d][b] = uri[d][u] ? (uri[d][o] ? uri[d][o] + "://" + uri[d][u] : uri[d][u]) + (uri[d].port ? ":" + uri[d].port: "") : "",
        uri
    }
    function getAttrName(elm) {
        var tn = elm.tagName;
        return typeof tn !== w ? tag2attr[tn.toLowerCase()] : tn
    }
    function promote(parent, key) {
        if (parent[key][E] === 0) return parent[key] = {};
        var t = {};
        for (var i in parent[key]) t[i] = parent[key][i];
        return parent[key] = t,
        t
    }
    function parse(parts, parent, key, val) {
        var part = parts.shift();
        if (!part) isArray(parent[key]) ? parent[key].push(val) : S == typeof parent[key] ? parent[key] = val: w == typeof parent[key] ? parent[key] = val: parent[key] = [parent[key], val];
        else {
            var obj = parent[key] = parent[key] || [];
            x == part ? isArray(obj) ? "" !== val && obj.push(val) : S == typeof obj ? obj[keys(obj)[E]] = val: obj = parent[key] = [parent[key], val] : ~part[T](x) ? (part = part[N](0, part[E] - 1), !isint.test(part) && isArray(obj) && (obj = promote(parent, key)), parse(parts, obj, part, val)) : (!isint.test(part) && isArray(obj) && (obj = promote(parent, key)), parse(parts, obj, part, val))
        }
    }
    function merge(parent, key, val) {
        if (~key[T](x)) {
            var parts = key[g]("[");
            parse(parts, parent, b, val)
        } else {
            if (!isint.test(key) && isArray(parent[b])) {
                var t = {};
                for (var k in parent[b]) t[k] = parent[b][k];
                parent[b] = t
            }
            key !== "" && set(parent[b], key, val)
        }
        return parent
    }
    function parseString(str) {
        return reduce(String(str)[g](/&|;/),
        function(ret, pair) {
            try {
                pair = decodeURIComponent(pair[y](/\+/g, " "))
            } catch(e) {}
            var eql = pair[T]("="),
            brace = lastBraceInKey(pair),
            key = pair[N](0, brace || eql),
            val = pair[N](brace || eql, pair[E]);
            return val = val[N](val[T]("=") + 1, val[E]),
            key === "" && (key = pair, val = ""),
            merge(ret, key, val)
        },
        {
            base: {}
        })[b]
    }
    function set(obj, key, val) {
        var v = obj[key];
        typeof v === w ? obj[key] = val: isArray(v) ? v.push(val) : obj[key] = [v, val]
    }
    function lastBraceInKey(str) {
        var len = str[E],
        brace,
        c;
        for (var i = 0; i < len; ++i) {
            c = str[i],
            x == c && (brace = p),
            "[" == c && (brace = C);
            if ("=" == c && !brace) return i
        }
    }
    function reduce(obj, accumulator) {
        var i = 0,
        l = obj[E] >> 0,
        curr = arguments[2];
        while (i < l) i in obj && (curr = accumulator.call(undefined, curr, obj[i], i, obj)),
        ++i;
        return curr
    }
    function isArray(vArg) {
        return Object.prototype.toString.call(vArg) === "[object Array]"
    }
    function keys(obj) {
        var key_array = [];
        for (var prop in obj) obj.hasOwnProperty(prop) && key_array.push(prop);
        return key_array
    }
    function purl(url, strictMode) {
        return arguments[E] === 1 && url === C && (strictMode = C, url = undefined),
        strictMode = strictMode || p,
        url = url || window.location.toString(),
        {
            data: parseUri(url, strictMode),
            attr: function(attr) {
                return attr = aliases[attr] || attr,
                typeof attr !== w ? this[s][d][attr] : this[s][d]
            },
            param: function(param) {
                return typeof param !== w ? this[s][m][f][param] : this[s][m][f]
            },
            fparam: function(param) {
                return typeof param !== w ? this[s][m][h][param] : this[s][m][h]
            },
            segment: function(seg) {
                return typeof seg === w ? this[s].seg[a] : (seg = seg < 0 ? this[s].seg[a][E] + seg: seg - 1, this[s].seg[a][seg])
            },
            fsegment: function(seg) {
                return typeof seg === w ? this[s].seg[h] : (seg = seg < 0 ? this[s].seg[h][E] + seg: seg - 1, this[s].seg[h][seg])
            }
        }
    }
    var n = "href",
    r = "src",
    s = "data",
    o = "protocol",
    u = "host",
    a = "path",
    f = "query",
    h = "fragment",
    p = !1,
    d = "attr",
    m = "param",
    g = "split",
    y = "replace",
    b = "base",
    w = "undefined",
    E = "length",
    S = "object",
    x = "]",
    T = "indexOf",
    N = "substr",
    C = !0,
    L = "jQuery",
    tag2attr = {
        a: n,
        img: r,
        form: "action",
        base: n,
        script: r,
        iframe: r,
        link: n,
        embed: r,
        object: s
    },
    key = ["source", o, "authority", "userInfo", "user", "password", u, "port", "relative", a, "directory", "file", f, h],
    aliases = {
        anchor: h
    },
    parser = {
        strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
        loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
    },
    isint = /^[0-9]+$/;
    return purl[L] = function($) {
        $ != null && ($.fn.url = function(strictMode) {
            var url = "";
            return this[E] && (url = $(this)[d](getAttrName(this[0])) || ""),
            purl(url, strictMode)
        },
        $.url = purl)
    },
    purl[L](window[L]),
    purl
}),
function(factory) {
    typeof define == "function" && define.amd ? define(["jquery"], factory) : typeof exports == "object" ? factory(require("jquery")) : factory(jQuery)
} (function($) {
    function encode(s) {
        return config.raw ? s: encodeURIComponent(s)
    }
    function decode(s) {
        return config.raw ? s: decodeURIComponent(s)
    }
    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value))
    }
    function parseCookieValue(s) {
        s.indexOf('"') === 0 && (s = s.slice(1, -1)[n](/\\"/g, '"')[n](/\\\\/g, "\\"));
        try {
            return s = decodeURIComponent(s[n](pluses, " ")),
            config.json ? JSON.parse(s) : s
        } catch(e) {}
    }
    function read(s, converter) {
        var value = config.raw ? s: parseCookieValue(s);
        return $[r](converter) ? converter(value) : value
    }
    var n = "replace",
    r = "isFunction",
    o = "cookie",
    u = "expires",
    pluses = /\+/g,
    config = $[o] = function(key, value, options) {
        if (value !== undefined && !$[r](value)) {
            options = $.extend({},
            config.defaults, options);
            if (typeof options[u] == "number") {
                var days = options[u],
                t = options[u] = new Date;
                t.setTime( + t + days * 864e5)
            }
            return document[o] = [encode(key), "=", stringifyCookieValue(value), options[u] ? "; expires=" + options[u].toUTCString() : "", options.path ? "; path=" + options.path: "", options.domain ? "; domain=" + options.domain: "", options.secure ? "; secure": ""].join("")
        }
        var result = key ? undefined: {},
        cookies = document[o] ? document[o].split("; ") : [];
        for (var i = 0,
        l = cookies.length; i < l; i++) {
            var parts = cookies[i].split("="),
            name = decode(parts.shift()),
            cookie = parts.join("=");
            if (key && key === name) {
                result = read(cookie, value);
                break
            } ! key && (cookie = read(cookie)) !== undefined && (result[name] = cookie)
        }
        return result
    };
    config.defaults = {},
    $.removeCookie = function(key, options) {
        return $[o](key) === undefined ? !1 : ($[o](key, "", $.extend({},
        options, {
            expires: -1
        })), !$[o](key))
    }
}),
function($) {
    var t = "settings",
    r = "validator",
    s = "currentForm",
    o = "length",
    u = !0,
    f = "name",
    l = "pendingRequest",
    c = "messages",
    h = "dependency-mismatch",
    p = "errorList",
    d = "optional",
    v = !1,
    g = "formSubmitted",
    y = "extend",
    b = "errorClass",
    w = "successList",
    E = "element",
    S = "submitted",
    x = "classRuleSettings",
    T = "submitButton",
    N = "removeClass",
    C = "previousValue",
    k = "string",
    L = "maxlength",
    A = "required",
    O = "format",
    M = "remote",
    _ = "currentElements",
    D = "normalizeRule",
    P = "showErrors",
    H = "labelContainer",
    B = "aria-required",
    j = "cancelSubmit",
    F = "addClass",
    I = "validateDelegate",
    q = "constructor",
    R = "unhighlight",
    U = "invalid",
    z = "findByName",
    W = "toHide",
    X = "validClass",
    V = "each",
    J = "attr",
    K = "pending",
    Q = "errorMap",
    G = "checkable",
    Y = "toLowerCase",
    Z = "submitHandler",
    et = "form",
    tt = "valid",
    nt = "defaultMessage",
    rt = "replace",
    it = "minlength",
    st = "containers",
    ot = "split",
    ut = "errorsFor",
    at = "removeAttr",
    ft = "toShow",
    lt = "getLength",
    ct = "objectLength",
    ht = "elementValue",
    pt = "addWrapper",
    dt = "rules",
    vt = "validate",
    mt = "lastElement",
    gt = "validationTargetFor",
    yt = "novalidate",
    bt = "methods",
    wt = "success",
    Et = "errorLabelContainer",
    St = "aria-invalid",
    xt = "true",
    Tt = "invalid-form",
    Nt = "parameters",
    Ct = "radio",
    kt = "wrapper",
    Lt = "depends",
    At = "isArray",
    Ot = "originalMessage",
    Mt = "invalidHandler",
    _t = "test",
    Dt = "triggerHandler",
    Pt = "type",
    Ht = "function",
    Bt = "errorPlacement",
    jt = "prepareElement",
    Ft = "rangelength",
    It = "range";
    $[y]($.fn, {
        validate: function(options) {
            if (!this[o]) {
                options && options.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing.");
                return
            }
            var validator = $.data(this[0], r);
            return validator ? validator: (this[J](yt, yt), validator = new $[r](options, this[0]), $.data(this[0], r, validator), validator[t].onsubmit && (this[I](":submit", "click",
            function(event) {
                validator[t][Z] && (validator[T] = event.target),
                $(event.target).hasClass("cancel") && (validator[j] = u),
                $(event.target)[J]("formnovalidate") !== undefined && (validator[j] = u)
            }), this.submit(function(event) {
                function handle() {
                    var hidden;
                    return validator[t][Z] ? (validator[T] && (hidden = $("<input type='hidden'/>")[J](f, validator[T][f]).val($(validator[T]).val()).appendTo(validator[s])), validator[t][Z].call(validator, validator[s], event), validator[T] && hidden.remove(), v) : u
                }
                return validator[t].debug && event.preventDefault(),
                validator[j] ? (validator[j] = v, handle()) : validator[et]() ? validator[l] ? (validator[g] = u, v) : handle() : (validator.focusInvalid(), v)
            })), validator)
        },
        valid: function() {
            var valid, validator;
            return $(this[0]).is(et) ? valid = this[vt]()[et]() : (valid = u, validator = $(this[0][et])[vt](), this[V](function() {
                valid = validator[E](this) && valid
            })),
            valid
        },
        removeAttrs: function(attributes) {
            var result = {},
            $element = this;
            return $[V](attributes[ot](/\s/),
            function(index, value) {
                result[value] = $element[J](value),
                $element[at](value)
            }),
            result
        },
        rules: function(command, argument) {
            var element = this[0],
            settings,
            staticRules,
            existingRules,
            data,
            param,
            filtered;
            if (command) {
                settings = $.data(element[et], r)[t],
                staticRules = settings[dt],
                existingRules = $[r].staticRules(element);
                switch (command) {
                case "add":
                    $[y](existingRules, $[r][D](argument)),
                    delete existingRules[c],
                    staticRules[element[f]] = existingRules,
                    argument[c] && (settings[c][element[f]] = $[y](settings[c][element[f]], argument[c]));
                    break;
                case "remove":
                    if (!argument) return delete staticRules[element[f]],
                    existingRules;
                    return filtered = {},
                    $[V](argument[ot](/\s/),
                    function(index, method) {
                        filtered[method] = existingRules[method],
                        delete existingRules[method],
                        method === A && $(element)[at](B)
                    }),
                    filtered
                }
            }
            return data = $[r].normalizeRules($[y]({},
            $[r].classRules(element), $[r].attributeRules(element), $[r].dataRules(element), $[r].staticRules(element)), element),
            data[A] && (param = data[A], delete data[A], data = $[y]({
                required: param
            },
            data), $(element)[J](B, xt)),
            data[M] && (param = data[M], delete data[M], data = $[y](data, {
                remote: param
            })),
            data
        }
    }),
    $[y]($.expr[":"], {
        blank: function(a) {
            return ! $.trim("" + $(a).val())
        },
        filled: function(a) {
            return !! $.trim("" + $(a).val())
        },
        unchecked: function(a) {
            return ! $(a).prop("checked")
        }
    }),
    $[r] = function(options, form) {
        this[t] = $[y](u, {},
        $[r].defaults, options),
        this[s] = form,
        this.init()
    },
    $[r][O] = function(source, params) {
        return arguments[o] === 1 ?
        function() {
            var args = $.makeArray(arguments);
            return args.unshift(source),
            $[r][O].apply(this, args)
        }: (arguments[o] > 2 && params[q] !== Array && (params = $.makeArray(arguments).slice(1)), params[q] !== Array && (params = [params]), $[V](params,
        function(i, n) {
            source = source[rt](new RegExp("\\{" + i + "\\}", "g"),
            function() {
                return n
            })
        }), source)
    },
    $[y]($[r], {
        defaults: {
            messages: {},
            groups: {},
            rules: {},
            errorClass: "error",
            validClass: tt,
            errorElement: "label",
            focusInvalid: u,
            errorContainer: $([]),
            errorLabelContainer: $([]),
            onsubmit: u,
            ignore: ":hidden",
            ignoreTitle: v,
            onfocusin: function(element) {
                this.lastActive = element,
                this[t].focusCleanup && !this.blockFocusCleanup && (this[t][R] && this[t][R].call(this, element, this[t][b], this[t][X]), this[pt](this[ut](element)).hide())
            },
            onfocusout: function(element) { ! this[G](element) && (element[f] in this[S] || !this[d](element)) && this[E](element)
            },
            onkeyup: function(element, event) {
                if (event.which === 9 && this[ht](element) === "") return; (element[f] in this[S] || element === this[mt]) && this[E](element)
            },
            onclick: function(element) {
                element[f] in this[S] ? this[E](element) : element.parentNode[f] in this[S] && this[E](element.parentNode)
            },
            highlight: function(element, errorClass, validClass) {
                element[Pt] === Ct ? this[z](element[f])[F](errorClass)[N](validClass) : $(element)[F](errorClass)[N](validClass)
            },
            unhighlight: function(element, errorClass, validClass) {
                element[Pt] === Ct ? this[z](element[f])[N](errorClass)[F](validClass) : $(element)[N](errorClass)[F](validClass)
            }
        },
        setDefaults: function(settings) {
            $[y]($[r].defaults, settings)
        },
        messages: {
            required: "This field is required.",
            remote: "Please fix this field.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date (ISO).",
            number: "Please enter a valid number.",
            digits: "Please enter only digits.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            maxlength: $[r][O]("Please enter no more than {0} characters."),
            minlength: $[r][O]("Please enter at least {0} characters."),
            rangelength: $[r][O]("Please enter a value between {0} and {1} characters long."),
            range: $[r][O]("Please enter a value between {0} and {1}."),
            max: $[r][O]("Please enter a value less than or equal to {0}."),
            min: $[r][O]("Please enter a value greater than or equal to {0}.")
        },
        autoCreateRanges: v,
        prototype: {
            init: function() {
                function delegate(event) {
                    var validator = $.data(this[0][et], r),
                    eventType = "on" + event[Pt][rt](/^validate/, ""),
                    settings = validator[t];
                    settings[eventType] && !this.is(settings.ignore) && settings[eventType].call(validator, this[0], event)
                }
                this[H] = $(this[t][Et]),
                this.errorContext = this[H][o] && this[H] || $(this[s]),
                this[st] = $(this[t].errorContainer).add(this[t][Et]),
                this[S] = {},
                this.valueCache = {},
                this[l] = 0,
                this[K] = {},
                this[U] = {},
                this.reset();
                var groups = this.groups = {},
                rules;
                $[V](this[t].groups,
                function(key, value) {
                    typeof value === k && (value = value[ot](/\s/)),
                    $[V](value,
                    function(index, name) {
                        groups[name] = key
                    })
                }),
                rules = this[t][dt],
                $[V](rules,
                function(key, value) {
                    rules[key] = $[r][D](value)
                }),
                $(this[s])[I](":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ", "focusin focusout keyup", delegate)[I]("[type='radio'], [type='checkbox'], select, option", "click", delegate),
                this[t][Mt] && $(this[s]).bind("invalid-form.validate", this[t][Mt]),
                $(this[s]).find("[required], [data-rule-required], .required")[J](B, xt)
            },
            form: function() {
                return this.checkForm(),
                $[y](this[S], this[Q]),
                this[U] = $[y]({},
                this[Q]),
                this[tt]() || $(this[s])[Dt](Tt, [this]),
                this[P](),
                this[tt]()
            },
            checkForm: function() {
                this.prepareForm();
                for (var i = 0,
                elements = this[_] = this.elements(); elements[i]; i++) this.check(elements[i]);
                return this[tt]()
            },
            element: function(element) {
                var cleanElement = this.clean(element),
                checkElement = this[gt](cleanElement),
                result = u;
                return this[mt] = checkElement,
                checkElement === undefined ? delete this[U][cleanElement[f]] : (this[jt](checkElement), this[_] = $(checkElement), result = this.check(checkElement) !== v, result ? delete this[U][checkElement[f]] : this[U][checkElement[f]] = u),
                $(element)[J](St, !result),
                this.numberOfInvalids() || (this[W] = this[W].add(this[st])),
                this[P](),
                result
            },
            showErrors: function(errors) {
                if (errors) {
                    $[y](this[Q], errors),
                    this[p] = [];
                    for (var name in errors) this[p].push({
                        message: errors[name],
                        element: this[z](name)[0]
                    });
                    this[w] = $.grep(this[w],
                    function(element) {
                        return ! (element[f] in errors)
                    })
                }
                this[t][P] ? this[t][P].call(this, this[Q], this[p]) : this.defaultShowErrors()
            },
            resetForm: function() {
                $.fn.resetForm && $(this[s]).resetForm(),
                this[S] = {},
                this[mt] = null,
                this.prepareForm(),
                this.hideErrors(),
                this.elements()[N](this[t][b]).removeData(C)[at](St)
            },
            numberOfInvalids: function() {
                return this[ct](this[U])
            },
            objectLength: function(obj) {
                var count = 0,
                i;
                for (i in obj) count++;
                return count
            },
            hideErrors: function() {
                this[pt](this[W]).hide()
            },
            valid: function() {
                return this.size() === 0
            },
            size: function() {
                return this[p][o]
            },
            focusInvalid: function() {
                if (this[t].focusInvalid) try {
                    $(this.findLastActive() || this[p][o] && this[p][0][E] || []).filter(":visible").focus().trigger("focusin")
                } catch(e) {}
            },
            findLastActive: function() {
                var lastActive = this.lastActive;
                return lastActive && $.grep(this[p],
                function(n) {
                    return n[E][f] === lastActive[f]
                })[o] === 1 && lastActive
            },
            elements: function() {
                var validator = this,
                rulesCache = {};
                return $(this[s]).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this[t].ignore).filter(function() {
                    return ! this[f] && validator[t].debug && window.console && console.error("%o has no name assigned", this),
                    this[f] in rulesCache || !validator[ct]($(this)[dt]()) ? v: (rulesCache[this[f]] = u, u)
                })
            },
            clean: function(selector) {
                return $(selector)[0]
            },
            errors: function() {
                var errorClass = this[t][b][ot](" ").join(".");
                return $(this[t].errorElement + "." + errorClass, this.errorContext)
            },
            reset: function() {
                this[w] = [],
                this[p] = [],
                this[Q] = {},
                this[ft] = $([]),
                this[W] = $([]),
                this[_] = $([])
            },
            prepareForm: function() {
                this.reset(),
                this[W] = this.errors().add(this[st])
            },
            prepareElement: function(element) {
                this.reset(),
                this[W] = this[ut](element)
            },
            elementValue: function(element) {
                var val, $element = $(element),
                type = $element[J](Pt);
                return type === Ct || type === "checkbox" ? $("input[name='" + $element[J](f) + "']:checked").val() : (val = $element.val(), typeof val === k ? val[rt](/\r/g, "") : val)
            },
            check: function(element) {
                element = this[gt](this.clean(element));
                var rules = $(element)[dt](),
                rulesCount = $.map(rules,
                function(n, i) {
                    return i
                })[o],
                dependencyMismatch = v,
                val = this[ht](element),
                result,
                method,
                rule;
                for (method in rules) {
                    rule = {
                        method: method,
                        parameters: rules[method]
                    };
                    try {
                        result = $[r][bt][method].call(this, val, element, rule[Nt]);
                        if (result === h && rulesCount === 1) {
                            dependencyMismatch = u;
                            continue
                        }
                        dependencyMismatch = v;
                        if (result === K) {
                            this[W] = this[W].not(this[ut](element));
                            return
                        }
                        if (!result) return this.formatAndAdd(element, rule),
                        v
                    } catch(e) {
                        throw this[t].debug && window.console && console.log("Exception occurred when checking element " + element.id + ", check the '" + rule.method + "' method.", e),
                        e
                    }
                }
                if (dependencyMismatch) return;
                return this[ct](rules) && this[w].push(element),
                u
            },
            customDataMessage: function(element, method) {
                return $(element).data("msg" + method[0].toUpperCase() + method.substring(1)[Y]()) || $(element).data("msg")
            },
            customMessage: function(name, method) {
                var m = this[t][c][name];
                return m && (m[q] === String ? m: m[method])
            },
            findDefined: function() {
                for (var i = 0; i < arguments[o]; i++) if (arguments[i] !== undefined) return arguments[i];
                return undefined
            },
            defaultMessage: function(element, method) {
                return this.findDefined(this.customMessage(element[f], method), this.customDataMessage(element, method), !this[t].ignoreTitle && element.title || undefined, $[r][c][method], "<strong>Warning: No message defined for " + element[f] + "</strong>")
            },
            formatAndAdd: function(element, rule) {
                var message = this[nt](element, rule.method),
                theregex = /\$?\{(\d+)\}/g;
                typeof message === Ht ? message = message.call(this, rule[Nt], element) : theregex[_t](message) && (message = $[r][O](message[rt](theregex, "{$1}"), rule[Nt])),
                this[p].push({
                    message: message,
                    element: element,
                    method: rule.method
                }),
                this[Q][element[f]] = message,
                this[S][element[f]] = message
            },
            addWrapper: function(toToggle) {
                return this[t][kt] && (toToggle = toToggle.add(toToggle.parent(this[t][kt]))),
                toToggle
            },
            defaultShowErrors: function() {
                var i, elements, error;
                for (i = 0; this[p][i]; i++) error = this[p][i],
                this[t].highlight && this[t].highlight.call(this, error[E], this[t][b], this[t][X]),
                this.showLabel(error[E], error.message);
                this[p][o] && (this[ft] = this[ft].add(this[st]));
                if (this[t][wt]) for (i = 0; this[w][i]; i++) this.showLabel(this[w][i]);
                if (this[t][R]) for (i = 0, elements = this.validElements(); elements[i]; i++) this[t][R].call(this, elements[i], this[t][b], this[t][X]);
                this[W] = this[W].not(this[ft]),
                this.hideErrors(),
                this[pt](this[ft]).show()
            },
            validElements: function() {
                return this[_].not(this.invalidElements())
            },
            invalidElements: function() {
                return $(this[p]).map(function() {
                    return this[E]
                })
            },
            showLabel: function(element, message) {
                var label = this[ut](element);
                label[o] ? (label[N](this[t][X])[F](this[t][b]), label.html(message)) : (label = $("<" + this[t].errorElement + ">")[J]("for", this.idOrName(element))[F](this[t][b]).html(message || ""), this[t][kt] && (label = label.hide().show().wrap("<" + this[t][kt] + "/>").parent()), this[H].append(label)[o] || (this[t][Bt] ? this[t][Bt](label, $(element)) : label.insertAfter(element))),
                !message && this[t][wt] && (label.text(""), typeof this[t][wt] === k ? label[F](this[t][wt]) : this[t][wt](label, element)),
                this[ft] = this[ft].add(label)
            },
            errorsFor: function(element) {
                var name = this.idOrName(element);
                return this.errors().filter(function() {
                    return $(this)[J]("for") === name
                })
            },
            idOrName: function(element) {
                return this.groups[element[f]] || (this[G](element) ? element[f] : element.id || element[f])
            },
            validationTargetFor: function(element) {
                return this[G](element) && (element = this[z](element[f]).not(this[t].ignore)[0]),
                element
            },
            checkable: function(element) {
                return /radio|checkbox/i[_t](element[Pt])
            },
            findByName: function(name) {
                return $(this[s]).find("[name='" + name + "']")
            },
            getLength: function(value, element) {
                switch (element.nodeName[Y]()) {
                case "select":
                    return $("option:selected", element)[o];
                case "input":
                    if (this[G](element)) return this[z](element[f]).filter(":checked")[o]
                }
                return value[o]
            },
            depend: function(param, element) {
                return this.dependTypes[typeof param] ? this.dependTypes[typeof param](param, element) : u
            },
            dependTypes: {
                "boolean": function(param) {
                    return param
                },
                string: function(param, element) {
                    return !! $(param, element[et])[o]
                },
                "function": function(param, element) {
                    return param(element)
                }
            },
            optional: function(element) {
                var val = this[ht](element);
                return ! $[r][bt][A].call(this, val, element) && h
            },
            startRequest: function(element) {
                this[K][element[f]] || (this[l]++, this[K][element[f]] = u)
            },
            stopRequest: function(element, valid) {
                this[l]--,
                this[l] < 0 && (this[l] = 0),
                delete this[K][element[f]],
                valid && this[l] === 0 && this[g] && this[et]() ? ($(this[s]).submit(), this[g] = v) : !valid && this[l] === 0 && this[g] && ($(this[s])[Dt](Tt, [this]), this[g] = v)
            },
            previousValue: function(element) {
                return $.data(element, C) || $.data(element, C, {
                    old: null,
                    valid: u,
                    message: this[nt](element, M)
                })
            }
        },
        classRuleSettings: {
            required: {
                required: u
            },
            email: {
                email: u
            },
            url: {
                url: u
            },
            date: {
                date: u
            },
            dateISO: {
                dateISO: u
            },
            number: {
                number: u
            },
            digits: {
                digits: u
            },
            creditcard: {
                creditcard: u
            }
        },
        addClassRules: function(className, rules) {
            className[q] === String ? this[x][className] = rules: $[y](this[x], className)
        },
        classRules: function(element) {
            var rules = {},
            classes = $(element)[J]("class");
            return classes && $[V](classes[ot](" "),
            function() {
                this in $[r][x] && $[y](rules, $[r][x][this])
            }),
            rules
        },
        attributeRules: function(element) {
            var rules = {},
            $element = $(element),
            type = element.getAttribute(Pt),
            method,
            value;
            for (method in $[r][bt]) method === A ? (value = element.getAttribute(method), value === "" && (value = u), value = !!value) : value = $element[J](method),
            /min|max/ [_t](method) && (type === null || /number|range|text/ [_t](type)) && (value = Number(value)),
            value || value === 0 ? rules[method] = value: type === method && type !== It && (rules[method] = u);
            return rules[L] && /-1|2147483647|524288/ [_t](rules[L]) && delete rules[L],
            rules
        },
        dataRules: function(element) {
            var method, value, rules = {},
            $element = $(element);
            for (method in $[r][bt]) value = $element.data("rule" + method[0].toUpperCase() + method.substring(1)[Y]()),
            value !== undefined && (rules[method] = value);
            return rules
        },
        staticRules: function(element) {
            var rules = {},
            validator = $.data(element[et], r);
            return validator[t][dt] && (rules = $[r][D](validator[t][dt][element[f]]) || {}),
            rules
        },
        normalizeRules: function(rules, element) {
            return $[V](rules,
            function(prop, val) {
                if (val === v) {
                    delete rules[prop];
                    return
                }
                if (val.param || val[Lt]) {
                    var keepRule = u;
                    switch (typeof val[Lt]) {
                    case k:
                        keepRule = !!$(val[Lt], element[et])[o];
                        break;
                    case Ht:
                        keepRule = val[Lt].call(element, element)
                    }
                    keepRule ? rules[prop] = val.param !== undefined ? val.param: u: delete rules[prop]
                }
            }),
            $[V](rules,
            function(rule, parameter) {
                rules[rule] = $.isFunction(parameter) ? parameter(element) : parameter
            }),
            $[V]([it, L],
            function() {
                rules[this] && (rules[this] = Number(rules[this]))
            }),
            $[V]([Ft, It],
            function() {
                var parts;
                rules[this] && ($[At](rules[this]) ? rules[this] = [Number(rules[this][0]), Number(rules[this][1])] : typeof rules[this] === k && (parts = rules[this][ot](/[\s,]+/), rules[this] = [Number(parts[0]), Number(parts[1])]))
            }),
            $[r].autoCreateRanges && (rules.min && rules.max && (rules[It] = [rules.min, rules.max], delete rules.min, delete rules.max), rules[it] && rules[L] && (rules[Ft] = [rules[it], rules[L]], delete rules[it], delete rules[L])),
            rules
        },
        normalizeRule: function(data) {
            if (typeof data === k) {
                var transformed = {};
                $[V](data[ot](/\s/),
                function() {
                    transformed[this] = u
                }),
                data = transformed
            }
            return data
        },
        addMethod: function(name, method, message) {
            $[r][bt][name] = method,
            $[r][c][name] = message !== undefined ? message: $[r][c][name],
            method[o] < 3 && $[r].addClassRules(name, $[r][D](name))
        },
        methods: {
            required: function(value, element, param) {
                if (!this.depend(param, element)) return h;
                if (element.nodeName[Y]() === "select") {
                    var val = $(element).val();
                    return val && val[o] > 0
                }
                return this[G](element) ? this[lt](value, element) > 0 : $.trim(value)[o] > 0
            },
            email: function(value, element) {
                return this[d](element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/ [_t](value)
            },
            url: function(value, element) {
                return this[d](element) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i[_t](value)
            },
            date: function(value, element) {
                return this[d](element) || !/Invalid|NaN/ [_t]((new Date(value)).toString())
            },
            dateISO: function(value, element) {
                return this[d](element) || /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/ [_t](value)
            },
            number: function(value, element) {
                return this[d](element) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/ [_t](value)
            },
            digits: function(value, element) {
                return this[d](element) || /^\d+$/ [_t](value)
            },
            creditcard: function(value, element) {
                if (this[d](element)) return h;
                if (/[^0-9 \-]+/ [_t](value)) return v;
                var nCheck = 0,
                nDigit = 0,
                bEven = v,
                n, cDigit;
                value = value[rt](/\D/g, "");
                if (value[o] < 13 || value[o] > 19) return v;
                for (n = value[o] - 1; n >= 0; n--) cDigit = value.charAt(n),
                nDigit = parseInt(cDigit, 10),
                bEven && (nDigit *= 2) > 9 && (nDigit -= 9),
                nCheck += nDigit,
                bEven = !bEven;
                return nCheck % 10 === 0
            },
            minlength: function(value, element, param) {
                var length = $[At](value) ? value[o] : this[lt]($.trim(value), element);
                return this[d](element) || length >= param
            },
            maxlength: function(value, element, param) {
                var length = $[At](value) ? value[o] : this[lt]($.trim(value), element);
                return this[d](element) || length <= param
            },
            rangelength: function(value, element, param) {
                var length = $[At](value) ? value[o] : this[lt]($.trim(value), element);
                return this[d](element) || length >= param[0] && length <= param[1]
            },
            min: function(value, element, param) {
                return this[d](element) || value >= param
            },
            max: function(value, element, param) {
                return this[d](element) || value <= param
            },
            range: function(value, element, param) {
                return this[d](element) || value >= param[0] && value <= param[1]
            },
            equalTo: function(value, element, param) {
                var target = $(param);
                return this[t].onfocusout && target.unbind(".validate-equalTo").bind("blur.validate-equalTo",
                function() {
                    $(element)[tt]()
                }),
                value === target.val()
            },
            remote: function(value, element, param) {
                if (this[d](element)) return h;
                var previous = this[C](element),
                validator,
                data;
                return this[t][c][element[f]] || (this[t][c][element[f]] = {}),
                previous[Ot] = this[t][c][element[f]][M],
                this[t][c][element[f]][M] = previous.message,
                param = typeof param === k && {
                    url: param
                } || param,
                previous.old === value ? previous[tt] : (previous.old = value, validator = this, this.startRequest(element), data = {},
                data[element[f]] = value, $.ajax($[y](u, {
                    url: param,
                    mode: "abort",
                    port: vt + element[f],
                    dataType: "json",
                    data: data,
                    context: validator[s],
                    success: function(response) {
                        var valid = response === u || response === xt,
                        errors, message, submitted;
                        validator[t][c][element[f]][M] = previous[Ot],
                        valid ? (submitted = validator[g], validator[jt](element), validator[g] = submitted, validator[w].push(element), delete validator[U][element[f]], validator[P]()) : (errors = {},
                        message = response || validator[nt](element, M), errors[element[f]] = previous.message = $.isFunction(message) ? message(value) : message, validator[U][element[f]] = u, validator[P](errors)),
                        previous[tt] = valid,
                        validator.stopRequest(element, valid)
                    }
                },
                param)), K)
            }
        }
    }),
    $[O] = function deprecated() {
        throw "$.format has been deprecated. Please use $.validator.format instead."
    }
} (jQuery),
function($) {
    var e = "ajaxPrefilter",
    t = "abort",
    n = "ajaxSettings",
    pendingRequests = {},
    ajax;
    $[e] ? $[e](function(settings, _, xhr) {
        var port = settings.port;
        settings.mode === t && (pendingRequests[port] && pendingRequests[port][t](), pendingRequests[port] = xhr)
    }) : (ajax = $.ajax, $.ajax = function(settings) {
        var mode = ("mode" in settings ? settings: $[n]).mode,
        port = ("port" in settings ? settings: $[n]).port;
        return mode === t ? (pendingRequests[port] && pendingRequests[port][t](), pendingRequests[port] = ajax.apply(this, arguments), pendingRequests[port]) : ajax.apply(this, arguments)
    })
} (jQuery),
function($) {
    $.extend($.fn, {
        validateDelegate: function(delegate, type, handler) {
            return this.bind(type,
            function(event) {
                var target = $(event.target);
                if (target.is(delegate)) return handler.apply(target, arguments)
            })
        }
    })
} (jQuery),
function($) {
    "use strict";
    function Ua(ua) {
        this.ua = (ua || navua || "")[f](),
        this[l] = !1,
        this[c] = !1,
        this[h] = !1
    }
    function _parse(rule, ua, isBrowser) {
        var item = {},
        name, versionSearch, flags, versionNames, i, is, ic, j, js, jc;
        if (isBrowser && ieVer) return {
            name: "ie",
            ie: !0,
            version: ieVer,
            isIe: !0
        };
        for (i = 0, is = rule[y]; i < is; i++) {
            ic = rule[i],
            name = ic[b],
            versionSearch = ic.versionSearch,
            flags = ic.flags,
            versionNames = ic.versionNames;
            if (ua.indexOf(name) !== -1) {
                item[b] = name[E](/\s/g, ""),
                ic.slugName && (item[b] = ic.slugName),
                item[S + _upperCase1st(item[b])] = !0,
                item[x] = ("" + ((new RegExp(versionSearch + "(\\d+((\\.|_)\\d+)*)")).exec(ua) || [, 0])[1])[E](/_/g, ".");
                if (flags) for (j = 0, js = flags[y]; j < js; j++) item[S + _upperCase1st(flags[j])] = !0;
                if (versionNames) for (j = 0, js = versionNames[y]; j < js; j++) {
                    jc = versionNames[j];
                    if (item[x].indexOf(jc.number) === 0) {
                        item[T] = jc[b],
                        item[S + _upperCase1st(item[T])] = !0;
                        break
                    }
                }
                rule === parseRule.platforms && (item[d] = /mobile|phone/ [a](ua) || item.isBlackberry, item[d] = item[d] === undefined ? !1 : !0, item[m] = /tablet/ [a](ua) || item.isIpad || item.isAndroid && !/mobile/ [a](ua), item[m] = item[m] === undefined ? !1 : !0, item[m] && (item[d] = !1), item[g] = !item[d] && !item[m] ? !0 : !1, item[N] && (item[T] = N + parseInt(item[x], 10), item[S + _upperCase1st(item[T])] = !0));
                break
            }
        }
        return item[b] || (item.isUnknown = !0, item[b] = "", item[x] = ""),
        item
    }
    function _upperCase1st(string) {
        return string[E](/^(\w)/,
        function(w) {
            return w.toUpperCase()
        })
    }
    function _mime(where, value, name, nameReg) {
        var mimeTypes = win[e].mimeTypes,
        i;
        for (i in mimeTypes) if (mimeTypes[i][where] == value) {
            if (name !== undefined && nameReg[a](mimeTypes[i][name])) return ! 0;
            if (name === undefined) return ! 0
        }
        return ! 1
    }
    function _getChromiumType() {
        if (isIe || win[u] !== undefined) return "";
        var isOriginalChrome = _mime("type", "application/vnd.chromium.remoting-viewer");
        if (isOriginalChrome) return t;
        if (win[t]) {
            var _track = C in doc[k](C),
            _style = "scoped" in doc[k]("style"),
            _v8locale = "v8Locale" in win,
            external = win.external;
            return external && "SEVersion" in external ? s: external && "LiebaoGetVersion" in external ? o: _track && !_style && !_v8locale && /Gecko\)\s+Chrome/ [a](appVersion) ? n: _track && _style && _v8locale ? r: "other chrome"
        }
        return ""
    }
    function _getIeVersion() {
        var v = 3,
        p = doc[k]("p"),
        all = p.getElementsByTagName("i");
        while (p.innerHTML = "<!--[if gt IE " + ++v + "]><i></i><![endif]-->", all[0]);
        return v > 4 ? v: 0
    }
    function _getRules() {
        return {
            platforms: [{
                name: "windows phone",
                versionSearch: "windows phone os ",
                versionNames: [{
                    number: "7.5",
                    name: "mango"
                }]
            },
            {
                name: "win",
                slugName: "windows",
                versionSearch: "windows(?: nt)? ",
                versionNames: [{
                    number: "6.2",
                    name: "windows 8"
                },
                {
                    number: "6.1",
                    name: "windows 7"
                },
                {
                    number: "6.0",
                    name: "windows vista"
                },
                {
                    number: "5.2",
                    name: L
                },
                {
                    number: "5.1",
                    name: L
                },
                {
                    number: "5.0",
                    name: "windows 2000"
                }]
            },
            {
                name: "ipad",
                versionSearch: "cpu os ",
                flags: [N]
            },
            {
                name: "ipod",
                versionSearch: A,
                flags: [N]
            },
            {
                name: "iphone",
                versionSearch: A,
                flags: [N]
            },
            {
                name: "mac",
                versionSearch: "os x ",
                versionNames: [{
                    number: "10.8",
                    name: "mountainlion"
                },
                {
                    number: "10.7",
                    name: "lion"
                },
                {
                    number: "10.6",
                    name: "snowleopard"
                },
                {
                    number: "10.5",
                    name: "leopard"
                },
                {
                    number: "10.4",
                    name: "tiger"
                },
                {
                    number: "10.3",
                    name: "panther"
                },
                {
                    number: "10.2",
                    name: "jaguar"
                },
                {
                    number: "10.1",
                    name: "puma"
                },
                {
                    number: "10.0",
                    name: "cheetah"
                }]
            },
            {
                name: "android",
                versionSearch: "android ",
                versionNames: [{
                    number: "4.1",
                    name: "jellybean"
                },
                {
                    number: "4.0",
                    name: "icecream sandwich"
                },
                {
                    number: "3.",
                    name: "honey comb"
                },
                {
                    number: "2.3",
                    name: "ginger bread"
                },
                {
                    number: "2.2",
                    name: "froyo"
                },
                {
                    number: "2.",
                    name: "eclair"
                },
                {
                    number: "1.6",
                    name: "donut"
                },
                {
                    number: "1.5",
                    name: "cupcake"
                }]
            },
            {
                name: O,
                versionSearch: "(?:blackberry\\d{4}[a-z]?|version)/"
            },
            {
                name: "bb",
                slugName: O,
                versionSearch: M
            },
            {
                name: "playbook",
                slugName: O,
                versionSearch: M
            },
            {
                name: "linux"
            },
            {
                name: "nokia"
            }],
            browsers: [{
                name: "iemobile",
                versionSearch: "iemobile/"
            },
            {
                name: "msie",
                slugName: "ie",
                versionSearch: "msie "
            },
            {
                name: "firefox",
                versionSearch: "firefox/"
            },
            {
                name: t,
                versionSearch: "chrome/"
            },
            {
                name: "safari",
                versionSearch: "(?:browser|version)/"
            },
            {
                name: "opera",
                versionSearch: "version/"
            }],
            engines: [{
                name: "trident",
                versionSearch: "trident/"
            },
            {
                name: "webkit",
                versionSearch: "webkit/"
            },
            {
                name: "gecko",
                versionSearch: "rv:"
            },
            {
                name: "presto",
                versionSearch: "presto/"
            }]
        }
    }
    var e = "navigator",
    t = "chrome",
    n = "360ee",
    r = "360se",
    s = "sougou",
    o = "liebao",
    u = "scrollMaxX",
    a = "test",
    f = "toLowerCase",
    l = "isWebkit",
    c = "isGecko",
    h = "isTrident",
    d = "isMobile",
    m = "isTablet",
    g = "isDesktop",
    y = "length",
    b = "name",
    E = "replace",
    S = "is",
    x = "version",
    T = "fullname",
    N = "ios",
    C = "track",
    k = "createElement",
    L = "windows xp",
    A = "iphone os ",
    O = "blackberry",
    M = "(?:version)/",
    win = window,
    nav = win[e],
    navua = nav.userAgent,
    appVersion = nav.appVersion,
    doc = win.document,
    $ = win.$,
    parseRule = _getRules(),
    ieAX = win.ActiveXObject,
    ieMode = doc.documentMode,
    ieVer = _getIeVersion() || ieMode || 0,
    isIe = ieAX || ieMode,
    chromiumType = _getChromiumType(),
    statics = {
        isIe: !!ieVer,
        isIe6: ieAX && ieVer == 6 || ieMode == 6,
        isIe7: ieAX && ieVer == 7 || ieMode == 7,
        isIe8: ieAX && ieVer == 8 || ieMode == 8,
        isIe9: ieAX && ieVer == 9 || ieMode == 9,
        isIe10: ieMode === 10,
        isIe11: ieMode === 11,
        ie: ieVer,
        isChrome: chromiumType === t,
        is360ee: chromiumType === n,
        is360se: chromiumType === r,
        isSougou: chromiumType === s,
        isLiebao: chromiumType === o,
        isFirefox: win[u] !== undefined,
        isMaxthon: ieVer && /\bmaxthon\b/i[a](appVersion),
        isQQ: ieVer && /\bqqbrowser\b/i[a](appVersion)
    },
    i;
    $.ua = function(ua) {
        var _ua = new Ua(ua);
        return _ua._parse()
    };
    for (i in statics) $.ua[i] = statics[i];
    Ua.prototype = {
        _parse: function() {
            var that = this,
            objPlatform = _parse(parseRule.platforms, that.ua),
            objBrowser = _parse(parseRule.browsers, that.ua, !0),
            objEngine = _parse(parseRule.engines, that.ua);
            return that.platform = $.extend({},
            objPlatform, {
                os: win[e].platform[f]()
            }),
            that.browser = objBrowser,
            that.engine = objEngine,
            that[l] = !!objEngine[l],
            that[c] = !!objEngine[c],
            that[h] = !!objEngine[h],
            that[d] = objPlatform[d],
            that[m] = objPlatform[m],
            that[g] = objPlatform[g],
            that
        }
    }
} (window.jQuery),
function() {
    var t = "validator",
    n = "format"; (function($) {
        $.extend($[t].messages, {
            required: "必填",
            remote: "请修正此栏位",
            email: "请输入有效的电子邮件",
            url: "请输入有效的网址.例如:http://www.evervc.com",
            date: "请输入有效的日期",
            dateISO: "请输入有效的日期 (YYYY-MM-DD)",
            number: "请输入正确的数字",
            digits: "只可输入数字",
            creditcard: "请输入有效的信用卡号码",
            equalTo: "您的输入不相同",
            extension: "请输入有效的后缀",
            maxlength: $[t][n]("最多 {0} 个字"),
            minlength: $[t][n]("最少 {0} 个字"),
            rangelength: $[t][n]("请输入长度为 {0} 至 {1} 之間的字串"),
            range: $[t][n]("请输入 {0} 至 {1} 之间的数值"),
            max: $[t][n]("请输入不大于 {0} 的数值"),
            min: $[t][n]("请输入不小于 {0} 的数值")
        })
    })(jQuery),
    $(document).ready(function(e) {
        JQueryValidateMethod.addMethods()
    })
} ();
var JQueryValidateMethod = {
    addMethods: function() {
        var e = "addMethod",
        t = "validator",
        n = "isIdCardNo",
        r = "optional",
        i = "isDate6",
        s = "isDate8",
        o = "isMobile";
        window.jQuery && (jQuery[t][e](n,
        function(value, element) {
            return this[r](element) || JQueryValidateMethod[n](value)
        },
        "请正确输入您的身份证号码"), jQuery[t][e](i,
        function(value, element) {
            return this[r](element) || JQueryValidateMethod[i](value)
        },
        "请输入有效的六位数年月。例如：201401"), jQuery[t][e](s,
        function(value, element) {
            return this[r](element) || JQueryValidateMethod[s](value)
        },
        "请输入有效的六位数年月日。例如：20140123"), jQuery[t][e](o,
        function(value, element) {
            return JQueryValidateMethod[o](value)
        },
        "请输入有效的11位手机号码"))
    },
    isMobile: function(value, element) {
        var length = value.length,
        mobile = /^(1+\d{10})$/;
        return length == 11 && mobile.exec(value) ? !0 : !1
    },
    isIdCardNo: function(num) {
        var e = !1,
        factorArr = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1),
        parityBit = new Array("1", "0", "X", "9", "8", "7", "6", "5", "4", "3", "2"),
        varArray = new Array,
        intValue,
        lngProduct = 0,
        intCheckDigit,
        intStrLen = num.length,
        idNumber = num;
        if (intStrLen != 15 && intStrLen != 18) return e;
        for (i = 0; i < intStrLen; i++) {
            varArray[i] = idNumber.charAt(i);
            if ((varArray[i] < "0" || varArray[i] > "9") && i != 17) return e;
            i < 17 && (varArray[i] = varArray[i] * factorArr[i])
        }
        if (intStrLen == 18) {
            var date8 = idNumber.substring(6, 14);
            if (this.isDate8(date8) == e) return e;
            for (i = 0; i < 17; i++) lngProduct += varArray[i];
            intCheckDigit = parityBit[lngProduct % 11];
            if (varArray[17] != intCheckDigit) return e
        } else {
            var date6 = idNumber.substring(6, 12);
            if (this.isDate6(date6) == e) return e
        }
        return ! 0
    },
    isDate6: function(sDate) {
        if (!/^[0-9]{6}$/.test(sDate)) return ! 1;
        var year, month, day;
        return year = sDate.substring(0, 4),
        month = sDate.substring(4, 6),
        year < 1700 || year > 2500 ? !1 : month < 1 || month > 12 ? !1 : !0
    },
    isDate8: function(sDate) {
        var e = !1,
        t = "substring";
        if (!/^[0-9]{8}$/.test(sDate)) return e;
        var year, month, day;
        year = sDate[t](0, 4),
        month = sDate[t](4, 6),
        day = sDate[t](6, 8);
        var iaMonthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (year < 1700 || year > 2500) return e;
        if (year % 4 == 0 && year % 100 != 0 || year % 400 == 0) iaMonthDays[1] = 29;
        return month < 1 || month > 12 ? e: day < 1 || day > iaMonthDays[month - 1] ? e: !0
    }
},
UrlHelper = {
    getRootUrl: function() {
        var host = window.location.protocol;
        if (host == "http:" || host == "https:") host = host + "//" + window.location.host;
        return host
    },
    getWebRootUrl: function() {
        return this.getRootUrl() + ""
    },
    getAPIRootUrl: function() {
        return UrlHelper.getRootUrl() + "/api"
    },
    getConsoleRootUrl: function() {
        return UrlHelper.getRootUrl() + "/console"
    },
    getJSRootUrl: function() {
        return UrlHelper.getRootUrl() + "/js"
    },
    getHomePageUrl: function() {
        return UrlHelper.getRootUrl() + "/index.html"
    },
    getCompanyUrl: function(startupId) {
        return ! startupId || startupId == 0 ? "#": UrlHelper.getRootUrl() + "/startups/" + startupId
    },
    getCompanyShowUrl: function(startup) {
        return UrlHelper.getRootUrl() + "/startups/" + startup.id
    },
    getConpanyRaisingShowUrl: function(startup) {
        return UrlHelper.getRootUrl() + "/fundraising.html?p=" + startup.id
    },
    getTagSearchUrl: function(tag) {
        return UrlHelper.getRootUrl() + "/tag-" + tag.id + ".html"
    },
    get404PageUrl: function() {
        return UrlHelper.getRootUrl() + "/404.html"
    },
    getCompanySearchUrl: function(params) {
        return UrlHelper.getRootUrl() + "/startups.html?" + $.param(params, !0)
    },
    getUserSearchUrl: function(params) {
        return UrlHelper.getRootUrl() + "/investors.html?" + $.param(params, !0)
    },
    getUserUrl: function(userId) {
        return ! userId || userId == 0 ? UrlHelper.getRootUrl() + "/person": UrlHelper.getRootUrl() + "/person/" + userId
    },
    getStartupSecretPicUrl: function(startupId, mediaId, style) {
        var e = "getAPIRootUrl",
        t = "/resources/startups/",
        n = "/media/";
        return style ? UrlHelper[e]() + t + startupId + n + mediaId + "@!" + style: UrlHelper[e]() + t + startupId + n + mediaId
    },
    getCaptchaUrl: function(captchaKey) {
        return UrlHelper.getRootUrl() + "/captcha/" + captchaKey + "?_" + Math.random()
    }
},
FormHelper = {
    validateRequired: function(val) {
        if (val === undefined || val == null) return ! 1;
        if ($.isNumeric(val)) {
            if (val == 0) return ! 1
        } else if (val == "") return ! 1;
        return ! 0
    },
    validatePhoneNumber: function(val) {
        return val && val != null && val.length == 11 && !isNaN(val) ? !0 : !1
    },
    removeTooltipFromField: function($field) {
        $field.tooltipster("destroy")
    },
    bindTooltipToFields: function($fieldSelector, tipClass, op) {
        var e = "length",
        t = "title",
        n = "tooltipster",
        r = "trigger",
        s = "custom",
        o = "tooltipster-ns";
        op = op ? op: {};
        var bind = function($field) {
            var pNode = $field.parent(),
            count = 0,
            tipElement = pNode.find("." + tipClass);
            while (tipElement[e] === 0 && count < 5) pNode = pNode.parent(),
            tipElement = pNode.find("." + tipClass);
            if (tipElement[e] === 0) return;
            var tipContent = null,
            maxwidth = 200,
            leftOffSet = 0;
            if (tipElement) {
                tipContent = tipElement.html();
                var maxWidth = tipElement.width();
                leftOffSet = tipElement.attr("tip_offset_x"),
                tipElement.hide()
            } else tipContent = $field.attr(t);
            if (!tipContent || tipContent[e] == 0) return;
            $field[n]({
                animation: "fade",
                speed: 200,
                position: op.position ? op.position: "right",
                maxWidth: op[r] ? op[r] : maxWidth,
                trigger: op[r] ? op[r] : s,
                theme: op[r] ? op[r] : "tooltipster-light",
                content: op[r] ? op[r] : "",
                contentAsHTML: "true",
                offsetX: leftOffSet
            });
            if (!op[r] || op[r] == s) $field.focus(function() {
                if ($field.data(o)) {
                    var tipContent = null;
                    tipElement ? (tipContent = tipElement.html(), tipElement.hide()) : tipContent = $field.attr(t);
                    if (!tipContent || tipContent[e] == 0) return;
                    $field[n]("content", tipContent),
                    $field[n]("show")
                }
            }),
            $field.blur(function() {
                $field.data(o) && $field[n]("hide")
            })
        };
        if ($fieldSelector[e] > 0) for (var i = 0; i < $fieldSelector[e]; i++) {
            var f = $fieldSelector[i];
            bind($(f))
        }
    },
    bindTooltipToField: function($fieldSelector, op) {
        var e = "parents",
        t = ".group",
        n = "length",
        r = "tooltipster",
        s = "trigger",
        o = "custom",
        u = "tooltipster-ns";
        op = op ? op: {};
        var bind = function($field) {
            var tipElement = $field[e](t).find("div.input_TipAct");
            tipElement[n] == 0 && (tipElement = $field[e](t).find("div.input_Tip1")),
            tipElement[n] == 0 && (tipElement = $field[e](t).find("div.input_Tip2"));
            var tipContent = null,
            maxwidth = 200,
            leftOffSet = 0;
            tipElement ? (tipContent = tipElement.html(), maxWidth = tipElement.width(), leftOffSet = tipElement.attr("tip_offset_x"), tipElement.hide()) : tipContent = $field.attr("title");
            if (!tipContent || tipContent[n] == 0) return;
            $field[r]({
                animation: "fade",
                speed: 200,
                position: op.position ? op.position: "right",
                maxWidth: op[s] ? op[s] : maxWidth,
                trigger: op[s] ? op[s] : o,
                theme: op[s] ? op[s] : "tooltipster-light",
                content: op[s] ? op[s] : "",
                contentAsHTML: "true",
                offsetX: leftOffSet
            });
            if (!op[s] || op[s] == o) $field.focus(function() {
                $field.data(u) && ($field[r]("content", tipContent), $field[r]("show"))
            }),
            $field.blur(function() {
                $field.data(u) && $field[r]("hide")
            })
        };
        if ($fieldSelector[n] > 0) for (var i = 0; i < $fieldSelector[n]; i++) {
            var f = $fieldSelector[i];
            bind($(f))
        }
    },
    showFormInputErrorTip: function(errInfo, errshowInObj, inputObj) {
        if (inputObj === undefined || inputObj == null || errshowInObj === undefined || errshowInObj == null) return;
        console.dir(inputObj.length);
        for (var i = 0; i < inputObj.length; i++) {
            var o = inputObj[i];
            o.tagName == "INPUT" && $(o).addClass("error")
        }
        errshowInObj.removeClass(),
        errshowInObj.addClass("input_TipError"),
        errshowInObj.html(errInfo)
    },
    setFieldInputTypeMoney: function($field) {
        $field.bind("input propertychange",
        function(e) {
            var placeHolder = $field.attr("placeholder"),
            inputValue = $field.val();
            if (placeHolder == inputValue) return;
            var newValue = "";
            for (var i = 0; i < inputValue.length; i++) {
                var c = inputValue.charAt(i);
                if (!isNaN(c) || c == "." && newValue.indexOf(".") < 0) newValue += c
            }
            newValue = NumberUtil.separatePerThree(newValue, ","),
            newValue != $field.val() && $field.val(newValue)
        })
    },
    setFieldInputTypeMoneyTenThousand: function($field) {
        $field.bind("input propertychange",
        function(e) {
            if ($field.val() == $field.attr("placeholder")) return;
            var inputValue = NumberUtil.removeSeparator($field.val()),
            newValue = "";
            for (var i = 0; i < inputValue.length; i++) {
                var c = inputValue.charAt(i);
                if (!isNaN(c) || c == "." && newValue.indexOf(".") < 0) newValue += c
            }
            newValue = NumberUtil.separatePerThree(newValue, ","),
            $field.val() != newValue && $field.val(newValue)
        })
    },
    setFieldInputTypePercent: function($field, floatPercision) {
        var t = ".",
        n = "indexOf";
        floatPercision || (floatPercision = 2),
        $field.bind("input propertychange",
        function(e) {
            if ($field.val() == $field.attr("placeholder")) return;
            var inputValue = $field.val(),
            newValue = "";
            for (var i = 0; i < inputValue.length; i++) {
                var c = inputValue.charAt(i);
                if (!isNaN(c) || c == t && newValue[n](t) < 0) newValue += c
            }
            if (Number(newValue) > 100) {
                newValue = 100,
                $field.val(newValue);
                return
            }
            if (newValue[n](t) > 0) {
                var floatLength = newValue.length - newValue[n](t) - 1;
                floatLength > floatPercision,
                newValue = newValue.substring(0, newValue[n](t) + floatPercision + 1)
            }
            $field.val() != newValue && $field.val(newValue)
        })
    },
    setFieldInputTypeNumber: function($field) {
        $field.bind("input propertychange",
        function(e) {
            if ($field.val() == $field.attr("placeholder")) return;
            var inputValue = $field.val(),
            newValue = "";
            for (var i = 0; i < inputValue.length; i++) {
                var c = inputValue.charAt(i);
                if (!isNaN(c) || c == "." && newValue.indexOf(".") < 0) newValue += c
            }
            newValue = NumberUtil.separatePerThree(newValue, ","),
            $field.val() != newValue && $field.val(newValue)
        })
    },
    setFieldInputTypeInteger: function($field) {
        $field.bind("input propertychange",
        function(e) {
            var placeHolder = $field.attr("placeholder"),
            inputValue = $field.val();
            if (placeHolder == inputValue) return;
            var newValue = "";
            for (var i = 0; i < inputValue.length; i++) {
                var c = inputValue.charAt(i);
                isNaN(c) || (newValue += c)
            }
            inputValue != newValue && $field.val(newValue)
        })
    },
    setFieldMaxInputLength: function($field, maxLength, $counter) {
        $field.bind("input propertychange",
        function(e) {
            if ($field.val() == $field.attr("placeholder")) return;
            var inputValue = $field.val();
            inputValue.length > maxLength && $field.val(inputValue.substring(0, maxLength)),
            $counter && $counter.html($field.val().length)
        }),
        $field.setVal = function(value) {
            $field.val(value),
            value ? $counter.html(value.length) : $counter.html(0)
        }
    },
    validateRadioGroup: function($container, validateParams) {
        var t = "showError",
        n = "length",
        r = "required",
        i = "messages",
        radios = $container.find('input[type="radio"]'),
        $error = validateParams.errorContainer;
        if (!$error || $error == null) $error = $container.find(".error");
        var validate = {};
        return validate[t] = function(errInfo) {
            $error && $error[n] > 0 && ($error.html(errInfo), $error.fadeIn())
        },
        validate.hideError = function() {
            $error && $error[n] > 0 && $error.fadeOut()
        },
        validate.validate = function() {
            var selectedValue = radios.filter(":checked").val();
            if (validateParams.rules[r]) {
                if (selectedValue == null || selectedValue[n] == 0) return validateParams[i] && validateParams[i][r] ? validate[t](validateParams[i][r]) : validate[t]("请选择一项"),
                !1;
                validate.hideError()
            }
            return ! 0
        },
        validateParams.rules && radios.change(function(e) {
            validate.validate()
        }),
        validate
    },
    serializeObject: function(sArray) {
        var e = "name",
        o = {},
        a = sArray;
        return $.each(a,
        function() {
            o[this[e]] !== undefined ? (o[this[e]].push || (o[this[e]] = [o[this[e]]]), o[this[e]].push(this.value || "")) : o[this[e]] = this.value || ""
        }),
        o
    }
},
NumberUtil = {
    separatePerThree: function(str, separator) {
        var e = "length",
        t = "substring";
        if (str === undefined || str == null) return "";
        $.type(str) !== "string" && (str = str.toString()),
        separator || (separator = ","),
        str = NumberUtil.removeSeparator(str, separator);
        var toLeft = function(s) {
            if (s[e] <= 3) return s;
            var l = s[e],
            rst = "",
            temp = s;
            while (l > 3) rst[e] > 0 ? rst = temp[t](temp[e] - 3, temp[e]) + separator + rst: rst = temp[t](temp[e] - 3, temp[e]),
            temp = temp[t](0, temp[e] - 3),
            l = temp[e];
            return rst = temp + separator + rst,
            rst
        },
        toRight = function(s) {
            if (s[e] <= 3) return s;
            var l = s[e],
            rst = "",
            temp = s;
            while (l > 3) rst[e] > 0 ? rst = rst + separator + temp[t](0, 3) : rst = temp[t](0, 3),
            temp = temp[t](3, temp[e]),
            l = temp[e];
            return rst = rst + separator + temp,
            rst
        };
        if (str.indexOf(".") >= 0) {
            var sep = str.split(".");
            return toLeft(sep[0]) + "." + toRight(sep[1])
        }
        return toLeft(str)
    },
    removeSeparator: function(str, separator) {
        return separator || (separator = ","),
        typeof str == "string" && str.indexOf(separator) >= 0 ? str.split(separator).join("") : str
    },
    convertCurrencyToZh: function(currencyDigits) {
        var e = "length",
        t = "substr",
        MAXIMUM_NUMBER = 99999999999.99,
        CN_ZERO = "零",
        CN_ONE = "壹",
        CN_TWO = "贰",
        CN_THREE = "叁",
        CN_FOUR = "肆",
        CN_FIVE = "伍",
        CN_SIX = "陆",
        CN_SEVEN = "柒",
        CN_EIGHT = "捌",
        CN_NINE = "玖",
        CN_TEN = "拾",
        CN_HUNDRED = "佰",
        CN_THOUSAND = "仟",
        CN_TEN_THOUSAND = "万",
        CN_HUNDRED_MILLION = "亿",
        CN_DOLLAR = "元",
        CN_TEN_CENT = "角",
        CN_CENT = "分",
        CN_INTEGER = "整",
        integral, decimal, outputCharacters, parts, digits, radices, bigRadices, decimals, zeroCount, i, p, d, quotient, modulus;
        currencyDigits = currencyDigits === undefined ? "": currencyDigits + "";
        if (currencyDigits == "") return console.error("转换数组为空"),
        "";
        var reg = /^((\d{1,3}(,\d{3})*(.((\d{3},)*\d{1,3}))?)|(\d+(.\d+)?))$/;
        if (!reg.test(currencyDigits)) return console.error("请输入有效格式数字"),
        "";
        currencyDigits = currencyDigits.replace(/,/g, ""),
        currencyDigits = currencyDigits.replace(/^0+/, "");
        if (Number(currencyDigits) > MAXIMUM_NUMBER) return console.error("您输入的数字太大了"),
        "";
        parts = currencyDigits.split("."),
        parts[e] > 1 ? (integral = parts[0], decimal = parts[1], decimal = decimal[t](0, 2)) : (integral = parts[0], decimal = ""),
        digits = new Array(CN_ZERO, CN_ONE, CN_TWO, CN_THREE, CN_FOUR, CN_FIVE, CN_SIX, CN_SEVEN, CN_EIGHT, CN_NINE),
        radices = new Array("", CN_TEN, CN_HUNDRED, CN_THOUSAND),
        bigRadices = new Array("", CN_TEN_THOUSAND, CN_HUNDRED_MILLION),
        decimals = new Array(CN_TEN_CENT, CN_CENT),
        outputCharacters = "";
        if (Number(integral) > 0) {
            zeroCount = 0;
            for (i = 0; i < integral[e]; i++) p = integral[e] - i - 1,
            d = integral[t](i, 1),
            quotient = p / 4,
            modulus = p % 4,
            d == "0" ? zeroCount++:(zeroCount > 0 && (outputCharacters += digits[0]), zeroCount = 0, outputCharacters += digits[Number(d)] + radices[modulus]),
            modulus == 0 && zeroCount < 4 && (outputCharacters += bigRadices[quotient]);
            outputCharacters += CN_DOLLAR
        }
        if (decimal != "") for (i = 0; i < decimal[e]; i++) d = decimal[t](i, 1),
        d != "0" && (outputCharacters += digits[Number(d)] + decimals[i]);
        return outputCharacters == "" && (outputCharacters = CN_ZERO + CN_DOLLAR),
        decimal == "" && (outputCharacters += CN_INTEGER),
        outputCharacters
    }
},
ErrorUtil = {
    responseBaseCallback: function(cb) {
        var e = "status",
        t = "responseText",
        n = null;
        return function(jqXHR, textState, throwError) {
            console.dir(jqXHR),
            console.dir(textState),
            console.dir(throwError);
            if (jqXHR[e] < 200 || jqXHR[e] > 299) {
                var errCode = jqXHR[e];
                if (errCode == 0) {
                    console.error(">>>>> net work error.status = 0");
                    return
                }
                var resText = jqXHR[t];
                if (resText != undefined && resText != n && resText.length > 0) try {
                    var res = $.parseJSON(jqXHR[t]);
                    res.errorCode && (errCode = res.errorCode),
                    cb(errCode, res)
                } catch(err) {} else {
                    var errorDesc = n;
                    throwError && throwError == n && throwError.length > 0 ? errorDesc = throwError: jqXHR[e] == 404 ? errorDesc = "无法找到请求的地址": jqXHR[e] == 403 ? errorDesc = "您没有访问权限": jqXHR[e] == 500 ? errorDesc = "服务器出错了": errorDesc = "出错了",
                    cb(jqXHR[e], {
                        errorDesc: errorDesc
                    })
                }
            }
        }
    },
    responseOnlyMsgCallback: function(cb) {
        return ErrorUtil.responseBaseCallback(function(errCode, errorObj) {
            var errDetail = errorObj.detail,
            errMsg = errorObj.errorDesc,
            rstMsg = "";
            errDetail != undefined && errDetail != null ? $.each(errDetail,
            function(n, v) {
                rstMsg.length == 0 && (rstMsg = v)
            }) : rstMsg = errMsg;
            if ($.ua().isMobile && errCode == "20101") {
                var q = {
                    url: window.location.href
                };
                window.location.href = "/login?" + $.param(q, !0);
                return
            }
            cb(errCode, rstMsg)
        })
    },
    responseErrorMobileCB: function(cb) {
        return ErrorUtil.responseBaseCallback(function(errCode, errorObj) {
            var errDetail = errorObj.detail,
            errMsg = errorObj.errorDesc,
            rstMsg = "";
            errDetail != undefined && errDetail != null ? $.each(errDetail,
            function(n, v) {
                rstMsg.length == 0 && (rstMsg = v)
            }) : rstMsg = errMsg;
            if (errCode == "20101") {
                var q = {
                    url: window.location.href
                };
                window.location.href = "/login?" + $.param(q, !0);
                return
            }
            cb(errCode, rstMsg)
        })
    }
},
SocialService = {
    getReviews: function(userId, targetId, page, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            userId: userId,
            target: targetId,
            page: page
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/reviews", {
            type: "GET",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    },
    talks: function(userId, content, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            userId: userId,
            geo: content
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/talks", {
            type: "POST",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    },
    intros: function(startupId, note, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            startupId: startupId,
            note: note
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/intros", {
            type: "POST",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    },
    planApplies: function(startupId, note, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            startupId: startupId,
            note: note
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/planApplies", {
            type: "POST",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    },
    follows: function(entityType, entityId, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            entityType: entityType,
            entityId: entityId
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/follows", {
            type: "POST",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    },
    deleteFollows: function(entityType, entityId, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            entityType: entityType,
            entityId: entityId
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/follows?" + $.param(q, !0), {
            type: "DELETE",
            success: sCB,
            error: eCB
        })
    },
    followsRelationships: function(userId, entityType, entityIds, sCB, eCB) {
        var q = {
            access_token: App.getInstance().getAccessToken(),
            userId: userId,
            entityType: entityType,
            entityIds: entityIds
        };
        $.ajax(UrlHelper.getAPIRootUrl() + "/follows/relationships", {
            type: "GET",
            data: $.param(q, !0),
            success: sCB,
            error: eCB
        })
    }
},
RaisingService = {
    _instacen: null,
    getInstance: function() {
        var e = "_instacen",
        t = "extend",
        n = "getAccessToken",
        r = "getInstance",
        i = "ajax",
        s = "getAPIRootUrl",
        o = "/startups/",
        u = "POST",
        a = "param",
        f = !0,
        l = "/raising",
        c = "GET",
        h = "/raisings/";
        if (RaisingService[e] != null) return RaisingService[e];
        var _instance = {};
        return _instance.postRaising = function(startupId, raisingInfo, sCB, eCB) {
            console.dir(raisingInfo);
            var q = {};
            $[t](q, raisingInfo),
            console.dir(q),
            q.access_token = App[r]()[n](),
            $[i](UrlHelper[s]() + o + startupId + "/raising ", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.getRaising = function(startupId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[i](UrlHelper[s]() + o + startupId + l, {
                type: c,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.putRaising = function(startupId, raisingInfo, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[t](q, raisingInfo),
            $[i](UrlHelper[s]() + o + startupId + l, {
                type: "PUT",
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.addReservations = function(reservation, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[t](q, reservation),
            $[i](UrlHelper[s]() + "/reservations", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.addCommitments = function(bakers, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[t](q, bakers),
            $[i](UrlHelper[s]() + "/commitments", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.addbackers = function(bakers, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[t](q, bakers),
            $[i](UrlHelper[s]() + "/backers/apply", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.getStartupRaistingRecords = function(startupId, raisingId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[i](UrlHelper[s]() + o + startupId + h + raisingId + "/records", {
                type: c,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.leaderRaising = function(info, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[t](q, info),
            $[i](UrlHelper[s]() + "/leadRaising", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.acceptLeader = function(info, sCB, eCB) {
            var q = {};
            $[t](q, info),
            $[i](UrlHelper[s]() + "/acceptLeader/" + info.applyId, {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.commitmentsRaisingRecord = function(raisingId, audit, note, sCB, eCB) {
            var q = {
                access_token: App[r]()[n](),
                audit: audit,
                note: note
            };
            $[i](UrlHelper[s]() + "/commitments/" + raisingId + "/audit", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.finishRaising = function(startupId, raisingId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[i](UrlHelper[s]() + o + startupId + h + raisingId + "/finish", {
                type: u,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.closeRaising = function(startupId, raisingId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n]()
            };
            $[i](UrlHelper[s]() + o + startupId + h + raisingId + "?" + $[a](q, f), {
                type: "DELETE",
                success: sCB,
                error: eCB
            })
        },
        _instance.getMyLastReservation = function(startupId, raisingId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n](),
                startupId: startupId,
                raisingId: raisingId
            };
            $[i](UrlHelper[s]() + "/my/lastReservation", {
                type: c,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        _instance.getMyLastCommitment = function(startupId, raisingId, sCB, eCB) {
            var q = {
                access_token: App[r]()[n](),
                startupId: startupId,
                raisingId: raisingId
            };
            $[i](UrlHelper[s]() + "/my/lastCommitment", {
                type: c,
                data: $[a](q, f),
                success: sCB,
                error: eCB
            })
        },
        RaisingService[e] = _instance,
        _instance
    }
},
App = {
    _instance: null,
    getInstance: function() {
        var e = "_instance";
        if (App[e] != null) return App[e];
        var app = {
            user: null
        };
        return app.getAccessToken = function() {
            return undefined
        },
        this[e] = app,
        App[e]
    }
};