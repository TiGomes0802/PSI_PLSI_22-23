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
                    'class' => AccessControl::class(),
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


    public function actionIndex($idevento)
    {
        if (\Yii::$app->user->can('viewGaleria')) {

            $model = Galerias::find()->where(['idevento' => $idevento]);
            $evento = Eventos::findOne(['id' => $idevento]);
            $searchModel = new ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'evento' => $evento,
        ]);
    }


    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewGaleria')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionCreate($idevento)
    {

        if (\Yii::$app->user->can('createGaleria')) {

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

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('createGaleria')) {

            $model = $this->findModel($id);
            unlink('galeria/'. $model->idevento . '/' . $model->foto);
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'idevento' => $model->idevento]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    protected function findModel($id)
    {
        if (($model = Galerias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
