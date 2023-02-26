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
                    <form method="post" action="{{route('admin.admin.customer.save')}}">
                        @csrf
                        <div class="modal-body" style="    border: 1px solid #ccc;margin: 20px;">
                            <div class="row">
                                <div class="col-md-4" style="margin-bottom: 30px;">
                                    <div class="title">Kişisel Bilgileri</div>
                                    <table style="    width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Adı :</td>
                                            <td><input type="text" oninput="this.value = this.value.toUpperCase()" name="firstname" class="form-control" required></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 13px;" nowrap="" align="left">Soyadı :</td>
                                            <td><input type="text"   oninput="this.value = this.value.toUpperCase()" name="lastname" class="form-control" required></td>
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
                                            <td><input type="text" name="email" class="form-control"></td>
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
