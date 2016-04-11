<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $net_c[$net];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
.map{
    width:100%;
    height:500px;
    margin-top:50px;
    position:relative;
}
.pop{
    width: 120px;
    height:60px;
    position:absolute;
    display:none;
    background:#69c4ee;
    font-size:14px;
    padding:10px;
    color:#fff;
}
.pop > p{
    margin:0;
    line-height: 20px;
}
</style>
<div class="dnsipdetectsum-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('中国电信', ['index', 'net'=>'chinanet'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('中国联通', ['index', 'net'=>'unicom'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('中国移动', ['index', 'net'=>'chinamobile'], ['class' => 'btn btn-success']) ?>
    </p>
    <h5>通过ping各个运营商在各地的多个dns ip来获取网络延时，当平均延时小于30ms时为绿色，平均延时大于80ms时为红色，灰色为数据缺失。</h5>
</div>

<div class="map"></div>
<div class="pop"></div>

<script src="./map/jquery-1.8.3.min.js"></script>
<script src="./map/geomap.js"></script>
<script src="./map/main.js"></script>
<script type="text/javascript">
map.init();
map.loadData('/index.php?r=dnsping/getdata&net=<?php echo $net;?>');
</script>

<div class="dnsipdetectsum-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'province',
            'net',
            'min',
            'avg',
            'max',
            'lost',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{hi}',
            ],
        ],
    ]); ?>

</div>