<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BizChain */

$this->registerJsFile('http://demo.qunee.com/lib/qunee-min.js', ['depends' => ['app\assets\AppAsset']]);

$js = <<<'JS'

    var graph = new Q.Graph('canvas');

    var url = 'index.php?r=biz-chain/get-json';
    var nodes = new Array();
    $.getJSON(url, function(data){

        for(var i = 0; i < data.nodes.length; i++){
            createNode(data.nodes[i]);
        }

        for(var i = 0; i < data.edges.length; i++){
            createEdge(data.edges[i]['local'], data.edges[i]['peer']);
        }

    });

    var nodes = [];
    function createNode(label){
        var node = graph.createNode(label);
        node.size = {width: 16};
        nodes.push(node);
        return node;
    }

    function createEdge(local, peer){
        var edge = graph.createEdge(local+'-'+peer, local, peer);
        return edge;
    }


JS;

$this->registerJs($js);


?>
<div style="width: 1000px; height: 1000px;" id="canvas"/>