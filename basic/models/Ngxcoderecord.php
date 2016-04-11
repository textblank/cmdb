<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ngxcoderecord".
 *
 * @property integer $id
 * @property string $time
 * @property string $code
 * @property integer $num
 * @property string $uri
 */
class Ngxcoderecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ngxcoderecord';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num'], 'integer'],
            [['time'], 'string', 'max' => 20],
            [['code'], 'string', 'max' => 10],
            [['uri'], 'string', 'max' => 255],
            [['upstreamaddr'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'IP',
            'time' => '时间',
            'code' => '代码',
            'num' => '数量',
            'uri' => 'URI',
            'upstreamaddr' => '后端接口',
        ];
    }
}
