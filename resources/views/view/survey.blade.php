@extends('layouts.welcome')

@section('content')

    <section class="header-blogdetail"
             style="background-image: url(https://worldcarrental.com/storage/uploads/a67057da-0e7d-4c30-a464-a40f5e75c73d.jpeg);">
        <div class="container">
            <div class="text-center">
                <h4>{{__('rent_a_car_anketi')}}</h4>
            </div>
        </div>
    </section>
    <div class="auto-container margin_60" style="    padding: 22px !important;">
        <div class="row">
            <div class="col-md-12">
                <label>
                    <h3>{{__('survey_title')}}</h3>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 box_style_1">
                <?php
                use App\Models\AnswerLanguage;
                use App\Models\Language; ?>
                <?php
                $langId = Language::where("url", app()->getLocale())->first()->id;
                ?>
                <form method="post" action="{{route('surveysave')}}">
                    <input type="hidden" name="id_reservation" value="{{base64_encode($reservation->id)}}"/>
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <?php foreach ($surveys as $survey) { ?>
                    <fieldset class="radioButtonsScaleBelow Receipt">
                        <legend class="radioButtonFNS Receipt00"
                                id="Receipt">{{ $survey->surveyquestion()->name}}</legend>
                        <div class="radioButtonList Receipt{{$survey->id}} row" type="radiogroup" aria-activedescendant="Receipt.1">
                            <?php
                            if($survey->type == 'radio'){
                            $answer_survey = AnswerLanguage::where('survey_id', $survey->id)->where('lang_id', $langId)->get();
                            $i = 0; foreach($answer_survey as $item){ ?>
                            <div class="col-md-2" tabindex="-1" aria-checked="False" role="radio" id="ReceiptBox{{$survey->id}}">
                                 <span>
                                    <input style="    width: 20px;height:20px" onclick="validateForm({{$survey->id}},{{$item->sort}})" type="radio" name="receipt[{{$survey->id}}]" value="{{$item->id}}" title="Yes" id="Receipt{{$survey->id}}" aria-checked="true" data-sort="{{$item->sort}}" tabindex="0">
                                    <label for="Receipt.{{$survey->id}}" class="radioSimpleInput" style="background-position: 0px -36px;font-size: 20px;font-weight:bold"><?php echo $item->name ?></label>
                                 </span>

                            </div>
                            <?php $i++; } ?>
                            <?php }else{ ?>
                                <div class="col-md-12" tabindex="-1" aria-checked="False" role="radio" style="margin: 0 0 20px 2px">
                                     <textarea rows="5" name="receipt[{{$survey->id}}]" class="form-control"></textarea>
                                </div>
                            <?php } ?>
                                <div id="htmltext"></div>
                        </div>
                    </fieldset>
                    <?php } ?>
                    <button class="btn btn-secondary" type="submit">{{__('Kaydet')}}</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        .htmltextClass{
            width: 89%;
            border: 3px solid #ccc;
            padding: 9px 10px 0px 10px;
            margin-left: 20px;
        }
    </style>
    <script>
        function validateForm(id,sort) {
            if(sort == 0)
            {
                $(".Receipt"+id).find("div#htmltext").html('' +
                    '<div class="form-group">'+
                    '<label for="exampleInputEmail1">Lütfen Nedenini Belirtiniz</label>'+
                    '<input type="text" class="form-control" name="receipt['+id+']" id="exampleInputEmail1">'+
                    '</div>').addClass('htmltextClass');
            }else{
                $(".Receipt"+id).find("div#htmltext").html(' ').removeClass('htmltextClass');
            }
        }
    </script>
@endsection
