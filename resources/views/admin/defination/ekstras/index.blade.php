@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ekstra ürünler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.ekstra.create')}}" class="btn btn-primary" ><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ürün Adı</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">Zorunlumu</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($ekstras))
                            @foreach($ekstras as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{!! \App\Models\EkstraLanguage::getSelectLang($item->id,'title',1) !!}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        @if($item->mandatoryInContract == 'yes')
                                            <a href="{{route('admin.admin.ekstra.mandatoryInContractStatus',['mandatoryInContract'=> "no",'id'=>$item->id])}}" >  <span class="badge badge-success">EVET</span></a>
                                        @else
                                                    <a href="{{route('admin.admin.ekstra.mandatoryInContractStatus',['mandatoryInContract'=> "yes",'id'=>$item->id])}}" > <span class="badge badge-danger">HAYIR</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 1)
                                            <a href="{{route('admin.admin.ekstra.status',['status'=> 0,'id'=>$item->id])}}" ><span class="badge badge-success">Aktif</span></a>
                                        @else
                                            <a href="{{route('admin.admin.ekstra.status',['status'=> 1,'id'=>$item->id])}}" ><span class="badge badge-danger">Pasif</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.admin.ekstra.edit',['id'=>$item->id])}}" class="btn btn-primary ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.ekstra.delete',['id'=>$item->id])}}" class="btn btn-danger ">
                                            <i class="nav-icon i-Close-Window "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
