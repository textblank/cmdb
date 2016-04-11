<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hostnameTag".
 *
 * @property string $id
 * @property string $hostname
 * @property string $tag
 */
class HostnameTag extends \yii\db\ActiveRecord
{
    public $tags;
    public $hostnames;
    public static $src_list = [
        1 => '自动发现',
        2 => '人工填写'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hostnametag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hostname'], 'string', 'max' => 128],
            [['tag'], 'string', 'max' => 32],
            [['src'], 'integer']
        ];
    }

    public function get_tag_hostname_num()
    {
        $ths = self::find()->orderBy("tag")->all();
        //var_dump($ths);
        if(count($ths) > 0) {
            foreach($ths as $th) {
                isset($r[$th->tag])?$r[$th->tag]++:$r[$th->tag]=1;
            }
            return $r;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hostname' => 'Hostname',
            'tag' => 'Tag',
            'src' => '来源'
        ];
    }
}
