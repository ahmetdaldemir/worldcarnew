@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bloglar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.blogs.create')}}" class="btn btn-primary" ><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bölge Adı</th>
                                <th scope="col">Anasayfada Göster</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Resim</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($blogs))
                                @foreach($blogs as $item)
                                     <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{\App\Models\BlogLanguage::getSelectLang($item->id,"title",1)}}</td>
                                        <td>
                                            @if($item->view == 1)
                                                <a  href="{{route('admin.admin.blogs.view',['id'=>$item->id,'view'=>0])}}" class="btn btn-success">Aktif</a>
                                            @else
                                                <a  href="{{route('admin.admin.blogs.view',['id'=>$item->id,'view'=>1])}}" class="btn btn-danger">Pasif</a>
                                            @endif
                                        </td>
                                        <td>{{$item->updated_at}}</td>
                                            <td>
                                                @if(!is_null($item->images()))
                                                    <img src="{{asset('storage/webp/'.$item->images()->title.'') }}" style="width:50px;">
                                                @endif
                                            </td>
                                        <td>
                                            <a href="{{route('admin.admin.blogs.edit',['id'=>$item->id])}}" type="button" class="btn btn-success ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a href="{{route('admin.admin.blogs.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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
