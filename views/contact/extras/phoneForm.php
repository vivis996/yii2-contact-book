<?php

use yii\widgets\ActiveForm;

$form = isset($form) ? $form : new ActiveForm();
?>

<div class="row" id="phone-row-<?= $i ?>">
  <div class="col-md-3">
    <?= $form->field($phone, 'type_id')->dropdownList($typeInputs, ['name' => $phone->formName() . '[' . ($i) . '][type_id]'])->label(false) ?>
    <?= $form->field($phone, 'id')->hiddenInput(['name' => $phone->formName() . '[' . ($i) . '][id]'])->label(false) ?>
  </div>
  <div class="col-md-8">
    <?= $form->field($phone, 'phone')->textInput(['id' => $phone->formName() . '-' . ($i) . '-phone', 'name' => $phone->formName() . '[' . ($i) . '][phone]'])->label(false) ?>
  </div>
  <div class="col-md-1">
    <a href="javascript:;" class="btn btn-danger" onclick="$('#phone-row-<?= $i ?>').remove();">
      <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
    </a>
  </div>
</div>