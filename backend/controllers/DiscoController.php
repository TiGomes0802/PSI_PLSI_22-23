<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Disco;
use common\models\DiscoSearch;
use common\models\EventosUpdate;

/**
 * DiscoController implements the CRUD actions for Disco model.
 */
class DiscoController extends Controller
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
                            'actions' => ['view', 'update'],
                            'allow' => true,
                            'roles' => ['admin'],
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

    /**
     * Displays a single Disco model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel(1),
        ]);
    }

    /**
     * Updates an existing Disco model.
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
     * Finds the Disco model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Disco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disco::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
