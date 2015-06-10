<?php

use yii\db\Schema;
use yii\db\Migration;

class m150518_071913_ads_main extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads}}', [
            'id'=>Schema::TYPE_PK,
            'banner_path' => Schema::TYPE_STRING . '(255) ',
            'banner_base_url' => Schema::TYPE_STRING . '(255) ',
            'name'=>Schema::TYPE_STRING .'(128) NOT NULL',
            'status'=>Schema::TYPE_SMALLINT,
            'type_id'=>Schema::TYPE_INTEGER,
            'user_id'=>Schema::TYPE_INTEGER,
            'action_url'=>Schema::TYPE_STRING . '(255) ',
            'category_id'=>Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_user_ads', '{{%ads}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
            $this->addForeignKey('fk_category_ads', '{{%ads}}', 'category_id', '{{%adscategory}}', 'id', 'cascade', 'cascade');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_user_ads','{{%ads}}');

        }
        $this->dropTable('{{%ads}}');
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
