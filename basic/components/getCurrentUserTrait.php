<?php


namespace app\components;


use app\models\entities\Yiiusers;
use yii\web\NotFoundHttpException;
use app\components\getCurrentUser;
use Yii;

trait getCurrentUserTrait
{
    public function setCurrentUser(int $id):void{
        $userModel = $this->findUserModel($id);
        new getCurrentUser($userModel);
    }
    /**
     * @param $id
     * @return Yiiusers|null
     * @throws NotFoundHttpExceptio
     */
    public function findUserModel($id)
    {
        if (($model = Yiiusers::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}