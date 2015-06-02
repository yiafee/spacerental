<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Search extends Model
{
    public $rate;
    public $date;
    public $time;
    public $keyword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate','date','time','keyword'],'safe'],
        ];
    }


}
