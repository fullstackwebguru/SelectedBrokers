<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 */

class Page extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'page_id'], 'required'],
            [['description','page_id','meta_keywords', 'meta_description'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getRoute()
    {
        return ['page/slug', 'slug' => $this->slug];
    }
}
