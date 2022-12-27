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

        if($pulseira == null && ($codigorpvalido != null or $codigorp == null)){

            $fatura = new Faturas();
            $pulseira = new Pulseiras();

            $evento = Eventos::find()->where(['id' =>  $id_evento])->one();

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

            if ($pulseira->save() && $fatura->save()) {    
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }

            return $this->render('create', [
                'model' => $linhasfaturas,
                'ngarrafas' => $vip->nbebidas,
            ]);
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
