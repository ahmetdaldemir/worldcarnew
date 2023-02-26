@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araç Ekleme Formu</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.cars.update')}}">
                        <input name="id" type="hidden" value="{{$car->id}}" class="form-control">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-brand" class="col-form-label">Araç Adı:</label>
                                       <input name="car_name" value="{{$car->car_name}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="car-brand" class="col-form-label">Marka:</label>
                                        <select class="form-control selectpicker" id="car-brand" name="brand" data-live-search="true" data-width="fit" tabindex="-98">
                                            @foreach($brands as $item)
                                                <option  {{ ($car->brand) ==  $item->id ? 'selected' : '' }}   value="{{$item->id}}">{{$item->brandname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-model" class="col-form-label">Model:</label>
                                        <select class="form-control selectpicker" id="car-model" name="model" data-live-search="true" data-width="fit" tabindex="-97">
                                            @foreach($car_models as $item)
                                                <option  {{ ($car->model) ==  $item->id ? 'selected' : '' }}  value="{{$item->id}}">{{$item->modelname}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="car-year" class="col-form-label">Yıl:</label>
                                        <select class="form-control selectpicker" id="car-year" name="year" data-live-search="true" data-width="fit" tabindex="-98">
                                            @for ($i = 2000; $i <= date('Y'); $i++)
                                                <option   {{ ($car->year) == $i ? 'selected' : '' }}   value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Büyük Bagaj Adedi:</label>
                                        <select class="form-control selectpicker" id="car-passenger" name="big_luggage" data-live-search="true" data-width="fit" tabindex="-98">
                                            @for ($i = 1; $i <= 11; $i++)
                                                <option  {{ ($car->big_luggage) == $i ? 'selected' : '' }}   value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Küçük Bagaj Adedi:</label>
                                        <select class="form-control" id="car-passenger" name="small_luggage">
                                            @for ($i = 1; $i <= 11; $i++)
                                                <option  {{ ($car->small_luggage) == $i ? 'selected' : '' }}  value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-hydraulic_steering" class="col-form-label">Hidrolik
                                            Direksiyon:</label>
                                        <select class="form-control" id="car-hydraulic_steering"
                                                name="hydraulic_steering">
                                            <option  {{ ($car->hydraulic_steering) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->hydraulic_steering) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-4_wd" class="col-form-label">4 Çeker:</label>
                                        <select class="form-control" id="car-4_wd" name="4_wd">
                                            <option <?php if($car['4_wd'] == 1){echo"selected";} ?> value="1">Evet</option>
                                            <option <?php if($car['4_wd'] == 0){echo"selected";} ?>  value="0">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-engine" class="col-form-label">Motor:</label>
                                        <select class="form-control" id="car-engine" name="engine">
                                            @foreach($engines as $item)
                                                <option {{ ($car->engine) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-type" class="col-form-label">Kasa:</label>
                                        <select class="form-control" id="car-type" name="type">
                                            <option  {{ ($car->type) == "Sedan" ? 'selected' : '' }} value="Sedan">Sedan</option>
                                            <option  {{ ($car->type) == "Hackback" ? 'selected' : '' }} value="Hackback">Hackback</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-power" class="col-form-label">Beygir:</label>
                                        <select class="form-control" id="car-power" name="power">
                                            <option  {{ ($car->power) == 1 ? 'selected' : '' }} value="1">50-75</option>
                                            <option  {{ ($car->power) == 2 ? 'selected' : '' }} value="2">75-90</option>
                                            <option  {{ ($car->power) == 3 ? 'selected' : '' }} value="3">90-125</option>
                                            <option  {{ ($car->power) == 4 ? 'selected' : '' }} value="4">125-150</option>
                                            <option  {{ ($car->power) == 5 ? 'selected' : '' }} value="5">150-200</option>
                                            <option  {{ ($car->power) == 6 ? 'selected' : '' }} value="6">200+</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-fuel" class="col-form-label">Yakıt:</label>
                                        <select class="form-control" id="car-fuel" name="fuel">
                                            <option  {{ ($car->fuel) == "Dizel" ? 'selected' : '' }} value="dizel">Dizel</option>
                                            <option  {{ ($car->fuel) == "Benzin" ? 'selected' : '' }} value="benzin">Benzin</option>
                                            <option  {{ ($car->fuel) == "Benzin+Gaz" ? 'selected' : '' }} value="benzin+gaz">Benzin + Gaz</option>
                                            <option  {{ ($car->fuel) == "Elektrikli" ? 'selected' : '' }} value="elektrikli">Elektrikli</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-transmission" class="col-form-label">Vites:</label>
                                        <select class="form-control" id="car-transmission" name="transmission">
                                            <option {{ ($car->transmission) == "Otomatik" ? 'selected' : '' }} value="Otomatik">Otomatik</option>
                                            <option {{ ($car->transmission) == "Manuel" ? 'selected' : '' }} value="Manuel">Manuel</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-category" class="col-form-label">Kategori:</label>
                                        <select class="form-control selectpicker" id="car-category" name="category" data-live-search="true" data-width="fit" tabindex="-97">
                                            @foreach($categories as $item)
                                                <option  {{ ($car->category) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->language_admin()->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-doors" class="col-form-label">Kapı:</label>
                                        <select class="form-control" id="car-doors" name="doors">
                                            <option  {{ ($car->doors) == 1 ? 'selected' : '' }} value="1">1</option>
                                            <option  {{ ($car->doors) == 2 ? 'selected' : '' }} value="2">2</option>
                                            <option  {{ ($car->doors) == 3 ? 'selected' : '' }} value="3">3</option>
                                            <option  {{ ($car->doors) == 4 ? 'selected' : '' }} value="4">4</option>
                                            <option  {{ ($car->doors) == 5 ? 'selected' : '' }} value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-air_conditioner" class="col-form-label">Klima:</label>
                                        <select class="form-control" id="car-air_conditioner" name="air_conditioner">
                                            <option  {{ ($car->air_conditioner) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->air_conditioner) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-ab" class="col-form-label">Ab:</label>
                                        <select class="form-control" id="car-ab" name="ab">
                                            <option  {{ ($car->ab) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->ab) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-abs" class="col-form-label">Abs:</label>
                                        <select class="form-control" id="car-abs" name="abs">
                                            <option  {{ ($car->abs) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->abs) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-radio" class="col-form-label">Radio:</label>
                                        <select class="form-control" id="car-radio" name="radio">
                                            <option  {{ ($car->radio) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->radio) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-cd" class="col-form-label">Cd:</label>
                                        <select class="form-control" id="car-cd" name="cd">
                                            <option  {{ ($car->cd) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->cd) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-sun_roof" class="col-form-label">Sun Roof:</label>
                                        <select class="form-control" id="car-sun_roof" name="sun_roof">
                                            <option  {{ ($car->sun_roof) == 1 ? 'selected' : '' }} value="1">Evet</option>
                                            <option  {{ ($car->sun_roof) == 0 ? 'selected' : '' }} value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-passenger" class="col-form-label">Yolcu:</label>
                                        <select class="form-control" id="car-passenger" name="passenger">
                                            @for ($i = 1; $i <= 21; $i++)
                                                <option  {{ ($car->passenger) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-passenger" class="col-form-label">Sıra:</label>
                                        <input class="form-control" id="car-sort" value="{{$car->sort}}" name="sort">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                            <button type="submit" class="btn btn-primary">KAYDET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#car-brand").change(function () {
            alert($(this).val());
            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/admin/getModel?id=' + $(this).val()+ '',
                type: 'GET',
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    $("#car-model").html(data);
                }
            });
        });
    });
</script>
@endsection
