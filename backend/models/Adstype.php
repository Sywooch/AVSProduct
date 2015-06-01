<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adstype".
 *
 * @property integer $id
 * @property string $name
 * @property integer $height
 * @property integer $width
 *
 * @property Ads[] $ads
 */
class Adstype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adstype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['height', 'width'], 'integer'],
            [['name'], 'string', 'max' => 64]
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
            'height' => Yii::t('app', 'Height'),
            'width' => Yii::t('app', 'Width'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ads::className(), ['type_id' => 'id']);
    }


}
