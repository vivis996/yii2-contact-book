<?php

namespace app\models;

use yii\db\ActiveRecord;

class TypeInput extends ActiveRecord
{
  public function rules()
  {
    return [
      [['name'], 'required'],
    ];
  }

  public static function tableName()
  {
    return '{{typeInput}}';
  }
}
