<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ngxlatency".
 *
 * @property integer $id
 * @property string $time
 * @property string $ip
 * @property string $uri
 * @property integer $num
 * @property double $min
 * @property double $avg
 * @property double $max
 * @property integer $t100
 * @property integer $t200
 * @property integer $t500
 * @property integer $t1000
 * @property integer $t3000
 * @property integer $tt
 */
class Ngxlatency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ngxlatency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'num', 't100', 't200', 't500', 't1000', 't3000', 'tt'], 'integer'],
            [['min', 'avg', 'max'], 'number'],
            [['ip'], 'string', 'max' => 15],
            [['uri'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => '时间',
            'ip' => 'ip',
            'uri' => 'uri',
            'num' => 'pv',
            'min' => 'min(ms)',
            'avg' => 'avg(ms)',
            'max' => 'max(ms)',
            't100' => '<100ms',
            't200' => '100~200ms',
            't500' => '200~500ms',
            't1000' => '500~1000ms',
            't3000' => '1~3s',
            'tt' => '>3s',
            'pt100' => '<100ms(%)',
            'pt200' => '100~200ms(%)',
            'pt500' => '200~500ms(%)',
            'pt1000' => '500~1000ms(%)',
            'pt3000' => '1~3s(%)',
            'ptt' => '>3s(%)',
        ];
    }
}
