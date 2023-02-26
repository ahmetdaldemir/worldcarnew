@extends('layouts.admin')

@section('content')
    <?php
    use App\Models\Location;
    use App\Models\Reservation;
    use App\User;
    use App\Repository\Data;
    $data = new Data();
    $location = new Location();
    $user = new User();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Anket Cevapları</div>
                <style>
                    .ucnokta {
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        width: 70px;
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                    }
                </style>
                <div class="card-body">
                    <div class="table-responsive" style="margin: 0 auto;">
                        <table class="table table-sm table-custom spacing8  table-gray-300 fold-table">
                            <thead>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-13" style="width: 2%" scope="col">#</th>
                                <th class="text-13" style="width: 8%" scope="col">Reservasyon No</th>
                                <th class="text-13" style="width: 20%" scope="col">Müşteri</th>
                                <th class="text-13" style="width: 5%" scope="col"><span data-toggle="tooltip"
                                                                                        title="Araç teslimi zamanında yapıldı mı?"
                                                                                        data-original-title="Araç teslimi zamanında yapıldı mı?"
                                                                                        class="ucnokta">Araç teslimi zamanında yapıldı mı?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Araç temiz bir şekilde teslim edildi mi?"
                                                                                        data-original-title="Araç temiz bir şekilde teslim edildi mi?">Araç temiz bir şekilde teslim edildi mi?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Karşılayan personel sorularınızı yanıtladı mı?"
                                                                                        data-original-title="Karşılayan personel sorularınızı yanıtladı mı?">Karşılayan personel sorularınızı yanıtladı mı?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Kiralama, ek paketler (HGS/OGS, Trafik Cezası, Mini Hasar Sigortası vb.) haricinde ek bir ücret ödediniz mi?"
                                                                                        data-original-title="Kiralama, ek paketler (HGS/OGS, Trafik Cezası, Mini Hasar Sigortası vb.) haricinde ek bir ücret ödediniz mi?">Kiralama, ek paketler (HGS/OGS, Trafik Cezası, Mini Hasar Sigortası vb.) haricinde ek bir ücret ödediniz mi?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Kiraladığınız Araçtan memnun kaldınız mı ?"
                                                                                        data-original-title="Kiraladığınız Araçtan memnun kaldınız mı ?">Kiraladığınız Araçtan memnun kaldınız mı ?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Telefonda sorularınıza yanıt bulabildiniz mi?"
                                                                                        data-original-title="Telefonda sorularınıza yanıt bulabildiniz mi?">Telefonda sorularınıza yanıt bulabildiniz mi?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Web sitemiz ve mobil uygulamamız kullanışlı mı?"
                                                                                        data-original-title="Web sitemiz ve mobil uygulamamız kullanışlı mı?">Web sitemiz ve mobil uygulamamız kullanışlı mı?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col"><span class="ucnokta"
                                                                                        data-toggle="tooltip"
                                                                                        title="Araç teslim veya iadesinde, teslimat personeli WorldCar'a ait olmayan farklı bir irtibat numarası vererek bir sonraki gelişinizde bu  numara ile irtibat kurmanızı istedi mi?"
                                                                                        data-original-title="Araç teslim veya iadesinde, teslimat personeli WorldCar'a ait olmayan farklı bir irtibat numarası vererek bir sonraki gelişinizde bu  numara ile irtibat kurmanızı istedi mi?">Araç teslim veya iadesinde, teslimat personeli WorldCar'a ait olmayan farklı bir irtibat numarası vererek bir sonraki gelişinizde bu  numara ile irtibat kurmanızı istedi mi?</span>
                                </th>
                                <th class="text-13" style="width: 20%" scope="col"><span class="ucnokta"
                                                                                         data-toggle="tooltip"
                                                                                         title="Anket sorularımız haricinde eklemek istedikleriniz var mı?"
                                                                                         data-original-title="Anket sorularımız haricinde eklemek istedikleriniz var mı?">Anket sorularımız haricinde eklemek istedikleriniz var mı?</span>
                                </th>
                                <th class="text-13" style="width: 5%" scope="col">İncele</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1; foreach($survey_answers as $item){ ?>
                            <tr class="view" style="font-weight: 700;">
                                <td style="vertical-align: middle"><span class="text-13">{{$i}}</span></td>
                                <td style="vertical-align: middle"><span
                                        class="text-13">{{$item->id_reservation}}</span></td>
                                <td style="vertical-align: middle"><span class="text-13">
                                                {{$item->reservation->reservationInformation->firstname}}
                                        {{$item->reservation->reservationInformation->lastname}}</span>
                                </td>
                                <?php $answers = unserialize(json_decode($item->answers)); ?>

                                <?php foreach($answers as $key => $value){ ?>
                                <?php if(is_numeric($value)){ ?>
                                <td>
                                    <?php
                                    $sort = \App\Models\ReservationSurvey::answer($value)->sort;
                                    if ($sort == 1) {
                                        echo '<div data-toggle="tooltip" title="" data-original-title=""><span class="text-success"><i class="i-Like-2"></i> Evet</span></div>';
                                    }
                                    ?>
                                </td>
                                <?php }else{ ?>
                                <td>
                                    <span class="ucnokta" data-toggle="tooltip" title="{{$value}}"
                                          data-original-title="{{$value}}"><i class="i-UnLike-2"></i> Hayır</span></td>
                                <?php } ?>
                                <?php } ?>
                                <td style="vertical-align: middle;">
                                            <span class="text-15 text-custom-900">
                                                <a target="_blank" class="btn btn-xs btn-success btn-icon"
                                                   target="_blank"
                                                   href="{{route('admin.admin.reservation.edit',['id'=>$item->id_reservation])}}">
                                                    <i class="fa-search"></i> Detay &amp; Cevaplar
                                                </a>
                                            </span>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {


            $scope.getLogList = function (id) {
                $http({
                    method: "GET",
                    url: "/admin/admin/reservation/get_log_list/" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationLoglist = response.data;
                    $('#reservationLogModal').modal('show');
                });
            }


        }]);
        $(function () {
            $(".fold-table tr.view").on("click", function () {
                $(this).toggleClass("open").next(".fold").toggleClass("open");
            });
        });
    </script>

    <link rel="stylesheet" href="{{ asset('public/assets/styles/css/survey_answer.css') }}">


    <style>


        .table.table-custom.spacing8 {
            border-spacing: 0px 5px !important;
        }

        .table.table-custom {
            border-collapse: separate !important;
        }

        .table.table-custom tr {
            border-bottom: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }

        .table-sm th, .table-sm td {
            padding: 0.3rem;
            border-right: 1px solid #ccc;
        }

    </style>

@endsection

