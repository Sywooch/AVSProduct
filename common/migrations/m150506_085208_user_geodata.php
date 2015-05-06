<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_085208_user_geodata extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_geodata}}', [
            'user_id' => Schema::TYPE_PK,
            'country' => Schema::TYPE_STRING . '(3)',
            'city' => Schema::TYPE_STRING . '(32)',
            'region' => Schema::TYPE_STRING . '(32)',
            'lat' => Schema::TYPE_STRING . '(32)',
            'lng' => Schema::TYPE_STRING . '(32)',
            'ip' => Schema::TYPE_STRING . '(45)',
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_geodata', '{{%user_geodata}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
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
