!function (a) {
    "use strict";
    var h = function (e, t) {
        this.$element = a(e), this.options = a.extend({}, a.fn.hierarchySelect.defaults, t), this.$button = this.$element.children("button"), this.$menu = this.$element.children(".dropdown-menu"), this.$menuInner = this.$menu.children(".hs-menu-inner"), this.$searchbox = this.$menu.find("input"), this.$hiddenField = this.$element.children("input"), this.previouslySelected = null, this.init()
    };
    h.prototype = {
        constructor: h, init: function () {
            this.setWidth(), this.setHeight(), this.initSelect(), this.clickListener(), this.buttonListener(), this.searchListener()
        }, initSelect: function () {
            var e = this.$menuInner.find("a[data-default-selected]:first");
            if (e.length) this.setValue(e.data("value")); else {
                var t = this.$menuInner.find("a:first");
                this.setValue(t.data("value"))
            }
        }, setWidth: function () {
            if (this.$searchbox.attr("size", 1), "auto" === this.options.width) {
                var e = this.$menu.width();
                this.$element.css("min-width", e + 2 + "px")
            } else this.options.width ? (this.$element.css("width", this.options.width), this.$menu.css("min-width", this.options.width), this.$button.css("width", "100%")) : this.$element.css("min-width", "42px")
        }, setHeight: function () {
            this.options.height && (this.$menu.css("overflow", "hidden"), this.$menuInner.css({
                "max-height": this.options.height,
                "overflow-y": "auto"
            }))
        }, getText: function () {
            return this.$button.text()
        }, getValue: function () {
            return this.$hiddenField.val()
        }, setValue: function (e) {
            var t = this.$menuInner.children('a[data-value="' + e + '"]:first');
            this.setSelected(t)
        }, enable: function () {
            this.$button.removeAttr("disabled")
        }, disable: function () {
            this.$button.attr("disabled", "disabled")
        }, setSelected: function (e) {
            if (e.length && this.previouslySelected !== e) {
                var t = e.text(), n = e.data("value");
                this.previouslySelected = e, this.$button.html(t), this.$hiddenField.val(n), this.$menu.find(".active").removeClass("active"), e.addClass("active")
            }
        }, moveUp: function () {
            var e = this.$menuInner.find("a:not(.d-none,.disabled)"), t = this.$menuInner.find(".active"),
                n = e.index(t);
            void 0 !== e[n - 1] && (this.$menuInner.find(".active").removeClass("active"), e[n - 1].classList.add("active"), s(this.$menuInner[0], e[n - 1]))
        }, moveDown: function () {
            var e = this.$menuInner.find("a:not(.d-none,.disabled)"), t = this.$menuInner.find(".active"),
                n = e.index(t);
            void 0 !== e[n + 1] && (this.$menuInner.find(".active").removeClass("active"), e[n + 1] && (e[n + 1].classList.add("active"), s(this.$menuInner[0], e[n + 1])))
        }, selectItem: function () {
            var e = this, t = this.$menuInner.find(".active");
            t.hasClass("d-none") || t.hasClass("disabled") || (setTimeout(function () {
                e.$button.focus()
            }, 5), t && this.setSelected(t), this.$button.dropdown("toggle"))
        }, clickListener: function () {
            var s = this;
            this.$element.on("show.bs.dropdown", function () {
                var n = s.$menuInner.find(".active");
                n && setTimeout(function () {
                    var e = n[0], t = n[0].parentNode;
                    t.scrollTop <= e.offsetTop - t.offsetTop && t.scrollTop + t.clientHeight > e.offsetTop + e.clientHeight || (e.parentNode.scrollTop = e.offsetTop - e.parentNode.offsetTop)
                }, 0)
            }), this.$element.on("hide.bs.dropdown", function () {
                s.previouslySelected && s.setSelected(s.previouslySelected)
            }), this.$element.on("shown.bs.dropdown", function () {
                s.previouslySelected = s.$menuInner.find(".active"), s.$searchbox.focus()
            }), this.$menuInner.on("click", "a", function (e) {
                e.preventDefault();
                var t = a(this);
                t.hasClass("disabled") ? e.stopPropagation() : s.setSelected(t)
            })
        }, buttonListener: function () {
            var t = this;
            this.options.search || this.$button.on("keydown", function (e) {
                switch (e.keyCode) {
                    case 9:
                        t.$element.hasClass("show") && e.preventDefault();
                        break;
                    case 13:
                        t.$element.hasClass("show") && (e.preventDefault(), t.selectItem());
                        break;
                    case 27:
                        t.$element.hasClass("show") && (e.preventDefault(), e.stopPropagation(), t.$button.focus(), t.previouslySelected && t.setSelected(t.previouslySelected), t.$button.dropdown("toggle"));
                        break;
                    case 38:
                        t.$element.hasClass("show") && (e.preventDefault(), e.stopPropagation(), t.moveUp());
                        break;
                    case 40:
                        t.$element.hasClass("show") && (e.preventDefault(), e.stopPropagation(), t.moveDown())
                }
            })
        }, searchListener: function () {
            var s = this;
            this.options.search ? (this.$searchbox.on("keydown", function (e) {
                switch (e.keyCode) {
                    case 9:
                        e.preventDefault(), e.stopPropagation(), s.$menuInner.click(), s.$button.focus();
                        break;
                    case 13:
                        s.selectItem();
                        break;
                    case 27:
                        e.preventDefault(), e.stopPropagation(), s.$button.focus(), s.previouslySelected && s.setSelected(s.previouslySelected), s.$button.dropdown("toggle");
                        break;
                    case 38:
                        e.preventDefault(), s.moveUp();
                        break;
                    case 40:
                        e.preventDefault(), s.moveDown()
                }
            }), this.$searchbox.on("input propertychange", function (e) {
                e.preventDefault();
                var t = s.$searchbox.val().toLowerCase(), n = s.$menuInner.find("a");
                0 === t.length ? n.each(function () {
                    var e = a(this);
                    e.toggleClass("disabled", !1), e.toggleClass("d-none", !1)
                }) : n.each(function () {
                    var e = a(this);
                    -1 !== e.text().toLowerCase().indexOf(t) ? (e.toggleClass("disabled", !1), e.toggleClass("d-none", !1), s.options.hierarchy && function (e) {
                        for (var t = e, n = t.data("level"); "object" == typeof t && 0 < t.length && 1 < n;) n--, (t = t.prevAll('a[data-level="' + n + '"]:first')).hasClass("d-none") && (t.toggleClass("disabled", !0), t.removeClass("d-none"))
                    }(e)) : (e.toggleClass("disabled", !1), e.toggleClass("d-none", !0))
                })
            })) : this.$searchbox.parent().toggleClass("d-none", !0)
        }
    };
    var e = a.fn.hierarchySelect;

    function s(e, t) {
        e.offsetHeight + e.scrollTop < t.offsetTop + t.offsetHeight ? e.scrollTop = t.offsetTop + t.offsetHeight - e.offsetHeight : e.scrollTop >= t.offsetTop - e.offsetTop && (e.scrollTop = t.offsetTop - e.offsetTop)
    }

    a.fn.hierarchySelect = function (s) {
        var i, o = Array.prototype.slice.call(arguments, 1), e = this.each(function () {
            var e = a(this), t = e.data("HierarchySelect"), n = "object" == typeof s && s;
            t || e.data("HierarchySelect", t = new h(this, n)), "string" == typeof s && (i = t[s].apply(t, o))
        });
        return void 0 === i ? e : i
    }, a.fn.hierarchySelect.defaults = {
        width: "auto",
        height: "256px",
        hierarchy: !0,
        search: !0
    }, a.fn.hierarchySelect.Constructor = h, a.fn.hierarchySelect.noConflict = function () {
        return a.fn.hierarchySelect = e, this
    }
}(jQuery);