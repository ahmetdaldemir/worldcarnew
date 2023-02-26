<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="author" content="Elitcar">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="OuyDRiOID0oogS8d6vrwfSNMmDGraJehMaBnydhU">
    <meta name="app-url" content="https://worldcarrental.com">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('public/view/media/linecons.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/xenon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/xenon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/xenon-components.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/xenon-skins.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{ asset('public/view/media/multi-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="{{ asset('public/view/media/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/view/media/custom.css')}}">

    <script src="{{ asset('public/view/media/jquery-1.12.4.min.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>WordlCarRental Panel</title>
    <style>.cke {
            visibility: hidden;
        }</style>
</head>
<body class="modal-body" ng-app="app">
<div class="panel panel-default medias-root"
     data-settings="{&quot;temp_key&quot;:&quot;16472746508U&quot;,&quot;table_type&quot;:&quot;App\\Models\\Delivery&quot;,&quot;table_id&quot;:103414}">
    <input name="medias_temp_key" type="hidden" value="16472746508U">
    <input name="medias_json" type="hidden" value="[]">
    <input name="deleted_medias_json" type="hidden" value="[]">
    <div class="panel-heading">
        <h3 class="panel-title">Medya Yönetimi</h3>
    </div>
    <div class="panel-body">
        <div class="list-area">
            <h3 class="temp-medias-title hidden">Geçici Dosyalar</h3>
            <ul class="list-unstyled temp-medias-list"></ul>
            <div class="clearfix"></div>
            <?php if(!is_null($operation)){ ?>
            <div class="position-relative">
                <div class="scrollable-container ps-container" style="position: relative; overflow: hidden; max-height: 370px;">
                    <ul class="list-unstyled medias-list list-preview ui-sortable">
                        <?php   $files = json_decode($operation->files,true);   ?>
                        <?php foreach($files as $item){   ?>
                        <li data-id="143745">
                                <span class="buttons btn-group">
                                    <span class="btn btn-xs btn-icon btn-white handle ui-sortable-handle"><i class="i-Arrow-Around"></i></span>
                                    <span class="btn btn-xs btn-icon btn-success btn-preview" data-type="image"><i class="i-Eye"></i></span>
                                    <a class="btn btn-xs btn-icon btn-info btn-download" ng-click="mediaDown('{{$item}}')" download="download" target="_blank"><i  class="i-Download"></i></a>
                                </span>
                            <img src="{{asset('storage/reservation_history/'.$item)}}" class="preview-image loading">
                            <span class="name">kimlik-e</span>
                            <span class="access hidden">Özel</span>
                            <span class="time hidden">09.07.2019 20:59</span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php }else{ ?>
            <h3 class="medias-title">Medya Bulunmuyor!</h3>

        <?php } ?>
        </div>
    </div>
</div>
<style>
    .panel .panel-options {
        margin-right: 25px;
    }
</style>
<style>
    .medias-root .list-area h3 {
        margin-top: 0;
        margin-bottom: 5px;
        color: #333;
        font-size: 16px;
    }

    .medias-root .list-area ul > li {
        display: block;
        color: #555;
    }

    .medias-root .list-area ul > li .btn {
        margin: 0;
    }

    .medias-root .list-area ul > li > span {
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .medias-root .list-area ul.medias-list > li {
        padding: 4px 2px;
        height: 31px;
        overflow: hidden;
        background-color: #f7f7f7;
        border-bottom: 1px solid #fff;
        -webkit-transition: background 0.3s;
        -moz-transition: background 0.3s;
        -ms-transition: background 0.3s;
        -o-transition: background 0.3s;
        transition: background 0.3s;
    }

    .medias-root .list-area ul.medias-list > li:hover {
        background-color: #DDD;
    }

    .medias-root .list-area ul.medias-list > li > .handle i {
        width: 18px;
        font-size: 10px;
    }

    .medias-root .list-area ul.medias-list > li > .name {
        min-width: 50px;
        width: calc(100% - 405px);
        line-height: 22px;
    }

    .medias-root .list-area ul.medias-list > li > .mime-type {
        width: 120px;
        line-height: 22px;
    }

    .medias-root .list-area ul.medias-list > li > .access {
        width: 40px;
        line-height: 22px;
    }

    .medias-root .list-area ul.medias-list > li > .time {
        width: 110px;
        line-height: 22px;
    }

    .medias-root .list-area ul.medias-list > li > .buttons {
        width: 100px;
        float: right;
    }

    .medias-root .list-area ul.medias-list.list-preview > li {
        position: relative;
        padding: 5px;
        width: 250px;
        height: 180px;
        overflow: hidden;
        display: inline-block;
    }

    .medias-root .list-area ul.medias-list.list-preview > li > .name {
        position: absolute;
        left: 5px;
        bottom: 5px;
        width: calc(100% - 10px);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        background-color: rgba(51, 51, 51, 0.50);
        color: #fff;
        padding: 0 5px;
        font-weight: bold;
    }

    .medias-root .list-area ul.medias-list.list-preview > li > .buttons {
        position: absolute;
        left: 5px;
        top: 5px;
        width: calc(100% - 10px);
        background-color: rgba(51, 51, 51, 0.50);
    }

    .medias-root .list-area ul.medias-list.list-preview > li > .preview-image {
        height: 100%;
        width: auto;
        display: block;
        margin: auto;
    }

    .medias-root .list-area ul.temp-medias-list {
        display: block;
        margin-bottom: 5px;
    }

    .medias-root .list-area ul.temp-medias-list > li {
        display: block;
        float: left;
        margin-right: 20px;
        margin-bottom: 10px;
        height: 22px;
        padding: 0;
        overflow: hidden;
    }

    .medias-root .list-area ul.temp-medias-list > li .label {
        font-size: 12px;
        height: 22px;
        line-height: 22px;
        padding: 0 5px 0 2px;
        float: left;
    }

    .medias-root .medias-title {
        font-weight: bold;
        font-size: 16px;
    }

    #media-upload-modal {
        z-index: 1051;
    }
</style>

<!-- Bottom Scripts -->
<script src="{{ asset('public/view/media/jquery-ui-1.12.1.min.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

<script>
    app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
        $scope.mediaDown = function (item) {

            $http({
                method: 'GET',
                url: '/admin/admin/reservation/mediadownload?media='+item+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response);
            });
        }

    });
</script>





<script src="{{ asset('public/view/media/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/view/media/TweenMax.min.js')}}"></script>
<script src="{{ asset('public/view/media/resizeable.js')}}"></script>
<script src="{{ asset('public/view/media/joinable.js')}}"></script>
<script src="{{ asset('public/view/media/xenon-api.js')}}"></script>
<script src="{{ asset('public/view/media/xenon-toggles.js')}}"></script>
<script src="{{ asset('public/view/media/xenon-widgets.js')}}"></script>
<script src="{{ asset('public/view/media/toastr.min.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/view/media/dataTables.bootstrap.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.dataTables.yadcf.js')}}"></script>
<script src="{{ asset('public/view/media/dataTables.tableTools.min.js')}}"></script>
<script src="{{ asset('public/view/media/icheck.min.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.multi-select.js')}}"></script>
<script src="{{ asset('public/view/media/ckeditor.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.js')}}"></script>
<script src="{{ asset('public/view/media/dropzone.min.js')}}"></script>
<script src="{{ asset('public/view/media/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.inputmask.bundle.js')}}"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{ asset('public/view/media/xenon-custom.js')}}"></script>

<!-- Custom -->
<script src="{{ asset('public/view/media/data-manipulator.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.tagsinput.min.js')}}"></script>
<script src="{{ asset('public/view/media/select2.full.min.js')}}"></script>
<script src="{{ asset('public/view/media/date.min.js')}}"></script>
<script src="{{ asset('public/view/media/moment-with-locales.min.js')}}"></script>
<script src="{{ asset('public/view/media/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('public/view/media/functions.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('public/view/media/jquery.floatThead.min.js')}}"></script>
<script src="{{ asset('public/view/media/serialize-object.js')}}"></script>
<script src="{{ asset('public/view/media/online-payment.js')}}"></script>
<script src="{{ asset('public/view/media/dynamic-data-table.js')}}"></script>
<script src="{{ asset('public/view/media/reservation-list.js')}}"></script>
<script src="{{ asset('public/view/media/morph-user-select.js')}}"></script>
<script src="{{ asset('public/view/media/media.js')}}"></script>

</body>
</html>
