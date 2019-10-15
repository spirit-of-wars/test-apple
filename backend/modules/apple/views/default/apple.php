<?php
/**
 * @var $appleCollection \backend\modules\apple\collections\Apple
 * @var $errorMessage string
 * @var $stateMessages array
 */

use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<? if($stateMessages) { ?>
    <div class="alert alert-success">
        <? foreach($stateMessages as $msg) {
            echo $msg .'<br>';
        } ?>
    </div>
<? } ?>

<? if($errorMessage) { ?>
    <div class="alert alert-danger">
        <?=$errorMessage?>
    </div>
<? } ?>
<div class="cont">
    <div class="tree-head">
        <? foreach ($appleCollection->getOnTreeApples() as $apple) {
            $topCount = floor($apple->id/18);
            $topMultiplier = $topCount%2;
            $offset = 10*((($topCount/2)%3)+1);
            $leftMultiplier = $apple->id % 18;
            $leftPx = $leftMultiplier * 60 + $offset;
            $topPx = $topMultiplier * 70 + $offset;

            echo $this->render('_apple', [
                'apple' => $apple,
                'leftPx' => $leftPx,
                'topPx' => $topPx
            ]);
        } ?>
    </div>
    <div class="tree-trunk">
        <div class="generator">
            <?php $form = ActiveForm::begin(); ?>

            <input type="hidden" name="generator" value="1">
            <div class="form-group">
                <?= Html::submitButton('Сгенерировать яблок', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="ground">
        <? foreach ($appleCollection->getUnderTreeApples() as $apple) {
            $topCount = floor($apple->id/18);
            $topMultiplier = $topCount%1;
            $offset = 5*((($topCount/2)%3)+1);
            $leftMultiplier = $apple->id % 18;
            $leftPx = $leftMultiplier * 60 + $offset;
            $topPx = $topMultiplier * 70 + $offset - 60;

            echo $this->render('_apple', [
                'apple' => $apple,
                'leftPx' => $leftPx,
                'topPx' => $topPx
            ]);
        } ?>
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function(){
        let currActiveElemForm = null;
        $('body').on('click', function(){
           if(currActiveElemForm) {
               currActiveElemForm.toggle();
               currActiveElemForm = null;
           }
        });
        $(document).on('click', '.apple', function(){
            currActiveElemForm = $(this).find('.apple-form');
            currActiveElemForm.toggle();
        })
    });
</script>