<form  method="post" enctype="multipart/form-data"  action="{{route('admin.admin.reservation.addmail')}}">
    @csrf
    <div class="modal-body">
        <div class="row" style="z-index: 99999;">
            <input name="id" value="{{$reservation->id}}" type="hidden">

            <input name="file" value="@{{file}}" type="hidden">
            <input name="status" value="@{{status}}" type="hidden">
            <div class="col-md-4 form-group mb-3">
                <label><b>Mail Gönderilecek Adres</b></label>
                <input class="form-control" name="email" value="{{$reservation->reservationInformation->email}}" type="email">
            </div>
        </div>
        <hr/>
        </br>
        {{--                            <div style="width: 100%;font-size: 12px" rows="20" ng-bind-html="message"></div>--}}
        <div style="width: 100%;font-size: 12px">
            <textarea class="form-control"  rows="20" id="mailContent" name="template" >{{$template->template}}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
        <button class="btn btn-primary ml-2" type="submit">GÖNDER</button>
    </div>
</form>
