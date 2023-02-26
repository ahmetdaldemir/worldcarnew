<?php use App\Models\Reservation; ?>

<section class="header header-inner-bg  main-header header-style-one">
    <div class="header-lower">
        <div class="main-menu">
            <div class="nav-outer clearfixa">
                <!-- Main Menu -->
                <nav class="row auto-container">
                    <div class="col-5 col-md-3">
                        <div class="logo text-center text-lg-left text-md-left far fa-registered"><a title="{{__('header_logo_title')}}" alt="{{__('header_logo_alt')}}" href="/{{app()->getLocale()}}">
                                <img src="{{asset('storage/'.$data['static']["logo"].'') }}" title="{{__('header_logo_title')}}" alt="{{__('header_logo_alt')}}"></a>
							<?php if(url()->current() == 'https://worldcarrental.com/tr'){  ?>
                            <h1 style="text-indent:-999;position: absolute;">WorldCarRental Araç Kiralama</h1>
                            <?php } ?>
                        </div>
                    </div>
                    <ul class="col-7 col-md-9">
                        <!--Social Links-->
                        <div class="social-links d-none ">
                            <a href="https://www.facebook.com/worldcarrentals"  rel="nofollow"><span class="fa fa-facebook-f"></span></a>
                            <a href="https://www.youtube.com/channel/UCgRjflgcjAwdFol1RHaNHhQ"  rel="nofollow"> <span
                                    class="fa fa-youtube"></span></a>
                            <a href="https://www.instagram.com/worldcarrentals/"  rel="nofollow"><span class="fa fa-instagram"></span></a>
                        </div>
                        <a href="mailto:{{$data['static']["email"]}}" title="Rent A Car" class="btn d-none">
                            <i class="fa fa-envelope mr-2"></i>
                        </a>
                        <ul class="nav d-none d-md-block" style="float:right;">
                            <a href="tel:{{$data['static']["850"]}}" title="Rent A Car" class="btn d-none d-md-block top-phone">
                                <i class="fa fa-headphones  mr-2"></i>
                                <span class="d-none d-xl-inline-block" style="font-size:11px">{{__('support')}}<br><b style="font-size:18px">{{$data['static']["850"]}}</b></span>
                            </a>
                            <?php   if(!Auth::guard('web')->check()){ ?>
                            <li class="nav-item">
                                <a class="nav-link logins" href="/{{app()->getLocale()}}" data-toggle="modal" data-target=".login" title="Rent A Car">
                                    <i class="fas fa-lock mr-2"></i><span class="d-none d-xl-inline-block">{{__('Login')}}</span>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle logins" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-lock mr-2"></i><span class="d-none d-xl-inline-block"> <?php echo Auth::guard('web')->user()->fullname; ?></span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/info">{{__('info')}}</a>
                                    <?php $reservation = Reservation::where('id_customer', Auth::guard('web')->id())->first(); ?>
                                    <?php if(!empty($reservation)){ ?>
                                    <a class="dropdown-item"href="/{{app()->getLocale()}}/profil/reservations">{{__('booking')}}</a>
{{--                                    <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/discount">{{__('discountm')}}</a>--}}
                                    <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/invitation">{{__('invitation')}}</a>
                                <!--<a class="dropdown-item" href="/{{app()->getLocale()}}/profil/call_center">{{__('callcenter')}}</a>-->
{{--                                    <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/anket">{{__('anket')}}</a>--}}
                                    <?php } ?>
                                    <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/logout">{{__('logout')}}</a>
                                </div>
                            </li>
                            <?php } ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle langs" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img alt="Rent A car" title="Rent A Car" src="{{ asset('public/view/images/flags/'.\App\Models\Language::where("url",app()->getLocale())->first()->flag.'') }}" width="24" class="mr-1">
                                    <span class="d-none">{{\App\Models\Language::where("url",app()->getLocale())->first()->short}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    @foreach($data['static']["languages"] as $item)
                                        <a title="{{__('language_text')}}" class="dropdown-item" href="/{{$item->url}}"><img alt="Rent A car" title="Rent A Car" src="{{ asset('public/view/images/flags/'.$item->flag.'') }}" width="24" class="mr-1">{{$item->short}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fa top-menu" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/{{app()->getLocale()}}">{{__('Anasayfa')}}</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">{{__('services')}}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($data["static"]["services"] as $itemd)
                                                <li><a class="dropdown-item" href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">{{__('informations')}}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($data["static"]["terms"] as $itemd)
                                                <li><a class="dropdown-item" href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="{{ route(__('blogs'), [app()->getLocale()])}}">{{__("all_blogs")}}</a></li>
                                    <li><a class="dropdown-item" href="/{{app()->getLocale()}}/{{__('contact_url')}}">{{__("contact")}}</a></li>
                                </ul>
                            </li>
                        </ul>
            </div>
            <div class="col-12" style="padding:0">
                <div class="navbar">
                    <div class="navbar-header">
                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="nav-item dropdown mlang">
                            <a class="nav-link dropdown-toggle langs" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img alt="Rent A car" title="Rent A Car" src="{{ asset('public/view/images/flags/'.\App\Models\Language::where("url",app()->getLocale())->first()->flag.'') }}" width="24" class="mr-1">
                                <span class="d-none">{{\App\Models\Language::where("url",app()->getLocale())->first()->short}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @foreach($data['static']["languages"] as $item)
                                    <a title="{{__('language_text')}}" class="dropdown-item" href="/{{$item->url}}"><img alt="{{$item->alt_text}}" title="{{$item->href_text}}" src="{{ asset('public/view/images/flags/'.$item->flag.'') }}" width="24" class="mr-1">{{$item->short}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-collapse collapse clearfixa d-lg-none">
                    <ul class="navigation clearfixa">
                        <li><a href="/{{app()->getLocale()}}">{{__('Anasayfa')}}</a></li>
                        <li><a href="/{{app()->getLocale()}}/{{__('kurumsal_url')}}/{{__('kurumsal_slug')}}">{{__('Kurumsal')}}</a></li>
                        <li class="dropdown"><a href="#">{{__('services')}}</a>
                            <ul class="dropdownUL">
                                @foreach($data["static"]["services"] as $itemd)
                                    <li><a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                                @endforeach
                            </ul>
                            <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                        </li>
                        <li class="dropdown"><a href="#">{{__('informations')}}</a>
                            <ul class="dropdownUL">
                                @foreach($data["static"]["terms"] as $itemd)
                                    <li><a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                                @endforeach
                            </ul>
                            <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                        </li>
                        <li><a href="{{ route(__('blogs'), [app()->getLocale()])}}">{{__("all_blogs")}}</a></li>
                        <li><a href="/{{app()->getLocale()}}/{{__('contact_url')}}">{{__("contact")}}</a></li>
                        <?php if(!Auth::guard('web')->check()){ ?>
                        <div class="nav-item mlogin">
                            <a class="nav-link logins" href="/{{app()->getLocale()}}"  data-toggle="modal" data-target=".login" title="Rent A Car">
                                <i class="fas fa-lock mr-2"></i><span>{{__('Login')}}</span>
                            </a>
                        </div>
                        <?php }else{ ?>
                        <div class="nav-item dropdown mlogin">
                            <a class="nav-link dropdown-toggle logins" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-2"></i><span class="d-none d-xl-inline-block"> <?php echo 'fullname';//echo Auth::user()->fullname; ?></span></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/info">{{__('info')}}</a>
                                <?php $reservation = Reservation::where('id_customer', Auth::id())->first(); ?>
                                <?php $reservation = Reservation::where('id_customer', Auth::guard('web')->id())->first(); ?>
                                <?php if($reservation){ ?>
                                <a class="dropdown-item"href="/{{app()->getLocale()}}/profil/reservations">{{__('booking')}}</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/discount">{{__('discountm')}}</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/invitation">{{__('invitation')}}</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/call_center">{{__('callcenter')}}</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/anket">{{__('anket')}}</a>
                                <?php } ?>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/profil/logout">{{__('logout')}}</a>
                            </div>
                        </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            </nav><!-- Main Menu End-->
        </div>
    </div>
    </div>
</section>
