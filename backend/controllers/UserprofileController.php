<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Userprofile;
use common\models\UserprofileSearch;
use common\models\SignupForm;
use common\models\User;
use common\models\AuthAssignment;

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
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Userprofile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserprofileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userprofile model.
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
     * Creates a new Userprofile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelprofile = new Userprofile();
        $modeluser = new SignupForm();
        $modelrole = new AuthAssignment();

        if ($this->request->isPost) {
            if ($modeluser->load($this->request->post()) && $modeluser->signup()) {
                $user = User::find()->where(['email' => $modeluser->email])->one();
                $modelprofile -> userid = $user->id;
                //$modelrole -> user_id = $user->id;

                if ($modelprofile->load($this->request->post()) && $modelprofile->save() && $modelrole->load($this->request->post())) {
                    $auth = \Yii::$app->authManager;
                    $authorRole = $auth->getRole($modelrole->item_name);
                    $auth->assign($authorRole, $user->id);
                    //return $this->redirect(['view', 'id' => $modelprofile->id]);
                    return $this->redirect(['index']);
                }
            }
        } else {
            $modelprofile->loadDefaultValues();
            //$modeluser->loadDefaultValues();
            //$modelrole->loadDefaultValues();
        }
    
        return $this->render('create', [
            'modelprofile' => $modelprofile,
            'modeluser' => $modeluser,
            'modelrole' => $modelrole,
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
        $modelprofile = $this->findModel($id);
        $modeluser = User::findOne($modelprofile->userid);
        $modelrole = AuthAssignment::findOne(['user_id' => $modelprofile->userid]);

        var_dump($modelprofile);
        var_dump($modeluser->password_has);
        var_dump($modelrole);
        die;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'modelprofile' => $modelprofile,
            'modeluser' => $modeluser,
            'modelrole' => $modelrole,
        ]);
    }

    /**
     * Deletes an existing Userprofile model.
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
