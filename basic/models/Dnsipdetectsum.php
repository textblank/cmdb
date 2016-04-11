<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dnsip_detect_sum".
 *
 * @property string $province
 * @property string $net
 * @property double $min
 * @property double $avg
 * @property double $max
 * @property double $lost
 */
class Dnsipdetectsum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dnsip_detect_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['min', 'avg', 'max', 'lost'], 'number'],
            [['province', 'net'], 'string', 'max' => 32],
            [['province', 'net'], 'unique', 'targetAttribute' => ['province', 'net'], 'message' => 'The combination of 省份 and 运营商 has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'province' => '省份',
            'net' => '运营商',
            'min' => 'min',
            'avg' => 'avg',
            'max' => 'max',
            'lost' => 'lost',
        ];
    }
}
