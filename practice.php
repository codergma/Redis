<?php
header("content-type:text/html;charset=utf-8;");
/*
* 通过string类型，模拟限制规定时间段内某ip的访问次数。
*/
function limit_ip_by_string(){
	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
	$key = "limit_ip:{$_SERVER['REMOTE_ADDR']}";
	if ($redis->exists($key)) {
		if ($redis->get($key) < 10) {
			echo $redis->get($key);
			$redis->incr($key);
		}else{
			exit('访问超出限制<br/>');
		}

	}else{
		echo '0';
		$redis->multi();
		$redis->set($key,1);
		$redis->expire($key,30);
		$redis->exec();
	}
}

/* 第一种方法存在漏洞，在30s内访问超过10 次
   通过list类型,模拟限制ip访问次数　
*/
function limit_ip_by_list(){
	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
	$key = "limit_ip:{$_SERVER['REMOTE_ADDR']}";
	$len = $redis->lLen($key);

	if ($len < 10) {
		$redis->lPush($key,time());
		var_dump($redis->lRange($key,0,-1));
	}else{
		$time = $redis->lIndex($key,-1);
		if (time()-$time < 30) {
			exit('超出限制');
		}else{
			$redis->lPush($key,time());
			$redis->lTrim($key,0,9);
			var_dump($redis->lRange($key,0,-1));
		}
	}
}
limit_ip_by_list();