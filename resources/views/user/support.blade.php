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
        <div class="col-12 col-sm-9 user-content">
		<h4>Destek Taleplerim
		<a href="/{{app()->getLocale()}}/profil/call_center/ticket" class="btn btn-primary btn-sm">Talep Oluştur</a>
		</h4>
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">Talep ID</th>
			  <th scope="col">Talep Konusu</th>
			  <th scope="col">Durum</th>
			  <th scope="col">#</th>
			</tr>
		  </thead>
		  <tbody>
		  @foreach($data['support'] as $result)
			<tr>
			  <th scope="row">{{$result->id}}</th>
			  <td>
                  <?php if($result->subject == "talep"){ ?> Talep <?php }else{ ?> Şikayet <?php }?>
              </td>
			  <td>{{$result->status}}</td>
			  <td>
				<a href="/{{app()->getLocale()}}/profil/call_center/detail">Detay</a>
			  </td>
			</tr>
		  @endforeach
		  </tbody>
		</table>
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
