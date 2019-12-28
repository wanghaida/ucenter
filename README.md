## UCenter Client For Laravel

### 安装

要安装此依赖包，您需要：

- PHP ^7.1 (Laravel 5+)
- PHP ^7.2 (Laravel 6+)

1、修改 `composer.json` 文件，然后运行 `composer update` 来更新依赖包。

```
"require": {
    "haaid/ucenter": "^1.0.0"
}
```

2、运行 `composer require haaid/ucenter` 来安装依赖包。

### 发布

运行以下命令发布配置文件：

```bash
php artisan vendor:publish --provider="Haaid\UCenter\UCenterServiceProvider"
```

### 路由

在 `routes/web.php` 中写入：

```php
UCenter::routes();
```

### Facades

依赖包已经创建了 `UCenter` 的别名，你可以直接使用。

也可以使用：`Haaid\UCenter\Facades\UCenter`

### 使用

例如获取用户名为 admin 的信息：

```php
use UCenter;

$result = UCenter::uc_get_user('admin');
var_dump($result);
```

更多函数请参考 `uc_client/client.php` 文件。

### 联系我

有问题，请提交 issue。

---

### 附录 1：如何重写接口事件

1、修改 `config/ucenter.php` 配置：

```php
return [
    'service' => env('UC_SERVICE', 'App\Services\UCenter'),
];
```

2、创建 `app/Services/UCenter.php` 文件：

```php
<?php

namespace App\Services;

class UCenter extends \Haaid\UCenter\Services\Api
{
    public function synlogin()
    {
        $uid = $this->get['uid'];
        $username = $this->get['username'];
        $password = $this->get['password'];
        $time = $this->get['time'];

        /*
         * 业务代码编写
         */

        return API_RETURN_SUCCEED;
    }
}
```

3、重写业务代码即可。注意保证配置文件的命名空间正确。

### 附录 2：路由的更多玩法

除了在 `routes/web.php` 中写入路由以外，也可以并建议在 `routes/api.php` 中写入：

```php
# 建议
UCenter::routes();
# 或者
Route::any(config('ucenter.url') . '/api/' . config('ucenter.apifilename'), '\Haaid\UCenter\Controllers\ApiController@run');
```

因为 `web.php` 当中，会自动加入 CSRF 的中间件，导致 UC Server 的 `post` 被拦截，写在 `api.php` 当中就不会。

所以 UC Server 编辑应用时，`应用接口文件名称` 写入上方的路由地址，例如：`api/uc`。
