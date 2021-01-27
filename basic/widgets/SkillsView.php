<?php
namespace app\widgets;

use app\components\db\ActiveRecord;
use yii\base\Widget;
use kartik\icons\Icon;
use yii\web\View;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;
use app\models\forms\AddSkill;
use app\models\entities\SkillsEntities;
use app\models\entities\Yiiusers;
use yii\helpers\Html;
use Yii;




class SkillsView extends Widget
{
    /* @var View $objekt */

    private array $arraySkills = [];
    private $message;
    private ?ActiveDataProvider $dataProvider = null;
    public ? View $viewObject = null;
    public ? AddSkill $model = null;
    public ? Yiiusers $userModel = null;
    public array $attributes = [];


    public function init()
    {
        parent::init();
        Icon::map($this->viewObject);
        $this->setSkills();
    }


    private function findAllSkills():array{
        $find = new SkillsEntities();
        $sql = 'SELECT * FROM skills WHERE user_id=:id';
        $allSkills = $find::findBySql($sql, [':id' =>$this->model->user_id ])->all();

        return $allSkills;
    }

    private function setSkills ():array{

        $allSkills = $this->findAllSkills();

        foreach ($allSkills as $skill){
            $this->arraySkills[] =  [
                'label' => Html::a(Icon::show('times-circle', ['class' => 'fa-2x', 'style' => 'color:Green', 'framework' => Icon::FAS]),
                    ['delete-skill', 'id' => $this->model->user_id, 'delete' => true, 'skill_id' => $skill->id],
                    ['class' => 'btn btn-link ',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]),
                'value' => $skill->skill,
                'contentOptions' => ['class' => 'col-lg-1 h3 '],
            ] ;
        }

        return $this->arraySkills;


    }
    public function run()
    {
        if (Yii::$app->user->identity->id === $this->model->user_id){
            $template = '<tr><th{contentOptions}>{value}</th><td{captionOptions}>{label}</td></tr>';
        }
        else{
            $template = '<tr><th{contentOptions}>{value}</th></tr>';
        }
        $table = DetailView::widget([
            'model' => $this->model,
            'options' => ['class' => 'col-lg-1'],
            'template' => $template,
            'attributes' => $this->arraySkills,
        ]);
        return $table;


    }




}
