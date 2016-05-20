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

        var _x = -2000;
        var _y = -500;
        var step = 100;
        var line_num = 10;
        var x = _x;
        var y = _y;
        for(var i = 0; i < data.nodes.length; i++){
            if(i > 0){
                if((i+1)%line_num == 0){
                    x = _x;
                    y += step;
                } else {
                    x += step;
                }
            }
            createNode(data.nodes[i]['biz'], data.nodes[i]['id'], x, y);
        }

        for(var i = 0; i < data.edges.length; i++){
            createEdge(data.edges[i]['local_biz_id'], data.edges[i]['local_biz_name'], data.edges[i]['peer_biz_id'], data.edges[i]['peer_biz_name']);
        }

        // var layouter = new Q.TreeLayouter(graph);
        // layouter.layoutType = Q.Consts.LAYOUT_TYPE_EVEN_HORIZONTAL;
        // layouter.doLayout({callback: function(){
        //     graph.zoomToOverview();
        // }});

        var layouter = new Q.SpringLayouter(graph);
        layouter.repulsion = 100; //排斥力
        layouter.attractive = 0.5; //吸引力
        layouter.elastic = 0.5; //弹力
        layouter.start();

        // var layouter = new Q.BalloonLayouter(graph);
        // layouter.radiusMode = Q.Consts.RADIUS_MODE_UNIFORM;
        // layouter.radius = 0.1; //半径
        // layouter.startAngle = Math.PI / 4; //角度
        // layouter.doLayout({callback: function(){
        //     graph.zoomToOverview();
        // }});
    });

    function createNode(label,id,x,y){
        var node = graph.createNode(label, x, y);
        node.size = {width: 16};
        nodes[id] = node;
        return node;
    }

    function createEdge(from_id, from_name, to_id, to_name){
        if(nodes[from_id] && nodes[to_id]){
            if(from_id != to_id){
                // console.log(nodes[from_id]);
                // console.log(nodes[to_id]);
                // console.log(nodes);
                var edge = new Q.Edge(nodes[from_id], nodes[to_id]);
                graph.graphModel.add(edge);
                edge.setStyle(Q.Styles.EDGE_COLOR, '#88AAEE');
                edge.setStyle(Q.Styles.EDGE_WIDTH, 2);
            }
        }
    }

JS;

$this->registerJs($js);


?>
<div style="width: 2000px; height: 1000px;" id="canvas"/>


