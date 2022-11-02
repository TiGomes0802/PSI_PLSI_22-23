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
        $date->sub(new DateInterval("P18Y"));
        $max = $date->format('Y-m-d');

        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['role', 'trim'],
            ['role', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['nome', 'apelido', 'datanascimento'], 'required'],
            [['datanascimento'], 'safe'],
            ['datanascimento', 'date', 'format' => 'php:Y-m-d', 'max' => $max, 'tooBig' => 'Precisa ser maior de 18 anos.'],
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

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save(false);

        $userprofile->id = $user->getId();
        $userprofile->nome = $this->nome;
        $userprofile->apelido = $this->apelido;
        $userprofile->datanascimento = $this->datanascimento;
        
        $userprofile->userid = $this->userid;
        
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole($this->role);
        $auth->assign($authorRole, $user->getId());

        if($this->role == 'rp'){
            $userprofile->codigoRP = $this->username;
        }

        return $user->save() && $userprofile->save() && $this->sendEmail($user);
    }

    public function updatedados($id)
    {
        
        $user = new User();
        $userprofile = new Userprofile();

        $userprofile = Userprofile::findOne(['id' => $id]);
        $user = user::findOne(['id' => $userprofile->userid]);

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $userprofile->id = $this;
        $userprofile->nome = $this->nome;
        $userprofile->apelido = $this->apelido;
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
