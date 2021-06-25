<?php

namespace app\models;

use yii\db\ActiveRecord;

class EmailContact extends ActiveRecord
{
  public function rules()
  {
    return [
      [['type_id', 'email', 'contact_id'], 'required'],
      ['type_id', 'integer', 'min' => 0],
      ['email', 'email'],
      ['email', 'unique'],
      ['email', 'filter', 'filter' => 'trim'],
      [['email'], 'string', 'max' => 50],
    ];
  }

  public static function tableName()
  {
    return '{{emailContact}}';
  }

  public function beforeSave($insert)
  {
    $this->email = strtolower($this->email);
    return true;
  }

  public function getTypeInput()
  {
    return $this->hasOne(TypeInput::class, ['id' => 'type_id']);
  }

  public function getContact()
  {
    return $this->hasMany(Contact::class, ['id' => 'contact_id']);
  }
}
