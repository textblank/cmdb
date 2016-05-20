<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ServiceImprovementTracking;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceImprovementTracking */

$this->title = '服务问题跟踪：'.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Service Improvement Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-improvement-tracking-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td>{label}</td><td>{value}</td></tr>', 
        'attributes' => [
            // 'id',
            ['attribute' => 'type', 'value' => ServiceImprovementTracking::$typeList[$model->type]],
            'find_date',
            'name',
            'intro',
            'query_count',
            'fail_count',
            'fail_rate',
            'timeout_rate',
            'latency',
            'employee_id',
            'owner',
            'plan',
            'plan_date',
            'finish_date',
            ['attribute' => 'status', 'value' => ServiceImprovementTracking::$statusList[$model->status]],
        ],
    ]) ?>

</div>
<?= $this->render('info_list.php', [
    'model' => $model,
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,]) ?>