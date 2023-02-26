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

        <div class="col-12 col-sm-12 user-content">
		<h4>Anket</h4>

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
