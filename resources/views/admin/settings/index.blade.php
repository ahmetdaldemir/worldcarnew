@extends('layouts.admin')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ayarlar</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="{{route('admin.admin.settings.save')}}" enctype="multipart/form-data">
                            @csrf
                        <table class="table table-sm table-gray-300 ">
                            <tbody>
                                <tr>
                                    <td scope="row" style="width: 40%">Logo</td><td>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="setting-logo" name="logo">
                                                <label class="custom-file-label" for="inputGroupFile01">Dosya Seç</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Favicon</td><td>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="setting-favicon" name="favicon">
                                                <label class="custom-file-label" for="inputGroupFile01">Dosya Seç</label>
                                            </div>
                                        </div>
                                    </td></tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Anasayfa Resim</td><td>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="setting-home_image" name="home_image">
                                                <label class="custom-file-label" for="inputGroupFile01">Dosya Seç</label>
                                            </div>
                                            <div><img style="width:120px" src="{{asset('storage/'.$data['home_image'][0]->value)}}"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Araçlar Sayfası</td><td>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="setting-cars_image" name="cars_image">
                                                <label class="custom-file-label" for="inputGroupFile01">Dosya Seç</label>
                                            </div>
                                            <div><img style="width:120px" src="{{asset('storage/'.$data['cars_image'][0]->value)}}"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Title</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-title" placeholder="Worldcar Rent A Car" name="title"
                                               value=" @if(isset($data['title'][0])) {{$data['title'][0]->value}}  @endif"
                                               required="required">
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Meta Key</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-keyword" placeholder="Kelime1, Kelime2" name="keywords"
                                               value=" @if(isset($data['keywords'][0])) {{$data['keywords'][0]->value}}  @endif"    required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Meta Description</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-description"  value=" @if(isset($data['description'][0])) {{$data['description'][0]->value}}  @endif  "   placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry" name="description"  required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">0850</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-850"  value=" @if(isset($data['850'][0])) {{$data['850'][0]->value}}  @endif  " name="850" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Cep Telefonu</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-phone1"  value=" @if(isset($data['phone1'][0])) {{$data['phone1'][0]->value}}  @endif  "  name="phone1" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Normal Hat</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-phone2"  value=" @if(isset($data['phone2'][0])) {{$data['phone2'][0]->value}}  @endif  "  name="phone2" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Eposta</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-email"  value=" @if(isset($data['email'][0])) {{$data['email'][0]->value}}  @endif  "  name="email" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Address1</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-address1"  value=" @if(isset($data['address1'][0])) {{$data['address1'][0]->value}}  @endif  "  name="address1" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Address2</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-address2"  value=" @if(isset($data['address2'][0])) {{$data['address2'][0]->value}}  @endif  "  name="address2" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Address3</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-address3"  value=" @if(isset($data['address3'][0])) {{$data['address3'][0]->value}}  @endif  "  name="address3" >
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 40%">Address4</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-address4"  value=" @if(isset($data['address4'][0])) {{$data['address4'][0]->value}}  @endif  "  name="address4" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-sm table-gray-300 ">
                            <tbody>

                            <tr><td scope="row" style="width: 40%">Varsayılan Para Birimi </td>
                                <td>
                                    <select class="form-control selectpicker" id="settings-currency_id" name="currency_id" data-live-search="true" data-width="fit" tabindex="-98">
                                        @foreach($currency as $item)
                                            <option value="{{$item->id}}" {{ ( $item->id == (isset($data['currency_id'][0]) ? $data['currency_id'][0]->value : 0)) ? 'selected' : '' }}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr><td scope="row" style="width: 40%">Varsayılan Dil</td>
                                <td>
                                    <select class="form-control selectpicker" id="settings-language_id" name="language_id" data-live-search="true" data-width="fit" tabindex="-98">
                                        @foreach($language as $item)
                                            <option value="{{$item->id}}" {{ ( $item->id == (isset($data['language_id'][0]) ? $data['language_id'][0]->value : 0)) ? 'selected' : '' }}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr><td scope="row" style="width: 40%">Kredi Kartı İle Ödeme</td>
                                <td>
                                    <select class="form-control" id="settings-language_id" name="card_payment" >
                                        <option value="true"  @if($data['card_payment'][0]->value == 'true') selected @endif>Evet</option>
                                        <option value="false" @if($data['card_payment'][0]->value == 'false') selected @endif>Hayır</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td scope="row" style="width: 40%">Saat Farkı</td>
                                <td>
                                    <input type="number" name="reservation_time" class="form-control" value="{{$data['reservation_time'][0]->value}}">
                                </td>
                            </tr>
                            </tbody>
                         </table>
                            <hr>
                             <table class="table table-sm table-gray-300 ">
                                <tbody>
                                <tr><td scope="row" style="width: 40%">Araç Km Sınırı </td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-car_km"  value="@if(isset($data['car_km'][0])){{$data['car_km'][0]->value}}@endif"  name="car_km" >
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Araç Km Sınırı Gün Sayısı</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-car_km_day"  value="@if(isset($data['car_km_day'][0])){{$data['car_km_day'][0]->value}}@endif"  name="car_km_day" >
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Sürücü Yaşı</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-driver_age"  value="@if(isset($data['driver_age'][0])){{$data['driver_age'][0]->value}}@endif"  name="driver_age" >
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Ehliyet Yaşı</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-license_age"  value="@if(isset($data['license_age'][0])){{$data['license_age'][0]->value}}@endif"  name="license_age" >
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Header Reklam</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-header_advert"  value="@if(isset($data['header_advert'][0])){{$data['header_advert'][0]->value}}@endif"  name="header_advert" >
                                    </td>
                                </tr>
                                <tr><td scope="row" style="width: 40%">Yurtdışı Fiyat Farkı</td>
                                    <td>
                                        <input type="text" class="form-control" id="settings-outside_price"  value="@if(isset($data['outside_price'][0])){{$data['outside_price'][0]->value}}@endif"  name="outside_price" >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="col-md-12" style="    padding: 10px;">
                                <button style="    width: 100%;" type="submit" class="btn btn-primary">KAYDET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
