<?php

namespace backend\models;

use backend\models\Ads;
use backend\models\CodeblocksAdscategories;
use common\behaviors\BlockCodeBehavior;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\Platforms;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "block_code".
 *
 * @property integer $id
 * @property string $name
 * @property integer $platform_id
 * @property string $hash_block
 * @property integer adstype_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Platforms $platform
 */
class BlockCode extends \yii\db\ActiveRecord
{

    public $categories;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_code';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
//            [
//                'class'=>BlockCodeBehavior::className(),
//                'blockcode_id' => ['post'],
//            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['platform_id', 'created_at', 'updated_at','adstype_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['hash_block'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'platform_id' => Yii::t('app', 'Platform ID'),
            'hash_block' => Yii::t('app', 'Hash Block'),
            'adstype_id' => Yii::t('app', 'Adstype'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatform()
    {
        return $this->hasOne(Platforms::className(), ['id' => 'platform_id']);
    }

    /**
     * Возвращает актуальное объявление
     * @param $hash_block
     * @param $host
     * @return array advertisment
     */
    public function getImgUrl($hash_block, $host)
    {
        $block_code = BlockCode::find()->where(['hash_block'=>$hash_block])->one();
        $param['blockcode_id'] = $block_code['id'];
        $param['platform_id'] = $block_code['platform_id'];
        $param['type_id'] = $block_code['adstype_id'];

        $platform = Platforms::find()->where(['id'=>$param['platform_id'],'status'=>Platforms::STATUS_ACTIVE])->one();
        if(!empty($platform))
        {
            if($this->getHost($platform['url'])!=$this->getHost($host))
            {
                return array('name'=>'Exception403');
            }
        }
        $categories_id = CodeblocksAdscategories::find()->where(['blockcode_id'=>$param['blockcode_id']])->all();
        if(is_array($categories_id))
        {
            foreach($categories_id as $category_id)
            {
                $categories[] = $category_id['adscategory_id'];
            }
        }
        $ads = Ads::find()->where(['status'=>Ads::STATUS_ACTIVE,'type_id'=>$param['type_id'], 'category_id'=>$categories])->all();
        foreach($ads as $advertisement)
        {
            $views = $advertisement->getView()->all();
            $sortAds[$advertisement->id] = count($views);
            $ads_type = $advertisement->getAdsType()->One();
            $adsArray[$advertisement->id]['picture'] = $advertisement->picture;
            $adsArray[$advertisement->id]['id'] = $advertisement->id;
            $adsArray[$advertisement->id]['action_url'] = $advertisement->action_url;
            $adsArray[$advertisement->id]['height'] = $ads_type->height;
            $adsArray[$advertisement->id]['width'] = $ads_type->width;
        }
        asort($sortAds);
        $currentAds = key($sortAds);
//        $adsView = new AdsViews();
//        $adsView->actionView($currentAds,$param['platform_id']);
        return $adsArray[$currentAds];
    }

    public function getHost($Address) {
        $parseUrl = parse_url(trim($Address));
        return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
    }
}
