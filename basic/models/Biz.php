<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biz".
 *
 * @property integer $id
 * @property integer $level
 * @property integer $l1id
 * @property integer $l2id
 * @property string $cname
 * @property string $ename
 * @property string $cshortname
 * @property string $eshortname
 * @property string $intro
 * @property integer $status
 */
class Biz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'biz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'l1id', 'l2id', 'status'], 'integer'],
            [['intro'], 'string'],
            [['cname', 'ename', 'cshortname', 'eshortname'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => '级别',
            'l1id' => '一级id',
            'l2id' => '二级id',
            'cname' => '中文名',
            'ename' => '英文名',
            'cshortname' => '中文缩写',
            'eshortname' => '英文缩写',
            'intro' => '介绍',
            'status' => '状态 1 在用 0 停用',
        ];
    }

    public static function autoTreeBiz1()
    {
        $query = self::find();
        $menuList = $query->select('id, cname')->where(['status'=>1, 'level'=>1])->indexBy('id')->asArray()->all();
        if($menuList) {
            foreach ($menuList as $item) {
                $list[$item['id']] = $item['cname'];
            }
            return $list;
        }
        return [];
    }

    public static function autoTreeBiz2($biz1Id)
    {
        $query = self::find();
        $menuList = $query->select('id, cname')->where(['status'=>1, 'l1id'=>$biz1Id])->indexBy('id')->asArray()->all();
        if($menuList) {
            foreach ($menuList as $item) {
                $list[$item['id']] = $item['cname'];
            }
            return $list;
        }
        return [];
    }

    public static function autoTreeBiz3($biz2Id)
    {
        $query = self::find();
        $menuList = $query->select('id, cname')->where(['status'=>1, 'l2id'=>$biz2Id])->indexBy('id')->asArray()->all();
        if($menuList) {
            foreach ($menuList as $item) {
                $list[$item['id']] = $item['cname'];
            }
            return $list;
        }
        return [];
    }

    public static function nameList()
    {
        $query = self::find();
        $menuList = $query->select('id, cname')->where(['status'=>1])->indexBy('id')->asArray()->all();
        if($menuList) {
            foreach ($menuList as $item) {
                $list[$item['id']] = $item['cname'];
            }
            return $list;
        }
        return [];
    }

    public static function getName($id)
    {
        $query = self::find();
        $name = $query->select('cname')->where(['id' => $id])->one();
        return $name;
    }

    public static function listBiz($level)
    {
        $data = [];
        $query = self::find()->where(['level' => $level])->all();
        foreach($query as $row){
            $data[$row->id] = $row->cname;
        }
        return $data;
    }
}
