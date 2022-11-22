<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Eventos;

/**
 * EventosSearch represents the model behind the search form of `common\models\Eventos`.
 */
class EventosSearch extends Eventos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numbilhetesdisp', 'idcriador', 'idtipoevento'], 'integer'],
            [['nome', 'descricao', 'cartaz', 'dataevento'], 'safe'],
            [['preco'], 'number'],
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
        $query = Eventos::find();

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
            'dataevento' => $this->dataevento,
            'numbilhetesdisp' => $this->numbilhetesdisp,
            'preco' => $this->preco,
            'idcriador' => $this->idcriador,
            'idtipoevento' => $this->idtipoevento,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'cartaz', $this->cartaz]);

        return $dataProvider;
    }
}
