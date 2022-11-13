<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Userprofile;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['gestor','admin'],
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
        #var_dump(Yii::$app->user->id);
        #die;

        $model = Userprofile::find()->where(['userid' => Yii::$app->user->id])->one();    
        $grafico = (new yii\db\Query())->from('auth_assignment')->select(['item_name', 'COUNT(item_name) AS quantidade_item_name'])->groupBy('item_name')->all();
        $grafico2 = (new yii\db\Query())
        ->from('userprofile')
        ->select(['sexo', 'COUNT(sexo) AS quantidade'])
        ->leftJoin('user', 'user.id = userprofile.userid')
        ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
        ->orwhere(['auth_assignment.item_name' => 'cliente'])
        ->groupBy('sexo')
        ->all();

        return $this->render('index', [
            'model' => $model,
            'grafico' => $grafico,
            'grafico2' => $grafico2,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        //if (!Yii::$app->user->isGuest && $model->verifycanbackend()*/) {
        //    return $this->goHome();
        //}

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login() && $model->verifycanbackend()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    
}
