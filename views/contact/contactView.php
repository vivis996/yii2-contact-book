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
          <h2 for="email">Email(s): </h2>
          <ul>
            <?php foreach ($contact->email_List as $i => $email) : ?>
              <li for="name"><?= $email->email ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="form-group">
          <h2 for="phone">Phone: </h2>
          <ul>
          <?php foreach ($contact->phone_List as $i => $phone) : ?>
            <li for="name"><?= $phone->phone ?></li>
          <?php endforeach; ?>
          </ul>
        </div>
        <br />
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