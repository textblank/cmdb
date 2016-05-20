<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_improvement_tracking_info".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $info
 * @property integer $creator_id
 * @property string $creator
 * @property string $ctime
 */
class ServiceImprovementTrackingInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_improvement_tracking_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'info', 'ctime'], 'required'],
            [['parent_id', 'creator_id'], 'integer'],
            [['info'], 'string'],
            [['ctime'], 'safe'],
            [['creator'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'parent_id' => '主id',
            'info' => '内容',
            'creator_id' => '添加人id',
            'creator' => '添加人',
            'ctime' => '添加时间',
        ];
    }

    public function getParent(){
        return $this->hasOne(ServiceImprovementTracking::className(), ['id' => 'parent_id']);
    }
}
