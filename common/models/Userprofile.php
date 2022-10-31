<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $id
 * @property string $nome
 * @property string $apelido
 * @property string $datanascimento
 * @property int|null $codigoRP
 * @property int|null $userid
 *
 * @property User $user
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'apelido', 'datanascimento'], 'required'],
            [['datanascimento'], 'safe'],
            [['codigoRP', 'userid'], 'integer'],
            [['nome', 'apelido'], 'string', 'max' => 25],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userid' => 'id']],
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
            'apelido' => 'Apelido',
            'datanascimento' => 'Datanascimento',
            'codigoRP' => 'Codigo Rp',
            'userid' => 'Userid',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userid']);
    }
}
