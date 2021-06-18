<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
  // public $id;
  // public $name;
  // public $lastName;
  // public $email;
  // public $phone;

  // public function rules()
  // {
  //     return [
  //         [['name', 'lastName', 'email', 'phone'], 'required'],

  //         ['email', 'email'],
  //     ];
  // }

  /**
   * @return string the name of the table associated with this ActiveRecord class.
   */
  public static function tableName()
  {
    return '{{contact}}';
  }
}