@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kullanıcılar</div>

                <div class="card-body">
                    <div class="container">
                        @foreach ($permissions as $_key=> $_permissions)
                            <div class="row mt-4 mb-4" style="border-bottom: 1px solid #0C0C3C">
                                <h4>{{$_key}}</h4>
                            </div>
                            <div class="row ml-3">
                                @foreach ($_permissions as $key => $permission)
                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 form-check">
                                        <label class="checkbox checkbox-warning" for="permission_{{$permission->id}}">
                                            <input class="checkbox" type="checkbox" name="permissions[]" value="{{$permission->name}}" id="permission_{{$permission->id}}" @if($user->hasPermissionTo($permission->name)) checked @endif >
                                            <span> {{$key}}</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="row mt-4">
                            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
