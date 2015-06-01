<?php

use yii\db\Schema;
use yii\db\Migration;

class m150601_195429_codeblock_adscategory extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%codeblocks_adscategories}}', [
            'blockcode_id'=>Schema::TYPE_INTEGER,
            'adscategory_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_blockcode_id', '{{%codeblocks_adscategories}}', 'blockcode_id', '{{%block_code}}', 'id', 'cascade', 'cascade');
            $this->addForeignKey('fk_adscategory', '{{%codeblocks_adscategories}}', 'adscategory_id', '{{%adscategory}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_blockcode_id','{{%block_code}}');
            $this->dropForeignKey('fk_adscategory','{{%block_code}}');
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
