<?php

namespace frontend\controllers;

use Yii;
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
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionCreate($id_evento, $codigorp)
    {
        $fatura = new Faturas();
        $pulseira = new Pulseiras();
        
        $user = Userprofile::find()->where(['user_id' =>  Yii::$app->user->id])->one();
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
    }

    protected function findModel($id)
    {
        if (($model = Faturas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
