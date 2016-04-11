<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "sysuser".
 *
 * @property integer $id
 * @property string $username
 * @property integer $employee_id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $department
 * @property string $first_time
 * @property string $last_time
 * @property string $session_id
 * @property integer $on_use
 */
class Sysuser extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
    public $rememberMe;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sysuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'on_use'], 'integer'],
            [['first_time', 'last_time'], 'safe'],
            [['username', 'name', 'mobile', 'ip'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 64],
            [['department'], 'string', 'max' => 256],
            [['session_id'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => '用户名',
            'employee_id' => '员工ID',
            'name' => '姓名',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'department' => '部门',
            'first_time' => '初次登陆',
            'last_time' => '最后登陆',
            'session_id' => '当前session',
            'on_use' => '在用',
            'password' => '密码',
        ];
    }

    public static function findIdentity($id)
    {
        if(!isset(Yii::$app->session['user'])) {
            $user = static::find()->where(['id' => $id])->findOne();
            Yii::$app->session['user'] = $user;
        }
        return Yii::$app->session['user'];
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey(){}
    public function validateAuthKey($authKey){}
}
