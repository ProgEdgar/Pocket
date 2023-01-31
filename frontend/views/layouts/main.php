<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        
        <?php if(Yii::$app->user->isGuest){ ?>
            <link rel="stylesheet" type="text/css" href="<?=Yii::$app->request->baseUrl?>/css/dark-theme.css" />
            <?php }else{ if(Yii::$app->user->identity->leitor->Theme){ ?>
            <link rel="stylesheet" type="text/css" href="<?=Yii::$app->request->baseUrl?>/css/dark-theme.css" />
            <?php }else{ ?>
            <link rel="stylesheet" type="text/css" href="<?=Yii::$app->request->baseUrl?>/css/light-theme.css" />
        <?php }} ?>


        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-color-1">
        <?php $this->beginBody() ?>

        <div class="wrap">
            <nav class="navbar navbar-expand-lg navbar-dark bg-color-1 fixed-top">
                <div class="container">
                    <!-- Brand -->
                    <a class="navbar-brand text-color-2" href="<?=Yii::$app->homeUrl?>">
                        <img width="220px" src="<?=Yii::$app->request->baseUrl.'/img/default/PocketManga.png'?>" placeholder="PocketManga" />
                    </a>

                    <!-- Links -->
                    <ul class="navbar-nav">
                        <!--<li class="nav-item">
                            <form class="form-inline my-2 my-lg-0">
                                <div class="input-group input-group-sm m-2">
                                    <input class="form-control border-secondary py-2" type="search" placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-color-2 <?=(Yii::$app->controller->route=='site/about')?'active':''?>" href="<?=Yii::$app->request->baseUrl.'/about'?>">About</a>
                        </li>
                        <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-color-2 <?=(Yii::$app->controller->route == 'site/signup')?'active':''?>" href="<?=Yii::$app->request->baseUrl.'/signup'?>">Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-color-2 <?=(Yii::$app->controller->route == 'site/login')?'active':''?>" href="<?=Yii::$app->request->baseUrl.'/login'?>">Login</a>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item align-center">
                            <a class="nav-link text-color-2 <?=(Yii::$app->controller->route == 'leitor/myaccount')?'active':''?>" href="<?=Yii::$app->request->baseUrl.'/my_account'?>">
                                <div class="row">
                                    <div class="col-6">
                                        <span><?=Yii::$app->user->identity->Username?></span>
                                    </div>
                                    <div class="col-6">
                                        <?php if(Yii::$app->user->identity->SrcPhoto){ if (file_exists(Yii::getAlias('@backend').'/web/img'.Yii::$app->user->identity->SrcPhoto)){ ?>
                                        <img class="rad-all-50p" src="<?=Yii::$app->urlManagerBackend->baseUrl.'/img'.Yii::$app->user->identity->SrcPhoto?>" height="30" width="30">
                                        <?php }else{ ?>
                                        <img class="rad-all-50p" src="<?=Yii::$app->urlManagerBackend->baseUrl.'/img/default/'.((Yii::$app->user->identity->Gender == "F")?'F':'M').'.jpg'?>" height="30" width="30">
                                        <?php }}else{ ?>
                                        <img class="rad-all-50p" src="<?=Yii::$app->urlManagerBackend->baseUrl.'/img/default/'.((Yii::$app->user->identity->Gender == "F")?'F':'M').'.jpg'?>" height="30" width="30">
                                        <?php } ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
            <div class="container mar-b-100">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item pb-0 px-0">
                        <a class="nav-link rad-t-15 rad-b-0 <?=(Yii::$app->controller->route=='site/mangaindex'||Yii::$app->controller->route=='manga/mangaindex')?'active bg-color-2 text-color-1':'text-color-2'?>" 
                            href="<?=Yii::$app->request->baseUrl.'/last-updated'?>">Last Updated</a>
                    </li>
                    <li class="nav-item pb-0 px-0">
                        <a class="nav-link rad-t-15 rad-b-0 <?=(Yii::$app->controller->route=='manga/allmanga')?'active bg-color-2 text-color-1':'text-color-2'?>" 
                            href="<?=Yii::$app->request->baseUrl.'/all-manga'?>">All Manga</a>
                    </li>
                    <li class="nav-item pb-0 px-0">
                        <a class="nav-link rad-t-15 rad-b-0 <?=(Yii::$app->controller->route=='api/allmanga')?'active bg-color-2 text-color-1':'text-color-2'?>" 
                            href="<?=Yii::$app->request->baseUrl.'/other-mangas'?>">Other Manga</a>
                    </li>
                    <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="nav-item pb-0 px-0">
                        <a class="nav-link rad-t-15 rad-b-0 disabled" href="#">Library</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item pb-0 px-0">
                        <a class="nav-link rad-t-15 rad-b-0 <?=(Yii::$app->controller->route=='library/index'||Yii::$app->controller->route=='library/index2')?'active bg-color-2 text-color-1':'text-color-2'?>" 
                            href="<?=Yii::$app->request->baseUrl.'/'.'library'?>">Library</a>
                    </li>
                    <?php } ?>
                </ul>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer id="footer" class="py-2">
            <div class="container">
                <p class="text-right text-color-1 bold m-0">Projet Developed By: <span class="text-color-3">Edgar Cordeiro</span></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage();
