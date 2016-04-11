<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NgxcodetopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '50x 每日排行';
$this->params['breadcrumbs'][] = $this->title;
$model->readDate = '';

$js = <<<'JS'

    $("#ngxcodetopsearch-readdate").on('change', function(){
        console.log($(this).val());
        readDate = $(this).val();
        location.href = "/index.php?r=ngxcodetop&readDate="+readDate+"&NgxcodetopSearch[date]="+readDate;
    });

JS;
$this->registerJs($js);
?>
<div class="ngxcodetop-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-3 col-sm-3">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-md-7 col-sm-7">
        
    </div>
    <div class="col-md-2 col-sm-2">
        <?= $form->field($model, 'readDate')->widget(DateTimePicker::className(), [
            'language' => 'en',
            'size' => 'ms',
            'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
                'startView' => 2,
                'minView' => 2,
                'maxView' => 4,
                'autoclose' => true,
                //'linkFormat' => 'HH:ii P', // if inline = true
                'format' => 'yyyy-mm-dd', // if inline = false
                'todayBtn' => true
            ]
        ]);?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            'num',
            'uri',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
