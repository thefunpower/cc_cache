<?php  
/**
* 设置或获取缓存
* global $cache_drive,$cache_redis_config,$cache_file_dir;
* $cache_drive = 'redis';
* $cache_redis_config = [
*   'host'=>'127.0.0.1',
*   'port'=>6379
* ];
*/
function cc_cache($key,$val=null,$ttl=null){
    global $cache_redis_config,$cache_pre_key,$cache_file_dir,$cache_drive,$cache;
    $key = $cache_pre_key.$key;
    if(!$cache){
        if(!$cache_drive){
            $cache_drive = 'redis';
        }
        if($cache_drive == 'file'){
            $cache = new Framework\Cache\FilesCache([
                'directory' => $cache_file_dir,
                'files_permission' => 0644,
            ]); 
        } 
        if($cache_drive == 'redis'){
            $configs = [
                'host'    => $redis_config['host']??'127.0.0.1',
                'port'    => $redis_config['port']??'6379',
                'timeout' => 0.0,
            ];
            $cache = new Framework\Cache\RedisCache($configs);
        }
    }  
    if($val){
        if(is_array($val)){
            $val = json_encode($val,JSON_UNESCAPED_UNICODE);
        }
        $cache->set($key, $val, $ttl);
    }else{
        $data = $cache->get($key);  
        if  ($data !== null) { 
            if(function_exists('is_json') && is_json($data)){
                return json_decode($data,true);
            }
            return $data;
        }
    } 
}
