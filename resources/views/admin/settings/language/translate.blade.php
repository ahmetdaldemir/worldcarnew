@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="breadcrumb">
                <h1>Dil Düzenle</h1>
                <ul>
                    <li><a href="">Diller</a></li>
                    <li> {{$title}}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{route('admin.admin.language.translatesave',['url'=>$url])}}">
                    @csrf
                    <ul class="list-group">
                        @foreach($json as $key => $value)
                            <li style="padding-top: 5px;padding-bottom: 5px;" class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3" style="    vertical-align: inherit;line-height: 2.3;font-weight: 700;">
                                        <input value="{{$key}}" type="hidden" name="key[]"/>
                                        {{__($key),'tr'}}</div>
                                    <div class="col-md-9">
                                        <input value="{{$value}}" name="value[]" class="form-control"/>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="col-md-12" style="    padding: 10px;">
                        <button style="width: 100%" class="btn btn-danger">KAYDET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
