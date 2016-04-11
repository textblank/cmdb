<?php

/* @var $this yii\web\View */

$this->title = 'CMDB';

?>
<div class="site-index">

    <div class="row">
    </div>

    <div class="body-content">

        <div class="row">
        <h2>服务器按Tag分组如下：</h2>
            <div>
<?php
if($tag_hostname_num) {
    foreach($tag_hostname_num as $t_h_n_k=>$t_h_n_v) {
?>
    <a class="btn btn-default" href="/index.php?r=server/tag&tag=<?php echo $t_h_n_k;?>"><?php echo $t_h_n_k;?> <?php echo $t_h_n_v;?></a>
<?php
    }
}
?>
            </div>
        </div>

    </div>
</div>
