<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "galerias".
 *
 * @property int $id
 * @property string $foto
 * @property int $id_evento
 *
 * @property Eventos $evento
 */
class Galerias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'galerias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foto', 'id_evento'], 'required'],
            [['id_evento'], 'integer'],
            [['foto'], 'string', 'max' => 250],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['id_evento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foto' => 'Foto',
            'id_evento' => 'Id Evento',
        ];
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Eventos::class, ['id' => 'id_evento']);
    }
}
