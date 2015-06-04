<?php

use yii\db\Schema;
use yii\db\Migration;

class m150603_230522_ads_events extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads_events}}', [
            'id' => Schema::TYPE_PK,
            'ads_id' => Schema::TYPE_INTEGER,
            'platform_id' => Schema::TYPE_INTEGER,
            'event' => Schema::TYPE_INTEGER,
            'ipAddress' => Schema::TYPE_STRING . '(128) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_adsevents', '{{%ads_events}}', 'ads_id', '{{%ads}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_adsevents','{{%ads_events}}');
        }
        $this->dropTable('{{%ads_events}}');
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
