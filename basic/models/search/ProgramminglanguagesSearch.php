<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entities\ProgramminglanguagesEntities;

/**
 * ProgramminglanguagesSearch represents the model behind the search form of `app\models\entities\ProgramminglanguagesEntities`.
 */
class ProgramminglanguagesSearch extends ProgramminglanguagesEntities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'c', 'cPlus', 'cSharp', 'go', 'java', 'javaScript', 'matlab', 'objectiveC', 'perl', 'pascal', 'php', 'python', 'r', 'sql'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = ProgramminglanguagesEntities::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'c' => $this->c,
            'cPlus' => $this->cPlus,
            'cSharp' => $this->cSharp,
            'go' => $this->go,
            'java' => $this->java,
            'javaScript' => $this->javaScript,
            'matlab' => $this->matlab,
            'objectiveC' => $this->objectiveC,
            'perl' => $this->perl,
            'pascal' => $this->pascal,
            'php' => $this->php,
            'python' => $this->python,
            'r' => $this->r,
            'sql' => $this->sql,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
