@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yazı Kategorisi Güncelleme</div>
                <form method="post" action="{{route('admin.admin.text_category.update')}}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$text_category->id?>">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="type" class="form-control">
                                            <option @if($text_category->type == "default") selected @endif  value="default">Default</option>
                                            <option @if($text_category->type == "tab")  selected @endif value="tab">Tab</option>
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
                                                <div class="tab-pane fade @if($item->id == '1') active show @endif" id="{{$item->title}}lang" role="tabpanel" aria-labelledby="{{$item->id}}-tab">
                                                    <div class="form-group">
                                                        <input class="form-control" name="title[]" id="location-title"  value="{{$text_category->getLangTitleView($item->id)}}"/>
                                                    </div>
                                                </div>
                                            @endforeach
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

        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            <?php foreach($languages as $item){ ?>
            tinymce.init({selector: '#description_<?=$item->id?>'});
            <?php } ?>
        </script>

