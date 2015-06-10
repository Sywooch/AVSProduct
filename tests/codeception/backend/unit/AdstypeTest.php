<?php
/**
 * Created by PhpStorm.
 * User: ejayjr
 * Date: 05.06.15
 * Time: 0:54
 */

namespace tests\codeception\backend\unit;


use backend\models\Adstype;

class AdstypeTest extends DbTestCase
{
    /**
     * @var adstype
     */
    protected $adstype;

    protected function setUp()
    {
        parent::setUp();
        $this->adstype = new Adstype();
    }


    public function testNameIsRequired()
    {
        $this->adstype->name = '';
        $this->assertFalse($this->adstype->validate(array('name')));
    }

}
