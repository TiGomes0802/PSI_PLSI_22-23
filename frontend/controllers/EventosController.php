<?php

namespace frontend\controllers;

use Yii;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\EventosUpdate;

/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
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
                            'actions' => ['index', 'view'],
                            'allow' => true,
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Eventos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $eventos = Eventos::find()->where(['estado'=> 'ativo'])->all();
        
        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }

    /**
     * Displays a single Eventos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $evento = Eventos::FindOne($id);

        if (Yii::$app->user->id != null) {
            $comprado = Pulseiras::Find()->where(['id_cliente'=> Yii::$app->user->id])->andwhere(['id_evento'=>$id])->one();
        }else{
            $comprado = null;
        }

        return $this->render('view', [
            'evento' => $evento,
            'comprado' => $comprado,
        ]);
    }

    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Eventos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
