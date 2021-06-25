<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
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
        <?= $form->field($contact, 'id')->hiddenInput()->label(false) ?>
        <div id="emails-content">
          <div class="row">
            <div class="col-md-11">
              <label class="control-label">Email</label>
            </div>
            <div class="col-md-1 float-right">
              <a href="javascript:;" class="btn btn-success" onclick="addEmailInput();">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <br />
          <?php foreach ($contact->email_List as $i => $email) : ?>
            <?= $this->render('extras/emailForm', ['form' => $form, 'email' => $email, 'i' => $i, 'typeInputs' => $typeInputs]); ?>
          <?php endforeach; ?>
        </div>
        <div id="phones-content">
          <div class="row">
            <div class="col-md-11">
              <label class="control-label">Phone</label>
            </div>
            <div class="col-md-1 float-right">
              <a href="javascript:;" class="btn btn-success" onclick="addPhoneInput();">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <br />
          <?php foreach ($contact->phone_List as $i => $phone) : ?>
            <?= $this->render('extras/phoneForm', ['form' => $form, 'phone' => $phone, 'i' => $i, 'typeInputs' => $typeInputs]); ?>
          <?php endforeach; ?>
        </div>
        <div class="form-group">
          <?= Html::submitButton($contact->isNewRecord ? 'Create' : 'Update', ['class' => $contact->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>

<script>
  var emails = <?= count($contact->email_List) ?>;
  var phones = <?= count($contact->phone_List) ?>;

  function addEmailInput() {
    emails++;
    $.ajax({
      url: "<?= Url::to(['contact/email']) ?>" + '/' + (emails - 1),
      success: function(result) {
        $("#emails-content").append(result);
      }
    });
  }

  function addPhoneInput() {
    phones++;
    $.ajax({
      url: "<?= Url::to(['contact/phone']) ?>" + '/' + (phones - 1),
      success: function(result) {
        $("#phones-content").append(result);
      }
    });
  }
</script>