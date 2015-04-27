<?php

namespace tests\codeception\common\fixtures;
use yii\test\ActiveFixture;

/**
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class ArticleFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Article';
    public $depends = [
        'tests\codeception\common\fixtures\ArticleCategoryFixture',
        'tests\codeception\common\fixtures\UserFixture',
    ];
}
