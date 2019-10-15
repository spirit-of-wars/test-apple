<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 15.10.2019
 * Time: 7:08
 */

/**
 * @var \backend\modules\apple\models\Apple $apple
 * @var integer $leftPx
 * @var integer $topPx
 */
use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<div class="apple" style="color: <?=$apple->color?>; left: <?=$leftPx?>px; top: <?=$topPx?>px;">
    <i class="fa fa-apple"></i>
    <div class="apple-form">
        <?php $form = ActiveForm::begin(); ?>

        <input type="hidden" name="appleID" value="<?=$apple->id?>">
        <input type="hidden" name="fall" value="1">
        <div class="form-group">
            <?= Html::submitButton('Уронить', ['class' => 'btn btn-primary my-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php $form = ActiveForm::begin(); ?>

        <input type="hidden" name="appleID" value="<?=$apple->id?>">
        <input type="hidden" name="eat" value="10">
        <div class="form-group">
            <?= Html::submitButton('Откусить', ['class' => 'btn btn-primary my-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
