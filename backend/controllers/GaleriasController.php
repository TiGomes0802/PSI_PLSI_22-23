<?php

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
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
        $modelfotos = new Galerias();
        $evento = Eventos::findOne(['id' => $idevento]);
        if ($this->request->isPost && $modelfotos->load($this->request->post())) {
            $modelfotos->imageFile = UploadedFile::getInstances($modelfotos, 'imageFile');
            $directoryName = 'galeria/' . $idevento . '/';
            if (!file_exists($directoryName)) {
                mkdir($directoryName, 0777, true);
            }
            foreach($modelfotos->imageFile as $image){
                $model = new Galerias();
                $model->idevento = (int)$idevento;
                $model->foto = date("Ymdhis") . time().rand(10,999999999) . '.' . $image->extension;
                if ($model->save()) {
                    $image->saveAs($directoryName . $model->foto);
                } else{
                    return $this->render('create', [
                        'model' => $model,
                        'evento' => $evento,
                    ]);
                }
            }
            return $this->redirect(['index', 'idevento' => $idevento]);
        }
        return $this->render('create', [
            'model' => $modelfotos,
            'evento' => $evento,
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
        unlink('galeria/'. $model->idevento . '/' . $model->foto);
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
