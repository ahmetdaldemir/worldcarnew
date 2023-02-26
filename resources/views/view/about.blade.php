@extends('layouts.welcome')
@section('title'){{__('Kurumsal')}} - @endsection

@section('content')
<section class="header-blogdetail" style="background-image: url(/storage/uploads/<?=$data["Image"]?>)">
	<div class="container">
        <div class="text-center">
            <h4>{{__('Kurumsal')}}</h4>
        </div>
	</div>
</section>
<div class="sidebar-page-container">
	<div class="auto-container">
		<div class="row">
			<div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<section class="col-12 news-section">
					<div class="news-style-one">
						<div class="inner-box">
							<div class="lower-content">
								<div class="text text-content">
									{!! $data["text"]->description !!}
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
@endsection
