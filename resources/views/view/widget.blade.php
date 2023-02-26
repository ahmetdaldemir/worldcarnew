<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<?php
date_default_timezone_set("Europe/London");
$range = range(strtotime("00:00"), strtotime("24:00"), 15 * 60);
foreach ($range as $time) {
    $x[] = date("H:i", $time) . "\n";
}

$language = app()->getLocale();
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <form method="get">
                <div class="col-md-12">
                    <label>Dil Seçiniz</label>
                    <select class="form-control" name="language" id="language" onchange="this.form.submit()">
                        <?php foreach ($data['language'] as $item){ if($item->view == 1){ ?>
                        <option @if($language == $item->url) selected @endif value="<?=$item->url?>"><?=$item->title?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="card-body">

            <form method="get" action="{{ route('newlists', $language) }}">
                <div class="row">
                    <div class="col-md-6 " id="startlocation">
                        <select name="pick_up_location" class="js-example-responsive js-states form-control"
                                id="id_label_single">
                            @foreach($data['center_location'] as $item)
                                @if($item->id_parent == 0)
                                    <optgroup label="{{$item->title}}">
                                        @foreach($data['center_location'] as $val)
                                            @if($val->id_parent == $item->id)
                                                <option value="{{$val->id}}">{{$val->title}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                        <label><input type="checkbox" name="changeLocation" id="changeLocation"/> Farklı lokasyonda
                            teslim edeceğim</label>
                    </div>
                    <div class="col-md-3"  id="pick_drop_location" style="display: none">
                        <select name="end-point">

                        </select>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" name="cikis_tarihi_submit" value="<?php echo date('Y-m-d'); ?>"
                               type="date">
                    </div>
                    <div class="col-md-1" style="padding: 0">
                        <select class="form-control" style="padding: 0" name="cikis_saati_submit">
                            @foreach($x as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" name="donus_tarihi_submit"
                               value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" type="date">
                    </div>
                    <div class="col-md-1" style="padding: 0">
                        <select style="padding: 0" class="form-control" name="donus_saati_submit">
                            @foreach($x as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix" style="margin-top: 18px;border-top: 1px solid #c1c1c1;height: 20px;width: 100%;"></div>
                    <div class="clearfix"
                         style="margin-top: 18px;border-top: 1px solid #c1c1c1;height: 20px;width: 100%;"></div>
                    <div class="col-md-12">
                        <button formtarget="_blank" type="submit" class="btn btn-danger w-100">Arama Yap</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $(".js-example-responsive").select2({
        width: 'resolve' // need to override the changed default
    });

    $("#changeLocation").change(function () {
        if ($(this).is(':checked')) {
            const html = '<select name="end_point" class="js-example-responsive js-states form-control" id="id_label_single">' +
                @foreach($data['center_location'] as $item)
                    @if($item->id_parent == 0)
                    '<optgroup label = "{{$item->title}}">' +
                @foreach($data['center_location'] as $val)
                    @if($val->id_parent == $item->id)
                    '<option value="{{$val->id}}"> {{$val->title}} </option>' +
                @endif
                    @endforeach
                    '</optgroup>' +
                @endif
                    @endforeach
                    '</select>';
            $("#pick_drop_location").html(html);
            $("#pick_drop_location").show();
            $("#start_location").removeClass('col-md-6');
            $("#start_location").addClass('col-md-3');
        } else {
            $(this).attr('value', 'false');
            $("#start_location").addClass('col-md-6');
            $("#start_location").removeClass('col-md-3');
        }
    });
</script>

</body>
</html>
