@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sorgulamalar</div>
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table table-sm table-custom spacing8  table-gray-300 ">
                            <thead>
                                <tr>
                                    <td>Tarih</td>
                                    <td>IP</td>
                                    <td>Url</td>
                                    <td>Dil</td>
                                    <td>Platform</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($access as $item)
                                    @if($item->type=='search')
                                        <tr>
                                            <td>{{ date('d-m-Y H:i:s',strtotime($item->created_at))}}</td>
                                            <td>{{$item->ip}}</td>
                                            <td>{{$item->url}}</td>
                                            <td>{{$item->language}}</td>
                                            <td>{{$item->platform}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

