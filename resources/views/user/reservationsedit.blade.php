@extends('layouts.welcome')

@section('content')
<section class="header-home header-blogdetail">
	<img alt="worldcarRentall" src="https://worldcarrental.com/storage/uploads/account_image.jpeg" width="100%"/>
	<div class="header-home-title">
		<div class="container">
			<div class="text-center">
				<h4 style="bottom: 125px;">{{__('welcome')}}, {{$data['reservation']->reservationInformation->firstname}} {{$data['reservation']->reservationInformation->lastname}}</h4>
			</div>
		</div>
	</div>
</section>
<div class="auto-container">
	<div class="row user-menu">
        @include('user.menu')
        <div class="col-12 col-sm-12 user-content">
            <?php $json = json_decode($data['reservation']->reservationInformation->up_drop_information,TRUE); ?>
          <form method="post" href="/{{app()->getLocale()}}/profil/reservations/reservationeditsave?id={{$data['reservation']->id}}/{{$data['reservation']->reservationInformation->id}}">
            <figure>
                <figcaption>Alış Bilgileri</figcaption>
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td>Alış Tipi</td>
                        <td>Hotel / Adres</td>
                        <td>Oda No / Uçuş Bilg.</td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="info[up][type]">
                                <option
                                    <?php if("up_hotel" == $json["up"]["type"]){echo"selected";} ?> value="up_hotel">
                                    Otel Teslimi
                                </option>
                                <option
                                    <?php if("up_airport" == $json["up"]["type"]){echo"selected";} ?> value="up_airport">
                                    Havalimanı Teslimi
                                </option>
                                <option
                                    <?php if("up_address" == $json["up"]["type"]){echo"selected";} ?> value="up_address">
                                    Adres Teslimi
                                </option>
                                <option
                                    <?php if("up_center" == $json["up"]["type"]){echo"selected";} ?> value="up_center">
                                    Ofis Teslimi
                                </option>
                            </select></td>
                        <td>
                             <input class="form-control" type="text" name="info[up][key]" value="{{$json["up"]["key"]}}"/>
                        </td>
                        <td>
                             <input class="form-control" type="text" name="info[up][value]" value="{{$json["up"]["value"]}}"/>
                        </td>
                    </tr>
                </table>
            </figure>
            <figure>
                <figcaption>Dönüş Bilgileri</figcaption>
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td>Alış Tipi</td>
                        <td>Hotel / Adres</td>
                        <td>Oda No / Uçuş Bilg.</td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="info[drop][type]">
                                <option
                                    <?php if("up_hotel" == $json["drop"]["type"]){echo"selected";} ?> value="up_hotel">
                                    Otel Teslimi
                                </option>
                                <option
                                    <?php if("up_airport" == $json["drop"]["type"]){echo"selected";} ?> value="up_airport">
                                    Havalimanı Teslimi
                                </option>
                                <option
                                    <?php if("up_address" == $json["drop"]["type"]){echo"selected";} ?> value="up_address">
                                    Adres Teslimi
                                </option>
                                <option
                                    <?php if("up_center" == $json["drop"]["type"]){echo"selected";} ?> value="up_center">
                                    Ofis Teslimi
                                </option>
                            </select></td>
                        <td>
                             <input class="form-control" type="text" name="info[drop][key]" value="{{$json["drop"]["key"]}}"/>
                        </td>
                        <td>
                             <input class="form-control" type="text" name="info[drop][value]" value="{{$json["drop"]["value"]}}"/>
                        </td>
                    </tr>
                </table>
            </figure>
          <button class="btn btn-success btn-lg" style="width: 100%">KAYDET</button>
          </form>
        </div>
	</div>
</div>

@endsection

<style>
.user-menu{margin-top: 20px;}
.user-menu .user-links{}
.user-menu .user-links a{display: block;
    line-height: 40px;
    padding: 0 30px;transition: all .5s;background: #ffe39f;
    margin-bottom: 5px;}
.user-menu .user-links a:hover,.user-menu .user-links a.active{background-color: #f9af00;
    color: #FFF;text-shadow: #555 0px 0px 3px;}
.user-content {}
.user-menu h4{padding: 7px 0;
    border-bottom: 3px solid #f9af00;
    font-size: 21px;}
</style>
