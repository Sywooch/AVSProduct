<?php

namespace frontend\modules\api\v1\resources;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;
use backend\models\BlockCode;
/**
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class Banner extends BlockCode
{
    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'name', 'hash_block'];
    }

    /**
     * @return array
     */
    public function extraFields()
    {
        return ['id'];
    }

}
