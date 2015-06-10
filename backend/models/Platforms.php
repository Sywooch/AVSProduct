<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "platforms".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Platforms extends \yii\db\ActiveRecord
{
    /**
     * This platform status
     */
    const STATUS_BANNED = 0;
    const STATUS_MODERATE = 1;
    const STATUS_ACTIVE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'platforms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 254],
            [['url'], 'string', 'max' => 127],
            [['name', 'url'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {

        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return PlatformsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlatformsQuery(get_called_class());
    }

    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BANNED => Yii::t('backend','Banned'),
            self::STATUS_MODERATE => Yii::t('backend','Moderate'),
            self::STATUS_ACTIVE => Yii::t('backend','Active'),
        ];
    }
}
