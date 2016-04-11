<?php
$areas = ['北京', '广东', '上海', '天津', '重庆', '辽宁', '江苏', '湖北',
				  '四川', '陕西', '河北', '山西', '河南', '吉林', '安徽', '黑龙江',
				  '浙江', '福建', '湖南', '广西', '江西', '贵州', '云南', '西藏',
				  '海南', '甘肃', '宁夏', '青海', '新疆', '香港', '澳门', '台湾',
				  '内蒙古', '山东'];
$res = [];

function getColor($delay){
	$min = 50;
	$max = 500;
	$middle = ($max + $min) / 2;
	$scale = 255 / ($middle - $min);
	if($delay >= $max){
		return '#ff0000';
	}elseif($delay <= $min){
		return '#00ff00';
	}elseif($delay < $middle){
		return sprintf("#%02xFF00", ($delay - $min) * $scale);
	}else{
		return sprintf("#FF%02x00", 255 - ($delay - $middle) * $scale);
	}
}

foreach($areas as $a){
	$delay = mt_rand(50, 500);
	$res[] = [
		'name' => $a,
		'delay' => $delay, 
		'max_delay' => mt_rand($delay, 500),
		'min_delay' => mt_rand(50, $delay),
		'color' => getColor($delay)
	];
}
echo json_encode($res);