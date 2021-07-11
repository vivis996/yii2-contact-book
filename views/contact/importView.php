<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Import by csv file';
?>

<div class="site-index">
  <div class="body-content">
    <div class="row">
      <div class="col-md-12">
        <h1>Import content by csv file</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'csvFile')->fileInput() ?>
        <div class="form-group">
          <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>