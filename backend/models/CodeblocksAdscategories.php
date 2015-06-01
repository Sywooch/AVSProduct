<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "codeblocks_adscategories".
 *
 * @property integer $blockcode_id
 * @property integer $adscategory_id
 *
 * @property Adscategory $adscategory
 * @property BlockCode $blockcode
 */
class CodeblocksAdscategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'codeblocks_adscategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockcode_id', 'adscategory_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blockcode_id' => Yii::t('app', 'Blockcode ID'),
            'adscategory_id' => Yii::t('app', 'Adscategory ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdscategory()
    {
        return $this->hasOne(Adscategory::className(), ['id' => 'adscategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockcode()
    {
        return $this->hasOne(BlockCode::className(), ['id' => 'blockcode_id']);
    }
}
