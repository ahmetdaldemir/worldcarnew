@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Header Resim ve Yazı Düzenleme</div>
                <form method="post" action="{{route('admin.admin.permission.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="id" value="{{$permission->id}}">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="function">İsim Soyisim</label>
                                        <input name="name" class="form-control" value="<?=$permission->name?>" />
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
@endsection

