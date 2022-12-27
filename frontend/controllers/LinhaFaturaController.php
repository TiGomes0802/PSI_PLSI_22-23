<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\EventosUpdate;
use common\models\Faturas;
use common\models\FaturasSearch;
use common\models\Linhafatura;
use common\models\LinhafaturaSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;
use common\models\Vip;
use common\models\VipSearch;
use common\models\VipPulseira;
use common\models\VipPulseiraSearch;

/**
 * LinhafaturaController implements the CRUD actions for LinhaFatura model.
 */
class LinhafaturaController extends Controller
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

    public function actionCreate($id_evento, $codigorp, $id_vip)
    {
        $linhasfaturas = new LinhaFatura();
        $fatura = new Faturas();
        $pulseira = new Pulseiras();
        $reserva_vip =  new VipPulseira();

        $user = Userprofile::find()->where(['user_id' =>  Yii::$app->user->id])->one();
        $vip = Vip::findOne($id_vip);

        if ($this->request->isPost && $linhasfaturas->load($this->request->post())) {
            
            $pulseira->estado = 'ativa';
            $pulseira->tipo = 'vip';
            if($codigorp != null){
                $pulseira->codigorp = $codigorp;
            }
            $pulseira->id_evento = intval($id_evento);
            $pulseira->id_cliente = $user->id;
            $pulseira->save(false);

            $reserva_vip->id_pulseira = $pulseira->id;
            $reserva_vip->id_vip = $vip->id;

            $fatura->datahora_compra = date("Y-m-d H:i:s");
            $fatura->preco = $vip->preco;
            $fatura->id_pulseira = $pulseira->id;
            $fatura->save(false);

            foreach($linhasfaturas->bebidas as $bebida){
                $novalinha = new LinhaFatura();
                $novalinha->id_bebida = $bebida;
                $novalinha->id_fatura = $fatura->id;
                $novalinha->bebidas = $bebida;
                $novalinha->save();
            }

            if ($pulseira->save() && $fatura->save() && $reserva_vip->save()) {    
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }
        } else {
            $linhasfaturas->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $linhasfaturas,
            'ngarrafas' => $vip->nbebidas,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = LinhaFatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
