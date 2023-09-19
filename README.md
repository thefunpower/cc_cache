# 安装

在composer.json中添加
~~~
"thefunpower/cc_cache": "dev-main" 
~~~

# 配置

~~~
global $cache_drive,$cache_redis_config,$cache_file_dir,$cache_pre_key;
$cache_drive = 'redis';
$cache_redis_config = [
  'host'=>'127.0.0.1',
  'port'=>6379,
  'auth'=>''
];
~~~

# 使用

~~~
//设置
cc_cache($key,$value,$ttl);
//获取
cc_cache($key);
~~~

### 开源协议 

The [MIT](LICENSE) License (MIT)