<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
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
 * @property string $ip
 * @property integer $on_use
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $list;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'on_use'], 'integer'],
            [['first_time', 'py', 'last_time', 'list'], 'safe'],
            [['username', 'name', 'mobile', 'ip'], 'string', 'max' => 32],
            [['email', 'py'], 'string', 'max' => 64],
            [['department', 'session_id'], 'string', 'max' => 255],
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
            'py' => '拼音',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'department' => '部门',
            'first_time' => '初次登陆',
            'last_time' => '最后登陆',
            'session_id' => '当前session',
            'ip' => 'IP',
            'on_use' => '在用',
            'list' => '用户信息'
        ];
    }

    public static function findIdentity($employee_id)
    {
        if(!isset(Yii::$app->session['user'])){
            $user = static::find()->where(['employee_id' => $employee_id])->one();
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

    public function getEmplyeeName()
    {
        return $this->name;
    }

    public function validatePassword($password)
    {
        return true;
    }

    public static function getName()
    {
        $data = [];
        $query = self::find()->all();
        foreach($query as $q){
            $data[] = $q->mobile.'-'.$q->name.'-'.$q->employee_id;
        }
        return $data;
    }

    public static function getNameByKey($q)
    {
        $data = [];
        $query = self::find()->where(['like','name', $q])->orWhere(['like', 'mobile', $q])->orWhere(['like', 'py', $q])->all();
        foreach($query as $row){
            $r['id'] = $row->employee_id;
            $r['data'] = $row->name;
            //$r['thumbnail'] = $row->mobile;
            $r['description'] = $row->username;
            $data[] = $r;
        }
        return $data;
    }

    public static function getNameOptions()
    {
        $data = [];
        $query = self::find()->all();
        foreach($query as $q){
            $data[$q->employee_id] = $q->mobile.'-'.$q->name.'-'.$q->employee_id;
        }
        return $data;
    }

    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey(){}
    public function validateAuthKey($authKey){}
}
