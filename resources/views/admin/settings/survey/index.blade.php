@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Anketler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.survey.create')}}" class="btn btn-primary"><i
                                    class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Soru</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($surveys))
                                @foreach($surveys as $survey)
                                    <tr>
                                        <td>{{$survey->id}}</td>
                                        <td>{{$survey->survey_language->name}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <?php if($survey->type == 'radio'){ ?>
                                                <a href="{{route('admin.admin.survey.answer',['id'=>$survey->id])}}"  class="btn btn-default ">
                                                    <img style="width: 24px;" src="https://worldcarrental.com/public/assets/images/answers.png">
                                                </a>
                                                <?php } ?>
                                                <a href="{{route('admin.admin.survey.edit',['id'=>$survey->id])}}"  class="btn btn-default ">
                                                    <img style="width: 24px;" src="https://worldcarrental.com/public/assets/images/pencil.png">
                                                </a>
                                                <a href="{{route('admin.admin.survey.delete',['id'=>$survey->id])}}" class="btn btn-default ">
                                                    <img style="width: 24px;" src="https://worldcarrental.com/public/assets/images/remove.png">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
