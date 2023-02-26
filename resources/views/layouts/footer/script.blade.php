<link href="{{asset('public/view/select/css/style.css') }}" rel="stylesheet"/>
<script type="text/javascript" src="{{asset('public/view/js/phoneMask.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('public/view/js/date.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('public/view/js/home.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/view/js/spinner.js') }}"></script>
<script type="text/javascript">
    $('#recipeCarousel').carousel({});
    $('.carousel').on('slide.bs.carousel', function (e) {
        let $e = $(e.relatedTarget),
            itemsPerSlide = 3,
            totalItems = $('.carousel-item', this).length,
            $itemsContainer = $('.carousel-inner', this),
            it = itemsPerSlide - (totalItems - $e.index());
        if (it > 0) {
            for (var i = 0; i < it; i++) {
                $('.carousel-item', this).eq(e.direction == "left" ? i : 0).
                    // append slides to the end/beginning
                    appendTo($itemsContainer);
            }
        }
    });
    $('.more-text p.morehide').hide();

    function more() {
        $('.more-text p').removeClass('morehide').show();
        $('.more-text button.more').hide('fast');
    }
</script>

<link rel="stylesheet" href="{{asset('public/view/tobii/tobii.css') }}">
<script src="{{asset('public/view/tobii/tobii.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.11/dist/plugins/rangePlugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.11/dist/plugins/confirmDate/confirmDate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.11/dist/plugins/momentPlugin.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/tr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
@php
    use App\Models\Ekstra;$ekstra = Ekstra::all()
@endphp
<script>
    $("body").on('click', 'a.lightbox', function (e) {
        //e.preventdefault()
    })
    @foreach($ekstra as $item)
    $('.{{$item->input_name}}').spinner({value: 0, max: {{$item->value}}, min: 0})
    @endforeach

    var $btns = $('.categoryButton').click(function () {
        if (this.id == 'category_all') {
            $('#ListeId > div').show();
        } else {
            var $el = $('.' + this.id).show();
            $('#ListeId .accordion > div').not($el).hide();
            if ($el.length == 0) {
                $("#categoryNonBox").show();
            } else {
                $("#categoryNonBox").hide();
            }
        }
        $btns.removeClass('active');
        $(this).addClass('active');
    })

    var $btns = $('.transmissionButton').click(function () {
        var $el = $('.' + this.id).show();
        $('#ListeId .accordion > div').not($el).hide();
        if ($el.length == 0) {
            $("#categoryNonBox").show();
        } else {
            $("#categoryNonBox").hide();
        }
        $btns.removeClass('active');
        $(this).addClass('active');
    })

    $('nav#up .button').click(function () {
        $('nav#up .button span').toggleClass("rotate");
        $('ul#menu0').toggleClass("ulMenuDisplayNone");
    });

    $('nav#up ul li').click(function () {
        $('#menu_parent0').addClass("ulMenuDisplayNone");
    });

    $('.ulMenuDisplayNone').on("click", "li", function () {
        $(this + " > .#menu_parent0").addClass("ulMenuDisplayNone");
    });


    $('nav#downNav .button').click(function () {
        $('nav#up .button span').toggleClass("rotate");
        $('ul#menu1').toggleClass("ulMenuDisplayNone");
    });

    $('nav#downNav ul li').click(function () {
        $('#menu_parent1').addClass("ulMenuDisplayNone");
    });
</script>
<script src="{{ asset('public/view/js/ks.js') }}"></script>
<!--  Modal content for the above example -->
<?php if(!Auth::guard('web')->check()){ ?>
<div class="modal fade login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="isLogin" method="post" ng-submit="isLogin()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ _('Login') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="example-text-email"
                                   class="col-sm-12 col-form-label">{{ __('E-Mail Address') }}</label>
                            <input class="form-control" type="text" name="email" id="example-text-email"
                                   placeholder="{{ __('E-Mail Address') }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="example-text-password"
                                   class="col-sm-12 col-form-label">{{ __('Password') }}</label>
                            <input class="form-control" type="password" name="password" id="example-text-password"
                                   placeholder="*******" required>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember_me" class="form-check-input"
                                               id="exampleCheck1">
                                        <label class="form-check-label"
                                               for="exampleCheck1">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-right"><a href="#" id="closelogin" data-toggle="modal"
                                                             data-target=".fogetpassword"
                                                             class="blue-text">{{ __('Forgot Your Password?') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div style="margin:10px 0;" class="col-md-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="width: 100%;">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-md-12">
                            <div class="or">
                                <span>{{ __('or') }}</span>
                            </div>
                        </div>
                        <!--div class="col-sm-6">
                            <a class="btn btn-facebook btn-block" href="{{ url('auth/facebook') }}">
                                <i class="fa fa-facebook"></i>
                                {{__('Facebook ile Giriş Yap')}}
                            </a>
                        </div -->
                        <div class="col-sm-12">
                            <a class="btn btn-google btn-block" href="{{ url('auth/google') }}">
                                <i class="fa fa-google"></i>
                                {{__('Google ile Giriş Yap')}}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<div class="modal fade fogetpassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="isForget" action="/forgetpassword" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ __('Forgot Your Password?') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="example-text-email"
                                   class="col-sm-12 col-form-label">{{ __('E-Mail Address') }}</label>
                            <input class="form-control" type="text" name="email" id="example-text-email"
                                   placeholder="E-posta" required>
                        </div>
                        <div style="margin:10px 0;" class="col-md-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="width: 100%;">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(".kc-group").removeClass("active");
    // Search Block Toggle ul list
    $(".kc-heading").on("click", function () {
        var id = $(this).attr("id");
        $(this).parent(".kc-group").toggleClass("active");
        $(".kc-group").not("#" + id).removeClass("active");
    });
    $('body').on('click', function () {
    })

    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) {
                $('#scollbutton').fadeIn();
            } else {
                $('#scollbutton').fadeOut();
            }
        });
        $('#scollbutton').click(function () {
            $("html, body").animate({scrollTop: 0}, 500);
            window.scrollTo(xCoord, yCoord);
            // return false;
        });

        $('#mainButtoonScrrollPanelsss').click(function () {
            $("#mainDivScrrollPanel").animate({height: 980}, 200);
        });

        $('.scrollBar').on('click', 'a', function () {
            $('.scrollBar a').removeClass('active');
            $(this).addClass('active');
        });
    });
    // <button class="btn btn-outline-primary waves-effect waves-light" type="button" data-toggle="modal" data-target=".login"><i class="fas fa-plus"></i></button>
</script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.css"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>
<script>
    window.addEventListener("load", function () {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#666666"
                },
                "button": {
                    "background": "#fff",
                    "text": "#000000"
                }
            },
            "theme": "classic",
            "content": {
                "message": "{{__('cerez')}}",
                "dismiss": "{{__('ok')}}",
                "link": "{{__('href_text')}}",
                "href": "{!! __('href') !!}"
            }
        })
    });
</script>

<script type="text/javascript">
    let messages = {
        welcome: "Welcome",
        error: "Something bad happend. Please refresh page",
        error_connection: "Connection is lost. Please check internet connection",
        cookie_policy: '{{__('cerez')}}',
    };
    let dates = {
        <?php if(app()->getLocale() == "tr"){ ?>
        day: {
            0: "Pazar",
            1: "Pazartesi",
            2: "Salı",
            3: "Çarşamba",
            4: "Perşembe",
            5: "Cuma",
            6: "Cumartesi",
            s0: "Paz",
            s1: "Pzt",
            s2: "Sal",
            s3: "Çar",
            s4: "Per",
            s5: "Cum",
            s6: "Cmt"
        },
        month: {
            0: "Ocak",
            1: "Şubat",
            2: "Mart",
            3: "Nisan",
            4: "Mayıs",
            5: "Haziran",
            6: "Temmuz",
            7: "Ağustos",
            8: "Eylül",
            9: "Ekim",
            10: "Kasım",
            11: "Aralık",
            s0: "Oca",
            s1: "Şub",
            s2: "Mar",
            s3: "Nis",
            s4: "May",
            s5: "Haz",
            s6: "Tem",
            s7: "Ağu",
            s8: "Eyl",
            s9: "Eki",
            s10: "Kas",
            s11: "Ara"
        }
        <?php }else{ ?>
        day: {
            0: "Sunday",
            1: "Monday",
            2: "Tuesday",
            3: "Wednesday",
            4: "Thursday",
            5: "Friday",
            6: "Saturday",
            s0: "Sun",
            s1: "Mon",
            s2: "Tue",
            s3: "Wed",
            s4: "Thu",
            s5: "Fri",
            s6: "Sat"
        },
        month: {
            0: "January",
            1: "February",
            2: "March ",
            3: "April",
            4: "May",
            5: "June",
            6: "July",
            7: "August ",
            8: "September",
            9: "October",
            10: "November",
            11: "December ",
            s0: "Jan",
            s1: "Feb",
            s2: "Mar",
            s3: "Apr",
            s4: "May",
            s5: "Jun",
            s6: "Jul",
            s7: "Aug",
            s8: "Sep",
            s9: "Oct",
            s10: "Nov",
            s11: "Dec"
        }
        <?php } ?>
    };
    let dateFormatDashes = 'YYYY-MM-DD';
    let dateFormat = 'YYYYMMDD';
    let calendar = flatpickr("#from", {
        dateFormat: "Y-m-d",
        allowInput: true,
        locale: {
            <?php if(app()->getLocale() == "tr"){  ?>
            weekdays: {
                longhand: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                shorthand: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
            },
            months: {
                longhand: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                shorthand: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara']
            },
            today: 'Bugün',
            clear: 'Temizle'
            <?php }else if(app()->getLocale() == "de"){ ?>
            weekdays: {
                longhand: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
                shorthand: ['Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam']
            },
            months: {
                longhand: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
                shorthand: ['Jan', 'Feb', 'Mär', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Dez']
            },
            today: 'Heute',
            clear: 'Reinigen'
            <?php }else if(app()->getLocale() == "ru"){ ?>
            weekdays: {
                longhand: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
                shorthand: ['BC', 'Пн', 'Вт', 'Ср', 'Че', 'Пя', 'Су']
            },
            months: {
                longhand: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                shorthand: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
            },
            today: 'Сегодня',
            clear: 'Чистый'
            <?php }else{ ?>
            weekdays: {
                longhand: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                shorthand: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            },
            months: {
                longhand: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Dec']
            },
            today: 'Today',
            clear: 'Clear'
            <?php } ?>
        },
        minDate: new Date().fp_incr(0), theme: "dark",
        showAlways: false,
        disableMobile: deviceCheck(),//enableTime: true,time_24hr: true,
        inline: false,
        minuteIncrement: 30,
        static: true,/**/
        onChange: function (selectedDates, dateStr, instance) {
            let selectedDateInput = selectedDates.map(date => this.formatDate(date, 'Y-m-d'));
            $("input[name=cikis_tarihi_submit]").val(selectedDateInput);
            let selectedDate = selectedDates.map(date => this.formatDate(date, "l"));
            $("#cikis_timer .date-detail span.day").text(selectedDate);
            let selectedMonth = selectedDates.map(date => this.formatDate(date, "F"));
            $("#cikis_timer .date-detail span.month").text(selectedMonth);
            let selectedDay = selectedDates.map(date => this.formatDate(date, "d"));
            $("#cikis_timer div.date").text(selectedDay);
            let selectedHM = selectedDates.map(date => this.formatDate(date, 'H:i'));
            //$("#cikis_timer .date-detail span.time").text(selectedHM);
            //$("input[name=cikis_saati_submit]").val(selectedHM);

            $('.t1').trigger('click')
        }, onClose: function () {/*setTimeout(function(){calendar2.open();}, 0);*/
        }
    });

    let calendar2 = flatpickr("#to", {
        dateFormat: "Y-m-d",
        allowInput: true,
        locale: {
            <?php if(app()->getLocale() == "tr"){  ?>
            weekdays: {
                longhand: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                shorthand: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
            },
            months: {
                longhand: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                shorthand: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara']
            },
            today: 'Bugün',
            clear: 'Temizle'
            <?php }else if(app()->getLocale() == "de"){ ?>
            weekdays: {
                longhand: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
                shorthand: ['Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam']
            },
            months: {
                longhand: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
                shorthand: ['Jan', 'Feb', 'Mär', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Dez']
            },
            today: 'Heute',
            clear: 'Reinigen'
            <?php }else if(app()->getLocale() == "ru"){ ?>
            weekdays: {
                longhand: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
                shorthand: ['BC', 'Пн', 'Вт', 'Ср', 'Че', 'Пя', 'Су']
            },
            months: {
                longhand: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                shorthand: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
            },
            today: 'Сегодня',
            clear: 'Чистый'
            <?php }else{ ?>
            weekdays: {
                longhand: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                shorthand: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            },
            months: {
                longhand: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Dec']
            },
            today: 'Today',
            clear: 'Clear'
            <?php } ?>
        },
        minDate: new Date().fp_incr(2), theme: "dark",
        disableMobile: deviceCheck(),//enableTime: true,time_24hr: true,
        minuteIncrement: 30,
        static: true,
        onChange: function (selectedDates, dateStr, instance) {
            let selectedDateInput = selectedDates.map(date => this.formatDate(date, 'Y-m-d'));
            $("input[name=donus_tarihi_submit]").val(selectedDateInput);
            let selectedDate = selectedDates.map(date => this.formatDate(date, "l"));
            $("#donus_timer .date-detail span.day").text(selectedDate);
            let selectedMonth = selectedDates.map(date => this.formatDate(date, "F"));
            $("#donus_timer .date-detail span.month").text(selectedMonth);
            let selectedDay = selectedDates.map(date => this.formatDate(date, "d"));
            $("#donus_timer div.date").text(selectedDay);
            let selectedHM = selectedDates.map(date => this.formatDate(date, 'H:i'));
            //$("#donus_timer .date-detail span.time").text(selectedHM);
            //$("input[name=donus_saati_submit]").val(selectedHM);
            $('.t2').trigger('click')
        }
    });


    function deviceCheck() {
        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            return true;
        } else {
            return false;
        }
    }


    function openCalendar() {
        setTimeout(function () {
            calendar.open();
        }, 0);
        $("ul.time-list").removeClass("open");
    }

    function openCalendar2() {
        setTimeout(function () {
            calendar2.open();
        }, 0);
        $("ul.time-list").removeClass("open");
    }

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
        $.timer = {
            list: function (element, title) {
                var date = new Date();
                var hour = date.getHours();
                var html = '';
                html += '<div class="time-list">';
                html += '<span>' + title + '</span>';
                html += '<ul>';
                for (i = 0; i < 24; i++) {
                    if (i < 10) {
                        i = "0" + i
                    }
                    if (i == hour + 1) {
                        html += '<li class="selected"><a data-time="<b>' + i + '</b>:00" data-value="' + i + ':00"><b>' + i + '</b>:00</a></li>';
                    } else {
                        html += '<li><a data-time="<b>' + i + '</b>:00" data-value="' + i + ':00"><b>' + i + '</b>:00</a></li>';
                    }
                    html += '<li><a data-time="<b>' + i + '</b>:15" data-value="' + i + ':15"><b>' + i + '</b>:15</a></li>';
                    html += '<li><a data-time="<b>' + i + '</b>:30" data-value="' + i + ':30"><b>' + i + '</b>:30</a></li>';
                    html += '<li><a data-time="<b>' + i + '</b>:45" data-value="' + i + ':45"><b>' + i + '</b>:45</a></li>';
                }
                html += '</ul>';
                html += '</div>';
                $('.' + element).after(html);
            },

            click: function (element) {
                $('.' + element).on('click', function (e) {
                    $(".time-list ul").removeClass("open");
                    $('.' + element + " + .time-list").toggleClass("open");
                    $('.search-form-box1').append('<div class="blank"></div>');
                    $('html,body').css('overflow-y', 'hidden');
                    var jump = $('.' + element + " + .time-list ul li.selected");
                    var position = $(jump).position();
                    //$('ul.time-list').not(".time").removeClass("open");
                    var new_position = $(jump).offset();
                    $('.' + element + " + .time-list ul").scrollTop(position.top);//.animate({scrollTop: new_position}, 500, 'swing');
                    //alert($(jump).scrollTop() + " px");
                });
            },
            select: function (element) {
                $('.' + element + " + .time-list").on('click', 'a', function (e) {
                    let t = $(this).attr("data-time"), v = $(this).attr("data-value");
                    $('.time-list li').removeClass('selected')
                    $(this).parent().addClass('selected')
                    $('.' + element + ' span.time').html(t)
                    $('input#' + element).val(v)
                    $("ul.time-list").removeClass("open");
                    if (element == 't1') setTimeout(function () {
                        calendar2.open();
                    }, 0);
                    e.stopPropagation();
                });
            }
        }
        $.timer.list('t1', '{{__('Alış Saati')}}')
        $.timer.click('t1')
        $.timer.select('t1')
        $.timer.list('t2', '{{__('Dönüş Saati')}}')
        $.timer.click('t2')
        $.timer.select('t2')
    });
    $(document).mouseup(function (event) {
        var div = $(".date-detail");
        if (!div.is(event.target) && div.has(event.target).length === 0) {
            $('.blank').remove();
            $('html,body').css('overflow-y', 'auto');
            $(".time-list").removeClass("open");
        }
    });
</script>
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
    });
</script>
<script type="text/javascript">
    $(".avaible").attr("data-original-title", "Alış Tarihi Seçin");
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '/reloadcaptcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

    $('#closelogin').click(function () {
        $('.login').modal('hide');
    });
    $('.main-header li.dropdown').on("click", function (e) {
        $("ul.dropdownUL").removeClass("active");
        $(this).find("ul.dropdownUL").toggleClass("active");
    });
    $(window).scroll(function () {
        var sticky = $('.header'),
            scroll = $(window).scrollTop();

        if (scroll >= 28) {
            sticky.addClass('fixed');
        } else {
            sticky.removeClass('fixed');
        }
    });
</script>
<script>
    $(".kc-options").on("click", "#selectOne", function () {
        var id = $(this).attr("data-id");
        getDropLocation(id);
    });
    $("#pick_up_location").change(function () {
        var id = $(this).val();
        getDropLocation(id);
    });

    function getDropLocation(id) {
        $("#kc-options-parent").html('');
        if (id == "") {
            var id_location = 0;
        } else if (id == undefined) {
            var id_location = 0;
        } else {
            var id_location = id;
        }
        $.ajax({
            type: 'GET',
            url: '/getDropLocation?id=' + id_location + '&langId={{app()->getLocale()}}',
            success: function (data) {
                console.log(data);
                var row = "";
                var x = 0;
                $.each(data, function (key, value) {
                    if (value.id_parent == 0) {
                        row += '<li class="kc-group" id="down_' + value.id + '">' +
                            '<div class="kc-heading" id="down_' + value.id + '"><i class="fas fa-map-marker-alt"></i> ' + value.title + ' </div>' +
                            '<input style="display:none" type="checkbox" class="parentMenuBytn"  id="btn-' + value.id + '">';
                        row += '<ul class="menu_parent" id="menu_parent1">';
                        $.each(value.parentList, function (keys, values) {
                            row += '<li name="selectTwo" data-id="' + values.id + '" data-value="' + values.id + '">' +
                                '<button type="button">';
                            if (values.type == "hotel") {
                                row += '<i style="    margin: 2px 10px 0 0;" class="fas fa-hotel icon-large"></i>';
                            } else if (values.type == "airport") {
                                row += '<i style="    margin: 2px 10px 0 0;" class="fas fa-plane-departure icon-large"></i>';
                            } else if (values.type == "center") {
                                row += '<i style="    margin: 2px 10px 0 0;"  class="fas fa-map-marker-alt icon-large"></i>';
                            }
                            row += '' + values.title + '</button>';
                            row += '</li>';
                        });
                        row += '</ul>';
                        row += '</li>';
                    }
                    x++;
                });
                $("#kc-options-parent").append(row);
            }
        });
    }

    //Title Changer
    window.onload = function () {
        var pageTitle = document.title;
        var attentionMessage = '{{__('dontforgetme')}}';
        var blinkEvent = null;
        document.addEventListener('visibilitychange', function (e) {
            var isPageActive = !document.hidden;
            if (!isPageActive) {
                blink();
            } else {
                document.title = pageTitle;
                clearInterval(blinkEvent);
            }
        });

        function blink() {
            blinkEvent = setInterval(function () {
                if (document.title === attentionMessage) {
                    document.title = pageTitle;
                } else {
                    document.title = attentionMessage;
                }
            }, 100);
        }
    };


</script>
<?php if(Session::has('message')){ ?>
<script>
    swal('{{session('message')}}');
</script>
<?php session()->forget('message'); } ?>
