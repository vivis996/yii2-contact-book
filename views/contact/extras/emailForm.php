<?php

use yii\widgets\ActiveForm;

$form = isset($form) ? $form : new ActiveForm();
?>

<div class="row" id="email-row-<?= $i ?>">
  <div class="col-md-3">
    <?= $form->field($email, 'type_id')->dropdownList($typeInputs, ['name' => $email->formName() . '[' . ($i) . '][type_id]'])->label(false) ?>
    <?= $form->field($email, 'id')->hiddenInput(['name' => $email->formName() . '[' . ($i) . '][id]'])->label(false) ?>
  </div>
  <div class="col-md-8">
    <?= $form->field($email, 'email')->textInput(['id' => $email->formName() . '-' . ($i) . '-email', 'name' => $email->formName() . '[' . ($i) . '][email]'])->label(false) ?>
  </div>
  <div class="col-md-1">
    <a href="javascript:;" class="btn btn-danger" onclick="$('#email-row-<?= $i ?>').remove();">
      <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
    </a>
  </div>
</div>