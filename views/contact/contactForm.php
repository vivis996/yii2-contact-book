<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = (isset($contact->id) ? 'Edit \'' . $contact->name . ' ' . $contact->lastName . '\'' : 'New') . ' contact';
?>

<div class="site-index">
  <div class="body-content">
    <div class="row">
      <div class="col-md-12">
        <h1><?= isset($contact->id) ? 'Edit \'' . $contact->name . ' ' . $contact->lastName . '\'' : 'New' ?> contact</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($contact); ?>
        <?= $form->field($contact, 'name')->textInput() ?>
        <?= $form->field($contact, 'lastName')->textInput() ?>
        <?= $form->field($contact, 'email')->textInput() ?>
        <?= $form->field($contact, 'phone')->textInput() ?>
        <div class="form-group">
          <?= Html::submitButton($contact->isNewRecord ? 'Create' : 'Update', ['class' => $contact->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>