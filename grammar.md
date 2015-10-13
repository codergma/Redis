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
	
	key不存在返回nil 		
	key不是字符串，报错 		

*	GETRANGE key start end 		

	返回字符串中的一部分

*	GETSET key value 设置key，并返回旧的value

*


