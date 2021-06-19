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

  public function rules()
  {
    return [
      [['name', 'lastName', 'email', 'phone'], 'required'],
      [['name', 'lastName', 'email', 'phone'], 'filter', 'filter' => 'trim'],
      [['name', 'lastName'], 'string', 'max' => 40],
      ['phone', 'string', 'min' => 10, 'max' => 12],
      ['phone', 'match', 'pattern' => '/^[0-9]{10,12}$/'],
      ['email', 'email'],
      ['email', 'unique'],
      [['email'], 'string', 'max' => 50],
    ];
  }

  /**
   * @return string the name of the table associated with this ActiveRecord class.
   */
  public static function tableName()
  {
    return '{{contact}}';
  }

  public function beforeSave($insert)
  {
    $this->email = strtolower($this->email);
    return true;
  }
}
