@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ekstra Ürün Ekleme Formu
                <div style="float:right;color:#f00">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.ekstra.save')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                                    <div class="col-md-8">
                                                        <label for="customer-title col-md-12" class="col-form-label" style="width: 100%">Ürün Adı:</label>
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            @foreach($languages as $item)
                                                                <li class="nav-item">
                                                                    <a style="    padding: 0.3rem;"
                                                                       class="nav-link @if($item->id == '1') active show @endif "
                                                                       id="{{$item->id}}-tab" data-toggle="tab"
                                                                       href="#{{$item->title}}lang" role="tab"
                                                                       aria-controls="{{$item->id}}lang">{{$item->title}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="tab-content" id="myTabContent">

                                                            @foreach($languages as $item)
                                                                <div class="tab-pane fade @if($item->id == '1') active show @endif"
                                                                     id="{{$item->title}}lang" role="tabpanel"
                                                                     aria-labelledby="{{$item->id}}-tab">
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="title[]" id="location-title"
                                                                               placeholder="{{$item->title}} Ektra açıklama"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="info[]" id="location-title"
                                                                               placeholder="{{$item->title}}  açıklama"/>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="customer-price col-md-12" class="col-form-label" style="width: 100%">Fiyat:</label>
                                                        <input class="form-control" name="price" id="customer-price" placeholder="Fiyat">
                                                    </div>
                                             </div>
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="customer-mandatoryInContract col-md-12" class="col-form-label" style="width: 100%">Kontratta Zorunlumu:</label>
                                                <select class="form-control" name="mandatoryInContract" id="customer-mandatoryInContract">
                                                    <option value="yes">Evet</option>
                                                    <option value="no">Hayır</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="customer-itemOfCustom col-md-12" class="col-form-label" style="width: 100%">Adet Arttırma:</label>
                                                <select class="form-control" name="itemOfCustom" id="customer-itemOfCustom">
                                                    <option value="yes">Evet</option>
                                                    <option value="no">Hayır</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="customer-mandatoryInContract col-md-12" class="col-form-label" style="width: 100%">Resim:</label>
                                                <input type="text" class="form-control"  name="image">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="customer-itemOfCustom col-md-12" class="col-form-label" style="width: 100%">Değer:</label>
                                                <input type="number" class="form-control"  max="5" min="0" name="value">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="customer-itemOfCustom col-md-12" class="col-form-label" style="width: 100%">Input Name:</label>
                                                <input type="text" class="form-control"  value="default" name="input_name">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="customer-type col-md-12" class="col-form-label" style="width: 100%">Tipi:</label>
                                                <select class="form-control" name="type" id="customer-type">
                                                    <option value="insurance">Sigorta</option>
                                                    <option value="ekstra">Ekstra</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="customer-sellType col-md-12" class="col-form-label" style="width: 100%">Satış Tipi:</label>
                                                <select class="form-control" name="sellType" id="customer-sellType">
                                                    <option value="daily">Günlük</option>
                                                    <option value="ofRent">Kiralama Başı</option>
                                                </select>
                                            </div>
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
@endsection
