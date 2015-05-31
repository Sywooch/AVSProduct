<?php

namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property string $banner_path
 * @property string $banner_base_url
 * @property string $name
 * @property integer $status
 * @property integer $type_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AdsCategory[] $adsCategories
 */
class Ads extends \yii\db\ActiveRecord
{

    /**
     * This const status banners
     */
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;


    public $picture;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'banner_path',
                'baseUrlAttribute' => 'banner_base_url',
//                'typeAttribute' => true,
//                'sizeAttribute' => true,
                'nameAttribute' => false,
//                'orderAttribute' => true
            ]
        ];
    }
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
            [['status', 'type_id', 'created_at', 'updated_at'], 'integer'],
            [['banner_path', 'banner_base_url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 128],
            [['type_id'],'required'],
            ['picture', 'safe'],
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
            'user_id'=> Yii::t('app','User ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'category_id'=>Yii::t('app', 'Category ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsType()
    {
        return $this->hasMany(Adstype::className(), ['id' => 'type_id']);
    }
    /**
     * @return string
     */
    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    /**
     * @return array
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('backend','Active'),
            self::STATUS_DEACTIVE => Yii::t('backend','Deactive'),
        ];
    }
}
