<?php
namespace frontend\models;

use common\models\Image;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class UploadImage extends Model
{
    public $filename;
   // public $email;
   // public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['filename', 'trim'],
            ['filename', 'required'],
            ['filename', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['filename', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function upload()
    {
        if (!$this->validate()) {
            return null;
        }

        $image = new Image();
        $image->filepath = 'file/path';
       

        return $image->save() ? $image : null;
    }
}
