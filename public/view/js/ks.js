jQuery.fn.stripTags = function () {
    return this.replaceWith(this.html().replace(/<\/?[^>]+>/gi, ''));
};

jQuery(document).ready(function($) {

    var newId = 0;
    $(".kc-search-end-point").on("click","li",function(){
        newId = $(this).attr("id");
        $(this).toggleClass("active");
    })
    var _el = {
        html: $('html'),
        body: $('body'),
        datepicker: $('.kc-datepicker'),
        calendar: $('.kc-calendar'),
        dropdown: $('.kc-dropdown')
    };

    _el.body.on('change', '#is_active_select', function() {
        var i = $(this).is(':checked');
        var el = $('.kc-search-point').parent();
        if(!i) {
            el.addClass('kc-single');
            $('.tex2').hide();
            $('.tex1').show();
            $('.greenLabelTextNEW').hide();
            $('.kc-d').removeClass('show');
        } else {
            $('.tex1').hide();
            $('.tex2').show();
            $('.greenLabelTextNEW').show();
            $('.kc-d').addClass('show');
            el.removeClass('kc-single');
        }
    });
    var kc_dates = {};
    ['start_date', 'end_date'].forEach(function(i) {
        var v = $('.kc-search-'+ i.replace('_','-') +' .kc-value').html();
        if(/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/.test(v)) {
            var _v = v.split('.');
            kc_dates[i] = new Date(_v[2], parseInt(_v[1])-1, _v[0]);
        }

    });

    // @todo: close element on esc key press

    var trLowercase = function(v) {
        var f = ['Ä°','Å','Ã‡','Ã–','Ãœ','Ä','Ä±','ÄŸ','Ã¼','ÅŸ','Ã¶','Ã§'];
        var r = ['i','s','c','o','u','g','i','g','u','s','o','c'];
        f.forEach(function(l, i) {
            v = v.replace(new RegExp(l,'g'), r[i]);
        });
        return v.toLowerCase();
    };

    var stripTags = function(v) {
        return v.replace(/<\/?[^>]+>/gi, '');
    };

    var closeAllElements = function() {
        _el.body.removeClass('kc-modal-open');
        _el.dropdown.add(_el.datepicker).removeClass('active');
    };

    var formatDate = function(d) {
        return (d instanceof Date) ? ('0'+d.getDate()).slice(-2) +'.'+ ('0'+(d.getMonth()+1)).slice(-2) +'.'+ d.getFullYear() : '';
    };

    var isMobile = function() {
        var i_w = _el.body.width() <= 560;
        // document width is enough for mobile check for now.
        return i_w;

    };

    var kcAdjustScroll = function() {
        if(isMobile()) {
            return;
        }
    };

    var kcSetDate = function(start, end) {

        // Remove unnecessary tooltip on datepicker hide
        var j = 0, i = setInterval(function() {
            j++; if(j>2)clearInterval(i);
            $('.tooltip').remove();
        }, 50);

        kc_dates.start_date = start;
        kc_dates.end_date = end;

        ['start', 'end'].forEach(function(i) {

            var el1 = $('.kc-search-'+ i +'-date .kc-value');
            var el2 = $('.kc-sum-'+ i +'-date');
            var d = formatDate(kc_dates[i+'_date']);

            [el1, el2].forEach(function(j) {
                j.html(d == '' ? j.data('placeholder') : d).siblings('input[type="hidden"]').val(d);
            });

        });

        // close datepicker on select
        closeAllElements();

        // open timepicker on select
        // if(!end) // ilk secilen saat ile son secilen saat ayni olacak. o yuzden donus tarihi calendar'indan sonra donus saatini actirma.
        $('.kc-search-'+ (end ? 'end' : 'start') +'-time').addClass('active');

    };

    var kcSetDropdown = function(v) {

        var t = $(this);
        var el_v = t.find('.kc-value');

        if(typeof v == 'undefined') {
            v = el_v.html();
        }

        v = stripTags(v);

        el_v.html(v);

        t.find('.kc-options button').each(function() {
            var _t = $(this);
            var _i = stripTags(_t.html()) == v;
            if(_i) {
                var _v = _t.parent().data('value');
                el_v.siblings('input[type="hidden"]').val(_v ? _v : v);
            }
            _t.parent().attr('class', (_i ? 'active' : ''));
        });
    }

    _el.dropdown.each(function() {
        kcSetDropdown.call(this);
    });

    _el.body.on('keyup', '.kc-dropdown .kc-input input', function (e) {
        var t = $(this);
        var p = t.parents('.kc-dropdown');
        var v = trLowercase(t.val());
        if (v === "") {
            $(".kc-group").removeClass("active")
        }
        p.find('.kc-options button').each(function () {
            var _t = $(this);
            var _v = trLowercase(stripTags(_t.html()));
            if (_v.indexOf(v) === -1) {
                _t.parent().hide();
            }else {
                _t.parent().show();
            }
        });


        p.find('.kc-options > li').each(function () {
            var _t = $(this);
            var _n = 0;
            $(this).children('ul').find('li').each(function () {
                if ($(this).css('display') !== 'none') {
                    _n++;
                }
            });
            if (v !== "") {
                if (_n) {
                    _t.show();
                    _t.addClass('active')
                } else {
                    _t.removeClass('active')
                    _t.hide();
                }
            }
        });
    });

    _el.body.on('click', function(e) {
        var _t = $(e.target);
        var el_dropdown = _t.parents('.kc-dropdown');
        var el_search_date = _t.parents('.kc-search-date');
        if( _t.hasClass('kc-datepicker') ||
            _t.hasClass('ui-icon') ||
            ( _t.attr('class') && _t.attr('class').indexOf('ui-datepicker') !== -1 ) ||
            _t.parents('.kc-datepicker').length) {
            return;
        }
        closeAllElements();
        if(el_dropdown.length) {
            if(el_dropdown.attr('class').indexOf('kc-search') !== -1) {
                kcAdjustScroll();
            }
            _el.body.addClass('kc-modal-open');
            el_dropdown.addClass('active');
            var el_input = el_dropdown.find('.kc-input input');
            if(el_input.length) {
                setTimeout(function() {
                    el_input.focus();
                }, 50);
            }
        }

        if(el_search_date.length) {
            kcAdjustScroll();
            _el.body.addClass('kc-modal-open');
            // @todo: this is not always being called here. Fix it.
            var el_dp = el_search_date.siblings('.kc-datepicker');
            var v = stripTags(el_search_date.find('.kc-label').html());
            el_dp.addClass('active').find('.kc-mobile-header .kc-title').text(v);
        }
    });

    if(!isMobile()) {
        _el.body.tooltip({
            selector: 'td[title]'
        });
    }


    _el.body.on('click', '.kc-dropdown .kc-options button', function(e) {
        e.stopPropagation();
        e.preventDefault();

        var t = $(this);
        var p = t.parents('.kc-dropdown');
        var v = t.html();
        console.log(t);
        // close dropdown on select
        closeAllElements();

        kcSetDropdown.call(p[0], v);

        if(p.hasClass('kc-search-time')) {
            var _t = p.hasClass('kc-search-start-time') ? 'start' : 'end';
            $('.kc-sum-'+ _t +'-time').html(v);
            kc_dates[_t+'_time'] = v;
            // Baslangic saati secildiginde, bitis saati secilmemis ise baslangic ile bitis saatini ayni yap.
            if(_t == 'start' && !kc_dates.end_time) {
                kcSetDropdown.call($('.kc-search-end-time')[0], v);
                kc_dates['end_time'] = v;
            }
        }

        if(p.attr('class').indexOf('kc-search') !== -1 && (!kc_dates.start_date || !kc_dates.end_date)) {
            if(p.hasClass('kc-search-start-point') && !$('.kc-search-end-point').is(':hidden')) {
                $('.kc-search-end-point .kc-value').trigger('click');
            } else {
                _el.calendar.parents('.kc-datepicker').addClass('active');
            }
        }
    });

    _el.body.on('mouseover', '.ui-datepicker .ui-datepicker-calendar tbody tr td a', function() {
        var l = 0;
        var p = $(this).parent();
        var d = new Date( p.data('year'), p.data('month'), $(this).html() );

        if(!kc_dates.start_date || kc_dates.end_date || isMobile()) {
            return;
        }

        _el.calendar.find("td").removeClass("selected-day end-day");
        while(d > kc_dates.start_date) {
            var o = [d.getFullYear(), d.getMonth(), d.getDate()];
            $('td[data-year="' + o[0] + '"][data-month="' + o[1] + '"][data-day="' + o[2] + '"]').addClass(1 == ++l ? "end-day" : "selected-day");
            d.setDate(d.getDate() - 1);
        }
    });

    _el.body.on('click', '.kc-mobile-header .kc-close', function(e) {
        e.stopPropagation();
        closeAllElements();
    });

});


