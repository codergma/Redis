#Redis 语法学习

String数据类型

---

*	SET
>	SET key value     如果key存在就覆盖		
	SET key value EX  秒为单位设置过期时间		
	SET key value PX  毫秒为单位设置过期时间		
	SET key value NX  key不存在才设置成功		
	SET key value XX  key存在才设置成功 		

*	GET key
>	key不存在返回nil 		
	key不是字符串，报错 		

*	GETRANGE key start end 		
>	返回字符串中的一部分

*	GETSET key value 设置key，并返回旧的value

*	MSET key value [key value] 一次设置多个key,value

*	MGET　key [key] 一次得到多个value

*	STRLEN key 获取字符串长度　		

*	SETRANGE key offset value 相当于字符串替换效果	

*	APPEND key value    字符串追加			

*	SETNX key value 等价于　SET key value NX 		

*	SETEX key seconds value 等价于 SET key value EX 		

*	PSETEX　key milliseconds value 等价于　SET key value PSETEX　key

*	INCR key    值加１
	key不存在，先初始化为０，在加１		
	value不是数字，报错	

*	INCRBY key int 　值加一个整数		

*	INCRBY key float 值加一个浮点数		

*	DECR Key 		

*	DECRBY key int 				

*	




