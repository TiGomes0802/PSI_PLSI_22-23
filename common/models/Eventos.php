<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $cartaz
 * @property string $dataevento
 * @property int $numbilhetesdisp
 * @property float $preco
 * @property string $estado
 * @property int $id_criador
 * @property int $id_tipo_evento
 *
 * @property Userprofile $criador
 * @property Galerias[] $galerias
 * @property Pulseiras[] $pulseiras
 * @property Tipoevento $tipoEvento
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'cartaz', 'dataevento', 'numbilhetesdisp', 'preco', 'estado', 'id_criador', 'id_tipo_evento'], 'required'],
            [['dataevento'], 'safe'],
            [['numbilhetesdisp', 'id_criador', 'id_tipo_evento'], 'integer'],
            [['preco'], 'number'],
            [['nome', 'estado'], 'string', 'max' => 25],
            [['descricao'], 'string', 'max' => 750],
            [['cartaz'], 'string', 'max' => 250],
            [['id_criador'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_criador' => 'id']],
            [['id_tipo_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoevento::class, 'targetAttribute' => ['id_tipo_evento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'cartaz' => 'Cartaz',
            'dataevento' => 'Dataevento',
            'numbilhetesdisp' => 'Numbilhetesdisp',
            'preco' => 'Preco',
            'estado' => 'Estado',
            'id_criador' => 'Id Criador',
            'id_tipo_evento' => 'Id Tipo Evento',
        ];
    }

    /**
     * Gets query for [[Criador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriador()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'id_criador']);
    }

    /**
     * Gets query for [[Galerias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalerias()
    {
        return $this->hasMany(Galerias::class, ['id_evento' => 'id']);
    }

    /**
     * Gets query for [[Pulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulseiras()
    {
        return $this->hasMany(Pulseiras::class, ['id_evento' => 'id']);
    }

    /**
     * Gets query for [[TipoEvento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEvento()
    {
        return $this->hasOne(Tipoevento::class, ['id' => 'id_tipo_evento']);
    }
}
