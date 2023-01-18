<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Eventos;

class EventosController extends \yii\web\Controller
{
    public function actionViewalleventos($estado)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $alleventos = Eventos::find()->where(['estado' => 'ativo'])->all();
        
        foreach($alleventos as $evento){
            $evento->id_criador = $evento->criador->nome . ' ' . $evento->criador->apelido;
            $evento->id_tipo_evento = $evento->tipoEvento->tipo;
        };

        return $alleventos;
    }
}
