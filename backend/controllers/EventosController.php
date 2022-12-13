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
        
            $user = Userprofile::find()->where(['user_id' => Yii::$app->user->getId()])->one();

            if ($this->request->isPost && $model->load($this->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                
                if($model->imageFile != null){
                    $model->cartaz = $model->nome . date("Ymdhisv") . '.' . $model->imageFile->extension;
                }
                
                $model->id_tipo_evento = (int)$model->id_tipo_evento;
                $model->id_criador = $user->id;
                
                $input = strtotime($model->dataevento);
                $newdatetime = date('Y-m-d h:i',$input);

                $model->dataevento = $newdatetime;
                $model->estado = "ativo";

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

                $input = strtotime($model->dataevento);
                $newdatetime = date('Y-m-d h:i',$input);
                $model->dataevento = $newdatetime;

                $model->imageFileUpdate = UploadedFile::getInstance($model, 'imageFileUpdate');
                
                $model->imageFile = 'nada.png';

                $model->id_tipo_evento = (int)$model->id_tipo_evento;

                if ($model->save()) {
                    
                    if($model->imageFileUpdate != null){
                        $model->imageFileUpdate->saveAs('cartaz/' . $model->cartaz);
                    }
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
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
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
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
