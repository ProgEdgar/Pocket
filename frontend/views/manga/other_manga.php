<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'PocketManga';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="bg-color-2 rad-all-15 ">
    <div class="container-fluid pb-4 px-4 b-35">
        <div class="row">
            <div class="col">
                <!-- Page Heading -->
                <div class="mb-4 row">
                    <div class="col">
                        <h4 class="mt-4" id="test-title">Other Manga</h4>
                    </div>
                </div>
                <!-- Approach -->
                <div class="bg-color-1 rad-all-15 p-4">
                    <div class="row">
                        <div class="col-3">
                            <button class="bg-color-3 border-0 rad-t-15 w-100 px-4 py-2" id="button-filter" onclick="PressFilterButton();">
                                <p class="text-color-2 m-0 ts-18">Filter</p>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="bg-color-3 rad-b-15 rad-tr-15" id="filters">
                                <div class="row p-3 mx-0" id="filters_genres">
                                    <div class="col-3 pb-2 div-genre-button div-genre-clone">
                                        <button class="bg-color-1 border-0 w-100 mt-2 rad-all-15 py-1 mx-n2 text-c" 
                                            onclick="PressGenreButton($(this).closest('.div-genre-button'));">
                                            <span class="text-color-2" id="genre-name"></span>
                                            <input type="checkbox" class="radio add-genres" id="genre-add-radio"> <!-- don't forget to add value and name -->
                                            <input type="checkbox" class="radio remove-genres" id="genre-remove-radio"> <!-- don't forget to add value and name -->
                                        </button>
                                    </div>
                                </div>
                                <div class="row px-3 mx-0 pt-3 pb-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php if($SortOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2 ml-n2" id="filter_order" 
                                                        onchange="ChangeButtonSearch()">
                                                        <?php $selected=true; foreach($SortOptions as $Sort){?>
                                                            <option value="<?=$Sort[0]?>" <?=($selected)?'selected="selected"':''?>><?=$Sort[1]?></option>
                                                        <?php $selected=false;} ?>
                                                    </select>
                                                </div>
                                            <?php } if($StatusOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2" id="filter_status"
                                                        onchange="ChangeButtonSearch()">
                                                        <option value="" selected="selected">Show All Status</option>
                                                        <?php foreach($StatusOptions as $Status){?>
                                                            <option value="<?=$Status[0]?>"><?=$Status[2]?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } if($TypeOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2" id="filter_type"
                                                        onchange="ChangeButtonSearch()">
                                                        <option value="" selected="selected">Show All Types</option>
                                                        <?php foreach($TypeOptions as $Type){?>
                                                            <option value="<?=$Type[0]?>"><?=$Type[1]?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <div class="col-3">
                                                <button class="text-color-2 bg-color-1 border-0 rad-all-15 w-100 py-2 ml-2" id="button-search" value="1" onclick="SearchMangas()">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row manga-list mt-4">
                        <div class="col-12 div-manga-clone">
                            <a class="text-dec-none" id="manga-link" href="">
                                <div class="row p-2 bord-all-5-sol-color-2 mx-2 mb-3 rad-all-15">
                                    <div class="col-auto p-0">
                                        <img class="rad-all-10" id="manga-image" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/manga_alternative.jpg'?>" height="200" width="150">
                                    </div>
                                    <div class="col row">
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Title: <span class="text-color-2 ts-18 no-bold" id="manga-title"></span></span></div>
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Alternative Title: <span class="text-color-2 ts-18 no-bold" id="manga-alt-title"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Author: <span class="text-color-2 ts-18 no-bold" id="manga-author"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Chapters: <span class="text-color-2 ts-18 no-bold" id="manga-chapters"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Genres: <span class="text-color-2 ts-18 no-bold" id="manga-genres"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Type: <span class="text-color-2 ts-18 no-bold" id="manga-type"></span></span></div>
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Description: <span class="text-color-2 ts-18 no-bold ellipse" id="manga-description"></span></span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" id="no-manga">
                        <div class="col">
                            <p class="text-color-2" id="p-no-manga"> There are no manga </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var baseUrl = '<?=Yii::$app->request->baseUrl?>';
    var Api = <?=$JavaApi?>;
</script>
<script src="<?=Yii::$app->request->baseUrl?>/js/api-jikan.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/js/manga-list.js"></script>
