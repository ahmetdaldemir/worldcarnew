@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dil Ekleme Formu</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.language.update')}}">
                        <input type="hidden" name="id" value="{{$id}}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="language-title" class="col-form-label">Dil:</label>
                                        <input type="text" class="form-control" id="language-title" value="{{$languages->title}}" name="title" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language-short" class="col-form-label">Kısa Kod:</label>
                                        <input type="text" class="form-control" id="language-short" value="{{$languages->short}}" maxlength="2" name="short" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language-flag" class="col-form-label">Bayrak:</label>
                                        <input type="text" class="form-control" id="language-flag" value="{{$languages->flag}}" name="flag" placeholder="tr.png">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="language-flag" class="col-form-label">Meta Title:</label>
                                        <input type="text" class="form-control" id="language-meta_title" value="{{$languages->meta_title}}" name="meta_title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="language-description" class="col-form-label">Meta Description: (<small> *Style kullanmayınız</small>)</label>
                                        <textarea class="form-control" id="language-meta_description"  name="meta_description">{!! $languages->meta_description !!}</textarea>
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
