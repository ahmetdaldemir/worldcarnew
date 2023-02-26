<div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
    <a style="   padding: 0.375rem 0.75rem 0 0;" class="btn btn-primary"
       href="{{route('admin.admin.reservation.create')}}">
        <i style="font-size: 27px;    margin-right: 10px;font-weight: 600;" class="i-Add"></i>
        <span style="top: -8px;position: relative;">Yeni Rezervasyon</span>
    </a>
    <a style="   padding: 0.375rem 0.75rem 0 0;"
       href="{{route('admin.admin.reservation.deletereservation')}}" type="button"
       class="btn btn-warning"><img style="width: 24px;"
                                    src="{{asset('public/assets/images/bin.png')}}"/> Silinen
        Rezervasyonlar</a>
    <a style="   padding: 0.375rem 0.75rem 0 0;"
       href="{{route('admin.admin.reservation.cancelreservation')}}" type="button"
       class="btn btn-secondary"><img style="width: 24px;"
                                      src="{{asset('public/assets/images/cancel.png')}}"/> İptal
        Rezervasyonlar</a>
    <a style="   padding: 0.375rem 0.75rem 0 0;"
       href="{{route('admin.admin.reservation.noncomfirmreservation')}}" type="button"
       class="btn btn-secondary"><img style="width: 24px;"
                                      src="{{asset('public/assets/images/laravel-logo.png')}}"/> Onaylanmamış
        Rezervasyonlar</a>
</div>
