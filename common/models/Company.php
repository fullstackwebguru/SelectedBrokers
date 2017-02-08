<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $title
 * @property string $logo_url
 * @property string $image_url
 * @property string $short_description
 * @property string $description
 * @property string $website_url
 * @property string $bonus_text_font
 * @property string $bonus_offer
 * @property string $bonus_link_heading
 * @property integer $bonus_as_value
 * @property double $rating
 * @property string $self_rank
 * @property string $review
 * @property string $telephone
 * @property integer $established
 * @property string $regulation
 * @property integer $min_deposit
 * @property double $spreads_from
 * @property integer $pairs_offered
 * @property integer $us_allowed
 * 
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 */

class Company extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;
    public $temp_image_logo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
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
            [['title', 'website_url', 'meta_keywords', 'meta_description'], 'required'],
            [['bonus_as_value','bonus_offer'], 'required'],
            [['rating'], 'required'],
            [['self_rank','status'], 'integer'],
            [['review','short_description','description','logo_url', 'website_url', 'image_url', 'meta_keywords', 'meta_description'], 'string'],
            [['bonus_offer','bonus_offer_desc', 'telephone','regulation','max_leverage','pairs_offered','spreads_from'], 'string'],
            [['rating'], 'number', 'max' => 10],
            [['min_deposit'], 'number'],
            [['bonus_as_value','established','us_allowed'], 'integer'],
            [['user_favorite','extra_secure'], 'integer'],
            [['title', 'slug','short_description'], 'string'],
            [['button_text', 'link_text', 'promotion_link_text','bonus_link_heading','slider_text'], 'string'],
            [['temp_image','temp_image_logo'], 'safe'],
            [['temp_image','temp_image_logo'], 'file', 'extensions'=>'jpg, gif, png'],
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
            'website_url' => 'Website',
            'image_url' => 'Image',
            'logo_url' => 'Logo',
            'rating' => 'Rating',
            'spreads_from' => 'Spreads From (EUR/USD)',
            'bonus_as_value' => 'Bonus As Percentage',
            'bonus_offer' => 'Bonus Offers(Text)',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'slug' => 'Slug',
            'status' => 'Enabled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'temp_image_logo' => 'Logo',
            'temp_image' => 'Image'
        ];
    }

    /**
     * @return url
     */
    
    public function getRoute()
    {
        return ['review/slug', 'slug' => $this->slug];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateComps()
    {
        return $this->hasMany(CateComp::className(), ['company_id' => 'id']);
    }

    public function getRegulComps()
    {
        return $this->hasMany(RegulComp::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Feature::className(), ['company_id' => 'id']);
    }



    public function getMaxSelfRank() {
        $maxModels = Company::find()->orderBy(['self_rank' => SORT_DESC])->limit(1)->all();
        foreach ($maxModels as $maxModel) {
            return $maxModel->self_rank;
        }

        return 0;
    }

    public function getBonusLinkHeading() {
        $sanitizedLinkText = str_replace("#bonus#", $this->bonus_offer, $this->bonus_link_heading);
        return $sanitizedLinkText;
    }

    public function shortDescription() {
        $len = strlen($this->short_description);
        $str = $this->short_description;
        if ($len > 50) {
            $str = substr($str, 0, 49);
            $str = $str . "...";
        }

        return $str;
    }
}
