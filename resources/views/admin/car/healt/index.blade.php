@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araçlar</div>

                <div class="card-body">
                    <div class="page-body">
                        <div class="col-md-12">
                            <div class="panel panel-default static-table-filters padding-min"
                                 vdata-table="maintenance-cars-table">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Filtre
                                    </h3>
                                    <div class="panel-options">
                                        <div class="pull-right">
                                            <span class="btn btn-xs btn-white btn-filter"><i class="fa-save"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="javascript:void(0);" name="filter-form"
                                          data-table="maintenance-cars-table">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="license_plate">Plaka</label>
                                                    <input class="form-control" name="license_plate" type="text"
                                                           id="license_plate">
                                                </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-6">

                                                    </div>
                                                    <div class="col-sm-6">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default padding-min">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div class="page-loading-overlay absolute-overlay loaded">
                                        <div class="loader-2"></div>
                                    </div>
                                    <table id="maintenance-cars-table"
                                           data-url="https://supplier.elitcarrental.com/maintenance-cars/trackData"
                                           class="table table-bordered table-hover table-condensed table-nowrap vertical-middle">
                                        <thead>
                                        <tr>
                                            <th class="nowrap" style="width: 1%;">Sn</th>
                                            <th>İşlem</th>
                                            <th class="">Plaka</th>
                                            <th class="">Son Km</th>
                                            <th class="">Yapılacak İşlemler</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($plates as $plate){ ?>
                                        <tr>
                                            <td class="nowrap">{{$i}}</td>
                                            <td>
                                                <a href="#" target="_blank" class="btn btn-primary"><i
                                                        style="font-size: 25px;font-weight: bold;"
                                                        class="i-Add"></i></a>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="#" target="_blank">
                                                        <span class="">Plaka: </span>
                                                        <span class="text-bold text-elite"><?=$plate->plate?>
                                                         </span>
                                                    </a>
                                                    <small class="text-gray">({{$plate->getPlateStatus()}})</small>
                                                </div>
                                                <div>
                                                    @if(!is_null($plate->reservation()))
                                                        <a href="#" target="_blank">Rezervasyon PNR: {{$plate->reservation()['pnr']}}</a>
                                                        (<small class="text-info">({{$plate->getPlateStatus()}})</small>)
                                                     @endif

                                                </div>
                                                <div>
                                                    @if(!is_null($plate->reservation()))
                                                        <b>{{$plate->reservation()['up_location']}}</b> - <b>{{$plate->reservation()['drop_location']}}</b>
                                                    @endif

                                                </div>
                                                      @if(!is_null($plate->reservation()))
                                                    <span  style="color:#04b755;font-weight:900"> {{date('d-m-Y',strtotime($plate->reservation()['checkin']))}}</span> - <span style="color:#f00;font-weight:900">{{date('d-m-Y',strtotime($plate->reservation()['checkout']))}}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">{{$plate->km}}</td>
                                            <td>
                                                <table class="table table-condensed">
                                                    <tbody>
                                                    <tr>
                                                        <th>Periyodik Bakım</th>
                                                        <th class="text-red text-right nowrap" style="width: 1%;">79185
                                                            km
                                                        </th>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .page-loading-overlay.absolute-overlay {
        position: absolute;
    }

    .page-loading-overlay.loaded {
        zoom: 1;
        filter: alpha(opacity=0);
        -webkit-opacity: 0;
        -moz-opacity: 0;
        opacity: 0;
        visibility: hidden;
    }

    .page-loading-overlay {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        overflow: hidden;
        background: #2c2e2f;
        z-index: 10000;
        -webkit-perspective: 10000;
        -moz-perspective: 10000;
        perspective: 10000;
        -webkit-perspective: 10000px;
        -moz-perspective: 10000px;
        perspective: 10000px;
        zoom: 1;
        filter: alpha(opacity=100);
        -webkit-opacity: 1;
        -moz-opacity: 1;
        opacity: 1;
        -webkit-transition: all 800ms ease-in-out;
        -moz-transition: all 800ms ease-in-out;
        -o-transition: all 800ms ease-in-out;
        transition: all 800ms ease-in-out;
    }
</style>
