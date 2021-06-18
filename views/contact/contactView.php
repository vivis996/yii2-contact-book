<?php

use yii\helpers\Url;

$this->title = $contact->name . ' ' . $contact->lastName . ' contact';
?>

<div class="site-index">
  <div class="body-content">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <h2 for="name">Name: </h2>
          <h3 for="name"><?= $contact->name ?></h3>
        </div>
        <div class="form-group">
          <h2 for="lastName">Last name: </h2>
          <h3 for="name"><?= $contact->lastName ?></h3>
        </div>
        <div class="form-group">
          <h2 for="email">Email: </h2>
          <h3 for="name"><?= $contact->email ?></h3>
        </div>
        <div class="form-group">
          <h2 for="phone">Phone: </h2>
          <h3 for="name"><?= $contact->phone ?></h3>
        </div>
        <div class="form-group">
          <h2 for="Status">Status: </h2>
          <span class="label label-<?= $contact->status == 0 ? 'danger' : 'success' ?>" style="font-size:1.5em;"><?= $contact->status == 0 ? 'Inactive' : 'Active' ?></span>
        </div>
        <br/>
        <div class="form-group">
          <div class="btn-group">
            <a class="btn btn-warning" href="<?= Url::to(['contact/edit', 'id' => $contact->id]) ?>">Edit</a>
            <a class="btn btn-danger" href="<?= Url::to(['contact/delete', 'id' => $contact->id]) ?>">Delete</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>