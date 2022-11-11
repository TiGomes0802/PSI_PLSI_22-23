<?php

namespace common\models;

use Yii;

use DateTime;
use DateInterval;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $id
 * @property string $nome
 * @property string $apelido
 * @property string $datanascimento
 * @property int|null $codigoRP
 * @property int|null $userid
 * @property string $sexo
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
        
        $date = new DateTime();
        $date->sub(new DateInterval('P18Y'));
        $max = $date->format('Y-m-d');

        return [
            [['nome', 'apelido', 'datanascimento', 'sexo'], 'required'],
            [['datanascimento'], 'safe'],
            ['datanascimento', 'date', 'format' => 'php:Y-m-d', 'max' => $max, 'tooBig' => 'Precisa ser maior de 18 anos.'],
            [['userid'], 'integer'],
            [['nome', 'apelido', 'codigoRP'], 'string', 'max' => 25],
            ['sexo', 'string', 'max' => 9],
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
            'sexo' => 'Sexo',
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
