<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ngxcodetop".
 *
 * @property integer $id
 * @property string $date
 * @property integer $num
 * @property string $uri
 */
class Ngxcodetop extends \yii\db\ActiveRecord
{
    public $readDate;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ngxcodetop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['num'], 'integer'],
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
            'date' => '日期',
            'num' => '数量',
            'uri' => 'URI',
            'readDate' => '选择日期',
        ];
    }
}
