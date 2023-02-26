<section class="footers position-relative">
    <div class="auto-container">
        <div class="col-12">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="footers-logo"><img src="{{url('storage/'.$data['static']["logo"].'') }}" alt="World" style="    width: 200px;"></div>
                    <div class="footers-info mt-3"><p>{{__('footer_value')}}</p></div>
                    <h5>{{__('newsletter')}}</h5>
                    <form id="newsletter_form" action="#">
                        <div class="form-group">
                            <input type="email" name="email" id="newsletter_input" class="form-control position-relative newspaper-input" placeholder="{{__('abonetext')}}" required/>
                            <button type="submit" id="newsletter_btn" style="background-color: #102a70; border-color: #102a70;" class="btn btn-primary position-absolute newspaper-btn">{{__('abone')}}</i> </button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-6">
                    <h5>{{__('services')}} </h5>
                    <ul class="list-unstyled">
                        @foreach($data["static"]["services"] as $itemd)
                            <li><a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-6">
                    <h5>{{__('informations')}} </h5>
                    <ul class="list-unstyled">
                        @foreach($data["static"]["terms"] as $itemd)
                            <li>
                                <a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}"
                                   title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                        @endforeach
                        <li><a href="/{{app()->getLocale()}}/{{__('contact_url')}}"
                               title="{{__('contact')}}">{{__('contact')}}</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <h5>{{__('footer_contact')}} </h5>
                    <ul class="list-unstyled">
                        <li><a href="#" title="Rent A Car"><i class="fa fa-map-marker mr-2"></i> {{$data['static']["address1"]}}</a></li>
                        <li><a href="tel:{{$data['static']["850"]}}" title="Rent A Car"><i class="fa fa-mobile mr-2"></i>{{$data['static']["850"]}}</a></li>
                        <li><a href="https://api.whatsapp.com/send?phone={{$data['static']["phone1"]}}&text={{__('whatsapptext')}}" title="{{__('rentacar')}}"><i class="fa fa-whatsapp mr-2"></i>{{$data['static']["phone1"]}}</a></li>
                        <li><a href="mailto:{{$data['static']["email"]}}" title="{{__('rentacar')}}"><i class="fa fa-envelope mr-2"></i>{{$data['static']["email"]}}</a></li>
                    </ul>
                    <div class="social-icons">
                        <a title="World Facebook" target="_blank" href="https://www.facebook.com/worldcarrentals/" data-toggle="tooltip" data-original-title="World Facebook" rel="nofollow" style="background-color:#3b5998 !important;">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a title="World Instagram" target="_blank" href="https://www.instagram.com/worldcarrentals" data-toggle="tooltip" rel="nofollow" data-original-title="World Instagram" style="background-color:#c32aa3 !important;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a title="World Car Youttube" target="_blank" href="https://www.youtube.com/channel/UCgRjflgcjAwdFol1RHaNHhQ" data-toggle="tooltip" rel="nofollow" data-original-title="World Youtube" style="background-color:#f21d1d  !important;">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="auto-container">
        <div class="col-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{__('tapTitle1')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('tapTitle2')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{__('tapTitle3')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-langs-tab" data-toggle="pill" href="#pills-langs" role="tab" aria-controls="pills-langs" aria-selected="false">{{__('languages')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-airports-tab" data-toggle="pill" href="#pills-airports" role="tab" aria-controls="pills-airports" aria-selected="false">{{__('tapTitle4')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-locations-tab" data-toggle="pill" href="#pills-locations" role="tab" aria-controls="pills-locations" aria-selected="false">{{__('tapTitle5')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-motorsiklet-tab" data-toggle="pill" href="#pills-motorsiklet" role="tab" aria-controls="pills-motorsiklet" aria-selected="false">{{__('tapTitle6')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-bisiklet-tab" data-toggle="pill" href="#pills-bisiklet" role="tab" aria-controls="pills-bisiklet" aria-selected="false">{{__('tapTitle7')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <ul class="buttom-menu"><li><a class="white-text" href="/arac-kiralama/istanbul-havalimani/" title="İstanbul Havalimanı Araç Kiralama (IST)"> » İstanbul Havalimanı Araç Kiralama (IST)</a></li><li><a class="white-text" href="/arac-kiralama/sabiha-gokcen-havalimani/" title="Sabiha Gökçen Havalimanı Araç Kiralama (SAW)"> » Sabiha Gökçen Havalimanı Araç Kiralama (SAW)</a></li><li><a class="white-text" href="/arac-kiralama/adnan-menderes-havalimani/" title="Adnan Menderes Havalimanı Araç Kiralama (ADB)"> » Adnan Menderes Havalimanı Araç Kiralama (ADB)</a></li><li><a class="white-text" href="/arac-kiralama/antalya-havalimani/" title="Antalya Havalimanı Araç Kiralama (AYT)"> » Antalya Havalimanı Araç Kiralama (AYT)</a></li><li><a class="white-text" href="/arac-kiralama/esenboga-havalimani/" title="Esenboğa Havalimanı Araç Kiralama (ESB)"> » Esenboğa Havalimanı Araç Kiralama (ESB)</a></li><li><a class="white-text" href="/arac-kiralama/sakirpasa-havalimani/" title="Şakirpaşa Havalimanı Araç Kiralama (ADA)"> » Şakirpaşa Havalimanı Araç Kiralama (ADA)</a></li><li><a class="white-text" href="/arac-kiralama/kayseri-havalimani/" title="Kayseri Havalimanı Araç Kiralama (ASR)"> » Kayseri Havalimanı Araç Kiralama (ASR)</a></li><li><a class="white-text" href="/arac-kiralama/milas-bodrum-havalimani/" title="Milas-Bodrum Havalimanı Araç Kiralama (BJV)"> » Milas-Bodrum Havalimanı Araç Kiralama (BJV)</a></li><li><a class="white-text" href="/arac-kiralama/diyarbakir-havalimani/" title="Diyarbakır Havalimanı Araç Kiralama (DIY)"> » Diyarbakır Havalimanı Araç Kiralama (DIY)</a></li><li><a class="white-text" href="/arac-kiralama/dalaman-havalimani/" title="Dalaman Havalimanı Araç Kiralama (DLM)"> » Dalaman Havalimanı Araç Kiralama (DLM)</a></li><li><a class="white-text" href="/arac-kiralama/gaziantep-havalimani/" title="Gaziantep Havalimanı Araç Kiralama (GZT)"> » Gaziantep Havalimanı Araç Kiralama (GZT)</a></li><li><a class="white-text" href="/arac-kiralama/hatay-havalimani/" title="Hatay Havalimanı Araç Kiralama (HTY)"> » Hatay Havalimanı Araç Kiralama (HTY)</a></li><li><a class="white-text" href="/arac-kiralama/konya-havalimani/" title="Konya Havalimanı Araç Kiralama (KYA)"> » Konya Havalimanı Araç Kiralama (KYA)</a></li><li><a class="white-text" href="/arac-kiralama/ordu-giresun-havalimani/" title="Ordu-Giresun Havalimanı Araç Kiralama (OGU)"> » Ordu-Giresun Havalimanı Araç Kiralama (OGU)</a></li><li><a class="white-text" href="/arac-kiralama/samsun-havalimani/" title="Samsun Havalimanı Araç Kiralama (SZF)"> » Samsun Havalimanı Araç Kiralama (SZF)</a></li><li><a class="white-text" href="/arac-kiralama/trabzon-havalimani/" title="Trabzon Havalimanı Araç Kiralama (TZX)"> » Trabzon Havalimanı Araç Kiralama (TZX)</a></li><li><a class="white-text" href="/arac-kiralama/van-havalimani/" title="Van Ferit Melen Havalimanı Araç Kiralama (VAN)"> » Van Ferit Melen Havalimanı Araç Kiralama (VAN)</a></li><li><a class="white-text" href="/arac-kiralama/bursa-yenisehir-havalimani/" title="Bursa Yenişehir Havalimanı Araç Kiralama (YEI)"> » Bursa Yenişehir Havalimanı Araç Kiralama (YEI)</a></li>                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="buttom-menu"><li> <a class="white-text" href="/arac-kiralama/antalya/" title="Antalya Araç Kiralama"> » Antalya Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/bodrum/" title="Bodrum Araç Kiralama"> » Bodrum Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/adana/" title="Adana Araç Kiralama"> » Adana Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/ankara/" title="Ankara Araç Kiralama"> » Ankara Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/istanbul-anadolu/" title="İstanbul Anadolu Araç Kiralama"> » İstanbul Anadolu Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/istanbul-avrupa/" title="İstanbul Avrupa Araç Kiralama"> » İstanbul Avrupa Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/izmir/" title="İzmir Araç Kiralama"> » İzmir Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/hatay/" title="Hatay Araç Kiralama"> » Hatay Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/kayseri/" title="Kayseri Araç Kiralama"> » Kayseri Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/trabzon/" title="Trabzon Araç Kiralama"> » Trabzon Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/samsun/" title="Samsun Araç Kiralama"> » Samsun Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/diyarbakir/" title="Diyarbakır Araç Kiralama"> » Diyarbakır Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/dalaman/" title="Dalaman Araç Kiralama"> » Dalaman Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/konya/" title="Konya Araç Kiralama"> » Konya Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/gaziantep/" title="Gaziantep Araç Kiralama"> » Gaziantep Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/bursa/" title="Bursa Araç Kiralama"> » Bursa Araç Kiralama</a></li><li> <a class="white-text" href="/arac-kiralama/van/" title="Van Araç Kiralama"> » Van Araç Kiralama</a></li><li> <a class="white-text" href="/istanbul-arac-kiralama/" title="İstanbul Araç Kiralama"> » İstanbul Araç Kiralama</a></li>                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <ul class="buttom-menu"><li><a class="white-text" href="/arac-kiralama/dizel-araclar/" title="Dizel Araçlar Araç Kiralama"> » Dizel Araçlar Araç Kiralama</a></li><li><a class="white-text" href="/arac-kiralama/benzinli-araclar/" title="Benzinli Araçlar Araç Kiralama"> » Benzinli Araçlar Araç Kiralama</a></li><li><a class="white-text" href="/arac-kiralama/manuel-araclar/" title="Manuel Araçlar Araç Kiralama"> » Manuel Araçlar Araç Kiralama</a></li><li><a class="white-text" href="/arac-kiralama/otomatik-araclar/" title="Otomatik Araçlar Araç Kiralama"> » Otomatik Araçlar Araç Kiralama</a></li>                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-langs" role="tabpanel" aria-labelledby="pills-langs-tab">
                    <ul class="buttom-menu">
                        <li class="dillistesi"><a href="/tr" title="Araç kiralama"> <img
                                    src="https://worldcarrental.com/public/view/images/flags/tr.png" style="width:25px;"
                                    alt="Araç Kiralama için Tıklayın"> <span>Araç kiralama</span> </a></li>
                        <li class="dillistesi"><a href="/en" title="Car Rental"> <img
                                    src="https://worldcarrental.com/public/view/images/flags/en.png" style="width:25px;"
                                    alt="Click for Car Rental"> <span>Car Rental</span> </a></li>
                        <li class="dillistesi"><a href="/de" title="Auto Vermietung"> <img
                                    src="https://worldcarrental.com/public/view/images/flags/de.png" style="width:25px;"
                                    alt="Klicken Sie für Autovermietung"> <span>Auto Vermietung</span> </a></li>
                        <li class="dillistesi"><a href="/ru" title="Аренда автомобилей"> <img
                                    src="https://worldcarrental.com/public/view/images/flags/ru.png" style="width:25px;"
                                    alt="Нажмите для проката автомобилей"> <span>Аренда автомобилей</span> </a></li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-airports" role="tabpanel" aria-labelledby="pills-airports-tab">
                    <ul class="buttom-menu"><li><a class="white-text" href="/aylik-kiralama/istanbul-havalimani/" title="İstanbul Havalimanı Aylık Araç Kiralama (IST)"> » İstanbul Havalimanı Aylık Araç Kiralama (IST)</a></li><li><a class="white-text" href="/aylik-kiralama/sabiha-gokcen-havalimani/" title="Sabiha Gökçen Havalimanı Aylık Araç Kiralama (SAW)"> » Sabiha Gökçen Havalimanı Aylık Araç Kiralama (SAW)</a></li><li><a class="white-text" href="/aylik-kiralama/adnan-menderes-havalimani/" title="Adnan Menderes Havalimanı Aylık Araç Kiralama (ADB)"> » Adnan Menderes Havalimanı Aylık Araç Kiralama (ADB)</a></li><li><a class="white-text" href="/aylik-kiralama/antalya-havalimani/" title="Antalya Havalimanı Aylık Araç Kiralama (AYT)"> » Antalya Havalimanı Aylık Araç Kiralama (AYT)</a></li><li><a class="white-text" href="/aylik-kiralama/esenboga-havalimani/" title="Esenboğa Havalimanı Aylık Araç Kiralama (ESB)"> » Esenboğa Havalimanı Aylık Araç Kiralama (ESB)</a></li><li><a class="white-text" href="/aylik-kiralama/sakirpasa-havalimani/" title="Şakirpaşa Havalimanı Aylık Araç Kiralama (ADA)"> » Şakirpaşa Havalimanı Aylık Araç Kiralama (ADA)</a></li><li><a class="white-text" href="/aylik-kiralama/kayseri-havalimani/" title="Kayseri Havalimanı Aylık Araç Kiralama (ASR)"> » Kayseri Havalimanı Aylık Araç Kiralama (ASR)</a></li><li><a class="white-text" href="/aylik-kiralama/milas-bodrum-havalimani/" title="Milas-Bodrum Havalimanı Aylık Araç Kiralama (BJV)"> » Milas-Bodrum Havalimanı Aylık Araç Kiralama (BJV)</a></li><li><a class="white-text" href="/aylik-kiralama/diyarbakir-havalimani/" title="Diyarbakır Havalimanı Aylık Araç Kiralama (DIY)"> » Diyarbakır Havalimanı Aylık Araç Kiralama (DIY)</a></li><li><a class="white-text" href="/aylik-kiralama/dalaman-havalimani/" title="Dalaman Havalimanı Aylık Araç Kiralama (DLM)"> » Dalaman Havalimanı Aylık Araç Kiralama (DLM)</a></li><li><a class="white-text" href="/aylik-kiralama/denizli-cardak-havalimani/" title="Denizli Çardak Havalimanı Aylık Araç Kiralama (DNZ)"> » Denizli Çardak Havalimanı Aylık Araç Kiralama (DNZ)</a></li><li><a class="white-text" href="/aylik-kiralama/gazipasa-havalimani/" title="Gazipaşa Havalimanı Aylık Araç Kiralama (GZP)"> » Gazipaşa Havalimanı Aylık Araç Kiralama (GZP)</a></li><li><a class="white-text" href="/aylik-kiralama/gaziantep-havalimani/" title="Gaziantep Havalimanı Aylık Araç Kiralama (GZT)"> » Gaziantep Havalimanı Aylık Araç Kiralama (GZT)</a></li><li><a class="white-text" href="/aylik-kiralama/hatay-havalimani/" title="Hatay Havalimanı Aylık Araç Kiralama (HTY)"> » Hatay Havalimanı Aylık Araç Kiralama (HTY)</a></li><li><a class="white-text" href="/aylik-kiralama/konya-havalimani/" title="Konya Havalimanı Aylık Araç Kiralama (KYA)"> » Konya Havalimanı Aylık Araç Kiralama (KYA)</a></li><li><a class="white-text" href="/aylik-kiralama/ordu-giresun-havalimani/" title="Ordu-Giresun Havalimanı Aylık Araç Kiralama (OGU)"> » Ordu-Giresun Havalimanı Aylık Araç Kiralama (OGU)</a></li><li><a class="white-text" href="/aylik-kiralama/samsun-havalimani/" title="Samsun Havalimanı Aylık Araç Kiralama (SZF)"> » Samsun Havalimanı Aylık Araç Kiralama (SZF)</a></li><li><a class="white-text" href="/aylik-kiralama/trabzon-havalimani/" title="Trabzon Havalimanı Aylık Araç Kiralama (TZX)"> » Trabzon Havalimanı Aylık Araç Kiralama (TZX)</a></li><li><a class="white-text" href="/aylik-kiralama/van-ferit-melen-havalimani/" title="Van Ferit Melen Havalimanı Aylık Araç Kiralama (VAN)"> » Van Ferit Melen Havalimanı Aylık Araç Kiralama (VAN)</a></li><li><a class="white-text" href="/aylik-kiralama/bursa-yenisehir-havalimani/" title="Bursa Yenişehir Havalimanı Aylık Araç Kiralama (YEI)"> » Bursa Yenişehir Havalimanı Aylık Araç Kiralama (YEI)</a></li>                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-locations" role="tabpanel" aria-labelledby="pills-locations-tab">
                    <ul class="buttom-menu"><li> <a class="white-text" href="/aylik-kiralama/antalya/" title="Antalya Aylık Araç Kiralama"> » Antalya Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/bodrum/" title="Bodrum Aylık Araç Kiralama"> » Bodrum Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/adana/" title="Adana Aylık Araç Kiralama"> » Adana Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/ankara/" title="Ankara Aylık Araç Kiralama"> » Ankara Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/istanbul-anadolu/" title="İstanbul Anadolu Aylık Araç Kiralama"> » İstanbul Anadolu Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/istanbul-avrupa/" title="İstanbul Avrupa Aylık Araç Kiralama"> » İstanbul Avrupa Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/izmir/" title="İzmir Aylık Araç Kiralama"> » İzmir Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/hatay/" title="Hatay Aylık Araç Kiralama"> » Hatay Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/kayseri/" title="Kayseri Aylık Araç Kiralama"> » Kayseri Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/trabzon/" title="Trabzon Aylık Araç Kiralama"> » Trabzon Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/samsun/" title="Samsun Aylık Araç Kiralama"> » Samsun Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/diyarbakir/" title="Diyarbakır Aylık Araç Kiralama"> » Diyarbakır Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/dalaman/" title="Dalaman Aylık Araç Kiralama"> » Dalaman Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/konya/" title="Konya Aylık Araç Kiralama"> » Konya Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/gaziantep/" title="Gaziantep Aylık Araç Kiralama"> » Gaziantep Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/bursa/" title="Bursa Aylık Araç Kiralama"> » Bursa Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/aylik-kiralama/van/" title="Van Aylık Araç Kiralama"> » Van Aylık Araç Kiralama</a></li><li> <a class="white-text" href="/istanbul-arac-kiralama/" title="İstanbul Araç Kiralama"> » İstanbul Araç Kiralama</a></li>                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-motorsiklet" role="tabpanel" aria-labelledby="pills-motorsiklet-tab">
                    <ul class="buttom-menu"><li> <a class="white-text" href="/karavan-kiralama/antalya/" title="Antalya Karavan Kiralama"> » Antalya Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/bodrum/" title="Bodrum Karavan Kiralama"> » Bodrum Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/adana/" title="Adana Karavan Kiralama"> » Adana Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/ankara/" title="Ankara Karavan Kiralama"> » Ankara Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/istanbul-anadolu/" title="İstanbul Anadolu Karavan Kiralama"> » İstanbul Anadolu Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/istanbul-avrupa/" title="İstanbul Avrupa Karavan Kiralama"> » İstanbul Avrupa Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/izmir/" title="İzmir Karavan Kiralama"> » İzmir Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/hatay/" title="Hatay Karavan Kiralama"> » Hatay Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/kayseri/" title="Kayseri Karavan Kiralama"> » Kayseri Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/trabzon/" title="Trabzon Karavan Kiralama"> » Trabzon Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/samsun/" title="Samsun Karavan Kiralama"> » Samsun Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/diyarbakir/" title="Diyarbakır Karavan Kiralama"> » Diyarbakır Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/dalaman/" title="Dalaman Karavan Kiralama"> » Dalaman Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/konya/" title="Konya Karavan Kiralama"> » Konya Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/gaziantep/" title="Gaziantep Karavan Kiralama"> » Gaziantep Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/bursa/" title="Bursa Karavan Kiralama"> » Bursa Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/van/" title="Van Karavan Kiralama"> » Van Karavan Kiralama</a></li></ul>
                </div>
                <div class="tab-pane fade" id="pills-bisiklet" role="tabpanel" aria-labelledby="pills-bisiklet-tab">
                    <ul class="buttom-menu"><li> <a class="white-text" href="/karavan-kiralama/antalya/" title="Antalya Karavan Kiralama"> » Antalya Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/bodrum/" title="Bodrum Karavan Kiralama"> » Bodrum Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/adana/" title="Adana Karavan Kiralama"> » Adana Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/ankara/" title="Ankara Karavan Kiralama"> » Ankara Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/istanbul-anadolu/" title="İstanbul Anadolu Karavan Kiralama"> » İstanbul Anadolu Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/istanbul-avrupa/" title="İstanbul Avrupa Karavan Kiralama"> » İstanbul Avrupa Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/izmir/" title="İzmir Karavan Kiralama"> » İzmir Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/hatay/" title="Hatay Karavan Kiralama"> » Hatay Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/kayseri/" title="Kayseri Karavan Kiralama"> » Kayseri Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/trabzon/" title="Trabzon Karavan Kiralama"> » Trabzon Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/samsun/" title="Samsun Karavan Kiralama"> » Samsun Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/diyarbakir/" title="Diyarbakır Karavan Kiralama"> » Diyarbakır Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/dalaman/" title="Dalaman Karavan Kiralama"> » Dalaman Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/konya/" title="Konya Karavan Kiralama"> » Konya Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/gaziantep/" title="Gaziantep Karavan Kiralama"> » Gaziantep Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/bursa/" title="Bursa Karavan Kiralama"> » Bursa Karavan Kiralama</a></li><li> <a class="white-text" href="/karavan-kiralama/van/" title="Van Karavan Kiralama"> » Van Karavan Kiralama</a></li></ul>
                </div>
            </div>
        </div>
    </div>
</section>