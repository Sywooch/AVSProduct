<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Platforms]].
 *
 * @see Platforms
 */
class PlatformsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Platforms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Platforms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}