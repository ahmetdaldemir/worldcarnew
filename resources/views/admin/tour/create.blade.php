@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blog Ekle</div>
                <form method="post" action="{{route('admin.admin.tour.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
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
                                                        <input class="form-control" name="title[]"
                                                               id="title_{{$item->id}}"
                                                               placeholder="{{$item->title}} Tur Adı"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="description_{{$item->id}}"
                                                                  name="description[]"></textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Fiyat</label>
                                                    <input class="form-control" type="text" name="price">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Kaç Gün</label>
                                                    <input class="form-control" type="text" name="days">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Saat</label>
                                                    <input class="form-control" type="text" name="time">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class style="width:100%">Tur Günleri</label>

                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="1" name="tour_days[]"><span>Pzt</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="2" name="tour_days[]"><span>Sl</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="3" name="tour_days[]"><span>Çrş</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="4" name="tour_days[]"><span>Prş</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="5" name="tour_days[]"><span>Cm</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="6" name="tour_days[]"><span>Cmt</span><span class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary" style="float:left;width: 12%;">
                                                        <input type="checkbox" value="7" name="tour_days[]"><span>Pz</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                               <span class="input-group-btn">
                                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                               </span>
                                                <input id="thumbnail" class="form-control" type="text" name="filepath">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class>Resim</label>
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                            </div>
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
        <script>

            var lfm = function(id, type, options) {
                let button = document.getElementById(id);

                button.addEventListener('click', function () {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    var target_input = document.getElementById(button.getAttribute('data-input'));
                    var target_preview = document.getElementById(button.getAttribute('data-preview'));

                    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {
                        var file_path = items.map(function (item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_input.value = file_path;
                        target_input.dispatchEvent(new Event('change'));

                        // clear previous preview
                        target_preview.innerHtml = '';

                        // set or change the preview image src
                        items.forEach(function (item) {
                            let img = document.createElement('img')
                            img.setAttribute('style', 'height: 5rem')
                            img.setAttribute('src', item.thumb_url)
                            target_preview.appendChild(img);
                        });

                        // trigger change event
                        target_preview.dispatchEvent(new Event('change'));
                    };
                });
            };
            $('#lfm').filemanager('image');
        </script>
        @endsection

        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            <?php foreach($languages as $item){ ?>
            tinymce.init({selector: '#description_<?=$item->id?>'});
            <?php } ?>
        </script>

