<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string $datanoticia
 * @property string $descricao
 * @property int $idcriador
 *
 * @property Userprofile $idcriador0
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'datanoticia', 'descricao', 'idcriador'], 'required'],
            ['datanoticia', 'safe'],
            ['datanoticia', 'datetime', 'format' => 'Y-m-d H:i:s'],
            ['idcriador', 'integer'],
            ['titulo', 'string', 'max' => 25],
            ['descricao', 'string', 'max' => 250],
            ['idcriador', 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['idcriador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'datanoticia' => 'Datanoticia',
            'descricao' => 'Descricao',
            'idcriador' => 'Idcriador',
        ];
    }

    /**
     * Gets query for [[Idcriador0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcriador0()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'idcriador']);
    }
}
