<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SignupForm;
use common\models\Userprofile;
use common\models\UserprofileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserprofileController implements the CRUD actions for Userprofile model.
 */
class UserprofileController extends Controller
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
                ],
                
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view', 'update', 'update_password'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Displays a single Userprofile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $userprofile = Userprofile::find()->where(['userid' => $id])->one();

        return $this->render('view', [
            'model' => $userprofile,
        ]);
    }


    /**
     * Updates an existing Userprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new SignupForm();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate_password($id)
    {
        $model = new SignupForm();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            if(Yii::$app->user->getId() == $id){
                return $this->redirect(['/site/login']);
            }else{
                return $this->redirect(['view', 'id' => $id]);
                die;
            }
        }

        return $this->render('update_password', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Userprofile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Userprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userprofile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
