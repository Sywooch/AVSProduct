<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads_category".
 *
 * @property integer $ads_id
 * @property integer $ads_category_id
 *
 * @property Ads $ads
 * @property Adscategory $adsCategory
 */
class AdsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ads_id', 'ads_category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ads_id' => Yii::t('app', 'Ads ID'),
            'ads_category_id' => Yii::t('app', 'Ads Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasOne(Ads::className(), ['id' => 'ads_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsCategory()
    {
        return $this->hasOne(Adscategory::className(), ['id' => 'ads_category_id']);
    }
}
