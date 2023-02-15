<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = $IdManga;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="bg-color-2 rad-all-15">
    <div class="container-fluid pb-4 pr-4 pl-4">
        <div class="row">
            <div class="col px-4">
                <div class="bg-color-1 rad-all-15 pt-4 px-4 pb-2 mt-4">
                    <div class="row">
                        <div class="<?=(Yii::$app->user->isGuest)?'col-12':'col-8'?> mb-4">
                            <h4 class="text-color-2" id="manga-title"></h4>
                        </div>
                        <?php if(!Yii::$app->user->isGuest){ ?>
                        <div class="col-3 mb-4">
                            <?php if($Library){ ?>
                            <a id="library-tag-a" style="cursor: pointer;" onClick="removeApiLibrary(<?=$Api->IdApi?>,<?=$IdManga?>)" class="btn btn-error px-1 w-100 bg-color-6"><span class="text">Remove from Library</span></a>
                            <?php }else{ ?>
                            <a id="library-tag-a" style="cursor: pointer;" onClick="addApiLibrary(<?=$Api->IdApi?>,<?=$IdManga?>)" class="btn btn-success px-1 w-100 bg-color-4"><span id="library-span" class="text">Add to Library</span></a>
                            <?php } ?>
                        </div>
                        <div class="col-1 mb-4">
                            <?php if($Favorite){ ?>
                            <a id="img-tag-a" style="cursor: pointer;" onClick="removeApiFavorite(<?=$Api->IdApi?>,<?=$IdManga?>)">
                                <img id="img-fav" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/favorite.png'?>" width="38">
                            </a>
                            <?php }else{ ?>
                            <a id="img-tag-a" style="cursor: pointer;" onClick="addApiFavorite(<?=$Api->IdApi?>,<?=$IdManga?>)">
                                <img id="img-fav" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/unfavorite.png'?>" width="38">
                            </a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="col-auto">
                            <div class="d-flex justify-content-center">
                                <img class="img-h-300 img-w-225 rad-all-15" id="manga-image" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/manga_alternative.jpg'?>">
                            </div>
                        </div>
                        <div class="col row">
                            <div class="col-12 text-color-3 bold ts-18">Original Title: <span class="text-color-2" id="manga-orig-title"></span></div>
                            <div class="col-12 text-color-3 bold ts-18">Alternative Title: <span class="text-color-2" id="manga-alt-title"></span></div>
                            <div class="col-12 text-color-3 bold ts-18">Authors: <span class="text-color-2" id="manga-author"></span></div>
                            <div class="col-6 text-color-3 bold ts-18">Type: <span class="text-color-2" id="manga-type"></span></div>
                            <div class="col-6 text-color-3 bold ts-18">Release Date: <span class="text-color-2" id="manga-release-date"></span></div>
                            <div class="col-6 text-color-3 bold ts-18">Status: <span class="text-color-2" id="manga-status"></span></div>
                            <div class="col-6 text-color-3 bold ts-18">Chapters: <span class="text-color-2" id="manga-chapters"></span></div>
                            <div class="row" id="manga-genres-list">
                                <div class="col-auto">
                                    <span class="text-color-3 mb-0 bold ts-18">Genres: </span>
                                </div>
                                <div class="col-auto div-genre-clone"><span class="text-color-1 bg-color-2 rad-all-15 p-2 bold ts-18" id="genre-name"></span></div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="text-color-3 bold ts-18">Description:  <span class="text-color-2" id="manga-description"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var Api = <?=$JavaApi?>;
    var IdManga = <?=$IdManga?>;
    var GenreClone = $('.div-genre-clone').clone();

    var this_web_api = "<?=Yii::$app->urlManagerBackend->baseUrl?>/";
    var user_id = "<?=(!Yii::$app->user->isGuest)?Yii::$app->user->identity->IdUser:null?>";
</script>
<script src="<?=Yii::$app->request->baseUrl?>/js/api-jikan.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/js/manga-view.js"></script>