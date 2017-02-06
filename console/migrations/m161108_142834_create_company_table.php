<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m161108_142834_create_company_table extends Migration
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

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'short_description' => $this->string(300)->notNull(),
            'description' => $this->text(),
            'logo_url' => $this->string(255),
            'image_url' => $this->string(255),
            'website_url' => $this->string(500)->notNull(),
            'rating' => $this->double(2)->notNull(),
            'review' => $this->text(),
            'bonus_as_value' => $this->integer(255)->notNull()->defaultValue(0),
            'bonus_offer' => $this->string(255),
            'bonus_offer_desc' => $this->string(255),
            'telephone' => $this->string(255),
            'established' => $this->integer(11),
            'regulation' => $this->string(255),
            'max_leverage' => $this->string(255),
            'min_deposit' => $this->integer(255),
            'spreads_from' => $this->string(255),
            'pairs_offered' => $this->string(255),
            'us_allowed' => $this->integer(2),
            'self_rank' => $this->integer(11),
            'button_text' => $this->string(255)->defaultValue('Visit Site'),
            'link_text' => $this->string(255)->defaultValue('Get Bonus'),
            'promotion_link_text' => $this->string(255)->defaultValue('Get Deal'),
            'bonus_link_heading' => $this->string(255)->defaultValue('#bonus# Welcome Bonus'),
            'slider_text' => $this->string(500),
            'slug' => $this->string(255),
            'user_favorite' => $this->integer(2)->defaultValue(0),
            'status' => $this->integer(2)->defaultValue(1),
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
        $this->dropTable('{{%company}}');
    }
}
