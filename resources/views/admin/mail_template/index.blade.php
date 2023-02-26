@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="card-title">Email Şablonları</h3>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <?php  foreach($emailTemplateList as $item){  ?>
                        <form ng-submit="addTemplate<?=$item->id?>()" id="EmailTemplate<?=$item->id?>">
                            <div class="card ul-card__border-radius">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?=$item->id?>" aria-expanded="false">
                                            <?=$item->name?>
                                        </a>
                                    </h6>
                                </div>
                                <div class="collapse" id="accordion-item-group<?=$item->id?>" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <?php foreach($languages as $language){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($language->id == 1) {
                                                    echo "active";
                                                } ?> " id="home-basic-tab" data-toggle="tab"
                                                   href="#homeBasic<?=$language->id?><?=$item->id?>" role="tab"
                                                   aria-controls="homeBasic<?=$language->id?>"
                                                   aria-selected="false"><?=$language->title?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <?php foreach($languages as $language){ ?>
                                            <div class="tab-pane  <?php if ($language->id == 1) {
                                                echo " show active";
                                            } ?> fade" id="homeBasic<?=$language->id?><?=$item->id?>" role="tabpanel" aria-labelledby="home-basic-tab">
                                                <div class="row">
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="firstName1">Mail Başlığı</label>
                                                        <input class="form-control" value="{{ \App\Service\GetData::getEmailTitle($item->id,$language->id)}}" id="mailTitle<?=$language->id?>" type="text" name="mail[<?=$item->id?>][mailTitle][<?=$language->id?>]">
                                                    </div>
                                                    <div class="col-md-12 form-group mb-3">
                                                        <label for="lastName1">İçerik</label>
                                                        <textarea class="form-control"  id="mailContent<?=$language->id?>" name="mail[<?=$item->id?>][mailContent][<?=$language->id?>]">{{ \App\Service\GetData::getEmailTemplate($item->id,$language->id)}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
            <?php  foreach($emailTemplateList as $item){  ?>
            $scope.addTemplate<?=$item->id?> = function (templateId, languageId) {
                const data = $("#EmailTemplate<?=$item->id?>").serialize();
                $http({
                    method: 'POST',
                    url: "/admin/admin/emailtemplate/save",
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    swal("Şablon Eklendi", "Eklendi", "success");
                });
            }
            <?php } ?>
        });
    </script>
@endsection
