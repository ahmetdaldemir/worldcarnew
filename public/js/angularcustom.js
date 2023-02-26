$("[data-toggle=popover]").popover({
    html: true,
    content: function () {
        return $('#popover-content').html();
    }
});



app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http) {
    $scope.getReservation = function () {
        $http({
            method: "POST",
            url: "/admin/admin/reservation/get_operation",
            data: $('#reservationdata').serialize(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            console.log(response);
            $scope.reservationlist = response.data;
        });

    }
    $scope.mailModal = function (id) {
        $http({
            method: 'GET',
            url: '/admin/admin/reservation/getEncode/' + id + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            $scope.reservationid = id;
            $scope.encode = response.data;
            $("#mailModal").modal('show');
        });
    }
    $scope.operationModal = function (id, type) {
        $http({
            method: "GET",
            url: "/admin/admin/reservation/operationcontrol?id=" + id + "&type=" + type + "",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            if (response.data == 0) {
                $scope.reservationid = id;
                if (type == 'up') {
                    $("#upModal").find("input#reservationidprocess").val(id);
                    $("#upModal").modal('show');
                    $http({
                        method: "GET",
                        url: "/admin/admin/reservation/get_entry_exit/" + id + "",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).then(function (response) {
                        console.log(response);
                        $scope.reservationid = id;
                        $scope.entry_exit_s = response.data;
                    });
                }
                if (type == 'drop') {
                    $("#dropModal").find("input#reservationidprocess").val(id);
                    $("#dropModal").modal('show');
                }
            } else {
                swal("Daha Önce " + type + " İşlemi Yapıldur", "danger");
            }
        });

    }
    $scope.operationControl = function (id, type) {
        $http({
            method: "GET",
            url: "/admin/admin/reservation/operationcontrol?id=" + id + "&type=" + type + "",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            $scope.operationcontrolcheck = response.data;
            console.log($scope.operationcontrolcheck);
        });
    }
    $scope.getPage = function (page, id, status, template_id) {
        $scope.file = page;
        $scope.status = status;
        $scope.template_id = template_id;
        $http({
            method: 'GET',
            url: '/admin/admin/reservation/getPage?page=' + page + '&id=' + id + '&template_id=' + template_id + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            $scope.message = response.data;
        });
    }
    $scope.openpopover = function (id) {
        var $targ = $('#kv-custom-popover_' + id + '');
        $targ.popoverButton({target: '#myPopover_' + id + '', placement: 'auto'});
    }
    $scope.reservationModal = function (id) {

        $('#reservationModal').modal('show');
        $http({
            method: "GET",
            url: "/admin/admin/reservation/get_entry_exit/" + id + "",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            $scope.reservationid = id;
            $scope.entry_exit = response.data;
        });
    }
    $scope.mediaModal = function (id, type) {
        var table_type = type;
        var table_id = id;

        var medias_modal = $('#medias-modal');
        $('.modal-content', medias_modal).append($('<iframe>', {
            src: '/admin/admin/reservation/media?table_type=' + table_type + '&table_id=' + table_id,
            id: 'medias-iframe',
            frameborder: 0,
            scrolling: 'no'
        }));
        medias_modal.modal('show');
        medias_modal.on('hidden.bs.modal', function () {
            $('.modal-content', medias_modal).html('');
        });
    }
    $scope.upKey = function () {
        var id = $("#upModal").find("input#reservationidprocess").val();
        var km = $scope.upkm;
        $http({
            method: "GET",
            url: "/admin/admin/reservation/kmcontrol?id=" + id + "&km=" + km + "",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            if (response.length > 0) {
                $scope.errormessage = response.data;
                $(".lockup").prop('disabled', true);
            } else {
                $(".lockup").removeAttr('disabled');
            }
        });
    }
    $scope.noteModal = function (id) {

        $http({
            method: "GET",
            url: "/admin/admin/reservation/getcomment/" + id + "",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            $scope.reservationid = id;
            $('#noteModal').modal('show');
            $scope.data = response.data;
        });
    }
    $scope.getOpetationData = function () {
        $http({
            method: "GET",
            url: "/admin/admin/reservation/get_operation_redis_data",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            console.log(response);
            $scope.reservationlist = response.data;
        });

    }
    $scope.getSingleReservation = function (id) {
        $http({
            method: "GET",
            url: "/admin/admin/reservation/get_single_reservation",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            $scope.reservation = response.data;
        });

    }
    $scope.plateModal = function (id, plate, checkin, checkout) {
        $("#plateModal").modal('show');
        $http({
            method: "GET",
            url: "/admin/admin/plates/getAvaiblePlate?id="+id+"",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            console.log(response);
            $scope.reservationid = id;
            $scope.plate = plate;
            $scope.plates = response.data;
            $scope.checkin = checkin;
            $scope.checkout = checkout;
            $scope.checkin_time = response.data.checkin_time;
            $scope.checkout_time = response.data.checkout_time;
        });
    }
    $scope.smsModal = function (id) {
        $("#smsModal").modal('show');
        $scope.reservationid = id;
    }



    $scope.upsave = function () {
        $http({
            method: 'GET',
            url: './comment/change_status?id=' + id + '&status=' + status + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            swal({
                type: 'success',
                title: 'Güncellendi!',
                text: '',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-success'
            })
        });
    }
    $scope.commentDelete = function (id, idreservation) {
        $http({
            method: 'GET',
            url: '/admin/admin/reservation/deletecomment?id=' + id + '&idreservation=' + idreservation + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            console.log(response);
            $scope.getComment(idreservation)
        });
    }
    $scope.dropsave = function (id, status) {
        $http({
            method: 'GET',
            url: './comment/change_status?id=' + id + '&status=' + status + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            swal({
                type: 'success',
                title: 'Güncellendi!',
                text: '',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-success'
            })
        });
    }
    $scope.ekstralistarray = function (id) {

        $http({
            method: 'GET',
            url: '/admin/admin/ekstra/editlists/'+id+'',
            cache: false,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function successCallback(response) {
            console.log(response);
            $scope.ekstralist = response.data;
        }, function (response) {
            swal("Hoops!", 'Ekstra Ürün Bulunamadı', 'warning');
        });
    }
    $scope.add_ekstra = function (parameter, value, maxVal, price, days, currency_price, sellType) {
        var id = 'model_ekstra_' + value;


        var oldValue = $("#" + id).val();

        var newVal = 0;
        if (parameter == 'up') {

            newVal = parseInt(oldValue) + 1;

            if (maxVal >= newVal || newVal == maxVal) {
                $("#" + id).val(newVal);
            } else {
                newVal = maxVal;
                $("#"+id).attr('disabled','disabled')
                swal("Yeterli", '' + maxVal + ' Adet Ekleyebilirsiniz', 'info');
            }
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 0;
            }
            $("#" + id).val(newVal);
        }

        if (sellType == 'Günlük') {
            var totalekstra = (price * newVal * days);
        } else {
            var totalekstra = (price * newVal);
        }

        $('#ekstra_' + value).html((Math.round(totalekstra * 100) / 100));
        $('.ekstra_' + value).val((Math.round(totalekstra * 100) / 100));
        var sum = 0;
        $(".ekstratotal").each(function () {
            sum += Number($(this).val());
        });

        var priceround = Math.round(sum * 100) / 100;
        $scope.ekstra_total = priceround;
        // $scope.calculate();
    }
    $scope.addComment = function (id) {
        $http({
            method: 'POST',
            url: '/admin/admin/reservation/addcomment',
            data: $("#notes").serialize(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            $scope.getComment(id);
            $("#notes").find('input').val('');
        });
    }
    $scope.getComment = function (id) {
        $http({
            method: 'GET',
            url: '/admin/admin/reservation/getcomment/' + id + '',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            $scope.comments = response.data;
        });
    }


    $scope.restUpdate = function (id) {
        $('#restUpdateModal').modal('show');
        $("#restupdateForm").find("#reservationId").val(id);
    }

    $scope.restUpdateProcess = function () {
        $http({
            method: "POST",
            url: "/admin/admin/reservation/updaterest",
            data: $("#restupdateForm").serialize(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            swal("Rest Kaydedildi", "Başarılı", "");
        });
    }
}]);
