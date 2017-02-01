<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $short_title
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $self_rank
 * @property string $slug
 * @property string $image_url
 * @property string $slider_title
 * @property string $slider_description
 * @property string $table_title
 * @property string $table_risk
 * @property string $table_risk_short
 * @property string $table_advisor_disclosure
 * @property string $how_to_choose_title
 * @property string $how_to_choose
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 */

class Category extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['title','short_title', 'short_description', 'meta_keywords', 'meta_description'], 'required'],
            [['title'], 'string'],
            [['self_rank'], 'integer'],
            [['slider_description', 'slider_title', 'table_title', 'table_risk', 'table_risk_short', 'table_advisor_disclosure','how_to_choose_title', 'how_to_choose'], 'string'],
            [['banner_heading', 'banner_subheading', 'banner_background'], 'string'],
            [['show_deposit'], 'integer'],
            [['description', 'image_url', 'meta_keywords', 'meta_description'], 'string'],
            [['temp_image'], 'safe'],
            [['temp_image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'slug' => 'Slug',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'status' => 'Enabled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Finds category by title
     *
     * @param string $title
     * @return static|null
     */
    public static function findByCategorytitle($title)
    {
        return static::findOne(['title' => $title, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateComps()
    {
        return $this->hasMany(CateComp::className(), ['category_id' => 'id']);
    }

    public function getCateCompsSortByRank()
    {
        $query = $this->getCateComps()->joinWith('category')->joinWith('company')->orderBy('rank ASC');
        return $query->all();
    }

    public function getMaxRank() {
        return $this->getCateComps()->count();
    }

    public function getMaxSelfRank() {
        $maxModels = Category::find()->orderBy(['self_rank' => SORT_DESC])->limit(1)->all();
        foreach ($maxModels as $maxModel) {
            return $maxModel->self_rank;    
        }
    }

    public function getTableHeading() {
        $sanitizedLinkText = str_replace("#name#", $this->title, $this->table_title);
        return $sanitizedLinkText;
    }

    public function getHowToHeading() {
        $sanitizedLinkText = str_replace("#name#", $this->title, $this->how_to_choose_title);
        return $sanitizedLinkText;
    }

    public function getSliderHeading() {
        $sanitizedLinkText = str_replace("#name#", $this->title, $this->slider_title);
        return $sanitizedLinkText;
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['category/slug', 'slug' => $this->slug];
    }
}

