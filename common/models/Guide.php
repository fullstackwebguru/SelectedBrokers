<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "guide".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image_url
 * @property string $description
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 */

class Guide extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guide}}';
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
            [['title','meta_keywords', 'meta_description'], 'required'],
            [['description','image_url'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
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
            'category_id' => 'Category',
            'title' => 'Title',
            'slug' => 'Slug',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'description' => 'Description',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GuideCategory::className(), ['id' => 'category_id']);
    }

    public function getMaxSelfRank() {
        $maxModels = Guide::find()->orderBy(['self_rank' => SORT_DESC])->limit(1)->all();
        foreach ($maxModels as $maxModel) {
            return $maxModel->self_rank;
        }

        return 0;
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['news/slug', 'slug' => $this->slug];
    }

    public function shortDescription() {
        $len = strlen($this->description);
        $str = $this->description;
        if ($len > 50) {
            $str = substr($str, 0, 49);
            $str = $str . "...";
        }

        return $str;
    }
}
