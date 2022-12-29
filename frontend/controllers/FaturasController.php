<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Eventos;
use common\models\EventosUpdate;
use common\models\EventosSearch;
use common\models\Faturas;
use common\models\FaturasSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;

/**
 * FaturasController implements the CRUD actions for Faturas model.
 */
class FaturasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $model = new Eventosupdate();
        $model->UpdateEstadoEvento();
        
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['create'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    public function actionCreate($id_evento, $codigorp)
    {
        $user = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $pulseira = Pulseiras::find()->where(['id_evento' =>  $id_evento])->andwhere([ 'id_cliente' =>  $user->id])->one();
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $codigorp])->one();
        $evento = EventosUpdate::findOne($id_evento);

        if($pulseira == null && ($codigorpvalido != null or $codigorp == null && $evento->numbilhetesdisp > 0)){

            $fatura = new Faturas();
            $pulseira = new Pulseiras();

            $pulseira->estado = 'ativa';
            $pulseira->tipo = 'normal';
            if($codigorp != null){
                $pulseira->codigorp = $codigorp;
            }

            $pulseira->id_evento = $evento->id;
            $pulseira->id_cliente = $user->id;
            $pulseira->save(false);

            $fatura->datahora_compra = date("Y-m-d H:i:s");
            $fatura->preco = $evento->preco;
            $fatura->id_pulseira = $pulseira->id;

            $evento->numbilhetesdisp -= 1;
            $date = strtotime($evento->dataevento);
            $evento->dataevento = date('Y-m-d H:i', $date); 

            var_dump($evento);
            var_dump($evento->validate());
            //die;

            if ($evento->save() && $pulseira->save() && $fatura->save()) {    
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }

            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }else{
            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Faturas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
