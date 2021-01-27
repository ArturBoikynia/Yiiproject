<?php


namespace app\components;

use app\models\entities\Yiiusers;
use kartik\icons\Icon;
use Yii;
use yii\helpers\Html;
use app\models\entities\SchoolEntities;
use app\models\entities\HighSchoolEntities;

class getEducationParams
{
    public string $headerSchool = '';
    public string $headerHighSchool = '';
    public string $duration = '';
    public ?string $specialty = '';
    public ?string $nameOfSchool = '';
    public ?string $nameOfPlace = '';
    public ?string $nameOfUni = '';
    public ?string $nameOfFaculty = '';
    public ?string $nameOfDepartament = '';
    public ?string $deleteButtons = null;
    public ?string $updateButtons = null;

    public function __construct($query){
        if(Yii::$app->user->identity->id === $query->user_id){
            $this->setButtons($query);
        }
    }

    public function setButtons($query){

       $this->deleteButtons = Html::a('<span class="glyphicon glyphicon-remove" style="color: black" aria-hidden="true"></span>',
            ['delete-education', 'id' => $query->id, 'tableName' => $query::tableName()],
            ['class' => 'text-right',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);

        $this->updateButtons = Html::a('<span class="glyphicon glyphicon-refresh" style="color: black" aria-hidden="true"></span>',
            ['update-education', 'id' => $query->id, 'tableName' => $query::tableName()],
            ['class' => 'text-right',
                'data' => [
                    'method' => 'post',
                ],
            ]) ;
    }
    /**
     * @param string $headerSchool
     */
    public function setHeaderSchool(string $headerSchool): void
    {
        $this->headerSchool = $headerSchool;
    }

    /**
     * @param string $headerHighSchool
     */
    public function setHeaderHighSchool(string $headerHighSchool): void
    {
        $this->headerHighSchool = $headerHighSchool;
    }

    /**
     * @param string $duration
     */
    public function setDuration(?string $begin, ?string $end): void
    {
        if($begin && $end){
            $this->duration = '(' . $begin . ' ' . Yii::t('app', 'to') . ' ' . $end . ')';
        }
        else{
        $this->duration = '(Duration was not set)';
        }


    }

    /**
     * @param string $specialty
     */
    public function setSpecialty(?string $specialty): void
    {
        if($specialty){
            $string = '<strong>' . Yii::t('app', 'Specialty') . '</strong>' . ':' . ' ' . $specialty;
        }

        $this->specialty = $string;
    }

    /**
     * @param string|null $nameOfSchool
     */
    public function setNameOfSchool(?string $nameOfSchool): void
    {
        $string = '<strong>' . Yii::t('app', 'School') . '</strong>' . ':' . ' ' . $nameOfSchool ;

        $this->nameOfSchool = $string;
    }

    /**
     * @param string|null $nameOfPlace
     */
    public function setNameOfPlace(?string $nameOfPlace): void
    {
        $string = '<strong>' . Yii::t('app', 'Place') . '</strong>' . ':' . ' ' . $nameOfPlace;

        $this->nameOfPlace = $string;
    }

    /**
     * @param string|null $nameOfUni
     */
    public function setNameOfUni(?string $nameOfUni):void
    {
        $string = '<strong>' . Yii::t('app', 'Highschool') . '</strong>' . ':' . ' ' . $nameOfUni;

        $this->nameOfUni = $string;
    }

    /**
     * @param string|null $nameOfFaculty
     */
    public function setNameOfFaculty(?string $nameOfFaculty): void
    {
        if($nameOfFaculty){

            $string = '<strong>' . Yii::t('app', 'Faculty') . '</strong>' . ':' . ' ' . $nameOfFaculty;
        }

        $this->nameOfFaculty = $string;
    }

    /**
     * @param string|null $nameOfDepartament
     */
    public function setNameOfDepartament(?string $nameOfDepartament): void
    {
        if($nameOfDepartament){

            $string = '<strong>' . Yii::t('app', 'Departament') . '</strong>' . ':' . ' ' . $nameOfDepartament;
        }

        $this->nameOfDepartament = $string;
    }


}