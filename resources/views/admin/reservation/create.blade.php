@extends('layouts.admin')

@section('content')
    <?php
    use App\Repository\Data;
    $data = new Data();
    ?>
    <form id="rezervationcreateform" action="/admin/admin/reservation/save" method="post" autocomplete="off">
        @csrf
        <div class="row justify-content-center text-13 imp">
            <div class="col-md-4">
                <div class="card" style="border-radius: 0px;">
                    <div class="card-title"
                         style="margin-bottom:5px;font-size: 15px;text-align: center;border-bottom: 1px solid #ccc;line-height: 3;">
                        <span style=" float: left; margin-left: 55px;">Para Birimi</span>
                        <span style="    float: right; margin-right: 85px;">Rezervasyon Kaynağı</span>
                    </div>
                    <div class="card-body">
                        <div class="row row-xs " style="    width: 97%;margin: 0 auto;">
                            <div class="col-md-6 p-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                style="font-size: 19px;font-weight: 600;"
                                                class="i-Money-Bag"></i></span>
                                    </div>
                                    <select name="currency"
                                            style="width: 165px;border-radius: 0;border: 1.5px solid #ccc;">
                                        <?php foreach ($currency as $item){ ?>
                                        <option
                                            value="EUR_<?=$item->left_icon?>" <?php if ('EUR_' . $item->left_icon == 'EUR_EUR') {
                                            echo "selected";
                                        } ?>><?=$item->title?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                style="font-size: 19px;font-weight: 600;"
                                                class="i-Telephone"></i></span>
                                    </div>
                                    <select name="reservation_source"
                                            style="width: 165px;border-radius: 0;border: 1.5px solid #ccc;">
                                        <option
                                            {{ old('reservation_source') ==  "phone" ? 'selected' : '' }} value="phone">
                                            Telefon
                                        </option>
                                        <option
                                            {{ old('reservation_source') ==  "whatsapp" ? 'selected' : '' }} value="whatsapp">
                                            Whatsapp
                                        </option>
                                        <option
                                            {{ old('reservation_source') ==  "facebook" ? 'selected' : '' }} value="facebook">
                                            Facebook
                                        </option>
                                        <option
                                            {{ old('reservation_source') ==  "instagram" ? 'selected' : '' }} value="instagram">
                                            İnstagram
                                        </option>
                                        <option
                                            {{ old('reservation_source') ==  "google" ? 'selected' : '' }} value="google">
                                            Google
                                        </option>
                                        <option
                                            {{ old('reservation_source') ==  "recommends" ? 'selected' : '' }} value="recommends">
                                            Öneri
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style=" margin-top: 10px">
                    {{--                <div class="card-title" style=" margin-bottom:0px;     font-size: 15px;text-align: center;border-bottom: 1px solid #ccc;line-height: 3;">Yer Ve Zaman </div>--}}
                    <div class="card-body" style="    padding: 10px;">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Alış Lokasyon - Tarih Saat Bilgileri</label>
                            <div class="input-group" style="    flex-wrap: unset !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">=></span>
                                </div>
                                <select name="up_location" style="width: 92%;" id="location" onchange="getDropLocation(this)" required>
                                    <option value="">Alış Yeri Seçiniz</option>
                                    <?php foreach ($center_location_pick_up as $item){ if($item->id_parent == 0){ ?>
                                    <optgroup label="<?=$item->title?>">
                                        <?php foreach ($center_location_pick_up as $item1){ if($item1->id_parent == $item->id){ ?>
                                        <option
                                            {{ old('up_location') ==  $item1->id ? 'selected' : '' }} value="<?=$item1->id?>"><?=$item1->title?></option>
                                        <?php }} ?>
                                    </optgroup>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" style="width: 60%;float: left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                </div>
                                <input style="font-size: 13px !important;" name="up_date" value="{{ old('up_date') }}"
                                       type="text" class="form-control" id="up_datepicker" required>
                            </div>
                            <div class="input-group input-group-lg bootstrap-timepicker" style="width:40%;float: right">
                                <div class="input-group-addon"
                                     style="width: 35px;background: #eeeeee; text-align: center;">
                                <span style="height: 34px;" class="input-group-text" id="inputGroupPrepend2">
                                    <span style="font-size: 19px;font-weight: 600;margin-left: -5px;"
                                          class="i-Time-Backup"></span>
                                </span>
                                </div><!--{{old('up_time')}}-->
                                <select name="up_time" type="text" class="timepickerx"
                                        style="border-radius: 0;    width: 78%;" required>
                                    <option value="00:00">00:00</option>
                                    <option value="00:15">00:15</option>
                                    <option value="00:30">00:30</option>
                                    <option value="00:45">00:45</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:15">01:15</option>
                                    <option value="01:30">01:30</option>
                                    <option value="01:45">01:45</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:15">02:15</option>
                                    <option value="02:30">02:30</option>
                                    <option value="02:45">02:45</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:15">03:15</option>
                                    <option value="03:30">03:30</option>
                                    <option value="03:45">03:45</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:15">04:15</option>
                                    <option value="04:30">04:30</option>
                                    <option value="04:45">04:45</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:15">05:15</option>
                                    <option value="05:30">05:30</option>
                                    <option value="05:45">05:45</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:15">06:15</option>
                                    <option value="06:30">06:30</option>
                                    <option value="06:45">06:45</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:15">07:15</option>
                                    <option value="07:30">07:30</option>
                                    <option value="07:45">07:45</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:15">08:15</option>
                                    <option value="08:30">08:30</option>
                                    <option value="08:45">08:45</option>
                                    <option value="09:00" selected>09:00</option>
                                    <option value="09:15">09:15</option>
                                    <option value="09:30">09:30</option>
                                    <option value="09:45">09:45</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:15">10:15</option>
                                    <option value="10:30">10:30</option>
                                    <option value="10:45">10:45</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:15">11:15</option>
                                    <option value="11:30">11:30</option>
                                    <option value="11:45">11:45</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:15">12:15</option>
                                    <option value="12:30">12:30</option>
                                    <option value="12:45">12:45</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:15">13:15</option>
                                    <option value="13:30">13:30</option>
                                    <option value="13:45">13:45</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:15">14:15</option>
                                    <option value="14:30">14:30</option>
                                    <option value="14:45">14:45</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:15">15:15</option>
                                    <option value="15:30">15:30</option>
                                    <option value="15:45">15:45</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:15">16:15</option>
                                    <option value="16:30">16:30</option>
                                    <option value="16:45">16:45</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:15">17:15</option>
                                    <option value="17:30">17:30</option>
                                    <option value="17:45">17:45</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:15">18:15</option>
                                    <option value="18:30">18:30</option>
                                    <option value="18:45">18:45</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:15">19:15</option>
                                    <option value="19:30">19:30</option>
                                    <option value="19:45">19:45</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:15">20:15</option>
                                    <option value="20:30">20:30</option>
                                    <option value="20:45">20:45</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:15">21:15</option>
                                    <option value="21:30">21:30</option>
                                    <option value="21:45">21:45</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:15">22:15</option>
                                    <option value="22:30">22:30</option>
                                    <option value="22:45">22:45</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:15">23:15</option>
                                    <option value="23:30">23:30</option>
                                    <option value="23:45">23:45</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="    padding: 10px;">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Dönüş Lokasyon - Tarih Saat Bilgileri</label>
                            <div class="input-group" style="    flex-wrap: unset !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">=></span>
                                </div>
                                <select name="drop_location" style="    width: 92%;" id="drop_location" required>
                                    <option value="0">Dönüş Yeri Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" style="width: 60%;float: left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                </div>
                                <input style="font-size: 13px !important;" name="drop_date" type="text"
                                       class="form-control" value="{{ old('drop_date') }}" id="drop_datepicker"
                                       required>
                            </div>
                            <div class="input-group input-group-lg bootstrap-timepicker" style="width:40%;float: right">
                                <div class="input-group-addon"
                                     style="width: 35px;background: #eeeeee; text-align: center;">
                                <span style="height: 34px;" class="input-group-text" id="inputGroupPrepend2"><span
                                        style="font-size: 19px;font-weight: 600;margin-left: -5px;"
                                        class="i-Time-Backup"></span></span>
                                </div><!--{{old('drop_time')}}-->
                                <select name="drop_time" type="text" class="timepickerx" style="border-radius: 0;    width: 78%;" required>
                                    <option value="00:00">00:00</option>
                                    <option value="00:15">00:15</option>
                                    <option value="00:30">00:30</option>
                                    <option value="00:45">00:45</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:15">01:15</option>
                                    <option value="01:30">01:30</option>
                                    <option value="01:45">01:45</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:15">02:15</option>
                                    <option value="02:30">02:30</option>
                                    <option value="02:45">02:45</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:15">03:15</option>
                                    <option value="03:30">03:30</option>
                                    <option value="03:45">03:45</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:15">04:15</option>
                                    <option value="04:30">04:30</option>
                                    <option value="04:45">04:45</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:15">05:15</option>
                                    <option value="05:30">05:30</option>
                                    <option value="05:45">05:45</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:15">06:15</option>
                                    <option value="06:30">06:30</option>
                                    <option value="06:45">06:45</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:15">07:15</option>
                                    <option value="07:30">07:30</option>
                                    <option value="07:45">07:45</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:15">08:15</option>
                                    <option value="08:30">08:30</option>
                                    <option value="08:45">08:45</option>
                                    <option value="09:00" selected>09:00</option>
                                    <option value="09:15">09:15</option>
                                    <option value="09:30">09:30</option>
                                    <option value="09:45">09:45</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:15">10:15</option>
                                    <option value="10:30">10:30</option>
                                    <option value="10:45">10:45</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:15">11:15</option>
                                    <option value="11:30">11:30</option>
                                    <option value="11:45">11:45</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:15">12:15</option>
                                    <option value="12:30">12:30</option>
                                    <option value="12:45">12:45</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:15">13:15</option>
                                    <option value="13:30">13:30</option>
                                    <option value="13:45">13:45</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:15">14:15</option>
                                    <option value="14:30">14:30</option>
                                    <option value="14:45">14:45</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:15">15:15</option>
                                    <option value="15:30">15:30</option>
                                    <option value="15:45">15:45</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:15">16:15</option>
                                    <option value="16:30">16:30</option>
                                    <option value="16:45">16:45</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:15">17:15</option>
                                    <option value="17:30">17:30</option>
                                    <option value="17:45">17:45</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:15">18:15</option>
                                    <option value="18:30">18:30</option>
                                    <option value="18:45">18:45</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:15">19:15</option>
                                    <option value="19:30">19:30</option>
                                    <option value="19:45">19:45</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:15">20:15</option>
                                    <option value="20:30">20:30</option>
                                    <option value="20:45">20:45</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:15">21:15</option>
                                    <option value="21:30">21:30</option>
                                    <option value="21:45">21:45</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:15">22:15</option>
                                    <option value="22:30">22:30</option>
                                    <option value="22:45">22:45</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:15">23:15</option>
                                    <option value="23:30">23:30</option>
                                    <option value="23:45">23:45</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 10px">
                        <button type="button" ng-click="carlist($event)" style="width: 100%"
                                class="btn btn-lg btn-primary ladda-button " data-style="expand-right">Araçları Getir
                        </button>
                    </div>
                </div>
                <div class="card" style="margin: 10px 0;    padding: 10px;">

                    <div class="card-title"
                         style="    font-size: 15px;text-align: left;border-bottom: 1px solid #ccc;line-height: 3;">
                        Rezervasyon Alış / Dönüş Bilgileri
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="uptype == 'hotel'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Hotel Adı</th>
                                        <th style="width: 50%">
                                            <input name="info[up][type]" type="hidden" value="up_hotel"/>
                                            <input class="form-control" name="info[up][key]" type="text"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Oda No</th>
                                        <th style="width: 50%">
                                            <input class="form-control" name="info[up][value]" type="text"/>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="uptype == 'airport'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Havalimanı</th>
                                        <th style="width: 50%"><input name="info[up][type]" type="hidden"
                                                                      value="up_airport"/><input class="form-control"
                                                                                                 name="info[up][key]"
                                                                                                 type="text"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Uçuş Kodu</th>
                                        <th style="width: 50%"><input class="form-control" name="info[up][value]"
                                                                      type="text"/></th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="uptype == 'address'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Adres</th>
                                        <th style="width: 50%"><input name="info[up][type]" type="hidden"
                                                                      value="up_address"/><input class="form-control"
                                                                                                 name="info[up][key]"
                                                                                                 type="text"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : İl/İlçe</th>
                                        <th style="width: 50%"><input class="form-control" name="info[up][value]"
                                                                      type="text"/></th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="uptype == 'center'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Alış Yeri : Ofis</th>
                                        <th style="width: 50%"><b>Ofisten Teslim Alacak</b>
                                            <input type="hidden" name="info[up][type]" value="up_center"/>
                                            <input type="hidden" name="info[up][key]" value="0" type="text"/>
                                            <input type="hidden" name="info[up][value]" value="0" type="hidden"/>
                                        </th>
                                    </tr>

                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="droptype == 'hotel'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Hotel Adı</th>
                                        <th style="width: 50%">
                                            <input name="info[drop][type]" type="hidden" value="drop_hotel"/>
                                            <input class="form-control" name="info[drop][key]" type="text"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Oda No</th>
                                        <th style="width: 50%">
                                            <input class="form-control" name="info[drop][value]" type="text"/>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="droptype == 'airport'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Havalimanı</th>
                                        <th style="width: 50%">
                                            <input name="info[drop][type]" type="hidden" value="drop_airport"/>
                                            <input class="form-control" name="info[drop][key]" type="text"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Uçuş Kodu</th>
                                        <th style="width: 50%">
                                            <input class="form-control" name="info[drop][value]" type="text"/>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="droptype == 'address'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Adres</th>
                                        <th style="width: 50%">
                                            <input name="info[drop][type]" type="hidden" value="drop_address"/>
                                            <input class="form-control" name="info[drop][key]" type="text"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : İl / İlçe</th>
                                        <th style="width: 50%">
                                            <input class="form-control" name="info[drop][value]" type="text"/>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    ng-if="droptype == 'center'">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Dönüş Yeri : Ofis</th>
                                        <th style="width: 50%"><b>Ofisten Teslim Alacak</b>
                                            <input type="hidden" name="info[drop][type]" value="drop_center"/>
                                            <input type="hidden" name="info[drop][key]" value="0"/>
                                            <input type="hidden" name="info[drop][value]" value="0"/>
                                        </th>
                                    </tr>

                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="padding: 10px">
                    <div class="card-title">
                        <h4 style="width: 30%;float: left">Kiraya Verilebilecek Araçlar</h4>
                    </div>
                    <div class="card-body" style="height: 500px;overflow-x: auto;">
                        <table class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 font-weight-600 carlistclass">
                            <thead style="background: #003473;color: #fff;">
                            <tr>
                                <th>Araç Model</th>
                                <th>Plaka</th>
                                <th>Kaç Gün</th>
                                <th>Gün. Fyt</th>
                                <th>Kir. Fyt</th>
                                <th>Drop Ücr.</th>
                                <th>Teslim Ücr.</th>
                                <th>Toplam Fyt</th>
                                <th>Dönüş Bİl.</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in carlistarray" style="cursor: pointer;background: @{{ 'item.warningColor' }} "
                                ng-click="carselect(item.id,item.id_car,item.id_plate,item.days,item.price.day_price,item.price.rent_price,item.price.drop_price,item.price.up_price,item.currency,item.currency_price,item.currency_icon)"
                                id="tr_@{{item.id}}" >
                                <td>@{{ item.cars  }}</td>
                                <td>@{{ item.plate }}</td>
                                <td>@{{ item.days  }}</td>
                                <td>@{{ item.price.day_price  }} @{{ item.currency_icon }}</td>
                                <td>@{{ item.price.rent_price }} @{{ item.currency_icon }}</td>
                                <td>@{{ item.price.drop_price }} @{{ item.currency_icon }}</td>
                                <td>@{{ item.price.up_price   }} @{{ item.currency_icon }}</td>
                                <td>@{{ item.price.rent_price + item.price.up_price + item.price.drop_price }}
                                    @{{item.currency_icon }}
                                </td>
                                <td>
                                    <div>
                                        @{{ item.return.finish.reservation_name }}
                                        @{{ item.return.finish.reservation_date  | date:"dd-MM-yyyy" }}  @{{ item.return.finish.reservation_time | date:"hh:mm" }}
                                    </div>
                               </td>
                            </tr>
                            </tbody>
                        </table>
                        <div ng-class="myVar" style="margin: 0 auto !important;position: absolute;display: none;z-index: 999;left: 50%;"  class="carlistspin spinner-bubble spinner-bubble-primary m-5"></div>
                    </div>
                    <div class="card-body ekstraproduct" style="margin-top:20px;display: none">
                        <table class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <thead>
                            <tr>
                                <th style="width: 50%">Ekstra Adı</th>
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
                                        <button type="button" style="padding-bottom: 0;" class="btn btn-default"
                                                data-dir="dwn" ng-disabled="!@{{ ekstra.mandatoryInContract }}"
                                                ng-click="add_ekstra('dwn',ekstra.id,0,ekstra.price,ekstra.sellType)"
                                                data-price="ekstra.price" data-days="ekstra.price"><span
                                                style=" font-size: 18px;font-weight: 800; padding-bottom: 0;"
                                                class="i-Remove"></span></button>
                                    </span>
                                        <input style="font-size: 13px; height: 30px;"
                                               name="ekstra[@{{ ekstra.id }}][value]" type="text"
                                               class="form-control text-center" id="model_ekstra_@{{ ekstra.id }}"
                                               value="@{{ ekstra.mandatoryInContractvalue }}">
                                        <input name="ekstra[@{{ ekstra.id }}][id]" type="hidden"
                                               value="@{{ ekstra.id }}">
                                        <input name="ekstra[@{{ ekstra.id }}][total]" type="hidden"
                                               value="@{{ekstra.total_price}}"
                                               class="ekstratotal ekstra_@{{ ekstra.id }}">
                                        <span class="input-group-btn">
					                     <button type="button" style="padding-bottom: 0;" class="btn btn-default"
                                                 data-dir="up" ng-disabled="!@{{ ekstra.mandatoryInContract }}"
                                                 ng-click="add_ekstra('up',ekstra.id,ekstra.value,ekstra.price,ekstra.sellType)"
                                                 data-price="@{{ ekstra.price }}" data-days="@{{ days }}"><span
                                                 style="font-size: 18px;font-weight: 800; padding-bottom: 0;"
                                                 class="i-Add"></span></button>
				                    </span>
                                    </div>
                                </td>
                                <td>@{{ (ekstra.price |currency:''| number:2) }} @{{ currency_icon }}</td>
                                <td id="ekstra_@{{ ekstra.id }}">@{{ekstra.total_price}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                    <thead>
                                    <tr>
                                        <th style="width: 95%">Müşteri Seçimi</th>
                                        <th style="width: 5%;    text-align: center;">+</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td style="width: 95%">
                                        <input class="form-control" id="theSearch" ng-change="fetchUsers()" ng-model="searchText" name="searchText" data-customer_id=""  name="customer" type="text">
                                        <input id="theSearchHidden" value="@{{customer_id}}" name="id_customer" type="hidden">
                                    </td>
                                    <td style="width: 5%">
                                        <button type="button" data-toggle="modal" data-target="#exampleModal" style="padding-bottom: 2px" class="btn btn-success"><i style="font-size: 18px;font-weight: 800" class="i-Add"></i></button>
                                    </td>
                                    </tbody>
                                </table>
                                <ul id="theSearchUl" style="height: 300px;">
                                    <li ng-repeat="item in searchResult"
                                        ng-click="addCustomerInput(item.id,item.firstname,item.lastname,item)">
                                        @{{item.id }} - @{{item.firstname }} @{{item.lastname }} - @{{item.phone }} - @{{item.email }}
                                    </li>
                                </ul>
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13 mt-12"
                                    style="z-index:-1;">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Ülke</th>
                                        <th style="width: 50%" colspan="2">@{{ customer_country }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Müşteri Adı Ve Soyadı</th>
                                        <th style="width: 50%" colspan="2">@{{ customer_fullname }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Email</th>
                                        <th style="width: 50%" colspan="2">@{{ email }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Mobil</th>
                                        <th style="width: 50%" colspan="2">@{{ mobile }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Tel</th>
                                        <th style="width: 50%" colspan="2">@{{ phone }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">D.Tarihi</th>
                                        <th style="width: 50%" colspan="2"> @{{ birthday }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;font-weight: 500">Cinsiyet</th>
                                        <th style="width: 50%" colspan="2">
                                            <span ng-if="gender == 'men'">Erkek</span>
                                            <span ng-if="gender == 'women'">Kadın</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td>İptal Rez.</td>
                                        <td>Onaylı Rez.</td>
                                        <td>Beklemede Rez.</td>
                                        <td>Tamamlanan Rez.</td>
                                    </tr>
                                    <tr>
                                        <td>@{{cancel_reservation}}</td>
                                        <td>@{{comfirm_reservation}}</td>
                                        <td>@{{waiting_reservation}}</td>
                                        <td>@{{complated_reservation}}</td>
                                    </tr>
                                    </tfoot>
                                    <tfoot>
                                    <tr>
                                        <td>Kara Liste</td>
                                        <td>Toplam Puan</td>
                                        <td>Kalan Puan</td>
                                    </tr>
                                    <tr>
                                        <td><b><img style="width:20px" src="@{{blacklist}}"/></b></td>
                                        <td><b>@{{point}}</b></td>
                                        <td><b>@{{remaining_points}}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table
                                    class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%">Kiralama Süresi</th>
                                        <th style="width: 50%">@{{days}} <input name="days" value="@{{days}}"
                                                                                type="hidden"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Kiramama Ücreti</th>
                                        <th style="width: 50%">@{{rent_price}} @{{ currency_icon }}<input
                                                name="rent_price" value="@{{rent_price}}" type="hidden"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Ekstra Ücreti</th>
                                        <th style="width: 50%">@{{ ekstra_total }} @{{ currency_icon }}<input
                                                name="ekstra_total" value="@{{ekstra_total}}" type="hidden"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Teslim Ücreti</th>
                                        <th style="width: 50%">@{{up_price}} @{{ currency_icon }}<input name="up_price"
                                                                                                        value="@{{up_price}}"
                                                                                                        type="hidden"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Drop Ücreti</th>
                                        <th style="width: 50%">@{{drop_price}} @{{ currency_icon }}<input
                                                name="drop_price" value="@{{drop_price}}" type="hidden"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Günlük Fiyat</th>
                                        <th style="width: 50%">@{{day_price}} @{{ currency_icon }}<input
                                                name="day_price" value="@{{day_price}}" type="hidden"/></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;vertical-align: middle;">Ödeme Yöntemi</th>
                                        <th style="width: 50%">
                                            <select class="form-control text-13" name="payment_method">
                                                <option value="debit-card">Havale & EFT</option>
                                                <option value="delivery-debit-card">Araç Tesliminde Nakit & K. Kartı
                                                </option>
                                                <option value="debit-cash">Araç Tesliminde Nakit Ödeme Yapın</option>
                                                <option value="online-credit-card">Online Ödeme</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Ödenecek Tutar</th>
                                        <th style="width: 50%">
                                            <input name="totalprice" value="@{{newtotalprice}}" type="hidden">
                                            @{{newtotalprice}} @{{ currency_icon }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">İndirimli Tutar</th>
                                        <th style="width: 50%"><input name="discount" class="form-control"
                                                                      ng-model="discountvalue" value="0"/></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <input name="id_car" type="hidden" value="@{{ id_car_selected }}"/>
            <input name="id_plate" type="hidden" value="@{{ id_plate_selected }}"/>
            <input name="currency_price" value="@{{ currency_price }}" type="hidden"/>

            <div style="margin:10px 0;" class="col-md-12">
                <button style="width: 100%" onclick="reservationSave()" type="button" class="btn btn-danger">REZERVASYON
                    KAYDET
                </button>
            </div>
            <div id="customerNoteModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    style="right: 25px; position: absolute;">
                                &times;
                            </button>
                            <h4 class="modal-title"><b style="color:#000">Müşteri</b> <b style="color:#f00">Notu</b>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr ng-repeat="item in customernotelist">
                                    <th scope="col">#-@{{item.id}}</th>
                                    <th scope="col">@{{item.created_at | date:'MM-dd-yyyy'}}</th>
                                    <th scope="col">@{{item.note}}</th>
                                </tr>
                                </thead>
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
        </div>
    </form>
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Müşteri Bilgileri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ng-submit="saveCustomer()" id="customerdata" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4" style="margin-bottom: 30px;">
                                <div class="title">Kişisel Bilgileri</div>
                                <table style="    width: 100%;">
                                    <tbody>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Adı :</td>
                                        <td><input type="text" name="firstname" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Soyadı :</td>
                                        <td><input type="text" name="lastname" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Doğum Yeri :</td>
                                        <td><input type="text" name="birthpalace" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;">Doğum Tarihi :</td>
                                        <td><input type="text" name="birthday" class="form-control" id="datepicker" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;">Cinsiyet :</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input style="    width: 20px;height: 20px;" class="form-check-input"
                                                       type="radio" name="gender" id="gendermen" value="men">
                                                <label class="form-check-label" for="inlineRadio1">Erkek</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input style="    width: 20px;height: 20px;" class="form-check-input"
                                                       type="radio" name="gender" id="genderwoman" value="woman">
                                                <label class="form-check-label" for="inlineRadio2">Kadın</label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4" style=" margin-bottom: 30px;">
                                <div class="title">Kişisel Bilgileri</div>
                                <table style="    width: 100%;">
                                    <tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Dil :</td>
                                        <td>
                                            <select name="language" class="form-control">
                                                @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->title}}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Cep Telefonu :</td>
                                        <td><input type="text" name="phone" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Ev/İş Telefonu(Yedek) :</td>
                                        <td><input type="text" name="phone1" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Vergi Dairesi :</td>
                                        <td><input type="text" name="tax_office" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Vergi No :</td>
                                        <td><input type="text" name="tax" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Email :</td>
                                        <td><input type="email" name="email" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Şifre :</td>
                                        <td><input type="text" name="password" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Ülke :</td>
                                        <td>
                                            <select name="nationality" class="form-control">
                                                <?php foreach ($country as $item){ ?>
                                                <option
                                                    value="<?=$item->country_name?>"><?=$item->country_name?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4" style="  margin-bottom: 30px;">
                                <div class="title">Ehliyet Bilgileri</div>
                                <table style="    width: 100%;">
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">No :</td>
                                        <td><input type="text" name="driving_licance_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Sınıfı :</td>
                                        <td><input class="form-control" name="driving_licance_class" type="text"  id="customer-driving_licance_class"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Verildiği Yer:</td>
                                        <td><input type="text" name="driving_licance_location" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 13px;" nowrap="" align="left">Veriliş Tarihi :</td>
                                        <td><input type="text" name="driving_licance_date" id="drivinglicance" class="form-control" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style=" margin-bottom: 30px;">
                                <div class="title">Kimlik / Pasport Bilgileri</div>
                                <table class="pad5 vmrg10" width="100%">
                                    <tbody>
                                    <tr>
                                        <td>TCKN / Passport No :</td>
                                        <td><input type="text" name="identity_no" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td nowrap="" align="left">Kimlik Türü :</td>
                                        <td><select name="identity_type" class="form-control">
                                                <option value="identity">TC Kimlik</option>
                                                <option value="passport">Passport</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td nowrap="" align="left">Verildiği Yer :</td>
                                        <td><input type="text" name="passport_palace" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td nowrap="" align="left">Veriliş Tarihi :</td>
                                        <td><input type="text" name="passport_date" class="form-control"/></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12" style=" margin-bottom: 30px;">
                                <div class="title">Adres Bilgileri</div>
                                <div class="row">
                                    <div class="col-md-12">Ev Adresi :</div>
                                    <div class="col-md-12"><input name="home_address" class="form-control"/></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">İş Adresi :</div>
                                    <div class="col-md-12"><input name="office_address" class="form-control"/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("#id_car").change(function () {
            var items = " ";
            $.ajax({
                /* the route pointing to the post function */
                url: '/getPlate?id_car=' + $(this).val() + '',
                type: 'GET',
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    if (data.data.length > 0) {
                        $("#id_plate").html("");
                        $.each(data.data, function (index, item) {
                            items += "<option value='" + item.id + "'>" + item.plate + "</option>";
                        });
                        $("#id_plate").append(items);
                    }
                }
            });
        })
    </script>

    <style>
        .title {
            border-bottom: 1px solid #ccc;
            margin-bottom: 30px;
        }

        #theSearchUl {
            margin: 0;
            padding: 0;
            position: absolute;
            overflow: auto;
            width: 95%;
            z-index: 999;
        }

        #theSearchUl li {
            background: #013473;
            list-style: none;
            padding: 5px;
            color: #fff;
            cursor: pointer;
        }

        #theSearchUl li:hover {
            background: #0d5fc6;
            list-style: none;
            padding: 5px;
            color: #fff;
            cursor: pointer;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            height: 33px;
            border-radius: 0;
        }
    </style>

    <script>

        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {

            $scope.discountvalue = 0;

            $scope.fetchUsers = function () {
                $scope.searchResult={};
                $("#theSearchUl").show();
                $("#theSearchUl").css('display', 'block');
                var searchText_len = $scope.searchText.trim().length;
                // Check search text length
                if (searchText_len > 0) {
                    $scope.data = [];
                    $http({
                        method: "POST", // method bu sefer post
                        url: "/get_customer", // urlmiz
                        data: $httpParamSerializerJQLike({
                            searchText: $scope.searchText,
                        }),
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    }).then(function (response) {
                        console.log(response);
                        $scope.searchResult = response.data;
                    });
                } else {
                    $scope.searchResult = {};
                }
            }

            $scope.addCustomerInput = function (id, firstname, lastname, item) {
                $("#theSearch").attr("data-customer_id", id);
                $("#theSearch").val(firstname + " " + lastname);
                $("#theSearchHidden").val(id);
                $("ul#theSearchUl").css('display', 'none');
                $scope.searchResult = "";

                $scope.customer_id = item.id;
                $scope.customer_country = item.nationality;
                $scope.customer_fullname = item.firstname + " " + item.lastname;
                $scope.email = item.email;
                $scope.phone = item.phone;
                $scope.birthday = item.birthday;
                $scope.mobile = item.mobile;
                $scope.gender = item.gender;
                $scope.point = item.point;
                $scope.remaining_points = item.remaining_points;
                $scope.cancel_reservation = item.cancel_reservation;
                $scope.waiting_reservation = item.waiting_reservation;
                $scope.comfirm_reservation = item.comfirm_reservation;
                $scope.complated_reservation = item.complated_reservation;
                $http({
                    method: "GET", // method bu sefer post
                    url: "/get_customer_blacklist?id=" + id + "",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                }).then(function (response) {
                    $scope.blacklist = response.data;
                });
                if (item.notes != null) {
                    $("#customerNoteModal").modal("show");
                    $scope.customernotelist = item.notes;
                }

            }

            $scope.carlist = function ($event) {

                var checkin = $('input[name=up_date]').val();
                var today =   new Date();


                var dd = today.getDate();
                var mm = today.getMonth()+1;
                var yyyy = today.getFullYear();
                if(mm<10)
                {
                    mm='0'+mm;
                }
                var date = yyyy+'-'+mm+'-'+dd;


                const formatDate = (date) => {
                    var x = date.split("-");

                    return [x[2], x[1], x[0]].join('-');
                }
               var checkinnewdate = formatDate(checkin);


              //  if(checkinnewdate < date)
                //  {
                //      swal("Hoops!", "Alış tarhi seçiniz!", "error");

                //       return false;
                //   }


                $(".ekstraproduct").hide();

                var laddaBtn = $event.currentTarget;
                var l = Ladda.create(laddaBtn);
                l.start();

                var country = $('select[name=country]').val();
                var up_location = $('select[name=up_location]').val();
                var drop_location = $('select[name=drop_location]').val();

                if (up_location == "") {
                    l.stop();
                    swal("Hoops!", "Alış Lokasyonu Seçiniz!", "error");
                    return false;
                }

                $(".carlistclass").css("opacity", ".3");
                $(".carlistspin").css("display", "block");


                var data = {
                    "country": country,
                    "currency": $('select[name=currency]').val(),
                    "reservation_source": $('select[name=reservation_source]').val(),
                    "up_location": $('select[name=up_location]').val(),
                    "drop_location": $('select[name=drop_location]').val(),
                    "up_date": $('input[name=up_date]').val(),
                    "drop_date": $('input[name=drop_date]').val(),
                    "up_time": $('select[name=up_time]').val(),
                    "drop_time": $('select[name=drop_time]').val(),
                };
                $http({
                    method: 'POST',
                    url: './get_data',
                    data: JSON.stringify(data),
                    cache: false,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function successCallback(response) {
                    console.log(response.data);
                    if(response.code == 401)
                    {
                        l.stop();
                        swal(":(", response.message, 'danger');
                    }
                    l.stop();
                    $(".carlistspin").css("display", "none");
                    if (response.data == "") {
                        swal(":(", 'Araç Bulunamadı', 'info');
                    } else {
                        $scope.informationrender(up_location, drop_location);
                        $(".carlistclass").css("opacity", "1");
                        $scope.carlistarray = response.data;
                    }
                }, function (response) {
                    setTimeout(function () {
                        l.stop();
                        $(".carlistspin").css("display", "none");
                    }, 3000);
                });

            }

            $scope.informationrender = function (up_location, drop_location) {
                $http({
                    method: 'POST',
                    url: '/informationrender/' + up_location + '/' + drop_location + '',
                    cache: false,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function successCallback(response) {
                    $scope.uptype = response.data.up_type;
                    $scope.droptype = response.data.drop_type;
                }, function (response) {
                    swal("Hoops!", response, 'warning');
                });
            }

            $scope.carselect = function (id, id_car, id_plate, days, day_price, rent_price, drop_price, up_price, currency, currency_price, currency_icon) {
                /*if(day_price == 0)
                {
                    swal("Hoops!", 'Günlük Fiyat 0 olan araç seçilemez', 'warning');
                }else{*/
                $scope.days = days;
                $scope.day_price = day_price;
                $scope.drop_price = drop_price;
                $scope.rent_price = rent_price;
                $scope.up_price = up_price;
                $scope.currency = currency;
                $scope.currency_price = currency_price;
                $scope.ekstra_total = 0;
                $scope.currency_icon = currency_icon;
                $scope.newtotalprice = rent_price + up_price + drop_price;
                $scope.id_car_selected = id_car;
                $scope.id_plate_selected = id_plate;
                $scope.ekstralistarray(currency_price, days);
                $(".ekstraproduct").show();
                $("#tr_" + id).toggleClass('checkedtable').siblings().removeClass('checkedtable');
                /*}*/

            }

            $scope.add_ekstra = function (parameter, value, maxVal, price, sellType) {

                var id = 'model_ekstra_' + value;
                var oldValue = $("#" + id).val();
                var newVal = 0;
                if (parameter == 'up') {
                    newVal = parseInt(oldValue) + 1;
                    if (maxVal >= newVal || newVal == maxVal) {
                        $("#" + id).val(newVal);
                    } else {
                        newVal = maxVal;
                        swal("Yeterli", '' + maxVal + ' Adet Ekleyebilirsiniz', 'info');
                    }
                } else {
                    if (oldValue > 1) {
                        newVal = parseInt(oldValue) - 1;
                        $('#' + id).css("background", "green !important");
                        $('#' + id).css("color", "#000");
                    } else {
                        newVal = 0;
                    }
                    $("#" + id).val(newVal);
                }
                if (newVal == 0) {
                    var els = $("#" + id);
                    els.css("wwww", "www");
                }
                if (sellType == 'Günlük') {
                    var totalekstra = price * newVal * $scope.days;
                } else {
                    var totalekstra = price * newVal;
                }
                $('#ekstra_' + value).html(totalekstra + " " + $scope.currency_icon);
                $('#' + id).css("background", "green");
                $('#' + id).css("color", "#fff");
                $('#' + id).css("font-weight", "700");
                $('#' + id).css("text-align", "center");
                $('#' + id).css("line-height", "2.3");
                $('#' + id).css("font-size", "15px");
                $('.ekstra_' + value).val(totalekstra);
                var sum = 0;
                $(".ekstratotal").each(function () {
                    sum += Number($(this).val());
                });

                var priceround = Math.round(sum * 100) / 100;

                $scope.ekstra_total = priceround;
                $scope.calculate();
            }

            $scope.calculate = function () {
                $scope.newtotalprice = $scope.ekstra_total + $scope.rent_price + $scope.up_price + $scope.drop_price;
            }

            $scope.ekstralistarray = function (currency_price, days) {
                var arrays = [currency_price, days];
                var sum = 0;
                $http({
                    method: 'POST',
                    url: '/admin/admin/ekstra/lists',
                    cache: false,
                    data: arrays,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function successCallback(response) {
                    console.log(response.data);
                    $scope.ekstralist = response.data;
                    $.each(response.data, function (key, value) {
                        sum += value['total_price'];
                    });
                    $scope.ekstra_total = sum;
                    $scope.calculate();
                }, function (response) {
                    swal("Hoops!", 'Ekstra Ürün Bulunamadı', 'warning');
                });
            }

            $scope.saveCustomer = function () {
                $scope.customer_country = "";
                $scope.customer_fullname = "";
                $scope.email = "";
                $scope.phone = "";
                $scope.birthday = "";
                $scope.gender = "";

                $http({
                    method: 'POST',
                    url: '/admin/admin/customer/save_api',
                    data: $('#customerdata').serialize(),
                    cache: false,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.customer_id = response.data.id;
                    $scope.customer_country = response.data.nationality;
                    $scope.customer_fullname = response.data.fullname;
                    $scope.email = response.data.email;
                    $scope.phone = response.data.phone;
                    $scope.birthday = response.data.birthday;
                    $scope.gender = response.data.gender;
                    $("#exampleModal").modal("hide");
                }, function (response) {

                    var message = response.data.errors.message;
                    swal("Hoops!", message + 'Telefon, Email, Kimlik No ve Kimlik Verildiği alanlar boş geçilemez. Aynı mail 2 defa kayıt edilemez', 'warning');
                });
            }

            // $scope.discount = function (event,discountvalue) {
            //
            //    var totalprices =  $("input[name=totalprice]").val();
            //    var yuzde =  (totalprices * 10)  / 100;
            //    var x = totalprices - yuzde;
            //     $scope.newtotalprice  =  Math.round(x * 100)/100;
            // }
        }]);
    </script>
    <script>
        function getDropLocation(sel) {
            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var id = sel.value;

            if (id == "") {
                var id_location = 0;
            } else if (id == undefined) {
                var id_location = 0;
            } else {
                var id_location = id;
            }
            $.ajax({
                type: 'GET',
                url: '/admin/admin/api/droplocation?id=' + id_location + '',
                success: function (data) {
console.log(data);
                    var row = "";
                    var x = 0;
                    $.each(data.data, function (key, value) {
                        if (value.id_parent == 0) {
                            row += '<optgroup label="' + value.title + '">';
                            $.each(value.parentList, function (keys, values) {
                                if(values.id == id)
                                {
                                    var a = "selected";
                                }
                                row += '<option  value="' + values.id + '" '+a+'>' + values.title + '</option>';
                            });
                            row += '</optgroup>';
                        }

                        x++;
                    });
                    $("#drop_location").append(row);
                    $("#drop_location").select2().select2('val',id );

                }
            });
        }

        function reservationSave() {
            var id_customer = $('input[name="id_customer"]').val();
            if (!id_customer) {
                swal("HATA!", "Müşteri Seçimi Yapılmadı!", "warning")
            }

            $("#rezervationcreateform").submit();
        }
    </script>

    <script>
        $('select[name=up_time]').change(function(){
           var val = $(this).val();
           $('select[name=drop_time]').val(val);
        });
    </script>
    <style>
        .checkedtable {
            background-color: green !important;
            color: #fff;
            font-weight: 600;
        }
    </style>
@endsection


