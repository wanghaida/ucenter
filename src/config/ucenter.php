<?php

return [
    'url'            => env('UC_URL', ''), // 应用的主 URL：接口 api 的前缀，比如 /xxx/api/uc.php 一般直接留空
    'connect'        => env('UC_CONNECT', null), // UCenter 连接方式：数据库方式（mysql）/接口方式（null）
    'dbhost'         => env('UC_DBHOST', 'localhost'),
    'dbuser'         => env('UC_DBUSER', 'root'),
    'dbpw'           => env('UC_DBPW', 'root'),
    'dbname'         => env('UC_DBNAME', 'ucenter'),
    'dbcharset'      => env('UC_DBCHARSET', 'utf8'),
    'dbtablepre'     => env('UC_DBTABLEPRE', '`ucenter`.uc_'),
    'dbconnect'      => env('UC_DBCONNECT', '0'),
    'key'            => env('UC_KEY', ''), // UCenter 通信密钥「必填」
    'api'            => env('UC_API', ''), // UCenter 访问地址「必填」
    'charset'        => env('UC_CHARSET', 'utf-8'),
    'ip'             => env('UC_IP', ''),
    'appid'          => env('UC_APPID', '1'), // UCenter 应用 ID「必填」
    'ppp'            => env('UC_PPP', '20'),

    // 应用接口文件名称
    'apifilename'    => env('UC_APIFILENAME', 'uc'),

    /**
     * 接口函数处理服务
     *
     * 如果需要处理异步登录等方法：
     * 1. 可以创建 app/Services/UCenter.php（文件放哪里都可以）实现该类实现的所有接口
     * 2. 可以创建 app/Services/UCenter.php（文件放哪里都可以）继承这个类，并改写其中的方法
     *
     * 注意：如需自行处理方法，需修改配置的命名空间。
     */
    'service'        => env('UC_SERVICE', 'Haaid\UCenter\Services\Api'),
];
