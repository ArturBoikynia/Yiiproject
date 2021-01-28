<?php

namespace app\models\forms;

use app\models\entities\PhotoEntities;
use app\models\entities\Yiiusers;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use Yii;


class AddPhotos extends Model
{

    /**
     * @var UploadedFile[]
     */
    public array $imageFiles = [];
    public ?int $user_id = null;

    public function rules():array
    {
        return [
            [['user_id', 'imageFiles'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload():bool
    {
        if (!$this->validate()) {
            return false;
        }
        $dirPath = Yii::getAlias('@photos') . '/' . $this->user_id;


        if(!is_dir($dirPath))
        {
            FileHelper::createDirectory(Yii::getAlias('@photos') . '/' . $this->user_id);
        }

        foreach ($this->imageFiles as $file) {
            $fileName = time() . md5($file->baseName) . mt_rand() . '.' . $file->extension;
            $path = $dirPath . '/' . $fileName;
            if(!$file->saveAs($path)){
               $this->addError(
                   'imageFiles',
                   Yii::t('app', 'File {file} was not loaded',['file' => "{$file->baseName}.{$file->extension}"]));
                continue;
            }

            $photoEntity = new PhotoEntities();
            $photoEntity->user_id = $this->user_id;
            $photoEntity->path = $path;
            $photoEntity->save();
        }
        return true;
    }

}