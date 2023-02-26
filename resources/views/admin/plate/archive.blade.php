@extends('layouts.admin')

@section('content')
    <?php
    use App\Models\Plate;
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araçlar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.plates.create')}}" class="btn btn-primary"><i
                                    class="i-Add"></i> Yeni Ekle</a>
                            <a href="{{route('admin.admin.plates.archive')}}" class="btn btn-warning"><i
                                    class="i-Folder-Archive"></i> Arşiv Listesi</a>
                            <a href="{{route('admin.admin.plates')}}" class="btn btn-danger"><i
                                    class="i-Folder-Network"></i> Plaka Listesi</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Plaka</th>
                                <th scope="col">Araç</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Giriş T.</th>
                                <th scope="col">Belge No / Seri No</th>
                                <th scope="col">Değişiklik T.</th>
                                <th scope="col">SonKM</th>
                                <th scope="col">SonŞehir</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($plates as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td style="text-align:left;">{{$item->plate}}</td>
                                    <td style="text-align:left;text-indent: 10px"> @php
                                            $brand = \App\Models\Brand::find($item->car->brand);
                                             if($brand != null)
                                                 {
                                                     $marka = $brand->brandname;
                                                 }else{
                                                     $marka = "null";
                                                      }

                                            $car_model = \App\Models\CarModel::find($item->car->model);
                                              if($car_model != null)
                                                 {
                                                     $model = $car_model->modelname;
                                                 }else{
                                                     $model = "null";
                                                      }
                                            $year = $item->car->year;
                                            $engine = \App\Models\Engine::find($item->car->engine)->title;
                                        @endphp   {{$marka}} | {{$model}} | {{$item->car_name}} | {{$year}} | {{$engine}} </td>
                                    <td>
                                        <select class="form-control" name="status"
                                                onchange="changePlateStatus('{{$item->id}}',this)">
                                            <option <?php if ($item->status == Plate::PLATE_STATUS_FAULT) {
                                                echo "selected";
                                            } ?>   value="{{Plate::PLATE_STATUS_FAULT}}">Serviste
                                            </option>
                                            <option <?php if ($item->status == Plate::PLATE_STATUS_CRASHED) {
                                                echo "selected";
                                            } ?> value="{{Plate::PLATE_STATUS_CRASHED}}">Kazalı
                                            </option>
                                            <option <?php if ($item->status == Plate::PLATE_STATUS_ARCHIVE) {
                                                echo "selected";
                                            } ?> value="{{Plate::PLATE_STATUS_ARCHIVE}}">Arşiv
                                            </option>
                                            <option <?php if ($item->status == Plate::PLATE_STATUS_FREE) {
                                                echo "selected";
                                            } ?>    value="{{Plate::PLATE_STATUS_FREE}}">Müsait
                                            </option>
                                            <option <?php if ($item->status == Plate::PLATE_STATUS_BUSY) {
                                                echo "selected";
                                            } ?>    value="{{Plate::PLATE_STATUS_BUSY}}">Çalışıyor
                                            </option>
                                        </select>
                                    </td>
                                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                                    <td>{{$item->document_number}}</td>
                                    <td>{{$item->updated_at->format('d-m-Y')}}</td>
                                    <td style="text-align:right">{{$item->oil_km_current}}</td>
                                    <td>4</td>
                                    <td>
                                        <div class="btn-group float-right " role="group" aria-label="Basic example">
                                            <a href="{{route('admin.admin.plates.edit',['id'=>$item->id])}}" class="btn btn-warning ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a href="{{route('admin.admin.plates.delete',['id'=>$item->id])}}"
                                               class="btn btn-danger ">
                                                <i class="nav-icon i-Close-Window "></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function changePlateStatus(id, sel) {
        if (confirm("Plaka durumunu değiştirmek istediğinizden eminmisiniz ?")) {
            this.click;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/admin/admin/plates/status/' + id + '/' + sel.value + '',
                type: 'GET',
                success: function (data) {
                    swal('Güncelledim')
                }
            });
        } else {
            swal("Silme işlemi iptal edildi !");
        }
    }
</script>

