<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\EventosUpdate;
use common\models\Vip;
use common\models\VipSearch;
use common\models\VipPulseira;
use common\models\VipPulseiraSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;

/**
 * PulseirasController implements the CRUD actions for Pulseiras model.
 */
class PulseirasController extends Controller
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
                            'actions' => ['index', 'view', 'comprar', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['cliente'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all Pulseiras models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PulseirasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pulseiras model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pulseiras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionComprar($id_evento, $codigorp)
    {
        $model = new Pulseiras();
        $evento = Eventos::findOne($id_evento);
        
        $id_de_vips_ocupados = VipPulseira::find()
            ->leftJoin('pulseiras', 'pulseiras.id = vip_pulseira.id_pulseira')
            ->where(['pulseiras.id_evento' => $id_evento])
            ->all();

        $id_de_vips=[];

        foreach($id_de_vips_ocupados as $i){
            array_push($id_de_vips, $i->id_vip);
        }

        $listavips = Vip::find()->orderBy(['preco'=>SORT_ASC])->all();

        return $this->render('comprar', [
            'model' => $model,
            'evento' => $evento,
            'codigorp' => $codigorp,
            'id_de_vips' => $id_de_vips,
            'listavips' => $listavips,
        ]);
    }

    /**
     * Updates an existing Pulseiras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pulseiras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pulseiras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pulseiras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pulseiras::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
