<?php

use yii\db\Schema;
use yii\db\Migration;

class m150531_075902_adstype extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adstype}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
            'height' => Schema::TYPE_INTEGER,
            'width' => Schema::TYPE_INTEGER,
        ], $tableOptions);
        //todo migrate not work
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_adstype', '{{%ads}}', 'type_id', '{{%adstype}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_adstype', '{{%adstype}}');
        }

        $this->dropTable('{{%adstype}}');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
