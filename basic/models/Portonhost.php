<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portonhost".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $user
 * @property integer $port
 * @property string $processname
 * @property string $cmdline
 * @property string $owner
 * @property integer $counter
 * @property string $lasttime
 * @property string $firsttime
 */
class Portonhost extends \yii\db\ActiveRecord
{
    public $server_owner;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portonhost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port'], 'integer'],
            [['cmdline'], 'string'],
            [['lasttime', 'firsttime'], 'safe'],
            [['hostname', 'user', 'owner'], 'string', 'max' => 32],
            [['processname'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hostname' => 'Hostname',
            'user' => 'User',
            'port' => 'Port',
            'processname' => 'Processname',
            'cmdline' => 'Cmdline',
            'owner' => 'Owner',
            'server_owner' => '机器负责人',
            'lasttime' => 'Lasttime',
            'firsttime' => 'Firsttime',
        ];
    }

    public function getServer(){
        return $this->hasOne(Server::className(), ['hostname' => 'hostname']);
    }
}
