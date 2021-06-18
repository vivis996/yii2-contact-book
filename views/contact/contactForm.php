<?php

/* @var $this yii\web\View */

$this->title = 'New contact - Agenda';
?>

<div class="site-index">
  <div class="body-content">
    <div class="row">
      <div class="col-md-12">
        <h1><?= isset($contact) ? 'Edit \'' . $contact->name . ' ' . $contact->lastName . '\'' : 'New' ?> contact</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="/contact/save<?= isset($contact) ? '?id=' . $contact->id : '' ?>" method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= isset($contact) ? $contact->name : '' ?>">
          </div>
          <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" name="lastName" id="lastName" class="form-control" value="<?= isset($contact) ? $contact->lastName : '' ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= isset($contact) ? $contact->email : '' ?>" onkeyup="this.value = this.value.toLowerCase();"/>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control no-arrow" min="1" value="<?= isset($contact) ? $contact->phone : '' ?>">
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="0" <?= isset($contact) && $contact->status == 0 ? 'selected' : '' ?>>Inactive</option>
              <option value="1" <?= !isset($contact) || $contact->status == 1 ? 'selected' : '' ?>>Active</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" value="Save" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>