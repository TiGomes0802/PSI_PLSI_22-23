<?php

namespace common\models;

use Yii;
use DateTime;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "eventos".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $cartaz
 * @property string $dataevento
 * @property int $numbilhetesdisp
 * @property float $preco
 * @property int $idcriador
 * @property int $idtipoevento
 *
 * @property Galerias[] $galerias
 * @property Userprofile $idcriador0
 * @property Tipoevento $idtipoevento0
 * @property Pulseiras[] $pulseiras
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;
    public $imageFileUpdate;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $date = new DateTime();
        $min = $date->format('Y-m-d h:i');

        return [
            [['nome', 'descricao', 'cartaz', 'dataevento', 'numbilhetesdisp', 'preco', 'idcriador', 'idtipoevento', 'imageFile'], 'required', 'message' => '{attribute} não pode estar vazio'],
            ['dataevento', 'safe'],
            ['dataevento', 'datetime', 'format' => 'php:Y-m-d h:i', 'min' => $min, 'tooSmall' => 'Data minima é ' . $min],
            [['numbilhetesdisp', 'idcriador', 'idtipoevento'], 'integer'],
            ['preco', 'double'],
            ['nome', 'string', 'max' => 25],
            ['descricao', 'string', 'max' => 750],
            ['cartaz', 'string', 'max' => 250],
            ['idcriador', 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['idcriador' => 'id']],
            ['idtipoevento', 'exist', 'skipOnError' => true, 'targetClass' => Tipoevento::class, 'targetAttribute' => ['idtipoevento' => 'id']],
            [['imageFile','imageFileUpdate'], 'file', 'extensions' => 'png, jpg'],
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
            'descricao' => 'Descricao',
            'cartaz' => 'Cartaz',
            'imageFile' => 'Product Image',
            'imageFileUpdate' => 'Product Image',
            'dataevento' => 'Dataevento',
            'numbilhetesdisp' => 'Numbilhetesdisp',
            'preco' => 'Preco',
            'idcriador' => 'Idcriador',
            'idtipoevento' => 'Idtipoevento',
        ];
    }

    /**
     * Gets query for [[Galerias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalerias()
    {
        return $this->hasMany(Galerias::class, ['idevento' => 'id']);
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

    /**
     * Gets query for [[Idtipoevento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtipoevento0()
    {
        return $this->hasOne(Tipoevento::class, ['id' => 'idtipoevento']);
    }

    /**
     * Gets query for [[Pulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulseiras()
    {
        return $this->hasMany(Pulseiras::class, ['idevento' => 'id']);
    }
}
