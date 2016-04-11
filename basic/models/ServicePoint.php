<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_point".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $employee_id
 */
class ServicePoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'name', 'employee_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => '服务名',
            'name' => '负责人',
            'employee_id' => '负责人id',
        ];
    }
}
