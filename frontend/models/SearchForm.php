<?php
namespace frontend\models;

use yii\base\Model;

/**
 * Signup form
 */
class SearchForm extends Model
{
    public $name;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
        ];
    }
}
