<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_delete_config".
 *
 * @property integer $id
 * @property string $hostname
 * @property integer $type
 * @property string $path
 * @property integer $threshold
 * @property string $matching
 */
class FileDeleteConfig extends \yii\db\ActiveRecord
{
    public $list;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_delete_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'threshold'], 'integer'],
            [['creator'], 'string', 'max' => 64],
            [['hostname'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 256],
            [['matching'], 'string', 'max' => 128]
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
            'type' => '类型 1 - 日期 2 - 大小',
            'path' => '路径',
            'threshold' => '阈值',
            'matching' => '匹配字串',
            'list' => 'hostname，一行一个',
            'creator' => '创建人',
        ];
    }
}
