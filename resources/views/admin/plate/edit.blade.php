@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araç Düzenleme Formu</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.plates.update')}}">
                        <input name="id" type="hidden" value="{{$plates->id}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="car-brand" class="col-form-label">Araç:</label>
                                        <select class="form-control selectpicker" id="car-id_car" name="id_car" data-live-search="true" data-width="fit" tabindex="-98">
                                            @foreach($cars as $item)
                                                @php
                                                    $brand = \App\Models\Brand::find($item->brand)->brandname ?? null;
                                                    $car_model = \App\Models\CarModel::find($item->model)->modelname ?? null;
                                                    $year = $item->year;
                                                    $engine = $item->engine;
                                                @endphp
                                                <option value="{{$item->id}}" <?php if($item->id == $plates->id_car){echo"selected";} ?> >{{$brand}} | {{$car_model}} | {{$year}} | {{$engine}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-model" class="col-form-label">Plaka:</label>
                                        <input type="text" class="form-control" id="car-plate" value="{{$plates->plate}}" name="plate">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="car-year" class="col-form-label">Tescil Tarihi:</label>
                                                <input type="date" class="form-control" id="car-registry" value="{{$plates->registry}}" name="registry">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="car-document_number" class="col-form-label">Belge No/ Seri No:</label>
                                                <input type="text" class="form-control" id="car-document_number" value="{{$plates->document_number}}" name="document_number">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="recipient-name-2" class="col-form-label">Km:</label>
                                                <input type="number" min="0"  class="form-control" id="car-km"  value="{{$plates->km}}"  name="km">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="recipient-name-2" class="col-form-label">Oil Km Mevcut:</label>
                                                <input type="number" min="0" class="form-control" id="car-oil_km_current"  value="{{$plates->oil_km_current}}"  name="oil_km_current">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="recipient-name-2" class="col-form-label">Yağ Km :</label>
                                                <input type="number" min="0" class="form-control" id="car-oil_km"  value="{{$plates->oil_km}}"  name="oil_km">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="car-description" class="col-form-label">Description:</label>
                                        <textarea  class="form-control" id="car-description" name="description">{{$plates->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-header">Sigorta / Muayene / Diğer </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-gray-300 ">
                                            <thead>
                                            <tr>
                                                <th scope="col">Tip</th>
                                                <th scope="col">Sigorta Şirketi</th>
                                                <th scope="col">Başlangıç Tarihi</th>
                                                <th scope="col">Bitiş Tarihi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">Kasko<input type="hidden" class="form-control" id="recipient-name-2" name="type[]" value="kasko"></th>
                                                <td><input  class="form-control" id="plate-insurance_company" name="insurance_company[]" @if($plates->plate_document && @$plates->plate_document[0]->type == 'kasko') value="{{$plates->plate_document[0]->insurance_company}}" @endif ></td>
                                                <td><input type="date" @if($plates->plate_document && @$plates->plate_document[0]->type == 'kasko') value="{{@$plates->plate_document[0]->insurance_start}}"   @endif class="form-control" id="plate-insurance_start" name="insurance_start[]"></td>
                                                <td><input type="date" @if($plates->plate_document && @$plates->plate_document[0]->type == 'kasko') value="{{@$plates->plate_document[0]->insurance_finish}}"  @endif class="form-control" id="plate-insurance_start" name="insurance_finish[]"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Trafik Sigortası<input type="hidden" class="form-control" id="recipient-name-2" name="type[]" value="sigorta"></th>
                                                <td><input class="form-control" id="plate-insurance_company" name="insurance_company[]" @if($plates->plate_document && @$plates->plate_document[1]->type == 'sigorta') value="{{$plates->plate_document[1]->insurance_company}}" @endif></td>
                                                <td><input type="date" @if($plates->plate_document && @$plates->plate_document[1]->type == 'sigorta') value="{{@$plates->plate_document[1]->insurance_start}}"  @endif  class="form-control" id="plate-insurance_start" name="insurance_start[]"></td>
                                                <td><input type="date" @if($plates->plate_document && @$plates->plate_document[1]->type == 'sigorta') value="{{@$plates->plate_document[1]->insurance_finish}}"  @endif  class="form-control" id="plate-insurance_start" name="insurance_finish[]"></td>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <th scope="row">Rent A Car Sigortası<input type="hidden" class="form-control" id="recipient-name-2" name="type[]" value="rent_a_car_sigortasi"></th>--}}
{{--                                                <td><input class="form-control" id="plate-insurance_company" name="insurance_company[]"></td>--}}
{{--                                                <td><input type="date" class="form-control" id="plate-insurance_start" name="insurance_start[]"></td>--}}
{{--                                                <td><input type="date" class="form-control" id="plate-insurance_start" name="insurance_finish[]"></td>--}}
{{--                                            </tr>--}}
                                            <?php if(!isset($plates->plate_document)){ ?>
                                            <tr>
                                                <th scope="row">Muayene<input type="hidden" class="form-control" id="recipient-name-2" name="type[]" value="muayene"></th>
                                                <td><input type="hidden" class="form-control" id="recipient-name-2" name="insurance_company[]" value="TUVTURK"></td>
                                                <td><input type="date" @if($plates->plate_document[2]->type == 'muayene') value="{{$plates->plate_document[2]->insurance_start}}"  @endif  class="form-control" id="plate-insurance_start" name="insurance_start[]"></td>
                                                <td><input type="date" @if($plates->plate_document[2]->type == 'muayene') value="{{$plates->plate_document[2]->insurance_finish}}" @endif  class="form-control" id="plate-insurance_start" name="insurance_finish[]"></td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(!isset($plates->plate_document)){ ?>
                                            <tr>
                                                <th scope="row">Eksoz Muayenesi<input type="hidden" class="form-control" id="recipient-name-2" name="type[]" value="eksoz_muayenesi"></th>
                                                <td><input type="hidden" class="form-control" id="recipient-name-2" name="insurance_company[]" value="TUVTURK"></td>
                                                <td><input type="date" class="form-control" @if($plates->plate_document[3]->type == 'eksoz_muayenesi') value="{{$plates->plate_document[3]->insurance_start}}" @endif id="plate-insurance_start" name="insurance_start[]"></td>
                                                <td><input type="date" class="form-control" @if($plates->plate_document[3]->type == 'eksoz_muayenesi') value="{{$plates->plate_document[3]->insurance_finish}}" @endif id="plate-insurance_start" name="insurance_finish[]"></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
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

    <style>
        .form-group label {
            font-size: 14px;
            color: #1b406c;
            margin-bottom: 4px;
        }
    </style>
@endsection
