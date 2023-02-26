@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="breadcrumb">
                <h1>Kampanyalar</h1>
                <ul>
                    <li><a href="">Kampanya</a></li>
                    <li> Kampanya Listesi</li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kampanyalar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="camping/create" class="btn btn-primary"  data-whatever="@mdo"><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kampanya Adı</th>
                                <th scope="col">Tarih</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($camping as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{ \App\Models\CampingLanguage::where('id_camping',$item->id)->first()->title}}</td>
                                    <td>{{$item->start_date}} / {{$item->finish_date}}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <a href="{{route('admin.admin.camping.statusChange',['id'=>$item->id,'status'=>0])}}">
                                            <span class="badge badge-success">Aktif</span>
                                            </a>
                                        @else
                                            <a href="{{route('admin.admin.camping.statusChange',['id'=>$item->id,'status'=>1])}}">
                                            <span class="badge badge-danger">Pasif</span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a  href="{{route('admin.admin.camping.edit',['id'=>$item->id])}}" class="btn btn-success ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.camping.delete',['id'=>$item->id])}}" class="btn btn-danger ">
                                            <i class="nav-icon i-Close-Window "></i>
                                        </a>
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



    <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Kategoriler</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.admin.camping.save')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Başlık:</label>
                                <input type="text" class="form-control" id="recipient-name-2" name="title">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Araç:</label>
                                <select class="form-control" name="id_car">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach ($cars as $val){ ?>
                                      <option value="<?=$val["id"]?>"><?=$val["brand"]?> - <?=$val["model"]?> - <?=$val["year"]?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Para Birimi :</label>
                                <select class="form-control" name="id_currency">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach ($currency as $val){ ?>
                                    <option value="<?=$val->id?>"><?=$val->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Yayınlanacağı Bölge :</label>
                                <select class="form-control" name="location">
                                    <option value="0">Seçiniz</option>
                                    <option value="domestic">Yurtiçi</option>
                                    <option value="abroad">Yurtdışı</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label>Geçerli Şehirler :</label>
                            <div class="col-md-12" style="border:1px solid #ccc;margin: 15px 0px 0 0;">
                                <select  name="destination[]" class="selectpicker" multiple>
                                    <?php foreach ($location as $val){ ?>
                                      <option value="<?=$val->id?>"><?=$val->title?></option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">1-3 Gün :</label>
                                <input type="text" class="form-control" id="recipient-name-2" name="price2">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">4-6 Gün :</label>
                                <input type="text" class="form-control" id="recipient-name-2" name="price1">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">7-13 Gün :</label>
                                <input type="text" class="form-control" id="recipient-name-2" name="price3">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">14-30 Gün :</label>
                                <input type="text" class="form-control" id="recipient-name-2" name="price4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Başlangıç tarihi :</label>
                                <input type="date" class="form-control" id="recipient-name-2" name="start_date">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Bitiş Tarihi :</label>
                                <input type="date" class="form-control" id="recipient-name-2" name="finish_date">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Geçerlilik Süresi :</label>
                                <select class="form-control" name="period_validity">
                                    <option value="0">Seçiniz</option>
                                    <option value="1">1 Gün</option>
                                    <option value="2">2 Gün</option>
                                    <option value="3">3 Gün</option>
                                    <option value="4">4 Gün</option>
                                    <option value="5">5 Gün</option>
                                    <option value="6">6 Gün</option>
                                    <option value="7">7 Gün</option>
                                    <option value="8">8 Gün</option>
                                    <option value="9">9 Gün</option>
                                    <option value="10">10 Gün</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Müşteri Tipi:</label>
                                <select class="form-control" name="customer_type">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach ($customer_type as $val){ ?>
                                      <option value="<?=$val->id?>"><?=$val->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
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
@endsection
