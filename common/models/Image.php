<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


class Image extends  ActiveRecord
{

    public static function tableName()
    {
        return 'image';
    }

    public function fields()
    {
        return [
            'filepath',
            'angle',
            'id'
        ];
    }
    //related with user Model
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}