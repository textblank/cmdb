<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_improvement_tracking".
 *
 * @property integer $id
 * @property string $find_date
 * @property string $name
 * @property string $intro
 * @property integer $query_count
 * @property integer $fail_count
 * @property string $fail_rate
 * @property string $timeout_rate
 * @property string $latency
 * @property string $employee_id
 * @property string $owner
 * @property string $plan
 * @property string $plan_date
 * @property string $finish_date
 * @property integer $status
 */
class ServiceImprovementTracking extends \yii\db\ActiveRecord
{
    public $oss;

    public static $status_css = [
        1 => '',
        2 => 'text-warning',
        3 => '',
        4 => 'text-success',
        5 => 'text-danger',
    ];

    public static $statusList = [
        1 => '登记',
        2 => '优化中',
        3 => '确认中',
        4 => '已完成',
        5 => '不做优化'
    ];

    public static $typeList = [
        1 => '耗时长',
        2 => '失败率高',
        3 => '失败数高'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_improvement_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['find_date', 'plan_date', 'finish_date', 'oss', 'plan'], 'safe'],
            [['query_count', 'fail_count', 'status', 'type'], 'integer'],
            [['fail_rate', 'timeout_rate', 'latency'], 'number'],
            [['name', 'intro', 'owner'], 'string', 'max' => 255],
            [['employee_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'oss' => '输入oss内容',
            'find_date' => '登记日期',
            'type' => '问题类型',
            'name' => '服务',
            'intro' => '说明',
            'query_count' => '调用量',
            'fail_count' => '失败数',
            'fail_rate' => '失败率',
            'timeout_rate' => '超时率',
            'latency' => '平均耗时',
            'employee_id' => '负责人id',
            'owner' => '负责人',
            'plan' => '改进方案',
            'plan_date' => '计划完成日期',
            'finish_date' => '完成日期',
            'status' => '状态',
        ];
    }

    public function statusText($status = null){
        $status = $status === null ? $this->status : $status;
        return sprintf('<span class="%s">%s</span>', self::$status_css[$status], self::$statusList[$status]);
    }

    public function typeText($type = null){
        $type = $type === null ? $this->type : $type;
        return self::$typeList[$type];
    }

    public function getDetails(){
        return $this->hasMany(ServiceImprovementTrackingInfo::className(), ['parent_id' => 'id']);
    }

    public function latencyText($status = null){
        return $this->type == 1 ? sprintf('<span style="background-color: rgb(250, 255, 189); padding: 5px;">%s</span', $this->latency) : $this->latency;
    }

    public function failRateText($status = null){
        return $this->type == 2 ? sprintf('<span style="background-color: rgb(250, 255, 189); padding: 5px;">%s</span', $this->fail_rate) : $this->fail_rate;
    }

    public function failCountText($status = null){
        return $this->type == 3 ? sprintf('<span style="background-color: rgb(250, 255, 189); padding: 5px;">%s</span', $this->fail_count) : $this->fail_count;
    }
}
