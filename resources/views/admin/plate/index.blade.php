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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="    width: 6%;">Plaka</th>
                                <th scope="col" style="width: 27%">Araç</th>
                                <th scope="col">Durum</th>
                                <th scope="col" style="width: 9%;">Belge No / Seri No</th>
                                <th scope="col">Giriş T.</th>
                                <th scope="col">Değişiklik T.</th>
                                <th scope="col">SonKM</th>
                                <th scope="col" style="    width: 25%;">SonŞehir</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach($plates as $item) { if($item->status != 30){ ?>
                                <tr style="@if($item->status == 30) background:#0b93ff;color:#fff @endif">
                                    <th scope="row">{{$i}}</th>
                                    <td style="text-align:left;"><a href="{{route('admin.admin.plates.show',['id' => $item->id])}}">{{$item->plate}}</a></td>
                                    <td style="text-align:left;text-indent: 10px;font-size: 15px"> @php
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
                                        <select  name="status"
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
                                    <td style="text-align:left">{{$item->created_at->format('d-m-Y')}}</td>
                                    <td style="text-align:left">{{$item->updated_at->format('d-m-Y')}}</td>
                                    <td style="text-align: left;">{{$item->document_number}}</td>
                                    <td style="text-align:center;font-weight:bold">{{$item->oil_km_current}}</td>
                                    <td style="overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;">
                                        <?php  $x = $item->get_last_plate();  ?>
                                        <?php if(gettype($x) == "object"){ ?>
                                           <?=$x->title?>
                                        <?php }else{ ?>
                                        {{$x}}
                                           <?php  } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group float-right " role="group" aria-label="Basic example">
                                            <a style="    margin-right: 15px;" href="{{route('admin.admin.plates.edit',['id'=>$item->id])}}">
                                                <img style="width: 24px;" src="https://worldcarrental.com/public/assets/images/pencil.png">
                                            </a>
                                            <a href="{{route('admin.admin.plates.delete',['id'=>$item->id])}}">
                                                <img style="width: 24px;" src="https://worldcarrental.com/public/assets/images/bin.png">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                           <?php $i++; }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .ucnokta {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
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

