<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vip_pulseira".
 *
 * @property int $id
 * @property int $id_vip
 * @property int $id_pulseira
 *
 * @property Pulseiras $pulseira
 * @property Vip $vip
 */
class VipPulseira extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vip_pulseira';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idvip', 'idpulseira'], 'required'],
            [['idvip', 'idpulseira'], 'integer'],
            [['idvip'], 'exist', 'skipOnError' => true, 'targetClass' => Vip::class, 'targetAttribute' => ['idvip' => 'id']],
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
            'idvip' => 'Idvip',
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
     * Gets query for [[Idvip0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdvip0()
    {
        return $this->hasOne(Vip::class, ['id' => 'idvip']);
    }
}
