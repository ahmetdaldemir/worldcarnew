@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Müşteri Ekleme Formu</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.customer.update')}}">
                        @csrf
                        <input name="id" value="<?=$id?>" type="hidden">

                        <div class="modal-body" style="    border: 1px solid #ccc;margin: 20px;">
                            <div class="row">
                                <div class="col-md-4" style="margin-bottom: 30px;">
                                    <div class="title">Kişisel Bilgileri</div>
                                    <table style="    width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td style="font-size: 13px;width: 145px;" nowrap="" align="left">Adı :</td>
                                            <td><input type="text"  oninput="this.value = this.value.toUpperCase()"  value="@if($customer) {{$customer->firstname}} @endif" name="firstname" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;width: 145px;" nowrap="" align="left">Soyadı :</td>
                                            <td><input type="text"  oninput="this.value = this.value.toUpperCase()"  value="@if($customer) {{$customer->lastname}} @endif" name="lastname" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;width: 145px;" nowrap="" align="left">Doğum Yeri :</td>
                                            <td><input type="text" name="birthpalace" value="@if($customer) {{$customer->birthpalace}} @endif" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;width: 145px;">Doğum Tarihi :</td>
                                            <td><input type="text" name="birthday"  value="{{ \Carbon\Carbon::parse($customer->birthday)->format('d-m-Y')}}" class="form-control" id="datepicker" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;width: 145px;">Cinsiyet :</td>
                                            <td>
                                                <select class="form-control" name="gender" id="customer-gender">
                                                    <option @if($customer->gender == 'men') selected @endif value="men">Erkek</option>
                                                    <option @if($customer->gender == 'women') selected @endif value="woman">Kadın</option>
                                                </select>
                                                <div class="form-check form-check-inline">
                                                    <input style="    width: 20px;height: 20px;" class="form-check-input"
                                                           @if($customer->gender == 'men') selected @endif  type="radio" name="gender" id="gendermen" value="men">
                                                    <label class="form-check-label" for="inlineRadio1">Erkek</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input @if($customer->gender == 'woman') selected @endif style="    width: 20px;height: 20px;" class="form-check-input"
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
                                            <td style="font-size: 13px;width: 145px;" nowrap="" align="left">Dil :</td>
                                            <td>
                                                <select name="language" class="form-control">
                                                    @foreach($languages as $language)
                                                        <option @if($customer->language == $language->id) selected @endif  value="{{$language->id}}">{{$language->title}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Cep Telefonu :</td>
                                            <td><input type="text" name="phone" value="@if($customer) {{$customer->phone}} @endif" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Ev/İş Telefonu(Yedek) :</td>
                                            <td><input type="text" name="phone1" value="@if($customer) {{$customer->phone1}} @endif" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Vergi Dairesi :</td>
                                            <td><input type="text" name="tax_office" value="@if($customer) {{$customer->tax_office}} @endif" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Vergi No :</td>
                                            <td><input type="text" name="tax" value="@if($customer) {{$customer->tax}} @endif" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Email :</td>
                                            <td><input type="text" name="email" value="@if($customer) {{$customer->email}} @endif" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Şifre :</td>
                                            <td>
                                                <input type="text" name="password_new"  class="form-control">
                                                <input type="hidden" name="password" value="@if($customer) {{$customer->password}} @endif"  class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Ülke :</td>
                                            <td>
                                                <select name="nationality" class="form-control">
                                                    <?php foreach ($country as $item){ ?>
                                                    <option @if($customer->nationality == $item->country_name) selected @endif value="<?=$item->country_name?>"><?=$item->country_name?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                     </table>
                                </div>
                                <div class="col-md-4" style="  margin-bottom: 30px;">
                                    <div class="title">Ehliyet Bilgileri</div>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">No :</td>
                                            <td><input type="text"  value="<?=$customer->driving_licance_number?>" name="driving_licance_number" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Sınıfı :</td>
                                            <td><input class="form-control"  value="<?=$customer->driving_licance_class?>" name="driving_licance_class" type="text"  id="customer-driving_licance_class"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Verildiği Yer:</td>
                                            <td><input type="text"  value="<?=$customer->driving_licance_location?>" name="driving_licance_location" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Veriliş Tarihi :</td>
                                            <td><input type="text"  value="<?=$customer->driving_licance_date?>" name="driving_licance_date" id="drivinglicance" class="form-control" required></td>
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
                                            <td><input type="text"  value="<?=$customer->identity_no?>" name="identity_no" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td nowrap="" align="left">Kimlik Türü :</td>
                                            <td>
                                                <select name="identity_type" class="form-control">
                                                    <option @if($customer->identity_type == 'identity') selected @endif value="identity">TC Kimlik</option>
                                                    <option @if($customer->identity_type == 'passport') selected @endif value="passport">Passport</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td nowrap="" align="left">Verildiği Yer :</td>
                                            <td><input type="text"  value="<?=$customer->passport_palace?>" name="passport_palace" class="form-control"/></td>
                                        </tr>
                                        <tr>
                                            <td  align="left">Veriliş Tarihi :</td>
                                            <td><input type="text"  value="<?=$customer->passport_date?>" name="passport_date" class="form-control"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12" style=" margin-bottom: 30px;">
                                    <div class="title">Adres Bilgileri</div>
                                    <div class="row">
                                        <div class="col-md-12">Ev Adresi :</div>
                                        <div class="col-md-12"><input value="<?=$customer->home_address?>" name="home_address" class="form-control"/></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">İş Adresi :</div>
                                        <div class="col-md-12"><input value="<?=$customer->office_address?>" name="office_address" class="form-control"/></div>
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

    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 100%;
        }
    </style>
@endsection
