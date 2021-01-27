<?php

namespace app\models\forms;

use app\components\db\Where;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entities\FriendsEntities;



/**
 * FriendsSearch represents the model behind the search form of `app\models\entities\FriendsEntities`.
 */
class FriendsSearch extends FriendsEntities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'friend_id'], 'integer'],
            [['username', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FriendsEntities::find()->where(['user_id' => $params['id']]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        var_dump($this->user_id);
        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
            'user_id' => $this->user_id,
//            'friend_id' => $this->friend_id,
//            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
