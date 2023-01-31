<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="bg-color-2 rad-tr-15 rad-b-15">
    <div class="container-fluid pb-4 px-4">
        <div class="row">
            <div class="col">
                <!-- Page Heading -->
                <div class="mb-4">
                    <select class="sel-color-1 mt-4" id="order-by" onchange="changePage('<?=Yii::$app->request->baseUrl.'/'?>','home',1)">
                        <option class="option-color1" value="latest-updates" <?=('latest-updates'==$Option)?'selected="selected"':''?>>Latest Updates</option>
                        <option class="option-color1" value="ranking" <?=('ranking'==$Option)?'selected="selected"':''?>>Ranking</option>
                        <option class="option-color1" value="popular" <?=('popular'==$Option)?'selected="selected"':''?>>Popular</option>
                    </select>
                    <select class="float-right sel-color-1 mt-4" id="show-per-page" onchange="changePage('<?=Yii::$app->request->baseUrl.'/'?>','home',<?=$PageNumber?>)">
                        <option class="option-color1" value="25" <?=(25==$NumberPerPage)?'selected="selected"':''?>>Show mangas: 25 per page</option>
                        <option class="option-color1" value="50" <?=(50==$NumberPerPage)?'selected="selected"':''?>>Show mangas: 50 per page</option>
                        <option class="option-color1" value="100" <?=(100==$NumberPerPage)?'selected="selected"':''?>>Show mangas: 100 per page</option>
                    </select>
                </div>
                <!-- Approach -->
                <div class="bg-color-1 rad-all-15 p-4">
                    <?=$this->render('//layouts/view_type_1',['Option'=>$Option,'Mangas'=>$Mangas,'PageNumber'=>$PageNumber,'NumOfPages'=>$NumOfPages,'NumberPerPage'=>$NumberPerPage])?>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <?=$this->render('//layouts/genre_list',['Categories'=>$Categories])?>
            </div>
        </div>
    </div>
</div>