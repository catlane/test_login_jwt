**简单jwt登录**

1、需要将login目录单独拿出去，部署一下，这样可以测试跨域问题；

2、如果用nginx，需要配置伪静态:
```nginxconf
location / {
	if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}
```
3、需要复制.example.env为.env文件

4、本项目的验证码为顶象极验证，因只是测试用，故没有用到和php后台配合的双重验证（更安全）

5、数据库只有一个，直接运行`php think migrate:run`或者导入数据库均可


By **杨宇辉-15033610274-3年PHP**

   