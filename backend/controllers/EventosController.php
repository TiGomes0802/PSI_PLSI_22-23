<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;

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
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                    ],
                ],
            ]
        );
    }


    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewEvento')) {

            $searchModel = new EventosSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewEvento')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
            
        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionCreate()
    {
        if (\Yii::$app->user->can('createEvento')) {

            $model = new Eventos();
        
            $user = Userprofile::find()->where(['userid' => Yii::$app->user->getId()])->one();

            if ($this->request->isPost && $model->load($this->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $model->cartaz = $model->nome . date("Ymdhisv") . '.' . $model->imageFile->extension;
                
                $model->idtipoevento = (int)$model->idtipoevento;
                $model->idcriador = $user->id;

                if ($model->save()) {
                    
                    $directoryName = 'cartaz/';
                    
                    if (!file_exists($directoryName)) {
                        mkdir($directoryName, 0777, true);
                    }

                    $model->imageFile->saveAs($directoryName . $model->cartaz);
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateEvento')) {

            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $model->idtipoevento = (int)$model->idtipoevento;

                if ($model->save()) {
                    
                    if($model->imageFile != null){
                        $model->imageFile->saveAs('cartaz/' . $model->cartaz);
                    }
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }  
    }


    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteEvento')) {

            $model = $this->findModel($id);
            $this->findModel($id)->delete();
            unlink('cartaz/' . $model->cartaz);
            return $this->redirect(['index']);
        
        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }  
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
