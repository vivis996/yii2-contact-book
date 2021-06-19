<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'All contacts';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
                <h1>My friends</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Name</th>
                            <th>LastName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $i => $contact) : ?>
                                <tr>
                                    <td><?= $contact->name; ?></td>
                                    <td><?= $contact->lastName; ?></td>
                                    <td><?= $contact->email; ?></td>
                                    <td><?= $contact->phone; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="<?= Url::to(['contact/view', 'id' => $contact->id]) ?>">
                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            </a>
                                            <a class="btn btn-primary" href="<?= Url::to(['contact/edit', 'id' => $contact->id]) ?>">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </a>
                                            <a class="btn btn-danger" href="<?= Url::to(['contact/delete', 'id' => $contact->id]) ?>">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>