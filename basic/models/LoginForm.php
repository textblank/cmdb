<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $captcha;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
            //['captcha', 'captcha', 'captchaAction' => 'login/captcha'],
        ];
    }

    public function attributeLabels(){
        return [
            'username' => '用户帐号',
            'password' => '登录密码',
            'captcha' => '验证码',
            'rememberMe' => '记住我'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    /*public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '错误的用户名或密码');
            }
        }
    }*/

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            //调用远程接口，验证用户名和密码
            if($this->validateFromFxk()) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 3 : 0);
            }
        }
        return false;
    }

    public function validateFromFxk()
    {
        //var_dump($this->username);
        $post['UserName'] = $this->username;
        $post['Password'] = $this->password;
        $post_json = json_encode($post);
        $url = "http://172.17.13.1:9995/Account/UserInfo/GetUserAccount";
        $header = [
            'Content-Type: application/json',
            'Content-Length: '.strlen($post_json),
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            print curl_error($ch);
        }
        curl_close($ch);
        $res =json_decode(json_decode($response, true), true);
        if($res['IsValid'] == true) {
            date_default_timezone_set('Asia/Shanghai');
            $time = date("Y-m-d H:i:s");
            $ip = $_SERVER["REMOTE_ADDR"];
            $ck = User::find()->where(['username' => $this->username])->one();
            if($ck) {
                $ck->last_time = $time;
                $ck->ip = $ip;
                $ck->update();
                Yii::$app->session['user'] = $ck;
            } else {
                $in = new User();
                $in->username = $this->username;
                $in->employee_id = $res['UserInfo']['EmployeeID'];
                $in->name = $res['UserInfo']['UserName'];
                $in->mobile = $res['UserInfo']['Mobile'];
                $in->email = $res['UserInfo']['Email'];
                $in->department = $res['UserInfo']['Department'];
                $in->first_time = $time;
                $in->last_time = $time;
                $in->ip = $ip;
                $in->on_use = 1;
                $in->save();
                Yii::$app->session['user'] = $in;
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::find()->where(['username' => $this->username])->one();

        }

        return $this->_user;
    }
}
