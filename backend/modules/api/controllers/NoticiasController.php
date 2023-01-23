<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Noticias;

class NoticiasController extends \yii\web\Controller
{
    public function actionViewnoticias($id_cliente)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $noticias = Noticias::find()->all();

        return $noticias;
    }
}
