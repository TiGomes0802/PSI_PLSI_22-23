<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarefas".
 *
 * @property int $id
 * @property string $descricao
 * @property int $feito
 * @property int $id_user
 *
 * @property Userprofile $user
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
            [['descricao', 'feito', 'id_user'], 'required'],
            ['id_user', 'integer'],
            ['feito', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
            [['descricao'], 'string', 'max' => 30],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'feito' => 'Feito',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'id_user']);
    }
}
