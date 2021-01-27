<?php


namespace app\components;


use app\models\entities\PhotoEntities;
use app\models\entities\SkillsEntities;
use yii\db\Exception;
use Yii;

class EditSkill
{
    private ?int $id = null;

    public function __construct(int $id){
        $this->id = $id;
    }

    public function remove (string $user_id):void {
        $skill = new SkillsEntities();
        $skill::deleteAll(['id' => $user_id]);

    }


}