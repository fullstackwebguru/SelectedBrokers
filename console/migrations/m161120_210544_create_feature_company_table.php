<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature_company`.
 */
class m161120_210544_create_feature_company_table extends Migration
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

        $this->createTable('{{%feature_company}}', [
            'id' => $this->primaryKey(11),
            'company_id' => $this->integer(11)->notNull(),
            'value' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-featurecomp-company_id-company-id', '{{%feature_company}}', 'company_id', '{{%company}}', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feature_company');
    }
}
