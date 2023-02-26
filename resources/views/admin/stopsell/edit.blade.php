@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transfer Ekle</div>
                <form method="post" action="{{route('admin.admin.stopsell.update')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id"  value="{{$stopsell->id}}"/>
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <select class="form-control" name="id_car">
                                                <option value="0">Seçiniz</option>
                                                <?php foreach ($cars as $val){ ?>
                                                <option <?php if($val["id"] == $stopsell->id_car){echo"selected";} ?> value="<?=$val["id"]?>"><?=$val["brand"]?> - <?=$val["model"]?>
                                                    - <?=$val["year"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="checkin" id="stopsell-checkin" value="{{$stopsell->checkin}}" type="date"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="checkout" id="stopsell-checkout" value="{{$stopsell->checkout}}" type="date"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                        <button type="submit" class="btn btn-primary">KAYDET</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
@endsection

