<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m161109_180719_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(11),
            'title' => $this->string(255)->notNull(),
            'short_title' => $this->string(255)->notNull(),
            'short_description' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'image_url' => $this->string(255),
            'self_rank' => $this->integer(11),
            'status' => $this->integer(2)->defaultValue(1),
            'slider_title' => $this->string(255)->defaultValue('Top 10 Brokers for #name#'),
            'slider_description' => $this->string(500),
            'table_title' => $this->string(300)->defaultValue('Top 10 Brokers for #name#'),
            'table_risk' => $this->text(),
            'how_to_choose_title' => $this->string(300)->defaultValue('How to Choose the Best Online Broker for #name#'),
            'how_to_choose' => $this->text(),
            'slug' => $this->string(255),
            'meta_description' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
