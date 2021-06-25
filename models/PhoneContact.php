<?php

namespace app\models;

use yii\db\ActiveRecord;

class PhoneContact extends ActiveRecord
{
  public function rules()
  {
    return [
      [['type_id', 'phone', 'contact_id'], 'required'],
      ['type_id', 'integer', 'min' => 0],
      ['phone', 'string', 'min' => 10, 'max' => 12],
      ['phone', 'match', 'pattern' => '/^[0-9]{10,12}$/'],
    ];
  }

  public static function tableName()
  {
    return '{{phoneContact}}';
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
