<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="bg-color-2 rad-all-15 rad-b-15">
    <div class="container-fluid pb-4 px-4">
        <div class="row pt-4">
            <div class="col-12">
                <h1 class="text-color-1"><?= Html::encode($this->title) ?></h1>
            </div>

            <div class="col-12 mt-2 pt-2">
                <div class="alert alert-danger text-color-1">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
            </div>

            <div class="col-12">
                <p class="text-color-1">The above error occurred while the Web server was processing your request.</p>
            </div>
            <div class="col-12">
                <p class="text-color-1">Please contact us if you think this is a server error. Thank you.</p>
            </div>
        </div>
    </div>
</div>
