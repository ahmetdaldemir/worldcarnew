<div  class="row">
    @if($errors->any())
        <div style="    width: 100%;" class="alert alert-danger" role="alert"><strong
                class="text-capitalize">UYARI!</strong> {{$errors->first()}}
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif
</div>
