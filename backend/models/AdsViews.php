<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ads_views".
 *
 * @property integer $id
 * @property integer $ads_id
 * @property integer $event_click
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Ads $ads
 */
class AdsViews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads_views';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ads_id', 'platform_id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ads_id' => Yii::t('app', 'Ads ID'),
            'platform_id' => Yii::t('app', 'platform_id'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasOne(Ads::className(), ['id' => 'ads_id']);
    }

    public function actionView($id, $platform_id)
    {
        $this->ads_id = $id;
        $this->platform_id = $platform_id;
        $this->save();
    }
}
