<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cate_comp`.
 */
class m161109_190347_create_cate_comp_table extends Migration
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

        $this->createTable('{{%cate_comp}}', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'rank' => $this->integer(11)->notNull(),
            'company_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-catecomp-category_id-category-id', '{{%cate_comp}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-catecomp-company_id-company-id', '{{%cate_comp}}', 'company_id', '{{%company}}', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%cate_comp}');
    }
}
