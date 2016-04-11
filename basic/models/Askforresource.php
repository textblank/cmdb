<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "askforresource".
 *
 * @property string $id
 * @property string $product
 * @property string $module
 * @property string $owner
 * @property string $purpose
 * @property string $os
 * @property string $osver
 * @property integer $machineType
 * @property string $num
 * @property string $cpu
 * @property string $mem
 * @property string $sysdisk
 * @property string $userdisk
 * @property string $insideBandwidth
 * @property string $outsideBandwidth
 * @property string $expectDate
 * @property string $explan
 * @property string $memo
 * @property integer $status
 */
class Askforresource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askforresource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purpose', 'explan'], 'string'],
            [['machineType', 'num', 'cpu', 'mem', 'sysdisk', 'userdisk', 'insideBandwidth', 'outsideBandwidth', 'status'], 'integer'],
            [['expectDate'], 'safe'],
            [['product', 'module', 'owner', 'os', 'osver', 'neworexpansion'], 'string', 'max' => 32],
            [['memo'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'product' => '产品',
            'module' => '模块',
            'owner' => '接口人',
            'neworexpansion' => '扩容/新增',
            'purpose' => '用途',
            'os' => '操作系统',
            'osver' => '系统版本',
            'machineType' => '机器类型 1 实机 2 虚机',
            'num' => '数量',
            'cpu' => 'cpu(核)',
            'mem' => '内存(GB)',
            'sysdisk' => '系统盘(GB)',
            'userdisk' => '数据盘(GB)',
            'insideBandwidth' => '内网带宽(Mb)',
            'outsideBandwidth' => '外网带宽(Mb)',
            'expectDate' => '期望交付日期',
            'explan' => '资源使用说明',
            'memo' => '备注',
            'status' => '状态 1 审核中 2 交付中 3 已交付',
        ];
    }
}
