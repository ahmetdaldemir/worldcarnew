@extends('layouts.admin')

@section('content')
    @php $destinationArray = json_decode($camping->destination);  @endphp
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="breadcrumb">
                <h1>Kampanyalar</h1>
                <ul>
                    <li><a href="">Kampanya</a></li>
                    <li> Kampanya Ekleme Formu</li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kampanyalar</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.camping.update')}}">
                        <input name="id" value="{{$id}}" type="hidden" />
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Araç:</label>
                                    <select class="form-control" name="id_car">
                                        <option value="0">Seçiniz</option>
                                        <?php foreach ($cars as $val){ ?>
                                        <option   @if($val['id'] == $camping->id_car) selected @endif  value="<?=$val["id"]?>"><?=$val["brand"]?> - <?=$val["model"]?>
                                            - <?=$val["year"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Para Birimi :</label>
                                    <select class="form-control" name="id_currency">
                                        <option value="0">Seçiniz</option>
                                        <?php foreach ($currency as $val){ ?>
                                        <option  @if($val['id'] == $camping->id_currency) selected @endif   value="<?=$val->id?>"><?=$val->title?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Yayınlanacağı Bölge :</label>
                                    <select class="form-control" name="location">
                                        <option value="0">Seçiniz</option>
                                        <option @if("domestic" == $camping->id_currency) selected @endif  value="domestic">Yurtiçi</option>
                                        <option @if("abroad" == $camping->id_currency)   selected @endif  value="abroad">Yurtdışı</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Geçerli Şehirler :</label>
                                    <div class="col-md-12">
                                        <select name="destination[]" class="selectpicker" multiple>
                                            <option>Seçiniz</option>
                                            <?php foreach ($location as $val){ ?>
                                                <option  @if(!empty($destinationArray)) @if(in_array($val->id,$destinationArray) == 1) selected @endif @endif value="<?=$val->id?>"><?=$val->title?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">1-3 Gün :</label>
                                    <input type="text" class="form-control" id="recipient-name-2" value="{{$camping->price1}}" name="price1">
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">4-6 Gün :</label>
                                    <input type="text" class="form-control" id="recipient-name-2" value="{{$camping->price2}}"  name="price2">
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">7-13 Gün :</label>
                                    <input type="text" class="form-control" id="recipient-name-2" value="{{$camping->price3}}"  name="price3">
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">14-30 Gün :</label>
                                    <input type="text" class="form-control" id="recipient-name-2" value="{{$camping->price4}}"  name="price4">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Başlangıç tarihi :</label>
                                    <input type="date" class="form-control" id="recipient-name-2" value="{{$camping->start_date}}"   name="start_date">
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Bitiş Tarihi :</label>
                                    <input type="date" class="form-control" id="recipient-name-2" value="{{$camping->finish_date}}"   name="finish_date">
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Geçerlilik Süresi :</label>
                                    <select class="form-control" name="period_validity">
                                        <option @if("0"  == $camping->period_validity) selected @endif value="0">Seçiniz</option>
                                            <?php for($i = 0; $i < 30; $i++){ ?>
                                               <option @if($i == $camping->period_validity) selected @endif value="<?=$i?>"><?=$i?> Gün</option>
                                            <?php } ?>
                                        <option value="32">30+ Gün</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Müşteri Tipi:</label>
                                    <select class="form-control" name="customer_type">
                                        <option value="0">Seçiniz</option>
                                        <?php foreach ($customer_type as $val){ ?>
                                        <option  @if($val['id'] == $camping->customer_type) selected @endif  value="<?=$val->id?>"><?=$val->title?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="    margin: 20px 0;">
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
                                                                   value="{{ \App\Models\CampingLanguage::getSelectLang($id,"title",$item->id)}}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea  class="form-control" id="description_{{$item->id}}"   name="description[]">{{ \App\Models\CampingLanguage::getSelectLang($id,"description",$item->id)}}</textarea>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
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
