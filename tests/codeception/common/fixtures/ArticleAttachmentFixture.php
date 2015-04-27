<?php
namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * @author Andrey Avseenko <bropwnz0r@gmail.com>
 */
class ArticleAttachmentFixture extends ActiveFixture
{
    public $modelClass = 'common\models\ArticleAttachment';
    public $depends = [
        'tests\codeception\common\fixtures\ArticleFixture'
    ];
}
