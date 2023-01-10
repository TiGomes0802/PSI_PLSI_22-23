<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarefas".
 *
 * @property int $id
 * @property string $Descricao
 * @property int|null $Feito
 * @property int $id_utilizador
 *
 * @property Userprofile $utilizador
 */
class Tarefas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarefas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Descricao','Feito', 'id_utilizador'], 'required'],
            [['Feito', 'id_utilizador'], 'integer'],
            [['Descricao'], 'string', 'max' => 30],
            [['id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_utilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Descricao' => 'Descricao',
            'Feito' => 'Feito',
            'id_utilizador' => 'Id Utilizador',
        ];
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'id_utilizador']);
    }
}
