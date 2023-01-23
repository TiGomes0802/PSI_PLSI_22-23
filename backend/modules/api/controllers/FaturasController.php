<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Faturas;

class FaturasController extends \yii\web\Controller
{
    public function actionViewfaturas($id_cliente)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $faturas = Faturas::find()
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->where(['pulseiras.id_cliente' => $id_cliente])
            ->orderby(['datahora_compra'=>SORT_DESC])
            ->all();

        return $faturas;
    }
}
