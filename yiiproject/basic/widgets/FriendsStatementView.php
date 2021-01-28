<?php


namespace app\widgets;

use app\components\FriendsTemplate;
use app\models\entities\Yiiusers;
use yii\base\Widget;
use yii\web\View;


use app\components\web\checkFriendship;
class FriendsStatementView extends Widget
{
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
        $countQuery = checkFriendship::getQueryCount($this->model->id)?: false;

        $flowIcon = FriendsTemplate::setFlowIcon($countQuery);


        foreach ($this->modelsArray as $query){
            $object = new FriendsTemplate($query);

            $icon = <<<HTML
                <div class="row">
                    <div class="col-md-10">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="placeholder">
                                         $object->image 
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>$object->userName</h3>
                                </div>
                            </div>
                          <div class="caption">
                            <p>$object->acceptButton $object->rejectButton</p>
                          </div>
                        </div>
                    </div>
                </div>  
                 
            HTML;

            $layout .=<<<HTML
                <div >
                    $icon
                </div>
                 
            HTML;
        }

        if($countQuery){
            $template = $flowIcon . $layout;
        }

        return $template;
    }

}

