<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property string $id
 * @property string $tag
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'string', 'max' => 32],
            [['tag'], 'unique']
        ];
    }

    public function getTags()
    {
        $tags = self::find()->orderBy("tag")->all();
        if(count($tags) > 0) {
            foreach($tags as $t) {
                $r[$t->tag] = $t->tag;
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
            'tag' => 'Tag',
        ];
    }
}
