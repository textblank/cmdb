<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $service
 * @property string $owner
 * @property string $info
 * @property integer $employee_id
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service'], 'required'],
            [[], 'integer'],
            [['employee_id', 'service', 'owner', 'info'], 'string', 'max' => 255],
            [['service'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service' => '服务',
            'owner' => '负责人',
            'info' => '说明',
            'employee_id' => '员工id',
        ];
    }

    public function insert($runValidation = true, $attributes = NULL){
        $trans = $this->db->beginTransaction();
        try {
            if(!parent::insert()){
                throw new \Exception("插入失败", 1);
            }

            $up = UpdateTime::find()->where(['table_name' => 'service'])->one();
            if($up){
                $up->uptime = intval(time());
                if(!$up->save()){
                    throw new \Exception("uptime update fail", 1);
                }
            } else {
                $up = new UpdateTime();
                $up->table_name = 'service';
                $up->uptime = intval(time());
                if(!$up->insert()){
                    throw new \Exception("uptime insert fail", 1);
                }
            }

            $trans->commit();
            return true;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            $trans->rollback();
            return false;
        }
    }

    public function update($runValidation = true, $attributes = NULL){
        $trans = $this->db->beginTransaction();
        try {
            if(!parent::update()){
                throw new \Exception("修改失败", 1);
            }

            $up = UpdateTime::find()->where(['table_name' => 'service'])->one();
            if($up){
                $up->uptime = intval(time());
                if(!$up->save()){
                    throw new \Exception("uptime update fail", 1);
                }
            } else {
                $up = new UpdateTime();
                $up->table_name = 'service';
                $up->uptime = intval(time());
                if(!$up->insert()){
                    throw new \Exception("uptime insert fail", 1);
                }
            }

            $trans->commit();
            return true;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            $trans->rollback();
            return false;
        }
    }
}
