<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 4:43
 */

namespace backend\modules\apple\models\db;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property integer $id
 * @property string $color
 * @property integer $size_percent
 * @property integer $status
 * @property integer $fall_date
 * @property integer $created_at
 * @property integer $updated_at
 */

class Apple extends ActiveRecord
{
    const STATUS_ON_TREE = 1;
    const STATUS_UNDER_TREE = 2;
    const BASE_PERCENT_SIZE = 100;

    const DEFAULT_COLOR = 'green';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['color'], 'string', 'max' => 255],
            [['size_percent', 'status', 'fall_date', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ON_TREE, self::STATUS_UNDER_TREE,]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'size_percent' => 'Размер в процентах',
            'status' => 'Состояние',
            'fall_date' => 'Дата падения',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }
}