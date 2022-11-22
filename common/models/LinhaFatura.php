<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linha_fatura".
 *
 * @property int $id
 * @property int $idbebida
 * @property int $idfatura
 *
 * @property Bebidas $idbebida0
 * @property Faturas $idfatura0
 */
class LinhaFatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linha_fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbebida', 'idfatura'], 'required'],
            [['idbebida', 'idfatura'], 'integer'],
            [['idbebida'], 'exist', 'skipOnError' => true, 'targetClass' => Bebidas::class, 'targetAttribute' => ['idbebida' => 'id']],
            [['idfatura'], 'exist', 'skipOnError' => true, 'targetClass' => Faturas::class, 'targetAttribute' => ['idfatura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idbebida' => 'Idbebida',
            'idfatura' => 'Idfatura',
        ];
    }

    /**
     * Gets query for [[Idbebida0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdbebida0()
    {
        return $this->hasOne(Bebidas::class, ['id' => 'idbebida']);
    }

    /**
     * Gets query for [[Idfatura0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfatura0()
    {
        return $this->hasOne(Faturas::class, ['id' => 'idfatura']);
    }
}
