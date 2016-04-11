<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "update_time".
 *
 * @property integer $id
 * @property string $table_name
 * @property integer $uptime
 */
class UpdateTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'update_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name'], 'required'],
            [['uptime'], 'integer'],
            [['table_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'uptime' => 'Uptime',
        ];
    }
}
