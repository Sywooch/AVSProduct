<?php

use yii\db\Schema;
use yii\db\Migration;

class m150603_183127_adsviews extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads_views}}', [
            'id' => Schema::TYPE_PK,
            'ads_id' => Schema::TYPE_INTEGER,
            'platform_id' => Schema::TYPE_INTEGER,
            'unique'=>Schema::TYPE_STRING . '(7) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_adsviews', '{{%ads_views}}', 'ads_id', '{{%ads}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_adsviews','{{%ads_views}}');

        }
        $this->dropTable('{{%ads_views}}');
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
