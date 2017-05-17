<?php
namespace frontend\models;

use common\models\Image;
use yii\base\Model;
use common\models\User;
use Yii;

/**
 * Signup form
 */
class UploadImage extends Model
{
    public $filepath;
    public $angle;
    public $imageId;

    public function rules()
    {
        return [
            [['filepath'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    //upload image
    public function upload()
    {
        //validate
        if (!$this->validate()) {
            return null;
        }
        //upload user image
        $newName = time();
        $this->filepath->saveAs('uploads/' .$newName . '.' . $this->filepath->extension);
        $image = new Image();
        $user = Yii::$app->user->identity;
        $image->filepath = $newName .'.'. $this->filepath->extension;
        $image->angle = 0;
        return $user->link('images', $image) ? $image : null;
    }
    //change image angle
    public function changeAngle($param)
    {
        $image=Image::findOne($param['Image']['id']);
        $image->angle = $param['Image']['angle'];
        return $image->save() ? $image : null;
    }
    //delete user image
    public function deleteImage($param)
    {
        $image=Image::findOne($param['Image']['id']);

        return $image->delete() ? $image : null;
    }
}
