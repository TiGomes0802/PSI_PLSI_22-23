<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Userprofile;

/**
 * UserprofileSearch represents the model behind the search form of `app\models\Userprofile`.
 */
class UserprofileSearch extends Userprofile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'codigoRP', 'userid'], 'integer'],
            [['nome', 'apelido', 'datanascimento'], 'safe'],
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
        $query = Userprofile::find();

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
            'id' => $this->id,
            'datanascimento' => $this->datanascimento,
            'codigoRP' => $this->codigoRP,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'apelido', $this->apelido]);

        return $dataProvider;
    }
}
