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
 * @property string $estado 
 * @property int $id_criador
 * @property int $id_tipo_evento
 *
 * @property Userprofile $criador
 * @property Galerias[] $galerias
 * @property Pulseiras[] $pulseiras
 * @property Tipoevento $tipoEvento
 */
class EventosUpdate extends \yii\db\ActiveRecord
{
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
            [['nome', 'descricao', 'cartaz', 'dataevento', 'numbilhetesdisp', 'preco', 'estado', 'id_criador', 'id_tipo_evento'], 'required', 'message' => '{attribute} não pode estar vazio'],
            ['dataevento', 'safe'],
            ['dataevento', 'datetime', 'format' => 'php:Y-m-d H:i'],
            [['numbilhetesdisp', 'id_criador', 'id_tipo_evento'], 'integer'],
            ['preco', 'double'],
            [['nome', 'estado'], 'string', 'max' => 25],
            ['descricao', 'string', 'max' => 750],
            ['cartaz', 'string', 'max' => 250],
            ['id_criador', 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_criador' => 'id']],
            ['id_tipo_evento', 'exist', 'skipOnError' => true, 'targetClass' => Tipoevento::class, 'targetAttribute' => ['id_tipo_evento' => 'id']],
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
            'dataevento' => 'Dataevento',
            'numbilhetesdisp' => 'Numbilhetesdisp',
            'preco' => 'Preco',
            'estado' => 'Estado',
            'id_criador' => 'Id Criador',
            'id_tipo_evento' => 'Id Tipo Evento',
        ];
    }

    public function UpdateEstadoEvento()
    {
        $eventos = Eventosupdate::find()->where(['estado' => 'ativo'])->all();
        
        foreach($eventos as $evento){

            if(date('Y-m-d 06:00:00') < date('Y-m-d H:m:s')){
                $date = date('Y-m-d H:m:s');
            } else{
                $date = date('Y-m-d H:m:s', strtotime(date('Y-m-d H:m:s') . " - 1 day"));
            }

            if($evento->dataevento < $date){
                $eventoupdate = new Eventosupdate();
                $eventoupdate = Eventosupdate::find()->where(['id' => $evento->id])->one();
                var_dump($eventoupdate);
                $date = strtotime($evento->dataevento);
                $eventoupdate->dataevento = date('Y-m-d H:i', $date); 
                $eventoupdate->estado = 'desativo';
                if($eventoupdate->validate()){
                    $pulseiras = Pulseiras::find()->where(['estado' => 'ativa'])->andwhere(['id_evento' => $evento->id])->all();
                    foreach($pulseiras as $pulseira){
                        $pulseiraupdate = new Pulseiras();
                        $pulseiraupdate->estado = 'naousada';
                        $pulseiraupdate->save();
                    }
                }
                $eventoupdate->save();
            }
        }
    }
}
