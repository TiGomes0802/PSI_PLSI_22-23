<?php

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Galerias;
use common\models\GaleriasSearch;
use common\models\Eventos;
use common\models\EventosSearch;

/**
 * GaleriasController implements the CRUD actions for Galerias model.
 */
class GaleriasController extends Controller
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

    /**
     * Lists all Galerias models.
     *
     * @return string
     */
    public function actionIndex($idevento)
    {
        $model = Galerias::find()->where(['idevento' => $idevento]);
        $evento = Eventos::findOne(['id' => $idevento]);
        $searchModel = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'evento' => $evento,
        ]);
    }

    /**
     * Displays a single Galerias model.
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
     * Creates a new Galerias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($idevento)
    {
        $model = new Galerias();
        $evento = Eventos::findOne(['id' => $idevento]);

        if ($this->request->isPost && $model->load($this->request->post())) {
            
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->idevento = $idevento;
            $model->foto = date("Ymdhisv") . '.' . $model->imageFile->extension;

            if ($model->save()) {

                $directoryName = 'galeria/' . $model->idevento . '/';
            
                if (!file_exists($directoryName)) {
                    mkdir($directoryName, 0777, true);
                }

                $model->imageFile->saveAs($directoryName . $model->foto);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'evento' => $evento,
        ]);
    }

    /**
     * Updates an existing Galerias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
    
            if ($model->save()) {
                
                $directoryName = 'galeria/' . $model->idevento . '/';

                $model->imageFile->saveAs($directoryName . $model->foto);
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Galerias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'idevento' => $model->idevento]);
    }

    /**
     * Finds the Galerias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Galerias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Galerias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
