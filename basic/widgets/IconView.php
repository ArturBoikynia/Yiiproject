<?php
namespace app\widgets;

use yii\base\Widget;
use kartik\icons\Icon;
use yii\web\View;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;



class IconView extends Widget
{
    /* @var View $objekt */

    private array $arrayAttributes = [];
    private $message;
    private ?ActiveDataProvider $dataProvider = null;
    public ? View $viewObject = null;
    public ? Model $model = null;
    public array $attributes = [];


    public function init()
    {
        parent::init();
        Icon::map($this->viewObject);
        $this->setAttributes($this->attributes);

    }

    public function run()
    {
        $table = DetailView::widget([
            'model' => $this->model,
            'options' => ['class' => 'col-lg-1'],
            'attributes' => $this->arrayAttributes
            ]);
        return $table;


    }

    private function setAttributes(array $attributes, string $separator = ':'):void{

        foreach ($attributes as $attribute){
            if(stripos($attribute, $separator)){
                $paramsArray = explode($separator, $attribute);
                $param = $paramsArray[0];
                $bool = $this->model->$param;
                $this->arrayAttributes[] = $this->setIcons($paramsArray[0], $paramsArray[1], $bool);
            }
            else {
                $bool = $this->model->$attribute;
                $this->arrayAttributes[] = $this->setIcons($attribute, $attribute, $bool);
            }
        }
    }

    private function setIcons (string $attribute, string $value, $icon):array{

        if($icon){
            $icon =  [
                'attribute' => $attribute,
                'label' => Icon::show('check-circle', ['class' => 'fa-2x', 'style' => 'color:Green', 'framework' => Icon::FAS]),
                'value' => $value,
                'contentOptions' => ['class' => 'col-lg-1 h3 '],
            ];
            return $icon;
        }

        $icon = [
            'attribute' => $attribute,
            'label' => Icon::show('times-circle', ['class' => 'fa-2x', 'style' => 'color:Red', 'framework' => Icon::FAS]),
            'value' => $value,
            'contentOptions' => ['class' => ' col-lg-1 h3 strong'],
        ];
        return $icon;
    }
}
