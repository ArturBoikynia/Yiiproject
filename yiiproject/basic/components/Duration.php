<?php


namespace app\components;

use app\models\entities\ExperienceEntities;
use yii\helpers\Html;
use kartik\icons\Icon;
use Yii;
use DateTime;
use app\models\entities\Yiiusers;
class Duration
{
    public ? ExperienceEntities $query = null;
    public string $time = '';
    public string $duration = '';
    public string $updateButtons = '';
    public string $deleteButtons = '';
    public ?Yiiusers $model = null;


    public function __construct(ExperienceEntities $query , Yiiusers $model){
        $this->query = $query;
        $this->model = $model;
        $this->checkTime();
        $this->setTime();
    }

    public function checkTime(){

        if($this->query->to_this_day){
            $this->query->to = null;
            $this->query->save();
        }
    }
    private function setTime(){

        if($this->query->from && $this->query->to_this_day && !$this->query->to){
            $this->time = $this->query->from . PHP_EOL . 'to' . PHP_EOL  . 'present';
        }
        if($this->query->from && $this->query->to){
            $this->time = $this->query->from . PHP_EOL . 'to' . PHP_EOL  . $this->query->to;
        }
        $this->setButtons();
        $this->setDuration(...$this->setDiff());
    }

    private function setButtons(){
        if (Yii::$app->user->can('admin') || (Yii::$app->user->identity->id === $this->model->id)){

            $this->updateButtons = Html::a(
                Icon::show('edit', ['class' => 'fa-2x', 'style' => 'color:Black', 'framework' => Icon::FAS]),
                ['update-experience', 'id' => $this->query->user->id, 'update' => true, 'experienceId' => $this->query->id],
                ['class' => 'text-right',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ;

            $this->deleteButtons = Html::a(
                Icon::show('trash-alt', ['class' => 'fa-2x', 'label' =>'vsd', 'style' => 'color:Black', 'framework' => Icon::FAS]),
                ['delete-experience' , 'id' => $this->query->user->id, 'delete' => true, 'experienceId' => $this->query->id],
                ['class' => 'text-right',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ;

        }

    }
    private function setDuration( int $years, int $months, int $days){

        $templateWords = [
          'years'  => Yii::t('app', 'years'),
          'months'  => Yii::t('app', 'months'),
          'days'  => Yii::t('app', 'days'),
        ];

       $this->duration = $this->getDurationString($years, $months, $days, $templateWords);

    }

    private function setDiff():array{
        if($this->query->to_this_day && !$this->query->to){
            $years = date_diff(new DateTime($this->query->from), new DateTime(date('Y-m-d', time())))->y;
            $months = date_diff(new DateTime($this->query->from), new DateTime(date('Y-m-d', time())))->m;
            $days = date_diff(new DateTime($this->query->from), new DateTime(date('Y-m-d', time())))->d;

            return [$years, $months, $days];
        }
        elseif ($this->query->to && !$this->query->to_this_day){
            $years = date_diff(new DateTime($this->query->from), new DateTime($this->query->to))->y;
            $months = date_diff(new DateTime($this->query->from), new DateTime($this->query->to))->m;
            $days = date_diff(new DateTime($this->query->from), new DateTime($this->query->to))->d;

            return [$years, $months, $days];
        }
        else{
            return [0, 0, 0];   // if duration was not set all 0
        }
    }

    private function getDurationString(int $years, int $months, int $days, array $templateWords):string{
        if($years && !$months){
            if($years === 1){
                $templateWords['years'] = Yii::t('app', 'year') ;
            }
             return '(' . $years . PHP_EOL . $templateWords['years'] .')';
        }

        if($years && $months){
            if($years === 1){
                $templateWords['years'] = Yii::t('app', 'year') ;
            }
            if($months === 1){
                $templateWords['months'] = Yii::t('app', 'month') ;
            }
            return '(' . $years . PHP_EOL . $templateWords['years'] . PHP_EOL . $months .  PHP_EOL . $templateWords['months'] . ')';
        }

        if($months && !$days){
            if($months === 1){
                $templateWords['months'] = Yii::t('app', 'month') ;
            }
            return '(' . $months . PHP_EOL . $templateWords['months'] .')';
        }

        if($days && $months && !$years){
            if($months === 1){
                $templateWords['months'] = Yii::t('app', 'month') ;
            }
            if($days === 1){
                $templateWords['days'] = Yii::t('app', 'day') ;
            }
            return '(' . $months . PHP_EOL . $templateWords['months'] . PHP_EOL . $days .  PHP_EOL . $templateWords['days'] . ')';
        }

        if($days  && !$years && !$months){
            if($days === 1){
                $templateWords['days'] = Yii::t('app', 'day') ;
            }
            return '(' . $days . PHP_EOL . $templateWords['days'] .')';
        }

        return 'Duration was not set';

    }



}