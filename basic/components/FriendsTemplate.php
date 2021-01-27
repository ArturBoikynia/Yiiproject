<?php


namespace app\components;



use app\models\entities\StatementToFriendshipEntities;
use yii\helpers\Html;
use Yii;

class FriendsTemplate
{
    public ?StatementToFriendshipEntities $query = null;
    public string $userName = '';
    public string $acceptButton = '';
    public string $rejectButton = '';
    public string $image = '';



    public function __construct( StatementToFriendshipEntities $query){
        $this->query = $query;
        $this->setUserName();
        $this->setButtons();
        $this->setAvatar();

    }

    public static function setFlowIcon(int $countQuery){

        $flowIcon = <<<HTML
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Attention!</strong> You have $countQuery friend requests.
                </div>
            HTML;
        return $flowIcon;
    }

    private function setUserName(){
        $this->userName = Html::a($this->query->userAsk->surname . PHP_EOL . $this->query->userAsk->name,
            ['/users/view' , 'id' =>  $this->query->userAsk->id],
            [
                'data' => [
                    'method' => 'post',
                ],
            ]) ;
    }

    private function setButtons(){
        $this->acceptButton = Html::a(
            Yii::t('app', 'Accept'),
            ['accept-friend' , 'idStatement' => $this->query->id, 'user_answer_id' => $this->query->user_answer_id, 'user_ask_id' => $this->query->user_ask_id],
            ['class' => 'btn btn-primary',
                'data' => [
                    'method' => 'post',
                ],
            ]) ;
        $this->rejectButton = Html::a(
            Yii::t('app', 'Reject'),
            ['reject-friend' , 'idStatement' => $this->query->id],
            ['class' => 'btn btn-default',
                'data' => [
                    'method' => 'post',
                ],
            ]) ;
    }

    private function setAvatar(){
        $mainImage = EditPhoto::findMainPhoto($this->query->userAsk->id);

        $this->image = Html::img(['users/image', 'url' => $mainImage->path], [ 'width' => '100', 'height' => '100', 'class' => 'img-circle']);

    }

}


