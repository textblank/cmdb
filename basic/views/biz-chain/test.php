<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BizChain */

$this->registerJsFile('http://demo.qunee.com/lib/qunee-min.js', ['depends' => ['app\assets\AppAsset']]);

$js = <<<'JS'


    var nodes = {};
    var graph = new Q.Graph('canvas');

    var url = 'index.php?r=biz-chain/get-json';
    $.getJSON(url, function(data){

        for(var i = 0; i < data.nodes.length; i++){
            createNode(data.nodes[i]['biz'], data.nodes[i]['id']);
        }

        for(var i = 0; i < data.edges.length; i++){
            createEdge(data.edges[i]['local_biz_id'], data.edges[i]['local_biz_name'], data.edges[i]['peer_biz_id'], data.edges[i]['peer_biz_name']);
        }

        var layouter = new Q.TreeLayouter(graph);
        layouter.layoutType = Q.Consts.LAYOUT_TYPE_EVEN_HORIZONTAL;
        layouter.doLayout({callback: function(){
            graph.zoomToOverview();
        }});

    });

    function createNode(label){
        var node = graph.createNode(label);
        node.size = {width: 16};
        nodes.push(node);
        return node;
    }

    function createEdge(from_id, from_name, to_id, to_name){
        if(nodes[from_id] && nodes[to_id]){
            if(from_id != to_id){
                console.log(nodes[from_id]);
                console.log(nodes[to_id]);
                // console.log(nodes);
                return graph.createEdge(nodes[from_id], nodes[to_id]);
            }
        }
    }

JS;

$this->registerJs($js);


?>
<div style="width: 2000px; height: 1000px;" id="canvas"/>


