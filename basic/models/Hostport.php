<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hostport".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $ports
 * @property string $uptime
 */
class Hostport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hostport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uptime'], 'safe'],
            [['hostname'], 'string', 'max' => 32],
            [['ports'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hostname' => 'host',
            'ports' => 'ports',
            'uptime' => 'uptime',
        ];
    }
}
