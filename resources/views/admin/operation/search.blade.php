 <div class="row justify-content-center">
    <div class="col-md-12">
        <form action="{{route('admin.admin.operation.search')}}" name="filter-form" id="reservationdata" method="get">
            @csrf
            <div class="row">
                <div class="col-sm-1">
                    <label for="type" class="text-12">Tür {{old('type')}}</label>
                    <select class="form-control" id="type" name="type"  onchange="$('#reservationdata').submit();">
                        <option {{ request()->type == "in" ? 'selected' : '' }} value="in">Çıkışlar</option>
                        <option {{ request()->type == "out" ? 'selected' : '' }} value="out">Dönüşler</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="date_time_first" class="text-12">Operasyon Tarihi Aralığı</label>
                    <div class="input-group">
                        <input class="form-control" name="date_time_first" type="text" id="operation_up_datepicker" value="{{ request()->date_time_first }}" autocomplete="false">
                        <span class="input-group-addon"><i class="fa-arrows-h"></i></span>
                        <input class="form-control date-picker text-center" name="date_time_last" value="{{ request()->date_time_last }}"  onchange="$('#reservationdata').submit();" id="operation_drop_datepicker" type="text" autocomplete="false">
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="car_status" class="text-12">Plaka Durumu</label>
                    <select class="form-control" id="plate" name="plate"  onchange="$('#reservationdata').submit();">
                        <option {{ request()->plate == "2" ? 'selected' : '' }} value="2" selected="selected">Tümü</option>
                        <option {{ request()->plate == "0" ? 'selected' : '' }} value="0">Atanmamış</option>
                        <option {{ request()->plate == "1" ? 'selected'  : '' }} value="1">Atanmış</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="plates" class="text-12">Plaka</label>
                    <select class="form-control" id="plates" name="plates"  onchange="$('#reservationdata').submit();">
                        <option value="" selected="selected">Hepsi</option>
                        @foreach($allplates as $plateval)
                        <option {{ request()->plates == $plateval->id ? 'selected' : '' }} value="{{$plateval->id}}">{{$plateval->plate}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="reservation_status" class="text-12">Onay Durumu</label>
                    <select class="form-control" id="reservation_status" name="reservation_status"  onchange="$('#reservationdata').submit();">
                        <option value="" selected="selected">Hepsi</option>
                        <option {{ request()->reservation_status == "waiting" ? 'selected' : '' }} value="waiting">Bekliyor</option>
                        <option {{ request()->reservation_status == "comfirm" ? 'selected' : '' }} value="comfirm">Onaylandı</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="payment_method" class="text-12">Ödeme Yöntemi</label>
                    <select class="form-control" id="payment_method" name="payment_method"  onchange="$('#reservationdata').submit();">
                        <option {{ request()->payment_method == "" ? 'selected' : '' }} value="" selected="selected">Hepsi</option>
                        <option {{ request()->payment_method == "debit-card" ? 'selected' : '' }} value="debit-card">Havale & EFT</option>
                        <option {{ request()->payment_method == "delivery-debit-card" ? 'selected' : '' }} value="delivery-debit-card">Araç Tesliminde Nakit & K. Kartı</option>
                        <option {{ request()->payment_method == "debit-cash" ? 'selected' : '' }} value="debit-cash">Araç Tesliminde Nakit Ödeme Yapın</option>
                        <option {{ request()->payment_method == "online-credit-card" ? 'selected' : '' }} value="online-credit-card">Online Ödeme</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="city_id" class="text-12">Şehir</label>
                    <select class="form-control" id="city_id" name="city_id"  onchange="$('#reservationdata').submit();">
                        <option value="" selected="selected">Hepsi</option>
                        <?php   foreach ($location as $item){ ?>
                        <option {{ request()->city_id == $item->id ? 'selected' : '' }} value="<?=$item->id?>"><?=$item->title?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="type_id" class="text-12">Model</label>
                    <select class="form-control" id="car" name="car"  onchange="$('#reservationdata').submit();">
                        <option value="" selected="selected">Hepsi</option>
                        <?php foreach ($car as $item){ ?>
                        <option {{ request()->car == $item->id ? 'selected' : '' }} value="<?=$item->id?>"><?=$data->getCarInfoFullNoYear($item->id)?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <div style="margin: 30px 0 0 0 ;">
                        <input style="width: 20px;height: 20px" type="checkbox" id="closed"  {{ request()->closed == 'on' ? 'checked' : '' }}   name="closed">
                        <label for="closed">İptal/Silinen  dahil et</label>
                    </div>
                 </div>
            </div>
            <div class="col-md-12"  style="padding: 0;margin-top: 10px;background: #ebebeb;text-align: center;">
                <button class="btn btn-success" type="submit" style="width:15%;border: 2px solid #013473;">ARA</button>
            </div>
        </form>
    </div>
</div>
