@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alış Bölgesi</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.locations.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="    margin: 20px 0;">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                            @foreach($languages as $item)
                                                <tr>
                                                    <td>{{$item->title}} </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Adı</label>
                                                            <input class="form-control" name="title[]"
                                                                   id="location-title"
                                                                   value="{{ \App\Service\GetData::getLocationTitle($id,$item->id)}}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Meta Title</label>
                                                            <input class="form-control" name="meta_title[]"
                                                                   id="location-meta_title"
                                                                   value="{{ \App\Service\GetData::getLocationMeta($id,$item->id)}}"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer-title col-md-12" class="col-form-label" style="width: 100%">Üst Bölgesi:</label>
                                        <select class="form-control" name="id_parent" id="location-id_parent">
                                            <option value="0" selected>Merkez</option>
                                            @foreach($locations as $item)
                                                <option @if($location->id_parent == $item->id) {{ 'selected' }} @endif  value="{{$item->id}}">{!! $item->getName()->title ?? NULL !!} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-price col-md-12" class="col-form-label"
                                               style="width: 100%">Tipi:</label>
                                        <select class="form-control" name="type" id="location-price">
                                            <option
                                                @if ($location->type == "center") {{ 'selected' }} @endif value="center">
                                                Merkez
                                            </option>
                                            <option
                                                @if ($location->type == "hotel") {{ 'selected' }} @endif value="hotel">
                                                Otel
                                            </option>
                                            <option
                                                @if ($location->type == "airport") {{ 'selected' }} @endif value="airport">
                                                Havalimanı
                                            </option>
                                            <option
                                                @if ($location->type == "address") {{ 'selected' }} @endif value="address">
                                                Adres
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-price col-md-12" class="col-form-label"
                                               style="width: 100%">Sıra No:</label>
                                        <input class="form-control" name="sort" value="<?=$location->sort?>"
                                               id="location-sort"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-price col-md-12" class="col-form-label"
                                               style="width: 100%">Teslim Ücreti:</label>
                                        <input class="form-control" name="price" value="<?=$location->price?>"
                                               id="location-price"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-price col-md-12" class="col-form-label"
                                               style="width: 100%">Drop Ücreti:</label>
                                        <input class="form-control" name="drop_price" value="<?=$location->drop_price?>"
                                               id="location-drop_price"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-price col-md-12" class="col-form-label"
                                               style="width: 100%">Min Gün Sayısı:</label>
                                        <input class="form-control" name="min_day" value="<?=$location->min_day?>"
                                               id="location-min_day"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary" data-dismiss="modal">KAPAT</a>
                    <button type="submit" class="btn btn-primary">KAYDET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
