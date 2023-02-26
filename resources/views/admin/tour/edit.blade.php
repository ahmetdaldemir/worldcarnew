@extends('layouts.admin')

@section('content')
    @php use  \App\Models\TourLanguage; @endphp
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tur Ekle</div>
                <form method="post" action="{{route('admin.admin.tour.update')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        <input name="id" type="hidden" value="{{$id}}">
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
                                                               id="title_{{$item->id}}" value="{{ TourLanguage::getSelectLang($id,"title",$item->id)}}"
                                                               placeholder="{{$item->title}} Tur Adı"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="description_{{$item->id}}" name="description[]">{{ TourLanguage::getSelectLang($id,"description",$item->id)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Fiyat</label>
                                                    <input class="form-control" type="text" name="price" value="{{$tour->price}}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Kaç Gün</label>
                                                    <input class="form-control" type="text" name="days" value="{{$tour->days}}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class>Saat</label>
                                                    <input class="form-control" type="text" name="time" value="{{$tour->time}}">
                                                </div>
                                            </div>
                                             <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class style="width:100%">Tur Günleri</label>
                                                     <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="1" @if(array_search('5', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Pzt</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="2" @if(array_search('2', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Sl</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="3" @if(array_search('3', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Çrş</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="4" @if(array_search('4', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Prş</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="5" @if(array_search('5', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Cm</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="6" @if(array_search('6', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Cmt</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                    <label class="checkbox checkbox-outline-primary"
                                                           style="float:left;width: 12%;">
                                                        <input type="checkbox" value="7" @if(array_search('7', $tour->tour_days) != false) checked @endif
                                                               name="tour_days[]"><span>Pz</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class>Resim</label>
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                                <img src="{{'/storage/uploads/'.$tour->image.''}}" />
                                                <input name="imageName" value="{{$tour->image}}" type="hidden" />
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
        @endsection

        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            <?php foreach($languages as $item){ ?>
            tinymce.init({selector: '#description_<?=$item->id?>'});
            <?php } ?>
        </script>

