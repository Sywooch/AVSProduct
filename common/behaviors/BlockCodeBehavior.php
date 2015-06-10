<?php
/**
 * Avseenko Andrey <bropwnz0r@gmail.com>
 */

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class BlockCodeBehavior extends Behavior
{

//    public $blockcode_id;
//
//    private $_prop2;
//
//    public function getProp2()
//    {
//        return $this->_prop2;
//    }
//
//    public function setProp2($value)
//    {
//        $this->_prop2 = $value;
//    }
//    /**
//     * Get events list.
//     * @return array
//     */
//    public function events()
//    {
//        return [
//            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
//            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
//        ];
//    }

//    public function afterInsert($event)
//    {
//        echo '<pre>';
//        print_r($event);
//        die();
//        $file = new File($event->filesystem, $event->path);
//        $model = new FileStorageItem();
//        $model->component = $this->component;
//        $model->path = $file->getPath();
//        $model->base_url = $this->getStorage()->baseUrl;
//        $model->size = $file->getSize();
//        $model->type = $file->getMimeType();
//        $model->name = pathinfo($file->getPath(), PATHINFO_FILENAME);
//        if (Yii::$app->request->getIsConsoleRequest() === false) {
//            $model->upload_ip = Yii::$app->request->getUserIP();
//        }
//        $model->save(false);
//    }

//    public function afterUpdate($event)
//    {
//        echo '<pre>';
//        print_r($this->blockcode_id);
//        die();
//    }

}
