@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transfer Ekle</div>
                <form method="post" action="{{route('admin.admin.transfer.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <label>Transfer Tarihi</label>
                                            <input class="form-control" type="date" name="check_in" id="transfer-title" placeholder="Checkin"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="    margin: 20px 0;">
                                        <div class="form-group">
                                            <label>Müşteri Adı Soyadı</label>
                                            <input class="form-control" name="fullname" id="transfer-title" placeholder="İsim Soyisim"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <label>Kime</label>
                                            <input class="form-control" name="receiver" id="transfer-receiver" placeholder="Kime"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <label>Konu</label>
                                            <input class="form-control" name="subject" id="transfer-subject" placeholder="Konu"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <label>Mesaj</label>
                                            <textarea class="form-control"   name="message" id="transfer-title" ></textarea>
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

