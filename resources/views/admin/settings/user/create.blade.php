@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kullanıcı Ekleme</div>
                <form method="post" action="{{route('admin.admin.user.save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="function">İsim Soyisim</label>
                                        <input name="name" class="form-control"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Email</label>
                                        <input name="email" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Şifre</label>
                                        <input name="password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Role</label>
                                        <select class="form-control" name="roles">
                                            <?php foreach($roles as $role){ ?>
                                            <option value="<?=$role->id?>"><?=$role->name?></option>
                                            <?php } ?>
                                        </select>
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

