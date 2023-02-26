@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Para Ekleme Formu</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.currency.save')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="currency-title" class="col-form-label">Para Birimi:</label>
                                        <input type="text" class="form-control" id="currency-title" name="title" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency-left_icon" class="col-form-label">Sol İkon:</label>
                                        <input type="text" class="form-control" id="currency-left_icon" maxlength="3" name="left_icon">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency-right_icon" class="col-form-label">Sağ İkon:</label>
                                        <input type="text" class="form-control" id="currency-right_icon" name="right_icon"  maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency-decimal_place" class="col-form-label">Decimal Ayracı:</label>
                                        <input type="text" class="form-control" id="currency-decimal_place" name="decimal_place"  maxlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                                <button type="submit" class="btn btn-primary">KAYDET</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
