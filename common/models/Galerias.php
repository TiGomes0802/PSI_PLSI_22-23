<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "galerias".
 *
 * @property int $id
 * @property string $foto
 * @property int $idevento
 *
 * @property Eventos $idevento0
 */
class Galerias extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

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
            [['foto', 'idevento'], 'required'],
            [['idevento'], 'integer'],
            [['foto'], 'string', 'max' => 250],
            [['idevento'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['idevento' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 50],
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
            'idevento' => 'Idevento',
            'imageFile' => 'Product Image',
        ];
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
}
