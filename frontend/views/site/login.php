<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<div class="bg-color-2 p-4 rad-all-15">
    <div class="container-fluid">
        <h4 class="mb-4 text-c bold"><?= Html::encode($this->title) ?></h4>
        <div class="d-flex justify-content-center">
            <div class="bg-color-1 rad-all-15 p-4 row w-50">
                <div class="col-12 p-0">
                    <p class = "text-color-2">Please fill out the following fields to login:</p>
                </div>

                <div class="col-12 p-0">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]); ?>
                        <p class = "text-color-2 bold m-0">Username</p>
                        <?= $form->field($model, 'username')->textInput(['class' => 'form-control rad-all-15 bord-color-1 bg-color-3 text-color-2 bold'])->label(false) ?>

                        <p class = "text-color-2 bold m-0">Password</p>
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control rad-all-15 bord-color-1 bg-color-3 text-color-2 bold'])->label(false) ?>

                        <?= $form->field($model, 'rememberMe', ['options' =>  ['class' => 'text-color-2 bold text-r']])->checkbox() ?>

                        <div class="text-color-1 my-1">
                            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                        </div>
                        <div class="text-color-1 my-1">
                            Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                        </div>

                        <div class="form-group m-0 float-r">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary rad-all-15 bg-color-2 text-color-1 border-0 bold', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
