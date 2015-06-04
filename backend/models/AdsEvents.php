<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ads_events".
 *
 * @property integer $id
 * @property integer $ads_id
 * @property integer $platform_id
 * @property integer $event
 * @property string $ipAddress
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Ads $ads
 */
class AdsEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads_events';
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
            [['ads_id', 'platform_id', 'event', 'created_at', 'updated_at'], 'integer'],
            [['ipAddress'], 'required'],
            [['ipAddress'], 'string', 'max' => 128],
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
            'platform_id' => Yii::t('app', 'Platform ID'),
            'event' => Yii::t('app', 'Event'),
            'ipAddress' => Yii::t('app', 'Ip Address'),
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

    /**
     * @param $ipAddress
     * @param $ads_id
     * @param $platform_id
     * @param $event
     */
    public function setEvent($ipAddress, $ads_id, $platform_id, $event)
    {
        $this->ads_id = $ads_id;
        $this->ipAddress = $ipAddress;
        $this->platform_id = $platform_id;
        $this->event = $event;
        $this->banned_time = time() + (60 * 60 * 24);
        $this->save();
    }

    /**
     * @param $ipAddress
     * @param $ads_id
     * @param $platform_id
     * @return bool
     */
    public function checkUniqueEvent($ipAddress, $ads_id, $platform_id)
    {
        $events = $this->find()
            ->where(['ipAddress'=>$ipAddress, 'ads_id'=>$ads_id, 'platform_id'=>$platform_id])
            ->all();
        if(!empty($events))
        {
            foreach ($events as $event) {
                if(time() - $event->banned_time)
                {
                    return true;
                }
            }
        }
        return true;
    }
}
