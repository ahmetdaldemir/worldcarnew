@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/admincss/operation.css') }}">
@include('admin.operation.error')
@include('admin.operation.search',['location' => $location])
@include('admin.operation.table',['reservationarray'=>$reservationarray])
    <div id="reservationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            style="right: 25px; position: absolute;">&times;
                    </button>
                    <h4 class="modal-title"><b style="color:#000">Çıkış</b>-<b style="color:#f00">Dönüş</b>  Bilgileri</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped">
                        <tr class="bg-primary text-white">
                            <td>Çıkış Tarihi</td>
                            <td>Çıkış KM</td>
                            <td>Çıkış Yakıt</td>
                            <td>Resim</td>
                            <td>Kullanıcı</td>
                        </tr>
                        <tr>
                            <td>@{{entry_exit.drop.created}}</td>
                            <td>@{{entry_exit.drop.km}} Km</td>
                            <td>@{{entry_exit.drop.fuel}} </td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Dönüş Yap"
                                   data-original-title="Dönüş Yap" style="line-height: 3;cursor:pointer"
                                   ng-click="mediaModal(reservationid,'drop')" class="m-1">
                                    <i class="i-Disk"></i>
                                </a>
                            </td>
                            <td>
                                @{{entry_exit.drop.user}}
                            </td>
                        </tr>
                    </table>
                    <hr/>
                    <table class="table table-striped background-danger">
                        <tr class="bg-danger text-white">
                            <td>Dönüş Tarihi</td>
                            <td>Dönüş KM</td>
                            <td>Dönüş Yakıt</td>
                            <td>Kullanıcı</td>
                        </tr>
                        <tr>
                            <td>@{{entry_exit.up.created}}</td>
                            <td>@{{entry_exit.up.km}} Km</td>
                            <td>@{{entry_exit.up.fuel}} </td>
                            <td>
                                @{{entry_exit.up.user}}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button style="padding-bottom: 2px;padding-top: 5px;padding-left: 5px;padding-right: 5px;"
                            type="button" class="btn btn-default" data-dismiss="modal">KAPAT
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Rezervasyon İle İglili Mail Gönderme</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="model-header" style="margin: 1rem 0 0 0;">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-success" ng-click="getPage('comfirm',reservationid,'comfirm',1)"
                                    type="button">Onay Maili
                            </button>
                            <button class="btn btn-danger" ng-click="getPage('cancel',reservationid,'closed',2)"
                                    type="button">Red Maili
                            </button>
                            <button class="btn btn-primary"
                                    ng-click="getPage('reservation_edit',reservationid,'reservation_edit',4)"
                                    type="button">Geliş Dönüş Bilgileri
                            </button>
                        </div>
                    </div>
                </div>
                <hr style="width: 100%;margin-top: 1rem; margin-bottom: 1rem;">
                <div class="modal-body">
                    <form class="form-group" method="post" enctype="multipart/form-data"
                          action="{{route('admin.admin.reservation.addmail')}}">
                        @csrf
                        <div class="modal-body">
                            <input name="id" value="@{{reservationid}}" type="hidden">
                            <input name="file" value="@{{file}}" type="hidden">
                            <input name="status" value="@{{status}}" type="hidden">
                            <div style="width: 100%;font-size: 12px" rows="20"  ng-bind-html="message  | unsafe"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary ml-2" type="submit">GÖNDER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         aria-hidden="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: .5rem;">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Yorumlar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body" style="padding: .5rem;">
                    <table class="table table-bordered table-hover table-condensed table-nowrap-th">
                        <thead>
                        <tr>
                            <th>Görevli</th>
                            <th>Tür</th>
                            <th>İçerik</th>
                            <th>Zaman</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="comment in data">
                            <td class="nowrap">@{{ comment.sender }}</td>
                            <td class="nowrap"><span class="text-gray">Not</span></td>
                            <td class="table-container">@{{ comment.messages }}</td>
                            <td class="nowrap">@{{ comment.created_at | date:'d-MM-yyyy HH:mm:ss' }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="height: 10px;"></div>
                    <form class="form-group" id="notes" method="post" enctype="multipart/form-data"
                          ng-submit="addComment(reservationid)">
                        @csrf
                        <input name="id" value="@{{reservationid}}" type="hidden">
                        <div class="input-group">
                            <input style="width: 95%;float: left" type="text" name="messages"  placeholder="Yeni ekle..">
                            <span class="input-group-addon separator"></span>
                            <span style="width: 5%;float: left" class="input-group-btn"><button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;" class="btn btn-primary btn-add">Ekle</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Dönüş İşlemleri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.process')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" id="reservationidprocess" value="" type="hidden">
                        <input name="type" value="up" type="hidden">
                        <table class="table table-striped">
                            <tr class="bg-primary text-white">
                                <td>Çıkış Tarihi</td>
                                <td>Çıkış KM</td>
                                <td>Çıkış Yakıt</td>
                            </tr>
                            <tr>
                                <td>@{{entry_exit_s.drop.created}}</td>
                                <td>@{{entry_exit_s.drop.km}} Km</td>
                                <td>@{{entry_exit_s.drop.fuel}} Çizgi</td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 40%;">Personel</th>
                                <td>
                                    <select class="form-control" name="id_user">
                                        <?php foreach($users as $user){ ?>
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>KM</th>
                                <td>
                                    <input class="form-control" ng-keyup="upKey()" name="km" type="number"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Yakıt</th>
                                <td>
                                    <select class="form-control" name="fuel">
                                        <option value="1/8">1/8</option>
                                        <option value="2/8">2/8</option>
                                        <option value="3/8">3/8</option>
                                        <option value="4/8">4/8</option>
                                        <option value="5/8">5/8</option>
                                        <option value="6/8">6/8</option>
                                        <option value="7/8">7/8</option>
                                        <option value="8/8">8/8</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Çıkış Resimler</th>
                                <td>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="inputGroupFile02" name="files[]"
                                               type="file" multiple>
                                        <label class="custom-file-label" for="inputGroupFile02"
                                               aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div style="color:#f00;" class="">@{{errormessage}}</div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2 lockup" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Çıkış İşlemleri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data"
                      action="{{route('admin.admin.reservation.process')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" id="reservationidprocess" value="" type="hidden">
                        <input name="type" value="drop" type="hidden">
                        <table
                            class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 40%;">Personel</th>
                                <td>
                                    <select class="form-control" name="id_user">
                                        <?php foreach($users as $user){ ?>
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>KM</th>
                                <td>
                                    <input class="form-control" name="km" type="number"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Yakıt</th>
                                <td>
                                    <select class="form-control" name="fuel">
                                        <option value="1/8">1/8</option>
                                        <option value="2/8">2/8</option>
                                        <option value="3/8">3/8</option>
                                        <option value="4/8">4/8</option>
                                        <option value="5/8">5/8</option>
                                        <option value="6/8">6/8</option>
                                        <option value="7/8">7/8</option>
                                        <option value="8/8">8/8</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Dönüş Resimler</th>
                                <td>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="inputGroupFile02" name="file[]"
                                               type="file"
                                               multiple>
                                        <label class="custom-file-label" for="inputGroupFile02"
                                               aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary ml-2" type="button">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="medias-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         aria-hidden="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: .5rem;">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Yorumlar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body" style="padding: .5rem;">
                    <form class="form-group" id="notes" method="post" enctype="multipart/form-data"  ng-submit="addSms(reservationid)">
                        @csrf
                        <input name="id" value="@{{reservationid}}" type="hidden">
                        <div class="input-group">
                            <textarea style="width: 95%;float: left" type="text" name="messages"  ></textarea>
                            <span class="input-group-addon separator"></span>
                            <span style="width: 5%;float: left" class="input-group-btn">
                                <button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;" class="btn btn-primary btn-add">Gönder</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="plateModal" role="dialog" aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Onaylama Ve Plaka Atama</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('admin.admin.operation.addplate')}}">
                    @csrf
                    <div class="modal-body">
                        <input name="id" value="@{{reservationid}}" type="hidden">
                        <table class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                            <tbody>
                            <tr>
                                <th style="width: 25%;">Plaka Atama</th>
                                <td>
                                    <select  class="form-control js-example-basic-single" data-live-search="true" name="plate">
                                        <option value="0">PLAKASIZ</option>
                                        <optgroup ng-repeat="plate in plates" label="@{{ plate.car }} @{{ plate.model.modelname }}">
                                            <option ng-repeat="item in plate.plate" ng-selected="item.id == plate" value="@{{item.id}}">
                                                <span>@{{  item.plate}}</span> |  @{{  item.car.transmission}} |  @{{  item.car.fuel}}
                                                @{{item.getDropData}}  | <!-- ?=$dropdata['checkout']?>-< ?=$dropdata['checkouttime']?>
                                                | < ?=$dropdata['droplocation']?> | REZ = < ?=$dropdata['reservation_id']? -->
                                            </option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                        <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="restUpdateModal" role="dialog" aria-hidden="false">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width:800px">
            <div class="modal-content">
                <div class="modal-header" style="padding: .5rem;">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Ödeme Notu</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="padding: .5rem;">
                    <form class="form-group" id="restupdateForm" method="post" enctype="multipart/form-data"
                          ng-submit="restUpdateProcess()">
                        @csrf
                        <input name="id" id="reservationId" type="hidden">
                        <div class="form-group">
                            <input class="form-control" type="text" name="price" placeholder="Ödeme Miktarı" style="width: 82%;float: left" required>
                            <select class="form-control"  name="currency" style="float: right">
                                <?php foreach ($currencies as $currency){ ?>
                                <option value="<?=$currency->id?>"><?=$currency->title?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="messages" placeholder="Not Yazınız..">
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon separator"></span>
                            <span style="width: 5%;float: left" class="input-group-btn">
                                <button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;"
                                        class="btn btn-primary btn-add">Ekle</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('public/js/angularcustom.js') }}"></script>
@endsection

