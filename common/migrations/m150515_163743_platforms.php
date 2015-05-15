<?php

use yii\db\Schema;
use yii\db\Migration;

class m150515_163743_platforms extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%platforms}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11)',
            'name' => Schema::TYPE_STRING . '(254)',
            'url' => Schema::TYPE_STRING . '(127)',
            'status'=> Schema::TYPE_INTEGER . '(1)',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_platforms', '{{%platforms}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_geodata', '{{%user_geodata}}');
        }
        $this->dropTable('{{%user_geodata}}');
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
