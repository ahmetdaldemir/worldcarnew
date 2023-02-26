@extends('layouts.admin')

@section('content')
    @php use  \App\Models\TextLanguage; @endphp

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Test Ekle</div>
                <form method="post" action="{{route('admin.admin.texts.update')}}" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="{{$id}}">

                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control" name="category">
                                            <option @if($text->category == "services") selected @endif value="services">Hizmetlerimiz</option>
                                            <option @if($text->category == "information") selected @endif value="information">Bilgilendirme</option>
                                        </select>
                                    </div>

                                    <div class="form-group" style="    margin: 20px 0;">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($languages as $item)
                                                <li class="nav-item">
                                                    <a style="    padding: 0.3rem;"
                                                       class="nav-link @if($item->id == '1') active show @endif "
                                                       id="{{$item->id}}-tab" data-toggle="tab"
                                                       href="#{{$item->title}}lang" role="tab"
                                                       aria-controls="{{$item->id}}lang">{{$item->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            @foreach($languages as $item)
                                                <div class="tab-pane fade @if($item->id == '1') active show @endif"
                                                     id="{{$item->title}}lang" role="tabpanel"
                                                     aria-labelledby="{{$item->id}}-tab">
                                                    <div class="form-group">
                                                        <input class="form-control" name="title[]" id="location-title"
                                                               value="{{ TextLanguage::getSelectLang($id,"title",$item->id)}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea  class="form-control" id="description_{{$item->id}}"   name="description[]">{{ TextLanguage::getSelectLang($id,"description",$item->id)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group" style="height: 60px">
                                        <input class="form-control" type="file" name="image" style="width: 80%;  float: left;">
                                        <input class="form-control" type="hidden" name="image1" value="{{ TextLanguage::getImage($id)}}">
                                        <img src="{{ TextLanguage::getImage($id)}}"  style="width: 50px;  float: right;">
                                    </div>

                                    <div class="form-group" style="height: 60px">
                                        <label style="width: 100%" for="heade_image">Header Resim</label>
                                        <input id="heade_image" class="form-control" type="file" name="file" style="width: 80%;  float: left;">
                                        <input type="hidden" name="header_image1" value="{{ TextLanguage::getHeaderImage($id)}}">
                                        <img src="/storage/uploads/{{ TextLanguage::getHeaderImage($id)}}"  style="width: 50px;  float: right;">
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

