@extends('layouts.admin')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Anket Sorusunu Düzenleyiniz</div>
                <form method="post" action="{{route('admin.admin.survey.update')}}" enctype="multipart/form-data">
                    <input name="id" value="{{$id}}" type="hidden" />
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="    margin: 20px 0;">

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($languages as $item)
                                                <li class="nav-item">
                                                    <a style="    padding: 0.3rem;"  class="nav-link @if($item->id == '1') active show @endif "   id="{{$item->id}}-tab" data-toggle="tab"
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
                                                        <input class="form-control" name="name[{{$item->id}}]" id="location-title"  value="{{$surveys->surveylanguageedit($item->id)->name}}"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <label for="function">Type</label>
                                            <select class="form-control" name="type">
                                                <option @if($surveys->type == "text")  selected @endif value="text">Text</option>
                                                <option @if($surveys->type == "radio") selected @endif value="radio">Radio</option>
                                            </select>
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

