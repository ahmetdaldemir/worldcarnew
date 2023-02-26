@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araç Ekleme Formu</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.cars.save')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-brand" class="col-form-label">Araç Adı:</label>
                                        <input name="car_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="car-brand" class="col-form-label">Marka:</label>
                                        <select class="form-control selectpicker" id="car-brand" name="brand" data-live-search="true" data-width="fit" tabindex="-98">
                                            @foreach($brands as $item)
                                                <option value="{{$item->id}}">{{$item->brandname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-model" class="col-form-label">Model:</label>
                                        <select class="form-control" id="car-model" name="model"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-year" class="col-form-label">Yıl:</label>
                                        <select class="form-control selectpicker" id="car-year" name="year" data-live-search="true" data-width="fit" tabindex="-98">
                                            @for ($i = 2000; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Büyük Bagaj Adedi:</label>
                                        <select class="form-control selectpicker" id="car-passenger" name="big_luggage" data-live-search="true" data-width="fit" tabindex="-98">
                                            @for ($i = 1; $i <= 11; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Küçük Bagaj Adedi:</label>
                                        <select class="form-control" id="car-passenger" name="small_luggage">
                                            @for ($i = 1; $i <= 11; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-hydraulic_steering" class="col-form-label">Hidrolik
                                            Direksiyon:</label>
                                        <select class="form-control" id="car-hydraulic_steering"
                                                name="hydraulic_steering">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-4_wd" class="col-form-label">4 Çeker:</label>
                                        <select class="form-control" id="car-4_wd" name="4_wd">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-engine" class="col-form-label">Motor:</label>
                                        <select class="form-control" id="car-engine" name="engine">
                                            @foreach($engines as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-type" class="col-form-label">Kasa:</label>
                                        <select class="form-control" id="car-type" name="type">
                                            <option value="Sedan">Sedan</option>
                                            <option value="Hackback">Hackback</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-power" class="col-form-label">Beygir:</label>
                                        <select class="form-control" id="car-power" name="power">
                                            <option value="1">50-75</option>
                                            <option value="2">75-90</option>
                                            <option value="3">90-125</option>
                                            <option value="4">125-150</option>
                                            <option value="5">150-200</option>
                                            <option value="6">200+</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-fuel" class="col-form-label">Yakıt:</label>
                                        <select class="form-control" id="car-fuel" name="fuel">
                                            <option value="dizel">Dizel</option>
                                            <option value="benzin">Benzin</option>
                                            <option value="benzin+gaz">Benzin + Gaz</option>
                                            <option value="elektrikli">Elektrikli</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-transmission" class="col-form-label">Vites:</label>
                                        <select class="form-control" id="car-transmission" name="transmission">
                                            <option value="Otomatik">Otomatik</option>
                                            <option value="Manuel">Manuel</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-category" class="col-form-label">Kategori:</label>
                                        <select class="form-control selectpicker" id="car-category" name="category" data-live-search="true" data-width="fit" tabindex="-97">
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->language_admin()->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-doors" class="col-form-label">Kapı:</label>
                                        <select class="form-control" id="car-doors" name="doors">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-air_conditioner" class="col-form-label">Klima:</label>
                                        <select class="form-control" id="car-air_conditioner" name="air_conditioner">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-ab" class="col-form-label">Ab:</label>
                                        <select class="form-control" id="car-ab" name="ab">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-abs" class="col-form-label">Abs:</label>
                                        <select class="form-control" id="car-abs" name="abs">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-radio" class="col-form-label">Radio:</label>
                                        <select class="form-control" id="car-radio" name="radio">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-cd" class="col-form-label">Cd:</label>
                                        <select class="form-control" id="car-cd" name="cd">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-sun_roof" class="col-form-label">Sun Roof:</label>
                                        <select class="form-control" id="car-sun_roof" name="sun_roof">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-passenger" class="col-form-label">Yolcu:</label>
                                        <select class="form-control" id="car-passenger" name="passenger">
                                            @for ($i = 1; $i <= 21; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-passenger" class="col-form-label">Sıra:</label>
                                        <input class="form-control" id="car-sort" name="sort">
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
        var items ="";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#car-brand").change(function () {
            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/admin/getModel?id=' + $(this).val()+ '',
                type: 'GET',
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {

                    $.each(data,function(index,item)
                    {
                        items +="<option value='"+item.id +"'>"+item.modelname +"</option>";
                    });

                    $("#car-model").append(items);
                }
            });
        });
    });
</script>
@endsection
