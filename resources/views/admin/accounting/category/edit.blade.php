@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transfer Ekle</div>
                <form method="post" action="{{route('admin.admin.accountingcategory.update')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id"  value="{{$accountingCategory->id}}"/>
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group" style="margin: 20px 0;">
                                        <div class="form-group">
                                            <input class="form-control" name="title" id="accountingcategory-title" value="{{$accountingCategory->title}}" type="text"/>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                        <button type="submit" class="btn btn-primary">KAYDET</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
@endsection

