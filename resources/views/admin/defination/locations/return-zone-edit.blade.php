@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alış Bölgesi</div>
                <form method="post" action="{{route('admin.admin.locations.updatetransferZoneFee')}}">
                    <input type="hidden" name="id_location" value="{{$id}}">
                <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" width="100%">
                                        <thead>
                                        <tr>
                                            <td>Sehir</td>
                                            <td>Mesafe</td>
                                            <td>Ücret</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><select name="id_city"  class="form-control">{!! \App\Service\GetData::getCityAllHtml() !!}</select></td>
                                            <td><input  name="distance" value="{{$transferzone->distance}}" class="form-control"></td>
                                            <td><input  name="price" value="{{$transferzone->price}}"    class="form-control"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                   </div>
                                <div class="col-md-12" style="margin-bottom: 40px;margin-top: 40px;">
                                    <button style=" position: relative; float: right; margin-right: 11px;" type="button" data-code="{{$id}}" id="adds" class="btn btn-danger">Yeni Alt Bölge Ekle</button></div>
                                <div class="col-md-12" id="dynamic_field_{{$id}}"></div>
                                @for($i = 0; $i < $transferzonesubs; $i++)
                                <div class="col-md-12">
                                    <div id="row'+i+'">
                                         <div class="form-group">
                                             <div class="row" style="margin:0">
                                                <div class="col-md-3">
                                                     <select name="transferzonesub['+i+'][type]" class="form-control">
                                                         <option value="center">Merkez</option>
                                                         <option value="hotel">Otel</option>
                                                         <option value="airport">Havalimanı</option>
                                                         <option value="busstation">Otogar</option>
                                                         </select>
                                                    </div>
                                                <div class="col-md-9">
                                                    <ul class="nav nav-tabs" id="myTab_'+id+'_'+i+'" role="tablist_'+id+'_'+i+'">
                                                        @foreach($languages as $item)
                                                            <li class="nav-item">
                                                                <a style="padding: 0.3rem;"  class="nav-link " id="{{$item->id}}-tab_'+id+'_'+i+'" data-toggle="tab" href="#{{$item->title}}_'+id+'_'+i+'"  role="tab" aria-controls="{{$item->id}}lang_'+id+'">{{$item->title}}</a>
                                                           </li>
                                                        @endforeach
                                                        <li style="right: 14px;position: absolute;"><button class="btn btn-danger btn_remove" name="remove" id="' + i + '" ><i class="i-Remove"></i></button></li>
                                                        </ul>
                                                     <div class="tab-content" style="padding-top: 1rem;"  id="myTabContent_'+id+'_'+i+'">
                                                        @foreach($languages as $item)
                                                            <div class="tab-pane fade "  id="{{$item->title}}_'+id+'_'+i+'"  role="tabpanel" aria-labelledby="{{$item->id}}-tab_'+id+'_'+i+'">' +
                                                                <input  class="form-control" name="transferzonesub['+i+'][title][{{$item->id}}]" id="location-title" placeholder="{{$item->title}} Bölge Adı">
                                                                <input  class="form-control" name="transferzonesub['+i+'][meta_title][{{$item->id}}]" id="location-meta_title" placeholder="{{$item->meta_title}} Bölge Meta">
                                                                </div>
                                                        @endforeach
                                                        </div>
                                                </div>
                                             </div>
                                         </div>
                                </div>
                            </div>
                                @endfor
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                    <button type="submit" class="btn btn-primary">KAYDET</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var i = 0;
            $("#adds").click( function () {
                var id = $(this).data("code");
                i++;
                // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                $('#dynamic_field_'+id+'').append('<div id="row'+i+'">' +
                    '<div class="form-group">'+
                    '<div class="row" style="margin:0">'+
                    '<div class="col-md-3">'+
                    '<select name="transferzonesub['+i+'][type]" class="form-control">'+
                    '<option value="center">Merkez</option>'+
                    '<option value="hotel">Otel</option>'+
                    '<option value="airport">Havalimanı</option>'+
                    '<option value="busstation">Otogar</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="col-md-9">'+
                    '<ul class="nav nav-tabs" id="myTab_'+id+'_'+i+'" role="tablist_'+id+'_'+i+'">' +
                        @foreach($languages as $item)
                            '<li class="nav-item">' +
                    '<a style="padding: 0.3rem;"  class="nav-link " id="{{$item->id}}-tab_'+id+'_'+i+'" data-toggle="tab" href="#{{$item->title}}_'+id+'_'+i+'"  role="tab" aria-controls="{{$item->id}}lang_'+id+'">{{$item->title}}</a>' +
                    '</li>'+
                        @endforeach
                            '<li style="right: 14px;position: absolute;"><button class="btn btn-danger btn_remove" name="remove" id="' + i + '" ><i class="i-Remove"></i></button></li>'+
                    '</ul>' +
                    '<div class="tab-content" style="padding-top: 1rem;"  id="myTabContent_'+id+'_'+i+'">' +
                        @foreach($languages as $item)
                            '<div class="tab-pane fade "  id="{{$item->title}}_'+id+'_'+i+'"  role="tabpanel" aria-labelledby="{{$item->id}}-tab_'+id+'_'+i+'">' +
                            '<input  class="form-control" name="transferzonesub['+i+'][title][{{$item->id}}]" id="location-title" placeholder="{{$item->title}} Bölge Adı">' +
                            '</div>'+
                        @endforeach
                            '</div></div></div></div>');
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
@endsection


