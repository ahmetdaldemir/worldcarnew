@extends('layouts.admin')

@section('content')
    <?php

    use App\Models\Plate;

    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Plaka Analizi</div>

                <div class="card-body">
                        <div class="col-md-12">
                            <form action="#">
                                <div class="form-group">
                                    <label for="email">Başlangıç Tarihi:</label>
                                    <input type="date" class="form-control" id="startdate" name="startdate" @if($data) value="{{$data->startdate}}" @endif required />
                                </div>
                                <div class="form-group">
                                    <label for="email">Bitiş Tarihi:</label>
                                    <input type="date" class="form-control" id="finishdate" name="finishdate"  @if($data) value="{{$data->finishdate}}" @endif required />
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Plaka:</label>
                                    <select name="plate" id="plate" class="form-control">
                                        @foreach($platelist as $plateall)
                                        <option value="{{$plateall->id}}">{{$plateall->plate}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Arama Yap</button>
                            </form>
                        </div>
                    </hr>
                    @if(!empty($plates))
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-gray-300 ">
                                <thead>
                                <tr>
                                    <td>Toplam Gün</td>
                                    <td>Euro</td>
                                    <td>Dolar</td>
                                    <td>TL</td>
                                    <td>Pound</td>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{$plates->sum('days')}}</td>
                                    <td>{{$plates->where('id_currency',2)->sum('total_amount')}}</td>
                                    <td>{{$plates->where('id_currency',3)->sum('total_amount')}}</td>
                                    <td>{{$plates->where('id_currency',1)->sum('total_amount')}}</td>
                                    <td>{{$plates->where('id_currency',4)->sum('total_amount')}}</td>
                                </tr>

                                </tbody>
                            </table>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-gray-300 ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="    width: 6%;">Plaka</th>
                                        <th scope="col" style="    width: 15%;">Müşteri</th>
                                        <th scope="col" style="width: 7%">Checkin</th>
                                        <th scope="col" style="width: 7%">Checkout</th>
                                        <th scope="col" style="width: 9%;">Toplam Gün</th>
                                        <th scope="col" style="width: 9%;">Günlük Fiyat</th>
                                        <th scope="col" style="width: 9%;">Ekstra Fiyat</th>
                                        <th scope="col" style="width: 9%;">Alış Fiyat</th>
                                        <th scope="col" style="width: 9%;">Bırakış Fiyat</th>
                                        <th scope="col">Fiyat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($plates as $item) { ?>
                                    <tr style="@if($item->status == 30) background:#0b93ff;color:#fff @endif">
                                        <th scope="row">{{$i}}</th>
                                        <td style="text-align:left;">{{$item->getPlate->plate}}</td>
                                        <td style="text-align:left;">{{$item->customer->fullname}}</td>
                                        <td style="text-align:left;">{{$item->checkin}}</td>
                                        <td style="text-align:left;">{{$item->checkout}}</td>
                                        <td style="text-align:left;">{{$item->days}}</td>
                                        <td style="text-align:left;">
                                            <strong>{{$item->day_price}}</strong> {{$item->current->left_icon}}</td>
                                        <td style="text-align:left;">
                                            <strong>{{$item->ekstra_price}}</strong> {{$item->current->left_icon}}</td>
                                        <td style="text-align:left;">
                                            <strong>{{$item->up_price}}</strong> {{$item->current->left_icon}}</td>
                                        <td style="text-align:left;">
                                            <strong>{{$item->drop_price}}</strong> {{$item->current->left_icon}}</td>
                                        <td style="text-align:left;">
                                            <strong>{{$item->total_amount}}</strong> {{$item->current->left_icon}}</td>
                                    </tr>
                                        <?php $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
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

