<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_geodata".
 *
 * @property integer $user_id
 * @property string $country
 * @property string $city
 * @property string $region
 * @property string $lat
 * @property string $lng
 * @property string $ip
 *
 * @property User $user
 */
class UserGeodata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_geodata}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country'], 'string', 'max' => 3],
            [['city', 'region', 'lat', 'lng'], 'string', 'max' => 32],
            [['ip'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'region' => Yii::t('app', 'Region'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'ip' => Yii::t('app', 'Ip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
