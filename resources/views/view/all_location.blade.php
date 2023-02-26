@extends('layouts.welcome')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <a href="/avis-karavan" class="card media-card">
                <figure class="card-img-wrapper">
                    <img src="https://www.avis.com.tr/Avis/media/Avis/anasayfa/avis2.jpg?ext=.jpg" class="img-fluid card-img" alt="Avis Caravan" width="512" height="600">
                </figure>
                <div class="card-img-overlay">
                    <div class="card-content">
                        <h4 class="card-title">Karavan Kiralama</h4>
                        <p class="card-text"></p>
                    </div>
                    <span class="card-link">
                        <span>DETAYLI BİLGİ</span>
                        <i class="icon icon-arrow-right"></i>
                  </span>
                </div>
            </a>
        </div>
    </div>

@endsection
