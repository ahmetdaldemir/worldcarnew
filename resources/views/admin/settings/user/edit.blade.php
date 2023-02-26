@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kullanıcı Düzenleme</div>
                <form method="post" action="{{route('admin.admin.user.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="id" value="{{$user->id}}">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="function">İsim Soyisim</label>
                                        <input name="name" class="form-control" value="<?=$user->name?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Email</label>
                                        <input name="email" class="form-control" value="<?=$user->email?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Şifre</label>
                                        <input name="password" class="form-control" value="" />
                                        <input name="password1" type="hidden" class="form-control" value="<?=$user->password?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Role</label>
                                        <select class="form-control" name="roles">
                                        <?php foreach($roles as $role){ ?>
                                          <option value="<?=$role->id?>" {{ $user->hasRole($role->name) ? 'selected' : '' }}><?=$role->name?></option>
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

