<?php


namespace app\widgets;


use app\components\FriendsTemplate;
use app\components\web\checkFriendship;
use app\models\entities\Yiiusers;
use app\components\getEducationParams;
use Yii;

class EducationView extends \yii\base\Widget
{
    public array $querySchool = [];
    public array $queryHighSchool = [];


    public function init()
    {
        parent::init();


    }

    public function run()
    {
        return $this->template();
    }

    public function template(){




        foreach ($this->querySchool as $query){
            $objectSchool = new getEducationParams($query);
            $objectSchool->setHeaderSchool(Yii::t('app', 'School Education'));
            $objectSchool->setDuration($query->begin, $query->end);
            $objectSchool->setSpecialty($query->specialty);
            $objectSchool->setNameOfSchool($query->nameOfSchool);
            $objectSchool->setNameOfPlace($query->place);
            $templateSchool .= <<<HTML
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                              <div class="col-md-11">$objectSchool->duration</div>
                              <div class="col-md-1">$objectSchool->deleteButtons $objectSchool->updateButtons</div>
                        </div>
                    </div>
                        <div class="panel-body">
                            <h5>$objectSchool->nameOfSchool</h5>
                            <h5>$objectSchool->specialty</h5>
                            <h5>$objectSchool->nameOfPlace</h5>
                        </div>
                </div>
            HTML;

        }

    foreach ($this->queryHighSchool as $query){
        $objectUni = new getEducationParams($query);

        $objectUni->setHeaderHighSchool(Yii::t('app', 'High Education'));
        $objectUni->setDuration($query->begin, $query->end);
        $objectUni->setNameOfUni($query->nameOfUni);
        $objectUni->setSpecialty($query->specialty);
        $objectUni->setNameOfFaculty($query->faculty);
        $objectUni->setNameOfDepartament($query->departament);

        $templateHighSchool .= <<<HTML
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                          <div class="col-md-11"><strong>$query->degree $query->specialty</strong> $objectUni->duration</div>
                          <div class="col-md-1">$objectUni->deleteButtons $objectUni->updateButtons</div>
                    </div>
                </div>    
                <div class="panel-body">
                    <h5>$objectUni->nameOfUni</h5>
                    <h5>$objectUni->nameOfPlace</h5>
                    <h5>$objectUni->nameOfFaculty</h5>
                    <h5>$objectUni->specialty</h5>
                    <h5>$objectUni->nameOfDepartament</h5>
                </div>
            </div>
        HTML;
    }

        $schoolView = <<<HTML
            <div class="bs-callout bs-callout-danger" id="callout-overview-dependencies">
                <h4>$objectSchool->headerSchool</h4>
                <p>
                    $templateSchool
                </p>
            </div>
        HTML;

        $uniView = <<<HTML
           <div class="bs-callout bs-callout-uni" id="callout-overview-dependencies">
                <h4>$objectUni->headerHighSchool</h4>
                <p>
                    $templateHighSchool
                </p>
           </div>
        HTML;

        if(!$templateSchool){
            return $uniView;
        }
        if(!$templateHighSchool){
            return $schoolView;
        }
        return $uniView;

    }

}