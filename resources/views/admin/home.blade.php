@extends('layouts.admin')


@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Site İstatistikleri</h1>
        <ul style="width: 85%">
            <li><a href="">Dashboard</a></li>
            <li>Version 1</li>
            <li style="float: right"><a href="{{route('admin.admin.transfer.create')}}" class="btn btn-success" ng-click="">Transfer Ekle</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i style="color: #f00;" class="i-Arrow-Forward-2"></i>
                        <div class="content">
                            <p class="text-muted text-12 mt-2 mb-0">Çıkışı Yapılmamışlar</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$totalDrop}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" style="    background: #e10b0b;">
                    <div class="card-body"><i style="color: #fff;" class="i-Arrow-Back-3"></i>
                        <div class="content">
                            <a href="{{route('admin.admin.reservation.waitupreservation')}}">
                            <p class="text-muted text-12 mt-2 mb-0" style="color: #fff !important;font-weight: bold;">Dönüşü Yapılmamışlar</p>
                            <p class="text-primary text-24 line-height-1 mb-2" style="color: #fff !important;">{{$totalUp}}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Calendar-4"></i>
                            <div class="content">
                                <p class="text-muted text-15 mt-2 mb-0">Günlük Rezervasyon</p>
                                <p class="text-primary text-18 line-height-1 mb-2">{{$daycount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i style="color: rgb(242 70 54);" class="i-Car"></i>
                        <div class="content">
                            <p class="text-muted text-12 mt-2 mb-0">Toplam İş Günü</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$totalday}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Calendar-4"></i>
                        <div class="content">
                            <p class="text-muted text-15 mt-2 mb-0">Aylık Rezervasyon</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$mounthcount}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Money"></i>
                        <div class="content">
                            <p class="text-muted text-15 mt-2 mb-0">Toplam Rezervasyon</p>
                            <p class="text-primary text-18 line-height-1 mb-2">{{$totalreservation}}</p>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="xe-widget xe-status-update" data-auto-switch="5">
                <div class="xe-header">
                    <div class="xe-icon">
                        <i class="i-RSS" style="font-size: 45px"></i>
                    </div>
                    <div class="xe-nav">
                        <a href="javascript:void(0);" class="xe-prev">
                            <i class="fa-angle-left"></i>
                        </a>
                        <a href="javascript:void(0);" class="xe-next">
                            <i class="fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="xe-body">

                    <ul class="list-unstyled">
                        <?php  if(!empty($notification)) {  foreach($notification as $items) {
                        $i = 0; foreach($items as $item){   ?>
                        <li>
                            <table>
                                <th scope="row">{{$i}}</th>
                                <td>{{$item['plate'] ?? "Bulunamadı"}}</td>
                                <td>{{$item['type'] ?? "Bulunamadı"}}</td>
                                <td>{{$item['text'] ?? "Bulunamadı"}}</td>
                                <td>{{$item['date'] ?? "Bulunamadı"}}</td>
                            </table>
                        </li>
                        <?php $i++; } ?>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="xe-footer hidden">
                    <a href="javascript:void(0);">
                        <i class="fa-retweet"></i>
                        Tümünü göster
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card o-hidden mb-4">
                <div class="card-header d-flex align-items-center border-0">
                    <h3 class="w-50 float-left card-title m-0">Giriş Log Kayıtları</h3>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table text-center " id="user_table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Date</th>
                                <th scope="col">IP</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($log)){ ?>
                            <?php foreach($log as $item){    ?>
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{ $item->userType }}</td>
                                <td>{{ \App\User::find($item->userId)->name ?? "Bulunamadı" }}</td>
                                <td>{{$item->ipAddress}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                                {{--                                        <td><span class="badge badge-success"></span><a target="_blank"--}}
                                {{--                                                                                        href="https://www.ipsorgu.com/ip_numarasindan_adres_bulma.php?ip=<?=$item->getJsonDataAttribute()['ipAddress']?>#sorgu">{{$item->getJsonDataAttribute()['ipAddress']}}</a>--}}
                                {{--                                        </td>--}}
                            </tr>
                            <?php } ?>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card text-left">
                <div class="card-header d-flex align-items-center border-0">
                    <h3 class="w-50 float-left card-title m-0">Transfer Listesi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">İsim Soyisim</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Çıkış Tarihi</th>
                                <th scope="col">Saat</th>
                                <th scope="col">Şöför</th>
                                <th scope="col">Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($transfers)) {  $i = 1; foreach($transfers as $transfer){ ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$transfer->fullname}}</td>
                                <td>{{$transfer->phone}}</td>
                                <td>{{ \Carbon\Carbon::parse($transfer->check_in)->format('d-m-Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($transfer->check_in_time)->format('H:i')}}</td>
                                <td>{{$transfer->driver}}</td>
                                <td><span class="badge badge-success">{{$transfer->status}}</span></td>
                            </tr>
                            <?php  $i++; } ?>
                            <?php   } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

@endsection

<style>
    .clearfix {
        height: 20px;
        width: 100%;
    }

    .xe-widget.xe-status-update {
        background: #062d55;
        color: #fff;
        margin-bottom: 20px;
        padding: 15px;
        padding-bottom: 20px;
    }

    .xe-widget {
        position: relative;
    }

    .xe-widget.xe-status-update .xe-header .xe-icon, .xe-widget.xe-status-update .xe-header .xe-nav {
        display: table-cell;
        vertical-align: top;
        color: #fff;
        padding-bottom: 20px;
    }

    .xe-widget.xe-status-update .xe-header .xe-nav {
        text-align: right;
    }

    .xe-widget.xe-status-update .xe-footer {
        text-transform: uppercase;
        font-size: 11px;
        padding-top: 15px;
    }

    .hidden {
        display: none !important;
        visibility: hidden !important;
    }

    .xe-widget.xe-status-update .xe-header {
        display: table;
        width: 100%;
    }

    .list-group-item {
        background-color: transparent !important;
        border: none !important;
        position: relative !important;
        display: block !important;
        padding: 0.25rem 1.25rem !important;
        font-size: 15px !important;
        margin-bottom: -1px !important;
    }

    .card-icon-bg-primary [class^="i-"] {
        color: rgb(6 45 85);
    }
</style>

