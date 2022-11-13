<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Userprofile;

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
    public $id;
    public $nome;
    public $apelido;
    public $datanascimento;
    public $codigoRP;
    public $userid;

    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P18Y'));
        $max = $date->format('d-m-Y');

        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já está a ser utilizado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['role', 'trim'],
            ['role', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já está a ser utilizado.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['nome', 'apelido', 'datanascimento'], 'required'],
            [['datanascimento'], 'safe'],
            ['datanascimento', 'date', 'format' => 'php:d-m-Y', 'max' => $max, 'tooBig' => 'Precisa ser maior de 18 anos.'],
            [['codigoRP', 'userid'], 'integer'],
            [['nome', 'apelido'], 'string', 'max' => 25],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $userprofile = new Userprofile();

        $userprofile->nome = $this->nome;
        $userprofile->apelido = $this->apelido;
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->email = $this->email;
        $userprofile->datanascimento = $this ->datanascimento;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save(false);

        $userprofile->userid = $user->getid();

        $auth = \Yii::$app->authManager;

        $authManager = $auth->getRole("cliente");
        $auth->assign($authorRole, $user->getid());

        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        

        return $user->save() && $this->sendEmail($user);
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
