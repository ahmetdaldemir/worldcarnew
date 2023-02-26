@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kullanıcı Ekleme</div>
                <form method="post" action="{{route('admin.admin.settings.mailtestsend')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="function">İsim Soyisim</label>
                                        <input name="name" class="form-control" value="John Deo"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Email</label>
                                        <input name="email" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Mesaj</label>
                                        <input name="message" class="form-control" />
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
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">WEB-P Resim Deneme</div>
                <form method="post" action="{{route('admin.admin.settings.uploadtest')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="function">Resim</label>
                                        <input name="name" class="form-control" value="John Deo"  type="file" />
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
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sorgulamalar</div>
                      <div class="card-body">
                        <div class="col-md-12">
                            <table class="">
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>

             </div>
        </div>
    </div>
@endsection

