<?php

use yii\db\Migration;

class m161120_215912_create_relationship_regul_cate_comp extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk-regulcomp-category_id-category-id', '{{%regulation_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-regulcate-company_id-company-id', '{{%regulation_broker}}', 'company_id', '{{%company}}', 'id', 'CASCADE');

        $this->addForeignKey('fk-regulcate-regulation_id-regulation-id', '{{%regulation_category}}', 'regulation_id', '{{%regulation}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-regulcomp-regulation_id-regulation-id', '{{%regulation_broker}}', 'regulation_id', '{{%regulation}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->removeForeignKey('fk-regulcomp-category_id-category-id');
        $this->removeaddForeignKey('fk-regulcate-company_id-company-id');
        $this->removeaddForeignKey('fk-regulcate-regulation_id-regulation-id');
        $this->removeaddForeignKey('fk-regulcomp-regulation_id-regulation-id');
        return false;
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
