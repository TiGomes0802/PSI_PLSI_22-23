<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\AuthAssignment;
use common\models\Eventos;
use common\models\Userprofile;
use common\models\LoginForm;

class EventosController extends \yii\web\Controller
{

    public function actionIndex()
    {
        echo 'this is test'; exit;

        return $this->render('index');
    }

    public function actionViewalleventosdesativos()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $alleventos = Eventos::find()->where(['estado' => 'desativo'])->all();
        return $alleventos;
    }

    public function actionLogin($username, $password)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new LoginForm();
        $model->username = $username;
        $model->password = $password;
        if ($model->login()) {
            $userprofile = Userprofile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            $role = AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            //$user += [ "role" => $role->item_name ];
            $user = (object) [
                'id' => $userprofile->id,
                'nome' => $userprofile->nome,
                'apelido' => $userprofile->apelido,
                'datanascimento' => $userprofile->datanascimento,
                'sexo' => $userprofile->sexo,
                'role' => $role->item_name,
              ];
            return $user;
        };
        return null;
    }

}
