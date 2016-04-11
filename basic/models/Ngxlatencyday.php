<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ngxlatencyday".
 *
 * @property integer $id
 * @property string $date
 * @property string $uri
 * @property integer $num
 * @property integer $t100
 * @property integer $t200
 * @property integer $t500
 * @property integer $t1000
 * @property integer $t3000
 * @property integer $tt
 * @property double $pt100
 * @property double $pt200
 * @property double $pt500
 * @property double $pt1000
 * @property double $pt3000
 * @property double $ptt
 */
class Ngxlatencyday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ngxlatencyday';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['num', 't100', 't200', 't500', 't1000', 't3000', 'tt'], 'integer'],
            [['pt100', 'pt200', 'pt500', 'pt1000', 'pt3000', 'ptt'], 'number'],
            [['uri'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => '日期',
            'uri' => 'uri',
            'num' => 'pv',
            't100' => '<100ms',
            't200' => '100~200ms',
            't500' => '200~500ms',
            't1000' => '500~1000ms',
            't3000' => '1~3s',
            'tt' => '>3s',
            'pt100' => '<100ms占比',
            'pt200' => '100~200ms占比',
            'pt500' => '200~500ms占比',
            'pt1000' => '500~1000ms占比',
            'pt3000' => '1~3s占比',
            'ptt' => '>3s占比',
        ];
    }
}
