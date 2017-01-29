<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m161110_172805_create_page_table extends Migration
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

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(11),
            'page_id' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'description' => $this->text(),
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
        $this->dropTable('{{%page}}');
    }
}
