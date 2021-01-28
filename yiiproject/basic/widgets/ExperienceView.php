<?php


namespace app\widgets;

use yii\base\Widget;
use yii\web\View;
use app\components\Duration;
use app\models\entities\Yiiusers;

class ExperienceView extends Widget
{
    public ?View $viewObject = null;
    public array $modelsArray = [];
    public ?Yiiusers $model = null;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->template();
    }

    public function template(){

        foreach ($this->modelsArray as $query){
            $duration = new Duration($query, $this->model);

            $template .=<<<HTML
                <div class="panel panel-default">
                    <div class="panel-heading">$duration->time $duration->duration</div>
                        <div class="panel-body">
                            <h4> Company:  $query->company </h4>
                            <h5> Post: $query->post  </h5>
                            <h5> Area of employment:  $query->areaOfEmployment </h5>
                      
                            <div style="text-align: right">
                               $duration->updateButtons 
                               $duration->deleteButtons
                            </div>
                        </div>
                </div>
            HTML;
    }
        return $template;
    }

}