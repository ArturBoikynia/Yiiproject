<?php

namespace app\models\forms;

use app\models\entities\Yiiusers;
use app\models\entities\SkillsEntities;
use yii\base\Model;


class AddSkill extends Model
{

    public string $addYourSkill = '';
    public ?int $user_id = null;

    public function rules():array
    {
        return [
            [['user_id', 'addYourSkill'], 'required'],
            [['user_id'], 'integer'],
            [['addYourSkill'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yiiusers::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    public function setSkill( string $skill):bool
    {
        $this->addYourSkill = $skill;

        if (!$this->validate()) {
            return false;
        }
//        $dirPath = Yii::getAlias('@photos') . '/' . $this->user_id;


//        if(!is_dir($dirPath))
//        {
//            FileHelper::createDirectory(Yii::getAlias('@photos') . '/' . $this->user_id);
//        }

        /*foreach ($this->imageFiles as $file) {
            $fileName = time() . md5($file->baseName) . mt_rand() . '.' . $file->extension;
            $path = $dirPath . '/' . $fileName;
            if (!$file->saveAs($path)) {
                $this->addError(
                    'imageFiles',
                    Yii::t('app', 'File {file} was not loaded', ['file' => "{$file->baseName}.{$file->extension}"]));
                continue;
            }
        }*/
            $skill = new SkillsEntities();
            $skill->user_id = $this->user_id;
            $skill->skill = $this->addYourSkill;
            $skill->save();

            $this->addYourSkill = '';

        return true;
    }

}