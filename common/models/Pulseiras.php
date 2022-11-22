<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pulseiras".
 *
 * @property int $id
 * @property string $estado
 * @property string $tipo
 * @property int $codigorp
 * @property int $idevento
 * @property int $idcliente
 *
 * @property Faturas[] $faturas
 * @property Userprofile $idcliente0
 * @property Eventos $idevento0
 * @property VipPulseira[] $vipPulseiras
 */
class Pulseiras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pulseiras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado', 'tipo', 'codigorp', 'idevento', 'idcliente'], 'required'],
            [['codigorp', 'idevento', 'idcliente'], 'integer'],
            [['estado', 'tipo'], 'string', 'max' => 25],
            [['idevento'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['idevento' => 'id']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['idcliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'codigorp' => 'Codigorp',
            'idevento' => 'Idevento',
            'idcliente' => 'Idcliente',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Faturas::class, ['idpulseira' => 'id']);
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'idcliente']);
    }

    /**
     * Gets query for [[Idevento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdevento0()
    {
        return $this->hasOne(Eventos::class, ['id' => 'idevento']);
    }

    /**
     * Gets query for [[VipPulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVipPulseiras()
    {
        return $this->hasMany(VipPulseira::class, ['idpulseira' => 'id']);
    }
}
