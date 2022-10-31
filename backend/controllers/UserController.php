<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

use common\models\Userprofile;
use common\models\SignupForm;
use common\models\User;
use common\models\AuthAssignment;

/**
 * User controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    //public function actionCreate()
    //{
    //    return $this->render('form_add_empregado');
    //}
    
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
}
