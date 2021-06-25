<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
  public function rules()
  {
    return [
      [['name', 'lastName',], 'required'],
      [['name', 'lastName',], 'filter', 'filter' => 'trim'],
      [['name', 'lastName'], 'string', 'max' => 40],
    ];
  }

  public function attributes()
  {
    $attributes = parent::attributes();
    $attributes[] = 'phone_List';
    $attributes[] = 'email_List';
    return $attributes;
  }

  /**
   * @return string the name of the table associated with this ActiveRecord class.
   */
  public static function tableName()
  {
    return '{{contact}}';
  }

  public function getEmails()
  {
    return $this->hasMany(EmailContact::class, ['contact_id' => 'id']);
  }

  public function getPhones()
  {
    return $this->hasMany(PhoneContact::class, ['contact_id' => 'id']);
  }
}
