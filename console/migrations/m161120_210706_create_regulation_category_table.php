<?php

use yii\db\Migration;

/**
 * Handles the creation of table `regulation_category`.
 */
class m161120_210706_create_regulation_category_table extends Migration
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

        $this->createTable('{{%regulation_category}}', [
            'id' => $this->primaryKey(11),
            'regulation_id' => $this->integer(11)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'position' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('regulation_category');
    }
}
