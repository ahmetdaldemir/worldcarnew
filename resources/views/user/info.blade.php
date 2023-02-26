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
	<form method="POST" action="/{{app()->getLocale()}}/profil/info/update">
	<div class="row user-menu">
     @include('user.menu')
	<div class="col-12 col-sm-6 user-content">
		<h4>Bilgilerim</h4>
            @csrf
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('firstname')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="firstname" placeholder="{{__('firstname')}}" value="{{$data['customers']->firstname}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('lastname')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="lastname" placeholder="{{__('lastname')}}" value="{{$data['customers']->lastname}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('phone')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="phone" placeholder="{{__('phone')}}" value="{{$data['customers']->phone}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('email')}}</label>
			<div class="col-sm-9">
			  <input type="email" class="form-control" name="email" placeholder="{{__('email')}}" value="{{$data['customers']->email}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('bdate')}} {{$data['customers']->birthday}}</label>
			<div class="col-sm-9">
				<input id="birthday" data-mask="00-00-0000" autocomplete="off" type="text" class="form-control" name="birthday" placeholder="{{__('bdate')}}" value="{{date('d-m-Y',strtotime($data['customers']->birthday))}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">Ülke</label>
			<div class="col-sm-9">
                <input id="country" name="nationality" class="form-control"  value="{{$data['customers']->nationality}}" type="text"  autocomplete="off" />
			</div>
		  </div>
	</div>
	<div class="col-12 col-sm-6 user-content">
		<h4>{{__('createnewpassword')}}</h4>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('oldpassword')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="oldpassword" placeholder="{{__('oldpassword')}}" >
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('newpassword')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="newpassword" placeholder="{{__('newpassword')}}">
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label">{{__('newpasswordconfirm')}}</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" name="oldpassword" placeholder="{{__('name')}}" >
			</div>
		  </div>
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label"></label>
			<div class="col-sm-9">
			  <button type="submit" class="btn btn-primary">{{__('update')}}</button>
			</div>
		  </div>
	</div>
	<div class="col-12 col-sm-6 user-content">
		  <div class="form-group row">
			<label class="col-sm-3 col-form-label"></label>
			<div class="col-sm-9">
			  <button type="submit" class="btn btn-primary">{{__('update')}}</button>
			</div>
		  </div>
	</div>
	</div>
	</form>
</div>

<link href="{{ asset('public/view/country/countrySelect.css') }}" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js" type="text/javascript"></script>
<script src="{{asset("public/view/js/country.js")}}"></script>
<script src="{{asset("public/view/country/countrySelect.js")}}"></script>
    <script>
        $("#country").countrySelect();

    </script>

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
<link href="{{ asset('public/view/country/countrySelect.css') }}" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="{{asset("public/view/js/country.js")}}"></script>
<script src="{{asset("public/view/country/countrySelect.js")}}"></script>
<script>
    var $ = jQuery;
    $(document).ready(function() {
        $("#country").countrySelect();
    });
</script>
