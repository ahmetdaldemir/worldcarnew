<?php
use App\Models\Language;
$langId = Language::where("url", app()->getLocale())->first()->id;
?>
<div class="auto-container">
    <div class="col-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <?php

            foreach ($data['static']['tabs'] as $value) {
            ?>
            <li class="nav-item">
                <a class="nav-link" id="rent-a-car-tab{{$value->id}}" data-toggle="pill" href="#rent-a-car-{{Str::slug($value->getLangTitleView($langId))}}" role="tab" aria-controls="rent-a-car-{{Str::slug($value->getLangTitleView($langId))}}" aria-selected="true">{{$value->getLangTitleView($langId)}}</a>
            </li>
       <?php } ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        <?php foreach ($data['static']['tabs'] as $value) { ?>
                <div class="tab-pane fade" id="rent-a-car-{{Str::slug($value->getLangTitleView($langId))}}" role="tabpanel" aria-labelledby="rent-a-car-{{Str::slug($value->getLangTitleView($langId))}}-tab">
                    <?php $alltitle = $value->getLangViewAllTitle($langId);  ?>
                    <?php foreach($alltitle as $item){ ?>
                    <span class="footertabspan"><a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$item->slug}}/{{$item->id_text}}"><?=$item->title?></a>
                    </span>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<style>
    .footertabspan{
        font-weight:500;
    }
    .footertabspan::after {
        margin-right:5px;
        margin-left:5px;
        font-weight:600;
        content: "|";
    }
    .footertabspan:last-child::after{
        margin-right:5px;
        content: "";
    }
</style>
