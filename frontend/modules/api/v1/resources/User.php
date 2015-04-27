<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'created_at'];
    }

    public function extraFields()
    {
        return ['userProfile'];
    }
}
