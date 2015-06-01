<?php

namespace app\models;

use common\behaviors\BlockCodeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "block_code".
 *
 * @property integer $id
 * @property string $name
 * @property integer $platform_id
 * @property string $hash_block
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Platforms $platform
 */
class BlockCode extends \yii\db\ActiveRecord
{

    public $categories;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_code';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
//            [
//                'class'=>BlockCodeBehavior::className(),
//                'blockcode_id' => ['post'],
//            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['platform_id', 'created_at', 'updated_at','adstype_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['hash_block'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'platform_id' => Yii::t('app', 'Platform ID'),
            'hash_block' => Yii::t('app', 'Hash Block'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'adstype' => Yii::t('app', 'Adstype'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatform()
    {
        return $this->hasOne(Platforms::className(), ['id' => 'platform_id']);
    }
}
