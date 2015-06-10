<?php

use yii\db\Schema;
use yii\db\Migration;

class m150601_092133_codegen extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_code}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
            'platform_id' => Schema::TYPE_INTEGER,
            'adstype_id' => Schema::TYPE_INTEGER,
            'hash_block' => Schema::TYPE_STRING . '(128) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_blockcode', '{{%block_code}}', 'platform_id', '{{%platforms}}', 'id', 'cascade', 'cascade');
            $this->addForeignKey('fk_blockcode_ads', '{{%block_code}}', 'adstype_id', '{{%platforms}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_blockcode','{{%block_code}}');
            $this->dropForeignKey('fk_blockcode_ads','{{%block_code}}');

        }
        $this->dropTable('{{%block_code}}');
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
