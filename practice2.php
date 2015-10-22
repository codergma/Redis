<?php
header('content-type:text/html;charset=utf-8');
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$ip = $_SERVER['REMOTE_ADDR'];
$key = "rate.limiting:{$ip}";
$listLen = $redis->lLen($key);
echo $listLen;
if ($listLen<10)
{
	$redis->lPush($key,time());
}else
{
	$time = $redis->lIndex($key,-1);
	if (time()-$time < 60)
	{
		exit('超出限制');
	}else{
		$redis->lPush($key,time());
		$redis->lTrim($key,0,9);
	}
}


header('content-type:text/html;charset=utf-8');
echo $_SERVER['REMOTE_ADDR'];
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$exists = $redis->exists('liubin');
if ($exists)
{
	$times = $redis->incr('liubin');
	if ($times>10)
	{
		exit('超出限制');
	}
}else {
	$redis->multi();
	$redis->incr('liubin');
	$redis->expire('liubin',30);
	$redis->exec();
}
var_dump($exists);

