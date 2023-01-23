<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Pulseiras;
use common\models\Userprofile;
use common\models\Faturas;
use common\models\EventosUpdate;
use common\models\VipPulseira;

class PulseirasController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;

    public function actionViewallpulseiras($id, $estado)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($estado == 'ativa'){
            $pulseiras = Pulseiras::find()->where(['id_cliente' => $id, 'estado' => 'ativa'])->orderby(['id_evento'=>SORT_DESC])->all();
        }else if($estado == 'naoativa'){
            $pulseiras = Pulseiras::find()->where('id_cliente = ' . $id . ' and (estado = "desativa" or estado = "naousada")')->orderby(['id_evento'=>SORT_DESC])->all();
        }

        return $pulseiras; 
    }

    public function actionViewallpulseirasevento($idevento)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        $pulseiras = Pulseiras::find()->where(['id_evento' => $idevento])->all();

        return $pulseiras; 
    }

    public function actionComprarpulseira()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        $pulseira = new Pulseiras();
        $fatura = new Faturas();
        $reserva_vip =  new VipPulseira();
        $resquest = Yii::$app->request;

        $pulseira->estado = $resquest->post('estado');
        $pulseira->tipo = $resquest->post('tipo');
        $pulseira->codigorp = $resquest->post('codigorp');
        $pulseira->id_evento = $resquest->post('id_evento');
        $pulseira->id_cliente = $resquest->post('id_cliente');
        $fatura->preco = $resquest->post('preco');
        
        if($pulseira->codigorp == 'null'){
            $pulseira->codigorp = null;
        }

        $veripulseira = Pulseiras::find()->where(['id_evento' =>  $pulseira->id_evento])->andwhere(['id_cliente' =>  $pulseira->id_cliente])->one();
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $pulseira->codigorp])->one();
        $evento = EventosUpdate::findOne($pulseira->id_evento);

        if($veripulseira == null && ($codigorpvalido != null or $pulseira->codigorp == null && $evento->numbilhetesdisp > 0)){

            $pulseira->save(false);

            $fatura->datahora_compra = date("Y-m-d H:i:s");
            $fatura->preco = $evento->preco;
            $fatura->id_pulseira = $pulseira->id;

            $evento->numbilhetesdisp -= 1;
            $date = strtotime($evento->dataevento);
            $evento->dataevento = date('Y-m-d H:i', $date); 

            if ($evento->save() && $pulseira->save() && $fatura->save()) {    
                return $pulseira;
            }
        }else{
            return null;
        }

    }

}
