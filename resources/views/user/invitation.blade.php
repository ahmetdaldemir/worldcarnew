@extends('layouts.welcome')

@section('content')
<section class="header-home header-blogdetail">
	<img alt="worldcarRentall" src="https://worldcarrental.com/storage/uploads/account_image.jpeg" width="100%"/>
	<div class="header-home-title">
		<div class="container">
			<div class="text-center">
				<h4 style="bottom: 125px;">{{__('welcome')}}, {{$data['customers']->firstname}} {{$data['customers']->lastname}}</h4>
			</div>
		</div>
	</div>
</section>
<div class="auto-container">
	<div class="row user-menu">
        @include('user.menu')
        <div class="col-12 col-sm-5 user-content">
		<h4>Davet Gönder</h4>
		<form method="POST" action="/{{app()->getLocale()}}/profil/invitation/invitationsend">
            @csrf
		  <div class="form-group row">
			<label class="col-sm-12 col-form-label">Tanidiklarinizinda World Car Rental-Transfer güvencesini tercih etmelerini istiyorsanız onlara davet e-postası gönderin sizin davetinizle Arac kiralama yaptiklarinda hem onlar indirim Puan Kazansın hem Siz.</label>
		  </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Davet Sahibi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" placeholder="İsim Soyisim" value="" >
                </div>
            </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">Davet Email</label>
			<div class="col-sm-9">
			  <input type="email" class="form-control" name="email" placeholder="Email" value="" >
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">Davet Mesaj</label>
			<div class="col-sm-9">
                <textarea  class="form-control" name="message"></textarea>
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label"></label>
			<div class="col-sm-9">
			  <button type="submit" class="btn btn-primary">{{__('invitation')}}</button>
			</div>
		  </div>
		</form>
	</div>
		<div class="col-12 col-sm-7 user-content">
			<h4>{{__('invitation')}}</h4>
			<table class="table table-hover">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">Davet Edilen	</th>
				  <th scope="col">Tarih</th>
				  <th scope="col">Indiririm Kullandi mi?</th>
				</tr>
			  </thead>
                <?php if(!empty($invitation)){ ?>
			  <tbody>
              <?php foreach($invitation as $item){ ?>
				<tr>
				  <th scope="row">{{$item->id}}</th>
				  <th scope="row">{{$item->name}}</th>
				  <th scope="row">{{$item->created_at}}</th>
				  <th scope="row">{{$item->status}}</th>
				</tr>
              <?php } ?>
			  </tbody>
                <?php } ?>
			</table>
			<?php //var_dump($data['reservation'])?>
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
