@extends('layouts.admin')

@section('content')
    <?php
    use App\Models\Location;
    use App\Models\Reservation;
    use App\User;
    use App\Repository\Data;
    $data = new Data();
    $location = new Location();
    $user = new User();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$breadcrumbs}}</div>
                <div class="card-body">
                    <form id="searchlist" ng-submit="searchlist()" method="post" action="{{route('admin.admin.reservation.searchlist')}}">
                        @csrf
                        <div class="search active"
                             style="    padding: 10px;  border: 1px solid #ccc; margin: 10px 0;   width: 99%;   margin: 10px auto 10px 10px;">
                            <div class="col-md-12">
                                <div class="row">


                                    <div class="col-md-1">
                                        <div class="select table-count custom1">
                                            <label>Adet</label>
                                            <select name="pagination" class="form-control">
                                                <option
                                                    @if($request) {{ $request->pagination ==  "10"  ? 'selected' : '' }}     @endif value="10">
                                                    10
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "25"  ? 'selected' : '' }}     @endif value="25">
                                                    25
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "50"  ? 'selected' : '' }}     @endif value="50">
                                                    50
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "100" ? 'selected' : '' }}     @endif value="100">
                                                    100
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "1000" ? 'selected' : '' }}    @endif value="1000">
                                                    1000
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "10000" ? 'selected' : '' }}   @endif value="10000">
                                                    10000
                                                </option>
                                                <option
                                                    @if($request) {{ $request->pagination ==  "100000" ? 'selected' : '' }}  @endif value="100000">
                                                    100000
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="float:left">
                                        <label>PNR</label>
                                        <input name="pnr" class="form-control custom1 small"
                                               value="@if($request) {{$request->pnr}} @endif" placeholder="PNR" type="text">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6" style="display: grid">
                                        <label>Alış Tarihi</label>
                                        <input type="text" id="datepicker" name="start_date" class="form-control" value="@if($request) {{$request->start_date}}  @endif"/>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6" style="display: grid">
                                        <label>Dönüş Tarihi</label>
                                        <input type="text" id="datepicker" name="finish_date" value=" @if($request) {{$request->finish_date}} @else {{date('d-m-Y')}}  @endif" class="form-control"/>
                                    </div>
                                    <div class="col-md-2" style="float:left">
                                        <label>Rezervasyon Tarihi</label>
                                        <input type="text" id="datepicker_created_at" name="created_at"  value=" @if($request) {{$request->created_at}} @else {{date('d-m-Y')}}  @endif" class="form-control"/>
                                    </div>

                                    <div class="col-md-2" style="float:left">
                                        <label>Müşteri</label>
                                        <select name="customer" class="form-control">
                                            <option>Müşteri Seç</option>
                                            @foreach($customers as $item)
                                                <option @if($request)  @if($request->customer == $item->id) selected @endif  @endif value="{{$item->id}}">{{$item->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="margin: 30px 0 0 0 ;">
                                            <input style="width: 20px;height: 20px" type="checkbox" id="closed"  {{ request()->closed == 'on' ? 'checked' : '' }}   name="closed">
                                            <label for="closed">İptal/Silinen  dahil et</label>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Kategori</label>
                                        <div class="select custom1 small">
                                            <select name="category" class="form-control">
                                                <option value="">Hepsi</option>
                                                @foreach($categorys as $category)
                                                    <option @if($request) @if($request->category == $category->id) selected @endif @endif value="{{$category->id}}">
                                                        {{$category->language_admin()->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Vites</label>
                                        <div class="select custom1 small">
                                            <select name="transmission" class="form-control">
                                                <option value="">Hepsi</option>
                                                <option @if($request) @if($request->transmission =='Manuel') selected
                                                        @endif   @endif  value="Manuel">
                                                    Manuel
                                                </option>
                                                <option @if($request) @if($request->transmission =='Otomatik') selected
                                                        @endif  @endif    value="Otomatik">
                                                    Otomatik
                                                </option>
                                                <option @if($request) @if($request->transmission =='F1') selected
                                                        @endif   @endif   value="F1">
                                                    F1
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Durum</label>
                                        <div class="select custom1 small">
                                            <select value="{{old('status')}}" name="status" class="form-control">
                                                <option value="">Hepsi</option>
                                                <option
                                                    @if($request) @if($request->status =='waiting') selected
                                                    @endif  @endif   value="waiting">
                                                    Beklemede
                                                </option>
                                                <option
                                                    @if($request)  @if($request->status =='comfirm') selected
                                                    @endif @endif     value="comfirm">
                                                    Onaylandı
                                                </option>
                                                <option
                                                    @if($request) @if($request->status =='closed') selected
                                                    @endif  @endif    value="closed">
                                                    İptal Edildi
                                                </option>
                                                <option
                                                    @if($request)  @if($request->status =='complate') selected
                                                    @endif  @endif    value="complate">
                                                    Tamamlandı
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="float:left">
                                        <label>Plaka</label>
                                        <input name="plate" class="form-control custom1 small"
                                               value="@if($request) {{$request->plate}} @endif" placeholder="Plaka"
                                               type="text">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="city_id" class="text-12">Şehir</label>
                                        <select class="form-control" id="city_id" name="city_id"  onchange="$('#reservationdata').submit();">
                                            <option value="" selected="selected">Hepsi</option>
                                            @foreach ($locationView as $item){ ?>
                                            <option @if($request)  @if($request->city_id == $item->id) selected @endif  @endif  value="<?=$item->id?>"><?=$item->title?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6" style="display: grid">
                                        <label></label>
                                        <button
                                            style="   height: 35px; bottom: -10px;margin: 0;vertical-align: bottom;position: relative"
                                            type="submit" class=" custom2 btn btn-danger" name="button">Filtrele
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <div class="table-responsive" style="margin: 0 auto;">
                        <table class="table table-sm table-custom spacing8  table-gray-300 ">
                            <thead>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-12" scope="col">#</th>
                                <th class="text-12" scope="col">İnfo</th>
                                <th class="text-12" scope="col">PNR</th>
                                <th class="text-12" scope="col">Adı ve Soyadı</th>
                                <th class="text-12" scope="col">Araç - Plaka</th>
                                <th class="text-12" scope="col" style="    width: 130px;">Tarih Aralığı</th>
                                <th class="text-12" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-12" scope="col">Gün</th>
                                <th class="text-12" scope="col">Günlük</th>
                                <th class="text-12" scope="col">Kir. Fiyatı</th>
                                <th class="text-12" scope="col">Ekstra</th>
                                <th class="text-12" scope="col">Toplam</th>
                                <th class="text-12" scope="col">Kalan</th>
                                <th class="text-12" scope="col">Ödeme</th>
                                <th class="text-12" scope="col">Not</th>
                                <th class="text-12" scope="col">Personel</th>
                                <th class="text-12" scope="col">Durum</th>
                                <th class="text-12" scope="col">Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1; foreach($reservation as $item) { ?>

                            <tr>
                                <td style="vertical-align: middle" class="text-12">

                                    @if($item->email_send == 1)
                                        <?php
                                        $reservationlogresponse = $item->reservationLog->first();
                                        if ($reservationlogresponse) {
                                            $reservationlog = $user->find($reservationlogresponse->id_user)->name ?? "Bulunamadı";
                                        } else {
                                            $reservationlog = "Bulunamadı";
                                        }
                                        ?>
                                        <div style="background: #013473;text-align: center;color: #fff;"
                                             data-toggle="tooltip" data-placement="top"
                                             data-original-title="{{$reservationlog}}"> {{$i}}</div>
                                    @else
                                        <div>  {{$i}}</div>
                                    @endif
                                    <div style="    height: 1.1rem;" class="progress">
                                        <div data-toggle="tooltip" data-placement="top" title=""
                                             data-original-title="{{$item->getReservationStatus()}} / {{$item->created_at}}"
                                             class="progress-bar bg-{{$item->getReservationStatusClass()}}"
                                             role="progressbar" style="width: 100%" aria-valuenow="25"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>
                                    <a ng-click="getLogList({{$item->id}})" href="javascript:;"
                                       style="position: relative;top: 10px;"><i class="i-Information"></i></a>
                                </td>
                                <td class="text-12  font-weight-bold" style="vertical-align: middle">
                                        <span style="display: flex;">
                                            <a target="_blank"
                                               href="{{route('admin.admin.reservation.edit',['id'=>$item->id])}}"> <i
                                                    class="i-Link"></i>{{$item->pnr}}</a>
                                        </span>
                                    <span
                                        style="color:#f00;display: flex;text-align:center">{{\App\Models\Reservation::RESERVATION_SOURCE_STRING[$item->reservation_source]}}</span>
                                </td>
                                <td style="@if(!is_null($item->comfirm_date)) background:beige; @endif vertical-align: middle;{{$item->tdcolor()}}">
                                        <span class="text-12 " style="display: flex">
                                            <b>
                                                <a href="{{route('admin.admin.customer.edit',['id'=> $item->customer->id])}}">{{$item->private_str()}}</a>
                                                <a href="/admin/admin/reservation/customerreservation/{{$item->customer->id}}">({{$item->reservationCount()}})</a>

                                            </b>
                                        </span>
                                    <?php if(!is_null($item->comfirm_date)){ ?>
                                    <span
                                        style="display: flex;font-weight: 800;color: white;text-indent: 11px;background: #4caf50;"
                                        class="text-12 flex">{{date("d-m-Y H:i",strtotime($item->comfirm_date))}}</span>
                                    <?php } ?>
                                    {{--                                    <span>{{$item->phone}}</span>--}}
                                </td>
                                <td style="vertical-align: middle">
                                        <span class="text-12">
                                            <?php
                                            if (is_null($item->plate)) {
                                                echo $data->getCarInfoFullNoYear($item->car);
                                                echo "<br>";
                                                echo $data->getCarInfoFullNoDetail($item->car);
                                            } else {
                                                echo $data->getCarInfoFullNoYear($item->getPlate->id_car);
                                                echo "<br>";
                                                echo $data->getCarInfoFullNoDetail($item->getPlate->id_car);
                                            }
                                            ?>
                                          </span>
                                    <?php if(($item->plate != 0) && ($item->getPlate->id_car != $item->car)){ ?>
                                    <i data-toggle="tooltip" data-placement="top"
                                       data-original-title="{!! $item->plateDiff() !!}"
                                       style="font-size: 22px;color: #f00;font-weight: 600;" class="i-Danger"></i>
                                    <?php }  ?><br>
                                    <p class="plate"><span>TR</span>{{$data->getPlateReservation($item->plate)}}</p>
                                    </span>
                                </td>
                                <td style="vertical-align: middle">
                                    <span class="text-14 text-black-900"
                                          style="display: flex;">{{date("d-m-Y",strtotime($item->reservationInformation->checkin ?? null))}} {{$item->reservationInformation->checkin_time  ?? null }}</span>
                                    <span class="text-14 text-green-900"
                                          style="display: flex">{{date("d-m-Y",strtotime($item->reservationInformation->checkout ?? null))}} {{$item->reservationInformation->checkout_time  ?? null }}</span>
                                </td>

                                <?php
                                if(isset($item->reservationInformation))  { ?>
                                <td style="vertical-align: middle;" class="text-12">
                                    <?php
                                    $reservationinformation = $item->reservationInformation->up_drop_information;
                                    if($reservationinformation)
                                    {
                                    $details = json_decode($reservationinformation, true);
                                    ?>
                                    <span
                                        style="color:#000;font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title ?? null}} </span>
                                    <br><span style="font-weight: 700;font-size:10px"> {!! $details['up']['value'] !!} )</span>
                                    <br><span class="text-green-900"
                                              style="font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null}}  </span>
                                    <br>
                                    <span>{!! $details['drop']['value'] !!} )</span>
                                    <?php } ?>
                                </td>
                                <?php }else{ ?>
                                <td>

                                </td> <?php } ?>

                                <td style="vertical-align: middle;    text-align: center;"><span
                                        class="text-13"> {{$item->days}}</span>
                                </td>
                                <td style="vertical-align: middle;    text-align: center;"><span
                                        class="text-13"> {{ number_format($item->day_price, 2, ',', '.') }}
                                     {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle;    text-align: center;"><span
                                        class="text-13"> {{ number_format($item->days*$item->day_price, 2, ',', '.') }} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle;    text-align: center;">
                                    <a href="javascript:;" data-toggle="popover" title="Ücretler" data-content="
                                       <?php foreach($item->reservationEkstras as $ekstralist){ if($ekstralist->price != 0){ ?>
                                        <div>{{\App\Models\EkstraLanguage::getSelectLang($ekstralist->id_ekstra,'title',1)}}= {{$ekstralist->price}} {{$item->reservationCurrency->right_icon}}</div>
                                                <?php } ?>
                                    <?php } ?>
                                        <div>Teslim Ücreti = {{$item->drop_price ?? 0}} {{$item->reservationCurrency->right_icon}}</div>
                                                <div>Dönüş Ücreti  = {{$item->up_pice ?? 0}} {{$item->reservationCurrency->right_icon}}</div>
                                     ">Ücretler</a>
                                </td>
                                <td style="vertical-align: middle;    text-align: center;"><span
                                        class="text-13"> {{$item->total_amount}} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle;font-size:13px;font-weight:bold;">
                                     @if($item->getPaymentMethod() != "KK")
                                        @if(auth()->user()->email == 'worldrentalanya@gmail.com' || auth()->user()->email == 'aderin@gmail.com')
                                            @if($item->rest > 0)
                                                {{$item->rest}} {{$item->reservationCurrency->right_icon}}
                                                <a href="#" ng-click="restUpdate({{$item->id}})"><span class="btn btn-success btn-sm" style="display: flex;">Tahsilat</span></a>
                                            @else
                                                @if(!is_null($item->reservationRest()))
                                                    @if($item->rest == 0)
                                                        <a href="javascript:;" data-toggle="popover" title="Ücretler" data-content="
                                                             <?php foreach($item->reservationRest() as $reservationRestInfo){  ?>
                                                                <div> Tarih  = {{$reservationRestInfo->created_at}}</div>
                                                                <div> Not    = {{$reservationRestInfo->note}}</div>
                                                                <div> Fiyat  = {{$reservationRestInfo->price}}</div>
                                                                <hr style='margin-top: 0.5rem !important;margin-bottom: 0.5rem !important;'>
                                                            <?php } ?> ">Ödendi</a>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        0
                                    @endif
                                </td>
                                <td style="vertical-align: middle"
                                    class="text-12 font-weight-bold text-custom">{{$item->getPaymentMethod()}}</td>
                                <td style="vertical-align: middle" class="text-20 text-red-900">
                                    <?php if ($item->reservationNotes){  ?>
                                    <a href="#" data-toggle="modal" data-target="#noteModal"
                                       ng-click="getNote({{$item->id}})"><i class="i-Danger"></i></a>
                                    <?php } ?>
                                </td>
                                <td style="vertical-align: middle;
    white-space: nowrap;
    width: 145px;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    font-weight: 800;" class="text-12">
                                    <i data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{$item->it_made}}"
                                       style="font-size: 18px;color: #f00;font-weight: 600;" class="i-Information"></i>
                                    @if($item->it_made != "web") {{$item->user->name}}
                                    @else {{$item->it_made}}
                                    @endif {{$item->device}}
                                </td>
                                <td>
                                    <select
                                        style="background-color:{{$item->statusColor()}};color:#fff;    margin-top: 35px;"
                                        ng-select="statusChange(1)" id="status" data-id="{{$item->id}}" name="status">
                                        <option @if($item->status == 'new')       selected @endif value="new"> Yeni
                                            Rezervasyon
                                        </option>
                                        <option @if($item->status == 'waiting')   selected @endif value="waiting">
                                            Beklemede
                                        </option>
                                        <option @if($item->status == 'closed')    selected @endif value="closed">İptal
                                            Edildi
                                        </option>
                                        <option @if($item->status == 'comfirm')   selected @endif value="comfirm">
                                            Onaylandı
                                        </option>
                                        <option @if($item->status == 'complated') selected @endif value="complated">
                                            Tamamlandı
                                        </option>
                                        <option @if($item->status == 'not_found') selected @endif value="not_found">
                                            Bulunamadı
                                        </option>
                                    </select>
                                </td>
                                <td style="vertical-align: middle">


                                    <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="_dot _inline-dot bg-primary"></span>
                                        <span class="_dot _inline-dot bg-primary"></span>
                                        <span class="_dot _inline-dot bg-primary"></span>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                         style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"> </i> Çıkış Yap</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"> </i> Dönüş Yap</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"></i> Dönüş Tarihi Güncelle</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"   ng-click="plateModal({{$item->id}},'{{$item->plate}}','{{$item->checkin}}','{{$item->checkout}}','{{$item->private_str()}}')"><i class="i-Duplicate-Layer"></i> Plaka Ata</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"></i> Fiyat Gncelle</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"></i> Tarih Güncelle</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"></i> Ödeme Al</a>
                                        <a class="dropdown-item ul-widget__link--font" href="#"><i
                                                class="i-Duplicate-Layer"></i> Not Gir</a>

                                        <a class="dropdown-item ul-widget__link--font"
                                           onclick="return confirm('Silmek İstediğinizden eminmisiniz?')"
                                           href="{{route('admin.admin.reservation.delete',['id'=>$item->id])}}">
                                            <img style="width: 20px;" src="{{asset('public/assets/images/bin.png')}}"/>
                                            SİL
                                        </a>
                                        @role('Admin')
                                        <a class="dropdown-item ul-widget__link--font"
                                           onclick="return confirm('Tamamen Silinecektir Silmek İstediğinizden eminmisiniz?')"
                                           href="{{route('admin.admin.reservation.forceDeletereservation',['id'=>$item->id])}}"
                                           class="btn">
                                            <img style="width: 20px;"
                                                 src="{{asset('public/assets/images/forcedelete.png')}}"/> KOMPLE SİL
                                        </a>
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                            </tbody>

                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$totalcalculate['days']}}</td>
                                <td></td>
                                <td colspan="2"><b> {{$totalcalculate['price']['tl']}}  ₺ </b></td>
                                <td colspan="2"><b> {{$totalcalculate['price']['usd']}} $</b></td>
                                <td colspan="2"><b> {{$totalcalculate['price']['eur']}} €</b></td>
                                <td colspan="2"><b> {{$totalcalculate['price']['gbp']}} £</b></td>
                                <td></td>
                                <td></td>

                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="paginate" style="    padding: 19px;">
                        <?php //echo $reservation->links('pagination::bootstrap-4'); ?>
                    </div>

                </div>
            </div>
        </div>


        <style>
            .dataTables_wrapper * {
                -moz-transition-duration: 0s;
                -o-transition-duration: 0s;
                -webkit-transition-duration: 0s;
                transition-duration: 0s;
                -moz-transition-timing-function: ease-in;
                -o-transition-timing-function: ease-in;
                -webkit-transition-timing-function: ease-in;
                transition-timing-function: ease-in;
            }

            .dataTables_wrapper .dataTables_scrollHead {
                display: none;
            }

            .dataTables_wrapper .dt-buttons {
                display: none;
            }

            .dataTables_wrapper .dataTables_length {
                display: none;
            }

            .dataTables_wrapper .dataTable {
                min-width: 100%;
                width: 100% !important;
                border: 1px solid #d8e2e7;
                border-top: none;
            }

            .dataTables_wrapper .dataTable tr {
                border-top: 1px solid #d8e2e7;
            }

            .dataTables_wrapper .dataTable tr td,
            .dataTables_wrapper .dataTable tr th {
                border-left: 1px solid #d8e2e7;
                padding: 15px 10px;
                text-align: left !important;
                font-weight: normal !important;
                color: #7b7b91;
                font-size: 14px;
            }

            .dataTables_wrapper .dataTable tr td .red,
            .dataTables_wrapper .dataTable tr th .red {
                color: #ff5645;
            }

            .dataTables_wrapper .dataTable tr td .green,
            .dataTables_wrapper .dataTable tr th .green {
                color: #4ccc3c;
            }

            .dataTables_wrapper .dataTable tr td .orange,
            .dataTables_wrapper .dataTable tr th .orange {
                color: #ff9700;
            }

            .dataTables_wrapper .dataTable tr td .blue,
            .dataTables_wrapper .dataTable tr th .blue {
                color: #1097ff;
            }

            .dataTables_wrapper .dataTable tr td:first-child,
            .dataTables_wrapper .dataTable tr th:first-child {
                border: none;
            }

            .dataTables_wrapper .dataTable thead {
                background: #f6f8fa;
                height: auto !important;
            }

            .dataTables_wrapper .dataTable thead tr {
                border: none;
            }

            .dataTables_wrapper .dataTable thead th {
                padding: 10px !important;
                padding-right: 36px !important;
                white-space: nowrap;
            }

            .dataTables_wrapper .dataTable thead th.sorting {
                background: url(../img/arrows.png) no-repeat right center;
            }

            .dataTables_wrapper .dataTable thead th.sorting_desc {
                background: url(../img/arrow-down.png) no-repeat right center;
            }

            .dataTables_wrapper .dataTable thead th.sorting_asc {
                background: url(../img/arrow-up.png) no-repeat right center;
            }

            .dataTables_wrapper .dataTable thead th.backNo {
                background: none;
            }

            .dataTables_wrapper .dataTable thead th div {
                height: auto !important;
            }

            .dataTables_wrapper .dataTable tbody td {
                height: 70px;
            }

            .dataTables_wrapper .dataTable tbody td.dataTables_empty {
                text-align: center !important;
                vertical-align: middle;
            }

            .dataTables_wrapper .dataTable tbody tr:nth-child(even) {
                background: #f6f8fa;
            }

            .dataTables_wrapper .dataTable tbody tr.green {
                background: #d9fed4;
            }

            .dataTables_wrapper .dataTable tbody tr.orange {
                background: #ffefd3;
            }

            .dataTables_wrapper .dataTables_scrollHeadInner .dataTable {
                border: none;
            }

            .dataTables_wrapper .dataTables_paginate {
                text-align: center;
                margin-top: 30px;
                font-size: 0;
                line-height: 40px;
            }

            .dataTables_wrapper .dataTables_paginate > * {
                display: inline-block;
                font-size: 14px;
                color: #7b7b91;
                cursor: pointer;
            }

            .dataTables_wrapper .dataTables_paginate > a {
                width: 40px;
                text-align: center;
                border: 1px solid #dde1e9;
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
                background: #fff;
                color: #7b7b91;
                font-size: 14px;
            }

            .dataTables_wrapper .dataTables_paginate > a.previous {
                border-radius: 0;
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
                border-right: 0;
            }

            .dataTables_wrapper .dataTables_paginate > a.previous i {
                -webkit-transform: rotateY(180deg);
                -moz-transform: rotateY(180deg);
                -ms-transform: rotateY(180deg);
                -o-transform: rotateY(180deg);
                transform: rotateY(180deg);
                display: block;
            }

            .dataTables_wrapper .dataTables_paginate > a:not(.disabled):hover {
                background: #ecf7ff;
                color: #008fff;
            }

            .dataTables_wrapper .dataTables_paginate .ellipsis {
                width: 40px;
                text-align: center;
                border: 1px solid #dde1e9;
                border-right: 0;
                background: #fff;
                color: #7b7b91;
                font-size: 14px;
                display: inline-block;
            }

            .dataTables_wrapper .dataTables_paginate > span a {
                display: inline-block;
                width: 40px;
                border: 1px solid #dde1e9;
                border-right: 0;
                background: #fff;
                color: #7b7b91;
                font-size: 14px;
            }

            .dataTables_wrapper .dataTables_paginate > span a:hover {
                background: #ecf7ff;
                color: #008fff;
            }

            .dataTables_wrapper .dataTables_paginate > span a.current {
                color: #fff;
                background: #008fff;
                border-top-color: #008fff;
                border-bottom-color: #008fff;
            }

            .dataTables_wrapper .dataTables_length {
                background: #dde1e9;
                padding: 5px 20px;
                z-index: 5;
                position: relative;
            }

            .dataTables_wrapper .dataTables_empty {
                text-align: center !important;
            }

            .dataTables_wrapper .active {
                color: #4ccc3c;
                font-size: 12px;
                white-space: nowrap;
            }

            .dataTables_wrapper .active i {
                margin-right: 5px;
            }

            .dataTables_wrapper .active.red {
                color: #ff5645;
            }

            .dataTables_wrapper .dtButton {
                font-size: 16px;
                color: #a8bed0;
                padding: 0 10px;
                display: inline-block;
                -moz-transition-duration: 0.2s;
                -o-transition-duration: 0.2s;
                -webkit-transition-duration: 0.2s;
                transition-duration: 0.2s;
                -moz-transition-timing-function: ease-in;
                -o-transition-timing-function: ease-in;
                -webkit-transition-timing-function: ease-in;
                transition-timing-function: ease-in;
                background: none;
                border: none;
            }

            .dataTables_wrapper .dtButton:hover {
                transform: scale(1.8);
                color: #008fff;
            }

            .dataTables_wrapper .dtButton:hover.purple {
                color: #c65ee7;
            }

            .dataTables_wrapper .dtButton:hover.orange {
                color: #fea000;
            }

            .dataTables_wrapper .dtButton:hover.green {
                color: #4ccc3c;
            }

            .dataTables_wrapper .dtButton2 {
                color: #a8bed0;
                line-height: 26px;
                margin-left: 15px;
            }

            .dataTables_wrapper .dtButton2:hover {
                color: #4ccc3c;
            }

            .dataTables_wrapper .dtButton3 {
                color: #008fff;
                font-size: 12px;
                display: block;
                float: left;
                font-weight: 700 !important;
                text-align: center;
            }

            .dataTables_wrapper .dtButton3 i {
                display: block;
                font-size: 20px;
            }

            .dataTables_wrapper .dtButton3:hover {
                color: #4ccc3c;
            }

            .dataTables_wrapper .dataTables_info {
                display: none;
            }

            .dataTable {
                border-left: 0;
                border-right: 0;
                min-width: 750px;
            }

            .dataTable thead th:last-child,
            .dataTable thead th:first-child {
                background: none;
            }

            .dataTable .details-control {
                text-align: center !important;
                cursor: pointer;
            }

            .dataTable .details-control:before {
                font-family: 'fontello';
                content: '\e82b';
                font-size: 22px;
                color: #4ccc3c;
            }

            .dataTable .detail {
                background: #1f3547;
                margin: 0 -5px;
                margin: -15px -10px;
                white-space: normal;
                padding: 15px 15px 0 15px;
            }

            .dataTable .detail > div {
                padding: 0 5px;
            }

            .dataTable .detail > div > ul {
                border-radius: 4px;
                background: #2f485d;
                padding: 5px 0;
                overflow: hidden;
                height: 267px;
            }

            .dataTable .detail > div > ul li {
                border-bottom: 1px dashed #435e75;
                line-height: 42px;
                color: #92a5b5;
                font-size: 12px;
            }

            .dataTable .detail > div > ul li:after,
            .dataTable .detail > div > ul li:before {
                content: "";
                display: table;
                clear: both;
            }

            .dataTable .detail > div > ul li span {
                display: block;
                float: left;
                width: 50%;
                padding: 0 15px;
            }

            .dataTable .detail > div > ul li span a {
                color: #fff;
            }

            .dataTable .detail > div > ul li span a:hover {
                color: #4ccc3c;
            }

            .dataTable .detail > div > ul li span:last-child {
                text-align: left !important;
                color: #fff;
            }

            .dataTable .detail > div > ul li:last-child {
                border: none;
            }

            .dataTable .detail > div > ul li.totalPrice {
                background: #446077;
                font-weight: 700 !important;
                margin-bottom: -5px;
                padding-bottom: 5px;
                color: #fff;
            }

            .dataTable .detail > div > ul li.totalPrice span:last-child {
                color: #4ccc3c;
            }

            .dataTable .detail > div > ul li.totalPrice span:last-child b {
                font-weight: normal !important;
                font-size: 9px;
                display: block;
                color: #92a5b5;
                line-height: 0px;
                margin-top: -8px;
            }

            .dataTable .detail > div .button {
                width: 100%;
                display: block;
                text-align: center;
                background: #172837;
                line-height: 70px;
                font-size: 14px;
                font-weight: 700 !important;
                color: #4ccc3c;
                margin-top: 10px;
                position: relative;
            }

            .dataTable .detail > div .button i {
                line-height: 0px;
                font-size: 24px;
                position: relative;
                top: 4px;
                margin-right: 10px;
            }

            .dataTable .detail > div .button:before,
            .dataTable .detail > div .button:after {
                position: absolute;
                content: "";
                left: -15px;
                top: 0;
                width: 15px;
                bottom: 0;
                background: #172837;
            }

            .dataTable .detail > div .button:after {
                left: auto;
                right: -15px;
            }

            .dataTable .detail > div .button:hover {
                background: #446077;
                color: #fff;
            }

            .dataTable .detail > div .button:hover:before,
            .dataTable .detail > div .button:hover:after {
                background: #446077;
            }

            .dataTable .detail .rating {
                border-radius: 4px;
                background: #182836;
                height: 36px;
                margin: 20px 0;
                padding: 0 20px;
                line-height: 36px;
            }

            .dataTable .detail .rating p {
                float: left;
                font-size: 14px;
                font-weight: 700 !important;
                color: #a8bed0;
            }

            .dataTable .detail .rating b {
                float: right;
                display: block;
                font-size: 28px;
                color: #008fff;
                line-height: 50px;
                width: 64px;
                background: #182836;
                border-radius: 100%;
                border: 7px solid #1f3547;
                margin: -13px 20px 0 0;
                letter-spacing: -2px;
                text-align: center;
            }

            .dataTable .detail .rating span {
                font-size: 14px;
                font-weight: 700 !important;
                color: #fff;
                float: right;
                display: block;
            }

            .dataTable .detail .companyBlacklist {
                background-image: linear-gradient(270deg, #ff765b 0%, #f64694 100%);
                border-radius: 4px;
                height: 36px;
                margin: 20px 0;
                padding: 0 20px;
                line-height: 36px;
                font-weight: 700 !important;
                color: #fff;
                font-size: 14px;
                text-align: left !important;
                position: relative;
            }

            .dataTable .detail .companyBlacklist span {
                float: right;
            }

            .dataTable .detail .companyBlacklist:before {
                position: absolute;
                top: -14px;
                right: 80px;
                width: 64px;
                height: 65px;
                content: "";
                background: url(../img/companyBlacklist.png);
            }

            .dataTable .detail .generalBlacklist {
                border-radius: 4px;
                background: #182836;
                height: 36px;
                margin: 20px 0;
                padding: 0 20px;
                line-height: 36px;
            }

            .dataTable .detail .generalBlacklist p {
                float: left;
                font-size: 14px;
                font-weight: 700 !important;
                color: #a8bed0;
            }

            .dataTable .detail .generalBlacklist b {
                float: right;
                display: block;
                font-size: 25px;
                color: #4ccc3c;
                line-height: 50px;
                width: 64px;
                background: #182836;
                border-radius: 100%;
                border: 7px solid #1f3547;
                margin: -13px 20px 0 0;
                letter-spacing: -2px;
                text-align: center;
            }

            .dataTable .detail .generalBlacklist span {
                font-size: 14px;
                font-weight: 700 !important;
                color: #4ccc3c;
                float: right;
                display: block;
            }

            .dataTable .detail > .row {
                margin: 0 -5px;
            }

            .dataTable .detail > .row > div {
                padding: 0 5px;
            }

            .dataTable .detail > .row > div > ul {
                border-radius: 4px;
                background: #2f485d;
                padding: 5px 0;
                overflow: hidden;
                height: 267px;
            }

            .dataTable .detail > .row > div > ul li {
                border-bottom: 1px dashed #435e75;
                line-height: 42px;
                color: #92a5b5;
                font-size: 12px;
            }

            .dataTable .detail > .row > div > ul li:after,
            .dataTable .detail > .row > div > ul li:before {
                content: "";
                display: table;
                clear: both;
            }

            .dataTable .detail > .row > div > ul li span {
                display: block;
                float: left;
                width: 50%;
                padding: 0 15px;
            }

            .dataTable .detail > .row > div > ul li span a {
                color: #fff;
            }

            .dataTable .detail > .row > div > ul li span a:hover {
                color: #4ccc3c;
            }

            .dataTable .detail > .row > div > ul li span:last-child {
                text-align: left !important;
                color: #fff;
            }

            .dataTable .detail > .row > div > ul li:last-child {
                border: none;
            }

            .dataTable .detail > .row > div > ul li.totalPrice {
                background: #446077;
                font-weight: 700 !important;
                margin-bottom: -5px;
                padding-bottom: 5px;
                color: #fff;
            }

            .dataTable .detail > .row > div > ul li.totalPrice span:last-child {
                color: #4ccc3c;
            }

            .dataTable .detail > .row > div > ul li.totalPrice span:last-child b {
                font-weight: normal !important;
                font-size: 9px;
                display: block;
                color: #92a5b5;
                line-height: 0px;
                margin-top: -8px;
            }

            .dataTable .detail > .row > div .button {
                width: 100%;
                display: block;
                text-align: center;
                background: #172837;
                line-height: 70px;
                font-size: 14px;
                font-weight: 700 !important;
                color: #4ccc3c;
                margin-top: 10px;
                position: relative;
            }

            .dataTable .detail > .row > div .button i {
                line-height: 0px;
                font-size: 24px;
                position: relative;
                top: 4px;
                margin-right: 10px;
            }

            .dataTable .detail > .row > div .button:before,
            .dataTable .detail > .row > div .button:after {
                position: absolute;
                content: "";
                left: -15px;
                top: 0;
                width: 15px;
                bottom: 0;
                background: #172837;
            }

            .dataTable .detail > .row > div .button:after {
                left: auto;
                right: -15px;
            }

            .dataTable .detail > .row > div .button:hover {
                background: #446077;
                color: #fff;
            }

            .dataTable .detail > .row > div .button:hover:before,
            .dataTable .detail > .row > div .button:hover:after {
                background: #446077;
            }

            .dataTable .icon-lock,
            .dataTable .icon-unlock {
                display: block;
                color: #4ccc3c;
                font-size: 23px;
            }

            .dataTable .icon-lock {
                color: #ff5645;
            }

            .dataTable .process {
                font-size: 20px;
                padding: 0 5px;
                display: inline-block;
                color: #a8bed0;
            }

            .dataTable .process {
                font-size: 20px;
                padding: 0 5px;
                display: inline-block;
                color: #a8bed0;
            }

            .dataTable .process-menu {
                font-size: 20px;
                padding: 0 10px;
                display: inline-block;
                color: #a8bed0;
                position: relative;
                border-radius: 4px;
            }

            .dataTable .process-menu i {
                color: #4ccc3c;
                cursor: pointer;
                margin: 0 !important;
            }

            .dataTable .process-menu ul {
                position: absolute;
                right: 35px;
                top: 0;
                display: none;
                background: #8c8c9e;
                z-index: 5;
                border-radius: 4px;
                overflow: hidden;
                box-shadow: -12px 15px 18px rgba(0, 0, 0, 0.2);
            }

            .dataTable .process-menu ul li a {
                display: block;
                border-left: 4px solid #8c8c9e;
                text-align: left !important;
                font-size: 14px;
                color: #fff;
                padding: 17px 25px;
            }

            .dataTable .process-menu ul li a:hover {
                background: rgba(248, 249, 250, 0.2);
                border-left-color: #4ccc3c;
                color: #fff;
            }

            .dataTable .process-menu.active {
                background: #8c8c9e;
            }

            .dataTable .process-menu.active i {
                color: #fff;
            }

            .dataTable .process-menu.active ul {
                display: block;
            }

            .dataTable thead .details-control:before {
                display: none;
            }

            .dataTable tbody tr td {
                font-size: 12px;
            }

            .dataTable tbody tr td a {
                color: #008fff;
                word-wrap: break-word;
            }

            .dataTable tbody tr td a:hover {
                color: #4ccc3c;
            }

            .dataTable tbody tr td a.button {
                color: #fff;
            }

            .dataTable tbody tr td a.button.custom1 {
                color: #7b7b91;
            }

            .dataTable tbody tr td a.button.custom1:hover {
                color: #4ccc3c;
            }

            .dataTable tbody tr td .locationLink {
                font-size: 9px;
                color: #4ccc3c;
                display: block;
                border: 1px solid #4ccc3c;
                border-radius: 10px;
                line-height: 18px;
                padding: 0 5px 0 25px;
                margin: 3px 0;
                white-space: nowrap;
                position: relative;
            }

            .dataTable tbody tr td .locationLink i {
                display: block;
                width: 25px;
                text-align: center;
                font-size: 14px;
                line-height: 18px;
                height: 18px;
                position: absolute;
                left: 0;
                top: 0;
            }

            .dataTable tbody tr td .locationLink:hover {
                color: #fff;
                background: #4ccc3c;
            }

            .dataTable tbody tr td .locationLink.red {
                border-color: #ff5645;
                color: #ff5645;
            }

            .dataTable tbody tr td .locationLink.red:hover {
                color: #fff;
                background: #ff5645;
            }

            .dataTable tbody tr td:last-child {
                white-space: nowrap;
                text-align: right !important;
            }

            .dataTable tbody tr td:last-child p {
                display: inline-block;
            }

            .dataTable tbody tr td:last-child.dataTables_empty {
                text-align: center !important;
            }

            .dataTable tbody tr.details {
                background: #172837;
            }

            .dataTable tbody tr.details td {
                border-color: #172837;
            }

            .dataTable tbody tr.details td.details-control:before {
                content: '\e822';
                color: #a8bed0;
            }

            .dataTable tbody tr.details + tr {
                border-color: #172837;
            }

            .dataTable tbody tr:last-child .process-menu ul {
                top: auto;
                bottom: 0;
            }

            .dataTable tbody tr:nth-last-child(2) .process-menu ul {
                top: auto;
                bottom: -80px;
            }

            .dataTable tbody tr:nth-last-child(3) .process-menu ul {
                top: auto;
                bottom: -160px;
            }
        </style>
        <div id="reservationLogModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                style="right: 25px; position: absolute;">&times;
                        </button>
                        <h4 class="modal-title"><b style="color:#000">Rezervasyon</b>-<b style="color:#f00">Log</b>
                            Bilgileri</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Kullanıcı</td>
                                <td>İşlem</td>
                                <td>Detay</td>
                                <td>Tarih</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in reservationLoglist">
                                <td>@{{item.user}}</td>
                                <td>@{{item.description}}</td>
                                <td>@{{item.detail}}</td>
                                <td>@{{item.created_at | date:'dd-MM-yyyy H:mm'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button style="padding-bottom: 2px;padding-top: 5px;padding-left: 5px;padding-right: 5px;"
                                type="button" class="btn btn-default" data-dismiss="modal">KAPAT
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reservationNotelist" role="dialog" aria-hidden="false">
            <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width:800px">
                <div class="modal-content">
                    <div class="modal-header" style="padding: .5rem;">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Yorumlar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body" style="padding: .5rem;">
                        <table class="table table-bordered table-hover table-condensed table-nowrap-th">
                            <thead>
                            <tr>
                                <th>Görevli</th>
                                <th>Tür</th>
                                <th>İçerik</th>
                                <th>Zaman</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="comment in reservationNotelist">
                                <td class="nowrap">@{{ comment.sender }}</td>
                                <td class="nowrap">
                                    <span class="text-gray">Not</span>
                                </td>
                                <td class="table-container">@{{ comment.messages }}</td>
                                <td class="nowrap">@{{ comment.created_at | date:'d-MM-yyyy HH:mm:ss' }}</td>
                                <td class="nowrap"><a style="    cursor: pointer;"
                                                      ng-click="commentDelete(comment.id,reservationId)"><img
                                            style="width: 24px;"
                                            src="https://worldcarrental.com/public/assets/images/bin.png"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="height: 10px;"></div>
                        <form class="form-group" id="notes" method="post" enctype="multipart/form-data"
                              ng-submit="addComment(reservationId)">
                            @csrf
                            <input name="id" id="reservationId" type="hidden">
                            <input name="status" id="statusCode" type="hidden">
                            <div class="input-group">
                                <select style="width: 10%;float: left" name="type">
                                    <option value="noted">Mesaj</option>
                                    <option value="closed">İptal</option>
                                </select>
                                <input style="width: 82.5%;float: left" type="text" name="messages"
                                       placeholder="Yeni ekle..">
                                <span class="input-group-addon separator"></span>
                                <span style="width: 5%;float: left" class="input-group-btn">
                                <button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;"
                                        class="btn btn-primary btn-add">Ekle</button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="restUpdateModal" role="dialog" aria-hidden="false">
            <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width:800px">
                <div class="modal-content">
                    <div class="modal-header" style="padding: .5rem;">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Ödeme Notu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" style="padding: .5rem;">
                        <form class="form-group" id="restupdateForm" method="post" enctype="multipart/form-data"
                              ng-submit="restUpdateProcess()">
                            @csrf
                            <input name="id" id="reservationId" type="hidden">
                            <div class="form-group">
                                <input class="form-control" type="text" name="price" placeholder="Ödeme Miktarı" style="width: 82%;float: left" required>
                                <select class="form-control"  name="currency" style="float: right">
                                    <?php foreach ($currencies as $currency){ ?>
                                      <option value="<?=$currency->id?>"><?=$currency->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="messages" placeholder="Not Yazınız..">
                            </div>

                            <div class="form-group">
                                <span class="input-group-addon separator"></span>
                                <span style="width: 5%;float: left" class="input-group-btn">
                                <button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;"
                                        class="btn btn-primary btn-add">Ekle</button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="plateModal" role="dialog" aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2"><b style="    color: #ff8300;">(@{{fullname}})</b> Onaylama Ve Plaka Atama</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('admin.admin.reservation.addplate')}}">
                        @csrf
                        <div class="modal-body">
                            <input name="id" value="@{{reservationid}}" type="hidden">
                            <table class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                <tbody>
                                    <tr>
                                        <th style="width: 25%;">Plaka Atama</th>
                                            <td>
                                                <select  class="form-control js-example-basic-single" data-live-search="true" name="plate">
                                                    <option value="0">PLAKASIZ</option>
                                                    <optgroup ng-repeat="plate in plates" label="@{{ plate.car }} @{{ plate.model.modelname }}">
                                                     <option ng-repeat="item in plate.plate" ng-selected="item.id == plate" value="@{{item.id}}">
                                                      <span>@{{  item.plate}}</span> |  @{{  item.car.transmission}} |  @{{  item.car.fuel}}
                                                     </option>
                                                    </optgroup>
                                                </select>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        app.controller("mainController", function ($scope, $http) {
            $scope.getLogList = function (id) {
                $http({
                    method: "GET",
                    url: "/admin/admin/reservation/get_log_list/" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationLoglist = response.data;
                    $('#reservationLogModal').modal('show');
                });
            }
            $scope.restUpdate = function (id) {
                $('#restUpdateModal').modal('show');
                $("#restupdateForm").find("#reservationId").val(id);
            }
            $scope.restUpdateProcess = function () {
                $http({
                    method: "POST",
                    url: "/admin/admin/reservation/updaterest",
                    data: $("#restupdateForm").serialize(),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    swal("Rest Kaydedildi", "Başarılı", "");
                });
            }
            $scope.getNote = function (id) {
                $http({
                    method: "GET",
                    url: "/admin/admin/reservation/get_note_list?id=" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationNotelist = response.data;
                    $scope.reservationId = id;
                    $('#reservationNotelist').modal('show');
                });
            }
            $scope.getComment = function (id) {
                $http({
                    method: 'GET',
                    url: '/admin/admin/reservation/getcomment/' + id + '',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.reservationNotelist = response.data;
                });
            }
            $scope.statusChange = function (id) {
                alert("cs");
            }
            $scope.addComment = function (id) {
                $http({
                    method: 'POST',
                    url: '/admin/admin/reservation/addcommentapi',
                    data: $("#notes").serialize(),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getComment(id);
                    $.ajax({
                        url: "/admin/admin/reservation/statusChange?id=" + $("#notes").find('#reservationId').val() + "&status=" + $("#notes").find('#statusCode').val() + "",
                        type: "get",
                        success: function (response) {
                            console.log(response);
                            swal("Durum Değiştirildi", "Başarılı", "");
                            $('#reservationNotelist').modal('hide');
                            window.location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                    $("#notes").find('input').val('');
                });
            }
            $scope.plateModal = function (id, plate, checkin, checkout,name) {
                $("#plateModal").modal('show');
                $http({
                    method: "GET",
                    url: "/admin/admin/plates/getAvaiblePlate?id="+id+"",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationid = id;
                    $scope.plate = plate;
                    $scope.plates = response.data;
                    $scope.checkin = checkin;
                    $scope.checkout = checkout;
                    $scope.checkin_time = response.data.checkin_time;
                    $scope.checkout_time = response.data.checkout_time;
                    $scope.fullname = name;
                    $scope.car = response.car;
                    console.log(response);
                });
            }
        });

        $("table").on("change", "#status", function () {
            $('#reservationNotelist').modal('show');
            $("#statusCode").val($(this).val());
            $("#reservationId").val($(this).attr('data-id'));
        });

    </script>
    <script>
        $("[data-toggle=popover]").popover({
            html: true,
            content: function () {
                return $('#popover-content').html();
            }
        });
    </script>
    <style>
        .table.table-custom.spacing8 {
            border-spacing: 0px 0 !important;
        }

        .table.table-custom {
            border-collapse: separate !important;
        }


        .table-sm th, .table-sm td {
            padding: 0.3rem;
            border-right: 1px solid #ccc;
        }

        .table tr td {
            padding: 5px;
        }

        .table a {
            color: #000000 !important;
        }

        .table.table-custom tr:hover td {
            background: #e1e1e1;
        }

        .table.table-custom tr td {
            border-bottom: 2px solid white;
        }

        .table.table-custom tr {
            background: #fefefe;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        table {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        *, ::after, ::before {
            box-sizing: border-box;
        }

        .table thead th {
            padding: 7px !important;
        }
    </style>

@endsection

