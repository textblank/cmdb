<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biz_chain".
 *
 * @property integer $id
 * @property integer $local_biz_id
 * @property string $local_biz_name
 * @property integer $peer_biz_id
 * @property string $peer_biz_name
 * @property integer $num
 */
class BizChain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'biz_chain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['local_biz_id', 'local_biz_name', 'peer_biz_id', 'peer_biz_name'], 'required'],
            [['local_biz_id', 'peer_biz_id', 'num'], 'integer'],
            [['local_biz_name', 'peer_biz_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'local_biz_id' => 'Local Biz ID',
            'local_biz_name' => 'Local Biz Name',
            'peer_biz_id' => 'Peer Biz ID',
            'peer_biz_name' => 'Peer Biz Name',
            'num' => 'Num',
        ];
    }
}
