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
                                <td>#</td>
                                <td>Tarih</td>
                                <td>IP</td>
                                <td>Dil</td>
                                <td>Çıkış / Dönüş</td>
                                <td>Çıkış / Dönüş Lokasyon</td>
                                <td>Ülke</td>
                                <td>Platform</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1; ?>


                            @foreach($access as $item)

                                @if($item->type=='search')
                                    <?php
                                    $param = [];
                                    $x = explode('&', $item->url);
                                    foreach ($x as $chunk) {
                                        $param[] = $chunk;
                                    }
                                    ?>
                                    @if(isset($param['1']))
                                        @if(date('d-m-Y',strtotime(explode("=",$param['1'])[1])))
                                            <tr>
                                                <td><b><?=$i?></b></td>
                                                <td>{{ date('d-m-Y H:i:s',strtotime($item->created_at))}}</td>
                                                <td>{{$item->ip}} <a href="{{route('admin.admin.reservation.access.list',['id' => ''.$item->id.''])}}">({{\App\Models\AccessReport::ip_count($item->ip)}})</a></td>
                                                <td>{{$item->language_id}}</td>
                                                <td><span style="color: #00a52d;font-weight: 800">{{isset($param['1']) ? date('d-m-Y',strtotime(explode("=",$param['1'])[1])):"Bulunamadı"}} -
                                             {{strstr($param['0'],"cikis_saati_submit") ? date('H:i',strtotime(explode("=",$param['0'])[1])) :"Bulunamadı" }}</span>
                                                    /
                                                    <span style="color:#f21d1d;font-weight: 800">{{isset($param['3']) ? date('d-m-Y',strtotime(explode("=",$param['3'])[1])):"Bulunamadı"}}  -
                                            {{isset($param['2']) ? (strstr($param['2'],"donus_saati_submit") ? date('H:i',strtotime(explode("=",$param['2'])[1])) :"Bulunamadı"):"Bulunamadı" }}
                                            </span>
                                                </td>
                                                <td>{{isset($param['5']) ? \App\Models\Location::getViewLocationName(explode("=",$param['5'])[1])->title ?? "Bulunamadı":"Bulunamadı"}}
                                                    /
                                                    {{isset($param['4']) ? \App\Models\Location::getViewLocationName(explode("=",$param['4'])[1])->title ?? "Bulunamadı":"Bulunamadı"}}
                                                </td>
                                                <td>{{$item->country}}</td>
                                                <td>{{$item->platform}}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endif
                                    @endif
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

