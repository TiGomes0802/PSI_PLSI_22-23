<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Faturas;

class FaturasController extends \yii\web\Controller
{
    public function actionViewfaturas()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $faturas = Faturas::find()
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->where(['pulseiras.id_cliente' => 16])
            ->all();

        return $faturas;
    }
}
