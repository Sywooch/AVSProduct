<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property string $banner_path
 * @property string $banner_base_url
 * @property string $name
 * @property integer $status
 * @property integer $type_size
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AdsCategory[] $adsCategories
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'type_size', 'created_at', 'updated_at'], 'integer'],
            [['banner_path', 'banner_base_url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'banner_path' => Yii::t('app', 'Banner Path'),
            'banner_base_url' => Yii::t('app', 'Banner Base Url'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'type_size' => Yii::t('app', 'Type Size'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsCategories()
    {
        return $this->hasMany(AdsCategory::className(), ['ads_id' => 'id']);
    }
}
