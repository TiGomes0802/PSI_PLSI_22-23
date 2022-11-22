<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property string $datahora_compra
 * @property int $idpulseira
 *
 * @property Pulseiras $idpulseira0
 * @property LinhaFatura[] $linhaFaturas
 */
class Faturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datahora_compra', 'idpulseira'], 'required'],
            [['datahora_compra'], 'safe'],
            [['idpulseira'], 'integer'],
            [['idpulseira'], 'exist', 'skipOnError' => true, 'targetClass' => Pulseiras::class, 'targetAttribute' => ['idpulseira' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datahora_compra' => 'Datahora Compra',
            'idpulseira' => 'Idpulseira',
        ];
    }

    /**
     * Gets query for [[Idpulseira0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpulseira0()
    {
        return $this->hasOne(Pulseiras::class, ['id' => 'idpulseira']);
    }

    /**
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
    {
        return $this->hasMany(LinhaFatura::class, ['idfatura' => 'id']);
    }
}
