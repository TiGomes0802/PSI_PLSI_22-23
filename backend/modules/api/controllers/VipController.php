<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Vip;
use common\models\VipPulseira;

class VipController extends \yii\web\Controller
{
    public function actionViewvips()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $vips = Vip::find()->all();

        return $vips;
    }

    public function actionVipsocupados($id_evento)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $vips_ocupados = VipPulseira::find()
            ->leftJoin('pulseiras', 'pulseiras.id = vip_pulseira.id_pulseira')
            ->where(['pulseiras.id_evento' => $id_evento])
            ->all();

        return $vips_ocupados;
    }
}
