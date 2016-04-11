<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maintenance".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $ip
 * @property string $start_time
 * @property string $end_time
 * @property string $reson
 * @property integer $user_id
 * @property integer $status
 */
class Maintenance extends \yii\db\ActiveRecord
{
    public $hostnames;

    const STATUS_NO = 0;
    const STATUS_BEGIN = 1;
    const STATUS_END = 2;

    public static $status_text = [
        self::STATUS_NO => '登记',
        self::STATUS_BEGIN => '已开始',
        self::STATUS_END => '已恢复',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maintenance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time', 'reson', 'user_id'], 'required'],
            [['start_time', 'end_time', 'hostnames'], 'safe'],
            [['user_id', 'status'], 'integer'],
            [['hostname'], 'string', 'max' => 128],
            [['ip'], 'string', 'max' => 15],
            [['reson'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hostname' => 'hostname',
            'ip' => 'ip',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'reson' => '原因',
            'user_id' => '操作人',
            'status' => '状态 0 记录 1 已屏蔽 2 已恢复',
            'hostnames' => '主机名列表',
        ];
    }

    public function statusText(){
        return sprintf('%s', self::$status_text[$this->status]);
    }
}
