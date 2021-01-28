<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use app\widgets\FriendsStatementView;
use yii\grid\GridView;
use app\components\EditPhoto;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\forms\AddSkill $skillsModel */
/* @var array $friendsQuery */
/* @var yii\data\ActiveDataProvider $dataProvider */
/* @var app\models\forms\FriendsSearch $searchModel */


$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
Icon::map($this);

?>
<h1> Friends of <?= $model->name . ' ' . $model->surname ?></h1>



<div class="row">
    <div class="col-md-5">
        <?php  echo $this->render('friends-search', ['model' => $searchModel, 'userModel' => $model]); ?>
        <?= GridView::widget([

            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
                'class' => 'col-lg-1',
//            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                  'label' => 'Avatar',
//                  'encodeLabel' => false,
                  'format' => 'html',
                  'value' => function($data){
                      $image = EditPhoto::findMainPhoto($data->friend_id);
                      return Html::img(['users/image', 'url' => $image->path], [ 'width' => '30', 'height' => '30', 'class' => 'img-circle ']);
                  },
                ],
                [
                    'attribute' => 'username',
                    'format' => 'html',
                    'value' => function($data)
                    {
                        return
                            Html::a($data->username, ['/users/view','id'=> $data->friend_id], ['class' => 'btn']);
                    }
                ],

                [
                    'label' => 'Send',
                    'format' => 'html',
                    'visible' => (Yii::$app->user->can('admin') || Yii::$app->user->identity->id === $model->id)?:false,
                    'value' => function($data)
                    {
                        return
                            Html::a(Yii::t('app', 'Messsage'), ['/users/view','id'=> $data->friend_id], ['class' => 'btn btn-primary']);
                    }
                ],

                [
                  'label' => 'Remove',
                  'format' => 'html',
                  'visible' => (Yii::$app->user->can('admin') || Yii::$app->user->identity->id === $model->id)?:false,
                  'value' => function($data)
                    {
                        return
                            Html::a(Yii::t('app', 'Remove friend'), ['/users/remove-friend', 'friendId'=> $data->friend_id, 'userId' => $data->user_id], ['class' => 'btn btn-primary']);
                    }
                ],
//                'id',
//                'user_id',
//                'friend_id',
//                'created_at',
//                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <div class="col-md-7">
        <?= FriendsStatementView::widget([
            'modelsArray' => $friendsQuery,
            'model' => $model,
        ])?>
    </div>
</div>



