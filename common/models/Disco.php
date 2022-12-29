<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "disco".
 *
 * @property int $id
 * @property string $nome
 * @property string $nif
 * @property string $localidade
 * @property string $codpostal
 * @property string $morada
 * @property int $lotacao
 */
class Disco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'localidade', 'codpostal', 'morada', 'lotacao'], 'required'],
            [['lotacao'], 'integer'],
            [['nome', 'localidade'], 'string', 'max' => 25],
            [['nif'], 'string', 'max' => 9],
            [['codpostal'], 'string', 'max' => 8],
            [['morada'], 'string', 'max' => 50],
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
            'nif' => 'Nif',
            'localidade' => 'Localidade',
            'codpostal' => 'Codpostal',
            'morada' => 'Morada',
            'lotacao' => 'Lotacao',
        ];
    }
}
