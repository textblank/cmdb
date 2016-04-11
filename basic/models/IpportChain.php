<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ipport_chain".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $local_ip
 * @property string $local_port
 * @property string $peer_ip
 * @property string $peer_port
 * @property string $uptime
 * @property integer $times
 */
class IpportChain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ipport_chain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uptime'], 'required'],
            [['uptime'], 'safe'],
            [['times'], 'integer'],
            [['hostname'], 'string', 'max' => 32],
            [['local_ip', 'local_port', 'peer_ip', 'peer_port'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'hostname' => 'hostname',
            'local_ip' => 'local ip',
            'local_port' => 'local port',
            'peer_ip' => 'peer ip',
            'peer_port' => 'peer port',
            'uptime' => 'uptime',
            'times' => 'times',
        ];
    }
}
