<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "op_doc".
 *
 * @property integer $id
 * @property string $title
 * @property integer $owner_id
 * @property string $owner_name
 * @property integer $busi1Id
 * @property integer $busi2Id
 * @property integer $busi3Id
 * @property string $content
 * @property string $create_time
 */
class OpDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'op_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'busi1Id', 'busi2Id', 'busi3Id', 'last_id'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'last_time'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['owner_name', 'last_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => '标题',
            'owner_id' => '作者id',
            'owner_name' => '作者',
            'busi1Id' => '一级业务',
            'busi2Id' => '二级业务',
            'busi3Id' => '三级业务',
            'content' => '内容',
            'create_time' => '创建时间',
            'last_id' => '最后编辑人id',
            'last_name' => '最后编辑人',
            'last_time' => '最后编辑时间'
        ];
    }

    public function getBiz1(){
        return $this->hasOne(Biz::className(), ['id' => 'busi1Id'])->from('biz as biz1');
    }

    public function getBiz2(){
        return $this->hasOne(Biz::className(), ['id' => 'busi2Id'])->from('biz as biz2');
    }

    public function getBiz3(){
        return $this->hasOne(Biz::className(), ['id' => 'busi3Id'])->from('biz as biz3');
    }
}
