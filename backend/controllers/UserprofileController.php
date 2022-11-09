<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;
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
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.userid')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->orwhere(['auth_assignment.item_name' => 'admin'])
            ->orwhere(['auth_assignment.item_name' => 'gestor'])
            ->orwhere(['auth_assignment.item_name' => 'rp'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);

        }
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'gestor') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.userid')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => 'rp'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);
        }

        $searchModel = new ActiveDataProvider([
            'query' => $model,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
        ]);
    }

    public function actionIndexclientes()
    {
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.userid')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->orwhere(['auth_assignment.item_name' => 'cliente'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);
        }

        $searchModel = new ActiveDataProvider([
            'query' => $model,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $userprofile = Userprofile::find()->where(['userid' => $id])->one();

        return $this->render('view', [
            'model' => $userprofile,
        ]);
    }

    /**
     * Creates a new Userprofile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
    */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->createnewfuncionario()) {
                return $this->redirect(['index']);
            }else {
                #$model->loadDefaultValues();
            }
        } 
    
        return $this->render('create', [
            'model' => $model,
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

        $model = $model->updatedados($id);

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

        $model = $model->updatedados($id);

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
     * Deletes an existing Userprofile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $userprofile = Userprofile::find()->where(['userid' => $id])->one();
        $auth = AuthAssignment::find()->where(['user_id' => $id])->one();
        
        $userprofile->delete();
        $auth->delete();
        $user->delete();

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