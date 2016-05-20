<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    @media (min-width: 1900px) {
      .container {
        width: 1870px;
      }
    }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CMDB',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => '机器列表', 'url' => ['/server']],
            //['label' => 'Tag管理', 'url' => ['/tags']],
            ['label' => '资源申请', 'url' => ['/askforresource']],
            ['label' => '网络速度', 'url' => ['/dnsping', 'net'=>'chinanet'],
                'items' => [
                    ['label' => '中国电信', 'url' => ['/dnsping', 'net'=>'chinanet']],
                    ['label' => '中国联通', 'url' => ['/dnsping', 'net'=>'unicom']],
                    ['label' => '中国移动', 'url' => ['/dnsping', 'net'=>'chinamobile']],
                ],
            ],
            ['label' => '返回码', 'url' => ['/ngxcoderecord'],
                'items' => [
                    ['label' => '实时返回码查询', 'url' => ['/ngxcoderecord']],
                    ['label' => '每日50x排行', 'url' => ['/ngxcodetop']],
                ],
            ],
            ['label' => '服务耗时', 'url' => ['/ngxlatencyday'],
                'items' => [
                    ['label' => '每日服务耗时统计', 'url' => ['/ngxlatencyday']],
                    ['label' => '实时服务耗时', 'url' => ['/ngxlatency']],
                ],
            ],
            ['label' => '服务查询', 'url' => ['/service']],
            ['label' => '服务埋点', 'url' => ['/service-point']],
            ['label' => '机器端口', 'url' => ['/portonhost']],
            ['label' => '日志清理', 'url' => ['/file-delete-config']],
            // ['label' => '运维文档', 'url' => ['/op-doc']],
            ['label' => '运维文档', 'url' => ['/op-doc'],
                'items' => [
                    ['label' => '运维文档', 'url' => ['/op-doc']],
                    ['label' => '服务问题跟踪', 'url' => ['/service-improvement-tracking']],
                ],
            ],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->getIdentity()->name . '/' . Yii::$app->user->getIdentity()->employee_id . ')',
                    'url' => ['/login/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget(); ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; www.fxiaoke.com <?= date('Y') ?></p>

        <p class="pull-right">Powered by OP</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
