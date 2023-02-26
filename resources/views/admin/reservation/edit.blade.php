@extends('layouts.admin')

@section('content')

    <?php
    use Akaunting\Money\Money;
    use App\Helpers\Search;
    use App\Models\Location;
    use App\Models\Reservation;
    use App\User;
    use App\Repository\Data;
    $data = new Data();
    $location = new Location();
    $search = new Search();
    $user = new User();
    ?>
    <div class="breadcrumb">
        <h1>Rezervasyon Bilgisi</h1>
        <ul>
            <li><a href="{{route('admin.admin.reservation',['status'=> 1])}}">Rezervasyonlar</a></li>
            <a href="{{route('admin.admin.customer.edit',['id'=> $reservation->id_customer])}}">
                {{$reservation->reservationInformation->firstname . " " . $reservation->reservationInformation->lastname}}
            </a></li>
        </ul>
    </div>

    <script>

    </script>
    <div class="row">
        @if(Session::has('msg'))
            <div style="    width: 100%;" class="alert alert-success" role="alert">
                <strong class="text-capitalize">UYARI!</strong> {{Session::get('msg')}}
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                @php
                    Session::forget('msg');
                @endphp
            </div>
        @endif
    </div>
    <div class="row">
        @if($errors->any())
            <div style="    width: 100%;" class="alert alert-danger" role="alert"><strong
                    class="text-capitalize">UYARI!</strong> {{$errors->first()}}
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-6 float-left">
            <h3 class="card-title">
                <table
                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-15 text-center">
                    <thead>
                    <tr style="font-weight: 800">
                        <td>Rez. Tar</td>
                        <td>PNR:</td>
                        <td>Durum</td>
                        <td>Rez. Kaynağı</td>
                        <td>Çıkış KM / Dönüş KM</td>
                    <!-- td><a href="{{route('admin.admin.survey.send',['id' => $reservation->id])}}">Anket</a></td -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="background: #fff;">{{\Carbon\Carbon::parse($reservation->created_at)->format('d-m-Y H:i')}}</td>
                        <td style="background: #fff;"><?=$reservation->pnr?></td>
                        <td style="background: #fff;">{{$reservation->getReservationStatus()}}</td>
                        <td style="background: #fff;">{{$reservation->it_made}}</td>
                        <td style="background: #fff;">

                            @if(!empty($reservationoperations))
                                @foreach($reservationoperations as $item)
                                    @if($item->type == "drop")
                                        {{$item->km}}
                                    @endif

                                    @if($item->type == "up")
                                        / {{$item->km}}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    </tbody>
                    <tfood>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Onaylayan</td>
                            <td>{{$reservation->user->name}}</td>
                            <td>{{ $reservation->reservationOperationDrop() ?  $reservation->reservationOperationDrop()->user->name : "Çıkış Yapılmadı"}}
                                /
                                {{$reservation->reservationOperationUp() ? $reservation->reservationOperationUp()->user->name : "Dönüş Yapılmadı"}}</td>
                        </tr>
                    </tfood>
                </table>
            </h3>
        </div>
        <div class="col-md-6 float-right">
            <div class="btn-group" role="group" aria-label="Basic example">
                <select id="status" data-id="{{$reservation->id}}" name="status">
                    <option @if($reservation->status == 'waiting') selected @endif  value="waiting">
                        Beklemede
                    </option>
                    <option @if($reservation->status == 'closed') selected @endif value="closed">İptal
                        Edildi
                    </option>
                    <option @if($reservation->status == 'comfirm') selected @endif value="comfirm">
                        Onaylandı
                    </option>
                    <option @if($reservation->status == 'complated') selected @endif value="complated">
                        Tamamlandı
                    </option>
                </select>
                <button data-toggle="modal" data-target="#mailModal" class="btn btn-danger" type="button">Mail Gönder
                </button>
                <button data-toggle="modal" data-target="#plateModal" class="btn btn-warning" type="button"
                        @if(!is_null($reservation->reservationOperationUp()))  disabled @endif>Plaka
                    Atama
                </button>
                <button data-toggle="modal" data-target="#daysModal" class="btn btn-info" type="button"
                        @if(!is_null($reservation->reservationOperationUp()))  disabled @endif>Dönüş Değiştir
                </button>
                <button data-toggle="modal" data-target="#dropModal" class="btn btn-success" type="button"
                        @if(!is_null($reservation->reservationOperationDrop()))  disabled @endif>Çıkış
                </button>
                <button data-toggle="modal" data-target="#upModal" class="btn btn-danger" type="button"
                        @if(!is_null($reservation->reservationOperationUp()))  disabled @endif>Dönüş
                </button>
                <?php if(!is_null($reservation->reservationNotes())){ ?>
                <button data-toggle="modal" data-target="#noteModal" class="btn btn-warning" type="button"><i
                        style="color: #f00;font-weight: 600; margin-right: 5px;" class="i-Danger"></i>Notlar
                </button>
                <?php } ?>
                <button data-toggle="modal" data-target="#newMailModal" class="btn btn-danger" type="button">Mail
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="accordion" id="accordionTime">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                            <a class="text-default" data-toggle="collapse" href="#accordion-item-time"
                                               aria-expanded="true"><b>Yer & Zaman Bilgisi</b></a>
                                        </h6>
                                        <button style="border: 0;cursor: pointer;right: 29px;position: relative;"
                                                type="button" data-toggle="modal" data-target="#dateChangeModal"><i
                                                class="i-Pen-4"></i></button>
                                    </div>
                                    <div class="collapse show" id="accordion-item-time" data-parent="#accordionTime"
                                         style="">
                                        <div class="card-body">
                                            <div class="col-md-12" style="padding:10px;">
                                                <table
                                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width: 20%;">Alış Tarihi</th>
                                                        <td><?=date('d-m-Y', strtotime($reservation->reservationInformation->checkin))?> <?=$reservation->reservationInformation->checkin_time?></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alış Yeri</th>
                                                        <td>
                                                            <?php $locationpalacequery =  $location->getViewCenterId($reservation->reservationInformation->up_location);  ?>
                                                            <?php if(!empty($locationpalacequery)){ ?>
                                                            <span><?php echo $locationpalacequery[0]->title ?></span>
                                                            |
                                                                <?php if($reservation->reservationCurrency){ ?>
                                                            <span class="text-medium text-info font-weight-800"
                                                                  data-toggle="tooltip" data-placement="left" title=""
                                                                  data-original-title="Ek Teslimat Ücreti (<?=$reservation->up_price?>  <?=$reservation->reservationCurrency->right_icon?>)">Ek Teslimat Ücreti (<?=$reservation->up_price?>  <?=$reservation->reservationCurrency->right_icon?>)</span>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dönüş Tarihi</th>
                                                        <td>
                                                <span>
                                                    <?=date('d-m-Y', strtotime($reservation->reservationInformation->checkout))?> <?=$reservation->reservationInformation->checkout_time?>
                                                </span>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dönüş Yeri</th>
                                                        <td>
                                                            <?php $locationdropquery = $location->getViewCenterId($reservation->reservationInformation->drop_location); ?>
                                                            <?php if(!empty($locationdropquery)){ ?>
                                                            <span><?php echo $locationdropquery[0]->title ?></span>
                                                            |
                                                            <span class="text-medium text-info font-weight-800"
                                                                  data-toggle="tooltip" data-placement="left" title=""
                                                                  data-original-title="Ek Teslimat Ücreti (<?=$reservation->drop_price?>  <?=$reservation->reservationCurrency->right_icon?>)">Ek Teslimat Ücreti (<?=$reservation->drop_price?> <?=$reservation->reservationCurrency->right_icon?>)</span>
                                                       <?php }?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Süre</th>
                                                        <td class="text-bold">
                                                            <span class="text-elite"><?=$reservation->days?> </span>
                                                            <span class="text-small text-gray">Gün</span>
                                                        </td>
                                                        <td></td>
                                                    </tr>

                                                    </tbody>
                                                    <tbody>
                                                    <?php $reservationdetail = $reservation->reservationInformation->up_drop_information;
                                                    if($reservationdetail){
                                                    $details = json_decode($reservationdetail, true);
                                                    ?>
                                                    <?php    foreach ($details as $detail){ $x = explode("_", $detail["type"]);   ?>
                                                    <tr>

                                                        <th style="width: 20%;">
                                                            <?php if(is_array($x)){?>
                                                            <?php if(isset($x[1]) && $x[1] == 'airport'){?>
                                                            Havalimanı <?php } ?>
                                                            <?php if(isset($x[1]) && $x[1] == 'hotel'   ){?>
                                                            Otel <?php } ?>
                                                            <?php if(isset($x[1]) && $x[1] == 'address' ){?>
                                                            Adres <?php } ?>
                                                            <?php if(isset($x[0]) && $x[0] == 'ofis' ){?>
                                                            Ofis <?php } ?>
                                                            <?php } else{ ?>
                                                            <?php if($detail["type"] == 'ofis'){?> Ofis <?php } ?>
                                                            <?php } ?>
                                                        </th>

                                                        <td>
                                                            <?php if ($detail["key"] == 0) {
                                                                echo "Ofis Teslimat";
                                                            } else {
                                                                echo $detail["key"];
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($detail["value"] == 0) {
                                                                echo "Ofis Teslimat";
                                                            } else {
                                                                echo $detail["value"];
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <button style="border: 0;cursor: pointer;right: 29px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#detailChangeModal">
                                                                <i class="i-Pen-4"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php }else{  ?>
                                                    <button type="button" data-toggle="modal"
                                                            data-target="#detailChangeModal">
                                                        Alış Dönüş Bilgisi Ekle
                                                    </button>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /right control icon-->
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <!-- right control icon-->
                            <div class="accordion" id="accordionCar">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                            <a class="text-default" data-toggle="collapse" href="#accordion-item-car"
                                               aria-expanded="true"><b>Araç Bilgisi</b></a>
                                        </h6>
                                    </div>
                                    <div class="collapse show" id="accordion-item-car" data-parent="#accordionCar"
                                         style="">
                                        <div class="card-body">
                                            <table
                                                class="text-13 table table-bordered table-striped table-condensed table-nowrap-th vertical-middle">
                                                <tbody>
                                                <tr>
                                                    <th style="width: 25%;">Talep Edilen Araç</th>
                                                    <td>
                                                        <?=$data->getCarInfoFullNoYear($reservation->car)?>
                                                        {{$reservation->reservationCar->fuel}}  {{$reservation->reservationCar->transmission}}
                                                    </td>
                                                </tr>
                                                <?php if($reservation->getPlate && $reservation->getPlate->id_car != $reservation->car){ ?>
                                                <tr>
                                                    <th style="width: 25%;">Verilen Araç</th>
                                                    <td style="color: #f00;font-weight: 700;">
                                                        <?=$data->getCarInfoFullNoYear($reservation->getPlate->id_car)?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Plaka</th>
                                                    <td>
                                                        <?php if($reservation->plate == 0){ ?>
                                                        Atanmadı
                                                        <?php }else{ ?>
                                                        <span
                                                            class="text-info"> <?=$reservation->getPlate->plate?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /right control icon-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <!-- right control icon-->
                            <div class="accordion" id="accordionCustomer">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                            <a class="text-default collapsed" data-toggle="collapse"
                                               href="#accordion-item-customer" aria-expanded="true"><b>Müşteri
                                                    Bilgisi</b></a>
                                        </h6>
                                    </div>
                                    <div class="collapse show" id="accordion-item-customer"
                                         data-parent="#accordionCustomer">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-center">İsim Soyisim</td>
                                                        <td class="text-center"><?=$reservation->customer->fullname?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Email</td>
                                                        <td class="text-center"><?=$reservation->customer->email?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Telefon 1</td>
                                                        <td class="text-center"><?=$reservation->customer->phone_country?><?=$reservation->customer->phone?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Telefon 2</td>
                                                        <td class="text-center"><?=$reservation->customer->phone1?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Doğum günü</td>
                                                        <td class="text-center"><?=date('d-m-Y', strtotime($reservation->customer->birthday))?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Kimlik No</td>
                                                        <td class="text-center"><?=$reservation->customer->identity_no?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Ülkesi</td>
                                                        <td class="text-center"><?=$reservation->customer->nationality?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="accordion" id="accordionRightIconPrice">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                            <a class="text-default" data-toggle="collapse" href="#accordion-item-price"
                                               aria-expanded="true"><b>Ücret, Ödeme ve Komisyon Bilgisi</b></a>
                                        </h6>
                                    </div>
                                    <div class="collapse show" id="accordion-item-price"
                                         data-parent="#accordionRightIconPrice" style="height:250px">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6"
                                                     style="padding-left: 25px; padding-top: 10px;padding-bottom: 10px;">
                                                    <table
                                                        class="text-13 table table-bordered table-striped table-condensed table-nowrap-th vertical-middle table-hover">
                                                        <tbody>
                                                        <tr class="text-gray">
                                                            <th style="width:160px;">Ödeme Yöntemi</th>
                                                            <td colspan="2" class="text-right nowrap">
                                                                <?=Reservation::RESERVATION_PAYMENT_STRING[$reservation->payment_method]?>
                                                            </td>
                                                            <td colspan="2" class="text-right nowrap">
                                                                <button style="border: 0; cursor: pointer" type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#paymentChangeModal"><i
                                                                        class="i-Pen-4"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-gray">
                                                            <th>Döviz</th>
                                                            <td colspan="2" class="text-right nowrap">
                                                                <?=$reservation->reservationCurrency->title?>
                                                            </td>
                                                            <td colspan="2" class="text-right nowrap">
                                                                <button style="border: 0; cursor: pointer" type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#currencyChangeModal">
                                                                    <i class="i-Pen-4"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Günlük Ücreti</th>
                                                            <td class="text-right nowrap text-bold text-info">
                                                                <span data-toggle="tooltip"
                                                                      data-original-title="Müşteri fiyatı"><i
                                                                        class="fa-info"></i></span>
                                                                <span><?=$reservation->day_price?></span>
                                                            </td>
                                                            <td style="width: 1px;"
                                                                class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Toplam Gün</th>
                                                            <td class="text-right nowrap text-bold text-info">
                                                                <span data-toggle="tooltip"
                                                                      data-original-title="Müşteri fiyatı"><i
                                                                        class="fa-info"></i></span>
                                                                <span><?=$reservation->days?></span>
                                                            </td>
                                                            <td style="width: 1px;" class="text-center nowrap"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6"
                                                     style="padding-left: 0;padding-top: 10px;padding-bottom: 0;    padding-right: 25px;">
                                                    <table
                                                        class="text-13 table table-bordered table-striped table-condensed table-nowrap-th vertical-middle table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <th style="width: 50%;">Kiralama Bedeli</th>
                                                            <td class="text-right nowrap"><?=$reservation->rent_price?></td>
                                                            <td style="width: 1px;"
                                                                class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Drop | Tek Yön Ücreti</th>
                                                            <td class="text-right nowrap text-bold text-info">
                                                                <span data-toggle="tooltip"
                                                                      data-original-title="Müşteri fiyatı"><i
                                                                        class="fa-info"></i></span>
                                                                <span><?=$reservation->drop_price?></span>
                                                            </td>
                                                            <td style="width: 1px;"
                                                                class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                            <td colspan="2" class="text-right nowrap">

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Adres / Otel - Teslim Ücreti</th>
                                                            <td class="text-right nowrap text-bold text-info">
                                                                <span data-toggle="tooltip" data-original-title="Müşteri fiyatı"><i class="fa-info"></i></span>
                                                                <span><?=$reservation->up_price?></span>
                                                            </td>
                                                            <td style="width: 1px;" class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                            <td colspan="2" class="text-right nowrap"></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 50%;">Ekstra Ücreti</th>
                                                            <td class="text-right nowrap"><?=$reservation->ekstra_price?></td>
                                                            <td style="width: 1px;" class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Müşteriden Alınacak</th>
                                                            <td class="text-right nowrap text-bold">
                                                                <i class="fa-info text-info" data-toggle="tooltip"
                                                                   title=""
                                                                   data-original-title="Müşteriden alınacak tutar rezervasyon ücretinden farklı olabilir"></i>
                                                                0
                                                            </td>
                                                            <td class="text-center nowrap">€</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Komisyon</th>
                                                            <td class="text-right nowrap text-bold">
                                                                <i class="text-info" data-toggle="tooltip"
                                                                   data-original-title="Hesaplanan">0</i>
                                                                <i class="fa-arrows-h"></i>
                                                                <i class="text-success" data-toggle="tooltip"
                                                                   data-original-title="Ödenen">0</i>
                                                            </td>
                                                            <td class="text-center nowrap">€</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Müşteri Toplam</th>
                                                            <td class="text-right nowrap text-bold text-info">
                                                                <span data-toggle="tooltip"
                                                                      data-original-title="Müşteri fiyatı"><i
                                                                        class="fa-info"></i></span>
                                                                <span><?=$reservation->total_amount?></span>
                                                            </td>
                                                            <td style="width: 1px;"
                                                                class="text-center nowrap"><?=$reservation->reservationCurrency->right_icon?></td>
                                                            <td colspan="2" class="text-right nowrap">
                                                                <button style="border: 0; cursor: pointer" type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#pricesChangeModal"><i
                                                                        class="i-Pen-4"></i></button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <!-- right control icon-->
                            <div class="accordion" id="accordionRightIconEk">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                            <a class="text-default" data-toggle="collapse" href="#accordion-item-ek"
                                               aria-expanded="true"><b>Ek Ürünler</b></a>
                                        </h6>
                                    </div>
                                    <div class="collapse show" id="accordion-item-ek"
                                         data-parent="#accordionRightIconEk" style="padding: 10px;">
                                        <form style="margin-bottom: 0" method="post"
                                              action="{{route('admin.admin.reservation.changeekstra')}}">
                                            @csrf
                                            <input name="id" value="<?=$reservation->id?>" type="hidden">
                                            <input name="ekstra_total" value="@{{ekstra_total}}" type="hidden">
                                            <input name="days" value="<?=$reservation->days?>" type="hidden">
                                            <div class="card-body ekstraproduct"
                                                 ng-init="ekstralistarray(<?=$reservation->id?>)">
                                                <table
                                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 35%">Ekstra Adı</th>
                                                        <th style="width: 20%">Seçim</th>
                                                        <th style="width: 15%">Fiyat</th>
                                                        <th style="width: 15%">Toplam</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="ekstra in ekstralist">
                                                        <td>@{{ekstra.title}} (@{{ekstra.sellType}})</td>

                                                        <td>
                                                            <div class="input-group number-spinner">
                                                                <span class="input-group-btn">
                                                                    <button type="button" style="padding-bottom: 0;"
                                                                            class="btn btn-default"
                                                                            data-dir="dwn"
                                                                            ng-click="add_ekstra('dwn',ekstra.id,0,ekstra.price,<?=$reservation->days?>,<?=$reservation->currency_price?>,ekstra.sellType)"
                                                                            data-price="ekstra.price"
                                                                            data-days="ekstra.price"
                                                                            ng-disabled="ekstra.mandatoryInContract == 'yes'"><span
                                                                            style=" font-size: 18px;font-weight: 800; padding-bottom: 0;"
                                                                            class="i-Remove">
                                                                        </span>
                                                                    </button>
                                                                </span>
                                                                <input style="font-size: 13px; height: 30px;"
                                                                       name="ekstra[@{{ ekstra.id }}][value]"
                                                                       type="text"
                                                                       class="form-control text-center"
                                                                       id="model_ekstra_@{{ ekstra.id }}"
                                                                       value="@{{ ekstra.current_value }}">
                                                                <input name="ekstra[@{{ ekstra.id }}][id]" type="hidden"
                                                                       value="@{{ ekstra.id }}">
                                                                <input name="ekstra[@{{ ekstra.id }}][total]"
                                                                       type="hidden"
                                                                       class="ekstratotal ekstra_@{{ ekstra.id }}">
                                                                <span class="input-group-btn">
					                     <button type="button" style="padding-bottom: 0;" class="btn btn-default"
                                                 data-dir="up"
                                                 ng-click="add_ekstra('up',ekstra.id,ekstra.value,ekstra.item_price,<?=$reservation->days?>,<?=$reservation->currency_price?>,ekstra.sellType)"
                                                 data-price="@{{ ekstra.price }}" data-days="@{{ days }}"
                                                 ng-disabled="ekstra.mandatoryInContract == 'yes'"><span
                                                 style="font-size: 18px;font-weight: 800; padding-bottom: 0;"
                                                 class="i-Add"></span></button></span>
                                                            </div>
                                                        </td>
                                                        <td>@{{ekstra.price | number : 2}} <?=$reservation->reservationCurrency->right_icon?></td>
                                                        <td id="ekstra_@{{ ekstra.id }}"> @{{ (ekstra.item_price | currency:'')}} <?=$reservation->reservationCurrency->right_icon?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer" style="padding-left: 0;">
                                                <button style="width: 100%" class="btn btn-danger" type="submit">
                                                    Kaydet
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                            <!-- /right control icon-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                </div>
                <div class="col-md-12"></div>
                <div class="col-md-12"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <!-- right control icon-->
                    <div class="accordion" id="accordionHistory">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a class="text-default collapsed" data-toggle="collapse"
                                       href="#accordion-item-history" aria-expanded="false"><b>Plaka Hareketleri</b>
                                    </a></h6>
                            </div>
                            <div class="collapse" id="accordion-item-history" data-parent="#accordionHistory"
                                 style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="text-13 table table-hover table-condensed vertical-middle">
                                            <thead>
                                            <tr>
                                                <td width="10%">İşlemi Zamanı</td>
                                                <td width="10%">Kullanıcı</td>
                                                <td width="10%">Plaka</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($reservation->reservationPlate as $item){ ?>
                                            <tr>
                                                <td width="10%" style="vertical-align: middle">
                                                    <b>{{\Carbon\Carbon::parse($item['created_at'])->format('d-m-Y')}}
                                                </td>
                                                <td width="10%" style="vertical-align: middle">
                                                    <b><?=User::find($item->id_user)->name?></td>
                                                <td>{{$item->getPlate->plate}}</td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /right control icon-->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <!-- right control icon-->
                    <div class="accordion" id="accordionHistory">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a class="text-default collapsed" data-toggle="collapse"
                                       href="#accordion-item-history" aria-expanded="false"><b>İşlem Geçmişi</b>
                                    </a></h6>
                            </div>
                            <div class="collapse" id="accordion-item-history" data-parent="#accordionHistory"
                                 style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="text-13 table table-hover table-condensed vertical-middle">
                                            <thead>
                                            <tr>
                                                <td width="15%">İşlemi Yapan</td>
                                                <td width="10%">İşlemi Tipi</td>
                                                <td width="10%">Zaman</td>
                                                <td width="65%">Açıklama</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach($reservationlog as $item){ ?>
                                            <tr>
                                                <td style="vertical-align: middle"><b><?=$item['user']?></b></td>
                                                <td style="vertical-align: middle"><b><?=$item['description']?></b></td>
                                                <td style="vertical-align: middle">
                                                    <b>{{\Carbon\Carbon::parse($item['created_at'])->format('d-m-Y H:i')}}</b>
                                                </td>
                                                <td style="vertical-align: middle"><b>
                                                        <?php

                                                        if (gettype($item['detail']) == "json") {
                                                            echo json_decode($item['detail']);
                                                        } else {
                                                            echo $item['detail'];
                                                        }

                                                        ?>
                                                    </b></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <!-- right control icon-->
                    <div class="accordion" id="accordionHistory">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a class="text-default collapsed" data-toggle="collapse"
                                       href="#accordion-item-history" aria-expanded="false"><b>Anket Cevapları</b>
                                    </a></h6>
                            </div>
                            <div class="collapse" id="accordion-item-history" data-parent="#accordionHistory"
                                 style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="text-13 table table-hover table-condensed vertical-middle">
                                            <thead>
                                            <tr>
                                                <td width="10%">Soru</td>
                                                <td width="15%">Cevap</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($reservation->reservationSurvey)
                                            {
                                            $reservationsurvey = unserialize(json_decode($reservation->reservationSurvey->answers));
                                            foreach($reservationsurvey as $key => $value){ ?>
                                            <?php $reservationsurveyanswer = \App\Models\Survey::find($key);
                                            ?>
                                            <tr>
                                                <td style="vertical-align: middle">
                                                    <b><?php echo $reservationsurveyanswer->survey_language->name; ?></b>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <?php
                                                    $sort = \App\Models\ReservationSurvey::answer($value);
                                                    if (!is_null($sort)) {
                                                        if ($sort->sort == 1) {
                                                            echo '<div data-toggle="tooltip" title="" data-original-title=""><span class="text-success"><i class="i-Like-2"></i> Evet</span></div>';
                                                        }
                                                    }else{
                                                        echo $value;
                                                    }

                                                    ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Rezervasyon İle İglili Mail Gönderme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="model-header" style="margin: 1rem 0 0 0;">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-success"
                                    ng-click="getPage('comfirm',{{$reservation->id}},'comfirm',1)"
                                    type="button">Onay Maili
                            </button>
                            <button class="btn btn-danger" ng-click="getPage('cancel',{{$reservation->id}},'closed',2)"
                                    type="button">Red Maili
                            </button>
                            <button class="btn btn-primary"
                                    ng-click="getPage('reservation_edit',{{$reservation->id}},'reservation_edit',4)"
                                    type="button">Geliş Dönüş Bilgileri
                            </button>
                        </div>
                    </div>
                </div>
                <hr style="width: 100%;margin-top: 1rem; margin-bottom: 1rem;">
                <div class="modal-body">
                    <form class="form-group" method="post" id="mailForm" enctype="multipart/form-data"
                          action="{{route('admin.admin.reservation.addmail')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row" style="z-index: 99999;">
                                <input name="id" value="{{$reservation->id}}" type="hidden">

                                <input name="file" value="@{{file}}" type="hidden">
                                <input name="status" value="@{{status}}" type="hidden">
                                <input id="template_id" name="template_id" value="@{{template_id}}" type="hidden" required>
                                <div class="col-md-4 form-group mb-3">
                                    <label><b>Mail Gönderilecek Adres</b></label>
                                    <input class="form-control" name="email"
                                           value="{{$reservation->customer->email}}" type="email">
                                </div>
                            </div>
                            <hr/>
                            </br>
                            <textarea class="form-control" rows="5" name="ekstraMessage">

                            </textarea>
                            </br>

                            <div style="width: 100%;font-size: 12px" rows="20" ng-bind-html="message"></div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary submitForm ml-2" onclick="control()"  type="button">GÖNDER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="plateModal" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Onaylama Ve Plaka Atama</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="model-header">
                    <div class="col-md-12">
                        <?php if(isset($reservation->plate)){ ?>
                           <?php if($reservation->plate == 0){ ?> <span style="font-size:16px;font-weight: bold; color: #f00">*Atanmadı.</span> <?php }else{ ?>
                              <span style="font-size:16px;font-weight: bold; color: #f00">* <?=$reservation->getPlate->plate?> plakalı araç atanmıştır.</span>
                           <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.addplate')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <table
                            class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 25%;">Plaka Atama</th>
                                <td>
                                    <select id="mySelect2" class="form-control  js-example-basic-single"
                                            data-live-search="true" name="plate">
                                        <option value="0">PLAKASIZ</option>
                                        <?php foreach ($plates as $key => $value){ ?>

                                        <optgroup label="<?php $brand = \App\Models\CarModel::find($key)->brandid;  $x = \App\Models\Brand::find($brand); echo $x->brandname ?? "Bulunamadı";  ?> {{\App\Models\CarModel::find($key)->modelname}}">
                                            @foreach($value as $item)
                                                <?php $dropdata = $data->getDropData($item->id); ?>
                                                    <option @if($reservation->plate == $item->id) selected @endif value="<?=$item->id?>"><?=$item->plate?>
                                                        | <?php echo $item->car->fuel . " " . $item->car->transmission ?>
                                                        | <?=$dropdata['checkout']?>-<?=$dropdata['checkouttime']?>
                                                        | <?=$dropdata['droplocation']?> | REZ = <?=$dropdata['reservation_id']?></option>
                                            @endforeach
                                        </optgroup>
                                        <?php } ?>
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

    <div class="modal fade" id="daysModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Dönüş Değiştir</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" action="{{route('admin.admin.reservation.changedays')}}">
                    <div class="modal-body">
                        @csrf
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <table
                            class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 25%;">Dönüş Tarihi</th>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" id="datepicker"
                                               value="{{ \Carbon\Carbon::parse($reservation->checkout)->format('d-m-Y')}}"
                                               name="checkout" class="form-control"/>
                                        <div class="input-group-append">
                                            <?php $explode = explode(":", $reservation->reservationInformation->checkout_time); ?>
                                            <select name="time1" type="number"
                                                    style="height: 34px;width: 51px;text-indent: 5px;border: 1px solid #ccc;">
                                                <?php for($i = 1; $i < 24; $i++){ ?>
                                                <option @if($i == $explode[0]) selected
                                                        @endif value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                            <select name="time2" type="number"
                                                    style="height: 34px;width: 51px;border: 1px solid #ccc;">
                                                <option @if("00" == $explode[1]) selected @endif value="00">00</option>
                                                <option @if("15" == $explode[1]) selected @endif value="15">15</option>
                                                <option @if("30" == $explode[1]) selected @endif value="30">30</option>
                                                <option @if("45" == $explode[1]) selected @endif value="45">45</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 25%;">Ödeme Tutarı</th>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="price"
                                               aria-label="Text input with checkbox">
                                        <span
                                            style="width: 50px;text-align: center;background: #fd0000;color: #fff;font-size: 24px;">{{$reservation->reservationCurrency->right_icon}}</span>
                                        <input type="hidden" name="id_currency" value="{{$reservation->id_currency}}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span style="float: right;color: #f00;font-weight: 700;">* Ödeme Alındımı ?</span>
                                                <input style="    width: 20px;
    height: 20px;
    margin-left: 10px;" type="checkbox" name="rest" aria-label="Ödeme Alındı mı?" data-title="Ödeme Alındır mı ?"
                                                       title="Ödeme Alındı mı ?">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 25%;">Not</th>
                                <td>
                                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                        <button class="btn btn-primary ml-2" type="submit"
                                onclick="javascript:return confirm('Tarih Değişikliği yapmak istediğinizden eminmisiniz ?')">
                            Kaydet
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Dönüş İşlemleri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.process')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <input name="type" value="up" type="hidden">
                        <table
                            class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 40%;">Personel</th>
                                <td>
                                    <select class="form-control" name="id_user">
                                        <?php foreach($users as $user){ ?>
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>KM</th>
                                <td>
                                    <input class="form-control" name="km" type="number"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Yakıt</th>
                                <td>
                                    <select class="form-control" name="fuel">
                                        <option value="1">1/8</option>
                                        <option value="2">2/8</option>
                                        <option value="3">3/8</option>
                                        <option value="4">4/8</option>
                                        <option value="5">5/8</option>
                                        <option value="6">6/8</option>
                                        <option value="7">7/8</option>
                                        <option value="8">8/8</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Çıkış Resimler</th>
                                <td>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="inputGroupFile02" name="file[]" type="file"
                                               multiple>
                                        <label class="custom-file-label" for="inputGroupFile02"
                                               aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                    </div>
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

    <div class="modal fade" id="dropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Çıkış İşlemleri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.process')}}">
                    <div class="modal-body">
                        @csrf
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <input name="type" value="drop" type="hidden">
                        <table
                            class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 20%;">Personel</th>
                                <td>
                                    <select name="id_user" class="form-control">
                                        <?php foreach($users as $user){ ?>
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>KM</th>
                                <td>
                                    <input class="form-control" name="km" type="number"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Yakıt</th>
                                <td>
                                    <select class="form-control" name="fuel">
                                        <option value="1">1/8</option>
                                        <option value="2">2/8</option>
                                        <option value="3">3/8</option>
                                        <option value="4">4/8</option>
                                        <option value="5">5/8</option>
                                        <option value="6">6/8</option>
                                        <option value="7">7/8</option>
                                        <option value="8">8/8</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Dönüş Resimler</th>
                                <td>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="inputGroupFile02" name="file[]" type="file"
                                               multiple>
                                        <label class="custom-file-label" for="inputGroupFile02"
                                               aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary ml-2" type="button">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: block;" aria-hidden="false">
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
                        <tbody ng-init="getComment(<?=$reservation->id?>)">
                        <tr ng-repeat="comment in comments">
                            <td class="nowrap">@{{ comment.id_user }}</td>
                            <td class="nowrap">
                                <span ng-if="comment.type == 'closed'" class="text-gray">İptal</span>
                                <span ng-if="comment.type == 'noted'" class="text-gray">Not</span>
                            </td>
                            <td class="table-container">@{{ comment.messages }}</td>
                            <td class="nowrap">@{{ comment.created_at | date:'d-MM-yyyy HH:mm:ss' }}</td>
                            <td class="nowrap">
                                <a style="    cursor: pointer;"
                                   ng-click="commentDelete(comment.id,<?=$reservation->id?>)">
                                    <img style="width: 24px;"
                                         src="https://worldcarrental.com/public/assets/images/bin.png">
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="height: 10px;"></div>
                    <form class="form-group" id="notes" method="post" enctype="multipart/form-data"
                          ng-submit="addComment(<?=$reservation->id?>)">
                        @csrf
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="input-group">
                            <select style="width: 10%;float: left" name="type">
                                <option value="noted">Mesaj</option>
                                <option value="closed">İptal</option>
                            </select>
                            <input style="width: 83.5%;float: left" type="text" name="messages"
                                   placeholder="Yeni ekle..">
                            <span class="input-group-addon separator"></span>
                            <span style="width: 5%;float: left" class="input-group-btn"> <button type="submit"
                                                                                                 style="border-radius: 0; margin: 1px 0;height: 35px;"
                                                                                                 class="btn btn-primary btn-add note_add">Ekle</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newMailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Rezervasyon İle İglili Mail Gönderme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <hr style="width: 100%;margin-top: 1rem; margin-bottom: 1rem;">
                <div class="modal-body">
                    <form class="form-group" method="post" enctype="multipart/form-data"
                          action="{{route('admin.admin.reservation.addmail')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row" style="z-index: 99999;">
                                <input name="id" value="{{$reservation->id}}" type="hidden">
                                <input name="file" value="normal" type="hidden">
                                <input name="status" value="normal" type="hidden">
                                <input name="template_id" value="9" type="hidden">
                                <div class="col-md-6 form-group mb-3">
                                    <label><b>Mail Gönderilecek Adres</b></label>
                                    <input class="form-control" name="email" value="{{$reservation->customer->email}}"
                                           type="email">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label><b>Konu</b></label>
                                    <input class="form-control" name="subject" value="" type="text">
                                </div>
                            </div>
                            <hr/>
                            </br>
                            <textarea class="form-control" rows="5" name="ekstraMessage"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary ml-2" type="submit">GÖNDER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentChangeModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Ödeme Tipi Güncelle</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changepaymentmethod')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="form-group mb-3">
                            <label for="picker1">Ödeme Tipi</label>
                            <select class="form-control text-13" name="payment_method">
                                <option value="debit-card">Havale &amp; EFT</option>
                                <option value="delivery-debit-card">Araç Tesliminde Nakit &amp; K. Kartı</option>
                                <option value="debit-cash">Araç Tesliminde Nakit Ödeme Yapın</option>
                                <option value="online-credit-card">Online Ödeme</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="currencyChangeModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Kur Değiştirme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changecurrency')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="form-group mb-3">
                            <label for="picker1">Kur Değiştirme</label>
                            <select class="form-control text-13" name="id_currency">
                                <?php foreach ($currencies as $currency){ ?>
                                <option @if($reservation->id_currency == $currency->id) selected
                                        @endif value="<?=$currency->id?>"><?=$currency->title?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pricesChangeModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Fiyat Değiştirme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changeprice')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <input name="days" value="{{$reservation->days}}" type="hidden">
                        <div class="form-group mb-3">
                            <label for="picker1">Toplam Tutar</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="total_amount"
                                       value="<?=$reservation->total_amount?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="picker1">Kiralama Tutarı</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="day_price"
                                       value="<?=$reservation->rent_price?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="picker1">Günlük Tutar</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="day_price"
                                       value="<?=$reservation->day_price?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="picker1">Tek Yön Ücreti</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="drop_price"
                                       value="<?=$reservation->drop_price?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="picker1">Teslim Ücreti</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="up_price"
                                       value="<?=$reservation->up_price?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="picker1">Ekstra Tutar</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="ekstra_price"
                                       value="<?=$reservation->ekstra_price?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Müşterinin Ödediği Tutar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changerest')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="form-group mb-3">
                            <label for="picker1">Müşterinin Ödediği Tutar</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="total_amount"
                                       value="<?=$reservation->total_amount - $reservation->rest?>">
                                <div class="input-group-append"><span
                                        class="input-group-text"><?=$reservation->reservationCurrency->right_icon?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dateChangeModal"  role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Tarih ve Saat / Alış - Teslim Yeri
                        Güncelleme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changelocation')}}">
                    @csrf

                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="card-body" style="    padding: 10px;">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Alış Lokasyon - Tarih Saat Bilgileri</label>
                                <div class="input-group" style="    flex-wrap: unset !important;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">=></span>
                                    </div>
                                    <select name="up_location" style="width: 92%;" id="location5" onchange="getDropLocation(<?=$reservation->reservationInformation->drop_location?>)"  class="form-control  js-example-basic-single"
                                            data-live-search="true"  required>
                                        <option value="">Alış Yeri Seçiniz</option>
                                        <?php foreach ($center_location_pick_up as $item){ if($item->id_parent == 0){ ?>
                                        <optgroup label="<?=$item->title?>">
                                            <?php foreach ($center_location_pick_up as $item1){  if($item1->id_parent == $item->id){ ?>
                                            <option
                                                <?php if ($item1->id == $reservation->reservationInformation->up_location) {
                                                    echo "selected";
                                                } ?> value="<?=$item1->id?>"><?=$item1->title?></option>
                                            <?php }} ?>
                                        </optgroup>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group" style="width: 66%;float: left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    </div>
                                    <input style="font-size: 13px !important;" name="up_date"
                                           value="{{ \Carbon\Carbon::parse($reservation->checkin)->format('d-m-Y') }}"
                                           type="text" class="form-control" id="up_datepicker" required>
                                </div>
                                <div class="input-group input-group-lg bootstrap-timepicker"
                                     style="width:34%;float: right">
                                    <div class="input-group-addon"
                                         style="width: 35px;background: #eeeeee; text-align: center;">
                                        <span style="height: 34px;" class="input-group-text" id="inputGroupPrepend2">
                                            <span style="font-size: 19px;font-weight: 600;margin-left: -5px;"
                                                  class="i-Time-Backup"></span>
                                        </span>
                                    </div>
                                    <input name="up_time" type="text" class="timepicker"
                                           value="{{$reservation->checkin_time}}"
                                           style="border-radius: 0;    width: 75%;"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="    padding: 10px;">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Dönüş Lokasyon - Tarih Saat Bilgileri - <?=$reservation->reservationInformation->drop_location?></label>
                                <div class="input-group" style="    flex-wrap: unset !important;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">=></span>
                                    </div>
                                    <select name="drop_location" style="    width: 92%;" id="drop_location"   data-live-search="true"  required>
                                        <option value="">Dönüş Yeri Seçiniz</option>
                                        <?php foreach ($center_location_pick_up as $item){ if($item->id_parent == 0){ ?>
                                        <optgroup label="<?=$item->title?>">
                                            <?php foreach ($center_location_pick_up as $item1){ if($item1->id_parent == $item->id){ ?>
                                            <option
                                                <?php if ($item1->id == $reservation->reservationInformation->drop_location) {  echo "selected"; }
                                                ?>

                                                value="<?=$item1->id?>"><?=$item1->title?></option>
                                            <?php }} ?>
                                        </optgroup>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group" style="width: 66%;float: left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    </div>
                                    <input style="font-size: 13px !important;" name="drop_date" type="text"
                                           class="form-control"
                                           value="{{ \Carbon\Carbon::parse($reservation->checkout)->format('d-m-Y') }}"
                                           id="drop_datepicker" required>
                                </div>
                                <div class="input-group input-group-lg bootstrap-timepicker"
                                     style="width:34%;float: right">
                                    <div class="input-group-addon"
                                         style="width: 35px;background: #eeeeee; text-align: center;">
                                        <span style="height: 34px;" class="input-group-text"
                                              id="inputGroupPrepend2"><span
                                                style="font-size: 19px;font-weight: 600;margin-left: -5px;"
                                                class="i-Time-Backup"></span></span>
                                    </div>
                                    <input name="drop_time" type="text" class="timepicker"
                                           value="{{$reservation->checkout_time}}"
                                           style="border-radius: 0;    width: 76%;" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailChangeModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Rezervayon Detay Güncelleme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.changedetail')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="{{$reservation->id}}" type="hidden">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="text-13 table table-bordered table-striped table-condensed table-nowrap-th vertical-middle">
                                    <tbody>
                                    <?php $reservationdetail = $reservation->reservationInformation->up_drop_information;
                                    if($reservationdetail){ $details = json_decode($reservationdetail, true); ?>
                                    <?php foreach ($details as $key => $detail){  ?>
                                    <tr>
                                        <th style="width: 20%;">
                                            <select class="form-control" name="info[<?=$key?>][type]">
                                                <option
                                                    <?php if ($key . "_hotel" == $detail["type"]) {
                                                        echo "selected";
                                                    } ?> value="<?=$key?>_hotel">
                                                    Otel Teslimi
                                                </option>
                                                <option
                                                    <?php if ($key . "_airport" == $detail["type"]) {
                                                        echo "selected";
                                                    } ?> value="<?=$key?>_airport">
                                                    Havalimanı Teslimi
                                                </option>
                                                <option
                                                    <?php if ($key . "_address" == $detail["type"]) {
                                                        echo "selected";
                                                    } ?> value="<?=$key?>_address">
                                                    Adres Teslimi
                                                </option>
                                                <option
                                                    <?php if ($key . "_center" == $detail["type"]) {
                                                        echo "selected";
                                                    } ?> value="<?=$key?>_center">
                                                    Ofis Teslimi
                                                </option>
                                            </select>
                                        </th>
                                        <td>
                                            <label style="font-size: 16px;">Havalimanı/Otel/Adres</label><br>
                                            <input class="form-control" type="text" name="info[<?=$key?>][key]"
                                                   value="<?=$detail["key"]?>"/>
                                        </td>
                                        <td>
                                            <label style="font-size: 16px;">Oda No/Uçuş No/Adres</label><br>
                                            <input class="form-control" type="text" name="info[<?=$key?>][value]"
                                                   value="<?=$detail["value"]?>"/>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php }else{ ?>
                                    <tr>
                                        <th style="width: 20%;">
                                            <select class="form-control" name="info[up][type]">
                                                <option value="up_hotel">Otel Teslimi</option>
                                                <option value="up_airport">Havalimanı Teslimi</option>
                                                <option value="up_address"> Adres Teslimi</option>
                                                <option value="up_center"> Ofis Teslimi</option>
                                            </select>
                                        </th>
                                        <td>
                                            <label style="font-size: 16px;">Havalimanı/Otel/Adres</label><br>
                                            <input class="form-control" type="text" name="info[up][key]" value=""/>
                                        </td>
                                        <td>
                                            <label style="font-size: 16px;">Oda No/Uçuş No/Adres</label><br>
                                            <input class="form-control" type="text" name="info[up][value]" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 20%;">
                                            <select class="form-control" name="info[drop][type]">
                                                <option value="drop_hotel"> Otel Teslimi</option>
                                                <option value="drop_airport"> Havalimanı Teslimi</option>
                                                <option value="drop_address"> Adres Teslimi</option>
                                                <option value="drop_center"> Ofis Teslimi</option>
                                            </select>
                                        </th>
                                        <td>
                                            <label style="font-size: 16px;">Havalimanı/Otel/Adres</label><br>
                                            <input class="form-control" type="text" name="info[drop][key]" value=""/>
                                        </td>
                                        <td>
                                            <label style="font-size: 16px;">Oda No/Uçuş No/Adres</label><br>
                                            <input class="form-control" type="text" name="info[drop][value]" value=""/>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit -->


    <script>
        $("#noteModal").modal('show');
        $("#status").change(function () {
            var status = $(this).val();
            var reservationId = $(this).attr("data-id");
            $("#noteModal").modal('show');
            $('.note_add').click(function () {
                $.ajax({
                    url: "/admin/admin/reservation/statusChange?id=" + reservationId + "&status=" + status + "",
                    type: "get",
                    success: function (response) {
                        $("#noteModal").modal('hide');
                        swal("Durum Değiştirildi", "Başarılı", "");
                        window.location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>

    <script>
        function control()
        {
           var x = $('#template_id').val();
           if(x == "")
           {
               alert("Mail Tipi Seçiniz");
           }else{
               $('.submitForm').prop('disabled', true);
               $('.submitForm').val('Sending, please wait...');
               $('#mailForm').submit();
           }
        }
    </script>

    <script src="{{ asset('public/js/angularcustom.js') }}"></script>

@endsection


<script>
    function getDropLocation(drop_location_id) {
        var id =  $("#location5 option:selected" ).val();
        if (id == "") {
            var id_location = 0;
        } else if (id == undefined) {
            var id_location = 0;
        } else {
            var id_location = id;
        }
        $.ajax({
            type: 'GET',
            url: '/getDropLocation?id=' + id_location + '',
            success: function (data) {
                $("#drop_location").html(' ');
                var row = "";
                var x = 0;
                $.each(data, function (key, value) {
                    if (value.id_parent == 0) {
                        row += '<optgroup label="' + value.title + '">';
                        $.each(value.parentList, function (keys, values) {
                            row += '<option '+ if(drop_location_id == values.id){ +' selected '+}+' value="' + values.id + '">' + values.title + '</option>';
                        });
                        row += '</optgroup>';
                    }

                    x++;
                });
                $("#drop_location").append(row);
            }
        });
    }

</script>
<style>
    .CToWUdImg {
        width: 40px;
    }

    .CToWUdLEFT {
        width: 100px;
    }

    .CToWUdCENTER {
        width: 700px;
    }
</style>
<link rel="stylesheet" href="{{ asset('public/assets/lightbox/css/lightbox.min.css') }}">
<script src="{{ asset('public/assets/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>


