@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transfer Ekle</div>
                <form method="post" action="{{route('admin.admin.transfer.update')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id"  value="{{$transfer->id}}"/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="    margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="fullname" id="transfer-title" value="{{$transfer->fullname}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="phone" id="transfer-title" value="{{$transfer->phone}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="fly_info" id="transfer-title" value="{{$transfer->fly_info}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="check_in" id="transfer-title" value="{{$transfer->check_in}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" type="time" step="900"  name="check_in_time" id="transfer-title" value="{{$transfer->check_in_time}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="up_location" id="transfer-title" value="{{$transfer->up_location}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="drop_location" id="transfer-title" value="{{$transfer->drop_location}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="driver" id="transfer-title" value="{{$transfer->driver}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="price" id="transfer-title" value="{{$transfer->price}}"/>
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

