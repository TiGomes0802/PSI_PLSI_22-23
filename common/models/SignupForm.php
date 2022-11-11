<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Userprofile;
use yii\web\IdentityInterface;

use DateTime;
use DateInterval;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $passwordrepet;
    public $id;
    public $nome;
    public $apelido;
    public $datanascimento;
    public $codigoRP;
    public $userid;
    public $sexo;

    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P18Y'));
        $max = $date->format('Y-m-d');

        return [
            [['username', 'email', 'role'], 'trim'],
            [['nome', 'apelido', 'datanascimento', 'username', 'email', 'role', 'password', 'passwordrepet', 'sexo'], 'required', 'message' => 'Este campo não pode ser vazio.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já está a ser utilizado.'],
            [['username', 'email'], 'string', 'min' => 5, 'max' => 255],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já está a ser utilizado.'],

            [['password', 'passwordrepet'], 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['passwordrepet', 'compare', 'compareAttribute'=>'password', 'message' => 'As passwords não correspondem'],

            [['datanascimento'], 'safe'],
            ['datanascimento', 'date', 'format' => 'php:Y-m-d', 'max' => $max, 'tooBig' => 'Precisa ser maior de 18 anos.'],
            ['userid', 'integer'],
            [['nome', 'apelido', 'codigoRP'], 'string', 'min' => 5, 'max' => 25],
            ['sexo', 'string', 'min' => 8, 'max' => 9],
            ['userid', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function createnewfuncionario()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $userprofile = new Userprofile();

        $userprofile->nome = $this->nome;
        $userprofile->apelido = $this->apelido;
        $userprofile->datanascimento = $this->datanascimento;
        $userprofile->sexo = $this->sexo;
        if($this->role == 'rp'){
            $userprofile->codigoRP = $this->username;
        }

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save(false);

        $userprofile->userid = $user->getId();

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole($this->role);
        $auth->assign($authorRole, $user->getId());

        return $user->save() && $userprofile->save() && $this->sendEmail($user);
    }

    public function updatedados($id)
    {   
        $userprofile = Userprofile::find()->where(['userid' => $id])->one();
        $user = user::find()->where(['id' => $id])->one();
        $model = $this;

        $model->username = $user->username;
        $model->email = $user->email;

        $model->nome = $userprofile->nome;
        $model->apelido = $userprofile->apelido;
        $model->sexo = $userprofile->sexo;
        $model->datanascimento = $userprofile->datanascimento;

        return $model;
    }

    public function updateload($id)
    {

        $userprofile = new Userprofile();
        $user = new User();

        $user = user::find()->where(['id' => $id])->one();
        $userprofile = Userprofile::find()->where(['userid' => $user->id])->one();
        
        $user->username = $this->username;
        $user->email = $this->email;

        if($this->password != null){
            $user->setPassword($this->password);
            $user->generateAuthKey();
        } else{
            $this->password = $user->password_hash;
            $user->auth_key = $user->auth_key;
            $user->password_hash = $user->password_hash;
        }

        $userprofile->nome = $this->nome;
        $userprofile->apelido = $this->apelido;
        $userprofile->sexo = $this->sexo;
        $userprofile->datanascimento = $this->datanascimento;
        
        return $user->save() && $userprofile->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
